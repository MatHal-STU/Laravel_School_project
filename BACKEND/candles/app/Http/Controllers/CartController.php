<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cartitem;
use App\Models\Product;
use App\Models\User;

class CartController extends Controller
{

    
    public function addToCart(Request $request)
    {
        $id = $request->id; 
        $quantity = $request->quantity;
        $quantity = $quantity ?? 1;
        $product = Product::find($id);
        
        if(!$product) {
            abort(404);
        }

        if (Auth::check()){
            $user = Auth::user(); 
            $user_cart = $user->cartItems;
            if (empty($user_cart) or !$user_cart->contains('product_id', $id)) {

                // The product_id is not present in the user's cart, so add it
                $user->cartItems()->create([
                    'user_id' => $user->id,
                    'product_id' => $id,
                    'quantity' => $quantity,
                    'price' => $product->price,
                    'discount' => $product->discount,
                    'created_at' => now(),
                    'updated_at' => now(), 
                ]);

            }
            else{
                $existingCartItem = $user_cart->where('product_id', $id)->first();
                $existingCartItem->quantity += 1;
                $existingCartItem->save();
            }

        }


        else
        {
            $cart = session()->get('cart');
            if(!$cart) {
                $cart = [
                    $id => [
                        "product_id" => $product->name,
                        "name" => $product->name,
                        "quantity" => $quantity,
                        "price" => $product->price,
                        "image" => $product->photo_path
                    ]
                ];
                session()->put('cart', $cart);
                return redirect()->back()->with('success', 'Product added to cart successfully!');
            }

            if(isset($cart[$id])) {
                $cart[$id]['quantity']++;
                session()->put('cart', $cart);
                return redirect()->back()->with('success', 'Product added to cart successfully!');
            }

            $cart[$id] = [
                "product_id" => $product->name,
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->price,
                "image" => $product->photo_path
            ];

            session()->put('cart', $cart);
        } 

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function show_cart()
    {
        $cart = session()->get('cart');
        $cartItems = [];
        $cart_items = [];
        $totalPrice = 0;
        $totalQuantity = 0;
        
        if (Auth::check()) {
            $user = Auth::user(); 
            $items = ($user->cartItems);

    
            if (!$items->isEmpty()) {
                $totalQuantity = $user->cartItems->sum('quantity');
                
                $totalPrice = 0;
                foreach ($user->cartItems as $cart_item) {
                    $totalPrice += $cart_item->quantity * $cart_item->product->price;
                }

                foreach ($user->cartItems as $item) {
                    $cart_items[] = [
                        'id' => $item->product->id,
                        'name' => $item->product->name,
                        'price' => $item->product->price,
                        'quantity' => $item->quantity,
                        'item_total_price' => $item->quantity * ($item->product->price - $item->product->discount),
                        'photo_path' => $item->product->photo_path,
                    ];
                }    
            }
            return view('cart', [
                'cartItems' => $cart_items,
                'totalPrice' => $totalPrice,
                'totalQuantity' => $totalQuantity,
            ]);
        }

        if ($cart) {
            foreach ($cart as $id => $item) {
                $product = Product::find($id);

                if ($product) {
                    $itemTotalPrice = $item['quantity'] * ($product->price - $product->discount);
                    $totalPrice += $itemTotalPrice;
                    $totalQuantity += $item['quantity'];

                    $cartItems[] = [
                        'id' => $id,
                        'name' => $product->name,
                        'quantity' => $item['quantity'],
                        'price' => $product->price,
                        'discount' => $product->discount,
                        'item_total_price' => $itemTotalPrice,
                        'photo_path' => $product->photo_path,
                    ];
                } else {
                    // Remove invalid product from cart
                    unset($cart[$id]);
                    session()->put('cart', $cart);
                }
            }
        }

        return view('cart', [
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity,
        ]);
    }

    public function updateCartItemQuantity(Request $request)
    {
        $id = $request->id;
        $quantity = $request->input('quantity');
        if ($quantity == 0 ) {
            $this->deleteItem($id);
            return redirect()->back()->with('success', 'Cart item deleted successfully');
        }
        
        if (Auth::check()) {
            $user = Auth::user();
            $cart_item = $user->cartItems()->where('product_id', $id)->first();

            if ($cart_item) {
                $cart_item->quantity = $quantity;
                $cart_item->save();
                session()->forget('cart');
                return redirect()->back()->with('success', 'Cart item updated successfully');
            }else{
                $this->addToCart($request);
            }
        } else {
            $cart = session()->get('cart');
            if (isset($cart[$id])) {
                $cart[$id]['quantity'] = $quantity;
                session()->put('cart', $cart);
                return redirect()->back()->with('success', 'Cart item updated successfully');
            }else {
                $this->addToCart($request);
            }
        }
        
        return redirect()->back()->with('error', 'Cart item not found');
    }


    public function removeCartItem(Request $request)
    {
        $id = $request->id;
        $this->deleteItem($id);

        return redirect()->back()->with('success', 'Item has been removed');
    }

    private function deleteItem($id){
        if (Auth::check()) {
            $user = Auth::user(); 
            // Find the cart item for the specified user and product
            $cart_item = CartItem::where('user_id', $user->id)->where('product_id', $id)->first();

            // Delete the cart item if it exists
            if ($cart_item) {
                $cart_item->delete();
            }
        }

        else{
            $cart = session()->get('cart');

            if(isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
        }
    }
    
    public function syncCart(){
        $user = Auth::user();
    
        if (session()->has('cart')) {
            $cartItems = session()->get('cart');
            if (count($cartItems) > 0) {
                $unlogged_cart = session()->get('cart');
                $user_cart = $user->cartItems;
            
                foreach ($unlogged_cart as $product_id => $values) {
                    if (empty($user_cart) or !$user_cart->contains('product_id', $product_id)) {
                        // The product_id is not present in the user's cart, so add it
                        $product = Product::find($product_id);
                        $total_price = $values['quantity'] * floatval($product->price);

                        $user->cartItems()->create([
                            'user_id' => $user->id,
                            'product_id' => $product_id,
                            'quantity' => $values['quantity'],
                            'price' => $product->price,
                            'discount' => $product->discount,
                            'created_at' => now(),
                            'updated_at' => now(), 
                        ]);

                    }
                    else{
                        $existingCartItem = $user_cart->where('product_id', $product_id)->first();
                        $existingCartItem->quantity += $values['quantity'];
                        $existingCartItem->save();
                    }
                }
                // Clear the cart items from the session for the unlogged user
                session()->forget('cart');
                }
        }
    }
    
}

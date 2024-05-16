<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cartitem;
use App\Models\Product;
use App\Models\User;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    
    public function addToCart($uid, $pid, $quantity) {
        // Get the user based on the provided user ID
        $user = User::find($uid);
    
        // Check if the user exists
        if (!$user) {
            abort(404, 'User not found');
        }
    
        // Get the product based on the provided product ID
        $product = Product::find($pid);
    
        // Check if the product exists
        if (!$product) {
            abort(404, 'Product not found');
        }
    
        // Check if the quantity is valid (non-negative integer)
        if (!is_numeric($quantity) || $quantity < 1) {
            abort(400, 'Invalid quantity provided');
        }
    
        // Check if the product is already in the user's cart
        $cartItem = $user->cartItems()->where('product_id', $pid)->first();
    
        if ($cartItem) {
            // If the product is already in the cart, update the quantity
            $cartItem->update(['quantity' => $cartItem->quantity + $quantity]);
        } else {
            // If the product is not in the cart, add it
            $user->cartItems()->create([
                'product_id' => $pid,
                'quantity' => $quantity,
                'price' => $product->price,
                'discount' => $product->discount,
            ]);
        }
    
        // Return a success response
        return response()->json(['message' => 'Product added to cart successfully']);
    }

    public function deleteItem($uid, $pid, $quantity){
        $user = User::find($uid);

    // Check if the user exists
    if (!$user) {
        abort(404, 'User not found');
    }

    // Find the cart item based on the provided cart item ID
    $cartItem = $user->cartItems()->where('product_id', $pid)->first();

    // Check if the cart item exists
    if (!$cartItem) {
        abort(404, 'Cart item not found');
    }

    // Check if the cart item belongs to the user
    if ($cartItem->user_id != $uid) {
        abort(403, 'Unauthorized');
    }

    // Check if the quantity to delete is greater than the current quantity in the cart
    if ($quantity > $cartItem->quantity) {
        abort(400, 'Quantity to delete exceeds the current quantity in the cart');
    }

    // Decrement the quantity of the cart item
    $cartItem->quantity -= $quantity;

    // If the quantity becomes zero, delete the cart item
    if ($cartItem->quantity === 0) {
        $cartItem->delete();
    } else {
        $cartItem->save();
    }

    // Return a success response
    return response()->json(['message' => 'Quantity deleted from cart successfully']);
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

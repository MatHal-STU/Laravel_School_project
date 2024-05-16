<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use App\Models\Country;
use App\Models\Address;
use App\Models\DeliveryOption;
use App\Models\PaymentOption;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    public function show_checkout() {
        $cart = session()->get('cart');
        $cartItems = [];
        $cart_items = [];
        $totalPrice = 0;
        $totalQuantity = 0;
        $payment = PaymentOption::all();
        $delivery = DeliveryOption::all();
        
        if (Auth::check()) {
            $user = Auth::user(); 
            $items = ($user->cartItems);

            $address = $user->address ;
            $country = Country::find($address->country_id);

            

            if (!$items->isEmpty()) {
                $totalQuantity = $user->cartItems->sum('quantity');
                
                $totalPrice = 0;
                foreach ($user->cartItems as $cart_item) {
                    $totalPrice += $cart_item->quantity * $cart_item->product->price;
                }
                
            }
            $tax = ($country->tax ?? 0) * $totalPrice;

            return view('checkout', [
                'totalPrice' => $totalPrice,
                'address' => $address->address,
                'name' => $user->first_name,
                'surname' => $user->last_name,
                'number' => $user->phone_number,
                'city' => $address->city,
                'postal' => $address->postal_code,
                'name' => $user->first_name,
                'country' => $country->name ?? '',
                'tax' =>  $country->tax ?? 0,
                'email' => $user->email,
                'payment' => $payment,
                'delivery' => $delivery,
            ]);
        }

        if ($cart) {
            foreach ($cart as $id => $item) {
                $product = Product::find($id);

                if ($product) {
                    $itemTotalPrice = $item['quantity'] * ($product->price - $product->discount);
                    $totalPrice += $itemTotalPrice;
                } else {
                    // Remove invalid product from cart
                    unset($cart[$id]);
                    session()->put('cart', $cart);
                }
            }
        }

        return view('checkout', [
                'totalPrice' => $totalPrice,
                'address' => '',
                'name' => '',
                'surname' => '',
                'number' => '',
                'city' => '',
                'postal' => '',
                'name' => '',
                'country' => '',
                'tax' => 0,
                'email' => '',
                'payment' => $payment,
                'delivery' => $delivery,
        ]);
    }

    public function update_checkout(Request $request) {

        if (Auth::check()) {
            $user = Auth::user(); 
            $cart = ($user->cartItems);
        }else{
            $cart = json_decode($request->input('cart'), true);
        }

        $totalPrice = 0;
        

        foreach ($cart as $id => $item) {
            if ($item) {
                $itemTotalPrice = $item['quantity'] * $item['price'];
                $totalPrice += $itemTotalPrice;
            } else {
                // Remove invalid product from cart
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
        }
        

        if ($request->filled('country')) {
            $countryName = $request->input('country');
            $country = Country::where('name', $countryName)->first();
            if (!$country) {
                return redirect()->back()->withErrors(['country' => 'Country does not exists!'] );
            }
           
        }
        $payment []= PaymentOption::find($request->payment); 
        $delivery[]= DeliveryOption::find($request->shipping);

        return view('ship', [
            'shipping' => $delivery[0]->price,
            'pay' => $payment[0]->price,
            'totalPrice' => $totalPrice,
            'address' => $request->address,
            'name' => $request->fname,
            'surname' => $request->lname,
            'number' => $request->pnumber,
            'city' => $request->city,
            'postal' => $request->postal_code,
            'country' => $country->name ,
            'tax' => $country->tax,
            'email' => $request->email,
            'payment' => $payment,
            'delivery' => $delivery,
        ]);
    }

    public function make_order(Request $request) {

        
        $order = new Order();
        $country = Country::where('name', $request->input('country'))->first();
        if (Auth::check()) {
            $user = Auth::user(); 
            $cart = ($user->cartItems);
            CartItem::where('user_id', $user->id)->delete();
            session()->forget('cart');
        }else{
            $cart = session()->get('cart');
            session()->forget('cart');
        }
        
        $address = new Address();
        $address->user_id = $user->id ?? 1;
        $address->first_name = $request->input('fname'); 
        $address->last_name = $request->input('lname');
        $address->address = $request->input('address');
        $address->city = $request->input('city');
        $address->postal_code = $request->input('postal_code');
        $address->country_id = $country->id;
        $address->phone_number = $request->input('pnumber');
        $address->save();
        
        
        $totalPrice = 0;
        
        $order->created_at = Carbon::now();
        $order->user_id = $user->id ?? 1;
        $order->status = "paid";
        $order->delivery_option_id = $request->input('shipping'); 
        $order->payment_option_id = $request->input('payment'); 
        $order->total_price = $request->input('total'); 
        $order->address_id = $address->id; 
        $order->save();

        foreach ($cart as $id => $item) {
            $product = Product::find($id);
            $orderitem = new OrderItem();
            $orderitem->order_id = $order->id;
            $orderitem->product_id = $item->id;
            $orderitem->quantity = $item['quantity'];
             
            if ($product) {
                $itemTotalPrice = $item['quantity'] * ($product->price - $product->discount);
                $totalPrice += $itemTotalPrice;
            } else {
                // Remove invalid product from cart
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
            $orderitem->price = $totalPrice;
            $orderitem->discount = $item->discount;
            $orderitem->save();
            
        }

        

        return redirect()->route('home')->with('success', 'Order create! Email sent!');
    }
}
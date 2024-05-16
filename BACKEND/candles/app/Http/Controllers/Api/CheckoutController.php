<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
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
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{

    public function check_order(Request $request)
    {
        // Process the cart data received from the frontend
        $cartData = $request->all();

        // Check the availability of items, validate data, etc.

        // Return a response based on the processing result
        return response()->json(['message' => 'Order processed successfully'], 200);
    }


    public function delete_order($id) {
        // Find the order by its ID
    $order = Order::find($id);

    // Check if the order exists
    if (!$order) {
        return response()->json(['success' => false, 'message' => 'Order not found'], 404);
    }

    // Delete the associated order items
    $orderItemsDeleted = OrderItem::where('order_id', $id)->delete();

    // Delete the order itself
    $orderDeleted = $order->delete();

    if ($orderDeleted && $orderItemsDeleted) {
        return response()->json(['success' => true, 'message' => 'Order and associated items deleted successfully'], 200);
    } else {
        return response()->json(['success' => false, 'message' => 'Failed to delete order and/or associated items'], 500);
    }
    }

    public function make_order(Request $request)
{
    $requestData = $request->json()->all();

    $validator = Validator::make($requestData, [
        // Add validation rules here
        'fname' => 'required|string',
        'lname' => 'required|string',
        'address' => 'required|string',
        'city' => 'required|string',
        'postal_code' => 'required|string',
        'pnumber' => 'required|string',
        'country' => 'required|string',
        'shipping' => 'required|integer',
        'payment' => 'required|integer',
        'total' => 'required|numeric',
    ]);

    if ($validator->fails()) {
        return response()->json(['success' => false, 'message' => $validator->errors()->first()], 400);
    }

    $order = new Order();
    $country = Country::where('name', $request->input('country'))->first();

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

    

    return response()->json(['success' => true, 'message' => 'Order created successfully'], 200);
    }
    
}
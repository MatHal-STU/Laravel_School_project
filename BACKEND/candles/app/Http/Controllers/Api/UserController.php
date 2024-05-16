<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\CartController;
use App\Models\User;
use App\Models\Address;
use App\Models\Country;
use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function login(Request $request) {
        // Retrieve email and password from the request
        $email = $request->input('email');
        $password = $request->input('password');
    
        // Find the user by email
        $user = User::where('email', $email)->first();
    
        // Check if the user exists
        if (!$user) {
            // User not found with this email
            return response()->json(['error' => 'Invalid Email'], 422);
        }
    
        // Check if the password matches
        if (Hash::check($password, $user->password)) {
            // Password matches, log in the user
    
            // You can perform additional actions here, such as setting session data or generating JWT tokens
            
            // For simplicity, let's return the user data in the response
            return response()->json(['user' => $user]);
        }
    
        // Password doesn't match
        return response()->json(['error' => 'Invalid password'], 422);
    }

    public function register(Request $request) {
        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|max:255|confirmed',
        ]);

        // Return validation errors if any
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Check if user already exists with the given email
        $existingUser = User::where('email', $request->email)->first();
        if ($existingUser) {
            return response()->json(['error' => 'User already exists with this email'], 409);
        }

        // Hash the password
        $hashedPassword = Hash::make($request->password);

        // Create user record
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $hashedPassword,
        ]);

        // Return success response
        return response()->json(['message' => 'User registered successfully'], 201);
    }

    public function changeInfo(Request $request) {

        // Retrieve the user and address instances
        $user = Auth::user();

        $address = $user->address;

        // Update the user instance
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->phone_number = $request->input('phone_number');
        $user->save();

     
        // Update the address instance
        if ($request->filled('a_first_name')) {
            $address->first_name = $request->input('a_first_name');
        }

        if ($request->filled('a_last_name')) {
            $address->last_name = $request->input('a_last_name');
        }

        if ($request->filled('street_address')) {
            $address->address = $request->input('street_address');
        }

        if ($request->filled('city')) {
            $address->city = $request->input('city');
        }

        if ($request->filled('postal_code')) {
            $address->postal_code = $request->input('postal_code');
        }

        if ($request->filled('country')) {
            $countryName = $request->input('country');
            $country = Country::where('name', $countryName)->first();
            if ($country) {
                $address->country_id = $country->id;
            }
            else{
                return redirect()->back()->withErrors(['country' => 'Country does not exists!']);
            }
        }
        $address->save();

        return redirect()->back()->with('success', 'Information changed successfully!');
    }

}

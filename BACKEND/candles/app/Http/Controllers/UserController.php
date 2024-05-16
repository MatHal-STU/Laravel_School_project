<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\CartController;
use App\Models\User;
use App\Models\Address;
use App\Models\Country;
use App\Models\Order;

class UserController extends Controller
{
    public function show_login() {
        if (Auth::check()) {
            $user = auth()->user();
            $orders = Order::where('user_id', $user->id)->get();
            // user is logged in, return the logged-in view
            return view('profile', ['user' => $user, 'orders' => $orders]);
        } else {
            // user is not logged in, return the login view
            return view('login');
        }
    }

    public function showRegistration() {
        return view('registration');
    }

    public function showChangePass() {
        return view('change_pass');
    }

    
    public function showChangeInfo() {
        return view('change_pass');
    }


    public function login(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');
    
        $user = User::where('email', $email)->first();
    
        if (!$user) {
            // user not found with this email
            return redirect()->back()->withErrors(['email' => 'Invalid Email']);
        }
    
        if (Hash::check($password, $user->password)) {
            // password matches, log in the user
            Auth::login($user);
            $cartController = new CartController();
            $cartController->syncCart();
            if ($user->role == 'admin'){
                return redirect('/admin');
            }
            else {
                return redirect('/');
            }
        }
    
        // password doesn't match
        return redirect()->back()->withErrors(['email' => 'Invalid password']);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function register(Request $request) {
        $email = $request->input('email');
        $existingUser = User::where('email', $email)->first();
        if ($existingUser) {
            // email already exists, return error response or redirect back with error message
            return redirect()->back()->withErrors(['email' => 'Email already exists']);
        }

        $password = $request->input('password');
        $passwordConfirmation = $request->input('repeat_password');
    
        if ($password !== $passwordConfirmation) {
            // password and password confirmation do not match, return error response or redirect back with error message
            return redirect()->back()->withErrors(['repeat_password' => 'Password and password confirmation do not match']);
        }
    

        $user = new User();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $email;
        $user->password = Hash::make($request->input('password'));
        $user->phone_number = '';
        $user->role = 'client';
        $user->registered_at = now();
        $user->save();

        // Create an empty address for the new user
        $address = new Address();
        $address->user_id = $user->id;
        $address->first_name = $request->input('first_name'); 
        $address->last_name = $request->input('last_name');
        $address->address = '';
        $address->city = '';
        $address->postal_code = '';
        $address->save();

        Auth::login($user);
        return redirect('/');
    }

    public function changePassword(Request $request){
        $user = auth()->user();
        $password = $request->input('old_password');
    
        $new_password = $request->input('new_password');
        $passwordConfirmation = $request->input('repeat_password');
    
        if (Hash::check($password, $user->password)) {
            // password matches
    
            if ($new_password !== $passwordConfirmation) {
                // password and password confirmation do not match, return error response or redirect back with error message
                return redirect()->back()->withErrors(['repeat_password' => 'New password and password confirmation do not match']);
            }
    
            $user->password = Hash::make($request->input('new_password'));
            $user->save();

            return redirect('/login')->with('success', 'Password changed successfully!');

        }
    
        // password doesn't match
        return redirect()->back()->withErrors(['email' => 'Invalid password']);
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

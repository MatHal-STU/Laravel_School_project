<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;


class HomeController extends Controller {
    public function index() {

        $products = Product::where('trending', true)->take(4)->get();
        return view('index', ['trending' => $products]);
    }
}


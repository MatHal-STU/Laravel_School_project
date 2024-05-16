<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Scent;
use App\Models\ProductType;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{

    public function index(Request $request) {
        $scents = Scent::all();
        $types = ProductType::all();
        $brands = Brand::all();
        $categ = null;
        $filters = [
            "brand" => null,
            "type" => null,
            "scent" => null,
            "color" => null
        ];

        $productsQuery = Product::query();

        $filter_by = 'Price: High to Low';

        if ($request->filled('category')) {
            $categoryId = Category::where('name', $request->category)->value('id');
            $productsQuery->where('category_id', $categoryId);
            $categ = Category::where('name', $request->category)->first();
        }

        if ($request->filled('brand')) {
            $categoryId = Brand::where('id', $request->brand)->value('id');
            $productsQuery->where('brand_id', $categoryId);
            $filters["brand"] = $request->brand;
        }

        if ($request->filled('type')) {
            $categoryId = ProductType::where('id', $request->type)->value('id');
            $productsQuery->where('type_id', $categoryId);
            $filters["type"] = $request->type;
        }

        if ($request->filled('scent')) {
            $scentId = $request->scent;
            $productsQuery->whereHas('scents', function ($query) use ($scentId) {
                $query->where('scents.id', $scentId);
            });
            $filters["scent"] = $request->scent;
        }

        if ($request->filled('color')) {
            $productsQuery->where('color', $request->color);
            $filters["color"] = $request->color;
        }

        if ($request->sort === 'price_asc') {
            $productsQuery->orderByRaw('price - (price * discount / 100) asc');
            $filter_by = 'Price: Low to High';
        } elseif ($request->sort === 'price_desc') {
            $productsQuery->orderByRaw('price - (price * discount / 100) desc');
            $filter_by = 'Price: High to Low';
        }
    
        // Get the filtered products
        $products = $productsQuery->paginate(6);
        return view('products', compact('categ', 'scents', 'types', 'brands', 'products', 'filter_by', 'filters'));
    }


    public function show_product_detail($id) {
        $data = [
            'quantity' => 1,
            'class' => 'hidden',
            'product' => null,
            'trending' => null
        ];
        
        $product = Product::find($id);
    
        $data['product'] = $product;
    
        return response()->json($data);
    }    

    public function search($searchTerm) {
        $search = $searchTerm;

        $products = Product::where('name', 'LIKE', "%$search%")
            ->orWhere('description', 'LIKE', "%$search%")
            ->orWhereHas('category', function($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%");
            })
            ->orWhereHas('scents', function ($query) use ($search) {
                $query->where('scents.name','LIKE', "%$search%");
            })
            ->paginate(8);
    
        return response()->json(['products' => $products]);
    }
}


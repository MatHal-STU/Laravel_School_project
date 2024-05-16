@extends('html_template')

@section('content')

<main class="container my-5">
    <section class="row">
      <div class="col">
        <h1>Edit Product</h1>
        <hr class="border-3 opacity-50" />
      </div>
    </section>
    <section class="row">
        <div class="container ">
            <form action="{{ route('product.update', $product->id) }}" method="POST" class="row" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col">                    
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
                        </div>
                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" required>
                        </div>
                        <div class="form-group">
                            <label for="ean_code">EAN Code</label>
                            <input type="text" name="ean_code" class="form-control" value="{{ $product->ean_code }}" required>
                        </div>
                        <div class="form-group">
                            <label for="categry_id">Category</label>
                            <select name="category_id" class="form-control">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="trending">Trending</label>
                            <input type="checkbox" name="trending" {{ $product->trending ? 'checked' : '' }}>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="color">Color</label>
                            <input type="text" name="color" class="form-control" value="{{ $product->color }}" required>
                        </div>
                        <div class="form-group">
                            <label for="burn_hours">Burn Hours</label>
                            <input type="number" name="burn_hours" class="form-control" value="{{ $product->burn_hours }}" required>
                        </div>
                        <div class="form-group">
                            <label for="discount">Discount</label>
                            <input type="number" name="discount" class="form-control" value="{{ $product->discount }}" required>
                        </div>
                        <div class="form-group">
                            <label for="type_id">Type</label>
                            <select name="type_id" class="form-control">
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}" {{ $product->type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="brand_id">Brand</label>
                            <select name="brand_id" class="form-control">
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-3">
                        <label for="photo_path">Photo 1</label>
                        <img style="height:300px" src="{{ asset($product->photo_path) }}">
                        <input type="file" id="photo1" name="photo1" class="form-control">
                    </div>
                    <div class="form-group col-3">
                        <label for="photo_path2">Photo 2</label>
                        <img style="height:300px" src="{{ asset($product->photo_path2) }}">
                        <input type="file" id="photo2" name="photo2" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" cols="30" rows="10" class="form-control">{{ $product->description }}</textarea>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="ingredients">Ingredients</label>
                            <textarea name="ingredients" cols="30" rows="10" class="form-control">{{ $product->ingredients }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <button type="submit" class="btn col-2 btn-primary">Update Product</button>
                </div>
            </form>
        </div>
    </section>
</main>


@endsection

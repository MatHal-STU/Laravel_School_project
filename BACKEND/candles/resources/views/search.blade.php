@extends('html_template')

@section('content') 
  <main class="container-xl mt-4">
      <section class="row ">
        <div class="col">
          <h1 class="mt-4" >Search</h1>
          <hr class="border-3 opacity-50" />
        </div>
      </section>
  
      <section>
          <form action="{{ route('search.submit') }}" method="GET">
            <div class="row justify-content-center">
                <p class="col-4">
                  <input type="text" name="search" class="form-control" />
                </p>
                <button type="submit" class="btn main-button col-1 h-50">Search</button>
            </div>
          </form>
          @if (isset($products))
          <div class="row">

            @foreach ($products as $product)
              <div class="col-xl-3 col-sm-6 product-card">
                <div class="product-image">
                  <a href="{{ route('product_detail', ['id'=>$product->id]) }}">
                    <img src="{{ asset($product->photo_path) }}" />
                  </a>
                  <a href="{{ route('cart.add', ['id' => $product->id]) }}" class="add-to-cart">Add to Cart</a>
                </div>
                <div class="row py-2">
                  <p class="col product-name"> {{ $product->name}} </p>
                  <p class="col price"> {{number_format($product->price  * (1 - $product->discount/ 100), 2)}} € </p>
                </div>
              </div>
            @endforeach

            </div>

            <hr class="border-3 opacity-50" />

            <nav class="d-flex justify-content-center">
              {!! $products->links() !!}
            </nav>
          @endif
      </section>
  </main>
@endsection
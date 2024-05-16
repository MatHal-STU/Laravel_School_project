@extends('html_template')

@section('content') 
@if(session()->has('success'))
      <div class="alert alert-success">
          {{ session()->get('success') }}
      </div>
  @endif
  <main class="container-xl">
      <section class="container-fluid my-5">
        <div class="row my-4 align-items-center">
          <div class="col-md-6">

            <div id="carouselExampleControls" class="product-carousel carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img class="product-image-lg" src="{{ asset($product->photo_path) }}" alt="First slide">
                </div>
                <div class="carousel-item">
                  <img class="product-image-lg" src="{{ asset($product->photo_path2) }}" alt="Second slide">
                </div>
              <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
              </div>
            </div>
          </div>
          <div class="col-md-6 my-4">
            <h1>{{$product->name}}</h1>
            <div class="mt-4 mb-2 product-price">
            <?php if ($product->discount > 0): ?>
              <span class="text-decoration-line-through">{{number_format($product->price, 2)}} €</span>
              <span>{{number_format($product->price  * (1 - $product->discount/ 100), 2)}} €</span>
            <?php else: ?>
                <span>{{number_format($product->price, 2)}} €</span>
            <?php endif; ?>
            </div>
            <form action="{{ route('cart.update', ['id' => $product['id']]) }}" method="POST">
            @csrf
            <div class="d-flex">
              <input
                class="text-center me-3"
                name="quantity"
                type="number"
                value="{{$quantity}}"
                min="0"
                style="max-width: 3rem"
              />  
                <button class="btn main-button" type="submit">Add to Cart</button>
              </form>
            </div>
            <p {{$class}} >Product in basket</p>
            <p> Remove </p>
          </div>
        </div>
      </section>
      
      @if ($product->category->name == 'Candles')
      <section class="container my-5">
        <section class="container marketing">
          <div class="row">
            @foreach ($product->scents as $scent)
              <div class="col-lg-4">
                <img src= "{{ asset($scent->photo_path) }}" width="140" />
                <p class="w-75 mx-auto">
                  {{$scent->description}}
                </p>
              </div>
            @endforeach
          </div>
        </section>
      </section>
    @endif

      <section class="container my-5">
        <div class="row align-items-center gx-5">
          <article class="col-lg-6">
            <h3>Item Description</h3>
            <p>
              {{ $product->description }}
            </p>
          </article>
          @if ($product->category->name == 'Lanterns')
            <article class="col-lg-6 gy-5">
                <h4>Materials</h4>
                <p>{{$product->ingredients}}</p>
            </article>
          @else
              <article class="col-lg-6 gy-5">
                  @if ($product->category->name == 'Candles' or $product->category->name == 'Incense Sticks' )
                    <h4>Burn Hours</h4>
                  @else
                    <h4>Fragrance longevity in hours</h4>
                  @endif
                    <p>{{ $product->burn_hours }}</p>
                  <h4>Ingredients</h4>
                  <p>{{$product->ingredients}}</p>
              </article>
          @endif

        </div>
      </section>

      <section class="container my-5">
        <h2 class="text-center mb-5">You may also like</h2>
        <div class="row">
          
          @foreach ($trending as $product)
            <div class="col-xl-3 col-sm-6 product-card">
              <div class="product-image">
                <a href="{{ route('product_detail',  ['id' => $product->id] ) }}">
                  <img src="{{ asset($product->photo_path) }}" />
                </a>
                <a href="{{ route('cart.add', ['id' => $product->id]) }}" class="add-to-cart">Add to Cart</a>
              </div>
              <div class="row py-2">
                <p class="col product-name">{{$product->name}}</p>
                <p class="col price">{{number_format($product->price  * (1 - $product->discount/ 100), 2)}} €</p>
              </div>
            </div>
          @endforeach

        </div>
      </section>
  </main>
@endsection

@section('scripts')

  <script
      src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
      integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
      integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
      integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
      crossorigin="anonymous"
    ></script>
@endsection

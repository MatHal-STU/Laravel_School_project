@extends('html_template')

@section('content') 
  @if(session()->has('success'))
      <div class="alert alert-success">
          {{ session()->get('success') }}
      </div>
  @endif


  @if(isset($categ))
      <div class="row m-0" style="height: 300px; background-color: #e6ddcf">
          <div class="col text-center my-auto mx-5">
              <h1>{{ $categ->name }}</h1>
              <p>{{ $categ->description }}</p>
          </div>
          <div class="col d-flex justify-content-end p-0 d-none d-md-flex">
              <img src="{{ asset($categ->photo_path) }}" />
          </div>
      </div>
  @endif


    <main class="container-xl d-flex p-5">
      <aside class="col mx-3 d-none d-sm-flex">
        <div class="flex-shrink-0 bg-white">
          <h4>Filter by</h4>
          <hr class="border-3 opacity-50" />
          <ul class="list-unstyled ps-0">
            <li class="mb-1">
              <button
                class="btn btn-toggle align-items-center"
                data-bs-toggle="collapse"
                data-bs-target="#brand-collapse"
              >
                Brand
              </button>
              <div class="collapse" id="brand-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                 @foreach ($brands as $brand)
                    @php
                    $classes = $filters['brand'] == $brand->id ? 'rounded filter-btn-selected' : 'link-dark rounded'
                    @endphp
                    <li><a href="{{ route('products', ['brand' => $brand->id == $filters['brand'] ? null : $brand->id, 'type' => $filters['type'], 'scent' => $filters['scent'], 'color' => $filters['color'], 'category' => $categ->name]) }}" class="{{$classes}}">{{ $brand->name }}</a></li>
                @endforeach
                </ul>
              </div>
            </li>
            <li class="mb-1">
              <button
                class="btn btn-toggle align-items-center"
                data-bs-toggle="collapse"
                data-bs-target="#product-type-collapse"
              >
                Product Type
              </button>
              <div class="collapse" id="product-type-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  @foreach ($types as $type)
                    @php
                      $classes = $filters['type'] == $type->id ? 'rounded filter-btn-selected' : 'link-dark rounded'
                    @endphp
                    <li><a href="{{ route('products', ['brand' => $filters['brand'], 'type' => $type->id == $filters['type'] ? null : $type->id, 'scent' => $filters['scent'], 'color' => $filters['color'], 'category' => $categ->name]) }}" class="{{$classes}}">{{ $type->name }}</a></li>
                  @endforeach
                </ul>
              </div>
            </li>
            <li class="mb-1">
              <button
                class="btn btn-toggle align-items-center"
                data-bs-toggle="collapse"
                data-bs-target="#scent-family-collapse"
              >
                Scent Family
              </button>
              <div class="collapse" id="scent-family-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  @foreach ($scents as $scent)
                    @php
                      $classes = $filters['scent'] == $scent->id ? 'rounded filter-btn-selected' : 'link-dark rounded'
                    @endphp
                    <li><a href="{{ route('products', ['brand' => $filters['brand'], 'type' => $filters['type'], 'scent' => $scent->id == $filters['scent'] ? null : $scent->id, 'color' => $filters['color'], 'category' => $categ->name]) }}" class="{{$classes}}">{{ $scent->name }}</a></li>
                  @endforeach
                </ul>
              </div>
            </li>
            <li class="mb-1">
              <button
                class="btn btn-toggle align-items-center"
                data-bs-toggle="collapse"
                data-bs-target="#color-collapse"
              >
                Color
              </button>
              <div class="collapse" id="color-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  @php
                    $colors = ['white', 'yellow', 'orange', 'red', 'pink', 'purple', 'blue', 'green', 'brown']
                  @endphp
                  @foreach ($colors as $color)
                    @php
                      $classes = $filters['color'] == $color ? 'rounded filter-btn-selected' : 'link-dark rounded'
                    @endphp
                    <li><a href="{{ route('products', ['brand' => $filters['brand'], 'type' => $filters['type'], 'scent' => $filters['scent'], 'color' => $color == $filters['color'] ? null : $color, 'category' => $categ->name]) }}" class="{{$classes}}">{{ ucfirst($color) }}</a></li>
                  @endforeach
                </ul>
              </div>
            </li>
          </ul>
        </div>
      </aside>
      <section class="col-sm-8 col-xl-9 text-center">
        <div class="justify-content-end d-flex">
        <div class="btn-group">
          <h5 class="pe-2">Sort by:</h5>
          <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{ $filter_by }}
          </button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('products', ['sort' => 'price_desc', 'category' => $categ->name]) }}">Price: High to Low</a>
            <a class="dropdown-item" href="{{ route('products', ['sort' => 'price_asc', 'category' => $categ->name]) }}">Price: Low to High</a>
          </div>
        </div>
      </div>
        <hr class="border-3 opacity-50" />
        <div class="row">

          @foreach ($products as $product)
            <div class="col-xl-4 col-sm-6 product-card">
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
          {!! $products->withQueryString()->appends(['category' => $categ->name])->links() !!}
        </nav>
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
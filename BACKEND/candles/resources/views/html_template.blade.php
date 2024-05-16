<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap"
      rel="stylesheet"
    />

    <script
      src="https://kit.fontawesome.com/3292bd839a.js"
      crossorigin="anonymous"
    ></script>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
      crossorigin="anonymous"
    />
    
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css">


    <title>Serenity Candles</title>
  </head>

  <body>
    <header>
      <nav class="navbar navbar-expand-md navbar-light bg-white shadow py-1">
        <div class="container-fluid row">
          <a href="{{ route('home') }}" class="navbar-brand col-2 p-0">
            <img src="{{ asset('images/logo.svg') }}" height="60" />
          </a>
          <div
            class="collapse navbar-collapse col-8 justify-content-center"
            id="navbarCollapse"
          >
            <ul class="navbar-nav">
              <li class="nav-item">
                <a href="{{ route('products', ['category' => 'Candles']) }}" class="nav-link">Candles</a>
              </li>
              <li class="nav-item">
                <a href="{{ route('products', ['category' => 'Lanterns']) }}" class="nav-item nav-link">Lanterns</a>
              </li>
              <li class="nav-item">
                <a href="{{ route('products', ['category' => 'Incense Sticks']) }}" class="nav-item nav-link">Incense Sticks</a >
              </li>
              <li class="nav-item">
                <a href="{{ route('products', ['category' => 'Essential oils']) }}" class="nav-item nav-link">Essential Oils</a>
              </li>
              <li class="nav-item">
                <a href="{{ route('products', ['category' => 'Diffusers']) }}" class="nav-item nav-link">Diffusers</a>
              </li>
            </ul>
          </div>

          <div class="d-lg-flex col-2 justify-content-end d-none d-md-flex">
            <div class="row gx-3">
              @if (Auth::check() && Auth::user()->role=='admin')
                <a
                  href="{{ route('admin') }}"
                  class="fa-solid fa-screwdriver-wrench col nav-icon"
                ></a>
              @endif
              <a
                href="{{ route('search') }}"
                class="fa-solid fa-magnifying-glass col nav-icon"
              ></a>
              <a href="{{ route('login') }}" class="fa-solid fa-user col nav-icon"></a>
              <a
                href="{{ route('cart') }}"
                class="col fa-solid fa-basket-shopping nav-icon"
              ></a>
            </div>
          </div>
          <button
            type="button"
            class="navbar-toggler col-auto"
            data-bs-toggle="collapse"
            data-bs-target="#navbarCollapse"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </nav>
    </header>

    @yield('content')     

    <footer class="py-3 mt-5 bg-white">
      <ul class="nav justify-content-center border-bottom pb-3 mb-3">
        <li class="nav-item">
          <a href="#" class="nav-link px-2 text-muted">Contact</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link px-2 text-muted">Payment</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link px-2 text-muted">Shipping</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link px-2 text-muted">Terms of use</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link px-2 text-muted">Return & Exchanges</a>
        </li>
      </ul>
      <p class="text-center text-muted">© 2023 Serenity Candles, Inc</p>
    </footer>
    
    @yield('scripts')  
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
      crossorigin="anonymous"
    ></script>
    
  </body>
</html>

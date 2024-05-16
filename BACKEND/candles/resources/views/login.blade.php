@extends('html_template')

@section('content') 
  <main class="container-xl mt-5">
      @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
      <h1>Customer Login</h1>
      <hr class="border-3 opacity-50" />
      <div class="row mt-5">
        <div class="col-md-6 me-5">
          <h2>Registered Customers</h2>
          <p>If you have an account, sign in with your email address.</p>
          <form method="POST" action="{{ route('login.submit') }}">
            @csrf
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" class="form-control" id="email" name="email"/>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password" />
            </div>
            <button type="submit" class="btn-create-account">Login</button>
          </form>

        </div>
        <div class="col-md-5">
          <h2>New Customers</h2>
          <p>
            Creating an account has many benefits: check out faster, keep more
            than one address, track orders and more.
          </p>
          <a href="{{ route('register') }}" class="btn-create-account">Register</a>
        </div>
      </div>
</main>
@endsection

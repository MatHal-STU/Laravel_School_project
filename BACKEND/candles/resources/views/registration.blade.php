@extends('html_template')

@section('content') 

  <main>
        @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
      
      <div class="form-container">
        <h1>Create Account</h1>
        <form method="POST" action="{{ route('register') }}">
        @csrf
          <div class="form-group">
            <label for="firstName">First Name:</label>
            <input
              type="text"
              class="form-control"
              id="firstName"
              name="first_name"
              placeholder="Enter first name"
              required
            />
          </div>
          <div class="form-group">
            <label for="lastName">Last Name:</label>
            <input
              type="text"
              class="form-control"
              id="lastName"
              name="last_name"
              placeholder="Enter last name"
              required
            />
          </div>
          <div class="form-group">
            <label for="email">Email:</label>
            <input
              type="email"
              class="form-control"
              id="email"
              name="email"
              placeholder="Enter email"
              required
            />
          </div>
          <div class="form-group">
            <label for="password">Password:</label>
            <input
              type="password"
              class="form-control"
              id="password"
              name="password"
              placeholder="Enter password"
              required
            />
          </div>
          <div class="form-group">
            <label for="repeatPassword">Repeat Password:</label>
            <input
              type="password"
              class="form-control"
              id="repeatPassword"
              name="repeat_password"
              placeholder="Repeat password"
              required
            />
          </div>
          <button type="submit" class="btn-create-account">
            Create Account
          </button>
        </form>
      </div>
  </main>

  @endsection

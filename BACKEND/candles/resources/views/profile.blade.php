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

      @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    <div class="row align-items-center justify-content-between mb-3">
        <div class="col-auto">
            <h1 class="mb-0">Profile</h1>
        </div>
        <div class="col-auto">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-primary btn-sm" type="submit">Logout</button>
            </form>
        </div>
    </div>
    <hr class="border-3 opacity-50" />




    <div class="mb-5">
        <h4>Login Information</h4>
        <p><strong>Email:</strong> {{ $user->email }} </p>
        <a href="{{ route('password.change') }}" class="btn btn-primary btn-sm mb-3">Change Password</a>
    </div>


    <form action="{{ route('information.submit') }}" method="POST">
        <div class="mb-5">
            <h4>Contact Information</h4>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}">
                </div>
                <div class="col-md-6">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="phone-number" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phone-number" name="phone_number" value="{{ $user->phone_number }}">
                </div>
            </div>
        </div>


        <h4>Address</h4>
    
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="a_first_name" name="a_first_name" value="{{  optional($user->address)->first_name }}">
                </div>
                <div class="col-md-6">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="a_last_name" name="a_last_name" value="{{  optional($user->address)->last_name }}">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="street_address" class="form-label">Street Address</label>
                    <input type="text" class="form-control" id="street_address" name="street_address" value="{{ optional($user->address)->address }}">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control" id="city" name="city" value="{{ optional($user->address)->city }}">
                </div>
                <div class="col-md-6">
                    <label for="postal_code" class="form-label">Postal Code</label>
                    <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ optional($user->address)->postal_code }}">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="country" class="form-label">Country</label>
                    <input type="text" class="form-control" id="country" name="country" value="{{ optional($user->address->country)->name }}">
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-sm mb-3">Save Changes</button>
    </form> 

    <section class="row">
        <div class="container">
            <h2>Order List</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Products</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Address</th>
                        <th>Name</th>
                        <th>City</th>
                        <th>Country</th>
                        <th>Status</th>
                        <th>Created at</th>
                        <th>Shipment</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>
                            @foreach($order->items as $item)
                                {{ $item->product->name }} <br>
                            @endforeach
                            </td>
                            <td>
                            @foreach($order->items as $item)
                                {{ $item->quantity }}<br>
                            @endforeach
                            </td>
                            <td>{{ $order->total_price }}</td>
                            <td>{{ $order->address->address }}</td>
                            <td>{{ $order->address->first_name}} {{ $order->address->last_name }}</td>
                            <td>{{ $order->address->city }}</td>
                            <td>{{ $order->address->country->name }}</td>
                            <td>{{ $order->status }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td>{{ $order->deliveryOption->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
        
</main>
@endsection

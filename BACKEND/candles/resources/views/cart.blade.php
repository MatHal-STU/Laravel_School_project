
@extends('html_template')

@section('content') 
  @if(session()->has('success'))
      <div class="alert alert-success">
          {{ session()->get('success') }}
      </div>
  @endif


  <main class="container my-5">
    <section class="row">
      <div class="col">
        <h1>Your Shopping Cart</h1>
        <hr class="border-3 opacity-50" />
      </div>
    </section>
    <section class="row">
      <div class="col-md-8">
        <table class="table table-borderless table-responsive">
          <thead>
            <tr>
              <th>Product</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Subtotal</th>
            </tr>
          </thead>
          <tbody>
          @foreach ($cartItems as $item)
            <tr>
              <td class="row">
                <div class="col-sm-6" >
                <img
                  
                  src="{{ $item['photo_path'] }}"
                  width="112"
                  height="112"
                />
                </div>   
                <section class="col-sm-6">
                  <p >{{ $item['name'] }}</p>
                </section>
              </td>
              
              <td >{{ $item['price'] }} €</td>
              <td >
              <form method="POST" action="{{ route('cart.update', ['id' => $item['id']]) }}">
                @csrf
                <input
                  class="text-center me-3"
                  min= 1
                  name="quantity"
                  type="number"
                  value="{{ $item['quantity'] }}"
                  style="max-width: 3rem"
                  onkeydown="updateCartItemQuantity(event)"
                />
                <div>
                  <a href="{{ route('cart.remove', ['id' => $item['id']] ) }}" class="fa fa-trash nav-icon"></a>
                  <button type="submit" class="btn btn-link text-black p-0"><i class="fas fa-refresh"> </i></button>
                </div>  
              </form>
                
              </td>
              <td>{{ $item['item_total_price'] }} €</td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
      <div class="col-md-4 text-center">
        <h2>Order Summary</h2>
        <table class="table">
          <tbody>
            <tr>
              <td>Subtotal</td>
              <td class="text-center">{{$totalPrice}} €</td>
            </tr>
            <tr>
              <td>Order total</td>
              <td class="text-center">{{$totalPrice}} €</td>
            </tr>
          </tbody>
        </table>
        <a class="btn main-button" role="button" href="{{ route('checkout') }}">Checkout</a>
      </div>
    </section>
</main>
@endsection

@section('scripts')
<script>
  function updateCartItemQuantity(event) {
    if (event.keyCode === 13) { // Enter key
      const input = event.target;
      const cartItemId = input.dataset.cartItemId;
      const newQuantity = input.value;
      fetch(`/cart/${cartItemId}`, {
        method: 'PUT',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ quantity: newQuantity })
      })
      .then(response => {
        if (response.ok) {
          window.location.reload(); // Reload the page to reflect the updated quantity
        } else {
          alert('Failed to update cart item quantity');
        }
      })
      .catch(error => {
        console.error(error);
        alert('Failed to update cart item quantity');
      });
    }
  }
</script> 
@endsection
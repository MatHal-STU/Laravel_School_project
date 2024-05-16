@extends('html_template')

@section('content')
<main class="container my-5">
    <section class="row">
      <div class="col">
        <h1>Admin Panel</h1>
        <hr class="border-3 opacity-50" />
      </div>
    </section>
    <section class="row">
        <div class="container">
            <h2>Product List</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>EAN</th>
                        <th>Name</th>
                        <th>Color</th>
                        <th>Price</th>
                        <th>Trending</th>
                        <th>Discount</th>
                        <th>Stock</th>
                        <th>Burn Hours</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->ean_code }}</td>
                            <td><a href="{{ route('product_detail', ['id'=>$product->id]) }}">{{ $product->name }}</a></td>
                            <td>{{ $product->color }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->trending }}</td>
                            <td>{{ $product->discount }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>{{ $product->burn_hours }}</td>
                            <td><a href="{{ route('product.edit', ['id'=>$product->id]) }}">Edit</a></td>
                            <td><a href="{{ route('product.delete', ['id'=>$product->id]) }}">Delete</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('product.create') }}" class="btn btn-primary">Create New Product</a>
        </div>
    </section>
    <br>
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
@extends('layouts.user')

@section('title', 'User View Store Page')

@section('content')
    <h1>Store {{ $seller->shop_name }}</h1>
  
    <table class="table table-bordered ">
        <tr>
            <th colspan=2 class="text-center"><h5>Store Info</h5></th>
        </tr>
        <tr>
            <th>Store Name: </th>
            <td>{{$seller->shop_name}}</td>
        </tr>
        <tr>
            <th>Owner Name: </th>
            <td>{{$seller->name}}</td>
        </tr>
        <tr>
            <th>Phone Number: </th>
            <td>{{$seller->phone_no}}</td>
        </tr>
        <tr>
            <th>Email: </th>
            <td>{{$seller->email}}</td>
        </tr>
    </table><br>
    @if($products->isEmpty())
        <p>This seller currently has no products available in stock</p>
    @else 
    
    <h3>Available Products</h3>
    <table class="table table-bordered text-center">
        <tr>
            <th>Product Name</th>
            <th>Remaining Stock</th>
            <th>Action</th>
        </tr>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->stock }}</td>
            <td><button class="btn btn-success" onclick="orderProduct('{{ $product->id }}', '{{ $product->name }}','{{ $product->stock}}')">Order</button></td>
        </tr>
        @endforeach
    </table>
    @endif

    <form id="orderForm" method="post" action="{{ route('addPurchase') }}" style="display: none;">
        @csrf
        <input type="hidden" name="product_id" id="product_id">
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" min="1" required>
        <!-- <input type="number" name="user_id" id="user_id" required> -->
            <!-- Gonna use Auth instead -->
        <button type="submit">Submit Order</button>
    </form>

    <script>
        function orderProduct(productId, productName, productQuantity) {
            var quantity = prompt(`Enter the desired order quantity for the product ${productName}:`);
                
                // if (quantity !== null && quantity > 0 && quantity <= productQuantity) {

                quantity = parseInt(quantity);
                productQuantity = parseInt(productQuantity);
                if (quantity == null || quantity == "null" || quantity <= 0){
                    alert('Please enter a valid quantity.');
                } else if (quantity > productQuantity) {
                    //Got error when ordering Product 1 with quantity 5, eventho remaning 
                    //stock is 10.
                    console.log('Quantity: ',quantity, ' productQuantity: ', productQuantity);                    
                    alert("Order quantity cannot exceed remaining stock.");
                }
                else{
                    if(confirm('Are you sure you want to order this product?')){
                    document.getElementById('product_id').value = productId;
                    document.getElementById('quantity').value = quantity;
                    // document.getElementById('user_id').value = {{ Auth::user()->id }};
                    document.getElementById('orderForm').submit();
                    // alert("Order placed successfully.");
                    }
                }
        }
    </script>
@endsection
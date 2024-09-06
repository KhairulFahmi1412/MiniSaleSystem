@extends('layouts.seller')

@section('title', 'Seller Products Page')

@section('content')
    <h1>Current Products</h1>
@if($products->isEmpty())
<p>No products found. Please add a new product</p>
@else
    <table class="table table-bordered text-center">
        <tr>
            <th>Product Name</th>
            <th>Stock</th>
            <td>Action</td>
        </tr>
        @foreach($products as $product)
        <tr>
            <form method="post" action=" {{ route('editProduct', $product->id) }}">
                @csrf
                <!-- <td><input type="text" name="name" value="{{ $product->name }}" readonly /></td> -->
                 
                <td>{{ $product->name }}</td>
                <!-- <input type="hidden" name="name" value="{{ $product->name }}" /> -->
                    <!-- Cancelled option to edit name, uncomment this, set as not text, and update in the sg  -->
                <td><input type="number" style="max-width: 15%; text-align: right;" name="stock" value="{{ $product->stock }}" /></td>
                <td><button type="submit" class="btn btn-success" onclick="return confirm('Confirm update current stock?')">Edit Stock</button></td>
            </form>
        </tr>
            @endforeach
</table><br><br>
@endif
    <a href="{{ route('sellerNewProductPage') }}"><button class="btn btn-primary btn-block">Add New Product</button></a>

@endsection
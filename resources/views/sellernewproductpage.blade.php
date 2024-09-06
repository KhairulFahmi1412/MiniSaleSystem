@extends('layouts.seller')

@section('title', 'Seller New Products Page')

@section('content')
    <h1>Add New Product</h1>
    
<div class="card w-25 mx-auto mt-4">
<h3 class="card-header text-center">New Product Information</h3>

    <form method="post" action="addNewProduct" class="mt-4 px-3">
        @csrf
        <div class="form-group">
        <input type="text" name="name" placeholder="New Product Name" class="form-control">
        </div>
        <div class="form-group">
        <input type="number" name="stock" placeholder="Current Stock"  class="form-control">
        </div>
        
        <button type="submit" class="btn btn-success btn-block" onclick="return confirm('Confirm to add new product?')" >Add Product</button>
    </form>
</div>
@endsection
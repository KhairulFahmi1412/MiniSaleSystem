@php 
    use Carbon\Carbon;
    //Import carbon to be used for timestamp formatting 
@endphp

@extends('layouts.seller')

@section('title', 'Seller Order History Page')

@section('content')
    <h1>Order History</h1>
   @if($purchases->isNotEmpty())

    <table class="table table-bordered text-center">
        <tr>
            <th>Orderer's Info</th>
            <th>Product Ordered</th>
            <th>Quantity Ordered</th>
            <th>Order Status</th>
            <th>Date Order Created</th>
            <th>Date Order Processed</th>
</tr>
    @foreach($purchases as $purchase)
        <tr>
            <td>{{ $purchase->user->name }} <br> {{ $purchase->user->phone_no }} <br> {{ $purchase->user->email }}</td>
            <td>{{ $purchase->product->name }}</td>
            <td>{{ $purchase->quantity }}</td>
            <!-- <td>{{ $purchase->created_at }}</td> -->
            <td>
            @include('partials.orderStatus')
            </td>
            <td>{{ Carbon::parse($purchase->created_at)->format("H:i, m-d-Y")}}</td>
            <td>{{ Carbon::parse($purchase->updated_at)->format("H:i, m-d-Y")}}</td>
            </tr>
    @endforeach
</table>
   @else 
    <p>No order for any of your products has been made.</p>
   @endif
@endsection
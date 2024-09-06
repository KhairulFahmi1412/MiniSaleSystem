@extends('layouts.seller')
@php 
    use Carbon\Carbon;
@endphp
@section('title', 'Seller Home Page')

@section('content')
    <h1>Seller Homepage</h1>

@if($purchases->isEmpty())
    <p>No pending orders.</p>
@else
    <table class="table table-bordered text-center">
        <tr>
            <th colspan=6><h5>Pending Orders</h5></th>
        </tr>
        <tr>
            <th>Orderer's Info</th>
            <th>Ordered Item</th>
            <th>Order Date</th>
            <th>Current Stock</th>
            <th>Ordered Quantity</th>
            <th>Action</th>
</tr>

        @foreach($purchases as $purchase)  
        <tr>    
            <td>{{ $purchase->user->name }} <br> {{ $purchase->user->phone_no }} <br> {{ $purchase->user->email }}</td>
            <td>{{ $purchase->product->name }}</td>
            <td>{{ Carbon::parse($purchase->created_at)->format('H:i, m-d-y') }}</td>
            <td>{{ $purchase->product->stock }}</td>
            <td>{{ $purchase->quantity }}</td>
            <td>
                        <form method="post"  action="{{route('processPurchase', $purchase->id)}}">
                            @csrf
                            @if($purchase->product->stock >= $purchase->quantity)
                                    <button type="submit" class="btn btn-success" onclick='return confirm("Confirm to process order?")'>Process Order </button>
                            @else 
                                <button type="button"  class="btn btn-secondary" disabled>Process Order</button>
                       

                            @endif
                            <br><br>
                            </form>
                            <form method="post" onclick="return confirm('Confirm to reject order?')" action="{{ route('rejectPurchase', $purchase->id) }}">
                            @csrf
                                    <button type="submit" class="btn btn-danger">Reject Order</button>
                            </form>
                        </td>
            
           
</tr>
        @endforeach
</table>
@endif
@endsection
@php 
    use Carbon\Carbon;
    //Import carbon to be used for timestamp formatting 
@endphp
@extends('layouts.user')

@section('title', 'Order History Page')

@section('content')
    <h1>Order History Page</h1>
    <ul>

    @if($purchases->isEmpty())
        <p>No order records exist for this account</p>
    @else 
        <table class="table table-bordered text-center">
            <tr>
                <th>Ordered Product</th>
                <th>Ordered Quantity</th>
                <th>Store Name</th>
                <th>Order Placed Date</th>
                <th>Order Last Updated At</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        @foreach($purchases as $purchase)
            <tr>
                <td>{{$purchase->product->name }}</td>
                <td>{{$purchase->quantity}}</td>
                <td>{{$purchase->product->seller->shop_name}}</td>
                <td>{{Carbon::parse($purchase->created_at)->format('H:i, m-d-y')}}</td>
                <td>{{Carbon::parse($purchase->updated_at)->format('H:i, m-d-y')}}</td>
                <td>
                  @include('partials.orderStatus')

                </td>
                <td>
                <a href="{{ route('storePage', $purchase->product->seller->id) }}"><button class="btn btn-primary">View Store</button></a>
                
                @if($purchase->status == 'pending')
                <br><br>
                    <form method="post" action="{{route('deletePurchase', $purchase->id)}}">  
                        @csrf 
                        <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure to cancel and delete this pending order?')">Delete Order</button>
                </form>
                @endif
                </td>
            </tr>
    @endforeach
</table>
    @endif
@endsection
@extends('layouts.user')

@section('title', 'User Home Page')

@section('content')
    <h1>Shop List</h1>

    @if($sellers->isEmpty())
        <p>No shops available.</p>
    @else
    <table class="table table-bordered text-center " >
        <tr>
            <th>Shop Name</th>
            <th>Action</th>
        </tr>
            @foreach($sellers as $seller)
            <tr>
                <td>{{$seller->shop_name}}</td>
                <td><a href="{{ route('storePage', $seller->id) }}"><button class="btn btn-primary">View Store</button></a></td>
            </tr>
            @endforeach
    </table>

    @endif
@endsection
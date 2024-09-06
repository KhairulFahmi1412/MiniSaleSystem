@extends('layouts.default')

@section('title', 'User Login')

@section('content')
    <!-- <h3 class="card-header text-center">User Login</h3> -->
    <form method="post" action="authUser" class="mt-4  px-3"">
        @csrf
        <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Email" required />
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Password" required />
        </div>
        <input type="submit" value="Login" class="btn btn-primary btn-block">
    </form>
    <div class="mt-3 text-center">
        <a href="{{ route('userRegister') }}" class="btn btn-link">User Register</a>
        <a href="{{ route('sellerLogin') }}" class="btn btn-link">Seller Login</a>
    </div>
@endsection

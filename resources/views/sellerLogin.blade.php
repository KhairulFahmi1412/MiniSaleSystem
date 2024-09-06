@extends('layouts.default')
@section('title', 'Seller Login')
@section('content')
    <form action="authSeller" method="post" class="mt-4  px-3"">
        @csrf
        <div class="form-group">
        <input type="email" class="form-control" placeholder="Email" name='email' required />
        </div>
        <div class="form-group">
        <input type="password" class="form-control" placeholder="Password" name='password' required /><br>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Login</button>

        
    </form>
    <div class="mt-3 text-center">
    <a href="{{ route('sellerRegister') }}"><button class="btn btn-link">Seller Register </button></a>
    <a href="{{ route('userLogin') }}"><button class="btn btn-link">User Login</button></a>
    </div>
    </body>
@endsection

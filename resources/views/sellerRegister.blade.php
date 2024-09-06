@extends('layouts.default')
@section('title', 'Seller Registration')
@section('content')


<!-- <h3 class="card-header text-center">Seller Registration</h3> -->
    <form method="post" action="registerSeller" class="mt-4  px-3"">
        @csrf
        <div class="form-group">
        <input type="email"  class="form-control" name='email' placeholder="Email"  required />
        </div>
        <div class="form-group">
        <input type="password"  class="form-control" name='password' placeholder="Password" required />
        </div>
        <div class="form-group">
        <input type="text" class="form-control" name="phone_no" placeholder="Phone Number" required />
        </div>
        <div class="form-group">
        <input type="text" class="form-control" name="name" placeholder="Name" required />
        </div>
        <div class="form-group">
        <input type="text" class="form-control" name="shop_name" placeholder="Shop Name" required />
        </div>
        <input type="submit" class="btn btn-success btn-block" value="Register"></br>
    
    </form>
    <div class="mt-3 text-center">
    <a href="{{ route('sellerLogin') }}"><button  class="btn btn-link">Seller Login</button></a>
    <a href="{{ route('userLogin') }}"><button  class="btn btn-link">User Login</button></a>
    </div>

@endsection

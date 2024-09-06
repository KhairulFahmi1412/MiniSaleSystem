@extends('layouts.default')

@section('title', 'User Registration')

@section('content')
    <form method="post" action="registerUser" class="mt-4 px-3"">
        @csrf
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Email"  required />
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password"  required />
        </div>
        <div class="form-group">
            <input type="name" class="form-control" name="name" placeholder="Full Name"  required /> 
        </div>
        <div class="form-group">
            <input type="phone_no" class="form-control" name="phone_no" placeholder="Phone Number"   required /><br>
        </div>
            <input type="submit" class="btn btn-success btn-block"  value="Register"  required />
    
    </form>
    
    <div class="mt-4 text-center">
    <a href="{{ route('userLogin') }}" class="btn btn-link">User Login</a>
    <a href="{{ route('sellerLogin') }}" class="btn btn-link">Seller Login</a>
</div>  
</body>
</html>

@endsection

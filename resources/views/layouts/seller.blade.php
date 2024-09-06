<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Seller View')</title>
    <!-- Include Bootstrap CSS -->
    
    @include('partials.head')</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('sellerHomepage')}}"><h5>Seller View</h5></a>
        <a class="navbar-brand" href="{{ route('sellerProductsPage')}}">Products</a>
        <a class="navbar-brand" href="{{ route('sellerPurchaseHistoryPage')}}">Order History</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('sellerAccountPage') }}">Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('sellerLogout') }}">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
@include('partials.notice')
    <div class="container mt-4">
        @yield('content')
    </div>
    <!-- Include Bootstrap JS and dependencies -->
  @include('partials.foot')
</body>
</html>
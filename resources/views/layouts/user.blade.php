<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title', 'User View')</title>
    <!-- Include Bootstrap CSS -->
  @include('partials.head')
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('homepage')}}"><h5>User View</h5></a>
        <a class="navbar-brand" href="{{ route('purchaseHistoryPage')}}">Order History</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('accountPage') }}">Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('userLogout') }}">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
   @include('partials.notice')
    <div class="container mt-4">
        @yield('content')
    </div>
    <footer class="text-center mt-4">
        <!-- Common footer content -->
    </footer>

    <!-- Include Bootstrap JS and dependencies -->
    @include('partials.foot')
</body>
</html>
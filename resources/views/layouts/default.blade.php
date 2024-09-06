<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Login / Registration Page')</title>
    <!-- Include Bootstrap CSS -->
    @include('partials.head')
</head>
<body>


@include('partials.notice')
   

<div class="card w-50 mx-auto mt-4">
<h3 class="card-header text-center">@yield('title', 'Login / Registration Page')</h3>
        @yield('content')
</div>
        <!-- Include Bootstrap JS and dependencies -->
   
        @include('partials.foot')
    </body>
</html>
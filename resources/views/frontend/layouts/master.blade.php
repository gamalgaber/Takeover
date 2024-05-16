<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>takeover</title>
    <link rel="stylesheet" href="{{ asset('Frontend/css/main/style.css') }}">
    <link rel="stylesheet" href="{{ asset('Frontend/css/main/cart.css') }}">
    <link rel="stylesheet" href="{{ asset('Frontend/css/main/wishlist.css') }}">
    <link rel="stylesheet" href="{{ asset('Frontend/css/main/cheakout.css') }}">
    <link rel="stylesheet" href="{{ asset('Frontend/css/main/contact.css') }}">
    <link rel="stylesheet" href="{{asset('Frontend/css/vendors/animate.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('Frontend/css/vendors/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Frontend/css/vendors/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Frontend/css/main/singleProduct.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="{{ asset('Frontend/assets/images/logo/DONT BE BITCH Y2K - Copy.png') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap">
    <link rel="stylesheet" href="{{asset('Frontend/css/vendors/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('Frontend/css/vendors/toastr.css')}}">
</head>

<body>


    <!------------------------------------------------------Start-Navbar------------------------------------------------------->
    @include('frontend.layouts.navbar')
    <!------------------------------------------------------End-avbar------------------------------------------------------->

    <!--============================
        MAIN CONTENT
    ==============================-->
    @yield('content')
    <!--============================
        MAIN CONTENT
    ==============================-->
    <!------------------------------------------------------Start-Footer------------------------------------------------------->
    @include('frontend.layouts.footer')
    <!------------------------------------------------------End-Footer------------------------------------------------------->



    <script src="{{asset('Frontend/js/vendors/jquery-3.6.0.min.js')}}"></script>
    <script src="{{ asset('Frontend/js/main/singleproduct.js') }}"></script>
    <script src="{{ asset('Frontend/js/main/main.js') }}"></script>
    <script src="{{ asset('Frontend/js/main/cart.js') }}"></script>
    <script src="{{ asset('Frontend/js/vendors/all.min.js') }}"></script>
    <script src="{{ asset('Frontend/js/vendors/bootstrap.bundle.min.js') }}"></script>
    <script src="{{asset('Frontend/js/vendors/toastr.min.js')}}"></script>
    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                // Display an info toast with no title
                toastr.error("{{ $error }}")
            @endforeach
        @endif
    </script>
    <script>
        $(document).ready(function(){
            $('.auto_click').click();
        })
    </script>
    @stack('scripts')
</body>

</html>

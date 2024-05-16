<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('Backend/assets/css/sales.css') }}">
    <link rel="stylesheet" href="{{ asset('Backend/assets/css/products.css') }}">
    <link rel="stylesheet" href="{{ asset('Backend/vendors/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{asset('Backend/vendors/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('Backend/vendors/dataTables/dataTables.css')}}">
    <link rel="stylesheet" href="{{ asset('Backend/assets/icons/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Backend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{asset('Backend/vendors/dataTables/responsive.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('Backend/vendors/toastr-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('Backend/vendors/toastr.min.css')}}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <title>Takeover</title>
</head>

<body>
    @include('admin.layouts.navbar')

    <!-- ****************************************************************************** -->
    <div class=" d-flex ">
        @include('admin.layouts.sidebar')

        <!-- ************************************************************************************ -->



        <!-- ******************************************************************* -->
        <!-- Main Content -->

        @yield('content')




    </div>
    <script src="{{asset('Backend/vendors/jquery/jquery-3.7.1.min.js')}}"></script>
    <script src="{{ asset('Backend/assets/icons/all.min.js') }}"></script>
    <script src="{{asset('Backend/vendors/bootstrap.min.js')}}"></script>
    <script src="{{asset('Backend/vendors/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('Backend/assets/js/script.js') }}"></script>
    <script src="{{asset('Backend/vendors/toastr.min.js')}}"></script>

    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                // Display an info toast with no title
                toastr.error("{{ $error }}")
            @endforeach
        @endif
    </script>
    @stack('scripts')
</body>

</html>

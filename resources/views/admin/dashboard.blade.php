@extends('admin.layouts.master')

@section('content')
<div class="container py-3">
    <div class="row d-flex flex-column flex-md-row gap-3 mx-auto container">
        <div class="col-12 col-md-3 bg-white rounded-3 d-flex flex-column p-3 shadow-lg">
            <div>
                <h3>Today Orders</h3>
                <p class="text-black-50">{{$todaysOrders}}</p>
            </div>

        </div>
        <div class="col-12 col-md-3 bg-white rounded-3 d-flex flex-column p-3 shadow-lg">
            <div>
                <h3>Total Orders</h3>
                <p class="text-black-50">{{$totalOrders}}</p>
            </div>

        </div>
        <div class="col-12 col-md-3 bg-white rounded-3 d-flex flex-column p-3 shadow-lg">
            <div>
                <h3>Total Earnings</h3>
                <p class="text-black-50">{{$totalEarnings}} LE</p>
            </div>
        </div>
        <div class="col-12 col-md-3 bg-white rounded-3 d-flex flex-column p-3 shadow-lg">
            <div>
                <h3>Month Earnings</h3>
                <p class="text-black-50">{{$monthEarnings}} LE</p>
            </div>
        </div>
        <div class="col-12 col-md-3 bg-white rounded-3 d-flex flex-column p-3 shadow-lg">
            <div>
                <h3>Year Earnings</h3>
                <p class="text-black-50">{{$yearEarnings}} LE</p>
            </div>
        </div>
        <div class="col-12 col-md-3 bg-white rounded-3 d-flex flex-column p-3 shadow-lg">
            <div>
                <h3>Total Categories</h3>
                <p class="text-black-50">{{$totalCategories}}</p>
            </div>
        </div>
        <div class="col-12 col-md-3 bg-white rounded-3 d-flex flex-column p-3 shadow-lg">
            <div>
                <h3>Total Products</h3>
                <p class="text-black-50">{{$totalProducts}}</p>
            </div>
        </div>
        <div class="col-12 col-md-3 bg-white rounded-3 d-flex flex-column p-3 shadow-lg">
            <div>
                <h3>Total Users</h3>
                <p class="text-black-50">{{$totalUsers}}</p>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src="{{asset('Backend/assets/icons/all.min.js')}}"></script>
    <script src="{{asset('Backend/vendors/bootstrap.min.js')}}"></script>
    <script src="{{asset('Backend/vendors/jquery/jquery-3.7.1.min.js')}}"></script>
    <script src="{{asset('Backend/assets/js/script.js')}}"></script>
    <script src="{{asset('Backend/vendors/bootstrap.bundle.min.js')}}"></script>
@endpush
@endsection



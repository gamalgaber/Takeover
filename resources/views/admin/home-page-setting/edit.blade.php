@extends('admin.layouts.master')


@section('content')
    <div class=" container py-3  px-5  row ">
        <div class="row d-flex flex-column bg-white p-2  bg-opacity-75 col-12 col-md-12 shadow-lg">
            <h2>Update Home Page</h2>
            <div class="prodcut_input d-flex flex-column ">
                <form action="{{route('admin.home-page-settings.update',$homePage->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="">Products Title:</label>
                        <input type="name" name="products_title" id="" value="{{$homePage->products_title}}">
                    </div>
                    <div>
                        <label for="">Categories Title:</label>
                        <input type="name" name="categories_title" id="" value="{{$homePage->categories_title}}">
                    </div>
                    <div>
                        <label for="">Categories Title:</label>
                        <input type="name" name="filter_categories_title" id="" value="{{$homePage->filter_categories_title}}">
                    </div>
                    <div class="pt-3">
                        <button class="btn my_btn " id="create_btn">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

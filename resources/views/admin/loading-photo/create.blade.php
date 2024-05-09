@extends('admin.layouts.master')


@section('content')
    <div class=" container py-3  px-5  row ">

        <div class="row d-flex flex-column bg-white p-2  bg-opacity-75 col-12 col-md-12 shadow-lg">
            <h2>Create Loading Photo</h2>

            <div class="prodcut_input d-flex flex-column ">
                <form action="{{route('admin.Loading-photo.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label for="">banner:</label>
                        <input type="file" name="banner" id="">
                    </div>
                    <div>
                        <label for="">Title:</label>
                        <input type="text" name="title" id="" value="{{old('title')}}">
                    </div>
                    <div>
                        <label for="">Button URL:</label>
                        <input type="text" name="button_url" id="" value="{{old('button_url')}}">
                    </div>
                    <div>
                        <label for="">Status:</label>
                        <div class="form-floating">
                            <select name="status" id="" class=" form-select" value="{{old('status')}}">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="pt-3">
                        <button class="btn my_btn " id="create_btn">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

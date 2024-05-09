@extends('admin.layouts.master')


@section('content')
    <div class=" container py-3  px-5  row ">

        <div class="row d-flex flex-column bg-white p-2  bg-opacity-75 col-12 col-md-12 shadow-lg">
            <h2>Update Loading Photo</h2>

            <div class="prodcut_input d-flex flex-column ">
                <form action="{{route('admin.Loading-photo.update',$loadingPhoto->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div>
                        <label>Preview</label>
                        <br>
                        <img src="{{asset($loadingPhoto->banner)}}" width="200px" alt="">
                    </div>
                    <div>
                        <label for="">banner:</label>
                        <input type="file" name="banner" id="">
                    </div>
                    <div>
                        <label for="">Title:</label>
                        <input type="text" name="title" id="" value="{{$loadingPhoto->title}}">
                    </div>
                    <div>
                        <label for="">Button URL:</label>
                        <input type="text" name="button_url" id="" value="{{$loadingPhoto->button_url}}">
                    </div>
                    <div>
                        <label for="">Status:</label>
                        <div class="form-floating">
                            <select name="status" id="" class=" form-select">
                                <option {{$loadingPhoto->status === 1 ? 'selected' : ''}} value="1">Active</option>
                                <option {{$loadingPhoto->status === 0 ? 'selected' : ''}} value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="pt-3">
                        <button class="btn my_btn " id="create_btn">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

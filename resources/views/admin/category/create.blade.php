@extends('admin.layouts.master')


@section('content')
    <div class=" container py-3  px-5  row ">

        <div class="row d-flex flex-column bg-white p-2  bg-opacity-75 col-12 col-md-12 shadow-lg">
            <h2>Create Category</h2>

            <div class="prodcut_input d-flex flex-column ">
                <form action="{{route('admin.category.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label for="">Image:</label>
                        <input type="file" name="image" id="" value="{{old('name')}}">
                    </div>
                    <div>
                        <label for="">Name:</label>
                        <input type="text" name="name" id="" value="{{old('name')}}">
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

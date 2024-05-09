@extends('admin.layouts.master')


@section('content')
    <div class=" container py-3  px-5  row ">

        <div class="row d-flex flex-column bg-white p-2  bg-opacity-75 col-12 col-md-12 shadow-lg">
            <h2>Update Product Variants</h2>

            <div class="prodcut_input d-flex flex-column ">
                <form action="{{route('admin.product-variants.update', $variant->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="">Name:</label>
                        <input type="name" name="name" id="" value="{{$variant->name}}">
                    </div>
                    <div>
                        <label for="">Status:</label>
                        <div class="form-floating">
                            <select name="status" id="" class=" form-select">
                                <option {{$variant->status === 1 ? 'selected' : ''}} value="1">Active</option>
                                <option {{$variant->status === 0 ? 'selected' : ''}} value="0">Inactive</option>
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

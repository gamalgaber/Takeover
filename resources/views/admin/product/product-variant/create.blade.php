@extends('admin.layouts.master')


@section('content')
    <div class=" container py-3  px-5  row ">

        <div class="row d-flex flex-column bg-white p-2  bg-opacity-75 col-12 col-md-12 shadow-lg">
            <h2>Create Product Variant</h2>

            <div class="prodcut_input d-flex flex-column ">
                <form action="{{route('admin.product-variants.store')}}" method="POST">
                    @csrf
                    <div>
                        <label for="">Name:</label>
                        <input type="text" name="name" id="" value="{{old('name')}}">
                    </div>
                    <br>
                    <div>
                        <input type="text" name="product" id="" value="{{request()->product}}" readonly>
                    </div>
                    <br>
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

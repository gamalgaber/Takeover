@extends('admin.layouts.master')

@section('content')
    <div class="container py-3  ">
        <div class=" bg-white p-5 bg-opacity-75 col-11 col-md-12 col-lg-12 shadow-lg">
            <h2>Edit Shipping</h2>


            <div class="row">
                <div class="px-1  ">
                    <div class=" d-flex flex-column   ">
                        <form action="{{ route('admin.shipping.update',$shipping->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="prodcut_input d-flex flex-column">
                                <div>
                                    <label for="">Name:</label>
                                    <input type="text" name="name" id="" value="{{$shipping->name}}">
                                </div>
                                <div>
                                    <label for="">Cost:</label>
                                    <input type="text" name="cost" id="" value="{{$shipping->cost}}">
                                </div>
                                <div>
                                    <label for="">Status:</label>
                                    <div class="form-floating">

                                        <select name="status" id="" class=" form-select">
                                            <option {{$shipping->status == 1 ? 'selected' : ''}}  value="1">Active</option>
                                            <option {{$shipping->status == 1 ? 'selected' : ''}} value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="pt-3">
                                    <button class="btn my_btn " id="create_btn">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

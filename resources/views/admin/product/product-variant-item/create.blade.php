@extends('admin.layouts.master')


@section('content')
    <div class=" container py-3  px-5  row ">

        <div class="row d-flex flex-column bg-white p-2  bg-opacity-75 col-12 col-md-12 shadow-lg">
            <h2>Create Variant-item</h2>

            <div class="prodcut_input d-flex flex-column ">
                <form action="{{ route('admin.product-variant-item.store') }}" method="POST">
                    @csrf
                    <div>
                        <label for="">Variant Name:</label>
                        <input type="text" name="variant_name" id="" value="{{ $variant->name }}" readonly>
                    </div>
                    <div>
                        <input type="hidden" name="variant_id" id="" value="{{$variant->id}}" readonly>
                    </div>
                    <div>
                        <input type="hidden" name="product_id" id="" value="{{$product->id}}" readonly>
                    </div>
                    <div>
                        <label for="">Item Name:</label>
                        <input type="text" name="name" id="">
                    </div>
                    <div>
                        <label for="">Is Default:</label>
                        <div class="form-floating">
                            <select name="is_default" id="" class=" form-select">
                                <option value="">Select</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label for="">Status:</label>
                        <div class="form-floating">
                            <select name="status" id="" class=" form-select">
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

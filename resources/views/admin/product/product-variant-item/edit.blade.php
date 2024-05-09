@extends('admin.layouts.master')


@section('content')
    <div class=" container py-3  px-5  row ">

        <div class="row d-flex flex-column bg-white p-2  bg-opacity-75 col-12 col-md-12 shadow-lg">
            <h2>Edit Variant-item</h2>

            <div class="prodcut_input d-flex flex-column ">
                <form action="{{ route('admin.product-variant-item.update', $variantItem->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="">Variant Name:</label>
                        <input type="text" name="variant_name" id="" value="{{ $variant->name }}" readonly>
                    </div>
                    <div>
                        <label for="">Item Name:</label>
                        <input type="text" name="name" id="" value="{{ $variantItem->name }}">
                    </div>
                    <div>
                        <label for="">Is Default:</label>
                        <div class="form-floating">
                            <select name="is_default" id="" class=" form-select">
                                <option value="">Select</option>
                                <option {{ $variantItem->is_default == 1 ? 'selected' : '' }} value="1">Yes</option>
                                <option {{ $variantItem->is_default == 0 ? 'selected' : '' }} value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label for="">Status:</label>
                        <div class="form-floating">
                            <select name="status" id="" class=" form-select">
                                <option {{ $variantItem->status == 1 ? 'selected' : '' }} value="1">Active</option>
                                <option {{ $variantItem->status == 0 ? 'selected' : '' }} value="0">Inactive</option>
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

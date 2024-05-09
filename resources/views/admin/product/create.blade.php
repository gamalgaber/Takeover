@extends('admin.layouts.master')


@section('content')
    <div class=" container py-3  px-5  row ">

        <div class="row d-flex flex-column bg-white p-2  bg-opacity-75 col-12 col-md-12 shadow-lg">
            <h2>Create Product</h2>

            <div class="prodcut_input d-flex flex-column ">
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label for="">Image:</label>
                        <input type="file" name="image" id="">
                    </div>
                    <br>
                    <div>
                        <label for="">Name:</label>
                        <input type="text" name="name" id="" value="{{ old('name') }}">
                    </div>
                    <br>
                    <div>
                        <label for="">Category:</label>
                        <div class="form-floating">
                            <select name="category_id" id="" class=" form-select" value="{{ old('category_id') }}">
                                <option value="">Select</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <div>
                        <label for="">Sku:</label>
                        <input type="text" name="sku" id="" value="{{ old('sku') }}">
                    </div>
                    <br>
                    <div>
                        <label for="">Price:</label>
                        <input type="text" name="price" id="" value="{{ old('price') }}">
                    </div>
                    <br>
                    <div>
                        <label for="">Offer Price:</label>
                        <input type="text" name="offer_price" id="" value="{{ old('offer_price') }}">
                    </div>
                    <br>
                    <div>
                        <label for="">Offer Start Date:</label>
                        <input type="date" name="offer_start_date" id="" value="{{ old('offer_start_date') }}">
                    </div>
                    <br>
                    <div>
                        <label for="">Offer End Date:</label>
                        <input type="date" name="offer_end_date" id="" value="{{ old('offer_end_date') }}">
                    </div>
                    <br>
                    <div>
                        <label for="">Quantity:</label>
                        <input type="text" name="quantity" id="" value="{{ old('quantity') }}">
                    </div>
                    <br>
                    <div>
                        <label for="">Instagram Link:</label>
                        <input type="text" name="instagram_link" id="" value="{{ old('instagram_link') }}">
                    </div>
                    <br>
                    <div>
                        <label for="">Short Description:</label>
                        <br>
                        <textarea type="text" name="short_description" id="" value="{{ old('short_description') }}"></textarea>
                    </div>
                    <br>
                    <div>
                        <label for="">Product Type:</label>
                        <div class="form-floating">
                            <select name="product_type" id="" class=" form-select">
                                <option value="">Select</option>
                                <option value="new_arrival">New Arrival</option>
                                <option value="featured_product">Featured</option>
                                <option value="top_product">Top Product</option>
                                <option value="sale">Sale</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div>
                        <label for="">Status:</label>
                        <div class="form-floating">
                            <select name="status" id="" class=" form-select" value="{{ old('status') }}">
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

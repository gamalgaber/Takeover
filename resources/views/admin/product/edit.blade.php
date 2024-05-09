@extends('admin.layouts.master')


@section('content')
    <div class=" container py-3  px-5  row ">

        <div class="row d-flex flex-column bg-white p-2  bg-opacity-75 col-12 col-md-12 shadow-lg">
            <h2>Update Product</h2>

            <div class="prodcut_input d-flex flex-column ">
                <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div>
                        <label>Preview</label>
                        <br>
                        <img src="{{asset($product->image)}}" width="200px" alt="">
                    </div>
                    <div>
                        <label for="">Image:</label>
                        <input type="file" name="image" id="">
                    </div>
                    <br>
                    <div>
                        <label for="">Name:</label>
                        <input type="text" name="name" id="" value="{{$product->name}}">
                    </div>
                    <br>
                    <div>
                        <label for="">Category:</label>
                        <div class="form-floating">
                            <select name="category_id" id="" class=" form-select" value="{{ old('category_id') }}">
                                <option value="">Select</option>
                                @foreach ($categories as $category)
                                <option {{ $category->id == $product->category_id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <div>
                        <label for="">Sku:</label>
                        <input type="text" name="sku" id="" value="{{$product->sku}}">
                    </div>
                    <br>
                    <div>
                        <label for="">Price:</label>
                        <input type="text" name="price" id="" value="{{$product->price}}">
                    </div>
                    <br>
                    <div>
                        <label for="">Offer Price:</label>
                        <input type="text" name="offer_price" id="" value="{{$product->offer_price}}">
                    </div>
                    <br>
                    <div>
                        <label for="">Offer Start Date:</label>
                        <input type="date" name="offer_start_date" id="" value="{{$product->offer_start_date}}">
                    </div>
                    <br>
                    <div>
                        <label for="">Offer End Date:</label>
                        <input type="date" name="offer_end_date" id="" value="{{$product->offer_end_date}}">
                    </div>
                    <br>
                    <div>
                        <label for="">Quantity:</label>
                        <input type="text" name="quantity" id="" value="{{$product->quantity}}">
                    </div>
                    <br>
                    <div>
                        <label for="">Instagram Link:</label>
                        <input type="text" name="instagram_link" id="" value="{{$product->instagram_link}}">
                    </div>
                    <br>
                    <div>
                        <label for="">Short Description:</label>
                        <br>
                        <textarea type="text" name="short_description" id="" value="{">{!! $product->short_description !!}</textarea>
                    </div>
                    <br>
                    <div>
                        <label for="">Product Type:</label>
                        <div class="form-floating">
                            <select name="product_type" id="" class=" form-select">
                                <option value="">Select</option>
                                <option {{ $product->product_type === 'new_arrival' ? 'selected' : '' }} value="new_arrival">New Arrival</option>
                                <option {{ $product->product_type === 'featured_product' ? 'selected' : '' }} value="featured_product">Featured</option>
                                <option {{ $product->product_type === 'top_product' ? 'selected' : '' }} value="top_product">Top Product</option>
                                <option {{ $product->product_type === 'sale' ? 'selected' : '' }} value="sale">Sale</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div>
                        <label for="">Status:</label>
                        <div class="form-floating">
                            <select name="status" id="" class=" form-select" value="">
                                <option {{$product->status === 1 ? 'selected' : ''}} value="1">Active</option>
                                <option {{$product->status === 0 ? 'selected' : ''}} value="0">Inactive</option>
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

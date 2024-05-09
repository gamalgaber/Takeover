@extends('admin.layouts.master')

@section('content')
    <div class=" container my-form py-3 ">

        <div class="row  w-auto">
            <h2>Edit Coupon</h2>

            <div class="col-12 col-md-10  p-1  ">
                <form action="{{route('admin.coupon.update', $coupon->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class=" d-flex flex-column bg-white p-5 bg-opacity-75">
                        <div class="prodcut_input col-8 col-md-7 col-lg-12 gap-2 d-flex flex-column ">
                            <div class="d-flex flex-column flex-lg-row">
                                <div>
                                    <label for="">Name:</label>
                                    <input type="text" name="name" id="" value="{{ $coupon->name }}">
                                </div>
                            </div>
                            <div>
                                <label for="">Code:</label>
                                <input type="text" name="code" id="" value="{{ $coupon->code }}">
                            </div>
                            <div>
                                <label for="">Quantity:</label>
                                <input type="text" name="quantity" id="" value="{{ $coupon->quantity }}">
                            </div>
                            <div>
                                <label for="">Max Use Per Person:</label>
                                <input type="text" name="max_use" id="" value="{{ $coupon->max_use }}">
                            </div>
                            <div>
                                <label for="">Start Date:</label>
                                <input type="date" name="start_date" id="" value="{{ $coupon->start_date }}">
                            </div>
                            <div>
                                <label for="">End Date:</label>
                                <input type="date" name="end_date" id="" value="{{ $coupon->end_date }}">
                            </div>
                            <div>
                                <label for="">Discount Type:</label>
                                <div class="form-floating">
                                    <select name="discount_type" id="" class=" form-select">
                                        <option {{ $coupon->discount_type == 'percent' ? 'selected' : '' }} value="percent">Percentage(%)</option>
                                        <option {{ $coupon->discount_type == 'amount' ? 'selected' : '' }} value="amount">Amount (LE)</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label for="">Discount Value:</label>
                                <input type="text" name="discount" id="" value="{{ $coupon->discount }}">
                            </div>
                            <div>
                                <label for="">Status:</label>
                                <div class="form-floating">
                                    <select name="status" id="" class=" form-select">
                                        <option {{ $coupon->status == '1' ? 'selected' : '' }} value="1">Active</option>
                                        <option {{ $coupon->status == '0' ? 'selected' : '' }} value="0">Inactive</option>
                                    </select>
                                </div>
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
@endsection

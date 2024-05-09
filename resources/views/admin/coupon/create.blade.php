@extends('admin.layouts.master')

@section('content')
    <div class=" container my-form py-3 ">

        <div class="row  w-auto">
            <h2>Create Coupon</h2>

            <div class="col-12 col-md-10  p-1  ">
                <form action="{{route('admin.coupon.store')}}" method="POST">
                    @csrf
                    <div class=" d-flex flex-column bg-white p-5 bg-opacity-75">
                        <div class="prodcut_input col-8 col-md-7 col-lg-12 gap-2 d-flex flex-column ">
                            <div class="d-flex flex-column flex-lg-row">
                                <div>
                                    <label for="">Name:</label>
                                    <input type="text" name="name" id="">
                                </div>
                            </div>
                            <div>
                                <label for="">Code:</label>
                                <input type="text" name="code" id="">
                            </div>
                            <div>
                                <label for="">Quantity:</label>
                                <input type="text" name="quantity" id="">
                            </div>
                            <div>
                                <label for="">Max Use Per Person:</label>
                                <input type="text" name="max_use" id="">
                            </div>
                            <div>
                                <label for="">Start Date:</label>
                                <input type="date" name="start_date" id="">
                            </div>
                            <div>
                                <label for="">End Date:</label>
                                <input type="date" name="end_date" id="">
                            </div>
                            <div>
                                <label for="">Discount Type:</label>
                                <div class="form-floating">
                                    <select name="discount_type" id="" class=" form-select">
                                        <option value="percent">Percentage(%)</option>
                                        <option value="amount">Amount (LE)</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label for="">Discount Value:</label>
                                <input type="text" name="discount" id="">
                            </div>
                            <div>
                                <label for="">Status:</label>
                                <div class="form-floating">
                                    <select name="status" id="" class=" form-select">
                                        <option value="1">Active</option>
                                        <option value="0">Hidden</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="pt-3">
                            <button class="btn my_btn " id="create_btn">Create</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection

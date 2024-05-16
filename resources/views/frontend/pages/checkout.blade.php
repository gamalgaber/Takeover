@extends('frontend.layouts.master')

@section('content')
    <section class="mt-5 pb-4">
        <div class="container ">
            <div class="row">
                <div class="accordion   d-block d-sm-none " id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">

                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <span>
                                    Show Order Summary
                                </span>
                                <div class="ms-auto ">
                                    <span class="fw-bold fs-6  total_amount_res" ></span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="cheak-out__text--size">
                                    @if (request()->has('product_id'))
                                        <div class="">
                                            <div class="d-flex  align-items-center ">
                                                <div class="cheak-out__image">
                                                    <img src="{{ asset($product->image) }}" class="img-fluid "
                                                         width="100%" height="100%" alt="">
                                                </div>
                                                <div class="d-flex flex-column ms-3">
                                                    <div>
                                                        <span>{{ $product->name }}</span>
                                                    </div>
                                                    <div>
                                                            <span class="text-black-50  text-small">Size: {{request()->variant_id}}</span>
                                                    </div>
                                                    <div>
                                                            <span class="text-black-50  text-small">Quantity: 1</span>
                                                    </div>
                                                </div>
                                                <div class="ms-auto ">
                                                    <span class="cheak-out__span--price">{{ $product->price }} LE</span>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        @if ($cartItems)
                                            @foreach ($cartItems as $item)
                                                <div class="">
                                                    <div class="d-flex  align-items-center ">
                                                        <div class="cheak-out__image">
                                                            <img src="{{ asset($item->options->image) }}" class="img-fluid "
                                                                 width="100%" height="100%" alt="">
                                                        </div>
                                                        <div class="d-flex flex-column ms-3">
                                                            <div>
                                                                <span>{{ $item->name }}</span>
                                                            </div>
                                                            <div>
                                                            <span
                                                                class="text-black-50  text-small">Size: {{ $item->options->variants }}</span>
                                                            </div>
                                                            <div>
                                                            <span
                                                                class="text-black-50  text-small">Quantity: {{ $item->qty }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="ms-auto ">
                                                            <span class="cheak-out__span--price">{{ $item->price * $item->qty }} LE</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    @endif



                                    <form class="coupon_form">
                                        <div class="mt-5 mb-5 d-flex  justify-content-between align-items-center ">
                                            <div class="w-100 me-4">
                                                <input type="text" class="form-control "
                                                    value="{{ session()->has('coupon') ? session()->get('coupon')['coupon_code'] : '' }}"
                                                    name="coupon_code" id="exampleInputEmail1" placeholder="Discount code">
                                            </div>
                                            <div>
                                                <button class="cheak-out__button">apply</button>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="d-flex justify-content-between mb-1 ">
                                        <span class="cheak-out__span--text">Subtotal</span>
                                        <span class="cheak-out__span--price "
                                            id="subTotal_amount_res">{{$subTotal > 0 ? $subTotal : getCartSubTotal() }}LE</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1 ">
                                        <span class="cheak-out__span--text">Discount</span>
                                        <span class="cheak-out__span--price "
                                            id="discount_web_res">0 LE</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2 ">
                                        <span class="cheak-out__span--text">Shipping</span>
                                        <span class="cheak-out__span--price " id="invoice-shopping-cost_res"></span>
                                    </div>
                                    <div class="d-flex justify-content-between  fs-5">
                                        <span class="fw-bold ">Total</span>
                                        <span class="fw-bold total_amount_res"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!--Information Div-->
                <div class="col-md-6 col-12   mt-4 mt-sm-0">
                    <form action="{{ route('checkout.form-submit') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                                <div class="d-flex justify-content-between pb-2">
                                    <h4>Contact</h4>
                                    @if(!auth()->check())
                                    <a href="{{route('login')}}" class="checkout__login" style="padding: 5px 10px;
                                    width: 60px;">Login</a>
                                    @endif
                                </div>
                            <div class="">
                                <input type="email" class="form-control p-2" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" placeholder="Email or mobile phone number" name="email"
                                    value="{{ old('email') }}">
                            </div>
                        </div>

                        <div>
                            <div>
                                <h4>Delivery</h4>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="First name" name="first_name"
                                        aria-label="First name" value="{{ old('first_name') }}">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Last name" name="last_name"
                                        aria-label="Last name" value="{{ old('last_name') }}">
                                </div>
                            </div>
                            <div class="mb-3 mt-4">
                                <input type="text" class="form-control p-2" id="exampleInputEmail1" name="address"
                                    aria-describedby="emailHelp" placeholder="Address" value="{{ old('address') }}">
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-12 mb-3 mb-sm-0">
                                    <input type="text" class="form-control" placeholder="City" aria-label="First name"
                                        name="city" value="{{ old('city') }}">
                                </div>
                                <div class="col-md-4 col-12 mb-3  mb-sm-0">
                                    <select id="government-select" class="form-select form-select-md form-control"
                                        aria-label=".form-select-md example" name="government">
                                        <option>Select</option>
                                        @foreach (config('government.government_list') as $govenment)
                                            <option {{ $govenment == old('govenment') ? 'selected' : '' }}
                                                value="{{ $govenment }}">{{ $govenment }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 col-12">
                                    <input type="text" class="form-control" placeholder="Postal code"
                                        name="postal_code" aria-label="First name" value="{{ old('postal_code') }}">
                                </div>
                            </div>

                            <div class="mb-3 mt-3">
                                <input type="tel" class="form-control p-2" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" placeholder=" phone " name="phone"
                                    value="{{ old('phone') }}">
                            </div>

                            <div class="mt-4">
                                <h4>Shipping method</h4>
                                <input class="input__checkout-disabled p-3" type="text" id="shopping-government-cost"
                                    placeholder="Standard  50.00LE" aria-label="Disabled input example" disabled>
                            </div>

                            <div class="mt-4">
                                <h3>Payment</h3>
                                <input class="input__checkout-disabled p-3  " type="text"
                                    placeholder="Cash on Delivery (COD)" aria-label="Disabled input example" disabled>
                            </div>
                        </div>
                        <input type="hidden" name="shipping_price" id="shipping_price" value="">
                        <div class="cheakout__button--completeorder mt-4">
                            <input type="hidden" name="checkout_type" value="{{ request()->segment(1) === 'checkout' && request()->segment(2) === 'buyNow' ? 'buyNow' : 'cart' }}">
                            <input type="hidden" name="product_id" value="{{ request('product_id') }}">
                            <input type="hidden" name="variant_id" value="{{ request('variant_id') }}">
                            <button type="submit">Complete Order</button>
                        </div>
                    </form>
                </div>

                <!--Product and Price Div-->
                <div class="col-md-6 col-12 check-out__price d-none d-sm-block ">
                    <div class="cheak-out__text--size">
                        @if (request()->has('product_id'))
                            <div class="">
                                <div class="d-flex  align-items-center pb-2">
                                    <div class="cheak-out__image">
                                        <img src="{{ asset($product->image) }}" class="img-fluid " width="100%"
                                            height="100%" alt="">
                                    </div>
                                    <div class="d-flex flex-column ms-3">
                                        <div>
                                            <span>{{ $product->name }}</span>
                                        </div>
                                        <div>
                                            <span class="text-black-50  text-small">Size: {{request()->variant_id}}</span>
                                        </div>
                                        <div>
                                            <span class="text-black-50  text-small">Quantity: 1</span>
                                        </div>
                                    </div>
                                    <div class="ms-auto ">
                                        <span class="cheak-out__span--price">{{ $product->price }}LE</span>
                                    </div>
                                </div>
                            </div>
                        @else
                            @foreach ($cartItems as $item)
                                <div class="">
                                    <div class="d-flex  align-items-center pb-2">
                                        <div class="cheak-out__image">
                                            <img src="{{ asset($item->options->image) }}" class="img-fluid "
                                                width="100%" height="100%" alt="">
                                        </div>
                                        <div class="d-flex flex-column ms-3">
                                            <div>
                                                <span>{{ $item->name }}</span>
                                            </div>
                                            <div>
                                                <span
                                                    class="text-black-50  text-small">Size: {{ $item->options->variants }}</span>
                                            </div>
                                            <div>
                                                <span
                                                    class="text-black-50  text-small">Quantity: {{ $item->qty }}</span>
                                            </div>
                                        </div>
                                        <div class="ms-auto ">
                                            <span class="cheak-out__span--price">{{ $item->price * $item->qty }}LE</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <form class="coupon_form">
                            <div class="mt-5 mb-5 d-flex  justify-content-between align-items-center ">
                                <div class="w-100 me-4">
                                    <input type="text" class="form-control " id="exampleInputEmail1"
                                        value="{{ session()->has('coupon') ? session()->get('coupon')['coupon_code'] : '' }}"
                                        name="coupon_code" placeholder="Discount code">
                                </div>
                                <div>
                                    <button class="cheak-out__button">apply</button>
                                </div>
                            </div>
                        </form>
                        <div class="d-flex justify-content-between mb-1 ">
                            <span class="cheak-out__span--text">Subtotal</span>
                            <span class="cheak-out__span--price " id="subTotal_amount">{{$subTotal > 0 ? $subTotal : getCartSubTotal() }}LE</span>
                        </div>
                        <div class="d-flex justify-content-between mb-1 ">
                            <span class="cheak-out__span--text">Discount</span>
                            <span class="cheak-out__span--price " id="discount_web">0
                                LE</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2 ">
                            <span class="cheak-out__span--text">Shipping</span>
                            <span class="cheak-out__span--price " id="invoice-shopping-cost"></span>
                        </div>
                        <div class="d-flex justify-content-between  fs-5">
                            <span class="fw-bold ">Total</span>
                            <span class="fw-bold  " id="total_amount"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function updateTotal() {
                var subtotal = parseInt($('#subTotal_amount').text().replace('LE', '').trim());
                var shippingCost = parseInt($('#invoice-shopping-cost').text().replace('LE', '').trim());

                if (!isNaN(subtotal) && !isNaN(shippingCost)) {
                    // Calculate total
                    var total = subtotal + shippingCost; //

                    total = Math.round(total * 100) / 100;
                    // Update total
                    $('#total_amount').text(total + ' LE');
                }
            }

            function updateTotalResponsive() {
                var subtotalRes = parseInt($('#subTotal_amount_res').text().replace('LE', '').trim());
                var shippingCostRes = parseInt($('#invoice-shopping-cost_res').text().replace('LE', '').trim());
                if (!isNaN(subtotalRes) && !isNaN(shippingCostRes)) {
                    // Calculate total
                    var total = subtotalRes + shippingCostRes; //

                    total = Math.round(total * 100) / 100;
                    // Update total
                    $('.total_amount_res').text(total + ' LE');
                }
            }

            // apply coupon on cart
            $('.coupon_form').on('submit', function(event) {
                event.preventDefault();
                let formData = $(this).serialize();
                $.ajax({
                    type: 'GET',
                    url: "{{ route('checkout.apply-coupon') }}",
                    data: formData,
                    success: function(data) {
                        if (data.status == 'error') {
                            toastr.error(data.message);
                        } else if (data.status == 'success') {
                            calculateCouponDiscount();
                            toastr.success(data.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        var errors = xhr.responseJSON.errors;
                        if (errors) {
                            $.each(errors, function(key, value) {
                                toastr.error(value);
                            });
                        } else {
                            toastr.error('An error occurred. Please try again.');
                        }
                    }
                })
            })

            function calculateCouponDiscount() {
                $.ajax({
                    type: 'GET',
                    url: "{{ route('checkout.coupon-calculation') }}",
                    success: function(data) {
                        if (data.status == 'success') {
                            $('#discount_web').text('- '+data.cart_total + " LE");
                            $('#discount_web_res').text('- '+data.cart_total + " LE");
                            $('#subTotal_amount').text(data.discount + " LE");
                            $('#subTotal_amount_res').text(data.discount + " LE");
                        }
                    },
                    error: function(xhr, status, error) {
                        var errors = xhr.responseJSON.errors;
                        if (errors) {
                            $.each(errors, function(key, value) {
                                toastr.error(value);
                            });
                        } else {
                            toastr.error('An error occurred. Please try again.');
                        }
                    }
                })
            }

            $('#government-select').change(function() {
                // Get the selected government
                var selectedGovernment = $(this).val();

                // Send AJAX request to server to calculate shipping cost
                $.ajax({
                    method: 'GET',
                    url: "{{ route('calculate-shipping-cost') }}",
                    data: {
                        government: selectedGovernment
                    },
                    success: function(response) {
                        // Update the shipping cost display
                        $('#invoice-shopping-cost').text(response.cost + ' LE');
                        $('#invoice-shopping-cost_res').text(response.cost + ' LE');

                        $('#shopping-government-cost').prop('value', 'Standard ' + response
                            .cost + ' LE');
                        // Call updateTotal function initially
                        updateTotal();
                        updateTotalResponsive();
                        let shippingPrice = parseInt($('#shopping-government-cost').val()
                            .replace('Standard', '').replace('LE', '').trim());
                        $('#shipping_price').val(shippingPrice);
                    },
                    error: function(xhr, status, error) {
                        var errors = xhr.responseJSON.errors;
                        if (errors) {
                            $.each(errors, function(key, value) {
                                toastr.error(value);
                            });
                        } else {
                            toastr.error('An error occurred. Please try again.');
                        }
                    }
                });
            });
        })
    </script>
@endpush

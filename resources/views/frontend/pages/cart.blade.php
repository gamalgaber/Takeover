@extends('frontend.layouts.master')

@section('content')
    <section class="mt-3 cart allcart__size">
        <div class="container">
            <div>
                <ul class="d-flex list-unstyled gap-2 align-items-center  text-capitalize  text-black-50">
                    <li>
                        <a href="{{ url('/') }}" class="text-decoration-none text-black-50 ">home</a>
                    </li>
                    <i class="fa-solid fa-angle-right"></i>
                    <li>
                        <a href="javascript:;" class="text-decoration-none text-black-50 text-capitalize ">your cart</a>
                    </li>
                </ul>
            </div>
            <div class="mt-6">
                <h4 class="text-uppercase text-center ">your cart</h4>
                <hr class=" hr--small ">
            </div>

            {{-- <button class="fs-4 btn btn-danger clear_cart" style="height: 50px;">clear cart</button> --}}


            <div class="d-none d-sm-block text-uppercase product--textinfo mt-5">
                <div class="d-flex  flex-row justify-content-between  ">
                    <div>
                        <p class="fs-4">product</p>
                    </div>
                    <div class="d-flex cart__info--gap">
                        <p class="fs-4">quantity</p>
                        <p class="fs-4">total</p>
                    </div>
                </div>
                <hr>
            </div>


            @foreach ($cartItems as $item)
                <div>
                    <div class="row">
                        <div class="col-6 col-md-3">
                            <div class="cart__image">
                                <img src="{{ asset($item->options->image) }}" alt="">
                            </div>
                        </div>

                        <div class="col-6 col-md-4">
                            <div class="d-flex flex-column ">
                                <span class="cart__info">{{ $item->name }}</span>
                                <span class="mt-2 text-black-50 ">Size: {{$item->options->variants}}</span><!--size-->
                                <a class="mt-2 text-black-50 cart__text--none" href="{{route('cart.remove-product', $item->rowId)}}">Remove</a>
                            </div>
                        </div>

                        <div class="flex__mobile  mt-4 mt-sm-0 col-md-5 d-flex align-items-center ">

                            <div class="col-6 ">
                                <div class="quantity-selector ">
                                    <button class="quantity-btn decrease-btn product-decrement">-</button>
                                    <input type="" class="quantity-input  product-qty" id="quantity" min="1"
                                        max="100" data-rowid="{{ $item->rowId }}" value="{{ $item->qty }}"
                                        readonly>
                                    <button class="quantity-btn increase-btn product-increment">+</button>
                                </div>
                            </div>

                            <div class="cart__price col-6">
                                <span>{{ $item->price }} LE</span>
                            </div>
                        </div>

                    </div>
                    <hr class="my-4">
                </div>
            @endforeach
            @if (count($cartItems) == 0)
                <div class="mt-5">
                    <h4 class="text-uppercase text-center ">your cart is empty!</h4>
                </div>
                <div class="mt-4 ">
                    <a href="{{ url('/') }}" class="cart__button mt-4">Continue Shopping</a>
                </div>
            @else
                <div class="mx-4 mt-4">
                    <div class="d-flex justify-content-between ">
                        <span class="cart__price">SUBTOTAL</span>
                        <span class="cart__price" id="sub_total">{{ getCartSubTotal() }} LE</span>
                    </div>
                </div>
                <div class="mt-3 text-center  ">
                    <span>Tax included and shipping calculated at checkout</span>
                </div>
                <div class="mt-4 ">
                    <a href="{{ route('checkout') }}" class="cart__button">process to checkout</a>
                </div>
                <div class="mt-4 ">
                    <a href="{{ url('/') }}" class="cart__button">Continue Shopping</a>
                </div>
            @endif
            <div class="mt-5">
                <hr class=" hr--small ">
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

            // product quantity increment
            $('.product-increment').on('click', function(event) {
                event.preventDefault();
                let input = $(this).siblings('.product-qty');
                let quantity = parseInt(input.val()) + 1;
                let rowId = input.data('rowid');
                input.val(quantity);

                $.ajax({
                    url: "{{ route('cart.update-quantity') }}",
                    method: 'POST',
                    data: {
                        rowId: rowId,
                        quantity: quantity
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            renderCartSubTotal();
                            location.reload();
                        } else if (data.status == 'stock_out') {
                            toastr.error(data.message)
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

            // product quantity decrement
            $('.product-decrement').on('click', function(event) {
                event.preventDefault();
                let input = $(this).siblings('.product-qty');
                let quantity = parseInt(input.val()) - 1;
                let rowId = input.data('rowid');

                if (quantity < 1) {
                    quantity = 1;
                }
                input.val(quantity);
                $.ajax({
                    url: "{{ route('cart.update-quantity') }}",
                    method: 'POST',
                    data: {
                        rowId: rowId,
                        quantity: quantity
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            renderCartSubTotal();
                            location.reload();
                        } else if (data.status == 'stock_out') {
                            toastr.error(data.message)
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

            // get total cart subtotal
            // this function will only return flat value
            function renderCartSubTotal() {
                $.ajax({
                    method: 'GET',
                    url: "{{ route('cart.product-total') }}",
                    success: function(data) {
                        $('#sub_total').text(data + "LE");
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

            $('.clear_cart').on('click', function(event) {
                event.preventDefault();

                $.ajax({
                    type: 'get',
                    url: "{{ route('cart.clear-cart') }}",
                    success: function(data) {
                        if (data.status == 'success') {
                            location.reload();
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
        })
    </script>
@endpush

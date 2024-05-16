@extends('frontend.layouts.master')

@section('content')
    <!------------------------------------------------------Start-singleproduct------------------------------------------------------->
    <div class="container ">
        <ul class="d-flex list-unstyled gap-2 align-items-center  text-capitalize  text-black-50">
            <li>
                <a href="{{ url('/') }}" class="text-decoration-none text-black-50 ">home</a>
            </li>
            <i class="fa-solid fa-angle-right"></i>
            <li>
                <a href="{{route('collections', ['category'=>$product->category->slug])}}" class="text-decoration-none text-black-50 ">{{ $product->category->name }}</a>
            </li>
            <i class="fa-solid fa-angle-right "></i>
            <li>
                <a href="javascript:;" class="text-decoration-none text-black-50 ">{{$product->name}}</a>
            </li>
        </ul>
        <div class="row">
            <div class="col-md-7">
                <div class="position-relative ">
                    <div class="single-product__card--size">
                        <div class=" ">
                            <img src="{{ asset($product->image) }}" alt="MainImg" id="singleproduct__MainImg"
                                class="img-fluid  ">
                        </div>
                        <div class="card__image-text">
                            <span>{{ checkProductType($product->product_type) }}</span>
                        </div>

                        <div class="d-flex justify-content-around  mt-4 ">
                            @foreach ($product->productImageGalleries as $img)
                                <div class=" singleproduct__smallImg--space ">
                                    <img src="{{ asset($img->image) }}" class="img-fluid singleproduct__smallImg"
                                        alt="singleproduct__secoundImg">
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-5 px-5 mt-sm-0 mt-5">
                <div class="product__info ">
                    <div>
                        <div class="mb-4">
                            <h4 class="text-capitalize ">{{ $product->name }}</h4>
                        </div>
                        <p class=" product__info-paragrhph"> {!! $product->short_description !!}</p>
                    </div>
                    <hr>
                    <div class="product__info-details my-4 ">
                        <p>SKU : {{ $product->sku }} </p>
                        <p>Availability : in stock ({{ $product->quantity }})</p>
                        <p>product category : {{ $product->category->name }}</p>
                    </div>
                    <hr>
                    <div class="mt-4 mb-2 product--info__price">
                        <p>Price: <span class="price__product">{{ $product->price }} LE</span></p>
                    </div>
                    <form class="shopping-cart-form">
                        <div class="singleProduct__size ">
                            @foreach ($product->variants as $variant)
                                @if ($variant->status !== 0)
                                    <p>Size: <strong class="main--size text-uppercase " id="selected-size"></strong></p>
                                    <div class=" d-flex gap-2 size--text" id="selected_variant">
                                        @foreach ($variant->productVariantItem as $variantItem)
                                            <span class="size_se "
                                                data-variant="{{ $variantItem->name }}">{{ $variantItem->name }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <hr>
                        <div class="d-flex mb-2 justify-content-between align-items-center product--centerThereeItem">
                            <input type="hidden" name="variant_name" id="variant_name" value="">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <div class="quantity-selector mb-3 mb-sm-0">
                                <span class="quantity-btn decrease-btn">-</span>
                                <input type="text" class="quantity-input" id="quantity" value="1" min="1"
                                    max="100" name="quantity">
                                <span class="quantity-btn increase-btn">+</span>
                            </div>

                            <div class="button-addtocard ">
                                <button href="" class="button__product-add" id="event_not_change" id="cart-count">add to
                                    card</button>
                            </div>
                    </form>
                    <div class="add_to_wishlist wishlist__icon" data-id="{{ $product->id }}">
                        <button><li class="fa-regular fa-heart icon__single-product-heart "></li></button>
                    </div>
                </div>
                <form action="{{ route('checkout.buyNow', $product->id) }}" method="GET">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="variant_id" id="variant_size" value="">
                    <div class="mb-5 animate__animated animate__slower  animate__infinite animate__shakeX">
                        <button href="" class="button__product-buy ">buy it now</button>
                    </div>
                </form>


                <div class="mb-3 ">
                    <div class="d-flex flex-row align-items-center ">
                        <i class="fa-regular fa-heart "></i>
                        <span class=" ms-3 span__singleproduct-shipping ">Fast Shipping</span>
                    </div>
                    <span class="text-black-50 span__singleproduct-shipping ">Fast shipping on all orders</span>
                </div>

                <div>
                    <div class="d-flex flex-row align-items-center ">
                        <i class="fa-regular fa-heart "></i>
                        <span class=" ms-3 span__singleproduct-shipping ">Easy Returns</span>
                    </div>
                    <span class="text-black-50 span__singleproduct-shipping ">Return Policy</span>
                </div>
            </div>

        </div>
    </div>
    <div class="mt-5">
        <hr class=" hr--small ">
    </div>
    <!------------------------------------------------------End-singleproduct------------------------------------------------------->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });



            $('#selected-size').text('');

            $('.size_se').on('click', function() {
                var variantName = $(this).data('variant');
                $('#selected-size').text(variantName);

                $('#variant_name').val(variantName);
                $('#variant_size').val(variantName);
            });

            // add product into cart
            $('.shopping-cart-form').on('submit', function(event) {
                event.preventDefault();
                let formData = $(this).serialize();
                $.ajax({
                    method: 'POST',
                    data: formData,
                    url: "{{ route('add-to-cart') }}",
                    success: function(data) {
                        if (data.status == 'success') {
                            getCartCount();
                            toastr.success(data.message);
                        } else if (data.status == 'stock_out') {
                            toastr.error(data.message);
                        }
                    },
                    error: function(data) {

                    }
                })
            })

            function getCartCount() {
                $.ajax({
                    method: 'GET',
                    url: "{{ route('cart.cart-count') }}",
                    success: function(data) {
                        $('#cart-count').text(data);
                    },
                    error: function(data) {

                    }
                })
            }


            $('.quantity-btn').on('click', function() {
                var input = $(this).siblings('.quantity-input');
                var value = parseInt(input.val());

                if ($(this).hasClass('increase-btn')) {
                    value++;
                } else if ($(this).hasClass('decrease-btn') && value > 1) {
                    value--;
                }

                input.val(value);
            });
        });
    </script>
@endpush

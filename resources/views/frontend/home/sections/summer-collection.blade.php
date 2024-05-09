<section class="bg-light " id="summer-collection">
    <div class="container ">
        <div class="collection text-center pt-5 pb-3">
            <h5 class="collection__text text-black-50 ">new collection</h5>
            <h1 class="collection__text--main">{{ $homePageTitles->products_title }}</h1>
        </div>

        <div class="row mt-3 ">
            @foreach ($products as $product)
                <div class="col-lg-3 col-6 col-md-4  product__full-card">
                    <form class="shopping-cart-form">
                        <div class="card__product position-relative ">
                            <a href="{{ route('product-detail', $product->slug) }}" class="d-inline-block w-100 h-100 ">
                                <img src="{{ $product->image }}" class="card__product--main-image img-fluid "
                                    alt="product-1 model from front">
                                <img src="@if (isset($product->productImageGalleries[0]->image)) {{ asset($product->productImageGalleries[0]->image) }} @else {{ asset($product->image) }} @endif "class="card__product--hovered-image img-fluid "
                                    alt="product-1 model from back">
                            </a>
                            <!--wishlist-->
                            <div class="card__icon add_to_wishlist" data-id="{{ $product->id }}">
                                <i class="fa-solid fa-heart card__icon--red" ></i>
                            </div>

                            <div class="card__image-text  ">
                                <span>{{ checkProductType($product->product_type) }}</span>
                            </div>

                             {{-- <div class="card__button">
                                <button class=" card__button--size quickAddButton">quick add</button>
                                <div class="bg-light card__product--size ">
                                    <div class="btn__close">
                                        <i class="fa-solid fa-xmark "></i>
                                    </div>
                                    <span class="card__product-header--size ">Size: <span
                                            class="text-uppercase product--size ">sm</span></span>
                                     <div class="d-flex justify-content-evenly text-uppercase product__spans--size ">
                                        @foreach ($product->variants as $variant)
                                            @foreach ($variant->productVariantItem as $variantItem)
                                                 <span class="position-relative card__product--typeof-size"
                                                    value="{{ $variantItem->id }}">{{ $variantItem->is_default == 1 ? $variantItem->name : '' }}</span>
                                                <span class="position-relative "
                                                    value="{{ $variantItem->id }}">{{ $variantItem->status == 1 ? $variantItem->name : '' }}</span>
                                            @endforeach
                                        @endforeach
                                    </div>
                                </div>
                            </div> --}}

                        </div>
                        <div class="card__text ">
                            <a class="text-black-50 card__paragraph "
                                href="{{ route('product-detail', $product->slug) }}">{{ $product->name }}</a>
                            @if (checkDiscount($product))
                                <p class=" card__paragraph--price "><span
                                        class="act__price">{{ $product->offer_price }} LE</span><del>LE
                                        {{ $product->price }}</del></p>
                            @else
                                <p class=" card__paragraph--price "> <span
                                        class="act__price">{{ $product->price }} LE</span></p>
                            @endif
                        </div>
                    </form>
                </div>
            @endforeach
        </div>

        <div class=" button__card__showmore ">
            <p>show more</p>
        </div>
    </div>
</section>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.add_to_wishlist').on('click', function(event) {
                event.preventDefault();
                let id = $(this).data('id');

                $.ajax({
                    method: 'GET',
                    url: "{{ route('wishlist.store') }}",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            getWislistCount();
                            toastr.success(data.message);
                        } else if (data.status == 'error') {
                            toastr.error(data.message);
                        }
                    },
                    error: function(data) {
                        console.log(data);
                    }
                })
            })
            function getWislistCount() {
                $.ajax({
                    method: 'GET',
                    url: "{{ route('wishlist-count') }}",
                    success: function(data) {
                        $('#wishlist_count').text(data);
                    },
                    error: function(data) {

                    }
                })
            }
        })
    </script>
@endpush

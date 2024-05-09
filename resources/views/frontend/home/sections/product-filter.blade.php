<!------------------------------------------------------Start-Product_filter------------------------------------------------------->
<section class="mt-4 mb-5 bg-light overflow-hidden ">
    <h2 class="text-uppercase text-center mt-4 fw-bolder ">{{ $homePageTitles->categories_title }}</h2>

    <div class="mt-4 mb-5">
        <ul class=" product__ul--filter list-unstyled d-flex justify-content-center align-items-center gap-2 " id="filter-buttons">
            @foreach ($categories as $key => $category)
                @if ($category)
                    <li data-filter=".category-{{$key}}">
                        <button class="product--filter {{ $loop->index == 0 ? 'active' : '' }}" data-filter="category-{{$key}}">{{ $category->name }}</button>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>

    <div class="container">
        <div class="row mt-3" id="filterable-cards">
            @foreach ($categories as $key => $category)
                @foreach ($category->product->take(4) as $item)
                    <div class="col-lg-3 col-6 col-md-4 product__full-card cardd" data-name="category-{{ $key }}">
                        <div class="card__product position-relative ">
                            <a href="{{ route('product-detail', $item->slug) }}" class="d-inline-block w-100 h-100 ">
                                <img src="{{ $item->image }}" class="card__product--main-image img-fluid "
                                    alt="product-1 model from front">
                                <img src="@if (isset($item->productImageGalleries[0]->image)) {{ asset($item->productImageGalleries[0]->image) }} @else {{ asset($item->image) }} @endif "class="card__product--hovered-image img-fluid "
                                    alt="product-1 model from back">
                            </a>
                            <div class="card__icon ">
                                <i class="fa-solid fa-heart card__icon--red add_to_wishlist " data-id="{{$item->id}}"></i>
                            </div>

                            <div class="card__image-text ">
                                <span>{{ checkProductType($item->product_type) }}</span>
                            </div>
                            <div class="card__button ">
                                <button class=" card__button--size ">quick add</button>
                                {{-- <div class="bg-light card__product--size ">
                                    <div class="btn__close ">
                                        <i class="fa-solid fa-xmark "></i>
                                    </div>
                                    <span class="card__product-header--size ">Size: <span
                                            class="text-uppercase product--size " id="selected-size">sm</span></span>
                                    <div class="d-flex justify-content-evenly text-uppercase product__spans--size ">
                                        @foreach ($item->variants as $variant)
                                            @foreach ($variant->productVariantItem as $variantItem)
                                                <span class="position-relative card__product--typeof-size "
                                                    value="{{ $variantItem->id }}">{{ $variantItem->is_default == 1 ? $variantItem->name : '' }}</span>
                                                <span class="position-relative "
                                                    value="{{ $variantItem->id }}">{{ $variantItem->status == 1 && $variantItem->is_default == 0 ? $variantItem->name : '' }}</span>
                                            @endforeach
                                        @endforeach
                                    </div>
                                </div> --}}
                            </div>
                        </div>


                        <div class="card__text ">
                            <a class="text-black-50 card__paragraph "
                                href="{{ route('product-detail', $item->slug) }}">{{ $item->name }}</a>
                            @if (checkDiscount($item))
                                <p class=" card__paragraph--price ">LE <span
                                        class="act__price">{{ $item->offer_price }}</span><del>LE
                                        {{ $item->price }}</del></p>
                            @else
                                <p class=" card__paragraph--price ">LE <span
                                        class="act__price">{{ $item->price }}</span></p>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>

</section>
<!------------------------------------------------------End-Product_filter------------------------------------------------------->

@push('scripts')
@endpush

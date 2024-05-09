@extends('frontend.layouts.master')

@section('content')

<section class="mt-3 cart allcart__size">
    <div class="container">


        <div>
            <ul class="d-flex list-unstyled gap-2 align-items-center  text-capitalize  text-black-50">
                <li>
                    <a href="{{url('/')}}" class="text-decoration-none text-black-50 ">home</a>
                </li>
                <i class="fa-solid fa-angle-right"></i>
                <li>
                    <a href="javascript:;" class="text-decoration-none text-black-50 text-capitalize ">{{$category->name}}</a>
                </li>

            </ul>
        </div>
        <div class="mt-5">
            <h4 class="text-uppercase text-center ">{{$category->name}}</h4>
            <hr class=" hr--small ">
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
                            <div class="card__icon add_to_wishlist">
                                <i class="fa-solid fa-heart card__icon--red "
                                    data-id="{{ $product->id }}"></i>
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
                                                {{-- <span class="position-relative card__product--typeof-size"
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
                                <p class=" card__paragraph--price ">LE <span
                                        class="act__price">{{ $product->offer_price }}</span><del>LE
                                        {{ $product->price }}</del></p>
                            @else
                                <p class=" card__paragraph--price ">LE <span
                                        class="act__price">{{ $product->price }}</span></p>
                            @endif
                        </div>
                    </form>
                </div>
            @endforeach
        </div>

        <div class="mt-5">
            <hr class=" hr--small ">
        </div>

    </div>
</section>


@endsection

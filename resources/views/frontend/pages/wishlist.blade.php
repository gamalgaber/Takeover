@extends('frontend.layouts.master')

@section('content')
<section class="mt-3 cart allwishlist__size">
    <div class="container">


        <div>
            <ul class="d-flex list-unstyled gap-2 align-items-center  text-capitalize  text-black-50">
                <li>
                    <a href="{{url('/')}}" class="text-decoration-none text-black-50 ">home</a>
                </li>
                <i class="fa-solid fa-angle-right"></i>
                <li>
                    <a href="javascript:;" class="text-decoration-none text-black-50 text-capitalize ">your wishlist</a>
                </li>

            </ul>
        </div>


        <div class="mt-6">
            <h4 class="text-uppercase text-center ">your wishlist</h4>
            <hr class=" hr--small ">
        </div>


        <div class="d-none d-sm-block text-uppercase product--textinfo mt-5">
            <div class="d-flex  flex-row justify-content-between  ">
                <div>
                    <p class="fs-4">product</p>
                </div>
                <div class="d-flex wishlist__info--gap">
                    <p class="fs-4">Unit price</p>
                    <p class="fs-4">Stock</p>
                </div>
            </div>
            <hr>
        </div>


        @foreach ($wishlistProducts as $wishlistProduct)
        <div>
            <div class="row">
                <div class="col-6 col-md-3">
                    <div class="cart__image">
                        <img src="{{asset($wishlistProduct->product->image)}}" alt="">
                    </div>
                </div>

                <div class="col-6 col-md-4">
                    <div class="d-flex flex-column ">
                        <span class="cart__info">{{$wishlistProduct->product->name}}</span>
                        <a class="mt-2 text-black-50 cart__text--none" href="{{route('wishlist.destroy', $wishlistProduct->id)}}">Remove</a>
                        <a class="mt-2 text-black-50 cart__text--none" href="{{route('product-detail', $wishlistProduct->product->slug)}}">View Product</a>
                    </div>
                </div>


                <div class="flex__mobile  mt-4 mt-sm-0 col-md-5 d-flex align-items-center ">
                    <div class="cart__price col-6 d-flex justify-content-center">
                        <span>{{$wishlistProduct->product->price}} LE</span>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                            <span class="cart__info">{{$wishlistProduct->product->quantity > 0 ? 'in stock' : 'out of stock'}}</span>
                    </div>
                </div>
            </div>
            <hr class="my-4">
        </div>
        @endforeach
        @if(count($wishlistProducts) == 0)
        <div class="mt-5">
            <h4 class="text-uppercase text-center ">your Wishlist is empty!</h4>
        </div>
        <div class="mt-4 ">
            <a href="{{ url('/') }}" class="cart__button mt-4">Continue Shopping</a>
        </div>
        <div class="mt-5">
            <hr class=" hr--small ">
        </div>
        @else
        <div class="mt-4 ">
            <a href="{{url('/')}}" class="cart__button">Continue Shopping</a>
        </div>

        <div class="mt-5">
            <hr class=" hr--small ">
        </div>
        @endif
    </div>
</section>
@endsection

@push('scripts')

@endpush

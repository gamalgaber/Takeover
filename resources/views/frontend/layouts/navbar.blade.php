<nav class="navbar navbar-expand-lg navbar-light text-uppercase aa px-0 py-2 px-sm-0 py-sm-1 pb-md-3 pb-sm-3 ">
    <div class="container ">
        <button class="navbar-toggler shadow-none border-0  " type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div>
            <a class="navbar-brand fs-3  " href="{{ url('/') }}">
                <img src="{{ asset('Frontend/assets/images/logo/DONT BE BITCH Y2K - Copy.png') }}" style="width:200px; height:95px;"
                    class="logo" alt="">
            </a>
        </div>
        <div class="d-lg-none icon__position-ipad">
            <a href="{{ route('cart') }}">
                <i class="fa-solid fa-cart-shopping  nav__icon--color"></i>
                <span class="icon__span--position" id="cart-count">{{ Cart::content()->count() }}</span>
            </a>
        </div>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
            aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <h4 class="offcanvas-title lh-sm  " id="offcanvasExampleLabel">MENU</h4>
                <button type="button" class="btn-close text-reset shadow-none   " data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="ms-auto ">
                    <ul class="navbar-nav  ">
                        <li class="nav-item nav__item--hr-mobile border-bot-g">
                            <a class="nav-link  " href="{{url('/')}}">Home</a>
                        </li>


                        <li class="nav-item ">
                            <div
                                class="d-flex align-items-center  justify-content-between py-2 toggle-header border-bot-g">
                                <div>
                                    <a class="nav-link" href="#summer-collection">Summer Collection</a>
                                </div>
                                <div>
                                    <i class="fa-solid fa-plus"></i>
                                </div>
                            </div>
                            <ul class="list-unstyled ms-1 toggle-content menu mt-2">
                                @php
                                    $categories = App\Models\Category::where('status', 1)->get();
                                @endphp
                                @foreach ($categories as $category)
                                <li class="mb-2">
                                    <a href="{{route('collections', ['category'=>$category->slug])}}" class="text-decoration-none text__color--black">{{$category->name}}</a>
                                </li>
                                @endforeach
                                <div class="border-bot-t"></div>
                            </ul>
                        </li>


                        </li>
                        <li class="nav-item nav__item--hr-mobile border-bot-g">
                            <a class="nav-link" href="{{route('contact')}}">Contact</a>
                        </li>
                        <div class=" mt-3 n">
                            <a href="{{route('wishlist.index')}}" class=" text-decoration-none ">
                                <i class=" fa-regular fa-heart fs-3 me-2 nav__icon--color "></i>
                                <span class="text-capitalize  nav__icon--color fs-6">my wish list</span>
                            </a>
                        </div>
                        <div class="icon mt-3 ">
                            @if(auth()->check())
                                @if (auth()->user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class=" text-decoration-none ">
                                    <i class="fa-regular fa-user fs-3 me-2 nav__icon--color "></i>
                                    <span class="text-capitalize  nav__icon--color fs-6 ">Admin Dashboard</span>
                                </a>
                                @elseif (auth()->user()->role === 'user')
                                <a href="{{route('logout')}}" class=" text-decoration-none ">
                                    <i class="fa-regular fa-user fs-3 me-2 nav__icon--color "></i>
                                    <span class="text-capitalize  nav__icon--color fs-6 ">Logout</span>
                                </a>
                                @endif
                            @else
                            <a href="{{ route('login') }}" class=" text-decoration-none ">
                                <i class="fa-regular fa-user fs-3 me-2 nav__icon--color "></i>
                                <span class="text-capitalize  nav__icon--color fs-6 ">Login</span>
                            </a>
                            @endif
                        </div>
                    </ul>
                </div>
            </div>
        </div>
        <div class=" collapse navbar-collapse " id="navbarNav ">
            <div class="ms-auto fs-5 ">
                <ul class="navbar-nav gap-3 ">
                    <li class="nav-item ">
                        <a class="nav-link " aria-current="page " href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link " href="#summer-collection">Summer collection</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link " href="{{ route('contact') }}">Contact</a>
                    </li>
                </ul>
            </div>
            <div class="ms-auto d-flex gap-4 align-items-center ">
                <div class="icon position-relative ">
                    <a href="{{route('wishlist.index')}}">
                        <i class="fa-regular fa-heart fs-4 nav__icon--color "></i>
                        <span class="icon__span--position text-black " id="wishlist_count">{{App\Models\Wishlist::count()}}</span>
                    </a>
                </div>
                <div class="icon position-relative ">
                    <a href="{{ route('cart') }}" class=" ">
                        <i class="fa-solid fa-cart-shopping fs-4 nav__icon--color "></i>
                        <span class="icon__span--position text-black " id="cart-count">{{ Cart::content()->count() }}</span>
                    </a>
                </div>
                <div class="icon ">
                    @if (auth()->check())
                        @if (auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}"><i class="fa-regular fa-user fs-4 nav__icon--color "></i></a>
                        @elseif (auth()->user()->role === 'user')
                            <a href="" class=" ">
                                <i class="fa-regular fa-user fs-4 nav__icon--color "></i>
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class=" ">
                            <i class="fa-regular fa-user fs-4 nav__icon--color "></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</nav>


@push('scripts')

<script>
    $(document).ready(function() {
        $('a[href^="#"]').on('click', function(event) {
            var target = $(this.getAttribute('href'));
            if( target.length ) {
                event.preventDefault();
                $('html, body').stop().animate({
                    scrollTop: target.offset().top
                }, 1000);
            }
        });
    });
</script>

@endpush

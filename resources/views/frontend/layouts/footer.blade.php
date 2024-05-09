<footer class="mt-5">
    <div class="container">
        <div class="row ">
            <div class="col-md-4 col-12 ">
                <div class="mb-md-0 mb-4 ">
                    <div class="mb-4 ">
                        <a class="navbar-brand fs-3 " href="javascript:;">
                            <img src="{{ asset('Frontend/assets/images/logo/DONT BE BITCH Y2K - Copy.png') }}"
                                width="155px" class=" logo " alt=" ">
                        </a>
                    </div>
                    <p class="footer__textinfo "><b>Email: </b>ghonimygroup@gmail.com</p>
                    <p class="footer__textinfo "><b>call us: </b>+20 112 296 9833</p>
                    <div class="d-flex flex-row mt-md-4 mt-0 ">
                        <div>
                            <a href="https://www.instagram.com/takeover_brand1?igsh=czQ4NTQ5aDF5eXB6 " target="_blank ">
                                <i class="fa-brands fa-instagram footer__icon "></i>
                            </a>
                        </div>
                        <div>
                            <a href="https://www.facebook.com/share/mzBYdWcX3upf9DvX/?mibextid=qi2Omg "
                                target="_blank ">
                                <i class="fa-brands fa-facebook footer__icon "></i>
                            </a>
                        </div>
                        <div>
                            <a href="https://vm.tiktok.com/ZMMCvycEE/ " target="_blank ">
                                <i class="fa-brands fa-tiktok footer__icon "></i> </a>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-4 col-12 ">
                <div class="footer__text mb-md-0 mb-4 ">
                    <h6>catagories</h6>
                    <ul class="list-unstyled ">
                        @foreach ($categories as $category)
                        <li>
                            <a href="{{route('collections', ['category'=>$category->slug])}}" class="footer__link--underline ">{{$category->name}}</a> </li>
                        <li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-md-4 col-12 ">
                <div class="footer__text ">
                    <h6>information</h6>
                    <ul class="list-unstyled ">
                        <li>
                            <a href="{{ url('/') }}" class="footer__link--underline ">home</a>
                        </li>
                        <li>
                            <a href="{{ route('contact') }}" class="footer__link--underline ">contact us</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footer_bottom">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="copyright_footer d-flex justify-content-center">
                        <p class="text-center">Copyright © 2024 Takeover. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

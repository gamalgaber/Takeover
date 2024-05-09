<header class="">
    <nav class="navbar navbar-expand   my-nav container-fluid">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li>
                        <a class="fs-2 fw-bold sidebar_header object-cover img-fluid" href="{{url('/')}}"><img src="{{asset('Login-form/assets/images/DONT BE BITCH Y2K.png')}}" width="160px" height="97px" alt=""></a>
                    </li>
                    <li class="nav-item dropdown my-drop">
                        <div class=" img-fluid">
                            <img src="{{ asset(auth()->user()->image) }}" alt="" width="50rem" height="50rem"
                                class="rounded-5 img-fluid">
                        </div>
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <div class="my-text">
                            Hi,{{ auth()->user()->name }}
                        </div>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.profile') }}">Proile</a></li>

                            <!--Logout-->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <li><a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                            this.closest('form').submit();"
                                        class="dropdown-item">Logout</a></li>
                            </form>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

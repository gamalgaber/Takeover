<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('Login-form/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('Login-form/vendors/bootstrap.min.css') }}">
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <title>Login</title>
</head>

<body class=" bg">


    <section class="contaainer forms">

        <!-- Login Form -->
        <div class="form login  p-3 m-0 mx-auto my-auto">
            <div class="form-content">


                    <img src="{{asset('Login-form/assets/images/DONT BE BITCH Y2K.png')}}" alt="" class="w-25 h-25 rounded-3">


                <header>Login</header>

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <!-- Email Address -->
                    <div class="field input-field">
                        <input type="email" placeholder="Email" class="input" name="email" id="email"
                            value="{{ old('email') }}" required>
                    </div>

                    <!-- Password -->
                    <div class="field input-field">
                        <input placeholder="Password" class="password" type="password" name="password" required
                            id="password">
                        <i class='bx bx-hide eye-icon'></i>
                    </div>

                    <!-- Remember Me -->
                    <div class="form-link">
                        <div class=" d-flex justify-start gap-2 ">
                            <input class="" type="checkbox" id="remebmer_me" name="remember" class="rounded">
                            <label class="" for="remember-me">Remember me</label>
                        </div>
                        <a href="{{route('password.request')}}" class="forgot-pass">Forgot password?</a>
                    </div>

                    <div class="field button-field">
                        <button type="submit">Login</button>
                    </div>

                </form>
                <div class="form-link">
                    <span>Already have an account?<a href="#" class="link signup-link">Signup</a></span>
                </div>
            </div>

            <div class="line"></div>

            <div class="media-options">
                <a href="{{route('socialite.redirect', 'facebook')}}" class="field facebook">
                    <i class='bx bxl-facebook facebook-icon'></i>
                    <span>Login with Facebook</span>
                </a>
            </div>

            <div class="media-options">
                <a href="{{route('socialite.redirect', 'google')}}" class="field google">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="48px" height="48px">
                        <path fill="#FFC107"
                            d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z" />
                        <path fill="#FF3D00"
                            d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z" />
                        <path fill="#4CAF50"
                            d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z" />
                        <path fill="#1976D2"
                            d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z" />
                    </svg>
                    <span>Login with Google</span>
                </a>
            </div>
        </div>

        <!-- SignUp Form -->

        <div class="form signup p-3 m-0 mx-auto my-auto ">
            <div class="form-content">
                <img src="{{asset('login-form/assets/images/DONT BE BITCH Y2K.png')}}" alt="" class="w-25 h-25 rounded-3 ">
                <header>Signup</header>

                <form method="POST" action="{{route('register')}}">
                    @csrf
                    <!-- Name -->
                    <div class="field input-field">
                        <input id="name" name="name" value="{{old('name')}}" type="text" placeholder="Name">
                    </div>

                    <!-- Email -->
                    <div class="field input-field">
                        <input type="email" placeholder="Email" class="input" id="email" name="email" value="{{old('email')}}">
                    </div>

                    <!-- Password -->
                    <div class="field input-field">
                        <input type="password" placeholder="Password" class="password" id="password" name="password">
                    </div>

                    <!-- Conifrm Password -->
                    <div class="field input-field">
                        <input type="password" class="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                        <i class='bx bx-hide eye-icon'></i>
                    </div>

                    <div class="field button-field">
                        <button type="submit">Signup</button>
                    </div>
                </form>
                <div class="form-link">
                    <span>Already have an account?<a href="#" class="link login-link">Login</a></span>
                </div>
            </div>

            {{-- <div class="line"></div> --}}

            {{-- <div class="media-options">
                <a href="{{route('socialite.redirect', 'facebook')}}" class="field facebook">
                    <i class='bx bxl-facebook facebook-icon'></i>
                    <span>Signup with Facebook</span>
                </a>
            </div>

            <div class="media-options">
                <a href="{{route('socialite.redirect', 'google')}}" class="field google">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="48px" height="48px">
                        <path fill="#FFC107"
                            d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z" />
                        <path fill="#FF3D00"
                            d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z" />
                        <path fill="#4CAF50"
                            d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z" />
                        <path fill="#1976D2"
                            d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z" />
                    </svg>
                    <span>Signup with Google</span>
                </a>
            </div> --}}
        </div>
    </section>


    <script src="{{ asset('Login-form/assets/js/script.js') }}"></script>
    <script src="{{ asset('Login-form/vendors/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                // Display an info toast with no title
                toastr.error("{{ $error }}")
            @endforeach
        @endif
    </script>
</body>

</html>

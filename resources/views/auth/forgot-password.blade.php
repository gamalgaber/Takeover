{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('Login-form/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('Login-form/vendors/bootstrap.min.css') }}">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <title>Forgot Password</title>
</head>

<body class=" bg">
    <section class="contaainer forms">
        <div class="form login  p-5 m-0 mx-auto my-auto">
            <div class="form-content">
                <img src="{{ asset('login-form/assets/images/DONT BE BITCH Y2K.png') }}" alt=""
                    class="w-25 h-25 rounded-3'">
                <p class=" fs-6 text-black-50 pt-2">Forgot your password? No problem. Just let us know your email
                    address and we will email you a password reset link that will allow you to choose a new one.</p>
                <form action="{{ route('password.email') }}" method="POST">
                    @csrf
                    <div class="field input-field">
                        <input id="email" type="email" name="email" value="{{old('email')}}" placeholder="Your Email" class="input">
                    </div>
                    <div class="field button-field  mx-auto">
                        <button class=" text-white text-nowrap">Email Password Reset Link</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script src="{{ asset('Login-form/assets/js/script.js') }}"></script>
    <script src="{{ asset('Login-form/vendors/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</body>

</html>

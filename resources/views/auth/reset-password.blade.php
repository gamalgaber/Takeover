{{-- <x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
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
    <title>Document</title>
</head>

<body class=" bg">


    <section class="contaainer forms">

        <!-- Login Form -->
        <div class="form login  p-5 m-0 mx-auto my-auto">
            <div class="form-content">
                <img src="{{ asset('Login-form/assets/images/DONT BE BITCH Y2K.png') }}" alt=""
                    class="w-25 h-25 rounded-3">
                <form method="POST" action="{{ route('password.store') }}">
                    @csrf
                    <h4 class="text-center">Reset Password</h4>
                    <input type="hidden" name="token" value="{{ old($request->route('token')) }}">
                    <div class="field input-field">
                        <input type="email" placeholder="email" class="input" name="email"
                            value="{{ old('email', $request->email) }}">
                    </div>
                    <div class="field input-field">
                        <input type="password" placeholder="enter new password" id="password" name="password"
                            class="input" required>
                    </div>
                    <div class="field input-field">
                        <input type="password" placeholder="Confirm Password" class="input"
                            name="password_confirmation" id="password_confirmation" required>
                    </div>
                    <div class="field button-field">
                        <button>Save</button>
                    </div>
                </form>
            </div>
        </div>
    </section>


    <script src="{{ asset('Login-form/assets/js/script.js') }}"></script>
    <script src="{{ asset('Login-form/vendors/bootstrap.min.js') }}"></script>
</body>

</html>

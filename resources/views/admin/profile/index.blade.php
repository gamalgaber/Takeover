@extends('admin.layouts.master')
@section('content')
    <div class=" container py-3 px-3">
        <div class="row d-flex flex-column bg-white col-10 col-md-12 p-3  bg-opacity-75 shadow-lg">
            <h2>Update Profile</h2>
            <form method="POST" class="needs-validation" action=" {{ route('admin.profile.update') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="prodcut_input d-flex flex-column">
                    <div class="mb-3">
                        <img width="100px" src="{{ asset(Auth::user()->image) }}" alt="">
                    </div>
                    <div>
                        <label for="">Profile Photo:</label>
                        <input type="file" name="image" id="" value="{{ Auth::user()->image }}">
                    </div>
                    <div>
                        <label for="">Name:</label>
                        <input type="text" name="name" id="" value="{{ Auth::user()->name }}">
                    </div>
                    <div>
                        <label for="">Email:</label>
                        <input type="text" name="email" id="" value="{{ Auth::user()->email }}">
                    </div>
                    <div class="pt-3">
                        <button class="btn my_btn " id="create_btn">Save</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="row d-flex flex-column bg-white col-10 col-md-12 p-3  bg-opacity-75 shadow-lg mt-3">
            <h2>Update Password</h2>
            <form method="POST" class="needs-validation" novalidate="" action="{{ route('admin.password.update') }}">
                @csrf
                @method('PUT')
                <div class="prodcut_input d-flex flex-column">
                    <div>
                        <label for="">Current Password:</label>
                        <input type="password" name="current_password" id="">
                    </div>
                    <div>
                        <label for="">New Password:</label>
                        <input type="password" name="password" id="">
                    </div>
                    <div>
                        <label for="">Confirm Password:</label>
                        <input type="password" name="password_confirmation" id="">
                    </div>
                    <div class="pt-3">
                        <button class="btn my_btn " id="create_btn">Update</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection

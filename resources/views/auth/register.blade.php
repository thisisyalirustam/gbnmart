{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

@extends('website.layout.content')
@section('webcontent')
<style>
   .demo{ background: #F2F2F2; }
.form-container{
    background: #ecf0f3;
    font-family: 'Nunito', sans-serif;
    padding: 40px;
    border-radius: 20px;
    box-shadow: 14px 14px 20px #cbced1, -14px -14px 20px white;
}
.form-container .form-icon{
    color: #33cc0d;
    font-size: 55px;
    text-align: center;
    line-height: 100px;
    width: 100px;
    height:100px;
    margin: 0 auto 15px;
    border-radius: 50px;
    box-shadow: 7px 7px 10px #cbced1, -7px -7px 10px #fff;
}
.form-container .title{
    color: #33cc0d;
    font-size: 25px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    text-align: center;
    margin: 0 0 20px;
}
.form-container .form-horizontal .form-group{ margin: 0 0 25px 0; }
.form-container .form-horizontal .form-group label{
    font-size: 15px;
    font-weight: 600;
    text-transform: uppercase;
}
.form-container .form-horizontal .form-control{
    color: #333;
    background: #ecf0f3;
    font-size: 15px;
    height: 50px;
    padding: 20px;
    letter-spacing: 1px;
    border: none;
    border-radius: 50px;
    box-shadow: inset 6px 6px 6px #cbced1, inset -6px -6px 6px #fff;
    display: inline-block;
    transition: all 0.3s ease 0s;
}
.form-container .form-horizontal .form-control:focus{
    box-shadow: inset 6px 6px 6px #cbced1, inset -6px -6px 6px #fff;
    outline: none;
}
.form-container .form-horizontal .form-control::placeholder{
    color: #808080;
    font-size: 14px;
}
.form-container .form-horizontal .btn{
    color: #000;
    background-color: #33cc0d;
    font-size: 15px;
    font-weight: bold;
    text-transform: uppercase;
    width: 100%;
    padding: 12px 15px 11px;
    border-radius: 20px;
    box-shadow: 6px 6px 6px #cbced1, -6px -6px 6px #fff;
    border: none;
    transition: all 0.5s ease 0s;
}
.form-container .form-horizontal .btn:hover,
.form-container .form-horizontal .btn:focus{
    color: #fff;
    letter-spacing: 3px;
    box-shadow: none;
    outline: none;
}
</style>

<div class="form-bg mt-4 mb-5" style="height: 110vh;">
    <div class="container">
        <div class="row">
            <div class="col-6 mx-auto col-md-offset-4">
                <div class="form-container">
                    <div class="form-icon"><i class="fa fa-user"></i></div>
                    <h3 class="title">Sign Up</h3>
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" type="text" id="name" name="name" placeholder="Enter your full name" value="{{ old('name') }}" required autofocus autocomplete="name">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" type="email" id="email" name="email" placeholder="Enter your email address" value="{{ old('email') }}" required autocomplete="email">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <label>Password</label>
                            <input class="form-control" type="password" id="password" name="password" placeholder="Create a password" required autocomplete="new-password">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required autocomplete="new-password">
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                                Already registered?
                            </a>
                        </div>
                        <button type="submit" class="btn btn-default">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

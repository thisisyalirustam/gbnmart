{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
@extends('website.layout.content')
@section('webcontent')
    {{-- <style>
        .demo {
            background: #F2F2F2;
        }

        .form-container {
            background: #ecf0f3;
            font-family: 'Nunito', sans-serif;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 14px 14px 20px #cbced1, -14px -14px 20px white;
        }

        .form-container .form-icon {
            color: #33cc0d;
            font-size: 55px;
            text-align: center;
            line-height: 100px;
            width: 100px;
            height: 100px;
            margin: 0 auto 15px;
            border-radius: 50px;
            box-shadow: 7px 7px 10px #cbced1, -7px -7px 10px #fff;
        }

        .form-container .title {
            color: #33cc0d;
            font-size: 25px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-align: center;
            margin: 0 0 20px;
        }

        .form-container .form-horizontal .form-group {
            margin: 0 0 25px 0;
        }

        .form-container .form-horizontal .form-group label {
            font-size: 15px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .form-container .form-horizontal .form-control {
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

        .form-container .form-horizontal .form-control:focus {
            box-shadow: inset 6px 6px 6px #cbced1, inset -6px -6px 6px #fff;
            outline: none;
        }

        .form-container .form-horizontal .form-control::placeholder {
            color: #808080;
            font-size: 14px;
        }

        .form-container .form-horizontal .btn {
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
        .form-container .form-horizontal .btn:focus {
            color: #fff;
            letter-spacing: 3px;
            box-shadow: none;
            outline: none;
        }
    </style> --}}

    {{-- <div class="form-bg mt-4" style="height: 100vh;">
        <div class="container">
            <div class="row">
                <div class="col-6 mx-auto col-md-offset-4">
                    <div class="form-container">
                        <div class="form-icon"><i class="fa fa-user"></i></div>
                        <h3 class="title">Login</h3>
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label>email</label>
                                <input class="form-control" id="email" type="email" placeholder="email address" name="email"
                                    :value="old('email') " required autofocus autocomplete="username">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <label>password</label>
                                <input class="form-control" type="password" id="password" name="password"
                                    placeholder="password" required autocomplete="current-password">
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                            <div class="block mt-4">
                                <label for="remember_me" class="inline-flex items-center">
                                    <input id="remember_me" type="checkbox"
                                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                        name="remember">
                                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                </label>
                            </div>
                            <div class="flex items-center justify-end mt-4 mb-2">
                                @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                    href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-default">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <main class="main">

        <!-- Page Title -->
        <div class="page-title light-background position-relative">
            <div class="container">
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="index.html">Home</a></li>
                        <li class="current">Login</li>
                    </ol>
                </nav>
                <h1>Login</h1>
            </div>
        </div><!-- End Page Title -->

        <!-- Login Section -->
        <section id="login" class="login section">
            <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-8 aos-init aos-animate" data-aos="zoom-in" data-aos-delay="200">
                        <div class="login-form-wrapper">
                            <div class="login-header text-center">
                                <h2>Login</h2>
                                <p>Welcome back! Please enter your details</p>
                            </div>

                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="mb-4">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Enter your email"
                                        required="" autocomplete="email" name="email" :value="old('email') " required
                                        autofocus autocomplete="username">
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <div class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <label for="password" class="form-label">Password</label>
                                        @if (Route::has('password.request'))

                                            <a href="{{ route('password.request') }}"
                                                class="forgot-link">{{ __('Forgot your password?') }}</a>
                                        @endif

                                    </div>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Enter your password" required="" autocomplete="current-password">
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                <div class="mb-4 form-check">
                                    <input type="checkbox" class="form-check-input" id="remember_me">
                                    <label class="form-check-label" for="remember_me">{{ __('Remember me') }}</label>
                                </div>

                                <div class="d-grid gap-2 mb-4">
                                    <button type="submit" class="btn btn-primary">Sign in</button>
                                    <button type="button" class="btn btn-outline">
                                        <i class="bi bi-google me-2"></i>Sign in with Google
                                    </button>
                                </div>

                                <div class="signup-link text-center">
                                    <span>Don't have an account?</span>
                                    @if (Route::has('register'))   
                                    <a href="{{ route('register') }}">Sign up for free</a>
                                    @endif
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /Login Section -->

    </main>

@endsection
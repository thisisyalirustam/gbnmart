
@extends('website.layout.content')
@section('webcontent')
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
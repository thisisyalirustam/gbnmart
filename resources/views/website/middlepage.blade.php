@extends('website.layout.content')
@section('webcontent')

<section class="checkout spad">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="border p-5 text-center rounded">
                    <h3 class="mb-4">Complete Your Purchase</h3>
                    <p class="mb-4 text-muted">
                        Choose how you’d like to proceed with your checkout. You can log in for a faster experience
                        or continue as a guest to complete your purchase without signing in.
                    </p>

                    <div class="row align-items-center">
                        <!-- Login Option -->
                        <div class="col-md-6 mb-4">
                            <div class="d-flex flex-column align-items-center">
                                <i class="icon-user fa-3x mb-3 text-primary"></i>
                                <h5>Login</h5>
                                <p class="text-muted">
                                    Access your account for a faster checkout process and to view your order history.
                                </p>
                                <a href="{{ route('login') }}" class="btn btn-primary mt-3">Login</a>
                            </div>
                        </div>

                        <!-- Guest Checkout Option -->
                        <div class="col-md-6 mb-4">
                            <div class="d-flex flex-column align-items-center">
                                <i class="icon-shopping-cart fa-3x mb-3 text-secondary"></i>
                                <h5>Buy as Guest</h5>
                                <p class="text-muted">
                                    No account? No problem! Proceed as a guest to quickly finalize your purchase.
                                </p>
                                <a href="{{ route('checkout.index') }}" class="btn btn-secondary mt-3">Buy as Guest</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="mt-5">
                    <h4>Why Create an Account?</h4>
                    <p class="text-muted">
                        Creating an account allows you to save your details for faster checkout next time.
                        You can also view your order history and track your purchases easily.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

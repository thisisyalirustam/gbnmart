@extends('website.layout.content')

@section('webcontent')

<style>
    /* Checkout Page Styling */
.checkout {
    background-color: #f9fafb;
    background-image: linear-gradient(to right, #d4edda, #ffffff); /* Light green gradient */
}

.checkout h3 {
    font-size: 2.25rem;
    color: #2c3e50;
    font-weight: 700;
}

.checkout p {
    font-size: 1.125rem;
    color: #7f8c8d;
    line-height: 1.5;
}

.card-box {
    border-radius: 8px;
    background-color: #ffffff;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.card-box:hover {
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
}

.btn {
    text-transform: uppercase;
    font-weight: bold;
    padding: 10px 30px;
    font-size: 1.1rem;
    transition: all 0.3s ease; /* Smooth transition for the button hover effect */
}

.btn-light {
    background-color: #577234;
    color: #28a745; /* Green text */
    border: 2px solid #28a745; /* Green border */
}

.btn-light:hover {
    background-color: #28a745; /* Green background */
    color: #ffffff; /* White text */
    transform: translateY(-5px); /* Push-up effect */
}

.btn-secondary {
    background-color: #6c757d;
    border: 2px solid #6c757d;
    color: #ffffff;
}

.btn-secondary:hover {
    background-color: #5a6268;
    border-color: #5a6268;
}

.hover-shadow:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.icon-user,
.icon-shopping-cart {
    color: #ffffff;
}

.font-weight-bold {
    font-weight: 700;
}

.text-muted {
    color: #6c757d;
}

.text-primary {
    color: #3498db;
}

.text-success {
    color: #28a745; /* Green success text */
}

.bg-primary {
    background-color: #3498db;
}

.bg-light {
    background-color: #f8f9fa;
}

.card-box {
    border-radius: 10px;
    background-color: #ffffff;
    padding: 25px;
    margin-bottom: 30px;
}

/* Green tint for the page */
.page-background {
    background-color: #d4edda; /* Very light green */
}

/* Hover effect for buttons */
.btn-light:hover {
    background-color: #28a745; /* Green */
    color: #ffffff;
    transform: translateY(-5px); /* Push-up effect */
}

.btn-secondary:hover {
    background-color: #5a6268;
    color: #ffffff;
}

/* Animations for hover effects */
.hover-shadow:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}
</style>

<section class="checkout spad bg-light py-5 page-background">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="border p-5 rounded-lg shadow-lg bg-white">
                    <h3 class="mb-4 font-weight-bold text-primary">Complete Your Purchase</h3>
                    <p class="mb-4 text-muted">
                        We want to make your shopping experience even better! Log in for a faster checkout, track your orders, and enjoy special discounts. If you prefer, you can also check out as a guest.
                    </p>

                    <div class="row align-items-center justify-content-center">
                        <!-- Login Option -->
                        <div class="col-md-6 mb-4">
                            <div class="d-flex flex-column align-items-center p-4 rounded-lg bg-primary text-white shadow-sm hover-shadow">
                                <i class="icon-user fa-4x mb-3"></i>
                                <h5 class="font-weight-bold mb-3">Join Us for a Seamless Experience!</h5>
                                <p class="text-light text-center mb-3">
                                    Unlock benefits like faster checkout, easy order tracking, and personalized discounts. Sign up today for a smoother shopping experience!
                                </p>
                                <a href="{{ route('login') }}" class="btn btn-light mt-3 px-4 py-2 rounded-pill">Login to Your Account</a>
                            </div>
                        </div>

                        <!-- Guest Checkout Option -->
                        <div class="col-md-6 mb-4">
                            <div class="d-flex flex-column align-items-center p-4 rounded-lg bg-light text-dark shadow-sm hover-shadow">
                                <i class="icon-shopping-cart fa-4x mb-3"></i>
                                <h5 class="font-weight-bold mb-3">Continue as a Guest</h5>
                                <p class="text-muted text-center mb-3">
                                    No worries! You can still proceed with your purchase without creating an account. Check out as a guest for a quicker process.
                                </p>
                                <a href="{{ route('checkout.index') }}" class="btn btn-secondary mt-3 px-4 py-2 rounded-pill">Proceed as Guest</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Information Section -->
                <div class="mt-5">
                    <h4 class="font-weight-bold mb-3 text-primary">Why Create an Account?</h4>
                    <ul class="list-unstyled mb-4">
                        <li><i class="fa fa-check-circle text-success"></i> Save your shipping details for faster checkout.</li>
                        <li><i class="fa fa-check-circle text-success"></i> View your order history and track deliveries with ease.</li>
                        <li><i class="fa fa-check-circle text-success"></i> Receive special discounts and personalized offers just for you.</li>
                    </ul>
                    <p class="text-muted mb-4">
                        Creating an account is quick and easy, and you can unlock many benefits for future purchases. We promise to make it worth your while!
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

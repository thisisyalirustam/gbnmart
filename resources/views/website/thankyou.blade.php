<!-- resources/views/checkout/thankyou.blade.php -->

@extends('website.layout.content')

@section('webcontent')
<style>
/* Thank You Page Styling */
.thank-you-page {
    background-color: #f8f9fa;
}

.thank-you-title {
    font-size: 2.5rem;
    color: #2c3e50;
    font-weight: 700;
    margin-bottom: 20px;
}

.order-summary-box {
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    background-color: #ffffff;
    padding: 25px;
    margin-bottom: 30px;
}

.order-summary-title {
    font-size: 1.75rem;
    color: #34495e;
    font-weight: 600;
    border-bottom: 2px solid #ecf0f1;
    padding-bottom: 10px;
    margin-bottom: 20px;
}

.order-summary li {
    font-size: 1.125rem;
    color: #7f8c8d;
    padding: 8px 0;
}

.order-summary li strong {
    color: #2c3e50;
    font-weight: 600;
}

.btn-primary {
    background-color: #3498db;
    border-color: #3498db;
    font-size: 1.1rem;
    text-transform: uppercase;
    padding: 10px 30px;
    transition: background-color 0.3s ease;
}

.btn-primary:hover {
    background-color: #2980b9;
    border-color: #2980b9;
}

.bg-light {
    background-color: #f4f6f9 !important;
}


</style>
<section class="thank-you-page spad bg-light py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="thank-you-title mb-4">Thank You for Your Order!</h2>
                <p class="lead mb-4">Your order has been placed successfully. We are processing it and will send you a confirmation email shortly.</p>

                <div class="order-summary-box p-4 bg-white shadow-sm rounded-lg">
                    <h4 class="order-summary-title mb-4">Order Summary</h4>
                    <ul class="order-summary list-unstyled">
                        <li class="mb-2"><strong>Name:</strong> {{ $order->name }}</li>
                        <li class="mb-2"><strong>Email:</strong> {{ $order->email }}</li>
                        <li class="mb-2"><strong>Phone:</strong> {{ $order->phone }}</li>
                        <li class="mb-2"><strong>Shipping Address:</strong> {{ $order->address }}, {{ $order->city }}, {{ $order->state }}</li>
                        <li class="mb-2"><strong>Country:</strong> {{ $order->country->name }}</li>
                        <li class="mb-2"><strong>Total Amount:</strong> ${{ number_format($order->grand_total, 2) }}</li>
                    </ul>
                </div>

                <p class="mt-4 mb-5">We appreciate your business and look forward to serving you again!</p>

                <a href="{{ route('homepage') }}" class="btn btn-primary btn-lg px-4 py-2">Back to Home</a>
            </div>
        </div>
    </div>
</section>

@endsection

@extends('website.layout.content')

@section('webcontent')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <!-- Terms and Conditions Section -->
            <div class="card">
                <div class="card-header text-center bg-primary text-white">
                    Terms and Conditions
                </div>
                <div class="card-body">
                    <h5>Affiliate Marketing Program</h5>
                    <p>
                        By applying to become an affiliate marketer, you agree to the following terms and conditions:
                        <ul>
                            <li>You must adhere to all guidelines provided by the platform.</li>
                            <li>All affiliate commissions are subject to verification and approval by the admin.</li>
                            <li>Misuse or fraudulent activity may result in termination of your affiliate account.</li>
                        </ul>
                    </p>
                    @if ($affiliate)  <!-- Check if the user is already an affiliate -->
                        <a href="{{ route('website.affliate.applay') }}" class="btn btn-secondary btn-block mt-4" disabled>Already an Affiliate</a>
                    @else
                        <a href="{{ route('website.affliate.applay') }}" class="btn btn-success btn-block mt-4">Apply for Affiliate Marketing</a>
                    @endif
                </div>
            </div>

            <!-- Affiliate Dashboard (Visible if user has an affiliate account) -->
            @if ($affiliate)  <!-- Check if the user has an affiliate account -->
                <div class="card mt-5">
                    <div class="card-header text-center bg-dark text-white">
                        Affiliate Dashboard
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('uploads/' . Auth::user()->image) }}" alt="User Profile" class="rounded-circle mb-3">
                            <h5>{{ Auth::user()->name }}</h5>
                            <p class="text-muted">Rank: {{ ucfirst($affiliate->membership_tier) }}</p>
                        </div>

                        <div class="row text-center">
                            <div class="col-md-4">
                                <h6>Total Sales</h6>
                                <p>{{ $affiliate->sales ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-4">
                                <h6>Total Earnings</h6>
                                <p>{{ $affiliate->amount ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-4">
                                <h6>Withdrawable Amount</h6>
                                <p>{{ $affiliate->withdrawal ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <button class="btn btn-primary btn-block mt-4" data-bs-toggle="modal" data-bs-target="#withdrawModal">Withdraw Earnings</button>

                        <!-- Bank Details Modal -->
                        <div class="modal fade" id="withdrawModal" tabindex="-1" aria-labelledby="withdrawModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title" id="withdrawModalLabel">Bank Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('website.affliate.storeBankDetails') }}">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="accountName" class="form-label">Account Holder Name</label>
                                                <input type="text" class="form-control" id="accountName" name="account_name" value="{{ old('account_name', $affiliate->bank_details['account_name'] ?? '') }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="bankName" class="form-label">Bank Name</label>
                                                <input type="text" class="form-control" id="bankName" name="bank_name" value="{{ old('bank_name', $affiliate->bank_details['bank_name'] ?? '') }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="accountNumber" class="form-label">Account Number</label>
                                                <input type="text" class="form-control" id="accountNumber" name="account_number" value="{{ old('account_number', $affiliate->bank_details['account_number'] ?? '') }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="ifscCode" class="form-label">IFSC Code</label>
                                                <input type="text" class="form-control" id="ifscCode" name="ifsc_code" value="{{ old('ifsc_code', $affiliate->bank_details['ifsc_code'] ?? '') }}" required>
                                            </div>

                                            <button type="submit" class="btn btn-primary btn-block">Save Bank Details</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

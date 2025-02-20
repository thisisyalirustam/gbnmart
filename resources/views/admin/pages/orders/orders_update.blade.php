@extends('admin.layout.content')
@section('content')
    <div class="pagetitle">
        <h1>Update Order</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Orders</li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h4 class="card-title text-center mb-4">Update Order</h4>
                        <form action="{{ route('coustomer-orders.update', $orderShow->id) }}" method="POST">
                            @csrf
                            @method('PUT')
    
    
                            <div class="row">
                                <!-- Subtotal -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="subtotal" class="font-weight-bold">Subtotal</label>
                                        <input type="number" step="0.01" class="form-control" id="subtotal" name="subtotal" value="{{ $orderShow->subtotal }}" required>
                                    </div>
                                </div>
    
                                <!-- Shipping -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="shipping" class="font-weight-bold">Shipping</label>
                                        <input type="number" step="0.01" class="form-control" id="shipping" name="shipping" value="{{ $orderShow->shipping }}" required>
                                    </div>
                                </div>
                            </div>
    
                            <div class="row">
                                <!-- Discount -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="discount" class="font-weight-bold">Discount</label>
                                        <input type="number" step="0.01" class="form-control" id="discount" name="discount" value="{{ $orderShow->discount }}">
                                    </div>
                                </div>
    
                                <!-- Grand Total -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="grand_total" class="font-weight-bold">Grand Total</label>
                                        <input type="number" step="0.01" class="form-control" id="grand_total" name="grand_total" value="{{ $orderShow->grand_total }}" required>
                                    </div>
                                </div>
                            </div>
    
                            <!-- Name -->
                            <div class="form-group">
                                <label for="name" class="font-weight-bold">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $orderShow->name }}" required>
                            </div>
    
                            <!-- Email -->
                            <div class="form-group">
                                <label for="email" class="font-weight-bold">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $orderShow->email }}" required>
                            </div>
    
                            <!-- Phone -->
                            <div class="form-group">
                                <label for="phone" class="font-weight-bold">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ $orderShow->phone }}" required>
                            </div>
    
                            <!-- Address -->
                            <div class="form-group">
                                <label for="address" class="font-weight-bold">Address</label>
                                <textarea class="form-control" id="address" name="address" required>{{ $orderShow->address }}</textarea>
                            </div>
    
                            <!-- Apartment -->
                            <div class="form-group">
                                <label for="apartment" class="font-weight-bold">Apartment</label>
                                <input type="text" class="form-control" id="apartment" name="apartment" value="{{ $orderShow->apartment }}">
                            </div>
    
                            <div class="row">
                                <!-- Country Dropdown -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="country" class="font-weight-bold">Country</label>
                                       
                                            <select id="country_id" name="country_id" class="form-select" required>
                                                <option value="{{ $orderShow->country_id }}">{{ $orderShow->country->name }}</option>
                                              @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                              @endforeach
                                            </select>
                                            <div class="invalid-feedback">Please select a country.</div>
                                    </div>
                                </div>
                            
                                <!-- State Dropdown -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="state" class="font-weight-bold">State</label>
                                        <select class="form-control" id="state_id" name="state" required>
                                            <option value="{{ $orderShow->state_id }}">{{ $orderShow->state->name }}</option>
                                        </select>
                                    </div>
                                </div>
                            
                                <!-- City Dropdown -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="city_id" class="font-weight-bold">City</label>
                                        <select class="form-control" id="city_id" name="city" required>
                                            <option value="{{ $orderShow->city_id }}">{{ $orderShow->city->name }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
    
                            <!-- ZIP -->
                            <div class="form-group">
                                <label for="zip" class="font-weight-bold">ZIP Code</label>
                                <input type="text" class="form-control" id="zip" name="zip" value="{{ $orderShow->zip }}">
                            </div>
    
                            <!-- Note -->
                            <div class="form-group">
                                <label for="note" class="font-weight-bold">Note</label>
                                <textarea class="form-control" id="note" name="note">{{ $orderShow->note }}</textarea>
                            </div>
    
                            <!-- Submit Button -->
                            <div class="form-group text-center mt-3">
                                <button type="submit" class="btn btn-success btn-lg">Update Order</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
    
            // When country is selected, fetch related states
            $('#country_id').change(function () {
                var countryId = $(this).val();
    
                // Reset state and city dropdowns
                $('#state_id').html('<option selected="">Select State</option>');
                $('#city_id').html('<option selected="">Select City</option>');
                $('#state_id').prop('disabled', true); // Disable state dropdown initially
                $('#city_id').prop('disabled', true); // Disable city dropdown initially
    
                if (countryId) {
                    $.ajax({
                        url: '/get-states/' + countryId,
                        method: 'GET',
                        dataType: 'json',
                        success: function (response) {
                            if (response.length > 0) {
                                $('#state_id').prop('disabled', false); // Enable state dropdown
                                $.each(response, function (index, state) {
                                    $('#state_id').append('<option value="' + state.id + '">' + state.name + '</option>');
                                });
                            }
                        },
                        error: function () {
                            alert('Error fetching states.');
                        }
                    });
                }
            });
            $('#country_id').change(function () {
                var countryId = $(this).val();
    
                // Reset state and city dropdowns
                $('#state_id').html('<option selected="">Select State</option>');
                $('#city_id').html('<option selected="">Select City</option>');
                $('#state_id').prop('disabled', true); // Disable state dropdown initially
                $('#city_id').prop('disabled', true); // Disable city dropdown initially
    
                if (countryId) {
                    $.ajax({
                        url: '/get-states/' + countryId,
                        method: 'GET',
                        dataType: 'json',
                        success: function (response) {
                            if (response.length > 0) {
                                $('#state_id').prop('disabled', false); // Enable state dropdown
                                $.each(response, function (index, state) {
                                    $('#state_id').append('<option value="' + state.id + '">' + state.name + '</option>');
                                });
                            }
                        },
                        error: function () {
                            alert('Error fetching states.');
                        }
                    });
                }
            });
    
            // When state is selected, fetch related cities
            $('#state_id').change(function () {
                var stateId = $(this).val();
    
                // Reset city dropdown
                $('#city_id').html('<option selected="">Select City</option>');
                $('#city_id').prop('disabled', true); // Disable city dropdown initially
    
                if (stateId) {
                    $.ajax({
                        url: '/get-cities/' + stateId,
                        method: 'GET',
                        dataType: 'json',
                        success: function (response) {
                            if (response.length > 0) {
                                $('#city_id').prop('disabled', false); // Enable city dropdown
                                $.each(response, function (index, city) {
                                    $('#city_id').append('<option value="' + city.id + '">' + city.name + '</option>');
                                });
                            }
                        },
                        error: function () {
                            alert('Error fetching cities.');
                        }
                    });
                }
            });
            $('#state_id').change(function () {
                var stateId = $(this).val();
    
                // Reset city dropdown
                $('#city_id').html('<option selected="">Select City</option>');
                $('#city_id').prop('disabled', true); // Disable city dropdown initially
    
                if (stateId) {
                    $.ajax({
                        url: '/get-cities/' + stateId,
                        method: 'GET',
                        dataType: 'json',
                        success: function (response) {
                            if (response.length > 0) {
                                $('#city_id').prop('disabled', false); // Enable city dropdown
                                $.each(response, function (index, city) {
                                    $('#city_id').append('<option value="' + city.id + '">' + city.name + '</option>');
                                });
                            }
                        },
                        error: function () {
                            alert('Error fetching cities.');
                        }
                    });
                }
            });
    
        });
    </script>
@endsection

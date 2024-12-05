@extends('admin.layout.content')
@section('content')
    <div class="pagetitle">
        <h1>Shipping Management</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Shipping</li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>
    </div>
    <style>
        .dx-datagrid .dx-data-row>td.bullet {
            padding-top: 0;
            padding-bottom: 0;
        }
    </style>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn mt-2" data-bs-toggle="modal" data-bs-target="#add">
                            <i class="bi bi-plus-lg txt-primary"></i> Add New Shipping Rule
                        </button>
                        <hr>
                        <div id="gridContainer"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Create Modal --}}
    <div class="modal fade" id="add" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Shipping Rule</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addform">
                        @csrf
                        <div class="row mb-3">
                            <label for="country_id" class="col-sm-2 col-form-label">Country</label>
                            <div class="col-sm-10">
                                <select id="country_id" name="country_id" class="form-select">
                                    <option selected="">Select Country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="state_id" class="col-sm-2 col-form-label">State</label>
                            <div class="col-sm-10">
                                <select id="state_id" name="state_id" class="form-select">
                                    <option selected="">Select State</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="city_id" class="col-sm-2 col-form-label">City</label>
                            <div class="col-sm-10">
                                <select id="city_id" name="city_id" class="form-select">
                                    <option selected="">Select City</option>
                                </select>
                            </div>
                        </div>

                        <!-- New field for weight unit -->
                        <div class="row mb-3">
                            <label for="weight_unit" class="col-sm-2 col-form-label">Weight Unit</label>
                            <div class="col-sm-10">
                                <select id="weight_unit" name="weight_unit" class="form-select">
                                    <option value="kg">Kilogram (kg)</option>
                                    <option value="g">Gram (g)</option>
                                    <option value="lb">Pound (lb)</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="charge" class="col-sm-2 col-form-label">Shipping Charge</label>
                            <div class="col-sm-10">
                                <input type="number" name="charge" id="charge" class="form-control" step="0.01"
                                    placeholder="Enter Shipping Charge">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea name="description" id="description" class="form-control" rows="3"
                                    placeholder="Optional: Add additional details"></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-10 offset-sm-2">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- Update Modal --}}
    <div class="modal fade" id="update" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="updateform">
                        @csrf
                        <input type="hidden" name="_method" value="PUT"> <!-- Method override for PUT -->
                        <input type="hidden" id="updateid" name="id" value="">

                        <!-- Country Selection -->
                        <div class="mb-3 row">
                          <label for="update_country_id" class="col-sm-3 col-form-label">Country</label>
                          <div class="col-sm-9">
                            <select id="update_country_id" name="country_id" class="form-select" required>
                              <option value="" disabled selected>Select a Country</option>
                              @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                              @endforeach
                            </select>
                            <div class="invalid-feedback">Please select a country.</div>
                          </div>
                        </div>

                        <!-- State Selection -->
                        <div class="mb-3 row">
                          <label for="update_state_id" class="col-sm-3 col-form-label">State</label>
                          <div class="col-sm-9">
                            <select id="update_state_id" name="state_id" class="form-select" required>
                              <option value="" disabled selected>Select a State</option>
                              @foreach ($states as $state)
                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                              @endforeach
                            </select>
                            <div class="invalid-feedback">Please select a state.</div>
                          </div>
                        </div>

                        <!-- City Selection -->
                        <div class="mb-3 row">
                          <label for="update_city_id" class="col-sm-3 col-form-label">City</label>
                          <div class="col-sm-9">
                            <select id="update_city_id" name="city_id" class="form-select" required>
                              <option value="" disabled selected>Select a City</option>
                              @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                              @endforeach
                            </select>
                            <div class="invalid-feedback">Please select a city.</div>
                          </div>
                        </div>

                        <!-- Shipping Charge -->
                        <div class="mb-3 row">
                          <label for="update_charge" class="col-sm-3 col-form-label">Shipping Charge</label>
                          <div class="col-sm-9">
                            <input type="number" name="charge" id="update_charge" class="form-control" step="0.01"
                              placeholder="Enter Shipping Charge" required>
                            <div class="invalid-feedback">Please enter a valid shipping charge.</div>
                          </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-3 row">
                          <label for="update_description" class="col-sm-3 col-form-label">Description</label>
                          <div class="col-sm-9">
                            <textarea name="description" id="update_description" class="form-control" rows="3"
                              placeholder="Enter additional details (optional)"></textarea>
                          </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                          <button type="submit" class="btn btn-primary">Update Shipping Rule</button>
                        </div>
                      </form>


                </div>
            </div>
        </div>
      </div>


@section('tabledev')
    <script src="{{ asset('admin/ajax_crud/shipping.js') }}"></script>
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

    });
</script>

@endsection
@endsection

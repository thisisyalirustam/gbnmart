@extends('layouts.main')
@section('user-content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-center bg-primary text-white">
                    Apply for Affiliate Marketing
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('website.affliate.store') }}" id="affiliateForm" enctype="multipart/form-data">
                        @csrf

                        <div class="text-center mb-4">
                            <label for="profileImage">
                                <img src="{{ asset('uploads/' . Auth::user()->image) }}" alt="User Profile" class="rounded-circle" id="profilePreview">
                            </label>
                            <input type="file" id="profileImage" name="profile_image" class="d-none" accept="image/*" onchange="document.getElementById('profilePreview').src = window.URL.createObjectURL(this.files[0])">
                            <p class="text-muted mt-2">Click the image to upload</p>
                        </div>

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" readonly value="{{$user->name}}" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="{{$user->email}}" readonly required>
                        </div>

                        <div class="form-group">
                            <label for="cnic">CNIC/Passport</label>
                            <input type="text" class="form-control" id="cnic" name="cnic" placeholder="Enter your CNIC or Passport number" value="{{$user->cnic}}" required>
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="2" placeholder="Enter your address" required>{{$user->address}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" value="{{$user->phone}}" required>
                        </div>

                        <button type="submit" class="btn btn-success btn-block mt-4">Submit Application</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Toastr CSS and JS (if not already included) -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $(document).ready(function () {
        $('#affiliateForm').on('submit', function (e) {
            e.preventDefault(); // Prevent the default form submission

            // Get form data
            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('website.affliate.store') }}", // Backend route to handle the request
                type: 'POST', // Ensure it's using POST method
                data: formData,
                contentType: false, // Let jQuery handle content-type
                processData: false, // Let jQuery handle data processing
                success: function (response) {
                    if (response.success) {
                        // Show success toast
                        toastr.success('Affiliate application submitted successfully!');
                    } else {
                        toastr.error('Failed to submit the application. Please try again.');
                    }
                },
                error: function (xhr, status, error) {
                    toastr.error('An error occurred while processing your request.');
                }
            });
        });
    });

    // Configure Toastr (Optional)
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right", // Position of the toast
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300", // Duration of the show animation
        "hideDuration": "1000", // Duration of the hide animation
        "timeOut": "5000", // Time the toast will be displayed
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn", // Animation method for showing
        "hideMethod": "fadeOut" // Animation method for hiding
    };
</script>



@endsection

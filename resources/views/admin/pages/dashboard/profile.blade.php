@extends('admin.layout.content')
@section('content')
    <div class="pagetitle">
        <h1>Admin Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
                <li class="breadcrumb-item">Admin Profile</li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>
    </div>
    <style>
        .dx-datagrid .dx-data-row>td.bullet {
            padding-top: 0;
            padding-bottom: 0;
        }

        .profile-header {
            margin-bottom: 20px;
        }

        .profile-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
        }

        .profile-info {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
        }

        .profile-info h5 {
            font-size: 1.25rem;
            margin-bottom: 15px;
            color: #333;
        }

        .profile-info p {
            font-size: 1rem;
            color: #555;
        }

        .profile-actions button {
            margin: 5px;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .profile-actions .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .profile-actions .btn-secondary {
            background-color: #6c757d;
            border: none;
        }

        .profile-actions .btn-primary:hover {
            background-color: #0056b3;
        }

        .profile-actions .btn-secondary:hover {
            background-color: #5a6268;
        }
    </style>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Profile Header -->
                        <div class="profile-header text-center">
                            <img src="{{ asset('uploads/' . Auth::user()->image) }}" alt="Profile Picture"
                                class="rounded-circle profile-img">
                            <h3 class="mt-3">{{ Auth::user()->name }}</h3>
                            <p class="text-muted">Admin - {{ config('app.name', 'Laravel') }}</p>
                        </div>

                        <!-- Profile Information -->
                        <div class="profile-info mt-5">
                            <h5>Personal Information</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Phone:</strong> {{ Auth::user()->phone }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Address:</strong> {{ Auth::user()->address }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Role:</strong> {{ Auth::user()->user_type }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Profile Actions -->
                        <div class="profile-actions mt-4 text-center">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#editProfileModal">Edit
                                Profile</button>
                            <button class="btn btn-secondary" data-toggle="modal" data-target="#changePasswordModal">Change
                                Password</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal for Edit Profile -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg">
            <!-- Modal Header -->
            <form action="{{ route('profile.update') }}"  method="POST">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
           
            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Edit Profile Form -->
                    @csrf <!-- Add CSRF Token -->
                    <input type="number" class="form-control" name="userid" id="userid" value="{{ Auth::id() }}" hidden>

                    <!-- Full Name Field -->
                    <div class="form-group">
                        <label for="name" class="font-weight-bold">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                               value="{{ Auth::user()->name }}" placeholder="Enter your full name">
                    </div>

                    <!-- Email Field -->
                    <div class="form-group">
                        <label for="email" class="font-weight-bold">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                               value="{{ Auth::user()->email }}" placeholder="Enter your email">
                    </div>

                    <!-- Phone Field -->
                    <div class="form-group">
                        <label for="phone" class="font-weight-bold">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                               value="{{ Auth::user()->phone }}" placeholder="Enter your phone number">
                    </div>

                    <!-- Address Field -->
                    <div class="form-group">
                        <label for="address" class="font-weight-bold">Address</label>
                        <input type="text" class="form-control" id="address" name="address"
                               value="{{ Auth::user()->address }}" placeholder="Enter your address">
                    </div>
               
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="profileUpdate" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
        </div>
    </div>
</div>


    <!-- Modal for Change Password -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog"
    aria-labelledby="changePasswordModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content">
           <!-- Modal Header -->
           <div class="modal-header bg-primary text-white">
               <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
               <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>

           <!-- Modal Body -->
           <form  action="{{ route('change.admin.password') }}" method="POST">
               @csrf
               <input type="number" class="form-control" name="userid" id="userid" value="{{ Auth::id() }}" hidden>
               <div class="modal-body">
                   <!-- Current Password Field -->
                   <div class="form-group">
                       <label for="currentPassword" class="font-weight-bold">Current Password</label>
                       <input type="password" class="form-control" id="currentPassword" name="current_password"
                              placeholder="Enter your current password" required>
                   </div>

                   <!-- New Password Field -->
                   <div class="form-group">
                       <label for="newPassword" class="font-weight-bold">New Password</label>
                       <input type="password" class="form-control" id="newPassword" name="new_password"
                              placeholder="Enter new password" required>
                   </div>

                   <!-- Confirm New Password Field -->
                   <div class="form-group">
                       <label for="confirmPassword" class="font-weight-bold">Confirm New Password</label>
                       <input type="password" class="form-control" id="confirmPassword" name="new_password_confirmation"
                              placeholder="Confirm your new password" required>
                   </div>
               </div>

               <!-- Modal Footer -->
               <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                   <button type="submit" class="btn btn-primary">Change Password</button>
               </div>
           </form>
       </div>
   </div>
</div>

    {{-- <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#profileUpdate").submit(function(event) {
                event.preventDefault();

                $.ajax({
                    url: '{{ route('profile.update') }}',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'JSON',
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.success);
                            $('#editProfileModal').modal('hide');
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        } else {
                            toastr.error(
                                "There was an error updating your profile. Please try again."
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        if (xhr.responseJSON && xhr.responseJSON.error) {
                            toastr.error(xhr.responseJSON
                                .error); // Show backend validation error
                        } else {
                            toastr.error("An unexpected error occurred. Please try again.");
                        }
                    }
                });
            });

        });

    </script>


<script>
    // Your custom script here
    $(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#changePasswordForm").submit(function(event) {
        event.preventDefault();

        $.ajax({
            url: '{{ route('change.admin.password') }}',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'JSON',
            success: function(response) {
                if (response.success) {
                    toastr.success(response.success);
                    $('#changePasswordModal').modal('hide');
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                } else {
                    toastr.error("There was an error updating your profile. Please try again.");
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                if (xhr.responseJSON && xhr.responseJSON.error) {
                    toastr.error(xhr.responseJSON.error); // Show backend validation error
                } else {
                    toastr.error("An unexpected error occurred. Please try again.");
                }
            }
        });
    });
});
</script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
{{--   --}}

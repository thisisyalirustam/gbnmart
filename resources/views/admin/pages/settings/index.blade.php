@extends('admin.layout.content')

@section('content')
    <div class="pagetitle">
        <h1>Website Settings</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Website Settings</li>
                <li class="breadcrumb-item active">Update Settings</li>
            </ol>
        </nav>
    </div>

    <style>
        /* Dashboard Section Styling */
        .dashboard-section .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            height: auto;
            /* Dynamic height based on content */
            min-height: 220px;
            /* Minimum height to keep cards consistent */
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            text-align: center;
            padding: 15px;
        }

        .dashboard-section .card:hover {
            transform: translateY(-5px);
        }

        .dashboard-section .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            text-align: center;
            height: 100%;
        }

        .dashboard-section .card-title {
            font-size: 1.1rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .dashboard-section .card p {
            font-size: 0.9rem;
            margin-bottom: 15px;
        }

        .dashboard-section .card i {
            color: #3498db;
            font-size: 3rem;
            /* Adjust icon size */
        }

        .dashboard-section .btn {
            padding: 8px 16px;
            font-size: 1rem;
            border-radius: 4px;
            text-decoration: none;
            background-color: #3498db;
            color: white;
            transition: background-color 0.3s ease;
        }

        .dashboard-section .btn:hover {
            background-color: #2980b9;
        }

        /* Flexbox for row items */
        .dashboard-section .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            /* Ensure equal spacing between cards */
        }

        /* Responsive Design */
        @media (max-width: 768px) {

            .dashboard-section .col-xl-3,
            .dashboard-section .col-lg-6 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }

        /* Profile Section Adjustments (keeping separate for the profile section) */
        .profile-section .profile-card {
            text-align: center;
            padding: 30px 15px;
            /* Adjust padding for the profile card */
        }

        .profile-section .profile-card img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
        }

        .profile-section .profile-card h2 {
            font-size: 1.5rem;
            margin-top: 10px;
        }

        .profile-section .social-links a {
            font-size: 1.2rem;
            margin: 0 10px;
            color: #3498db;
            text-decoration: none;
        }

        .profile-section .social-links a:hover {
            color: #2980b9;
        }

        /* Adjust tabs for smaller screens */
        .dashboard-section .nav-tabs-bordered {
            display: flex;
            flex-direction: row;
            justify-content: space-evenly;
            align-items: center;
        }

        .dashboard-section .nav-tabs-bordered .nav-item {
            margin-right: 10px;
        }

        .dashboard-section .nav-tabs-bordered .nav-link {
            padding: 10px 20px;
        }

        /* Content inside tabs */
        .dashboard-section .tab-content {
            padding-top: 20px;
        }
    </style>

    <section class="section profile dashboard-section">
        <div class="row">
            <!-- Banners Box -->
            <div class="col-xl-3 col-lg-6">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <i class="fas fa-image fa-3x mb-3"></i> <!-- Banner Icon -->
                        <h5 class="card-title">Banners</h5>
                        <p>Manage your banners here.</p>
                        <a href="{{ route('banners.index') }}" class="btn btn-primary">Manage</a> <!-- Anchor link -->
                    </div>
                </div>
            </div>

            <!-- Ads Box -->
            <div class="col-xl-3 col-lg-6">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <i class="fas fa-ad fa-3x mb-3"></i> <!-- Ads Icon -->
                        <h5 class="card-title">Ads</h5>
                        <p>Manage your ads here.</p>
                        <a href="#ads" class="btn btn-primary">Manage</a> <!-- Anchor link -->
                    </div>
                </div>
            </div>

            <!-- Promotions Box -->
            <div class="col-xl-3 col-lg-6">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <i class="fas fa-gift fa-3x mb-3"></i> <!-- Promotions Icon -->
                        <h5 class="card-title">Promotions</h5>
                        <p>Manage your promotions here.</p>
                        <a href="#promotions" class="btn btn-primary">Manage</a> <!-- Anchor link -->
                    </div>
                </div>
            </div>

            <!-- Links Box -->
            <div class="col-xl-3 col-lg-6">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <i class="fas fa-link fa-3x mb-3"></i> <!-- Links Icon -->
                        <h5 class="card-title">Links</h5>
                        <p>Manage your links here.</p>
                        <a href="#links" class="btn btn-primary">Manage</a> <!-- Anchor link -->
                    </div>
                </div>
            </div>
        </div>
    </section>




    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="{{ asset($settings->logo) }}" alt="Profile" class="rounded-circle">
                        <h2>{{ $settings->name }}</h2>
                        <h3>Web Designer</h3>
                        <div class="social-links mt-2">
                            <a href="{{ $settings->twitter }}" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="{{ $settings->facebook }}" class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="{{ $settings->instagram }}" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="{{ $settings->linkedin }}" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered" role="tablist">

                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview"
                                    aria-selected="true" role="tab">Overview</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit"
                                    aria-selected="false" role="tab" tabindex="-1">Edit Profile</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings"
                                    aria-selected="false" role="tab" tabindex="-1">Settings</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password"
                                    aria-selected="false" role="tab" tabindex="-1">Change Password</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade profile-overview active show" id="profile-overview" role="tabpanel">
                                <h5 class="card-title">About</h5>
                                <p class="small fst-italic">{{ $settings->description }}.</p>

                                <h5 class="card-title">Profile Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                    <div class="col-lg-9 col-md-8">{{ $settings->name }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Address</div>
                                    <div class="col-lg-9 col-md-8">{{ $settings->address }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Phone</div>
                                    <div class="col-lg-9 col-md-8">(+92) {{ $settings->phone }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">{{ $settings->email }}</div>
                                </div>

                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit" role="tabpanel">

                                <!-- Profile Edit Form -->

                                <form action="{{ route('setting.update', $settings->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mb-3">
                                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Logo</label>
                                        <div class="col-md-8 col-lg-9">
                                            <img id="profileImgPreview" src="{{ asset($settings->logo) }}"
                                                alt="Profile" style="width: 100px; height: 100px; object-fit: cover;">
                                            <div class="pt-2">
                                                <button type="button" class="btn btn-primary btn-sm"
                                                    title="Upload new profile image"
                                                    onclick="document.getElementById('profileImageInput').click();"><i
                                                        class="bi bi-upload"></i></button>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    title="Remove my profile image" onclick="removeImage();"><i
                                                        class="bi bi-trash"></i></button>
                                                <input type="file" id="profileImageInput" name="profileImage"
                                                    style="display:none" accept="image/*" onchange="previewImage(event)">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="fullName" type="text" class="form-control" id="fullName"
                                                value="{{ $settings->name }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                                        <div class="col-md-8 col-lg-9">
                                            <textarea name="about" class="form-control" id="about" style="height: 100px">{{ $settings->description }}</textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="address" type="text" class="form-control" id="Address"
                                                value="{{ $settings->address }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="phone" type="text" class="form-control" id="Phone"
                                                value="{{ $settings->phone }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="email" type="email" class="form-control" id="Email"
                                                value="{{ $settings->email }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter
                                            Profile</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="twitter" type="text" class="form-control" id="Twitter"
                                                value="{{ $settings->twitter }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook
                                            Profile</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="facebook" type="text" class="form-control" id="Facebook"
                                                value="{{ $settings->facebook }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram
                                            Profile</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="instagram" type="text" class="form-control" id="Instagram"
                                                value="{{ $settings->instagram }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin
                                            Profile</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="linkedin" type="text" class="form-control" id="Linkedin"
                                                value="{{ $settings->linkedin }}">
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form><!-- End Profile Edit Form -->

                            </div>

                            <div class="tab-pane fade pt-3" id="profile-settings" role="tabpanel">

                                <!-- Settings Form -->
                                <form>

                                    <div class="row mb-3">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email
                                            Notifications</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="changesMade"
                                                    checked="">
                                                <label class="form-check-label" for="changesMade">
                                                    Changes made to your account
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="newProducts"
                                                    checked="">
                                                <label class="form-check-label" for="newProducts">
                                                    Information on new products and services
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="proOffers">
                                                <label class="form-check-label" for="proOffers">
                                                    Marketing and promo offers
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="securityNotify"
                                                    checked="" disabled="">
                                                <label class="form-check-label" for="securityNotify">
                                                    Security alerts
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form><!-- End settings Form -->

                            </div>

                            <div class="tab-pane fade pt-3" id="profile-change-password" role="tabpanel">
                                <!-- Change Password Form -->
                                <form>

                                    <div class="row mb-3">
                                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current
                                            Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="password" type="password" class="form-control"
                                                id="currentPassword">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New
                                            Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="newpassword" type="password" class="form-control"
                                                id="newPassword">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New
                                            Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="renewpassword" type="password" class="form-control"
                                                id="renewPassword">
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Change Password</button>
                                    </div>
                                </form><!-- End Change Password Form -->

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>

    <script>
        // Function to preview the image after upload
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profileImgPreview').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }

        // Function to remove the image
        function removeImage() {
            document.getElementById('profileImgPreview').src = 'assets/img/profile-img.jpg'; // Default image
            document.getElementById('profileImageInput').value = ''; // Clear the input
        }

        // Form submission with image
        document.getElementById('profileForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            const formData = new FormData(this);
            // Optionally add other fields or handle the form data before submitting
            fetch('/submit-form', {
                method: 'POST',
                body: formData
            }).then(response => {
                if (response.ok) {
                    alert('Profile updated successfully');
                } else {
                    alert('Error updating profile');
                }
            }).catch(error => {
                alert('An error occurred');
            });
        });
    </script>
@endsection

@section('tabledev')
    <!-- Custom scripts for this page -->
@endsection

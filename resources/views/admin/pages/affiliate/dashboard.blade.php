@extends('admin.layout.content')
@section('content')

<div class="pagetitle">
  <h1>Vendor's Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </nav>
</div><!-- End Page Title -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
  /* Card Section Styling */
  .custom-dashboard-card {
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease-in-out, box-shadow 0.3s ease;
  }

  .custom-dashboard-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
  }

  .custom-card-body {
      text-align: center;
  }

  .custom-card-icon {
      font-size: 3rem;
  }

  .custom-card-title {
      font-size: 1.25rem;
      font-weight: bold;
  }

  .custom-card-text {
      font-size: 1.5rem;
      color: #333;
  }

  .text-primary {
      color: #007bff !important;
  }

  .text-success {
      color: #28a745 !important;
  }

  .text-warning {
      color: #ffc107 !important;
  }

  .text-danger {
      color: #dc3545 !important;
  }

  .font-weight-bold {
      font-weight: 600;
  }

  /* Responsive Design */
  @media (max-width: 768px) {
      .custom-dashboard-card {
          margin-bottom: 1rem;
      }
  }

  .navbar {
      background-color: #f8f9fa; 
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .navbar-nav .nav-item .nav-link {
      font-size: 1.1rem;
      color: #333;
      transition: all 0.3s ease;
  }

  .navbar-nav .nav-item .nav-link:hover {
      color: #007bff;
      background-color: rgba(0, 123, 255, 0.1);
      transform: translateY(-2px);
  }

  .navbar-nav .nav-item .nav-link i {
      font-size: 1.3rem;
  }
</style>

<section class="section">
  <div class="row">
      <div class="col-lg-12">
          <!-- Navbar -->
          <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
              <div class="container-fluid justify-content-center">
                  <div class="collapse navbar-collapse" id="navbarNav">
                      <ul class="navbar-nav">
                          <li class="nav-item">
                              <a class="nav-link text-dark px-3 py-2 mx-2 rounded-pill" href="{{route('affiliate.active')}}">
                                  <i class="fas fa-store-alt me-2"></i>Vendors
                              </a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link text-dark px-3 py-2 mx-2 rounded-pill" href="#">
                                  <i class="fas fa-handshake me-2"></i>Vendor Requests
                              </a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link text-dark px-3 py-2 mx-2 rounded-pill" href="#">
                                  <i class="fas fa-wallet me-2"></i>Funds
                              </a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link text-dark px-3 py-2 mx-2 rounded-pill" href="#">
                                  <i class="fas fa-tags me-2"></i>Coupon Codes
                              </a>
                          </li>
                      </ul>
                  </div>
              </div>
          </nav>

          <!-- Card Section -->
          <div class="card">
              <div class="card-body">
                  <div class="container my-4">
                      <!-- Row for main cards -->
                      <div class="row text-center">
                          <!-- Active Marketers Card -->
                          <div class="col-md-3 mb-4">
                              <div class="card custom-dashboard-card shadow-lg rounded">
                                  <div class="custom-card-body p-4">
                                      <i class="fas fa-users custom-card-icon text-primary"></i>
                                      <h5 class="custom-card-title text-primary mt-3">Active Marketers</h5>
                                      <p class="custom-card-text font-weight-bold">145</p>
                                      <span class="text-success">12% increase</span>
                                  </div>
                              </div>
                          </div>

                          <!-- Vendor Requests Card -->
                          <div class="col-md-3 mb-4">
                              <div class="card custom-dashboard-card shadow-lg rounded">
                                  <div class="custom-card-body p-4">
                                      <i class="fas fa-handshake custom-card-icon text-success"></i>
                                      <h5 class="custom-card-title text-success mt-3">Vendor Requests</h5>
                                      <p class="custom-card-text font-weight-bold">35</p>
                                      <span class="text-success">8% increase</span>
                                  </div>
                              </div>
                          </div>

                          <!-- Funds Card -->
                          <div class="col-md-3 mb-4">
                              <div class="card custom-dashboard-card shadow-lg rounded">
                                  <div class="custom-card-body p-4">
                                      <i class="fas fa-wallet custom-card-icon text-warning"></i>
                                      <h5 class="custom-card-title text-warning mt-3">Funds</h5>
                                      <p class="custom-card-text font-weight-bold">$3,264</p>
                                      <span class="text-success">8% increase</span>
                                  </div>
                              </div>
                          </div>

                          <!-- Coupon Codes Card -->
                          <div class="col-md-3 mb-4">
                              <div class="card custom-dashboard-card shadow-lg rounded">
                                  <div class="custom-card-body p-4">
                                      <i class="fas fa-tags custom-card-icon text-danger"></i>
                                      <h5 class="custom-card-title text-danger mt-3">Coupon Codes</h5>
                                      <p class="custom-card-text font-weight-bold">45</p>
                                      <span class="text-success">5% increase</span>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>

@endsection
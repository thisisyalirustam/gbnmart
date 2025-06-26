
@extends('website.layout.content')
@section('webcontent')
abc    <main class="main">

    <!-- Page Title -->
    <div class="page-title light-background position-relative">
      <div class="container">
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Login</li>
          </ol>
        </nav>
        <h1>Login</h1>
      </div>
    </div><!-- End Page Title -->

    <!-- Login Section -->
    <section id="login" class="login section">
      <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
        <div class="row justify-content-center">
          <div class="col-lg-5 col-md-8 aos-init aos-animate" data-aos="zoom-in" data-aos-delay="200">
            <div class="login-form-wrapper">
              <div class="login-header text-center">
                <h2>Login</h2>
                <p>Welcome back! Please enter your details</p>
              </div>

              <form>
                <div class="mb-4">
                  <label for="form3Example3" class="form-label">Email</label>
                  <input type="email" class="form-control" id="form3Example3" placeholder="Enter your email" required="" autocomplete="email">
                </div>

                <div class="mb-3">
                  <div class="d-flex justify-content-between">
                    <label for="form3Example4" class="form-label">Password</label>
                    <a href="#!" class="forgot-link">Forgot password?</a>
                  </div>
                  <input type="password" class="form-control" id="form3Example4" placeholder="Enter your password" required="" autocomplete="current-password">
                </div>

                <div class="mb-4 form-check">
                  <input type="checkbox" class="form-check-input" id="form2Example3">
                  <label class="form-check-label" for="form2Example3">Remember for 30 days</label>
                </div>

                <div class="d-grid gap-2 mb-4">
                  <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary">Sign in</button>
                  <button type="button" class="btn btn-outline">
                    <i class="bi bi-google me-2"></i>Sign in with Google
                  </button>
                </div>

                <div class="signup-link text-center">
                  <span>Don't have an account?</span>
                  <a href="{{ route('signup') }}">Sign up</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section><!-- /Login Section -->

  </main>
  {{-- </section> --}}

@endsection
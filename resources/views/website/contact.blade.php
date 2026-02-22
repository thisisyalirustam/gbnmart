@extends('website.layout.content')
@section('webcontent')
<main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container">
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Contact</li>
          </ol>
        </nav>
        <h1>Contact</h1>
      </div>
    </div><!-- End Page Title -->

    <!-- Contact 2 Section -->
    <section id="contact-2" class="contact-2 section">

     <div class="mb-4 aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
  <iframe
    style="border:0; width: 100%; height: 350px;"
    src="https://maps.google.com/maps?q=IT%20Block%20Gilgit%20Pakistan&output=embed"
    frameborder="0"
    allowfullscreen=""
    loading="lazy">
  </iframe>
</div>


      <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-4">
            <div class="info-item d-flex aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-geo-alt flex-shrink-0"></i>
              <div>
                <h3>Address</h3>
                <p> {{ settings()->address }}</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex aos-init aos-animate" data-aos="fade-up" data-aos-delay="400">
              <i class="bi bi-telephone flex-shrink-0"></i>
              <div>
                <h3>Call Us</h3>
                <p> {{ settings()->phone }}</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex aos-init aos-animate" data-aos="fade-up" data-aos-delay="500">
              <i class="bi bi-envelope flex-shrink-0"></i>
              <div>
                <h3>Email Us</h3>
                <p> {{ settings()->email }}</p>
              </div>
            </div><!-- End Info Item -->

          </div>

          <div class="col-lg-8">
            <form action="forms/contact.php" method="post" class="php-email-form aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                </div>

                <div class="col-md-6 ">
                  <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>

                  <button type="submit">Send Message</button>
                </div>

              </div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact 2 Section -->

  </main>
@endsection
@extends('website.layout.content')

@section('webcontent')

<main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container">
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">About</li>
          </ol>
        </nav>
        <h1>About Pamir Pure</h1>
      </div>
    </div><!-- End Page Title -->

    <!-- About 2 Section -->
    <section id="about-2" class="about-2 section">

      <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">

        <div class="row mb-lg-5">
          <span class="text-uppercase small-title mb-2">About Our Company</span>
          <div class="col-lg-6">
            <h2 class="about-title">Pure Herbs, Dry Fruits & Gemstones from the Heart of Nature</h2>
          </div>
          <div class="col-lg-6 description-wrapper">
            <p class="about-description">Founded in 2023 by Yaseen Ali, Pamir Pure brings you the finest quality herbs, dry fruits, and authentic gemstones sourced directly from nature's bounty. We are committed to purity, authenticity, and your wellbeing.</p>
          </div>
        </div>

        <div class="row g-4">

          <div class="col-lg-4 aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
            <div class="content-card">
              <div class="card-image">
                <img src="{{asset('website/assets/img/about/about-portrait-16.webp')}}" alt="" class="img-fluid">
              </div>
              <div class="card-content">
                <h3>Premium Quality Herbs</h3>
                <p>Our carefully selected herbs are harvested at their peak potency to ensure maximum therapeutic benefits for your health and wellness.</p>
                <a href="#" class="read-more">
                  Explore Herbs <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div><!-- End Content Card -->

          <div class="col-lg-4 aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
            <div class="content-card">
              <div class="card-image">
                <img src="{{asset('website/assets/img/about/about-portrait-4.webp')}}" alt="" class="img-fluid">
              </div>
              <div class="card-content">
                <h3>Nutrient-Rich Dry Fruits</h3>
                <p>We offer the finest selection of dry fruits packed with essential nutrients, vitamins and minerals for your daily health needs.</p>
                <a href="#" class="read-more">
                  Discover Dry Fruits <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div><!-- End Content Card -->

          <div class="col-lg-4 aos-init aos-animate" data-aos="fade-up" data-aos-delay="400">
            <div class="content-card">
              <div class="card-image">
                <img src="{{asset('website/assets/img/about/about-portrait-1.webp')}}" alt="" class="img-fluid">
              </div>
              <div class="card-content">
                <h3>Authentic Gemstones</h3>
                <p>Each gemstone in our collection is ethically sourced and verified for authenticity to bring you nature's energy and beauty.</p>
                <a href="#" class="read-more">
                  View Gemstones <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>
          <!-- End Content Card -->

        </div>

      </div>

    </section><!-- /About 2 Section -->

    <!-- Stats Section -->
    <section id="stats" class="stats section light-background">

      <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6">
            <div class="stats-item">
              <i class="bi bi-emoji-smile"></i>
              <span data-purecounter-start="0" data-purecounter-end="500" data-purecounter-duration="0" class="purecounter">500</span>
              <p><strong>Happy Customers</strong> <span>trusting our natural products</span></p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item">
              <i class="bi bi-journal-richtext"></i>
              <span data-purecounter-start="0" data-purecounter-end="150" data-purecounter-duration="0" class="purecounter">150</span>
              <p><strong>Natural Products</strong> <span>in our growing collection</span></p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item">
              <i class="bi bi-headset"></i>
              <span data-purecounter-start="0" data-purecounter-end="24" data-purecounter-duration="0" class="purecounter">24</span>
              <p><strong>Hours Support</strong> <span>for all your inquiries</span></p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item">
              <i class="bi bi-people"></i>
              <span data-purecounter-start="0" data-purecounter-end="10" data-purecounter-duration="0" class="purecounter">10</span>
              <p><strong>Dedicated Team</strong> <span>ensuring quality service</span></p>
            </div>
          </div><!-- End Stats Item -->

        </div>

      </div>

    </section><!-- /Stats Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section">

      <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">

        <div class="testimonials-slider swiper init-swiper swiper-initialized swiper-horizontal swiper-backface-hidden">
          <script type="application/json" class="swiper-config">
            {
              "slidesPerView": 1,
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "navigation": {
                "nextEl": ".swiper-button-next",
                "prevEl": ".swiper-button-prev"
              }
            }
          </script>

          <div class="swiper-wrapper" id="swiper-wrapper-fd284ac42e5f1982" aria-live="off" style="transition-duration: 0ms; transform: translate3d(-3348px, 0px, 0px); transition-delay: 0ms;">

            <!-- End Testimonial Item -->

            <!-- End Testimonial Item -->

            <!-- End Testimonial Item -->

            <!-- End Testimonial Item -->

          <div class="swiper-slide swiper-slide-next" role="group" aria-label="4 / 4" data-swiper-slide-index="3" style="width: 1116px;">
              <div class="testimonial-item">
                <div class="row">
                  <div class="col-lg-8">
                    <h2>Life-Changing Herbal Remedies</h2>
                    <p>
                      Pamir Pure's herbal products have transformed my health. The quality is unmatched and I can feel the difference compared to other brands. Their attention to purity is remarkable.
                    </p>
                    <p>
                      As someone who values natural remedies, I appreciate their commitment to authentic sourcing. The dry fruits are always fresh and the gemstones I purchased have such positive energy. Truly a trustworthy source for natural products.
                    </p>
                    <div class="profile d-flex align-items-center">
                      <img src="{{asset('website/assets/img/person/person-f-10.webp')}}" class="profile-img" alt="">
                      <div class="profile-info">
                        <h3>Fatima Khan</h3>
                        <span>Regular Customer</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 d-none d-lg-block">
                    <div class="featured-img-wrapper">
                      <img src="{{asset('website/assets/img/person/person-f-10.webp')}}" class="featured-img" alt="">
                    </div>
                  </div>
                </div>
              </div>
            </div><div class="swiper-slide" role="group" aria-label="1 / 4" data-swiper-slide-index="0" style="width: 1116px;">
              <div class="testimonial-item">
                <div class="row">
                  <div class="col-lg-8">
                    <h2>Authentic Gemstones & Herbs</h2>
                    <p>
                      I've been collecting gemstones for years and Pamir Pure offers some of the most authentic pieces I've found. Their knowledge of both gemstones and herbs is impressive.
                    </p>
                    <p>
                      The dry fruits are always premium quality and packaged with care. Yaseen and his team clearly have passion for what they do. I recommend them to all my friends interested in natural wellness products.
                    </p>
                    <div class="profile d-flex align-items-center">
                      <img src="{{asset('website/assets/img/person/person-m-7.webp')}}" class="profile-img" alt="">
                      <div class="profile-info">
                        <h3>Ahmed Raza</h3>
                        <span>Holistic Practitioner</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 d-none d-lg-block">
                    <div class="featured-img-wrapper">
                      <img src="{{asset('website/assets/img/person/person-m-7.webp')}}" class="featured-img" alt="">
                    </div>
                  </div>
                </div>
              </div>
            </div><div class="swiper-slide swiper-slide-prev" role="group" aria-label="2 / 4" data-swiper-slide-index="1" style="width: 1116px;">
              <div class="testimonial-item">
                <div class="row">
                  <div class="col-lg-8">
                    <h2>Best Dry Fruits in Town</h2>
                    <p>
                      I've tried many brands but Pamir Pure's dry fruits are in a league of their own. The almonds and walnuts are so fresh and flavorful - you can tell they're premium quality.
                    </p>
                    <p>
                      What I appreciate most is their transparency about sourcing. Knowing exactly where my food comes from gives me peace of mind. Their customer service is excellent too - always helpful with recommendations.
                    </p>
                    <div class="profile d-flex align-items-center">
                      <img src="{{asset('website/assets/img/person/person-f-8.webp')}}" class="profile-img" alt="">
                      <div class="profile-info">
                        <h3>Ayesha Malik</h3>
                        <span>Nutritionist</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 d-none d-lg-block">
                    <div class="featured-img-wrapper">
                      <img src="{{asset('website/assets/img/person/person-f-8.webp')}}" class="featured-img" alt="">
                    </div>
                  </div>
                </div>
              </div>
            </div><div class="swiper-slide swiper-slide-active" role="group" aria-label="3 / 4" data-swiper-slide-index="2" style="width: 1116px;">
              <div class="testimonial-item">
                <div class="row">
                  <div class="col-lg-8">
                    <h2>
                      A Trusted Source for Wellness
                    </h2>
                    <p>
                      As someone who switched to natural remedies, finding Pamir Pure has been a blessing. Their herbal products are effective and reasonably priced. The shipping is always prompt and items well-packaged.
                    </p>
                    <p>
                      The owner Yaseen clearly has deep knowledge about the products he sells. I recently purchased a gemstone after his recommendation and have noticed positive changes. This is more than a business - it's a passion project for holistic health.
                    </p>
                    <div class="profile d-flex align-items-center">
                      <img src="{{asset('website/assets/img/person/person-m-11.png')}}" class="profile-img" alt="">
                      <div class="profile-info">
                        <h3>Imran Sheikh</h3>
                        <span>Yoga Instructor</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 d-none d-lg-block">
                    <div class="featured-img-wrapper">
                      <img src="{{asset('website/assets/img/person/person-m-11.png')}}" class="featured-img" alt="">
                    </div>
                  </div>
                </div>
              </div>
            </div></div>

          <div class="swiper-navigation w-100 d-flex align-items-center justify-content-center">
            <div class="swiper-button-prev" tabindex="0" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-fd284ac42e5f1982"></div>
            <div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-fd284ac42e5f1982"></div>
          </div>

        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>

      </div>

    </section><!-- /Testimonials Section -->

  </main>
@endsection
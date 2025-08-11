@extends('website.layout.content')

@section('webcontent')
    <style>
        /* Main Content Styles */
        .single-content {
            line-height: 1.8;
            color: #333;
        }
        
        .single-content img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 2rem 0;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        /* Author Section */
        .author-section {
            display: flex;
            align-items: center;
            padding: 1.5rem;
            background: #f9f9f9;
            border-radius: 8px;
            margin: 2rem 0;
            border-left: 4px solid #0d6efd;
        }
        
        .bio-pic img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #fff;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }
        
        .author-info {
            margin-left: 1.5rem;
        }
        
        .author-name {
            font-weight: 600;
            color: #222;
            margin-bottom: 0.25rem;
        }
        
        .post-meta {
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        /* Article Content */
        .article-content {
            font-size: 1.1rem;
            line-height: 1.8;
        }
        
        .article-content p {
            margin-bottom: 1.5rem;
        }
        
        .article-content h2, 
        .article-content h3 {
            margin: 2rem 0 1rem;
            color: #222;
        }
        
        /* Popular Posts */
        .popular-posts {
            background: #f9f9f9;
            padding: 2rem;
            border-radius: 8px;
            position: sticky;
            top: 20px;
        }
        
        .section-title {
            left: 0;
           
            margin-bottom: 2rem;
        }
        
        .section-title h2 {
            font-size: 1.5rem;
            font-weight: 600;
            left: 0;
            color: #222;
            position: absolute;
            display: inline-block;
            padding-bottom: 10px;
        }
        
        .section-title h2:after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 3px;
            background: #0d6efd;
        }
        
        .trend-entry {
            margin-bottom: 1.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #eee;
            transition: all 0.3s ease;
        }
        
        .trend-entry:hover {
            transform: translateX(5px);
        }
        
        .trend-entry:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .trend-entry .number {
            font-size: 1.5rem;
            font-weight: bold;
            color: #ddd;
            margin-right: 15px;
            min-width: 30px;
        }
        
        .trend-contents h5 {
            font-size: 1rem;
            line-height: 1.4;
            margin-bottom: 0.5rem;
        }
        
        .trend-contents h5 a {
            color: #333;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .trend-contents h5 a:hover {
            color: #0d6efd;
        }
        
        /* See All Button */
        .see-all-btn {
            display: inline-flex;
            align-items: center;
            color: #0d6efd;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .see-all-btn:hover {
            color: #0a58ca;
            transform: translateX(5px);
        }
        
        /* Responsive Adjustments */
        @media (max-width: 991.98px) {
            .popular-posts {
                margin-top: 3rem;
                position: static;
            }
        }
    </style>

    <main class="main">
        <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container">
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Blog Details</li>
          </ol>
        </nav>
        <h1>Blog Details</h1>
      </div>
    </div><!-- End Page Title -->
     <div class="container">
      <div class="row">

        <div class="col-lg-8">
            <section id="blog-details" class="blog-details section">
            <div class="container">
                <article class="article">
                    <figure class="featured-image mb-4">
                        <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" class="img-fluid rounded-lg w-100">
                    </figure>
                    <h2 class="title">{{ $blog->title }}</h2>
                     <div class="author-section">
                        <div class="bio-pic">
                            <img src="{{ asset('uploads/'.$blog->user->image) }}" alt="{{ $blog->user->name }}">
                        </div>
                        <div class="author-info">
                            <div class="author-name">
                                <a href="#" class="text-decoration-none">{{ $blog->user->name }}</a> 
                                About
                              <a href="{{ route('shoppage', $blog->product_cat->slug) }}" class="">{{ $blog->product_cat->name }}</a>
                            </div>
                            <div class="post-meta">
                                {{ \Carbon\Carbon::parse($blog->created_at)->format('F j, Y') }} 
                                <span class="mx-1">•</span> 
                                3 min read 
                                <i class="bi bi-star-fill text-warning ms-1"></i>
                            </div>
                        </div>
                    </div>
             <div class="content">
                 
                 {!!$blog->content!!}

                </div><!-- End post content -->
                </article>
            </div>
            </section>

        </div>

         {{-- <div class="col-lg-4">
                    <div class="popular-posts">
                        <div class="section-title">
                            <h2>Popular Posts</h2>
                        </div>
                        
                        @foreach ($relatedBlogs as $index => $item)
                        <div class="trend-entry d-flex">
                            <div class="number align-self-start">{{ $index + 1 }}</div>
                            <div class="trend-contents">
                                <h5><a href="{{ route('website.blog.show', $item->slug) }}">{{ $item->title }}</a></h5>
                                <div class="post-meta">
                                    <span class="d-block">
                                        <a href="#" class="text-decoration-none">{{ $item->user->name }}</a> 
                                        in 
                                        <a href="{{ route('shoppage', $item->product_cat->slug) }}" class="text-decoration-none">{{ $item->product_cat->name }}</a>
                                    </span>
                                    <span class="text-muted">
                                        {{ \Carbon\Carbon::parse($item->created_at)->format('F j, Y') }} 
                                        <span class="mx-1">•</span> 
                                        3 min read 
                                        <i class="bi bi-star-fill text-warning ms-1"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                        <div class="mt-4 pt-2">
                            <a href="{{route('website.blog')}}" class="see-all-btn text-decoration-none">
                                See All Popular <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div> --}}

                <div class="col-lg-4 sidebar">

          <div class="widgets-container popular-posts">

            <!-- Search Widget -->
            <div class="search-widget widget-item">

              <h3 class="widget-title">Search</h3>
              <form action="">
                <input type="text">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
              </form>

            </div><!--/Search Widget -->

            

            <!-- Recent Posts Widget -->
            <div class="recent-posts-widget widget-item">

              <h3 class="widget-title">Recent Posts</h3>
              @foreach ($relatedBlogs as $index => $item)
                     
                         <div class="post-item">
                <img src="{{asset($item->image)}}" alt="" class="flex-shrink-0">
                <div>
                    <h4><a href="{{ route('website.blog.show', $item->slug) }}">{{ $item->title }}</a></h4>
                  <time datetime="2020-01-01"> {{ \Carbon\Carbon::parse($item->created_at)->format('F j, Y') }} </time>
                 
                </div>
              </div><!-- End recent post item-->
                        @endforeach
            </div><!--/Recent Posts Widget -->

<!-- Categories Widget -->
            <div class="categories-widget widget-item">

              <h3 class="widget-title">Categories</h3>
              <ul class="mt-3">
                <li><a href="#">General <span>(25)</span></a></li>
                <li><a href="#">Lifestyle <span>(12)</span></a></li>
                <li><a href="#">Travel <span>(5)</span></a></li>
                <li><a href="#">Design <span>(22)</span></a></li>
                <li><a href="#">Creative <span>(8)</span></a></li>
                <li><a href="#">Educaion <span>(14)</span></a></li>
              </ul>

            </div><!--/Categories Widget -->
            <!-- Tags Widget -->
            <div class="tags-widget widget-item">

              <h3 class="widget-title">Tags</h3>
              <ul>
                <li><a href="#">App</a></li>
                <li><a href="#">IT</a></li>
                <li><a href="#">Business</a></li>
                <li><a href="#">Mac</a></li>
                <li><a href="#">Design</a></li>
                <li><a href="#">Office</a></li>
                <li><a href="#">Creative</a></li>
                <li><a href="#">Studio</a></li>
                <li><a href="#">Smart</a></li>
                <li><a href="#">Tips</a></li>
                <li><a href="#">Marketing</a></li>
              </ul>

            </div><!--/Tags Widget -->

          </div>

        </div>
      </div>
     </div>
    </main>
@endsection

{{-- @extends('website.layout.content')

@section('webcontent')

<main class="main">

    

    <div class="container">
      <div class="row">

        <div class="col-lg-8">

          <!-- Blog Details Section -->
          <section id="blog-details" class="blog-details section">
            <div class="container">

              <article class="article">

                <div class="post-img">
                  <img src="{{ asset($blog->image) }}" alt="" class="img-fluid">
                </div>

                <h2 class="title">{{ $blog->title }}</h2>

                <div class="meta-top">
                  <ul>
                    <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-details.html">John Doe</a></li>
                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-details.html"><time datetime="2020-01-01">Jan 1, 2022</time></a></li>
                    <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="blog-details.html">12 Comments</a></li>
                  </ul>
                </div><!-- End meta top -->

                

                <div class="meta-bottom">
                  <i class="bi bi-folder"></i>
                  <ul class="cats">
                    <li><a href="#">Business</a></li>
                  </ul>

                  <i class="bi bi-tags"></i>
                  <ul class="tags">
                    <li><a href="#">Creative</a></li>
                    <li><a href="#">Tips</a></li>
                    <li><a href="#">Marketing</a></li>
                  </ul>
                </div><!-- End meta bottom -->

              </article>

            </div>
          </section><!-- /Blog Details Section -->

          <!-- Blog Comments Section -->
          <section id="blog-comments" class="blog-comments section">

            <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">

              <div class="blog-comments-3">
                <div class="section-header">
                  <h3>Discussion <span class="comment-count">(8)</span></h3>
                </div>

                <div class="comments-wrapper">
                  <!-- Comment 1 -->
                  <article class="comment-card">
                    <div class="comment-header">
                      <div class="user-info">
                        <img src="assets/img/person/person-f-9.webp" alt="User avatar" loading="lazy">
                        <div class="meta">
                          <h4 class="name">Sarah Williams</h4>
                          <span class="date"><i class="bi bi-calendar3"></i> February 13, 2025</span>
                        </div>
                      </div>
                    </div>
                    <div class="comment-content">
                      <p>Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.</p>
                    </div>
                    <div class="comment-actions">
                      <button class="action-btn like-btn">
                        <i class="bi bi-hand-thumbs-up"></i>
                        <span>12</span>
                      </button>
                      <button class="action-btn reply-btn">
                        <i class="bi bi-reply"></i>
                        <span>Reply</span>
                      </button>
                    </div>
                  </article>

                  <!-- Comment 2 with replies -->
                  <article class="comment-card">
                    <div class="comment-header">
                      <div class="user-info">
                        <img src="assets/img/person/person-m-9.webp" alt="User avatar" loading="lazy">
                        <div class="meta">
                          <h4 class="name">James Cooper</h4>
                          <span class="date"><i class="bi bi-calendar3"></i> February 13, 2025</span>
                        </div>
                      </div>
                    </div>
                    <div class="comment-content">
                      <p>Quisque ut nisi. Donec mi odio, faucibus at, scelerisque quis, convallis in, nisi. Suspendisse non nisl sit amet velit hendrerit rutrum. Ut leo. Ut a nisl id ante tempus hendrerit.</p>
                    </div>
                    <div class="comment-actions">
                      <button class="action-btn like-btn">
                        <i class="bi bi-hand-thumbs-up"></i>
                        <span>8</span>
                      </button>
                      <button class="action-btn reply-btn">
                        <i class="bi bi-reply"></i>
                        <span>Reply</span>
                      </button>
                    </div>

                    <!-- Reply Thread -->
                    <div class="reply-thread">
                      <!-- Reply 1 -->
                      <article class="comment-card reply">
                        <div class="comment-header">
                          <div class="user-info">
                            <img src="assets/img/person/person-f-9.webp" alt="User avatar" loading="lazy">
                            <div class="meta">
                              <h4 class="name">Emily Parker</h4>
                              <span class="date"><i class="bi bi-calendar3"></i> February 13, 2025</span>
                            </div>
                          </div>
                        </div>
                        <div class="comment-content">
                          <p>Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.</p>
                        </div>
                        <div class="comment-actions">
                          <button class="action-btn like-btn">
                            <i class="bi bi-hand-thumbs-up"></i>
                            <span>5</span>
                          </button>
                          <button class="action-btn reply-btn">
                            <i class="bi bi-reply"></i>
                            <span>Reply</span>
                          </button>
                        </div>
                      </article>

                      <!-- Reply 2 -->
                      <article class="comment-card reply">
                        <div class="comment-header">
                          <div class="user-info">
                            <img src="assets/img/person/person-f-7.webp" alt="User avatar" loading="lazy">
                            <div class="meta">
                              <h4 class="name">Daniel Brown</h4>
                              <span class="date"><i class="bi bi-calendar3"></i> February 13, 2025</span>
                            </div>
                          </div>
                        </div>
                        <div class="comment-content">
                          <p>Nam commodo suscipit quam. Vestibulum ullamcorper mauris at ligula. Fusce fermentum odio nec arcu.</p>
                        </div>
                        <div class="comment-actions">
                          <button class="action-btn like-btn">
                            <i class="bi bi-hand-thumbs-up"></i>
                            <span>3</span>
                          </button>
                          <button class="action-btn reply-btn">
                            <i class="bi bi-reply"></i>
                            <span>Reply</span>
                          </button>
                        </div>
                      </article>
                    </div>
                  </article>

                  <!-- Comment 3 -->
                  <article class="comment-card">
                    <div class="comment-header">
                      <div class="user-info">
                        <img src="assets/img/person/person-m-6.webp" alt="User avatar" loading="lazy">
                        <div class="meta">
                          <h4 class="name">Rachel Adams</h4>
                          <span class="date"><i class="bi bi-calendar3"></i> February 13, 2025</span>
                        </div>
                      </div>
                    </div>
                    <div class="comment-content">
                      <p>Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                    </div>
                    <div class="comment-actions">
                      <button class="action-btn like-btn">
                        <i class="bi bi-hand-thumbs-up"></i>
                        <span>6</span>
                      </button>
                      <button class="action-btn reply-btn">
                        <i class="bi bi-reply"></i>
                        <span>Reply</span>
                      </button>
                    </div>
                  </article>
                </div>
              </div>

            </div>

          </section><!-- /Blog Comments Section -->

          <!-- Blog Comment Form Section -->
          <section id="blog-comment-form" class="blog-comment-form section">

            <div class="container aos-init" data-aos="fade-up" data-aos-delay="100">

              <form method="post" role="form">

                <div class="section-header">
                  <h3>Share Your Thoughts</h3>
                  <p>Your email address will not be published. Required fields are marked *</p>
                </div>

                <div class="row gy-3">
                  <div class="col-md-6 form-group">
                    <label for="name">Full Name *</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter your full name" required="">
                  </div>

                  <div class="col-md-6 form-group">
                    <label for="email">Email Address *</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email address" required="">
                  </div>

                  <div class="col-12 form-group">
                    <label for="website">Website</label>
                    <input type="url" name="website" class="form-control" id="website" placeholder="Your website (optional)">
                  </div>

                  <div class="col-12 form-group">
                    <label for="comment">Your Comment *</label>
                    <textarea class="form-control" name="comment" id="comment" rows="5" placeholder="Write your thoughts here..." required=""></textarea>
                  </div>

                  <div class="col-12 text-center">
                    <button type="submit" class="btn-submit">Post Comment</button>
                  </div>
                </div>

              </form>

            </div>

          </section><!-- /Blog Comment Form Section -->

        </div>

        <div class="col-lg-4 sidebar">

          <div class="widgets-container">

            <!-- Search Widget -->
            <div class="search-widget widget-item">

              <h3 class="widget-title">Search</h3>
              <form action="">
                <input type="text">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
              </form>

            </div><!--/Search Widget -->

            <!-- Categories Widget -->
            <div class="categories-widget widget-item">

              <h3 class="widget-title">Categories</h3>
              <ul class="mt-3">
                <li><a href="#">General <span>(25)</span></a></li>
                <li><a href="#">Lifestyle <span>(12)</span></a></li>
                <li><a href="#">Travel <span>(5)</span></a></li>
                <li><a href="#">Design <span>(22)</span></a></li>
                <li><a href="#">Creative <span>(8)</span></a></li>
                <li><a href="#">Educaion <span>(14)</span></a></li>
              </ul>

            </div><!--/Categories Widget -->

            <!-- Recent Posts Widget -->
            <div class="recent-posts-widget widget-item">

              <h3 class="widget-title">Recent Posts</h3>

              <div class="post-item">
                <img src="assets/img/blog/blog-post-square-1.webp" alt="" class="flex-shrink-0">
                <div>
                  <h4><a href="blog-details.html">Nihil blanditiis at in nihil autem</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>
              </div><!-- End recent post item-->

              <div class="post-item">
                <img src="assets/img/blog/blog-post-square-2.webp" alt="" class="flex-shrink-0">
                <div>
                  <h4><a href="blog-details.html">Quidem autem et impedit</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>
              </div><!-- End recent post item-->

              <div class="post-item">
                <img src="assets/img/blog/blog-post-square-3.webp" alt="" class="flex-shrink-0">
                <div>
                  <h4><a href="blog-details.html">Id quia et et ut maxime similique occaecati ut</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>
              </div><!-- End recent post item-->

              <div class="post-item">
                <img src="assets/img/blog/blog-post-square-4.webp" alt="" class="flex-shrink-0">
                <div>
                  <h4><a href="blog-details.html">Laborum corporis quo dara net para</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>
              </div><!-- End recent post item-->

              <div class="post-item">
                <img src="assets/img/blog/blog-post-square-5.webp" alt="" class="flex-shrink-0">
                <div>
                  <h4><a href="blog-details.html">Et dolores corrupti quae illo quod dolor</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>
              </div><!-- End recent post item-->

            </div><!--/Recent Posts Widget -->

            <!-- Tags Widget -->
            <div class="tags-widget widget-item">

              <h3 class="widget-title">Tags</h3>
              <ul>
                <li><a href="#">App</a></li>
                <li><a href="#">IT</a></li>
                <li><a href="#">Business</a></li>
                <li><a href="#">Mac</a></li>
                <li><a href="#">Design</a></li>
                <li><a href="#">Office</a></li>
                <li><a href="#">Creative</a></li>
                <li><a href="#">Studio</a></li>
                <li><a href="#">Smart</a></li>
                <li><a href="#">Tips</a></li>
                <li><a href="#">Marketing</a></li>
              </ul>

            </div><!--/Tags Widget -->

          </div>

        </div>

      </div>
    </div>

  </main>
  @endsection --}}
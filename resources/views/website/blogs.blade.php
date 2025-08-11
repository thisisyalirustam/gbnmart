@extends('website.layout.content')

@section('webcontent')
    <style>
        /* Your existing styles */
        .blog-card {
            transition: all 0.3s ease;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            height: 100%;
        }
        .blog-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }
        .blog-img-container {
            height: 200px;
            overflow: hidden;
        }
        .blog-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        .blog-card:hover .blog-img {
            transform: scale(1.05);
        }
        .blog-category {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(0,0,0,0.7);
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
        }
        .blog-meta {
            font-size: 0.85rem;
        }
        .blog-title {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .blog-excerpt {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .read-more-btn {
            position: relative;
            padding-right: 25px;
        }
        .read-more-btn:after {
            content: '→';
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            transition: all 0.3s ease;
        }
        .read-more-btn:hover:after {
            right: 0;
        }
        
        /* New styles for recent posts section */
        .recent-post-card {
            transition: all 0.3s ease;
            height: 100%;
        }
        .recent-post-img-container {
            position: relative;
            height: 250px;
            overflow: hidden;
            border-radius: 8px;
        }
        .recent-post-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        .recent-post-card:hover .recent-post-img {
            transform: scale(1.05);
        }
        .post-content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
            color: white;
            padding: 20px;
        }
        .post-category {
            background: rgba(255,255,255,0.2);
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            margin-bottom: 10px;
        }
        .post-meta {
            font-size: 0.85rem;
            opacity: 0.9;
        }
    </style>

<main class="main">
    <!-- Page Title -->
    <div class="page-title light-background">
        <div class="container">
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="">Home</a></li>
                    <li class="current">Blog</li>
                </ol>
            </nav>
            <h1>Blog</h1>
        </div>
    </div><!-- End Page Title -->

    <!-- Blog Grid Section -->
    <section id="blog-grid" class="blog-grid section py-5">
        <div class="container">
            <div class="row g-4">
                @forelse($blogs as $blog)
                <div class="col-md-6 col-lg-4">
                    <div class="blog-card">
                        <div class="position-relative blog-img-container">
                            <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" class="blog-img">
                            <a href="{{ route('shoppage', $blog->product_cat->slug) }}" class="blog-category">
                                {{ $blog->product_cat->name }}
                            </a>
                        </div>
                        <div class="p-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="me-3">
                                    <img src="{{ asset('uploads/'.$blog->user->image) }}" alt="{{ $blog->user->name }}" 
                                         class="rounded-circle" width="40" height="40">
                                </div>
                                <div class="blog-meta">
                                    <div class="fw-bold">{{ $blog->user->name }}</div>
                                    <div class="text-muted small">
                                        {{ $blog->created_at->format('M d, Y') }} · 3 min read
                                    </div>
                                </div>
                            </div>
                            
                            <h3 class="h5 blog-title mb-2">
                                <a href="{{ route('website.blog.show', $blog->slug) }}" class="text-decoration-none text-dark">
                                    {{ $blog->title }}
                                </a>
                            </h3>
                            
                            <p class="text-muted blog-excerpt mb-3">
                                {{ Str::limit(strip_tags($blog->content), 150) }}
                            </p>
                            
                            <a href="{{ route('website.blog.show', $blog->slug) }}" 
                               class="read-more-btn text-decoration-none">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <h4>No blogs found</h4>
                    <p>Check back later for new content</p>
                </div>
                @endforelse
            </div>
            
            @if($blogs->hasPages())
            <div class="row mt-5">
                <div class="col-12 d-flex justify-content-center">
                    {{ $blogs->links() }}
                </div>
            </div>
            @endif
        </div>
    </section><!-- End Blog Grid Section -->

    <!-- Recent Posts Section -->
    <section id="recent-posts" class="recent-posts section bg-light py-5">
        <div class="container">
            <!-- Section Title -->
            <div class="section-title text-center mb-5">
                <h2>Recent Posts</h2>
                <p>Discover our latest articles and updates</p>
            </div><!-- End Section Title -->

            <div class="row g-4">
                @foreach($blogs->take(6) as $blog)
                <div class="col-md-6 col-lg-4">
                    <article class="recent-post-card">
                        <div class="recent-post-img-container">
                            <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" class="recent-post-img">
                            <div class="post-content">
                                <a href="{{ route('shoppage', $blog->product_cat->slug) }}" class="post-category">
                                    {{ $blog->product_cat->name }}
                                </a>
                                <h3 class="h4 mb-2">
                                    <a href="{{ route('website.blog.show', $blog->slug) }}" class="text-white text-decoration-none">
                                        {{ Str::limit($blog->title, 60) }}
                                    </a>
                                </h3>
                                <div class="post-meta">
                                    <time datetime="{{ $blog->created_at->format('Y-m-d') }}">
                                        {{ $blog->created_at->format('M d, Y') }}
                                    </time>
                                    <span class="px-2">•</span>
                                    <span>3 min read</span>
                                </div>
                            </div>
                        </div>
                    </article>
                </div><!-- End post list item -->
                @endforeach
            </div>
        </div>
    </section><!-- /Recent Posts Section -->
</main>
   
@endsection
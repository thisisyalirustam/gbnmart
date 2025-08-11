@extends('website.layout.content')

@section('webcontent')
    <style>
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
    </style>

<main class="main">
     <div class="container py-5">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h1 class="display-5 fw-bold">Our Blog</h1>
                <p class="lead">Discover the latest news and insights</p>
            </div>
        </div>

        <div class="row g-4">
            @forelse($blogs as $blog)
            <div class="col-md-6 col-lg-3">
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
</main>
   
@endsection
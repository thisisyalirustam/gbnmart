<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Ogani | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('website/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('website/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('website/css/elegant-icons.css') }}" type="text/css">
    {{--
    <link rel="stylesheet" href="{{asset('website/css/nice-select.css')}}" type="text/css"> --}}
    <link rel="stylesheet" href=" {{ asset('website/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('website/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href=" {{ asset('website/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('website/css/style.css ') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('website/coustom_css/css.css') }}" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Toastr JS -->

</head>

<body>
    <!-- Page Preloder -->

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <style>
        .header_meddle {
            position: relative;
            z-index: 1000;
        }

        .header_meddle.sticky {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background-color: rgba(212, 211, 208, 0.925);
            box-shadow: 0 4px 2px -2px rgb(73, 73, 73);
            transition: all 0.3s ease-in-out;
        }

        body.sticky-header-active {
            padding-top: 100px;
        }

        /* .user-details{
            background-color: rgb(247, 243, 233);
        } */
    </style>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="{{ route('homepage') }}"><img src="{{ asset(settings()->logo) }}" alt="Logo"></a>
        </div>

        <div class="humberger__menu__cart">
            <ul>
                <li>
                    <a href="{{ route('wishlist.show') }}">
                        <i class="fa fa-heart"></i>
                        <span id="wishlist-count">{{ $wishlistCount ?? 0 }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('cart.show') }}">
                        <i class="fa fa-shopping-bag"></i>
                        <span id="cart-count">{{ $cartCount ?? 0 }}</span>
                    </a>
                </li>
            </ul>
            <div class="header__cart__price">
                Items: <span>${{ $totalCartPrice ?? 0 }}</span> <!-- Optional: Total price of the cart -->
            </div>
        </div>

        <div class="humberger__menu__widget">
            <div class="header__top__right__language">
                <img src="img/language.png" alt="">
                <div>English</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">Spanish</a></li>
                    <li><a href="#">English</a></li>
                </ul>
            </div>

            <div class="header__top__right__auth">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('dashboard') }}"><i class="fa fa-user"></i> Profile</a>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                class="fa fa-sign-out"></i> Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <a href="{{ route('login') }}"><i class="fa fa-user"></i> Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"><i class="fa fa-user-secret"></i> Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>

        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="{{ route('homepage') }}">Home</a></li>
                <li class="dropdown">
                    <a href="{{ route('shoppage') }}">Shop</a>
                    <ul class="header__menu__dropdown">
                        @foreach (getCategories() as $category)
                            <li><a href="{{ route('shoppage', $category->slug) }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li><a href="./blog.html">Blog</a></li>
                <li><a href="./contact.html">Contact</a></li>
            </ul>
        </nav>

        <div id="mobile-menu-wrap"></div>

        <div class="header__top__right__social">
            <a href="{{ settings()->facebook }}"><i class="fa fa-facebook"></i></a>
            <a href="{{ settings()->twitter }}"><i class="fa fa-twitter"></i></a>
            <a href="{{ settings()->linkedin }}"><i class="fa fa-linkedin"></i></a>
            <a href="{{ settings()->pinterest }}"><i class="fa fa-pinterest-p"></i></a>
        </div>

        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> {{ settings()->email }}</li>
                <li>Free Shipping for all Orders over $99</li>
            </ul>
        </div>
    </div>

    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> {{ settings()->email }}</li>
                                <li>Free Shipping for all Order of $99</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="{{ settings()->facebook }}"><i class="fa fa-facebook"></i></a>
                                <a href="{{ settings()->twitter }}"><i class="fa fa-twitter"></i></a>
                                <a href="{{ settings()->linkedin }}"><i class="fa fa-linkedin"></i></a>
                            </div>
                            <div class="header__top__right__language">
                                <img src="img/language.png" alt="">
                                <div>English</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="#">Spanis</a></li>
                                    <li><a href="#">English</a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid header_meddle">
            <div class="row align-items-center">
                <!-- Logo Section -->
                <div class="col-lg-2">
                    <div class="header__logo">
                        <a href="{{ route('homepage')}}"><img src="{{ asset(settings()->logo) }}" alt="Logo"
                                class="img-fluid"></a>
                    </div>
                </div>

                <!-- Navigation Menu Section -->
                <div class="col-lg-5">
                    <nav class="header__menu">
                        <ul class="nav ">
                            <li class="nav-item"><a class="nav-link active" href="{{ route('homepage') }}">Home</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link " href="{{ route('shoppage') }}" id="shopDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                                <ul class="header__menu__dropdown">
                                    @php
                                        $categories = getCategories();
                                    @endphp
                                    @if ($categories->isEmpty())
                                        <li><a href="javascript:void(0);">No categories available</a></li>
                                    @else
                                        @foreach ($categories as $category)
                                            <li><a href="{{ route('shoppage', $category->slug) }}">{{ $category->name }}</a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </li>
                            <li><a class="nav-link" href="./blog.html">Blog</a></li>
                            <li><a class="nav-link" href="./contact.html">Contact</a></li>
                            <li><a class="nav-link" href="./blog.html">Blog</a></li>

                        </ul>
                    </nav>
                </div>
                <!-- Cart and Wishlist Section -->
                <div class="col-lg-3 d-flex justify-content-end">
                    <div class="header__cart d-flex align-items-center">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item"><a href="{{ route('wishlist.show') }}"><i
                                        class="fa fa-heart"></i> <span
                                        id="wishlist-count">{{ getWishlistCount() }}</span></a></li>
                            <li class="list-inline-item"><a href="{{ route('cart.show') }}"><i
                                        class="fa fa-shopping-bag"></i> <span
                                        id="cart-count">{{ $cartCount ?? 0 }}</span>
                                </a></li>
                        </ul>
                        {{-- <div class="header__cart__price ms-3">Items: <span>$150.00</span></div> --}}
                    </div>
                </div>

                <!-- User Profile Section -->
                <div class="col-lg-2 d-flex  user-details">
                    @if (Route::has('login'))
                        <nav class="d-flex align-items-center">
                            @auth
                                <div class="user-profile-dropdown me-2">
                                    <a href="{{ route('dashboard') }}" class="btn btn-link text-dark"><i class="fa fa-user"></i>
                                        Profile</a>
                                </div>
                                <div class="user-profile-dropdown me-2">
                                    <a href="javascript:void(0);" class="btn btn-link text-dark"><i
                                            class="fa fa-user-secret"></i> {{ Auth::user()->name }}</a>
                                </div>
                            @else
                                <div class="user-auth-buttons me-2">
                                    <a href="{{ route('login') }}" class="btn btn-link text-dark"><i class="fa fa-user"></i>
                                        Login</a>
                                </div>
                                @if (Route::has('register'))
                                    <div class="user-auth-buttons">
                                        <a href="{{ route('register') }}" class="btn btn-link text-dark"><i
                                                class="fa fa-user-secret"></i> Register</a>
                                    </div>
                                @endif
                            @endauth
                        </nav>
                    @endif
                </div>
            </div>
            <!-- Hamburger Menu -->
            <div class="humberger__open d-lg-none">
                <i class="fa fa-bars"></i>
            </div>
        </div>

    </header>
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>All departments</span>
                        </div>
                        <ul>
                            @if (getCategories()->isNotEmpty())
                                @foreach (getCategories() as $category)
                                    <li><a href="{{ route('shoppage', $category->slug) }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="{{ route('shoppage') }}" method="GET">
                                <div class="hero__search__categories">
                                    All Categories
                                    <span class="arrow_carrot-down"></span>
                                </div>
                                <input type="text" name="search" value="{{ Request::get('search') }}" id="search"
                                    placeholder="What do yo u need?">
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>{{ settings()->phone }}</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        window.onscroll = function () {
            stickyHeader();
        };

        var header = document.querySelector('.header_meddle');
        var sticky = header.offsetTop;

        function stickyHeader() {
            if (window.pageYOffset > sticky) {
                header.classList.add("sticky");
                document.body.classList.add("sticky-header-active");
            } else {
                header.classList.remove("sticky");
                document.body.classList.remove("sticky-header-active");
            }
        }

    </script>
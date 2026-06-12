@extends('layouts.home')

@section('title', 'Home - Molla Shop')

@section('content')
    {{-- Intro Banner --}}
    <div class="intro-section">
        <div class="intro-slider-container">
            <div class="intro-slider owl-carousel owl-simple owl-light owl-nav-inside" data-toggle="owl"
                 data-owl-options='{"dots": true, "nav": false}'>
                <div class="intro-slide" style="background-image: url('{{ asset('assets/shop/images/demos/demo-2/slides/slide-1.jpg') }}');">
                    <div class="container intro-content">
                        <div class="row">
                            <div class="col-auto intro-info">
                                <h3 class="intro-subtitle">Sale Off</h3>
                                <h1 class="intro-title">Shop Now</h1>
                                <a href="#" class="btn btn-outline-white-4">
                                    <span>Discover More</span>
                                </a>
                            </div><!-- End .intro-info -->
                        </div><!-- End .row -->
                    </div><!-- End .container -->
                </div><!-- End .intro-slide -->
            </div><!-- End .intro-slider -->
        </div><!-- End .intro-slider-container -->
    </div><!-- End .intro-section -->

    {{-- Products Grid --}}
    <div class="container py-5">
        <div class="heading text-center mb-5">
            <h2 class="title">Our Products</h2>
            <p class="title-desc">Find what you need</p>
        </div><!-- End .heading -->

        <div class="row">
            @forelse ($products as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product">
                        <figure class="product-media">
                            <a href="{{ route('product', $product->id) }}">
                                <img src="{{ $product->image ? asset('uploads/products/' . $product->image) : 'https://via.placeholder.com/300x300' }}"
                                     alt="{{ $product->title }}" class="product-image">
                            </a>
                            @if ($product->discount > 0)
                                <div class="product-label-group">
                                    <label class="product-label label-sale">-{{ $product->discount }}%</label>
                                </div>
                            @endif
                            <div class="product-action-vertical">
                                <a href="{{ route('product', $product->id) }}" class="btn-product-icon btn-wishlist btn-expandable">
                                    <span>view</span>
                                </a>
                            </div><!-- End .product-action-vertical -->
                        </figure><!-- End .product-media -->

                        <div class="product-body">
                            <div class="product-cat">
                                <a href="{{ $product->category ? route('category', $product->category->slug) : '#' }}">
                                    {{ $product->category->title ?? 'Uncategorized' }}
                                </a>
                            </div><!-- End .product-cat -->
                            <h3 class="product-title">
                                <a href="{{ route('product', $product->id) }}">{{ $product->title }}</a>
                            </h3><!-- End .product-title -->

                            <div class="product-price">
                                @if ($product->discount > 0)
                                    <span class="new-price">${{ number_format($product->discounted_price, 2) }}</span>
                                    <span class="old-price">${{ number_format($product->price, 2) }}</span>
                                @else
                                    <span class="new-price">${{ number_format($product->price, 2) }}</span>
                                @endif
                            </div><!-- End .product-price -->

                            <div class="product-action">
                                <a href="{{ auth()->check() ? route('cart.index') : route('login') }}"
                                   class="btn-product btn-cart" title="Add to cart">
                                    <span>add to cart</span>
                                </a>
                            </div><!-- End .product-action -->
                        </div><!-- End .product-body -->
                    </div><!-- End .product -->
                </div><!-- End .col -->
            @empty
                <div class="col-12 text-center py-5">
                    <p>No products available yet. Check back soon!</p>
                </div>
            @endforelse
        </div><!-- End .row -->
    </div><!-- End .container -->
@endsection

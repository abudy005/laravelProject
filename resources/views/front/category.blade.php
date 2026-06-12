@extends('layouts.home')

@section('title', $category->title . ' - Molla Shop')

@section('content')
    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $category->title }}</li>
            </ol>
        </div>
    </nav>

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-4">
                    <h1 class="page-title">{{ $category->title }}
                        <span>{{ $products->count() }} Products Found</span>
                    </h1>
                </div>
            </div>

            <div class="products mb-3">
                <div class="row justify-content-center">
                    @forelse ($products as $product)
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="product product-7 text-center">
                                <figure class="product-media">
                                    @if ($product->discount > 0)
                                        <span class="product-label label-sale">-{{ $product->discount }}%</span>
                                    @endif
                                    <a href="{{ route('product', $product->id) }}">
                                        <img src="{{ $product->image ? asset('uploads/products/' . $product->image) : 'https://via.placeholder.com/300x300' }}"
                                             alt="{{ $product->title }}" class="product-image">
                                    </a>
                                    <div class="product-action">
                                        <a href="{{ route('product', $product->id) }}" class="btn-product btn-cart"><span>view product</span></a>
                                    </div>
                                </figure>

                                <div class="product-body">
                                    <div class="product-cat">
                                        <a href="{{ route('category', $category->slug) }}">{{ $category->title }}</a>
                                    </div>
                                    <h3 class="product-title">
                                        <a href="{{ route('product', $product->id) }}">{{ $product->title }}</a>
                                    </h3>
                                    <div class="product-price">
                                        @if ($product->discount > 0)
                                            <span class="new-price">${{ number_format($product->discounted_price, 2) }}</span>
                                            <span class="old-price">${{ number_format($product->price, 2) }}</span>
                                        @else
                                            ${{ number_format($product->price, 2) }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <p>No products in this category yet.</p>
                            <a href="{{ route('home') }}" class="btn btn-outline-primary-2">
                                <span>Back to Home</span>
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.home')

@section('title', $product->title . ' - Molla Shop')

@section('content')
    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                @if ($product->category)
                    <li class="breadcrumb-item">
                        <a href="{{ route('category', $product->category->slug) }}">{{ $product->category->title }}</a>
                    </li>
                @endif
                <li class="breadcrumb-item active">{{ $product->title }}</li>
            </ol>
        </div>
    </nav>

    <div class="page-content">
        <div class="container">
            <div class="product-details-top">
                <div class="row">
                    {{-- Product image --}}
                    <div class="col-md-6">
                        <div class="product-gallery product-gallery-vertical">
                            <div class="row">
                                <figure class="product-main-image">
                                    @if ($product->discount > 0)
                                        <span class="product-label label-sale">-{{ $product->discount }}%</span>
                                    @endif
                                    <img src="{{ $product->image ? asset('uploads/products/' . $product->image) : 'https://via.placeholder.com/600x600' }}"
                                         alt="{{ $product->title }}" class="product-image">
                                </figure>
                            </div>
                        </div>
                    </div>

                    {{-- Product info --}}
                    <div class="col-md-6">
                        <div class="product-details">
                            <h1 class="product-title">{{ $product->title }}</h1>

                            <div class="product-price">
                                @if ($product->discount > 0)
                                    <span class="new-price">${{ number_format($product->discounted_price, 2) }}</span>
                                    <span class="old-price">${{ number_format($product->price, 2) }}</span>
                                @else
                                    ${{ number_format($product->price, 2) }}
                                @endif
                            </div>

                            @if ($product->description)
                                <div class="product-content">
                                    <p>{{ $product->description }}</p>
                                </div>
                            @endif

                            <div class="details-filter-row details-row-size">
                                <label>Availability:</label>
                                @if ($product->stock > 0)
                                    <span class="text-success">{{ $product->stock }} in stock</span>
                                @else
                                    <span class="text-danger">Out of stock</span>
                                @endif
                            </div>

                            @if (session('error'))
                                <div class="alert alert-danger mt-2">{{ session('error') }}</div>
                            @endif

                            @if ($product->stock > 0)
                                <div class="product-details-action">
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-flex align-items-center">
                                        @csrf
                                        <div class="details-filter-row details-row-size me-3">
                                            <label for="qty">Qty:</label>
                                            <div class="product-details-quantity">
                                                <input type="number" id="qty" name="quantity" class="form-control"
                                                       value="1" min="1" max="{{ $product->stock }}" step="1" data-decimals="0" required>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn-product btn-cart"><span>add to cart</span></button>
                                    </form>
                                </div>
                            @else
                                <div class="product-details-action">
                                    <button class="btn-product btn-cart" disabled><span>out of stock</span></button>
                                </div>
                            @endif

                            <div class="product-details-footer">
                                @if ($product->category)
                                    <div class="product-cat">
                                        <span>Category:</span>
                                        <a href="{{ route('category', $product->category->slug) }}">{{ $product->category->title }}</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Description / Reviews tabs --}}
            <div class="product-details-tab">
                <ul class="nav nav-pills justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab"
                           role="tab" aria-selected="true">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab"
                           role="tab" aria-selected="false">Reviews</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel">
                        <div class="product-desc-content">
                            @if ($product->detail)
                                <p>{!! nl2br(e($product->detail)) !!}</p>
                            @else
                                <p>No description provided for this product.</p>
                            @endif
                        </div>
                    </div>
                    <div class="tab-pane fade" id="product-review-tab" role="tabpanel">
                        <div class="product-desc-content">
                            <p>No reviews yet. Be the first to review this product.</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Related products --}}
            @if ($related->isNotEmpty())
                <div class="products-section-title">
                    <h2 class="section-title">Related Products</h2>
                </div>
                <div class="products">
                    <div class="row justify-content-center">
                        @foreach ($related as $item)
                            <div class="col-6 col-md-4 col-lg-3">
                                <div class="product product-7 text-center">
                                    <figure class="product-media">
                                        @if ($item->discount > 0)
                                            <span class="product-label label-sale">-{{ $item->discount }}%</span>
                                        @endif
                                        <a href="{{ route('product', $item->id) }}">
                                            <img src="{{ $item->image ? asset('uploads/products/' . $item->image) : 'https://via.placeholder.com/300x300' }}"
                                                 alt="{{ $item->title }}" class="product-image">
                                        </a>
                                        <div class="product-action">
                                            <a href="{{ route('product', $item->id) }}" class="btn-product btn-cart"><span>view product</span></a>
                                        </div>
                                    </figure>
                                    <div class="product-body">
                                        <div class="product-cat">
                                            @if ($item->category)
                                                <a href="{{ route('category', $item->category->slug) }}">{{ $item->category->title }}</a>
                                            @endif
                                        </div>
                                        <h3 class="product-title"><a href="{{ route('product', $item->id) }}">{{ $item->title }}</a></h3>
                                        <div class="product-price">
                                            @if ($item->discount > 0)
                                                <span class="new-price">${{ number_format($item->discounted_price, 2) }}</span>
                                                <span class="old-price">${{ number_format($item->price, 2) }}</span>
                                            @else
                                                ${{ number_format($item->price, 2) }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@extends('layouts.home')

@section('title', 'My Cart')

@section('content')
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Cart</li>
            </ol>
        </div>
    </nav>

    <div class="page-content">
        <div class="cart">
            <div class="container">

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    </div>
                @endif

                @if ($cartItems->count() > 0)
                    @php $subtotal = 0; @endphp
                    <div class="row">
                        <div class="col-lg-9">
                            <table class="table table-cart table-mobile">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartItems as $item)
                                        @php
                                            $lineTotal = $item->price * $item->quantity;
                                            $subtotal += $lineTotal;
                                        @endphp
                                        <tr>
                                            <td class="product-col">
                                                <div class="product">
                                                    <figure class="product-media">
                                                        <a href="{{ $item->product ? route('product', $item->product->id) : '#' }}">
                                                            <img src="{{ $item->product && $item->product->image ? asset('uploads/products/' . $item->product->image) : 'https://via.placeholder.com/80x80' }}"
                                                                 alt="{{ $item->product->title ?? 'Product' }}">
                                                        </a>
                                                    </figure>
                                                    <h3 class="product-title">
                                                        @if ($item->product)
                                                            <a href="{{ route('product', $item->product->id) }}">{{ $item->product->title }}</a>
                                                        @else
                                                            <span class="text-muted">Product Deleted</span>
                                                        @endif
                                                    </h3>
                                                </div>
                                            </td>
                                            <td class="price-col">${{ number_format($item->price, 2) }}</td>
                                            <td class="quantity-col">
                                                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex align-items-center">
                                                    @csrf
                                                    <div class="cart-product-quantity">
                                                        <input type="number" name="quantity" class="form-control"
                                                               value="{{ $item->quantity }}" min="1" step="1" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-sm btn-primary ml-2">Update</button>
                                                </form>
                                            </td>
                                            <td class="total-col">${{ number_format($lineTotal, 2) }}</td>
                                            <td class="remove-col">
                                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-remove"><i class="icon-close"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="cart-bottom">
                                <a href="{{ route('home') }}" class="btn btn-outline-dark-2">
                                    <span>CONTINUE SHOPPING</span><i class="icon-refresh"></i>
                                </a>
                            </div>
                        </div><!-- End .col-lg-9 -->

                        <aside class="col-lg-3">
                            <div class="summary summary-cart">
                                <h3 class="summary-title">Cart Total</h3>

                                <table class="table table-summary">
                                    <tbody>
                                        <tr class="summary-subtotal">
                                            <td>Subtotal:</td>
                                            <td>${{ number_format($subtotal, 2) }}</td>
                                        </tr>
                                        <tr class="summary-total">
                                            <td>Total:</td>
                                            <td>${{ number_format($subtotal, 2) }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <a href="{{ route('checkout') }}" class="btn btn-outline-primary-2 btn-order btn-block">
                                    PROCEED TO CHECKOUT
                                </a>
                            </div>
                        </aside>
                    </div>
                @else
                    <div class="text-center py-5">
                        <p>Your cart is empty.</p>
                        <a href="{{ route('home') }}" class="btn btn-outline-primary-2">
                            <span>Start Shopping</span>
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection

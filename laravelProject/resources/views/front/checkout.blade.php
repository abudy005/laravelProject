@extends('layouts.home')

@section('title', 'Checkout')

@section('content')
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('cart.index') }}">My Cart</a></li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
        </div>
    </nav>

    <div class="page-content">
        <div class="checkout">
            <div class="container">

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('place.order') }}" method="POST">
                    @csrf
                    <div class="row">
                        {{-- Billing Details --}}
                        <div class="col-lg-9">
                            <h2 class="checkout-title">Billing Details</h2>

                            <div class="form-group">
                                <label>Full Name *</label>
                                <input type="text" name="name" class="form-control"
                                       value="{{ old('name', auth()->user()->name ?? '') }}" required>
                            </div>

                            <div class="form-group">
                                <label>Email Address *</label>
                                <input type="email" name="email" class="form-control"
                                       value="{{ old('email', auth()->user()->email ?? '') }}" required>
                            </div>

                            <div class="form-group">
                                <label>Street Address *</label>
                                <input type="text" name="address" class="form-control"
                                       placeholder="House number and street name"
                                       value="{{ old('address') }}" required>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Town / City</label>
                                        <input type="text" name="city" class="form-control" value="{{ old('city') }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Country</label>
                                        <input type="text" name="country" class="form-control" value="{{ old('country') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Postcode / ZIP</label>
                                        <input type="text" name="zip_code" class="form-control" value="{{ old('zip_code') }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="tel" name="phone" class="form-control" value="{{ old('phone') }}">
                                    </div>
                                </div>
                            </div>

                            <h2 class="checkout-title mt-5">Shipping Method</h2>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="shipping-1" name="shipping_method"
                                       class="custom-control-input" value="Free Shipping" checked>
                                <label class="custom-control-label" for="shipping-1">Free Shipping &mdash; $0.00</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="shipping-2" name="shipping_method"
                                       class="custom-control-input" value="Standard Shipping">
                                <label class="custom-control-label" for="shipping-2">Standard Shipping &mdash; $4.00</label>
                            </div>

                            <h2 class="checkout-title mt-4">Payment Method</h2>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="payment-1" name="payment_method"
                                       class="custom-control-input" value="Direct Bank Transfer" checked>
                                <label class="custom-control-label" for="payment-1">Direct Bank Transfer</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="payment-2" name="payment_method"
                                       class="custom-control-input" value="Cash on Delivery">
                                <label class="custom-control-label" for="payment-2">Cash on Delivery</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="payment-3" name="payment_method"
                                       class="custom-control-input" value="Paypal">
                                <label class="custom-control-label" for="payment-3">Paypal</label>
                            </div>
                        </div><!-- End .col-lg-9 -->

                        {{-- Order Summary --}}
                        <aside class="col-lg-3">
                            <div class="summary">
                                <h3 class="summary-title">Your Order</h3>

                                <table class="table table-summary">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cartItems as $item)
                                            <tr>
                                                <td>{{ $item->product->title ?? 'Product Deleted' }} &times; {{ $item->quantity }}</td>
                                                <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                                            </tr>
                                        @endforeach
                                        <tr class="summary-subtotal">
                                            <td>Subtotal:</td>
                                            <td>${{ number_format($subtotal, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Shipping:</td>
                                            <td>Free / Standard</td>
                                        </tr>
                                        <tr class="summary-total">
                                            <td>Total:</td>
                                            <td>${{ number_format($total, 2) }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                                    PLACE ORDER
                                </button>
                            </div>
                        </aside>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

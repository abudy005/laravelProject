@extends('layouts.admin')

@section('title', 'Order Detail')

@section('content')

  @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
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

  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="fs-3 mb-0">Order Detail #{{ $order->id }}</h1>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">
      <i class="ti ti-arrow-left"></i> Back to Orders
    </a>
  </div>

  <div class="row g-3">
    {{-- Customer information --}}
    <div class="col-md-6">
      <div class="card h-100">
        <div class="card-header"><h5 class="card-title mb-0">Customer Information</h5></div>
        <div class="card-body">
          <table class="table table-bordered mb-0">
            <tr><th style="width: 150px;">Name</th><td>{{ $order->name }}</td></tr>
            <tr><th>Email</th><td>{{ $order->email }}</td></tr>
            <tr><th>Phone</th><td>{{ $order->phone }}</td></tr>
            <tr><th>Address</th><td>{{ $order->address }}</td></tr>
            <tr><th>City</th><td>{{ $order->city }}</td></tr>
            <tr><th>Country</th><td>{{ $order->country }}</td></tr>
            <tr><th>ZIP Code</th><td>{{ $order->zip_code }}</td></tr>
          </table>
        </div>
      </div>
    </div>

    {{-- Order information + status change --}}
    <div class="col-md-6">
      <div class="card h-100">
        <div class="card-header"><h5 class="card-title mb-0">Order Information</h5></div>
        <div class="card-body">
          <table class="table table-bordered">
            <tr><th style="width: 180px;">Order ID</th><td>{{ $order->id }}</td></tr>
            <tr><th>Current Status</th><td>@include('admin.orders.partials.status-badge', ['status' => $order->status])</td></tr>
            <tr><th>Payment Method</th><td>{{ $order->payment_method }}</td></tr>
            <tr><th>Shipping Method</th><td>{{ $order->shipping_method }}</td></tr>
            <tr><th>Order Date</th><td>{{ $order->created_at->format('m/d/Y H:i') }}</td></tr>
            <tr><th>Subtotal</th><td>${{ number_format($order->subtotal, 2) }}</td></tr>
            <tr><th>Shipping Price</th><td>${{ number_format($order->shipping_price, 2) }}</td></tr>
            <tr><th>Total</th><td><strong>${{ number_format($order->total, 2) }}</strong></td></tr>
          </table>

          <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
            @csrf
            <div class="mb-2">
              <label for="status" class="form-label">Change Status</label>
              <select name="status" id="status" class="form-select">
                @foreach ($statuses as $item)
                  <option value="{{ $item }}" {{ $order->status == $item ? 'selected' : '' }}>{{ $item }}</option>
                @endforeach
              </select>
            </div>
            <button type="submit" class="btn btn-success">Update Status</button>
          </form>
        </div>
      </div>
    </div>

    {{-- Order items --}}
    <div class="col-12">
      <div class="card">
        <div class="card-header"><h5 class="card-title mb-0">Order Items</h5></div>
        <div class="card-body table-responsive">
          <table class="table table-bordered mb-0">
            <thead class="table-light">
              <tr>
                <th>Product ID</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($order->items as $item)
                <tr>
                  <td>{{ $item->product_id }}</td>
                  <td>{{ $item->product_title }}</td>
                  <td>${{ number_format($item->price, 2) }}</td>
                  <td>{{ $item->quantity }}</td>
                  <td>${{ number_format($item->total, 2) }}</td>
                </tr>
              @empty
                <tr><td colspan="5" class="text-center text-muted">No order items found.</td></tr>
              @endforelse
            </tbody>
            <tfoot>
              <tr><th colspan="4" class="text-end">Subtotal</th><th>${{ number_format($order->subtotal, 2) }}</th></tr>
              <tr><th colspan="4" class="text-end">Shipping</th><th>${{ number_format($order->shipping_price, 2) }}</th></tr>
              <tr><th colspan="4" class="text-end">Total</th><th>${{ number_format($order->total, 2) }}</th></tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>

@endsection

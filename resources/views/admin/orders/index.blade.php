@extends('layouts.admin')

@section('title', 'Orders')

@section('content')

  @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <div class="row">
    <div class="col-12">
      <div class="mb-4">
        <h1 class="fs-3 mb-1">Orders List</h1>
        <p class="mb-0">All customer orders</p>
      </div>

      {{-- Status filter --}}
      <div class="card mb-3">
        <div class="card-body">
          <form action="{{ route('admin.orders.index') }}" method="GET" class="row g-2 align-items-end">
            <div class="col-md-4">
              <label class="form-label small mb-1">Filter by status</label>
              <select name="status" class="form-select">
                <option value="">All Orders</option>
                @foreach ($statuses as $item)
                  <option value="{{ $item }}" {{ $status == $item ? 'selected' : '' }}>{{ $item }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-auto">
              <button type="submit" class="btn btn-primary">Filter</button>
            </div>
            <div class="col-md-auto">
              <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">Clear</a>
            </div>
          </form>
        </div>
      </div>

      <div class="card table-responsive">
        <table class="table mb-0 text-nowrap table-hover">
          <thead class="table-light border-light">
            <tr>
              <th>ID</th>
              <th>Customer</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Total</th>
              <th>Status</th>
              <th>Date</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($orders as $order)
              <tr class="align-middle">
                <td>{{ $order->id }}</td>
                <td>{{ $order->name }}</td>
                <td>{{ $order->email }}</td>
                <td>{{ $order->phone }}</td>
                <td>${{ number_format($order->total, 2) }}</td>
                <td>@include('admin.orders.partials.status-badge', ['status' => $order->status])</td>
                <td>{{ $order->created_at->format('m/d/Y H:i') }}</td>
                <td>
                  <a href="{{ route('admin.orders.show', $order->id) }}" title="Show">
                    <i class="ti ti-eye"></i>
                  </a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="8" class="text-center text-muted py-4">No orders found.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="mt-3">
        {{ $orders->links() }}
      </div>
    </div>
  </div>

@endsection

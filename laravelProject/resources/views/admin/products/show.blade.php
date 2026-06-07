@extends('layouts.admin')

@section('title', 'Show Product')

@section('content')

  <div class="row">
    <div class="col-12">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
          <h1 class="fs-3 mb-1">Show Product</h1>
          <p class="mb-0">Product details</p>
        </div>
        <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">
          <i class="ti ti-arrow-left"></i> Back to Products
        </a>
      </div>

      <div class="card">
        <div class="card-header">
          <h3 class="card-title mb-0 fs-5">Product Details</h3>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped mb-0">
            <tr>
              <th style="width: 200px">ID</th>
              <td>{{ $product->id }}</td>
            </tr>
            <tr>
              <th>Category</th>
              <td>{{ $product->category ? $product->category->full_path : 'No Category' }}</td>
            </tr>
            <tr>
              <th>User ID</th>
              <td>{{ $product->user_id }}</td>
            </tr>
            <tr>
              <th>Title</th>
              <td>{{ $product->title }}</td>
            </tr>
            <tr>
              <th>Keywords</th>
              <td>{{ $product->keywords }}</td>
            </tr>
            <tr>
              <th>Description</th>
              <td>{{ $product->description }}</td>
            </tr>
            <tr>
              <th>Detail</th>
              <td>{!! $product->detail !!}</td>
            </tr>
            <tr>
              <th>Price</th>
              <td>{{ $product->price }}</td>
            </tr>
            <tr>
              <th>Stock</th>
              <td>{{ $product->stock }}</td>
            </tr>
            <tr>
              <th>Minimum Stock</th>
              <td>{{ $product->minstock }}</td>
            </tr>
            <tr>
              <th>Discount</th>
              <td>{{ $product->discount }}</td>
            </tr>
            <tr>
              <th>Status</th>
              <td>
                @if ($product->status == 1)
                  <span class="badge bg-success">Active</span>
                @else
                  <span class="badge bg-danger">Passive</span>
                @endif
              </td>
            </tr>
            <tr>
              <th>Image</th>
              <td>
                @if ($product->image)
                  <img src="{{ asset('uploads/products/' . $product->image) }}" width="150" class="img-thumbnail">
                @else
                  No image
                @endif
              </td>
            </tr>
          </table>
        </div>
        <div class="card-footer">
          <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-primary">
            <i class="ti ti-edit"></i> Edit
          </a>
        </div>
      </div>
    </div>
  </div>

@endsection

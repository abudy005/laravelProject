@extends('layouts.admin')

@section('title', 'Products')

@section('content')

  {{-- Success message --}}
  @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <div class="row">
    <div class="col-12">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
          <h1 class="fs-3 mb-1">Products List</h1>
          <p class="mb-0">All products in the store</p>
        </div>
        <a href="{{ route('admin.product.create') }}" class="btn btn-primary">
          <i class="ti ti-plus"></i> Add Product
        </a>
      </div>

      <div class="card table-responsive">
        <table class="table mb-0 text-nowrap table-hover">
          <thead class="table-light border-light">
            <tr>
              <th>ID</th>
              <th>Category</th>
              <th>Title</th>
              <th>Price</th>
              <th>Stock</th>
              <th>Discount</th>
              <th>Image</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($products as $product)
              <tr class="align-middle">
                <td>{{ $product->id }}</td>
                <td>{{ $product->category ? $product->category->full_path : 'No Category' }}</td>
                <td>{{ $product->title }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->discount }}</td>
                <td>
                  @if ($product->image)
                    <img src="{{ asset('uploads/products/' . $product->image) }}" alt="" class="avatar avatar-md rounded">
                  @else
                    <span class="text-muted">No image</span>
                  @endif
                </td>
                <td>
                  @if ($product->status == 1)
                    <span class="badge bg-success">True</span>
                  @else
                    <span class="badge bg-danger">False</span>
                  @endif
                </td>
                <td>
                  <a href="{{ route('admin.product.show', $product->id) }}" title="Show">
                    <i class="ti ti-eye"></i>
                  </a>
                  <a href="{{ route('admin.product.edit', $product->id) }}" class="ms-2" title="Edit">
                    <i class="ti ti-edit"></i>
                  </a>
                  <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-link link-danger p-0 ms-2"
                      onclick="return confirm('Are you sure you want to delete this product?')" title="Delete">
                      <i class="ti ti-trash"></i>
                    </button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="9" class="text-center text-muted py-4">No products found. <a href="{{ route('admin.product.create') }}">Add one</a>.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

@endsection

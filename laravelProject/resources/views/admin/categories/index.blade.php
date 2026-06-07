@extends('layouts.admin')

@section('title', 'Categories')

@section('content')

  {{-- Success message --}}
  @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  {{-- ===================== MAIN CATEGORIES ===================== --}}
  <div class="row mb-5">
    <div class="col-12">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
          <h1 class="fs-3 mb-1">Main Categories</h1>
          <p class="mb-0">Top-level categories</p>
        </div>
        <a href="{{ route('admin.main-categories.create') }}" class="btn btn-primary">
          <i class="ti ti-plus"></i> Add Main Category
        </a>
      </div>

      <div class="card table-responsive">
        <table class="table mb-0 text-nowrap table-hover">
          <thead class="table-light border-light">
            <tr>
              <th>ID</th>
              <th>Title</th>
              <th>Keywords</th>
              <th>Description</th>
              <th>Image</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($mainCategories as $category)
              <tr class="align-middle">
                <td>{{ $category->id }}</td>
                <td>{{ $category->title }}</td>
                <td>{{ $category->keywords }}</td>
                <td>{{ $category->description }}</td>
                <td>
                  @if ($category->image)
                    <img src="{{ asset('uploads/categories/' . $category->image) }}" alt="" class="avatar avatar-md rounded">
                  @else
                    <span class="text-muted">No image</span>
                  @endif
                </td>
                <td>
                  @if ($category->status == 1)
                    <span class="badge bg-success">True</span>
                  @else
                    <span class="badge bg-danger">False</span>
                  @endif
                </td>
                <td>
                  <a href="{{ route('admin.categories.edit', $category->id) }}" class="">
                    <i class="ti ti-edit"></i>
                  </a>
                  <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-link link-danger p-0 ms-2"
                      onclick="return confirm('Are you sure you want to delete this category?')">
                      <i class="ti ti-trash"></i>
                    </button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7" class="text-center text-muted py-4">No main categories found. <a href="{{ route('admin.main-categories.create') }}">Add one</a>.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  {{-- ===================== CATEGORIES ===================== --}}
  <div class="row">
    <div class="col-12">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
          <h1 class="fs-3 mb-1">Categories</h1>
          <p class="mb-0">Subcategories grouped under main categories</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
          <i class="ti ti-plus"></i> Add Category
        </a>
      </div>

      <div class="card table-responsive">
        <table class="table mb-0 text-nowrap table-hover">
          <thead class="table-light border-light">
            <tr>
              <th>ID</th>
              <th>Main Category</th>
              <th>Title</th>
              <th>Keywords</th>
              <th>Description</th>
              <th>Image</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($categories as $category)
              <tr class="align-middle">
                <td>{{ $category->id }}</td>
                <td>{{ $category->parent ? $category->parent->title : '-' }}</td>
                <td>{{ $category->title }}</td>
                <td>{{ $category->keywords }}</td>
                <td>{{ $category->description }}</td>
                <td>
                  @if ($category->image)
                    <img src="{{ asset('uploads/categories/' . $category->image) }}" alt="" class="avatar avatar-md rounded">
                  @else
                    <span class="text-muted">No image</span>
                  @endif
                </td>
                <td>
                  @if ($category->status == 1)
                    <span class="badge bg-success">True</span>
                  @else
                    <span class="badge bg-danger">False</span>
                  @endif
                </td>
                <td>
                  <a href="{{ route('admin.categories.edit', $category->id) }}" class="">
                    <i class="ti ti-edit"></i>
                  </a>
                  <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-link link-danger p-0 ms-2"
                      onclick="return confirm('Are you sure you want to delete this category?')">
                      <i class="ti ti-trash"></i>
                    </button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="8" class="text-center text-muted py-4">No categories found. <a href="{{ route('admin.categories.create') }}">Add one</a>.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

@endsection

@extends('layouts.admin')

@section('title', 'Add Category')

@section('content')

  {{-- Page Header --}}
  <div class="row">
    <div class="col-12">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
          <h1 class="fs-3 mb-1">Add Category</h1>
          <p class="mb-0">Create a new product category</p>
        </div>
        {{-- Back button --}}
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
          <i class="ti ti-arrow-left"></i> Back to Categories
        </a>
      </div>
    </div>
  </div>

  {{-- Create Form --}}
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body p-4">

          @if ($errors->any())
            <div class="alert alert-danger mb-4">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          {{-- Form posts to admin.categories.store (POST /admin/categories) --}}
          <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">

              {{-- Parent (Main) Category --}}
              <div class="col-md-6 mb-3">
                <label for="parent_id" class="form-label">Main Category</label>
                <select name="parent_id" id="parent_id" class="form-select @error('parent_id') is-invalid @enderror" required>
                  <option value="">-- Select Main Category --</option>
                  @foreach ($mainCategories as $mainCategory)
                    <option value="{{ $mainCategory->id }}" {{ old('parent_id') == $mainCategory->id ? 'selected' : '' }}>
                      {{ $mainCategory->title }}
                    </option>
                  @endforeach
                </select>
                @error('parent_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              {{-- Title --}}
              <div class="col-md-6 mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="e.g. Smartphones" required>
              </div>

              {{-- Keywords --}}
              <div class="col-md-6 mb-3">
                <label for="keywords" class="form-label">Keywords</label>
                <input type="text" name="keywords" id="keywords" class="form-control" placeholder="e.g. gadgets, devices">
              </div>

              {{-- Description --}}
              <div class="col-12 mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" rows="3" placeholder="Enter category description"></textarea>
              </div>

              {{-- Image --}}
              <div class="col-md-6 mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/*">
              </div>

              {{-- Status --}}
              <div class="col-md-6 mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select">
                  <option value="1">TRUE</option>
                  <option value="0">FALSE</option>
                </select>
              </div>

            </div>

            <div class="d-flex gap-2">
              <button type="submit" class="btn btn-primary">Save Category</button>
              <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancel</a>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

@endsection


@extends('layouts.admin')

@section('title', 'Edit Main Category')

@section('content')

  {{-- Page Header --}}
  <div class="row">
    <div class="col-12">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
          <h1 class="fs-3 mb-1">Edit Main Category</h1>
          <p class="mb-0">Update an existing top-level category</p>
        </div>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
          <i class="ti ti-arrow-left"></i> Back to Categories
        </a>
      </div>
    </div>
  </div>

  {{-- Edit Form --}}
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

          <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Keep parent_id as 0 since this is a main category --}}
            <input type="hidden" name="parent_id" value="0">

            <div class="row">

              {{-- Title --}}
              <div class="col-md-6 mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                  value="{{ old('title', $category->title) }}" required>
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              {{-- Keywords --}}
              <div class="col-md-6 mb-3">
                <label for="keywords" class="form-label">Keywords</label>
                <input type="text" name="keywords" id="keywords" class="form-control"
                  value="{{ old('keywords', $category->keywords) }}">
              </div>

              {{-- Description --}}
              <div class="col-12 mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $category->description) }}</textarea>
              </div>

              {{-- Image --}}
              <div class="col-md-6 mb-3">
                <label for="image" class="form-label">Image</label>
                @if ($category->image)
                  <div class="mb-2">
                    <img src="{{ asset('uploads/categories/' . $category->image) }}" alt="" width="80" class="rounded">
                    <small class="text-muted ms-2">Current image</small>
                  </div>
                @endif
                <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                <small class="text-muted">Leave blank to keep the current image</small>
                @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              {{-- Status --}}
              <div class="col-md-6 mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select">
                  <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>TRUE</option>
                  <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>FALSE</option>
                </select>
              </div>

            </div>

            <div class="d-flex gap-2">
              <button type="submit" class="btn btn-primary">Update Main Category</button>
              <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancel</a>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

@endsection

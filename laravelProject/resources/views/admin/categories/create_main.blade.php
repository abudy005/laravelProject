@extends('layouts.admin')

@section('title', 'Add Main Category')

@section('content')

  {{-- Page Header --}}
  <div class="row">
    <div class="col-12">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
          <h1 class="fs-3 mb-1">Add Main Category</h1>
          <p class="mb-0">Create a new top-level category</p>
        </div>
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

          <form action="{{ route('admin.main-categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">

              {{-- Title --}}
              <div class="col-md-6 mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                  value="{{ old('title') }}" placeholder="e.g. Electronics" required>
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              {{-- Keywords --}}
              <div class="col-md-6 mb-3">
                <label for="keywords" class="form-label">Keywords</label>
                <input type="text" name="keywords" id="keywords" class="form-control"
                  value="{{ old('keywords') }}" placeholder="e.g. gadgets, devices">
              </div>

              {{-- Description --}}
              <div class="col-12 mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" rows="3"
                  placeholder="Enter category description">{{ old('description') }}</textarea>
              </div>

              {{-- Image --}}
              <div class="col-md-6 mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
              <button type="submit" class="btn btn-primary">Save Main Category</button>
              <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancel</a>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

@endsection

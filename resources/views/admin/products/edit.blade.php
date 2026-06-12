@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')

  {{-- Page Header --}}
  <div class="row">
    <div class="col-12">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
          <h1 class="fs-3 mb-1">Edit Product</h1>
          <p class="mb-0">Update product details</p>
        </div>
        <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">
          <i class="ti ti-arrow-left"></i> Back to Products
        </a>
      </div>
    </div>
  </div>

  {{-- Edit Form --}}
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body p-4">

          {{-- Forms can only send GET/POST, so @method('PUT') spoofs the PUT
               that admin.product.update expects. --}}
          <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @include('admin.products.form')

            <div class="d-flex gap-2">
              <button type="submit" class="btn btn-primary">Save Product</button>
              <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">Cancel</a>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
  {{-- CKEditor turns the Detail textarea into a rich-text editor --}}
  <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
  <style>.ck-editor__editable { min-height: 250px; }</style>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const detail = document.querySelector('#detail');
      if (detail) {
        ClassicEditor.create(detail).catch(error => console.error(error));
      }
    });
  </script>
@endsection

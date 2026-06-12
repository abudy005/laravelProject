{{-- Shared product form fields — included by create.blade.php and edit.blade.php.
     On create, $product is not set, so old()/?? fall back to blanks.
     On edit, $product holds the existing values. --}}

<div class="row">

  {{-- Category (dropdown of all categories, shown by full path) --}}
  <div class="col-md-6 mb-3">
    <label for="category_id" class="form-label">Category</label>
    <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
      <option value="">-- Select Category --</option>
      @foreach ($categories as $item)
        <option value="{{ $item->id }}"
          {{ old('category_id', $product->category_id ?? '') == $item->id ? 'selected' : '' }}>
          {{ $item->full_path }}
        </option>
      @endforeach
    </select>
    @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  {{-- Title --}}
  <div class="col-md-6 mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
      value="{{ old('title', $product->title ?? '') }}" placeholder="e.g. iPhone 15 Pro" required>
    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  {{-- Keywords --}}
  <div class="col-md-6 mb-3">
    <label for="keywords" class="form-label">Keywords</label>
    <input type="text" name="keywords" id="keywords" class="form-control"
      value="{{ old('keywords', $product->keywords ?? '') }}" placeholder="e.g. apple, smartphone">
  </div>

  {{-- Description --}}
  <div class="col-md-6 mb-3">
    <label for="description" class="form-label">Description</label>
    <input type="text" name="description" id="description" class="form-control"
      value="{{ old('description', $product->description ?? '') }}" placeholder="Short description">
  </div>

  {{-- Detail (rich text via CKEditor) --}}
  <div class="col-12 mb-3">
    <label for="detail" class="form-label">Detail</label>
    <textarea name="detail" id="detail" rows="6" class="form-control">{{ old('detail', $product->detail ?? '') }}</textarea>
  </div>

  {{-- Image --}}
  <div class="col-md-6 mb-3">
    <label for="image" class="form-label">Image</label>
    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
    @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
    @if (!empty($product?->image))
      <div class="mt-2">
        <img src="{{ asset('uploads/products/' . $product->image) }}" alt="" width="80" class="rounded">
      </div>
    @endif
  </div>

  {{-- Status --}}
  <div class="col-md-6 mb-3">
    <label for="status" class="form-label">Status</label>
    <select name="status" id="status" class="form-select">
      <option value="1" {{ old('status', $product->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
      <option value="0" {{ old('status', $product->status ?? 1) == 0 ? 'selected' : '' }}>Passive</option>
    </select>
  </div>

</div>

{{-- Numeric fields grouped on one row --}}
<div class="row">
  <div class="col-md-3 mb-3">
    <label for="price" class="form-label">Price</label>
    <input type="number" step="0.01" name="price" id="price" class="form-control @error('price') is-invalid @enderror"
      value="{{ old('price', $product->price ?? '') }}" required>
    @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div class="col-md-3 mb-3">
    <label for="stock" class="form-label">Stock</label>
    <input type="number" name="stock" id="stock" class="form-control"
      value="{{ old('stock', $product->stock ?? 0) }}">
  </div>

  <div class="col-md-3 mb-3">
    <label for="minstock" class="form-label">Minimum Stock</label>
    <input type="number" name="minstock" id="minstock" class="form-control"
      value="{{ old('minstock', $product->minstock ?? 0) }}">
  </div>

  <div class="col-md-3 mb-3">
    <label for="discount" class="form-label">Discount (%)</label>
    <input type="number" name="discount" id="discount" class="form-control"
      value="{{ old('discount', $product->discount ?? 0) }}">
  </div>
</div>

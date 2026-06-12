<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminProductController extends Controller
{
    // Shows a list of all products — GET /admin/product
    public function index()
    {
        // Eager-load the category to avoid an extra query per row (N+1)
        $products = Product::with('category')->latest()->get();

        return view('admin.products.index', compact('products'));
    }

    // Shows the form to create a new product — GET /admin/product/create
    public function create()
    {
        // All categories (parent + sub) so the dropdown can show the full path
        $categories = Category::with('parent')->get();

        return view('admin.products.create', compact('categories'));
    }

    // Saves the new product to the database — POST /admin/product/store
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|integer|exists:categories,id',
            'title' => 'required|string|max:255',
            'keywords' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'detail' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'price' => 'required|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'minstock' => 'nullable|integer|min:0',
            'discount' => 'nullable|integer|min:0',
            'status' => 'required|in:0,1',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/products'), $imageName);
        }

        Product::create([
            'category_id' => $request->category_id,
            'user_id' => Auth::id(), // the logged-in admin who created/edited it
            'title' => $request->title,
            'keywords' => $request->keywords,
            'description' => $request->description,
            'detail' => $request->detail,
            'image' => $imageName,
            'price' => $request->price,
            'stock' => $request->stock ?? 0,
            'minstock' => $request->minstock ?? 0,
            'discount' => $request->discount ?? 0,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.product.index')->with('success', 'Product created successfully.');
    }

    // Shows the details of a single product — GET /admin/product/show/{product}
    public function show(Product $product)
    {
        $product->load('category');

        return view('admin.products.show', compact('product'));
    }

    // Shows the form to edit an existing product — GET /admin/product/edit/{product}
    public function edit(Product $product)
    {
        $categories = Category::with('parent')->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    // Saves the updated product to the database — PUT /admin/product/update/{product}
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required|integer|exists:categories,id',
            'title' => 'required|string|max:255',
            'keywords' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'detail' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'price' => 'required|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'minstock' => 'nullable|integer|min:0',
            'discount' => 'nullable|integer|min:0',
            'status' => 'required|in:0,1',
        ]);

        // Only replace the image if a new one was uploaded
        $imageName = $product->image; // keep existing image by default
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($product->image && file_exists(public_path('uploads/products/'.$product->image))) {
                unlink(public_path('uploads/products/'.$product->image));
            }
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/products'), $imageName);
        }

        $product->update([
            'category_id' => $request->category_id,
            'user_id' => Auth::id(), // the logged-in admin who created/edited it
            'title' => $request->title,
            'keywords' => $request->keywords,
            'description' => $request->description,
            'detail' => $request->detail,
            'image' => $imageName,
            'price' => $request->price,
            'stock' => $request->stock ?? 0,
            'minstock' => $request->minstock ?? 0,
            'discount' => $request->discount ?? 0,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.product.index')->with('success', 'Product updated successfully.');
    }

    // Deletes a product from the database — DELETE /admin/product/delete/{product}
    public function destroy(Product $product)
    {
        // Delete the image file from storage if it exists
        if ($product->image && file_exists(public_path('uploads/products/'.$product->image))) {
            unlink(public_path('uploads/products/'.$product->image));
        }

        $product->delete();

        return redirect()->route('admin.product.index')->with('success', 'Product deleted successfully.');
    }
}

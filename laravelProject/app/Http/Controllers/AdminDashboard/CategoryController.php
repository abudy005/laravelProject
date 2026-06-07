<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // Shows a list of all categories — GET /admin/categories
    public function index()
    {
        $mainCategories = Category::oldest()->where('parent_id', 0)->get();
        $categories = Category::oldest()->where('parent_id', '!=', 0)->get();

        return view('admin.categories.index', compact('mainCategories', 'categories'));
    }

    // Shows the form to create a new main category — GET /admin/main-categories/create
    public function createMain()
    {
        return view('admin.categories.create_main');
    }

    // Saves the new main category — POST /admin/main-categories
    public function storeMain(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'keywords' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'status' => 'required|in:0,1',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/categories'), $imageName);
        }

        Category::create([
            'parent_id' => 0,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'keywords' => $request->keywords,
            'description' => $request->description,
            'image' => $imageName,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Main category created successfully.');
    }

    // Shows the form to create a new category — GET /admin/categories/create
    public function create()
    {
        $mainCategories = Category::oldest()->where('parent_id', 0)->get();

        return view('admin.categories.create', compact('mainCategories'));
    }

    // Saves the new category to the database — POST /admin/categories
    public function store(Request $request)
    {
        $request->validate([
            'parent_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'keywords' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'status' => 'required|in:0,1',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/categories'), $imageName);
        }

        Category::create([
            'parent_id' => $request->parent_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'keywords' => $request->keywords,
            'description' => $request->description,
            'image' => $imageName,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    // Shows the details of a single category — GET /admin/categories/{category}
    public function show(Category $category)
    {
        //
    }

    // Shows the form to edit an existing category — GET /admin/categories/{category}/edit
    public function edit(Category $category)
    {
        if ($category->parent_id == 0) {
            return view('admin.categories.edit_main', compact('category'));
        }

        $mainCategories = Category::oldest()->where('parent_id', 0)->get();

        return view('admin.categories.edit', compact('category', 'mainCategories'));
    }

    // Saves the updated category to the database — PUT /admin/categories/{category}
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'parent_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'keywords' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'status' => 'required|in:0,1',
        ]);

        // Only update the image if a new one was uploaded
        $imageName = $category->image; // keep existing image by default
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($category->image && file_exists(public_path('uploads/categories/'.$category->image))) {
                unlink(public_path('uploads/categories/'.$category->image));
            }
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/categories'), $imageName);
        }

        $category->update([
            'parent_id' => $request->parent_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'keywords' => $request->keywords,
            'description' => $request->description,
            'image' => $imageName,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    // Deletes a category from the database — DELETE /admin/categories/{category}
    public function destroy(Category $category)
    {
        // Delete the image file from storage if it exists
        if ($category->image && file_exists(public_path('uploads/categories/'.$category->image))) {
            unlink(public_path('uploads/categories/'.$category->image));
        }

        // Delete the category from the database
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}

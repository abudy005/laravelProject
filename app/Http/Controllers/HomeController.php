<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->where('status', 1)
            ->latest()
            ->get();

        return view('front.home', compact('products'));
    }

    public function category(Category $category)
    {
        $products = $category->products()
            ->with('category')
            ->where('status', 1)
            ->latest()
            ->get();

        return view('front.category', compact('category', 'products'));
    }

    public function product(Product $product)
    {
        $product->load('category');

        $related = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 1)
            ->latest()
            ->take(4)
            ->get();

        return view('front.product', compact('product', 'related'));
    }
}

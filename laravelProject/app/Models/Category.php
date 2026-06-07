<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Fields that can be mass assigned (e.g. Category::create([...]))
    protected $fillable = [
        'parent_id', 'title', 'slug', 'keywords', 'description', 'image', 'status',
    ];

    // A category can have many sub-categories (e.g. Electronics → Phones, Laptops)
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // A category can have many products (used for the navbar product count)
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // A sub-category belongs to one parent category
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Builds the full category path, e.g. "Electronics → Phones → Android".
    // Walks up the parent chain until it reaches a top-level category
    // (parent_id = 0, which has no matching parent row so $parent is null).
    // Used as $category->full_path in the product views.
    public function getFullPathAttribute()
    {
        $titles = [];
        $category = $this;

        while ($category) {
            array_unshift($titles, $category->title);
            $category = $category->parent;
        }

        return implode(' → ', $titles);
    }
}

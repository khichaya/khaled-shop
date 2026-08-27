<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        // جلب المنتجات التي تنتمي لهذا الصنف فقط
        $products = Product::where('category_id', $category->id)
                            ->where('is_active', true)
                            ->latest()
                            ->paginate(12);

        return view('category', compact('category', 'products'));
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        $product->load(['category', 'details']);
        return view('products.show', compact('product'));
    }
        // دالة الفلترة حسب النوع (Type)
    public function byType($type)
    {
        $products = Product::where('type', $type)
                            ->where('is_active', true)
                            ->latest()
                            ->paginate(12);

        // نستخدم نفس واجهة صفحة الأصناف لعرض النتائج
        return view('category', [
            'category' => (object)['name' => $type],
            'products' => $products
        ]);
    }
}
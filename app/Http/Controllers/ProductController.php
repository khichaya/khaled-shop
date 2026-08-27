<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // عرض صفحة منتج واحد (تفاصيل المنتج)
    public function show(Product $product)
    {
        $product->load('details');
        return view('products.show', compact('product'));
    }
        // دالة البحث في المنتجات
    public function search(Request $request)
    {
        $query = $request->input('query');
        
        // البحث في الاسم، الرمز، الباركود، النوع، وأرقام الشاسيه
        $products = Product::where('is_active', true)
            ->where(function($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('sku', 'LIKE', "%{$query}%")
                  ->orWhere('barcode', 'LIKE', "%{$query}%")
                  ->orWhere('type', 'LIKE', "%{$query}%")
                  ->orWhere('compatibility', 'LIKE', "%{$query}%");
            })
            ->latest()
            ->paginate(12);

        // إعادة استخدام واجهة الأصناف لعرض نتائج البحث
        return view('category', [
            'category' => (object)['name' => 'Résultats pour: "' . $query . '"'],
            'products' => $products
        ]);
    }
    // ✅ دالة الفلترة حسب النوع (Type) - هي التي تسبب الخطأ إذا كانت ناقصة
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
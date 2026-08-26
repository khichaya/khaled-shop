<?php

namespace App\Http\Controllers;
 
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // جلب آخر المنتجات النشطة للعرض في الصفحة الرئيسية
        $featuredProducts = Product::with('category')
            ->where('is_active', true)
            ->latest()
            ->take(8)
            ->get();

        return view('home', compact('featuredProducts'));
    }
}
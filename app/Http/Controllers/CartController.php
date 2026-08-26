<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);

        $productId = $request->product_id;
        $quantity = $request->quantity;

        // إذا كان المنتج موجوداً في السلة، نزيد الكمية
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $product->price_1, // نستخدم سعر التجزئة
                'quantity' => $quantity,
                'image' => $product->image
            ];
        }

        session()->put('cart', $cart);

        // ✅ التحقق مما إذا كان الطلب سريعاً (Express)
        if ($request->has('buy_now')) {
            return redirect()->route('checkout.show')->with('success', 'Produit ajouté. Finalisez votre commande !');
        }

        return redirect()->back()->with('success', 'Produit ajouté au panier avec succès !');
    }
        // عرض صفحة السلة
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart', compact('cart', 'total'));
    }

    // حذف منتج من السلة
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Produit retiré du panier.');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    // عرض صفحة إتمام الطلب
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('home')->with('error', 'Votre panier est vide.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('checkout', compact('cart', 'total'));
    }

    // حفظ الطلب في قاعدة البيانات
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_wilaya' => 'required|string|max:100',
            'customer_address' => 'required|string',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('home');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // إنشاء الطلب
        $order = Order::create([
            'user_id' => auth()->id(), // ✅ ربط الطلب بحساب الزبون
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'total_amount' => $total,
            'status' => 'pending',
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_wilaya' => $request->customer_wilaya,
            'customer_address' => $request->customer_address,
        ]);

        // حفظ القطع المطلوبة
        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'product_name' => $item['name'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['price'],
            ]);
        }

        // تفريغ السلة
        session()->forget('cart');

        // ✅ إرسال الطلب إلى الـ POS المحلي (المزامنة العكسية)
        // ✅ إرسال الطلب مباشرة (Sync) لضمان وصوله الفوري
        \App\Jobs\SyncOrderToPosJob::dispatchSync($order);

        return redirect()->route('checkout.success');
    }

    // صفحة نجاح الطلب
    public function success()
    {
        return view('checkout-success');
    }
}
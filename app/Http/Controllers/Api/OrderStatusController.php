<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderStatusController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'order_number' => 'required|string',
            'status' => 'required|in:processing,shipped,completed,cancelled',
        ]);

        $order = Order::where('order_number', $request->order_number)->first();
        
        if ($order) {
            $order->status = $request->status;
            $order->save();
            return response()->json(['message' => 'Statut mis à jour avec succès']);
        }
        
        return response()->json(['message' => 'Commande non trouvée'], 404);
    }
}
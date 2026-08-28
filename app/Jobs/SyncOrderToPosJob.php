<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SyncOrderToPosJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function handle(): void
    {
        $url = rtrim(config('services.pos_api.url'), '/') . '/sync-order';
        $token = config('services.pos_api.token');

        $this->order->load('items.product');

        $data = [
            'order_number' => $this->order->order_number,
            'customer_name' => $this->order->customer_name,
            'customer_phone' => $this->order->customer_phone,
            'customer_address' => $this->order->customer_address,
            'total_amount' => $this->order->total_amount,
            'items' => $this->order->items->map(function ($item) {
                return [
                    'code' => $item->product->code ?? 'PROD-' . $item->product_id,
                    'name' => $item->product_name,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->unit_price,
                ];
            }),
        ];

        try {
            $response = Http::withToken($token)->timeout(30)->post($url, $data);

            if (!$response->successful()) {
                Log::error("Order Sync Failed: " . $response->body());
            }
        } catch (\Exception $e) {
            Log::error("Order Sync Exception: " . $e->getMessage());
        }
    }
}
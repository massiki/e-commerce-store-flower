<?php

namespace App\Services;

use App\Models\Order;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function createSnapToken(Order $order): string
    {
        // #region agent log
        $logPath = base_path('.cursor/debug.log');
        @file_put_contents(
            $logPath,
            json_encode([
                'location' => 'MidtransService.php:21',
                'message' => 'createSnapToken called',
                'data' => [
                    'order_id' => $order->id,
                    'order_number' => $order->order_number,
                    'total' => $order->total,
                    'items_loaded' => $order->relationLoaded('items'),
                    'items_count' => $order->items()->count()
                ],
                'timestamp' => time() * 1000,
                'runId' => 'run1',
                'hypothesisId' => 'C'
            ]) . "\n",
            FILE_APPEND
        );
        // #endregion

        // Ensure items are loaded
        if (!$order->relationLoaded('items')) {
            $order->load('items');
        }

        $items = [];

        foreach ($order->items as $item) {
            $items[] = [
                'id' => $item->product_id,
                'price' => (int) $item->price,
                'quantity' => $item->quantity,
                'name' => substr($item->product_name, 0, 50),
            ];
        }

        if ($order->shipping_cost > 0) {
            $items[] = [
                'id' => 'SHIPPING',
                'price' => (int) $order->shipping_cost,
                'quantity' => 1,
                'name' => 'Ongkos Kirim',
            ];
        }

        if ($order->discount > 0) {
            $items[] = [
                'id' => 'DISCOUNT',
                'price' => (int) -$order->discount,
                'quantity' => 1,
                'name' => 'Diskon Voucher',
            ];
        }

        $params = [
            'transaction_details' => [
                'order_id' => $order->order_number,
                'gross_amount' => (int) $order->total,
            ],
            'item_details' => $items,
            'customer_details' => [
                'first_name' => $order->name,
                'email' => $order->email,
                'phone' => $order->phone,
                'shipping_address' => [
                    'first_name' => $order->name,
                    'phone' => $order->phone,
                    'address' => $order->address,
                ],
            ],
        ];

        // #region agent log
        @file_put_contents(
            $logPath,
            json_encode([
                'location' => 'MidtransService.php:69',
                'message' => 'Before calling Snap::getSnapToken',
                'data' => [
                    'order_id' => $order->id,
                    'params_summary' => [
                        'order_id' => $params['transaction_details']['order_id'],
                        'gross_amount' => $params['transaction_details']['gross_amount'],
                        'items_count' => count($params['item_details']),
                        'has_customer' => !empty($params['customer_details']['email'])
                    ],
                    'server_key_set' => !empty(Config::$serverKey),
                    'is_production' => Config::$isProduction
                ],
                'timestamp' => time() * 1000,
                'runId' => 'run1',
                'hypothesisId' => 'C'
            ]) . "\n",
            FILE_APPEND
        );
        // #endregion

        try {
            $snapToken = Snap::getSnapToken($params);

            // #region agent log
            @file_put_contents(
                $logPath,
                json_encode([
                    'location' => 'MidtransService.php:71',
                    'message' => 'Snap::getSnapToken success',
                    'data' => [
                        'order_id' => $order->id,
                        'token_length' => strlen($snapToken)
                    ],
                    'timestamp' => time() * 1000,
                    'runId' => 'run1',
                    'hypothesisId' => 'C'
                ]) . "\n",
                FILE_APPEND
            );
            // #endregion
        } catch (\Exception $e) {
            // #region agent log
            @file_put_contents(
                $logPath,
                json_encode([
                    'location' => 'MidtransService.php:exception',
                    'message' => 'Exception in Snap::getSnapToken',
                    'data' => [
                        'order_id' => $order->id,
                        'error' => $e->getMessage(),
                        'error_code' => $e->getCode()
                    ],
                    'timestamp' => time() * 1000,
                    'runId' => 'run1',
                    'hypothesisId' => 'C'
                ]) . "\n",
                FILE_APPEND
            );
            // #endregion

            throw $e;
        }

        $order->update(['snap_token' => $snapToken]);

        return $snapToken;
    }

    public function handleNotification(): array
    {
        $notification = new Notification();

        $transactionStatus = $notification->transaction_status;
        $orderId = $notification->order_id;
        $paymentType = $notification->payment_type;
        $transactionId = $notification->transaction_id;
        $fraudStatus = $notification->fraud_status ?? null;

        $order = Order::where('order_number', $orderId)->firstOrFail();

        $status = match ($transactionStatus) {
            'capture' => ($fraudStatus === 'accept') ? 'paid' : 'pending',
            'settlement' => 'paid',
            'pending' => 'pending',
            'deny', 'cancel' => 'cancelled',
            'expire' => 'expired',
            default => $order->status,
        };

        $order->update([
            'status' => $status,
            'transaction_id' => $transactionId,
            'payment_type' => $paymentType,
        ]);

        return [
            'status' => $status,
            'order' => $order,
        ];
    }
}

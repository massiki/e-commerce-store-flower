<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PaymentController extends Controller
{
    public function pay(Order $order, MidtransService $midtrans): JsonResponse
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $snapToken = $midtrans->createSnapToken($order);

        return response()->json(['snap_token' => $snapToken]);
    }

    public function callback(Request $request, MidtransService $midtrans): JsonResponse
    {
        try {
            $result = $midtrans->handleNotification();

            return response()->json(['status' => 'ok', 'order_status' => $result['status']]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function success()
    {
        return view('payment.success');
    }

    public function failed()
    {
        return view('payment.failed');
    }
}

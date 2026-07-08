<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function track()
    {
        return view('orders.track');
    }

    public function trackStatus(Request $request)
    {
        $request->validate(['order_number' => 'required|string']);

        $order = Order::with('items')
            ->where('order_number', $request->order_number)
            ->first();

        if (! $order) {
            return response()->json([
                'success' => false,
                'message' => app()->getLocale() === 'ar' ? 'الطلب غير موجود. تأكد من رقم الطلب.' : 'Order not found. Please check your order number.',
            ]);
        }

        $steps = ['pending', 'processing', 'shipped', 'delivered'];
        $currentStep = array_search($order->status, $steps);
        if ($currentStep === false) $currentStep = -1;

        return response()->json([
            'success'        => true,
            'order_number'   => $order->order_number,
            'status'         => $order->status,
            'status_label'   => $order->status_label,
            'status_color'   => $order->status_color,
            'payment_status' => $order->payment_status,
            'payment_label'  => $order->payment_status_label,
            'customer_name'  => $order->customer_name,
            'created_at'     => $order->created_at->format('d M Y, H:i'),
            'total'          => number_format($order->total, 2),
            'items_count'    => $order->items->sum('quantity'),
            'current_step'   => $currentStep,
            'steps'          => $steps,
        ]);
    }
}

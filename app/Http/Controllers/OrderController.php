<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function trackStatus(Request $request)
    {
        $request->validate(['order_number' => 'required']);
        $order = \App\Models\Order::where('order_number', $request->order_number)->first();
        if ($order) {
            return response()->json(['success' => true, 'status' => $order->status]);
        }
        return response()->json(['success' => false, 'message' => app()->getLocale() === 'ar' ? 'الطلب غير موجود' : 'Order not found']);
    }
}

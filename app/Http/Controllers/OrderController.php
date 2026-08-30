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

    public function quickOrder(Request $request)
    {
        $validated = $request->validate([
            'product_id'       => 'required|exists:products,id',
            'quantity'         => 'required|integer|min:1|max:999',
            'customer_name'    => 'required|string|max:255',
            'customer_phone'   => 'required|string|max:30',
            'customer_address' => 'required|string|max:500',
            'city'             => 'nullable|string|max:100',
            'notes'            => 'nullable|string|max:1000',
        ], [
            'customer_name.required'    => app()->getLocale() === 'ar' ? 'يرجى إدخال الاسم بالكامل' : 'Please enter your full name',
            'customer_phone.required'   => app()->getLocale() === 'ar' ? 'يرجى إدخال رقم الهاتف' : 'Please enter your phone number',
            'customer_address.required' => app()->getLocale() === 'ar' ? 'يرجى إدخال العنوان بالتفصيل' : 'Please enter your delivery address',
        ]);

        $product = \App\Models\Product::findOrFail($validated['product_id']);
        $quantity = (int) $validated['quantity'];
        $unitPrice = (float) $product->price;
        $totalPrice = $unitPrice * $quantity;

        $user = \Illuminate\Support\Facades\Auth::user();

        $order = Order::create([
            'order_number'     => Order::generateOrderNumber(),
            'customer_name'    => $validated['customer_name'],
            'customer_email'   => $user?->email,
            'customer_phone'   => $validated['customer_phone'],
            'customer_address' => $validated['customer_address'],
            'city'             => $validated['city'] ?? null,
            'subtotal'         => $totalPrice,
            'shipping'         => 0,
            'total'            => $totalPrice,
            'status'           => 'pending',
            'payment_method'   => 'cash',
            'payment_status'   => 'unpaid',
            'notes'            => $validated['notes'] ?? null,
        ]);

        \App\Models\OrderItem::create([
            'order_id'     => $order->id,
            'product_id'   => $product->id,
            'product_name' => $product->name,
            'price'        => $unitPrice,
            'quantity'     => $quantity,
            'total'        => $totalPrice,
        ]);

        // Decrement product stock if positive
        if ($product->stock !== null && $product->stock > 0) {
            $product->decrement('stock', min($quantity, $product->stock));
        }

        // Increment sales count
        $product->increment('sales_count', $quantity);

        return response()->json([
            'success'      => true,
            'order_number' => $order->order_number,
            'total'        => number_format($totalPrice, 2),
            'message'      => app()->getLocale() === 'ar' 
                ? 'تم استلام طلبك بنجاح! رقم الطلب الخاص بك: ' . $order->order_number 
                : 'Your order has been placed successfully! Order #: ' . $order->order_number,
        ]);
    }
}

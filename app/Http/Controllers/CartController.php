<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $cart = session()->get('cart', []);
        
        $productId = $request->input('product_id');
        $productName = $request->input('product_name');
        $productPrice = $request->input('product_price');
        $productImage = $request->input('product_image');
        $quantity = $request->input('quantity', 1);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'id' => $productId,
                'name' => $productName,
                'price' => $productPrice,
                'image' => $productImage,
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'تم إضافة المنتج إلى السلة',
            'cart_count' => count($cart),
        ]);
    }

    public function remove(Request $request)
    {
        $cart = session()->get('cart', []);
        $productId = $request->input('product_id');

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        return response()->json([
            'success' => true,
            'message' => 'تم حذف المنتج من السلة',
            'cart_count' => count($cart),
        ]);
    }

    public function update(Request $request)
    {
        $cart = session()->get('cart', []);
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = max(1, $quantity);
            session()->put('cart', $cart);
        }

        return response()->json([
            'success' => true,
            'message' => 'تم تحديث الكمية',
        ]);
    }

    public function clear()
    {
        session()->forget('cart');

        return response()->json([
            'success' => true,
            'message' => 'تم تفريغ السلة',
        ]);
    }
}

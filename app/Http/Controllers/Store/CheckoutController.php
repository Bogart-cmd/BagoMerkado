<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductVariant;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        $subtotal = 0;

        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $coupon = Session::get('cart_coupon');
        $discount = 0;

        if ($coupon) {
            if ($coupon['type'] === 'percentage') {
                $discount = ($coupon['discount'] / 100) * $subtotal;
            } elseif ($coupon['type'] === 'fixed') {
                $discount = $coupon['discount'];
            }
        }

        $total = $subtotal - $discount;
        $shipping = null; // Or calculate based on method

        return view('themes.xylo.checkout', compact('cart', 'subtotal', 'shipping', 'total', 'discount', 'coupon'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'payment_method' => 'required',
        ]);

        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Cart is empty!');
        }

        $subtotal = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        $coupon = Session::get('cart_coupon');
        $discount = 0;

        if ($coupon) {
            if ($coupon['type'] === 'percentage') {
                $discount = ($coupon['discount'] / 100) * $subtotal;
            } elseif ($coupon['type'] === 'fixed') {
                $discount = $coupon['discount'];
            }
        }

        $total = $subtotal - $discount;

        $order = Order::create([
            'user_id' => Auth::id(),
            'address' => $request->address,
            'payment_method' => $request->payment_method,
            'total' => $total,
            'status' => 'pending',
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'variant_id' => $item['variant_id'] ?? null,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'attributes' => json_encode($item['attributes']),
            ]);
        }

        Session::forget('cart');
        Session::forget('cart_coupon'); // Clear coupon after order

        return redirect()->route('thankyou')->with('success', 'Order placed successfully!');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        if (empty($cart)) return redirect()->route('menu.index');

        $subtotal  = array_sum(array_map(fn($i) => $i['price'] * $i['qty'], $cart));
        $tax       = (int)($subtotal * 0.10);
        $total     = $subtotal + $tax;
        $cartCount = count($cart);

        return view('checkout.index', compact('cart', 'subtotal', 'tax', 'total', 'cartCount'));
    }

    public function store(Request $request)
    {
        $cart     = session('cart', []);
        $subtotal = array_sum(array_map(fn($i) => $i['price'] * $i['qty'], $cart));
        $tax      = (int)($subtotal * 0.10);
        $total    = $subtotal + $tax;
        $orderId  = strtoupper(substr(uniqid(), -8));

        $name      = trim($request->customer_name ?? '');
        $method    = trim($request->payment_method ?? '');
        $orderType = trim($request->order_type ?? 'Dine In');

        // Jika nama atau metode pembayaran kosong → langsung failed
        $status = ($name === '' || $method === '') ? 'failed' : 'processing';

        $order = [
            'id'             => $orderId,
            'order_number'   => rand(10, 99),
            'customer_name'  => $name ?: 'Guest',
            'payment_method' => $method ?: '-',
            'order_type'     => $orderType,
            'items'          => $cart,   // simpan cart di order supaya bisa di-restore
            'subtotal'       => $subtotal,
            'tax'            => $tax,
            'total'          => $total,
            'status'         => $status,
            'date'           => now()->format('d-m-Y'),
            'time'           => now()->format('h:i A'),
        ];

        session(['order_' . $orderId => $order]);
        session()->forget('cart');

        return redirect()->route('payment.status', $orderId);
    }

    // Restore cart dari order yang failed, lalu redirect ke checkout
    public function restoreFromOrder(string $orderId)
    {
        $order = session('order_' . $orderId);

        if (!$order) {
            return redirect()->route('menu.index');
        }

        // Kembalikan items ke cart
        session(['cart' => $order['items']]);

        return redirect()->route('checkout.index');
    }
}

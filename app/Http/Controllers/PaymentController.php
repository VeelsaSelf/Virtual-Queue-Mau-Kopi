<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function status(string $orderId)
    {
        $order = session('order_'.$orderId);
        if (!$order) return redirect()->route('menu.index');
        $cartCount = 0;
        return view('payment.status', compact('order', 'cartCount'));
    }

    public function confirm(Request $request, string $orderId)
    {
        $order = session('order_'.$orderId);
        if (!$order) return redirect()->route('menu.index');
        $order['status'] = $request->payment_status;
        session(['order_'.$orderId => $order]);
        return redirect()->route('payment.status', $orderId);
    }

    public function receipt(string $orderId)
    {
        $order = session('order_'.$orderId);
        if (!$order) return redirect()->route('menu.index');
        $cartCount = 0;
        return view('payment.receipt', compact('order', 'cartCount'));
    }
}

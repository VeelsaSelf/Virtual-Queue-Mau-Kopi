<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $total = array_sum(array_map(fn($i) => $i['price'] * $i['qty'], $cart));
        $cartCount = count($cart);
        return view('cart.index', compact('cart', 'total', 'cartCount'));
    }

    public function add(Request $request)
    {
        $cart = session('cart', []);
        $id = uniqid();

        $parts = [];
        if ($request->size)         $parts[] = $request->size;
        if ($request->sugar)        $parts[] = $request->sugar;
        if ($request->ice)          $parts[] = $request->ice;
        if ($request->rice)         $parts[] = $request->rice;
        if ($request->spicy)        $parts[] = $request->spicy;
        if ($request->serve)        $parts[] = $request->serve;
        if ($request->addons) {
            foreach ((array)$request->addons as $a) $parts[] = 'Add '.$a;
        }

        $cart[$id] = [
            'id'      => $id,
            'name'    => $request->name,
            'price'   => (int)$request->price,
            'img'     => $request->img,
            'qty'     => max(1,(int)$request->qty),
            'options' => implode(' • ', $parts),
            'notes'   => $request->notes,
        ];

        session(['cart' => $cart]);
        return redirect()->route('cart.index');
    }

    public function update(Request $request)
    {
        $cart = session('cart', []);
        $id = $request->id;
        if (isset($cart[$id])) {
            if ($request->action === 'increase') $cart[$id]['qty']++;
            else { $cart[$id]['qty']--; if ($cart[$id]['qty'] <= 0) unset($cart[$id]); }
        }
        session(['cart' => $cart]);
        return redirect()->route('cart.index');
    }

    public function remove(string $id)
    {
        $cart = session('cart', []);
        unset($cart[$id]);
        session(['cart' => $cart]);
        return redirect()->route('cart.index');
    }
}

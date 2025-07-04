<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Redirect;
class CheckoutController extends Controller
{
    public function create()
    {
        $cart = session('cart', []);
        return view('checkout.create', compact('cart'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'payment' => 'required|in:cod,credit',
        ], [
            'name.required' => '請輸入收件人姓名',
            'phone.required' => '請輸入電話',
            'address.required' => '請輸入地址',
            'payment.required' => '請選擇付款方式',
            'payment.in' => '付款方式不正確'
        ]);

        $cart = session('cart', []);

        if (empty($cart)) {
            return back()->withErrors(['cart' => '目前購物車是空的，請先選購商品。']);
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $order = Order::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'payment' => $request->payment,
            'total' => $total,
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ]);
        }
        session()->forget('cart');
        return redirect()->route('checkout.create')->with('success', '訂單已成功建立！');
    }
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session(['cart' => $cart]);
        }
        return redirect()->route('checkout.create')->with('success', '已移除商品!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;

class OrderController extends Controller
{
    public function create() {
        $cartItems = Cart::where('id_user', auth()->id())->with('product')->get();
        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Корзина пуста');
        }
        return view('orders.create', compact('cartItems'));
    }

    public function index() {
        $orders = Order::where('id_user', auth()->id())
            ->with(['status', 'orderItems.product'])
            ->orderBy('id_order', 'desc')
            ->get();
        return view('orders.index', compact('orders'));
    }

    public function store(Request $request) {
        $request->validate(['password' => 'required']);
        if (!Hash::check($request->password, auth()->user()->password)) {
            return response()->json(['error' => 'Неверный пароль'], 422);
        }
        DB::transaction(function () use ($request) {
            $cartItems = Cart::where('id_user', auth()->id())->get();
            if ($cartItems->isEmpty()) return;
            $order = Order::create(['id_user' => auth()->id(), 'id_status' => 1]);
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'id_order' => $order->id_order,
                    'id_product' => $item->id_product,
                    'quantity' => $item->quantity
                ]);
            }
            $cartItems->each(fn($i) => $i->delete());
        });
        return response()->json(['success' => 'Заказ оформлен']);
    }

    public function destroy($id) {
        $order = Order::findOrFail($id);
        if ($order->id_user !== auth()->id()) {
            return response()->json(['error' => 'Нет доступа'], 403);
        }
        $order->delete();
        return response()->json(['success' => 'Заказ удален']);
    }
}

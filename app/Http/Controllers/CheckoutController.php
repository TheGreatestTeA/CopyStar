<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $basketItems = Cart::where('id_user', Auth::id())
            ->with('product')
            ->get();

        if ($basketItems->isEmpty()) {
            return redirect()->route('product')->with('success', 'Корзина пуста.');
        }

        $total = $basketItems->sum(fn($item) => $item->product->price * $item->quantity);

        return view('checkout', compact('basketItems', 'total'));
    }

    public function confirm(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password, $user->password)) {
            return back()
                ->withErrors(['password' => 'Неверный пароль. Попробуйте снова.'])
                ->withInput();
        }

        $basketItems = Cart::where('id_user', $user->id_user)->get();

        if ($basketItems->isEmpty()) {
            return back()->withErrors(['password' => 'Корзина пуста.']);
        }

        DB::beginTransaction();

        $order = Order::create([
            'id_user'   => $user->id_user,
            'id_status' => 1,
            'id_product' => $request->id_product,
        ]);

        Cart::where('id_user', $user->id_user)->delete();

        DB::commit();

        return redirect()
            ->route('index')
            ->with('success', 'Заказ №' . $order->id_order . ' успешно сформирован!');
    }
}
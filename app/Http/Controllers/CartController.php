<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cartItems = $user->cartProducts; 

        $totalPrice = $cartItems->sum(function($product) {
            return $product->price * $product->pivot->quantity;
        });

        return view('cart.index', compact('cartItems', 'totalPrice'));
    }

    public function add(Request $request, $id_product)
    {
        $user = Auth::user();
        $quantity = $request->input('quantity', 1);

        $existingItem = $user->cartProducts()->where('cart.id_product', $id_product)->first();

        if ($existingItem) {
            $newQuantity = $existingItem->pivot->quantity + $quantity;
            $user->cartProducts()->updateExistingPivot($id_product, ['quantity' => $newQuantity]);
        } else {
            $user->cartProducts()->attach($id_product, ['quantity' => $quantity]);
        }

        return redirect()->back()->with('success', 'Товар добавлен в корзину!');
    }

    public function update(Request $request, $id_product)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);
        
        $user = Auth::user();
        $user->cartProducts()->updateExistingPivot($id_product, [
            'quantity' => $request->quantity
        ]);

        return redirect()->route('cart.index')->with('success', 'Корзина обновлена');
    }

    public function remove($id_product)
    {
        $user = Auth::user();
        $user->cartProducts()->detach($id_product);

        return redirect()->route('cart.index')->with('success', 'Товар удален из корзины');
    }
}

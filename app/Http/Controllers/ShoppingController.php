<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ShoppingController extends Controller
{
    public function addToCart()
    {
        $pdt = Product::find(request()->pdt_id);

        $cartItem = Cart::add([
            'id' => $pdt->id,
            'name' => $pdt->name,
            'qty' => request()->qty,
            'price' => $pdt->price
        ]);
        Cart::associate($cartItem->rowId, 'App\Models\Product');
        Session::flash('success', 'Đã thêm vào giỏ hàng.');
        return redirect()->route('cart');
    }

    public function cart()
    {
        return view('cart');
    }

    public function cartDelete($id)
    {
        Cart::remove($id);

        Session::flash('success', 'Đã xóa khỏi giỏ hàng.');
        return redirect()->back();
    }

    public function incr($id, $qty)
    {

        Cart::update($id, $qty + 1);

        Session::flash('success', 'Đã tăng số lượng sản phẩm.');

        return redirect()->back();
    }
    public function decr($id, $qty)
    {
        Cart::update($id, $qty - 1);

        Session::flash('success', 'Đã giảm số lượng sản phẩm.');

        return redirect()->back();
    }

    public function rapidAdd($id)
    {
        $pdt = Product::find($id);

        $cartItem = Cart::add([
            'id' => $pdt->id,
            'name' => $pdt->name,
            'qty' => 1,
            'price' => $pdt->price
        ]);

        Cart::associate($cartItem->rowId, 'App\Models\Product');

        Session::flash('success', 'Đã thêm vào giỏ hàng.');

        return redirect()->route('cart');
    }
}

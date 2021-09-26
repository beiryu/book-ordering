<?php

namespace App\Http\Controllers;

use App\Mail\PurchaseSuccessful;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Stripe\Charge;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    public function index()
    {   
        if(Cart::content()->count() == 0)
        {
            Session::flash('info', 'Giỏ hàng của bạn đang trống, hãy tiếp tục mua sắm');
            return redirect()->back();
        }
        return view('checkout');
    }

    public function pay()
    {
        Stripe::setApiKey("sk_test_51JdsdTF4FTJBI9BouQTVueMpJfQpg8nCnentS5V4CNFoD51VTLy1EBdMT1qRi4W9OwbeRdxJxeJdiRwKKWAtllTN00bwpHS7bm");

        $charge = Charge::create([
            'amount' => Cart::total(),
            'currency' => 'vnd',
            'description' => 'Thanh toán tiền sách',
            'source' => request()->stripeToken
        ]);
        Session::flash('success', 'Mua hàng thành công');

        Cart::destroy();

        // Mail::to(request()->stripeEmail)->send(new PurchaseSuccessful);

        return redirect('/');
    }
}

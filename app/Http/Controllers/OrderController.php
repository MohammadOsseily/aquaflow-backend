<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Cart_Item;
use App\Models\order;
use App\Models\Product;
use Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function createOrder(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $cart = Cart::where('user_id', $user->id)->where('purchased', 0)->first();
            $order  = new order();


            $order->user_id = $user->id;
            $order->cart_id = $cart->id;
            $order->email = request()->input('email');
            $order->fname = request()->input('fname');
            $order->conutry = request()->input('conutry');
            $order->state = request()->input('state');
            $order->city = request()->input('city');
            $order->apartment = request()->input('apartment');
            $order->floor = request()->input('floor');
            $order->additional_notes = request()->input('additional_notes');
            $order->save();

            $cart->purchased = 1;
            $cart->save();

            return response()->json(['message' => 'successfully'], 200);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}

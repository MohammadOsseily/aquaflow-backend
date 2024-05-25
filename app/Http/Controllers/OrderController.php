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
            $cart = Cart::where('user_id', $user->id)->first();




            $array = [];


            $array[] = [

                "user_id" => $user->id,
                "cart_id" => $cart->id,
                "email" => request()->input('email'),
                "fname" => request()->input('fname'),
                "conutry" => request()->input('conutry'),
                "state" => request()->input('state'),
                "city" => request()->input('city'),
                "apartment" => request()->input('apartment'),
                "floor" => request()->input('floor'),
                "additional_notes" => request()->input('additional_notes'),

            ];


            $order = order::create($array);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}

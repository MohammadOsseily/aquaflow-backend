<?php

// app/Http/Controllers/CartController.php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Cart_Item;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Check if the user is authenticated
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            try {
                $productId = $request->input('product_id');
                $quantity = $request->input('quantity');

                // Get or create a cart for the user
                $cart = Cart::firstOrCreate(['user_id' => $user->id]);

                // Check if the item is already in the cart
                $cartItem = Cart_Item::where('cart_id', $cart->id)
                    ->where('product_id', $productId)
                    ->first();

                if ($cartItem) {
                    // Update the quantity if the item is already in the cart
                    $cartItem->quantity += $quantity;
                    $cartItem->save();
                } else {
                    // Add a new item to the cart
                    Cart_Item::create([
                        'cart_id' => $cart->id,
                        'product_id' => $productId,
                        'quantity' => $quantity,
                    ]);
                }

                return response()->json(['message' => 'Product added to cart successfully']);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Internal Server Error', 'message' => $e->getMessage()], 500);
            }
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }


    public function getCart(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $cart = Cart::where('user_id', $user->id)->first();
            $cartItems = Cart_Item::where('cart_id', $cart->id)->get();
            $cartItemsIds = $cartItems->pluck("product_id");
            $product = Product::whereIn('id', $cartItemsIds)->get();

            $array = [];

            foreach ($cartItems as $cartItem) {
                $productCart = $product->where('id', $cartItem->product_id)->first();
                $array[] = [
                    "id" => $cartItem->id,
                    "quantity" => $cartItem->quantity,
                    "product" => $productCart,
                    "product_id" => $productCart->id,
                ];
            };
            if (!$cart) {
                return response()->json(['message' => 'Cart is empty']);
            }

            return response()->json([
                "id" => $cart->id,
                "user_id" => $user->id, "items" => $array
            ]);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function updateCartItem(Request $request)
    {
        $request->validate([
            'cart_item_id' => 'required|exists:cart_items,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = Cart_Item::find($request->header->input('cart_item_id'));
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return response()->json(['message' => 'Cart item updated successfully']);
    }

    public function removeCartItem(Request $request)
    {


        $cartItem = Cart_Item::where('id', $request->input("cart_item_id"))->first();
        $cartItem->delete();

        return response()->json(['message' => 'Cart item removed successfully']);
    }
}

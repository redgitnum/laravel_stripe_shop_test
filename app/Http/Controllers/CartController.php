<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    
    public function index()
    {
        $products = [];
        $totalArr = [];
        $total = 0;
        foreach (auth()->user()->cart->pluck('product_id') as $prod_id) {
            $products[] = Product::where('id', $prod_id)->first();
            $totalArr[] = Product::where('id', $prod_id)->get()->pluck('price')->first();
        }
        $total = array_reduce($totalArr, function($initial, $value){
             return $initial + $value;
            }, 0);
        return view('cart', [
            'cart' => $products,
            'total' => $total
        ]);
    }

    public function remove($id)
    {
        Cart::where('user_id', auth()->id())->where('product_id', $id)->delete();
        return back();
    }

    public function purchase(Request $request)
    {
            $request->user()->charge($request->total, $request->stripeToken);
            Cart::where('user_id', auth()->id())->delete();
            return redirect()->route('home');
    }
}

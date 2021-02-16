<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    
    public function index()
    {
        return view('products', [
            'products' => Product::all()
        ]);
    }

    public function addItem(Request $request)
    {
        Cart::create([
            'user_id' => auth()->id(),
            'product_id' => $request->id
        ]);
        return back();
    }
}

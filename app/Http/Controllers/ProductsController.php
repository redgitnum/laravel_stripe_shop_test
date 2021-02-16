<?php

namespace App\Http\Controllers;

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

    public function addItem($id)
    {
        dd($id);
    }
}

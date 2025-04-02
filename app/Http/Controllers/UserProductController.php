<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class UserProductController extends Controller
{
    
    public function index()
    {
        $products = Product::latest()->get();
        return view('users.showproduct', compact('products'));
    }
}

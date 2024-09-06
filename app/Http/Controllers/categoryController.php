<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class categoryController extends Controller
{
    public function index(){
        $product = Product::get();
        dd($product);
    }
    
}

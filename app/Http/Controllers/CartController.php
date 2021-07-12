<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    function ProductDetail(){
        return view('Customer.ProductDetail');
    }
}

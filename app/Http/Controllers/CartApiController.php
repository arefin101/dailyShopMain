<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;

class CartApiController extends Controller
{

    function getCart(){
        return Cart::all();
    }
    
    function AddToCart(Request $req){
        //return $req;
        $req->validate([
            'color' => 'required',
        ]);

        $product = Product::where('productId', $req->id)->first();
        $cart = new Cart;
        $cart->productName = $product->productName;
        $cart->userName = $req->userName;
        $cart->price = $product->sellingPrice;
        $cart->color = $req->color;
        $cart->quantity = $req->quantity;
        $cart->picture = $product->picture;
        $cart->save();
        return $cart;

    }

}

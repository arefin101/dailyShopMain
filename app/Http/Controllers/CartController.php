<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    
    function ProductDetail(Request $req){
        $idd=$req->id;
        $req->session()->put('idd', $idd);
        $id = $req->id;
        $userId = $req->userId;
        $category=Category::rightJoin( 'products', 'categories.categoryId', '=', 'products.categoryId' )
                    ->where('productId', $id)
                    ->select('categories.categoryName')
                    ->first();
        $product=Product::where('productId', $id)->first();
        $categories=Category::all();
        $products=Product::all();
        //return $admin;

        $productCategory = Category::leftJoin('products', 'categories.categoryId', '=', 'products.categoryId')
                        ->select('products.categoryId','categories.categoryName')
                        ->whereNotNull('products.categoryId')
                        ->distinct()
                        ->get();
        return view('Customer.ProductDetail', ['category' => $category, 'product' => $product ]);
    }

    function ProductDetails(Request $req){
        //return $req;
        $req->validate([
            'color' => 'required',
        ]);

        $product = Product::where('productId', $req->id)->first();
        $cart = new Cart;
        $cart->productName = $product->productName;
        $cart->userName = session()->get('userNames');
        $cart->price = $product->sellingPrice;
        $cart->color = $req->color;
        $cart->quantity = $req->quantity;
        $cart->picture = $product->picture;
        if($cart->save() && session()->has('LoggedUser')){
            return redirect()->route('CheckOut');
        }else{
            return redirect()->route('login', ['idd' => 1, 'ids' =>  $req->id ]);
        }
    }

    function Cart(){
        $id= (string)session()->get('userNames');
        //return $id;
        $sql="select productName, picture,  count(*) as quantity, sum(price) as totalPrice, price from carts where userName={$id} group by productName, picture, price";
        $cart = DB::select(DB::raw($sql));
        $subtotal = 0;
        foreach($cart as $item){
            $subtotal = $subtotal + $item->price;
        }
        return view('Customer.Cart',['cart' => $cart, 'subtotal' => $subtotal]);
    }

    function CheckOut(){
        $id= (string)session()->get('userNames');
        $sql="select productName, count(*) as quantity, sum(price) as price from carts where userName={$id} group by productName";
        $cart = DB::select(DB::raw($sql));
        $subtotal = 0;
        $tax=0;
        foreach($cart as $item){
            $subtotal = $subtotal + $item->price;
        }
        $tax = ceil((3/100)*$subtotal);
        $total = $subtotal + $tax;
        return view('Customer.CheckOut', ['cart'=> $cart, 'subtotal' => $subtotal, 'tax' => $tax, 'total' => $total]);
    }
    
}

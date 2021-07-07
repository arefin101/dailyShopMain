<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryApiController extends Controller
{

    function GetCategory(){

        $category = Category::all();

        return $category;

    }
    
    function UpdateCategory(Request $request, $id){

        $category = Category::find($id);
        $category->update($request->all());

        return $category;

    }

    function DeleteCategory($id){

        $category = Category::find($id);
        $query=$category->delete();

        if($query){
            return response('No Content', 204);
        }
        return response('Bad Request', 400);

    }

}

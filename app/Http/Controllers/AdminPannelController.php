<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use App\Models\Category;
use Image;

class AdminPannelController extends Controller
{
    function home(){
        //return session()->get('LoggedUser');
        $user = Admin::where('userName', '=', session()->get('LoggedUser'))
                ->orWhere('email', '=', session()->get('LoggedUser'))
                ->first();
        return view('Admin.Home', ['user' => $user]);
    }

    function profile(){
        //return session()->get('LoggedUser');
        $user = Admin::where('userName', '=', session()->get('LoggedUser'))
                ->orWhere('email', '=', session()->get('LoggedUser'))
                ->first();
        return view('Admin.ProfileSettings', ['user' => $user]);
    }

    function ChangePassword(){
        $user = Admin::where('userName', '=', session()->get('LoggedUser'))
                ->orWhere('email', '=', session()->get('LoggedUser'))
                ->first();
        return view('Admin.ChangePassword', ['user' => $user]);
    }

    function UploadPhoto(){
        $user = Admin::where('userName', '=', session()->get('LoggedUser'))
                ->orWhere('email', '=', session()->get('LoggedUser'))
                ->first();
        $image = $user->picture;
        return view('Admin.UploadPhoto', ['image' => $image, 'user'=>$user]);
    }

    function UploadedPhoto(Request $req){
        $req->validate([
            'picture' => 'mimes:jpeg,png,jpg,gif,svg'
        ]);

        $user = Admin::where('userName', '=', session()->get('LoggedUser'))
                ->orWhere('email', '=', session()->get('LoggedUser'))
                ->first();
        
        $temp=true;

        if($req->file('picture')){
            $image = $req->file('picture');
            $filename = $image->getClientOriginalName();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(300, 300);  
            $image_resize->save(public_path('images/'.$filename));
            $image = base64_encode($image_resize);
        }else{
            $image = $user->picture;
            $temp=false;
        }

        $user->picture=$image;
        $query=$user->save();
        if($query){
            $req->session()->put('picture', $user->picture);
            if($temp){
                return back()->with('success', 'Upload successful');
            }else{
                return back()->with('fail', 'This photo is allready in the system');
            }
        }else{
            return "back()";
        }
    }

    function ViewProfile(){
        $user = Admin::where('userName', '=', session()->get('LoggedUser'))
                ->orWhere('email', '=', session()->get('LoggedUser'))
                ->first();
        return view('Admin.ViewProfile', ['user'=> $user]);
    }

    function UpdateProfile(Request $request){

        $validated = $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>[
                'required',
                'regex:/[0-9]/',
                'string',
                'min:11',
                'max:11'             
            ],
            'address'=>'required|string',
            'district'=>'required|string'
        ]);

        $user = Admin::where('userName', '=', session()->get('LoggedUser'))
                ->orWhere('email', '=', session()->get('LoggedUser'))
                ->first();
                
        $user->name=$request->name;
        $user->email=$request->email;
        $user->phone=$request->phone;
        $user->address=$request->address;
        $user->district=$request->district;

        $query=$user->save();


        if($query){
            return back()->with("success", "Update Successful");
        }else{
            return back()->with("fail", "Update Failed");
        }
    }

    function AddCategory(){
        return view("Admin.AddCategory");
    }

    function AddedCategory(Request $req){

        $req->validate([
            'categoryName' => 'required|string|unique:categories'
        ]);

        $category = new Category;
        
        $category->categoryName = $req->categoryName;
        $query = $category->save();

        if($query){
            return back()->with('success', 'Category add successful');
        }else{
            return back()->with('fail', 'Submission failed');
        }
    }

    function CustomizeCategory(Request $req){

        $id = $req->id;

        $totalRow = Category::count();

        if($id == -2){
            $id = (ceil($totalRow/5)-1);
        }else if($id == -1){
            $id=0;
        }

        if($totalRow>0){
            $firstId=Category::first()->categoryId;
            $lastId=Category::latest()->first()->categoryId;

            $category = Category::skip($id*5)->take(5)->get();

            return view('Admin.CustomizeCategory', ['category' => $category, 'firstId' => $firstId, 'lastId' => $lastId, 'totalRow' => $totalRow ] );
        }

        return back();


    }
    

}

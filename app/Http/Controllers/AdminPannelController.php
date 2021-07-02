<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;

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
        return view('Admin.UploadPhoto');
    }

    function ViewProfile(){
        $user = Admin::where('userName', '=', session()->get('LoggedUser'))
                ->orWhere('email', '=', session()->get('LoggedUser'))
                ->first();
        return view('Admin.ViewProfile', ['user'=> $user]);
    }

}

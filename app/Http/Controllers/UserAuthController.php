<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Admin;
use App\Models\Customer;

class UserAuthController extends Controller
{
    
    function register(){
        return view('auth.register');
    }

    function registered(Request $request){

        $request->validate([
            'userName'=>'required|unique:customers',
            'email'=>'required|email|unique:customers',
            'password'=>[
                'required',
                'string',
                'min:4',
                'max:20'             
            ],
            'phone'=>[
                'required',
                'regex:/[0-9]/',
                'string',
                'min:11',
                'max:11'             
            ],
            'DOB'=>'required|string',
            'gender'=>'required|string',
            'address'=>'required|string',
        ],

        [
            'DOB.required' => "The date of birth field is required",
            'DOB.string' => "The date of birth field must be string",
            'cPassword.required' => 'The confirm password field is required.',
            'cPassword.string' => 'The confirm password field must be string.',
            'cPassword.min' => 'The confirm password field must be at least 5 characters.',
            'cPassword.dmax' => 'The confirm password must not be greater than 20 characters.',
        ]
    );

        $customer=new Customer;

        $customer->userName=$request->userName;
        $customer->email=$request->email;
        $customer->phone=$request->phone;
        $customer->DOB=$request->DOB;
        $customer->gender=$request->gender;
        $customer->address=$request->address;
        $customer->district=$request->district;
        $customer->userType="Customer";

        $customerQuery = $customer->save();

        $user=new User;

        $user->userName=$request->userName;
        $user->email=$request->email;
        $user->userType="Customer";
        $user->password=Hash::make($request->password);

        $userQuery = $user->save();

        if($customerQuery && $userQuery){
            return redirect()->route("Home");
        }else{
            return back()->with('fail','Something went wrong');
        }
    }

    function login(){
        return view('auth.login');
    }

    function check(Request $request){
        $request->validate([
            'user' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('userName', '=', $request->user)
                    ->orWhere('email', '=', $request->user)
                    ->first();

        if($user->userType=='Admin'){
            $userbytype= Admin::where('userName', '=', $request->user)
                ->orWhere('email', '=', $request->user)
                ->first();
        }

        if($user){
            if(Hash::check($request->password, $user->password)){
                //return $user->userType;
                if($user->userType=="Admin"){
                    $request->session()->put('LoggedUser', $user->userName);
                    $request->session()->put('name', $userbytype->name);
                    $request->session()->put('email', $user->email);
                    $request->session()->put('userType', $user->userType);
                    return redirect()->route('Home');
                }else if($user->userType=="Customer"){
                    $request->session()->put('LoggedUser', $user->userName);
                    return redirect()->route('index');
                }else{
                    return back()->with('fail', 'Invalid request');
                }
            }else{
                $request->session()->flash('user', $request->user);
                return back()->with('fail', 'Invalid password');
            }
        }else{
            return back()->with('fail', 'No account found for this email or username');
        }
    }

    function logout(){
        if(session()->has('LoggedUser')){
            session()->flush();
            return redirect()->route("index");
        }
    }

}

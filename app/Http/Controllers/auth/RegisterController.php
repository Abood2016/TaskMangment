<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
     protected $redirectTo = '/';


    public function register()
    {
        return view('frontend.register');
    }


    public function store(Request $request)
    {
        $request->validate($this->Rules());
        // dd($request->all());
        $user = User::create([
            'username' => $request['username'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'role' => 'employee',
            'status' => 'deactive',
            'password' => Hash::make($request['password']),
        ]);

        //  auth()->login($user);

        //  dd($user);
        if ($user->status == "deactive") {

            return redirect()->back()->with('error', 'Thank You we will activate your account soon!');   
        }
    }


    public function Rules()
    {
        return [
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ];
    }

}

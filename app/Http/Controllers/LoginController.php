<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    // This method will show login page for customer
    public function index()
    {
        return view('login');
    }

    // This method will authenticate user
    public function authenticate(Request $request){

        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validator->passes())
        {
            if(Auth::attempt(['email' => $request->email,'password' => $request->password]))
            
        { 
            return redirect()->route('account.dashboard');
        }else {
            return redirect()->route('account.login')->with('error','Either emial or password is incorrect.');
    }
        } else {
            return redirect()->route('account.login')
            ->withInput()
            ->withErrors($validator);
        }
    }


    public function register()
    {
        return view('register');
    }

    public function processRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:5',
            'password_conformation' => 'required',
            'name' => 'required'
            
        ]);
    
        if ($validator->passes()) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email; // Corrected line
            $user->password = Hash::make($request->password);
            $user->role = 'customer';
            $user->save();
    
            return redirect()->route('account.login')->with('success', 'You have registered successfully.');
        } else {
            return redirect()->route('account.register')
                ->withInput()
                ->withErrors($validator);
        }
    }
    
    public function logout()
    {
        Auth::logout();
        return redirect()->route('account.login');  // Redirect to login page after logout
    }
}


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;

class LoginController extends Controller
{   
    public function getLogin() {
    	// Check login
        if (Auth::check()) {
            // Đã đăng nhập
            if (Auth::user()->user_role == "admin") {
                return redirect('dashboard');
            } else {
                Auth::logout();
                $errors['checkAdmin'] = "Sorry, you do not have access.";
                return redirect('login')->withErrors($errors)->withInput();
            }
        } else {
            return view('login.login');
        }
    }

    public function postLogin(Request $request) {
    	// Validator
    	$rules = [
    		'user_email' => 'required|email',
    		'user_password' => 'required|min:5'
    	];

    	$validator = Validator::make($request->all(), $rules);

    	if ($validator->fails()) {
    		return redirect()->back()->withErrors($validator)->withInput();
    	} else {
            $data = [
        		'user_email' => $request->input('user_email'),
        		'password' => $request->input('user_password'),
                'user_role' => 'admin'
            ];

    		// Login (thêm true để remember me)
    		if (Auth::attempt($data, true)) {
    			return redirect()->intended('/dashboard');
    		} else {
    			return redirect()->back()->withErrors('Email or password is wrong.')->withInput();
    		}
    	}
    }

    public function getLogout() {
        Auth::logout();
        return redirect('login');
    }
}

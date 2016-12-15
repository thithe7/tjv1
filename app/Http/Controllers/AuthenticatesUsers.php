<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\RedirectResponse as Redirection;

use App\Http\Requests\AuthRequest as Request;

trait AuthenticatesUsers {
    public function __construct() {
    	$this->middleware("guest:$this->guard", ['except' => 'logout']);
    }

    public function login(Request $request, Auth $auth) {
        if ($this->guard === 'web_users') {
            $authorized = $auth->guard($this->guard)->attempt(['email' => $request->input('username'), 'password' => $request->input('password'), 'status' => 'active'], $request->input('remember'));
        } else {
            $authorized = $auth->guard($this->guard)->attempt(['username' => $request->input('username'), 'password' => $request->input('password'), 'status' => 'active'], $request->input('remember'));
        }

    	if ($authorized) {
            return redirect()->intended($this->redirectTo);
    	}
    	   return back()
    		->with('authError', 'Username or Password incorrect')
    		->withInput($request->except('password'));
    }

    public function logout(Auth $auth) {
    	$auth->guard($this->guard)->logout();

    	return redirect($this->redirectTo);
    }
}

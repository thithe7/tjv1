<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\View\View;

use App\Http\Controllers\Controller;
use App\Http\Controllers\AuthenticatesUsers;

class authCtrl extends Controller {
    use AuthenticatesUsers;

    protected $guard = 'web_admin';
    protected $redirectTo = 'admin';

    public function index(){
    	return view('admin/auth/view');
    }
}

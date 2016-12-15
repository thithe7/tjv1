<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Contracts\View\View;

use App\Http\Controllers\Controller;
use App\Http\Controllers\AuthenticatesUsers;

class authCtrl extends Controller {
    use AuthenticatesUsers;

    protected $guard = 'web_vendor';
    protected $redirectTo = 'tjvendor';

    public function index() {
    	return view('vendor/auth/view');
    }
}

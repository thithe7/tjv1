<?php
namespace App\Http\Controllers\Users;

use Illuminate\Contracts\View\View;

use App\Http\Controllers\Controller;
use App\Http\Controllers\AuthenticatesUsers;

class authCtrl extends Controller {
    use AuthenticatesUsers;

    protected $guard = 'web_users';
    protected $redirectTo = '/';

    public function index() {
    	return view('users.register.view');
    }
}
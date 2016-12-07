<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\View\View;

use App\Http\Controllers\Controller;
use App\Http\Controllers\AuthenticatesUsers;
use App\Http\Controllers\Admin\menuCtrl;

class adminCtrl extends Controller {
    use menuCtrl;
}
<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\adminCtrl;

class homeCtrl extends Controller {
	use adminCtrl;

    public function index(){
    	$menu = $this->generateMenu();

    	return view('admin/home/view', compact('menu'));
    }
}
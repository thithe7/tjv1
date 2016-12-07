<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\adminCtrl;
use App\Http\Controllers\Admin\menuCtrl;

class homeCtrl extends adminCtrl {
	use menuCtrl;

    public function index(){
    	$menu = $this->generateMenu();

    	return view('admin/home/view', compact('menu'));
    }
}
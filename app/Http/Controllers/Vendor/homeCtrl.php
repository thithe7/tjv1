<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Vendor\vendorCtrl;

class homeCtrl extends Controller {
	use vendorCtrl;

    public function index(){
    	$menu = $this->generateMenu();

    	return view('vendor/home/view', compact('menu'));
    }
}
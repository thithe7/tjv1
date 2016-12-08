<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Vendor\vendorCtrl;

class homeCtrl extends Controller {
	use vendorCtrl;

    /**
    * Programmer   : Thithe
    * Tanggal      : 08-12-2016
    * Fungsi       : halaman awal home vendor
    * Tipe         : create
    */
    public function index(){
    	$menu = $this->generateMenu();

    	return view('vendor/home/view', compact('menu'));
    }
}
<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use Auth;
use Session;

class usersCtrl extends Controller {

	function __construct() {
		if (Auth::guard('web_users')->user()) {
			$id = Auth::guard('web_users')->user()->id;
			$point = DB::table('m_point')->selectRaw("sum(total_point) as total_point")->where('userid', $id)->first()->total_point;
			Session::set('total_point', $point);
		} else {
			Session::forget('total_point');
		}
	}

}
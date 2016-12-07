<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\Traits\ParentCtrl;

use Auth;
use DB;
use PDF;
use App;
use Mail;
use Session;
use Redirect;
use Input;
use URL;
use mPDF;

class SearchCtrl extends Controller {  
    use ParentCtrl;

    /**
    * Programmer   : Thithe
    * Tanggal      : 01-12-2016
    * Fungsi       : halaman awal hasil search
    * Tipe         : create
    */
    public function index(Request $request) {
        $destination=$request->get('destination');
        $harga=$request->get('harga');
        $breakfast=$request->get('breakfast');
        $amenities=$request->get('amenities');
        $when=$request->get('when');
        $cekin=date('Y-m-d',strtotime(str_replace('/', '-', $request->get('checkin'))));
        $cekout = date('Y-m-d',strtotime(str_replace('/', '-', $request->get('checkout'))));
        // $cekin=date('Y-m-d',strtotime($request->get('checkin')));
        // $cekout = date('Y-m-d',strtotime($request->get('checkout'))); 
        $night = ((abs(strtotime ($cekout) - strtotime ($cekin)))/(60*60*24));
        

        $hotel_name=$request->get('hotel_name');
        $amount=$request->get('amount');
        $amount2=$request->get('amount2');
        $inputstar=$request->get('star');
        $star=explode(",",substr($inputstar,0,strlen($inputstar)-1));
        if($inputstar==""){
            $star=$inputstar;
        }
        //print_r($star);
        $ketdbprice='';

        $page = $request->input('page');
        $getdata=$this->getDataSearch($destination, $breakfast, $amenities, $hotel_name, $star, $cekin, $cekout, $amount, $amount2, $ketdbprice, $night, $page);

        // $hargamaks=$getdata['hargamaks'];
        // $totalPages=$getdata['totalPages'];
        // $records=$getdata['records'];

        $act="";
        $msg="";
        if(!Auth::guard('web_users')->guest()){
            $cekactivation = DB::table('m_user')
                ->select('statusconfirm')
                ->where('id', Auth::guard('web_users')->user()->id)
                ->first();
            $act=$cekactivation->statusconfirm;
        }

        if($act == 'need confirm') $msg="Your account hasn't been verified. Please check your email to verify your account.";
        //echo $hargamaks;
        //echo Session::get('hargamaks');
        // echo "<pre>";
        // print_r($getdata);
        // echo "</pre>";
        return view('users/search/view',compact('harga','totalPages','data','records','night','cekin','cekout','destination','breakfast','amenities', 'msg', 'getdata','when'));
    }

    /**
    * Programmer   : Thithe
    * Tanggal      : 01-12-2016
    * Fungsi       : modify hasil search
    * Tipe         : create
    */
    public function indextampil(Request $request) {
        $destination=$request->get('destination');
        $breakfast=$request->get('breakfast');
        $amenities=$request->get('amenities');
        $hotel_name=$request->get('hotel_name');
        $amount=$request->get('amount');
        $amount2=$request->get('amount2');
        $inputstar=$request->get('star');
        $star=explode(",",substr($inputstar,0,strlen($inputstar)-1));
        if($inputstar==""){
            $star=$inputstar;
        }
        //print_r($star);
        $ketdbprice='';
        // echo $hotel_name."<br>";
        // echo $amount."<br>";
        // echo $amount2."<br>";
        //echo $star."<br>";
        //echo substr($inputstar,0,strlen($inputstar)-1)."<br>";
        $cekin=date('Y-m-d',strtotime(str_replace('/', '-', $request->get('checkin'))));
        $cekout = date('Y-m-d',strtotime(str_replace('/', '-', $request->get('checkout'))));
        // $cekin=date('Y-m-d',strtotime($request->get('checkin')));
        // $cekout = date('Y-m-d',strtotime($request->get('checkout')));
        $night = ((abs(strtotime ($cekout) - strtotime ($cekin)))/(60*60*24));
        $page = $request->input('page');
        $getdata=$this->getDataSearch($destination, $breakfast, $amenities, $hotel_name, $star, $cekin, $cekout, $amount, $amount2, $ketdbprice, $night, $page);

        // $hargamaks=$getdata['hargamaks'];
        // $totalPages=$getdata['totalPages'];
        // $records=$getdata['records'];

        return view('users/search/search',compact('data','night','cekin','cekout','destination','breakfast','amenities','getdata'));
    }
        
}
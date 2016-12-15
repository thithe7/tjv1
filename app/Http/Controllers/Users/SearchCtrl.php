<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\Traits\ParentCtrl;

use Input;

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
        $ketdbprice='';

        $page = $request->input('page');
        $tipe="search";
        $getdata=$this->getDataSearch($destination, $breakfast, $amenities, $hotel_name, $star, $cekin, $cekout, $amount, $amount2, $ketdbprice, $night, $page, $tipe);

        return view('users/search/view',compact('harga','totalPages','data','records','night','cekin','cekout','destination','breakfast','amenities', 'getdata','when'));
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
        $ketdbprice='';
        $cekin=date('Y-m-d',strtotime(str_replace('/', '-', $request->get('checkin'))));
        $cekout = date('Y-m-d',strtotime(str_replace('/', '-', $request->get('checkout'))));
        $night = ((abs(strtotime ($cekout) - strtotime ($cekin)))/(60*60*24));
        $page = $request->input('page');
        $tipe=$request->get('tipe');
        $getdata=$this->getDataSearch($destination, $breakfast, $amenities, $hotel_name, $star, $cekin, $cekout, $amount, $amount2, $ketdbprice, $night, $page, $tipe);
        return view('users/search/search',compact('data','night','cekin','cekout','destination','breakfast','amenities','getdata'));
    }
        
}
<?php

namespace App\Http\Controllers\Users;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Users\usersCtrl;
use App\Http\Controllers\Users\Traits\ParentCtrl;

class homeCtrl extends usersCtrl {    
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    use ParentCtrl;

    function getdate() {
        return $this->getdateParent();
    }

    public function index(/*$value5 = NULL*/) {
        $data['date']=date('Y-m-d');
        return view('users/home/view',compact('data'));
    }

    /**
    * Programmer   : Thithe
    * Tanggal      : 20-10-2016
    * Fungsi       : Field khusus untuk autocomplete search home
    * Tipe         : 
    */
    public function autocompleteSearch(Request $request) {
        $term=strtolower($request->input('term'));
        return(json_encode($this->autocompleteParent($term)));
    }

}
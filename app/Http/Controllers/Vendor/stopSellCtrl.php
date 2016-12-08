<?php

namespace App\Http\Controllers\vendor;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use File;
use Image;
use Storage;
use URL;
use Toastr;
use Mail;
use Auth;
use Input;

class stopSellCtrl extends Controller{

    /**
    * Programmer   : Thithe
    * Tanggal      : 08-12-2016
    * Fungsi       : get date untuk stop sale all room
    * Tipe         : create
    */    
    function getDateStopSellAllRoom(){
        $query = DB::table('m_vendor');
        $query->join('m_contract_vendor','m_vendor.id','=','m_contract_vendor.vendor');
        $query->join('m_vendor_user', 'm_vendor_user.vendor', '=', 'm_vendor.id');
        $query->where('m_vendor_user.id','=', Auth::guard('web_vendor')->user()->id);
        $data = $query->first();
        if($data->valid_from<=date('Y-m-d') && date('Y-m-d')<=$data->valid_to){
            $return['batas']=date('Y-m-d');
        }
        else{
            $return['batas']="";
        }
        $return['results'] = $data;
        return $return;
    }

    /**
    * Programmer   : Thithe
    * Tanggal      : 08-12-2016
    * Fungsi       : check period untuk stop sale apabila periodnya 1 hari
    * Tipe         : create
    */
    function checkStop($id_room="",$date=""){
        $ratecheck=DB::table('stop_sell')
           ->where('room','=',$id_room)
           ->where('stop_date_from','=',$date);
        $data=$ratecheck->first();
        return count($data);
    }
    
    /**
    * Programmer   : Thithe
    * Tanggal      : 08-12-2016
    * Fungsi       : check period untuk stop sale apabila lebih dari 1 hari
    * Tipe         : create
    */
    function checkStop2($id_room="",$date="",$date2=""){
        $ratecheck=DB::table('stop_sell')
           ->where('room','=',$id_room)
           ->where('stop_date_from', '<=', $date)
           ->where('stop_date_to', '>=', $date2);
        $data=$ratecheck->first();
        return count($data);
    }

    /**
    * Programmer   : Thithe
    * Tanggal      : 08-12-2016
    * Fungsi       : ambil data semua room untuk proses stop sale all room
    * Tipe         : create
    */
    function getAllRoom(){
        $query = DB::table('m_room');
        $query->select('m_room.id as id_room', 'm_room.name as name_room');
        $query->join('m_vendor','m_vendor.id','=','m_room.vendor');
        $query->join('m_vendor_user', 'm_vendor_user.vendor', '=', 'm_vendor.id');
        $query->where('m_vendor_user.id','=', Auth::guard('web_vendor')->user()->id);
        $data = $query->get();
        return $data;
    }

    /**
    * Programmer   : Thithe
    * Tanggal      : 08-12-2016
    * Fungsi       : fungsi simpan data stop sale
    * Tipe         : create
    */
    public function postStopSale(Request $request){
        $id_room = $request->input('id_room');
        //echo "aaa".$id_room;
        $valid_from = date('Y-m-d', strtotime($request->input('stop_from')));
        $valid_to = date('Y-m-d', strtotime($request->input('stop_to')));
        $pesansukses='';
        $pesanerror='';
        if($request->input('mode_form') == 'ubah'){
          $id_allotment = $request->input('id_allotment');
            DB::table('m_priment')
            ->where('id', '=', $id_allotment)
            ->update([
                "allotement"        => $sallotment,
                "updated_at"        => date('Y-m-d H:i:s')
            ]);
            $data['success'] = 'true';
            $data['msgServer'] = 'Success';             
        }
        else{ 
           if($id_room!=""){
                $ratecheck=$this->checkStop($id_room,$valid_from); 
                $ratecheck2=$this->checkStop2($id_room,$valid_from,$valid_to);
                if($ratecheck==0 && $ratecheck2==0){
                    $insert = array(
                        "status"            => TRUE,
                        "room"              => $id_room,
                        "stop_date_from"    => $valid_from,
                        "stop_date_to"      => $valid_to,
                        "created_at"        => date('Y-m-d H:i:s'),
                        "updated_at"        => date('Y-m-d H:i:s')
                    );
                    DB::table('stop_sell')->insert($insert);
                    $data['success'] = 'true';
                    $data['msgServer'] = 'Success';
                }
                else{
                    $data['success'] = 'false';
                    $data['msgServer'] = 'Same day has found please use another date';
                }
           }
           else{
                $getallroom=$this->getAllRoom(); 
                // echo "<pre>";
                // print_r($getallroom);
                // echo "</pre>";
                // die;
                foreach ($getallroom as $gar) {
                    $ratecheck=$this->checkStop($gar->id_room,$valid_from); 
                    $ratecheck2=$this->checkStop2($gar->id_room,$valid_from,$valid_to);
                    if($ratecheck==0 && $ratecheck2==0){
                        $insert = array(
                            "status"            => TRUE,
                            "room"              => $gar->id_room,
                            "stop_date_from"    => $valid_from,
                            "stop_date_to"      => $valid_to,
                            "created_at"        => date('Y-m-d H:i:s'),
                            "updated_at"        => date('Y-m-d H:i:s')
                        );
                        DB::table('stop_sell')->insert($insert);
                        $pesansukses.=$gar->name_room.' Success Add stop sale<br>';
                        $data['success'] = 'true';
                        $data['msgServer'] = $pesansukses;
                    }
                    if($ratecheck!=0 && $ratecheck2!=0){
                        $pesanerror.=$gar->name_room.' Error Add stop sale(Same day has found)<br>';
                        $data['failedgan'] = 'false';
                        $data['msgServergan'] = $pesanerror;
                    }
                }

           }
        }
        return json_encode($data);
    }

    /**
    * Programmer   : Thithe
    * Tanggal      : 08-12-2016
    * Fungsi       : menampilkan data stop sale untuk data table
    * Tipe         : create
    */
    function do_Tabel(Request $request){
        $records["aaData"] = array();
        $aColumns = array('','name', 'allotement', 'valid_from', '','');
        $sort = "name";
        $dir = "asc";
        $criteria = "name";
        //$id_room=$request->get("id_room");
        $id_room=$request->input("id_room");

        $sSearch = ($request->input("sSearch") != "") ? $request->input("sSearch") : "";
        $iDisplayLength = ($request->input("iDisplayLength") != "") ? $request->input("iDisplayLength") : "";
        $iDisplayStart = ($request->input("iDisplayStart") != "") ? $request->input("iDisplayStart") : "";
        $sEcho = ($request->input("sEcho") != "") ? $request->input("sEcho") : "";

        // Shorting
        $iSortCol_0 = ($request->input("iSortCol_0") != "") ? $request->input("iSortCol_0") : "";
        $iSortingCols = ($request->input("iSortingCols") != "") ? $request->input("iSortingCols") : "";
        if ($iSortCol_0) {
            for ($i = 0; $i < intval($iSortingCols); $i++) {
                $sort = $aColumns[intval($request->input('iSortCol_' . $i))];
                $dir = ($request->input('sSortDir_' . $i) != "") ? $request->input('sSortDir_' . $i) : "";
            }
        }
        $iTotalRecords = $this->getCountData($criteria, $sSearch,$id_room);

        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;

        $records["sEcho"] = $sEcho;
        $records["iTotalRecords"] = $iTotalRecords;
        $records["iTotalDisplayRecords"] = $iTotalRecords;

        $query = $this->getData($criteria, $sSearch, $sort, $dir, $iDisplayStart, $iDisplayLength,$id_room);

        if (count($query) > 0) {
            $no = $iDisplayStart;
            foreach ($query as $Fields) {
                
                if($Fields->status==TRUE){
                    $checked='checked="checked"';
                }
                else{
                    $checked='';
                }

                $check = ((abs(strtotime ($Fields->mroomdateto) - strtotime ($Fields->mroomdatefrom)))/(60*60*24));
                $hiddengan='<input type="hidden" value="'.$Fields->id_room.'" id="id_room" name="id_room">';
                
                $tombol="<a href='javascript:;' data-id='".$Fields->id_stopsell."' data-room='".$Fields->id_room."' class='btn btn-xs btn-danger btn-flat delete-stopsale'><i class='fa fa-times'></i>Delete Stop Sale</a>";
                $no++;
                $records["aaData"][] = array(
                    $no,
                    $Fields->name,
                    date('d-M-Y', strtotime($Fields->mroomdatefrom)),
                    date('d-M-Y', strtotime($Fields->mroomdateto)),
                    $Fields->status,
                    '<center>'
                    . $tombol.$hiddengan
                    //'<input type="checkbox" '.$checked.' name="stop_sale[]" value="'.$Fields->id_stopsell.'">'
                );
            }
        }
        echo json_encode($records);
    }

    /**
    * Programmer   : Thithe
    * Tanggal      : 08-12-2016
    * Fungsi       : get data untuk stop sale
    * Tipe         : create
    */
    function getData($criteria = "", $keyword = "", $sort = "", $dir = "", $start = "", $limit = "",$id_room=""){
        $query = DB::table('m_room');
        $query->select('m_room.*','stop_sell.*','m_room.id as id_room','stop_sell.stop_date_from as mroomdatefrom','stop_sell.stop_date_to as mroomdateto','stop_sell.id as id_stopsell');
        $query->join('stop_sell','m_room.id','=','stop_sell.room');
        $query->where('m_room.id','=',$id_room );
        
        if ($criteria && $keyword) {
            $query->where(function($modif)use($criteria, $keyword) {
                $modif->where('m_room.'.$criteria, 'ilike', '%'.$keyword.'%');
                $modif->orWhereRaw('to_char(stop_sell.stop_date_from, \'YYYY-Mon-DD\') ilike ?', array('%'.$keyword.'%'));
                $modif->orWhereRaw('to_char(stop_sell.stop_date_to, \'YYYY-Mon-DD\') ilike ?', array('%'.$keyword.'%'));
            });
        }
        if ($sort && $dir) {
            $query->orderBy($sort, $dir);
        }
        if ($start != "" && $limit != "") {
            $query->take($limit)->skip($start);
        }
        $data = $query->get();
        return $data;
    }

    /**
    * Programmer   : Thithe
    * Tanggal      : 08-12-2016
    * Fungsi       : get count data untuk stop sale
    * Tipe         : create
    */
    function getCountData($criteria = "", $keyword = "",$id_room=""){
        $query = DB::table('m_room');
        $query->select('m_room.*','stop_sell.*','m_room.id as id_room','stop_sell.stop_date_from as mroomdatefrom','stop_sell.stop_date_to as mroomdateto','stop_sell.id as id_stopsell');
        $query->join('stop_sell','m_room.id','=','stop_sell.room');
        $query->where('m_room.id','=',$id_room );
        
        if ($criteria && $keyword) {
            $query->where(function($modif)use($criteria, $keyword) {
                $modif->where('m_room.'.$criteria, 'ilike', '%'.$keyword.'%');
                $modif->orWhereRaw('to_char(stop_sell.stop_date_from, \'YYYY-Mon-DD\') ilike ?', array('%'.$keyword.'%'));
                $modif->orWhereRaw('to_char(stop_sell.stop_date_to, \'YYYY-Mon-DD\') ilike ?', array('%'.$keyword.'%'));
            });
        }
        $data = $query->get();
        return count($data);
    }

    /**
    * Programmer   : Thithe
    * Tanggal      : 08-12-2016
    * Fungsi       : menghapus data stop sale
    * Tipe         : create
    */
    public function deleteStopSale($id){
        DB::beginTransaction();
        try {
            DB::table('stop_sell')->where('id','=', $id)->delete();
            DB::commit();            
            $return["msgServer"] = "Data has been deleted";
            $return["success"] = true;
        } catch (Exception $e) {

            DB::rollback();
            $return["msgServer"] = "Sorry, Delete Data was failed.";
            $return["success"] = false;
        }
        return $return;
    }

    /**
    * Programmer   : Thithe
    * Tanggal      : 08-12-2016
    * Fungsi       : fungsi cek apakah stop sale sudah pernah di cancel stop sale
    * Tipe         : create
    */
    function checkToday($id=""){
        $ratecheck=DB::table('stop_sell')
           ->where('room','=',$id)
           ->where('status','=',false)
           ->where('stop_date_from','=',date('Y-m-d'))
           ->where('stop_date_to','=',date('Y-m-d'));
        $data=$ratecheck->get();
        return count($data);
    }

    /**
    * Programmer   : Thithe
    * Tanggal      : 08-12-2016
    * Fungsi       : fungsi cek apakah stop sale sudah ada periodnya
    * Tipe         : create
    */
    function checkPeriod($id=""){
        $ratecheck=DB::table('stop_sell')
           ->where('room','=',$id);
        $data=$ratecheck->get();
        return count($data);
    }

    /**
    * Programmer   : Thithe
    * Tanggal      : 08-12-2016
    * Fungsi       : fungsi cancel stop sale
    * Tipe         : create
    */
    public function cancelStopSale(Request $request){
        $id=$request->get("id");
        //echo $checkToday;die;
        if($id!=""){
            $checkToday=$this->checkToday($id);
            $checkPeriod=$this->checkPeriod($id);
            if($checkToday==0 && $checkPeriod>0){
                DB::beginTransaction();
                try {
                    $insert = array(
                        "status"            => FALSE,
                        "room"              => $id,
                        "stop_date_from"    => date('Y-m-d'),
                        "stop_date_to"      => date('Y-m-d'),
                        "created_at"        => date('Y-m-d H:i:s'),
                        "updated_at"        => date('Y-m-d H:i:s')
                    );
                    DB::table('stop_sell')->insert($insert);
                    DB::commit();            
                    $return["msgServer"] = "Data has been Save";
                    $return["success"] = true;
                } catch (Exception $e) {
                    DB::rollback();
                    $return["msgServer"] = "Sorry, failed.";
                    $return["success"] = false;
                }
            }
            else if($checkPeriod==0){
                $return["msgServer"] = "Sorry, You Dont have stop sell period.";
                $return["success"] = false;            
            }
            else{
                $return["msgServer"] = "Sorry, You Already Cancel Stop Sell Today.";
                $return["success"] = false;
            }
        }
        else{
            $getallroom=$this->getAllRoom(); 
            foreach ($getallroom as $gar) {
                $checkToday=$this->checkToday($gar->id_room);
                $checkPeriod=$this->checkPeriod($gar->id_room);
                if($checkToday==0 && $checkPeriod>0){
                    DB::beginTransaction();
                    try {
                        $insert = array(
                            "status"            => FALSE,
                            "room"              => $gar->id_room,
                            "stop_date_from"    => date('Y-m-d'),
                            "stop_date_to"      => date('Y-m-d'),
                            "created_at"        => date('Y-m-d H:i:s'),
                            "updated_at"        => date('Y-m-d H:i:s')
                        );
                        DB::table('stop_sell')->insert($insert);
                        DB::commit();            
                        $return["msgServer"] = "Data has been Save";
                        $return["success"] = true;
                    } catch (Exception $e) {
                        DB::rollback();
                        $return["msgServer"] = "Sorry, failed.";
                        $return["success"] = false;
                    }
                }
                else if($checkPeriod==0){
                    $return["msgServer"] = "Sorry, You Dont have stop sell period.";
                    $return["success"] = false;            
                }
                else{
                    $return["msgServer"] = "Sorry, You Already Cancel Stop Sell Today.";
                    $return["success"] = false;
                }
            }
        }
        return $return;
    }
}

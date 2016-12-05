<?php

namespace App\Http\Controllers\Vendor;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Vendor\vendorCtrl;

use DB;
use File;
use Image;
use Auth;

class roomCtrl extends Controller{
    use vendorCtrl;
    /**
    * Programmer   : Thithe
    * Tanggal      : 05-12-2016
    * Fungsi       : halaman awal config room hotel
    * Tipe         : create
    */
    public function index()
    {
        $data = [];
        $data['title'] = 'List Room';
        $data['subtitle'] = '';
        $data['url_do_action'] = url('hotel/list-room');
        $menu = $this->generateMenu();
        return view('vendor/hotel/room/view',compact('data','menu'));
    }

    /**
    * Programmer   : Thithe
    * Tanggal      : 05-12-2016
    * Fungsi       : menampilkan data room
    * Tipe         : create
    */
    function do_Tabel(Request $request){

        $records["aaData"] = array();

        $aColumns = array('','name', 'valid_from', 'stop_sell', '','');
        
        $sort = "name";
        $dir = "asc";
        $criteria = "name";
        
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
        $iTotalRecords = $this->getCountRoom($criteria, $sSearch);

        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;

        $records["sEcho"] = $sEcho;
        $records["iTotalRecords"] = $iTotalRecords;
        $records["iTotalDisplayRecords"] = $iTotalRecords;

        $query = $this->getRoom($criteria, $sSearch, $sort, $dir, $iDisplayStart, $iDisplayLength);

        if (count($query) > 0) {
            $no = $iDisplayStart;
            foreach ($query as $Fields) {
                $no++;

                if($Fields->stop_sell==TRUE){
                    $checked='checked="checked"';
                }
                else{
                    $checked='';
                }

                $records["aaData"][] = array(
                    $no,
                    $Fields->name,
                    date('d-M-Y', strtotime($Fields->valid_from)).' s/d '.date('d-M-Y', strtotime($Fields->valid_to)),
                    '<center>'
                    . '<a href="javascript:;" data-room="'.$Fields->name.'" data-id="'.$Fields->id_room.'" class="btn btn-xs btn-info btn-flat btn-editable2" data-toggle="modal" data-target="#myModal2" data-backdrop="static"><i class="fa fa-pencil"></i> Allotment</a>',
                    '<a href="javascript:;" data-room="'.$Fields->name.'" data-id="'.$Fields->id_room.'" class="btn btn-xs btn-info btn-flat btn-editable3" data-toggle="modal" data-target="#myModal3" data-backdrop="static"><i class="fa fa-pencil"></i> Stop Sale</a>'
                );
            }
        }
        echo json_encode($records);
    }

    /**
    * Programmer   : Thithe
    * Tanggal      : 05-12-2016
    * Fungsi       : ambil data room
    * Tipe         : create
    */
    function getRoom($criteria = "", $keyword = "", $sort = "", $dir = "", $start = "", $limit = ""){
        $query = DB::table('m_room');
        $query->select('m_room.*', 'm_contract_hotel.*', 'm_room.id as id_room');
        $query->join('m_hotel','m_hotel.id','=','m_room.hotel');
        $query->join('m_contract_hotel','m_hotel.id','=','m_contract_hotel.hotel');
        $query->join('m_hotel_user', 'm_hotel_user.hotel', '=', 'm_hotel.id');
        $query->where('m_hotel_user.id','=', Auth::guard('web_hotel')->user()->id);
        if ($criteria && $keyword) {
            $query->where(function($modif)use($criteria, $keyword) {
                $modif->where('m_room.'.$criteria, 'ilike', '%'.$keyword.'%');
                $modif->orWhereRaw('to_char(m_contract_hotel.valid_from, \'YYYY-Mon-DD\') ilike ?', array('%'.$keyword.'%'));
                $modif->orWhereRaw('to_char(m_contract_hotel.valid_to, \'YYYY-Mon-DD\') ilike ?', array('%'.$keyword.'%'));
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
    * Tanggal      : 05-12-2016
    * Fungsi       : hitung data room
    * Tipe         : create
    */    
    function getCountRoom($criteria = "", $keyword = ""){
        $query = DB::table('m_room');
        $query->select('m_room.*', 'm_contract_hotel.*', 'm_room.id as id_room');
        $query->join('m_hotel','m_hotel.id','=','m_room.hotel');
        $query->join('m_contract_hotel','m_hotel.id','=','m_contract_hotel.hotel');
        $query->join('m_hotel_user', 'm_hotel_user.hotel', '=', 'm_hotel.id');
        $query->where('m_hotel_user.id','=', Auth::guard('web_hotel')->user()->id);
        if ($criteria && $keyword) {
            $query->where(function($modif)use($criteria, $keyword) {
                $modif->where('m_room.'.$criteria, 'ilike', '%'.$keyword.'%');
                $modif->orWhereRaw('to_char(m_contract_hotel.valid_from, \'YYYY-Mon-DD\') ilike ?', array('%'.$keyword.'%'));
                $modif->orWhereRaw('to_char(m_contract_hotel.valid_to, \'YYYY-Mon-DD\') ilike ?', array('%'.$keyword.'%'));
            });
        }
        $data = $query->get();
        return count($data);
    }
	
    /**
    * Programmer   : Thithe
    * Tanggal      : 05-12-2016
    * Fungsi       : check data kontrak hotel
    * Tipe         : create
    */
	function getdate($id_room=null){
        $query = DB::table('m_room');
        $query->join('m_contract_hotel','m_room.hotel','=','m_contract_hotel.hotel');
        $query->where('m_room.id','=',$id_room );
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
    * Tanggal      : 05-12-2016
    * Fungsi       : check data validity price
    * Tipe         : create
    */
    function getdatestopsell($id_room=null){
        $query = DB::table('m_priment');
        $query->where('room','=',$id_room );
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
    * Tanggal      : 05-12-2016
    * Fungsi       : menampilkan data allotment
    * Tipe         : create
    */
    function allotmentdo_Tabel(Request $request){
        $records["aaData"] = array();
        $aColumns = array('','name', 'allotement', 'valid_from', '','');
        $sort = "name";
        $dir = "asc";
        $criteria = "name";
        
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
        $iTotalRecords = $this->getCountDataAllotment($criteria, $sSearch,$id_room);

        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;

        $records["sEcho"] = $sEcho;
        $records["iTotalRecords"] = $iTotalRecords;
        $records["iTotalDisplayRecords"] = $iTotalRecords;

        $query = $this->getDataAllotment($criteria, $sSearch, $sort, $dir, $iDisplayStart, $iDisplayLength,$id_room);

        if (count($query) > 0) {
            $no = $iDisplayStart;
            foreach ($query as $Fields) {
                $check = ((abs(strtotime ($Fields->mroomdateto) - strtotime ($Fields->mroomdatefrom)))/(60*60*24));
                $hiddengan='<input type="hidden" value="'.$Fields->id_room.'" id="id_room" name="id_room">';
                if($check!=0){
                    $tombol="<a href='javascript:;' data-id='".$Fields->id_allotment."' data-room='".$Fields->id_room."' class='btn btn-xs btn-info btn-flat edit-allotment'><i class='fa fa-pencil'></i>Edit Allotment</a>";
                    $tanggal=date('d-M-Y', strtotime($Fields->valid_from)).' s/d '.date('d-M-Y', strtotime($Fields->valid_to));
                    //$tambah='&nbsp; <button id="allotmentbutton" type="button" data-id="'.$Fields->id_room.'" class="btn btn-flat btn-xs btn-flat add-allotment btn-success"><i class="fa fa-plus">Add Daily Allotment</i></button> ';
                    $tambah='';
                }
                else{
                    $tombol="<a href='javascript:;' data-id='".$Fields->id_allotment."' data-room='".$Fields->id_room."' class='btn btn-xs btn-info btn-flat edit-allotment'><i class='fa fa-pencil'></i>Edit Allotment</a>

                    <a href='javascript:;' data-id='".$Fields->id_allotment."' data-room='".$Fields->id_room."' class='btn btn-xs btn-danger btn-flat delete-allotment'><i class='fa fa-times'></i>Delete Allotment</a>";
                    $tanggal=date('d-M-Y', strtotime($Fields->valid_from));
                    $tambah='';

                }
                $no++;
                $records["aaData"][] = array(
                    $no,
                    $Fields->name,
                    $Fields->allotement,
                    $Fields->max_allotement,
                    $tanggal,
                    '<center>'
                    . $tambah.$tombol.$hiddengan
                );
            }
        }
        echo json_encode($records);
    }

    /**
    * Programmer   : Thithe
    * Tanggal      : 05-12-2016
    * Fungsi       : ambil data allotment
    * Tipe         : create
    */
    function getDataAllotment($criteria = "", $keyword = "", $sort = "", $dir = "", $start = "", $limit = "",$id_room=""){
        $query = DB::table('m_room');
        $query->select('m_priment.*','m_room.*','m_room.id as id_room','m_priment.valid_from as mroomdatefrom','m_priment.valid_to as mroomdateto','m_priment.id as id_allotment');
        $query->join('m_priment','m_room.id','=','m_priment.room');
        $query->where('m_room.id','=',$id_room );

        if ($criteria && $keyword) {
            $query->where(function($modif)use($criteria, $keyword) {
                $modif->where('m_room.'.$criteria, 'ilike', '%'.$keyword.'%');
                $modif->orWhereRaw('to_char(m_priment.valid_from, \'YYYY-Mon-DD\') ilike ?', array('%'.$keyword.'%'));
                $modif->orWhereRaw('to_char(m_priment.valid_to, \'YYYY-Mon-DD\') ilike ?', array('%'.$keyword.'%'));
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
    * Tanggal      : 05-12-2016
    * Fungsi       : hitung data allotment
    * Tipe         : create
    */
    function getCountDataAllotment($criteria = "", $keyword = "",$id_room=""){
        $query = DB::table('m_room');
        $query->select('m_priment.*','m_room.*','m_room.id as id_room','m_priment.valid_from as mroomdatefrom','m_priment.valid_to as mroomdateto','m_priment.id as id_allotment');
        $query->join('m_priment','m_room.id','=','m_priment.room');
        $query->where('m_room.id','=',$id_room );
        
        if ($criteria && $keyword) {
            $query->where(function($modif)use($criteria, $keyword) {
                $modif->where('m_room.'.$criteria, 'ilike', '%'.$keyword.'%');
                $modif->orWhereRaw('to_char(m_priment.valid_from, \'YYYY-Mon-DD\') ilike ?', array('%'.$keyword.'%'));
                $modif->orWhereRaw('to_char(m_priment.valid_to, \'YYYY-Mon-DD\') ilike ?', array('%'.$keyword.'%'));
            });
        }
        $data = $query->get();
        return count($data);
    }

    /**
    * Programmer   : Thithe
    * Tanggal      : 05-12-2016
    * Fungsi       : menampilkan data daily allotment
    * Tipe         : create
    */
    function allotmentdailydo_Tabel(Request $request){
        $records["aaData"] = array();
        $aColumns = array('','allotment', 'date_daily', '','');
        $sort = "date_daily";
        $dir = "asc";
        $criteria = "date_daily";
        $id_room=$request->get("id_room");
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
        $iTotalRecords = $this->getCountDataAllotmentDaily($criteria, $sSearch,$id_room);

        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;

        $records["sEcho"] = $sEcho;
        $records["iTotalRecords"] = $iTotalRecords;
        $records["iTotalDisplayRecords"] = $iTotalRecords;

        $query = $this->getDataAllotmentDaily($criteria, $sSearch, $sort, $dir, $iDisplayStart, $iDisplayLength,$id_room);

        if (count($query) > 0) {
            $no = $iDisplayStart;
            foreach ($query as $Fields) {
                $tombol="<a href='javascript:;' data-id='".$Fields->id_daily."' data-room='".$Fields->room."' class='btn btn-xs btn-info btn-flat edit-allotmentdaily'><i class='fa fa-pencil'></i>Edit Allotment</a>";
                $no++;
                $records["aaData"][] = array(
                    $no,
                    $Fields->allotment,
                    $Fields->date_daily,
                    '<center>'
                    . $tombol
                );
            }
        }
        echo json_encode($records);
    }

    /**
    * Programmer   : Thithe
    * Tanggal      : 05-12-2016
    * Fungsi       : ambil data daily allotment
    * Tipe         : create
    */
    function getDataAllotmentDaily($criteria = "", $keyword = "", $sort = "", $dir = "", $start = "", $limit = "",$id_room=""){
        $query = DB::table('m_daily_allotment');
        $query->select('m_priment.*','m_daily_allotment.*','m_daily_allotment.id as id_daily');
        $query->join('m_priment','m_daily_allotment.priment','=','m_priment.id');
        $query->where('m_priment.room','=',$id_room );

        if ($criteria && $keyword) {
            $query->where(function($modif)use($criteria, $keyword) {
                $modif->orWhereRaw('cast(m_daily_allotment.allotment as varchar(10)) like ?', array('%'.$keyword.'%'));
                $modif->orWhereRaw('to_char(m_priment.valid_from, \'YYYY-Mon-DD\') ilike ?', array('%'.$keyword.'%'));
                $modif->orWhereRaw('to_char(m_priment.valid_to, \'YYYY-Mon-DD\') ilike ?', array('%'.$keyword.'%'));
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
    * Tanggal      : 05-12-2016
    * Fungsi       : hitung data daily allotment
    * Tipe         : create
    */
    function getCountDataAllotmentDaily($criteria = "", $keyword = "",$id_room=""){
        $query = DB::table('m_daily_allotment');
        $query->select('m_priment.*','m_daily_allotment.*','m_daily_allotment.id as id_daily');
        $query->join('m_priment','m_daily_allotment.priment','=','m_priment.id');
        $query->where('m_priment.room','=',$id_room );
        if ($criteria && $keyword) {
            $query->where(function($modif)use($criteria, $keyword) {
                $modif->orWhereRaw('cast(m_daily_allotment.allotment as varchar(10)) like ?', array('%'.$keyword.'%'));
                $modif->orWhereRaw('to_char(m_priment.valid_from, \'YYYY-Mon-DD\') ilike ?', array('%'.$keyword.'%'));
                $modif->orWhereRaw('to_char(m_priment.valid_to, \'YYYY-Mon-DD\') ilike ?', array('%'.$keyword.'%'));
            });
        }
        $data = $query->get();
        return count($data);
    }

    /**
    * Programmer   : Thithe
    * Tanggal      : 05-12-2016
    * Fungsi       : mengaktifkan dan menonaktifkan stop sale
    * Tipe         : create
    */
    function stopsale(Request $request){
        $stop_sale=$request->input('stop_sale');
        $id_room=$request->input('id_room');
        
        if($stop_sale!=""){
            DB::table('stop_sell')
            ->whereIn('id',$stop_sale)
            ->update([
                "status"         => TRUE,
                "updated_at"     => date('Y-m-d H:i:s')
            ]);

            DB::table('stop_sell')
            ->whereNotIn('id',$stop_sale)
            ->update([
                "status"         => FALSE,
                "updated_at"     => date('Y-m-d H:i:s')
            ]);
            $data['success'] = 'true';
            $data['msgServer'] = 'Success';            
        }
        else if($stop_sale==""){
            DB::table('stop_sell')
            ->where('room',$id_room)
            ->update([
                "status"         => FALSE,
                "updated_at"     => date('Y-m-d H:i:s')
            ]);
            $data['success'] = 'true';
            $data['msgServer'] = 'Success';            
        }
        else{
            $data['success'] = 'false';
            $data['msgServer'] = 'Error';
        }
        return json_encode($data);
    }

    /**
    * Programmer   : Thithe
    * Tanggal      : 05-12-2016
    * Fungsi       : check apakah ada data diperiode yang sama
    * Tipe         : create
    */
    function checkRate($id_room="",$date=""){
        $ratecheck=DB::table('m_priment')
           ->where('room','=',$id_room)
           ->where('valid_from','=',$date);
        $data=$ratecheck->first();

        return count($data);
    }

    /**
    * Programmer   : Thithe
    * Tanggal      : 05-12-2016
    * Fungsi       : check apakah ada data dengan hari yang sama
    * Tipe         : create
    */
    function checkDaily($id = "", $tanggal = ""){
        $ratecheck=DB::table('m_daily_allotment')
        ->where('priment','=',$id)
        ->WhereRaw('to_char(date_daily, \'YYYY-Mon\') ilike ?', array('%'.$tanggal.'%'));
        $data=$ratecheck->get();
        return count($data);
    }

    /**
    * Programmer   : Thithe
    * Tanggal      : 05-12-2016
    * Fungsi       : ambil data dari m_priment
    * Tipe         : create
    */
    function getDatePriment($id=""){
        $ratecheck=DB::table('m_priment')
           ->where('id','=',$id);
        $data=$ratecheck->first();
        return $data;
    }
	
    /**
    * Programmer   : Thithe
    * Tanggal      : 05-12-2016
    * Fungsi       : simpan data allotment
    * Tipe         : create
    */
	public function postAllotment(Request $request){
        $id_room = $request->input('id_room');
        $sallotment = $request->input('sallotment');
        $max_sallotment = $request->input('max_sallotment');
		$type_allotment = $request->input('type_allotment');
        $query = DB::table('m_room')
            ->join('m_contract_hotel','m_room.hotel','=','m_contract_hotel.hotel')
            ->where('m_room.id','=',$id_room )
            ->first();
        $valid_from=date('Y-m-d', strtotime($request->input('validity_day')));

        if($request->input('mode_form') == 'ubah'){
		  $id_allotment = $request->input('id_allotment');
            DB::table('m_priment')
            ->where('id', '=', $id_allotment)
            ->update([
                "allotement"        => $sallotment,
                "max_allotement"    => $max_sallotment,
                "updated_at"        => date('Y-m-d H:i:s')
            ]);
            if($max_sallotment>$sallotment){
                $data['success'] = 'false';
                $data['msgServer'] = 'Max Allotment Per Day Cant more than Monthly allotment';
            }
            else{
                $datepriment=$this->getDatePriment($id_allotment);
                $checkDaily=$this->checkDaily($id_allotment,date('Y-m', strtotime($datepriment->valid_from)));
                if($checkDaily==0){                        
                    for ($i=date('d', strtotime($datepriment->valid_from)); $i <= date('t', strtotime($datepriment->valid_to)); $i++) { 
                        $insert = array(
                            "priment"           => $id_allotment,
                            "allotment"         => $datepriment->max_allotement,
                            "date_daily"        => date('Y-m-d', strtotime(date('Y-m', strtotime($datepriment->valid_from)).'-'.$i)),
                            "created_at"        => date('Y-m-d H:i:s'),
                            "updated_at"        => date('Y-m-d H:i:s')
                        );
                        DB::table('m_daily_allotment')->insert($insert);
                    }
                }
                else{
                    DB::table('m_daily_allotment')
                    ->where('priment', '=', $id_allotment)
                    ->update([
                        "allotment"         => $max_sallotment,
                        "updated_at"        => date('Y-m-d H:i:s')
                    ]);
                }
                $data['success'] = 'true';
                $data['msgServer'] = 'Success';
            }             
        }
        else{
            $ratecheck=$this->checkRate($id_room,$valid_from); 
            if($ratecheck==0){
                $insert = array(
                    "room"              => $id_room,
                    "valid_from"        => $valid_from,
                    "valid_to"          => $valid_from,
                    "allotement"        => $sallotment,
                    "best_value"        => $rate->best_value,
                    "vlm_value"         => $rate->vlm_value,
                    "amenities"         => $rate->amenities,
                    "breakfast"         => $rate->breakfast,
                    "created_at"        => date('Y-m-d H:i:s'),
                    "updated_at"        => date('Y-m-d H:i:s')
                );
                DB::table('m_priment')->insert($insert);

                $data['success'] = 'true';
                $data['msgServer'] = 'Success';
            }
            else{
                $data['success'] = 'false';
                $data['msgServer'] = 'Same day has found please use another date';
            }
		}
        return json_encode($data);
    }

    /**
    * Programmer   : Thithe
    * Tanggal      : 05-12-2016
    * Fungsi       : simpan data daily allotment
    * Tipe         : create
    */
    public function postAllotmentDaily(Request $request){
        $id_daily = $request->input('id_daily');
        $priment = $request->input('priment');
        $sallotment = $request->input('sallotment_daily');
        $getmaxallotment=$this->getDatePriment($priment);
        if($sallotment>$getmaxallotment->max_allotement){
            $data['success'] = 'false';
            $data['msgServer'] = 'Max Allotment Cant more than Max Allotment Per Day In Monthly Tab setting';
        }
        else{
            if($request->input('mode_form') == 'ubah' && $getmaxallotment->allotement >= $sallotment){
                DB::table('m_daily_allotment')
                ->where('id', '=', $id_daily)
                ->update([
                    "allotment"         => $sallotment,
                    "updated_at"        => date('Y-m-d H:i:s')
                ]);
                $data['success'] = 'true';
                $data['msgServer'] = 'Success';             
            }
            else{
                $data['success'] = 'false';
                $data['msgServer'] = 'Allotment Cant More Than Monthly Allotment';
            }
        }
        return json_encode($data);
    }
	
    /**
    * Programmer   : Thithe
    * Tanggal      : 05-12-2016
    * Fungsi       : ambil data allotment saat edit allotment
    * Tipe         : create
    */
	public function editAllotment($id_allotment=null)
    {
        $rate=DB::table('m_priment')
        ->where('id',$id_allotment)
        ->first();
        
        $check = ((abs(strtotime ($rate->valid_to) - strtotime ($rate->valid_from)))/(60*60*24));

        $data = [
            "id_allotment"      => $rate->id,
            "check"             => $check,
            "max_allotement"    => $rate->max_allotement,
			"date_from"         => $rate->valid_from,
            "date_to"           => $rate->valid_to,
            "sallotment"       	=> $rate->allotement
        ];
        $return['results'] = $data;   
        $query = DB::table('m_room');
        $query->join('m_contract_hotel','m_room.hotel','=','m_contract_hotel.hotel');
        $query->where('m_room.id','=',$rate->room );
        $room = $query->first();
        $return['room'] = $room;
        return $return;
    }

    /**
    * Programmer   : Thithe
    * Tanggal      : 05-12-2016
    * Fungsi       : ambil data daily allotment saat edit daily allotment
    * Tipe         : create
    */
    public function editAllotmentDaily($id="")
    {
       $rate=DB::table('m_daily_allotment')
       ->where('id',$id)
       ->first();
        $data = [
            "id"                => $rate->id,
            "priment"           => $rate->priment,
            "date_daily"        => $rate->date_daily,
            "sallotment"        => $rate->allotment
        ];
        $return['results'] = $data;   
        return $return;
    }

    /**
    * Programmer   : Thithe
    * Tanggal      : 05-12-2016
    * Fungsi       : delete data allotment thithe
    * Tipe         : create
    */
	public function deleteAllotment($id_allotment){
        DB::beginTransaction();
        try {
            DB::table('m_priment')->where('id','=', $id_allotment)->delete();
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
    * Tanggal      : 05-12-2016
    * Fungsi       : simpan data stop sale
    * Tipe         : create
    */
	public function postStopsale(Request $request){
        if($request->input('validity_from') == ""){
            $data['success'] = 'false';
            $data['msgServer'] = "Please fill Validity From's Field";
            return json_encode($data);
        }elseif($request->input('validity_to') == ""){
            $data['success'] = 'false';
            $data['msgServer'] = "Please fill Validity To's Field";
            return json_encode($data);
        }    
        $id_allotment = $request->input('id_allotment');
		$id_stopsale = $request->input('id_stopsale');
	    
        $validity_from = date('Y-m-d', strtotime($request->input('validity_from')));
        $validity_to   = date('Y-m-d', strtotime($request->input('validity_to')));
		
		$cekfrom = DB::table('m_stopsale')
		->where('validity_from', '<=', $validity_from)
		->where('validity_to', '>=', $validity_from)
		->where('user_stopsale', '=', 'supplier')
		->where('id_allotment', '=', $id_allotment)
        ->get();
			
		$cekto = DB::table('m_stopsale')
		->where('validity_from', '<=', $validity_to)
		->where('validity_to', '>=', $validity_to)
		->where('user_stopsale', '=', 'supplier')
		->where('id_allotment', '=', $id_allotment)
        ->get();
			
		if(empty($cekfrom)){
    		if(empty($cekto)){
                if($request->input('mode_form') == 'ubah'){
		
                    $id_stopsale = $request->input('id_stopsale');
			
			        DB::table('m_stopsale')
	    			->where('id_stopsale', '=', $id_stopsale)
	    			->update([
    					'validity_from' 	=> $validity_from,
    					'validity_to' 		=> $validity_to,
                        "updated_at"        => date('Y-m-d H:i:s')
					]); 
					$data['success'] = 'true';
            		$data['msgServer'] = 'Success';    
        		}
        		else{
		
            		$insert = array(
    					"id_allotment" 			=> $id_allotment,
                        "validity_from"         => $validity_from,
                        "validity_to"           => $validity_to,
                        "user_stopsale"         => 'supplier',
                        "created_at"            => date('Y-m-d H:i:s'),
                        "updated_at"            => date('Y-m-d H:i:s')
                    );
                    DB::table('m_stopsale')->insert($insert);

                    $data['success'] = 'true';
                    $data['msgServer'] = 'Success';
	           } 
		    }
    		else{
		        $data['msgServer'] = 'Validity To Sudah ada';
		    }
		}
		else{
		    $data['msgServer'] = 'Validity From Sudah ada';
		}
        return json_encode($data);
    }	
	
    /**
    * Programmer   : Thithe
    * Tanggal      : 05-12-2016
    * Fungsi       : hapus data stop sale
    * Tipe         : create
    */
	public function deleteStopsale($id_stopsale=null){
        DB::beginTransaction();
        try {
            DB::table('m_stopsale')->where('id_stopsale','=', $id_stopsale)->delete();
            DB::commit();            
            // return redirect('hotelrate');
            $return["msgServer"] = "Delete Stopsale Success.";
            $return["success"] = true;
        } catch (Exception $e) {
            DB::rollback();
            $return["msgServer"] = "Sorry, Delete Stopsale Failed.";
            $return["success"] = false;
        }
        return $return;
    }
}

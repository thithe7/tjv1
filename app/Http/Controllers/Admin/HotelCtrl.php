<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Admin\adminCtrl;
use App\Http\Controllers\Admin\menuCtrl;
use DB;
use File;
use Image;
use Storage;
use URL;
use Toastr;
use Mail;
use Session;
use Input;



class HotelCtrl extends adminCtrl
{
    use menuCtrl;
     /**
    * Programmer   : Ory
    * Tanggal      : 05-12-2016
    * Fungsi       : Menampilkan halaman vendor dengan membawa beberapa variabel
    * Tipe         : Edit
    */
    public function index()
    {
        $data = [];
        $data['title'] = 'Hotel';
        $data['subtitle'] = '';
        $data['url_do_action'] = '/hotel';
        $data['country'] = $this->getCountry();
        $data['city'] = $this->getCity(1);
        $data['area'] = $this->getArea(1);
        $data['vendor_type'] = $this->getVendorType(1);
        $menu = $this->generateMenu();
        return view('admin/vendor/view',compact('data','menu'));
    }

    /**
    * Programmer   : Ory
    * Tanggal      : 05-12-2016
    * Fungsi       : Mengambil data dari tabel m_country
    * Tipe         : Edit
    */
    function getCountry($id=null){
        $query = DB::table('m_country');
        if($id!=null){
            $query->where('id', $id);
        }
        $query->orderBy('id', 'asc');
        $data = $query->get();
        return $data;
    }

    /**
    * Programmer   : Ory
    * Tanggal      : 05-12-2016
    * Fungsi       : Mengambil data dari tabel m_city
    * Tipe         : Edit
    */
    function getCity($id=null){
        $query = DB::table('m_city');
        if($id!=null){
            $query->where('country', $id);
        }
        $query->orderBy('id', 'asc');
        $data = $query->get();
        return $data;
    }

    /**
    * Programmer   : Ory
    * Tanggal      : 05-12-2016
    * Fungsi       : Mengambil data dari tabel m_area
    * Tipe         : Edit
    */
    function getArea($id=null){
        $query = DB::table('m_area');
        $query->where('city', $id);
        $query->orderBy('id', 'asc');
        $data = $query->get();
        return $data;
    }

    /**
    * Programmer   : Ory
    * Tanggal      : 05-12-2016
    * Fungsi       : Mengambil data dari tabel m_vendor_type
    * Tipe         : Create
    */
    function getVendorType($id=null){
        $query = DB::table('m_vendor_type');
        $query->orderBy('id', 'asc');
        $data = $query->get();
        return $data;
    }

    /**
    * Programmer   : Ory
    * Tanggal      : 05-12-2016
    * Fungsi       : Menampilkan select option nama kota
    * Tipe         : Edit
    */
    function getChoose($id=""){
        $query = DB::table('m_city');
        $query->select('m_city.*');
        $query->where('m_city.country',$id);
        $data = $query->get();
        foreach ($data as $kota) {
            echo "<option value='$kota->id'>$kota->city_name</option>";
        }
    }

     /**
    * Programmer   : Ory
    * Tanggal      : 05-12-2016
    * Fungsi       : Mengambil jumlah hotel
    * Tipe         : Edit
    */
    function getCountHotel($criteria = "", $keyword = ""){
        $query = DB::table('m_vendor');
        $query->select('m_vendor.*', 'm_city.name as city');
        $query->join('m_area', 'm_area.id', '=', 'm_vendor.area');
        $query->join('m_city', 'm_city.id', '=', 'm_area.city');
        $query->join('m_country', 'm_country.id', '=', 'm_city.country');
        $query->where('m_vendor.vendor_type', '=', 1);

        if ($criteria && $keyword) {
            $query->where('m_vendor.'.$criteria, 'ilike', '%'.$keyword.'%');
            $query->orWhere('m_vendor.name', 'ilike', '%'.$keyword.'%');
            $query->orWhere('m_vendor.code', 'ilike', '%'.$keyword.'%');
            $query->orWhere('m_city.name', 'ilike', '%'.$keyword.'%');
            $query->orWhereRaw('to_char(m_vendor.updated_at, \'YYYY-Mon-DD\') ilike ?', array('%'.$keyword.'%'));
        }
        $data = $query->get();
        return count($data);
    }

     /**
    * Programmer   : Ory
    * Tanggal      : 05-12-2016
    * Fungsi       : Mengambil data hotel
    * Tipe         : Edit
    */
    function getHotel($criteria = "", $keyword = "", $sort = "", $dir = "", $start = "", $limit = ""){
        $data = "";
        $query = DB::table('m_vendor');
        $query->select('m_vendor.id as id_hotel', 'm_vendor.name as name_hotel', 'm_vendor.star_rate','m_vendor.code as hotel_code', 'm_city.name as city');
        $query->join('m_area', 'm_area.id', '=', 'm_vendor.area');
        $query->join('m_city', 'm_city.id', '=', 'm_area.city');
        $query->join('m_country', 'm_country.id', '=', 'm_city.country');
        $query->where('m_vendor.vendor_type', '=', 1);

        if ($criteria && $keyword) {
            $query->where(function($modif)use($criteria, $keyword) {
                $modif->orWhere('m_vendor.'.$criteria, 'ilike', '%'.$keyword.'%');
                $modif->orWhere('m_vendor.name', 'ilike', '%'.$keyword.'%');
                $modif->orWhere('m_city.name', 'ilike', '%'.$keyword.'%');
                $modif->orWhere('m_vendor.code', 'ilike', '%'.$keyword.'%');
                $modif->orWhereRaw('cast(m_vendor.star_rate as varchar(10)) like ?', array('%'.$keyword.'%'));
                $modif->orWhereRaw('to_char(m_vendor.updated_at, \'YYYY-Mon-DD\') ilike ?', array('%'.$keyword.'%'));
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
    * Programmer   : Ory
    * Tanggal      : 05-12-2016
    * Fungsi       : Menampilkan data hotel yang diedit
    * Tipe         : Edit
    */
    function List_Data($id_hotel= "") {
        $query = DB::table('m_vendor');
        $query->select(DB::raw('m_vendor.id as id_hotel, m_vendor.code as hotel_code,m_contract_hotel.cut_of_date as cod_hotel, m_vendor.name as name_hotel, m_city.name as name_city, m_vendor.star_rate as star_hotel, m_country.name as name_country, m_vendor.address, m_vendor.phone as telephone_hotel, m_vendor.email as email_hotel, m_vendor.lat as latitude_hotel, m_vendor.long as longitude_hotel, m_vendor.code as hotel_code, m_vendor.cp_name, m_vendor.cp_phone, m_vendor.cp_mail, m_vendor.cp_title, m_vendor.cp_department, m_vendor.area as area_hotel, m_area.name as name_area, m_area.city as id_city, m_city.country as id_country, m_contract_hotel.valid_from as valid_from, m_contract_hotel.valid_to as valid_to'));
        $query->join('m_contract_hotel','m_contract_hotel.hotel','=','m_vendor.id');
        $query->join('m_area','m_area.id','=','m_vendor.area');
        $query->join('m_city','m_city.id','=','m_area.city');
        $query->join('m_country','m_country.id','=','m_city.country');
        $query->where('m_vendor.id', $id_hotel);
        $data = $query->first();
        return $data;
    }

    /**
    * Programmer   : Ory
    * Tanggal      : 05-12-2016
    * Fungsi       : Menampilkan data hotel ke datatable
    * Tipe         : Edit
    */
    function do_Tabel(Request $request){
        $records["aaData"] = array();
        $aColumns = array('','m_vendor.name', 'm_vendor.code', 'm_vendor.star_rate', 'm_city.name',  '');
        $sort = "m_vendor.name";
        $dir = "asc";
        $criteria = "name";
        $sSearch = ($request->input("sSearch") != "") ? $request->input("sSearch") : "";
        $iDisplayLength = ($request->input("iDisplayLength") != "") ? $request->input("iDisplayLength") : "";
        $iDisplayStart = ($request->input("iDisplayStart") != "") ? $request->input("iDisplayStart") : "";
        $sEcho = ($request->input("sEcho") != "") ? $request->input("sEcho") : "";

        // Sorting
        $iSortCol_0 = ($request->input("iSortCol_0") != "") ? $request->input("iSortCol_0") : "";
        $iSortingCols = ($request->input("iSortingCols") != "") ? $request->input("iSortingCols") : "";
        if ($iSortCol_0) {
            for ($i = 0; $i < intval($iSortingCols); $i++) {
                $sort = $aColumns[intval($request->input('iSortCol_' . $i))];
                $dir = ($request->input('sSortDir_' . $i) != "") ? $request->input('sSortDir_' . $i) : "";
            }
        }
        $iTotalRecords = $this->getCountHotel($criteria, $sSearch);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $records["sEcho"] = $sEcho;
        $records["iTotalRecords"] = $iTotalRecords;
        $records["iTotalDisplayRecords"] = $iTotalRecords;
        $query = $this->getHotel($criteria, $sSearch, $sort, $dir, $iDisplayStart, $iDisplayLength);
        $photos = $this->getPhotos();
        if (count($query) > 0) {
            $no = $iDisplayStart;
            foreach ($query as $Fields) {
                $jmlphoto = 0;
                foreach ($photos as $row) {
                    if ($row->id_hotel == $Fields->id_hotel) {
                        $jmlphoto = $jmlphoto+1;
                    }
                }
                $no++;
                if((strpos($Fields->name_hotel, 'Delete') !== false) || (strpos($Fields->name_hotel, 'delete') !== false) || (strpos($Fields->name_hotel, 'DELETE') !== false)){
                    $button = '<center>'
                    . '<a href="javascript:;" data-city="'.$Fields->city.'" data-id="' . $Fields->id_hotel . '" data-name="' . $Fields->name_hotel . '" class="btn btn-xs btn-info btn-flat btn-detail" data-toggle="modal" data-target="#myModal" data-backdrop="static"><i class="fa fa-pencil"></i> Detail</a>';
                }else{
                    $button = '<center>'
                    . '<a href="javascript:;" data-city="'.$Fields->city.'" data-id="' . $Fields->id_hotel . '" data-name="' . $Fields->name_hotel . '" class="btn btn-xs btn-info btn-flat btn-editable" data-toggle="modal" data-target="#myModal" data-backdrop="static"><i class="fa fa-pencil"></i> Edit</a>'
                    .'&nbsp;&nbsp;<a href="javascript:;" data-id="' . $Fields->id_hotel . '" data-name="' . $Fields->name_hotel . '" class="btn btn-xs btn-success btn-flat btn-detailable"><i class="fa fa-file-text-o"></i> Room Setup </a>'
                    .'</center>';
                }
                $records["aaData"][] = array(
                    $no,
                    $Fields->name_hotel,
                    $Fields->hotel_code,
                    $Fields->star_rate,
                    $Fields->city,
                    $button
                    );
            }
        }
        echo json_encode($records);
    }

    /**
    * Programmer   : Ory
    * Tanggal      : 05-12-2016
    * Fungsi       : Fungsi edit data hotel
    * Tipe         : Edit
    */
    function do_Ubah(Request $request) {
        $return = array();
        $itemList = array();
        $id_hotel = ($request->input("id_hotel") != "") ? $request->input("id_hotel") : "";

        if ($this->Chek_Data($id_hotel) > 0) {
            $Fields = $this->List_Data($id_hotel);
            $item = array(
                "id_hotel"          => $Fields->id_hotel,
                "name_hotel"        => $Fields->name_hotel,
                "hotel_code"        => $Fields->hotel_code,
                "star_hotel"        => $Fields->star_hotel,
                "country_hotel"     => $Fields->id_country,
                "city_hotel"        => $Fields->id_city,
                "address"           => $Fields->address,
                "area_hotel"        => $Fields->area_hotel,
                "telephone_hotel"   => $Fields->telephone_hotel,
                "email_hotel"       => $Fields->email_hotel,
                "hotel_lat"         => $Fields->latitude_hotel,
                "hotel_lgt"         => $Fields->longitude_hotel,
                "cod_hotel"         => $Fields->cod_hotel,
                "cp_name"           => $Fields->cp_name,
                "cp_phone"          => $Fields->cp_phone,
                "cp_mail"           => $Fields->cp_mail,
                "cp_title"          => $Fields->cp_title,
                "cp_department"     => $Fields->cp_department,
                "valid_from"        => date("M-Y", strtotime($Fields->valid_from)),
                "valid_to"          => date("M-Y", strtotime($Fields->valid_to))
            );
            $itemList[] = $item;
            $return["success"] = TRUE;
            $return["results"] = $item;
        } else {
            $return["success"] = FALSE;
            $return["msgServer"] = "Sorry, Hotel not found.";
        }
        echo json_encode($return);
    }

    /**
    * Programmer   : Ory
    * Tanggal      : 05-12-2016
    * Fungsi       : Fungsi tambah hotel
    * Tipe         : Edit
    */
    function do_Simpan(Request $request) {
        $return = array();
        $error = "";
        $mode_form = $request->input('mode_form');
        $id        = $request->input('id_hotel');

        if ($mode_form == "tambah") {
            $cekk = DB::table('m_vendor')
                ->join('m_area', 'm_area.id', '=', 'm_vendor.area')
                ->where('m_area.city', '=', $request->input('city_hotel'))
                ->get();

            $city_code = DB::table('m_area')
                ->select('m_city.code')
                ->join('m_city', 'm_area.city', '=', 'm_city.id')
                ->where('m_area.city', '=', $request->input('city_hotel'))
                ->first()->code;

            $sqlcity = DB::table('m_city')
                ->select('code')
                ->where('id', '=', $request->input('city_hotel'))->first();
            $date=date("ym");

            $idc = DB::table('m_vendor')
                 ->get();

            if(!$cekk){
                $codehotel=$city_code.$date."0001";
            }else{
                $codehotel=$city_code.$date.str_pad(base_convert(base_convert((count($idc)+1),36,10),10,36),4,0,STR_PAD_LEFT);
            }

            if($idc == 0){
                $userid = "H".$date."0001";
                $passwd = "H0001";
            }else{
                $userid="H".$date.str_pad(base_convert(base_convert((count($idc)+1),36,10),10,36),4,0,STR_PAD_LEFT);
                $passwd = "H".str_pad(base_convert(base_convert((count($idc)+1),36,10),10,36),4,0,STR_PAD_LEFT);
            }

            if ($this->Chek_DataEmail($request->input('email_hotel')) == 0) {
                DB::beginTransaction();
                try {
                    $data = array(
                        "name"          => $request->input('name_hotel'),
                        "code"          => $codehotel,
                        "star_rate"     => $request->input('star_hotel'),
                        "address"       => $request->input('address'),
                        "area"          => $request->input('area_hotel'),
                        "phone"         => $request->input('telephone_hotel'),
                        "email"         => $request->input('email_hotel'),
                        "lat"           => $request->input('latitude_hotel'),
                        "long"          => $request->input('longitude_hotel'),
                        "cp_name"       => $request->input('cp_name'),
                        "cp_phone"      => $request->input('cp_phone'),
                        "cp_mail"       => $request->input('cp_mail'),
                        "cp_title"      => $request->input('cp_title'),
                        "cp_department" => $request->input('cp_department'),
                        "created_at"    => date("Y-M-d H:i:s")
                    );
                    DB::table('m_vendor')->insert($data);

                    $id_hotel = DB::table('m_vendor')
                        ->orderBy('id', 'desc')->first()->id;

                    $validto = date('t', strtotime($request->input('validity_to')));

                    $data_contract = array(
                        "hotel"         => $id_hotel,
                        "cut_of_date"   => $request->input('cod_hotel'),
                        "valid_from"    => date("Y-M-d", strtotime($request->input('validity_from')."-01")),
                        "valid_to"      => date("Y-M-d", strtotime($request->input('validity_to')."-".$validto)),
                        "created_at"    => date("Y-M-d H:i:s")
                    );
                    DB::table('m_contract_hotel')->insert($data_contract);

                    $data2 = array(
                        "email"     => $request->input('email_hotel'),
                        "status"    => "active",
                        "password"  => bcrypt($passwd),
                        "username"    => $userid,
                        "hotel"    => $id_hotel,
                        "created_at"=> date('Y-m-d H:i:s'),
                    );
                    DB::table('m_vendor_user')->insert($data2);

                    if ($request->hasFile('hotel_photo')){
                        $file = $request->file('hotel_photo');
                        $destinationPath = 'assets/hotel_img';
                        $filename = date("ymdHis").$file->getClientOriginalName();
                        Input::file('hotel_photo')->move($destinationPath, $filename);
                        $photo=array('hotel'=>$id_hotel,'photo'=>$filename, 'created_at'=>date('Y-m-d H:i:s'));
                        DB::table('m_photo')->insert($photo);
                    }

                    $email = $request->input('email_hotel');
                    $emaildata = array(
                        "type"      => 'tambah',
                        "name"      => $request->input('name_hotel'),
                        "username"  => $userid,
                        "password"  => $passwd
                    );
                    $emaildata = array(
                        'logo' => 'http://traveljinni.com/tj/public/assets/images/traveljinni-logo-icon.png',
                        'login' => 'http://traveljinni/tj/public/login',
                        'name' => $request->input('name_hotel'),
                        'email' => $request->input('email_hotel'),
                        'username' => $userid,
                        'password' => $passwd,
                        'mode' => 'register',
                        'heading' => 'Travel Jinni Registration',
                        'content' => 'Hai '.$request->input('name_hotel').',<br><br>
                            Terima Kasih telah bergabung dalam http://www.traveljinni.com <br><br>
                            Jika Anda memerlukan informasi lebih lanjut, silahkan hubungi Customer Service Travel Jinni<br/><br/>
                            Hormat kami,<br/>
                            TRAVEL JINNI<br/><br/><hr>
                            Hi '.$request->input('name_hotel').',<br/><br/>
                            Should you need more information or assistance, please call TRAVEL JINNI Customer Service<br/><br/>
                            Yours Sincerely,<br/>
                            TRAVEL JINNI'
                    );
                    Mail::send('users.emailreg', $emaildata, function ($message) use ($email) {
                        $message->from('info@traveljinni.com', 'Admin Travel Jinni');
                        $message->to($email)->subject('TRAVEL JINNI Hotel Activation');
                    });
                    DB::commit();
                    $return["msgServer"] = "Save Hotel success.";
                    $return["success"] = TRUE;
                } catch (Exception $e) {
                    DB::rollback();
                    $return["msgServer"] = "Save Hotel failed. !!!";
                    $return["success"] = FALSE;
                }
            } else {
                $error = "Sorry, User already exists. !!!";
                $return["msgServer"] = "Sorry, Email already exists. !!!";
                $return["success"] = FALSE;
            }
        } else if ($mode_form == "ubah") {
            if ($this->Chek_Data($id) > 0) {
                DB::beginTransaction();
                try {
                    $data = array(
                        "name"          => $request->input('name_hotel'),
                        "star_rate"     => $request->input('star_hotel'),
                        "address"       => $request->input('address'),
                        "area"          => $request->input('area_hotel'),
                        "phone"         => $request->input('telephone_hotel'),
                        "email"         => $request->input('email_hotel'),
                        "lat"           => $request->input('latitude_hotel'),
                        "long"          => $request->input('longitude_hotel'),
                        "cp_name"       => $request->input('cp_name'),
                        "cp_phone"      => $request->input('cp_phone'),
                        "cp_mail"       => $request->input('cp_mail'),
                        "cp_title"      => $request->input('cp_title'),
                        "cp_department" => $request->input('cp_department'),
                        "updated_at"    => date("Y-M-d H:i:s")
                    );
                    DB::table('m_vendor')->where('id', $id)->update($data);
                    $validto = date('t', strtotime($request->input('validity_to')));
                    $data_contract = array(
                        "cut_of_date"   => $request->input('cod_hotel'),
                        "valid_from"    => date("Y-M-d", strtotime($request->input('validity_from')."-01")),
                        "valid_to"      => date("Y-M-d", strtotime($request->input('validity_to')."-".$validto)),
                        "updated_at"    => date("Y-M-d H:i:s")
                    );
                    DB::table('m_contract_hotel')->where('hotel', $id)->update($data_contract);
                    $data2 = array(
                        "email"     => $request->input('email_hotel'),
                        "updated_at"=> date('Y-m-d H:i:s')
                    );
                    DB::table('m_vendor_user')->where('hotel', $id)->update($data2);
                    if ($request->hasFile('hotel_photo')){
                        $file = $request->file('hotel_photo');
                        $destinationPath = 'assets/hotel_img';
                        $filename = date("ymdHis").$file->getClientOriginalName();
                        Input::file('hotel_photo')->move($destinationPath, $filename);
                        $photo=array('hotel'=>$id,'photo'=>$filename, 'created_at'=>date('Y-m-d H:i:s'));
                        DB::table('m_photo')->insert($photo);
                    }
                    $email = $request->input('email_hotel');
                    $emaildata = array(
                        "type"      => 'update',
                        "name"      => $request->input('name_hotel')
                    );
                    DB::commit();
                    $return["msgServer"] = "Update Hotel success.";
                    $return["success"] = TRUE;
                } catch (Exception $e) {
                    DB::rollback();
                    $return["msgServer"] = "Update Hotel failed. !!!";
                    $return["success"] = FALSE;
                }
            } 
            else {
                $return["msgServer"] = "Sorry, User not found1. !!!";
                $return["success"] = FALSE;
            }
        }
        else{
            $return["msgServer"] = "Sorry, User not found2. !!!";
            $return["success"] = FALSE;
        }
        return json_encode($return);
    }

    /**
    * Programmer   : Ory
    * Tanggal      : 05-12-2016
    * Fungsi       : Fungsi cek data hotel yang diedit ada atau tidak
    * Tipe         : Edit
    */
    function Chek_Data($id_hotel = "", $name_hotel = "") {
        $query = DB::table('m_vendor');

        if ($id_hotel) {
            $query->where('id', $id_hotel);
        } else {
            $query->where('name', $name_hotel);
        }
        $data = $query->get();
        return count($data);
    }

    /**
    * Programmer   : Ory
    * Tanggal      : 05-12-2016
    * Fungsi       : Fungsi cek data email yang didaftarkan ada atau tidak
    * Tipe         : Edit
    */
    function Chek_DataEmail($email = "") {
        $query = DB::table('m_vendor_user');
        $query->where('email', $email);
        $data = $query->get();
        return count($data);
    }

    /**
    * Programmer   : Ory
    * Tanggal      : 05-12-2016
    * Fungsi       : Fungsi hapus data hotel
    * Tipe         : Edit
    */
    function do_Hapus(Request $request){
        $id_hotel = ($request->input("id_hotel") != "") ? $request->input("id_hotel") : "";

        DB::beginTransaction();
        try {
            $this->delete($id_hotel);
            $hotel = DB::table('m_vendor')->where('id', $id_hotel)->first();
            $email = $hotel->email;
            $emaildata = array(
                "type"      => 'delete',
                "name"      => $hotel->name
            );

            DB::commit();
            $return["msgServer"] = "Hotel was successfully deleted";
            $return["success"] = true;
        } catch (Exception $e) {
            DB::rollback();
            $return["msgServer"] = "Sorry, Delete hotel was failed";
            $return["success"] = false;
        }
        echo json_encode($return);
    }


    /**
    * Programmer   : Ory
    * Tanggal      : 05-12-2016
    * Fungsi       : Fungsi menampilkan foto hotel
    * Tipe         : Edit
    */
     function getPhotos($id=null){
        $query = DB::table('m_photo');
        $query->select(DB::raw('m_photo.photo, m_vendor.id as id_hotel, m_photo.id as id_photo'));
        $query->join('m_vendor','m_vendor.id','=','m_photo.vendor');

        if($id != null){
            $query->where('m_photo.vendor','=',$id );
        }
        $data = $query->get();

        $a='<table id="tabel_photo" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="text-align: center;">Picture</th>
                        <th style="text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>';
        foreach ($data as $foto) {
          $a .= "<tr>
                    <td align='center'>
                        <img style='height: 80px; display: block;' src='". URL::to('/assets/hotel_img/'.$foto->photo)."'></td>
                    <td align='center' width='40%'>
                        <button type='button' class='btn-delphoto' data-name-photo='".$foto->photo."' data-id-photo='".$foto->id_photo."'><i class='fa fa-trash-o' data-toggle='tooltip' data-placement='bottom' title='' data-original-title='Delete $foto->photo'></i></button>
                    </td>
                </tr>";
        }
        $a .=  '</tbody>
            </table>';
        if($id != null ){
            return $a;
        }
        else{
            return $data;
        }
    }

    /**
    * Programmer   : Ory
    * Tanggal      : 05-12-2016
    * Fungsi       : Fungsi hapus foto hotel
    * Tipe         : Edit
    */
    public function deletePhotos($id=null){
        $photo=DB::table('m_photo')->where('id','=', $id)->first();
        File::delete('assets/hotel_img/'.$photo->photo);
        DB::table('m_photo')->where('id','=', $id)->delete();

        $return["msgServer"] = "Photo has been deleted";
        $return["success"] = true;
        return json_encode($return);
    }

     /**
    * Programmer   : Ory
    * Tanggal      : 05-12-2016
    * Fungsi       : Fungsi hapus data hotel
    * Tipe         : Edit
    */
    public function delete($id_hotel = "")
    {
        if($id_hotel != ""){
            $data = DB::table('m_vendor')
                ->where('id', $id_hotel)
                ->first()->name;

            DB::table('m_vendor')
                ->where('id', $id_hotel)
                ->update(['name' => '(Delete) '.$data]);
        }
    }
}


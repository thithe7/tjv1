<?php

namespace App\Http\Controllers\Vendor;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Vendor\vendorCtrl;

use DB;
use File;
use Image;
use Storage;
use URL;
use Toastr;
use Mail;
use Auth;
use Input;

class HotelCtrl extends Controller{
    use vendorCtrl;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
    * Programmer   : Thithe
    * Tanggal      : 05-12-2016
    * Fungsi       : halaman profile hotel dengan membawa data hotel, country, city dan area
    * Tipe         : create
    */
    public function index()
    {
        $data = [];
        $data['title'] = 'Hotel';
        $data['subtitle'] = '';
        $data['url_do_action'] = '/hotel';
        $data['country'] = $this->getCountry();
        $data['city'] = $this->getCity();
        $data['area'] = $this->getArea();
        $data['hotel'] = $this->getHotel();
        $menu = $this->generateMenu();
        return view('vendor/hotel/hotel/view',compact('data','menu'));
    }

    /**
    * Programmer   : Thithe
    * Tanggal      : 05-12-2016
    * Fungsi       : ambil data m_country
    * Tipe         : create
    */
    function getCountry($id=null){
        $query = DB::table('m_country');
        $query->orderBy('id', 'asc');
        $data = $query->get();
        return $data;
    }

    /**
    * Programmer   : Thithe
    * Tanggal      : 05-12-2016
    * Fungsi       : ambil data m_city
    * Tipe         : create
    */
    function getCity($id=null){
        $query = DB::table('m_city');
        $query->orderBy('id', 'asc');
        $data = $query->get();
        return $data;
    }

    /**
    * Programmer   : Thithe
    * Tanggal      : 05-12-2016
    * Fungsi       : ambil data m_area
    * Tipe         : create
    */
    function getArea($id=null){
        $query = DB::table('m_area');
        $query->orderBy('id', 'asc');
        $data = $query->get();
        return $data;
    }

    /**
    * Programmer   : Thithe
    * Tanggal      : 05-12-2016
    * Fungsi       : ambil data m_vendor sesuai id login vendor
    * Tipe         : create
    */
    function getHotel() {
        $query = DB::table('m_vendor');
        $query->select(DB::raw('m_vendor.point_back, m_vendor.id as id_hotel, m_vendor.code as hotel_code,m_contract_vendor.cut_of_date as cod_hotel, m_vendor.name as name_hotel, m_city.name as name_city, m_vendor.star_rate as star_hotel, m_country.name as name_country, m_vendor.address, m_vendor.phone as telephone_hotel, m_vendor.email as email_hotel, m_vendor.lat as latitude_hotel, m_vendor.long as longitude_hotel, m_vendor.code as hotel_code, m_vendor.cp_name, m_vendor.cp_phone, m_vendor.cp_mail, m_vendor.cp_title, m_vendor.cp_department, m_vendor.area as area_hotel, m_area.name as name_area, m_area.city as id_city, m_city.country as id_country, m_contract_vendor.valid_from as valid_from, m_contract_vendor.valid_to as valid_to'));
        $query->join('m_contract_vendor','m_contract_vendor.vendor','=','m_vendor.id');
        $query->join('m_area','m_area.id','=','m_vendor.area');
        $query->join('m_city','m_city.id','=','m_area.city');
        $query->join('m_country','m_country.id','=','m_city.country');
        $query->join('m_vendor_user', 'm_vendor_user.vendor', '=', 'm_vendor.id');
        $query->where('m_vendor_user.id','=', Auth::guard('web_vendor')->user()->id);
        $data = $query->first();
        return $data;
    }

    /**
    * Programmer   : Thithe
    * Tanggal      : 05-12-2016
    * Fungsi       : update data m_vendor, m_photo & m_vendor_user sesuai id login vendor
    * Tipe         : create
    */
    function do_Simpan(Request $request) {
        $return = array();
        $error = "";

        $mode_form = $request->input('mode_form');
        $id        = $request->input('id_hotel');

        $date=date("ym");

        $idc = DB::table('m_vendor')
            ->whereMonth('created_at', '=', date('m'))
            ->whereYear('created_at', '=', date('Y'))
            ->count('id');

        DB::beginTransaction();
        try {
            $data = array(
                "point_back"    => $request->input('point_back'),
                "phone"         => $request->input('telephone_hotel'),
                "email"         => $request->input('email_hotel'),
                "cp_phone"      => $request->input('cp_phone'),
                "cp_mail"       => $request->input('cp_mail'),
                "updated_at"    => date("Y-M-d H:i:s")
            );    
            DB::table('m_vendor')->where('id', $id)->update($data);
            
            $data2 = array(
                "email"     => $request->input('email_hotel'),
                "updated_at"=> date('Y-m-d H:i:s'),
            );
            DB::table('m_vendor_user')->where('vendor', $id)->update($data2);

            if ($request->hasFile('hotel_photo')){
                $file = $request->file('hotel_photo');
                $destinationPath = 'assets/images';
                $filename = $file->getClientOriginalName().date("ymdHis").$file->getClientOriginalExtension();
                Input::file('hotel_photo')->move($destinationPath, $filename);
                $photo=array('vendor'=>$id,'photo'=>$filename, 'created_at'=>date('Y-m-d H:i:s'));
                DB::table('m_photo')->insert($photo);
            }
            DB::commit();
            $return["msgServer"] = "Update Hotel success.";
            $return["success"] = TRUE;
        } catch (Exception $e) {
            DB::rollback();
            $return["msgServer"] = "Update Hotel failed. !!!";
            $return["success"] = FALSE;
        }
        echo json_encode($return);
    }

    /**
    * Programmer   : Thithe
    * Tanggal      : 05-12-2016
    * Fungsi       : delete data m_photo sesuai dengan photo yang ingin dihapus
    * Tipe         : create
    */
    public function deletePhotos($id=null){
        $photo=DB::table('m_photo')->where('id','=', $id)->first();
        File::delete('assets/images/'.$photo->photo);
        DB::table('m_photo')->where('id','=', $id)->delete();

        $return["msgServer"] = "Photo has been deleted";
        $return["success"] = true;

        return json_encode($return);
    }

    /**
    * Programmer   : Thithe
    * Tanggal      : 05-12-2016
    * Fungsi       : menampilkan data m_photo menggunakan datatable
    * Tipe         : create
    */
    function getPhotos($id=null, Request $request){
        $records["aaData"] = array();
        $aColumns = array('','photo','');
        $sort = "photo";
        $dir = "asc";
        $criteria = "photo";
        
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
        $iTotalRecords = $this->getCountPhoto($criteria, $sSearch,$id);

        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;

        $records["sEcho"] = $sEcho;
        $records["iTotalRecords"] = $iTotalRecords;
        $records["iTotalDisplayRecords"] = $iTotalRecords;

        $query = $this->getPhoto($criteria, $sSearch, $sort, $dir, $iDisplayStart, $iDisplayLength,$id);

        if (count($query) > 0) {
            $no = $iDisplayStart;
            foreach ($query as $Fields) {
                $no++;

                $records["aaData"][] = array(
                    $no,
                    '<img style="height: 80px; display: block;" src="'. URL::to('/assets/images/'.$Fields->photo).'">',
                    
                    '<center>'
                    . '<button type="button" class="btn-delphoto" data-name-photo="'.$Fields->photo.'" data-id-photo="'.$Fields->id_photo.'"><i class="fa fa-trash-o" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete '.$Fields->photo.'"></i></button>'
                );
            }
        }
        echo json_encode($records);
    }    

    /**
    * Programmer   : Thithe
    * Tanggal      : 05-12-2016
    * Fungsi       : ambil data m_photo
    * Tipe         : create
    */
    function getPhoto($criteria = "", $keyword = "", $sort = "", $dir = "", $start = "", $limit = "", $id=""){
        $query = DB::table('m_photo');
        $query->select(DB::raw('m_photo.photo, m_vendor.id as id_hotel, m_photo.id as id_photo'));
        $query->join('m_vendor','m_vendor.id','=','m_photo.vendor');
        $query->where('m_photo.vendor','=',$id );
        if ($criteria && $keyword) {
            $query->where('m_photo.'.$criteria, 'ilike', '%'.$keyword.'%');
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
    * Fungsi       : hitung data m_photo
    * Tipe         : create
    */
    function getCountPhoto($criteria = "", $keyword = "", $id=""){
        $query = DB::table('m_photo');
        $query->select(DB::raw('m_photo.photo, m_vendor.id as id_hotel, m_photo.id as id_photo'));
        $query->join('m_vendor','m_vendor.id','=','m_photo.vendor');
        $query->where('m_photo.vendor','=',$id );
        if ($criteria && $keyword) {
            $query->where('m_photo.'.$criteria, 'ilike', '%'.$keyword.'%');
        }
        $data = $query->get();
        return count($data);
    }
}

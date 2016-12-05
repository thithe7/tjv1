<?php

namespace App\Http\Controllers\Users\Traits;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use DB;

trait ParentCtrl {
    //home autocomplete
    public function getdateParent(){
        $return['batas']=date('Y-m-d');
        return $return;
    }

    public function autocompleteParent($term = null)
    {
        $return_array = [];
        $hotel=DB::table('m_city')
        ->where('name','ilike','%'.$term.'%')
        ->orwhere('province','ilike','%'.$term.'%')
        ->get();

        $coba = DB::table('m_hotel')
        ->where('name', 'ilike', '%'.$term.'%')
        ->get();
        //city
        foreach ($hotel as $row) {
            $return_array[] = array('value' => 0, 'label'=> $row->name, 'idcountry'=>$row->country, 'idcity'=>$row->id, 'category'=>'City', 'icon'=>'fa-building');
        }
        if (count($coba) > 0) {
            foreach ($coba as $row1) {
                $return_array[] = array('value' => $row1->name,'idhotel'=>$row1->id,'category'=>'Hotel','icon'=>'fa-bed');
            }
        } else {
            $return_array[] = ['value' => 'no result','idhotel'=>0,'category'=>'no result','icn'=>'fa-times'];
        }
        return $return_array;
    }   


    //search
    public function checkStopSell($id = "", $tanggal = ""){
        $query = DB::table('m_hotel');
        $query->select(DB::raw('stop_sell.status'));
        $query->join('m_room','m_room.hotel','=','m_hotel.id');
        $query->join('stop_sell','m_room.id','=','stop_sell.room');
        $query->where('m_hotel.id','=',$id );
        //$query->WhereRaw('to_char(stop_sell.stop_date_from, \'YYYY-Mon-DD\') ilike ?', array('%'.$tanggal.'%'));
        $query->where('stop_sell.stop_date_from','=',$tanggal );
        $query->where('stop_sell.status','=',FALSE );
        $data = $query->first();
        //echo count($data);
        if(count($data)==0){
            $query = DB::table('m_hotel');
            $query->select(DB::raw('stop_sell.status'));
            $query->join('m_room','m_room.hotel','=','m_hotel.id');
            $query->join('stop_sell','m_room.id','=','stop_sell.room');
            $query->where('m_hotel.id','=',$id );
            $query->where('stop_sell.stop_date_from','<=',$tanggal );
            $query->where('stop_sell.stop_date_to','>=',$tanggal );
            $query->where('stop_sell.status','=',TRUE );
            $data = $query->first();
        }
        return $data;
    }

    public function getPhoto($id = ""){
        $query = DB::table('m_photo');
        $query->select(DB::raw('m_photo.photo, m_hotel.id as id_hotel, m_photo.id as id_photo'));
        $query->join('m_hotel','m_hotel.id','=','m_photo.hotel');
        $query->where('m_photo.hotel','=',$id );
        $data = $query->first();
        return $data;
    }

    public function getPrice($id = "", $checkin = ""){
        $query = DB::table('m_room');
        $query->join('m_priment','m_room.id','=','m_priment.room');
        $query->where('m_room.hotel','=',$id );
        $query->where('m_priment.valid_from','<=',$checkin );
        $query->where('m_priment.valid_to','>=',$checkin );
        $query->where('m_priment.allotement','>',0 );
        $query->orderBy('m_priment.best_value','asc' );
        $data = $query->first();
        return $data;
    }

    public function getHotelMob($destination = "",$checkin="",$checkout=""){
        $query = DB::table('m_hotel');
        $query->select(DB::raw('distinct m_hotel.id as id_hotel , m_hotel.name as name_hotel, m_priment.best_value as price_hotel'));
        $query->join('m_area','m_area.id','=','m_hotel.area');
        $query->join('m_city','m_city.id','=','m_area.city');
        $query->join('m_country','m_country.id','=','m_city.country');
        $query->join('m_room','m_room.hotel','=','m_hotel.id');
        $query->join('m_priment','m_room.id','=','m_priment.room');
        $query->where('m_hotel.area', '=', $destination);
        $query->orderBy('m_priment.best_value', 'asc');
        $data_hotel = $query->get();

        $id_hotel = 0;
        $data = array();
        if(!empty($data_hotel)){
            for ($i = 0; $i < count($data_hotel); $i++) {
                $foto = DB::table('m_photo')
                ->where('hotel', $data_hotel[$i]->id_hotel)->get();

                if($id_hotel != $data_hotel[$i]->id_hotel){
                    $data[$i] = array(
                        "id_hotel"      => $data_hotel[$i]->id_hotel,
                        "name_hotel"    => $data_hotel[$i]->name_hotel,
                        "photo_hotel"   => $foto,
                        "price_hotel"   => $data_hotel[$i]->price_hotel,
                        "checkin"       => date("d M Y", strtotime($checkin)),
                        "checkout"      => date("d M Y", strtotime($checkout))
                        );
                    $id_hotel = $data_hotel[$i]->id_hotel;
                }
            }
        }

        return $data;
    }


    public function getHotelInfinite(){
        $query = DB::table('m_hotel');
        $query->select(DB::raw('m_hotel.id as id_hotel, m_hotel.code as hotel_code,m_contract_hotel.cut_of_date as cod_hotel, m_hotel.name as name_hotel, m_city.name as name_city, m_hotel.star_rate as star_hotel, m_country.name as name_country, m_hotel.address, m_hotel.phone as telephone_hotel, m_hotel.email as email_hotel, m_hotel.lat as latitude_hotel, m_hotel.long as longitude_hotel, m_hotel.code as hotel_code, m_hotel.cp_name, m_hotel.cp_phone, m_hotel.cp_mail, m_hotel.cp_title, m_hotel.cp_department, m_hotel.area as area_hotel, m_area.name as name_area, m_area.city as id_city, m_city.country as id_country, m_contract_hotel.valid_from as valid_from, m_contract_hotel.valid_to as valid_to'));
        $query->join('m_contract_hotel','m_contract_hotel.hotel','=','m_hotel.id');
        $query->join('m_area','m_area.id','=','m_hotel.area');
        $query->join('m_city','m_city.id','=','m_area.city');
        $query->join('m_country','m_country.id','=','m_city.country');
        $data = $query->get();
        return $data;
    }

    public function getHotel($criteria = "", $keyword = "", $sort = "", $dir = "", $start = "", $limit = "",$checkcod=""){
        $query = DB::table('m_hotel');
        $query->select(DB::raw('m_hotel.id as id_hotel, m_hotel.code as hotel_code,m_contract_hotel.cut_of_date as cod_hotel, m_hotel.name as name_hotel, m_city.name as name_city, m_hotel.star_rate as star_hotel, m_country.name as name_country, m_hotel.address, m_hotel.phone as telephone_hotel, m_hotel.email as email_hotel, m_hotel.lat as latitude_hotel, m_hotel.long as longitude_hotel, m_hotel.code as hotel_code, m_hotel.cp_name, m_hotel.cp_phone, m_hotel.cp_mail, m_hotel.cp_title, m_hotel.cp_department, m_hotel.area as area_hotel, m_area.name as name_area, m_area.city as id_city, m_city.country as id_country, m_contract_hotel.valid_from as valid_from, m_contract_hotel.valid_to as valid_to'));
        $query->join('m_contract_hotel','m_contract_hotel.hotel','=','m_hotel.id');
        $query->leftjoin('m_area','m_area.id','=','m_hotel.area');
        $query->leftjoin('m_city','m_city.id','=','m_area.city');
        $query->leftjoin('m_country','m_country.id','=','m_city.country');
        if ($criteria && $keyword) {
            $query->where('m_hotel.'.$criteria, 'ilike', '%'.$keyword.'%');
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

    public function getCountHotel($criteria = "", $keyword = "",$checkcod=""){
        $query = DB::table('m_hotel');
        $query->select(DB::raw('m_hotel.id as id_hotel, m_hotel.code as hotel_code,m_contract_hotel.cut_of_date as cod_hotel, m_hotel.name as name_hotel, m_city.name as name_city, m_hotel.star_rate as star_hotel, m_country.name as name_country, m_hotel.address, m_hotel.phone as telephone_hotel, m_hotel.email as email_hotel, m_hotel.lat as latitude_hotel, m_hotel.long as longitude_hotel, m_hotel.code as hotel_code, m_hotel.cp_name, m_hotel.cp_phone, m_hotel.cp_mail, m_hotel.cp_title, m_hotel.cp_department, m_hotel.area as area_hotel, m_area.name as name_area, m_area.city as id_city, m_city.country as id_country, m_contract_hotel.valid_from as valid_from, m_contract_hotel.valid_to as valid_to'));
        $query->join('m_contract_hotel','m_contract_hotel.hotel','=','m_hotel.id');
        $query->leftjoin('m_area','m_area.id','=','m_hotel.area');
        $query->leftjoin('m_city','m_city.id','=','m_area.city');
        $query->leftjoin('m_country','m_country.id','=','m_city.country');
        if ($criteria && $keyword) {
            $query->where('m_hotel.'.$criteria, 'ilike', '%'.$keyword.'%');
        }
        $data = $query->get();
        return count($data);
    }

    //details
    public function getPhotoDetail($id = ""){
        $photo = DB::table('m_photo')
        ->where('m_photo.hotel', $id);
        $data=$photo->get();
        return $data;
    }

    public function checkDailyAllotment($id = "", $tanggal = ""){
        $daily = DB::table('m_daily_allotment')
        ->where('priment', $id)
        ->where('date_daily', $tanggal);
        $data=$daily->first();
        return $data;
    }

    public function getHotelDetail($id = "") {
        $query = DB::table('m_hotel');
        $query->select(DB::raw('m_hotel.id as id_hotel, m_hotel.code as hotel_code, m_hotel.name as name_hotel, m_city.name as name_city, m_hotel.star_rate as star_hotel, m_country.name as name_country, m_hotel.address, m_hotel.phone as telephone_hotel, m_hotel.email as email_hotel, m_hotel.lat as latitude_hotel, m_hotel.long as longitude_hotel, m_hotel.code as hotel_code, m_hotel.cp_name, m_hotel.cp_phone, m_hotel.cp_mail, m_hotel.cp_title, m_hotel.cp_department, m_hotel.area as area_hotel, m_area.name as name_area, m_area.city as id_city, m_city.country as id_country'));
        $query->join('m_area','m_area.id','=','m_hotel.area');
        $query->join('m_city','m_city.id','=','m_area.city');
        $query->join('m_country','m_country.id','=','m_city.country');
        $query->where('m_hotel.id','=', $id);
        $data = $query->first();
        return $data;
    }

    public function getHotelDetailMob($id = "") {
        $query = DB::table('m_hotel');
        $query->select(DB::raw('m_hotel.id as id_hotel, m_hotel.code as hotel_code, m_hotel.name as name_hotel, m_city.name as name_city, m_hotel.star_rate as star_hotel, m_country.name as name_country, m_hotel.address, m_hotel.phone as telephone_hotel, m_hotel.email as email_hotel, m_hotel.lat as latitude_hotel, m_hotel.long as longitude_hotel, m_hotel.code as hotel_code, m_hotel.cp_name, m_hotel.cp_phone, m_hotel.cp_mail, m_hotel.cp_title, m_hotel.cp_department, m_hotel.area as area_hotel, m_area.name as name_area, m_area.city as id_city, m_city.country as id_country'));
        $query->join('m_area','m_area.id','=','m_hotel.area');
        $query->join('m_city','m_city.id','=','m_area.city');
        $query->join('m_country','m_country.id','=','m_city.country');
        $query->where('m_hotel.id','=', $id);
        $data1 = $query->first();

        $query2 = DB::table('m_priment');
        $query2->select('m_priment.id as id', 'm_room.name as name_room', 'm_priment.best_value as price_room');
        $query2->join('m_room','m_priment.room','=','m_room.id');
        $query2->join('m_hotel','m_hotel.id','=','m_room.hotel');
        $query2->where('m_hotel.id','=', $id);
        $query2->orderBy('m_priment.best_value','asc');
        $data2 = $query2->get();

        $data = array(
            "hotel" => $data1,
            "room" => $data2,
            );
        return $data;
    }

    public function getRoom($criteria = "", $keyword = "", $sort = "", $dir = "", $start = "", $limit = "", $id = "", $checkin = ""){
        //$cekin='2016-12-08';
        //$cekin= $request->input('checkin');
        $query = DB::table('m_room');
        $query->select('m_room.*','m_priment.*','m_room.id as id_room');
        $query->join('m_priment','m_room.id','=','m_priment.room');
        $query->where('m_room.hotel','=',$id );
        $query->where('m_priment.valid_from','<=',$checkin );
        $query->where('m_priment.valid_to','>=',$checkin );
        $query->orderBy('m_priment.best_value','desc' );
        // if ($criteria && $keyword) {
        //     $query->where(function($modif)use($criteria, $keyword) {
        //         $modif->where('m_room.'.$criteria, 'ilike', '%'.$keyword.'%');
        //         $modif->orWhereRaw('to_char(m_contract_hotel.valid_from, \'YYYY-Mon-DD\') ilike ?', array('%'.$keyword.'%'));
        //         $modif->orWhereRaw('to_char(m_contract_hotel.valid_to, \'YYYY-Mon-DD\') ilike ?', array('%'.$keyword.'%'));
        //     });
        // }
        
        if ($sort && $dir) {
            $query->orderBy($sort, $dir);
        }
        if ($start != "" && $limit != "") {
            $query->take($limit)->skip($start);
        }
        $data = $query->get();
        return $data;
    }

    public function getCountRoom($criteria = "", $keyword = "", $id = "", $checkin = ""){
        $query = DB::table('m_room');
        $query->select('m_room.*','m_priment.*','m_room.id as id_room');
        $query->join('m_priment','m_room.id','=','m_priment.room');
        $query->where('m_room.hotel','=',$id );
        $query->where('m_priment.valid_from','<=',$checkin );
        $query->where('m_priment.valid_to','>=',$checkin );
        $query->orderBy('m_priment.best_value','desc' );
        // if ($criteria && $keyword) {
        //     $query->where(function($modif)use($criteria, $keyword) {
        //         $modif->where('m_room.'.$criteria, 'ilike', '%'.$keyword.'%');
        //         $modif->orWhereRaw('to_char(m_contract_hotel.valid_from, \'YYYY-Mon-DD\') ilike ?', array('%'.$keyword.'%'));
        //         $modif->orWhereRaw('to_char(m_contract_hotel.valid_to, \'YYYY-Mon-DD\') ilike ?', array('%'.$keyword.'%'));
        //     });
        // }
        $data = $query->get();
        return count($data);
    }



    //booking
    function getTotalPoint($iduser = ""){
        $jmlpoint=0;
        $query = DB::table('m_point');
        $query->where('userid','=',$iduser );
        $ambilpoint = $query->get();
        foreach ($ambilpoint as $key) {
            $jmlpoint=$jmlpoint+$key->total_point;
        }
        return $jmlpoint; 
    }

    function getRoomBooking($id = ""){
        $query = DB::table('m_room');
        $query->where('id','=',$id );
        $data = $query->first();
        // echo "aaa".$id;
        // print_r($data);
        return $data;
    }

    public function getPriceBooking($id = "", $checkin = ""){
        $query = DB::table('m_room');
        $query->join('m_priment','m_room.id','=','m_priment.room');
        $query->where('m_room.hotel','=',$id );
        $query->where('m_priment.valid_from','<=',$checkin );
        $query->where('m_priment.valid_to','>=',$checkin );
        $query->where('m_priment.allotement','>',0 );
        $query->orderBy('m_priment.best_value','desc' );
        $data = $query->first();
        return $data;
    }

    public function getConfig(){
        $query = DB::table('m_config');
        $data = $query->first();
        return $data;
    }

    public function checkVoucher($code = ""){
        $query = DB::table('m_booking');
        $query->join('m_point','m_booking.id','=','m_point.id_trans');
        $query->where('m_booking.invoice_code','=',$code);
        $query->where('m_point.total_point','>',0);
        $data = $query->first();
        //print_r($data);
        //die;
        return $data;
    }

    public function getUser(){
        $query = DB::table('m_user');
        $query->join('m_user_details','m_user.id','=','m_user_details.id_user');
        $query->where('m_user.id','=',Auth::user()->id );
        $data = $query->first();
        return $data;
    }
}
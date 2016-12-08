<?php

namespace App\Http\Controllers\Users\Traits;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use DB;
use URL;
trait ParentCtrl {
    //home autocomplete
    public function getdateParent(){
        $return['batas']=date('Y-m-d');
        return $return;
    }

    /**
    * Programmer   : Thithe
    * Tanggal      : 01-12-2016
    * Fungsi       : query autocomplete
    * Tipe         : create
    */
    public function autocompleteParent($term = null)
    {
        $return_array = [];
        $hotel=DB::table('m_city')
        ->where('name','ilike','%'.$term.'%')
        ->orwhere('province','ilike','%'.$term.'%')
        ->get();

        $coba = DB::table('m_vendor')
        ->where('name', 'ilike', '%'.$term.'%')
        ->where('vendor_type', '=', '1')
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
    /**
    * Programmer   : Thithe
    * Tanggal      : 01-12-2016
    * Fungsi       : query halaman search untuk ambil data vendor
    * Tipe         : create
    */
    public function getDataSearch($destination, $breakfast, $amenities, $hotel_name, $star, $cekin, $cekout, $amount, $amount2, $ketdbprice, $night, $page){
        $query=$this->getHotelInfinite($hotel_name, $star, $cekin, $amount, $amount2, $ketdbprice);
        //echo count($query);
        $hargabreakfast=0;
        $hargaamenities=0;
        $ketbreakfast='';
        $ketamenities='';  
        $vlmdeals = "";
        $qty=0;
        $hargamaks=0;
        $total=0;
        $data['hargamaks']=0;
        $jinni=$this->getConfig();
        $default_allotment=$jinni->max_allotment_default;
        $link='';
        if (count($query) > 0) {
            foreach ($query as $Fields) {
                //ambil photo
                $id=$Fields->id_hotel;
                $link = "http://localhost/tj/public/detail-hotel?id_hotel=".$id."&destination=".$destination."&checkin=".$cekin."&checkout=".$cekout."&breakfast=".$breakfast."&amenities=".$amenities;
                $queryphoto = $this->getPhoto($Fields->id_hotel);
                if(count($queryphoto)>0){
                    $photo=URL::to('assets/images/'.$queryphoto->photo);
                }
                else{
                    $photo=URL::to('assets/images/NoImageFound.png');
                }

                //ambil harga
                $date = new \DateTime("now", new \DateTimeZone($Fields->timezone) );
                $curtime = $date->format('H:i:s');
                $now=strtotime($curtime);
                $from=strtotime($jinni->vlm_from);
                $to=strtotime($jinni->vlm_to);
                if ($from >= $to) {
                    if($now <= $from && $now <= $to){
                        $ketdbprice='vlm';
                    } else {
                        $ketdbprice='best';
                    }
                } else {
                    if($now>=$from && $now<=$to){
                        $ketdbprice='vlm';
                    }
                    else{
                        $ketdbprice='best';  
                    }   
                }
                $queryprice = $this->getPrice($Fields->id_hotel, $cekin, $amount, $amount2, $ketdbprice);
                if(count($queryprice)>0){
                    $uang='IDR.';
                    $book='<button type="submit" style="background-color:#095668;" class="btn btn-primary btn-block btn-md search-submit btn-tj">Book Now</button>';
                    $labelsold='';

                    $best_value=$queryprice->best_value;
                    
                    //best value = best price + amenities + breakfast

                    if($breakfast!=""){
                        $hargabreakfast=$queryprice->breakfast;
                        $ketbreakfast='<i class="ficon ficon-positive" data-selenium="benefit-included-icon"></i> Breakfast included';

                    }

                    if($amenities!=""){
                        $hargaamenities=$queryprice->amenities;
                        $ketamenities='<i class="ficon ficon-positive" data-selenium="benefit-included-icon"></i> Amenities included';
                    }
                    
                    $bestprice=$best_value+$queryprice->breakfast+$queryprice->amenities;

                    $date = new \DateTime("now", new \DateTimeZone($Fields->timezone) );
                    $curdatetime = $date->format('Y-m-d H:i:s');
                    $curdate = $date->format('Y-m-d');
                    $curtime = $date->format('H:i:s');
                    $tanggallastminutesawal = date('H:i:s', strtotime($jinni->vlm_from));
                    $tanggallastminutesakhir = date('H:i:s', strtotime($jinni->vlm_to));
                    
                    //checkbetween
                    $now=strtotime($curtime);
                    $from=strtotime($jinni->vlm_from);
                    $to=strtotime($jinni->vlm_to);
                    if ($from >= $to) {
                        if($now <= $from && $now <= $to){
                            $hargaambil=$queryprice->vlm_value;
                            $vlmdeals = "<font style='color: #096588;'>Very last minute price</font>";
                        } else {
                            $hargaambil=$best_value;
                        }
                    } else {
                        if($now>=$from && $now<=$to){
                            $hargaambil=$queryprice->vlm_value;    
                            $vlmdeals = "<font style='color: #096588;'>Very last minute price</font>";
                        }
                        else{
                            $hargaambil=$best_value;
                        }   
                    }

                    if($breakfast!="" && $amenities!=""){
                        $total=$bestprice;
                    }
                    else{
                        $total=$hargaambil+$hargabreakfast+$hargaamenities;
                    }
                    if($night!=0){
                        $harga_tampil_check=$total*$night;
                        $harga_tampil=number_format($total*$night);
                    }
                    else{
                        $harga_tampil_check=$total;
                        $harga_tampil=number_format($total);   
                    }

                    if($hargamaks<$harga_tampil_check){
                        $hargamaks=$harga_tampil_check;
                        $data['hargamaks']=$harga_tampil_check;
                    }

                    $total_allotment=$queryprice->allotement;
                    $checkdaily=$this->checkDailyAllotment($queryprice->id_priment, $cekin);
                    if(count($checkdaily)>0){
                        $dailyallotment=$checkdaily->allotment;
                        if($dailyallotment<$total_allotment){
                            $qty=$dailyallotment;
                        }
                        else{
                            $qty=$total_allotment;
                        }
                    }
                    else{
                        if($total_allotment>$default_allotment){
                            $qty=$default_allotment;
                        }
                        else{
                            $qty=$total_allotment;
                        }
                    }

                }
                else{
                    $uang='';
                    $harga_tampil='';
                    $book='<button class="btn btn-primary" style="background-color:#87949b;" disabled>Book Now</button>';
                    $labelsold='<font color=red>(Sold Out)</font>';
                    $vlmdeals = "";
                }

                //check star hotel
                if($Fields->star_hotel!=""){
                    $star='<i class="ficon ficon-star-'.$Fields->star_hotel.'"></i>';
                }
                else{
                    $star='No Star';
                }

                //check stop sell
                $checkStopSell = $this->checkStopSell($Fields->id_hotel,$cekin);
                if (count($checkStopSell)>0) {
                    if ($checkStopSell->status==FALSE) {
                    }
                    else{
                        $uang='';
                        $best_value='';
                        $book='<button class="btn btn-primary" style="background-color:#87949b;" disabled>Book Now</button>';                        
                        $labelsold='<font color=red>(Sold Out)</font>';
                    }
                } else {
                }

                if ( $qty > 0 ) {
                } else{
                    $harga_tampil='';
                    $uang='';
                    $best_value='';
                    $book='<button class="btn btn-primary" style="background-color:#87949b;" disabled>Book Now</button>';   
                    $labelsold='<font color=red>(Sold Out)</font>';
                }

                $data['records'][] = array(
                    'harga_tampil'  =>$harga_tampil,
                    'url'           =>url('detail-hotel'),
                    'id_hotel'      =>$Fields->id_hotel,
                    'address'       =>$Fields->address,
                    'area'          =>$Fields->name_area,
                    'destination'   =>$destination,
                    'cekin'         =>$cekin,
                    'cekout'        =>$cekout,
                    'breakfast'     =>$breakfast,
                    'amenities'     =>$amenities,
                    'ketbreakfast'  =>$ketbreakfast,
                    'ketamenities'  =>$ketamenities,
                    'photo'         =>$photo,
                    'name_hotel'    =>$Fields->name_hotel,
                    'star'          =>$star,
                    'uang'          =>$uang,
                    'book'          =>$book,
                    'vlmdeals'      =>$vlmdeals,
                    'labelsold'     =>$labelsold,
                    'link'          =>$link
                );
            }
        }
        else{
            $data['records'] = array('');
        }

        $page = ! empty( $page ) ? (int) $page : 1;
        $total = count( $data['records'] ); //total items in array    
        $limit = 10; //per page    
        $data['totalPages'] = ceil( $total/ $limit ); //calculate total pages
        $page = max($page, 1); //get 1 page when $_GET['page'] <= 0
        $page = min($page, $data['totalPages']); //get last page when $_GET['page'] > $totalPages
        $offset = ($page - 1) * $limit;
        if( $offset < 0 ) $offset = 0;
        $data['records'] = array_slice( $data['records'], $offset, $limit );

        return $data;
    }

    /**
    * Programmer   : Thithe
    * Tanggal      : 01-12-2016
    * Fungsi       : check stop sale vendor hotel
    * Tipe         : create
    */
    public function checkStopSell($id = "", $tanggal = ""){
        $query = DB::table('m_vendor');
        $query->select(DB::raw('stop_sell.status'));
        $query->join('m_room','m_room.vendor','=','m_vendor.id');
        $query->join('stop_sell','m_room.id','=','stop_sell.room');
        $query->where('m_vendor.id','=',$id );
        $query->where('stop_sell.stop_date_from','=',$tanggal );
        $query->where('stop_sell.status','=',FALSE );
        $data = $query->first();
        if(count($data)==0){
            $query = DB::table('m_vendor');
            $query->select(DB::raw('stop_sell.status'));
            $query->join('m_room','m_room.vendor','=','m_vendor.id');
            $query->join('stop_sell','m_room.id','=','stop_sell.room');
            $query->where('m_vendor.id','=',$id );
            $query->where('stop_sell.stop_date_from','<=',$tanggal );
            $query->where('stop_sell.stop_date_to','>=',$tanggal );
            $query->where('stop_sell.status','=',TRUE );
            $data = $query->first();
        }
        return $data;
    }

    /**
    * Programmer   : Thithe
    * Tanggal      : 01-12-2016
    * Fungsi       : ambil data photo
    * Tipe         : create
    */
    public function getPhoto($id = ""){
        $query = DB::table('m_photo');
        $query->select(DB::raw('m_photo.photo, m_vendor.id as id_hotel, m_photo.id as id_photo'));
        $query->join('m_vendor','m_vendor.id','=','m_photo.vendor');
        $query->where('m_photo.vendor','=',$id );
        $data = $query->first();
        return $data;
    }

    /**
    * Programmer   : Thithe
    * Tanggal      : 01-12-2016
    * Fungsi       : ambil harga vendor
    * Tipe         : create
    */
    public function getPrice($id = "", $checkin = "", $amount = "", $amount2 = "", $ketdbprice = ""){
        $query = DB::table('m_room');
        $query->select(DB::raw('m_room.*, m_priment.*, m_priment.id as id_priment'));
        $query->join('m_priment','m_room.id','=','m_priment.room');
        $query->where('m_room.vendor','=',$id );
        $query->where('m_priment.valid_from','<=',$checkin );
        $query->where('m_priment.valid_to','>=',$checkin );
        $query->where('m_priment.allotement','>',0 );
        if($amount!="" && $amount2!=""){
            if($ketdbprice=="best"){
                $query->whereBetween('best_value', [$amount, $amount2]);
            }
            else{
                $query->whereBetween('vlm_value', [$amount, $amount2]);
            }
        }
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


    /**
    * Programmer   : Thithe
    * Tanggal      : 01-12-2016
    * Fungsi       : query ambil data hotel
    * Tipe         : create
    */
    public function getHotelInfinite($hotel_name = "", $star = "", $checkin = "", $amount = "", $amount2 = "", $ketdbprice = ""){
        $query = DB::table('m_vendor');
        $query->select(DB::raw('distinct m_vendor.id as id_hotel, m_vendor.code as hotel_code,m_contract_vendor.cut_of_date as cod_hotel, m_vendor.name as name_hotel, m_city.name as name_city, m_vendor.star_rate as star_hotel, m_country.name as name_country, m_vendor.address, m_vendor.phone as telephone_hotel, m_vendor.email as email_hotel, m_vendor.lat as latitude_hotel, m_vendor.long as longitude_hotel, m_vendor.code as hotel_code, m_vendor.cp_name, m_vendor.cp_phone, m_vendor.cp_mail, m_vendor.cp_title, m_vendor.cp_department, m_vendor.area as area_hotel, m_area.name as name_area, m_area.city as id_city, m_city.country as id_country, m_contract_vendor.valid_from as valid_from, m_contract_vendor.valid_to as valid_to, m_timezones.TimeZone as timezone'));
        $query->join('m_room','m_room.vendor','=','m_vendor.id');
        $query->join('m_priment','m_room.id','=','m_priment.room');
        $query->join('m_contract_vendor','m_contract_vendor.vendor','=','m_vendor.id');
        $query->join('m_area','m_area.id','=','m_vendor.area');
        $query->join('m_city','m_city.id','=','m_area.city');
        $query->join('m_timezones','m_city.timezones','=','m_timezones.id');
        $query->join('m_country','m_country.id','=','m_city.country');
        if($hotel_name!=""){
            $query->where('m_vendor.name', 'ilike', '%'.$hotel_name.'%');
        }
        if($star != ""){
            $query->whereIn('m_vendor.star_rate',$star);
        }
        if($amount!="" && $amount2!=""){
            if($ketdbprice=="best"){
                $query->whereBetween('m_priment.best_value', [$amount, $amount2]);
            }
            else{
                $query->whereBetween('m_priment.vlm_value', [$amount, $amount2]);
            }
        }
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
        ->where('m_photo.vendor', $id);
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
        $query = DB::table('m_vendor');
        $query->select(DB::raw('m_vendor.id as id_hotel, m_vendor.code as hotel_code, m_vendor.name as name_hotel, m_city.name as name_city, m_vendor.star_rate as star_hotel, m_country.name as name_country, m_vendor.address, m_vendor.phone as telephone_hotel, m_vendor.email as email_hotel, m_vendor.lat as latitude_hotel, m_vendor.long as longitude_hotel, m_vendor.code as hotel_code, m_vendor.cp_name, m_vendor.cp_phone, m_vendor.cp_mail, m_vendor.cp_title, m_vendor.cp_department, m_vendor.area as area_hotel, m_area.name as name_area, m_area.city as id_city, m_city.country as id_country'));
        $query->join('m_area','m_area.id','=','m_vendor.area');
        $query->join('m_city','m_city.id','=','m_area.city');
        $query->join('m_country','m_country.id','=','m_city.country');
        $query->where('m_vendor.id','=', $id);
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
        $query = DB::table('m_room');
        $query->select('m_room.*','m_priment.*','m_room.id as id_room');
        $query->join('m_priment','m_room.id','=','m_priment.room');
        $query->where('m_room.vendor','=',$id );
        $query->where('m_priment.valid_from','<=',$checkin );
        $query->where('m_priment.valid_to','>=',$checkin );
        $query->orderBy('m_priment.best_value','desc' );
        
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
        $query->where('m_room.vendor','=',$id );
        $query->where('m_priment.valid_from','<=',$checkin );
        $query->where('m_priment.valid_to','>=',$checkin );
        $query->orderBy('m_priment.best_value','desc' );
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
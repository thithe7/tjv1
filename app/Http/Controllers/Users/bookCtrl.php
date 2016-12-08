<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\Traits\ParentCtrl;

use App;
use Auth;
use DB;
use Mail;

class bookCtrl extends Controller {    
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    use ParentCtrl;

    /**
    * Programmer   : Ima
    * Tanggal      : 08-12-2016
    * Fungsi       : menampilkan halaman form booking
    * Tipe         : create
    */

    public function index(Request $request){
        $id = $request->input('id_hotel');

        if($id==""){
            return Redirect('/');
        }

        $id_room = $request->input('id_room');
        $night=$request->get('night');
        $jml_kamar=$request->get('jml_kamar');
        $checkin=date('Y-m-d',strtotime($request->get('checkin')));
        $checkout = date('Y-m-d',strtotime($request->get('checkout')));
        $breakfast=$request->input('breakfast');
        $amenities=$request->input('amenities');

        $data['room'] = $this->getInfoRoom($id_room);
        $data['price'] = $this->getDataRoom($id, $id_room, $checkin);
        $data['photo'] = $this->getPhoto($id);
        $data['hotel'] = $this->getHotelDetail($id);
        $data['config'] = $this->getConfig();

        // echo "<pre>";
        // print_r($data['config']);
        // echo "</pre>";
        // die;

        $data['redeem'] = $data['config']->redeem.' TJ Point = IDR. '.$data['config']->redeem_value;
        $data['redeemback'] = 'If You check you will use '.$data['hotel']->point_back.' TJ Point. If Not Check it will be add to your TJ Point ('.$data['config']->redeem.' TJ Point = IDR. '.$data['config']->redeem_value.')';
        $data['get'] = 'This TJ Point get from total price. (IDR. '.$data['config']->point_value.' = '.$data['config']->point.' TJ Point)';
        $data['getback'] = $data['hotel']->point_back.' TJ Point back get from this hotel ('.$data['config']->redeem.' TJ Point = IDR. '.$data['config']->redeem_value.')';
        $data['link'] = "http://traveljinni.com/tj/public/detail-hotel?id_hotel=".$id."&destination=".$request->input('destination')."&checkin=".$request->input('checkin')."&checkout=".$request->input('checkout')."&breakfast=".$request->input('breakfast')."&amenities=".$request->input('amenities');
        
        // echo($data['redeem'])."<br>";
        // echo($data['redeemback'])."<br>";
        // echo($data['get'])."<br>";
        // echo($data['getback'])."<br>";
        // echo($data['link']);
        
        $best_value=$data['price']->best_value;
        $hargabreakfast=0;
        $hargaamenities=0;

        if($breakfast!=""){
            $hargabreakfast=$data['price']->breakfast;
        }
        
        if($amenities!=""){
            $hargaamenities=$data['price']->amenities;
        }

        // echo $best_value;
        // echo $hargabreakfast.$hargaamenities;
        //$bestprice=$best_value-$data['price']->breakfast-$data['price']->amenities;
        $bestprice=$best_value+$data['price']->breakfast+$data['price']->amenities;
        $ambiljam=date('H:i:s');
        $tanggallastminutesawal = date('H:i:s', strtotime($data['config']->vlm_from));
        $tanggallastminutesakhir = date('H:i:s', strtotime($data['config']->vlm_to));
        
        //checkbetween
        $now=strtotime($ambiljam);
        $from=strtotime($data['config']->vlm_from);
        $to=strtotime($data['config']->vlm_to);
        if($from>=$to){
            if($now<=$from && $now<=$to){
                $hargaambil=$data['price']->vlm_value; 
                //echo "vlm";   
            }
            else{
                $hargaambil=$best_value;    
                //echo "best";
            }
        }
        else{
            if($now>=$from && $now<=$to){
                $hargaambil=$data['price']->vlm_value;    
                //echo "vlm";
            }
            else{
                $hargaambil=$best_value;  
                //echo "best";  
            }   
        }

        if($breakfast!="" && $amenities!=""){
            //$total=$best_value;
            $total=$bestprice;
            //echo "aaa";
        }
        else{
            $total=$hargaambil+$hargabreakfast+$hargaamenities;
        }

        if($night!=0){
            $data['subtotal']=number_format($total*$night);
            $data['total']=number_format($total*$jml_kamar*$night);
            $data['subtotalnormal']=$total*$night;
            $data['totalnormal']=$total*$jml_kamar*$night;
            $totalakhir=$total*$jml_kamar*$night;
        }
        else{
            $night=1;
            $data['subtotal']=number_format($total);
            $data['total']=number_format($total*$jml_kamar);
            $data['subtotalnormal']=$total;
            $data['totalnormal']=$total*$jml_kamar;   
            $totalakhir=$total*$jml_kamar;
        }
        // echo $total;
        // echo $totalakhir;

        if(Auth::guest()){
        }
        else{
            //echo "akakakak";
            $iduser=Auth::user()->id;
            $data['jmlpoint'] = $this->getTotalPoint($iduser);         
            $data['user'] = $this->getUser();
            // $coba=$this->getUser();
            // echo "<pre>";
            // print_r($coba);         
            // echo "</pre>";
        }
        
        $data['pointtotal']=intval($totalakhir/$data['config']->point_value);

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

        // echo "<pre>";
        // print_r($data);         
        // echo "</pre>";

        return view('users/book/view', compact('data', 'id', 'id_room', 'destination','checkin','checkout','night','breakfast','amenities','jml_kamar','id_room', 'msg'));
    }

    /**
    * Programmer   : Ima
    * Tanggal      : 08-12-2016
    * Fungsi       : menampilkan info room
    * Tipe         : create
    */

    function getInfoRoom($id = ""){
        $query = DB::table('m_room');
        $query->where('id','=',$id );

        $data = $query->first();

        return $data;
    }

    /**
    * Programmer   : Ima
    * Tanggal      : 08-12-2016
    * Fungsi       : menampilkan data room (price, allotment, validity)
    * Tipe         : create
    */

    public function getDataRoom($id = "",$idroom = "", $checkin = ""){
        $query = DB::table('m_room');
        $query->join('m_priment','m_room.id','=','m_priment.room');
        $query->where('m_room.vendor','=',$id );
        $query->where('m_room.id','=',$idroom );
        $query->where('m_priment.valid_from','<=',$checkin );
        $query->where('m_priment.valid_to','>=',$checkin );
        $query->where('m_priment.allotement','>',0 );
        $query->orderBy('m_priment.best_value','desc' );

        $data = $query->first();

        return $data;
    }

    /**
    * Programmer   : Ima
    * Tanggal      : 08-12-2016
    * Fungsi       : menampilkan foto hotel
    * Tipe         : create
    */

    public function getPhoto($id = ""){
        $photo = DB::table('m_photo')
            ->where('m_photo.vendor', $id);

        $data=$photo->get();

        return $data;
    }

    /**
    * Programmer   : Ima
    * Tanggal      : 08-12-2016
    * Fungsi       : menampilkan info hotel
    * Tipe         : create
    */

    public function getHotelDetail($id = "") {
        $query = DB::table('m_vendor');
        $query->select(DB::raw('m_vendor.id as id_hotel, m_vendor.code as hotel_code, m_vendor.name as name_hotel, m_city.name as name_city, m_vendor.star_rate as star_hotel, m_country.name as name_country, m_vendor.address, m_vendor.phone as telephone_hotel, m_vendor.email as email_hotel, m_vendor.lat as latitude_hotel, m_vendor.long as longitude_hotel, m_vendor.code as hotel_code, m_vendor.cp_name, m_vendor.cp_phone, m_vendor.cp_mail, m_vendor.cp_title, m_vendor.cp_department, m_vendor.area as area_hotel, m_area.name as name_area, m_area.city as id_city, m_city.country as id_country, m_vendor.point_back as point_back'));
        $query->join('m_area','m_area.id','=','m_vendor.area');
        $query->join('m_city','m_city.id','=','m_area.city');
        $query->join('m_country','m_country.id','=','m_city.country');
        $query->where('m_vendor.id','=', $id);

        $data = $query->first();
        
        return $data;
    }

    /**
    * Programmer   : Ima
    * Tanggal      : 08-12-2016
    * Fungsi       : menampilkan info config
    * Tipe         : create
    */

    public function getConfig(){
        $query = DB::table('m_config');

        $data = $query->first();

        return $data;
    }

    /**
    * Programmer   : Ima
    * Tanggal      : 08-12-2016
    * Fungsi       : cek ketersediaan allotment
    * Tipe         : create
    */
   
    function checkAllotment($idroom = "", $checkin = ""){
        $query = DB::table('m_priment');
        $query->where('room','=',$idroom);
        $query->where('m_priment.valid_from','<=',$checkin );
        $query->where('m_priment.valid_to','>=',$checkin );

        $data = $query->first();

        return $data; 
    }

    /**
    * Programmer   : Ima
    * Tanggal      : 08-12-2016
    * Fungsi       : cek ketersediaan daily allotment
    * Tipe         : create
    */
   
    public function checkDailyAllotment($id = "", $tanggal = ""){
        $daily = DB::table('m_daily_allotment')
            ->where('priment', $id)
            ->where('date_daily', $tanggal);

        $data=$daily->first();

        return $data;
    }
    
    /**
    * Programmer   : Ima
    * Tanggal      : 08-12-2016
    * Fungsi       : menampilkan info point
    * Tipe         : create
    */
   
    function getTotalPoint($iduser = ""){
        $jmlpoint=0;

        $query = DB::table('m_point');
        $query->where('userid', '=', $iduser);

        $ambilpoint = $query->get();

        foreach ($ambilpoint as $key) {
            $jmlpoint=$jmlpoint+$key->total_point;
        }
        return $jmlpoint; 
    }

    /**
    * Programmer   : Ima
    * Tanggal      : 08-12-2016
    * Fungsi       : submit booking
    * Tipe         : create
    */

    public function post_book(Request $request)
    {
        $det_inv=array();

        // echo "<pre>";
        // print_r($request->input());
        // echo "</pre>";
        //die;

        $id_hotel = $request->input('id_hotel');
        $id_room = $request->input('id_room');
        $checkin = $request->input('checkin');
        $checkout = $request->input('checkout');
        $breakfast = $request->input('breakfast');
        $amenities = $request->input('amenities');
        $jml_kamar = $request->input('jml_kamar');
        $subtotal = $request->input('subtotal');
        $total = $request->input('total');
        $name = $request->input('loginName');
        $email = $request->input('loginEmail');
        $phoneNumber = $request->input('loginMobile');
        $point = $request->input('point');
        $point_back = $request->input('point_back');
        $point_backstatus = $request->input('point_backstatus');
        $voucher=str_replace(" ","",strtoupper($request->input('voucher')));

        //echo $voucher;
        $breakfast_price=0;
        $pointtotal=0;
        $amenities_price=0;
        $value_voucher=0;
        $id_voucher=0;
        if(Auth::guest()){
            $iduser=0;
        }
        else{
            $iduser=Auth::user()->id;
        }        

        if($breakfast!=="" || $amenities!==""){
            $getDataRoom=$this->getDataRoom($id_hotel, $id_room, $checkin);

            if(count($getDataRoom)>0){
                if($breakfast!==""){
                    $breakfast_price=$getDataRoom->breakfast;
                }
                if($amenities!==""){
                    $amenities_price=$getDataRoom->amenities;
                }
            }
        }

        //insert m_booking
        DB::beginTransaction();
        try {
            $checkallotment=$this->checkAllotment($id_room, $checkin);
            if(count($checkallotment)>0){
                $checkdailyallotment=$this->checkDailyAllotment($checkallotment->id, $checkin);
                if(count($checkdailyallotment)>0){
                    $dailyallotment=$checkdailyallotment->allotment;
                    $total_allotment=$checkallotment->allotement;

                    $newdailyallotment=$checkdailyallotment->allotment-$jml_kamar;
                    $newtotal_allotment=$checkallotment->allotement-$jml_kamar;
                    
                    //update table daily_allotment
                    $dataupdate = array(
                        "allotment"     => floatval($newdailyallotment),
                        "updated_at"    => date("Y-M-d H:i:s")
                    );    
                    DB::table('m_daily_allotment')->where('priment', $checkallotment->id)->where('date_daily', $checkin)->update($dataupdate);
                    
                    //update table m_priment
                    $dataupdate = array(
                        "allotement"    => floatval($newtotal_allotment),
                        "updated_at"    => date("Y-M-d H:i:s")
                    );    
                    DB::table('m_priment')->where('room', $id_room)->update($dataupdate);
                }
            }

            $kurangpoint=0;
            $kurangpointback=0;
            $kurangvoucher=0;
            $id_inv = 0;

            //generate invoice code
            $cek_booking = DB::table('m_booking')->orderBy('id', 'desc')
                  ->first();

            if(count($cek_booking)>0){
                $id_inv = $cek_booking->id;  
            } 

            $code_inv="TJB".date('Ym').substr(10001+$id_inv,1);

            $insert = array(
                "room"              => $id_room,
                "userid"            => $iduser,
                "name_pemesan"      => $name,
                "email_pemesan"     => $email,
                "telp_pemesan"      => $phoneNumber,
                "checkin"           => $checkin,
                "checkout"          => $checkout,
                "qty"               => $jml_kamar,
                "original_price"    => floatval($total),
                "sell_price"        => floatval($total),
                "status"            => 2,
                "breakfast"         => $breakfast,
                "amenities"         => $amenities,
                "breakfast_price"   => $breakfast_price,
                "amenities_price"   => $amenities_price,
                "invoice_code"      => $code_inv,
              //  "use_point_back"    => "",
                "point_back"        => 0,
                "created_at"        => date('Y-m-d H:i:s'),
                "updated_at"        => date('Y-m-d H:i:s')
            );
            if($point_backstatus!=""){
                $insert = array(
                    "room"              => $id_room,
                    "userid"            => $iduser,
                    "name_pemesan"      => $name,
                    "email_pemesan"     => $email,
                    "telp_pemesan"      => $phoneNumber,
                    "checkin"           => $checkin,
                    "checkout"          => $checkout,
                    "qty"               => $jml_kamar,
                    "original_price"    => floatval($total),
                    "sell_price"        => floatval($total),
                    "status"            => 2,
                    "breakfast"         => $breakfast,
                    "amenities"         => $amenities,
                    "breakfast_price"   => $breakfast_price,
                    "amenities_price"   => $amenities_price,
                    "invoice_code"      => $code_inv,
                   // "use_point_back"    => $point_backstatus,
                    "point_back"        => $point_back,
                    "created_at"        => date('Y-m-d H:i:s'),
                    "updated_at"        => date('Y-m-d H:i:s')
                );  
            }
            DB::table('m_booking')->insert($insert);

            //insert d_booking
            $query = DB::table('m_booking');
            $query->where('invoice_code','=', $code_inv);
            $data = $query->first();

            $kurangpoint=0;
            $kurangvoucher=0;
            $kurangpointback=0;
            
            for($i=1;$i<=$jml_kamar;$i++){
                $insert = array(
                    "id_booking"        => $data->id,
                    "p_name"            => $name,
                    "p_title"           => '',
                    "price"             => floatval($total/$jml_kamar),
                    "created_at"        => date('Y-m-d H:i:s'),
                    "updated_at"        => date('Y-m-d H:i:s')
                );
                DB::table('d_booking')->insert($insert);
            }

            if(!Auth::guest()){
                $checkpoint=$this->getConfig();
                $totalvoucher = $this->getTotalPoint($iduser);
                
                //dapat point back dari hotel
                if($point_back<=0 && $point_backstatus!=""){
                    $kurangpointback=$point_back*$checkpoint->redeem_value;
                }

                if($point>0 && $point<=$totalvoucher){ //menggunakan point sendiri
                    if($point_backstatus==""){ //no point back
                        $kurangpoint=$point*$checkpoint->redeem_value;
                        $insert = array(
                            "userid"            => $iduser,
                            "id_trans"          => $data->id,
                            "total_point"       => ($point)*-1,
                            "status"            => 'use',
                            "created_at"        => date('Y-m-d H:i:s'),
                            "updated_at"        => date('Y-m-d H:i:s')
                        );
                        DB::table('m_point')->insert($insert);
                    } else { // use point back
                        $kurangpoint=($point+$point_back)*$checkpoint->redeem_value;
                        $insert = array(
                            "userid"            => $iduser,
                            "id_trans"          => $data->id,
                            "total_point"       => ($point)*-1,
                            "status"            => 'use',
                            "created_at"        => date('Y-m-d H:i:s'),
                            "updated_at"        => date('Y-m-d H:i:s')
                        );
                        DB::table('m_point')->insert($insert);
                    }
                }
                else{//tidak menggunakan point sendiri dan use point back
                    if($point_backstatus!=""){
                        $kurangpoint=($point_back)*$checkpoint->redeem_value;
                        $insert = array(
                            "userid"            => $iduser,
                            "id_trans"          => $data->id,
                            "total_point"       => ($point_back)*-1,
                            "status"            => 'use',
                            "created_at"        => date('Y-m-d H:i:s'),
                            "updated_at"        => date('Y-m-d H:i:s')
                        );
                        DB::table('m_point')->insert($insert);
                    }
                }

                //dapat point jika login
                $pointtotal=intval(($total-$kurangpoint)/$checkpoint->point_value);
                
                if($pointtotal>0){ // cek sisa total apakah dapat point atau tidak
                    if($point_backstatus!=""){ // jika use point back
                        $point_back=0;
                    }
                    $insert = array(
                        "userid"            => $iduser,
                        "id_trans"          => $data->id,
                        "total_point"       => intval($pointtotal+$point_back),
                        "status"            => 'confirmed',
                        "created_at"        => date('Y-m-d H:i:s'),
                        "updated_at"        => date('Y-m-d H:i:s')
                    );
                    DB::table('m_point')->insert($insert);
                }
                else{
                    if($point_backstatus!=""){
                        $point_back=0;
                    }
                    $insert = array(
                        "userid"            => $iduser,
                        "id_trans"          => $data->id,
                        "total_point"       => intval($point_back),
                        "status"            => 'confirmed',
                        "created_at"        => date('Y-m-d H:i:s'),
                        "updated_at"        => date('Y-m-d H:i:s')
                    );
                    DB::table('m_point')->insert($insert);
                }

                //check voucher
                $iduser=Auth::user()->id;
                $checkvoucher=$this->checkVoucher($voucher);

                if(count($checkvoucher)>0 && $voucher!=""){
                    $id_voucher=$checkvoucher->id; 
                    if($checkvoucher->total_point<=$totalvoucher){
                        $kurangvoucher=$checkvoucher->total_point*$checkpoint->redeem_value;
                        $kurangpoint=$point*$checkpoint->redeem_value;

                        //ngurangi point dari voucher
                        $insert = array(
                            "userid"            => $iduser,
                            "id_trans"          => $data->id,
                            "total_point"       => $checkvoucher->total_point*-1,
                            "status"            => 'voucher',
                            "created_at"        => date('Y-m-d H:i:s'),
                            "updated_at"        => date('Y-m-d H:i:s')
                        );
                        DB::table('m_point')->insert($insert);

                        //insert ke m_voucher
                        $insert = array(
                            "userid"            => $iduser,
                            "id_point"          => $checkvoucher->id_point,
                            "code"              => $voucher,
                            "status"            => 'active',
                            "expired"           => date('Y-m-d'),
                            "created_at"        => date('Y-m-d H:i:s'),
                            "updated_at"        => date('Y-m-d H:i:s')
                        );
                        DB::table('m_voucher')->insert($insert); 
                        
                        $value_voucher=$checkvoucher->total_point;    
                    }
                }
            }

            $sell_price=$total-$kurangpoint-$kurangvoucher;
            if($sell_price!=$total || $kurangpoint!=0 || $kurangvoucher!=0){
                $dataupdate = array(
                    "voucher"       => $id_voucher,
                    "sell_price"    => floatval($sell_price),
                    "updated_at"    => date("Y-M-d H:i:s")
                );    
                DB::table('m_booking')->where('invoice_code', $code_inv)->update($dataupdate);
                $dataupdate1 = array(
                    "price"         => floatval($total/$jml_kamar),
                    "updated_at"    => date("Y-M-d H:i:s")
                );    
                DB::table('d_booking')->where('id', $data->id)->update($dataupdate1);
            }

            DB::commit();     

        } catch (Exception $e) {
            DB::rollback();
            $return["msgServer"] = "Sorry, Delete Data was failed.";
            $return["success"] = false;
        }
        return Redirect('/transdone/'.$data->id);
    }

    /**
    * Programmer   : Ima
    * Tanggal      : 08-12-2016
    * Fungsi       : menampilkan master transaksi
    * Tipe         : create
    */
   
    public function getTransaction($id = ""){
        $query = DB::table('m_booking');
        $query->select(DB::raw('m_booking.*, m_vendor.name as hotel_name, m_room.name as room_category_name, m_vendor.address, m_vendor.phone as telephone_hotel, m_vendor.email as email_hotel, m_vendor.website as website_hotel, m_vendor.id as id_hotel, m_booking.point_back, m_photo.photo'));
        $query->join('m_room','m_booking.room','=','m_room.id');
        $query->leftjoin('m_photo','m_photo.vendor','=','m_room.vendor');
        $query->join('m_vendor','m_vendor.id','=','m_room.vendor');
        $query->where('m_booking.id','=',$id );
        $data = $query->first();
        return $data;
    }

    /**
    * Programmer   : Ima
    * Tanggal      : 08-12-2016
    * Fungsi       : menampilkan detail transaksi
    * Tipe         : create
    */
   
    public function getTransactionDetail($id_invoice = "", $id_room = ""){
        $d_booking = DB::table('d_booking');
        $d_booking->select(DB::raw('m_booking.*, m_vendor.name as hotel_name, m_room.name as room_category_name, d_booking.price'));
        $d_booking->join('m_booking','m_booking.id','=','d_booking.id_booking');
        $d_booking->join('m_room','m_booking.room','=','m_room.id');
        $d_booking->join('m_vendor','m_vendor.id','=','m_room.vendor');
        $d_booking->where('id_booking','=',$id_invoice );
        $d_booking->where('room','=',$id_room );

        $data = $d_booking->get();

        return $data;
    }

    /**
    * Programmer   : Ima
    * Tanggal      : 08-12-2016
    * Fungsi       : menampilkan info poin transaksi
    * Tipe         : create
    */
   
    public function getM_VoucherTransdone($id_invoice = ""){
        $m_voucher = DB::table('m_point');
        $m_voucher->join('m_booking','m_booking.id','=','m_point.id_trans');
        $m_voucher->where('id_trans','=',$id_invoice );
        $m_voucher->where('m_point.status','=','voucher');
        
        $data = $m_voucher->first();

        return $data;
    }

    /**
    * Programmer   : Ima
    * Tanggal      : 08-12-2016
    * Fungsi       : menampilkan master poin
    * Tipe         : create
    */

    public function useM_PointTransdone($id_invoice = ""){
        $m_point = DB::table('m_point');
        $m_point->where('id_trans','=',$id_invoice );
        $m_point->where('m_point.status','=','use');

        $data = $m_point->first();

        return $data;
    }  

    /**
    * Programmer   : Ima
    * Tanggal      : 08-12-2016
    * Fungsi       : menampilkan dan mengimkan invoice transaksi
    * Tipe         : create
    */ 

    public function getM_PointTransdone($id_invoice = ""){
        $m_point = DB::table('m_point');
        $m_point->where('id_trans','=',$id_invoice );
        $m_point->where('total_point','>',0 );

        $data = $m_point->first();

        return $data;
    }   

    /**
    * Programmer   : Ima
    * Tanggal      : 08-12-2016
    * Fungsi       : menampilkan dan mengimkan invoice transaksi
    * Tipe         : create
    */
   
    public function transdone($id = ""){
        $invoice = $this->getTransaction($id);

        // echo "<pre>";
        // print_r($invoice);
        // echo "</pre>";
        // die;

        $id_invoice=$invoice->id;
        //$id_voucher=$invoice->voucher;
        $id_room=$invoice->room;
        $id_hotel=$invoice->id_hotel;
        $checkin=$invoice->checkin;
        $checkout=$invoice->checkout;
        $breakfast=$invoice->breakfast;
        $amenities=$invoice->amenities;
        
        $hotellink = "http://traveljinni.com/tj/public/detail-hotel?id_hotel=".$id_hotel."&destination=bali&checkin=".$checkin."&checkout=".$checkout."&breakfast=".$breakfast."&amenities=".$amenities;

        $detail = $this->getTransactionDetail($id_invoice, $id_room);
        //$voucher = $this->getM_VoucherTransdone($id_invoice);
        $point = $this->useM_PointTransdone($id_invoice); //use
        $pointget = $this->getM_PointTransdone($id_invoice); //use

        // echo "<pre>";
        // print_r($point);
        // echo "</pre>";
        // die;

        $data=array();

        $config=$this->getConfig();
      
        $data[] = [
            "payment_date"          => date('D, M d Y', strtotime($invoice->created_at)),
            "booking_invoice"       => $invoice->invoice_code,
            "fullname"              => $invoice->name_pemesan,
            "email"                 => $invoice->email_pemesan,
            "cellphone"             => $invoice->telp_pemesan,
            "total_sell_price"      => $invoice->sell_price,
            "checkin"               => $invoice->checkin,
            "checkout"              => $invoice->checkout,
            "hotel_name"            => $invoice->hotel_name,
            "room_category_name"    => $invoice->room_category_name,
            "id"                    => $invoice->id,
            "status"                => $invoice->status,
            // "voucher"               => $invoice->voucher,
            "sell_price"            => $invoice->sell_price,
            "qty"                   => $invoice->qty
        ];
        $return['results'] = $data;

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

        $hotel_name=$invoice->hotel_name;
        $name_pemesan=$invoice->name_pemesan;
        $email=$invoice->email_pemesan;

        // $pdf = App::make('dompdf.wrapper');
        // $pdf->loadView('users/invoice',compact('data','id','invoice','jinni','detail','voucher','point','pointget','hotellink', 'msg'));
        // $pdf->setPaper('A4')->setOrientation('potrait');
        // $pdf->save(storage_path()."/Invoice_".$booking_invoice.".pdf");

        $emaildata = array(
            'logo'      => 'http://traveljinni.com/tj/public/assets/images/traveljinni-logo-icon.png',
            'login'     => 'http://traveljinni/tj/public/login',
            'heading'   => 'TRAVEL JINNI Booking '.' '.$hotel_name,
            'data'      => $data,
            'id'        => $id,
            'invoice'   => $invoice,
            'config'    => $config,
            'detail'    => $detail,
            'hotellink' => $hotellink,
            // 'voucher'   => $voucher,
            'point'     => $point,
            'pointget'  => $pointget,
            'content'   => 'Hai '.$name_pemesan.',<br/><br/>
                            Terima kasih atas kepercayaan Anda dalam menggunakan Booking Hotel Online Travel Jinni <br/>
                            Mohon untuk tidak membalas email ini.<br/>
                            Jika Anda memerlukan informasi lebih lanjut, silahkan hubungi Customer Service Travel Jinni di nomor telepon '.$config->office_phone.', atau kirimkan e-mail ke: '.$config->office_email.'<br/><br/>
                            Hormat kami,<br/>
                            Travel Jinni<br/><br/>
 
                            Hi '.$name_pemesan.',<br/><br/>
                            We would like to thank you for using Travel Jinni Online Hotel Booking.<br/>
                            Please do not reply to this email.<br/>
                            Should you need more information or assistance, please call Travel Jinni Customer Service at '.$config->office_phone.', or email to: '.$config->office_email.'<br/><br/>
                            Yours Sincerely,<br/>
                            Travel Jinni'
        );

        // Mail::send('users.invoice.view', $emaildata, function ($message) use ($email,$hotel_name) {
        //     $message->from('info@traveljinni.com', 'Admin Travel Jinni');
        //     $message->to('imasohibah@gmail.com')->subject('TRAVEL JINNI Booking '.' '.$hotel_name);
        // });
            
        return view('users/book/transdone', compact('data','id','invoice','config','detail','voucher','point','pointget','hotellink', 'msg'));
    }
}
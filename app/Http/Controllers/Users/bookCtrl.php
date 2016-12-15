<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App;
use Auth;
use DB;
use Mail;
use File;

class bookCtrl extends Controller {    
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    /**
    * Programmer   : Ima
    * Tanggal      : 08-12-2016
    * Fungsi       : menampilkan halaman form booking
    * Tipe         : update
    */

    public function index(Request $request){
        $id = $request->input('id_hotel');

        if($id=="") return Redirect('/');

        $id_room    = $request->input('id_room');
        $night      = $request->get('night');
        $jml_kamar  = $request->get('jml_kamar');
        $checkin    = date('Y-m-d',strtotime($request->get('checkin')));
        $checkout   = date('Y-m-d',strtotime($request->get('checkout')));
        $breakfast  = $request->input('breakfast');
        $amenities  = $request->input('amenities');

        $data['room']   = $this->getInfoRoom($id_room);
        $data['price']  = $this->getDataRoom($id, $id_room, $checkin);
        $data['photo']  = $this->getPhoto($id);
        $data['hotel']  = $this->getHotelDetail($id);
        $data['config'] = $this->getConfig();
        $data['input']  = array(
                            "id"        => $id,
                            "id_room"   => $id_room,
                            "night"     => $night,
                            "jml_kamar" => $jml_kamar,
                            "checkin"   => $checkin,
                            "checkout"  => $checkout,
                            "breakfast" => $breakfast,
                            "amenities" => $amenities
                        );

        $data['point']      = (Auth::guard('web_users')->user())?$this->getTotalPoint(Auth::guard('web_users')->user()->id):0;

        $data['redeem']     = $data['config']->redeem.' TJ Point = IDR. '.$data['config']->redeem_value; 

        $data['redeemback'] = 'If You check you will use '.$data['hotel']->point_back.' TJ Point. If Not Check it will be add to your TJ Point ('.$data['config']->redeem.' TJ Point = IDR. '.$data['config']->redeem_value.')';  

        $data['get']        = 'This TJ Point get from total price. (IDR. '.$data['config']->point_value.' = '.$data['config']->point.' TJ Point)';

        $data['getback']    = $data['hotel']->point_back.' TJ Point back get from this hotel ('.$data['config']->redeem.' TJ Point = IDR. '.$data['config']->redeem_value.')';
                
        $best_value         = $data['price']->best_value;
        $hargabreakfast     = ($breakfast=="")?0:$hargabreakfast=$data['price']->breakfast;
        $hargaamenities     = ($amenities=="")?0:$hargaamenities=$data['price']->amenities;

        $bestprice                  = $best_value+$data['price']->breakfast+$data['price']->amenities;
        $tanggallastminutesawal     = date('H:i:s', strtotime($data['config']->vlm_from));
        $tanggallastminutesakhir    = date('H:i:s', strtotime($data['config']->vlm_to));
        $HotelTimezone              = $this->getHotelTimezone($id);
        
        //checkbetween
        $date       = new \DateTime("now", new \DateTimeZone($HotelTimezone->timezone));
        $curtime    = $date->format("H:i:s");
        $now        = strtotime($curtime);
        $from       = strtotime($data['config']->vlm_from);
        $to         = strtotime($data['config']->vlm_to);

        if($from >= $to) $hargaambil    = ($now <= $from && $now <= $to) ? $data['price']->vlm_value : $best_value;
        else $hargaambil                = ($now >= $from && $now <= $to) ? $data['price']->vlm_value : $best_value;

        $total      = ($breakfast!="" && $amenities!="") ? $bestprice : $hargaambil+$hargabreakfast+$hargaamenities;

        if($night!=0){
            $data['subtotal']       = number_format($total*$night);
            $data['total']          = number_format($total*$jml_kamar*$night);
            $data['subtotalnormal'] = $total*$night;
            $data['totalnormal']    = $total*$jml_kamar*$night;
            $totalakhir             = $total*$jml_kamar*$night;
        }
        else{
            $night                  = 1;
            $data['subtotal']       = number_format($total);
            $data['total']          = number_format($total*$jml_kamar);
            $data['subtotalnormal'] = $total;
            $data['totalnormal']    = $total*$jml_kamar;   
            $totalakhir             = $total*$jml_kamar;
        }

        if(!Auth::guest()){
            $iduser             = Auth::user()->id;
            $data['jmlpoint']   = $this->getTotalPoint($iduser);         
            $data['user']       = $this->getUser();
        }
        
        $data['pointtotal']     = intval($totalakhir/$data['config']->point_value);

        return view('users/book/view', compact('data'));
    }

    /**
    * Programmer   : Ima
    * Tanggal      : 08-12-2016
    * Fungsi       : menampilkan info timezone dari hotel
    * Tipe         : create
    */

    public function getHotelTimezone($id_hotel = ""){
        $query = DB::table('m_vendor');
        $query->select('m_timezones.timezone');
        $query->join('m_area','m_area.id','=','m_vendor.area');
        $query->join('m_city','m_city.id','=','m_area.city');
        $query->join('m_timezones','m_city.timezones','=','m_timezones.id');
        $query->where('m_vendor.id', '=', $id_hotel);

        $data = $query->first();

        return $data;
    }

    /**
    * Programmer   : Ima
    * Tanggal      : 08-12-2016
    * Fungsi       : menampilkan info user
    * Tipe         : update
    */
   
    public function getUser(){
        $query = DB::table('m_user');
        $query->where('id','=',Auth::user()->id );

        $data = $query->first();

        return $data;
    }

    /**
    * Programmer   : Ima
    * Tanggal      : 08-12-2016
    * Fungsi       : menampilkan info room
    * Tipe         : update
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
    * Tipe         : update
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
    * Tipe         : update
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
    * Tipe         : update
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
    * Tipe         : update
    */

    public function getConfig(){
        $query = DB::table('m_config');

        $data = $query->first();

        return $data;
    }

    /**
    * Programmer   : Ima
    * Tanggal      : 08-12-2016
    * Fungsi       : cek ketersediaan monthly allotment
    * Tipe         : update
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
    * Tipe         : update
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
    * Fungsi       : menampilkan info point per user
    * Tipe         : update
    */
   
    function getTotalPoint($iduser = ""){
        $jmlpoint=0;

        $query = DB::table('m_point');
        $query->where('userid', '=', $iduser);

        $jmlpoint = $query->sum('total_point');

        return $jmlpoint; 
    }

    /**
    * Programmer   : Ima
    * Tanggal      : 08-12-2016
    * Fungsi       : submit booking
    * Tipe         : update
    */

    public function post_book(Request $request)
    {
        $det_inv        = array();

        $id_hotel       = $request->input('id_hotel');
        $id_room        = $request->input('id_room');
        $checkin        = $request->input('checkin');
        $checkout       = $request->input('checkout');
        $breakfast      = $request->input('breakfast');
        $amenities      = $request->input('amenities');
        $jml_kamar      = $request->input('jml_kamar');
        $subtotal       = $request->input('subtotal');
        $total          = $request->input('total');
        $name           = $request->input('loginName');
        $email          = $request->input('loginEmail');
        $phoneNumber    = $request->input('loginMobile');
        $point          = $request->input('point');
        $point_back     = $request->input('point_back');
        $tjpb           = $request->input('TJPB');

        $point_backstatus   = ($tjpb > 0) ? 1 : 0;

        $breakfast_price    = 0;
        $amenities_price    = 0;

        $pointtotal         = 0;
        $kurangpoint        = 0;
        $kurangpointback    = 0;

        $iduser     = (Auth::guest()) ? 0 : Auth::user()->id;

        if($breakfast != "" || $amenities != ""){
            $getDataRoom    = $this->getDataRoom($id_hotel, $id_room, $checkin);

            if(count($getDataRoom)>0){
                if($breakfast != "") $breakfast_price = $getDataRoom->breakfast;
                if($amenities != "") $amenities_price = $getDataRoom->amenities;
            }
        }

        //insert m_booking
        DB::beginTransaction();
        try {
            $checkallotment = $this->checkAllotment($id_room, $checkin);
            if(count($checkallotment) >= $jml_kamar){
                $checkdailyallotment    = $this->checkDailyAllotment($checkallotment->id, $checkin);
                if(count($checkdailyallotment) >= $jml_kamar){
                    $dailyallotment     = $checkdailyallotment->allotment;
                    $total_allotment    = $checkallotment->allotement;

                    $newdailyallotment  = $dailyallotment-$jml_kamar;
                    $newtotal_allotment = $total_allotment-$jml_kamar;
                    
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

            //generate invoice code
            $cek_booking = DB::table('m_booking')->orderBy('id', 'desc')
                  ->first();

            $id_inv     = (count($cek_booking)>0) ? $cek_booking->id : 0; 
            $code_inv   = "TJB".date('Ym').substr(10001+$id_inv,1);

            if($point_backstatus=="") $point_back = 0;

            $insert = array(
                "room"              => $id_room,
                "userid"            => $iduser,
                "name_pemesan"      => $name,
                "email_pemesan"     => $email,
                "telp_pemesan"      => $phoneNumber,
                "checkin"           => $checkin,
                "checkout"          => $checkout,
                "qty"               => $jml_kamar,
                "original_price"    => floatval($total), //harga asli
                "sell_price"        => floatval($total), //harga setelah dikurangi point-point
                "status"            => 2,
                "breakfast"         => $breakfast,
                "amenities"         => $amenities,
                "breakfast_price"   => $breakfast_price,
                "amenities_price"   => $amenities_price,
                "invoice_code"      => $code_inv,
                "point_back"        => $point_back,
                "created_at"        => date('Y-m-d H:i:s'),
                "updated_at"        => date('Y-m-d H:i:s')
            );
            DB::table('m_booking')->insert($insert);

            //insert d_booking
            $query = DB::table('m_booking');
            $query->where('invoice_code','=', $code_inv);
            $data = $query->first();
            
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
                $checkpoint = $this->getConfig(); //ambil nilai kelipatan untuk mengalikan poin jadi rupiah
                $totalpoint = $this->getTotalPoint($iduser); //ambil total point user
                
                //dapat point back dari hotel
                if($point_back>0 && $point_backstatus!=""){
                    $kurangpointback = $point_back*$checkpoint->redeem_value; //poin dalam rupiah
                }

                if($point>0 && $point<=$totalpoint){ //menggunakan point sendiri
                    if($point_backstatus!="") { //jika tidak use point back
                        $kurangpoint = $point*$checkpoint->redeem_value;
                    } else { //jika use point back
                        $kurangpoint = ($point+$point_back)*$checkpoint->redeem_value;
                        $point_back  = 0;
                        $point       = 0;
                    }

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
                else{//tidak menggunakan point sendiri dan use point back
                    if($point_backstatus!="") {
                        $kurangpoint = ($point_back)*$checkpoint->redeem_value;
                        $point_back  = 0;
                    }
                }

                //dapat point jika login
                $pointtotal=intval(($total-$kurangpoint)/$checkpoint->point_value);
                
                if($pointtotal>0) $insert_total_point = intval($pointtotal+$point_back);
                else $insert_total_point = intval($point_back);

                $insert = array(
                    "userid"            => $iduser,
                    "id_trans"          => $data->id,
                    "total_point"       => $insert_total_point,
                    "status"            => 'confirmed',
                    "created_at"        => date('Y-m-d H:i:s'),
                    "updated_at"        => date('Y-m-d H:i:s')
                );
                DB::table('m_point')->insert($insert);
            }

            $sell_price     = $total-$kurangpoint;
            if($sell_price!=$total || $kurangpoint>0){
                $dataupdate = array(
                    "sell_price"    => floatval($sell_price),
                    "updated_at"    => date("Y-M-d H:i:s")
                );    
                DB::table('m_booking')->where('invoice_code', $code_inv)->update($dataupdate);
            }

            DB::commit();     

        } catch (Exception $e) {
            DB::rollback();
            $return["msgServer"] = "Sorry, your transaction was failed.";
            $return["success"] = false;
        }
        return redirect('/transdone/'.$data->id);
    }

    /**
    * Programmer   : Ima
    * Tanggal      : 08-12-2016
    * Fungsi       : menampilkan master transaksi
    * Tipe         : update
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
    * Tipe         : update
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
    * Fungsi       : menampilkan jumlah poin yang digunakan untuk transaksi tersebut
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
    * Fungsi       : menampilkan jumlah poin yang didapat dari transaksi tersebut
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
        $invoice    = $this->getTransaction($id);

        $id_invoice = $invoice->id;
        $id_room    = $invoice->room;
        $id_hotel   = $invoice->id_hotel;
        $checkin    = $invoice->checkin;
        $checkout   = $invoice->checkout;
        $breakfast  = $invoice->breakfast;
        $amenities  = $invoice->amenities;
        $night = ((abs(strtotime (date("Y-m-d", strtotime($checkout))) - strtotime (date("Y-m-d", strtotime($checkin)))))/(60*60*24));
        
        $hotellink  = "http://traveljinni.com/tj/public/detail-hotel?id_hotel=".$id_hotel."&destination=bali&checkin=".$checkin."&checkout=".$checkout."&breakfast=".$breakfast."&amenities=".$amenities;

        $detail     = $this->getTransactionDetail($id_invoice, $id_room);
        $cekpoint   = $this->useM_PointTransdone($id_invoice);
        $point      = ($cekpoint=="") ? 0 : $cekpoint->total_point; //point yang digunakan untuk trx
        $pointget   = $this->getM_PointTransdone($id_invoice); //poin yang didapatkan dari trx

        $getpoint   = (!empty($pointget)) ? $pointget->total_point : 0;

        $data       = array();
        $config     = $this->getConfig();
      
        $data = array(
            "payment_date"          => date('D, M d Y', strtotime($invoice->created_at)),
            "booking_invoice"       => $invoice->invoice_code,
            "fullname"              => $invoice->name_pemesan,
            "email"                 => $invoice->email_pemesan,
            "cellphone"             => $invoice->telp_pemesan,
            "total_sell_price"      => $invoice->sell_price,
            "original_price"        => $invoice->original_price,
            "checkin"               => $invoice->checkin,
            "checkout"              => $invoice->checkout,
            "night"                 => $night,
            "hotel_name"            => $invoice->hotel_name,
            "room_category_name"    => $invoice->room_category_name,
            "breakfast"             => ($invoice->breakfast_price>0) ? "IDR ".number_format($invoice->breakfast_price) : "-",
            "amenities"             => ($invoice->amenities_price>0) ? "IDR ".number_format($invoice->amenities_price) : "-",
            "id"                    => $invoice->id,
            "status"                => $invoice->status,
            "sell_price"            => $invoice->sell_price,
            "qty"                   => $invoice->qty,
            "hotel_name"            => $invoice->hotel_name,
            "address"               => $invoice->address,
            "telephone_hotel"       => $invoice->telephone_hotel,
            "email_hotel"           => $invoice->email_hotel,
            "website_hotel"         => $invoice->website_hotel,
            "tjpoint"               => $point,
            "tjpoint_back"          => $invoice->point_back,
            "tjpoint_rp"            => $point*$config->redeem_value,
            "tjpointback_rp"        => $invoice->point_back*$config->redeem_value,
            "point_get"             => $getpoint
        );

        $return['results'] = $data;

        $hotel_name     = $invoice->hotel_name;
        $email          = $invoice->email_pemesan;
        $code_inv       = $invoice->invoice_code;

        $emaildata = array(
            'logo'      => 'http://traveljinni.com/tj/public/assets/images/traveljinni-logo-icon.png',
            'data'      => $data,
            'hotellink' => $hotellink,
            'content'   => 'Hi '.$invoice->name_pemesan.',<br/><br/>
                            We would like to thank you for using Travel Jinni Online Hotel Booking.<br/>Please check the attached booking information.<br/>',
            'footer'    =>'Please do not reply to this email.<br/>
                            If you need more information or assistance, please call Travel Jinni Customer Service at '.$config->office_phone.', or email to: '.$config->office_email.'<br/><br/>
                            Yours Sincerely,<br/>
                            Travel Jinni'
        );

        $pdf = App::make('snappy.pdf.wrapper');
        $pdf->loadView('users.book.invoice_pdf', compact('data', 'hotellink'));
        //$pdf->setPaper('a4')->setOrientation('landscape');
        $pdf->save(storage_path()."/Invoice_".$code_inv.".pdf");

        Mail::send('users.book.invoice_mail', $emaildata, function ($message) use ($email,$code_inv) {
            $message->from('info@traveljinni.com', 'Admin Travel Jinni');
            $message->to($email)->subject('TRAVEL JINNI Booking '.$code_inv);
            $message->attach(storage_path().'/Invoice_'.$code_inv.'.pdf');
        });
        
        File::delete(storage_path()."/Invoice_".$code_inv.".pdf");
            
        return view('users/book/transdone', compact('data','hotellink'));
    }
}
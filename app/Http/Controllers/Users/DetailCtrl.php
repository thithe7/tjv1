<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\Traits\ParentCtrl;

use App;
use Auth;
use DB;

class detailCtrl extends Controller {    
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    use ParentCtrl;

    /**
    * Programmer   : Ima
    * Tanggal      : 07-12-2016
    * Fungsi       : menampilkan halaman detail hotel
    * Tipe         : create
    */

    public function index(Request $request){
        // echo "<pre>";
        // print_r($request->input());
        // echo "</pre>";
        //die;

        $id = $request->input('id_hotel');
        $destination=$request->get('destination');
        $cekin=date('Y-m-d',strtotime($request->get('checkin')));
        $cekout = date('Y-m-d',strtotime($request->get('checkout')));

        $base_url = App::make('url')->to('/');

        $data['photo'] = $this->getPhotoDetail($id);
        $data['hotel'] = $this->getHotelDetail($id);

        $data['link'] = $base_url."/search-hotel?destination=".$request->input('destination')."&checkin=".$request->input('checkin')."&checkout=".$request->input('checkout')."&breakfast=".$request->input('breakfast')."&amenities=".$request->input('amenities');

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
        
        return view('users/detail/view', compact('data', 'id', 'destination','cekin','cekout', 'msg'));
    }

    /**
    * Programmer   : Ima
    * Tanggal      : 07-12-2016
    * Fungsi       : untuk mengambil foto hotel
    * Tipe         : create
    */
   
    public function getPhotoDetail($id = ""){
        $photo = DB::table('m_photo')
            ->where('m_photo.vendor', $id);

        $data=$photo->get();

        return $data;
    }

    /**
    * Programmer   : Ima
    * Tanggal      : 07-12-2016
    * Fungsi       : untuk mengambil info hotel
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

    function do_Tabel(Request $request){
        $records["aaData"] = array();
        $aColumns = array('','name', 'valid_from', 'stop_sell', '','');
        
        $sort = "name";
        $dir = "asc";
        $criteria = "name";

        //inputan
        $id=$request->get('id_hotel');
        $hargabreakfast=0;
        $hargaamenities=0;
        $checkin= $request->input('checkin');
        $checkout= $request->input('checkout');
        $night = ((abs(strtotime ($checkout) - strtotime ($checkin)))/(60*60*24));
        $breakfast=$request->input('breakfast');
        $amenities=$request->input('amenities');

        $ketbreakfast='<i class="ficon ficon-positive" data-selenium="benefit-included-icon"></i> Breakfast Not included';
        $ketamenities='<i class="ficon ficon-positive" data-selenium="benefit-included-icon"></i> Amenities Not included';
        //inputan

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
        $iTotalRecords = $this->getCountRoom($criteria, $sSearch, $id, $checkin);

        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;

        $records["sEcho"] = $sEcho;
        $records["iTotalRecords"] = $iTotalRecords;
        $records["iTotalDisplayRecords"] = $iTotalRecords;

        $query = $this->getRoom($criteria, $sSearch, $sort, $dir, $iDisplayStart, $iDisplayLength, $id, $checkin);

        if (count($query) > 0) {
            $no = $iDisplayStart;
            $k=1;
            foreach ($query as $Fields) {
                if($k==1 || $k==2){
                    $collapse="class='room-group js-room-group js-is-collapsed'";
                    $button="";
                }
                elseif($k==3){
                    $collapse="class='room-group js-room-group js-is-collapsed display-table'";
                    $button="<input style='background-color:#095668;' id='togglee' onClick='action();' data-toggle='collapse' data-target='.showmore' type='submit' class='book-button' value='Show More Room'>";
                }
                else{
                    $collapse="class='room-group js-room-group js-is-collapsed display-table collapse showmore'";
                    $button="";
                }

                $best_value=$Fields->best_value;
                if($breakfast!=""){
                    $hargabreakfast=$Fields->breakfast;
                    $ketbreakfast='<i class="ficon ficon-positive" data-selenium="benefit-included-icon"></i> Breakfast included';
                }
                
                if($amenities!=""){
                    $hargaamenities=$Fields->amenities;
                    $ketamenities='<i class="ficon ficon-positive" data-selenium="benefit-included-icon"></i> Amenities included';
                }
                
                $bestprice=$best_value+$Fields->breakfast+$Fields->amenities;
                $ambiljam=date('H:i:s');
                $jinni=$this->getConfig();

                //checkbetween
                $now=strtotime($ambiljam);
                $from=strtotime($jinni->vlm_from);
                $to=strtotime($jinni->vlm_to);
                if($from>=$to){
                    if($now<=$from && $now<=$to){
                        $hargaambil=$Fields->vlm_value; 
                        //echo "vlm";   
                    }
                    else{
                        $hargaambil=$best_value;    
                        //echo "best";
                    }
                }
                else{
                    if($now>=$from && $now<=$to){
                        $hargaambil=$Fields->vlm_value;    
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
                //echo $total;

                if($night!=0){
                    $harga_tampil=number_format($total*$night);
                }
                else{
                    $harga_tampil=number_format($total);   
                }
                // echo $total;
                // echo $harga_tampil;
                $uang='IDR';
                $total_allotment=$Fields->allotement;
                $default_allotment=$jinni->max_allotment_default;
                $checkdaily=$this->checkDailyAllotment($Fields->id, $checkin);
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
                    //$qty=0;   
                }

                $select='';
                
                if($qty==0){
                    $book='<font color="red">Sold Out</font>';
                }
                else{
                    $book='<input type="submit" name="book-button-new-bf" class="btn-book-detail btn-tj" value="Book"/>';
                    $select.='<select class="form-control" name="jml_kamar">';
                    for($i=1;$i<=$qty;$i++){
                        $select.='<option value="'.$i.'">'.$i.'</option>';
                    }
                    $select.='</select>';
                }
                $no++;
                $records["aaData"][] = array(
                    $Fields->name,
                    '<ul class="info">
                        <li data-selenium="benefit-included" name="benefit">
                            <strong class="offer-text deals">
                                '.$ketbreakfast.'
                            </strong>
                        </li>
                        <li data-selenium="benefit-included" name="benefit">
                            <strong class="offer-text deals">
                                '.$ketamenities.'
                            </strong>
                        </li>
                    </ul>',
                    '<span class="room-item-price-container" data-selenium="room-price">
                        <!--<div class="rack-rate room-pricing-rack-rate" data-selenium="crossedOutRate">
                            <font color="red">
                                <strike>
                                    '.$uang.'. '.$harga_tampil.'
                                </strike>
                            </font>
                        </div>-->
                        <div class="room-cost room-pricing-currency">
                            <span name="currency"> </span> <span class="currency prices" style="color:#095668;">
                                '.$uang.'. '.$harga_tampil.'
                            </span>
                        </div>
                        <div class="room-priceinfo price-per-night room-pricing-price-per-night">
                            <span>per night</span>    
                        </div>
                    </span>',
                    '<form class="book-form" method="post" action="'.url('book-hotel').'">
                        <input type="hidden" name="_token" value="'.csrf_token().'" id="token">
                        <input type="hidden" name="id_hotel" value="'.$id.'">
                        <input type="hidden" name="id_room" value="'.$Fields->id_room.'">
                        <input type="hidden" name="night" value="'.$night.'">
                        <input type="hidden" name="checkin" value="'.$checkin.'">
                        <input type="hidden" name="checkout" value="'.$checkout.'">
                        <input type="hidden" name="breakfast" value="'.$breakfast.'">
                        <input type="hidden" name="amenities" value="'.$amenities.'">
                        
                        <div class="room-book-button-form">
                                <div class="display-table-cell">
                                    '.$select.'&nbsp;&nbsp;&nbsp;'.$book.'
                                </div> 
                        </div>
                        
                    </form>'
                );
                $k=$k+1;
            }
        
        }
        echo json_encode($records);
    } 
}
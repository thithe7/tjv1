<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\Traits\ParentCtrl;

use Auth;
use DB;
use PDF;
use App;
use Mail;
use Session;
use Redirect;
use Input;
use URL;
use mPDF;

class DetailCtrl extends Controller {  
    use ParentCtrl;    
    public function index(Request $request){
        $id = $request->input('id_hotel');
        $destination=$request->get('destination');
        $cekin=date('Y-m-d',strtotime($request->get('checkin')));
        $cekout = date('Y-m-d',strtotime($request->get('checkout')));
        //$data['price'] = $this->getPrice($id);
        $data['photo'] = $this->getPhotoDetail($id);
        $data['hotel'] = $this->getHotelDetail($id);

        $data['link'] = "http://traveljinni.com/tj/public/search-hotel?destination=".$request->input('destination')."&checkin=".$request->input('checkin')."&checkout=".$request->input('checkout')."&breakfast=".$request->input('breakfast')."&amenities=".$request->input('amenities');

        // echo '<pre>';
        //print_r($data['photo']);die();

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
        // $ketbreakfast='';
        // $ketamenities='';

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
                
                //echo $hargabreakfast.$hargaamenities;
                //walik an e best price
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
                    $book='<input style="background-color:#095668;" type="submit" name="book-button-new-bf" class="btn-book-detail btn-tj" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Book&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"/>';
                    $select.='<select name="jml_kamar">';
                    for($i=1;$i<=$qty;$i++){
                        $select.='<option value="'.$i.'">'.$i.'</option>';
                    }
                    $select.='</select>';
                }

// '<i class="ficon ficon-12 ficon-max-occupancy"></i>
//                     <i class="ficon ficon-12 ficon-max-occupancy"></i>',

// '                        <li data-selenium="cxl-condition">
//                             <strong class="offer-text deals clickable" name="condition" data-title="Cancellation policy" data-cxl="ca15788d-cbf4-4f3d-8a30-e3d1b77703df"  data-roomguid="ca15788d-cbf4-4f3d-8a30-e3d1b77703df" data-cxl-msg="Please note, if cancelled, modified or in case of no-show, the total price of the reservation will be charged. &lt;br/&gt;&lt;br/&gt; The total price of the reservation may be charged anytime after booking."  data-fc="0" data-cxl-text="Please note, if cancelled, modified or in case of no-show, the total price of the reservation will be charged. &amp;lt;br/&amp;gt;&amp;lt;br/&amp;gt; The total price of the reservation may be charged anytime after booking.">    
//                                 <i class="ficon ficon-positive"></i> <span class="underline">Cancellation policy</span>
//                                 <i class="ficon ficon-noti-info-line-circle ficon-12"></i>
//                             </strong>
//                         </li>
// <i class="only-mobileroomgrid ficon ficon-noti-info-line-circle ficon-12"></i> '                    
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
                        
                        <div class="room-book-button-form pull-right">
                                <div class="display-table-cell">
                                    '.$select.'
                                </div>
                                <div class="display-table-cell">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$book.'
                                </div> 
                        </div>
                        
                    </form>'
                );
                // $records["aaData"][] = array(
                //     '<div '.$collapse.'>
                //         <div class="room-group-column room-group-column-right">
                //                 <ul class="room-group-room-list">
                //                     <li class="mobile-room room-item">

                //                     <div class="display-table room-header">
                //                         <div class="display-table-cell room-names">
                //                             '.$Fields->name.'
                //                         </div>
                //                         <div class="display-table-cell one-third room-occupancy">
                //                             <div class="occupancy-popup-target">
                //                                 <div>
                //                                     <i class="ficon ficon-12 ficon-max-occupancy"></i>
                //                                     <i class="ficon ficon-12 ficon-max-occupancy"></i>
                //                                 </div>
                //                             </div>
                //                         </div>
                //                     </div>
                //                     <div class="display-table room-pricing-and-badges">
                //                         <div class="display-table-cell room-features-column">
                //                             <ul class="info">
                //                                 <li data-selenium="benefit-included" name="benefit">
                //                                     <strong class="offer-text deals">
                //                                         '.$ketbreakfast.'
                //                                     </strong>
                //                                 </li>
                //                                 <li data-selenium="benefit-included" name="benefit">
                //                                     <strong class="offer-text deals">
                //                                         '.$ketamenities.'
                //                                     </strong>
                //                                 </li>
                //                                 <li data-selenium="cxl-condition">
                //                                     <strong class="offer-text deals clickable" name="condition" data-title="Cancellation policy" data-cxl="ca15788d-cbf4-4f3d-8a30-e3d1b77703df"  data-roomguid="ca15788d-cbf4-4f3d-8a30-e3d1b77703df" data-cxl-msg="Please note, if cancelled, modified or in case of no-show, the total price of the reservation will be charged. &lt;br/&gt;&lt;br/&gt; The total price of the reservation may be charged anytime after booking."  data-fc="0" data-cxl-text="Please note, if cancelled, modified or in case of no-show, the total price of the reservation will be charged. &amp;lt;br/&amp;gt;&amp;lt;br/&amp;gt; The total price of the reservation may be charged anytime after booking.">    
                //                                         <i class="ficon ficon-positive"></i> <span class="underline">Cancellation policy</span>
                //                                         <i class="ficon ficon-noti-info-line-circle ficon-12"></i>
                //                                     </strong>
                //                                 </li>
                //                             </ul>
                //                         </div>
                //                     </div>
                //                     <div class="display-table room-pricing-and-badges">
                //                         <div class="display-table-cell sixty-percents-half room-badges-column">
                //                         <!-- AG Coupon and Moneyback-->
                //                         </div>
                //                         <div class="display-table-cell fourty-percents-half room-pricing-column">
                //                             <span class="room-item-price-container" data-selenium="room-price">
                //                                 <!--<div class="rack-rate room-pricing-rack-rate" data-selenium="crossedOutRate">
                //                                     <font color="red">
                //                                         <strike>
                //                                             '.$uang.'. '.$harga_tampil.'
                //                                         </strike>
                //                                     </font>
                //                                 </div>-->
                //                                 <div class="room-cost room-pricing-currency">
                //                                     <span name="currency"> </span> <span class="currency prices" style="color:#095668;">
                //                                         '.$uang.'. '.$harga_tampil.'
                //                                     </span>
                //                                 </div>
                //                                 <div class="room-priceinfo price-per-night room-pricing-price-per-night">
                //                                     <span>per night</span>
                //                                     <i class="only-mobileroomgrid ficon ficon-noti-info-line-circle ficon-12"></i>     
                //                                 </div>
                //                             </span>
                //                         </div>
                //                     </div>
                                    
                //                         <form class="book-form" method="post" action="'.url('book-hotel').'">
                //                             <input type="hidden" name="_token" value="'.csrf_token().'" id="token">
                //                             <input type="hidden" name="id_hotel" value="'.$id.'">
                //                             <input type="hidden" name="id_room" value="'.$Fields->id_room.'">
                //                             <input type="hidden" name="night" value="'.$night.'">
                //                             <input type="hidden" name="checkin" value="'.$checkin.'">
                //                             <input type="hidden" name="checkout" value="'.$checkout.'">
                //                             <input type="hidden" name="breakfast" value="'.$breakfast.'">
                //                             <input type="hidden" name="amenities" value="'.$amenities.'">
                                            
                //                         <div class="room-book-button-form">
                //                             <div class="display-table room-pricing-and-badges">
                //                                 <div class="display-table-cell">
                //                                     <div align=right>
                //                                         <span class="number-of-room" style="float: left;">Rooms </span>
                //                                         <div class="room-number-selector" style="float: left;" data-max="9">
                //                                             &nbsp;&nbsp;&nbsp;'.$select.'
                //                                         </div>
                //                                         '.$book.'
                //                                     </div>
                //                                 </div>   
                //                             </div>
                //                         </div>



                                         


                //                         </form>
                //                         <div class="RED-194">
                //                             <div class="redirect-mobile-price" data-id="5128416|ca15788d-cbf4-4f3d-8a30-e3d1b77703df|True|False|2|1545000.0000000000000000000000" data-unique-id="54D365FF3BAAFC820BBD24945C65057D" data-selenium="redirect-mobile-price-banner"></div>
                //                         </div>
                //                     </div>
                //                 </li>
                //             </ul>
                //         </div>
                //     </div>'.$button.'
                // </div>'
                // );
        $k=$k+1;
        }
        
      }
      echo json_encode($records);
    } 

}

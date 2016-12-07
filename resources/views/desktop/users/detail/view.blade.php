@extends("layout.userLayout")

@section('content')

<div class="breadcrumb"><a href="{{{ $data['link'] }}}"><i class="fa fa-arrow-left"></i> Back</a></div>

<div class="ownslider">
    <ul class="bxslider">
    	@if(!empty($data['photo']))
	    	@foreach($data['photo'] as $photo)
	      		<li><img src="{{ URL::asset('assets/hotel_img') }}/{{ $photo->photo }}" class="imgslider"/></li>
	      	@endforeach
	    @else
	    	<li><img src="{{ URL::asset('assets/hotel_img') }}/NoImageFound.png" class="imgslider"/></li>
	    @endif
    </ul>
</div>


<div id="tab-panel-hotel" data-tab="hotel" class="tab-panel about-hotel ">
    <!-- <ul class="nav-justified">
        <li class="map-tab"><a href="#"><span>Hotel</span></a></li>
        <li class="map-tab"><a href="#"><span>Map</span></a></li>
        <li class="map-tab"><a href="#"><span>Reviews</span></a></li>
    </ul> -->

    <div class="hotel-header" data-selenium="hotel-header">
        <label style="font-size: 20px">{{{ $data['hotel']->name_hotel }}}</label>
        <div class="star-with-ppp">
            <i data-selenium="hotel-header-star" class="ficon ficon-16 ficon-star-{{{ $data['hotel']->star_hotel }}} ficon-star-style"></i>
        </div>

        <!-- <div class="score-divider"></div>

        <div class="review-score" data-selenium="total-review-score" data-review-tab="reviews_tab" data-review-tab-redirect="reviews_tab">
            <h2>Excellent
                <strong class="visible-score" style="color:#095668;">8.6</strong>
                <span class="from-ten">/10.0</span>
            </h2>
        </div><br/>
        <div class="review-rating-detail" data-review-tab="reviews_tab" data-review-tab-redirect="reviews_tab">
            Based on <strong>108 reviews</strong>
        </div> -->
	</div>  
	<div><p>&nbsp;</p></div>
    
    <div class="section listroom-section">
        <br>
        <table id="hotelroom" class="table room-section" style="width:1300px;">
            <thead>
                <tr>
                    <td style="width: 250px;">Room</td>
                    <!-- <td>Included</td> -->
                    <td style="width: 400px;">Meals</td>
                    <td style="width: 350px;">Price</td>
                    <td style="width: 300px;">Total Room</td>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>






        <div class="row room-grid js-room-list">
            <div class="col-xs-20">
                <div id="abouthotel-panel" class="section facilities-section">
                    <div class="about-hotel-section" style="width:1245px;">
                        <div class="about-hotel-header">


<p>&nbsp;</p>

<meta charset="utf-8">

<div data-hypernova-key="listingbundlejs">
  <div>
    <div id="details" class="details-section webkit-render-fix">
      <div class="page-container-responsive">
        <div class="row">

        <div class="col-lg-16 js-details-column">
            <div class="space-top-1">
                <h4 class="space-4">
                    <span class="title_n9n61p">
                        <span>About this hotel</span>
                    </span>
                </h4>
                <div>
                    <p>
                        <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3">
                            <span>Large room with TV, AC, microwave, stove, fridge, king size bed, sofa. Facility: gym, swimming pool, beauty saloon, restaurants, pharmacy, laundry. You’ll love my place because of the neighborhood, the comfy bed, the light, and the outdoors space. My place is good for couples, solo adventurers, and business travelers.</span>
                        </span>
                    </p>
                </div>
                <hr>
                <div style="margin-top:24px;margin-bottom:-8px;">
                    <div class="row">
                        <div class="col-md-3 hide-sm">
                            <p class="text_1lobov3-o_O-size_regular_1n7tijc">
                                <span>The space</span>
                            </p>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-6">
                                    <div style="margin-bottom:16px;">
                                        <div>
                                            <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3">
                                                <span>Accommodates:</span>
                                            </span>
                                            <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-inline_10f0ge3">
                                                <span>2</span>
                                            </span>
                                        </div>
                                    </div>
                                    <div style="margin-bottom:16px;">
                                        <div>
                                            <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3">
                                                <span>Bathrooms:</span>
                                            </span>
                                            <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-inline_10f0ge3">
                                                <span>1</span>
                                            </span>
                                        </div>
                                    </div>
                                    <div style="margin-bottom:16px;">
                                        <div>
                                            <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3">
                                                <span>Bedrooms:</span>
                                            </span>                                 
                                            <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-inline_10f0ge3">
                                                <span>1</span>
                                            </span>
                                        </div>
                                    </div>
                                    <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.7.0.2.0.$0.$Beds=2">
                                        <div data-reactid=".26rwb10t1c0.0.0.0.0.3.7.0.2.0.$0.$Beds=2.0">
                                            <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.7.0.2.0.$0.$Beds=2.0.0">
                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.7.0.2.0.$0.$Beds=2.0.0.1">Beds:</span>
                                            </span>
                                            <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.7.0.2.0.$0.$Beds=2.0.2">
                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.7.0.2.0.$0.$Beds=2.0.2.1">1</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" data-reactid=".26rwb10t1c0.0.0.0.0.3.7.0.2.0.$1">
                                    <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.7.0.2.0.$1.$Check In=2">
                                        <div data-reactid=".26rwb10t1c0.0.0.0.0.3.7.0.2.0.$1.$Check In=2.0">
                                            <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.7.0.2.0.$1.$Check In=2.0.0">
                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.7.0.2.0.$1.$Check In=2.0.0.1">Check In:</span>
                                            </span>
                                            <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.7.0.2.0.$1.$Check In=2.0.2">
                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.7.0.2.0.$1.$Check In=2.0.2.1">Flexible</span>
                                            </span>
                                        </div>
                                    </div>
                                    <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.7.0.2.0.$1.$Check Out=2">
                                        <div data-reactid=".26rwb10t1c0.0.0.0.0.3.7.0.2.0.$1.$Check Out=2.0">
                                            <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.7.0.2.0.$1.$Check Out=2.0.0">
                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.7.0.2.0.$1.$Check Out=2.0.0.1">Check Out:</span>
                                            </span>
                                            <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.7.0.2.0.$1.$Check Out=2.0.2">
                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.7.0.2.0.$1.$Check Out=2.0.2.1">12.00 PM</span>
                                            </span>
                                        </div>
                                    </div>
                                    <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.7.0.2.0.$1.$Property type=2">
                                        <div data-reactid=".26rwb10t1c0.0.0.0.0.3.7.0.2.0.$1.$Property type=2.0">
                                                <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.7.0.2.0.$1.$Property type=2.0.0.0">
                                                    <span data-reactid=".26rwb10t1c0.0.0.0.0.3.7.0.2.0.$1.$Property type=2.0.0.0.1">Property type:</span>
                                                </span>
                                                <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.7.0.2.0.$1.$Property type=2.0.0.2">
                                                    <span data-reactid=".26rwb10t1c0.0.0.0.0.3.7.0.2.0.$1.$Property type=2.0.0.2.1">House</span>
                                                </span>
                                        </div>
                                    </div>
                                    <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.7.0.2.0.$1.$Room type=2">
                                        <div data-reactid=".26rwb10t1c0.0.0.0.0.3.7.0.2.0.$1.$Room type=2.0">
                                            <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.7.0.2.0.$1.$Room type=2.0.0">
                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.7.0.2.0.$1.$Room type=2.0.0.1">Room type:</span>
                                            </span>
                                            <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.7.0.2.0.$1.$Room type=2.0.2">
                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.7.0.2.0.$1.$Room type=2.0.2.1">Private room</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="row" data-reactid=".26rwb10t1c0.0.0.0.0.3.7.0.2.1">
                                <div class="col-md-6" data-reactid=".26rwb10t1c0.0.0.0.0.3.7.0.2.1.0">
                                    <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.7.0.2.1.0.0">
                                        <p class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff" data-reactid=".26rwb10t1c0.0.0.0.0.3.7.0.2.1.0.0.0">
                                            <a href="#house-rules" class="react-house-rules-trigger" data-reactid=".26rwb10t1c0.0.0.0.0.3.7.0.2.1.0.0.0.1">
                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.7.0.2.1.0.0.0.1.0">House Rules</span>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
                <hr class="col-md-9 col-md-offset-3" data-reactid=".26rwb10t1c0.0.0.0.0.3.8">
                <div class="row amenities" data-reactid=".26rwb10t1c0.0.0.0.0.3.9">
                    <div class="col-md-3 hide-md hide-lg" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.0">
                        <div style="margin-top:8px;margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.0.0">
                            <p class="text_1lobov3-o_O-size_regular_1n7tijc" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.0.0.0">
                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.0.0.0.1">Amenities</span></p>
                            </div>
                        </div>
                        <div class="col-md-3 hide-sm" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.1">
                            <div style="margin-top:8px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.1.0">
                                <p class="text_1lobov3-o_O-size_regular_1n7tijc" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.1.0.0">
                                    <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.1.0.0.1">Amenities</span>
                                </p>
                            </div>
                        </div>
                        <div style="margin-top:24px;margin-bottom:8px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2">
                            <div class="col-md-9 expandable" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0">
                                <div class="expandable-content-summary" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.0">
                                    <div class="row" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.0.0">
                                        <div class="col-sm-12 col-md-6" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.0.0.0:$0">
                                            <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.0.0.0:$0.$8-short">
                                                <div data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.0.0.0:$0.$8-short.0">
                                                    <div class="space-1" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.0.0.0:$0.$8-short.0.0">
                                                        <span aria-hidden="true" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.0.0.0:$0.$8-short.0.0.0">
                                                            <i class="icon h3 icon-meal" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.0.0.0:$0.$8-short.0.0.0.0"></i>
                                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.0.0.0:$0.$8-short.0.0.0.1">&nbsp;&nbsp;&nbsp;</span>
                                                        </span>
                                                        <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.0.0.0:$0.$8-short.0.0.1">
                                                            <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.0.0.0:$0.$8-short.0.0.1.0">
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.0.0.0:$0.$8-short.0.0.1.0.1">Kitchen</span>
                                                            </span>
                                                            <noscript data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.0.0.0:$0.$8-short.0.0.1.1"></noscript>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.0.0.0:$0.$3-short">
                                                <div data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.0.0.0:$0.$3-short.0">
                                                    <div class="space-1" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.0.0.0:$0.$3-short.0.0">
                                                        <span aria-hidden="true" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.0.0.0:$0.$3-short.0.0.0">
                                                            <i class="icon h3 icon-internet" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.0.0.0:$0.$3-short.0.0.0.0"></i>
                                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.0.0.0:$0.$3-short.0.0.0.1">&nbsp;&nbsp;&nbsp;</span>
                                                        </span>
                                                        <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.0.0.0:$0.$3-short.0.0.1">
                                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.0.0.0:$0.$3-short.0.0.1.1">Internet</span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.0.0.0:$1">
                                            <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.0.0.0:$1.$1-short">
                                                <div data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.0.0.0:$1.$1-short.0">
                                                    <div class="space-1" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.0.0.0:$1.$1-short.0.0">
                                                        <span aria-hidden="true" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.0.0.0:$1.$1-short.0.0.0">
                                                            <i class="icon h3 icon-tv" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.0.0.0:$1.$1-short.0.0.0.0"></i>
                                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.0.0.0:$1.$1-short.0.0.0.1">&nbsp;&nbsp;&nbsp;</span>
                                                        </span>
                                                        <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.0.0.0:$1.$1-short.0.0.1">
                                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.0.0.0:$1.$1-short.0.0.1.1">TV</span></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.0.0.0:$1.$40-short">
                                                    <div data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.0.0.0:$1.$40-short.0">
                                                        <div class="space-1" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.0.0.0:$1.$40-short.0.0">
                                                            <span aria-hidden="true" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.0.0.0:$1.$40-short.0.0.0">
                                                                <i class="icon h3 icon-essentials" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.0.0.0:$1.$40-short.0.0.0.0"></i>
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.0.0.0:$1.$40-short.0.0.0.1">&nbsp;&nbsp;&nbsp;</span>
                                                            </span>
                                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.0.0.0:$1.$40-short.0.0.1">
                                                                <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.0.0.0:$1.$40-short.0.0.1.0">
                                                                    <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.0.0.0:$1.$40-short.0.0.1.0.1">Essentials</span>
                                                                </span>
                                                                <noscript data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.0.0.0:$1.$40-short.0.0.1.1"></noscript>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="collapse" id="moreamenities">
                                        <div class="row" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0">
                                            <div class="col-sm-12 col-md-6" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0">
                                                <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$5-long">
                                                    <div data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$5-long.0">
                                                        <div class="space-1" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$5-long.0.0">
                                                            <span aria-hidden="true" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$5-long.0.0.0">
                                                                <i class="icon h3 icon-air-conditioning" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$5-long.0.0.0.0"></i>
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$5-long.0.0.0.1">&nbsp;&nbsp;&nbsp;</span>
                                                            </span>
                                                            <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$5-long.0.0.1">
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$5-long.0.0.1.1">Air conditioning</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$16-long">
                                                    <div data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$16-long.0">
                                                        <div class="space-1" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$16-long.0.0">
                                                            <span aria-hidden="true" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$16-long.0.0.0">
                                                                <i class="icon h3 icon-cup" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$16-long.0.0.0.0"></i>
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$16-long.0.0.0.1">&nbsp;&nbsp;&nbsp;</span>
                                                            </span>
                                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$16-long.0.0.1">
                                                                <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$16-long.0.0.1.0">
                                                                    <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$16-long.0.0.1.0.1">Breakfast</span>
                                                                </span>
                                                                <noscript data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$16-long.0.0.1.1"></noscript>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$28-long">
                                                    <div data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$28-long.0">
                                                        <div class="space-1" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$28-long.0.0">
                                                            <span aria-hidden="true" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$28-long.0.0.0">
                                                                <i class="icon h3 icon-intercom" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$28-long.0.0.0.0"></i>
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$28-long.0.0.0.1">&nbsp;&nbsp;&nbsp;</span>
                                                            </span>
                                                            <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$28-long.0.0.1">
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$28-long.0.0.1.1">Buzzer/wireless intercom</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$2-long">
                                                    <div data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$2-long.0">
                                                        <div class="space-1" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$2-long.0.0">
                                                            <span aria-hidden="true" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$2-long.0.0.0">
                                                                <i class="icon h3 icon-desktop" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$2-long.0.0.0.0"></i>
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$2-long.0.0.0.1">&nbsp;&nbsp;&nbsp;</span>
                                                            </span>
                                                            <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$2-long.0.0.1">
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$2-long.0.0.1.1">Cable TV</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$14-long">
                                                    <div data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$14-long.0">
                                                        <div class="space-1 text-muted" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$14-long.0.0">
                                                            <del aria-hidden="true" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$14-long.0.0.1">
                                                                <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$14-long.0.0.1.0">
                                                                    <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$14-long.0.0.1.0.1">Doorman</span>
                                                                </span>
                                                            </del>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$34-long">
                                                    <div data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$34-long.0">
                                                        <div class="space-1" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$34-long.0.0">
                                                            <span aria-hidden="true" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$34-long.0.0.0">
                                                                <i class="icon h3 icon-dryer" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$34-long.0.0.0.0"></i>
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$34-long.0.0.0.1">&nbsp;&nbsp;&nbsp;</span>
                                                            </span>
                                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$34-long.0.0.1">
                                                                <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$34-long.0.0.1.0">
                                                                    <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$34-long.0.0.1.0.1">Dryer</span>
                                                                </span>
                                                                <noscript data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$34-long.0.0.1.1"></noscript>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$21-long">
                                                    <div data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$21-long.0">
                                                        <div class="space-1 text-muted" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$21-long.0.0">
                                                            <del aria-hidden="true" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$21-long.0.0.1">
                                                                <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$21-long.0.0.1.0">
                                                                    <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$21-long.0.0.1.0.1">Elevator in building</span>
                                                                </span>
                                                            </del>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$40-long">
                                                    <div data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$40-long.0">
                                                        <div class="space-1" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$40-long.0.0">
                                                            <span aria-hidden="true" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$40-long.0.0.0">
                                                                <i class="icon h3 icon-essentials" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$40-long.0.0.0.0"></i>
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$40-long.0.0.0.1">&nbsp;&nbsp;&nbsp;</span>
                                                            </span>
                                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$40-long.0.0.1">
                                                                <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$40-long.0.0.1.0">
                                                                    <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$40-long.0.0.1.0.1">Essentials</span>
                                                                </span>
                                                                <noscript data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$40-long.0.0.1.1"></noscript>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$31-long">
                                                    <div data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$31-long.0">
                                                        <div class="space-1 text-muted" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$31-long.0.0">
                                                            <del aria-hidden="true" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$31-long.0.0.1">
                                                                <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$31-long.0.0.1.0">
                                                                    <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$31-long.0.0.1.0.1">Family/kid friendly</span>
                                                                </span>
                                                            </del>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$9-long">
                                                    <div data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$9-long.0">
                                                        <div class="space-1" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$9-long.0.0">
                                                            <span aria-hidden="true" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$9-long.0.0.0">
                                                                <i class="icon h3 icon-parking" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$9-long.0.0.0.0"></i>
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$9-long.0.0.0.1">&nbsp;&nbsp;&nbsp;</span>
                                                            </span>
                                                            <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$9-long.0.0.1">
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$9-long.0.0.1.1">Free parking on premises</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$15-long">
                                                    <div data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$15-long.0">
                                                        <div class="space-1 text-muted" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$15-long.0.0">
                                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$15-long.0.0.1">
                                                                <del aria-hidden="true" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$15-long.0.0.1.0">
                                                                    <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$15-long.0.0.1.0.0">
                                                                        <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$15-long.0.0.1.0.0.1">Gym</span>
                                                                    </span>
                                                                </del>
                                                                <noscript data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$15-long.0.0.1.1"></noscript>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$45-long">
                                                    <div data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$45-long.0">
                                                        <div class="space-1" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$45-long.0.0">
                                                            <span aria-hidden="true" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$45-long.0.0.0">
                                                                <i class="icon h3 icon-hair-dryer" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$45-long.0.0.0.0"></i>
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$45-long.0.0.0.1">&nbsp;&nbsp;&nbsp;</span>
                                                            </span>
                                                            <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$45-long.0.0.1">
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$45-long.0.0.1.1">Hair dryer</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$44-long">
                                                    <div data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$44-long.0">
                                                        <div class="space-1" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$44-long.0.0">
                                                            <span aria-hidden="true" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$44-long.0.0.0">
                                                                <i class="icon h3 icon-hangers" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$44-long.0.0.0.0"></i>
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$44-long.0.0.0.1">&nbsp;&nbsp;&nbsp;</span>
                                                            </span>
                                                            <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$44-long.0.0.1">
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$44-long.0.0.1.1">Hangers</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$30-long">
                                                    <div data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$30-long.0">
                                                        <div class="space-1" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$30-long.0.0">
                                                            <span aria-hidden="true" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$30-long.0.0.0">
                                                                <i class="icon h3 icon-heating" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$30-long.0.0.0.0"></i>
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$30-long.0.0.0.1">&nbsp;&nbsp;&nbsp;</span>
                                                            </span>
                                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$30-long.0.0.1">
                                                                <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$30-long.0.0.1.0">
                                                                    <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$30-long.0.0.1.0.1">Heating</span>
                                                                </span>
                                                                <noscript data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$30-long.0.0.1.1"></noscript>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$25-long">
                                                    <div data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$25-long.0">
                                                        <div class="space-1 text-muted" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$25-long.0.0">
                                                            <del aria-hidden="true" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$25-long.0.0.1">
                                                                <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$25-long.0.0.1.0">
                                                                    <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$0.$25-long.0.0.1.0.1">Hot tub</span>
                                                                </span>
                                                            </del>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1">
                                                <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$27-long">
                                                    <div data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$27-long.0">
                                                        <div class="space-1 text-muted" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$27-long.0.0">
                                                            <del aria-hidden="true" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$27-long.0.0.1">
                                                                <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$27-long.0.0.1.0">
                                                                    <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$27-long.0.0.1.0.1">Indoor fireplace</span>
                                                                </span>
                                                            </del>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$3-long">
                                                    <div data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$3-long.0">
                                                        <div class="space-1" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$3-long.0.0">
                                                            <span aria-hidden="true" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$3-long.0.0.0">
                                                                <i class="icon h3 icon-internet" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$3-long.0.0.0.0"></i>
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$3-long.0.0.0.1">&nbsp;&nbsp;&nbsp;</span>
                                                            </span>
                                                            <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$3-long.0.0.1">
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$3-long.0.0.1.1">Internet</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$46-long">
                                                    <div data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$46-long.0">
                                                        <div class="space-1" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$46-long.0.0">
                                                            <span aria-hidden="true" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$46-long.0.0.0">
                                                                <i class="icon h3 icon-iron" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$46-long.0.0.0.0"></i>
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$46-long.0.0.0.1">&nbsp;&nbsp;&nbsp;</span>
                                                            </span>
                                                            <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$46-long.0.0.1">
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$46-long.0.0.1.1">Iron</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$8-long">
                                                    <div data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$8-long.0">
                                                        <div class="space-1" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$8-long.0.0">
                                                            <span aria-hidden="true" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$8-long.0.0.0">
                                                                <i class="icon h3 icon-meal" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$8-long.0.0.0.0"></i>
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$8-long.0.0.0.1">&nbsp;&nbsp;&nbsp;</span>
                                                            </span>
                                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$8-long.0.0.1">
                                                                <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$8-long.0.0.1.0">
                                                                    <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$8-long.0.0.1.0.1">Kitchen</span>
                                                                </span>
                                                                <noscript data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$8-long.0.0.1.1"></noscript>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$47-long">
                                                    <div data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$47-long.0">
                                                        <div class="space-1 text-muted" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$47-long.0.0">
                                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$47-long.0.0.1">
                                                                <del aria-hidden="true" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$47-long.0.0.1.0">
                                                                    <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$47-long.0.0.1.0.0">
                                                                        <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$47-long.0.0.1.0.0.1">Laptop friendly workspace</span>
                                                                    </span>
                                                                </del>
                                                                <noscript data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$47-long.0.0.1.1"></noscript>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$12-long">
                                                    <div data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$12-long.0">
                                                        <div class="space-1 text-muted" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$12-long.0.0">
                                                            <del aria-hidden="true" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$12-long.0.0.1">
                                                                <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$12-long.0.0.1.0">
                                                                    <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$12-long.0.0.1.0.1">Pets allowed</span>
                                                                </span>
                                                            </del>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$7-long">
                                                    <div data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$7-long.0">
                                                        <div class="space-1 text-muted" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$7-long.0.0">
                                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$7-long.0.0.1">
                                                                <del aria-hidden="true" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$7-long.0.0.1.0">
                                                                    <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$7-long.0.0.1.0.0">
                                                                        <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$7-long.0.0.1.0.0.1">Pool</span>
                                                                    </span>
                                                                </del>
                                                                <noscript data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$7-long.0.0.1.1"></noscript>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$41-long">
                                                    <div data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$41-long.0">
                                                        <div class="space-1" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$41-long.0.0">
                                                            <span aria-hidden="true" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$41-long.0.0.0">
                                                                <i class="icon h3 icon-shampoo" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$41-long.0.0.0.0"></i>
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$41-long.0.0.0.1">&nbsp;&nbsp;&nbsp;</span>
                                                            </span>
                                                            <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$41-long.0.0.1">
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$41-long.0.0.1.1">Shampoo</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$11-long">
                                                    <div data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$11-long.0">
                                                        <div class="space-1" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$11-long.0.0">
                                                            <span aria-hidden="true" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$11-long.0.0.0">
                                                                <i class="icon h3 icon-smoking" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$11-long.0.0.0.0"></i>
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$11-long.0.0.0.1">&nbsp;&nbsp;&nbsp;</span>
                                                            </span>
                                                            <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$11-long.0.0.1">
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$11-long.0.0.1.1">Smoking allowed</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$32-long">
                                                    <div data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$32-long.0">
                                                        <div class="space-1 text-muted" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$32-long.0.0">
                                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$32-long.0.0.1">
                                                                <del aria-hidden="true" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$32-long.0.0.1.0">
                                                                    <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$32-long.0.0.1.0.0">
                                                                        <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$32-long.0.0.1.0.0.1">Suitable for events</span>
                                                                    </span>
                                                                </del>
                                                                <noscript data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$32-long.0.0.1.1"></noscript>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$1-long">
                                                    <div data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$1-long.0">
                                                        <div class="space-1" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$1-long.0.0">
                                                            <span aria-hidden="true" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$1-long.0.0.0">
                                                                <i class="icon h3 icon-tv" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$1-long.0.0.0.0"></i>
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$1-long.0.0.0.1">&nbsp;&nbsp;&nbsp;</span>
                                                            </span>
                                                            <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$1-long.0.0.1">
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$1-long.0.0.1.1">TV</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$33-long">
                                                    <div data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$33-long.0">
                                                        <div class="space-1" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$33-long.0.0">
                                                            <span aria-hidden="true" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$33-long.0.0.0">
                                                                <i class="icon h3 icon-washer" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$33-long.0.0.0.0"></i>
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$33-long.0.0.0.1">&nbsp;&nbsp;&nbsp;</span>
                                                            </span>
                                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$33-long.0.0.1">
                                                                <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$33-long.0.0.1.0">
                                                                    <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$33-long.0.0.1.0.1">Washer</span>
                                                                </span>
                                                                <noscript data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$33-long.0.0.1.1"></noscript>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$6-long">
                                                    <div data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$6-long.0">
                                                        <div class="space-1 text-muted" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$6-long.0.0">
                                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$6-long.0.0.1">
                                                                <del aria-hidden="true" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$6-long.0.0.1.0">
                                                                    <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$6-long.0.0.1.0.0">
                                                                        <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$6-long.0.0.1.0.0.1">Wheelchair accessible</span>
                                                                    </span>
                                                                </del>
                                                                <noscript data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$6-long.0.0.1.1"></noscript>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$4-long">
                                                    <div data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$4-long.0">
                                                        <div class="space-1" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$4-long.0.0">
                                                            <span aria-hidden="true" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$4-long.0.0.0">
                                                                <i class="icon h3 icon-wifi" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$4-long.0.0.0.0"></i>
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$4-long.0.0.0.1">&nbsp;&nbsp;&nbsp;</span>
                                                            </span>
                                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$4-long.0.0.1">
                                                                <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$4-long.0.0.1.0">
                                                                    <span data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$4-long.0.0.1.0.1">Wireless Internet</span>
                                                                </span>
                                                                <noscript data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.0:$1.$4-long.0.0.1.1"></noscript>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6" data-reactid=".26rwb10t1c0.0.0.0.0.3.9.2.0.1.0.$0"></div>
                                        </div>
                                    </div>

                                    <p>
                                        <span class="btn1" data-toggle="collapse" data-target="#moreamenities" style="cursor:pointer;">
                                          <font color="#f68alf" size="3px">+ More</font>
                                        </span>
                                    </p>
                                            
                                </div>
                            </div>
                        </div>
                        <hr class="col-md-9 col-md-offset-3" data-reactid=".26rwb10t1c0.0.0.0.0.3.a">
                        <div class="row" data-reactid=".26rwb10t1c0.0.0.0.0.3.b">
                            <div data-reactid=".26rwb10t1c0.0.0.0.0.3.b.0">
                                <div class="col-md-3 hide-md hide-lg" data-reactid=".26rwb10t1c0.0.0.0.0.3.b.0.0">
                                    <div style="margin-top:8px;margin-bottom:24px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.b.0.0.0">
                                        <p class="text_1lobov3-o_O-size_regular_1n7tijc" data-reactid=".26rwb10t1c0.0.0.0.0.3.b.0.0.0.0">
                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.b.0.0.0.0.1">Prices</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-3 hide-sm" data-reactid=".26rwb10t1c0.0.0.0.0.3.b.0.1">
                                    <div style="margin-top:8px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.b.0.1.0">
                                        <p class="text_1lobov3-o_O-size_regular_1n7tijc" data-reactid=".26rwb10t1c0.0.0.0.0.3.b.0.1.0.0">
                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.b.0.1.0.0.1">Prices</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9" data-reactid=".26rwb10t1c0.0.0.0.0.3.b.1">
                                <div style="margin-top:8px;margin-bottom:-8px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.b.1.0">
                                    <div class="row" data-reactid=".26rwb10t1c0.0.0.0.0.3.b.1.0.0">
                                        <div class="col-md-6" data-reactid=".26rwb10t1c0.0.0.0.0.3.b.1.0.0.$0">
                                            <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.b.1.0.0.$0.$Weekly Discount=2">
                                                <div data-reactid=".26rwb10t1c0.0.0.0.0.3.b.1.0.0.$0.$Weekly Discount=2.0">
                                                    <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.b.1.0.0.$0.$Weekly Discount=2.0.0">
                                                        <span data-reactid=".26rwb10t1c0.0.0.0.0.3.b.1.0.0.$0.$Weekly Discount=2.0.0.1">Normal Price:</span>
                                                    </span>
                                                    <span data-reactid=".26rwb10t1c0.0.0.0.0.3.b.1.0.0.$0.$Weekly Discount=2.0.1"> </span>
                                                    <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.b.1.0.0.$0.$Weekly Discount=2.0.2">
                                                        <span data-reactid=".26rwb10t1c0.0.0.0.0.3.b.1.0.0.$0.$Weekly Discount=2.0.2.1">08.01 AM - 07.59 PM</span>
                                                    </span>
                                                </div>
                                            </div>
                                            <!-- <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.b.1.0.0.$0.$Monthly Discount=2">
                                                <div data-reactid=".26rwb10t1c0.0.0.0.0.3.b.1.0.0.$0.$Monthly Discount=2.0">
                                                    <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.b.1.0.0.$0.$Monthly Discount=2.0.0">
                                                        <a href="/s/Toshima~ku--Japan?sublets=monthly" class="link-reset" data-reactid=".26rwb10t1c0.0.0.0.0.3.b.1.0.0.$0.$Monthly Discount=2.0.0.1:0">Very Last Minute:</a>
                                                        <span data-reactid=".26rwb10t1c0.0.0.0.0.3.b.1.0.0.$0.$Monthly Discount=2.0.0.1:1"> </span>
                                                    </span>
                                                    <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.b.1.0.0.$0.$Monthly Discount=2.0.1">
                                                        <strong data-reactid=".26rwb10t1c0.0.0.0.0.3.b.1.0.0.$0.$Monthly Discount=2.0.1.1">08.00 PM - 08.00 AM</strong>
                                                    </span>
                                                </div>
                                            </div> -->
                                        </div>
                                        <div class="col-md-6" data-reactid=".26rwb10t1c0.0.0.0.0.3.b.1.0.0.$1">
                                            <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.b.1.0.0.$1.$Cancellation=2">
                                                <div data-reactid=".26rwb10t1c0.0.0.0.0.3.b.1.0.0.$1.$Cancellation=2.0">
                                                    <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.b.1.0.0.$1.$Cancellation=2.0.0">
                                                        <span data-reactid=".26rwb10t1c0.0.0.0.0.3.b.1.0.0.$1.$Cancellation=2.0.0.1:0">Very Last Minute:</span>
                                                        <span data-reactid=".26rwb10t1c0.0.0.0.0.3.b.1.0.0.$1.$Cancellation=2.0.0.1:1"> </span>
                                                    </span>
                                                    <span>
                                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.b.1.0.0.$1.$Cancellation=2.0.1.1.0">08.00 PM - 08.00 AM</span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="col-md-9 col-md-offset-3" data-reactid=".26rwb10t1c0.0.0.0.0.3.c">
                        <div class="row description" id="description" data-reactid=".26rwb10t1c0.0.0.0.0.3.d">
                            <div data-reactid=".26rwb10t1c0.0.0.0.0.3.d.0">
                                <div class="col-md-3 hide-md hide-lg" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.0.0">
                                    <div style="margin-top:8px;margin-bottom:24px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.0.0.0">
                                        <p class="text_1lobov3-o_O-size_regular_1n7tijc" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.0.0.0.0">
                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.0.0.0.0.1">Description</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-3 hide-sm" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.0.1">
                                    <div style="margin-top:8px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.0.1.0">
                                        <p class="text_1lobov3-o_O-size_regular_1n7tijc" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.0.1.0.0">
                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.0.1.0.0.1">Description</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1">
                                
                                <div style="margin-top:8px;margin-bottom:8px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1">
                                    <div class="react-expandable" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0">
                                        <div class="expandable-content expandable-content-long" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0">
                                            <div data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0">
                                                <div style="margin-bottom:24px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0">
                                                    <div data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1">
                                                        <p data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$0">
                                                            <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$0.0">
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$0.0.1:$0">HOUSE INFO</span>
                                                            </span>
                                                        </p>
                                                        <p data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$1">
                                                            <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$1.0">
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$1.0.1:$0">Modern, well-designed interior, especially compared to other options at this price point in Tokyo. Took 3 years to painstakingly renovate/re-design. It was a labor of love but the result was well-worth it. The layout is perfect for Airbnb as guests have lots of privacy.</span>
                                                            </span>
                                                        </p>
                                                        <p data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$2">
                                                            <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$2.0">
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$2.0.1:$0">3 bedroom, 3-story house, 90 sq meters</span>
                                                            </span>
                                                        </p>

                                                        <p class="collapse" id="moredescription">
                                                            <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$3.0">
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$3.0.1:$0">1F :Guest Room / Toilet </span>
                                                                <br data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$3.0.1:$br-1">
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$3.0.1:$1">2F: Kitchen / Living /Dining / Bathroom</span>
                                                                <br data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$3.0.1:$br-2">
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$3.0.1:$2">3F: Hosts' rooms </span>
                                                            </span>
                                                        </p>
                                                        <p class="collapse" id="moredescription2">
                                                            <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$4.0">
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$4.0.1:$0">• Fully-equipped, renovated kitchen </span>
                                                                <br data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$4.0.1:$br-1">
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$4.0.1:$1">* high-end Nespresso Latissma Pro espresso machine </span>
                                                                <br data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$4.0.1:$br-2">
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$4.0.1:$2">* lots of other appliances </span>
                                                            </span>
                                                        </p>
                                                        <p class="collapse" id="moredescription3">
                                                            <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$5.0">
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$5.0.1:$0">• Japanese-style bathroom with shower/tub, and washer/dryer unit</span>
                                                            </span>
                                                        </p>
                                                        <p class="collapse" id="moredescription4">
                                                            <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$6.0">
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$6.0.1:$0">• High-grade entertainment center in living room</span>
                                                                <br data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$6.0.1:$br-1">
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$6.0.1:$1">* 50" flat-screen TV</span>
                                                                <br data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$6.0.1:$br-2">
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$6.0.1:$2">* top of the line Yamaha soundbar speaker</span>
                                                                <br data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$6.0.1:$br-3">
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$6.0.1:$3">* blue-ray dvd player/dvd recorder</span>
                                                                <br data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$6.0.1:$br-4">
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$6.0.1:$4">* Apple TV</span>
                                                                <br data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$6.0.1:$br-5">
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$6.0.1:$5">* cable with English channels</span>
                                                            </span>
                                                        </p>
                                                        <p class="collapse" id="moredescription5">
                                                            <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$7.0">
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$7.0.1:$0">ROOM INFO</span>
                                                            </span>
                                                        </p>
                                                        <p class="collapse" id="moredescription6">
                                                            <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$8.0">
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$8.0.1:$0">Clean, modern Japanese-inspired design</span>
                                                            </span>
                                                        </p>
                                                        <p class="collapse" id="moredescription7">
                                                            <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$9.0">
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$9.0.1:$0">• Size: 6 tatami mats (9 square meters)</span>
                                                            </span>
                                                        </p>
                                                        <p class="collapse" id="moredescription8">
                                                            <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$10.0">
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$10.0.1:$0">• Double-sized bed </span>
                                                                <br data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$10.0.1:$br-1">
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$10.0.1:$1">  * high-quality linens</span>
                                                                <br data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$10.0.1:$br-2">
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$10.0.1:$2">  * down duvet</span>
                                                                <br data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$10.0.1:$br-3">
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$10.0.1:$3">  * comfortable memory foam mattress pad </span>
                                                                <br data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$10.0.1:$br-4">
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$10.0.1:$4">  * can accommodate 2. </span>
                                                            </span>
                                                        </p>
                                                        <p class="collapse" id="moredescription9">
                                                            <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$11.0">
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$11.0.1:$0">• Extra Japanese style futon set is available and can be laid on the floor of the room for 3rd guest or child; can be stowed away in a designated futon closet during the day for more space.</span>
                                                            </span>
                                                        </p>
                                                        <p class="collapse" id="moredescription10">
                                                            <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$12.0">
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$12.0.1:$0">• Full-size wardrobe provides sufficient  storage.</span>
                                                            </span>
                                                        </p>
                                                        <p class="collapse" id="moredescription11">
                                                            <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$13.0">
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$0.0.1.$13.0.1:$0">Guest room on 1F next to toilet.</span>
                                                            </span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="collapse" id="moredescription12">
                                                <div style="margin-bottom:24px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$1.0">
                                                    <p data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$1.0.0">
                                                        <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$1.0.0.0">
                                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$1.0.0.0.1">Guest access</span>
                                                        </span>
                                                    </p>
                                                    <div data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$1.0.1">
                                                        <p data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$1.0.1.$0">
                                                            <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$1.0.1.$0.0">
                                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$1.0.1.$0.0.1:$0">Full access to 1F and 2F, including living dining/room and kitchen anytime.</span>
                                                            </span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="collapse" id="moredescription13">
                                                <div style="margin-bottom:24px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$2.0">
                                                    <p data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$2.0.0">
                                                        <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$2.0.0.0">
                                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$2.0.0.0.1">Interaction with guests</span>
                                                        </span>
                                                    </p>
                                                <div data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$2.0.1">
                                                    <p data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$2.0.1.$0">
                                                        <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$2.0.1.$0.0">
                                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$2.0.1.$0.0.1:$0">We both work full-time so are away from the house most of the time but are available in the evenings and on weekends to offer advice/suggestions or to share a nightcap ;)</span>
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapse" id="moredescription14">
                                            <div style="margin-bottom:24px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$3.0">
                                                <p data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$3.0.0">
                                                    <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$3.0.0.0">
                                                        <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$3.0.0.0.1">The neighborhood</span>
                                                    </span>
                                                </p>
                                                <div data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$3.0.1">
                                                    <p data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$3.0.1.$0">
                                                        <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$3.0.1.$0.0">
                                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$3.0.1.$0.0.1:$0">• Located at the end of a traditional shopping street (Ebisu Dori) in a safe, charming neighborhood with lots of mom-and-pop shops (butchers, florists, veg markets, fish mongers, etc) </span>
                                                        </span>
                                                    </p>
                                                    <p data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$3.0.1.$1">
                                                        <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$3.0.1.$1.0">
                                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$3.0.1.$1.0.1:$0">• Just 1 stop from Ikebukuro, so you get the best of both worlds!</span>
                                                        </span>
                                                    </p>
                                                    <p data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$3.0.1.$2">
                                                        <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$3.0.1.$2.0">
                                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$3.0.1.$2.0.1:$0">• Within 5 minutes on foot of 2 large supermarkets, inlcuding 24hr supermarket, lots of restaurants, wine bars, ramen shops, izakayas, cafes, etc.</span>
                                                        </span>
                                                    </p>
                                                    <p data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$3.0.1.$3">
                                                        <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$3.0.1.$3.0">
                                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$3.0.1.$3.0.1:$0">• 7/11 convenience store 1 minute away from house!</span>
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapse" id="moredescription15">
                                            <div style="margin-bottom:24px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$4.0">
                                                <p data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$4.0.0">
                                                    <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$4.0.0.0">
                                                        <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$4.0.0.0.1">Getting around</span>
                                                    </span>
                                                </p>
                                                <div data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$4.0.1">
                                                    <p data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$4.0.1.$0">
                                                        <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$4.0.1.$0.0">
                                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$4.0.1.$0.0.1:$0">• Ideally located just 1 subway stop from Ikebukuro station (2nd biggest station in Japan and in the world) </span>
                                                        </span>
                                                    </p>
                                                    <p data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$4.0.1.$1">
                                                        <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$4.0.1.$1.0">
                                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$4.0.1.$1.0.1:$0">• 6 minutes on foot from nearest subway station (Kanamecho Station) on Yurakucho and Fukutoshin subway lines.</span>
                                                        </span>
                                                    </p>
                                                    <p data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$4.0.1.$2">
                                                        <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$4.0.1.$2.0">
                                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$4.0.1.$2.0.1:$0">• Easy, direct access on 1 train line to the most important stations in Tokyo: Shinjuku, Harajuku, Shibuya, Yokohama, Ginza, etc.</span>
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapse" id="moredescription16">
                                            <div style="margin-bottom:24px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$5.0">
                                                <p data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$5.0.0">
                                                    <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$5.0.0.0">
                                                        <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$5.0.0.0.1">Other things to note</span>
                                                    </span>
                                                </p>
                                                <div data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$5.0.1">
                                                    <p data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$5.0.1.$0">
                                                        <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$5.0.1.$0.0">
                                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$5.0.1.$0.0.1:$0">* light breakfast items (fruit, pastries, toast).</span>
                                                            <br data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$5.0.1.$0.0.1:$br-1">
                                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$5.0.1.$0.0.1:$1">* capsules for Nespresso Latissma Pro Espresso Machine provided </span>
                                                            <br data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$5.0.1.$0.0.1:$br-2">
                                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$5.0.1.$0.0.1:$2">* a selection of tea also available (Japanese green tea, black tea, etc.)</span>
                                                        </span>
                                                    </p>
                                                    <p data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$5.0.1.$1">
                                                        <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$5.0.1.$1.0">
                                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$5.0.1.$1.0.1:$0">WI-FI  DETAILS</span>
                                                        </span>
                                                    </p>
                                                    <p data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$5.0.1.$2">
                                                        <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$5.0.1.$2.0">
                                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$5.0.1.$2.0.1:$0">Free high-speed wi-fi in house</span>
                                                            <br data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$5.0.1.$2.0.1:$br-1">
                                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$5.0.1.$2.0.1:$1">Free use of mobile 4G wi-fi router. Guests can take router with them at all times while exploring the city. </span>
                                                        </span>
                                                    </p>
                                                    <p data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$5.0.1.$3">
                                                        <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$5.0.1.$3.0">
                                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$5.0.1.$3.0.1:$0">SAFETY</span>
                                                        </span>
                                                    </p>
                                                    <p data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$5.0.1.$4">
                                                        <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$5.0.1.$4.0">
                                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$5.0.1.$4.0.1:$0">House was recently reinforced for extra earthquake protection.</span>
                                                            <br data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$5.0.1.$4.0.1:$br-1">
                                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$5.0.1.$4.0.1:$1">Earthquake/Disaster survival kit available. </span>
                                                            <br data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$5.0.1.$4.0.1:$br-2">
                                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$5.0.1.$4.0.1:$2">Smoke detectors and emergency flashlights on each floor.</span>
                                                            <br data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$5.0.1.$4.0.1:$br-3">
                                                            <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.0:$5.0.1.$4.0.1:$3">Very safe, family-friendly neighborhood</span>
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="expandable-indicator" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.0.1"></div>
                                    </div>
                                    <p>
                                        <span class="btn2" data-toggle="collapse" data-target="#moredescription,#moredescription2,#moredescription3,#moredescription4,#moredescription5,#moredescription6,#moredescription7,#moredescription8,#moredescription9,#moredescription10,#moredescription11,#moredescription12,#moredescription13,#moredescription14,#moredescription15,#moredescription16" style="cursor:pointer;">
                                          <font color="#f68alf" size="3px">+ More</font>
                                        </span>
                                    </p>
                                    <!-- <span class="react-expandable-trigger-more" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.1">
                                        <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.1.0">
                                            <button class="component_mbfsxg-o_O-component_button_r21s1q" type="button" data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.1.0.1">
                                                <span data-reactid=".26rwb10t1c0.0.0.0.0.3.d.1.1.0.1.0.1.0">+ More</span>
                                            </button>
                                        </span>
                                    </span> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="col-md-9 col-md-offset-3" data-reactid=".26rwb10t1c0.0.0.0.0.3.e">
                    <div class="row react-house-rules" id="house-rules" data-reactid=".26rwb10t1c0.0.0.0.0.3.f">
                        <div data-reactid=".26rwb10t1c0.0.0.0.0.3.f.0">
                            <div class="col-md-3 hide-md hide-lg" data-reactid=".26rwb10t1c0.0.0.0.0.3.f.0.0">
                                <div style="margin-top:8px;margin-bottom:24px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.f.0.0.0">
                                    <p class="text_1lobov3-o_O-size_regular_1n7tijc" data-reactid=".26rwb10t1c0.0.0.0.0.3.f.0.0.0.0">
                                        <span data-reactid=".26rwb10t1c0.0.0.0.0.3.f.0.0.0.0.1">House Rules</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-3 hide-sm" data-reactid=".26rwb10t1c0.0.0.0.0.3.f.0.1">
                                <div style="margin-top:8px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.f.0.1.0">
                                    <p class="text_1lobov3-o_O-size_regular_1n7tijc" data-reactid=".26rwb10t1c0.0.0.0.0.3.f.0.1.0.0">
                                        <span data-reactid=".26rwb10t1c0.0.0.0.0.3.f.0.1.0.0.1">House Rules</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9" data-reactid=".26rwb10t1c0.0.0.0.0.3.f.1">
                            <div data-reactid=".26rwb10t1c0.0.0.0.0.3.f.1.0">
                                <div style="margin-top:8px;margin-bottom:-8px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.f.1.0.0">
                                    <div class="structured_house_rules" data-reactid=".26rwb10t1c0.0.0.0.0.3.f.1.0.0.0">
                                        <div class="row col-sm-12" data-reactid=".26rwb10t1c0.0.0.0.0.3.f.1.0.0.0.0:$Not suitable for pets">
                                            <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.f.1.0.0.0.0:$Not suitable for pets.0">
                                                <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.f.1.0.0.0.0:$Not suitable for pets.0.0">
                                                    <span data-reactid=".26rwb10t1c0.0.0.0.0.3.f.1.0.0.0.0:$Not suitable for pets.0.0.1">Not suitable for pets</span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row col-sm-12 space-top-1" data-reactid=".26rwb10t1c0.0.0.0.0.3.f.1.0.0.0.0:$No parties or events">
                                            <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.f.1.0.0.0.0:$No parties or events.0">
                                                <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.f.1.0.0.0.0:$No parties or events.0.0">
                                                    <span data-reactid=".26rwb10t1c0.0.0.0.0.3.f.1.0.0.0.0:$No parties or events.0.0.1">No parties or events</span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row col-sm-12 space-top-1" data-reactid=".26rwb10t1c0.0.0.0.0.3.f.1.0.0.0.0:$May not be safe or suitable for children (0-12 years)">
                                            <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.f.1.0.0.0.0:$May not be safe or suitable for children (0-12 years).0">
                                                <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.f.1.0.0.0.0:$May not be safe or suitable for children (0-12 years).0.0">
                                                    <span data-reactid=".26rwb10t1c0.0.0.0.0.3.f.1.0.0.0.0:$May not be safe or suitable for children (0-12 years).0.0.1">May not be safe or suitable for children (0-12 years)</span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row col-sm-12 space-top-1" data-reactid=".26rwb10t1c0.0.0.0.0.3.f.1.0.0.0.0:$Check-in time is 12PM (noon) - 2AM (next day)=1">
                                            <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.f.1.0.0.0.0:$Check-in time is 12PM (noon) - 2AM (next day)=1.0">
                                                <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.f.1.0.0.0.0:$Check-in time is 12PM (noon) - 2AM (next day)=1.0.0">
                                                    <span data-reactid=".26rwb10t1c0.0.0.0.0.3.f.1.0.0.0.0:$Check-in time is 12PM (noon) - 2AM (next day)=1.0.0.1">Check-in time is 12PM (noon) - 2AM (next day).</span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row" data-reactid=".26rwb10t1c0.0.0.0.0.3.f.1.0.0.0.1">
                                            <div class="col-sm-2" data-reactid=".26rwb10t1c0.0.0.0.0.3.f.1.0.0.0.1.0">
                                                <hr class="structured_house_rules__hr" data-reactid=".26rwb10t1c0.0.0.0.0.3.f.1.0.0.0.1.0.0">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div data-reactid=".26rwb10t1c0.0.0.0.0.3.f.1.1">
                                <div class="react-expandable" data-reactid=".26rwb10t1c0.0.0.0.0.3.f.1.1.1">
                                    <div class="expandable-content" data-reactid=".26rwb10t1c0.0.0.0.0.3.f.1.1.1.0">
                                        <div style="margin-top:8px;margin-bottom:8px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.f.1.1.1.0.0">
                                            <div data-reactid=".26rwb10t1c0.0.0.0.0.3.f.1.1.1.0.0.0">
                                                <p>
                                                        <p>1) Keep guest room windows locked at all times </p>
                                                        
                                                        <p>2) Smoking is ok under the kitchen range hood or in the garage.</p>
                                                        
                                                        <p class="collapse" id="morerules">3) No burning of candles/incense.</p>
                                                        
                                                        <p class="collapse" id="morerules2">4) Turn off the a/c and all lights when you leave the house- power is quite expensive in Japan compared to a lot of other countries.</p>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="expandable-indicator" data-reactid=".26rwb10t1c0.0.0.0.0.3.f.1.1.1.0.1"></div>
                                    </div>
                                    <p>
                                        <span class="btn3" data-toggle="collapse" data-target="#morerules,#morerules2" style="cursor:pointer;">
                                          <font color="#f68alf" size="3px">+ More</font>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="col-md-9 col-md-offset-3" data-reactid=".26rwb10t1c0.0.0.0.0.3.g">
                    <div class="row" data-reactid=".26rwb10t1c0.0.0.0.0.3.l">
                        <div data-reactid=".26rwb10t1c0.0.0.0.0.3.l.0">
                            <div class="col-md-3 hide-md hide-lg" data-reactid=".26rwb10t1c0.0.0.0.0.3.l.0.0">
                                <div style="margin-top:8px;margin-bottom:24px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.l.0.0.0">
                                    <p class="text_1lobov3-o_O-size_regular_1n7tijc" data-reactid=".26rwb10t1c0.0.0.0.0.3.l.0.0.0.0">
                                        <span data-reactid=".26rwb10t1c0.0.0.0.0.3.l.0.0.0.0.1">Safety features</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-3 hide-sm" data-reactid=".26rwb10t1c0.0.0.0.0.3.l.0.1">
                                <div style="margin-top:8px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.l.0.1.0">
                                    <p class="text_1lobov3-o_O-size_regular_1n7tijc" data-reactid=".26rwb10t1c0.0.0.0.0.3.l.0.1.0.0">
                                        <span data-reactid=".26rwb10t1c0.0.0.0.0.3.l.0.1.0.0.1">Safety features</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9" data-reactid=".26rwb10t1c0.0.0.0.0.3.l.1">
                            <div style="margin-top:8px;margin-bottom:-8px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.l.1.0">
                                <div class="row" data-reactid=".26rwb10t1c0.0.0.0.0.3.l.1.0.0">
                                    <div class="col-md-6 col-sm-12" data-reactid=".26rwb10t1c0.0.0.0.0.3.l.1.0.0.$0">
                                        <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.l.1.0.0.$0.$35">
                                            <div data-reactid=".26rwb10t1c0.0.0.0.0.3.l.1.0.0.$0.$35.0">
                                                <div class="space-1" data-reactid=".26rwb10t1c0.0.0.0.0.3.l.1.0.0.$0.$35.0.0">
                                                    <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.l.1.0.0.$0.$35.0.0.1">
                                                        <span data-reactid=".26rwb10t1c0.0.0.0.0.3.l.1.0.0.$0.$35.0.0.1.1">Smoke detector</span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.l.1.0.0.$0.$37">
                                            <div data-reactid=".26rwb10t1c0.0.0.0.0.3.l.1.0.0.$0.$37.0">
                                                <div class="space-1" data-reactid=".26rwb10t1c0.0.0.0.0.3.l.1.0.0.$0.$37.0.0">
                                                    <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.l.1.0.0.$0.$37.0.0.1">
                                                        <span data-reactid=".26rwb10t1c0.0.0.0.0.3.l.1.0.0.$0.$37.0.0.1.1">First aid kit</span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12" data-reactid=".26rwb10t1c0.0.0.0.0.3.l.1.0.0.$1">
                                        <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.l.1.0.0.$1.$38">
                                            <div data-reactid=".26rwb10t1c0.0.0.0.0.3.l.1.0.0.$1.$38.0">
                                                <div class="space-1" data-reactid=".26rwb10t1c0.0.0.0.0.3.l.1.0.0.$1.$38.0.0">
                                                    <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.l.1.0.0.$1.$38.0.0.1">
                                                        <span data-reactid=".26rwb10t1c0.0.0.0.0.3.l.1.0.0.$1.$38.0.0.1.1">Safety card</span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="margin-bottom:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.l.1.0.0.$1.$39">
                                            <div data-reactid=".26rwb10t1c0.0.0.0.0.3.l.1.0.0.$1.$39.0">
                                                <div class="space-1" data-reactid=".26rwb10t1c0.0.0.0.0.3.l.1.0.0.$1.$39.0.0">
                                                    <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.l.1.0.0.$1.$39.0.0.1">
                                                        <span data-reactid=".26rwb10t1c0.0.0.0.0.3.l.1.0.0.$1.$39.0.0.1.1">Fire extinguisher</span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="col-md-9 col-md-offset-3" data-reactid=".26rwb10t1c0.0.0.0.0.3.m">
                    <div class="row" data-reactid=".26rwb10t1c0.0.0.0.0.3.n">
                        <div class="col-md-3 hide-md hide-lg" data-reactid=".26rwb10t1c0.0.0.0.0.3.n.0">
                            <div style="margin-top:8px;margin-bottom:24px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.n.0.0">
                                <p class="text_1lobov3-o_O-size_regular_1n7tijc" data-reactid=".26rwb10t1c0.0.0.0.0.3.n.0.0.0">
                                    <span data-reactid=".26rwb10t1c0.0.0.0.0.3.n.0.0.0.1">Availability</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3 hide-sm" data-reactid=".26rwb10t1c0.0.0.0.0.3.n.1">
                            <div style="margin-top:8px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.n.1.0">
                                <p class="text_1lobov3-o_O-size_regular_1n7tijc" data-reactid=".26rwb10t1c0.0.0.0.0.3.n.1.0.0">
                                    <span data-reactid=".26rwb10t1c0.0.0.0.0.3.n.1.0.0.1">Availability</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-9" data-reactid=".26rwb10t1c0.0.0.0.0.3.n.2">
                            <div style="margin-top:8px;margin-bottom:8px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.n.2.0">
                                <div class="row" data-reactid=".26rwb10t1c0.0.0.0.0.3.n.2.0.0">
                                    <span class="text_1lobov3-o_O-size_regular_1n7tijc-o_O-weight_light_1jo1qff-o_O-inline_10f0ge3" data-reactid=".26rwb10t1c0.0.0.0.0.3.n.2.0.0.0">
                                        <div class="col-md-6" data-reactid=".26rwb10t1c0.0.0.0.0.3.n.2.0.0.0.1">
                                            <strong>1 night</strong> minimum stay
                                        </div>
                                    </span><!-- 
                                    <div class="hide-sm" data-reactid=".26rwb10t1c0.0.0.0.0.3.n.2.0.0.1">
                                        <div class="col-md-6" data-reactid=".26rwb10t1c0.0.0.0.0.3.n.2.0.0.1.0">
                                            <p class="text_1lobov3-o_O-size_regular_1n7tijc" data-reactid=".26rwb10t1c0.0.0.0.0.3.n.2.0.0.1.0.0">
                                                <a class="view-calendar" href="#" data-reactid=".26rwb10t1c0.0.0.0.0.3.n.2.0.0.1.0.0.1">
                                                    <span data-reactid=".26rwb10t1c0.0.0.0.0.3.n.2.0.0.1.0.0.1.0">View calendar</span>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="hide-md hide-lg" data-reactid=".26rwb10t1c0.0.0.0.0.3.n.2.0.0.2">
                                        <div style="margin-top:16px;" data-reactid=".26rwb10t1c0.0.0.0.0.3.n.2.0.0.2.0">
                                            <div class="col-md-6" data-reactid=".26rwb10t1c0.0.0.0.0.3.n.2.0.0.2.0.0">
                                                <p class="text_1lobov3-o_O-size_regular_1n7tijc" data-reactid=".26rwb10t1c0.0.0.0.0.3.n.2.0.0.2.0.0.0">
                                                    <a class="view-calendar" href="#" data-reactid=".26rwb10t1c0.0.0.0.0.3.n.2.0.0.2.0.0.0.1">
                                                        <span data-reactid=".26rwb10t1c0.0.0.0.0.3.n.2.0.0.2.0.0.0.1.0">View calendar</span>
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<p>&nbsp;</p>

        </div>
      </div>
    </div>
  </div>
</div>









                        
                    </div>
                </div>
            </div>
        </div>




    <!-- <section class="section continue-search border-top" data-selenium="continue-search">

        <h2 class="continue-search-header">Not quite what you were looking for?</h2>

        <div>

            <button id="continue-search" class="continue-search-button">Continue search</button>

        </div>

    </section> -->











    <!-- <div class="row" id="see-all-reviews" data-selenium="see-all-reviews">

        <div class="col-xs-12">

            <a href="/ascott-kuningan-jakarta/reviews/jakarta-id.html?checkin=2016-09-16&amp;los=2&amp;cid=-1&amp;searchrequestid=41090646-b8a2-41e9-b880-54ad604a5df6" data-selenium='hotel-detail-see-all-reviews'>See all reviews </a>

        </div>

    </div>    --> 

 





<script id="pricegrid" type="text/x-handlebars-template">

    <li data-selenium="room-item" class="room-item" data-unique-id="UniqueId"  data-rtid="RoomTypeID" id="room-item-index" data-master-id="MasterRoomTypeID"

        data-supplier-id="GeneralInfo.SupplierID" data-bargs="BookingFormTransferArguments" data-no-of-guests="NumberOfGuests" data-exbed-price="Pricing.ExtraBedPricePerNight" data-room-occ="RoomMaxOccupancy" data-exbed-formatted-price="Pricing.FormattedPrices.FormattedExtraBedPrice" data-currency="Pricing.FormattedPrices.ExtraBedRateDisplay">



        <div class="room-item-currency-box">



            <span class="room-item-price-container">

                <div class="rack-rate">

                    Pricing.FormattedPrices.FormattedCrossedOutPrice

                </div>





                <div class="room-cost">

                    IDR <span class="currency">Pricing.FormattedPrices.FormattedDisplayPrice</span>

                </div>

            <div class="price-view-text-wrapper">

                <span class="price-view-text"></span>

            </div>



            </span>



        </div>

        <div class="room-item-booking">

            <div class="adult-icon-section" data-id="RoomTypeID" data-title="Occupancy details" data-description="Max RoomMaxOccupancy Adults, plus Pricing.NumberOfExtraBeds on extra bed (optional).">

                else

                <div class="adult-icon-section" data-id="RoomTypeID" data-title="Occupancy details" data-description="Max 1 Adult">

                    <div class="adult-icon-section" data-id="RoomTypeID" data-title="Occupancy details" data-description="Max RoomMaxOccupancy Adults, plus Pricing.NumberOfExtraBeds on extra bed (optional).">

                        <div class="adult-icon-section" data-id="RoomTypeID" data-title="Occupancy details" data-description="Max RoomMaxOccupancy Adults">

                            <i class="icon icon-adult-03"></i>

                            <span class="adult-number"> math MaxPeople "-" 3</span>

                            <span class="extra-room">+</span>

                        </div>

                        <div class="condition free">

                            <span class="v-middle booking-conditions" data-selenium="booking-conditions" data-cxl="Policies.CancellationPolicyCode" data-roomguid="GeneralInfo.RoomGuid" data-free="Policies.LastDayOfFreeCancellation">

                                <div class="condition free">

                                    <span class="v-middle booking-conditions" data-selenium="booking-conditions" data-cxl="Policies.CancellationPolicyCode" data-free="Policies.LastDayOfFreeCancellation">

                                        <div class="condition bc">

                                            <span class="v-middle booking-conditions" data-selenium="booking-conditions" data-cxl="Policies.CancellationPolicyCode" data-roomguid="GeneralInfo.RoomGuid">

                                                else

                                                <div class="condition bc">

                                                    <span class="v-middle booking-conditions" data-selenium="booking-conditions" data-cxl="Policies.CancellationPolicyCode">

                                                        Free cancellation!

                                                    </span>

                                                    <i class="icon icon-charge icon-right v-middle"></i>

                                                </div>

                                        </div>









    <div class="room-extra-bed">

         <div class="room-extra-bed-icon">

            <i class="accordion-toggle icon-accordion-plus" data-open="false"></i>

            <a class="accordion-toggle" href="#" data-selenium="accordion-toggle">Need an extra bed?</a>        

        </div>

        <div class="extrabed-border" style="display: none;">

            <div class="extrabed-note">

                    If you require an extra bed, please tick the box. 

                    Children aged  and over must use an extra bed.

                </div>

            <ul name="extrabed-container" class="extrabed-container">            

            

            </ul>

        </div>

    </div>



                                        <form class="book-form">



<div class="room-number-selector" style="float: left;" data-max="#if_lt GeneralInfo.NumberOfAvaliableRooms 9GeneralInfo.NumberOfAvaliableRoomselse9/if_lt" data-room-number-selector>

    <button class="btn btn-primary btn-left" data-diff="-1" data-change-room-number>-</button>

    <input name="number-of-room" class="text-center" type="text" value="#if IsHighLighted1else0/if" readonly>

    <button class="btn btn-primary btn-right" data-diff="1" data-change-room-number>+</button>

</div>

                                            <div class="book-button-container">



                                                <input data-selenium="book-button" data-cms="22861" type="submit" name="book-button" class="book-button" value="Book">



                                            </div>

                                        </form>

                                            <div class="pointsmax-panel" data-selenium="pointsmax-panel">

                                                <span class="pointsmax-point" data-selenium="pointsmax-point">This booking earns <strong>Promotion.EarnedPointsMax.FormattedEarnedPoints</strong></span>

                                                <div class="pointsmax-program" data-selenium="pointsmax-program">Promotion.EarnedPointsMax.PointsMaxProgram.PartnerPointName </div>

                                            </div>

    

    </li>

</script>



<script id="roominfotemplate" type="text/x-handlebars-template">

    <div data-selenium="roominfo-details" class="room-popup-container">



        <div id='room-popup-slider' class='room-popup-swiper'>

            <div id="slider-wrap" class='swipe-wrap' data-total-slides="">

            @if(count($data['photo'])==0)

                <div class="hotel-image"><img class="hif" src="{{ URL::asset('assets/hotel_img') }}/NoImageFound.png"></div>

            @else

                @foreach($data['photo'] as $ph)

                    <div class="hotel-image"><img class="hif" src="{{ URL::asset('assets/hotel_img') }}/$ph->photo"></div>

                @endforeach

            @endif

            </div>

            <span id="roop-popup-slider-prev" class="nav-image-prev ficon ficon-nav-left-thin"></span>

            <span id="roop-popup-slider-next" class="nav-image-next ficon ficon-nav-right-thin"></span>

        </div>

	    <div data-selenium="room-detail-info" class="room-popup-info">

            <h3 class="room-group-master-name">        </div>

    </div>

    

</script>





    



<script id="priceinfotemplate" type="text/x-handlebars-template">

        <div class="simple-popup-container" data-selenium="room-tax-and-surcharge">

            <div class="price-breakdown-container" data-selenium="price-breakdown-container">

                <div class="breakdown-items">



                    <ol>

                        <li class="row">

                            <span class="col-xs-6 breakdown-info" data-selenium="room-text">Room charge per night</span>

                            <span class="col-xs-2 curency" data-selenium="room-currency">Currency</span>

                            <span class="col-xs-4 price" data-selenium="room-price">RoomPerNightsPrice</span>

                        </li>

                        <li class="row discount">

                            <div class="col-xs-6 breakdown-info">

                                <div class="icon-circle-badge" data-selenium="coupon-icon">C</div>

                                <span class="discount-text" data-selenium="coupon-text">Redeem Coupon</span>

                            </div>

                            <span class="col-xs-2 curency" data-selenium="coupon-currency">Currency</span>

                            <span class="col-xs-4 price" data-selenium="coupon-price">CouponValue</span>

                        </li>

                    </ol>

                    <hr />

                    <ol>

                        <li class="row">

                            <span class="col-xs-6 breakdown-info" data-selenium="charge-text">Charge including taxes and fees</span>

                            <span class="col-xs-2 curency" data-selenium="charge-currency">Currency</span>

                            <span class="col-xs-4 price" data-selenium="charge-price">TotalCharge</span>

                        </li>

                        <hr />

                        <li class="row discount">

                            <div class="col-xs-6 breakdown-info">

                                <div class="icon-circle-badge" data-selenium="money-back-icon">G</div>

                                <span class="discount-text" data-selenium="money-back-text">Money back via Gift Card</span>

                            </div>

                            <span class="col-xs-2 curency" data-selenium="money-back-currency">Currency</span>

                            <span class="col-xs-4 price" data-selenium="money-back-price">MoneyBackValue</span>

                        </li>



                    </ol>

                    <ol>

                        <li class="row final-price">

                            <div class="final-price-content">

                                <span class="breakdown-info" data-selenium="final-text">Adjusted total</span>

                                <span class="curency" data-selenium="final-currency">Currency</span>

                                <span class="price" data-selenium="final-price">AdjustPrice</span>

                            </div>

                        </li>

                    </ol>

                </div>

            </div>

            <div class="room-messaging"><strong>Included</strong> in room price: IncludeMsg</div>

            <h4 data-selenium="room-info-taxes" class="room-taxes-title">

                Taxes and service fees

            </h4> 

            <div class="room-taxes-detail">

                Taxes and service fees are generally recovery charges which Agoda pays to the vendor or which are collected by the vendor. For more details, please see the Agoda Terms of Use. Tax and service fees may also contain fees that Agoda retains as compensation for processing the reservation.

            </div>

        </div>

</script>

<script id="simplePopupTemplate" type="text/x-handlebars-template">

    <div class="simple-popup-container" data-selenium="cxl-message">

        <div>Title</div>

    </div>

</script>

    



<script id="oldpopup-loading-template" type="text/x-handlebars-template">

    <div id="oldpopup-loading" class="pre-loading">

        <img src="https://cdn6.agoda.net/images/default/preload.gif"><span>Loading...</span>

    </div>

</script>

<script id="roomInfoImageTemplate" type="text/x-handlebars-template">

    <div class="room-info-picture-cont">

        <figure class="media room-media cover" style="display: block; background-image: url(Images.[0]); background-size: cover;">

            <img src="Images.[0]" alt="" />

        </figure>

    </div>

</script>



<script id="hotelmapinfotemplate" type="text/x-handlebars-template">

    <div id="map-hotel-panel">

        <div class="map-body">

            <div class="photo">

                <a href="HotelUrl">

                        <img src="https://cdn6.agoda.net/images/mvc/default/missing-image.png" />

                </a>

                <div class="review">TextReviews</div>

            </div>

            <div class="description">

                <a href="HotelUrl">HotelName</a>

                    <div><i class="star-rating star-small stars-replace_dot Star"></i></div>

                <div class="desc">{replace HotelDescription HotelName '[HOTELNAME]'}</div>

            </div>

        </div>

    </div>

</script>







</div>







    <div id="tab-panel-review" data-tab="reviews" class="tab-panel hide" data-selenium="mobile-tab-panel-reviews">

        <div class="no-padding-top">

            <div id="hotelreview-panel" class="scrollTo"></div>

                <div id="hotelreview-detail-panel" data-selenium="hotelreview-detail-panel" name="hotelreview-detail-panel"></div>

            

        </div>

    </div>



<script id="extrabed-checkbox-template" type="text/x-handlebars-template">

    <li>

        <label>

            <input type="checkbox" name="extrabed" value="ExtrabedValue" #if DisableCheckboxDisabled/if/>

            <span class="extrabed-custom-checkbox extrabed-custom-checkbox-unchecked only-mobileroomgrid">

                <span class="ficon ficon-right-tick"></span>

            </span>





            <span>{ExtrabedMessage}</span>

        </label>

    </li>

</script>



<input id="ssrRedirectUrl" name="ssrRedirectUrl" type="hidden" value="/NewSite/en-us/Hotel/RedirectToSSR" />







    <script id="map-lightbox-template" type="text/x-handlebars-template">

        <div class="map-text">Map</div>

        <div class="map-container map-poi" id="lightbox-map">

            <div id="map-container" class="map-body"></div>

            <div id="poi-container"></div>

        </div>

    </script>

    <script id="pin-template" type="text/x-handlebars-template">

        <div class='pinClass' name="pin" data-id="id" id="id">

            <span><i class="ficon fontIconClass ficon-fontIconSize"></i></span>

        </div>

    </script>

    <script id="hotel-poi-detail-template" type="text/x-handlebars-template">

        <div class="hotel-poi-detail">



                <div class="hotel-poi-detail-block-image">

                    <div class="hotel-poi-detail-img-cover">

                        <img class="hotel-poi-detail-img" src="mainPhoto"/>

                    </div>

                </div>



                <div class="hotel-poi-detail-block-content">



                        <div class="hotel-poi-detail-title">hotelName</div>

    

                        <div class="hotel-poi-detail-rating">

                            <span class="hotel-poi-starrate" data-selenium="hotel-poi-star"><i class="ficon ficon-12 starRating"></i></span>

                            | <span> reviewScoreText &nbsp;reviewScore</span>

                        </div>

                </div>

        </div>

    </script>

    <script id="poi-detail-template" type="text/x-handlebars-template">

        <section id="poi-panel-id" name="side-panel-poi" data-id="id" class="poi-item-content">



            <div id="poi-mainphoto-id" class="poi-mainphoto">

                <div class="poi-image">

                    <img class="hif" src="#if hasPicturephotos.[0]elsenoPicturePopupSize/if" />

                </div>

            </div>



            <div class="poi-detail-container">



                <div class="item-highlight">

                    <table class="content">

                        <tr>

                            <td class="text"><div class="item-name">poiName</div></td>

                        </tr>

                    </table>

                </div>



                <div class="item-distance">

                    <table class="content">

                        <tr>

                            <td class="text">

                                <div class="item-name">

                                    replace '[DISTANCE] Km from property' distance '[DISTANCE]'

                                </div>

                            </td>

                        </tr>

                    </table>

                </div>



                <div class="item-footer">

                        <span class="icon-tripadvisor-container" data-selenium="hotelmap-poi-rate"><i class="icon icon-tripadvisor ratingCss icon-tripadvisor-zoom"></i></span>

                            | <span>1 review</span>

                </div>



            </div>

        </section>

    </script>











<script type="text/javascript">

        var isSignOutClickable = true;

</script>







<script type="text/javascript">

            var isMyBookingReviewsSavedCardsClickable = true;

</script>











<script id="redirect-mobile-app-price" type="text/x-handlebars-template">

    <div class='redirect-app-price' data-id="id">

	    <span><i class="ficon ficon-pin ficon-32"></i></span>

	</div>

</script>

        </div>

        <div class="seperator"></div>
<script src="{{ URL::asset('theme/users/plugins/jquery.min.js') }}" type="text/javascript"></script>
<script>
  $(document).ready(function(){ 
      $("#moreamenities").on("hide.bs.collapse", function(){
    $(".btn1").html('<font color="#f68alf" size="3px">+ More</font>');
  });
  $("#moreamenities").on("show.bs.collapse", function(){
    $(".btn1").html('<font color="#f68alf" size="3px">- Less</font>');
  });

  $("#moredescription").on("hide.bs.collapse", function(){
    $(".btn2").html('<font color="#f68alf" size="3px">+ More</font>');
  });
  $("#moredescription").on("show.bs.collapse", function(){
    $(".btn2").html('<font color="#f68alf" size="3px">- Less</font>');
  });

  $("#morerules").on("hide.bs.collapse", function(){
    $(".btn3").html('<font color="#f68alf" size="3px">+ More</font>');
  });
  $("#morerules").on("show.bs.collapse", function(){
    $(".btn3").html('<font color="#f68alf" size="3px">- Less</font>');
  });
  

    var InitController = function () {
      var handleTable = function () {
        if (!jQuery().dataTable) {
          return;
        }
        $('#hotelroom').dataTable({
          // "aLengthMenu": [
          //   [2,5, 10, 15, 20, 25, 50, -1],
          //   [2,5, 10, 15, 20, 25, 50, "All"] // change per page values here
          // ],
          "bProcessing": true,
          "bPaginate": false,
          "bInfo" : false,
          "bServerSide": true,
          "sServerMethod": "get",
          "bRetrieve": true,
          "bFilter": false,
          "bSort": false,
          "sAjaxSource": "{!! url('/detail/do_Tabel') !!}?id_hotel={{$_GET['id_hotel']}}&checkin={{$_GET['checkin']}}&checkout={{$_GET['checkout']}}&amenities={{$_GET['amenities']}}&breakfast={{$_GET['breakfast']}}",
          // set the initial value
          "iDisplayLength": 3,
          // "sPaginationType": "bootstrap_full_number",
          "oLanguage": {
            "sProcessing": '<i class="fa fa-coffee"></i>&nbsp;Please wait...',
            //"sLengthMenu": "_MENU_ records",
            // "oPaginate": {
            //   "sPrevious": "Prev",
            //   "sNext": "Next"
            // }
          },
          "aoColumnDefs": [{
              'bSortable': false,
              "aTargets": [0, -1]
            }]
        });
      };

      return {
        //main function to initiate the module
        init: function () {
          handleTable();
        }
      };
    }();
    InitController.init();
  });

  </script>
@endsection
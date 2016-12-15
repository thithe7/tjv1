<html lang="en">
	<head>
		<link href="{{ URL::asset('theme/users/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"/>
		<!-- Theme styles START -->
		<link href="{{ URL::asset('theme/users/pages/css/components.css') }}" rel="stylesheet"/>
		<link href="{{ URL::asset('theme/users/pages/css/slider.css') }}" rel="stylesheet">
		<link href="{{ URL::asset('theme/users/corporate/css/style.css') }}" rel="stylesheet"/>
		<link href="{{ URL::asset('theme/users/corporate/css/style-responsive.css') }}" rel="stylesheet"/>
		<!-- Theme styles END -->
		<!-- TJ Custom CSS -->
		<link href="{{ URL::asset('theme/users/corporate/css/custom.css') }}" rel="stylesheet"/>
	</head>
	<body class="corporate wrapper">
		<div class="main">
			<div class="container" style="margin-bottom: 40px;">
				<div class="row">
			        <div class="col-xs-12" style="width: 100%;">
			            <div class="text-center">
			                <div class="row row-padding">
			                    <div class="col-lg-6">
			                        <img src="{{ URL::asset('assets/images/traveljinni-logo-icon.png') }}" class="logo-inv">
			                    </div>
			                    <div class="col-lg-6 pull-right" style="text-align: right">
			                        <strong>Travel Jinni</strong><br>
			                            Denpasar Bali<br>
			                            080000000 - 080000000
			                    </div>
			                </div>
			            </div>
			            <div class="row inv-header" style="padding-top: 20px; margin-top: 20px;">
			                <div class="col-xs-6" style="width: 50%; float: left;">
	                            <strong>Invoice : </strong>#{{{ $data['booking_invoice'] }}}<br>
	                            <strong>Issued : </strong>{{{ $data['payment_date'] }}}<br>
	                            <strong>Paid Using : </strong>Credit Card<br>
	                            <strong>Guest Name : </strong>{{{ $data['fullname'] }}}<br>
	                            <strong>Guest Email: </strong>{{{ $data['email'] }}}<br>
		                        <strong>Guest Phone: </strong>{{{ $data['cellphone'] }}}
			                </div>
			                <div class="col-xs-6" style="width: 50%; float: right; text-align: right;">
	                            <strong>Hotel : </strong><a href="{{{ $hotellink }}}" target="_BLANK">{{{ $data['hotel_name'] }}}</a><br>
	                            <strong>Address : </strong>{{{ $data['address'] }}}<br>
	                            <strong>Phone : </strong>{{{ $data['telephone_hotel'] }}} <br>
	                            <strong>Email : </strong>{{{ $data['email_hotel'] }}} <br>
	                            <strong>Website : </strong>{{{ $data['website_hotel'] }}}
			                </div>
			            </div>
			        </div>
			    </div>
			    <div class="row" style="padding-top: 20px;">
			        <div class="col-md-12">
			            <div class="panel panel-default">
			                <div class="panel-heading">
			                    <h4 class="text-center"><strong>Order Summary</strong></h4>
			                </div>
			                <div class="panel-body">
		                        <table class="table" style="width: 100%;">
		                            <thead>
		                                <tr>
		                                    <td style="width: 20%;"><strong>Room Type</strong></td>
		                                    <td class="text-center" style="width: 20%;"><strong>Breakfast</strong></td>
		                                    <td class="text-center" style="width: 20%;"><strong>Amenities</strong></td>
		                                    <td class="text-center" style="width: 20%;"><strong>Quantity</strong></td>
		                                    <td class="text-right" style="width: 20%;"><strong>Rate</strong></td>
		                                </tr>
		                            </thead>
		                            <tbody style="font-size: 12px;">
		                                <tr>
		                                    <td style="width: 20%;">
		                                        {{{ $data['hotel_name'] }}} - {{{ $data['room_category_name'] }}}<br>
		                                        <b>Check In : </b><br>{{{ date("D, M d Y", strtotime($data['checkin'])) }}}<br>
		                                        <b>Check Out : </b><br>{{{ date("D, M d Y", strtotime($data['checkout'])) }}}
		                                    </td>
		                                    <td class="text-center">{{{ $data['breakfast'] }}}</td>
		                                    <td class="text-center">{{{ $data['amenities'] }}}</td>
		                                    <td class="text-center">{{{ $data['qty'] }}}</td>
		                                    <td class="text-right">IDR. {{{ number_format($data['sell_price']) }}}</td>
		                                </tr><hr>
		                                <tr>
		                                    <td style="width: 20%;"></td>
		                                    <td></td>
		                                    <td class="text-right" colspan="2"><strong>Sub Total</strong></td>
		                                    <td class="text-right">IDR. {{{ number_format($data['total_sell_price']) }}}</td>
		                                </tr>
		                                <tr>
		                                    <td style="width: 20%;"></td>
		                                    <td></td>
		                                    <td class="text-right" colspan="2"><strong>Use TJ Point ({{{ $data['tjpoint'] }}})</strong></td>
		                                    <td class="text-right">- IDR. {{{ number_format($data['tjpoint_rp']) }}}</td>
		                                </tr>
		                                <tr>
		                                    <td style="width: 20%;"></td>
		                                    <td></td>
		                                    <td class="text-right" colspan="2"><strong>Use TJ Point Back ({{{ $data['tjpoint_back'] }}})</strong></td>
		                                    <td class="text-right">- IDR. {{{ number_format($data['tjpointback_rp']) }}}</td>
		                                </tr>
		                                <tr>
		                                    <td style="width: 20%;"></td>
		                                    <td></td>
		                                    <td class="text-right grand-total" colspan="2"><strong>GRAND TOTAL</strong></td>
		                                    <td class="text-right grand-total">IDR. {{{ number_format($data['total_sell_price']) }}}</td>
		                                </tr>
		                                @if($data['point_get'] > 0)
			                                <tr>
			                                    <td style="width: 20%;"></td>
			                                    <td></td>
			                                    <td class="text-right" colspan="2"><strong>You get TJ Point :</strong></td>
			                                    <td class="text-right">{{{ $data['point_get'] }}}</td>
			                                </tr>
			                            @endif
		                            </tbody>
		                        </table>
		                        <label style="font-size: 12px; color: red;">*Tax included <br>
								*Please checkin before 2PM at Thu, Dec 15 2016 and checkout before 12pm at Fri, Dec 16 2016 </label>
			                </div>
			            </div>
			        </div>
			    </div>
			</div>
		</div>
	</body>
</html>
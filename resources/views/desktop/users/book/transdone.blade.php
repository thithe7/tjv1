@extends('layout.userLayout')
@section('content')

	<div class="container" style="margin-bottom: 40px;">
		<div class="msg-done">
			<h2><strong>THANK YOU, YOUR TRANSACTION WAS SUCCESSFUL</strong></h2>
		</div>

	    <div class="row"><hr>
	        <div class="col-lg-12">
	            <div class="text-center">
	                <div class="row row-padding">
	                    <div class="col-md-6">
	                        <img src="{{ URL::asset('assets/images/traveljinni-logo-icon.png') }}" class="logo-inv">
	                    </div>
	                    <div class="col-md-6 text-right">
	                        <strong>Travel Jinni</strong><br>
                            Denpasar Bali<br>
                            080000000 - 080000000
	                    </div>
	                </div>
	            </div>
	            
	            <div class="row inv-header">
	                <div class="col-md-6">
	                	<strong>Invoice : </strong>#{{{ $data['booking_invoice'] }}}<br>
                        <strong>Issued : </strong>{{{ $data['payment_date'] }}}<br>
                        <strong>Paid Using : </strong>Credit Card<br>
                        <strong>Guest Name : </strong>{{{ $data['fullname'] }}}<br>
                        <strong>Guest Email: </strong>{{{ $data['email'] }}}<br>
                        <strong>Guest Phone: </strong>{{{ $data['cellphone'] }}}
	                </div>
	                <div class="col-md-6 text-right">
	                	<strong>Hotel : </strong><a href="{{{ $hotellink }}}" target="_BLANK">{{{ $data['hotel_name'] }}}</a><br>
                        <strong>Address : </strong>{{{ $data['address'] }}}<br>
                        <strong>Phone : </strong>{{{ $data['telephone_hotel'] }}} <br>
                        <strong>Email : </strong>{{{ $data['email_hotel'] }}} <br>
                        <strong>Website : </strong>{{{ $data['website_hotel'] }}}
	                </div>
	            </div>
	        </div>
	    </div>
	    <div class="row">
	        <div class="col-md-12">
	            <div class="panel panel-default">
	                <div class="panel-heading">
	                    <h3 class="text-center"><strong>Order Summary</strong></h3>
	                </div>
	                <div class="panel-body">
	                    <div class="table-responsive">
	                        <table class="table table-condensed">
	                            <thead>
	                                <tr>
	                                    <td><strong>Room Type</strong></td>
	                                    <td class="text-center"><strong>Breakfast</strong></td>
	                                    <td class="text-center"><strong>Amenities</strong></td>
	                                    <td class="text-center"><strong>Quantity</strong></td>
	                                    <td class="text-right"><strong>Rate</strong></td>
	                                </tr>
	                            </thead>
	                            <tbody>
	                                <tr>
	                                    <td>
	                                        {{{ $data['hotel_name'] }}} - {{{ $data['room_category_name'] }}}<br>
	                                        Check In : {{{ date("D, M d Y", strtotime($data['checkin'])) }}}<br>
	                                        Check Out : {{{ date("D, M d Y", strtotime($data['checkout'])) }}}
	                                    </td>
	                                    <td class="text-center">{{{ $data['breakfast'] }}}</td>
	                                    <td class="text-center">{{{ $data['amenities'] }}}</td>
	                                    <td class="text-center">{{{ $data['qty'] }}}</td>
	                                    <td class="text-right">IDR. {{{ number_format($data['sell_price']) }}}</td>
	                                </tr>
	                                <tr>
	                                    <td></td>
	                                    <td></td>
	                                    <td></td>
	                                    <td class="text-right" colspan="2"><strong>Sub Total</strong></td>
	                                    <td class="text-right">IDR. {{{ number_format($data['total_sell_price']) }}}</td>
	                                </tr>
	                                <tr>
	                                    <td></td>
	                                    <td></td>
	                                    <td></td>
	                                    <td class="text-right" colspan="2"><strong>Use TJ Point ({{{ $data['tjpoint'] }}})</strong></td>
	                                    <td class="text-right">- IDR. {{{ number_format($data['tjpoint_rp']) }}}</td>
	                                </tr>
	                                <tr>
	                                    <td></td>
	                                    <td></td>
	                                    <td></td>
	                                    <td class="text-right" colspan="2"><strong>Use TJ Point Back ({{{ $data['tjpoint_back'] }}})</strong></td>
	                                    <td class="text-right">- IDR. {{{ number_format($data['tjpointback_rp']) }}}</td>
	                                </tr>
	                                <tr>
	                                    <td></td>
	                                    <td></td>
	                                    <td></td>
	                                    <td class="text-right grand-total" colspan="2"><strong>GRAND TOTAL</strong></td>
	                                    <td class="text-right grand-total">IDR. {{{ number_format($data['total_sell_price']) }}}</td>
	                                </tr>
	                                @if($data['point_get'] > 0)
		                                <tr>
		                                    <td></td>
		                                    <td></td>
		                                    <td></td>
		                                    <td class="text-right" colspan="2"><strong>You get TJ Point :</strong></td>
		                                    <td class="text-right">{{{ $data['point_get'] }}}</td>
		                                </tr>
		                            @endif
	                            </tbody>
	                        </table>
	                        <label class="span-required">*Tax included <br>
							*Please checkin before 2PM at Thu, Dec 15 2016 and checkout before 12pm at Fri, Dec 16 2016 </label>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
@endsection
@extends('layout.userLayout')
@section('content')
	<div class="container" style="margin-bottom: 40px;">
		<div class="row">
			<div class="col-md-7">
			    <ul class="bxslider">
			    	@if(!empty($data['photo']))
			    		@foreach($data['photo'] as $photo)
				      		<li><img src="{{ URL::asset('assets/images/Top.jpg') }}" class="imgslider"/></li>
				      	@endforeach
				    @else
				    	<li><img src="{{ URL::asset('theme/user/corporate/img/NoImageFound.png') }}" class="imgslider"/></li>
				    @endif
			    </ul>
			</div>
			<div class="col-md-5">
				<h2 class="name-hotel">{{{ $data['hotel']->name_hotel }}}</h2>
				<div class="star-hotel">
					@for($i=0; $i<5; $i++)
						@if($i<(int)$data['hotel']->star_hotel)
							<i style="color: #ffcc33" class="fa fa-star"></i>
						@else
							<i style="color: #b5b8bc" class="fa fa-star"></i>
						@endif
					@endfor
				</div>
				<div class="address-hotel">
					{{{ $data['hotel']->address }}}
				</div>
				<p class="info-hotel">
					<i class="fa fa-phone fa-lg"></i> {{{ $data['hotel']->telephone_hotel }}} 
					&nbsp;&nbsp;| &nbsp;&nbsp;
					<i class="fa fa-fax fa-lg"></i> (62 361) 03432487
					<br>
					<i class="fa fa-globe fa-lg"></i> www.website.com
					<br>
					<i class="fa fa-envelope fa-lg"></i> {{{ $data['hotel']->email_hotel }}}
					<br>
				</p>
			</div>
		</div>

		<div class="section listroom-section">
	        <br>
	        <table id="hotelroom" class="table room-section">
	            <thead>
	                <tr>
	                    <td style="width: 250px;">Room</td>
	                    <td style="width: 400px;">Meals</td>
	                    <td style="width: 350px;">Price</td>
	                    <td style="width: 300px;">Total Room</td>
	                </tr>
	            </thead>
	            <tbody></tbody>
	        </table>
	    </div>

		<div class="listroom-section">
			<div class="about-hotel-section">
				<div class="about-details">
					<div class="about-section">
						<label class="title-detail">About Hotel</label>
						<div>
							Large room with TV, AC, microwave, stove, fridge, king size bed, sofa. Facility: gym, swimming pool, beauty saloon, restaurants, pharmacy, laundry. You’ll love my place because of the neighborhood, the comfy bed, the light, and the outdoors space. My place is good for couples, solo adventurers, and business travelers.
						</div>
					</div>
					<hr>
					<div class="space-section">
						<div class="row">
                        	<div class="col-md-3">
								<label class="space-title">The Space :</label>
							</div>
                        	<div class="col-md-9">
                        		<div class="row">
                                	<div class="col-md-6">
                                		<span>Accommodates: 2</span>
                                	</div>
                                	<div class="col-md-6">
                                		<span>Check In: Flexible</span>
                                	</div>
                                </div>
                        		<div class="row">
                                	<div class="col-md-6">
                                		<span>Bathrooms: 1</span>
                                	</div>
                                	<div class="col-md-6">
                                		<span>Check Out: 12.00 PM</span>
                                	</div>
                                </div>
                        		<div class="row">
                                	<div class="col-md-6">
                                		<span>Bedrooms: 1</span>
                                	</div>
                                	<div class="col-md-6">
                                		<span>Property type: House</span>
                                	</div>
                                </div>
                        		<div class="row">
                                	<div class="col-md-6">
                                		<span>Beds: 1</span>
                                	</div>
                                	<div class="col-md-6">
                                		<span>Room type: Private room</span>
                                	</div>
                                </div>
                                <hr>
                        	</div>
						</div>
					</div>
					<div class="space-section">
						<div class="row">
                        	<div class="col-md-3">
								<label class="space-title">Amenities :</label>
							</div>
                        	<div class="col-md-9">
                        		<div class="row">
                                	<div class="col-md-6">
                                		<i class="fa fa-cutlery fa-lg"></i> Kitchen
                                	</div>
                                	<div class="col-md-6">
                                		<i class="fa fa-television"></i> TV
                                	</div>
                                </div>
                        		<div class="row">
                                	<div class="col-md-6">
                                		<i class="fa fa-wifi fa-lg"></i> Internet
                                	</div>
                                	<div class="col-md-6">
                                		<i class="fa fa-snowflake-o fa-lg"></i> Air Conditioner
                                	</div>
                                </div>
                                <p id="more-collapse">
                                    <span class="btn-showmore" data-toggle="collapse" data-target="#moreamenities">
                                    	<font class="morecollapse" color="#ff8a0b">+ More</font>
                                    </span>
                                </p>
                                <div class="collapse" id="moreamenities">
	                        		<div class="row">
	                                	<div class="col-md-6">
	                                		<i class="fa fa-bath" aria-hidden="true"></i> Bathtub
	                                	</div>
	                                	<div class="col-md-6">
	                                		<i class="fa fa-thermometer-quarter fa-lg"></i> Heating
	                                	</div>
	                                </div>
	                        		<div class="row">
	                                	<div class="col-md-6">
	                                		<i class="fa fa-coffee fa-lg"></i> Breakfast
	                                	</div>
	                                	<div class="col-md-6">
	                                		<i class="fa fa-bed fa-lg"></i> Bed
	                                	</div>
	                                </div>
	                            </div>
	                            <p id="less-collapse">
                                    <span class="btn-showmore" data-toggle="collapse" data-target="#moreamenities">
                                    	<font class="morecollapse" color="#ff8a0b">- Less</font>
                                    </span>
                                </p>
                                <hr>
                        	</div>
						</div>
					</div>
					<div class="space-section">
						<div class="row">
                        	<div class="col-md-3">
								<label class="space-title">Prices :</label>
							</div>
                        	<div class="col-md-9">
                        		<div class="row">
                                	<div class="col-md-6">
                                		<span>Normal Price: 08.01 AM - 07.59 PM</span>
                                	</div>
                                	<div class="col-md-6">
                                		<span>Very Last Minute: 08.00 PM - 08.00 AM</span>
                                	</div>
                                </div>
                                <hr>
                        	</div>
						</div>
					</div>
					<div class="space-section">
						<div class="row">
                        	<div class="col-md-3">
								<label class="space-title">Description :</label>
							</div>
                        	<div class="col-md-9">
                        		<b>
                        			HOUSE INFO
                        		</b>
                        		<div>
                        			<label class="houseinfo">
                        				Modern, well-designed interior, especially compared to other options at this price point in Tokyo. Took 3 years to painstakingly renovate/re-design. It was a labor of love but the result was well-worth it. The layout is perfect for Airbnb as guests have lots of privacy.<br><br>

										3 bedroom, 3-story house, 90 sq meters<br><br>
									</label>

									<p id="more-desc">
	                                    <span class="btn-showmore" data-toggle="collapse" data-target="#moredesc">
	                                    	<font class="moreamenities" color="#ff8a0b">+ More</font>
	                                    </span>
	                                </p>

		                            <label id="moredesc" class="collapse">
										1F : Guest Room / Toilet <br>
										2F : Kitchen / Living /Dining / Bathroom <br>
										3F : Hosts' rooms<br><br>

										• Fully-equipped, renovated kitchen <br>
										<p>* high-end Nespresso Latissma Pro espresso machine</p>
										<p>* lots of other appliances</p><br>

										• Japanese-style bathroom with shower/tub, and washer/dryer unit<br><br>

										• High-grade entertainment center in living room <br>
										<p>* 50" flat-screen TV</p> 
										<p>* top of the line Yamaha soundbar speaker</p> 
										<p>* blue-ray dvd player/dvd recorder</p> 
										<p>* Apple TV</p>
										<p>* cable with English channels</p><br>

										<b>ROOM INFO</b><br>

										Clean, modern Japanese-inspired design<br>

										• Size: 6 tatami mats (9 square meters)<br>

										• Double-sized bed <br>
										<p>* high-quality linens</p>
										<p>* down duvet</p>
										<p>* comfortable memory foam mattress pad</p>
										<p>* can accommodate 2.</p><br>

										• Extra Japanese style futon set is available and can be laid on the floor of the room for 3rd guest or child; can be stowed away in a designated futon closet during the day for more space.<br>

										• Full-size wardrobe provides sufficient storage.<br>

										Guest room on 1F next to toilet.<br><br>

										<b>Guest access</b><br>

										Full access to 1F and 2F, including living dining/room and kitchen anytime.<br><br>

										<b>Interaction with guests</b><br>

										We both work full-time so are away from the house most of the time but are available in the evenings and on weekends to offer advice/suggestions or to share a nightcap ;)<br><br>

										<b>The neighborhood</b><br>

										• Located at the end of a traditional shopping street (Ebisu Dori) in a safe, charming neighborhood with lots of mom-and-pop shops (butchers, florists, veg markets, fish mongers, etc)<br><br>

										• Just 1 stop from Ikebukuro, so you get the best of both worlds!<br><br>

										• Within 5 minutes on foot of 2 large supermarkets, inlcuding 24hr supermarket, lots of restaurants, wine bars, ramen shops, izakayas, cafes, etc.<br><br>

										• 7/11 convenience store 1 minute away from house!<br><br>

										<b>Getting around</b><br>

										• Ideally located just 1 subway stop from Ikebukuro station (2nd biggest station in Japan and in the world)<br><br>

										• 6 minutes on foot from nearest subway station (Kanamecho Station) on Yurakucho and Fukutoshin subway lines.<br><br>

										• Easy, direct access on 1 train line to the most important stations in Tokyo: Shinjuku, Harajuku, Shibuya, Yokohama, Ginza, etc.<br><br>

										<b>Other things to note</b><br>

										<p>* light breakfast items (fruit, pastries, toast).</p>
										<p>* capsules for Nespresso Latissma Pro Espresso Machine provided</p>
										<p>* a selection of tea also available (Japanese green tea, black tea, etc.)</p><br>

										<b>WI-FI DETAILS</b><br>

										Free high-speed wi-fi in house 
										Free use of mobile 4G wi-fi router. Guests can take router with them at all times while exploring the city.<br><br>

										<b>SAFETY</b><br>

										House was recently reinforced for extra earthquake protection. <br>
										Earthquake/Disaster survival kit available. 
										Smoke detectors and emergency flashlights on each floor. <br>
										Very safe, family-friendly neighborhood
                        			</label>
                        		</div>
                        		<p id="less-desc">
                                    <span class="btn-showmore" data-toggle="collapse" data-target="#moredesc">
                                    	<font class="morecollapse" color="#ff8a0b">- Less</font>
                                    </span>
                                </p>
                                <hr>
                        	</div>
						</div>
					</div>
					<div class="space-section">
						<div class="row">
                        	<div class="col-md-3">
								<label class="space-title">House Rules :</label>
							</div>
                        	<div class="col-md-9">
                        		<div>
                        			<label class="houseinfo">
                        				Not suitable for pets<br>
										No parties or events<br>
										May not be safe or suitable for children (0-12 years)<br>
										Check-in time is 12PM (noon) - 2AM (next day).<br>
										<p>1) Keep guest room windows locked at all times</p>

										<p>2) Smoking is ok under the kitchen range hood or in the garage.</p>
									</label>

									<p id="more-house">
	                                    <span class="btn-showmore" data-toggle="collapse" data-target="#morehouse">
	                                    	<font class="moreamenities" color="#ff8a0b">+ More</font>
	                                    </span>
	                                </p>

		                            <label id="morehouse" class="collapse houseinfo">
										<p>3) No burning of candles/incense.</p>
										<p>4) Turn off the a/c and all lights when you leave the house- power is quite expensive in Japan compared to a lot of other countries.</p>
                        			</label>
                        		</div>
                        		<p id="less-house">
                                    <span class="btn-showmore" data-toggle="collapse" data-target="#morehouse">
                                    	<font class="morecollapse" color="#ff8a0b">- Less</font>
                                    </span>
                                </p>
                                <hr>
                        	</div>
						</div>
					</div>
					<div class="space-section">
						<div class="row">
                        	<div class="col-md-3">
								<label class="space-title">Safety Features :</label>
							</div>
                        	<div class="col-md-9">
                        		<div class="row">
                                	<div class="col-md-6">
                                		<span>Smoke detector</span>
                                	</div>
                                	<div class="col-md-6">
                                		<span>Safety card</span>
                                	</div>
                                </div>
                        		<div class="row">
                                	<div class="col-md-6">
                                		<span>First aid kit</span>
                                	</div>
                                	<div class="col-md-6">
                                		<span>Fire extinguisher</span>
                                	</div>
                                </div>
                                <hr>
                        	</div>
						</div>
					</div>
					<div class="space-section">
						<div class="row">
                        	<div class="col-md-3">
								<label class="space-title">Safety Features :</label>
							</div>
                        	<div class="col-md-9">
                        		<div class="row">
                                	<div class="col-md-6">
                                		<span>1 night minimum stay</span>
                                	</div>
                                </div>
                        	</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="{{ URL::asset('theme/users/plugins/jquery.min.js') }}" type="text/javascript"></script>
	<script>
		$(document).ready(function(){
			$('#more-collapse').show();
			$('#less-collapse').hide();
			$('#more-desc').show();
			$('#less-desc').hide();
			$('#more-house').show();
			$('#less-house').hide();

			$("#moreamenities").on("hide.bs.collapse", function(){
			    $('#more-collapse').show();
			    $('#less-collapse').hide();
			});
			$("#moreamenities").on("show.bs.collapse", function(){
			    $('#more-collapse').hide();
			    $('#less-collapse').show();
			});

			$("#moredesc").on("hide.bs.collapse", function(){
			    $('#more-desc').show();
			    $('#less-desc').hide();
			});
			$("#moredesc").on("show.bs.collapse", function(){
			    $('#more-desc').hide();
			    $('#less-desc').show();
			});

			$("#morehouse").on("hide.bs.collapse", function(){
			    $('#more-house').show();
			    $('#less-house').hide();
			});
			$("#morehouse").on("show.bs.collapse", function(){
			    $('#more-house').hide();
			    $('#less-house').show();
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
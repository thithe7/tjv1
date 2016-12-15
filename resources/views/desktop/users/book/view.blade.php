@extends('layout.userLayout')
@section('content')
	<style type="text/css">
		/*
		line space form login di modal pada halaman book
		 */
		.modal-spacing {
			padding-bottom: 20px !important;
		}
		.header-spacing {
			padding-top: 20px !important;
		}
		.point_value {
			float: right;
		}

		/*
		line space keterangan poin pada halaman book
		 */
		.row-spacing {
			padding-top: 1em !important;
		}
	</style>

	<div class="container" style="margin-bottom: 40px;">
		<!-- Modal -->
		<div class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
					  	<button type="button" class="close" data-dismiss="modal">&times;</button>
					  	<h4 class="modal-title">Member Login</h4>
					</div>
					<form id="submitform" role="form" novalidate="" method="post" action="#" class="header-spacing">
						<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
						<div class="modal-body">
							<div class="row modal-spacing">
								<div class="col-md-2"></div>
								<div class="col-md-3">
								  	<label>Email</label>
								</div>
								<div class="col-md-5">
								  	<input type="email" name="username" class="form-control">
								</div>
								<div class="col-md-2"></div>
							</div>
							<div class="row modal-spacing">
								<div class="col-md-2"></div>
								<div class="col-md-3">
								  	<label>Password</label>
								</div>
								<div class="col-md-5">
								  	<input type="password" name="password" class="form-control">
								</div>
								<div class="col-md-2"></div>
							</div>
						</div>
						<div class="modal-footer">
						  	<button type="button" class="btn btn-tj" id="btn-login">Login</button>
						  	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						</div>
					</form>
				</div>			  
			</div>
		</div>

		<form id="submitform" role="form" novalidate="" method="post" action="{!! url('post-book') !!}">
			<input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token">
	        <input type="hidden" name="hargajs" id="hargajs" value="{{$data['totalnormal']}}">	                
	        <input type="hidden" name="id_hotel" value="{{$data['input']['id']}}">
	        <input type="hidden" name="id_room" value="{{$data['input']['id_room']}}">
	        <input type="hidden" name="checkin" value="{{$data['input']['checkin']}}">
	        <input type="hidden" name="checkout" value="{{$data['input']['checkout']}}">
	        <input type="hidden" name="night" value="{{$data['input']['night']}}">
	        <input type="hidden" name="breakfast" value="{{$data['input']['breakfast']}}">
	        <input type="hidden" name="amenities" value="{{$data['input']['amenities']}}">
	        <input type="hidden" name="jml_kamar" value="{{$data['input']['jml_kamar']}}">
	        <input type="hidden" name="subtotal" value="{{$data['subtotalnormal']}}">
	        <input type="hidden" name="total" id="total" value="{{$data['totalnormal']}}">
	        <input type="hidden" name="point" id="point" value="0">
	        <input type="hidden" name="redeem_value_js" id="redeem_value_js" value="{{{$data['config']->redeem_value}}}">
	        <input type="hidden" name="get_value_js" id="get_value_js" value="{{{$data['config']->point_value}}}">
	        <input type="hidden" name="point_user" id="point_user" value="{{{$data['point']}}}">
	        <input type="hidden" name="TJP" id="TJP" value="0">
	        <input type="hidden" name="TJPB" id="TJPB" value="0">

	        @if(!Auth::guest())
	            <input type="hidden" name="point_back" id="point_back" value="{{$data['hotel']->point_back}}">
	        @else
	            <input type="hidden" name="point_back" id="point_back" value="0">
	        @endif

			<div class="col-md-7">
				<div class="panel-group" id="accordion">
					<div class="panel panel-default panel-style">
				      	<div class="panel-heading panel-heading-style" id="col1">
				        	<div class="panel-title heading-style-in">
				        		<div class="row">
				        			<div class="col-md-8">
						          		<a data-toggle="collapse" data-parent="#accordion" href="#collapse1" id="coll1" class="col-title">1. Booking Details</a>
						          	</div>
						          	<div class="col-md-4">
						          		@if(Auth::guard("web_users")->guest())
						          			<button type="button" class="signin" id="myBtn">Sign In</button>
						          		@endif
						          	</div>
						        </div>
				        	</div>
				      	</div>
				      	<div id="collapse1" class="panel-collapse collapse in">
					        <div class="panel-body">
	  							<div class="row row-style">
	  								<div class="col-sm-6">
		  								<label>Name <span class="span-required">*</span></label>
		  								@if(Auth::guard('web_users')->user())  
		  									<input name="loginName" placeholder="Please enter your name." class="form-control data-input" id="loginName" type="text" required value="{{{Auth::guard('web_users')->user()->name}}}">
		  								@else
		  									<input name="loginName" placeholder="Please enter your name." class="form-control data-input" id="loginName" type="text" required>
		  								@endif
		  							</div>
	  								<div class="col-sm-6">
		  								<label>Email <span class="span-required">*</span></label>
		  								@if(Auth::guard('web_users')->user())  
		  									<input name="loginEmail" placeholder="Please enter your email address." class="form-control data-input" id="loginEmail" type="email" required value="{{{Auth::guard('web_users')->user()->email}}}">
		  								@else
		  									<input name="loginEmail" placeholder="Please enter your email address." class="form-control data-input" id="loginEmail" type="email" required>
		  								@endif
		  								<span id="errorField" class="err">Email not valid</span>
		  							</div>
	  							</div>
	  							<div class="row row-style">
	  								<div class="col-sm-6">
		  								<label>Mobile <span class="span-required">*</span></label>
		  								@if(Auth::guard('web_users')->user())  
		  									<input name="loginMobile" placeholder="Please enter your mobile." class="form-control data-input" id="loginMobile" type="text" required onKeyUp="Number(this)" value="{{{Auth::guard('web_users')->user()->phone}}}">
		  								@else
		  									<input name="loginMobile" placeholder="Please enter your mobile." class="form-control data-input" id="loginMobile" type="text" required onKeyUp="Number(this)">
		  								@endif
		  							</div>
	  							</div>

	  							<div class="btn-next">
	  								@if(Auth::guard('web_users')->user()) 
					        			<a href="#collapse2" class="btn btn-primary btn-tj" data-toggle="collapse" data-parent="#accordion" id="nextcoll">Next</a>
					        		@else
					        			<a href="#collapse2" class="btn btn-primary btn-tj" data-toggle="collapse" data-parent="#accordion" id="nextcoll" style="pointer-events: none; cursor: default; background-color: #87949b">Next</a>
					        		@endif
					        	</div>				        		
							</div>

				        </div>
			      	</div>
				    <div class="panel panel-default panel-style">
				      	<div class="panel-heading panel-heading-style" id="col2">
					        <div class="panel-title">
					          <div data-toggle="collapse" data-parent="#accordion"  id="coll2" class="col-title">2. Payment</div>
					        </div>
				      	</div>
				      	<div id="collapse2" class="panel-collapse collapse">
					        <div class="panel-body">
					        	<div class="row row-style">
	  								<div class="col-sm-6">
		  								<label>Card Number <span class="span-required">*</span></label>
		  								<input name="cardnumber" placeholder="Please enter your card number" class="form-control" id="cardnumber" type="text" required onKeyUp="Number(this)">
		  							</div>
	  								<div class="col-sm-6">
		  								<label>Cardholder Name <span class="span-required">*</span></label>
		  								<input name="cardname" class="form-control" id="cardname" type="text" placeholder="Please enter your cardholder name" required>
		  							</div>
	  							</div>
	  							<div class="row row-style">
	  								<div class="col-sm-6">
		  								<label>Expiry Date <span class="span-required">*</span></label>
		  								<div class="row">
		  									<div class="col-sm-6">
			  									<select class="form-control" name="exp_month" required>
			  										@for($i=1; $i<=12; $i++)
			  											@if($i<10)
			  												<option value="0{{{ $i }}}">0{{{ $i }}}</option>
			  											@else
			  												<option value="{{{ $i }}}">{{{ $i }}}</option>
			  											@endif
			  										@endfor
			  									</select>
			  								</div>
		  									<div class="col-sm-6">
			  									<select class="form-control" name="exp-year" required>
			  										@for($i=date('Y'); $i<=date('Y', strtotime('+10 years')); $i++)
			  											<option value="{{{ $i }}}">{{{ $i }}}</option>
			  										@endfor
			  									</select>
			  								</div>
		  								</div>
		  							</div>
	  								<div class="col-sm-6">
		  								<label>CVC / CVV <span class="span-required">*</span></label>
		  								<input name="cardcvv" placeholder="" class="form-control" id="cardcvv" type="password" maxlength="3" placeholder="Please enter your CVC/CVV" required onKeyUp="Number(this)">
		  							</div>
	  							</div>

					        	<button class="btn btn-primary btn-tj" type="submit">Submit</button>
					        </div>
				      	</div>
				    </div>
				</div>
			</div>
		</form>
		<div class="col-md-5">
			<h2>{{{ $data['hotel']->name_hotel }}}</h2>
			<div class="content-details">
				<address>{{{ $data['hotel']->address }}}</address>
				<div class="row row-style">
					<div class="col-sm-4">
						<img src="{{ URL::asset('assets/images/Mid.png') }}" style="width: 100px; height: 70px;">
					</div>
					<div class="col-sm-8 hotel-details">
						<table class="table-details">
							<tr>
								<td>Location</td>
								<td> : </td>
								<td>{{{ $data['hotel']->name_area }}}</td>
							</tr>
							<tr>
								<td>Checkin</td>
								<td> : </td>
								<td>{{{ date("D, M d Y", strtotime($data['input']['checkin'])) }}}</td>
							</tr>
							<tr>
								<td>Checkout</td>
								<td> : </td>
								<td>{{{ date("D, M d Y", strtotime($data['input']['checkout'])) }}}</td>
							</tr>
							<tr>
								<td>Stay</td>
								<td> : </td>
								<td>{{{ $data['input']['jml_kamar'] }}} {{{ $data['price']->name }}}, {{{ $data['input']['night'] }}} Night(s)</td>
							</tr>
						</table>
					</div>
				</div>
			</div>

			<hr>
			
			<div class="content-details">	
				<h4>{{{ $data['input']['jml_kamar'] }}} Room(s), {{{ $data['input']['night'] }}} Night(s)</h4>

				<div class="row row-spacing">
					<div class="col-sm-4">
						Room Price
					</div>
					<div class="col-sm-8 price-book">
						IDR. {{{ $data['subtotal'] }}}
					</div>
				</div>

				<div class="row row-spacing">
					<div class="col-sm-4 pull-left">
						Use TJ Point <a href="#" data-toggle="tooltip" data-placement="top" title="{{{ $data['redeem'] }}}"><sup><img src="{{ URL::asset('assets/images/help.png') }}" width="18px;" height="18px;"></sup></a>
					</div>
					<div class="col-sm-3">
						<input type="number" name="point" class="form-control" id="settingpoint" min="0" max="{{{ $data['point'] }}}">
					</div>
					<div class="col-sm-5">
						<label class="point_value" id="point_to_rp">- IDR. 0</label>
					</div>
				</div>

				
					<div class="row row-spacing">
						<div class="col-sm-4 pull-left">
							Use TJ Point Back <a href="#" data-toggle="tooltip" data-placement="top" title="{{{ $data['redeemback'] }}}"><sup><img src="{{ URL::asset('assets/images/help.png') }}" width="18px;" height="18px;"></sup></a>
						</div>
						<div class="col-sm-3">
							<input type="checkbox" id="point_back_status" class="make-switch" onchange="return klik();" data-on-text="<i class='fa fa-check'></i>" data-off-text="<i class='fa fa-times'></i>" name="point_back" data-point="{{{$data['hotel']->point_back}}}">
						</div>
						<div class="col-sm-5">
							<label class="point_value" id="pointback_to_rp">IDR. 0</label>
						</div>
					</div>
				
			</div>

			<hr>

			<div class="content-details">
				<div class="row total-price">
					<h3>
						<div class="col-sm-6">
							<strong>Total Price</strong>
						</div>
						<div class="col-sm-6 price-book">
							<label id="total_price"><strong>IDR. {{{ $data['total'] }}}</strong></label>
						</div>
					</h3>
				</div>

				<h5>Included: Service charge 10%, Hotel tax 10%</h5>
				<h5>Included: You Will Get TJ Point <font id="getpoint"></font>  <a href="#" data-toggle="tooltip" data-placement="top" title="{{{ $data['get'] }}}"><sup><img src="{{ URL::asset('assets/images/help.png') }}" width="18px;" height="18px;"></sup></a></h5>
				<h5>Included: You Will Get TJ Point Back {{{ $data['hotel']->point_back }}} <a href="#" data-toggle="tooltip" data-placement="top" title="{{{ $data['getback'] }}}"><sup><img src="{{ URL::asset('assets/images/help.png') }}" width="18px;" height="18px;"></sup></a></h5>  
			</div>
		</div>
	</div>

	<script src="{{ URL::asset('theme/users/plugins/jquery.min.js') }}" type="text/javascript"></script>
	<script>
		$(document).ready(function(){
			$('#getpoint').html(parseInt($('#total').val()/$('#get_value_js').val()));

			$('body').on('click', '#coll1', function(){
				$('#col1').html("<div class='panel-title heading-style-in'><a data-toggle='collapse' data-parent='#accordion' href='#collapse1' id='coll1'>1. Booking Details</a></div>");
				$('#col2').html("<div class='panel-title'><div data-toggle='collapse' data-parent='#accordion' id='coll2'>2. Payment</div></div>");
			});

			$('body').on('click', '#nextcoll', function(){
				$('#col1').html("<div class='panel-title'><a data-toggle='collapse' data-parent='#accordion' href='#collapse1' id='coll1'>1. Booking Details</a></div>");
				$('#col2').html("<div class='panel-title heading-style-in'><div data-toggle='collapse' data-parent='#accordion' id='coll2'>2. Payment</div></div>");
			});

			$('#loginEmail').on('blur', function() {
				// Get the  value of the input field being submitted
			    $value = $(this).val();
			    if (validateEmail($value) && $value != '') {
			        $('#errorField').hide()
			        return true;
			    } else {
			        $('#errorField').show(function() {  
              			$("#loginEmail").focus();
              		});
			    }
			});

			$('#loginName').on('keyup', function() {
				var a = $(this).val();
				var b = /^[a-zA-Z ]*$/;

				if (!b.test(a)) {
		            a.replace(/[^\w\s]/gi, '');
		        }
			});

			$('.data-input').on('keyup blur', function() {
				$name = $('#loginName').val();
				$email = $('#loginEmail').val();
				$mobile = $('#loginMobile').val();

				if($name != "" && $email != "" && $mobile != ""){
					if(validateEmail($email)){
						$('.btn-next').html("<a href='#collapse2' class='btn btn-primary btn-tj' data-toggle='collapse' data-parent='#accordion' id='nextcoll'>Next</a>");
					}else{
						$('.btn-next').html("<a href='#collapse2' class='btn btn-primary btn-tj' data-toggle='collapse' data-parent='#accordion' id='nextcoll' style='pointer-events: none; cursor: default; background-color: #87949b'>Next</a>");
					}
				}else{
					$('.btn-next').html("<a href='#collapse2' class='btn btn-primary btn-tj' data-toggle='collapse' data-parent='#accordion' id='nextcoll' style='pointer-events: none; cursor: default; background-color: #87949b'>Next</a>");
				}
			});

			$("#myBtn").click(function(){
		    	$("#myModal").modal();
		    });

			$("#btn-login").click(function(){
		    	$.ajax({
		            method: 'POST',
		            dataType: 'json',
		            url: '{!! url("login_book") !!}',
		            data: $('#submitform').serializeArray(),
		            success: function (data) {
		            	console.log(data)
		                if (data.success == true) {
		                	$('#myModal').modal("hide");
		                	window.location.reload();
		                } else {
		                    toastr.warning("Email and password didn't match");
		                }
		            },
		            fail: function (e) {
		                toastr.error(e);
		            }
		        });
		    });

		    $('body').on('change', '#settingpoint', function(){
		        var point = $(this).val();
		        var tjpb = parseInt($('#TJPB').val());
		        var point_backstatus = 0;

		        $('#point').val($(this).val())

		        var point_to_rp = 0;
		        if ($('#point_back_status').is(":checked")){
		        	point_backstatus = 1;
		        	$('#hargajs').val(parseInt($('#total').val()-tjpb));
		        	$('#status_pointback').val("1");
		        }else{
		        	point_backstatus = 0;
		        	$('#hargajs').val(parseInt($('#total').val()));
		        }

		        var total = parseInt($('#hargajs').val());
		        var redeem_value = $('#redeem_value_js').val();
		        var get_value = $('#get_value_js').val();
		        var point_user = $('#point_user').val();

		        if(parseInt(point) > parseInt(point_user)){
			        if(parseInt(point_user*redeem_value) > parseInt(total)){
			        	point = parseInt(total)/parseInt(redeem_value);
			        }else{
			        	point = parseInt(point_user)-parseInt($('#TJPB').val()/redeem_value);
		        	}
			    	$('#settingpoint').val(point);
			    	$('#point').val(point);
		        }

		        point_to_rp = parseInt(point*redeem_value);
		        $('#TJP').val(point_to_rp);
		        $('#point_to_rp').html("- IDR. "+point_to_rp.toLocaleString('en-US', {minimumFractionDigits: 0}));

		        var total_price = parseInt(total - point_to_rp);
		        $('#hargajs').val(total_price);
		        $('#getpoint').html(parseInt(total_price/get_value));

		        $('#total_price').html("IDR. "+total_price.toLocaleString('en-US', {minimumFractionDigits: 0}));
		    });
		});
		  
		function klik(){
			var point_back = 0;
			var pointback_to_rp = 0;
			var redeem_value = $('#redeem_value_js').val();
			var get_value = $('#get_value_js').val();
			if ($('#point_back_status').is(":checked")){
				point_back = $('#point_back_status').attr('data-point');
			} else{
				$('#hargajs').val(parseInt($('#total').val()-$('#TJP').val()));
			}

			var total = $('#hargajs').val();

			pointback_to_rp = parseInt(point_back*redeem_value);
			$('#TJPB').val(pointback_to_rp);
			$('#pointback_to_rp').html("- IDR. "+pointback_to_rp.toLocaleString('en-US', {minimumFractionDigits: 0}));

			var total_price = parseInt(total - pointback_to_rp);
			$('#hargajs').val(total_price);

			if(total_price<0){
				var point = parseInt($('#total').val() / redeem_value) - parseInt(point_back);
				point_to_rp = parseInt(point*redeem_value);
				$('#TJP').val(point_to_rp);
				$('#settingpoint').val(point);
			   	$('#point').val(point);
				$('#point_to_rp').html("- IDR. "+point_to_rp.toLocaleString('en-US', {minimumFractionDigits: 0}));

				$('#pointback_to_rp').html("- IDR. "+pointback_to_rp.toLocaleString('en-US', {minimumFractionDigits: 0}));
				total_price = parseInt($('#total').val() - point_to_rp - pointback_to_rp);
				$('#hargajs').val(total_price);
			}

			$('#getpoint').html(parseInt(total_price/get_value));
			$('#total_price').html("IDR. "+total_price.toLocaleString('en-US', {minimumFractionDigits: 0}));
		}

		function validateEmail($email){
			$regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  			return $regex.test($email);
		}

		function Number(objNum) {
		    var num = objNum.value
			var ent, dec;
			if (num != '' && num != objNum.oldvalue) {
				num = MoneyToNumber(num);
				if (isNaN(num)){
					objNum.value = (objNum.oldvalue)?objNum.oldvalue:'';
		        } else {
					var ev = (navigator.appName.indexOf('Netscape') != -1)?Event:event;
					if (ev.keyCode == 190 || !isNaN(num.split('.')[1])) {
		                objNum.value = AddCommas(num.split('.')[0])+'.'+num.split('.')[1];
		            } else {
						objNum.value = AddCommas(num.split('.')[0]);
					}
					objNum.oldvalue = objNum.value;
		        }
		    }
		}

		function MoneyToNumber(num) {
			return (num.replace(/,/g, ''));
		}

		function AddCommas(num) {
			numArr=new String(num).split('').reverse();

			for (i=3;i<numArr.length;i+=3) {
				numArr[i]+='';
		    }
		    
		    return numArr.reverse().join('');
		}
	</script>

@endsection
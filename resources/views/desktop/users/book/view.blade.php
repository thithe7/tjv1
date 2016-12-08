@extends('layout.userLayout')
@section('content')
	<style type="text/css">
		.span-required {
			color: red;
		}
	</style>

	<div class="container" style="margin-bottom: 40px;">
		<form id="submitform" role="form" novalidate="" method="post" action="{!! url('post-book') !!}">
			<input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token">
	        <input type="hidden" name="hargajs" id="hargajs" value="{{$data['totalnormal']}}">	                
	        <input type="hidden" name="id_hotel" value="{{$id}}">
	        <input type="hidden" name="id_room" value="{{$id_room}}">
	        <input type="hidden" name="checkin" value="{{$checkin}}">
	        <input type="hidden" name="checkout" value="{{$checkout}}">
	        <input type="hidden" name="night" value="{{$night}}">
	        <input type="hidden" name="breakfast" value="{{$breakfast}}">
	        <input type="hidden" name="amenities" value="{{$amenities}}">
	        <input type="hidden" name="jml_kamar" value="{{$jml_kamar}}">
	        <input type="hidden" name="subtotal" value="{{$data['subtotalnormal']}}">
	        <input type="hidden" name="total" id="total" value="{{$data['totalnormal']}}">
	        <input type="hidden" name="point" id="point" value="0">

	        @if(!Auth::guest())
	            <input type="hidden" name="point_back" id="point_back" value="{{$data['hotel']->point_back}}">
	            <input type="hidden" name="point_backstatus" id="point_backstatus" value="">
	        @else
	            <input type="hidden" name="point_back" id="point_back" value="0">
	            <input type="hidden" name="point_backstatus" id="point_backstatus" value="">
	        @endif
			<div class="col-md-7">
				<div class="panel-group" id="accordion">
					<div class="panel panel-default panel-style">
				      	<div class="panel-heading panel-heading-style" id="col1">
				        	<div class="panel-title heading-style-in">
				          		<a data-toggle="collapse" data-parent="#accordion" href="#collapse1" id="coll1">1. Booking Details</a>
				        	</div>
				      	</div>
				      	<div id="collapse1" class="panel-collapse collapse in">
					        <div class="panel-body">
	  							<div class="row row-style">
	  								<div class="col-sm-6">
		  								<label>Name <span class="span-required">*</span></label>
		  								<input name="loginName" placeholder="Please enter your name." class="form-control data-input" id="loginName" type="text" required>
		  							</div>
	  								<div class="col-sm-6">
		  								<label>Email <span class="span-required">*</span></label>
		  								<input name="loginEmail" placeholder="Please enter your email address." class="form-control data-input" id="loginEmail" type="email" required>
		  								<span id="errorField" class="err">Email not valid</span>
		  							</div>
	  							</div>
	  							<div class="row row-style">
	  								<div class="col-sm-6">
		  								<label>Mobile <span class="span-required">*</span></label>
		  								<input name="loginMobile" placeholder="Please enter your mobile." class="form-control data-input" id="loginMobile" type="text" required onKeyUp="Number(this)">
		  							</div>
	  							</div>

	  							<div class="btn-next">
					        		<a href="#collapse2" class="btn btn-primary btn-tj" data-toggle="collapse" data-parent="#accordion" id="nextcoll" style="pointer-events: none; cursor: default; background-color: #87949b">Next</a>
					        	</div>				        		
							</div>

				        </div>
			      	</div>
				    <div class="panel panel-default panel-style">
				      	<div class="panel-heading panel-heading-style" id="col2">
					        <div class="panel-title">
					          <div data-toggle="collapse" data-parent="#accordion"  id="coll2">2. Payment</div>
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
								<td>{{{ date("D, M d Y", strtotime($checkin)) }}}</td>
							</tr>
							<tr>
								<td>Checkout</td>
								<td> : </td>
								<td>{{{ date("D, M d Y", strtotime($checkout)) }}}</td>
							</tr>
							<tr>
								<td>Stay</td>
								<td> : </td>
								<td>{{{ $jml_kamar }}} {{{ $data['price']->name }}}, {{{ $night }}} Night(s)</td>
							</tr>
						</table>
					</div>
				</div>
			</div>

			<hr>
			
			<div class="content-details">	
				<h4>{{{ $jml_kamar }}} Room(s), {{{ $night }}} Night(s)</h4>

				<div class="row">
					<div class="col-sm-4">
						Room Price
					</div>
					<div class="col-sm-8 price-book">
						IDR. {{{ $data['subtotal'] }}}
					</div>
				</div>
			</div>

			<hr>

			<div class="content-details">
				<div class="row total-price">
					<h3>
						<div class="col-sm-6">
							Total Price
						</div>
						<div class="col-sm-6 price-book">
							IDR. {{{ $data['total'] }}}
						</div>
					</h3>
				</div>

				<h5>Included: Service charge 10%, Hotel tax 10%</h5>
			</div>
		</div>
	</div>

	<script src="{{ URL::asset('theme/users/plugins/jquery.min.js') }}" type="text/javascript"></script>
	<script>
		$(document).ready(function(){
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

			$('.data-input').on('keyup', function() {
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
		});
		  
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
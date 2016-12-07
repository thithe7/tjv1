@extends('layout.userLoginLayout2')
@section('content_login')
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
	<title>Profile Settings | Unify - Responsive Website Template</title>

	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Favicon -->
	<link rel="shortcut icon" href="favicon.ico">

	<!-- Web Fonts -->
	<link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin'>

	<!-- CSS Global Compulsory -->
	<link rel="stylesheet" href="theme/users/login/login/bootstrap.min.css">
	<link rel="stylesheet" href="theme/users/login/login/style.css">

	<!-- CSS Header and Footer -->
	<link rel="stylesheet" href="theme/users/login/login/header-default.css">
	<link rel="stylesheet" href="theme/users/login/login/footer-v1.css">

	<!-- CSS Implementing Plugins -->
	<link rel="stylesheet" href="theme/users/login/login/animate.css">
	<link rel="stylesheet" href="theme/users/login/login/line-icons.css">
	<link rel="stylesheet" href="theme/users/login/login/font-awesome.min.css">
	<link rel="stylesheet" href="theme/users/login/login/jquery.mCustomScrollbar.css">
	<link rel="stylesheet" href="theme/users/login/login/sky-forms.css">
	<link rel="stylesheet" href="theme/users/login/login/custom-sky-forms.css">

	<!-- CSS Page Style -->
	<link rel="stylesheet" href="theme/users/login/login/profile.css">

	<!-- CSS Theme -->
	<link rel="stylesheet" href="theme/users/login/login/default.css" id="style_color">
	<link rel="stylesheet" href="theme/users/login/login/dark.css">

	<!-- CSS Customization -->
	<link rel="stylesheet" href="theme/users/login/login/custom.css">

	<link href="{{ URL::asset('theme/users/plugins/datepicker/datepicker3.css') }}" rel="stylesheet"/>

</head>

<body>
	
				
				<p>&nbsp;</p>
				<!-- Profile Content -->
				
					<div class="profile-body margin-bottom-20">
						<div class="tab-v1">
							<ul class="nav nav-justified nav-tabs">
								<li class="active"><a data-toggle="tab" href="#profile">Profile</a></li>
								<li><a data-toggle="tab" href="#editprofile">Edit Profile</a></li>
								<li><a data-toggle="tab" href="#passwordTab">Change Password</a></li>
								<li><a data-toggle="tab" href="#payment">Payment Options</a></li>
							</ul>
							<div class="tab-content">
								<div id="profile" class="profile-edit tab-pane fade in active">
									<h2 class="heading-md">Your Profile Information.</h2>
									<p>Below are the name and email addresses on file for your account.</p>
									<br>
									<dl class="dl-horizontal">
										<dt><strong>Your name </strong></dt>
										<dd>
											{{ Auth::guard('web_users')->user()->name }}
											<!-- <span>
												<a class="pull-right" href="#">
													<i class="fa fa-pencil"></i>
												</a>
											</span> -->
										</dd>
										<hr>
										<dt><strong>Your email </strong></dt>
										<dd>
											{{ Auth::guard('web_users')->user()->email }}
										</dd>
										<hr>
										<dt><strong>Phone number </strong></dt>
										<dd>
											{{ Auth::guard('web_users')->user()->phone }}
										</dd>
										<hr>
										<dt><strong>City </strong></dt>
										<dd>
											{{ $profile->name }}
										</dd>
										<hr>
										<dt><strong>Post Code </strong></dt>
										<dd>
											{{ Auth::guard('web_users')->user()->postcode }}
										</dd>
										<hr>
										<dt><strong>Address </strong></dt>
										<dd>
											{{ Auth::guard('web_users')->user()->address }}
										</dd>
										<hr>
										<dt><strong>Birthdate </strong></dt>
										<dd>
											{{ Auth::guard('web_users')->user()->birthdate }}
										</dd>
										<hr>
										<dt><strong>Email Confirmation </strong></dt>
										<dd>
											{{ Auth::guard('web_users')->user()->statusconfirm }}
										</dd>
										<hr>
										<dt><strong>Newsletter </strong></dt>
										<dd>
											<input type="checkbox" <?php if($profile->status_newsletter=='TRUE'){ echo "checked"; } ?> value="TRUE" name="status_newsletter" disabled>
										</dd>
										<hr>
									</dl>
								</div>

								<div id="editprofile" class="profile-edit tab-pane fade">
									<h2 class="heading-md">Manage your Profile</h2>
									<p>Below are the name and email addresses on file for your account.</p>
									<br>
									<form class="sky-form" id="formku">
										<input type="hidden" name="id" id="id" value="{{{ Auth::guard('web_users')->user()->id }}}">
										<input type="hidden" name="_token" value="{{{ csrf_token() }}}" id="token" />
										<dl class="dl-horizontal">
											<dt>Name</dt>
											<dd>
												<section>
													<label class="input">
														<i class="icon-append fa fa-user"></i>
														<input type="text" placeholder="Name" name="name" id="name" value="{{ Auth::guard('web_users')->user()->name }}">
														<b class="tooltip tooltip-bottom-right">Don't forget your Name</b>
													</label>
												</section>
											</dd>
											<dt>Email address</dt>
											<dd>
												<section>
													<label class="input">
														<i class="icon-append fa fa-envelope"></i>
														<input type="email" placeholder="Email address" name="email" id="email" value="{{ $profile->email }}">
														<b class="tooltip tooltip-bottom-right">Needed to verify your account</b>
													</label>
												</section>
											</dd>
											<dt>Phone</dt>
											<dd>
												<section>
													<label class="input">
														<i class="icon-append fa fa-user"></i>
														<input type="text" id="phone" name="phone" placeholder="Phone" value="{{ $profile->phone }}">
														<b class="tooltip tooltip-bottom-right">Don't forget your phone</b>
													</label>
												</section>
											</dd>
											<dt>City</dt>
											<dd>
												<div class="col-md-3">
												<section>
													<label class="input">
														
														<select id="city" name="city" class="form-control">
			                                                @foreach($data['city'] as $row)
			                                                   <option value="{{{ $row->id }}}" @if($row->id == "1") selected @endif> {{{ $row->name }}}</option>
			                                                @endforeach
			                                            </select>
			                                        	
														<b class="tooltip tooltip-bottom-right">Don't forget your city</b>
													</label>
												</section>
												</div>
											</dd>
											<dt>Post Code</dt>
											<dd>
												<section>
													<label class="input">
														<i class="icon-append fa fa-user"></i>
														<input type="text" id="postcode" name="postcode" placeholder="Post Code" value="{{ $profile->postcode }}">
														<b class="tooltip tooltip-bottom-right">Don't forget your post code</b>
													</label>
												</section>
											</dd>
											<dt>Address</dt>
											<dd>
												<section>
													<label class="input">
														<i class="icon-append fa fa-user"></i>
														<input type="text" id="address" name="address" placeholder="Address" value="{{ $profile->address }}">
														<b class="tooltip tooltip-bottom-right">Don't forget your address</b>
													</label>
												</section>
											</dd>
											<dt>Birthdate</dt>
											<dd>
												<section>
													<label class="input">
														<i class="icon-append fa fa-calendar"></i>
														<?php
								                            if ($profile->birthdate) {
								                                echo '<input class="date" type="text" name="birthdate" id="birthdate" value="'.date("Y-m-d", strtotime($profile->birthdate)).'" readonly>';
								                            }else{
								                                echo '<input class="date" type="text" name="birthdate" id="birthdate" readonly>';
								                            }
							                            ?>
													</label>
												</section>
											</dd>
											<dt><strong>Newsletter </strong></dt>
											<dd>
												<input type="checkbox" <?php if($profile->status_newsletter=='TRUE'){ echo "checked"; } ?> value="TRUE" name="status_newsletter">
											</dd>
										</dl>
										<div class="row">
							                <div class="col-xs-5 col-md-3">
							                    <h1><input type="submit" value="Save Changes" style="background-color:#095668;" class="btn btn-primary btn-block btn-sm btn-tj"></h1>
							                </div>
						            	</div>
									</form>
								</div>

								<div id="passwordTab" class="profile-edit tab-pane fade">
									<h2 class="heading-md">Manage your Security Settings</h2>
									<p>Change your password.</p>
									<br>
									<form class="sky-form" id="sky-form4" action="#">
										<dl class="dl-horizontal">
											<dt>Username</dt>
											<dd>
												<section>
													<label class="input">
														<i class="icon-append fa fa-user"></i>
														<input type="text" placeholder="Username" name="username">
														<b class="tooltip tooltip-bottom-right">Needed to enter the website</b>
													</label>
												</section>
											</dd>
											<dt>Email address</dt>
											<dd>
												<section>
													<label class="input">
														<i class="icon-append fa fa-envelope"></i>
														<input type="email" placeholder="Email address" name="email">
														<b class="tooltip tooltip-bottom-right">Needed to verify your account</b>
													</label>
												</section>
											</dd>
											<dt>Enter your password</dt>
											<dd>
												<section>
													<label class="input">
														<i class="icon-append fa fa-lock"></i>
														<input type="password" id="password" name="password" placeholder="Password">
														<b class="tooltip tooltip-bottom-right">Don't forget your password</b>
													</label>
												</section>
											</dd>
											<dt>Confirm Password</dt>
											<dd>
												<section>
													<label class="input">
														<i class="icon-append fa fa-lock"></i>
														<input type="password" name="passwordConfirm" placeholder="Confirm password">
														<b class="tooltip tooltip-bottom-right">Don't forget your password</b>
													</label>
												</section>
											</dd>
										</dl>
										<label class="toggle toggle-change"><input type="checkbox" checked="" name="checkbox-toggle-1"><i class="no-rounded"></i>Remember password</label>
										<br>
										<section>
											<label class="checkbox"><input type="checkbox" id="terms" name="terms"><i></i><a href="#">I agree with the Terms and Conditions</a></label>
										</section>
										<div class="row">
						                <div class="col-xs-5 col-md-3">
						                    <h1><input type="submit" value="Save Changes" style="background-color:#095668;" class="btn btn-primary btn-block btn-sm btn-tj"></h1>
						                </div>
						            </div>
									</form>
								</div>

								<div id="payment" class="profile-edit tab-pane fade">
									<h2 class="heading-md">Manage your Payment Settings</h2>
									<p>Below are the payment options for your account.</p>
									<br>
									<form class="sky-form" id="sky-form" action="#">
										<!--Checkout-Form-->
										<section>
											<div class="inline-group">
												<label class="radio"><input type="radio" checked="" name="radio-inline"><i class="rounded-x"></i>Visa</label>
												<label class="radio"><input type="radio" name="radio-inline"><i class="rounded-x"></i>MasterCard</label>
												<label class="radio"><input type="radio" name="radio-inline"><i class="rounded-x"></i>PayPal</label>
											</div>
										</section>

										<section>
											<label class="input">
												<input type="text" name="name" placeholder="Name on card">
											</label>
										</section>

										<div class="row">
											<section class="col col-10">
												<label class="input">
													<input type="text" name="card" id="card" placeholder="Card number">
												</label>
											</section>
											<section class="col col-2">
												<label class="input">
													<input type="text" name="cvv" id="cvv" placeholder="CVV2">
												</label>
											</section>
										</div>

										<div class="row">
											<label class="label col col-4">Expiration date</label>
											<section class="col col-5">
												<label class="select">
													<select name="month">
														<option disabled="" selected="" value="0">Month</option>
														<option value="1">January</option>
														<option value="1">February</option>
														<option value="3">March</option>
														<option value="4">April</option>
														<option value="5">May</option>
														<option value="6">June</option>
														<option value="7">July</option>
														<option value="8">August</option>
														<option value="9">September</option>
														<option value="10">October</option>
														<option value="11">November</option>
														<option value="12">December</option>
													</select>
													<i></i>
												</label>
											</section>
											<section class="col col-3">
												<label class="input">
													<input type="text" placeholder="Year" id="year" name="year">
												</label>
											</section>
										</div>
										<div class="row">
						                <div class="col-xs-5 col-md-3">
						                    <h1><input type="submit" value="Save Changes" style="background-color:#095668;" class="btn btn-primary btn-block btn-sm btn-tj"></h1>
						                </div>
						            </div>
										<!--End Checkout-Form-->
									</form>
								</div>

							</div>
						</div>
					</div>
				

	<!-- JS Global Compulsory -->
	<script type="text/javascript" src="theme/users/login/login/jquery.min.js"></script>
	<script type="text/javascript" src="theme/users/login/login/jquery-migrate.min.js"></script>
	<script type="text/javascript" src="theme/users/login/login/bootstrap.min.js"></script>
	<!-- JS Implementing Plugins -->
	<script type="text/javascript" src="theme/users/login/login/smoothScroll.js"></script>
	<script type="text/javascript" src="theme/users/login/login/jquery-ui.min.js"></script>
	<script type="text/javascript" src="theme/users/login/login/jquery.validate.min.js"></script>
	<script type="text/javascript" src="theme/users/login/login/jquery.maskedinput.min.js"></script>
	<script type="text/javascript" src="theme/users/login/login/jquery.mCustomScrollbar.concat.min.js"></script>
	<!-- JS Customization -->
	<script type="text/javascript" src="theme/users/login/login/custom.js"></script>
	<!-- JS Page Level -->
	<script type="text/javascript" src="theme/users/login/login/app.js"></script>
	<script type="text/javascript" src="theme/users/login/login/reg.js"></script>
	<script type="text/javascript" src="theme/users/login/login/checkout.js"></script>
	<script type="text/javascript" src="theme/users/login/login/datepicker.js"></script>
	<script type="text/javascript" src="theme/users/login/login/style-switcher.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function() {
			App.init();
			App.initScrollBar();
			RegForm.initRegForm();
			Datepicker.initDatepicker();
			CheckoutForm.initCheckoutForm();
			StyleSwitcher.initStyleSwitcher();
		});
	</script>

	<script src="{{ URL::asset('theme/users/plugins/jquery.min.js') }}" type="text/javascript"></script>
	<script src="{{ URL::asset('theme/users/plugins/datepicker/bootstrap-datepicker.js') }}" type="text/javascript"></script>

	<script>
	$('.date').datepicker({
        format: 'yyyy-mm-dd',
        endDate: '0D',
        autoclose: true
    });
    $(document).ready(function(){

        var InitController = function () {

            var handleValidation = function () {

                $('#formku').validate({
                    errorElement: 'span', //default input error message container
                    errorClass: 'help-block', // default input error message class
                    focusInvalid: true, // do not focus the last invalid input
                    ignore: "",
                    rules: {
                        id: {
                            required: true
                        },
                        name: {
                            required: true
                        },
                        address: {
                            required: true
                        },
                        email: {
                            required: true
                        },
                        birthdate: {
                            required: true
                        },
                        phone: {
                            required: true
                        },
                        password: {
                            required: true
                        }
                    },
                    invalidHandler: function (event, validator) { //display error alert on form submit              
                        toastr.error("Maaf, Inputkan data dengan lengkap");
                    },
                    errorPlacement: function (error, element) { // render error placement for each input type
                        var icon = $(element).parent('.input-icon').children('i');
                        icon.removeClass('fa-check').addClass("fa-warning");
                        icon.attr("data-original-title", error.text()).tooltip({'container': 'body'});
                    },
                    highlight: function (element) { // hightlight error inputs
                        $(element).closest('.form-group').addClass('has-error'); // set error class to the control group   
                    },
                    unhighlight: function (element) { // revert the change done by hightlight
                    },
                    success: function (label, element) {
                        var icon = $(element).parent('.input-icon').children('i');
                        $(element).closest('.form-group').removeClass('has-error');
                        icon.removeClass("fa-warning");
                    },
                    submitHandler: function (form) {
                        $.ajax({
                            method: 'POST',
                            dataType: 'json',
                            url: '{!! url("/profile/do_Simpan") !!}',
                            data: $('#formku').serializeArray(),
                            success: function (data) {
                                if (data.success === true) {
                                    toastr.success(data.msgServer);
                                    location.reload();
                                } else {
                                    toastr.warning(data.msgServer);
                                }
                            },
                            fail: function (e) {
                                toastr.error(e);
                            }
                        });
                    }
                });
            };

            return {
                //main function to initiate the module
                init: function () {
                    handleValidation();
                }
            };

        }();

        InitController.init();
    });
</script>


</body>
</html>
@endsection
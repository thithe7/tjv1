<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Head BEGIN -->
<head>
	<meta charset="utf-8">
	<title>Travel Jinni</title>

	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="csrf-token" content="<?php echo csrf_token() ?>"/>

	<link rel="shortcut icon" href="favicon.ico">

	<!-- Global styles START -->       
	<link href="{{ URL::asset('theme/users/plugins/font-awesome-4.7.0/css/font-awesome.css') }}" rel="stylesheet"/>
	<link href="{{ URL::asset('theme/users/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"/>
	<!-- Global styles END --> 

	<!-- Page level plugin styles START -->
	<link href="{{ URL::asset('theme/users/plugins/owl.carousel/assets/owl.carousel.css') }}" rel="stylesheet"/>
	<!-- Page level plugin styles END -->

	<!-- Theme styles START -->
	<link href="{{ URL::asset('theme/users/pages/css/components.css') }}" rel="stylesheet"/>
	<link href="{{ URL::asset('theme/users/pages/css/slider.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('theme/users/corporate/css/style.css') }}" rel="stylesheet"/>
	<link href="{{ URL::asset('theme/users/corporate/css/style-responsive.css') }}" rel="stylesheet"/>
	<link href="{{ URL::asset('theme/users/corporate/css/custom.css') }}" rel="stylesheet"/>
	<!-- Theme styles END -->
	<link href="{{ URL::asset('theme/users/plugins/toastr/toastr.min.css') }}" rel="stylesheet"/>
	<link href="{{ URL::asset('theme/users/plugins/DataTables-1.10.12/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet"/>
	<link href="{{ URL::asset('theme/users/plugins/flag-icon-css-master/css/flag-icon.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('assets/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('assets/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet">

	<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

	<!-- bxSlider CSS file -->
	<link href="{{ URL::asset('theme/users/plugins/bxslider/jquery.bxslider.css') }}" rel="stylesheet" />
</head>
<!-- Head END -->

<!-- Body BEGIN -->
<body class="corporate wrapper"><!-- add class page-header-fixed, if you want to fix header -->

	<!-- BEGIN TOP BAR -->
	<div class="pre-header">
		<div class="container">
			<div class="row">
				<!-- BEGIN TOP BAR LEFT PART -->
				<div class="col-md-6 col-sm-6 additional-shop-info">
					<ul class="list-unstyled list-inline">
						<li><i class="fa fa-phone"></i><span>+62 361 475 3330</span></li>
						<li><i class="fa fa-envelope-o"></i><span>info@traveljinni.com</span></li>
					</ul>
				</div>
				<!-- END TOP BAR LEFT PART -->
				<!-- BEGIN TOP BAR MENU -->
				<div class="col-md-6 col-sm-6 additional-nav">
					<ul class="list-unstyled list-inline pull-right">
						<!-- BEGIN CURRENCIES -->
						<li class="langs-block">
							<a href="javascript:void(0);" class="current">Rp - IDR</a>
							<div class="langs-block-others-wrapper">
								<div class="langs-block-others" style="background: #095668;">
									<a href="javascript:void(0);">$ - USD</a>
								</div>
							</div>
						</li>
						<!-- END CURRENCIES -->
						<!-- BEGIN LANGS -->
						<li class="langs-block">
							<a href="javascript:void(0);" class="current"><span class="flag-icon flag-icon-us"></span> English</a>
							<div class="langs-block-others-wrapper">
								<div class="langs-block-others" style="background: #095668; min-width: 150px;">
									<a href="javascript:void(0);"><span class="flag-icon flag-icon-id"></span> Indonesia</a>
								</div>
							</div>
						</li>
						<!-- END LANGS -->
						@if(Auth::guard('web_users')->user())
						<li><a href="{{ url('profile') }}" style="text-decoration: none;">Profile</a></li>
						<li><a href="javascript:;" style="text-decoration: none;" data-toggle="modal" data-target="#myModal" data-keyboard="false" data-backdrop="static"><img src="{{ URL::asset('assets/images/help.png') }}" alt="How to use?" height="15px;"> TJ Point = <b>{{{number_format(Session::get('total_point'), 0, ',', '.')}}}</b></a></li>
						<li><a href="{{ url('logout') }}">Log Out</a></li>
						@else
						<li><a href="{{ url('login') }}">Log In</a></li>
						<li><a href="{{ url('signup') }}">Register</a></li>
						@endif
					</ul>
				</div>
				<!-- END TOP BAR MENU -->
			</div>
		</div>        
	</div>
	<!-- END TOP BAR -->
	<!-- BEGIN HEADER -->
	<div class="header">
		<div class="container">
			<a class="site-logo" href="{{ url('/') }}">
				<img src="{{ URL::asset('assets/images/traveljinni-logo-icon.png') }}" alt="TraelJinni" style="height: 36px;">
			</a>

			<a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>

			<!-- BEGIN NAVIGATION -->
			<div class="header-navigation pull-right font-transform-inherit">
				<ul>
					<li><a href="{{ url('http://traveljinni.com/tj/public/') }}"><font style="font-family: 'MontserratFont'">HOME</font></a></li>
					<li><a href="{{ url('about-traveljinni') }}"><font style="font-family: 'MontserratFont'">ABOUT US</font></a></li>
					<li><a href="{!! url('faq') !!}"><font style="font-family: 'MontserratFont'">FAQ</font></a></li>
					<li><a href="{!! url('career-traveljinni') !!}"><font style="font-family: 'MontserratFont'">CAREER</font></a></li>
					<li><a href="{!! url('contact-traveljinni') !!}"><font style="font-family: 'MontserratFont'">CONTACT US</font></a></li>
				</ul>
			</div>
			<!-- END NAVIGATION -->
		</div>
	</div>
	<!-- Header END -->

	<div class="main">
		@yield('content')
	</div>
	<!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">How To Use TJ Point?</h4>
				</div>
				<div class="modal-body">
					<p>Some text in the modal.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-warning" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>
	<!-- BEGIN PRE-FOOTER -->
	<div class="pre-footer">
		<div class="container">
			<div class="row">
				<!-- BEGIN BOTTOM ABOUT BLOCK -->
				<div class="col-md-4 col-sm-12 pre-footer-col">
					<img src="{{ URL::asset('assets/images/Bottom.png') }}" alt="TravelJinni" style="height: 90px;">
				</div>
				<!-- END BOTTOM ABOUT BLOCK -->

				<!-- BEGIN BOTTOM CONTACTS -->
				<div class="col-md-8 col-sm-12 pre-footer-col">
					<div class="col-md-4 col-sm-12">
						<h2 style="font-weight: bold;">Company</h2>
						<ul>
							<li><a href="javascript:;">About Us</a></li>
							<li><a href="javascript:;">Career</a></li>
							<li><a href="javascript:;">Policy and Legal</a></li>
						</ul>
					</div>
					<div class="col-md-4 col-sm-12 pre-footer-col">
						<h2 style="font-weight: bold;">How To Order</h2>
						<ul>
							<li><a href="javascript:;">How To Order</a></li>
							<li><a href="javascript:;">Contact</a></li>
							<li><a href="javascript:;">Help</a></li>
							<li><a href="javascript:;">Be Our Partners</a></li>
						</ul>
					</div>
					<div class="col-md-4 col-sm-12 pre-footer-col">
						<h2 style="font-weight: bold;">Member Area</h2>
						<ul>
							<li><a href="javascript:;">Newsletter and Promo</a></li>
							<li><a href="javascript:;">Point Rewards</a></li>
							<li><a href="javascript:;">Register</a></li>
							<li><a href="javascript:;">Member Area</a></li>
						</ul>
					</div>
				</div>
				<!-- END BOTTOM CONTACTS -->
			</div>
		</div>
	</div>
	<!-- END PRE-FOOTER -->
	<!-- BEGIN FOOTER -->
	<div class="footer" id="footer">
		<div class="container">
			<div class="row">
				<!-- BEGIN COPYRIGHT -->
				<div class="col-md-6 col-sm-6 padding-top-10">
					<h4>Copyright by TravelJinni © 2016</h4>
				</div>
				<!-- END COPYRIGHT -->
				<!-- BEGIN PAYMENTS -->
				<div class="col-md-6 col-sm-6">
					<ul class="social-footer list-unstyled list-inline pull-right">
						<li>Follow Us On</li>
						<!-- <li>:</li> -->
						<li class="sosmed"><a href="javascript:;"><i class="fa fa-facebook"></i></a></li>
						<li class="sosmed"><a href="javascript:;"><i class="fa fa-twitter"></i></a></li>
						<li class="sosmed"><a href="javascript:;"><i class="fa fa-instagram"></i></a></li>
						<li class="sosmed"><a href="javascript:;"><i class="fa fa-google-plus"></i></a></li>
						<li class="sosmed"><a href="javascript:;"><i class="fa fa-youtube"></i></a></li>
					</ul>  
				</div>
				<!-- END PAYMENTS -->
			</div>
		</div>
	</div>
	<!-- END FOOTER -->

	<!-- Load javascripts at bottom, this will reduce page load time -->
	<!-- BEGIN CORE PLUGINS (REQUIRED FOR ALL PAGES) -->
    <!--[if lt IE 9]>
    <![endif]--> 
    <script src="{{ URL::asset('theme/users/plugins/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('theme/users/plugins/jquery-validation/dist/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('theme/users/plugins/toastr/toastr.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('theme/users/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>      
    <script src="{{ URL::asset('theme/users/corporate/scripts/back-to-top.js') }}" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->

    <script src="{{ URL::asset('theme/users/plugins/DataTables-1.10.12/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('theme/users/plugins/DataTables-1.10.12/media/js/dataTables.bootstrap.min.js') }}"></script>
    <!-- BEGIN PAGE LEVEL JAVASCRIPTS (REQUIRED ONLY FOR CURRENT PAGE) -->
    <script src="{{ URL::asset('theme/users/plugins/owl.carousel/owl.carousel.min.js') }}" type="text/javascript"></script><!-- slider for products -->

    <script src="{{ URL::asset('assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/plugins/select2/dist/js/select2.min.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('theme/users/corporate/scripts/layout.js') }}" type="text/javascript"></script>
    
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>

	<!-- bxSlider Javascript file -->
	<script src="{{ URL::asset('theme/users/plugins/bxslider/jquery.bxslider.min.js') }}"></script>

    <script type="text/javascript">
    	$.ajaxSetup({
    		headers: {
    			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    		}
    	});
    	$(document).ready(function() {
    		// write condition here
    		
    		$('.bxslider').bxSlider();

    		$.widget( "custom.catcomplete", $.ui.autocomplete, {
				_create: function() {
					this._super();
					this.widget().menu( "option", "items", "> :not(.ui-autocomplete-category)" );
				},
				_renderMenu: function( ul, items ) {
					var that = this,
					currentCategory = "";
					$.each( items, function( index, item ) {
						var li;
						if ( item.category != currentCategory ) {
							ul.append( "<li class='ui-autocomplete-category' style='font-family:Source Sans Pro Regular; padding-left: 10px; font-size: 20px; color: white; background-color:#87949b'> <h3>" + item.category + "</h3> </i> </li>" );
							currentCategory = item.category;
						}
						li = that._renderItemData( ul, item );
						if ( item.category ) {
							li.attr( "aria-label", item.category + " : " + item.label );
							li.addClass("highlight");
						}
					});
				}
			});

    		$("#autocomplete").catcomplete({
				source: "{{ url('search-autocomplete') }}",
				minLength: 3,
				select: function(event, ui) {
	                // prevent autocomplete from updating the textbox
	                event.preventDefault();
	                // manually update the textbox and hidden field
	                $(this).val(ui.item.label);
	                $("#autocomplete-value").val(ui.item.value);
	                $("#autocomplete-hotel").val(ui.item.idhotel);
	                $("#autocomplete-city").val(ui.item.idcity);
	                $("#autocomplete-country").val(ui.item.idcountry);
	            }
	        });
        });
    	$('.make-switch').bootstrapSwitch();
    </script>
    <!-- END PAGE LEVEL JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
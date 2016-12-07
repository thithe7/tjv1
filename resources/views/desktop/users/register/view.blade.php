@extends("layout.userLayout")

@section('content')


<html>
<head>

<meta name="csrf-token" content="{{ csrf_token() }}" />

<script src="{{ URL::asset('frontassets/reg1/style.js') }}"></script>

<!-- Include Date Range Picker -->
    <link href="{{ URL::asset('frontassets/datarangepicker/daterangepicker.css') }}" rel="stylesheet"/>
    <script src="{{ URL::asset('frontassets/datarangepicker/daterangepicker.js') }}" type="text/javascript"></script>

<style type="text/css">
    .iconbirth {
        background-image: url('frontassets/images/date.png');
        background-position: 97% ;
        background-repeat: no-repeat;
        cursor:pointer;
}
.biru {
        background-color:#095668;
}

.biru:hover {
        background-color:black;
}
</style>

<style type="text/css">
@font-face{
    font-family: 'MontserratFont';
    src: url('frontassets/fonts/Montserrat-Bold.ttf');
}

h1 {
    font-size: 20px;
}

h2 {
    font-size: 18px;
}

h3 {
    font-size: 16px;
}

h4 {
    font-size: 14px;
}
</style>

<script type="text/javascript">

        function validateForm () {

        var name=document.forms["myform"]["name"].value;
        var email=document.forms["myform"]["email"].value;
        //var username=document.forms["myform"]["username"].value;
        var password=document.forms["myform"]["password"].value;
        var phone=document.forms["myform"]["phone"].value;
        var birthdate=document.forms["myform"]["birthdate"].value;
        var mincarpassword = 10;
        var mincarphone = 7;
        

        if (name==null || name=="")
          {
            var infoerror =("Name Can't Empty");
            document.getElementById("fillouts").innerHTML =infoerror;
            return false;
          };

        if (email==null || email=="")
          {
            var infoerror =("Email Can't Empty");
            document.getElementById("fillouts").innerHTML =infoerror;
            return false;
          };

        if ((email.indexOf('@',0)==-1) || (email.indexOf('.',0)==-1))
            { 
            var infoerror =("Wrong Email Format");
            document.getElementById("fillouts").innerHTML =infoerror;
            return false;
          };

        // if (username==null || username=="")
        //   {
        //     var infoerror =("Username Can't Empty");
        //     document.getElementById("fillouts").innerHTML =infoerror;
        //     return false;
        //   };

          if (password==null || password=="")
          {
            var infoerror =("Password Can't Empty");
            document.getElementById("fillouts").innerHTML =infoerror;
            return false;
          };

          if (password==name)
          {
            var infoerror =("Password Can't Same with Name");
            document.getElementById("fillouts").innerHTML =infoerror;
            return false;
          };

          if (password.length < mincarpassword)
          {
            var infoerror =("Password Min. 10 character");
            document.getElementById("fillouts").innerHTML =infoerror;
            return false;
          };

          if (phone==null || phone=="")
          {
            var infoerror =("Phone Can't Empty");
            document.getElementById("fillouts").innerHTML =infoerror;
            return false;
          };

          if (phone.length < mincarphone)
          {
            var infoerror =("Phone Min. 12 character");
            document.getElementById("fillouts").innerHTML =infoerror;
            return false;
          };

            if (birthdate==null || birthdate=="")
          {
            var infoerror =("Birthdate Can't Empty");
            document.getElementById("fillouts").innerHTML =infoerror;
            return false;
          };          

        if (grecaptcha.getResponse() == "") {
            alert("Captcha must be checked");
            return false;
        };

        }
        </script>


<script type="text/javascript">
function validAngka(a)
{
    if(!/^[0-9]+$/.test(a.value))
    {
    a.value = a.value.substring(0,a.value.length-1);
    }
}

function validNama(a)
{
    if(!/^[a-zA-Z\_\- ]+$/.test(a.value))
    {
    a.value = a.value.substring(0,a.value.length-1);
    }
}
</script>

</head>
<body style="font-family: 'MontserratFont'">


<div class="container">

@if(Session::has('sukses'))

                    <div class="alert alert-success alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        </button>
                        <strong>
                          SUCCESS !!!Thank you for registering. A Confirmation email has been sent to your email. Please click to the link on your email to confirm your email address<br>If you do not receive the message within a few minutes, <b>please check your spam or bulk on your email</b>.
                        </strong>
                    </div>
                    {{Session::forget('sukses')}}
                  @endif
                    @if(Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        </button>
                        <strong>ERROR !!!</strong> {{ Session::get('error') }}
                    </div>
                    {{Session::forget('error')}}
                    @endif


<br>


<div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
        <form method="post" action="{{ url('register') }}" onsubmit="return validateForm()" id="myform">
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" id="token" />
            <h1>Member Registration</h1><small></small><hr>
            <!-- <hr class="colorgraph"> -->
            <div class="form-group">
                <label><h3>Name</h3></label>
                <input type="text" onkeyup="validNama(this)" name="name" id="name" class="form-control input-lg" placeholder="" tabindex="4" style="background-color:white;">
            </div>
            <div class="form-group">
                <label><h3>Email Address</h3></label>
                <input type="text" name="email" id="email" class="form-control input-lg" placeholder="" tabindex="4" style="background-color:white;">
            </div>
            <div class="form-group">
                <label><h3>Password</h3></label>
                <input type="password" name="password" id="password" class="form-control input-lg" placeholder="" tabindex="4" style="background-color:white;">
            </div>
            <div class="row">
                <div class="col-xs-10 col-sm-6 col-md-6">
                    <label><h3>Phone Number</h3></label>
                    <input type="text" onkeyup="validAngka(this)" name="phone" id="phone" class="form-control input-lg" placeholder="" tabindex="4" style="background-color:white;">
                </div>
                <div class="col-xs-10 col-sm-6 col-md-6">
                    <label><h3>Birthdate</h3></label>
                    <input type="text" name="birthdate" id="datepicker" class="form-control input-lg birthdategan iconbirth" placeholder="" tabindex="4" style="background-color:white;">
                </div>
            </div><br>
            <!-- <div class="row"> -->
                <!-- <div class="col-xs-12 col-md-12">
                    <input type="checkbox" name='terms' id='terms'>&nbsp;Please tick box to agree with terms and conditions
                </div> -->
                <!-- <div class="col-xs-12 col-md-12">
                     By clicking <strong class="label label-primary">Register</strong>, you agree to the Travel Jinni Terms of Service, Privacy Policy, Guest Refund Policy, and Host Guarantee Terms.
                </div> -->
            <!-- </div> -->
            <br>
            <div class="row">
                <!-- <div class="col-xs-10 col-sm-6 col-md-6">
                    <span class="button-checkbox">
                        <button type="button" class="btn" data-color="info" tabindex="7">I Agree</button>
                        <input type="checkbox" name="t_and_c" id="t_and_c" class="hidden" value="1">
                    </span>
                </div> -->
                <div class="col-xs-10 col-sm-6 col-md-6">
                    <h3><div class="g-recaptcha" data-sitekey="6LcnYgoUAAAAABG5sRbNwEEPq8-65bQwey41Ho7N" style="transform:scale(0.92);-webkit-transform:scale(0.92);transform-origin:0 0;-webkit-transform-origin:0 0;"></div></h3>
                </div>
                <div class="col-xs-10 col-sm-6 col-md-6">
                     <p align="justify"><h4>By clicking <strong style="background-color:#095668;" class="label label-primary">Register</strong>, you agree to the Travel Jinni Terms of Service, Privacy Policy and Guest Refund Policy.</h4></p>
                </div>
            </div>
            <!-- <hr class="colorgraph"> --><br>
            <div class="row">
                <div class="col-xs-5 col-md-5">
                    <h1><input type="submit" value="Register" style="background-color:#095668;" class="btn btn-primary btn-block btn-lg btn-tj" tabindex="7"></h1>
                </div>
                <div class="col-xs-5 col-md-7">
                <h3><div id="fillouts" class="alert-danger"></div></h3>
                </div>
            </div>
        </form>
    </div>
</div>

</div><p>&nbsp;</p><p>&nbsp;</p>

</body>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

</html>
@endsection
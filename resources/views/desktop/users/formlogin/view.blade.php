@extends("layout.userLayout")
@section('content')
<html>
<head>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script src="{{ URL::asset('frontassets/reg1/style.js') }}"></script>
<link rel="stylesheet" href="{{ URL::asset('frontassets/reg1/style.css') }}">

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
function validasi()
    {
        var username=document.forms["myforms"]["username"].value;
        var password=document.forms["myforms"]["password"].value;
        if (username==null || username=="")
          {
            var infoerror =("Email Can't Empty");
            document.getElementById("fillouts").innerHTML =infoerror;
            return false;
          };

        if ((username.indexOf('@',0)==-1) || (username.indexOf('.',0)==-1))
            { 
            var infoerror =("Wrong Email Format");
            document.getElementById("fillouts").innerHTML =infoerror;
            return false;
          };

        if (password==null || password=="")
          {
            var infoerror =("Password Can't Empty");
            document.getElementById("fillouts").innerHTML =infoerror;
            return false;
          };
     }
</script>

</head>
<body style="font-family: 'MontserratFont'">


<div class="container">


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
    <div class="col-xs-8 col-sm-6 col-md-6 col-sm-offset-2 col-md-offset-3">
        <form method="post" action="{{ url('login') }}" onSubmit="return validasi()" id="myforms">
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" id="token" />
            <h1>Member Login</h1><small><h3><div id="fillouts" class="alert-danger"></div></h3></small>
            <hr>
            <!-- <div class="form-group">
                Access your account information and manage your bookings.<br>Remember, password are case sensitive.
            </div> -->
            
            <div class="form-group">
                <label><h3>Email</h3></label>
                <input type="text" name="username" id="username" class="form-control input-lg" placeholder="" tabindex="4" style="background-color:white;">
            </div>
            <div class="form-group">
                <label><h3>Password</h3></label>
                <input type="password" name="password" id="password" class="form-control input-lg" placeholder="" tabindex="4" style="background-color:white;">
            </div>
            
            <div class="row">

                <div class="col-xs-10 col-md-4">
                    <input style="background-color:#095668;" type="submit" value="Login" class="btn btn-primary btn-block btn-lg btn-tj" tabindex="7">
                </div>
                <div class="col-xs-10 col-md-5">
                    <a href="forgotpassword" style="background-color:#095668;" class="btn btn-primary btn-block btn-lg btn-tj" tabindex="7">Forgot Password</a>
                </div> 

            </div>

        </form>
    </div>
</div>

</div>
<p>&nbsp;</p>



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
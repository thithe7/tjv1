@extends('layout.userLayout')
@section('content')
<link href="{{ URL::asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
<!-- BEGIN SLIDER -->
<div class="page-slider" style="margin-top: -23px;">
    <div id="carousel-example-generic" class="carousel slide carousel-slider">
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <!-- First slide -->
            <div class="item active" style="background: url({{{ URL::asset('assets/images/Top.jpg') }}})">
                <div class="container">
                    <!-- TABS -->
                    <div class="tab-style-1" style="margin-top: 300px;">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab-rooms" data-toggle="tab">Rooms</a></li>
                            <li><a href="#tab-deals" data-toggle="tab">Deals</a></li>
                        </ul>
                        <div class="tab-content">
                            <form method="get" action="{!! url('search-hotel') !!}">
                                <div class="tab-pane row fade in active" id="tab-rooms">
                                    <div class="col-md-4 col-sm-6">
                                        <div class="input-group">
                                            <label>Where</label>
                                            <input type="text" id="autocomplete" class="form-control" name="destination" placeholder="Where would you like to go?">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="input-group">
                                            <label>When</label>
                                            <input type="text" class="form-control" name="when" id="when" placeholder="When are you going?">
                                            <input type="hidden" class="form-control" name="checkin">
                                            <input type="hidden" class="form-control" name="checkout">
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-sm-3">
                                        <div class="input-group">
                                            <label>Breakfast</label>
                                            <input id="breakfast2" onchange="return klik();" type="checkbox" class="make-switch" data-on-text="<i class='fa fa-check'></i>" data-off-text="<i class='fa fa-times'></i>">
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-sm-3">
                                        <div class="input-group">
                                            <label>Amenities</label>
                                            <input id="amenities2" onchange="return klik2();" type="checkbox" class="make-switch" data-on-text="<i class='fa fa-check'></i>" data-off-text="<i class='fa fa-times'></i>">
                                        </div>
                                    </div>
                                    <input name="breakfast" id="breakfast" class="form-control" type="hidden" value="">
                                    <input name="amenities" id="amenities" class="form-control" type="hidden" value="">
                                    <div class="col-md-2 col-sm-6">
                                        <div class="input-group">
                                            <!-- <label>&nbsp;</label> -->
                                            <button type="submit" class="btn btn-tj trigger-search" name="" style="width: 100%; height: 57px; font-size: 25px;"><i class="fa fa-search"></i> Search</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="tab-pane row fade in" id="tab-deals">
                                <div class="col-md-4 col-sm-6">
                                    <div class="input-group">
                                        <label>Where</label>
                                        <input type="text" class="form-control" name="" placeholder="Where would you like to go?">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="input-group">
                                        <label>When</label>
                                        <input type="text" class="form-control" name="when" id="when" placeholder="When are you going?">
                                        <input type="hidden" class="form-control" name="checkin">
                                        <input type="hidden" class="form-control" name="checkout">
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-6">
                                    <div class="input-group">
                                        <label>Category</label>
                                        <select class="form-control">
                                            <option value="all">All</option>
                                            <option value="hotel">Hotel</option>
                                            <option value="spa">Spa</option>
                                            <option value="resto">Resto</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-6">
                                    <div class="input-group">
                                        <!-- <label>&nbsp;</label> -->
                                        <button type="button" class="btn btn-tj trigger-search" name="" style="width: 100%; height: 57px; font-size: 25px;"><i class="fa fa-search"></i> Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SLIDER -->
<img src="{{{ URL::asset('assets/images/Mid.png') }}}">
<script src="{{ URL::asset('theme/users/plugins/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/plugins/bootstrap-daterangepicker/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    // $(document).on('click', '.trigger-search', function(){
    //     window.location.href = 'search-hotel?destination=Denpasar%2C+Bali%2C+Indonesia&checkin=02%2F12%2F2016&checkout=03%2F12%2F2016&breakfast=&amenities=';
    // });
    var valid_from = new Date();
    //alert(valid_from);
    $('input[name="when"]').daterangepicker({
        autoUpdateInput: false,
        startDate: valid_from,
        minDate: valid_from,
        locale: {
            format: 'DD MMMM YYYY',
            "separator": " - "
        },
        "autoApply": true
    }, function(start, end, label) {
        $('input[name="checkin"]').val(start.format('YYYY-MM-DD'));
        $('input[name="checkout"]').val(end.format('YYYY-MM-DD'));
        $('input[name="when"]').val(start.format('DD MMMM YYYY')+' - '+end.format('DD MMMM YYYY'));
    });

    function klik(){
        if(document.getElementById("breakfast2").checked){
            $("#breakfast").val('breakfast');
        }
        else{
            $("#breakfast").val('');
        }
    }
    function klik2(){    
        if(document.getElementById("amenities2").checked){
            $("#amenities").val('amenities');
        }
        else{
            $("#amenities").val('');
        }
    }
</script>
@endsection
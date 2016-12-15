@extends('layout.userLayout')
@section('content')
@section('css')
<link href="{{ URL::asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
<link href="{{ URL::asset('theme/users/corporate/css/search-custom.css') }}" rel="stylesheet"/>
@endsection
<div class="page-slider page-slider-custom">
    <div id="carousel-example-generic" class="carousel slide carousel-slider">
        <div class="container container-custom">
            <br>
            <div class="col-md-3">
                <div class="filter-list-header div-styles">
                    <h3>Modify Search</h3>
                </div>
                <form method="get" action="{!! url('search-hotel') !!}">
                    <input name="breakfast" id="breakfast" class="form-control" type="hidden" value="{{$breakfast}}">
                    <input name="amenities" id="amenities" class="form-control" type="hidden" value="{{$amenities}}">

                    <div class="input-group">
                        <label>Change Your Destination ?</label>
                        <input type="text" id="autocomplete" class="form-control" name="destination" type="text" value="{{$destination}}">
                    </div>
                    <br>
                    <div class="input-group">
                        <label>When</label>
                        <input type="text" class="form-control" name="when" id="when" placeholder="When are you going?" value="{{$when}}" readonly="readonly">
                        <input type="hidden" class="form-control" name="checkin" id="checkin" value="{{$cekin}}">
                        <input type="hidden" class="form-control" name="checkout" id="checkout" value="{{$cekout}}">
                    </div>
                    <br>
                    <div class="input-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Breakfast</label>
                            </div>
                            <div class="col-md-2">
                                <a href="{!! url('breakfast') !!}" target="_BLANK"><img src="{{ URL::asset('assets/images/help.png') }}" width="18px;" height="18px;"></a>
                            </div>
                            <div class="col-md-4">
                                <input id="breakfast2" @if($breakfast!="") checked="checked" @endif onchange="return klik();" type="checkbox" class="make-switch" data-on-text="<i class='fa fa-check'></i>" data-off-text="<i class='fa fa-times'></i>">
                            </div>
                        </div>                        
                    </div>
                    <br>
                    <div class="input-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Amenities</label>
                            </div>
                            <div class="col-md-2">
                                <a href="{!! url('amenities') !!}" target="_BLANK"><img src="{{ URL::asset('assets/images/help.png') }}" width="18px;" height="18px;"></a>
                            </div>
                            <div class="col-md-4 pull-left">
                                <input id="amenities2" @if($amenities!="") checked="checked" @endif onchange="return klik2();" type="checkbox" class="make-switch" data-on-text="<i class='fa fa-check'></i>" data-off-text="<i class='fa fa-times'></i>">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="input-group">
                        <button class="btn btn-primary btn-block btn-lg search-submit_filter btn-tj trigger-search tj-custom-btn">Search</button>
                    </div>
                </form>
                <br>
                <br>
                <div class="filter-list">
                    <div class="filter-list-header div-styles">
                        <h3>Filter Search</h3>
                    </div>
                    <input name="breakfast" id="breakfast" class="form-control" type="hidden" value="{{$breakfast}}">
                    <input name="amenities" id="amenities" class="form-control" type="hidden" value="{{$amenities}}">

                    <div class="input-group">
                        <label>Hotel Name</label>
                        <input id="hotel_name" name="hotel_name" class="form-control" type="text" value="">
                    </div>
                    <br>
                    <div class="input-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Price Range</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                Min Price
                            </div>
                            <div class="col-md-6">
                                Max Price
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <input type='hidden' class="form-control number" value="0" name='amount' id="amountmin" onkeyup="return rangeslider();">
                            </div>
                            <div class="col-md-6">
                                <input type='hidden' class="form-control number" value="{{$getdata['hargamaks']}}" name='amount2' id="amountmax" onkeyup="return rangeslider();">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <input type='text' class="form-control number" value="0" name='tampilamount' id="tampilamountmin" onClick="this.setSelectionRange(0, this.value.length)">
                            </div>
                            <div class="col-md-6">
                                <input type='text' class="form-control number" value="{{$getdata['hargamaks']}}" name='tampilamount2' id="tampilamountmax" onClick="this.setSelectionRange(0, this.value.length)">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div id="slider-range"></div>
                            </div>
                        </div>

                        <input type='hidden' id="maxharga" name='maxharga' value="{{$getdata['hargamaks']}}">
                    </div>
                    <br>
                    <div class="input-group">
                        <label>Star Rating</label>
                        <br>
                        <label>
                            <input type="checkbox" class="checkhome" name="star_rating5" id="star_rating5" value="1" checked /> &nbsp;&nbsp;&nbsp;
                            <i class="fa fa-star star-active-custom" title="5 star"></i>
                            <i class="fa fa-star star-active-custom" title="5 star"></i>
                            <i class="fa fa-star star-active-custom" title="5 star"></i>
                            <i class="fa fa-star star-active-custom" title="5 star"></i>
                            <i class="fa fa-star star-active-custom" title="5 star"></i>
                        </label>
                        <br>
                        <label>
                            <input type="checkbox" class="checkhome" name="star_rating4" id="star_rating4" value="1" checked/> &nbsp;&nbsp;&nbsp;
                            <i class="fa fa-star star-active-custom" title="4 star"></i>
                            <i class="fa fa-star star-active-custom" title="4 star"></i>
                            <i class="fa fa-star star-active-custom" title="4 star"></i>
                            <i class="fa fa-star star-active-custom" title="4 star"></i>
                            <i class="fa fa-star-o star-nonactive-custom"></i>
                        </label>
                        <br>
                        <label>
                            <input type="checkbox" class="checkhome" name="star_rating3" id="star_rating3" value="1" checked/> &nbsp;&nbsp;&nbsp;
                            <i class="fa fa-star star-active-custom" title="3 star"></i>
                            <i class="fa fa-star star-active-custom" title="3 star"></i>
                            <i class="fa fa-star star-active-custom" title="3 star"></i>
                            <i class="fa fa-star-o star-nonactive-custom"></i>
                            <i class="fa fa-star-o star-nonactive-custom"></i>
                        </label>
                        <br>
                        <label>
                            <input type="checkbox" class="checkhome" name="star_rating2" id="star_rating2" value="1" checked/> &nbsp;&nbsp;&nbsp;
                            <i class="fa fa-star star-active-custom" title="2 star"></i>
                            <i class="fa fa-star star-active-custom" title="2 star"></i>
                            <i class="fa fa-star-o star-nonactive-custom"></i>
                            <i class="fa fa-star-o star-nonactive-custom"></i>
                            <i class="fa fa-star-o star-nonactive-custom"></i>
                        </label>
                        <br>
                        <label>
                            <input type="checkbox" class="checkhome" name="star_rating1" id="star_rating1" value="1" checked/> &nbsp;&nbsp;&nbsp;
                            <i class="fa fa-star star-active-custom" title="1 star"></i>
                            <i class="fa fa-star-o star-nonactive-custom"></i>
                            <i class="fa fa-star-o star-nonactive-custom"></i>
                            <i class="fa fa-star-o star-nonactive-custom"></i>
                            <i class="fa fa-star-o star-nonactive-custom"></i>
                        </label>
                        <br>
                        <label>
                            <input type="checkbox" class="checkhome" name="star_rating0" id="star_rating0" value="1" checked/> &nbsp;&nbsp;&nbsp;
                            Unrated
                        </label>
                    </div>
                    <br>
                    <div class="input-group">
                        <button class="btn btn-primary btn-block btn-lg search-submit_filter btn-tj trigger-search tj-custom-btn">Filter</button>
                    </div>
                </div>
            </div>
            <br>
            <div class="col-md-9 paddingsetup">
                <div id="content">
                </div>
            </div>
            <br>
            <div class="col-md-9">
                <input type="hidden" id="page" value="1" />
                <input type="hidden" id="max_page" value="{{$getdata['totalPages']}}" />
                <div id="end_of_page" class="center">
                    <hr/>
                    <span></span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('jsfile')
<script src="{{ URL::asset('assets/plugins/bootstrap-daterangepicker/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>
@endsection
@section('jsload')
<script>
    /**
    * Programmer   : Thithe
    * Tanggal      : 08-12-2016
    * Fungsi       : fungsi date range picker
    * Tipe         : create
    */
    var valid_from = new Date();
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

    /**
    * Programmer   : Thithe
    * Tanggal      : 08-12-2016
    * Fungsi       : fungsi jika breakfast diklik
    * Tipe         : create
    */
    function klik(){
        if(document.getElementById("breakfast2").checked){
            $("#breakfast").val('breakfast');
        }
        else{
            $("#breakfast").val('');
        }
    }

    /**
    * Programmer   : Thithe
    * Tanggal      : 08-12-2016
    * Fungsi       : fungsi jika amenitis diklik
    * Tipe         : create
    */
    function klik2(){    
        if(document.getElementById("amenities2").checked){
            $("#amenities").val('amenities');
        }
        else{
            $("#amenities").val('');
        }
    }

    var outerPane = $('#content'),
    didScroll = false;

    $(window).scroll(function() {
        didScroll = true;
    });

    setInterval(function() {
        if (didScroll) {
            didScroll = false;
            if (($(document).height() - $(window).height()) - $(window).scrollTop() < 5) {
                pageCountUpdate();
            }
        }
    }, 250);

    /**
    * Programmer   : Thithe
    * Tanggal      : 13-12-2016
    * Fungsi       : fungsi change slider dari text
    * Tipe         : create
    */
    function rangeslider() {
        var nilai1=parseInt($("#amountmin").val());
        var nilai2=parseInt($("#amountmax").val());
        var maxharga=parseInt($('#maxharga').val());
        var amountmax = $('#amountmax').val();
        $('#tampilamountmax').val(amountmax.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
        if(nilai1>nilai2){
            nilai1=nilai2;
            $("#amountmin").val(nilai1);
        }
        if(nilai1>maxharga){
            nilai1=maxharga;
            $("#amountmin").val(nilai);
        }
        if(nilai2>maxharga){
            nilai2=maxharga;
            $("#amountmax").val(nilai2);
        }
        $(function() {
            $("#slider-range").slider({
                range: true,
                min: 0,
                max: $('#maxharga').val(),
                values: [0, $('#maxharga').val()],
                slide: function(event, ui) {
                    $("#amount").val("IDR. " + ui.values[0] + " - IDR. " + ui.values[1]);
                    $("#amountmin").val(ui.values[0]);
                    var amountmin = $('#amountmin').val();
                    $('#tampilamountmin').val(amountmin.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
                    $("#amountmax").val(ui.values[1]);
                    var amountmax = $('#amountmax').val();
                    $('#tampilamountmax').val(amountmax.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
                }
            });
            $("#amount").val("IDR. " + nilai1 + " - IDR. " + nilai2);
            if(nilai1>0){
                $("#slider-range").slider('values',0,nilai1);
            }
            if(nilai2<maxharga){
                $("#slider-range").slider('values',1,nilai2);
            }
        }); 
    }

    /**
    * Programmer   : Thithe
    * Tanggal      : 08-12-2016
    * Fungsi       : fungsi update page
    * Tipe         : create
    */
    function pageCountUpdate() {
        var page = parseInt($('#page').val());
        var max_page = parseInt($('#max_page').val());
        if (page < max_page) {
            $('#page').val(page + 1);
            getPosts();
            $('#end_of_page').hide();
        } else {
            $('#end_of_page').fadeIn();
        }
    }

    /**
    * Programmer   : Thithe
    * Tanggal      : 08-12-2016
    * Fungsi       : fungsi update content
    * Tipe         : create
    */
    function getPosts() {
        var page = parseInt($('#page').val());
        var breakfast = $('#breakfast').val();
        var amenities = $('#amenities').val();
        var checkin = $('#checkin').val();
        var checkout = $('#checkout').val();
        $.ajax({
            type: "get",
            url: '{!!url("search-tampil/")!!}?destination={{$_GET["destination"]}}&checkin=' + checkin + '&checkout=' + checkout + '&breakfast=' + breakfast + '&amenities=' + amenities, 
            data: {
                page: page
            },
            beforeSend: function() { 
                $('#content').append("<div id='loading' class='center'>Loading news items...</div>");
            },
            complete: function() { 
                $('#loading').remove();
            },
            success: function(html) { 
                $('#content').append(html);
            }
        });
    } 

    /**
    * Programmer   : Thithe
    * Tanggal      : 08-12-2016
    * Fungsi       : fungsi ammbil data ke controller
    * Tipe         : create
    */
    function getData(tipe){
        $('#content').html();
        var data = "";
        $("#content").hide().html(data).fadeIn('fast');
        var container = document.getElementById("content");
        var content = container.innerHTML;
        container.innerHTML = content;
        $('#page').val('1');
        var page = parseInt($('#page').val());
        var breakfast = $('#breakfast').val();
        var amenities = $('#amenities').val();
        var checkin = $('#checkin').val();
        var checkout = $('#checkout').val();

        $hotel_name = $('input[name=hotel_name]').val();
        $c0 = $('input[name=star_rating0]').prop('checked');
        $c1 = $('input[name=star_rating1]').prop('checked');
        $c2 = $('input[name=star_rating2]').prop('checked');
        $c3 = $('input[name=star_rating3]').prop('checked');
        $c4 = $('input[name=star_rating4]').prop('checked');
        $c5 = $('input[name=star_rating5]').prop('checked');
        $amountstatus = $('input[name=amountstatus]').prop('checked');
        $amount = $("#amountmin").val();
        $amount2 = $("#amountmax").val();

        if ($c0 == true) $s0 = "0,-1,";
        else $s0 = "";

        if ($c1 == true) $s1 = "1,";
        else $s1 = "";

        if ($c2 == true) $s2 = "2,";
        else $s2 = "";

        if ($c3 == true) $s3 = "3,";
        else $s3 = "";

        if ($c4 == true) $s4 = "4,";
        else $s4 = "";

        if ($c5 == true) $s5 = "5,";
        else $s5 = '';

        if ($amountstatus == true) $amountstatus = "1";
        else $amountstatus = "0";

        $star = $s5 + '' + $s4 + '' + $s3 + '' + $s2 + '' + $s1 + '' + $s0;

        $.ajax({
            type: "get",
            url: '{!!url("search-tampil/")!!}?destination={{$_GET["destination"]}}',
            data: {
                page: page,
                checkin: checkin,
                checkout: checkout,
                breakfast: breakfast,
                amenities: amenities,
                hotel_name: $hotel_name,
                amount: $amount,
                amount2: $amount2,
                star: $star,
                tipe: tipe,
            },
            beforeSend: function() { 
                $('#content').append("<div id='loading' class='center'>Loading news items...</div>");
            },
            complete: function() { 
                $('#loading').remove();
            },
            success: function(html) { 
                $('#content').append(html);
            }
        });
    }

    $(document).ready(function() {
        var tipe='search';
        getData(tipe);
        rangeslider();

        /**
        * Programmer   : Thithe
        * Tanggal      : 08-12-2016
        * Fungsi       : fungsi filter search
        * Tipe         : create
        */
        $('body').on('click', '.search-submit_filter', function() {
            var tipe='filter';
            getData(tipe);
        });
        
        /**
        * Programmer   : Thithe
        * Tanggal      : 14-12-2016
        * Fungsi       : fungsi setting format money number dan setting ke slider min price
        * Tipe         : create
        */
        $('body').on('keyup', '#tampilamountmin', function() {
            // skip for arrow keys
            if(event.which >= 37 && event.which <= 40){
                event.preventDefault();
            }
            
            var checkval0 = $(this).val();
            var res = checkval0.substring(0,1);
            if( res == "0"){
                $(this).val(0);
            }

            $(this).val(function(index, value) {
                return value
                .replace(/\D/g, "")
                .replace(/([0-9])([0-9]{0})$/, '$1')  
                .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",")
                ;
            });
            var a = $(this).val();
            a=a.replace(/\,/g,'');
            a=parseInt(a,10);    
            $('#amountmin').val(a);

            var nilai1=parseInt($("#amountmin").val());
            var nilai2=parseInt($("#amountmax").val());
            var maxharga=parseInt($('#maxharga').val());
            if(nilai1>nilai2){
                nilai1=nilai2;
                $("#amountmin").val(nilai1);

                var amountmin = $('#amountmin').val();
                $('#tampilamountmin').val(amountmin.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
                toastr.error("Min Price Can't higher Than Max Price");
            }
            if(nilai1>maxharga){
                nilai1=maxharga;
                $("#amountmin").val(nilai);

                var amountmin = $('#amountmin').val();
                $('#tampilamountmin').val(amountmin.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
            }

            $("#slider-range").slider('values',0,nilai1);

        });

        /**
        * Programmer   : Thithe
        * Tanggal      : 14-12-2016
        * Fungsi       : fungsi setting format money number dan setting ke slider max price
        * Tipe         : create
        */
        $('body').on('keyup', '#tampilamountmax', function() {
            // skip for arrow keys
            if(event.which >= 37 && event.which <= 40){
                event.preventDefault();
            }

            var checkval0 = $(this).val();
            var res = checkval0.substring(0,1);
            if( res == "0"){
                $(this).val(0);
            }           
            
            $(this).val(function(index, value) {
                return value
                .replace(/\D/g, "")
                .replace(/([0-9])([0-9]{0})$/, '$1')  
                .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",")
                ;
            });
            var a = $(this).val();
            a=a.replace(/\,/g,'');
            a=parseInt(a,10);
            
            $('#amountmax').val(a);

            var nilai1=parseInt($("#amountmin").val());
            var nilai2=parseInt($("#amountmax").val());
            var maxharga=parseInt($('#maxharga').val());
            if(nilai1>nilai2){
                nilai2=nilai1;
                $("#amountmax").val(nilai1);
                var amountmax = $('#amountmax').val();
                $('#tampilamountmax').val(amountmax.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
                toastr.error("Max Price Can't Smaller Than Min Price");
            }
            if(nilai2>maxharga){
                nilai2=maxharga;
                $("#amountmax").val(nilai2);
                
                var amountmax = $('#amountmax').val();
                $('#tampilamountmax').val(amountmax.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
            }

            $("#slider-range").slider('values',1,nilai2);

        });
    });
</script>

@endsection
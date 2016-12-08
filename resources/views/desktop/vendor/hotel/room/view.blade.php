@extends("layout.vendorLayout")

@section('content')
<style>
    .datepicker {
        z-index: 1200 !important;
    }
</style>
<section class="content-header">
    <h1>Room Setup</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Hotel</a></li>
        <li class="active">Room Setup</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form role="form-horizontal" action="{!! url('/supplier/tjvendorrate/newrate') !!}" method="POST" id="formrate">
                    <input type="hidden" name="hiddenhandletable" id="hiddenhandletable" value="">
                    <input type="hidden" name="_token" id="token" value="{!! csrf_token() !!}">
                    <input type="hidden" id="id_hotel_rate" name="id_hotel_rate">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Room Setup</h3>
                        </div>
                        <div class="box-body">
                            <table id="hotelpromo" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Room Name</th>
                                        <th>Validity</th>
                                        <th>Action</th>
                                        <th>Action Stop Sale<br>
                                            <button id="allstopsaletbutton" type="button" class="btn btn-flat btn-xs alladd-stopsale btn-success"><i class="fa fa-plus">Stop Sale All Room</i></button><br>
                                            <button id="allcancelsaletbutton" type='button' data-id="" class='btn btn-flat btn-xs btn-danger cancel_stop_sale'><i class='fa fa-plus'>Cancel Stop Sale All Room Today</i></button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>


<div id="myModal2" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form role="form-horizontal" action="{!! url('/tjvendor/room/newallotment') !!}" method="POST" id="formrates2">
            <input type="hidden" name="_token" id="token" value="{!! csrf_token() !!}">

            <div class="nav-tabs-custom" style="width: 900px;">
                <ul class="nav nav-pills">
                    <li class="active"><a href="#hotel" data-toggle="tab">Monthly</a></li>
                    <li><a href="#room" data-toggle="tab">daily</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="hotel">
                        <section id="new">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Hotel</h3>
                                </div>
                                <div class="box-body">
                                    <div class="collapse" id="newrate" name="newrate">
                                        <div class="box">
                                            <div class="box-header">
                                                <button type="button" class="close tutup" data-dismiss="modal">&times;</button>
                                                <h3 class="box-title"></h3>
                                            </div>
                                            <div class="box-body">
                                                <table id="hotelroom" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Room Name</th>
                                                            <th>Allotment</th>
                                                            <th>Max Allotment PerDay</th>
                                                            <th>Allotment Date</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="tab-pane" id="room">
                        <section id="new">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Hotel Room</h3>
                                </div>
                                <div class="box-header">
                                    <button type="button" class="close tutup" data-dismiss="modal">&times;</button>
                                    <h3 class="box-title"></h3>
                                </div>
                                <div class="box-body">
                                    <table id="hotelroomdaily" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Allotment</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="tab-pane" id="price">

                        <section id="new">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Hotel Price</h3>
                                </div>
                                <div class="box-body">
                                </div>
                                <div class="box-footer">
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
            <div class="collapse2" id="newrate2" name="newrate2">
                <div class="box box-primary" style="width: 900px;">
                    <div class="box-header with-border">
                        <button type="button" class="close tutup" data-dismiss="modal">&times;</button>
                        <h3 class="box-title judul"></h3>
                    </div>
                    <div class="box-body">
                        <input type="hidden" name="id_room" id="id_contract3" class="form-control">
                        <input type="hidden" name="mode_form" id="mode_form2" class="form-control" value="tambah">
                        <input type="hidden" name="id_allotment" id="id_allotment" class="form-control">
                        <input type="hidden" id="type_allotment" name="type" value="day">
                        <table>
                            <tbody>
                                <tr>
                                    <td width="20%"></td>
                                    <td width="40%"><br></td>
                                </tr>
                                <tr id="day">
                                    <td width="20%">Select date Date</td>
                                    <td width="40%">
                                        <div class="form-group" style="width: 150px">
                                            <div class="input-group">
                                                <input type="text" class="rate form-control" id="validity_day" name="validity_day" readonly required>
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar pull-left">
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="month1">
                                    <td width="20%">From Date</td>
                                    <td width="40%">
                                        <div class="form-group" style="width: 150px">
                                            <div class="input-group">
                                                <input readonly="readonly" type="text" class="rate form-control" id="validity_from3" name="validity_from" readonly required>
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar pull-left">
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="month2">
                                    <td width="20%">To Date</td>
                                    <td width="40%">
                                        <div class="form-group" style="width: 150px">
                                            <div class="input-group">
                                                <input readonly="readonly" type="text" class="rate form-control" id="validity_to3" name="validity_to" readonly required>
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar pull-left">
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="20%">Allotment</td>
                                    <td width="40%"><input readonly="readonly" type="text" name="sallotment" id="sallotment" class="form-control number"></td>
                                </tr>
                                <tr>
                                    <td width="20%"></td>
                                    <td width="40%"><br></td>
                                </tr>
                                <tr>
                                    <td width="20%">Max Allotment Per Day</td>
                                    <td width="40%"><input type="text" name="max_sallotment" id="max_sallotment" class="form-control number"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer">
                        <button type="button" class="btn btn-default btn-close2 pull-left">Cancel</button>
                        <button type="button" class="btn btn-primary pull-right btn-save2">save</button>
                    </div>
                </div>
            </div>
            <div class="collapsedaily" id="collapsedaily" name="collapsedaily">
                <div class="box box-primary" style="width: 900px;">
                    <div class="box-header with-border">
                        <button type="button" class="close tutup" data-dismiss="modal">&times;</button>
                        <h3 class="box-title judul"></h3>
                    </div>
                    <div class="box-body">
                        <input type="hidden" name="id_daily" id="id_daily" class="form-control">
                        <input type="hidden" name="priment" id="priment" class="form-control">
                        <table>
                            <tbody>
                                <tr>
                                    <td width="20%"></td>
                                    <td width="40%"><br></td>
                                </tr>
                                <tr id="month2">
                                    <td width="20%">To Date</td>
                                    <td width="40%">
                                        <div class="form-group" style="width: 150px">
                                            <div class="input-group">
                                                <input readonly="readonly" type="text" class="rate form-control" id="validity_daily" name="validity_daily" readonly required>
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar pull-left">
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="20%">Value</td>
                                    <td width="40%"><input type="text" name="sallotment_daily" id="sallotment_daily" class="form-control number"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer">
                        <button type="button" class="btn btn-default btn-close2 pull-left">Cancel</button>
                        <button type="button" class="btn btn-primary pull-right btn-save4">save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<div id="myModal3" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form role="form-horizontal" action="{!! url('/tjvendor/room/newstopsale') !!}" method="POST" id="formrates3">
            <input type="hidden" name="_token" id="token" value="{!! csrf_token() !!}">
            <div class="collapse" id="newrate" name="newrate">
                <div class="box" style="width: 900px;">
                    <div class="box-header">
                        <button type="button" class="close tutup" data-dismiss="modal">&times;</button>
                        <h3 class="box-title"></h3>
                    </div>
                    <div class="box-body">
                        <table id="hotelstopsell" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Room Name</th>
                                    <th>Date From </th>
                                    <th>Date to </th>
                                    <th>Status Stop Sale </th>
                                    <th><button id="stopsaletbutton" type='button' data-id="" class='btn btn-flat btn-xs btn-block add-stopsale btn-success'><i class='fa fa-plus'>Add Stop Sale</i></button>
                                        <button id="cancel_stop_sale" type='button' data-id="" class='btn btn-flat btn-xs btn-block btn-danger cancel_stop_sale'><i class='fa fa-plus'>Cancel Stop Sale Today</i></button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="collapse2" id="newrate2" name="newrate2">
                <div class="box box-primary" style="width: 900px;">
                    <div class="box-header with-border">
                        <button type="button" class="close tutup" data-dismiss="modal">&times;</button>
                        <h3 class="box-title judul"></h3>
                    </div>
                    <div class="box-body">
                        <input type="hidden" name="id_room" id="id_room3" class="form-control">
                        <input type="hidden" name="mode_form" id="mode_form3" class="form-control" value="tambah">
                        <input type="hidden" name="id_allotment" id="id_allotment" class="form-control">
                        <input type="hidden" id="type_allotment" name="type" value="day">
                        <table>
                            <tbody>
                            <tr>
                                <td width="20%"></td>
                                <td width="40%"><br></td>
                            </tr>

                            <tr id="month1">
                                <td width="20%">From Date</td>
                                <td width="40%">
                                    <div class="form-group" style="width: 150px">
                                        <div class="input-group">
                                            <input readonly="readonly" type="text" class="rate form-control" id="validity_from4" name="stop_from" readonly required>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar pull-left">
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr id="month2">
                                <td width="20%">To Date</td>
                                <td width="40%">
                                    <div class="form-group" style="width: 150px">
                                        <div class="input-group">
                                            <input readonly="readonly" type="text" class="rate form-control" id="validity_to4" name="stop_to" readonly required>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar pull-left">
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    <button type="button" class="btn btn-default btn-close2 pull-left">Cancel</button>
                    <button type="button" class="btn btn-primary pull-right btn-save3">save</button>
                </div>
            </div>
        </div>
    </form>
</div>
</div>

<div id="myModal4" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title judul"></h4>
            </div>
            <div class="modal-body">
                <form role="form-horizontal" action="{!! url('/tjvendor/room/newstopsale') !!}" method="POST" id="formrates4">
                    <input type="hidden" name="_token" id="token" value="{!! csrf_token() !!}">
                    <input type="hidden" name="id_room" id="id_room4" class="form-control">
                    <input type="hidden" name="mode_form" id="mode_form3" class="form-control" value="tambah">
                    <input type="hidden" name="id_allotment" id="id_allotment" class="form-control">
                    <input type="hidden" id="type_allotment" name="type" value="day">
                    <table>
                        <tbody>
                            <tr>
                                <td width="20%"></td>
                                <td width="40%"><br></td>
                            </tr>
                            <tr id="month1">
                                <td width="20%">From Date</td>
                                <td width="40%">
                                    <div class="form-group" style="width: 150px">
                                        <div class="input-group">
                                            <input readonly="readonly" type="text" class="rate form-control" id="validity_from5" name="stop_from" readonly required>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar pull-left">
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr id="month2">
                                <td width="20%">To Date</td>
                                <td width="40%">
                                    <div class="form-group" style="width: 150px">
                                        <div class="input-group">
                                            <input readonly="readonly" type="text" class="rate form-control" id="validity_to5" name="stop_to" readonly required>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar pull-left">
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-close2 pull-left">Cancel</button>
                        <button type="button" class="btn btn-primary pull-right btn-save4allroom">save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ URL::asset('theme/admin/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script>
    $(document).ready(function() {
        <?php if(Session::get('success')) { ?>
        toastr.success("<?php echo Session::get('success'); ?>");
        <?php } else if(Session::get('failed')) { ?>
        toastr.warning("<?php echo Session::get('failed'); ?>");
        <?php } ?>
        $("#month1").hide();
        $("#month2").hide();
        $('.collapsedaily').hide();
        $('.collapse2').hide();

        var InitController = function() {
            var handleValidation = function() {
                /**
                 * Programmer   : Thithe
                 * Tanggal      : 05-12-2016
                 * Fungsi       : memunculkan form allotment saat button dengan class add-allotment diklik
                 * Tipe         : create
                 */
                $('body').on('click', '.add-allotment', function() {
                    $("#type").hide();
                    $("#type_allotment").val("day");
                    $("#day").show();
                    $("#month1").hide();
                    $("#month2").hide();
                    $a = $(this).attr("data-id");
                    $('#id_contract3').val($(this).attr("data-id"));
                    $.ajax({
                        method: 'GET',
                        url: '{!! url("/tjvendor/room/getdate") !!}/' + $(this).attr("data-id"),
                        success: function(data) {
                            $('.collapse5').hide();
                            $('.collapse6').hide();
                            $(".collapse2").show('toggle');
                            $(".judul").html('Add allotment');
                            $('#mode_form2').val("");
                            $('#validity_from3').val("");
                            $('#validity_to3').val("");
                            $('#aallotment').val("");
                            $('#sallotment').val("");
                            $('#acutofdate').val("");
                            $('#scutofdate').val("");

                            $(function() {
                                var startDate3 = new Date();
                                var FromEndDate3 = new Date();
                                var ToEndDate3 = new Date();
                                if (data.batas != "") {
                                    var valid_from = new Date(data.batas);
                                } else {
                                    var valid_from = new Date(data.results.valid_from);
                                }

                                var valid_to = new Date(data.results.valid_to);
                                console.log(valid_from);
                                ToEndDate3.setDate(ToEndDate3.getDate() + 365);

                                $('#validity_day').datepicker({
                                    minDate: startDate3,
                                    startDate: valid_from,
                                    endDate: valid_to,
                                    todayHighlight: true,
                                    autoclose: true,
                                    format: "dd-M-yyyy"
                                });
                            });
                        },
                        fail: function(e) {
                            toastr.error(e);
                        }
                    });
                });

                /**
                 * Programmer   : Thithe
                 * Tanggal      : 05-12-2016
                 * Fungsi       : close pop up saat button dengan class btn-close2 diklik
                 * Tipe         : create
                 */
                $('body').on('click', '.btn-close2', function() {
                    $('.collapsedaily').hide();
                    $('.collapse2').hide();
                });

                /**
                 * Programmer   : Thithe
                 * Tanggal      : 05-12-2016
                 * Fungsi       : memunculkan form stop sale all room saat button dengan id allstopsaletbutton
                 * Tipe         : create
                 */

                $('body').on('click', '#allstopsaletbutton', function() {
                    $("#type").hide();
                    $("#type_allotment").val("day");
                    $("#day").show();
                    $("#month1").hide();
                    $("#month2").hide();
                    $('#id_room3').val();
                    $.ajax({
                        method: 'GET',
                        url: '{!! url("/tjvendor/room/getdatestopsellallroom") !!}',
                        success: function(data) {
                            $("#myModal4").modal('show');
                            $(".judul").html('Add Stop Sale All Room');
                            $('#mode_form3').val("");
                            $(function() {
                                var startDate3 = new Date();
                                var FromEndDate3 = new Date();
                                var ToEndDate3 = new Date();
                                if (data.batas != "") {
                                    var valid_from = new Date(data.batas);
                                } else {
                                    var valid_from = new Date(data.results.valid_from);
                                }
                                var valid_to = new Date(data.results.valid_to);
                                console.log(valid_from);
                                console.log(valid_to);
                                ToEndDate3.setDate(ToEndDate3.getDate() + 365);
                                $('#validity_from5').datepicker({
                                    startDate: valid_from,
                                    endDate: valid_to,
                                    todayHighlight: true,
                                    autoclose: true,
                                    format: "dd-M-yyyy"
                                }).on("changeDate", function(selected) {
                                    startDate3 = new Date(selected.date.valueOf());
                                    startDate3.setDate(startDate3.getDate(new Date(selected.date.valueOf())));
                                    $("#validity_to5").datepicker("setStartDate", startDate3);
                                });

                                $('#validity_to5').datepicker({
                                    startDate: startDate3,
                                    endDate: valid_to,
                                    todayHighlight: true,
                                    autoclose: true,
                                    format: "dd-M-yyyy"
                                }).on('changeDate', function(selected) {
                                    FromEndDate3 = new Date(selected.date.valueOf());
                                    FromEndDate3.setDate(FromEndDate3.getDate(new Date(selected.date.valueOf())));
                                    $('#validity_from5').datepicker('setEndDate', FromEndDate3);
                                });
                            });
                        },
                        fail: function(e) {
                            toastr.error(e);
                        }
                    });
                });

                /**
                 * Programmer   : Thithe
                 * Tanggal      : 05-12-2016
                 * Fungsi       : simpan data stop sale all room saat button dengan class btn-save4allroom diklik
                 * Tipe         : create
                 */
                $('body').on('click', '.btn-save4allroom', function() {
                    $.ajax({
                        method: 'POST',
                        url: $('#formrates4').attr('action'),
                        data: new FormData($('#formrates4')[0]),
                        async: false,
                        success: function(data) {
                            var data = $.parseJSON(data);
                            if (data.failedgan === 'false') {
                                toastr.warning(data.msgServergan);
                            }
                            if (data.success === 'true') {
                                $("#myModal4").modal('hide');
                                $('.collapse2').hide();
                                $('.collapse5').hide();
                                $('.collapse6').hide();
                                var id_room = $("#id_room").val();
                                $('#hotelstopsell').dataTable().fnDraw();
                                toastr.success(data.msgServer);
                            } else {
                                toastr.warning(data.msgServer);
                            }
                        },
                        contentType: false,
                        processData: false
                    });
                });

                /**
                 * Programmer   : Thithe
                 * Tanggal      : 05-12-2016
                 * Fungsi       : memunculkan form stop sale per room saat button dengan id allstopsaletbutton
                 * Tipe         : create
                 */
                $('body').on('click', '.add-stopsale', function() {
                    $("#type").hide();
                    $("#type_allotment").val("day");
                    $("#day").show();
                    $("#month1").hide();
                    $("#month2").hide();
                    $a = $(this).attr("data-id");
                    $('#id_room3').val($(this).attr("data-id"));
                    $.ajax({
                        method: 'GET',
                        url: '{!! url("/tjvendor/room/getdatestopsell") !!}/' + $(this).attr("data-id"),
                        success: function(data) {
                            $('.collapse5').hide();
                            $('.collapse6').hide();
                            $(".collapse2").show('toggle');
                            $(".judul").html('Add Stop Sale');
                            $('#mode_form3').val("");
                            $('#validity_from4').val("");
                            $('#validity_to4').val("");
                            $('#aallotment').val("");
                            $('#sallotment').val("");
                            $('#acutofdate').val("");
                            $('#scutofdate').val("");
                            $(function() {
                                var startDate3 = new Date();
                                var FromEndDate3 = new Date();
                                var ToEndDate3 = new Date();
                                if (data.batas != "") {
                                    var valid_from = new Date(data.batas);
                                } else {
                                    var valid_from = new Date(data.results.valid_from);
                                }
                                var valid_to = new Date(data.results.valid_to);
                                console.log(valid_from);
                                ToEndDate3.setDate(ToEndDate3.getDate() + 365);
                                $('#validity_from4').datepicker({
                                    startDate: valid_from,
                                    endDate: valid_to,
                                    todayHighlight: true,
                                    autoclose: true,
                                    format: "dd-M-yyyy"
                                }).on("changeDate", function(selected) {
                                    startDate3 = new Date(selected.date.valueOf());
                                    startDate3.setDate(startDate3.getDate(new Date(selected.date.valueOf())));
                                    $("#validity_to4").datepicker("setStartDate", startDate3);
                                });

                                $('#validity_to4').datepicker({
                                    startDate: startDate3,
                                    endDate: valid_to,
                                    todayHighlight: true,
                                    autoclose: true,
                                    format: "dd-M-yyyy"
                                }).on('changeDate', function(selected) {
                                    FromEndDate3 = new Date(selected.date.valueOf());
                                    FromEndDate3.setDate(FromEndDate3.getDate(new Date(selected.date.valueOf())));
                                    $('#validity_from4').datepicker('setEndDate', FromEndDate3);
                                });
                            });
                        },
                        fail: function(e) {
                            toastr.error(e);
                        }
                    });
                });

                /**
                 * Programmer   : Thithe
                 * Tanggal      : 05-12-2016
                 * Fungsi       : memunculkan form edit monthly allotment saat button dengan class edit-allotment diklik
                 * Tipe         : create
                 */
                $('body').on('click', '.edit-allotment', function() {
                    $(".judul").html('edit allotment');
                    $('#id_contract3').val($(this).attr("data-room"));
                    $("#type").hide();
                    $.ajax({
                        method: 'GET',
                        url: '{!! url("/tjvendor/room/editallotment") !!}/' + $(this).attr("data-id"),
                        success: function(data) {
                            $('#mode_form2').val('ubah');
                            $(".collapse2").show('toggle');
                            $('#id_allotment').val(data.results.id_allotment);
                            $('#validity_from3').val(data.results.date_from);
                            $('#validity_to3').val(data.results.date_to);
                            $('#sallotment').val(data.results.sallotment);
                            $("#type_allotment").val(data.results.type);
                            $('#validity_day').val(data.results.date_from);
                            $('#max_sallotment').val(data.results.max_allotement);
                            $("#type").val();
                            if (data.results.check == 0) {
                                var startDate3 = new Date();
                                var FromEndDate3 = new Date();
                                var ToEndDate3 = new Date();
                                var valid_from = new Date(data.room.valid_from);
                                var valid_to = new Date(data.room.valid_to);
                                $("#day").show();
                                $("#type_allotment").val("day");
                                $("#month1").hide();
                                $("#month2").hide();
                            } else {
                                $("#type_allotment").val("month");
                                $("#day").hide();
                                $("#month1").show();
                                $("#month2").show();
                            }
                            $(function() {
                                var startDate3 = new Date();
                                var FromEndDate3 = new Date();
                                var ToEndDate3 = new Date();
                                var valid_from = new Date(data.room.valid_from);
                                var valid_to = new Date(data.room.valid_to);
                            });
                        },
                        fail: function(e) {
                            toastr.error(e);
                        }
                    });
                });

                /**
                 * Programmer   : Thithe
                 * Tanggal      : 05-12-2016
                 * Fungsi       : memunculkan form edit daily allotment saat button dengan class edit-allotment diklik
                 * Tipe         : create
                 */
                $('body').on('click', '.edit-allotmentdaily', function() {
                    $(".judul").html('edit allotment');
                    $('#id_daily').val($(this).attr("data-id"));
                    $("#type").hide();
                    $.ajax({
                        method: 'GET',
                        url: '{!! url("/tjvendor/room/editallotmentdaily") !!}/' + $(this).attr("data-id"),
                        success: function(data) {
                            $('#mode_form2').val('ubah');
                            $(".collapse2").hide();
                            $(".collapsedaily").show('toggle');
                            $('#validity_daily').val(data.results.date_daily);
                            $('#priment').val(data.results.priment);
                            $('#sallotment_daily').val(data.results.sallotment);
                        },
                        fail: function(e) {
                            toastr.error(e);
                        }
                    });
                });

                /**
                 * Programmer   : Thithe
                 * Tanggal      : 05-12-2016
                 * Fungsi       : menghapus data allotment saat button dengan class delete-allotment diklik
                 * Tipe         : create
                 */

                $('body').on('click', '.delete-allotment', function() {
                    var id_allotment = $(this).attr('data-id');
                    bootbox.dialog({
                        message: "Are you sure to delete <br> ?",
                        title: "Delete Confirmation",
                        buttons: {
                            success: {
                                label: "Yes",
                                className: "btn-success btn-flat",
                                callback: function() {
                                    $.ajax({
                                        method: 'GET',
                                        url: '{!! url("/tjvendor/room/deleteallotment") !!}/' + id_allotment,
                                        success: function(data) {
                                            if (data.success === true) {
                                                toastr.success(data.msgServer);
                                                $('.collapse2').hide();
                                                $('.collapse5').hide();
                                                $('.collapse6').hide();
                                                var id_room = $("#id_room").val();
                                                $('#hotelroom').dataTable().fnDraw();
                                            } else {
                                                toastr.warning(data.msgServer);
                                            }
                                        },
                                        fail: function(e) {
                                            toastr.error(e);
                                        }
                                    });
                                }
                            },
                            danger: {
                                label: "Cancel",
                                className: "btn-danger btn-flat"
                            }
                        }
                    });
                });

                /**
                 * Programmer   : Thithe
                 * Tanggal      : 05-12-2016
                 * Fungsi       : menghapus data stop sale saat button dengan class delete-stopsale diklik
                 * Tipe         : create
                 */
                $('body').on('click', '.delete-stopsale', function() {
                    var id_stopsale = $(this).attr('data-id');
                    bootbox.dialog({
                        message: "Are you sure to delete <br> ?",
                        title: "Delete Confirmation",
                        buttons: {
                            success: {
                                label: "Yes",
                                className: "btn-success btn-flat",
                                callback: function() {
                                    $.ajax({
                                        method: 'GET',
                                        url: '{!! url("/tjvendor/room/deletestopsale") !!}/' + id_stopsale,
                                        success: function(data) {
                                            if (data.success === true) {
                                                toastr.success(data.msgServer);
                                                $('.collapse2').hide();
                                                $('.collapse5').hide();
                                                $('.collapse6').hide();
                                                var id_room = $("#id_room").val();
                                                $('#hotelstopsell').dataTable().fnDraw();
                                            } else {
                                                toastr.warning(data.msgServer);
                                            }
                                        },
                                        fail: function(e) {
                                            toastr.error(e);
                                        }
                                    });
                                }
                            },
                            danger: {
                                label: "Cancel",
                                className: "btn-danger btn-flat"
                            }
                        }
                    });
                });

                /**
                 * Programmer   : Thithe
                 * Tanggal      : 05-12-2016
                 * Fungsi       : cancel stop sale hari ini saat button dengan class cancel_stop_sale diklik
                 * Tipe         : create
                 */
                $('body').on('click', '.cancel_stop_sale', function() {
                    var id_stopsale = $(this).attr('data-id');
                    bootbox.dialog({
                        message: "Are you sure to Cancel Stop Sale Today <br> ?",
                        title: "Cancel Confirmation",
                        buttons: {
                            success: {
                                label: "Yes",
                                className: "btn-success btn-flat",
                                callback: function() {
                                    $.ajax({
                                        method: 'GET',
                                        url: '{!! url("/tjvendor/room/cancelstopsale") !!}?id=' + id_stopsale,
                                        success: function(data) {
                                            if (data.success === true) {
                                                toastr.success(data.msgServer);
                                                $('.collapse2').hide();
                                                $('.collapse5').hide();
                                                $('.collapse6').hide();
                                                var id_room = $("#id_room").val();
                                                $('#hotelstopsell').dataTable().fnDraw();
                                            } else {
                                                toastr.warning(data.msgServer);
                                            }
                                        },
                                        fail: function(e) {
                                            toastr.error(e);
                                        }
                                    });
                                }
                            },
                            danger: {
                                label: "Cancel",
                                className: "btn-danger btn-flat"
                            }
                        }
                    });
                });

                /**
                 * Programmer   : Thithe
                 * Tanggal      : 05-12-2016
                 * Fungsi       : menampilkan data allotment saat button dengan class btn-editable2 diklik
                 * Tipe         : create
                 */
                $('body').on('click', '.btn-editable2', function() {
                    var id = $(this).attr("data-id");
                    $('#hiddenhandletable').val(id);
                    //alert(id);
                    handleTableroom();
                    $('.modal-title').html('add');
                    $('.collapse').show();
                    $('.collapse2').hide();
                    $('.collapse5').hide();
                    $('.collapse6').hide();
                });

                /**
                 * Programmer   : Thithe
                 * Tanggal      : 05-12-2016
                 * Fungsi       : menampilkan data stop sale saat button dengan class btn-editable3 diklik
                 * Tipe         : create
                 */
                $('body').on('click', '.btn-editable3', function() {
                    var id = $(this).attr("data-id");
                    $('#hiddenhandletable').val(id);
                    handleTablestopsell();
                    $('.modal-title').html('add');
                    $('.collapse').show();
                    $('.collapse2').hide();
                    $('.collapse5').hide();
                    $('.collapse6').hide();
                    document.getElementById("cancel_stop_sale").setAttribute("data-id", $(this).attr("data-id"));
                    document.getElementById("stopsaletbutton").setAttribute("data-id", $(this).attr("data-id"));
                    document.getElementById("id_room3").setAttribute("value", $(this).attr("data-id"));
                });

                /**
                 * Programmer   : Thithe
                 * Tanggal      : 05-12-2016
                 * Fungsi       : save data allotment saat button dengan class btn-save2 diklik
                 * Tipe         : create
                 */
                $('body').on('click', '.btn-save2', function() {
                    $.ajax({
                        method: 'POST',
                        url: $('#formrates2').attr('action'),
                        data: new FormData($('#formrates2')[0]),
                        async: false,
                        success: function(data) {
                            var data = $.parseJSON(data);
                            if (data.success === 'true') {
                                $('.collapse2').hide();
                                $('.collapse5').hide();
                                $('.collapse6').hide();
                                var id_room = $("#id_room").val();
                                $('#hotelroom').dataTable().fnDraw();
                                $('#hotelroomdaily').dataTable().fnDraw();
                                toastr.success(data.msgServer);
                            } else {
                                toastr.warning(data.msgServer);
                            }
                        },
                        contentType: false,
                        processData: false
                    });
                });

                /**
                 * Programmer   : Thithe
                 * Tanggal      : 05-12-2016
                 * Fungsi       : simpan data stop sale by room saat button dengan class btn-save3 diklik
                 * Tipe         : create
                 */
                $('body').on('click', '.btn-save3', function() {
                    $.ajax({
                        method: 'POST',
                        url: $('#formrates3').attr('action'),
                        data: new FormData($('#formrates3')[0]),
                        async: false,
                        success: function(data) {
                            var data = $.parseJSON(data);
                            if (data.success === 'true') {
                                $('.collapse2').hide();
                                $('.collapse5').hide();
                                $('.collapse6').hide();
                                var id_room = $("#id_room").val();
                                $('#hotelstopsell').dataTable().fnDraw();
                                toastr.success(data.msgServer);
                            } else {
                                toastr.warning(data.msgServer);
                            }
                        },
                        contentType: false,
                        processData: false
                    });
                });

                /**
                 * Programmer   : Thithe
                 * Tanggal      : 05-12-2016
                 * Fungsi       : simpan data daily allotment saat button dengan class btn-save4 diklik
                 * Tipe         : create
                 */
                $('body').on('click', '.btn-save4', function() {
                    $.ajax({
                        method: 'POST',
                        url: '{!! url("/tjvendor/room/newallotmentdaily") !!}',
                        data: new FormData($('#formrates2')[0]),
                        async: false,
                        success: function(data) {
                            var data = $.parseJSON(data);
                            if (data.success === 'true') {
                                $('.collapse2').hide();
                                $('.collapse5').hide();
                                $('.collapse6').hide();
                                $('.collapsedaily').hide();
                                var id_room = $("#id_daily").val();
                                $('#hotelroomdaily').dataTable().fnDraw();
                                toastr.success(data.msgServer);
                            } else {
                                toastr.warning(data.msgServer);
                            }
                        },
                        contentType: false,
                        processData: false
                    });
                });
            };

            /**
             * Programmer   : Thithe
             * Tanggal      : 05-12-2016
             * Fungsi       : menampilkan data room diklik
             * Tipe         : create
             */
            var handleTable = function() {
                if (!jQuery().dataTable) {
                    return;
                }
                $('#hotelpromo').dataTable({
                    "aLengthMenu": [
                        [2, 5, 10, 15, 20, 25, 50, -1],
                        [2, 5, 10, 15, 20, 25, 50, "All"]
                    ],
                    "bProcessing": true,
                    "bServerSide": true,
                    "sServerMethod": "get",
                    "bRetrieve": true,
                    "sAjaxSource": "{!! url('/tjvendor/room/do_Tabel') !!}",
                    "iDisplayLength": 5,
                    "oLanguage": {
                        "sProcessing": '<i class="fa fa-coffee"></i>&nbsp;Please wait...',
                        "sLengthMenu": "_MENU_ records",
                        "oPaginate": {
                            "sPrevious": "Prev",
                            "sNext": "Next"
                        }
                    },
                    "aoColumnDefs": [{
                        'bSortable': false,
                        "aTargets": [0, -1]
                    }]
                });
            };

            /**
             * Programmer   : Thithe
             * Tanggal      : 05-12-2016
             * Fungsi       : menampilkan data allotment diklik
             * Tipe         : create
             */
            var handleTableroom = function() {
                $id_room = $('input[name=hiddenhandletable]').val();

                $('#hotelroom').dataTable({
                    "aLengthMenu": [
                        [2, 5, 10, 15, 20, 25, 50, -1],
                        [2, 5, 10, 15, 20, 25, 50, "All"]
                    ],
                    "bProcessing": true,
                    "bServerSide": true,
                    "sServerMethod": "GET",
                    "bFilter": true,
                    "destroy": true,
                    "sAjaxSource": "{!! url('/tjvendor/room/allotmentdo_Tabel') !!}",
                    "iDisplayLength": 5,
                    "fnServerParams": function(aoData) {
                        aoData.push({
                            name: "id_room",
                            value: $id_room
                        })
                    },
                    "oLanguage": {
                        "sProcessing": '<i class="fa fa-coffee"></i>&nbsp;Please wait...',
                        "sLengthMenu": "_MENU_ records",
                        "oPaginate": {
                            "sPrevious": "Prev",
                            "sNext": "Next"
                        }
                    },
                    "aoColumnDefs": [{
                        'bSortable': false,
                        "aTargets": [0, -1]
                    }]
                });

                $('#hotelroomdaily').dataTable({
                    "aLengthMenu": [
                        [2, 5, 10, 15, 20, 25, 50, -1],
                        [2, 5, 10, 15, 20, 25, 50, "All"]
                    ],
                    "bProcessing": true,
                    "bServerSide": true,
                    "sServerMethod": "GET",
                    "bFilter": true,
                    "destroy": true,
                    "sAjaxSource": "{!! url('/tjvendor/room/allotmentdailydo_Tabel') !!}",
                    "iDisplayLength": 5,
                    "fnServerParams": function(aoData) {
                        aoData.push({
                            name: "id_room",
                            value: $id_room
                        })
                    },
                    "oLanguage": {
                        "sProcessing": '<i class="fa fa-coffee"></i>&nbsp;Please wait...',
                        "sLengthMenu": "_MENU_ records",
                        "oPaginate": {
                            "sPrevious": "Prev",
                            "sNext": "Next"
                        }
                    },
                    "aoColumnDefs": [{
                        'bSortable': false,
                        "aTargets": [0, -1]
                    }]
                });
            };

            /**
             * Programmer   : Thithe
             * Tanggal      : 05-12-2016
             * Fungsi       : menampilkan data stop sale diklik
             * Tipe         : create
             */
            var handleTablestopsell = function() {
                if (!jQuery().dataTable) {
                    return;
                }
                $id_room = $('input[name=hiddenhandletable]').val();
                $('#hotelstopsell').dataTable({
                    "aLengthMenu": [
                        [2, 5, 10, 15, 20, 25, 50, -1],
                        [2, 5, 10, 15, 20, 25, 50, "All"]
                    ],
                    "bProcessing": true,
                    "bServerSide": true,
                    "sServerMethod": "GET",
                    "bFilter": false,
                    "destroy": true,
                    "sAjaxSource": "{!! url('/tjvendor/room/stopselldo_Tabel') !!}",
                    "iDisplayLength": 5,
                    "fnServerParams": function(aoData) {
                        aoData.push({
                            name: "id_room",
                            value: $id_room
                        })
                    },
                    "oLanguage": {
                        "sProcessing": '<i class="fa fa-coffee"></i>&nbsp;Please wait...',
                        "sLengthMenu": "_MENU_ records",
                        "oPaginate": {
                            "sPrevious": "Prev",
                            "sNext": "Next"
                        }
                    },
                    "aoColumnDefs": [{
                        'bSortable': false,
                        "aTargets": [0, -1]
                    }]
                });
            };

            return {
                init: function() {
                    handleTable();
                    handleValidation();
                }
            };
        }();
        InitController.init();
    });
</script>

@endsection
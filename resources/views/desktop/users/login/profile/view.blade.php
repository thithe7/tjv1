@extends('layout.userLoginLayout')
@section('content_login')
<link href="{{ URL::asset('frontassets/users_login/plugins/datepicker/datepicker3.css') }}" rel="stylesheet"/>
<section>
    <h2>Profile details</h2>
    <p class="content">Completing your profile details will make your future booking faster and easier.</p>
</section>

<section>
    <blockquote>
        Basic Information
        <button type="button" class="btn btn-xs tjbutton pull-right" id="btn-update-profile">Update</button>
        <div class="btn-group pull-right" style="display: none;">
            <button type="button" class="btn btn-xs tjbutton dropdown-toggle" data-toggle="dropdown">Update <span class="caret"></span></button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="javascript:;">Information</a></li>
                <li><a href="javascript:;">Password</a></li>
            </ul>
        </div>
    </blockquote>
    <div class="row">
        <div class="col-md-12" style="margin-bottom: 40px;">
            <table class="table-bordered table-striped">
                <form id="formku">
                    <input type="hidden" name="id" id="id" class="form-control input-profil" value="{{{ Auth::guard('web_users')->user()->id }}}">
                    <tr>
                        <th style="width: 30%; text-align: right;">Name :</th>
                        <td style="width: 70%;">
                            <span class="span-profil">{{{ $profile->name }}}</span>
                            <input type="text" name="name" id="name" class="form-control input-profil" value="{{{ $profile->name }}}" style="display: none;">
                        </td>
                    </tr>
                    <tr>
                        <th style="width: 30%; text-align: right;">Address :</th>
                        <td style="width: 70%;">
                            <span class="span-profil">{{{ $profile->address }}}</span>
                            <input type="text" name="address" id="address" class="form-control input-profil" value="{{{ $profile->address }}}" style="display: none;">
                        </td>
                    </tr>
                    <tr>
                        <th style="width: 30%; text-align: right;">Email :</th>
                        <td style="width: 70%;">
                            <span class="span-profil">{{{ $profile->email }}}</span>
                            <input type="email" name="email" id="email" class="form-control input-profil" value="{{{ $profile->email }}}" style="display: none;">
                        </td>
                    </tr>
                    <tr>
                        <th style="width: 30%; text-align: right;">Birth date :</th>
                        <td style="width: 70%;">
                            <span class="span-profil">
                                <?php
                                if ($profile->birthdate) {
                                    echo date('d M Y', strtotime($profile->birthdate));
                                }
                                ?>
                            </span>
                            <?php
                            if ($profile->birthdate) {
                                echo '<div class="input-group date input-profil" style="display: none;"><input type="text" name="birthdate" id="birthdate" class="form-control" value="'.date("Y-m-d", strtotime($profile->birthdate)).'" readonly><span class="input-group-addon"><i class="fa fa-calendar"></i></span></div>';
                            }else{
                                echo '<div class="input-group date input-profil" style="display: none;"><input type="text" name="birthdate" id="birthdate" class="form-control" readonly><span class="input-group-addon"><i class="fa fa-calendar"></i></span></div>';
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th style="width: 30%; text-align: right;">Phone number :</th>
                        <td style="width: 70%;">
                            <span class="span-profil">{{{ $profile->phone }}}</span>
                            <input type="text" name="phone" id="phone" class="form-control input-profil" value="{{{ $profile->phone }}}" style="display: none;">
                        </td>
                    </tr>
                    <tr style="display: none;" id="trchpass">
                        <th style="width: 30%; text-align: right;">Password :</th>
                        <td style="width: 70%;">
                            <input type="password" name="password" id="password" class="form-control" disabled>
                        </td>
                    </tr>
                    <tr style="display: none;" class="input-profil">
                        <td colspan="2">
                            <button type="button" class="btn btn-sm btn-warning" id="btn-chpass">Change Password</button>
                            <button type="submit" class="btn btn-sm btn-success pull-right">Save</button>
                        </td>
                    </tr>
                </form>
            </table>
        </div>
    </div>
</section>
<script src="{{ URL::asset('frontassets/users_login/plugins/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('frontassets/users_login/plugins/datepicker/bootstrap-datepicker.js') }}" type="text/javascript"></script>
<script>
    $('.input-group.date').datepicker({
        format: 'yyyy-mm-dd',
        endDate: '0D',
        autoclose: true
    });
    $(document).on('click', '#btn-chpass', function(){
        $mode = $(this).html();
        if ($mode === "Change Password") {
            $(this).html("Cancel Change Password");
            $("#trchpass").show();
            $("#password").attr('disabled', false);
        } else {
            $(this).html("Change Password");
            $("#trchpass").hide();
            $("#password").attr('disabled', true);
        }
    });
    $(document).on('click', '#btn-update-profile', function(){
        $mode = $(this).html();
        if ($mode === "Update") {
            $(this).html("Cancel");
            $('.span-profil').hide();
            $('.input-profil').show();
        } else {
            $(this).html("Update");
            $('.span-profil').show();
            $('.input-profil').hide();
            $('#btn-chpass').html("Change Password");
            $("#trchpass").hide();
            $("#password").attr('disabled', true);
        }
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
@endsection
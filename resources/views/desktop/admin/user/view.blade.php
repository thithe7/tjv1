@extends("layout.adminLayout")

@section('content')

<style type="text/css">
    .iconbirth {
        background-image: url('../assets/images/date_small.png');
        background-position: 97% ;
        background-repeat: no-repeat;
        cursor:pointer;
}
</style>


<script type="text/javascript">

function validateForm () {

    var mode_form=document.forms["formku"]["mode_form"].value;
    var name=document.forms["formku"]["name"].value;
    var email=document.forms["formku"]["email"].value;
    var password=document.forms["formku"]["password"].value;
    var phone=document.forms["formku"]["phone"].value;
    var birthdate=document.forms["formku"]["birthdate"].value;
    var postcode=document.forms["formku"]["postcode"].value;
    var address=document.forms["formku"]["address"].value;
    var mincarpassword = 10;
    var mincarphone = 7;


    if (name==null || name=="")
    {
        toastr.error("Name Can't Empty");
        return false;
    };

    if (email==null || email=="")
    {
        toastr.error("Email Can't Empty");
        return false;
    };

    if ((email.indexOf('@',0)==-1) || (email.indexOf('.',0)==-1))
    { 
        toastr.error("Wrong Email Format");
        return false;
    };

    if (phone==null || phone=="")
    {
        toastr.error("Phone Can't Empty");
        return false;
    };

    if (phone.length < mincarphone)
    {
        toastr.error("Phone Min. 7 character");
        return false;
    };

    if (postcode==null || postcode=="")
    {
        toastr.error("Post Code Can't Empty");
        return false;
    };

    if (address==null || address=="")
    {
        toastr.error("Address Can't Empty");
        return false;
    };

    if (birthdate==null || birthdate=="")
    {
        toastr.error("Birthdate Can't Empty");
        return false;
    };

    if (mode_form=="tambah")
    {
        if (password==null || password=="")
        {
            toastr.error("Password Can't Empty");
            return false;
        }
        if (password.length < mincarpassword)
        {
            toastr.error("Password Min. 10 character");
            return false;
        };
    }
    else{
        if (password==null || password=="" && $('#password').attr("disabled") != 'disabled')
        {
            toastr.error("Password Can't Empty");
            return false;
        }
        if (password.length < mincarpassword && $('#password').attr("disabled") != 'disabled')
        {
            toastr.error("Password Min. 10 character");
            return false;
        };
        
    }


    



}
</script>


<script type="text/javascript">
function validAngkaPhone(a)
{
    if(!/^[0-9]+$/.test(a.value))
    {
        a.value = a.value.substring(0,a.value.length-1000);
    }
}

function validAngkaPost(a)
{
    if(!/^[0-9]+$/.test(a.value))
    {
        a.value = a.value.substring(0,a.value.length-1000);
    }
}

function validNama(a)
{
    if(!/^[a-zA-Z\_\- ]+$/.test(a.value))
    {
        a.value = a.value.substring(0,a.value.length-1000);
    }
}


</script>


    <link href="{{ URL::asset('theme/users/plugins/datepicker/datepicker3.css') }}" rel="stylesheet"/>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{{$data['title']}}}
            <small>{{{$data['subtitle']}}}</small>
        </h1>
        {{-- <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Here</li>
        </ol> --}}
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">List {{{$data['title']}}}</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <table id="tabelku" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th style="text-align: center;"><button type="button" class="btn btn-flat btn-xs btn-block btn-add btn-success" data-toggle="modal" data-target="#myModal" data-backdrop="static"><i class="fa fa-plus"></i> Add User</button></th>
                    </tr>
                </thead>
                <tbody></tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"></h4>
                    </div>
                    <form action="#" id="formku" onsubmit="return validateForm()">
                        <input type="hidden" name="mode_form" id="mode_form" class="form-control" placeholder="mode_form" value="tambah">
                        <input type="hidden" name="id" id="id" class="form-control" placeholder="id">
                        <div class="modal-body">
                            <div class="row">
                                <div id="fillouts" class="alert-danger"></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name*</label>
                                        <input type="text" onkeyup="validNama(this)" name="name" id="name" class="form-control" placeholder="Name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email*</label>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status*</label>
                                        <select type="text" name="status" id="status" class="form-control">
                                            <option value="active">Active</option>
                                            <option value="notactive">Not Active</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Phone*</label>
                                        <input type="text" onkeyup="validAngkaPhone(this)" name="phone" id="phone" class="form-control" placeholder="Phone" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">City*</label>
                                            <select id="city" name="city" class="form-control">
                                                @foreach($data['city'] as $row)
                                                   <option value="{{{ $row->id }}}" @if($row->id == "1") selected @endif> {{{ $row->name }}}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Post Code*</label>
                                        <input type="text" onkeyup="validAngkaPost(this)" name="postcode" id="postcode" class="form-control" placeholder="Post Code" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Address*</label>
                                        <input type="text" name="address" id="address" class="form-control" placeholder="Address" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Birthdate*</label>
                                        <input class="date form-control iconbirth" type="text" name="birthdate" id="birthdate" readonly required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password* <button type="button" class="btn-flat btn-xs btn btn-password btn-warning">Change</button></label>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required minlength="10"> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Newsletter </label>
                                        <input type="checkbox" value="true" name="status_newsletter" id="status_newsletter">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div id="fillouts" class="alert-danger"></div><p>&nbsp;</p>
                            <button type="submit" class="btn btn-success btn-flat btn-sm btn-save">Save</button>
                            <button type="button" class="btn btn-warning btn-flat btn-sm btn-cancel" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section><!-- /.content -->
    <script src="{{ URL::asset('theme/admin/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="{{ URL::asset('theme/users/plugins/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('theme/users/plugins/datepicker/bootstrap-datepicker.js') }}" type="text/javascript"></script>

    <script>

            $('.date').datepicker({
                format: 'yyyy-mm-dd',
                endDate: '0D',
                autoclose: true
            });

        $(document).ready(function(){

            $('.btn-password').hide();

            $('body').on('click', '.btn-password', function(){
                console.log($(this).html());
                if ($(this).html() == 'Change') {
                    $(this).html('Cancel');
                    $('#password').attr('disabled', false);
                }else{
                    $(this).html('Change');
                    $('#password').attr('disabled', true);
                };
            });
            
            var InitController = function () {

                var handleValidation = function () {

                    $('#formku').validate({
                        errorElement: 'span', //default input error message container
                        errorClass: 'help-block', // default input error message class
                        focusInvalid: true, // do not focus the last invalid input
                        ignore: "",
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
                                url: '{!! url("/admin/user/do_Simpan") !!}',
                                data: $('#formku').serializeArray(),
                                success: function (data) {
                                    if (data.success === true) {
                                        toastr.success(data.msgServer);
                                        handleClearForm();
                                        $('#tabelku').dataTable().fnDraw(false);
                                        $('#myModal').modal("hide");
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

                var handleTable = function () {

                    if (!jQuery().dataTable) {
                        return;
                    }

                    $('#tabelku').dataTable({
                        "aLengthMenu": [
                            [5, 10, 15, 20, 25, 50, -1],
                            [5, 10, 15, 20, 25, 50, "All"] // change per page values here
                        ],
                        "bProcessing": true,
                        "bServerSide": true,
                        "sServerMethod": "POST",
                        "bRetrieve": true,
                        "sAjaxSource": "{!! url('/admin/user/do_Tabel') !!}",
                        // set the initial value
                        "iDisplayLength": 50,
                        // "sPaginationType": "bootstrap_full_number",
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
                                'aTargets': [0, -1]
                            }
                        ]
                    });

                    $('body').on('click', '.btn-add', function(){
                        $('.modal-title').html('Add User');
                        $('#id').val('');
                    });

                    $('body').on('click', '.btn-cancel', function(){
                        $('.modal-title').html('');
                        handleClearForm();
                    });

                    $('body').on('click', '.btn-editable', function(){
                        $('#mode_form').val('ubah');
                        $('.modal-title').html('Update User');
                        $('#password').attr('disabled', true);
                        $('.btn-password').show();
                        $.ajax({
                            method: 'POST',
                            dataType: 'json',
                            url: '{!! url("/admin/user/do_Ubah") !!}',
                            data: {'id': $(this).attr("data-id")},
                            success: function (data) {
                                if (data.success === true) {
                                    $('#id').val(data.results.id);
                                    $('#name').val(data.results.name);
                                    $('#email').val(data.results.email);
                                    $('#status').val(data.results.status);
                                    $('#phone').val(data.results.phone);
                                    $('#city').val(data.results.city);
                                    $('#postcode').val(data.results.postcode);
                                    $('#address').val(data.results.address);
                                    $('#birthdate').val(data.results.birthdate);
                                    $('#password').val(data.results.password);

                                    if(data.results.status_newsletter == 'ACTIVE') {
                                        $('#status_newsletter').attr('checked','checked')
                                    }
                                    else{
                                        $('#status_newsletter').removeAttr('checked')
                                    }

                                } else {
                                    toastr.warning(data.msgServer);
                                }
                            },
                            fail: function (e) {
                                toastr.error(e);
                            }
                        });
                    });

                    $('body').on('click', '#tabelku_wrapper .btn-removable', function () {

                        var id = $(this).attr("data-id");
                        var name = $(this).attr("data-name");
                        bootbox.dialog({
                            message: "Apakah anda yakin menghapus </br>User : <b>" + name + "</b> ?",
                            title: "Delete Confirmation",
                            buttons: {
                                success: {
                                    label: "Yes",
                                    className: "btn-success btn-flat",
                                    callback: function () {
                                        $.ajax({
                                            method: 'POST',
                                            dataType: 'json',
                                            url: '{!! url("/admin/user/do_Hapus") !!}',
                                            data: {'id': id},
                                            success: function (data) {
                                                if (data.success === true) {
                                                    toastr.success(data.msgServer);

                                                    $('#tabelku').dataTable().fnDraw(false);
                                                } else {
                                                    toastr.warning(data.msgServer);
                                                }
                                            },
                                            fail: function (e) {
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

                };

                return {
                    //main function to initiate the module
                    init: function () {
                        handleTable();
                        handleValidation();
                    }
                };

            }();

            InitController.init();

        });

        function handleClearForm() {
            $('#formku').each(function () {
                this.reset();
            });
            $('#mode_form').val('tambah');
            $('#id').val('');
            $('#password').attr('disabled', false);
            $('.btn-password').html('Change');
            $('.btn-password').hide();
        }
    </script>
@endsection
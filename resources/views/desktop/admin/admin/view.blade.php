@extends("layout.adminLayout")

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{{$data['title']}}}
            <small id="small">{{{$data['subtitle']}}}</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">List {{{$data['title']}}}</h3>
            </div><!-- /.box-header -->
            <div class="table-responsive box-body">
                <table id="tabelku" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Member Since</th>
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
                    <form action="#" id="formku">
                        <input type="hidden" name="mode_form" id="mode_form" class="form-control" placeholder="mode_form" value="tambah">
                        <input type="hidden" name="id" id="id" class="form-control" placeholder="id">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password <button type="button" class="btn-flat btn-xs btn btn-password btn-warning">Change</button></label>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select type="text" name="status" id="status" class="form-control">
                                            <option value="active">Active</option>
                                            <option value="notactive">Not Active</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success btn-flat btn-sm btn-save">Save</button>
                            <button type="button" class="btn btn-warning btn-flat btn-sm btn-cancel" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section><!-- /.content -->
    <script src="{{ URL::asset('theme/admin/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script>
        $(document).ready(function(){

            // setInterval(function(){ alert("Hello"); }, 3000);
            // setInterval(function(){
            //     $.ajax({
            //         method: 'GET',
            //         dataType: 'json',
            //         url: '{!! url("/admin/test") !!}',
            //         data: {'id': 5},
            //         success: function (data) {
            //             if (data.name != $('#smallinput').val()) {
            //                 $('#small').html(data.name);
            //             }
            //         },
            //         fail: function (e) {
            //             toastr.error(e);
            //         }
            //     });
            // }, 3000);

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
                        rules: {
                            mode_form: {
                                required: true
                            },
                            name: {
                                required: true
                            },
                            username: {
                                required: true
                            },
                            email: {
                                required: true
                            },
                            password: {
                                required: true
                            },
                            status: {
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
                                url: '{!! url("/admin/admin/do_Simpan") !!}',
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
                        //"bStateSave": true,
                        "sAjaxSource": "{!! url('/admin/admin/do_Tabel') !!}",
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
                            url: '{!! url("/admin/admin/do_Ubah") !!}',
                            data: {'id': $(this).attr("data-id")},
                            success: function (data) {
                                if (data.success === true) {
                                    $('#id').val(data.results.id);
                                    $('#name').val(data.results.name);
                                    $('#username').val(data.results.username);
                                    $('#email').val(data.results.email);
                                    $('#status').val(data.results.status);
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
                                            url: '{!! url("/admin/admin/do_Hapus") !!}',
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
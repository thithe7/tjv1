@extends("layout.adminLayout")

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{{$data['title']}}}
            <small>{{{$data['subtitle']}}}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="javascript:;">Master</a></li>
            <li><a href="javascript:;">CMS</a></li>
            <li><a href="javascript:;">FAQ</a></li>
            <li class="active">Category</li>
        </ol>
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
                        <th>ID</th>
                        <th>Indonesia</th>
                        <th>English</th>
                        <th>Parent</th>
                        <th style="text-align: center;"><button type="button" class="btn btn-flat btn-xs btn-block btn-add btn-success" data-toggle="modal" data-target="#myModal" data-backdrop="static"><i class="fa fa-plus"></i> Add Category</button></th>
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
                                        <label for="as">As</label>
                                        <select id="as" name="as" class="form-control">
                                            <option value="Parent">Parent</option>
                                            @if(count($data['parent']) > 0)
                                                <option value="Child">Child</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="parent">Parent</label>
                                        @if(count($data['parent']) > 0)
                                            <select id="parent" name="parent" class="form-control">
                                                @foreach($data['parent'] as $row)
                                                    <option value="{{{$row->id}}}">{{{$row->name_id." || ".$row->name_en}}}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            <select id="parent" name="parent" class="form-control" disabled>
                                                @foreach($data['parent'] as $row)
                                                    <option value="{{{$row->id}}}">{{{$row->name_id." || ".$row->name_en}}}</option>
                                                @endforeach
                                            </select>             
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name_id">Indonesia</label>
                                        <input type="text" name="name_id" id="name_id" class="form-control" placeholder="Indonesia">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name_en">English</label>
                                        <input type="text" name="name_en" id="name_en" class="form-control" placeholder="English">
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

            $(document).on('change', '#as', function(){
                if($(this).val() == "Child"){
                    $('#parent').attr('disabled', false);
                }else if($(this).val() == "Parent"){
                    $('#parent').attr('disabled', true);
                }
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
                            parent: {
                                required: true
                            },
                            name_id: {
                                required: true
                            },
                            name_en: {
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
                                url: '{!! url("/admin/faqcat/do_Simpan") !!}',
                                data: $('#formku').serializeArray(),
                                success: function (data) {
                                    if (data.success === true) {
                                        toastr.success(data.msgServer);
                                        handleClearForm();
                                        $('#tabelku').dataTable().fnDraw();
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
                            [10, 20, 25, 50, -1],
                            [10, 20, 25, 50, "All"] // change per page values here
                        ],
                        "bProcessing": true,
                        "bServerSide": true,
                        "sServerMethod": "POST",
                        "bRetrieve": true,
                        "sAjaxSource": "{!! url('/admin/faqcat/do_Tabel') !!}",
                        // set the initial value
                        "iDisplayLength": 20,
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
                        $('.modal-title').html('Add Category FAQ');
                        $('#id').val('');
                        // $('#as').val('Child');
                        $('#parent').attr('disabled', true);
                    });

                    $('body').on('click', '.btn-cancel', function(){
                        $('.modal-title').html('');
                        handleClearForm();
                    });

                    $('body').on('click', '.btn-editable', function(){
                        $('#mode_form').val('ubah');
                        $('.modal-title').html('Update Category FAQ');
                        $.ajax({
                            method: 'POST',
                            dataType: 'json',
                            url: '{!! url("/admin/faqcat/do_Ubah") !!}',
                            data: {'id': $(this).attr("data-id")},
                            success: function (data) {
                                if (data.success === true) {
                                    $('#id').val(data.results.id);
                                    if (data.results.parent != null) {
                                        $('#parent').val(data.results.parent);
                                        $('#as').val('Child');
                                        $('#parent').attr('disabled', false);
                                    } else {
                                        $('#parent').val('');
                                        $('#as').val('Parent');
                                        $('#parent').attr('disabled', true);
                                    }
                                    $('#name_id').val(data.results.name_id);
                                    $('#name_en').val(data.results.name_en);
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
                        var parent = $(this).attr("data-parent");
                        bootbox.dialog({
                            message: "Apakah anda yakin menghapus </br>Category FAQ : <b>" + name + "</b> ?",
                            title: "Delete Confirmation",
                            buttons: {
                                success: {
                                    label: "Yes",
                                    className: "btn-success btn-flat",
                                    callback: function () {
                                        $.ajax({
                                            method: 'POST',
                                            dataType: 'json',
                                            url: '{!! url("/admin/faqcat/do_Hapus") !!}',
                                            data: {'id': id, 'parent': parent},
                                            success: function (data) {
                                                if (data.success === true) {
                                                    toastr.success(data.msgServer);

                                                    $('#tabelku').dataTable().fnDraw();
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
        }
    </script>
@endsection
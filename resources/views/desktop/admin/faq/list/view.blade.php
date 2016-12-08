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
            <li class="active">List</li>
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
                            <th style="width: 20px;">No</th>
                            <th>Category</th>
                            <th>Question Indonesia</th>
                            <th>Question English</th>
                            <th style="text-align: center; width: 100px;"><button type="button" class="btn btn-flat btn-xs btn-block btn-add btn-success" data-toggle="modal" data-target="#myModal" data-backdrop="static"><i class="fa fa-plus"></i> Add FAQ</button></th>
                        </tr>
                    </thead>
                <tbody></tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"></h4>
                    </div>
                    <form action="#" id="formku">
                        <input type="hidden" name="mode_form" id="mode_form" class="form-control" placeholder="mode_form" value="tambah">
                        <input type="hidden" name="id" id="id" class="form-control" placeholder="id">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select class="form-control" name="category" id="category">
                                    @foreach($data['category'] as $row)
                                        <option value="{{{$row->id}}}">
                                            {{{$row->name_id}}} || {{{$row->name_en}}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="question_id">Pertanyaan (Indonesia)</label>
                                        <textarea class="form-control tinymce" name="question_id" id="question_id"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="answer_id">Jawaban (Indonesia)</label>
                                        <textarea class="form-control tinymce" name="answer_id" id="answer_id"></textarea>
                                    </div>                            
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="question_en">Question (English)</label>
                                        <textarea class="form-control tinymce" name="question_en" id="question_en"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="answer_en">Answer (English)</label>
                                        <textarea class="form-control tinymce" name="answer_en" id="answer_en"></textarea>
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
    <script src="{{ URL::asset('assets/plugins/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            
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
                            category: {
                                required: true
                            },
                            question_id: {
                                required: true
                            },
                            answer_id: {
                                required: true
                            },
                            question_en: {
                                required: true
                            },
                            answer_en: {
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
                                url: '{!! url("/admin/faqlist/do_Simpan") !!}',
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
                        "sAjaxSource": "{!! url('/admin/faqlist/do_Tabel') !!}",
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
                        $('.modal-title').html('Add FAQ');
                    });

                    $('body').on('click', '.btn-cancel', function(){
                        $('.modal-title').html('');
                        handleClearForm();
                    });

                    $('body').on('click', '.btn-editable', function(){
                        $('#mode_form').val('ubah');
                        $('.modal-title').html('Update FAQ');
                        $.ajax({
                            method: 'POST',
                            dataType: 'json',
                            url: '{!! url("/admin/faqlist/do_Ubah") !!}',
                            data: {'id': $(this).attr("data-id")},
                            success: function (data) {
                                if (data.success === true) {
                                    $('#id').val(data.results.id);
                                    $('#category').val(data.results.category);
                                    tinyMCE.get('question_id').setContent(data.results.question_id);
                                    tinyMCE.get('answer_id').setContent(data.results.answer_id);
                                    tinyMCE.get('question_en').setContent(data.results.question_en);
                                    tinyMCE.get('answer_en').setContent(data.results.answer_en);
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
                            // message: "Apakah anda yakin menghapus </br>FAQ : <b>" + name + "</b> ?",
                            message: "Apakah anda yakin menghapus FAQ ?",
                            title: "Delete Confirmation",
                            buttons: {
                                success: {
                                    label: "Yes",
                                    className: "btn-success btn-flat",
                                    callback: function () {
                                        $.ajax({
                                            method: 'POST',
                                            dataType: 'json',
                                            url: '{!! url("/admin/faqlist/do_Hapus") !!}',
                                            data: {'id': id},
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
            $("#mode_form").val('tambah');
            $("#id").val('');
            // $('textarea').tinymce().destroy();
        }

        tinymce.init({
            selector: "textarea.tinymce",theme: "modern",height: 300,
            plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
            "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
            ],
            toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
            toolbar2: " link unlink anchor | image media | forecolor backcolor  | print preview code ",
            image_advtab: true ,
            convert_urls: false,
            relative_urls: false,
            autosave_ask_before_unload: false,

            external_filemanager_path:"{{ URL::asset('assets/plugins/responsive_filemanager/filemanager/') }}/",
            filemanager_title:"TravelJinni Filemanager",
            external_plugins: { "filemanager" : "{{ URL::asset('assets/plugins/responsive_filemanager/filemanager/plugin.min.js') }}"},
            templates: [
            { title: 'Test template 1', content: 'Test 1' },
            { title: 'Test template 2', content: 'Test 2' }
            ],
            remove_script_host: true,
            setup : function(ed){
                ed.on('change', function(e){
                    tinyMCE.triggerSave();
                });
                ed.on('SetContent', function(e){
                    tinyMCE.triggerSave();
                });
            }
        });
    </script>
@endsection
@extends('layout.userLoginLayout')
@section('content_login')
<section>
	<blockquote>
		TJ Booking
	</blockquote>
	<table class="table-bordered table-striped" id="tabelku">
		<thead>
			<tr style="text-align: left;">
				<th style="width: 10px;">No</th>
				<th>No Invoice</th>
				<th>Point</th>
			</tr>
		</thead>
	</table>
</section>
<script src="{{ URL::asset('frontassets/users_login/plugins/jquery.min.js') }}"></script>
<script type="text/javascript">
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
                    	name: {
                    		required: true
                    	},
                    	username: {
                    		required: true
                    	},
                    	email: {
                    		required: true
                    	},
                    	department: {
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
                        "sAjaxSource": "{!! url('/booking/do_Tabel') !!}",
                    // set the initial value
                    "iDisplayLength": 10,
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
						url: '{!! url("/booking/do_Ubah") !!}',
						data: {'id': $(this).attr("data-id")},
						success: function (data) {
							if (data.success === true) {
								$('#id').val(data.results.id);
								$('#name').val(data.results.name);
								$('#username').val(data.results.username);
								$('#email').val(data.results.email);
								$('#department').val(data.results.department);
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
</script>
@endsection
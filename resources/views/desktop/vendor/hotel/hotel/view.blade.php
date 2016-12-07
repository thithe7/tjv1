@extends("layout.vendorLayout")

@section('content')
<link rel="stylesheet" href="{{ URL::asset('theme/admin/plugins/select2/select2.min.css') }}">
<section class="content-header">
    <h1>
        Hotel
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Management</a></li>
        <li class="active">Hotel</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <!-- Modal content-->
                    <form role="form-horizontal" action="#" id="formpromo" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                        <input type="hidden" name="id_hotel" id="id_hotel" class="form-control" placeholder="id_hotel" value="{{$data['hotel']->id_hotel}}">
                        <input type="hidden" name="mode_form" id="mode_form" class="form-control" placeholder="mode_form" value="ubah">
                        <div class="modal-body">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="nav-tabs-custom">
                                            <ul class="nav nav-pills">
                                                <li class="active"><a href="#detail" data-toggle="tab">Detail</a></li>
                                                <li><a href="#photos" data-toggle="tab">Photos</a></li>
                                                <li><a href="#contact" data-toggle="tab">Contact Person</a></li>
                                            </ul>

                                            <!-- Tab Detail -->
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="detail">


                                                    <section id="new">
                                                        <div class="box box-primary">
                                                            <div class="box-header with-border">
                                                                <h3 class="box-title">Important</h3>
                                                            </div>
                                                            <!-- /.box-header -->
                                                            <!-- form start -->

                                                            <div class="box-body">
                                                                <table>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td width="10%">Country*</td>
                                                                            <td width="20%">
                                                                                <select disabled="disabled" id="country_hotel" name="country_hotel" class="form-control" style="width: 150px;">
                                                                                  @foreach($data['country'] as $row)
                                                                                  <option value="{{{ $row->id }}}" @if($row->id == "1") selected @endif> {{{ $row->name }}}</option>
                                                                                  @endforeach
                                                                              </select>
                                                                          </td>
                                                                          <td width="5%">City*</td>
                                                                          <td width="20%">
                                                                            <select disabled="disabled" id="city_hotel" name="city_hotel" class="form-control" style="width: 150px;">
                                                                              @foreach($data['city'] as $kota)
                                                                              <option value="{{{ $kota->id }}}">{{{ $kota->name }}}</option>
                                                                              @endforeach
                                                                          </select>
                                                                      </td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td> <br> </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- /.box-body -->

                                                    <div class="box-footer">
                                                    </div>

                                                </div>
                                                <!-- /.box -->

                                                <div class="box box-primary">
                                                    <div class="box-header with-border">
                                                        <h3 class="box-title">Detail</h3>
                                                    </div>
                                                    <!-- /.box-header -->
                                                    <!-- form start -->
                                                    <div class="box-body">
                                                        <table width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="20%">Hotel Name*</td>
                                                                    <td width="20%"><input readonly="readonly" type="text" style="width: 200px" id="name_hotel" name="name_hotel" class="form-control" value="{{$data['hotel']->name_hotel}}" required>
                                                                    </td>
                                                                    <td width="20%">Email*</td>
                                                                    <td width="20%"><input type="email" style="width: 170px" id="email_hotel" name="email_hotel" class="form-control" value="{{$data['hotel']->email_hotel}}" required>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td> <br> </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="20%">Star</td>
                                                                    <td width="20%">
                                                                        <select disabled="disabled" class="form-control" style="width: 100px;" id="star_hotel" name="star_hotel">
                                                                          <option value="0" @if($data['hotel']->star_hotel==0) selected @endif>0</option>
                                                                          <option value="1" @if($data['hotel']->star_hotel==1) selected @endif>1</option>
                                                                          <option value="2" @if($data['hotel']->star_hotel==2) selected @endif>2</option>
                                                                          <option value="3" @if($data['hotel']->star_hotel==3) selected @endif>3</option>
                                                                          <option value="4" @if($data['hotel']->star_hotel==4) selected @endif>4</option>
                                                                          <option value="5" @if($data['hotel']->star_hotel==5) selected @endif>5</option>
                                                                      </select>
                                                                  </td>
                                                                  <td width="20%">Telephone*</td>
                                                                  <td width="20%"><input type="text" style="width: 170px" id="telephone_hotel" class="number form-control" name="telephone_hotel" value="{{$data['hotel']->telephone_hotel}}">
                                                                  </td>
                                                              </tr>
                                                              <tr>
                                                                <td> <br> </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="20%">Area*</td>
                                                                <td width="20%">
                                                                    <select disabled="disabled" id="area_hotel" name="area_hotel" class="form-control" style="width: 150px;">
                                                                      @foreach($data['area'] as $kota)
                                                                      <option value="{{{ $kota->id }}}">{{{ $kota->name }}}</option>
                                                                      @endforeach
                                                                  </select>
                                                              </td>
                                                              <td width="20%">Longitude</td>
                                                              <td width="20%"><input readonly="readonly" type="text" style="width: 170px" id="longitude_hotel" name="longitude_hotel" class="form-control" value="{{$data['hotel']->longitude_hotel}}">
                                                              </td>
                                                          </tr>

                                                          <tr>
                                                            <td> <br> </td>
                                                        </tr>

                                                        <tr>
                                                            <td width="20%">Address</td>
                                                            <td width="20%"><textarea readonly="readonly" style="width: 200px" id="address" placeholder="Road Name" name="address" class="form-control">{{$data['hotel']->address}}</textarea>
                                                            </td>
                                                            <td width="20%">Latitude</td>
                                                            <td width="20%"><input readonly="readonly" type="text" style="width: 170px" id="latitude_hotel" name="latitude_hotel" class="form-control" value="{{$data['hotel']->latitude_hotel}}">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td> <br> </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="20%">Validity From</td>
                                                            <td width="20%">
                                                                <div class="form-group" style="width: 150px">
                                                                    <div class="input-group">
                                                                        <input readonly="readonly" type="text" class="rate form-control" value="{{$data['hotel']->valid_from}}" readonly="readonly">
                                                                        <span class="input-group-addon">
                                                                            <span class="glyphicon glyphicon-calendar pull-left">
                                                                            </span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td width="20%">Cut of Date</td>
                                                            <td width="20%"><input readonly="readonly" type="text" style="width: 170px" id="latitude_hotel" name="latitude_hotel" class="form-control" readonly="readonly" value="{{$data['hotel']->cod_hotel}}">
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td> <br> </td>
                                                        </tr>

                                                        <tr>
                                                            <td width="20%">Validity To</td>
                                                            <td width="20%">
                                                                <div class="form-group" style="width: 150px">
                                                                    <div class="input-group">
                                                                        <input readonly="readonly" type="text" class="rate form-control" value="{{$data['hotel']->valid_to}}" readonly="readonly">
                                                                        <span class="input-group-addon">
                                                                            <span class="glyphicon glyphicon-calendar pull-left">
                                                                            </span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td width="20%">TJ Point Back</td>
                                                            <td width="20%"><input type="number" style="width: 170px" id="point_back" name="point_back" min="0" class="form-control number" value="{{$data['hotel']->point_back}}">
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.box-body -->

                                            <div class="box-footer">
                                                                <!--   <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary pull-right">Submit</button> -->
                                                            </div>
                                                        </div>
                                                        <!-- /.box -->
                                                    </section>
                                                </div>

                                                <div class="tab-pane" id="photos">
                                                    <section id="new">
                                                        <div class="box box-primary">
                                                            <div class="box-header with-border">
                                                                <h3 class="box-title">Hotel Photos</h3>
                                                            </div>
                                                            <div class="box-body">
                                                                <table>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td width="20%">Hotel Photo</td>
                                                                            <td width="20%">
                                                                                <input type="file" id="hotel_photo" accept="image/*" onchange="return ValidateFileUpload()" name="hotel_photo">
                                                                            </td>
                                                                            <td width="50"><b>Image type supported : .JPG, .JPEG, .PNG, .GIF</b></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td> <br> </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <table id="tabel_photo" class="table table-bordered table-striped">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>No</th>
                                                                            <th>Picture</th>
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
                                                <div class="tab-pane" id="contact">

                                                    <section id="new">
                                                        <div class="box box-primary">
                                                            <div class="box-header with-border">
                                                                <h3 class="box-title">Detail</h3>
                                                            </div>
                                                            <!-- /.box-header -->
                                                            <!-- form start -->
                                                            <div class="box-body">
                                                                <table>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td width="20%">Name</td>
                                                                            <td width="40%"><input readonly="readonly" type="text" style="width: 200px" id="cp_name" name="cp_name" class="form-control" placeholder="Contact Name" value="{{$data['hotel']->cp_name}}">
                                                                            </td>
                                                                            <td width="20%">Title</td>
                                                                            <td width="40%">
                                                                              <select disabled="disabled" class="form-control" style="width: 200px;" id="cp_title" name="cp_title">
                                                                                  <option value="Mr" @if($data['hotel']->cp_title=="Mr") selected @endif>Mr.</option>
                                                                                  <option value="Ms" @if($data['hotel']->cp_title=="Ms") selected @endif>Ms.</option>
                                                                                  <option value="Mrs" @if($data['hotel']->cp_title=="Mrs") selected @endif>Mrs</option>
                                                                              </select>
                                                                          </td>
                                                                      </tr>

                                                                      <tr>
                                                                        <td> <br> </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td width="20%">Department</td>
                                                                        <td width="40%"><input readonly="readonly" type="text" style="width: 200px" id="cp_department" name="cp_department" class="form-control" value="{{$data['hotel']->cp_department}}" placeholder="Contact Department">
                                                                        </td>
                                                                        <td width="20%">Telephone</td>
                                                                        <td width="40%"><input type="text" style="width: 200px" id="cp_phone" name="cp_phone" class="number form-control" value="{{$data['hotel']->cp_phone}}" placeholder="Contact Phone Number">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td> <br> </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="20%">Email</td>
                                                                        <td width="40%"><input type="email" style="width: 200px" id="cp_mail" name="cp_mail" class="form-control" value="{{$data['hotel']->cp_mail}}" placeholder="Contact Mail">
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <!-- /.box-body -->
                                                        <div class="box-footer">
                                                                <!--   <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary pull-right">Submit</button> -->
                                                            </div>

                                                        </div>
                                                        <!-- /.box -->
                                                    </section>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <!-- <button type="button" class="btn btn-default pull-left btn-close tutup" data-dismiss="modal">Close</button> -->
                                <button type="button" class="btn btn-primary submit">Save changes</button>
                                <!-- <button type="submit" class="btn btn-primary btn-save">Save changes</button> -->
                            </div>
                        </div>
                    </form>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>

<script src="{{ URL::asset('theme/admin/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script>
    $(document).ready(function() {
        var InitController = function() {
            /**
            * Programmer   : Thithe
            * Tanggal      : 05-12-2016
            * Fungsi       : javascript action jika tombol delete photo saat button dengan class btn-delphoto diclick
            * Tipe         : create
            */
            $('body').on('click', '.btn-delphoto', function() {
                var photo_name = $(this).attr('data-name-photo');
                var photo_id = $(this).attr('data-id-photo');

                bootbox.dialog({
                    message: "Are you sure to delete <br><b> " + photo_name + " </b> ?",
                    title: "Delete Confirmation",
                    buttons: {
                        success: {
                            label: "Yes",
                            className: "btn-success btn-flat",
                            callback: function() {
                                $.ajax({
                                    method: 'get',
                                    dataType: 'json',
                                    url: '{!! url("tjvendor/deletephoto") !!}/' + photo_id,
                                    //data: {'id_photo': photo_id},
                                    success: function(data) {
                                        if (data.success === true) {
                                            toastr.success(data.msgServer);
                                            handleTable();
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
            * Fungsi       : javascript action jika button dengan class submit(save changes) diclick
            * Tipe         : create
            */
            $('body').on('click', '.submit', function() {
                $.ajax({
                    method: 'POST',
                    url: '{!! url("tjvendor/do-simpan") !!}',
                    data: new FormData($('#formpromo')[0]),
                    async: true,
                    contentType: false,
                    processData: false,
                    beforeSend: function(data) {
                        $.blockUI({
                            message: "<img src='{{ URL::to('assets/images/spin.gif') }}' style='max-width: 50px; max-height: 50px; z-index: 99999'> Please Wait...",
                        });
                    },
                    success: function(data) {
                        var data = $.parseJSON(data);
                        if (data.success === true) {
                            $('#hotel_photo').val();
                            document.getElementById("hotel_photo").value = "";
                            toastr.success(data.msgServer);
                            $.unblockUI();
                            handleTable();
                        } else {
                            toastr.warning(data.msgServer);
                            $.unblockUI();
                        }
                    },
                    error: function(xhr, Status, err) {
                        toastr.warning(data.msgServer);
                        $.unblockUI();
                    }
                });
            });

            /**
            * Programmer   : Thithe
            * Tanggal      : 05-12-2016
            * Fungsi       : javascript action load data photo
            * Tipe         : create
            */
            var handleTable = function() {
                hotel = {{$data['hotel']->id_hotel}};
                url = '{!!url("tjvendor/photo/")!!}';

                $('#tabel_photo').dataTable({
                    "aLengthMenu": [
                    [5, 10, 15, 20, 25, 50, -1],
                        [5, 10, 15, 20, 25, 50, "All"] // change per page values here
                        ],
                        "bProcessing": true,
                        "bServerSide": true,
                        "sServerMethod": "GET",
                    //"bRetrieve": true,
                    "bFilter": false,
                    "destroy": true,
                    "sAjaxSource": url + "/" + hotel,
                    // set the initial value
                    "iDisplayLength": 5,
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
                    }]
                });
            };
            return {
                //main function to initiate the module
                init: function() {
                    handleTable();
                }
            };
        }();
        InitController.init();
    });

    /**
    * Programmer   : Thithe
    * Tanggal      : 05-12-2016
    * Fungsi       : javascript check extensi photo
    * Tipe         : create
    */
    function ValidateFileUpload() {
        var fuData = document.getElementById('hotel_photo');
        var FileUploadPath = fuData.value;
        //To check if user upload any file
        if (FileUploadPath == '') {
            alert("Please upload an image");
        } else {
            var Extension = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
            //The file uploaded is an image
            if (Extension == "jpeg" || Extension == "jpg" || Extension == "png") {
            }
            //The file upload is NOT an image
            else {
                document.getElementById("hotel_photo").value = "";
                alert("Photo only allows file types of JPG and JPEG. ");
                //$("#tombolnya").hide();
                return false;
            }
        }
    }
</script>
@endsection
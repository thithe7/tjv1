@extends("layout.adminLayout")



@section('content')

<!-- <br>

<div class="col-xs-12">

  <div class="nav-tabs-custom">

    <ul class="nav nav-pills">

      <li class="active"><a href="{!! url('/admin/hotel') !!}">Hotel</a></li>

      <li><a href="{!! url('/admin/room') !!}">Room</a></li>

      <li><a href="{!! url('/admin/price') !!}">Room Price</a></li>

    </ul>

  </div>

</div>

<br>

<br>

 -->

<link rel="stylesheet" href="{{ URL::asset('theme/admin/plugins/select2/select2.min.css') }}">

<section class="content-header">

    <h1>

      Vendor



    </h1>

    <ol class="breadcrumb">

      <li><a href="#"><i class="fa fa-dashboard"></i> Management</a></li>

      <li class="active">Vendor</li>

    </ol>

  </section>



<!-- Modal -->

<div id="myModalgabung" class="modal fade" role="dialog">

    <div class="modal-dialog" style="width: 100%;">

        <!-- Modal content-->

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="btn btn-warning btn-sm btn-flat pull-right btn-cancel" data-dismiss="modal">Close</button>

                <h4 class="modal-title">Hotel Setup</h4>

            </div>

          <div class="modal-body">









<div>

              <div class="nav-tabs-custom">

                <ul class="nav nav-pills">

                  <li class="active"><a href="#roomsetup" data-toggle="tab">Room Setup</a></li>

                  <li><a href="#roomprice" data-toggle="tab" id="roompricetab">Room Price</a></li>

                </ul>



      <!-- Tab Detail -->

                <div class="tab-content">

                  <div class="tab-pane active" id="roomsetup">





                    <section id="new">

                    <div class="box box-primary">

                <!-- form start -->



                    <div class="box-body">

                      

                                  <div class="row">

              <div class="col-md-6">

                    <div class="box">

                        <div class="box-header">

                            <h3 class="box-title">List Room</h3>

                        </div><!-- /.box-header -->

                        <div class="table-responsive box-body">

                    <table id="tabelroom" class="table table-bordered table-striped table-hover">

                                <thead>

                                    <tr>

                                        <th>No</th>

                                        <th>Name</th>

                                        <th style="text-align: center;"><button type="button" class="btn btn-xs btn-info btn-add-room btn-flat">Add Room</button></th>

                                    </tr>

                                </thead>

                                <tbody></tbody>

                            </table>

                          </div>

                        </div>

                      </div>

              <div class="col-md-6">

                    <div class="box">

                        <div class="box-header">

                            <h3 class="box-title">Form Room</h3>

                        </div><!-- /.box-header -->

                        <div class="table-responsive box-body">

                    <form id="formku">

                      <input type="hidden" name="mode_form" id="mode_form" class="form-control" value="tambah">

                      <input type="hidden" name="id" id="id" class="form-control">

                      <input type="hidden" name="hotel" id="hotel" class="form-control">

                      <div class="input-group" style="width: 100%;">

                        <label>Room Name</label>

                        <input type="text" name="name" id="name" class="form-control">

                      </div>

                      <div style="margin-top: 30px;">

                        <button type="submit" class="btn btn-sm btn-success btn-flat ">Save</button>

                        <button type="button" class="btn btn-sm btn-warning btn-flat btn-cancel btn-clear pull-right">Clear</button>

                      </div>

                    </form>

                          </div>

                        </div>

                      </div>

            </div>

                  </div><!-- /.box-body -->



                  <div class="box-footer">

                  </div>



                </div><!-- /.box -->



            </section>

        </div>



                <div class="tab-pane" id="roomprice">

                    <section id="new">

                        <div class="box box-primary">





                  <div class="box-body">

                                        <div class="row">

            <div class="col-xs-12">

              <form role="form-horizontal" action="{!! url('/admin/price/do_Simpan') !!}" method="POST" id="formrates">

                <input type="hidden" name="_token" id="token" value="{{{ csrf_token() }}}">

          

                <div class="box">

                  <div class="box-header">

                    <h3 id="title_price"></h3>

                  </div><!-- /.box-header -->

                  <div class="box-body">

                    <table id="table_price" class="table table-bordered table-striped">

                      <thead>

                        <tr>

                          <th>No</th>

                          <th>Room Type</th>

                          <th>Validity</th>

                          <th>Best Value (IDR)</th>

                          <th>Best Price (IDR)</th>

                          <th>Very Last<br>Minutes (IDR)</th>

                          <th>Amenities (IDR)</th>

                          <th>Breakfast (IDR)</th>

                          <th>Allotment</th>

                          <th style="text-align: center;"><button type="button" class="btn btn-flat btn-xs btn-block btn-addprice btn-success"><i class="fa fa-plus">Add New</i></button></th>

                        </tr>

                      </thead>

                      <tbody>

                        

                      </tbody>

                    </table>

                  </div><!-- /.box-body -->

                </div><!-- /.box -->

          

                <div class="collapse" id="form_price" name="form_price">

                  <div class="box box-primary">

                    <div class="box-header with-border">

                      <h3 class="box-title judul"></h3>

                    </div><!-- /.box-header -->

                    <!-- form start -->

                    <div class="box-body">

                      <input type="hidden" name="mode_form" id="mode_form" class="form-control" value="tambah">

                      <input type="hidden" name="id_price" id="id_price" class="form-control">

                      

                      <table>

                        <tbody>

                          <tr>

                            <td> <br> </td>

                          </tr>



                          <tr>

                            <td width="15%">Validity From</td>

                            <td width="15%">

                              <div class="form-group" style="width: 150px; padding-top: 15px;">

                                <div class="input-group">

                                  <input type="text" class="rate form-control" id="validity_from" name="valid_from" readonly>

                                  <span class="input-group-addon">

                                    <span class="glyphicon glyphicon-calendar pull-left">

                                      </span>

                                  </span>

                                </div>

                              </div>

                            </td>

                            <td width="5%"></td>

                            <td width="15%">Best Value</td>

                            <td width="15%"><input type="text" name="best_price" id="best_price" class="form-control" readonly onchange="FormatCurrency(this)"></td>

                            <td width="5%"></td>

                            <td width="15%">Allotment</td>

                            <td width="15%"><input type="number" name="allotment" id="allotment" class="form-control"></td>

                          </tr>



                          <tr>

                           <td> <br> </td>

                          </tr>



                          <tr>

                            <td width="15%">Validity To</td>

                            <td width="15%">

                              <div class="form-group" style="width: 150px">

                                <div class="input-group">

                                  <input type="text" class="rate form-control" id="validity_to" name="valid_to" readonly>

                                  <span class="input-group-addon">

                                    <span class="glyphicon glyphicon-calendar pull-left"></span>

                                  </span>

                                </div>

                              </div>

                            </td>

                            <td width="5%"></td>

                            <td width="15%">Best Price*</td>

                            <td width="15%"><input type="text" name="best_value" id="best_value" class="form-control" required onkeyup="FormatCurrency(this)" value="0"></td>

                            <td width="5%"></td>

                            <td width="15%"></td>

                            <td width="15%"></td>

                          </tr>

                          <tr>

                           <td> <br> </td>

                          </tr>

                          <tr>

                            <td width="15%">Room*</td>

                            <td width="15%">

                              <select class="form-control" id="select_room" name="room">

                                @if(!empty($data['room']))

                                  @foreach($data['room'] as $room)

                                    <option value="{{{ $room->id }}}">{{{ $room->room_name }}}</option>

                                  @endforeach

                                @endif

                              </select>

                            </td>

                            <td width="5%"></td>

                            <td width="15%">Amenities*</td>

                            <td width="15%"><input type="text" name="amenities" id="amenities" class="form-control" required onkeyup="FormatCurrency(this)" value="0"></td>

                            <td width="5%"></td>

                            <td width="15%"></td>

                            <td width="15%"></td>

                          </tr>



                          <tr>

                            <td> <br> </td>

                          </tr>



                          <tr>

                            <td width="15%">Very Last <br>Minutes Value*</td>

                            <td width="15%"><input type="text" name="vlm_value" id="vlm_value" class="form-control" required onkeyup="FormatCurrency(this)" style="width: 150px" value="0"></td>

                            <td width="5%"></td>

                            <td width="15%">Breakfast*</td>

                            <td width="15%"><input type="text" name="breakfast" id="breakfast" class="form-control" required onkeyup="FormatCurrency(this)" value="0"></td>

                            <td width="5%"></td>

                            <td width="15%"></td>

                            <td width="15%"></td>

                          </tr>

                        </tbody>

                      </table>

                    </div><!-- /.box-body -->



                    <div class="box-footer">

                      <button type="button" class="btn btn-default btn-close pull-left" data-dismiss="modal">Cancel</button>

                      <button type="button" class="btn btn-primary pull-right btn-save-price">Submit</button>

                    </div>

                  </div><!-- /.box -->

                </div>

              </form>

            </div>

          </div>

                  </div>

               </div>

            </section>



                  </div>









                </div>

              </div>

            </div>

            













          </div>

                </div>



            </div>

        </div>





<!-- Modal -->

<div id="myModal" class="modal fade" role="dialog">

  <div class="modal-dialog">



    <!-- Modal content-->

   <form role="form-horizontal" action="#" id="formpromo" enctype="multipart/form-data">

    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

    <input type="hidden" name="id_hotel" id="id_hotel" class="form-control" placeholder="id_hotel">

     <input type="hidden" name="mode_form" id="mode_form1" class="form-control" placeholder="mode_form" value="tambah">

    <div class="modal-content" style="width: 850px;">

      <div class="modal-header">

        <button type="button" class="close tutup" data-dismiss="modal">&times;</button>

        <h4 class="modal-title"></h4>

      </div>

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

                          </div><!-- /.box-header -->

                <!-- form start -->



                    <div class="box-body">

                      <table>

                    <tbody>

                      <tr>

                        <td width="10%">Country*</td>

                        <td width="20%">

                          <select id="country_hotel" name="country_hotel" class="form-control" style="width: 150px;">

                            @foreach($data['country'] as $row)

                               <option value="{{{ $row->id }}}" @if($row->id == "1") selected @endif> {{{ $row->name }}}</option>

                            @endforeach

                          </select>

                        </td>

                        <td width="5%">City*</td>

                        <td width="20%">

                          <select  id="city_hotel" name="city_hotel" class="form-control" style="width: 150px;">

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

                  </div><!-- /.box-body -->



                  <div class="box-footer">

                  </div>



                </div><!-- /.box -->



                  <div class="box box-primary">

                      <div class="box-header with-border">

                        <h3 class="box-title">Detail</h3>

                      </div><!-- /.box-header -->

                <!-- form start -->

                  <div class="box-body">

                      <table width="100%">

                    <tbody>

                      <tr>

                        <td width="20%">Hotel Name*</td>

                        <td width="20%"><input type="text" style="width: 200px" id="name_hotel" name="name_hotel" class="form-control" required>

                        </td>

                        <td width="20%">Email*</td>

                        <td width="20%"><input type="email" style="width: 170px" id="email_hotel" name="email_hotel" class="form-control" required>

                       </td>

                      </tr>

                      <tr>

                      <td> <br> </td>

                      </tr>

                      <tr>

                        <td width="20%">Star</td>

                        <td width="20%">

                           <select class="form-control" style="width: 100px;" id="star_hotel" name="star_hotel">

                            <option value="0">0</option>

                            <option value="1">1</option>

                            <option value="2">2</option>

                            <option value="3">3</option>

                            <option value="4">4</option>

                            <option value="5">5</option>

                          </select>

                        </td>

                        <td width="20%">Telephone*</td>

                        <td width="20%"><input type="text" style="width: 170px" id="telephone_hotel" class="number form-control" name="telephone_hotel" required>

                       </td>

                      </tr>

                      <tr>

                       <td> <br> </td>

                      </tr>



                           <tr>

                        <td width="20%">Area*</td>

                        <td width="20%">

                          <select  id="area_hotel" name="area_hotel" class="form-control" style="width: 150px;" required>

                           @foreach($data['area'] as $kota)

                             <option value="{{{ $kota->id }}}">{{{ $kota->name }}}</option>

                            @endforeach

                          </select>

                        </td>

                        <td width="20%">Longitude</td>

                        <td width="20%"><input type="text" style="width: 170px" id="longitude_hotel" name="longitude_hotel" class="form-control">

                        </td>

                      </tr>



                       <tr>

                       <td> <br> </td>

                      </tr>



                      <tr>

                        <td width="20%">Address*</td>

                        <td width="20%"><textarea style="width: 200px" id="address" placeholder="Road Name" name="address" class="form-control" required></textarea>

                        </td>

                        <td width="20%">Latitude</td>

                        <td width="20%"><input type="text" style="width: 170px" id="latitude_hotel" name="latitude_hotel" class="form-control">

                        </td>

                      </tr>



                      <tr>

                       <td> <br> </td>

                      </tr>



                           <tr>

                        <td width="20%">Cut of Date*</td>

                        <td width="20%">

                           <input type="number" style="width: 170px" id="cod_hotel" name="cod_hotel" class="form-control" value="3" required>

                        </td>

                        <td width="20%"></td>

                        <td width="20%"></td>

                      </tr>



                      <tr>

                       <td> <br> </td>

                      </tr>



                     <tr>

                        <td width="20%">Validity From*</td>

                        <td width="20%">

                          <div class="form-group" style="width: 150px">

                           <div class="input-group">

                             <input type="text" class="rate form-control" id="validity_from_hotel" name="validity_from" readonly required>

                             <span class="input-group-addon">

                              <span class="glyphicon glyphicon-calendar pull-left">

                              </span>

                             </span>

                           </div>

                          </div>

                        </td>

                        <td width="20%"></td>

                        <td width="20%"></td>

                     </tr>



                      <tr>

                       <td> <br> </td>

                      </tr>



                     <tr>

                        <td width="20%">Validity To*</td>

                        <td width="20%">

                          <div class="form-group" style="width: 150px">

                           <div class="input-group">

                             <input type="text" class="rate form-control" id="validity_to_hotel" name="validity_to" readonly required>

                             <span class="input-group-addon">

                              <span class="glyphicon glyphicon-calendar pull-left">

                              </span>

                             </span>

                           </div>

                          </div>

                        </td>

                        <td width="20%"></td>

                        <td width="20%"></td>

                     </tr>

                    </tbody>

                  </table>

                  </div><!-- /.box-body -->



                  <div class="box-footer">

                <!--   <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

                  <button type="submit" class="btn btn-primary pull-right">Submit</button> -->

                </div>



              </div><!-- /.box -->

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

                            <input type="file" id="hotel_photo" name="hotel_photo">

                            <input disabled type="hidden" id="max" name="max" value="">

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

                        <th style="text-align: center;">Picture</th>

                        <th style="text-align: center;">Action</th>

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

              </div><!-- /.box-header -->

        <!-- form start -->

          <div class="box-body">

              <table>

            <tbody>

              <tr>

                <td width="20%">Name</td>

                <td width="40%"><input type="text" style="width: 200px" id="cp_name" name="cp_name" class="form-control" placeholder="Contact Name" value="">

                </td>

                <td width="20%">Title</td>

                <td width="40%"><select class="form-control" style="width: 200px;" id="cp_title" name="cp_title" >

                        <option value="Mr">Mr.</option>

                        <option value="Ms">Ms.</option>

                        <option value="Mrs">Mrs</option>

                    </select>

               </td>

              </tr>



              <tr>

              <td> <br> </td>

              </tr>



              <tr>

                <td width="20%">Telephone</td>

                <td width="40%"><input type="text" style="width: 200px" id="cp_phone" name="cp_phone" class="number form-control" value="" placeholder="Contact Phone Number">

                </td>

              </tr>



              <tr>

              <td> <br> </td>

              </tr>



              <tr>

                <td width="20%">Email</td>

                <td width="40%"><input type="email" style="width: 200px" id="cp_mail" name="cp_mail" class="form-control" value="" placeholder="Contact Mail">

                </td>

              </tr>



            </tbody>

          </table>

          </div><!-- /.box-body -->



          <div class="box-footer">

        <!--   <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

          <button type="submit" class="btn btn-primary pull-right">Submit</button> -->

            </div>



          </div><!-- /.box -->

        </section>

        </div>









                </div>

              </div>

            </div>

          </div>

        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left btn-removable del-hotel" data-id="" data-name="" id="del-hotel">Delete Hotel</button>

          <button type="submit" class="btn btn-primary">Save changes</button>

          <!-- <button type="submit" class="btn btn-primary btn-save">Save changes</button> -->

        </div>

      </div>

    </div>

    </form>

  </div>

</div>



<section class="content">

          <div class="row">

            <div class="col-xs-12">

               <div class="box">


                <p>&nbsp;</p>
                <div class="row">
                  <div class="container">
                    <div class="col-md-4">
                      <select id="type" name="type" class="form-control">
                            <option>Pilih Tipe Vendor</option>
                            @foreach($data['vendor_type'] as $row)
                               <option value="{{{ $row->name }}}" @if($row->id == "1") selected @endif> {{{ $row->name }}}</option>
                            @endforeach
                      </select>
                      <hr />
                      <div id="Spa" class="type">Spa</div>
                      <div id="Restaurant" class="type">Restaurant</div>
                    </div>
                  </div>
                </div>

              <div id="Hotel" class="type2">
                <div class="box-header">

                  <h3 class="box-title">Hotel Setup</h3>

                </div><!-- /.box-header -->

                <div class="box-body">

                  <table id="hotelpromo" class="table table-bordered table-striped">

                    <thead>

                      <tr>

                        <th>No</th>

                        <th>Hotel Name</th>

                        <th>Hotel Code</th>

                        <th>Star</th>

                        <th>City</th>

                       <th><center><button type="button" class="btn btn-flat btn-xs btn-add btn-success" data-toggle="modal" data-target="#myModal" data-backdrop="static"><i class="fa fa-plus" id="addpro"></i> Hotel</button></center></th>

                      </tr>

                    </thead>

                    <tbody>



                    </tbody>

                  </table>

                </div><!-- /.box-body -->

              </div>

            </div><!-- /.box -->

     </div>

  </div>

</section>



<script src="{{ URL::asset('theme/admin/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>

<script>



  $(document).ready(function(){

    <?php if(Session::get('success')) { ?>

    toastr.success("<?php echo Session::get('success'); ?>");

    <?php } else if(Session::get('failed')) { ?>

      toastr.warning("<?php echo Session::get('failed'); ?>");

    <?php } ?>



    var InitController = function () {





                      var handleValidationgabung = function () {



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

                                url: '{!! url("/admin/room/do_SimpanRoom") !!}',

                                data: $('#formku').serializeArray(),

                                success: function (data) {

                                    if (data.success === true) {

                                        toastr.success(data.msgServer);

                                        handleClearForm();

                                        $('#tabelroom').dataTable().fnDraw();

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





      var handleValidation = function () {

        $('#formpromo').validate({

          errorElement: 'span', //default input error message container

          errorClass: 'help-block', // default input error message class

          focusInvalid: true, // do not focus the last invalid input

          ignore: "",

          rules: {

            mode_form: {

                required: true

            },

            country_hotel: {

                required: true

            },

            city_hotel: {

                required: true

            },

            name_hotel: {

                required: true

            },

            email_hotel: {

                required: true

            },

            telephone_hotel: {

                required: true

            },

            area_hotel: {

                required: true

            }

          },

          invalidHandler: function (event, validator) { //display error alert on form submit

              toastr.error("Please fill the empty field");

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

              url: '{!! url("admin/hotel/do_Simpan") !!}',

              data: new FormData($('#formpromo')[0]),

              async: true,

              beforeSend :function (data){

                $('#myModal').modal("hide");

                $.blockUI({

                  message: "<img src='{{ URL::to('images/spin.gif') }}' style='max-width: 50px; max-height: 50px; z-index: 99999'> Please Wait...",

                });

              },

              success: function (data) {

                var data = $.parseJSON(data);

                if (data.success === true) {

                  $('#hotelpromo').dataTable().fnDraw();

                   $('#hotel_photo').val('');

                  $('#myModal').modal("hide");

                  toastr.success(data.msgServer);

                  $.unblockUI();

                } else {

                  toastr.warning(data.msgServer);

                  $.unblockUI();

                }

              },

              contentType: false,

              processData: false

            });

          }

        });

      };



      var handleTable = function () {

        if (!jQuery().dataTable) {

          return;

        }



        $('#hotelpromo').dataTable({

          "aLengthMenu": [

            [2,5, 10, 15, 20, 25, 50, -1],

            [2,5, 10, 15, 20, 25, 50, "All"] // change per page values here

          ],

          "bProcessing": true,

          "bServerSide": true,

          "sServerMethod": "get",

          //"bRetrieve": false,

          "destroy": true,

          "sAjaxSource": "{!! url('/admin/hotel/do_Tabel') !!}",

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

              "aTargets": [0, -1]

            }]

        });



        $('body').on('click', '#roompricetab', function(){

          var hotel = $(this).attr('data-id');



          $('#table_price').dataTable({

            "aLengthMenu": [

              [2,5, 10, 15, 20, 25, 50, -1],

              [2,5, 10, 15, 20, 25, 50, "All"] // change per page values here

            ],

            "bProcessing": true,

            "bServerSide": true,

            "sServerMethod": "post",

            //"bRetrieve": false,

            "destroy": true,

            "sAjaxSource": "{!!url("admin/price/list/")!!}/"+hotel,

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

                "aTargets": [0, -1]

              }]

          });



          $.ajax({

            method: 'get',

            //dataType : 'json',

            url: "{{{ url('admin/price/getroom') }}}",

            data: {"id_hotel" : hotel},

            success: function (data) {

              $('#select_room').html(data);

            },

          });

        });



        $('body').on('click', '.btn-detailable', function(){

          $id = $(this).attr("data-id");

          $.ajax({

            method: 'POST',

            dataType: 'json',

            url: '{!! url("/admin/room/do_DetailHotel") !!}',

            data: {'id': $id},

            success: function (data) {

              if (data.success === true) {

                tableRoom($id);

                $('#hotel').val($id);

                $('#myModalgabung').modal({backdrop: 'static', keyboard: false});

              } else {

                toastr.warning(data.msgServer);

              }

            },

            fail: function (e) {

              toastr.error(e);

            }

          });



          // $('#mode_form').val('ubah');

          $('#myModalgabung a:first').tab('show');

          $('.modal-title').html('Price List');

          $('#form_price').hide();



          var hotel = $(this).attr('data-id');

          $('#roompricetab').attr("data-id", hotel)

         

          $('.btn-addprice').click(function(){

            var val_from = $(this).attr('valid_from');

            var val_to = $(this).attr('valid_to');

            $('#id_price').val('');



            $('#formrates').each(function () {

                this.reset();

            });



            $('#title_price').html('Add Price List');

            handleClearFormPrice();

            //$('#myModalgabung a:first').tab('show');

            $(".collapse").show('toggle');



            $.ajax({

              method: 'get',

              //dataType : 'json',

              url: "{{{ url('admin/price/getlistroom') }}}/"+hotel,

              success: function (data) {

                $('#select_room').html(data);

              },

            });



            $(function(){

              var startDate = new Date();

              var FromEndDate = new Date();

              var ToEndDate = new Date(val_to);

              var valid_from = new Date(val_from);

              var valid_to = new Date(val_to);



              $('#validity_from').datepicker({

                startDate: valid_from,

                endDate: valid_to,

                todayHighlight: true,

                autoclose: true,

                format: "M-yyyy",

                startView: "months", 

                minViewMode: "months"

              }).on("changeDate", function(selected) {

                startDate = new Date(selected.date.valueOf());

                startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));

                $( "#validity_to" ).datepicker(  "setStartDate",  startDate ); 

              });



              $('#validity_to').datepicker({

                startDate: startDate,

                endDate: valid_to,

                todayHighlight: true,

                autoclose: true,

                format: "M-yyyy",

                startView: "months", 

                minViewMode: "months"

               }).on('changeDate', function(selected){

                  FromEndDate = new Date(selected.date.valueOf());

                  FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));

                  $('#validity_from').datepicker('setEndDate', valid_to);

                }); 

            });

          });



          $('body').on('click', '.price-edit', function(){

            $('.collapse').show('toggle');

            var id_priment = $(this).attr('data-id');

            var id_hotel = $(this).attr('data-id-hotel');



            $('#id_price').val(id_priment);

    

            $.ajax({

              method: 'get',

              dataType : 'json',

              url: "{{{ url('admin/price/do_Ubah') }}}",

              data: {"id_priment" : id_priment, "id_hotel" : id_hotel},

              success: function (data) {

                $('#select_room').html(data.room);

                var val_from = data.results.valid_from;

                var val_to = data.results.valid_to;



                $(function(){

                  var startDate = new Date();

                  var FromEndDate = new Date();

                  var ToEndDate = new Date(val_to);

                  var valid_from = new Date(val_from);

                  var valid_to = new Date(val_to);



                  $('#validity_from').datepicker({

                    startDate: valid_from,

                    endDate: valid_to,

                    todayHighlight: true,

                    autoclose: true,

                    format: "M-yyyy",

                    startView: "months", 

                    minViewMode: "months"

                  }).on("changeDate", function(selected) {

                    startDate = new Date(selected.date.valueOf());

                    startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));

                    $( "#validity_to" ).datepicker(  "setStartDate",  startDate ); 

                  });



                  $('#validity_to').datepicker({

                    startDate: startDate,

                    endDate: valid_to,

                    todayHighlight: true,

                    autoclose: true,

                    format: "M-yyyy",

                    startView: "months", 

                    minViewMode: "months"

                   }).on('changeDate', function(selected){

                      FromEndDate = new Date(selected.date.valueOf());

                      FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));

                      $('#validity_from').datepicker('setEndDate', valid_to);

                    }); 

                });



                $('#validity_from').val(data.results.valid_from);

                $('#validity_to').val(data.results.valid_to);

                $('#select_room').val(data.results.room);

                $('#vlm_value').val(data.results.vlm_value);

                $('#best_price').val(data.results.best_price);

                $('#best_value').val(data.results.best_value);

                $('#amenities').val(data.results.amenities);

                $('#breakfast').val(data.results.breakfast);

                $('#allotment').val(data.results.allotment);

              },

            });

          });



          $('body').on('keyup', '#best_value', function(){

            var jml = parseFloat($('#best_value').val().replace(/,/g, '')) + parseFloat($('#amenities').val().replace(/,/g, '')) + parseFloat($('#breakfast').val().replace(/,/g, ''));

            $('#best_price').val(jml);

          });



          $('body').on('keyup', '#amenities', function(){

            var jml = parseFloat($('#best_value').val().replace(/,/g, '')) + parseFloat($('#amenities').val().replace(/,/g, '')) + parseFloat($('#breakfast').val().replace(/,/g, ''));

            $('#best_price').val(jml);

          });



          $('body').on('keyup', '#breakfast', function(){

            var jml = parseFloat($('#best_value').val().replace(/,/g, '')) + parseFloat($('#amenities').val().replace(/,/g, '')) + parseFloat($('#breakfast').val().replace(/,/g, ''));

            $('#best_price').val(jml);

          });



          $('body').on('click', '.btn-save-price', function(){

            if($('#select_room').val() == "0"){

              toastr.warning("Room not Available")

            }else{

              $.ajax({

                method: 'POST',

                //dataType: 'json',

                url: $('#formrates').attr('action'),

                data: new FormData($('#formrates')[0]),

                //async: false,

                success: function (data) {

                  var data = $.parseJSON(data);

                  if (data.success == "true") {

                    //$('#myModalgabung').toggle('hide');

                    $(".collapse").hide();

                    $('#table_price').dataTable().fnDraw();

                    toastr.success(data.msgServer);

                  } else {

                    $(".collapse").hide();

                    toastr.warning(data.msgServer);

                  }

                },

                contentType: false,

                processData: false

              });

            }

          });

        });



                    $('body').on('click', '.btn-add-room', function(){

                        $('#mode_form').val('tambah');

                        $('#id').val('');

                        $('#name').val('');

                    });



                    $('body').on('click', '.btn-clear', function(){

                        $('#mode_form').val('tambah');

                        $('#id').val('');

                        $('#name').val('');

                    });





                    $('body').on('click', '.btn-cancel', function(){

                      $('#mode_form').val('tambah');

                        handleClearForm();

                    });



                    $('body').on('click', '.btn-editableroom', function(){

                        $('#mode_form').val('ubah');

                        $.ajax({

                            method: 'POST',

                            dataType: 'json',

                            url: '{!! url("/admin/room/do_UbahRoom") !!}',

                            data: {'id': $(this).attr("data-id")},

                            success: function (data) {

                                if (data.success === true) {

                                    $('#id').val(data.results.id);

                                    $('#name').val(data.results.name);

                                } else {

                                    toastr.warning(data.msgServer);

                                }

                            },

                            fail: function (e) {

                                toastr.error(e);

                            }

                        });

                    });



                    $('body').on('click', '.btn-removableroom', function () {



                        var id = $(this).attr("data-id");

                        var name = $(this).attr("data-name");

                        bootbox.dialog({

                            message: "Apakah anda yakin menghapus </br>Room : <b>" + name + "</b> ?",

                            title: "Delete Confirmation",

                            buttons: {

                                success: {

                                    label: "Yes",

                                    className: "btn-success btn-flat",

                                    callback: function () {

                                        $.ajax({

                                            method: 'POST',

                                            dataType: 'json',

                                            url: '{!! url("/admin/room/do_HapusRoom") !!}',

                                            data: {'id': id},

                                            success: function (data) {

                                                if (data.success === true) {

                                                    toastr.success(data.msgServer);



                                                    $('#tabelroom').dataTable().fnDraw();

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







        $('body').on('click', '.btn-delphoto', function () {

          var photo_name = $(this).attr('data-name-photo');

          var photo_id = $(this).attr('data-id-photo');



          bootbox.dialog({

            message: "Are you sure to delete <br><b> " +photo_name +" </b> ?",

            title: "Delete Confirmation",

            buttons: {

              success: {

                label: "Yes",

                className: "btn-success btn-flat",

                callback: function () {

                  $.ajax({

                    method: 'get',

                    dataType: 'json',

                    url: '{!! url("admin/hotel/deletephoto") !!}/'+photo_id,

                    //data: {'id_photo': photo_id},

                    success: function (data) {

                      if (data.success === true) {

                        toastr.success(data.msgServer);



                        window.location.reload();

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



        $('body').on('click', '.btn-removable', function () {

          var id_hotel = $(this).attr("data-id");

          var hotel_name = $(this).attr("data-name");

          bootbox.dialog({

              message: "Are you sure to delete <br><b> " +hotel_name +" </b> ?",

              title: "Delete Confirmation",

              buttons: {

                  success: {

                      label: "Yes",

                      className: "btn-success btn-flat",

                      callback: function () {

                          $.ajax({

                              method: 'get',

                              dataType: 'json',

                              url: '{!! url("admin/hotel/deletehotel") !!}',

                              data: {'id_hotel': id_hotel},

                              success: function (data) {

                                  if (data.success === true) {

                                      toastr.success(data.msgServer);

                                      $('#hotelpromo').dataTable().fnDraw();

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

      

        $('body').on('click', '.btn-add', function(){

          $('#id_hotel').val('');

          $('.modal-title').html('Room Setup');

          $('.del-hotel').hide();

          $('#myModal a:first').tab('show');

          $('#hotel_country').prop('disabled', false);

          $('#hotel_city').prop('disabled', false);

          $('#hotel_code').prop('disabled', false);

          $('#form_price').each(function(){

            handleClearForm();

          });



          $('#hotel_country').removeAttr('disabled');

          $('#hotel_city').removeAttr('disabled');

          $('#hotel_name').removeAttr('disabled');

          $('#hotel_email').removeAttr('disabled');

          $('#contact_name').removeAttr('disabled');

          $('#contact_title').removeAttr('disabled');

          $('#contact_phone').removeAttr('disabled');

          $('#contact_department').removeAttr('disabled');

          $('#contact_mail').removeAttr('disabled');



          $(function(){

            var startDate = new Date();

            var FromEndDate = new Date();

            var ToEndDate = new Date();

            var valid_from = new Date();

            var valid_to = new Date();

            //ToEndDate.setDate(ToEndDate.getDate()+365);



            $('#validity_from_hotel').datepicker({

              startDate: valid_from,

              //endDate: valid_to,

              todayHighlight: true,

              autoclose: true,

              format: "M-yyyy",

              startView: "months", 

              minViewMode: "months"

            }).on("changeDate", function(selected) {

              startDate = new Date(selected.date.valueOf());

              startDate.setDate(startDate.getDate(new Date(selected.date.valueOf()))+365);

              $( "#validity_to_hotel" ).datepicker(  "setStartDate",  startDate ); 

            });



            $('#validity_to_hotel').datepicker({

              startDate: startDate,

              //endDate: valid_to,

              todayHighlight: true,

              autoclose: true,

              format: "M-yyyy",

              startView: "months", 

              minViewMode: "months"

             }).on('changeDate', function(selected){

                FromEndDate = new Date(selected.date.valueOf());

                FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));

                $('#validity_from_hotel').datepicker('setEndDate', FromEndDate);

              }); 

          });

        });



        $('body').on('change', '#hotel_photo', function(){

          if(this.files[0].type.indexOf("image")==-1){

            alert("Please select images file");

            $(this).val("");

          }

        });



        $('body').on('click', '.tutup', function(){

          $('#tabel_photo').html("");

          $('#hotel_photo').val("");

        });



        $('body').on('click', '.btn-detail', function(){

          $('#myModal a:first').tab('show');

          $('.modal-title').html('Edit Hotel');



          $.ajax({

            method: 'get',

            dataType: 'json',

            url: '{!! url("admin/hotel/do_Ubah") !!}',

            data: {'id_hotel': $(this).attr("data-id")},

            success: function (data) {

              if (data.success === true) {

                $('#id_hotel').val(data.results.id_hotel);

                $('#name_hotel').val(data.results.name_hotel);

                $('#star_hotel').val(data.results.star_hotel);

                $('#city_hotel').val(data.results.city_hotel);

                $('#country_hotel').val(data.results.country_hotel);

                $('#email_hotel').val(data.results.email_hotel);

                $('#telephone_hotel').val(data.results.telephone_hotel);

                $('#address').val(data.results.address);

                $('#latitude_hotel').val(data.results.hotel_lat);

                $('#longitude_hotel').val(data.results.hotel_lgt);

                $('#area_hotel').val(data.results.area_hotel);

                $('#cod_hotel').val(data.results.cod_hotel);

                $('#cp_name').val(data.results.cp_name);

                $('#cp_title').val(data.results.cp_title);

                $('#cp_department').val(data.results.cp_department);

                $('#cp_mail').val(data.results.cp_mail);

                $('#cp_phone').val(data.results.cp_phone);

                $('#validity_from').val(data.results.valid_from);

                $('#validity_to').val(data.results.valid_to);



                $('#id_hotel').attr('disabled', 'true');

                $('#name_hotel').attr('disabled', 'true');

                $('#star_hotel').attr('disabled', 'true');

                $('#city_hotel').attr('disabled', 'true');

                $('#country_hotel').attr('disabled', 'true');

                $('#email_hotel').attr('disabled', 'true');

                $('#telephone_hotel').attr('disabled', 'true');

                $('#address').attr('disabled', 'true');

                $('#latitude_hotel').attr('disabled', 'true');

                $('#longitude_hotel').attr('disabled', 'true');

                $('#area_hotel').attr('disabled', 'true');

                $('#cod_hotel').attr('disabled', 'true');

                $('#cp_name').attr('disabled', 'true');

                $('#cp_title').attr('disabled', 'true');

                $('#cp_department').attr('disabled', 'true');

                $('#cp_mail').attr('disabled', 'true');

                $('#cp_phone').attr('disabled', 'true');

                $('#validity_from').attr('disabled', 'true');

                $('#validity_to').attr('disabled', 'true');



              } else {

                toastr.warning(data.msgServer);

              }

            },

            fail: function (e) {

              toastr.error(e);

            }

          });

        });



        $('body').on('click', '.btn-editable', function(){

          $('#mode_form1').val('ubah');

          $('.del-hotel').show();

          $('#myModal a:first').tab('show');

          $('.modal-title').html('Edit Hotel');



          $.ajax({

            method: 'get',

            dataType: 'json',

            url: '{!! url("admin/hotel/do_Ubah") !!}',

            data: {'id_hotel': $(this).attr("data-id")},

            success: function (data) {

              if (data.success === true) {

                $(function(){

                  var startDate = new Date();

                  var FromEndDate = new Date();

                  var ToEndDate = new Date();

                  var valid_from = new Date(data.results.valid_from);

                  var valid_to = new Date(data.results.valid_from);

                  ToEndDate.setDate(ToEndDate.getDate()+365);



                  $('#validity_from_hotel').datepicker({

                    startDate: valid_from,

                    //endDate: valid_to,

                    todayHighlight: true,

                    autoclose: true,

                    format: "M-yyyy",

                    startView: "months", 

                    minViewMode: "months"

                  }).on("changeDate", function(selected) {

                    startDate = new Date(selected.date.valueOf());

                    startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));

                    $( "#validity_to_hotel" ).datepicker(  "setStartDate",  ToEndDate ); 

                  });



                  $('#validity_to_hotel').datepicker({

                    startDate: ToEndDate,

                    //endDate: valid_to,

                    todayHighlight: true,

                    autoclose: true,

                    format: "M-yyyy",

                    startView: "months", 

                    minViewMode: "months"

                   }).on('changeDate', function(selected){

                      FromEndDate = new Date(selected.date.valueOf());

                      FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));

                      $('#validity_from_hotel').datepicker('setEndDate', FromEndDate);

                    }); 

                });



                $('#id_hotel').val(data.results.id_hotel);

                $('#del-hotel').attr("data-id", data.results.id_hotel);

                $('#name_hotel').val(data.results.name_hotel);

                $('#del-hotel').attr("data-name", data.results.name_hotel);

                $('#star_hotel').val(data.results.star_hotel);

                $('#city_hotel').val(data.results.city_hotel);

                $('#country_hotel').val(data.results.country_hotel);

                $('#email_hotel').val(data.results.email_hotel);

                $('#telephone_hotel').val(data.results.telephone_hotel);

                $('#address').val(data.results.address);

                $('#latitude_hotel').val(data.results.hotel_lat);

                $('#longitude_hotel').val(data.results.hotel_lgt);

                $('#area_hotel').val(data.results.area_hotel);

                $('#cod_hotel').val(data.results.cod_hotel);

                $('#cp_name').val(data.results.cp_name);

                $('#cp_title').val(data.results.cp_title);

                $('#cp_department').val(data.results.cp_department);

                $('#cp_mail').val(data.results.cp_mail);

                $('#cp_phone').val(data.results.cp_phone);

                $('#validity_from_hotel').val(data.results.valid_from);

                $('#validity_to_hotel').val(data.results.valid_to);



                hotel = data.results.id_hotel;

                url='{!!url("admin/hotel/photo/")!!}';



                $.ajax({

                  method: 'GET',

                  url: url+"/"+hotel,

                  success: function (results) {

                    // alert(data);

                    $("#tabel_photo").html(results);

                  },

                  fail: function (e) {

                    toastr.error(e);

                  }

                });



                $('#hotel_country').attr('disabled', "true");

                $('#hotel_city').attr('disabled', "true");

                $('#hotel_name').attr('disabled', "true");

                $('#hotel_email').attr('disabled', "true");

                // $('#cp_name').attr('disabled', "true");

                // $('#cp_title').attr('disabled', "true");

                $('#cp_phone').attr('disabled', "true");

                // $('#cp_department').attr('disabled', "true");

                $('#cp_mail').attr('disabled', "true");



              } else {

                toastr.warning(data.msgServer);

              }

            },

            fail: function (e) {

              toastr.error(e);

            }

          });

        });









        $('body').on('click', '.tutup', function(){

          $('#tabel_photo').html("");

          $('#hotel_photo').val("");

        });





      };

      return {

        //main function to initiate the module

        init: function () {

          handleTable();

          handleValidation();

          handleValidationgabung();

        }

      };

    }();



    InitController.init();

  });

 </script>

 <script type="text/javascript">

   $("#hotel_country").change(function() {

    $.ajax({

      method: 'GET',

      url: 'hotel/change/'+$(this).val(),

      success: function (results) {

       $("#hotel_city").html(results);



      },fail: function(e){

         toastr.error(e);

      }

    });

   });



   function tableRoom ($hotel = "") {

            $('#tabelroom').dataTable({

                "bLengthChange": false,

                "bProcessing": true,

                "bServerSide": true,

                "sServerMethod": "POST",

                //"bRetrieve": false,

                "destroy": true,

                "sAjaxSource": "{!! url('/admin/room/do_TableRoom') !!}",

                // set the initial value

                "iDisplayLength": 50,

                "fnServerParams": function ( aoData ) {

                    aoData.push({name: "hotel", value: $hotel})

                },

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

        }



                function handleClearForm() {

            $('#formku').each(function () {

                this.reset();

            });

            $('#mode_form').val('tambah');

            $('#id').val('');

        }







           $("#hotel_country").change(function() {

    $.ajax({

      method: 'GET',

      url: 'hotel/change/'+$(this).val(),

      success: function (results) {

       $("#hotel_city").html(results);



      },fail: function(e){

         toastr.error(e);

      }

    });

  });



  function FormatCurrency(objNum){

    var num = objNum.value

    var ent, dec;

    if (num != '' && num != objNum.oldvalue)

    {

      num = MoneyToNumber(num);

      if (isNaN(num))

      {

        objNum.value = (objNum.oldvalue) ? objNum.oldvalue : '';

      }else{

        var ev = (navigator.appName.indexOf('Netscape') != -1) ? Event : event;

        if (ev.keyCode == 190 || !isNaN(num.split('.')[1])){

            objNum.value = AddCommas(num.split('.')[0]) + '.' + num.split('.')[1];

        }

        else{

            objNum.value = AddCommas(num.split('.')[0]);

        }

        objNum.oldvalue = objNum.value;

      }

    }

  }

  function MoneyToNumber(num){

    return (num.replace(/,/g, ''));

  }



  function AddCommas(num){

    numArr = new String(num).split('').reverse();

    for (i = 3; i < numArr.length; i += 3){

      numArr[i] += ',';

    }

    return numArr.reverse().join('');

  }

  function handleClearForm() {

        $('#formpromo').each(function () {

            this.reset();

        });

        $('#mode_form').val('tambah');

        $('#id').val('');

    }



    function handleClearFormPrice() {

        $('#formrates').each(function () {

            this.reset();

        });

        $('#mode_form').val('tambah');

        $('#id').val('');

    }

 </script>





<script>
    (function()
    {
      $('div.type').hide();
      $('#type').change(function()
      {
          $('div.type').hide();
          $('div.type2').hide();
          $('#'+$(this).val()).toggle();
      });
    })();
    </script>

@endsection


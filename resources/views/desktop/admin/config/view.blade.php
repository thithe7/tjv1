@extends("layout.adminLayout")

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{{$data['title']}}}
            <small>{{{$data['subtitle']}}}</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">List {{{$data['title']}}}</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <form action="#" id="formku">
                    <!-- Custom Tabs -->
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#basic" data-toggle="tab">Basic</a></li>
                            <li><a href="#about" data-toggle="tab">About</a></li>
                            <li><a href="#email" data-toggle="tab">Email</a></li>
                            <li><a href="#office" data-toggle="tab">Office</a></li>
                            <li><a href="#maps" data-toggle="tab">Maps</a></li>
                            <li><a href="#payment_gateway" data-toggle="tab">Payment Gateway</a></li>
                            <li><a href="#prefixtransaction" data-toggle="tab">Prefix & Transction No</a></li>
                            <li><a href="#point" data-toggle="tab">Point</a></li>
                            <li><a href="#vlm" data-toggle="tab">Very Last Minute</a></li>
                            <li><a href="#mad" data-toggle="tab">Max Allotment Default</a></li>
                        </ul>
                        <p>&nbsp;</p>
                        <div class="tab-content">
                            <div class="tab-pane active" id="basic">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Website Address</label>
                                            <input type="text" class="form-control" id="link" name="link" value="{{{$data['config']->link}}}"></input>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">    
                                            <label>Footer</label>
                                            <input type="text" class="form-control" id="footer" name="footer" value="{{{$data['config']->footer}}}"></input>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col -->
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2 style="text-align: center;">SEO</h2>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Website Name</label>
                                            <input type="text" class="form-control" id="websitename" name="websitename" name="footer" value="{{{$data['config']->websitename}}}"></input>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Meta Title</label>
                                            <input type="text" class="form-control" id="seo_title" name="seo_title" name="footer" value="{{{$data['config']->seo_title}}}"></input>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Meta Keywords</label>
                                            <input type="text" class="form-control" id="seo_keywords" name="seo_keywords" name="footer" value="{{{$data['config']->seo_keywords}}}"></input>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Meta Description</label>
                                            <textarea class="form-control" id="seo_desc" name="seo_desc" name="footer" value="{{{$data['config']->seo_desc}}}"></textarea>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col -->
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2 style="text-align: center;">Maintenance</h2>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Maintenance IP</label>
                                            <label class="pull-right">Active Maintenance
                                                @if($data['config']->maintenance_status === true)
                                                <input class="minimal" type="checkbox" id="maintenance_status" name="maintenance_status" checked value="true"></input>
                                                @else
                                                <input class="minimal" type="checkbox" id="maintenance_status" name="maintenance_status" value="true"></input>
                                                @endif
                                            </label>
                                            <input type="text" class="form-control" id="maintenance_ip" name="maintenance_ip" value="{{{$data['config']->maintenance_ip}}}"></input>
                                        </div><!-- /.form-group -->
                                        <small>IP addresses allowed to access the website even if the website is disabled. Please use a comma to separate them</small>
                                    </div><!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Announcement</label>
                                            <textarea class="form-control" id="announcement" name="announcement">{{{$data['config']->announcement}}}</textarea>
                                        </div><!-- /.form-group -->
                                        <small>Announcement show on the homepage, if one of vendor is in a maintenance schedule. Leave it blank, if there is no maintenance</small>
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                            </div><!-- /.tab-pane -->
                            <div class="tab-pane" id="about">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" class="form-control" id="title" name="title" value="{{{$data['about']->title}}}"></input>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="tinymce" id="description" name="description">{{{$data['about']->description}}}</textarea>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                            </div><!-- /.tab-pane -->
                            <div class="tab-pane" id="email">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2 style="text-align: center;">Email</h2>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email sender's name</label>
                                            <input type="text" class="form-control" id="emailname" name="emailname" value="{{{$data['config']->emailname}}}"></input>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{{$data['config']->email}}}"></input>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email Type</label>
                                            <br/>
                                            <div class="col-md-6">
                                                <label>SMTP
                                                    @if($data['config']->smtp === true)
                                                    <input type="radio" checked class="minimal" value="true" id="smtp" name="smtp"></input>
                                                    @else
                                                    <input type="radio" class="minimal" value="true" id="smtp" name="smtp"></input>
                                                    @endif
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Mail
                                                    @if($data['config']->smtp === false)
                                                    <input type="radio" class="minimal" value="false" id="smtp" name="smtp" checked></input>
                                                    @else
                                                    <input type="radio" class="minimal" value="false" id="smtp" name="smtp"></input>
                                                    @endif
                                                </label>
                                            </div>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Smtp Host</label>
                                            <input type="text" class="form-control" id="smtp_host" name="smtp_host" value="{{{$data['config']->smtp_host}}}"></input>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Smtp Port</label>
                                            <input type="text" class="form-control" id="smtp_port" name="smtp_port" value="{{{$data['config']->smtp_port}}}"></input>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Smtp User</label>
                                            <input type="text" class="form-control" id="smtp_user" name="smtp_user" value="{{{$data['config']->smtp_user}}}"></input>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Smtp Password</label>
                                            <input type="text" class="form-control" id="smtp_pass" name="smtp_pass" value="{{{$data['config']->smtp_pass}}}"></input>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Use Email</label>
                                            <br/>
                                            @if($data['config']->use_email === true)
                                            <input type="checkbox" class="minimal" checked id="use_email" name="use_email" value="true"></input>
                                            @else
                                            <input type="checkbox" class="minimal" id="use_email" name="use_email" value="true"></input>
                                            @endif
                                        </div>
                                    </div>
                                </div><!-- /.row -->
                                <hr />
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2 style="text-align: center;">Email Newsletter</h2>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email sender's name</label>
                                            <input type="text" class="form-control" id="news_emailname" name="news_emailname" value="{{{$data['config']->news_emailname}}}"></input>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" id="news_email" name="news_email" value="{{{$data['config']->news_email}}}"></input>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email Type</label>
                                            <br/>
                                            <div class="col-md-6">
                                                <label>SMTP
                                                    @if($data['config']->news_smtp === true)
                                                    <input type="radio" checked class="minimal" value="true" id="news_smtp" name="news_smtp" checked></input>
                                                    @else
                                                    <input type="radio" class="minimal" value="true" id="news_smtp" name="news_smtp"></input>
                                                    @endif
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Mail
                                                    @if($data['config']->news_smtp === false)
                                                    <input type="radio" class="minimal" value="false" id="news_smtp" name="news_smtp" checked></input>
                                                    @else
                                                    <input type="radio" class="minimal" value="false" id="news_smtp" name="news_smtp"></input>
                                                    @endif
                                                </label>
                                            </div>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Smtp Host</label>
                                            <input type="text" class="form-control" id="news_smtp_host" name="news_smtp_host" value="{{{$data['config']->news_smtp_host}}}"></input>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Smtp Port</label>
                                            <input type="text" class="form-control" id="news_smtp_port" name="news_smtp_port" value="{{{$data['config']->news_smtp_port}}}"></input>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Smtp User</label>
                                            <input type="text" class="form-control" id="news_smtp_user" name="news_smtp_user" value="{{{$data['config']->news_smtp_user}}}"></input>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Smtp Password</label>
                                            <input type="text" class="form-control" id="news_smtp_pass" name="news_smtp_pass" value="{{{$data['config']->news_smtp_pass}}}"></input>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                            </div><!-- /.tab-pane -->
                            <div class="tab-pane" id="office">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Company Name</label>
                                            <input type="text" class="form-control" id="office_name" name="office_name" value="{{{$data['config']->office_name}}}"></input>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" id="office_email" name="office_email" value="{{{$data['config']->office_email}}}"></input>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" class="form-control" id="office_phone" name="office_phone" value="{{{$data['config']->office_phone}}}"></input>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Fax</label>
                                            <input type="text" class="form-control" id="office_fax" name="office_fax" value="{{{$data['config']->office_fax}}}"></input>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea class="form-control" id="office_address" name="office_address">{{{$data['config']->office_address}}}</textarea>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                            </div><!-- /.tab-pane -->
                            <div class="tab-pane" id="payment_gateway">
                                <div class="row">
                                    @foreach($data['payment'] as $row)
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>{{{$row->payment_name}}}<input type="hidden" id="id_type" name="id_type[]" value="{{{$row->id_type}}}"></input></label>
                                                <select class="form-control" id="status_payment_type_{{{$row->id_type}}}" name="status_payment_type[{{{$row->id_type}}}]">
                                                    @if($row->status == 0)
                                                        <option value="0" selected>Off</option>
                                                        <option value="1">Live</option>
                                                        <option value="2">Development</option>
                                                    @elseif($row->status == 1)
                                                        <option value="0">Off</option>
                                                        <option value="1" selected>Live</option>
                                                        <option value="2">Development</option>
                                                    @elseif($row->status == 2)
                                                        <option value="0">Off</option>
                                                        <option value="1">Live</option>
                                                        <option value="2" selected>Development</option>
                                                    @endif
                                                </select>
                                            </div><!-- /.form-group -->
                                        </div><!-- /.col -->
                                    @endforeach
                                </div><!-- /.row -->
                            </div><!-- /.tab-pane -->
                            <div class="tab-pane" id="prefixtransaction">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table style="width: 100%;">
                                            <tr style="height: 30px;">
                                                <td>Format Prefix</td>
                                                <td>%N : 000001</td>
                                            </tr>
                                            <tr style="height: 30px;">
                                                <td>Format Kode</td>
                                                <td>%M : Bulan, Jan</td>
                                                <td>%m : Bulan, 01</td>
                                                <td>%Y : Tahun, 2012</td>
                                                <td>%y : Tahun, 12</td>
                                            </tr>
                                            <tr style="height: 30px;">
                                                <td>Format Kode Romawi</td>
                                                <td>%rm : bulan, I</td>
                                                <td>%rY : Tahun, MMXII</td>
                                                <td>%ry : Tahun, XII</td>
                                            </tr>
                                            <tr style="height: 30px;">
                                                <td>Example</td>
                                                <td colspan="4">Transaction date january 2012, Prefix INV%m%Y, Result INV012012</td>
                                            </tr>
                                        </table>
                                        <hr/>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Prefix</label>
                                        <hr/>
                                        <div class="form-group">
                                            <label>Invoice <font color="red">*</font></label>
                                            <input type="text" class="form-control" id="inv_prefix" name="inv_prefix" value="{{{$data['config']->inv_prefix}}}"></input>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col -->
                                    <div class="col-md-6">
                                        <label>Invoice</label>
                                        <hr/>
                                        <div class="form-group">
                                            <label>Invoice</label>
                                            <input type="text" class="form-control" id="inv_code" name="inv_code" value="{{{$data['config']->inv_code}}}"></input>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                            </div><!-- /.tab-pane -->
                            
                            <div class="tab-pane" id="maps">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Latitude</label>
                                            <input type="text" class="form-control" id="maps_lat" name="maps_lat" value="{{{$data['config']->maps_lat}}}"></input>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Longitude</label>
                                            <input type="text" class="form-control" id="maps_long" name="maps_long" value="{{{$data['config']->maps_long}}}"></input>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Icon</label>
                                            <input type="text" class="form-control" id="maps_icon" name="maps_icon" value="{{{$data['config']->maps_icon}}}"></input>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" class="form-control" id="maps_title" name="maps_title" value="{{{$data['config']->maps_title}}}"></input>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="tinymce" id="maps_desc" name="maps_desc">{{{$data['config']->maps_desc}}}</textarea>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                            </div><!-- /.tab-pane -->
                            <div class="tab-pane" id="point">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Point Value / 1 point</label>
                                            <input type="text" class="form-control" id="point_value" name="point_value" value="{{{$data['config']->point_value}}}"></input>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Point Redeem / 1 point</label>
                                            <input type="text" class="form-control" id="redeem_value" name="redeem_value" value="{{{$data['config']->redeem_value}}}"></input>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                            </div><!-- /.tab-pane -->
                            <div class="tab-pane" id="vlm">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>From</label>
                                            <input type="text" class="form-control" id="vlm_from" name="vlm_from" value="{{{$data['config']->vlm_from}}}"></input>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>To</label>
                                            <input type="text" class="form-control" id="vlm_to" name="vlm_to" value="{{{$data['config']->vlm_to}}}"></input>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                            </div><!-- /.tab-pane -->
                            <div class="tab-pane" id="mad">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Max Allotment</label>
                                            <input type="text" class="form-control" id="max_allotment_default" name="max_allotment_default" value="{{{$data['config']->max_allotment_default}}}"></input>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                            </div><!-- /.tab-pane -->

                    </div><!-- nav-tabs-custom -->
                    <button type="submit" class="btn btn-success btn-flat btn-sm btn-save">Save</button>
                    <button type="button" class="btn btn-warning btn-flat btn-sm btn-cancel" data-dismiss="modal">Reload</button>
                </form>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.tab-content -->
</section><!-- /.content -->
    <!-- jQuery 2.1.4 -->
        <script src="{{ URL::asset('theme/admin/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $(document).on("click", ".btn-auto-td", function(){
                $vendor = $(this).attr('vendor');
                bootbox.dialog({
                    message: "Are you sure to set this field automatically?",
                    title: "Auto Set Confirmation",
                    buttons: {
                        success: {
                            label: "Yes",
                            className: "btn-success btn-flat",
                            callback: function () {
                                $(document).ajaxStart($.blockUI({ message: '<h2><i class="fa fa-spinner fa-pulse"></i> Please Wait...</h2>' })).ajaxStop($.unblockUI);
                                $.ajax({
                                    method: 'POST',
                                    dataType: 'json',
                                    url: '{!! url("/admin/config/settd") !!}',
                                    data: {'vendor': $vendor},
                                    success: function (data) {
                                        $data = '';
                                        for($i = 0; $i < data.length; $i++){
                                            console.log(data[$i].city_name);
                                            $data = $data+','+data[$i].city_code;
                                        }
                                        $selectedValues = $data.split(',');
                                        console.log($data);
                                        $('#t50i').select2('val', $data.split(','));
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

            $('.btn-cancel').click(function(){
                window.location.href = "{{{url('admin/config')}}}";
            });

            $('#formku').validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block', // default input error message class
                focusInvalid: true, // do not focus the last invalid input
                ignore: "",
                rules: {
                    mode_form: {
                        required: true
                    },
                    seo_title: {
                        required: true
                    },
                    seo_keywords: {
                        required: true
                    },
                    emailname: {
                        required: true
                    },
                    email: {
                        required: true
                    },
                    inv_prefix: {
                        required: true
                    },
                    order_prefix: {
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
                        $(document).ajaxStart($.blockUI({ message: '<h2><i class="fa fa-spinner fa-pulse"></i> Please Wait...</h2>' })).ajaxStop($.unblockUI);
                        $.ajax({
                            method: 'POST',
                            dataType: 'json',
                            url: '{!! url("/admin/config/do_Simpan") !!}',
                            data: $('#formku').serializeArray(),
                            success: function (data) {
                                if (data.success === true) {
                                    toastr.success(data.msgServer);
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
        });
    </script>
@endsection
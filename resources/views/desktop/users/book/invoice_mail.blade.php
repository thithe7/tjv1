<html lang="en">
    <head>
        <link href="{{ URL::asset('theme/users/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"/>
        <link href="{{ URL::asset('theme/users/corporate/css/custom.css') }}" rel="stylesheet"/>

        <style>
            .panel {
                margin-bottom: 20px;
                background-color: #fff;
                border: 1px solid transparent;
            }
            .panel-default .panel-heading {
                background-color: #f5f5f5;
                border-color: #ddd;
            }
            .panel-heading {
                padding: 10px 15px;
                border-bottom: 1px solid transparent;
            }
            .panel-body {
                padding: 15px;
            }
            .table-header {
                background-color: #f5f5f5;
                border-color: #ddd;
            }
            table thead tr td {
                padding-right: 10px;
                padding-left: 10px;
            }
            table tbody tr td {
                padding-right: 10px;
                padding-left: 10px;
            }
        </style>
    </head>
    <body class="corporate wrapper" style="min-width:1000px;">
        <div class="container">
            <div class="msg-done">
                <p style="font-size: 14px;"><?php echo html_entity_decode($content); ?></p>
            </div>
            <div class="col-md-12" style="padding-top: 20px; padding-bottom: 20px;">
                <div class="table-responsive">
                    <table border="0">
                        <tr>
                            <td><strong>Invoice Number</strong></td>
                            <td>: {{{$data['booking_invoice']}}}</td>
                        </tr>
                        <tr>
                            <td><strong>Guest Name</strong></td>
                            <td>: {{{$data['fullname']}}}</td>
                        </tr>
                        <tr>
                            <td><strong>Hotel Name</strong></td>
                            <td>: {{{$data['hotel_name']}}}</td>
                        </tr>
                        <tr>
                            <td><strong>Hotel Phone</strong></td>
                            <td>: {{{$data['telephone_hotel']}}}</td>
                        </tr>
                        <tr>
                            <td><strong>Hotel Address</strong></td>
                            <td>: {{{$data['address']}}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-md-12" style="padding-top: 20px;">
                <div class="table-responsive">
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <td style="font-size: 14px; font-weight: bold">Room Type</td>
                                <td class="text-center" style="font-size: 14px; font-weight: bold">Breakfast</td>
                                <td class="text-center" style="font-size: 14px; font-weight: bold">Amenities</td>
                                <td class="text-center" style="font-size: 14px; font-weight: bold">Quantity</td>
                                <td class="text-right" style="font-size: 14px; font-weight: bold">Rate</td>
                            </tr>
                            <tr>
                                <td colspan="5"><hr></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    {{{ $data['hotel_name'] }}} - {{{ $data['room_category_name'] }}}<br>
                                    Check In : {{{ date("D, M d Y", strtotime($data['checkin'])) }}}<br>
                                    Check Out : {{{ date("D, M d Y", strtotime($data['checkout'])) }}}
                                </td>
                                <td>{{{$data['breakfast']}}}</td>
                                <td>{{{$data['amenities']}}}</td>
                                <td>{{{ $data['qty'] }}}</td>
                                <td>IDR. {{{ number_format($data['sell_price']) }}}</td>
                            </tr>
                            <tr>
                                <td colspan="5"><hr></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-right" style="font-size: 14px; font-weight: bold;">
                                Sub Total</td>
                                <td class="text-right">IDR. {{{ number_format($data['total_sell_price']) }}}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-right" style="font-size: 14px; font-weight: bold;">
                                Use TJ Point ({{{ $data['tjpoint'] }}})</td>
                                <td class="text-right">- IDR. {{{ number_format($data['tjpoint_rp']) }}}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-right" style="font-size: 14px; font-weight: bold;">
                                Use TJ Point Back ({{{ $data['tjpoint_back'] }}})</td>
                                <td class="text-right">- IDR. {{{ number_format($data['tjpointback_rp']) }}}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-right grand-total" style="font-size: 14px; font-weight: bold;">
                                GRAND TOTAL</td>
                                <td class="text-right grand-total">IDR. {{{ number_format($data['total_sell_price']) }}}</td>
                            </tr>
                            @if($data['point_get'] > 0)
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-right" style="font-size: 14px; font-weight: bold;">
                                    You get TJ Point :</td>
                                    <td class="text-right">{{{ $data['point_get'] }}}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <label style="font-size: 12px; color: red">*Tax included <br>
                    *Please checkin before 2PM at Thu, Dec 15 2016 and checkout before 12pm at Fri, Dec 16 2016 </label>
                </div>
            </div><br>
            <div class="msg-done">
                <p style="font-size: 14px;"><?php echo html_entity_decode($footer); ?></p>
            </div>
        </div>
    </body>
</html>


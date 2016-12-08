<link href="{{ URL::asset('theme/users/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"/>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="text-center">
                <div class="row row-padding">
                    <div class="col-lg-6">
                        <img src="{{ URL::asset('assets/images/traveljinni-logo-icon.png') }}" class="logo-inv">
                    </div>
                    <div class="col-lg-6 pull-right">
                        <h1 class="h1-inv">Invoice #{{{ $data[0]['booking_invoice'] }}}</h1>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-12 col-md-4 pull-left">
                        <div class="panel panel-default height">
                            <div class="panel-heading">
                                <strong>Invoice Details</strong>
                            </div>
                            <div class="panel-body">
                                <strong>Invoice : </strong>#Invoice #{{{ $data[0]['booking_invoice'] }}}<br>
                                <strong>Issued : </strong>{{{ $data[0]['payment_date'] }}}<br>
                                <strong>Paid Using : </strong>Credit Card
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <div class="panel panel-default height">
                            <div class="panel-heading">
                                <strong>From</strong>
                            </div>
                            <div class="panel-body">
                                <strong>Travel Jinni</strong><br>
                                Denpasar Bali<br>
                                080000000<br>
                                080000000<br>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <div class="panel panel-default height">
                            <div class="panel-heading">
                                <strong>To</strong>
                            </div>
                            <div class="panel-body">
                                <strong>{{{ $data[0]['fullname'] }}}</strong><br>
                                {{{ $data[0]['email'] }}}<br>
                                {{{ $data[0]['cellphone'] }}}
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="text-center"><strong>Order summary</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <td><strong>Room Type</strong></td>
                                    <td class="text-center"><strong>Meals</strong></td>
                                    <td class="text-center"><strong>Quantity</strong></td>
                                    <td class="text-right"><strong>Rate</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        {{{ $data[0]['hotel_name'] }}} - {{{ $data[0]['room_category_name'] }}}<br>
                                        Check In : {{{ date("D, M d Y", strtotime($data[0]['checkin'])) }}}<br>
                                        Check Out : {{{ date("D, M d Y", strtotime($data[0]['checkout'])) }}}
                                    </td>
                                    <td class="text-center">Room Only</td>
                                    <td class="text-center">{{{ $data[0]['qty'] }}}</td>
                                    <td class="text-right">IDR. {{{ number_format($data[0]['sell_price']) }}}</td>
                                </tr><hr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center"><strong>Total</strong></td>
                                    <td class="text-right">IDR. {{{ number_format($data[0]['total_sell_price']) }}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .height {
        min-height: 150px;
    }

    .icon {
        font-size: 47px;
        color: #5CB85C;
    }

    .iconbig {
        font-size: 77px;
        color: #5CB85C;
    }

    .table > tbody > tr > .emptyrow {
        border-top: none;
    }

    .table > thead > tr > .emptyrow {
        border-bottom: none;
    }

    .table > tbody > tr > .highrow {
        border-top: 3px solid;
    }
    .row-padding {
        padding-top: 20px;
    }
    .logo-inv {
        width: 200px; 
        float: left;
    }
    .h1-inv {
        float: right; 
        margin-top: 0
    }
</style>
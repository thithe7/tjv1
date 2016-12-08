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
                        <i class="fa fa-search-plus pull-left icon"></i>
                        <h1 class="h1-inv">Invoice #76466554</h1>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-12 col-md-4 pull-left">
                    <div class="panel panel-default height">
                        <div class="panel-heading">Invoice Details</div>
                        <div class="panel-body">
                            <strong>Invoice : </strong>#4234234<br>
                            <strong>Issued : </strong>Tue, Dec 06 2016<br>
                            <strong>Paid Using : </strong>Credit Card
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4">
                    <div class="panel panel-default height">
                        <div class="panel-heading">From</div>
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
                        <div class="panel-heading">To</div>
                        <div class="panel-body">
                            <strong>yoko</strong><br>
                            yoko@mail.com
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
                                        Obbie Star - standard<br>
                                        Check In : Sun, Jan 01 2017<br>
                                        Check Out : Mon, Jan 02 2017
                                    </td>
                                    <td class="text-center">Room Only</td>
                                    <td class="text-center">1</td>
                                    <td class="text-right">$900</td>
                                </tr>
                                <tr>
                                    <td class="highrow"></td>
                                    <td class="highrow"></td>
                                    <td class="highrow text-center"><strong>Subtotal</strong></td>
                                    <td class="highrow text-right">$900.00</td>
                                </tr>
                                <tr>
                                    <td class="emptyrow"><i class="fa fa-barcode iconbig"></i></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow text-center"><strong>Total</strong></td>
                                    <td class="emptyrow text-right">$900.00</td>
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
<style type="text/css">
    .well {
        background-color: #fff;
        border: 1px solid #e3e3e3;
        border-radius: 6px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05) inset;
        margin-bottom: 20px;
        min-height: 20px;
        padding: 9px;
    }
        /* style hover div hotel */
    .info:hover{
        box-shadow: 3px 3px 3px #888888;
        background-color:#f2f2f2;
    }   
</style>
@if(count($getdata['records'])==0)
    No Data Found
@else
    @foreach ($getdata['records'] as $Fields)
    <a id="form_list" class="link_hotel_detail" href="" name="detail1" target="_blank">
        <div class="row well info no-ctrl" noctrl="1" style="margin-bottom: 20px; padding: 0px; cursor: pointer;">
            <form method="get" action="{{$Fields['url']}}">
                <input type="hidden" name="id_hotel" value="{{$Fields['id_hotel']}}">
                <input type="hidden" name="destination" value="{{$destination}}">
                <input type="hidden" name="checkin" value="{{$cekin}}">
                <input type="hidden" name="checkout" value="{{$cekout}}">
                <input type="hidden" name="breakfast" value="{{$breakfast}}">
                <input type="hidden" name="amenities" value="{{$amenities}}">

                <div class="hotel-container">
                    <!-- Hotel Image -->
                    <div class="hotel-image-wrapper">
                        <img class="col-xs-4 hotel-img" src="{{$Fields['photo']}}">
                    </div>
                    <!-- End Hotel Image -->
                    <div class="col-xs-8">
                        <div class="hotel-name">
                            <h3><a href="{{$Fields['link']}}"><font style="color:#095668;">{{$Fields['name_hotel']}}</font></a> <?php echo html_entity_decode($Fields['labelsold']); ?></h3>
                        </div>
                        <div class="hotel-name">
                            <h4 style="color:#095668;">{{$Fields['address']}} - {{$Fields['area']}} </h4>
                        </div>
                        <div class="ssr-hotel-rating">
                            <?php echo html_entity_decode($Fields['star']); ?>  
                        </div>
                        <div class="hotel-content">        
                            @if($Fields['ketbreakfast']!="")
                                <div class="green wrapper-prop">
                                    <i class="fa fa-check" aria-hidden="true"></i><?php echo html_entity_decode($Fields['ketbreakfast']); ?>
                                </div>
                            @endif
                            @if($Fields['ketamenities']!="")
                                <div class="green wrapper-prop">
                                    <i class="fa fa-check" aria-hidden="true"></i><?php echo html_entity_decode($Fields['ketamenities']); ?>
                                </div>
                            @endif
                        </div>
                        <div class="col-xs-5 col-md-9" align="right">
                        </div>
                        <div class="col-xs-5 col-md-3" align="right">
                            <div class="hotel-price loading-container redirect-hotel-price">
                                <div class="cor-mobile-container">
                                    <span class="cor-mobile-currency"></span>
                                    <span class="cor-mobile-price">
                                        <font color="red">
                                            <strike></strike>
                                        </font>
                                    </span>
                                </div>
                                {!!$Fields['vlmdeals']!!}
                                <span class="price-currency">{{$Fields['uang']}}</span>
                                <span class="price-value">
                                    {{$Fields['harga_tampil']}}
                                </span>                            
                            </div>
                            <div class="next-icon redirect-next-icon">
                                <?php echo html_entity_decode($Fields['book']); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </a>
    @endforeach
@endif

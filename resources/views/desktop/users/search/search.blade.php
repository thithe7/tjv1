@section('css')
<link href="{{ URL::asset('theme/users/corporate/css/search-custom.css') }}" rel="stylesheet"/>
@endsection
@if(count($getdata['records'])==0 || $getdata['records'][0]=="")
    No Data Found
@else
    @foreach ($getdata['records'] as $Fields)
    <a id="form_list" class="link_hotel_detail" href="" name="detail1" target="_blank">
        <div class="row well info no-ctrl" noctrl="1">
            <form method="get" action="{{$Fields['url']}}">
                <input type="hidden" name="urutan" value="{{$Fields['urutan']}}">
                <input type="hidden" name="id_hotel" value="{{$Fields['id_hotel']}}">
                <input type="hidden" name="destination" value="{{$destination}}">
                <input type="hidden" name="checkin" value="{{$cekin}}">
                <input type="hidden" name="checkout" value="{{$cekout}}">
                <input type="hidden" name="breakfast" value="{{$breakfast}}">
                <input type="hidden" name="amenities" value="{{$amenities}}">

                <div class="hotel-container">
                    <div class="hotel-image-wrapper">
                        <img class="col-xs-4 hotel-img" src="{{$Fields['photo']}}">
                    </div>
                    <div class="col-xs-8 paddingsetupsearch">
                        <div class="hotel-name">
                            <h3><a class="no-text-decoration" href="{{$Fields['link']}}"><font class="tj-custom-font">{{$Fields['name_hotel']}}</font></a></h3>
                        </div>
                        <div class="hotel-name">
                            <h4 class="tj-custom-font">{{$Fields['address']}} - {{$Fields['area']}} </h4>
                        </div>
                        <div class="ssr-hotel-rating">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="space-title">Hotel Star</label>
                                </div>
                                <div class="col-md-9">
                                    @if($Fields['star']>0)
                                        @for($i=0;$i<$Fields['star'];$i++)    
                                            <i class="fa fa-star tj-custom-star-hotel" title="5 star"></i>
                                        @endfor
                                    @else
                                        No Star
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="ssr-hotel-rating">
                            @if($Fields['review']>0)
                            <a data-toggle="modal" class="no-text-decoration" data-target="#myModal">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="space-title">Review</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="five-stars-container">
                                            <div class="five-stars" style="width: {{$Fields['review']}}%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <div id="myModal" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Hotel Review</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="space-title">Value for money rate</label>
                                                </div>
                                                <div class="col-md-1">
                                                    <label class="space-title"> : </label>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="five-stars-container">
                                                        <div class="five-stars" style="width: {{$Fields['valueformoney_rate']}}%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="space-title">Location Rate</label>
                                                </div>
                                                <div class="col-md-1">
                                                    <label class="space-title"> : </label>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="five-stars-container">
                                                        <div class="five-stars" style="width: {{$Fields['location_rate']}}%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="space-title">Cleanliness Rate</label>
                                                </div>
                                                <div class="col-md-1">
                                                    <label class="space-title"> : </label>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="five-stars-container">
                                                        <div class="five-stars" style="width: {{$Fields['cleanliness_rate']}}%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="space-title">Staff Rate</label>
                                                </div>
                                                <div class="col-md-1">
                                                    <label class="space-title"> : </label>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="five-stars-container">
                                                        <div class="five-stars" style="width: {{$Fields['staff_rate']}}%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="space-title">Facilities Rate</label>
                                                </div>
                                                <div class="col-md-1">
                                                    <label class="space-title"> : </label>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="five-stars-container">
                                                        <div class="five-stars" style="width: {{$Fields['facilities_rate']}}%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn btn-primary btn-tj trigger-search">Read More Reviews</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="hotel-content">        
                            @if($Fields['ketbreakfast']!="")
                                <div class="green wrapper-prop">
                                    <i class="fa fa-check" aria-hidden="true"></i>{!!$Fields['ketbreakfast']!!}
                                </div>
                            @endif
                            @if($Fields['ketamenities']!="")
                                <div class="green wrapper-prop">
                                    <i class="fa fa-check" aria-hidden="true"></i>{!!$Fields['ketamenities']!!}
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
                                @if($Fields['labelsold']!="")
                                    {!!$Fields['labelsold']!!}
                                @else
                                    {!!$Fields['vlmdeals']!!}
                                @endif
                                <br>
                                <span class="price-currency">{{$Fields['uang']}}</span>
                                <span class="price-value">
                                    {{$Fields['harga_tampil']}}
                                </span>                            
                            </div>
                            <div class="next-icon redirect-next-icon">
                                {!!$Fields['book']!!}
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </a>
    @endforeach
@endif

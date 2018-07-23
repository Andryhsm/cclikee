<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{!! 'coupon_'.Auth::user()->first_name.'_'.Auth::user()->last_name.'_'.$item->order->order_id !!}</title>
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
        
        @if($local_dev == "non")
            {!! Html::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css') !!}
            {{-- {!! Html::style('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.css') !!} --}}
        @else
            {!! Html::style('frontend/css/bootstrap.min.css') !!}
            {{-- {!! Html::style('frontend/css/jquery-ui.min.css') !!} --}}
            {!! Html::style('frontend/css/jquery-ui.css') !!}
        @endif
        
        {!! Html::style('frontend/css/bootstrap-dropdownhover.css') !!}
        {!! Html::style('frontend/css/font-awesome.min.css') !!}
        {!! Html::style('frontend/css/style-clickee.css') !!}
        {!! Html::style('frontend/css/customer.css') !!}
        {!! Html::style('frontend/css/responsive.css') !!}
        {!! Html::style('https://fonts.googleapis.com/icon?family=Material+Icons') !!}
    </head>
    
    <body>
        <div class='container-fluid customer-area'>
            <div class="row">
                <div class="main ajax-content col-lg-12 col-xs-12 col-md-12 col-sm-12">
                    <div class="ajax-content">
                        <div class="current-coupon">
                            <div class="coupon-item col-lg-12">
                                <div class="col-lg-12">
                                    <span class="title-bold-2">Coupon de réception</span>
                                </div>
                                <div class="col-lg-12">
                                    <div class="logo text-center">
                                        <img src="{!! URL::to('/') !!}/images/logoPdf.png" alt="logo clickee"/>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <p>Votre commande vous attend à la boutique {!! $item->product->store->store_name !!}.</p>
                                </div>
                                <div class="col-lg-12">
                                    <div class="col-lg-12" style="border: 4px solid #65bb9f; padding: 2% 0 0 0;float: none; margin-left: 9%; margin-right: 9%;margin-bottom: 10%;">
                                        <span class="mini-height">
                                            @foreach ($item->itemRequest as $index=>$request)
                                            <p>Réservation acceptée par :<pan class="title-bold-2"> {!! $request->merchant->last_name !!} {!! $request->merchant->first_name !!}</pan></p>
                                            <p>Date d’acceptation :<pan class="title-bold-2"> {!! Jenssegers\Date\Date::parse($request->created_date)->format('d-m-Y')!!}se </pan></p>
                                            @endforeach
                                            <p>Adresse :<pan class="title-bold-2"> {!! $item->product->store->address1 !!}</pan></p>
                                            <p>N° de téléphone :<pan class="title-bold-2"> {!! $item->product->store->phone !!}</pan></p>
                                        </span>
                                        <p class="think-hour"><i>Pensez à vérifier les horaires d’ouverture</i></p>
                                    </div>
                                </div>
                                
                                <div class="coupon-product text-center col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                    <div class="order_img col-lg-4 col-md-4 col-xs-4 col-sm-4">
                                        <img style="border: 4px solid #044651; max-width:60%;" src="{!! URL::to('/').'/'.$item->product->getDefaultImagePath() !!}"></img>
                                    </div>
                                    <div class="ptb-10 col-lg-8 col-md-8 col-xs-8 col-sm-4" style="padding-left: 185px;text-align:left;">
                                        
                                        <p class="title-bold-2 mb-30">{!! $item->product->brand_name !!}</p>
                                        
                                        <span class="mini-height">
                                            <p>{!! $item->product_name !!}</p>
                                            @foreach($item->attributes as $index=>$attribute)
                                                <p>{!! $attribute->attribute_label !!} {!! $attribute->attribute_selected_value !!}</p>
                                            @endforeach
                                        </span>
                                        <p><span>Tarif : </span><span class="title-bold-2">{!! format_price($item->price) !!}  (<b>X{!! $item->quantity !!}</b>)</span></p>
                                    </div>
                                </div>
                                <br><br><br><br><br><br><br><br><br><br><br>
                                <div class="coupon-condition col-lg-12">
                                    <span><b>conditions générales de vente : </b></span>
                                    <span>
                                        dejhgtkh ddijg cpgt coe vo trfjcdhbbv dejhgtkh ddijg cpgt coe vo trfjcdhbbv dejhgtkh ddijg cpgt
                                        coe vo trfjcdhbbv dejhgtkh ddijg cpgt coe vo trfjcdhbbv dejhgtkh ddijg cpgt coe vo trfjcdhbbv dejhgtkh ddijg cpgt coe vo
                                        trfjcdhbbv dejhgtkh ddijg cpgt coe vo trfjcdhbbv dejhgtkh ddijg cpgt coe vo trfjcdhbbv dejhgtkh ddijg cpgt coe vo trfjcdhbbv
                                        dejhgtkh ddijg cpgt coe vo trfjcdhbbv dejhgtkh ddijg cpgt coe vo trfjcdhbbv dejhgtkh ddijg cpgt coe vo trfjcdhbbv dejhgtkh ddijg
                                        cpgt coe vo trfjcdhbbv dejhgtkh ddijg cpgt coe vo trfjcdhbbv dejhgtkh ddijg cpgt coe vo trfjcdhbbv dejhgtkh ddijg cpgt coe vo
                                        trfjcdhbbv dejhgtkh ddijg cpgt coe vo trfjcdhbbv.
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
<!-- END BODY -->
</html>
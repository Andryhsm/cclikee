@extends('front.customer.layout.master')

@section('content')
@if(count($pending_items) > 0) 
        @foreach($pending_items as $item)
         @if(count($item->itemRequest)>0)
        @foreach($item->itemRequest as $index=>$request)
        <div class="ajax-content current_order">
            <div class="order col-lg-12">
                <div class="order-header">
                    <div class="order-item col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <span class="title-bold-2">N° DE COMMANDE : </span><span>{!! $item->order->order_id !!}</span>
                    </div>     
                    <div class="order-item col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <span class="title-bold-2">DATE DE COMMANDE : </span><span>{!! formatDate($item->order->order_date, "M dS, Y") !!}</span>
                    </div>
                </div>
                <div class="row">
                <div class="order-content col-lg-12">
                    <div class="order-img col-lg-4 col-md-4 col-sm-4 col-xs-6">
                        <img src="{!! URL::to('/').'/'.$item->product->getDefaultImagePath() !!}"></img>
                    </div>
                    <div class="order-info ptb-10 col-lg-4 col-md-4 col-sm-4 col-xs-5">
                        
                        <div><strong class="text-uppercase">{!! $item->product->brand_name !!}</strong></div>
                        
                        <div class="order-description">
                            <p>{!! $item->product_name !!}</p>
                            @foreach($item->attributes as $index=>$attribute)
                                <p>{!! $attribute->attribute_label !!}: {!! $attribute->attribute_selected_value !!}</p>
                            @endforeach
                        </div>
                        <div>
                            <div class="title-bold-2">{!! format_price($item->price) !!}  (<b>X{!! $item->quantity !!}</b>)</div>
                        </div>
                    </div>
                    <div class="order-form ptb-10 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        @if($item->order_status_id == 3)
                            <div>
                                <button class="btn btn-customer-filled pull-right" data-url="{!! route('customer-waiting-order', ['id' => $item->itemRequest->first()->order_item_request_id]) !!}" id="{!! $item->order_item_id !!}" type="button" onclick="waiting_order(this);">
                                    <span>Attendre</span>
                                </button>
                            </div>
                            <div>
                                <button class="btn btn-customer-filled pull-right" data-url="{!! route('customer-canceled-order', ['id' => $item->itemRequest->first()->order_item_request_id]) !!}" id="{!! $item->order_item_id !!}" type="button" onclick="canceled_order(this);">
                                    <span>Annuler</span>
                                </button>
                            </div>
                        @else
                            <div>
                                <a href="{!! route('customer-coupon-de-reception',['id' => $item->order_item_id]) !!}" class="Coupon btn btn-customer-filled pull-right">Coupon à présenter</a>
                            </div>
                            <div>
                                <button class="Reception btn btn-customer-filled pull-right" type="button" onclick="reception(this);">
                                    <span>Réception</span><i class="fa fa-angle-up"></i>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
                </div>
                <div class="shop col-lg-12">
                    <p class="shop-item title-bold-2 ptb-20">Votre magasin de réception à proximité</p>
                    <div class="shop-item content-map mb-20 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                       <img src="{!! URL::to('/') !!}/images/position.svg"></img>
                    </div>  
                    <div class="shop-item text-center col-lg-12">
                        <div class="row">
                            <?php $store = $item->product->store; ?>
                            <span class="mini-height">
                                <strong class="text-uppercase">{!! $store->store_name !!}</strong>
                                <p class="shop-data" data-url="{!! route('get-distance-store') !!}" data-store_name="{{ $store->store_name }}" data-short_description="{{ $store->short_description }}" data-latitude="{{ $store->latitude }}" data-longitude="{{ $store->longitude }}" data-shop_image="{{ $store->shop_image }}" data-registration_number="{{ $store->registration_number }}" data-country="{{ $store->country->name }}">{!! $store->store_name !!} {!! $store->city !!}</p>
                                <p>{!! $store->zip !!}</p>
                                <p class="store-distance">À 0,0km de chez vous</p>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <div class="ajax-content">
            <div class="order col-lg-12">
                <div class="order-header">
                    <div class="order-item col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <span class="title-bold-2">N° DE COMMANDE : </span><span>{!! $item->order->order_id !!}</span>
                    </div>     
                    <div class="order-item col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <span class="title-bold-2">DATE DE COMMANDE : </span><span>{!! formatDate($item->order->order_date, "M dS, Y") !!}</span>
                    </div>
                </div>
                <div class="row">
                <div class="order-content col-lg-12">
                    <div class="order-img col-lg-4 col-md-4 col-sm-4 col-xs-6">
                        <img src="{!! URL::to('/').'/'.$item->product->getDefaultImagePath() !!}"></img>
                    </div>
                    <div class="order-info ptb-10 col-lg-4 col-md-4 col-sm-4 col-xs-6">
                        
                        <div><strong class="text-uppercase">{!! $item->product->brand_name !!}</strong></div>
                       
                        <div class="order-description">
                            <p>{!! $item->product_name !!}</p>
                            @foreach($item->attributes as $index=>$attribute)
                                <p>{!! $attribute->attribute_label !!}: {!! $attribute->attribute_selected_value !!}</p>
                            @endforeach
                        </div>
                        <div>
                            <div class="title-bold-2">{!! format_price($item->price) !!}  (<b>X{!! $item->quantity !!}</b>)</div>
                        </div>
                    </div>
                    <div class="order-form ptb-10 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div>
                            <a disabled="disabled" class="Coupon btn btn-customer-filled pull-right">Coupon à présenter</a>
                        </div>
                        <div>
                            <button disabled="disabled" class="Reception btn btn-customer-filled pull-right" type="button" onclick="reception(this);">
                                <span>Réception</span><i class="fa fa-angle-up"></i>
                            </button>
                        </div>
                    </div>
                </div>
                </div>
                <div class="shop col-lg-12">
                    <p class="shop-item title-bold-2 ptb-20">Votre magasin de réception à proximité</p>
                    <div class="shop-item content-map mb-20 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                       <img src="{!! URL::to('/') !!}/images/position.svg"></img>
                    </div>  
                    <div class="shop-item text-center col-lg-12">
                        <div class="row">
                            <?php $store = $item->product->store; ?>
                            <span class="mini-height">
                                <strong class="text-uppercase">{!! $store->store_name !!}</strong>
                                <p class="shop-data" data-store_name="{{ $store->store_name }}" data-short_description="{{ $store->short_description }}" data-latitude="{{ $store->latitude }}" data-longitude="{{ $store->longitude }}" data-shop_image="{{ $store->shop_image }}" data-registration_number="{{ $store->registration_number }}" data-country="{{ $store->country->name }}">{!! $store->store_name !!} {!! $store->city !!}</p>
                                <p>{!! $store->zip !!}</p>
                                <p class="store-distance">À 0,0km de chez vous</p>
                            </span>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    @else
        <div class="order">
            <p class="title-bold-2 text-uppercase text-center">Aucun commande trouvé</p>&nbsp;
        </div>
    @endif
@endsection
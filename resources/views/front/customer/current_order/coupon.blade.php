@extends('front.customer.layout.master')

@section('content')
<div class="ajax-content">
    <div class="current-coupon">
        <div class="coupon-item col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <span class="title-bold-2">Coupon de réception</span>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="logo text-center">
                    <img src="{!! URL::to('/') !!}/images/logo.svg" alt="logo Alternateeve"/>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <p>Votre commande vous attend à la boutique {!! $item->product->store->store_name !!}.</p>
            </div>
            <div class="text-center col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="customer col-lg-7 col-md-8 col-sm-8 col-xs-10">
                    <span class="mini-height">
                        @foreach ($item->itemRequest as $index=>$request)
                        <p>Réservation acceptée par :<span class="title-bold-2"> {!! $request->merchant->last_name !!} {!! $request->merchant->first_name !!}</span></p>
                        <p>Date d’acceptation :<span class="title-bold-2"> {!! Jenssegers\Date\Date::parse($request->created_date)->format('d-m-Y')!!} </span></p>
                        @endforeach
                        <p>Adresse :<span class="title-bold-2"> {!! $item->product->store->address1 !!}</span></p>
                        <p>N° de téléphone :<span class="title-bold-2"> {!! $item->product->store->phone !!}</span></p>
                    </span>
                    <p class="think-hour"><i>Pensez à vérifier les horaires d’ouverture</i></p>
                </div>
            </div>
            <div class="coupon-product text-center">
                <div class="order-img col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <img src="{!! URL::to('/').'/'.$item->product->getDefaultImagePath() !!}"></img>
                </div>
                <div class="order-info">
                    
                    <div class="title-bold-2">{!! $item->product->brand_name !!}</div>
                    
                    <div class="mini-height">
                        <p>{!! $item->product_name !!}</p>
                        @foreach($item->attributes as $index=>$attribute)
                            <p>{!! $attribute->attribute_label !!} {!! $attribute->attribute_selected_value !!}</p>
                        @endforeach
                    </div>
                    <div><p>Tarif : </span><span class="title-bold-2">{!! format_price($item->price) !!}  (<b>X{!! $item->quantity !!}</b>)</p></div>
                </div>
            </div>
            <div class="coupon-condition col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
        <div class="coupon-boutton col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="customer-file-action download">
                <a href="{!! route('customer-download-pdf',['id' => $item->order_item_id]) !!}" class="btn btn-customer-filled">
                    <span>Télécharger</span>
                </a>
            </div>
            <div class="customer-file-action print">
                    <a href="{!! route('customer-print-pdf',['id' => $item->order_item_id]) !!}" class="btn btn-customer-filled" target="_blank">
                    <span>Imprimer</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
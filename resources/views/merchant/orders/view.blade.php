@extends('merchant.layout.master')

@section('additional-styles')
    {!! Html::style('backend/plugins/datatables/dataTables.bootstrap.css') !!}
    {!! Html::style('frontend/css/font-awesome.min.css') !!}
    {!! Html::style('backend/bootstrap/css/bootstrap.min.css') !!}
    {!! Html::style('backend/plugins/select2/select2.css') !!}
    {!! Html::style('backend/dist/css/AdminLTE.min.css') !!}
    {!! Html::style('backend/dist/css/skins/skin-black-light.css') !!}
    {!! Html::style('backend/css/style.css') !!}

    {!! Html::style('frontend/css/style-clickee.css') !!}
@stop
@section('page_title')
    <div class="section-title col-mm-8  col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <div class="header-item">  
            <div class="title title-active col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="title-icon">
                    <img class="" src="{!! URL::to('/') !!}/images/icon/historique_de_mes_commandes.svg"/>
                </div> 
                <div class="title-title">
                    <span class="text-title-active">Commandes</span>
                </div>
            </div>
        </div>
    </div>
@stop
@section('content')
<section class="content">
    <div class="bottle">
        <section class="content-header">
            <h1>
                Commandes et demandes
            </h1>
        </section>
        <section class="content">
            <div class="col-lg-12">
                @include('admin.layout.notification')    
            </div>
            
            <div class="">
                <div class="col-xs-12">
                <div class="box">
                <div class="box-body">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">{!! trans('order.to_respond') !!} &nbsp;&nbsp; <span class="badge bg-green-dark mr-5">{!! getNumberOrderPending(Auth::id()) !!}</span></a></li>
                        <li><a href="#tab_3" data-toggle="tab">{!! trans('order.earned') !!} &nbsp;&nbsp; <span class="badge bg-green-dark mr-5">{!! getNumberOrderEarned(Auth::id()) !!}</span></a></li>
                        <li><a href="#tab_4" data-toggle="tab">HISTORIQUE</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <section class=""> <!--content-->
                                <div class="row">
                                    <div class="col-md-12">
                                        <table width="100%" class="merchant-order-list bdr-btm">
                                            <tbody>
                                            @if(count($pending_items)>0)
                                                @foreach($pending_items as $index=>$item)
                                                {!! Form::open(['url' => route('commande.store'), 'id'=>'product_search_form_'.$index, 'method' => 'post','class'=>' form-inline','autocomplete'=>'off']) !!}
                                                <tr>
                                                    <td width="25%">
                                                        <strong>{!! $item->product->brand_name !!}</strong><br><br>
                                                        <a href="{!! (!empty($item->product)>0 && !empty($item->product->url)) ? url($item->product->url->target_url): "#" !!}">{!! $item->product_name !!}</a>
                                                        @foreach($item->attributes as $index=>$attribute)
                                                            <br/>{!! $attribute->attribute_label !!}
                                                            : {!! $attribute->attribute_selected_value !!}
                                                        @endforeach
                                                        <br/>Prix: {!! format_price($item->price) !!}  (<b>X{!! $item->quantity !!}</b>)
                                                        <!--<br/>-->
                                                        <!--@if($item->order->payment_type=='1')
                                                            {!! trans('order.payment_type') !!}
                                                        @endif-->
    
                                                    </td>
                                                    <td width="25%">
                                                        <div class="col-md-10">
                                                            <div class="funkyradio">
                                                                <div class="funkyradio-info">
                                                                    <input type="radio" checked name="available_option_{!! $item->order_item_id !!}" id="radio1_{!! $item->order_item_id !!}" value="1" />
                                                                    <label for="radio1_{!! $item->order_item_id !!}">Disponible</label>
                                                                </div>
                                                                <div class="funkyradio-info">
                                                                    <input type="radio" name="available_option_{!! $item->order_item_id !!}" id="radio3_{!! $item->order_item_id !!}" value="3" />
                                                                    <label for="radio3_{!! $item->order_item_id !!}">{!! trans('order.not_available') !!}</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td width="40%">
                                                        <input type="hidden" name="item_request_id"
                                                               value="{!! $item->order_item_request_id  !!}">
                                                        <input type="hidden" name="item_id"
                                                               value="{!! $item->order_item_id  !!}">
                                                        <input type="hidden" name="order_item_date"
                                                               value="{!! $item->order_item_date  !!}">       
                                                        <input type="hidden" name="customer_id"
                                                               value="{!! $item->order->user_id  !!}">
                                                        <label>{!! trans('order.client_message') !!}</label>
                                                        {!!Form::textarea('response',null,['class'=>"form-control",'placeholder'=>'','size' => '50x3']) !!}
                                                        <br>
                                                        <button type="submit"
                                                                class="btn btn-block btn-merchant-filled response-to-customer mb-10 pull-right"
                                                                data-index="{!! $index !!}"
                                                                id="response-to-customer">Répondre
                                                        </button>
                                                    </td>
                                                </tr>
                                                {!! Form::close() !!}
                                            @endforeach
                                            @else
                                                {!! trans('order.no_records_found') !!}
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="tab-pane" id="tab_3">
                            <section class="" id=""><!--content-->
                                <table width="100%" class="merchant-order-list bdr-btm">
                                    <tbody>
                                    @if(count($earned_items)>0)
                                        @foreach($earned_items as $index=>$item)
                                        <tr>
                                            <td width="50%" class="vertical-align">
                                                <strong>{!! $item->product->brand_name !!}</strong><br><br>
                                                <a href="{!! (!empty($item->product)>0 && !empty($item->product->url)) ? url($item->product->url->target_url): "#" !!}">{!! $item->product_name !!}</a>
                                                @foreach($item->attributes as $index=>$attribute)
                                                    <br/>{!! $attribute->attribute_label !!}
                                                    : {!! $attribute->attribute_selected_value !!}
                                                @endforeach
                                                <br/>Prix: {!! format_price($item->price) !!}  (<b>X{!! $item->quantity !!}</b>)
                                                <!--<a href="{!! !empty($item->product_url)?url($item->product_url) :'#' !!}">{!! trans('order.equalize_link') !!}</a><br>-->
                                                <!--@if($item->order->payment_type=='1')
                                                    {!! trans('order.payment_type') !!}
                                                @endif-->
    
                                            </td>
                                            <td width="50%" class="vertical-align">
                                                <button type="button"
                                                        class="btn btn-block btn-merchant-filled coupon-code-btn"
                                                        id="coupon-code">Afficher coupon
                                                </button>
                                                <div class="coupon-code mt-20">{!! $item->coupon->coupon_code !!}</div>
                                                <br/>
                                                <div class="">
                                                    {!! trans('order.the_confirmed') !!}
                                                    : {!! Carbon\Carbon::parse($item->itemRequest->first()->created_date)->format('d/m/Y')  !!}
                                                </div>
                                                <div>
                                                    <a href="{!! route('merchant-booked-request', ['id' => $item->itemRequest->first()->order_item_request_id]) !!}" class="btn btn-block btn-merchant-filled pull-right">Terminer</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @else
                                        {!! trans('order.no_records_found') !!}
                                    @endif
                                    </tbody>
                                </table>
                            </section>
                        </div>
                        <div class="tab-pane" id="tab_4">
                            <section class="" id="">
                                <table width="100%" class="merchant-order-list bdr-btm">
                                    <tbody>
                                        @if(count($history_items)>0)
                                        @foreach($history_items as $index=>$item)
                                        <tr>
                                            <td width="50%" class="vertical-align">
                                                <strong>{!! $item->product->brand_name !!}</strong><br><br>
                                                <a href="{!! (!empty($item->product)>0 && !empty($item->product->url)) ? url($item->product->url->target_url): "#" !!}">{!! $item->product_name !!}</a>
                                                @foreach($item->attributes as $index=>$attribute)
                                                    <br/>{!! $attribute->attribute_label !!}
                                                    : {!! $attribute->attribute_selected_value !!}
                                                @endforeach
                                                <br/>Prix: {!! format_price($item->price) !!}  (<b>X{!! $item->quantity !!}</b>)
                                                <!--<a href="{!! !empty($item->product_url)?url($item->product_url) :'#' !!}">{!! trans('order.equalize_link') !!}</a><br>-->
                                                <!--@if($item->order->payment_type=='1')
                                                    {!! trans('order.payment_type') !!}
                                                @endif-->
    
                                            </td>
                                            <td width="50%" class="vertical-align">
                                                <strong>{!! $item->itemRequest->first()->user->last_name !!} {!! $item->itemRequest->first()->user->first_name !!}</strong>
                                                <div class="mt-20">Code coupon: {!! $item->coupon->coupon_code !!}</div>
                                                <div class="">
                                                    Date de récuperation: {!! Carbon\Carbon::parse($item->itemRequest->first()->booked_date)->format('d/m/Y')  !!}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @else
                                        {!! trans('order.no_records_found') !!}
                                    @endif
                                    </tbody>
                                </table>
                            </section>
                        </div>
                    </div>
                </div>
                </div>
                </div>
                </div>
            </div>
        </section>
    </div>
</section>
@stop
@section('additional-script')
    <script>
        $(function () {
            $.fn.orderDetail();
        });
    </script>
@stop
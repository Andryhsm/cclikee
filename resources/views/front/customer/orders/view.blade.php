@extends('front.layout.master')
@section('content')
    <section class="order-detail-container ptb-30">
        <div class="container">
            <div class="col-xs-12">
                @include('notification')
                <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1"
                                          data-toggle="tab">{!! trans('order.application_in_progress') !!}</a></li>
                    <li><a href="#tab_2" data-toggle="tab">{!! trans('order.get_back') !!}</a></li>
                    <li><a href="#tab_3" data-toggle="tab">{!! trans('order.old_claim') !!}</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <section class="content">
                            <div class="row">
                                <div class="col-md-12">

                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>{!! trans('order.demand') !!}</th>
                                            <th>{!! trans('order.answers_received') !!}</th>
                                            <th>{!! trans('order.message') !!}</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody class="table bdr-btm order-item-container">
                                        @foreach($pending_items as $item)
                                            @if(count($item->itemRequest)>0)
                                            @foreach($item->itemRequest as $index=>$request)
                                                <tr
                                                    data-item-id="{!! $item->order_item_id !!}">
                                                     @if($index==0)
                                                    <td width="30%" rowspan="{!! count($item->itemRequest) !!}" class="vertical-align right-border">
                                                        <strong>{!! ($item->brand->parent_id==null) ? $item->brand->brand_name : $item->brand->parent->brand_name !!}</strong><br>
                                                        <a href="{!! (!empty($item->product)>0 && !empty($item->product->url)) ? url($item->product->url->target_url): "#" !!}">{!! $item->product_name !!}</a>
                                                        @foreach($item->attributes as $index=>$attribute)
                                                            <br/>{!! $attribute->attribute_label !!}
                                                            : {!! $attribute->attribute_selected_value !!}
                                                        @endforeach
                                                        <br/>{!! trans('order.price') !!}: {!! format_price($item->price) !!}
                                                    </td>
                                                    @endif

                                                    <td width="20%" class="vertical-align">
                                                        <strong>{!! $request->merchant->first_name." ".$request->merchant->last_name !!}</strong><br>
                                                        @if(!empty($request->merchant->store) && !empty($request->merchant->store->first()))
                                                            <strong>{!! $request->merchant->store->first()->city !!}</strong><br>
                                                        @endif
                                                        <?php
                                                        $available_type = !empty($request->available_type) ? \App\Models\OrderItemRequest::AVAILABLE_TYPE[$request->available_type]:'';
                                                        echo trans('order.'.$available_type).'<br>';
                                                        if($request->available_type=='2'){
                                                            echo $request->available_time;
                                                        } else if($request->available_type=='5'){
                                                            echo trans('order.product_name').":".$request->product_name.'<br>';
                                                            echo trans('order.product_link').":".$request->product_link.'<br>';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td width="30%" class="vertical-align">
                                                        {!! $request->message!!}
                                                    </td>
                                                    <td width="30%" class="notification-btn vertical-align"><a
                                                                data-item-id="{!! $item->order_item_id !!}"
                                                                data-customer="{!! $request->customer_id  !!}"
                                                                data-merchant="{!! $request->merchant_id !!}"
                                                                data-available_type="{!! $request->available_type !!}"
                                                                data-available_time="{!! $request->available_time !!}"
                                                                data-product_name="{!! $request->product_name !!}"
                                                                data-product_link="{!! $request->product_link !!}"
                                                                href="javascript:void(0)"
                                                                class="btn btn-default default-btn">{!! trans('order.choose_this_seller') !!}</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @else
                                                <tr data-item-id="{!! $item->order_item_id !!}">
                                                    <td width="30%" class="vertical-align right-border">
                                                        @if(count($item->brand)>0)
                                                            <strong>{!! ($item->brand->parent_id==null) ? $item->brand->brand_name : $item->brand->parent->brand_name !!}</strong><br>
                                                        @endif
                                                        <a href="{!! (!empty($item->product)>0 && !empty($item->product->url)) ? url($item->product->url->target_url): "#" !!}">{!! $item->product_name !!}</a>
                                                        @if(count($item->attributes)>0)
                                                        @foreach($item->attributes as $index=>$attribute)
                                                            <br/>{!! $attribute->attribute_label !!}
                                                            : {!! $attribute->attribute_selected_value !!}
                                                        @endforeach
                                                        @endif
                                                        <br/>{!! trans('order.price') !!}: {!! format_price($item->price) !!}
                                                    </td>
                                                    <td width="60%" class="vertical-align" align="left" colspan="2">
                                                        <strong>{!! trans('order.waiting_merchant_msg_1').getMerchantCount($item)." ".trans('order.waiting_merchant_msg_2') !!}</strong>
                                                    </td>
                                                    <td width="30%" class="notification-btn">
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="tab-pane" id="tab_2">
                        <section class="content" id="image_content">
                            <div class="col-md-12 bdr-btm">
                                <table class="table">
                                    @if(count($selected_items)>0 )
                                        @foreach($selected_items as $index=>$item)
                                            <tr>
                                                {!! Form::open(['url' => url(LaravelLocalization::getCurrentLocale().'/booking-request'), 'id'=>'product_booking_'.$index, 'method' => 'post','class'=>' form-inline','autocomplete'=>'off']) !!}
                                                <td width="30%">
                                                    <strong>{!! ($item->brand->parent_id==null) ? $item->brand->brand_name : $item->brand->parent->brand_name !!}</strong><br>
                                                    <a href="{!! (!empty($item->product)>0 && !empty($item->product->url)) ? url($item->product->url->target_url): "#" !!}">{!! $item->product_name !!}</a>
                                                    @foreach($item->attributes as $key=>$attribute)
                                                        <br/>{!! $attribute->attribute_label !!}
                                                        : {!! $attribute->attribute_selected_value !!}
                                                    @endforeach
                                                    <br/>{!! trans('order.price') !!}: {!! format_price($item->price) !!}
                                                </td>
                                                <td width="30%">{!! $item->itemRequest->first()->merchant->first_name." ".$item->itemRequest->first()->merchant->last_name !!}
                                                    <br/>
                                                    {!! $item->itemRequest->first()->merchant->store->first()->address1." ".$item->itemRequest->first()->merchant->store->first()->address2 !!}<br>
                                                    <?php
                                                    $available_type = !empty($item->itemRequest->first()->available_type) ? \App\Models\OrderItemRequest::AVAILABLE_TYPE[$item->itemRequest->first()->available_type]:'';
                                                    echo trans('order.'.$available_type).'<br>';
                                                    if($item->itemRequest->first()->available_type=='2'){
                                                    echo $item->itemRequest->first()->available_time;
                                                    } else if($item->itemRequest->first()->available_type=='5'){
                                                    echo trans('order.product_name').":".$item->itemRequest->first()->product_name.'<br>';
                                                    echo trans('order.product_link').":".$item->itemRequest->first()->product_link.'<br>';
                                                    }
                                                    ?>
                                                </td>
                                                <td width="30%">
                                                    @if($item->itemRequest->first()->is_booked==0)
                                                        <div class="col-md-12">
                                                        <input type="hidden" name="request-id"
                                                               value="{!! $item->itemRequest->first()->order_item_request_id !!}" readonly>
                                                        <button type="submit"
                                                                class="btn btn-default default-btn response-to-customer"
                                                                data-index="{!! $index !!}"
                                                                id="response-to-customer">{!! trans('order.booking_product') !!}
                                                        </button>
                                                        </div>
                                                        <div class="col-md-12">
                                                        <button type="button"
                                                                class="btn btn-default default-btn cancel_order mr-t-5"
                                                                data-index="{!! $index !!}"
                                                                id="cancel_order">{!! trans('order.cancel_order') !!}
                                                        </button>
                                                        </div>
                                                    @endif
                                                </td>
                                                {!! Form::close() !!}
                                            </tr>
                                        @endforeach
                                    @else
                                        <p>{!! trans('order.no_records_found') !!}</p>
                                    @endif
                                </table>
                                </div>
                        </section>
                    </div>
                    <div class="tab-pane" id="tab_3">
                        <section class="content" id="image_content">
                            <div class="col-md-12 bdr-btm">
                                <table class="table">
                                    @if(count($booked_items)>0)
                                        @foreach($booked_items as $index=>$item)
                                            <tr>
                                                <td width="30%">
                                                    <strong>{!! ($item->brand->parent_id==null) ? $item->brand->brand_name : $item->brand->parent->brand_name !!}</strong><br>
                                                    <a href="{!! (!empty($item->product)>0 && !empty($item->product->url)) ? url($item->product->url->target_url): "#" !!}">{!! $item->product_name !!}</a>
                                                    @foreach($item->attributes as $index=>$attribute)
                                                        <br/>{!! $attribute->attribute_label !!}
                                                        : {!! $attribute->attribute_selected_value !!}
                                                    @endforeach
                                                    <br/>{!! trans('order.price') !!}: {!! format_price($item->price) !!}
                                                </td>
                                                <td width="40%">
                                                        {!! $item->itemRequest->first()->merchant->first_name." ".$item->itemRequest->first()->merchant->last_name !!}
                                                        <br/>
                                                        {!! $item->itemRequest->first()->merchant->store->first()->address1." ".$item->itemRequest->first()->merchant->store->first()->address2 !!}<br>
                                                        <?php
                                                        $available_type = !empty($item->itemRequest->first()->available_type) ? \App\Models\OrderItemRequest::AVAILABLE_TYPE[$item->itemRequest->first()->available_type]:'';
                                                        echo trans('order.'.$available_type).'<br>';
                                                        if($item->itemRequest->first()->available_type=='2'){
                                                            echo $item->itemRequest->first()->available_time;
                                                        } else if($item->itemRequest->first()->available_type=='5'){
                                                            echo trans('order.product_name').":".$item->itemRequest->first()->product_name.'<br>';
                                                            echo trans('order.product_link').":".$item->itemRequest->first()->product_link.'<br>';
                                                        }
                                                        ?>
                                                </td>
                                                <td width="30%">
                                                    {!! trans('order.requested') !!}
                                                    : {!! Carbon\Carbon::parse($item->itemRequest->first()->created_date)->format('d/m/Y') !!}
                                                    <br/>
                                                    @if($item->itemRequest->first()->is_booked=='1')
                                                    {!! trans('order.the_booked') !!}
                                                    : {!! Carbon\Carbon::parse($item->itemRequest->first()->booked_date)->format('d/m/Y') !!}</td>
                                                    @else
                                                    {!! trans('order.the_cancel') !!}
                                                    : {!! Carbon\Carbon::parse($item->itemRequest->first()->booked_date)->format('d/m/Y') !!}</td>
                                                    @endif
                                            </tr>
                                        @endforeach
                                    @else
                                        <p>{!! trans('order.no_records_found') !!}</p>
                                    @endif
                                </table>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </section>
@stop
@section('footer-script')
    <script>
        $(function(){
            $.fn.orderDetail();
        })
    </script>
@stop
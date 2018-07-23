@extends($layout)
@section('content')
    <section class="content-header">
        <h1>
            Item Detail
        </h1>
    </section>

    <section class="invoice">
     @if(isset($order_item))
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-globe"></i> Order Id #{!! $order_item->order_id !!}
                    <small class="pull-right">Date: {!! convertDate($order_item->order->order_date) !!}</small>
                </h2>
            </div>
        </div>
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                Customer Detail
                @if(isset($order_item->order->customer))
                <address>
                    <strong>{!! $order_item->order->customer->first_name." ".$order_item->order->customer->last_name !!}</strong><br>

                    {!! $order_item->order->customer->address->address1!!}<br/>
                    {!! $order_item->order->customer->address->address2!!}
                    {!! $order_item->order->customer->address->city!!}, {!! $order_item->order->customer->address->state!!} {!! $order_item->order->customer->address->zip!!}<br>
                    Phone: {!! $order_item->order->customer->address->phone!!}<br>
                    Email: {!! $order_item->order->customer->email!!}
                </address>
                @endif
            </div>
            <div class="col-sm-4 invoice-col">
                Merchant Detail
                <address>
                    <strong>{!! (!empty($order_item->itemRequest) && count($order_item->itemRequest) >0 ) ? $order_item->itemRequest->first()->merchant->first_name." ".$order_item->itemRequest->first()->merchant->last_name:'' !!}</strong>
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <b>Order #{!! $order_item->order_id !!}</b><br>
                <br>
                <b>Order ID:</b> {!! $order_item->order_id !!}<br>
                <b>Order Date:</b> {!! convertDate($order_item->order->order_date) !!}<br>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Qty</th>
                        <th>Product</th>
                        <th>Serial #</th>
                        <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{!! $order_item->quantity !!}</td>
                        <td>{!! $order_item->product_name !!}</td>
                        <td>{!! $order_item->product_sku !!}</td>
                        <td> ${!! $order_item->final_price!!}</td>

                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6">
                <p class="lead">Payment Methods:</p>
                @if($order_item->order->transaction)
                {!! $order_item->order->transaction->payment_method !!}
                @endif
            </div>
          
            <div class="col-xs-6">
                <p class="lead">Order Summary</p>

                <div class="table-responsive">
                    <table class="table">
                        <tr>
                     
                            <th style="width:50%">Subtotal:</th>
                            <td> ${!! $order_item->order->subtotal!!}</td>
                        </tr>
                        <tr>
                            <th>Total:</th>
                            <td> ${!! $order_item->order->total!!}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="row no-print">
            <div class="col-xs-12">
                <a href="{!! route('product_billed') !!}" class="btn btn-default pull-right">Back</a>
            </div>
        </div>
        @endif
    </section>

@stop
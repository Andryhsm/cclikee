@extends($layout)
@section('content')
    <section class="content-header">
        <h1>
            Item Detail
        </h1>
    </section>

    <section class="invoice">
    @if(isset($item))
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <i class="fa fa-globe"></i> Order Id #{!! $item->order->order_id !!}
                        <small class="pull-right">Date: {!! convertDate($item->order->order_date) !!}</small>
                    </h2>
                </div>
            </div>
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    Customer Detail
                    @if(isset($item->order->customer))
                        <address>
                            <strong>{!! $item->order->customer->first_name." ".$item->order->customer->last_name !!}</strong><br>

                            {!! $item->order->customer->address->address1!!}<br/>
                            {!! $item->order->customer->address->address2!!}
                            {!! $item->order->customer->address->city!!}, {!! $item->order->customer->address->state!!} {!! $item->order->customer->address->zip!!}<br>
                            Phone: {!! $item->order->customer->address->phone!!}<br>
                            Email: {!! $item->order->customer->email!!}
                        </address>
                    @endif
                </div>
                <div class="col-sm-4 invoice-col">
                    Merchant Detail
                    <address>
                        <strong>{!! $item->itemRequest->first()->merchant->first_name." ".$item->itemRequest->first()->merchant->last_name !!}</strong>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>Order #{!! $item->order_id !!}</b><br>
                    <br>
                    <b>Invoice ID:</b> {!! !empty($item->invoiceItem)?$item->invoiceItem->invoice->id:'' !!}<br>
                    <b>Order Date:</b> {!! convertDate($item->order->order_date) !!}<br>
                    <b>Invoice Date:</b> {!! !empty($item->invoiceItem) ? convertDate($item->invoiceItem->invoice->created_at):'' !!}<br>
                    <b>Invoice Status:</b>
                    @if(!empty($item->invoiceItem)&&$item->invoiceItem->invoice->status=='0')
                        Billed
                    @elseif(!empty($item->invoiceItem)&&$item->invoiceItem->invoice->status=='1')
                        Payed
                    @endif
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
                            <td>{!! $item->quantity !!}</td>
                            <td>{!! $item->product_name !!}</td>
                            <td>{!! $item->product_sku !!}</td>
                            <td> ${!! $item->final_price!!}</td>

                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-6">
                    <p class="lead">Payment Methods:</p>
                    Cash
                </div>

                <div class="col-xs-6">
                    <p class="lead">Order Summary</p>

                    <div class="table-responsive">
                        <table class="table">
                            <tr>

                                <th style="width:50%">Subtotal:</th>
                                <td> {!! format_price($item->final_price) !!}</td>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td> {!! format_price($item->final_price) !!}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row no-print">
                <div class="col-xs-12">
                    <a href="{!! url('admin/company-account') !!}" class="btn btn-default pull-right">Back</a>
                </div>
            </div>
        @endif
    </section>

@stop
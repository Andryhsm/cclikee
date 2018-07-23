@extends($layout)
@section('content')
    <section class="content-header">
        <h1>
            Invoice Detail
        </h1>
    </section>

    <section class="invoice">
    @if(isset($invoice))
        <!-- title row -->
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <i class="fa fa-globe"></i> Invoice Id #{!! $invoice->id !!}
                        <small class="pull-right">Created Date: {!! convertDate($invoice->created_at) !!}</small>
                    </h2>
                </div>
            </div>
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    Merchant Detail
                    @if(isset($invoice->store))
                        <address>
                            <strong>{!! $invoice->merchant->first_name." ".$invoice->merchant->last_name !!}</strong><br>

                            {!! $invoice->store->address1!!}<br/>
                            {!! $invoice->store->address2!!}
                            {!! $invoice->store->city!!}, {!! $invoice->store->state->name !!} {!! $invoice->store->zip!!}<br>
                            Phone: {!! $invoice->store->phone!!}<br>
                            Email: {!! $invoice->store->email!!}
                        </address>
                    @endif
                </div>
                <div class="col-sm-4 invoice-col">
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
                            <th>Commission</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($invoice->items as $item)
                        <tr>
                            <td>{!! $item->orderItem->quantity !!}</td>
                            <td>{!! $item->orderItem->product_name !!}</td>
                            <td>{!! $item->orderItem->product_sku !!}</td>
                            <td> ${!! $item->orderItem->final_price!!}</td>
                            <td> ${!! getCommission($item->orderItem->final_price) !!}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-6">
                    <p class="lead">Payment Methods:</p>
                    Stripe
                </div>

                <div class="col-xs-6">
                    <p class="lead">Order Summary</p>

                    <div class="table-responsive">
                        <table class="table">
                            <tr>

                                <th style="width:50%">Subtotal:</th>
                                <td> ${!! $invoice->amount !!}</td>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td> ${!! $invoice->amount !!}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row no-print">
                <div class="col-xs-12">
                    <a href="{!! url('admin/invoice') !!}" class="btn btn-default pull-right">Back</a>
                </div>
            </div>
        @endif
    </section>

@stop
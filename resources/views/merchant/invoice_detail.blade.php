@extends('front.layout.master')
@section('content')
    <section class="ptb-30">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="invoice-title">
                        <h2>{!! trans('merchant.invoice') !!}</h2><h3 class="pull-right"># {!! $invoice->id !!}</h3>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-6">
                            <address>
                                <strong>{!! trans('merchant.billed_to') !!}:</strong><br>
                                {!! $invoice->merchant->first_name." ".$invoice->merchant->last_name !!}<br>
                                {!! $invoice->store->address1 !!}<br>
                                {!! $invoice->store->address2 !!}<br>
                                {!! $invoice->store->city !!}, {!! $invoice->store->state->state_name !!} {!! $invoice->store->zip !!}
                            </address>
                        </div>
                        <div class="col-xs-6 text-right">
                            <address>
                            </address>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <address>
                                <strong>{!! trans('merchant.payment_method') !!}:</strong><br>
                                Stripe
                            </address>
                        </div>
                        <div class="col-xs-6 text-right">
                            <address>
                                <strong>{!! trans('merchant.invoice_date') !!}:</strong><br>
                                {!! convertDate($invoice->created_at) !!}<br><br>
                            </address>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>{!! trans('merchant.invoice_summary') !!}</strong></h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-condensed">
                                    <thead>
                                    <tr>
                                        <td><strong>{!! trans('merchant.item') !!}</strong></td>
                                        <td class="text-center"><strong>{!! trans('merchant.price') !!}</strong></td>
                                        <td class="text-center"><strong>{!! trans('merchant.commission') !!}</strong></td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($invoice->items as $item)
                                    <tr>
                                        <td>{!! $item->orderItem->product_name !!}</td>
                                        <td class="text-center">{!! format_price($item->orderItem->final_price) !!}</td>
                                        <td class="text-center">{!! format_price(getCommission($item->orderItem->final_price)) !!}</td>
                                    </tr>
                                    @endforeach

                                    <tr>
                                        <td class="thick-line"></td>
                                        <td class="thick-line text-center"><strong>{!! trans('merchant.subtotal') !!}</strong></td>
                                        <td class="thick-line text-center">{!! format_price($invoice->amount) !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line text-center"><strong>{!! trans('merchant.total') !!}</strong></td>
                                        <td class="no-line text-center">{!! format_price($invoice->amount) !!}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                @if($invoice->status=='0')
                <form action="{!! url('/merchant/pay-invoice/'.$invoice->id) !!}" method="post" name="invoice_pay">
                    <div class="col-xs-12 margin-top btn-group">
                        <button type="submit" id="action_create_invoice"
                                class="mr-b-15 mr-r-5 btn btn-success pull-right">{!! trans('merchant.pay') !!}</button>
                    </div>
                </form>
                @else
                    <div class="col-xs-12 margin-top btn-group">
                        <button type="button" id="action_create_invoice"
                                class="mr-b-15 mr-r-5 btn btn-success pull-right">{!! trans('merchant.paid') !!}</button>
                    </div>
                @endif
            </div>

        </div>
    </section>
@stop
@section('footer-script')
    <script>
    </script>
@stop
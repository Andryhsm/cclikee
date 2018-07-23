@extends('front.layout.master')
@section('content')
    <section class="my-acccount-container ptb-30">
        <div class="container my-account-box">
            @if(empty($cards['data']))
                <div class="alert alert-warning" role="alert"> <strong>Warning!</strong>
                    {!! trans('merchant.missing_card_1') !!}
                    <a data-toggle="modal" data-target="#card_info" class="add_card" id="add_card" href="javascript:void(0)">{!! trans('merchant.missing_card_2') !!}</a>
                    {!! trans('merchant.missing_card_3') !!}
                </div>
            @endif
            <div class="header-title text-center">
                <a href="{!! url('/merchant/request') !!}">{!! trans('customer.request_management') !!}</a>
            </div>
            <div class="row">
                @include('notification')
                <div class="col-md-6">
                    <h1>{!! trans('customer.account_info') !!}</h1>
                    <div class="create-store">
                        <a class="" href="{!! url('/store/create/') !!}">{!! trans('merchant.add_store') !!}</a>
                    </div>
                    <div id="store-content" class="account-info-box  content">
                    </div>
                </div>
                <div class="col-md-6">
                    <h1>{!! trans('customer.request_management') !!}</h1>
                    <div id="merchant-orders-content" class="account-info-box  content"></div>
                </div>

                <div class="col-md-12">
                    <h1>{!! trans('merchant.invoices') !!}</h1>
                    <div id="merchant-invoice-content" class="account-info-box content"></div>
                </div>

            </div>
        </div>
    </section>

    <div class="modal-area">
        <!-- single-modal-start -->
        <div class="modal fade" id="card_info" tabindex="-1" role="dialog" aria-hidden="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{!! url('/merchant/add-card') !!}" class="form-horizontal" role="form" id="card_form" method="post">
                            <span class="payment-errors"></span>
                            <fieldset>
                                <legend>{!! trans('merchant.card_info') !!}</legend>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="card-number">{!! trans('merchant.card_number') !!}</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="card_number" data-stripe="number" id="card-number" placeholder="Debit/Credit Card Number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="expiry-month">{!! trans('merchant.expiration_date') !!}</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <input type="text" class="form-control" name="exp_month" size="2" data-stripe="exp_month" id="card-number" placeholder="MM">
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" class="form-control" name="exp_year" size="2" data-stripe="exp_year" id="card-number" placeholder="YY">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="cvv">{!! trans('merchant.card_cvv') !!}</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" name="cvv" size="4" data-stripe="cvc" id="cvv" placeholder="CVV">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button type="submit" class="btn btn-success">{!! trans('merchant.add_card') !!}</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
@section('footer-script')
    <script>
        $(function () {
            $.fn.customerProfile({
                role_id: "{!! $customer->role_id !!}"
            });
        })
    </script>
@stop
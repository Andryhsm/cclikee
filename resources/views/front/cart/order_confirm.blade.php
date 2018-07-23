@extends('front.layout.master')

@section('content')

    <?php
    /* $merchant_count = 0;
    foreach ($order->orderItems as $item){
        $merchant_count+=getMerchantCount($item);
    }*/
    ?>

    <div class="container">
        <div class="row mt-100 mb-100">
            <div class="col-lg-6 col-md-offset-3 mr-t-20">
                <div class="entry-header text-center mb-20">
                    <p><strong>{!! trans('common/label.thank_you_order') !!}</strong></p>
                </div>
                <div class="entry-content text-center order-confirm-text">
                    <p class="second-text">{!! trans('common/label.confirmation_text_2') !!} <a class="order-link" href="{!! url('customer/current-order') !!}">{!! trans('common/label.confirmation_link_text') !!}</a></p>
                    <a href="{!! route('home') !!}" class="btn btn-order-filled mt-20">Retourner à l ' accueil</a>
                </div>  
            </div>
        </div>
        
    </div>
    @include('front.layout.section-avantage')
@stop
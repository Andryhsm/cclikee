@extends('front.customer.layout.master')
@section('content')
<div class="section-element-area aid_faq">
    <div class="faq-content col-lg-12">
        <div class="">
            <div class="faq">
                <div class="faq-title text-center">
                    <h2>{!! trans('faq.title') !!}</h2>
                </div>
                <div class="collapses-group">
                <div class="panel-group-customer" id="accordion" role="tablist" aria-multiselectable="true">
                    <?php $inc = 1; ?>
                    @foreach($faqs as $index=>$faq)
                    <div class="panel panel-default" id="faq{!! $faq->id !!}" onclick="activate(this);">
                        <?php 
                            $class = "";
                            $class = ($inc%2 == 1) ? "left-arrow" : "right-arrow"; 
                        ?>
                        <div class="panel-heading {!! $class !!}" role="tab" id="headingOne">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse{!! $faq->id !!}" aria-expanded="true" aria-controls="collapse{!! $faq->id !!}">
                                    {!! $faq->byLanguage(app('language')->language_id,'question') !!}
                                </a>
                            </h4>
                        </div>
                        <div id="collapse{!! $faq->id !!}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{!! $faq->id !!}">
                            <div class="panel-body">
                                {!! $faq->byLanguage(app('language')->language_id,'answer') !!}
                            </div>
                        </div>
                    </div>
                    <?php $inc++;?>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 text-center mt-30">
            <h3 class="text-uppercase fw-600">{!! trans('faq.have_question') !!}</h3>
        </div>
        <div class="{!! ((app('language')->language_id==2)? "col-lg-8 col-md-offset-2 ": "col-lg-4 col-md-offset-4") !!}">
            <div class="question-area pb-40 text-center">
                <a class="btn btn-customer-filled" href="{!! route('contact-us-get') !!}">{!! trans('faq.contact_us') !!}</a>
            </div>
        </div>
    </div>
</div>
<!-- start section avantage -->
<!--@include('front.layout.section-avantage')-->
<!-- end section avantage -->
@stop


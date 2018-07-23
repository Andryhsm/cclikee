@extends('front.layout.master')
@section('content')
<div class="section-element-area ptb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="faq-content">
                    <div class="faq-title text-center">
                        <h2>{!! trans('faq.title') !!}</h2>
                    </div>
                    <div class="collapses-group">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <?php $inc = 1; ?>
                        @foreach($faqs as $index=>$faq)
                        <div class="panel panel-default">
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
            <div class="col-lg-12 mb-30">
                
            </div>
            <div class="{!! ((app('language')->language_id==2)? "col-lg-6 col-md-offset-3 ": "col-lg-4 col-md-offset-4") !!}">
                <div class="question-area text-center">
                    <h3>{!! trans('faq.have_question') !!}</h3>
                    <a class="btn btn-clickee-default" href="{!! route('contact-us-get') !!}">{!! trans('faq.contact_us') !!}</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- start section avantage -->
@include('front.layout.section-avantage')
<!-- end section avantage -->
@stop


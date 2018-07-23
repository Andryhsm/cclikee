@extends('front.layout.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="entry-header text-center mb-20">
                    <img src="{!! url('frontend/img/404.jpg') !!}" alt="not-found-img">
                    <p>{!! trans('common/label.oops') !!}</p>
                </div>
                <div class="entry-content text-center mb-30">
                    <p>{!! trans('common/label.page_not_found') !!}</p>
                    <a href="{!! url('/') !!}">{!! trans('common/label.go_to_home') !!}</a>
                </div>
            </div>
        </div>
    </div>
@stop


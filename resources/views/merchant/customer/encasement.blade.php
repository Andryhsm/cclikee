@extends('merchant.layout.master')
@section('additional-styles')
    {!! Html::style('backend/plugins/datatables/dataTables.bootstrap.css') !!}
    {!! Html::style('frontend/css/font-awesome.min.css') !!}
    {!! Html::style('backend/bootstrap/css/bootstrap.min.css') !!}
    {!! Html::style('backend/plugins/select2/select2.css') !!}
    {!! Html::style('backend/dist/css/AdminLTE.min.css') !!}
    {!! Html::style('backend/dist/css/skins/skin-black-light.css') !!}
    {!! Html::style('backend/css/style.css') !!}
     {!! Html::style('backend/plugins/dynatree/src/skin/ui.dynatree.css') !!}
    {!! Html::style('backend/plugins/dropzone/dropzone.css') !!}
    {!! Html::style('backend/plugins/plupload/js/jquery.plupload.queue/css/jquery.plupload.queue.css') !!}
    {!! Html::style('frontend/css/style-clickee.css') !!}
@stop
@section('page_title')
    <div class="section-title col-mm-8  col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <div class="header-item">  
            <div class="title title-active col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="title-icon">
                    <img class="" src="{!! URL::to('/') !!}/images/icon/encasement.svg"/>
                </div> 
                <div class="title-title">
                    <span class="text-title-active">Encaissement</span>
                </div>
            </div>
        </div>
    </div>
@stop
@section('content')
<section class="content">
    <div class="bottle">
    	<section class="content-header text-center">
            <strong class="text-uppercase">
                Encaissement
            </strong>
        </section>
    
        <section class="content">
            @include('admin.layout.notification')
            <div class="customer-encasement">
                <div class="col-xs-12">
                    <!--<div class="box">
                        <div class="box-body">-->
                            <div class="title text-center">
                                <strong class="text-uppercase">Client</strong>
                            </div>
                            <div class="btn btn-small mt-20 col-sm-6 col-xs-6">
                                <a href="{!! route('client.index') !!}" class="btn btn-block btn-merchant-filled">Dejà Client</a>
                            </div>
                            <div class="btn btn-small mt-20 col-sm-6 col-xs-6">
                                <a href="{!! route('client.create') !!}" class="btn btn-block btn-merchant-filled">Nouveau Client</a>
                            </div>
                        <!--</div>
                    </div>-->
                </div>
            </div>
        </section>
    </div>
</section>

@endsection
@section('additional-scripts')
    {!! Html::script('backend/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('backend/plugins/datatables/dataTables.bootstrap.min.js') !!}
@stop
@section('footer-scripts')
    
    {!! Html::script('frontend/js/customer.js') !!}
@stop

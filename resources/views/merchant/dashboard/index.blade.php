@extends('merchant.layout.master')

@section('additional-styles')
    {!! Html::style('backend/plugins/datatables/dataTables.bootstrap.css') !!}
    {!! Html::style('frontend/css/font-awesome.min.css') !!}
    {!! Html::style('backend/bootstrap/css/bootstrap.min.css') !!}
    {!! Html::style('backend/plugins/select2/select2.css') !!}
    {!! Html::style('backend/dist/css/AdminLTE.min.css') !!}
    {!! Html::style('backend/dist/css/skins/skin-black-light.css') !!}
    {!! Html::style('backend/css/style.css') !!}
    {!! Html::style('frontend/css/style-clickee.css') !!}
    {!! Html::style('frontend/css/morris.css') !!}
@stop
@section('page_title')
    <div class="section-title col-mm-8  col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <div class="header-item">  
            <div class="title title-active col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="title-icon">
                    <img class="" src="{!! URL::to('/') !!}/images/icon/dashboard.svg"/>
                </div> 
                <div class="title-title">
                    <span class="text-title-active">Tableau de bord</span>
                </div>
            </div>
        </div>
    </div>
@stop

@section('content')
    <section class="content">
        <!--<div class="box box-primary">
            <div class="box-body">-->
        <div class="bottle">
            <div  class="col-lg-12 col-sm-12 text-center">
               <h3><label class="label color-text text-uppercase">Statistiques de vente</label></h3>
        	   <div id="salesstat" data-url="{!! route('merchant-statistical') !!}"></div>
            
        
            	<div class="counting mt-30">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8">
                        <div class="bottle-box">
                            <h3><span class="bottle-box-number">{!! $product_count !!}</span></h3>
                            <span class="bottle-box-title">
                                Produits en ligne
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-8">
                        <div class="bottle-box">
                            <h3><span class="bottle-box-number">{!! $sales_count !!}</span></h3>
                            <span class="bottle-box-title">
                                Produits vendus
                        </div>
                    </div>
        
                    <!--<div class="clearfix visible-sm-block"></div>-->
        
                    <div class="col-lg-4 col-sm-4 col-xs-8">
                       <div class="bottle-box">
                            <h3><span class="bottle-box-number">{!! $total_sales !!}</span></h3>
                            <span class="bottle-box-title">
                                Chiffre d'affaires total
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
            <!--</div>
        </div>-->
    </section>
    
    <section class="content">
        <div  class="bottle">
            <div class="col-sm-6 col-sm-offset-3 text-center">
                <h3><label class="label color-text text-uppercase">Ventes en ligne - locales</label></h3>
                <div id="salescamembert" data-url="{!! route('merchant-inlineLocal') !!}"></div>
            </div>
        </div>
        <br>
    </section>
@stop
@section('additional-script')
    {{ HTML::script('frontend/js/dashboard.js') }}
@endsection
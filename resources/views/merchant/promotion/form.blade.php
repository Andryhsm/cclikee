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
@stop
@section('page_title')
    <div class="section-title col-mm-8  col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <div class="header-item">  
            <div class="title title-active col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="title-icon">
                    <img class="" src="{!! URL::to('/') !!}/images/icon/communication.svg"/>
                </div> 
                <div class="title-title">
                    <span class="text-title-active">Communication</span>
                </div>
            </div>
        </div>
    </div>
@stop
@section('content')

<?php
$all_code_promo = [];
if(count($code_promos) > 0){        
    foreach ($code_promos as $code_promo) {
        $all_code_promo[$code_promo->code_promo_id] = $code_promo->code_promo_name;
    }
}
?>
<section class="content">
    <div class="bottle">
        <section class="content-header text-center">
            <strong class="text-uppercase">
                Nouvelle Newsletter
            </strong>
        </section>
    
        @include('admin.layout.notification')
        <div class="">
            <div class="col-md-12">
                <div class=""> <!-- box box-primary -->
                    <div class=""> <!-- box-body -->
                    {!! Form::open(array('url' =>($promotion) ? Url("marchand/promotion/$promotion->promotion_id") : Url("marchand/promotion"),'id'=>'promotion','class'=>'promotion','method' => ($promotion)? 'PATCH':'POST')) !!}
                                        
                        <div class="row">
                        	<div class="col-lg-6">
    	                    	<div class="form-group col-lg-12">
    		                        <label for="campagne_name">Nom campagne</label>
    		                        <input type="text" name="campagne_name" class="form-control required" id="campagne_name"
    		                               value="{!! ($promotion) ? $promotion->campagne_name : null !!}"
    		                               placeholder="Nom campagne">
    		                    </div>
    		                    <div class="form-group col-lg-12">
    	                            {!! Form::label('code_promo','Code promo') !!}
    								{!! Form::select('code_promo',$all_code_promo,($promotion) ? $promotion->code_promo : null,['class'=>'form-control required','id'=>'code_promo']) !!}
    	                        </div>
                        	</div>
                        	<div class="col-lg-6">
    	                    	<div class="form-group col-lg-12">
    		                        <label for="subject">Sujet</label>
    		                        <input type="text" name="subject" class="form-control required" id="subject"
    		                               value="{!! ($promotion) ? $promotion->subject : null !!}"
    		                               placeholder="Sujet du mail">
    		                    </div>
    		                    <div class="form-group col-lg-12">
    		                        <label for="description">Déscription</label>
    		                        <textarea name="description" rows="5" class="form-control required" id="description"
    		                               value="{!! ($promotion) ? $promotion->description : null !!}"
    		                               placeholder="Déscription"></textarea>
    		                    </div>
                        	</div>
                        </div>
                    </div>
                    <div class="col-lg-12"> <!-- box-footer -->
                        <a href="{!! Url('marchand/promotion') !!}" class="btn btn-merchant-filled">Annuler</a>
                        <button type="submit" class="btn btn-merchant-filled pull-right" id="add-role">Envoyer</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</section>

@stop
@section('additional-script')
	{!! Html::script('backend/plugins/select2/select2.js') !!}
    <script>
        $('#code_promo').select2();
    </script>    
@stop
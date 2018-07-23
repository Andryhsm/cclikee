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
                    <img class="" src="{!! URL::to('/') !!}/images/icon/code_promo.svg"/>
                </div> 
                <div class="title-title">
                    <span class="text-title-active">Codes promo</span>
                </div>
            </div>
        </div>
    </div>
@stop
@section('content')

<?php
$category_parents = [];
if(count($categories) > 0){        
    foreach ($categories as $category) {
        $category_parents[$category->category_id] = $category->getByLanguage(app('language')->language_id)->category_name;
    }
}
/*var_dump($category_parents);*/
$selected_category = [];
    if ($code_promo && count($code_promo->categories) > 0) {
        foreach ($code_promo->categories as $category) {
            $selected_category[] = $category->category_id;
        }
    }
?>
<section class="content">
    <div class="bottle">
        <div class="content-header text-center">
            <strong class="text-uppercase">
                Mise à jours code promo
            </strong>
        </div>
        
        <section class="content">
            @include('admin.layout.notification')
            <div class="">
                <div class="col-md-12">
                    <!--<div class="box box-primary">
                        <div class="box-body">-->
                        {!! Form::open(array('url' =>($code_promo) ? route('code-promo.update',['code_promo' => $code_promo->code_promo_id]) : route('code-promo.store'),'id'=>'code_promo','class'=>'code_promo','method' => ($code_promo)? 'PATCH':'POST')) !!}
                                            
                            <div class="row">
                            	<div class="col-lg-6">
        	                    	<div class="form-group col-lg-12">
        		                        <label for="code_promo_name">Nom du code</label>
        		                        <input type="text" name="code_promo_name" class="form-control required" id="code_promo_name"
        		                               value="{!! ($code_promo) ? $code_promo->code_promo_name : null !!}"
        		                               placeholder="Nom du code">
        		                    </div>
        	                    	<div class="form-group col-lg-12">
        	                            <label for="date_debut">Date début</label>
        	                            <input type="text" name="date_debut" class="form-control datepicker required" id="date_debut"
        	                                   value="{!! ($code_promo) ? $code_promo->date_debut : null !!}"
        	                                   placeholder="Date début">
        	                        </div>
        	                        <div class="form-group col-lg-12">
        	                            <label for="date_fin">Date fin</label>
        	                            <input type="text" name="date_fin" class="form-control datepicker required" id="date_fin"
        	                                   value="{!! ($code_promo) ? $code_promo->date_fin : null !!}"
        	                                   placeholder="Date fin">
        	                        </div>	
        	                        <div class="form-group col-lg-12">
        	                            <label for="quantity_max">Quantité max</label>
        	                            <input type="number" name="quantity_max" class="form-control required" id="quantity_max"
        	                                   value="{!! ($code_promo) ? $code_promo->quantity_max : null !!}"
        	                                   placeholder="Quantité max">
        	                        </div>
                            	</div>
                            	<div class="col-lg-6">	
        	                    	<div class="form-group col-lg-12">
        	                            {!! Form::label('categories[]','Catégorie produit concernés') !!}
        								{!! Form::select('categories[]',$category_parents,($code_promo) ? $selected_category : null,['class'=>'form-control required','id'=>'categories','style'=>'height: 11rem;','multiple'=>true]) !!}
        	                        </div>
        	                        <div class="form-group col-lg-12 product-autocomplete">
                                        {!! Form::label('product', 'Produits', ['class' => ''])
                                        !!}
                                        <div class="">
                                            <span class="search-box-container">
                                                <span class="search-box">
                                                    <ul>
                                                    <?php
                                                    $selected_product = [];
                                                    if($code_promo){
                                                    foreach ($code_promo->products as $product){
                                                    $selected_product[] = $product->product_id;
                                                    ?>    
                                                        <li class="search-choice"
                                                            id="{!! $product->product_id!!}">
                                                            <span class="search-box-remove">×</span>
                                                            {!! $product->french->product_name !!}
                                                        </li>
                                                        
                                                    <?php }
                                                    }
                                                        ?>
                                                        <li data-type="category" class="search-input"><input
                                                                    class="form-control product-auto-complete">
                                                        </li>
                                                    </ul>
                                                </span>
                                            </span>
                                        </div>
                                        @if($code_promo)
                                            <input type="hidden" name="product" value="{!! implode(',',$selected_product) !!}" id="product">
                                        @else
                                            <input type="hidden" name="product" value="" id="product">
                                        @endif    
                                    </div>
                            	</div>
                            	
                            </div>
                        </div>
                        <div class="col-md-12"> <!--box-footer-->
                            <div class="col-lg-6">
                                 <a href="{!! route('code-promo.index') !!}" class="btn btn-merchant-filled">Annuler</a>
                            </div>
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-merchant-filled pull-right" id="add-role">Enregistrer</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                        <!--</div>
                    </div>-->
                </div>
            </div>
        </section>
    </div>
</section>

@stop
@section('additional-script')
    {!! Html::script('frontend/js/code_promo.js') !!}
    <script type="text/javascript">
        
        $(function () {
            $('#date_debut').change(function(){
                var date_debut = $('#date_debut').val();
                console.log(date_debut);
                $('#date_fin').datepicker('update', date_debut);  
            }); 

            $('#date_fin').change(function(){
                var date_debut = $('#date_debut').val().split("-");
                var date_fin = $('#date_fin').val().split("-");
                var time_debut = new Date(date_debut[2], date_debut[1], date_debut[0]);
                var time_fin = new Date(date_fin[2], date_fin[1], date_fin[0]);
                console.log('time_debut' + time_debut);
                console.log('time_fin' + time_fin);
                if(date_fin && time_fin < time_debut){
                    alert('Choisissez une date antérieure à la date début');
                    $('#date_fin').datepicker('update', ''); 
                }
            });                     
        });
    </script>
@stop
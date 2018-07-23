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
    <?php 
        $category_arr = [];
        $attributes = array();
    ?>
<section class="content">
    <div class="bottle">
        <section class="content-header" style="text-align: center;">
            <strong class="text-uppercase">
                @if($customer)
                    Dejà Client
                @else
                    Nouveau Client
                @endif
            </strong>
        </section>
        @include('admin.layout.notification')
    	<div class="row">
    		<div class="col-md-12">
    			<div class="nav-tabs-custom">
    				{!! Form::open(['url' => route('client.store') , 'id' =>'customer_form', 'enctype' => 'multipart/form-data', 'method' => 'POST']) !!}
    					<div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                @include('merchant.customer.customer')
                            </div>
                            <div class="tab-pane" id="tab_2">
                                @include('merchant.customer.product_encasement')
                            </div>
                            <div class="tab-pane" id="tab_3">
                                @include('merchant.customer.payement')
                            </div>
                            
                        </div>
    				{!! Form::close() !!}
    			</div>
    		</div> 
    	</div>
    </div>
</section>

@endsection
@section('additional-script')    
    <script>
        var product_is_active = [
                        {
                            id : 0,
                            text : "Séléctionner un produit"
                        },
                <?php 
                    $index = 0;
                    foreach ($product_is_active as $product): ?>
                       {
                            id : {!! addslashes($product->product_id) !!},
                            text : '{!! addslashes($product->french->product_name) !!}'
                        } {!! ((sizeof($product_is_active) - 1) != $index) ? "," : "" !!}
                                            
                <?php
                    $index++;
                    endforeach ?>
        ];
    </script>
    <!-- autocomplete -->
    {!! Html::script('frontend/js/jquery.easy-autocomplete.min.js') !!}
    {!! Html::script('backend/plugins/select2/select2.js') !!}
    {!! Html::script('frontend/js/customer.js') !!}

@stop
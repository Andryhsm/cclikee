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
                    <img class="" src="{!! URL::to('/') !!}/images/icon/my_product.svg"/>
                </div> 
                <div class="title-title">
                    <span class="text-title-active">Mes produits</span>
                </div>
            </div>
        </div>
    </div>
@stop
@section('content')
<section class="content">
    <div class="bottle">
        <section class="content-header">
            <h1>
                Tous les produits
            </h1>
    
            <div class="header-btn">
                <div class="clearfix">
                    <div class="btn-group inline pull-left">
                        <div class="btn btn-small">
                            <a href="{!! route('create_product') !!}" class="btn btn-block btn-merchant-filled">Nouveau produit</a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>
    
        <section class="content">
            @include('admin.layout.notification')
            <div class="">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <table id="product_list" class="table table-bordered table-hover table-responsive">
                                <thead class="text-uppercase">
                                <tr>
                                    <th>Nom Produit</th>
                                    <th>Numéro de série</th>
                                    <th>Marque</th>
                                    <th>Créé le</th>
                                    <th>Statut</th>                                
                                    <th class="no-sort">Action</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>
@stop

@section('additional-script')
    {!! Html::script('backend/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('backend/plugins/datatables/dataTables.bootstrap.min.js') !!}
    {!! Html::script('backend/plugins/dropzone/dropzone.js') !!}
    {!! Html::script('backend/js/tableExport.js') !!}
    <script type="application/javascript" language="JavaScript">
        var url_redirect = "{!! route('merchant-product') !!}";
        var url_get_data_product = "{!! route('merchant-product-data') !!}";
        var url_remove_image = "{!! route('remove_product_image') !!}";
        var url_upload_image = "{!! route('upload_product_image') !!}";
        var url_search_product = "{!! route('merchant_search_product') !!}";
        var url_remove_product_tag = "{!! route('merchant_product_remove_tag') !!}";
    </script>
    {!! Html::script('frontend/js/product_merchant.js') !!}
@stop

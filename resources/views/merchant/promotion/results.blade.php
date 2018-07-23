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
<section class="content-header">
    <h1>
        Résultat promotion {!! $promotion->campagne_name !!}
    </h1>
    <div class="header-btn">
            <div class="clearfix">
                <div class="btn-group inline pull-right">
                    <span style="font-size: 22px;"> Employé {!! count($encasementproducts) !!} fois </span>
                </div>
            </div>
        </div>
</section>

<section class="content">
    @include('admin.layout.notification')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <p> <b>Nom code promo:</b> {!! $code_promo->code_promo_name !!} </p>
                            <p> <b>Quantité max:</b> {!! $code_promo->quantity_max !!} </p>
                        </div>
                        <div class="col-lg-6">
                            <p> <b>Date début:</b> {!! Jenssegers\Date\Date::parse($code_promo->date_debut)->format('j F Y') !!} </p>
                            <p> <b>Date fin:</b> {!! Jenssegers\Date\Date::parse($code_promo->date_fin)->format('j F Y') !!} </p>
                        </div>    
                        <div class="col-lg-2">
                            <b> Catégories: </b>
                        </div>
                        <div class="col-lg-10 mb-10">
                            @foreach($code_promo->categories as $category)
                                <span class="badge bg-green mr-5" style="background: #044651 !important;">{!! $category->french->category_name !!}</span>
                            @endforeach
                        </div>
                    </div>

                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th width="">Date</th>
                            <th width="">Nom produit</th>
                            <th width="">Prix</th>
                            <th width="">Quantité</th>
                            <th width="">Sous total</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0; ?>
                            @foreach($encasementproducts as $encasementproduct)
                                <?php 
                                    $sub_total = $encasementproduct->product->original_price * $encasementproduct->quantity; 
                                    $total += $sub_total;
                                ?>
                                <tr>
                                    <td>{!!Jenssegers\Date\Date::parse($encasementproduct->created_at)->format('j F Y')!!}</td>
                                    <td>{!!$encasementproduct->product->french->product_name!!}</td>
                                    <td>{!!$encasementproduct->product->original_price!!}</td>        
                                    <td>{!!$encasementproduct->quantity!!}</td>
                                    <td>{!!$sub_total!!}</td>                                
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pull-right mt-20">
                        <p> <b> Total: </b> {!! $total !!} </p>
                    </div>
                </div>
                <div class="box-footer">
                    <a href="{!! Url('marchand/promotion') !!}" class="btn btn-primary pull-right">Retour</a>
                </div>
            </div>
        </div>
    </div>
</section>
@stop
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
            <section class="list-article-header">
                <div class="pull-left buttons-selection ptb-20">
                    <a class="delete-selected" href="#"><i class="fa fa-trash deletes hidden"></i></a>
                </div>
                <div class="pull-right ptb-20">
                    <a href="{!! route('article.create') !!}" class="btn btn-block btn-merchant-filled">
                        <i class="fa fa-plus"></i>
                        Nouvel article
                    </a>
                </div>
                <div class="blocs-3 pb-10">
                    <div class="" style="line-height: 5rem; width:160px;">
                        <a href="#" class="check-all"><i class="fa fa-circle-o mr-10"></i> <span>Tout sélectionner</span></a>
                    </div>
                    <div class="bloc">
                        <select id="product_sold" name="">
                            <option value="">Tous les articles</option>
                            <option value="">Produits soldés</option>
                            <option value="">Par gamme</option>
                        </select>
                    </div>
                    <div class="bloc">
                        <select id="stock_manage" name="">
                            <option value="">Voir tout</option>
                            <option value="">En stock</option>
                            <option value="">En partie en rupture de stock</option>
                        </select>
                    </div>
                </div>             
            </section>
            @include('admin.layout.notification')
            <div class="notification">
                
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <table id="article_list" class="article">
                        <thead class="text-uppercase">
                            <tr>
                                <th></th>
                                <th>ARTICLE</th>
                                <th>PRIX</th>
                                <th>INVENTAIRE</th>
                                <th class="no-sort"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products->data as $product)
                            <tr class="content-product">
                                <td>  <a href="#" class="checkbox" data-product-id="{!! $product->product_id !!}"><i class="fa fa-circle-o mr-10"></i></a>
                                </td>
                                <td class="article">
                                    <?php 
                                        $url_image = isset($product->images[0]) ? 'upload/product/'.$product->images[0]->image_name : '';
                                    ?>
                                    <img class="article-img" src="{!! url($url_image) !!}"></img>
                                </td>
                                <td class="product_name"><span>{!! isset($product->translation->product_name) ? $product->translation->product_name : '' !!}</span></td>
                                <td class="article_price">{!! format_price($product->original_price) !!}</td>
                                <td class="inventory">en stock</td>
                                <td class="action">
                                    <a href="{!! route('article.edit',['article'=>$product->product_id]) !!}" class=""><i class="fa fa-eye"></i></a>
                                    
                                    {!! Form::open(array('url' => route('article.destroy',['article'=>$product->product_id]), 'class' => 'pull-right')) !!}
                                    {!! Form::hidden('_method', 'DELETE') !!}
                                    {!! Form::button('<i class="fa fa-fw fa-trash"></i>', ['type' => 'submit', 'class' => 'btn delete-btn delete-btn'.$product->product_id.' btn-default btn-sm'] ) !!}
                                    {{ Form::close() }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@stop
@section('additional-script')
    <script>
        var url_deletes_product =   "{!! route('delete_products') !!}";
    </script>
    {!! Html::script('backend/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('backend/plugins/datatables/dataTables.bootstrap.min.js') !!}
    {{ HTML::script('frontend/js/article.js') }}
@stop
@section('footer-scripts')
    <script>
        if (jQuery('table.article').length > 0) {
            jQuery('table.article').DataTable({
                "responsive": true,
                "bPaginate": true,
                "bLengthChange": false,
                "bFilter": false,
                "bInfo": true,
                "bAutoWidth": false,
                "order": [[2, "desc"]],
                "lengthMenu": [20, 40, 60, 80, 100],
                "pageLength": 20,
                language: {
                        paginate: {
                            first:    'Premier',
                            previous: 'Précédent',
                            next:      'Suivant',
                            last:     'Dernier'
                        },
                        "lengthMenu": "Afficher _MENU_ entrées",
                        "search": "Chercher:",
                        "processing": "En traitement ...",
                        "infoEmpty": "Aucune entrée à afficher",
                        "info": "Afficher la page _PAGE_ de _PAGES_"
                },
                columns: [
                    {searchable: true, sortable: true},
                    {searchable: false, sortable: false},
                    {searchable: true, sortable: true},
                    {searchable: false, sortable: false}
                ],
                fnDrawCallback: function () {
                    var $paginate = this.siblings('.dataTables_paginate');

                    if (this.api().data().length <= this.fnSettings()._iDisplayLength) {
                        $paginate.hide();
                    }
                    else {
                        $paginate.show();
                    }
                }
            });
        }

        if (jQuery('.dataTables_filter').length > 0) {
            jQuery('.dataTables_filter').find('input').addClass('form-control')
        }
       
    </script>
    <script type="text/javascript">
        function delete_article(product_id){
            $('.delete-btn'+product_id).trigger('click'); 
        }
    </script>
@stop

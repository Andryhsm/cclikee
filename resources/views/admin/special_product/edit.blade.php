@extends($layout)
@section('content')
    <section class="content-header">
        @include('notification')
        <h1>
            Modification produit special
        </h1>
    </section>


    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    {{ Form::model($special_product[0], array('method' => 'PATCH', 'url' => array('admin/special-product', $special_product[0]->type),'class'=>'validate_form','files' => true)) }}
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('type', 'Type', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-10">
                                {!! Form::select('type', [''=>'Sélectionnez le type','1' => 'COUP DE COEUR', '2' => 'MEILLEURES VENTES','3' => 'MIEUX NOTÉS'],(isset($special_product[0])) ? $special_product[0]->type :
                                null,['class'=>'form-control required','id'=>'input_type']) !!}
                            </div>
                        </div>
                        <div class="form-group mr-10  product-autocomplete">
                            {!! Form::label('product', 'Produits', ['class' => 'col-sm-2 control-label'])
                            !!}
                            <div class="col-sm-10">
                                <span class="search-box-container">
                                    <span class="search-box">
                                        <ul>
                                            <?php

                                            $selected_product = [];
                                            if(isset($special_product) && count($special_product) > 0){
                                            foreach ($special_product as $products){
                                            $selected_product[] = $products->product_id;
                                            ?>
                                            <li class="search-choice"
                                                id="{!! $products->product_id!!}">
                                                <span class="search-box-remove">×</span>
                                                {!! $products->productTranslation->first()->product_name !!}
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
                            <input type="hidden" name="product" value="{!! implode(',',$selected_product) !!}" id="product">
                        </div>


                    </div>
                    <div class="box-footer">
                        <a href="{!!  URL::to('/admin/special-product') !!}" class="btn btn-default">Annuler</a>
                        <button type="submit" class="btn btn-primary pull-right save-form">Modifier</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@stop
@section('footer-scripts')
    {!! Html::script('backend/js/special_product.js') !!}
@stop
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
                    <span class="text-title-active">Mes products</span>
                </div>
            </div>
        </div>
    </div>
@stop
@section('content')

{!! Form::open(array('url' =>($product) ? route('article.update',['product' => $product->product_id]) : route('article.store'),'id'=>'product','class'=>'product','method' => ($product)? 'PATCH':'POST', 'enctype' => 'multipart/form-data')) !!}

<div class="row pt-0">
    <div class="article-form col-lg-8">
        <section class="content">
            <div class="bottle">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="product_name">Nom de l'article</label>
                        <input type="text" name="product_name" class="form-control required" id="product_name"
                               value="{!! ($product) ? $product->translation->product_name : null !!}"
                               placeholder="Nom de l'article">
                        <input type="text" name="product_id" value="{!! ($product) ? $product->product_id : null !!}" class="hidden"/>
                        <a href="{!! route('get_attribute') !!}" id="get_attributes" class="hidden"></a>
                    </div>
                    
                    <div class="line_separator"></div>
                    
                    <div class="article-add-img">
                        <p class="title"><bold>images</bold></p>
                        
                        <?php 
                            $hidden_img1 = ($product) ? 'hidden':'';
                            $hidden_img2 = ($product) ? '':'hidden';
                        ?>
                        
                        <div class="add-img1 {!! $hidden_img1 !!}">
                            <img src="{!! URL::to('/') !!}/images/icon/file-img.svg"></img>
                            <label id="add-img1" for="1">Ajouter images</label>
                        </div>
                        <div class="add-img2 {!! $hidden_img2 !!}">
                            <div class="nav-img">
                                @if($product)
                                    @foreach($product->images as $image)
                                        <img src="{!! URL::to('/') !!}/upload/product/{!! $image->image_name !!}" alt='{!! $image->image_name !!}'></img>
                                    @endforeach
                                @endif
                            </div>
                            <div class="center-img">
                                @if($product)
                                    <img src="{!! URL::to('/') !!}/upload/product/{!! $product->images->first()->image_name !!}" alt='{!! $product->images->first()->image_name !!}'></img>
                                @else
                                    <img class="" src=""></img>
                                @endif
                            </div>
                            <div class="add-bouton">
                                <a id="add-img2"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <!--input image file-->    
                    <div id="add-img-input" class="hidden">
                        @if($product)
                            <input type="file" class="input-img" id="0"/>
                        @else
                            <input type="file" class="input-img" id="1" name="images[1]"/>
                        @endif
                        
                    </div>    
                        
                    <div class="line_separator"></div>
                    
                    <div class="article-details">
                        <p class="title"><bold>détails de l'article</bold></p>
                        
                        <div class="form-group">
                            <label for="brand_name">Marque</label>
                            <input type="text" name="brand_name" class="form-control required" id="brand_name" value="{!!($product) ? $product->brand_name: null !!}" placeholder="Marque">
                        </div>
                        <div class="form-group">
                            <label for="attribute_set_">Gamme</label>
                            <select {!! ($product) ? 'disabled="true"' : '' !!} name="attribute_set_id" id="attribute_set_" class="form-control required">
                                <option value="" selected="selected">Selectionner gamme</option>
                                @if (count($attribute_sets) > 0) 
                                    @foreach($attribute_sets as $attribute_set)
                                        <option value="{!! $attribute_set->attribute_set_id !!}" {!! ($product) ? (($attribute_set->attribute_set_id == $product->attribute_set_id) ? 'selected = "selected"' : '') : '' !!}>{!! $attribute_set->set_name !!}</option>
                                    @endforeach
                                @endif
                            </select>
                            
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="original_price">Tarif</label>
                                    <input type="text" name="original_price" class="form-control required" id="original_price" value="{!!($product) ? $product->original_price: null !!}" placeholder="Tarif">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="pull-right pt-30">
                                    <a onclick="solde(this);" id="solde" class="solde">Soldé<i class="fa fa-circle-o pl-10"></i></a>
                                </div>
                            </div>
                        </div>
                        
                        <?php 
                            if($product)
                                $class = ($product->discount != null) ? '':'hidden';
                            else $class = 'hidden';
                        ?>
                        
                        <div class="solde-content row {!! $class !!}">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="discount">Réduction</label>
                                    <div class="input-group">
                                        <input type="number" name="discount" class="form-control required" id="reduction" value="{!!($product) ? $product->discount: null !!}" placeholder="Réduction">
                                        <span class="input-group-addon color-white fs-25">
                                            %
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                
                                <div class="form-group">
                                    <label for="promotional_price">Tarif promotionnel</label>
                                    <input type="text" name="promotional_price" class="form-control required" id="promotional_price" value="{!!($product) ? $product->promotional_price: null !!}" placeholder="Tarif promotionnel">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            {{ Form::textarea('description', ($product) ? $product->translation->description : null , ['class' => 'form-control required', 'id' => 'description', 'placeholder' => 'Description']) }}
                        </div>
                        <div class="form-group">
                            <label for="meta_advice">Conseils d'entretien</label>
                            {{ Form::textarea('meta_advice', ($product) ? $product->translation->meta_advice : null , ['class' => 'form-control', 'id' => 'meta_advice', 'placeholder' => 'Conseils d\'entretien']) }}
                        </div>
                    </div>
                    
                    <div class="line_separator"></div>
                    
                    <div class="stock-management">
                        <p class="title"><bold>Gestion des stock</bold></p>
                        
                        @if($product) 
                            @foreach($product->stocks as $key=>$stock)
                                <div class="decline" data-count="{!! $key + 1 !!}">
                                    <input name="product_stock_id[]" value="{!! $stock->product_stock_id !!}" class="hidden product_stock_id" />
                                    <div class="product-attribute">
                                        <?php
                                            $stock_option_ids=[];
                                            foreach($stock->options as $key1=>$option){
                                                $stock_option_ids[] = $option->attribute_option_id;
                                            }
                                            /*dd($stock->options[0]->product_stock_attribute_option_id);*/
                                        ?>
                                        @if($attribute_set)
                                            @foreach($attribute_set->attributes as $key1=>$attribute)
                                                <div class="form-group">
                                                    {!! Form::label('attribute_name', $attribute->french->attribute_name, ['class' => 'control-label']) !!}
                                                    <div class="">
                                                        <input type="text" name="attribute_id[{!! $key !!}][]" class="hidden attribute_id" value="{!! $attribute->attribute_id !!}" />
                                                        
                                                        <input type="text" name="product_stock_attribute_option_id[{!! $key !!}][]" class="hidden product_stock_attribute_option_id" value="{!! $stock->options[$key1]->product_stock_attribute_option_id !!}" />
                                                        
                                                            <select class="form-control attribute_option"
                                                                    name="attributes[{!! $key !!}][]"
                                                                    data-placeholder="Select option" style="width: 100%;">
                                                            @foreach($attribute->options as $option)
                                                                <option value="{!! $option->attribute_option_id !!}" {!! (in_array($option->attribute_option_id, $stock_option_ids)) ? 'selected = "selected"': '' !!}>{!! $option->french->option_name !!}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                        
                                        
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="product_inventory">Inventaire</label>
                                        <input type="text" name="product_inventory[]" class="product_inventory form-control required" value="{!! $stock->product_count !!}" placeholder="Inventaire">
                                    </div>
                                    
                                    <?php
                                        $stock_class1 = "fa-circle-o";
                                        $stock_class2 = "fa-circle-o";
                                        $stock_class3 = "fa-circle-o";
                                        switch ($stock->product_stock_status_id) {
                                            case 1:
                                                $stock_class1 = "fa-dot-circle-o";
                                                break;
                                            case 2:
                                                $stock_class2 = "fa-dot-circle-o";
                                                break;
                                            case 3:
                                                $stock_class3 = "fa-dot-circle-o";
                                                break;
                                        }
                                    ?>
                                    
                                    <div class="stock-types ptb-20">
                                        <p><i class="fa {!! $stock_class1 !!}" data_type="1" onclick="set_stock_type(this);"></i> En stock</p>
                                        <p><i class="fa {!! $stock_class2 !!}" data_type="2" onclick="set_stock_type(this);"></i> Derniers articles</p>
                                        <p><i class="fa {!! $stock_class3 !!}" data_type="3" onclick="set_stock_type(this);"></i> En rupture</p>
                                        <input type="text" name="stock-types[]" class="hidden" value="{!! $stock->product_stock_status_id !!}"/>
                                    </div>
                                </div>
                            @endforeach    
                        @else
                            <div class="decline" data-count="1">
                                <div class="product-attribute">
                                
                                </div>
                                <div class="form-group">
                                    <label for="product_inventory">Inventaire</label>
                                    <input type="text" name="product_inventory[]" class="product_inventory form-control required" value="" placeholder="Inventaire">
                                </div>
                                <div class="stock-types ptb-20">
                                    <p><i class="fa fa-dot-circle-o" data_type="1" onclick="set_stock_type(this);"></i> En stock</p>
                                    <p><i class="fa fa-circle-o" data_type="2" onclick="set_stock_type(this);"></i> Derniers articles</p>
                                    <p><i class="fa fa-circle-o" data_type="3" onclick="set_stock_type(this);"></i> En rupture</p>
                                    <input type="text" name="stock-types[]" class="hidden" value="1"/>
                                </div>
                            </div>
                        @endif
                        
                    </div>
                    <div class="text-center">
                        <a class="btn btn-merchant-filled" id="add-decline">Ajouter déclinaison</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="col-lg-4">
        <section class="content">
            <div class="bottle">
                <div class="col-lg-12 text-center pt-20">
                    <?php 
                        if($product)
                            $class_active = ($product->is_active == 1) ? 'fa-dot-circle-o' : 'fa-circle-o';
                        else
                            $class_active = 'fa-dot-circle-o';
                    ?>
                    <a onclick="checked(this);" id="visible" class="visible">Visibilité<i class="fa {!! $class_active !!} pl-90"></i></a>
                    <input type="text" name="is_active" id="is_active" class="hidden" value="{!!($product) ? $product->is_active : 1 !!}"/>
                </div>
                <div class="col-lg-12">
                    <div class="line_separator mlr-5"></div>
                </div>
                <div class="col-lg-12 text-center pb-10">
                    <b>CATÉGORIES</b>
                </div>
                
                @foreach($categories as $category)
                    <?php 
                        if ($product) {
                            $category_id = $product->categories->first()->category_id;
                            $category_class = ($category_id == $category->category_id) ? 'fa-dot-circle-o' : 'fa-circle-o';
                        }
                        else 
                           $category_class = 'fa-circle-o'; 
                    ?>
                    <div class="col-lg-12 ptb-5 mlr-10">
                        <a onclick="checka(this);" id="{!! $category->category_id !!}" class="category_parent"><i class="fa {!! $category_class !!} pr-10"></i>{!! $category->getByLanguage(2)->category_name !!}</a>
                    </div>
                @endforeach
                <input class="hidden" type="" name="categories_id" id="category_id" value="{!! ($product) ? $product->categories->first()->category_id : '' !!}">
                <div class="col-lg-12">
                    <div class="ptb-20 mlr-10">
                        <select name="category_child_id" id="category_child" class="form-control required">
                            @if($product)
                                @foreach($category_childs as $child)
                                    <?php 
                                        $attr_selected = ($product->categories[1]->category_id == $child->category_id) ? "selected='selected'" : '';
                                    ?>
                                    <option value="{!! $child->category_id !!}" {!! $attr_selected !!}> {!! $child->getByLanguage(2)->category_name !!} </option> 
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="row">
        <div class="col-md-12"> 
            <div class="col-lg-6">
                 <a href="{!! route('article.index') !!}" class="btn btn-merchant-filled">Annuler</a>
            </div>
            <div class="col-lg-6">
                <button type="submit" class="btn btn-merchant-filled pull-right" id="add-article">Enregistrer</button>
            </div>
        </div>
    </div>
</div>

{!! Form::close() !!}

@stop
@section('additional-script')
    {!! Html::script('frontend/js/article.js') !!}
    <script type="text/javascript">
        
    </script>
@stop

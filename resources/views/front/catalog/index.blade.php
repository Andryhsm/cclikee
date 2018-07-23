@extends('front.layout.master')

@section('content')
    <div class="product-area ptb-20 product-list">
        @if(!empty($category->url->target_url))
            <div class="category-url" data-url="{!! url(LaravelLocalization::getCurrentLocale().'/'.$category->url->target_url.'?') !!}"></div>
        @endif
        <div class="container product-container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <!-- left-catagory-area-start -->
                    <div class="cat-tree single-catagory mb-30">
                        <!-- Product-Categories-start -->
                        <div><p id="latest_category_selected" data-latest-category="{!! (Session::has('selected_category')) ? Session::get('selected_category') : "" !!}"></p></div>
                        <h2 class="title-category">{!! trans('catalog.product_categories') !!}</h2>
                        <div class="catagory-menu" id="cate-toggle">
                            <?php $selected_category = Input::get('category') ?>
                            {!! getCategories($categories['tree_data'],$title_name,$selected_category) !!}
                        </div>

                        <!-- Product-Categories-end -->
                    </div>
                    
                    <div class="single-catagory mb-30">
                        <a class="facet-title" href="#"><h5 class="title-filter"><i class="fa fa-angle-down"></i> {!! trans('catalog.filter_by_price') !!}</h5></a>
                        <div class="facet-content ml-30 show-filter">
                            <input type="hidden" class="start-price"
                                   value="{!! \Illuminate\Support\Facades\Input::get('start_price',0) !!}">
                            <input type="hidden" class="end-price"
                                   value="{!! \Illuminate\Support\Facades\Input::get('end_price',0) !!}">

                            <div id="slider-range"
                                 class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                                <div class="ui-slider-range ui-widget-header ui-corner-all"
                                     style="left: 6%; width: 88%;"></div>
                                <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"
                                      style="left: 6%;"></span><span class="ui-slider-handle ui-state-default ui-corner-all"
                                                                     tabindex="0" style="left: 94%;"></span></div>
                            <input readonly type="text" name="text" id="amount">
                        </div>
                    </div>


                    <div class="single-catagory mb-30">
                        <a class="facet-title" href="#"><h5 class="title-filter"><i class="fa fa-angle-down"></i> {!! trans('catalog.discount_offer') !!}</h5></a>
                        <div class="Tags-menu ml-30 facet-content">
                            <ul class="discount-filter">
                                <?php
                                $discounts = ['10' => '10% Off', '20' => '20% Off', '30' => '30 % Off'];
                                ?>
                                @foreach($discounts as $key=>$discount)
                                    <?php $class = ($key == Input::get('discount')) ? 'selected' : '' ?>
                                    <li><a class="filter {!! $class !!}"
                                           data-type="discount" href="#" title="{!! $discount !!}" data-id="{!! $key !!}
                                                ">{!! $discount !!}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- Si la filtre par category n'existe pas, aucun filtre n'est affiché que le filtre par prix et le discounte -->

                   @if(!empty($product_brands) && count($product_brands)>0 && $category_id != null && !in_array($category_id, $categories['category_parent_id']))
                        <div class="single-catagory mb-30">
                            <a class="facet-title" href="#"><h5 class="title-filter"><i class="fa fa-angle-right"></i> {!! trans('catalog.filter_by_brand') !!}</h5></a>

                            <div class="catagory-menu ml-30 facet-content hide-filter">
                                <ul class="brands-filter">
                                    <?php 
                                        $product_brands_ = [];
                                        if(!Input::get('brand')){
                                            Session::put("product_brands", $product_brands);      
                                        }
                                        $product_brands_ = Session::get("product_brands");
                                    ?>
                                     @if(sizeof($product_brands_) > 0)   
                                        @foreach($product_brands_ as $key=>$brands)
                                            <?php $class = (in_array($key, explode(',', Input::get('brand')))) ? 'selected' : '' ?>
                                            <li><a class="filter {!! $class  !!}"
                                                   data-type="brand" href="#" data-id="{!! $key !!}"><i class='fa fa-circle-o'></i>{!!  $brands !!}</a></li>
                                        @endforeach
                                     @endif
                                </ul>
                            </div>
                        </div>
                    @endif

                 
                     
                    @if(!empty($colors) && count($colors)>0 && $category_id != null  && !in_array($category_id, $categories['category_parent_id']))
                        <div class="single-catagory mb-30">
                            <a class="facet-title" href="#"><h5 class="title-filter"><i class="fa fa-angle-right"></i> {!! trans('catalog.filter_by_color') !!}</h5></a>

                            <div class="color-menu ml-15 facet-content hide-filter">
                                <ul class="color-filter">
                                    @foreach($colors as $key=>$color_val)
                                        <?php $class = (in_array($key, explode(',', Input::get('color')))) ? 'selected' : '' ?>
                                        <li><i class="fa fa-check icon-inactive"></i><a class="filter {!! $class !!}" href="#"
                                               data-type="color" data-id="{!! $key !!}"></i>
                                                {!! Html::image($color_val['color_code'], $color_val['name'],
                                                                    array( 'class' => "size16 attr-element",
                                                                    'title' => $color_val['name'],
                                                                    )) !!}
                                            </a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    @if(!empty($sizes) && count($sizes)>0 && $category_id != null && !in_array($category_id, $categories['category_parent_id']))
                        
                        @foreach($sizes as $attr_id => $attr)
                            <div class="single-catagory mb-30">
                                <a class="facet-title" href="#"><h5 class="title-filter"><i class="fa fa-angle-right"></i> {!! $attr['name'] !!}</h5></a>
                                <div class="size ml-30 facet-content hide-filter">
                                    <ul class="size-filter">
                                        <!-- li><a class="filter all-size {!! (Input::get("attrs.$attr_id")=='all')?'selected':''  !!}" href="#"
                                               data-id="all">All {!! $attr['name'] !!}</a></li-->
                                        <?php ksort($attr['options']); ?>
                                        @foreach($attr['options'] as $key=>$size_val)
                                            <?php $class = (in_array($key, explode(',', Input::get("attrs.$attr_id")))) ? 'selected' : '' ?>
                                            <li><a class="filter {!! $class !!}" href="#" data-type="size" data-id="{!! $key !!}" data-attribute_id="{!! $attr_id !!}"><i class="fa fa-square-o"></i> {!! $size_val !!}</a></li>
                                            <!--li><input type="checkbox"  name="{!! $key !!}" data-id="{!! $key !!}" data-attribute_id="{!! $attr_id !!}" class="filter-size {!! $class !!}" value="{!! $size_val !!}" /> <label for="{!! $key !!}">{!! $size_val !!}</label></li><br -->
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    @endif
                     
                    @if(count($product_tags)>0 && $category_id != null && !in_array($category_id, $categories['category_parent_id']))
                        <div class="single-catagory">
                            <a class="facet-title hide-filter" href="#"><h5 class="title-filter"><i class="fa fa-angle-right"></i> {!! trans('catalog.product_tag') !!}</h5></a>
                            <div class="Tags-menu ml-30 facet-content hide">
                                <ul class="tags-filter">
                                    @foreach($product_tags as $key=>$tag)
                                        <?php $class = (in_array($key, explode(',', Input::get('tag')))) ? 'selected' : '' ?>
                                        <li><a class="filter {!! $class  !!}"
                                               data-type="tag" href="#" title="8 topics" data-id="{!! $key !!}
                                                    ">{!! $tag !!}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif
                    <!-- left-catagory-area-end -->
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 ">
                     <div class="row">
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-6">
                                <div class="tab-menu mb-30">
                                    <ul>
                                        <li class="active"><a href="#th" data-toggle="tab" aria-expanded="false"><i
                                                        class="fa fa-th"></i></a></li>
                                        <li class=""><a href="#list" data-toggle="tab" aria-expanded="true"><i
                                                        class="fa fa-list"></i></a></li> 
                                    </ul>

                                </div>
                            </div>
                             <div class="form-inline col-lg-offset-1 col-lg-1 col-md-2 col-sm-2 col-xs-4 row">{!! Form::select('nb', ['48' => '48', '96' => '96'], null, ['class' => 'form-control ml--20', 'id' => 'nb', 'onchange' => 'changeNumberProduct();']); !!}</div>   <!-- Filtrage d'affichage du liste par page -->

                        </div>
                    <!-- tab-area-start -->
                    @if(count($products)>0)
                   <div class="tab-content">
                            <div class="tab-pane fade active in" id="th">
                                <div class="row">
                                    @foreach($products as $key=>$product)
                                        <?php
                                        $product_translation = $product->getByLanguageId(app('language')->language_id);
                                        $product_image = !empty($product->images[0]) ? $product->getDefaultImagePath() : '';
                                        $alt = !empty($product->images[0]) ? $product->images[0]->alt : '';
                                        $class = (($key+1)%4 ==1) ? "clear" : "";                                   //On affiche 4 produit par ligne

                                        ?>

                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 {!! $class !!}">
                                           <div class="product-wrapper mb-30">
                                                <div class="product-img product-pic">
                                                    @if(!empty($product->url))
                                                        <a href="{!! url($product->url->target_url) !!}">
                                                            <img src="{!! url($product_image) !!}" alt="{!! $alt !!}"
                                                                 class="primary">
                                                            <!--img src="{{-- {!! url($product_image) !!} --}}" alt="{{-- {!! $alt !!} --}}"
                                                                 class="secondary" -->
                                                        </a>
                                                    @endif
                                                    <div class="product-icon">
                                                        <ul>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="product-content mt-10 tac">
                                                    <span>{!! ($product->brand->parent_id==null) ? $product->brand->brand_name : $product->brand->parent->brand_name !!}</span>

                                                @if(!empty($product->url))
                                                        <h4>
                                                            <a href="{!! url($product->url->target_url) !!}">{!! $product_translation->product_name !!}</a>
                                                        </h4>
                                                    @endif
                                                    @if($product->original_price != $product->best_price)
                                                        <span class="old-price fs-14">({!! getPercentage($product->original_price,$product->best_price) !!})</span>
                                                        <span class="old-price fs-14"><del>{!! format_price($product->original_price) !!}</del></span>
                                                        <span class="new-price fs-14">{!! format_price($product->best_price) !!}</span>
                                                    @else
                                                        <span class="old-price fs-14">{!! format_price($product->original_price) !!}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane " id="list">
                                @foreach($products as $product)
                                    <?php
                                    $product_translation = $product->getByLanguageId(app('language')->language_id);
                                    $product_image = !empty($product->images[0]) ? $product->getDefaultImagePath() : '';
                                    $alt = !empty($product->images[0]) ? $product->images[0]->alt : '';
                                    ?>
                                    <div class="row mb-30">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <!-- single-product-start -->
                                            <div class="product-wrapper">
                                                <div class="product-img product-pic">
                                                    <a href="#">
                                                        <img src="{!! url($product_image) !!}" alt="{!! $alt !!}"
                                                             class="primary">
                                                        <img src="{!! url($product_image) !!}" alt="{!! $alt !!}"
                                                             class="secondary">
                                                    </a>
                                                    <span class="sale">sale</span>

                                                    <div class="product-icon">
                                                        <ul>
{{--
                                                            <li><a href="#" data-toggle="tooltip" data-placement="top"
                                                                   title="" data-original-title="Wishlist"><i
                                                                            class="pe-7s-like"></i></a></li>
                                                            <li><a href="#" data-toggle="tooltip" data-placement="top"
                                                                   title="" data-original-title="Add to cart"><i
                                                                            class="pe-7s-shopbag"></i></a></li>
--}}
                                                            {{--<li><a href="#" data-toggle="modal" data-target="#mymodal" data-placement="top" title="Quick View"><i class="pe-7s-search"></i></a></li>--}}
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single-product-end -->
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                            <!-- product-content-start -->
                                            <div class="product-content">
                                                <span>{!! ($product->brand->parent_id==null) ? $product->brand->brand_name : $product->brand->parent->brand_name !!}</span>
                                                <h4><a href="#">{!! $product_translation->product_name !!}</a></h4>
                                                @if($product->original_price != $product->best_price)
                                                    <span class="old-price">({!! getPercentage($product->original_price,$product->best_price) !!})</span>
                                                    <span class="old-price"><del>{!! format_price($product->original_price) !!}</del></span>
                                                    <span class="new-price">{!! format_price($product->best_price) !!}</span>
                                                @else
                                                    <span class="old-price">{!! format_price($product->original_price) !!}</span>
                                                @endif
                                                <p>{!! $product_translation->summary !!} </p>
                                            </div>
                                            <!-- product-content-end -->
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @else
                        {!! trans('catalog.no_records_found')  !!}
                        @endif
                    <!-- tab-area-end -->
                    <!-- pagination-area-start -->
                    @if($products instanceof \Illuminate\Pagination\LengthAwarePaginator && $products->total() >$products->perPage() )
                        <div class="pagination-area mt-50">
                            <div class="page-detail">
                                <div class="page-sumary">

                                    <p>Showing {!! $products->firstItem() !!}–{!! $products->lastItem() !!}
                                        of {!! $products->total() !!} results</p>
                                </div>

                                <div class="page-number text-right">
                                    {{ $products->links() }}
                                </div>
                            </div>
                        </div>
                        @endif
                                <!-- pagination-area-end -->
                        <div class="ask-button">
                            <p>{!! trans("catalog.ask_btn_text1")!!}
                                <a href="{!! URL::to('/ask-product') !!}" class="btn btn-default register-btn">
                                    <b>{!! trans("catalog.ask_btn_label")!!} </b></a>
                                {!! trans("catalog.ask_btn_text2")!!}</p>
                        </div>
                </div>
            </div>
        </div>
    </div>
    
@stop
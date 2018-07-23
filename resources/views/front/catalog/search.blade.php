@extends('front.layout.master')
 
@section('content')
    <div class="product-area ptb-10 product-list"> <!-- ptb-20 inter-ligne entre categorie des produits et recherche -->
        <div class="category-url" data-url="{!! route('search', ['q' => '']) !!}"></div>
        <div class="category-index-header">
            <?php 
                if(Input::has('category')){
                    $categories_name_selected = [];
                    $selected_category = Input::get('category'); 
                    $category = \App\Category::with('translation')->where('category_id', $selected_category)->first();
                    $categories_name_selected[] = $category->translation[1]->category_name;
                    while($category->parent){
                        $category = $category->parent;
                        $categories_name_selected[] = $category->translation[1]->category_name;
                    }
                    echo "<div class='container'>"; 
                    for($i = sizeof($categories_name_selected) - 1; $i >= 0 ; $i--){
                            echo "<a href='#'>".$categories_name_selected[$i]."</a> ";
                            echo ($i > 0) ? "&nbsp;&nbsp;&nbsp;&nbsp;<i class='fa fa-angle-right'></i>&nbsp;&nbsp;&nbsp;&nbsp;" : "";
                    }
                    echo "</div>";
                }
            ?>
        </div>
        <div class="category-title text-center">
            <span>VÊTEMENTS</span>
        </div>
        <div class="select-tri">
            <div class="container container-filter">
                <div class="row">
                    <input class="hidden" type="text" name="nb" id="nb" value="24"/>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 dropdown">
                        <button class="btn btn-secondary dropdown-toggle dropdown-filter" type="button" id="dropdownSort"  aria-haspopup="true" aria-expanded="false">
                            <span>TRIER</span><i class="fa fa-angle-down pull-rigth"></i>
                        </button>
                        <div class="dropdown-menu mb-30 sort-filter">
                             <a class="filter" data-id="discount" href="#" data-type="sort"><div class="dropdown-item"><span>{!! trans("catalog.discount") !!}</span><i class="fa fa-circle-o pull-right"></i></div></a>
                             <a class="filter" data-id="low_price_to_high" href="#" data-type="sort"><div class="dropdown-item">{!! trans("catalog.low_price_to_high") !!}<i class="fa fa-circle-o pull-right"></i></div></a>
                             <a class="filter" data-id="high_price_to_low" href="#" data-type="sort"><div class="dropdown-item">{!! trans("catalog.high_price_to_low") !!}<i class="fa fa-circle-o pull-right"></i></div></a>
                             <a class="filter" data-id="brand_a_z" href="#" data-type="sort"><div class="dropdown-item">{!! trans("catalog.brand_a_z") !!}<i class="fa fa-circle-o pull-right"></i></div></a>
                             <a class="filter" data-id="brand_z_a" href="#" data-type="sort"><div class="dropdown-item">{!! trans("catalog.brand_z_a") !!}<i class="fa fa-circle-o pull-right"></i></div></a>
                             <a class="filter" data-id="best_rating" href="#" data-type="sort"> <div class="dropdown-item">{!! trans("catalog.best_rating") !!}<i class="fa fa-circle-o pull-right"></i></div></a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 dropdown">
                        <button class="btn btn-secondary dropdown-toggle dropdown-filter" type="button" aria-haspopup="true" aria-expanded="false">
                            <span>TYPE DE PRODUIT</span><i class="fa fa-angle-down pull-rigth"></i>
                        </button>
                        <div class="dropdown-menu mb-30 sort-filter" id="product_types">
                            
                        </div>
                    </div>
                    @if(!empty($product_brands) && count($product_brands))
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 dropdown">
                            <button class="btn btn-secondary dropdown-toggle dropdown-filter" type="button" id="dropdownBrand"  aria-haspopup="true" aria-expanded="false">
                                <span>MARQUE </span><i class="fa fa-angle-down pull-rigth"></i>
                            </button>
                            <div class="dropdown-menu mb-30 brand-filter">
                                @foreach($product_brands as $key=>$brands)
                                    <a href="#" class="filter" data-id="{!! $key !!}"><div class="dropdown-item"><span>{!! $brands !!}</span><i class="fa fa-circle-o pull-right"></i></div></a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if(!empty($colors) && count($colors) > 0)
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 dropdown">
                        <button class="btn btn-secondary dropdown-toggle dropdown-filter" type="button" id="dropdownColor"  aria-haspopup="true" aria-expanded="false">
                            <span>COULEUR </span><i class="fa fa-angle-down pull-rigth"></i>
                        </button>
                        
                       <div class="dropdown-menu mb-30 color-filter">
                            @foreach($colors as $key=>$color_val)
                                <a href="#" class="filter" data-id="{!! $key !!}"><div class="dropdown-item"><span>{!! strtoupper($color_val['name']) !!}</span><i class="fa fa-circle-o pull-right"></i></div></a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    <div class="price-range col-lg-2 col-md-2 col-sm-4 col-xs-12 dropdown"> 
                        <button class="btn btn-secondary dropdown-toggle dropdown-filter" type="button" id="dropdownPrice"  aria-haspopup="true" aria-expanded="false">
                            <span>GAMME DE PRIX </span><i class="fa fa-angle-down pull-rigth"></i>
                        </button>
                        <div class="dropdown-menu mb-30">
                            <div class="facet-content ml-30 show-filter">
                                <div class="content-text pb-20 mt-10">
                                    <span class="title-show-price">Game de prix sélectionnée</span><br>
                                    <button id="reset-price" class="btn btn-default pull-right btn-refresh-price"><i class="fa fa-refresh"></i></button>
                                    <span class="show-price"></span>
                                </div>
    
                                <input type="hidden" class="start-price"
                                       value="{!! \Illuminate\Support\Facades\Input::get('start_price',0) !!}">
                                <input type="hidden" class="end-price"
                                       value="{!! \Illuminate\Support\Facades\Input::get('end_price',0) !!}">
                                <span class="span-start-price"></span>
                                <span class="span-end-price text-right"></span>
                                <div id="slider-range"
                                     class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                                    <div class="ui-slider-range ui-widget-header ui-corner-all"
                                         style="left: 6%; width: 88%;"></div>
                                    <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"
                                          style="left: 6%;"></span><span class="ui-slider-handle ui-state-default ui-corner-all"
                                                                         tabindex="0" style="left: 94%;"></span></div>
                                <input class="hidden" readonly type="text" name="text" id="amount">
                            </div>
                            <div class="hidden"><p id="max_price" data-max-price="{!! (!empty($prices_array) && (sizeof($prices_array) > 1)) ? ceil(max($prices_array)) : '' !!}"></p></div>
                        </div>
                    </div>
                    @if(!empty($sizes) && count($sizes) > 0)
                        @foreach($sizes as $attr_id => $attr)
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 dropdown">
                                <button data-attribute_id="{!! $attr_id !!}" class="btn btn-secondary dropdown-toggle dropdown-filter" type="button" id="dropdownSize"  aria-haspopup="true" aria-expanded="false">
                                    <span > {!! strtoupper($attr['name']) !!} </span><i class="fa fa-angle-down pull-rigth"></i>
                                </button>
                                <div class="dropdown-menu mb-30 size-filter">
                                    @foreach($attr['options'] as $key=>$size_val)
                                        <?php 
                                            $tri_option = explode('/§/',$size_val);
                                            $class = (Input::get("attrs.$attr_id") == $key) ? 'selected' : '' ;
                                        ?>
                                        <a href="#" class="filter {!! $class !!}" data-type="size" value="{!! $key !!}" data-attribute_id="{!! $attr_id !!}" data-id="{!! $key !!}"><div class="dropdown-item"><span><?php echo $tri_option[1]; ?></span><i class="fa fa-circle-o pull-right"></i></div></a>
                    
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="container product-container">
            
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    @if(!empty($products))

                        <div class="product_all">
                            {!! $products->total() !!} articles trouvés
                        </div>

                        <div class="tab-content-search mt-21">
                            <div class="tab-pane fade active in" id="th">
                                <div class="row">

                                    @foreach($products as $key=>$product)
                                        <?php
                                            $product_translation = $product->french;
                                            $product_image = !empty($product->images[0]) ? $product->getDefaultImagePath() : '';
                                            $alt = !empty($product->images[0]) ? $product->images[0]->alt : '';
                                            $class = (($key+1)%4 ==1) ? "clear" : ""; //On affiche 4 produit par ligne

                                        ?>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-10 {!! $class !!}">
                                           <div class="product-wrapper-home mb-30">
                                                <div class="product-img product-pic-catalog img_btn">
                                                     <a href="{!! !empty($product->url) ? url($product->url->target_url) : '' !!}">   
                                                        <img src="{!! url($product->getDefaultImagePath()) !!}" alt="{!! $product_translation->product_name !!}"
                                                         class=""/>
                                                    </a>
                                                </div>
                                                <div class="product-content p-lr-10 mt-10">
                                                    <div class="wishlist_prd_place_home wishlist_prd_place">
                                                        <?php 
                                                         $wishlist_del = (in_array($product->product_id,all_product_id_wishlist())) ? 'coeur_pm' : '';
                                                            if ($is_user_login) {
                                                                $idU = \Auth::user()->user_id;
                                                            }else{
                                                                $idU = '';
                                                            }                                            
                                                        ?>
                                                    <a class="wishlist_prd_home wishlist_prd w{!! $product->product_id !!} {!! $wishlist_del !!}" 
                                                    data-url-find-wishlist="{!! route('wishlist-findid', ['idpu' => '']) !!}" 
                                                    data-url-remove-wishlist="{!! route('wishlist-remove', ['id' => '']) !!}"
                                                    data-url-add-wishlist="{!! route('wishlist-store', ['id' => $product->product_id]) !!}"
                                                    onclick="addwishlist('{!! $product->product_id !!}','{!! $idU !!}', this);"> &nbsp; </a>
                                                    </div>
                                                    <span>{!! $product->brand_name !!}</span>
                                                    
                                                    @if(!empty($product->url))
                                                        <h4>
                                                            <a href="{!! url($product->url->target_url) !!}">{!! $product_translation->product_name !!}</a>
                                                        </h4>
                                                    @endif
                                                    <span class="new-price fs-14">{!! format_price($product->original_price) !!}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <!-- @foreach($products as $key=>$product)
                                        <?php
                                        $product_translation = $product->french;
                                        $product_image = !empty($product->images[0]) ? $product->getDefaultCdnImagesPath() : '';
                                        $alt = !empty($product->images[0]) ? $product->images[0]->alt : '';
                                        $class = (($key+1)%4 ==1) ? "clear" : ""; //On affiche 4 produit par ligne

                                        ?>

                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 {!! $class !!}">
                                           <div class="product-wrapper mb-30">
                                                <div class="product-img product-pic img_btn" style="height: 199px !important;">
                                                    <img src="{!! url($product->getDefaultCdnImagesPath()) !!}" alt="{!! $product_translation->product_name !!}"
                                                         class=""/>
                                                </div>
                                                <div class="product-content mt-10 tac">
                                                    <span>{!! 
                                                    (isset($product->brand)) ? ($product->brand->parent_id==null) ? $product->brand->brand_name : $product->brand->parent->brand_name : "" !!}</span>
                                                    
                                                    @if(!empty($product->url))
                                                        <h4>
                                                            <a href="{!! url($product->url->target_url) !!}">{!! $product_translation->product_name !!}</a>
                                                        </h4>
                                                    @endif
                                                    <span class="new-price fs-14">{!! format_price($product->best_price) !!}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach -->
                                </div>
                            </div>

                        </div>
                        @else
                        {!! trans("catalog.no_records_found")!!}
                        @endif
                                <!-- tab-area-end -->
                        <!-- pagination-area-start -->
                        @if($products instanceof \Illuminate\Pagination\LengthAwarePaginator && $products->total() >$products->perPage() )
                            <div class="pagination-area">
                                <div class="page-detail">
                                    <!-- <div class="page-sumary">

                                        <p> Showing {!! $products->firstItem() !!}–{!! $products->lastItem() !!}
                                            of {!! $products->total() !!} results </p>
                                    </div> -->

                                    <!-- <div class="page-number text-right">
                                        {!! $products->appends(\Input::except('page'))->links() !!}
                                    </div> -->
                                </div>
                            </div>
                        @endif
                        <!-- Afindra anatin if ao ambony ref manao fonctionnalité-->
                        <div class="product_all">
                            <span> Vous avez vu <span id="lastItem">{!! $products->lastItem() !!}</span>articles sur <span id="total">{!! $products->total() !!}</span> </span>
                            <div id="progress">
                              <div id="bar"></div>
                            </div>
                            <p class="pt-30 pb-20">
                                <button type="button" class="btn btn-clickee-default" id="charge-more" onclick="changeNumberProduct();">CHARGEZ PLUS</button>
                            </p>
                        </div>
                                    
                </div>
            </div>
        </div>
    </div>
<!-- start section avantage -->
@include('front.layout.section-avantage')
<!-- end section avantage -->
@endsection
@section('additional-css')
<style type="text/css">
    .mean-menu-area .nav>li>a:hover, .mean-menu-area .nav>li>a:focus {
        color: #65bb9f !important;
        background-color: #044651 !important;
    }
    .menu-large:hover a.arrow-bottom {
		color: #65bb9f !important;
        background-color: #044651 !important;
	}
</style>
@endsection
@section('additional-script')
    <script type="text/javascript">
    progressbar();
    function progressbar(){
        var bar = document.getElementById('bar');
        var width = 100;
        var lastItem = $('#lastItem').html();
        var total = $('#total').html();
        if(total>0)  width = (lastItem * 100) / total;
        console.log(width);
        bar.style.width = width + '%';
        if(width == 100) $('#charge-more').hide();
    }
    </script>
@endsection
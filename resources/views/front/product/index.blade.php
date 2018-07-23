@extends('front.layout.master')
@section('additional-header')
    <?php
        $product_translation = $product->translation;
    ?>
        <meta property="og:title" content="Produit clickee" /> 
        <meta property="og:image" content="{!! URL::to('/').'/'.$product->getDefaultImagePath() !!}" /> 
        <meta property="og:description" content="{!! $product_translation->description !!}" /> 
        <meta property="og:url" content="{!! URL::current() !!}">

@endsection
@section('content')
    
    <div class="product-area">
        
        <div class="col-lg-12">
            @include('notification')
        </div>
        <div class="container">
            <div class="col-lg-12 category-parent-product ptb-30">
                @foreach($categories as $category)
                    <a href="{!! route('search', ['category' => $category->category_id]) !!}" >{!! $category->getByLanguage(2)->category_name !!}</a>&nbsp;&nbsp;<i class="fa fa-chevron-right" style="font-size: 11px;"></i>&nbsp;&nbsp;
                @endforeach
                <span>{!! (isset($product->brand_name)) ? $product->brand_name : "&nbsp;" !!} - {!! $product_translation->product_name !!}</span>
            </div>
        </div>
        <div class="category-link"><p id="category-parent" data-latest-category=""></p></div>
        <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> -->
        <div class="container section-image-product">
            <div class="row">
                <div class="product-big-image col-xs-12 col-sm-12 col-lg-8 col-md-12">
                    {{--<div class="icon-sale-label sale-left">Sale</div>--}}
                    {{--<div class="large-image"> <a data-toggle="modal" data-target="#mymodal" data-placement="top" title="Quick View"  href="#" > <img class="main-image" src="{!! url($product->getDefaultImagePath()) !!}" alt="products"> </a> </div>--}}
                       {{-- <div class="buttons">
                            <span class="zoom-in"><i class="fa fa-plus" aria-hidden="true"></i>
                            </span>
                            <span class="zoom-out"><i class="fa fa-minus" aria-hidden="true"></i>
                            </span>
                            <span class="reset"><i class="fa fa-refresh" aria-hidden="true"></i></span>
                        </div>--}}
                     <div class="row">
                        <div class="image-thumb hidden">
                            <div class="flexslider flexslider-thumb">
                                <ul class="previews-list slides">
                                    @foreach($product->images as $product_image)
                                        <li class="{!! (count($product->images)==2)?'fixed-width':'' !!}">
                                            <a class="thumb-image" href='{!! $product->getImagesPath($product_image) !!}'>
                                                <img class="{!! ($loop->first) ? 'active' : '' !!}" data-image="{!! url($product->getImagesPath($product_image)) !!}" src="{!! url($product->thumb($product_image)) !!}" alt = "{!! $product_image->alt !!}" title="{!! $product_image->title !!}"/>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <section id="auto-contain" class="col-lg-9 col-md-9">
                            <div class="parent" style="overflow: hidden !important;">
                                <div class="panzoom" id="image_main">
                                    <img class="main-image" src="{!! url($product->getDefaultImagePath()) !!}" alt="{!! $product_translation->product_name !!}" data-zoom-image="{!! url($product->getDefaultImagePath()) !!}" width="600" height="500">
                                </div>
                            </div>
                            <!-- <div class="buttons">
                                <span class="zoom-in"><i class="fa fa-plus" aria-hidden="true"></i>
                                </span>
                                <span class="zoom-out"><i class="fa fa-minus" aria-hidden="true"></i>
                                </span>
                                 <span class="reset"><i class="fa fa-refresh" aria-hidden="true"></i></span>
                               
                            </div> -->
                                <a class="hidden" id="full-screen" data-toggle="modal" data-target="#mymodal" data-placement="top" title="Quick View"  href="#" >Click For Full Screen</a>
                        </section>
                </div>
                    
                <div class="modal-area">
                    <!-- single-modal-start -->
                    <div class="modal fade" id="mymodal" tabindex="-1" role="dialog" aria-hidden="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img class="main-image" src="{!! $product->getDefaultImagePath() !!}" alt="products">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-sm-12 col-xs-12 containt-product-info">
                <div class="product-info">
                    {!! Form::open(['url' => route("cart-add"), 'class' => '','id' =>'product_form']) !!}
                    <div class="mb-30 mt-10 mr-r-10 vcenter content-product-attribut col-lg-12 col-md-6 col-sm-5 col-xs-8"> 
                        <h1>{!! (isset($product->brand_name)) ? $product->brand_name : "&nbsp;" !!}</h1>
                    </div>
                    <h2 class="mr-l-15">{!! $product_translation->product_name !!}</h2>
                    <div class="price">
                        @if($product->promotional_price != null)
                            <span class="new-price fs-25">{!! format_price($product->promotional_price) !!}</span>
                            <span class="old-price fs-25">&nbsp;<del>{!! format_price($product->original_price) !!}</del></span>
                            <span class="old-price percentage ml-10 fs-25">{!! $product->discount !!} OFF</span>
                        @else
                            <span class="price-exact fs-25">{!! format_price($product->original_price) !!}</span>
                        @endif
                    </div>
                </div>
                <div class="review-total ptb-10">   
                        <div class="stars_review" style="overflow: show !important;">
                            @for($i=1;$i<=$average_rating;$i++)
                                <a title="1" class="star fullStar"></a>
                            @endfor
                            @for($i=4;$i>=$average_rating;$i--)
                                <a title="1" class="star"></a>
                            @endfor
                            <span style="font-size: 15px;">&nbsp;&nbsp;{!! (count($reviews) > 0) ? "(".count($reviews). " avis)" : "" !!}</span>
                        </div>
                </div>
                <!-- start attribute -->
                <div class="row">
                    <!--<div class="col-lg-12 col-sm-8 col-md-10 col-xs-10 pb-10 pt-0 p-lr-0 vcenter mt-0 mr-l-20">
                        <?php 
                            $value_margin = 40; //valeur du margin top pour les researux sociaux
                        ?>
                        @foreach($attribute_value as $attribute)
                            <div class="color-box">
                                <label class="color-label" style="color: #42838C; ">{!! $attribute['name'] !!} : </label> 
                            </div>
                            <div class="color-box">

                                @if($attribute['type']==1)
                                    <div class="color"> 
                                        <ul class="color-attribute"> 
                                            <?php $selected_color = ''; ?>
                                            @foreach($attribute['options'] as $index=>$options)
                                                @if(in_array($options->attribute_option_id,$attribute_option_id))
                                                    <?php
                                                    $product_attribute_option = $product->getProductAttributeOption($options->attribute_option_id);
                                                    $selected_color =  ($selected_color=='' && $index==0)? $product_attribute_option->product_attribute_option_id:$selected_color;
                                                    ?>
                                                    <li class="{!! ($index==0)?'active':'' !!}">
                                                        {!! Html::image($options->swatch(), $options->getByLanguageid(app('language')->language_id)->option_name,
                                                        array( 'class' => "size16 attr-element",'id' => "brd",
                                                        'title' => $options->getByLanguageid(app('language')->language_id)->option_name,
                                                        'data-product_attribute_option_id'=>$product_attribute_option->product_attribute_option_id,
                                                        'data-attribute_id'=>$options->attribute_id
                                                        )) !!}
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                    <input type="hidden" name="attrs[]" value="{!! $selected_color !!}" id="color_attribute_id">
                                @endif
                                @if($attribute['type']==2)
                                    <?php
                                        if($value_margin > 0)
                                            $value_margin -= 10;
                                        $class = (isset($attr_options[$attribute['id']]) && count($attr_options[$attribute['id']])>1) ? "" : "attribute-select-box" ?>
                                    
                                            <select name="attrs[]" data-placeholder="Choose an option…"
                                                    class="col-md-11 col-sm-10 col-xs-11  {!! $class !!} product-input-select required" tabindex="1" style="color: #42838C!important">
                                                @if(count($attribute['options']) > 1)
                                                    <option value="default" disabled selected>Veuillez choisir</option>
                                                    @foreach($attribute['options'] as $options)
                                                        @if(in_array($options->attribute_option_id,$attribute_option_id))
                                                            <?php
                                                            $product_attribute_option = $product->getProductAttributeOption($options->attribute_option_id);
                                                            ?>
                                                            <option value="{!! $product_attribute_option->product_attribute_option_id !!}">{!! $options->getByLanguageid(app('language')->language_id)->option_name !!}</option>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    @foreach($attribute['options'] as $options)
                                                        @if(in_array($options->attribute_option_id,$attribute_option_id))
                                                            <?php
                                                            $product_attribute_option = $product->getProductAttributeOption($options->attribute_option_id);
                                                            ?>
                                                            <option value="{!! $product_attribute_option->product_attribute_option_id !!}" selected>{!! $options->getByLanguageid(app('language')->language_id)->option_name !!}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                        
                                @endif
                            </div>
                        @endforeach
                             
                    </div>-->
                    <!-- end attribute -->
                    
                    
                    <!--test-->
                     @if($attribute_set)
                        @foreach($attribute_set->attributes as $key=>$attribute)
                            <div class="form-group">
                                {!! Form::label('attribute_name', $attribute->french->attribute_name, ['class' => 'control-label']) !!}
                                <select name="attrs[]" data-placeholder="Choose an option…" data-attribute="{!! $attribute->attribute_id !!}" data-route="{!! route('get_options') !!}" class="col-md-11 col-sm-10 col-xs-11 
                                    product-input-select required" tabindex="1" style="color: #42838C!important" onchange="changeAttribute(this, {!! $product->product_id !!})" autocomplete="off">
                                    <option value="default" disabled selected>Veuillez choisir</option>
                                    @foreach($attribute->options as $option)
                                        @if(in_array($option->attribute_option_id,$attribute_option_ids))
                                            <option value="{!! $option->attribute_option_id !!}" >{!! $option->french->option_name !!}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        @endforeach
                    @endif
                    <!--end test-->
                    

                    </div>
                    <div class="clear"></div>
                        <div class="col-md-7 ">
                            <input type="hidden" name="qty" value="1" readonly>
                            <input type="hidden" name="product_id" value="{!! $product->product_id !!}" readonly>
                            <input type="hidden" name="radius" id="radius" value="Input" readonly>
                            <input type="hidden" name="postal_code" id="postal_code" value="" readonly>
                        </div>
                    <!-- <div class="quantity row">
                         <label for="quantity" class="ml-15 col-lg-3">{!! trans('product.quantity'); !!}</label>
                         <input type="text" class="form-control-product-input col-lg-2" id="qty" name="qty" value="1">
                    </div> -->
                    <!-- start other information -->
                    <div class="other-information row">
                        <div class="col-lg-12 col-md-10 col-sm-9 col-xs-10">

                            <!-- a href="javascript://" class="btn btn-block btn-primary btn-lg" id="buy_locally">{!! trans('product.buy_it_locally_txt')." (".getPrice($product->best_price).")" !!}</a -->

                            <div class="buying-area hide" id="buying_area">
                                {!! Form::hidden('product_id',$product->product_id, ['class' => 'form-control ','id'=>'product-id','placeholder'=>""]) !!}
                                <?php $radius_data = getRadiusData() ?>
                                <label>{!! trans('product.choose_buying_area') !!}</label>
                                <div class="input-group text-center availibily-section">
                                          <select name="requested_distance" class="form-control" id="distance">
                                              @foreach($radius_data as $index=>$radius)
                                                  <option value="{!! $index !!}">{!! $radius !!}</option>
                                              @endforeach
                                          </select>
                                    <span class="input-group-addon">{!! trans('product.around') !!}</span>
                                    <input type="text" name="zip_code" class="required form-control-product" id="zip_code" value="" placeholder="{!! trans('product.postal_code') !!}">
                                </div>
                                <a href="#" class="btn btn-sm btn-default" id="check-product">{!! trans('product.check_retailer_availability') !!}</a>
                            </div>

                            <!-- div class="buying-lable" id="buying_label">
                                <span>{!! trans('product.buy_it_below') !!}</span><br>
                                <span>{!! trans('product.on_internet') !!}</span>
                            </div -->

                            <div class="row add-cart mb-20" id="add-cart">
                                <!-- <p> {!! trans('product.product_available_with_d_area') !!}</p> -->
                                <button type="button" class="btn btn-clickee-info col-lg-8 col-md-8 col-sm-8 col-xs-8" id="add-to-cart">{!! trans("product.add_to_cart")!!}</button>

                                <?php 
                                        $wishlist_del = (in_array($product->product_id,all_product_id_wishlist())) ? 'coeur_gm' : '';
                                        if ($is_user_login) {   
                                            $idU = \Auth::user()->user_id;
                                        }else{
                                            $idU = '';
                                        }                                            
                                    ?>    

                                <a id="add-to-wishlist" class="wishlist_prd_index col-lg-3 col-md-3 col-sm-3 col-xs-3 wG{!! $product->product_id !!} {!! $wishlist_del !!}"
                                    data-url-find-wishlist="{!! route('wishlist-findid', ['idpu' => '']) !!}" 
                                    data-url-remove-wishlist="{!! route('wishlist-remove', ['id' => '']) !!}"
                                    data-url-add-wishlist="{!! route('wishlist-store', ['id' => $product->product_id]) !!}"
                                onclick="addwishlist('{!! $product->product_id !!}','{!! $idU !!}', this);"></a>
                            </div>
                            <div class="share-social-network" style="margin-top: {!! $value_margin-10 !!}%;">
                                <a class="share share-to-facebook"  href="https://www.facebook.com/sharer/sharer.php?u={!! urlencode(URL::current()) !!}"></a>
                                <a href="https://twitter.com/intent/tweet?text={!! URL::current() !!}" class="share share-to-twitter" data-count="vertical" data-via="Clickee"></a> <!--twitter-share-button-->
                                <a class="share share-to-google" href="https://plus.google.com/share?url={!! URL::current() !!}" onclick="window.open(this.href, 'Google+', 'width=490,height=530'); return false;"></a>
                            </div>

                            <div class="product-not-avail hide" id="product-not-avail">
                                <p> {!! trans('product.product_not_available_with_selected_area') !!}</p>
                                <p>{!! trans('product.buy_with_ecommerce') !!}</p>
                            </div>
                            
                            <!-- <a href="javascript://" class="btn btn-block btn-primary btn-lg" id="see_best_price">{!! trans('product.see_best_prices') !!}</a> -->
                        </div>
                    </div>
                    <!-- end other information -->

                    @if(count($affiliate_products)>0)
                     <?php
                        $total_products = round(count($affiliate_products)/2);
                        ?>
                    <div class="col-sm-12 affiliate-container mr-t-10 mr-b-10 hide">
                        <div class="col-sm-6 affiliate-section">
                        @foreach($affiliate_products as $index=>$affiliate_product)
                            @if($index<$total_products)
                                <div class="col-sm-4 product-row">
                                    <?php
                                    $img_src = null;
                                    $epartner_repo = App::make(\App\Repositories\EpartnerRepository::class);
                                    $epartner = $epartner_repo->getByName($affiliate_product->advertiser_name);
                                    if(!empty($epartner)){
                                        $img_src = \App\Models\EpartnerMedia::IMAGE_PATH.'/'.$epartner->image;
                                    }
                                    ?>
                                    <div class="col-xs-4 no-padding">
                                    @if($img_src!=null)
                                        <div class="product-image">
                                        <img class="" src="{!! url($img_src) !!}">
                                        </div>
                                    @endif
                                    </div>
                                    <div class="col-xs-4 no-padding text-center product-price">
                                        <span class="">
                                            {!!  format_price($affiliate_product->price) !!}
                                        </span>
                                    </div>
                                        <div class="col-xs-4 no-padding">
                                    <span class="affiliate-product-link pull-right">
                                        <a target="_blank" class="btn btn-default default-btn" href="{!! $affiliate_product->product_url !!}">{!! trans('product.see_it') !!}</a>
                                    </span>
                                        </div>
                                </div>
                            @endif
                        @endforeach
                        </div>

                        <div class="col-sm-6 affiliate-section">
                            @foreach($affiliate_products as $index=>$affiliate_product)
                                @if($index>=$total_products)
                                    <div class="col-sm-4 product-row">
                                        <?php
                                        $img_src = null;
                                        $epartner_repo = App::make(\App\Repositories\EpartnerRepository::class);
                                        $epartner = $epartner_repo->getByName($affiliate_product->advertiser_name);
                                        if(!empty($epartner)){
                                            $img_src = \App\Models\EpartnerMedia::IMAGE_PATH.'/'.$epartner->image;
                                        }
                                        ?>
                                        <div class="col-xs-4 no-padding">
                                            @if($img_src!=null)
                                                <div class="product-image">
                                                <img class="" src="{!! url($img_src) !!}">
                                                    </div>
                                            @endif
                                        </div>
                                        <div class="col-xs-4 no-padding text-center product-price">
                                        <span class="">
                                            {!!  format_price($affiliate_product->price) !!}
                                        </span>
                                        </div>
                                        <div class="col-xs-4 no-padding">
                                    <span class="affiliate-product-link pull-right">
                                        <a target="_blank" class="btn btn-default default-btn" href="{!! $affiliate_product->product_url !!}">{!! trans('product.see_it') !!}</a>
                                    </span>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        <div class="col-sm-4 price-alert">
                            <div class="col-xs-4 no-padding">
                                <span><i class="fa fa-bell-o" style="color: #59b210; margin-right: 10px" aria-hidden="true"></i><a href="#"> {!! trans('product.lowest_price_alert') !!}</a></span>
                            </div>
                        </div>
                        </div>
                    </div>
                    @endif

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <!-- </div> -->

        <div class="product-overview-tab">
            <div class="container" >
                <div class="row" >
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="tab-container">
                       <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="tab-container">
                        <div class="tab-panel tab-panel-customer" style="width:100%;">
                            
                             <ul class="nav nav-tabs" style="font-size: 17px !important;" role="tablist">
    	                        <li role="presentation" class="active"><a href="#description" class="notflip" aria-controls="uploadTab" role="tab" data-toggle="tab" id="head-tab-signing">Description</a>
    	                        </li>
    	                        <li role="presentation"><a class="flip" href="#reviews" aria-controls="browseTab" role="tab" data-toggle="tab" id="head-tab-register">Avis clients</a>
    
    	                        </li>
    	                        <button type="button" class="close" href="javascript:history.back()" aria-label="Close">
    	                    </ul>
                            <div id="productTabContent" class="tab-content height-content">
                                <div class="tab-pane fade in active product_description" id="description">
                                    <div class="std more">
                                        {!! $product_translation->description !!}
                                    </div>
                                    <div class="product-tabs-content-inner clearfix">
                                        @foreach($attribute_value as $attribute)
                                            <?php
                                            $attribute_option['option_name'] = [];
                                            ?>
                                            @foreach($attribute['options'] as $options)
                                                @if(in_array($options->attribute_option_id,$attribute_option_id))
                                                    <?php
                                                    $attribute_option['attribute_name'] = $attribute['name'];
                                                    $attribute_option['option_name'][] = $options->getByLanguageid(app('language')->language_id)->option_name;
                                                    ?>
                                                @endif
                                            @endforeach

                                            @if(!empty($attribute_option) && count($attribute_option)>0)

                                                <p>
                                                    <span><b>{!! $attribute_option['attribute_name'] !!}</b>
                                                                    :</span> {!! implode(',',$attribute_option['option_name']) !!}
                                                </p>
                                            @endif

                                        @endforeach
                                    </div>
                                </div>

                                <div id="reviews" class="tab-pane fade">
                                    <div class="std">
                                        <div class="reviews-area">

                                            
                                            @if(\Illuminate\Support\Facades\Auth::check())

                                                <div class="review-btn mb-20 mr-t-40 hidden">
                                                    <a class="review-make">{!! trans("product.submit_opinion")!!}</a>
                                                </div>

                                                <div class="content-review-form">
                                                    <div id="review-success" class=""></div>
                                                    <div id="review-error" class=""></div>
                                                    {!! Form::open(array('url' => 'submit-review','id' =>'review_form','class'=>'')) !!}

                                                    <div class="row rating-area">
                                                        <label class="col-lg-3">Your Rating</label>
                                                        <div class="rating-container col-lg-9 mb-10">
                                                            <input type="radio" name="example" class="rating" value="1" />
                                                            <input type="radio" name="example" class="rating" value="2" />
                                                            <input type="radio" name="example" class="rating" value="3" />
                                                            <input type="radio" name="example" class="rating" value="4" />
                                                            <input type="radio" name="example" class="rating" value="5" />
                                                        </div>
                                                    </div>
                                                    {!! Form::hidden('rating_product_id',$product->product_id, ['class' => 'form-control ','id'=>'url_key','placeholder'=>""]) !!}
                                                    <div class="comment-form form-group">
                                                        <label class="col-lg-3">{!!
                                                            trans("product.review_comment")!!}</label>
                                                        <div class="col-lg-9 mb-10">
                                                            <textarea name="comment" class="required" id="comment" rows="4"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="comment-form-author mb-10">
                                                        <label class="col-lg-3">{!! trans("product.name")!!}</label>
                                                        <div class="col-lg-9 mb-10">
                                                            <input type="text" readonly name="user_name"
                                                               value="{!! \Illuminate\Support\Facades\Auth::user()->first_name." ".\Illuminate\Support\Facades\Auth::user()->last_name !!}">
                                                        </div>       
                                                    </div>
                                                    <div class="comment-form-email mb-30">
                                                        <label class="col-lg-3">{!! trans("product.email")!!}</label>
                                                        <div class="col-lg-9 mb-10">
                                                            <input type="text" readonly name="email_address"
                                                               value="{!! \Illuminate\Support\Facades\Auth::user()->email !!}">
                                                        </div>       
                                                    </div>
                                                    <div class="row mr-t-10">
                                                        <label class="col-lg-3"></label>
                                                        <div class="ptb-20 col-lg-9">
                                                            <button type="submit" class="submit-review btn-clickee-info">submit
                                                            </button>          
                                                        </div>
                                                    </div>
                                                    
                                                    {!! Form::close() !!}
                                                </div>


                                            @else     
                                                <?php 
                                                    $class_height_review = ($reviews->total()>0) ? '' : 'mr-sans-contenu'; 
                                                ?>
                                                <div class="review-login {!! $class_height_review !!}">
                                                {!! trans("product.review_login_message")!!} <a
                                                        href="{!! URL::to('login') !!}">{!!
                                                    trans("product.review_click_here")!!}</a>
                                                </div>
                                            @endif

                                            @if($reviews->total()>0)
                                            <div class="review-list ptb-20">
                                                <table class="table">
                                                    <thead class="header-table">
                                                        <tr>
                                                            <th scope="col" width="25%">
                                                                {!! $reviews->firstItem() !!}–{!! $reviews->lastItem() !!}
                                                                {!! trans("product.opinion_of")!!} {!! $reviews->total() !!}
                                                            </th>
                                                            <th scope="col" width="50%">{!! trans("product.opinion")!!}</th>
                                                            <th scope="col" width="25%" class="center">Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-reviews">
                                                    @foreach($reviews as $review)
                                                    
                                                        <tr>
                                                          
                                                            <td class="uppercase">
                                                                <div class="table-padding pt-20">
                                                                    {!! $review->nickname !!}
                                                                </div>
                                                            </td>     
                                                          <td>
                                                            <div class="table-padding">
                                                                <div class="stars col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                    @for($i=1;$i<=$review->rating;$i++)
                                                                        <a title="1" class="star fullStar"></a>
                                                                    @endfor
                                                                </div>
                                                                <p>
                                                                    {!! $review->review !!}
                                                                </p>
                                                                
                                                            </div>    
                                                          </td>
                                                          <td class="center">
                                                            <div class="table-padding pt-20">
                                                                {!! Jenssegers\Date\Date::parse($review->review_date)->format('j F Y')!!}
                                                            </div>
                                                          </td>
                                                        </tr>                                        

                                                @endforeach
                                                </tbody>
                                                </table>
                                                <div class="pagination-area">
                                                    {{ $reviews->links() }}
                                                </div>
                                               &nbsp;
                                            </div>
                                            @endif

                                        </div>

                                    </div>
                                </div>                                        
                            </div>
                            <div class="tabs-limit"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
        <div class="tabs-more-details tabs-details">
            <input type="button" id="btn_details" class="btn-clickee-info" value="{!! trans('product.more_details') !!}">
        </div>

        <!-- related products -->
        <div class="related-product-container mb-60 mt-20">
            <div class="container" style="padding-left: 0px !important; padding-right: 0px !important;">
            @if(!empty($related_products))
            <div class="related-products-area ptb-30">
                <div class="col-lg-12">
                    <div class="section-title-others">
                        <h2>{!! trans("product.related_products")!!}</h2>
                    </div>
                </div>
                <div class="related-products-active">
                    @foreach($related_products as $related_product)
                     <?php $related_product_translation = $related_product->translation; ?>

                        <div class="col-lg-12">
                        <!-- single-product-start -->
                        <div class="product-wrapper">
                            <div class="product-img-connexe product-pic">
                                <a href="{!! $related_product->url->target_url !!}">
                                    <img src="{!! url($related_product->getDefaultImagePath()) !!}" alt="{!! (isset($related_product_translation->product_name)) ? $related_product_translation->product_name : '' !!}"
                                         class=""/>
                                </a>
                            </div>
                            <div class="product-content pt-10">                                
                                <!-- whishlist add/remove -->
                                <div class="wishlist_prd_place_home" style="height: 13%;width: 24%;">

                                    <?php 
                                     $wishlist_del = (in_array($related_product->product_id,all_product_id_wishlist())) ? 'coeur_pm' : '';
                                        if ($is_user_login) {
                                            $idU = \Auth::user()->user_id;
                                        }else{
                                            $idU = '';
                                        }                                            
                                    ?>

                                    <a class="wishlist_prd_home w{!! $related_product->product_id !!} {!! $wishlist_del !!}"
                                    data-url-find-wishlist="{!! route('wishlist-findid', ['idpu' => '']) !!}" 
                                    data-url-remove-wishlist="{!! route('wishlist-remove', ['id' => '']) !!}"
                                    data-url-add-wishlist="{!! route('wishlist-store', ['id' => $related_product->product_id]) !!}"
                                    onclick="addwishlist('{!! $related_product->product_id !!}','{!! $idU !!}', this);"> &nbsp; </a>
                                    
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <span>{!! 
                                    (isset($related_product->brand)) ? ($related_product->brand->parent_id==null) ? $related_product->brand->brand_name : $related_product->brand->parent->brand_name : "&nbsp;" !!}
                                    </span>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <a href="{!! $related_product->url->target_url !!}">{!! (isset($related_product_translation->product_name)) ? $related_product_translation->product_name : '' !!}</a>
                                </div>
                                
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <span class="new-price">{!! format_price($related_product->original_price) !!}</span>      
                                </div>
                            </div>
                        </div>
                        <!-- single-product-end -->
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
            </div>
        </div>
        <div class="section-avantage"> 
            @include('front.layout.section-avantage') 
        </div>
    </div>

@stop

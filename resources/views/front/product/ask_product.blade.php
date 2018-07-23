@extends('front.layout.master')

@section('content')
    <div class="product-area ptb-50">
        <div class="container">
            <div class="row">
                @include('notification')
                <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12 product-search-container">
                       <h3>{!! trans('ask_product.product_search_text') !!}</h3>
                        {!! Form::open(['url' => url(LaravelLocalization::getCurrentLocale().'/ask-product/search'), 'id'=>'product_search_form', 'method' => 'get', 'role'
                        => 'form' ,'class'=>' form-inline','autocomplete'=>'off']) !!}
                        <div class="form-group">
                            {{ Form::text('keyword', $keyword,['class'=>"required form-control",'placeholder'=>trans("ask_product.product_search_place_holder")]) }}
                        </div>
                        <button type="submit" class="btn btn-default default-btn" id="login-btn">{!! trans("common/label.product_search")!!}</button>
                        {{Form::close()}}
                </div>
                @if(!empty($is_display))
                    <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12 table-responsive ptb-50 product-list-container ">
                        {!! Form::open(array('url' =>'ask-product' ,'method'=>'POST','id' =>'product_sorting_form','class'=>'product-sort-form')) !!}
                        <table class="table product-listing-container" id="sort-order">
                            <tr>
                                <input type="hidden" name="search_product" value="{!! $keyword !!}">
                                <td colspan="2"><strong>please select the relevant offers to your request</strong></td>
                                <td colspan="1" class="text-center vertical-align"><span>{!! trans('ask_product.product_sorting_text') !!}:</span></td>
                                <td colspan="2">{!! Form::select('sort_by', ['asc' => trans('ask_product.sort_low_to_high'), 'desc' => trans('ask_product.sort_high_to_low')],$sort_by,['class'=>'form-control required','id'=>'sorting']) !!}</td>
                            </tr>
                            <input type="hidden" name="search-keyword" class="search-keyword" value="{!! $keyword !!}">
                            <tbody class="product-listing">
                            @foreach($products as $key=>$product)
                                    <tr class="product-select" id="sectionsid_{!! $key !!}">
                                        <input type="hidden" name="sectionsid[]" value="{!! $key !!}">
                                        <td width="5%">
                                            <div class="remove-product" data-type="commission-api"
                                                 data-key="{!! $key !!}"
                                                 name="remove_product" value="{!! $key !!}"><i class="fa fa-times" aria-hidden="true"></i></div>
                                            <div class="sort-order"><i class="fa fa-arrows"></i></div>
                                        </td>
                                        <td width="15%" class="v-align-middle">
                                            <img class="product-image" src="{!! $product['image_url'] !!}">
                                        </td>
                                        <td width="50%">
                                            {!! Html::link( $product['DetailPageURL'],$product['name'],['class'=>'product-name','target'=>'_blank']) !!}
                                            <br/>
                                            <span>{!! \Illuminate\Support\Str::words(strip_tags($product['description']),25) !!}</span>
                                        </td>
                                        <td width="15%" class="text-center">
                                            <?php
                                            $img_src = null;
                                            $epartner_repo = App::make(\App\Repositories\EpartnerRepository::class);
                                            $epartner = $epartner_repo->getByName($product['advertiser_name']);
                                            if(!empty($epartner)){
                                                $img_src = \App\Models\EpartnerMedia::IMAGE_PATH.'/'.$epartner->image;
                                            }
                                            ?>
                                            @if($img_src!=null)
                                                <img src="{!! $img_src !!}">
                                            @else
                                                {!!  $product['advertiser_name']!!}
                                            @endif
                                        </td>

                                        <td width="15%" class="text-center price" data-price="{!! $product['sort_price'] !!}">
                                            {!! $product['price'] !!}<br/>
                                            {!! Html::link( $product['DetailPageURL'],trans('ask_product.buy'),['class'=>'btn btn-default default-btn','target'=>'_blank']) !!}
                                        </td>
                                    </tr>
                                @endforeach
								</tbody>
                            {!! Form::close() !!}
                        </table>
                    </div>
                    <div class="clear"></div>
                    <div class="row">

                    </div>
                    <div class="row">
                        <div class="alert ask-order-page-success alert-success hide" role="alert">
                            <strong>Well done!</strong> <span>You successfully read this important alert message.</span>
                        </div>
                        <div class="alert ask-order-page-warning alert-warning hide" role="alert">
                            <strong>Warning!</strong> <span>Better check yourself, you're not looking too good.</span>
                        </div>
                    </div>
                    <div class="row">
                     <div class="col-md-12">
                         <h4  class="text-center font-weight-bold">
                             <strong>
                                 {!! trans('ask_product.main_text')  !!}
                             </strong>
                         </h4>
                     </div>
                        <div class="col-md-12 well well-sm text-center font-weight-bold">
                            <div>
                                <strong>
                                    {!! trans('ask_product.search_text_1') !!}
                                    {!! form::select('radius',getRadiusData(),(!empty($ask_product['radius'])?$ask_product['radius']:null),['class'=>'required ask-page-radius']) !!}
                                    {!! trans('ask_product.search_text_2') !!}
                                    <input type="text" name="zip_code" class="ask-page-zip-code" value="{!! (!empty($ask_product['zip_code'])?$ask_product['zip_code']:null) !!}">
                                </strong>
                            </div>
                        </div>
                    <div class="login-area">
                        {!! Form::open(['url' => 'product-available', 'id'=>'ask_product_form', 'method' => 'post', 'class'=>'form-horizontal','autocomplete'=>'off']) !!}
                        <input type="hidden" name="keyword" value="{!! $keyword !!}">
                        <div class="col-md-4">
                            <label for="name">{!! trans("ask_product.brands")!!} <span>*</span></label>
                            <select class="required brand-multi-select" name="product_brands[]" size="12">
                                @foreach($brands as $brand)
                                    <option value="{!! $brand->brand_id !!}" {!! ((!empty($ask_product['product_brands']) && in_array($brand->brand_id,$ask_product['product_brands']))?"selected":"")  !!}>{!! ($brand->parent_id==null) ? $brand->brand_name : $brand->parent->brand_name." ".$brand->brand_name !!} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="name">{!! trans("ask_product.product_name")!!} <span>*</span></label>
                            {{ Form::text('product_name', (!empty($ask_product['product_name'])?$ask_product['product_name']:null),['class'=>"required",'id'=>'product_name']) }}
                            <label for="name">{!! trans("ask_product.color")!!} </label>
                            {{ Form::text('product_color', (!empty($ask_product['product_color'])?$ask_product['product_color']:null),['class'=>"",'id'=>'product_name']) }}
                            <label for="name">{!! trans("ask_product.size")!!}</label>
                            {{ Form::text('product_size', (!empty($ask_product['product_size'])?$ask_product['product_size']:null),['class'=>"",'id'=>'product_name']) }}
                        </div>
                        <div class="col-md-4">
                            <label for="password">{!! trans("ask_product.product_price")!!} <span>*</span></label>
                            {{ Form::text('reduce_price',(!empty($ask_product['reduce_price'])?$ask_product['reduce_price']:null),['class'=>"required",'id'=>'product_price']) }}
                            <label for="name">{!! trans("ask_product.product_link")!!} <span>*</span></label>
                            {{ Form::text('product_url', (!empty($ask_product['product_url'])?$ask_product['product_url']:null),['class'=>"required",'id'=>'product_url']) }}
                            <button type="submit"
                                id="ask-local-product" class="ask-page-submit-button">{!! trans("ask_product.validate_button")!!}</button>
                        </div>
                        {{Form::close()}}
                    </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@stop
@section('footer-script')
    <script>
        $(function(){
            $.fn.productSearch();
        })
    </script>
@stop
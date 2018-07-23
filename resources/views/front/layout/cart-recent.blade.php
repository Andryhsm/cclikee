@if($cart_count > 0)
    <div class="dropdown-menu cart-total text-right" id="content-cart" style="width: 365px;border: 1px solid #7fa6aa; display: none;">
    <ul class="cart-menu">
        <?php
            $nombre = ($cart_count < 10) ? '0'.$cart_count : $cart_count;
        ?> 
        <li>        
            <div class="shopping-cart">
                <div class="content-cart"> 
                    @foreach($recent_items as $item_id=>$item)
                    <fieldset class="cart-list row">
                        <legend></legend>
                        <div class="cart-img col-lg-3">
                            <a href="#" title="{!! $item->getName() !!}"><img
                                        src="{!! URL::to('/').'/'.\App\Product::PRODUCT_IMAGE_PATH.$item->getImage() !!}"
                                        alt="{!! $item->getImageAlt() !!}"/></a>
                        </div>
                        <div class="cart-info col-lg-8">
                            <div>
                                <h4 class="text-uppercase">{!! (isset($item->getProduct()->brand)) ? ($item->getProduct()->brand->parent_id==null) ? $item->getProduct()->brand->brand_name : $item->getProduct()->brand->parent->brand_name : "" !!}</h4>
                                <h4 class="mb-10"><a href="#">{!! $item->getName() !!}</a></h4>
                                <div class="cart-price">
                                    <div class="content-new-price">
                                        <span class="new-price">{!! format_price($item->getOriginalPrice()) !!}</span>         
                                    </div>
                                    <div class="col-lg-1 col-xs-1 text-center">|</div>
                                    <div class="col-lg-7 content-star">
                                        <?php 
                                            $product = $item->getProduct();
                                        //    $average_full = average_rating_product($product->product_id); 
                                         //   $average_empty = 5-average_rating_product($product->product_id);
                                        ?>
                                         @for($i=1;$i <= average_rating($product->product_id);$i++)
                                                <a title="1" class="star fullStar"></a>
                                         @endfor
                                         @for($i=5 ;$i > average_rating($product->product_id);$i--)
                                                <a title="1" class="star"></a>
                                         @endfor   
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pro-del col-lg-1">
                            <a href="{!! route('cart-remove', ['item_id' => $item_id]) !!}"><i  class="fa fa-times"></i></a>
                        </div>
                    </fieldset>
                    @endforeach
                </div>
                <div class="footer-cart">
                    <div class="mini-cart-total mt--10">
                        <span>{!! trans('cart.total') !!}</span>
                        <span class="total-price" style="float: right;">{!! format_price($cart_total) !!} ({!! $nombre !!})</span>
                    </div>
                    <div class="cart-button text-center text-uppercase mb-10">
                        <a class="btn btn-clickee-default" href="{!! route('cart') !!}" title="Cart">VOIR PANIER</a>
                    </div>
                </div>                
            </div>
        </li> 
    </ul>
</div>

@else
<div class="dropdown-menu cart-none" data-hover="dropdown" data-animations="fadeInDown fadeInRight fadeInUp fadeInLeft">
    <div class="shopping-cart text-center">
        <h4 class="ct mt-20 mb--10">VOTRE PANIER EST VIDE!</h4>
        <span class="al">Continuez à shopper</span>                    
    </div>
</div>

@endif
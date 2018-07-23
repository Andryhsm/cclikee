@extends('front.layout.master')

@section('content')
    <div class="">
        <div class="container-fluid page-confirm-cart-content mt-50 mb-50">

            <div class="row">
                <div class="col-lg-12">
                    @include('notification')
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 pt-40">
                    {!! Form::open(['url' => route('checkout'),'id' =>'cart_form', 'method' => 'POST']) !!}
                        <div class="row">
                             <div class="cart-order col-lg-7 col-md-7 col-sm-7 col-xs-12 mb-20">
                                <div class="cart-information row">
                                    <div class="cart-title">
                                        <h2>PAIEMENT</h2>
                                    </div>
                                   <div class="cart-product promotional-code-content row">
                                      <div class="cart-title col-lg-11">
                                          <h2>CODE PROMOTIONNEL</h2>
                                      </div>
                                       <div class="col-lg-1 product-remove pull-right">
                                              <button type="button" onclick="location.href = '".{!! url(LaravelLocalization::getCurrentLocale()) !!}."'" class="close">×</button>
                                        </div>
                                      <div class="info-facture mt-40">
                                          <div class="col-sm-7">     
                                                {{Form::text('cart_number', '',['class'=>'required cart-paye', "placeholder" => "" ])}}
                                           </div>
                                      </div>
                                     
                                  </div>  
                                  <div class="cart-product row">
                                      <div class="cart-title">
                                          <h2>ADRESSE DE FACTURATION</h2>
                                      </div>
                                      <?php $current_user = auth()->user();
                                            $address_current_user = address($current_user);
                                            ?>
                                      <div class="info-facture mt-40">
                                          <p>{!! ucfirst($current_user->first_name)." ".strtoupper($current_user->last_name) !!}</p>
                                          <p>{!! $address_current_user->zip !!}</p>
                                          <p>{!! $address_current_user->city !!}</p>
                                          <p>{!! $current_user->phone_number !!}</p>
                                      </div>
                                  </div>    
                                    <div class="cart-product row">
                                        <div class="content-cart">
                                            <div class="cart-title">
                                                <h2>PAIEMENT SÉCURISÉ  <img class="image-secure" src="{!! URL::to('/').'/images/icon/cadenat.svg' !!}"/></h2>
                                            </div>
                                            <p class="secure-text pb-20">FAITES VOS ACHATS EN TOUTE CONFIANCE AVEC NOTRE PAIEMENT SÉCURISÉ</p>
                                            
                                            <div class="form-group row mb-0">
                                                <label class="col-lg-5 fw-400" for="cart_number">Numéro de carte *</label>
                                                <div class="col-sm-7">     
                                                    {{Form::text('cart_number', '',['class'=>'required cart-paye', "placeholder" => "" ])}}
                                                </div>
                                            </div>
                                            <div class="form-group row mb-0">
                                                <label class="col-lg-5 fw-400" for="date_expirate">Date d’expiration *</label>
                                                <div class="col-sm-7">     
                                                    {{Form::text('date_expirate', '',['class'=>'required cart-paye', "placeholder" => "" ])}}
                                                </div>
                                            </div>
                                            <div class="form-group row mb-0">
                                                <label class="col-lg-5 fw-400" for="verif_code">Code de vérification *</label>
                                                <div class="col-sm-7">     
                                                    {{Form::text('verif_code', '',['class'=>'required cart-paye', "placeholder" => "" ])}}
                                                </div>
                                            </div>
                                            <div class="form-group row mb-0">
                                                <label class="col-lg-5 fw-400" for="cart_number">Numéro de carte *</label>
                                                <div class="col-sm-7">     
                                                    {{Form::text('cart_number', '',['class'=>'required cart-paye', "placeholder" => "" ])}}
                                                </div>
                                            </div>
                                            
                                            <a href="#" class="save-cart fw-400"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;Sauvegarder cette carte pour la prochaine fois.</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 text-center mb-20">
                                        <ul>
                                            
                                            <li class="text-center">    
                                                <button type="submit" class="btn btn-submit btn-clickee-info-plein pd-10" type="button" id="btn-etape3">CONFIRMER & PAYER</button>
                                            </li>
                                        </ul>
                                        </div>
                                    
                                </div>
                            </div>
                            <div class="cart-product-list col-lg-5 col-md-5 col-sm-5 col-xs-12 ">
                                <div class="content-cart-product">
                                    <div class="cart-title">
                                        <h2>{!! (count($cart->items()) == 0) ? count($cart->items()).' ARTICLE' : count($cart->items()).' ARTICLES' !!} </h2>
                                    </div>
                                    @if(count($cart->items())>0)
                                    @foreach($cart->items() as $item_id=>$item)
                                 
                                    <div class="cart-product row">
                                        <div class="col-lg-4">
                                            <div class="product-image"><a href="{!! url(LaravelLocalization::getCurrentLocale().'/'.$item->getUrl()) !!}"><img src="{!! URL::to('/').'/'.\App\Product::PRODUCT_IMAGE_PATH.$item->getImage() !!}" alt="{!! $item->getImageAlt() !!}"></a>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <h4>{!! (isset($item->getProduct()->brand)) ? ($item->getProduct()->brand->parent_id==null) ? $item->getProduct()->brand->brand_name : $item->getProduct()->brand->parent->brand_name : "" !!}</h4>
                                            <span><a href="#">{!! $item->getName() !!}</a></span>
                                            <div class="product-price">
                                                    <?php $product = $item->getProduct();?>
                                                    @if($product->promotional_price != null)
                                                        <span class="old-price" style="color: rgb(67, 223, 230);">({!! $product->discount !!})</span>
                                                        <span class="old-price original_price" style="color: rgb(67, 223, 230);" data-price="{!! $product->original_price !!}"><del>{!! format_price($product->original_price) !!}</del></span>
                                                        <span class="new-price real-price" data-price="{!! $product->promotional_price !!}">{!! format_price($product->promotional_price) !!}</span>
                                                    @else
                                                        <span class="old-price real-price original_price" data-price="{!! $product->original_price !!}">{!! format_price($product->original_price) !!}</span>
                                                    @endif
                                            </div>
                                            <div class="reviews-total">
                                                <div class="stars_review col-lg-12" style="overflow: show !important;">
                                                    @for($i=1;$i <= average_rating($product->product_id);$i++)
                                                        <a title="1" class="star fullStar"></a>
                                                    @endfor
                                                    @for($i=5 ;$i > average_rating($product->product_id);$i--)
                                                        <a title="1" class="star"></a>
                                                    @endfor
                                                </div>
                                            </div>
                                            <div class="product-quantity">
                                                    @foreach($item->getAttributes() as $attribute)
                                                        <span>{!! $attribute->getName() !!}</span>&nbsp;&nbsp;&nbsp;<span> | </span>&nbsp;&nbsp;&nbsp;
                                                    @endforeach
                                                <select  class="quantity form-control form-select" name="qty[{!! $item_id !!}]">
                                                    @for($i=1; $i<=10 ; $i++)    
                                                        <option value="{!!$i!!}" {!! (Session::has($item_id) && Session::get($item_id) == $i) ? 'selected' : '' !!}>Qté {!! $i !!}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                           
                                        </div>
                                        
                                        <div class="col-lg-1 product-remove pull-right">
                                                <!--<a href="{!! url(LaravelLocalization::getCurrentLocale()."/cart/remove/$item_id") !!}"><i class="fa fa-times"></i></a>-->
                                                <button type="button" onclick='location.href = "{!! url(LaravelLocalization::getCurrentLocale()."/cart/remove/$item_id") !!}"' class="close">×</button>
                    
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="cart-product row">
                                        <div class="col-lg-12 fs-16 total-amount">
                                                <span>TOTAL À RÉGLER</span>
                                                <span class="pull-right total_original_amount">{!! format_price($cart->total()) !!}</span>
                                        </div>
                                    </div>
                                    @else
                                    <tr>
                                        <td colspan="7">
                                               {!! trans('cart.no_item') !!}
                                            </td>
                                        </tr>
                                    @endif
                                </div>
                            </div>
                           
                        </div>
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>
    @include('front.layout.section-avantage')    
@stop

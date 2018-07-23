<header>
    <!-- Action changement langue -->
    {!! Form::open(array('url' =>'search' ,'method'=>'GET','id' =>'language_form','class'=>'language-convert')) !!}
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 hidden">

            <span class="input-group-btn">
                <button class="btn btn-link" id="language" value="{!! (app('language')->language_code == 'fr') ? 'en' : 'fr' !!}" type="button">{!! (app('language')->language_code == 'fr') ? 'EN' : 'FR' !!}</button>
            </span>
        </div>
    {{-- {!! Form::select('language', ['en' => 'English', 'fr' => 'French'],(app('language')) ? app('language')->language_code : null,['class'=>'form-control required','id'=>'language']) !!} --}}
    {!! Form::close() !!}
    <!-- Fin action -->
<!-- Debut code header -->

<div class="header-top-area">  
    <div class="container" id="header-height">
        <div class="row" style="line-height: 1.9;">
             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 header-top-area-left">
                <a href="#" class="change-your-area" >
                    <div class="icon-change-area" style="color: 044651;" data-toggle="popover"  data-content="Cliquez ici pour changer votre zone d'achat actuelle !">
                        <img class="img-change-area" src="{!! URL::to('/').'/images/icon/marker.svg' !!}"/>
                    </div>
                    <div class="area-information" >
                    @if(Cookie::has('zip-code') && Cookie::has('radius'))
                        <p class="area" data-toggle="popover"  data-content="Cliquez ici pour changer votre zone d'achat actuelle !"> {!! trans('product.shopping_area') !!} : <strong>{!! Cookie::get('radius') !!} KM </strong> {!! trans('product.around') !!} <strong> {!! Cookie::get('zip-code') !!}</strong></p> 
                    @endif
                    </div>
                </a>
            </div>
            <a href="#" class="find-your-shop">
                <span class="icon-shop"></span>Retrouver nos boutiques
            </a>   
        </div>
    </div>
</div>

<div class="all-header">
    
    <div class="mean-menu-area" style="margin-bottom: -21px;">
        <div class="container ptb-20">
            <div class="row mt-20" style="line-height: 3.5;">

                <!-- header-search-end -->
                <!-- logo-start -->
                <div class="container content-logo">
                    <div class="logo text-center">
                        <a href="{!! URL::to('/') !!}">
                            <img src="{!! URL::to('/') !!}/images/logo.svg" alt="logo clickee"/>
                        </a>
                    </div>
                </div>
                <!-- logo-end -->
               
               
               @if(!$is_user_login || (Auth::user()->role_id==2 && request_is_in(['*/merchant/*', '*/store/*'])))                               
                    @if($is_user_login) 
                    <div class="logo-merchant">
                        @foreach(Auth::user()->store as $index=>$stor)
                        <span class="logo-lg">
                            <img style="max-width: 100px !important;" src="{!! URL::to('/') !!}/upload/logo/{!! $stor->logo !!}"> 
                        </span>
                        @endforeach
                    </div>
                    @endif
                @endif
               
               
                <!-- mini-cart-end -->
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 pull-right menu-icon-right">
                    <!-- header-top-right-start -->
                    <div class="header-account text-right col-lg-12 col-md-12 col-sm-12 col-xs-12 mean-menu">
                        <ul>
                            <li class="dropdown espace-header">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="icon icon-search search-product"></span>   
                                </a>
                            </li>
                            <li class="dropdown espace-header">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="icon icon-user"></span>   
                                </a>
                                <?php

                                    $dropdown_c = (app('language')->language_code == 'en') ? "c-pos-en" : "c-pos-fr";
                                    $dropdown_m = (app('language')->language_code == 'en') ? "m-pos-en" : "m-pos-fr";

                                    $dropdown = (!$is_user_login || Auth::user()->role_id==1) ? $dropdown_c : $dropdown_m ;
                                ?>
                                <ul class="dropdown-menu {!! $dropdown !!}">
                                    @if(!$is_user_login || Auth::user()->role_id==1)
                                        <!-- Pour les customers -->
                                        <li><a class="dropdown-menu-border" href="{!! route('customer-informations-client') !!}">{!! trans('common/label.your_account') !!}</a></li>
                                        <li><a class="dropdown-menu-border" href="{!! route('customer-commande-en-cours') !!}">{!! trans('common/label.your_orders') !!}</a></li>
                                        @if($is_user_login)
                                            <li><a href="{!! route('logout') !!}">{!! trans('common/label.sign_out')!!}</a></li>
                                        @else
                                            <li><a href="{!! route('login') !!}">{!! trans('common/label.sign_in') !!}</a></li>
                                        @endif
                                    @else
                                        <!-- Pour les merchants -->
                                        <li><a class="dropdown-menu-border" href="{!! route('store.edit', ['id' => Session::get('store_to_user')]) !!}">{!! trans('common/label.shop_account') !!}</a></li>
                                        <li><a class="dropdown-menu-border" href="{!! route('merchant-dashboard') !!}"> Tableau de bord </a></li>
                                        <li><a class="dropdown-menu-border" href="{!! route('merchant-product') !!}">Gérer les produits </a></li>
                                        <li><a class="dropdown-menu-border" href="{!! route('code-promo.index') !!}">Gérer les code promos </a></li>
                                        @if($is_user_login)
                                            <li><a href="{!! route('logout') !!}"> {!! trans('common/label.sign_out')!!} </a></li>
                                        @else
                                            <li><a href="{!! route('login') !!}">{!! trans('common/label.sign_in') !!}</a></li>
                                        @endif
                                    @endif
                                </ul>
                            </li>
                            <li class="dropdown espace-header">
                                <a href="#" onclick="location.href='{!! route('wishlist') !!}';" class="dropdown-menu-border" data-toggle="dropdown">
                                    <?php 
                                        $classc = (count_wishlist() > 0) ? "icon-heart-not-empty" : "icon-heart";
                                    ?>
                                    <span class="icon {!! $classc !!}"></span>   
                               
                                <?php
                                    $wishlist_count = count_wishlist();
                                    if($wishlist_count>0)
                                        $nbr = ($wishlist_count < 10) ? '0'.$wishlist_count : $wishlist_count;
                                    else
                                        $nbr = "";
                                ?>  
                                <span class="sell_coeur">{!! $nbr !!}</span>
                                 </a>
                            </li>
                            <li class="dropdown espace-header">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
                                    <?php 
                                        $class = ($cart_count > 0) ? "icon-panier-not-empty" : "icon-panier";
                                    ?>
                                    <span class="icon {!! $class !!}"></span>   
                                    <?php
                                        $nombre = ($cart_count < 10) ? '0'.$cart_count : $cart_count;
                                    ?>
                                    <span class="sell_pannier">{!! ($nombre == '00') ? "" : $nombre; !!}</span>
                                </a>
                               
                                @include('front.layout.cart-recent')
                            </li>
                        </ul>
                    </div>
                    <!-- header-top-right-end -->
                </div>
            
            </div>
        </div>


        <!-- header-mid-area-end -->
        <!-- mean-menu-area-start -->
        @if(!$is_user_login || Auth::user()->role_id==1 || (Auth::user()->role_id==2 && !request_is_in(['*/merchant/*', '*/store/*'])) ) <!--si le marchant n'est pas connecté on affiche toujours le menu-->    
        <div class="navbar navbar-default navbar-static-top">
            <div class="container" style="padding-left: inherit;padding-right: inherit;">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </div>
                <?php 
                    $category_parent_id = '';
                    $selected_category = '';
                    if(Input::has('category')){
                        $selected_category = Input::get('category'); 
                        $category = \App\Category::where('category_id', $selected_category)->first();
                        while($category->parent){
                            $category = $category->parent;
                            $category_parent_id = $category->category_id;
                        }
                    }
                ?>
                <div class="navbar-collapse collapse">
                    <?php getCategories($categories_data['tree_data'], $category_parent_id, $selected_category); ?>
                
                </div>
            </div>
        </div>  
        @endif
    <!-- menu area end -->
    </div>
<!-- Fin code header -->
</div>

</header>

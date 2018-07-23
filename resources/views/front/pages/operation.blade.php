@extends('front.layout.master')

@section('content')
    <div class="container-fluid content-page">
        <div style="">
            <div class="title pb-30">
                <h2>CLIENTS</h2>
            </div>
            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 border-green-dark pr-0">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 block-operation-top">
                    <div class="">
                        <p>Découvrez l’intégralité des produits des
                        commerçants qui vous entourent et soutenez
                        votre économie locale.</p>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center pb-20">
                            <a href="{!! route('search') !!}" class="btn btn-clickee-info">EN SAVOIR PLUS</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pr-0">
                    <img class="" src="{!! URL::to('/') !!}/images/operation1.png" alt="fonctionnement clickee" style="float:right !important;"/>
                </div>
            </div>
            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center mt-10">
                <div class="line-separator"></div>
            </div>        
            
            <div class="title">
                <h2 class="mtb-40">COMMERÇANTS</h2>
            </div>
            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 border-green-dark pl-0">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pl-0">
                    <img class="" src="{!! URL::to('/') !!}/images/operation2.png" alt="fonctionnement clickee"/>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 block-operation-bottom">
                    <p>Augmentez le flux dans votre boutique en
                    adoptant pour la solution Clickee. Clickee est
                    un outil de gestion globale de votre boutique et
                    vous permettra de vous adapter au nouveaux
                    modes de consommations de vos clients.</p>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center pb-20">
                        <a href="{!! route('merchant-login') !!}" class="btn btn-clickee-info">EN SAVOIR PLUS</a>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center pt-20">
                    <div class="line-separator"></div>
                    <div class="title ptb-40">
                        <H2 class="p-0">LES CHIFFRES DE CLICKEE</H2>
                    </div> 
                    
                    <div class="row mt--10">
                        <div class="col-lg-3">
                            <div class="border-green-dark text-center">
                                <p class="figure">
                                    {!! $store_count !!}
                                </p>
                                <p class="figure-name">
                                    Boutiques
                                </p> 
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="border-green-dark text-center">
                                <p class="figure">
                                    {!! $product_count !!}
                                </p>
                                <p class="figure-name">
                                    Produits
                                </p> 
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="border-green-dark text-center">
                                <p class="figure">
                                    1
                                </p>
                                <p class="figure-name">
                                    Villes
                                </p> 
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="border-green-dark text-center">
                                <p class="figure">
                                    {!! $user_count !!}
                                </p>
                                <p class="figure-name">
                                    Utilisateurs
                                </p> 
                            </div>
                        </div>
                    </div>
                    
                    <div class="line-separator"></div>
                    <div class="title pt-40 pb-10">
                        <H2>LE FONCTIONNEMENT</H2>
                    </div> 
                </div>
            </div>
            
            <h4 class="text-title mb--0">Clients</h4>
            <p>En quelques cliques consultez les produits autour de chez vous sur Clickee. <br>
            Le commerçant est informé de la commande. Il a 12 heures jours ouvrés pour valider la
            disponibilité du produits en magasin. <br>
            Vous pouvez récupérer votre produit dans la boutique concernée.</p>
            
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center pb-20">
                    <a href="{!! route('search') !!}" class="btn btn-clickee-info">EN SAVOIR PLUS</a>
                </div>
            </div>
            
            <h4 class="text-title mb--0">Commerçants</h4>
            <p>Créez votre compte professionnel en moins de 5 minutes pour rejoindre notre communauté de
            boutiques locales.<br>
            Mettez vos produits en ligne à n’importe quel moment de la journée.<br>
            Une fois le produit vendu, vous recevrez la visite du client que vous venez de rendre heureux et
            votre virement est envoyé automatiquement.</p>
            
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                    <a href="{!! route('vendre-avec-nous') !!}" class="btn btn-clickee-info">VENDRE AVEC CLICKEE</a>
                </div>
            </div>
        </div>
    </div>
    @include('front.layout.section-avantage')
@endsection
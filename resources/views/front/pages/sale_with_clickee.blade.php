@extends('front.layout.master')

@section('content')
    <div class="container-fluid content-page" style="padding:0px !important;">
        <div style="padding: 4.75% 10% 0 10%;">
            <div class="title pb-30">
                <h2>POURQUOI VENDRE SUR CLICKEE</h2>
            </div>
            
            <h4 class="text-title mb--0">1. Mise en vente de vos produits en illimité</h4>
            <p>Vous pouvez mettre autant de produits que vous le souhaitez, au même titre que s’il s’agissait de
            votre site Internet, le tout avec une visibilité optimale (référencement et visibilité de part la
            communication faite de la plateforme).</p>
            
            <h4 class="text-title mb--0">2. Gestion des stocks en temps réel</h4>
            <p>Grâce à notre fonctionnalité « Encaissement », vous pouvez gérer vos stocks en live et éviter les
            doublons.</p>
            
            <h4 class="text-title mb--0">3. Attirer de nouveaux clients</h4>
            <p>Clickee fonctionne sur le principe du Click and Collect, une fois les produits achetés, les clients
            viendront chez vous les récupèrer. A vous de jouer pour les fidéliser.</p>
            
            <h4 class="text-title mb--0">4. Visibilité sur vos statistiques</h4>
            <p>Vous avez accès aux statistiques de vos performances en continue.</p>
            
            <h4 class="text-title mb--0">5. Boutique ouverte 24h/24</h4>
            <p>Les clients peuvent acheter vos produits 24h/24 et 7j/7.</p>
            
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center pt-20">
                    <a href="{!! route('merchant-login') !!}" class="btn btn-clickee-info">COMMENCER À VENDRE</a>
                    <div class="line-separator"></div>
                    <div class="title ptb-40">
                        <H2 class="p-0">LES CHIFFRES DE CLICKEE</H2>
                    </div> 
                    
                    <div class="row mt--10">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                            <div class="border-green-dark text-center">
                                <p class="figure">
                                    {!! $store_count !!}
                                </p>
                                <p class="figure-name">
                                    Boutiques
                                </p> 
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                            <div class="border-green-dark text-center">
                                <p class="figure">
                                    {!! $product_count !!}
                                </p>
                                <p class="figure-name">
                                    Produits
                                </p> 
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                            <div class="border-green-dark text-center">
                                <p class="figure">
                                    1
                                </p>
                                <p class="figure-name">
                                    Villes
                                </p> 
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
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
                        <H2>COMMENT VENDRE SUR CLICKEE</H2>
                    </div> 
                </div>
            </div>
            
            <h4 class="text-title mb--0">1. Créez votre compte professionnel</h4>
            <p>En moins de 5 minutes vous choisissez le pack le plus adapté à vos besoins et vous rentrez vos
            coordonnées professionnelles.</p>
            
            <h4 class="text-title mb--0">2. Prenez vos produits en photo</h4>
            <p>A l’aide de votre téléphone et nos conseils, prenez vos produits en photo pour les mettre sur le site.</p>
            
            <h4 class="text-title mb--0">3. Décrivez vos produits</h4>
            <p>Rentrez les informations qui concernent vos produits.</p>
            
            <h4 class="text-title mb--0">4. Générez du flux dans votre boutique</h4>
            <p>Une fois vos produits vendus, les clients viennent vous voir pour les récupérer, à vous de jouer!</p>
            
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center pt-20">
                    <a href="{!! route('merchant-login') !!}" class="btn btn-clickee-info">CRÉEZ VOTRE COMPTE</a>
                    <div class="line-separator"></div>
                    <div class="title pt-40 pb-10">
                        <H2>NOS PACKS</H2>
                    </div> 
                </div>
            </div>
        </div>
        <div role="tabpanel" id="tab-sale" class="tab-panel tab-panel-customer col-lg-12 col-xs-12 col-md-12 col-sm-12">
        	<div class="section-title">
        	</div>
            <ul class="nav nav-tabs" style="font-size: 17px !important;border-bottom: 1px solid #efefed !important;margin-top: 15px !important;width: 50% !important;" role="tablist">
                <li role="presentation" class="active"><a href="#uploadTab" class="notflip" aria-controls="uploadTab" role="tab" data-toggle="tab" id="head-tab-signing">ENGAGEMENT ANNUEL</a>
                </li>
                <li role="presentation"><a class="flip" href="#browseTab" aria-controls="browseTab" role="tab" data-toggle="tab" id="head-tab-register">SANS ENGAGEMENT</a>

                </li>
                <button type="button" class="close" href="javascript:history.back()" aria-label="Close">
            </ul>

            

            <div class="tab-content tab-login" id="tab-engagement">                

                <div role="tabpanel" class="tab-pane active hidden-xs" id="uploadTab">
                	
                	<div class="row" style="width: 105%;margin-bottom: -1.4rem;">
                	    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3 point5"></div>
                	    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3 point5"></div>
                	    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3 point5 bg-green">LE PLUS POPULAIRE</div>
                	    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3 point5"></div>
                	    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3 point5"></div>
                	</div>    
                	
                	<div class="row" style="width: 105%;">
                        
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-5 point5 left-header  border-green" id="left-header" style="margin-top: 30rem;">
                            <p><b>Compte employés</b></p>
                            <div class="row bg-white p-0"><p><b>Nombre d’articles</b></p></div>
                            <p><b>Base de données clients</b></p>
                            <div class="row bg-white p-0"><p><b>Visibilité des produits</b></p></div>
                            <p><b>Frais de transaction</b></p>
                            <div class="row bg-white p-0"><p><b>Codes promo</b></p></div>
                            <p><b>Encaissement physique</b></p>
                            <div class="row bg-white p-0"><p><b>Rapport d’activité</b></p></div>
                            <p><b>Fiche boutique</b></p>
                            <div class="row bg-white p-0"><p><b>Newsletters</b></p></div>
                        </div>
                        
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-7 point5 border-green" id="discovery">
                            <div class="row bg-white header-engagement-height">
                                <div class="title pb-20 pt-10">
                                    <img class="engagement-logo" src="{!! URL::to('/') !!}/images/icon/logo_dans_page.svg" alt="logo"/>
                                    <span>Découverte</span>
                                </div>
                                <div class="engagement-price mt-25">GRATUIT</div>
                                <a href="#" class="btn btn-clickee-info-plein mtb-10">CHOISIR</a>
                                
                                <span>
                                    Souscrivez au Pack Découverte pour découvrir toutes les fonctionnalités de Clickee sans dépenser un euro.
                                </span>
                            </div>
                            <p>illimité</p>
                            <div class="row bg-white p-0"><p>illimité</p></div>
                            <p>illimité</p>
                            <div class="row bg-white p-0">
                                <p><i class="fa fa-times"></i></p>
                            </div>
                            <p><i class="fa fa-times"></i></p>
                            <div class="row bg-white p-0">
                                <p><i class="fa fa-check"></i></p>
                            </div>
                            <p><i class="fa fa-check"></i></p>
                            <div class="row bg-white p-0">
                                <p><i class="fa fa-check"></i></p>    
                            </div>
                            <p><i class="fa fa-check"></i></p>
                            <div class="row bg-white p-0">
                                <p><i class="fa fa-times"></i></p>
                            </div>
                        </div>
                        
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-7 point5 border-green shadow-engagement" id="seller">
                            <div class="row bg-white header-engagement-height">
                                <div class="title pb-20 pt-10">
                                    <img class="engagement-logo" src="{!! URL::to('/') !!}/images/icon/logo_dans_page.svg" alt="logo"/>
                                    <span>Vendeur</span>
                                </div>
                                <div class="engagement-price mb--10"><span class="price-int">30</span><span class="price-unity">€</span>/mois</div>
                                <a href="#" class="btn btn-clickee-info-plein mtb-10">CHOISIR</a>
                                
                                <span>
                                    Souscrivez au Pack Vendeur pour commencer à booster vos ventes en local.
                                </span>
                            </div>
                            <p>illimité</p>
                            <div class="row bg-white p-0"><p>illimité</p></div>
                            <p>illimité</p>
                            <div class="row bg-white p-0">
                                <p><i class="fa fa-check"></i></p>
                            </div>
                            <p>3,5%</p>
                            <div class="row bg-white p-0">
                                <p><i class="fa fa-check"></i></p>
                            </div>
                            <p><i class="fa fa-check"></i></p>
                            <div class="row bg-white p-0">
                                <p><i class="fa fa-check"></i></p>    
                            </div>
                            <p><i class="fa fa-check"></i></p>
                            <div class="row bg-white p-0">
                                <p><i class="fa fa-times"></i></p>
                            </div>
                        </div>
                        
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-7 point5 border-green" id="marketing">
                            <div class="row bg-white header-engagement-height">
                                <div class="title pb-20 pt-10">
                                    <img class="engagement-logo" src="{!! URL::to('/') !!}/images/icon/logo_dans_page.svg" alt="logo"/>
                                    <span>Marketing</span>
                                </div>
                                <div class="engagement-price mb--10"><span class="price-int">45</span><span class="price-unity">€</span>/mois</div>
                                <a href="#" class="btn btn-clickee-info-plein mtb-10">CHOISIR</a>
                                
                                <span>
                                    Souscrivez au Pack Marketing si vous souhaitez fidéliser vos clients en les tenant informés en live.
                                </span>
                            </div>
                            <p>illimité</p>
                            <div class="row bg-white p-0"><p>illimité</p></div>
                            <p>illimité</p>
                            <div class="row bg-white p-0">
                                <p><i class="fa fa-check"></i></p>
                            </div>
                            <p>3,5%</p>
                            <div class="row bg-white p-0">
                                <p><i class="fa fa-check"></i></p>
                            </div>
                            <p><i class="fa fa-check"></i></p>
                            <div class="row bg-white p-0">
                                <p><i class="fa fa-check"></i></p>    
                            </div>
                            <p><i class="fa fa-check"></i></p>
                            <div class="row bg-white p-0">
                                <p>de 0 à 500 clients</p>
                            </div>
                        </div>
                        
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-7 point5 border-green"  id="marketingp">
                            <div class="row bg-white header-engagement-height">
                                <div class="title pb-20 pt-10">
                                    <img class="engagement-logo" src="{!! URL::to('/') !!}/images/icon/logo_dans_page.svg" alt="logo clickee"/>
                                    <span>Marketing +</span>
                                </div>
                                <div class="engagement-price mb--10"><span class="price-int">65</span><span class="price-unity">€</span>/mois</div>
                                <a href="#" class="btn btn-clickee-info-plein mtb-10">CHOISIR</a>
                                
                                <span>
                                    Souscrivez au Pack Marketing + quand votre base de données clients grandie.
                                </span>
                            </div>
                            <p>illimité</p>
                            <div class="row bg-white p-0"><p>illimité</p></div>
                            <p>illimité</p>
                            <div class="row bg-white p-0">
                                <p><i class="fa fa-check"></i></p>
                            </div>
                            <p>3,5%</p>
                            <div class="row bg-white p-0">
                                <p><i class="fa fa-check"></i></p>
                            </div>
                            <p><i class="fa fa-check"></i></p>
                            <div class="row bg-white p-0">
                                <p><i class="fa fa-check"></i></p>    
                            </div>
                            <p><i class="fa fa-check"></i></p>
                            <div class="row bg-white p-0">
                                <p>de 500 à 2 000 clients</p>
                            </div>
                        </div>
                        
                    </div>
                	
                </div>

                <div role="tabpanel" class="tab-pane hidden-xs" id="browseTab">
                	
                	<div class="row" style="width: 105%;margin-bottom: -1.4rem;">
                	    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3 point5"></div>
                	    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3 point5"></div>
                	    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3 point5 bg-green">LE PLUS POPULAIRE</div>
                	    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3 point5"></div>
                	    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3 point5"></div>
                	</div>
                	
                	<div class="row" style="width: 105%;">
                        
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-5 point5 left-header border-green" style="margin-top: 30rem;">
                            <p><b>Compte employés</b></p>
                            <div class="row bg-white p-0"><p><b>Nombre d’articles</b></p></div>
                            <p><b>Base de données clients</b></p>
                            <div class="row bg-white p-0"><p><b>Visibilité des produits</b></p></div>
                            <p><b>Frais de transaction</b></p>
                            <div class="row bg-white p-0"><p><b>Codes promo</b></p></div>
                            <p><b>Encaissement physique</b></p>
                            <div class="row bg-white p-0"><p><b>Rapport d’activité</b></p></div>
                            <p><b>Fiche boutique</b></p>
                            <div class="row bg-white p-0"><p><b>Newsletters</b></p></div>
                        </div>
                        
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-7 point5 border-green" id="discovery2">
                            <div class="row bg-white header-engagement-height">
                                <div class="title pb-20 pt-10">
                                    <img class="engagement-logo" src="{!! URL::to('/') !!}/images/icon/logo_dans_page.svg" alt="logo"/>
                                    <span>Découverte</span>
                                </div>
                                <div class="engagement-price mt-25">GRATUIT</div>
                                <a href="#" class="btn btn-clickee-info-plein mtb-10">CHOISIR</a>
                                
                                <span>
                                    Souscrivez au Pack Découverte pour découvrir toutes les fonctionnalités de Clickee sans dépenser un euro.
                                </span>
                            </div>
                            <p>illimité</p>
                            <div class="row bg-white p-0"><p>illimité</p></div>
                            <p>illimité</p>
                            <div class="row bg-white p-0">
                                <p><i class="fa fa-times"></i></p>
                            </div>
                            <p><i class="fa fa-times"></i></p>
                            <div class="row bg-white p-0">
                                <p><i class="fa fa-check"></i></p>
                            </div>
                            <p><i class="fa fa-check"></i></p>
                            <div class="row bg-white p-0">
                                <p><i class="fa fa-check"></i></p>    
                            </div>
                            <p><i class="fa fa-check"></i></p>
                            <div class="row bg-white p-0">
                                <p><i class="fa fa-times"></i></p>
                            </div>
                        </div>
                        
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-7 point5 border-green shadow-engagement" id="seller2">
                            <div class="row bg-white header-engagement-height">
                                <div class="title pb-20 pt-10">
                                    <img class="engagement-logo" src="{!! URL::to('/') !!}/images/icon/logo_dans_page.svg" alt="logo"/>
                                    <span>Vendeur</span>
                                </div>
                                <div class="engagement-price mb--10"><span class="price-int">39</span><span class="price-unity">€</span>/mois</div>
                                <a href="#" class="btn btn-clickee-info-plein mtb-10">CHOISIR</a>
                                
                                <span>
                                    Souscrivez au Pack Vendeur pour commencer à booster vos ventes en local.
                                </span>
                            </div>
                            <p>illimité</p>
                            <div class="row bg-white p-0"><p>illimité</p></div>
                            <p>illimité</p>
                            <div class="row bg-white p-0">
                                <p><i class="fa fa-check"></i></p>
                            </div>
                            <p>3,5%</p>
                            <div class="row bg-white p-0">
                                <p><i class="fa fa-check"></i></p>
                            </div>
                            <p><i class="fa fa-check"></i></p>
                            <div class="row bg-white p-0">
                                <p><i class="fa fa-check"></i></p>    
                            </div>
                            <p><i class="fa fa-check"></i></p>
                            <div class="row bg-white p-0">
                                <p><i class="fa fa-times"></i></p>
                            </div>
                        </div>
                        
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-7 point5 border-green" id="marketing2">
                            <div class="row bg-white header-engagement-height">
                                <div class="title pb-20 pt-10">
                                    <img class="engagement-logo" src="{!! URL::to('/') !!}/images/icon/logo_dans_page.svg" alt="logo"/>
                                    <span>Marketing</span>
                                </div>
                                <div class="engagement-price mb--10"><span class="price-int">59</span><span class="price-unity">€</span>/mois</div>
                                <a href="#" class="btn btn-clickee-info-plein mtb-10">CHOISIR</a>
                                
                                <span>
                                    Souscrivez au Pack Marketing si vous souhaitez fidéliser vos clients en les tenant informés en live.
                                </span>
                            </div>
                            <p>illimité</p>
                            <div class="row bg-white p-0"><p>illimité</p></div>
                            <p>illimité</p>
                            <div class="row bg-white p-0">
                                <p><i class="fa fa-check"></i></p>
                            </div>
                            <p>3,5%</p>
                            <div class="row bg-white p-0">
                                <p><i class="fa fa-check"></i></p>
                            </div>
                            <p><i class="fa fa-check"></i></p>
                            <div class="row bg-white p-0">
                                <p><i class="fa fa-check"></i></p>    
                            </div>
                            <p><i class="fa fa-check"></i></p>
                            <div class="row bg-white p-0">
                                <p>de 0 à 500 clients</p>
                            </div>
                        </div>
                        
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-7 point5 border-green" id="marketingp2">
                            <div class="row bg-white header-engagement-height">
                                <div class="title pb-20 pt-10">
                                    <img class="engagement-logo" src="{!! URL::to('/') !!}/images/icon/logo_dans_page.svg" alt="logo"/>
                                    <span>Marketing +</span>
                                </div>
                                <div class="engagement-price mb--10"><span class="price-int">79</span><span class="price-unity">€</span>/mois</div>
                                <a href="#" class="btn btn-clickee-info-plein mtb-10">CHOISIR</a>
                                
                                <span>
                                    Souscrivez au Pack Marketing + quand votre base de données clients grandie.
                                </span>
                            </div>
                            <p>illimité</p>
                            <div class="row bg-white p-0"><p>illimité</p></div>
                            <p>illimité</p>
                            <div class="row bg-white p-0">
                                <p><i class="fa fa-check"></i></p>
                            </div>
                            <p>3,5%</p>
                            <div class="row bg-white p-0">
                                <p><i class="fa fa-check"></i></p>
                            </div>
                            <p><i class="fa fa-check"></i></p>
                            <div class="row bg-white p-0">
                                <p><i class="fa fa-check"></i></p>    
                            </div>
                            <p><i class="fa fa-check"></i></p>
                            <div class="row bg-white p-0">
                                <p>de 500 à 2 000 clients</p>
                            </div>
                        </div>
                        
                    </div>
                	
                </div>
            </div>

            <!--  menu dans les écrans mobiles  -->
            <div class="engagement-menu hidden text-center" id="uploadTab">
                <br><br><br>
                <div class="row menu-pop" style="width: 105%;"> 
                    <div class="point5 col-xs-3"></div>
                    <div class="point5 col-xs-3 bg-green" style="font-size: 15px;">LE PLUS POPULAIRE</div>
                    <div class="point5 col-xs-3"></div>
                    <div class="oint5 col-xs-3"></div>
                </div>                      
                <div class="row menu" style="width: 105%;">
                        <a class="active  bg-white text-center col-xs-3" href = "#discovery" data-tab="uploadTab" onclick = "showEngagement(this)">
                            <div class="pt-10">
                                <span>Découverte</span>
                            </div>
                            <div class="engagement-price mt-25">GRATUIT</div>
                        </a>
                        <a class="shadow-engagement  bg-white text-center col-xs-3" href = "#seller" data-tab="uploadTab" onclick = "showEngagement(this)">
                            <div class="pt-10">
                                <span>Vendeur</span>
                            </div>
                            <div class="engagement-price text-center"><span class="price-int">30</span><span class="price-unity">€</span>/mois</div>
                        </a>
                        <a class="text-center  bg-white col-xs-3" href = "#marketing" data-tab="uploadTab" onclick = "showEngagement(this)">
                            <div class="pt-10">
                                <span>Marketing</span>
                            </div>
                            <div class="engagement-price text-center"><span class="price-int">45</span><span class="price-unity">€</span>/mois</div>
                        </a>
                        <a class="text-center  bg-white col-xs-3" href = "#marketingp" data-tab="uploadTab" onclick = "showEngagement(this)">
                            <div class="pt-10">
                                <span>Marketing +</span>
                            </div>
                            <div class="engagement-price text-center"><span class="price-int">65</span><span class="price-unity">€</span>/mois</div>                             
                        </a>
                </div>
            </div>

            <div class="engagement-menu hidden text-center" id="browseTab">
                <br><br><br>
                <div class="row menu-pop" style="width: 105%;">
                    <div class="point5 col-xs-3"></div>
                    <div class="point5 col-xs-3 bg-green" style="font-size: 15px;">LE PLUS POPULAIRE</div>
                    <div class="point5 col-xs-3"></div>
                    <div class="oint5 col-xs-3"></div>
                </div>                      
                <div class="row menu" style="width: 105%;">
                        <a class="active  bg-white text-center col-xs-3" href = "#discovery2" data-tab="browseTab" onclick = "showEngagement(this)">
                            <div class="pt-10">
                                <span>Découverte</span>
                            </div>
                            <div class="engagement-price mt-25">GRATUIT</div>
                        </a>
                        <a class="shadow-engagement  bg-white text-center col-xs-3" href = "#seller2" data-tab="browseTab" onclick = "showEngagement(this)">
                            <div class="pt-10">
                                <span>Vendeur</span>
                            </div>
                            <div class="engagement-price text-center"><span class="price-int">39</span><span class="price-unity">€</span>/mois</div>
                        </a>
                        <a class="text-center  bg-white col-xs-3" href = "#marketing2" data-tab="browseTab" onclick = "showEngagement(this)">
                            <div class="pt-10">
                                <span>Marketing</span>
                            </div>
                            <div class="engagement-price text-center"><span class="price-int">59</span><span class="price-unity">€</span>/mois</div>
                        </a>
                        <a class="text-center  bg-white col-xs-3" href = "#marketingp2" data-tab="browseTab" onclick = "showEngagement(this)">
                            <div class="pt-10">
                                <span>Marketing +</span>
                            </div>
                            <div class="engagement-price text-center"><span class="price-int">79</span><span class="price-unity">€</span>/mois</div>                             
                        </a>
                </div>
            </div>

            <div class="hidden" id="engagement-menu-content">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-5 point5 left-header  border-green" style="margin-top: 30rem; border-right: none;">
                    <p><b>Compte employés</b></p>
                    <div class="row bg-white p-0"><p><b>Nombre d’articles</b></p></div>
                    <p><b>Base de données clients</b></p>
                    <div class="row bg-white p-0"><p><b>Visibilité des produits</b></p></div>
                    <p><b>Frais de transaction</b></p>
                    <div class="row bg-white p-0"><p><b>Codes promo</b></p></div>
                    <p><b>Encaissement physique</b></p>
                    <div class="row bg-white p-0"><p><b>Rapport d’activité</b></p></div>
                    <p><b>Fiche boutique</b></p>
                    <div class="row bg-white p-0"><p><b>Newsletters</b></p></div>
                </div>
                
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-7 point5 border-green" id="content2">
                </div>
            </div>
        </div>
        
    </div>
    @include('front.layout.section-avantage')
@endsection
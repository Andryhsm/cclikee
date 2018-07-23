<!-- footer-area-start -->
<footer>
    <!-- footer-top-area-start -->
    <!-- <a onclick="$('#scrollUp').trigger('click');" href="#">
        <div class="container-fluid retour-en-haut">
            {!! trans("common/label.back-to-top")!!}
        </div>
    </a> -->    
    <div class="footer-top-area ptb-10">
        <div class="container">
            <div class="footer-img pt-30 pb-15 footer-logo row">
                <div class="col-lg-12">
                    <a href="{!! URL::to('/') !!}"><img class="footer-area-logo-width" src="{!! URL::to('/') !!}/images/logo_blanc.svg" alt="logo"/></a>
                </div>
            </div>
            <div class="footer-links">
                <div class="footer-item">
                    <div class="footer-menu">
                         <span class="top-link-footer">CLICKEE</span>
                        <ul>
                            <li class="footer-menu">
                                <a href="{!! route('qui-sommes-nous') !!}">Qui sommes-nous ? </a>
                            </li>
                            <li >
                                <a href="{!! route('fonctionnement') !!}">Fonctionnement</a>
                            </li>
                            <li >
                                <a href="{!! route('presse') !!}">Presse</a>
                            </li>
                            <li >
                                <a href="{!! route('mentions-légales-clickee') !!}">Mentions légales</a>
                            </li>
                            <li >
                                <a href="{!! route('contact-us-get') !!}">Contactez-nous</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="footer-item">
                    <!-- single-footer-area-start -->
                    <div class="single-footer">
                        <div class="footer-menu">
                            <span class="top-link-footer">CLIENTS</span>
                            <ul>
                                @if(!$is_user_login || Auth::user()->role_id==1)                                
                                    @if($is_user_login)
                                        <li class="footer-menu"><a href="{!! route('logout') !!}">Déconnexion</a></li>
                                    @else
                                        <li class="footer-menu"><a href="{!! route('login') !!}">Inscription / Connexion</a></li>
                                    @endif
                                    <?php $spaceC = ""; ?>
                                @else
                                    <?php $spaceC = "footer-menu"; ?>
                                @endif
                                <li class="{!! $spaceC !!}"> <a href="{!! url('/acheter-avec-clickee') !!}">Achetez avec Clickee</a></li>
                                <li> <a href="{!! route('faq') !!}">FAQ Clients</a></li>
                                <li> <a href="{!! route('conditions-générales-de-vente') !!}">CGV</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- single-footer-area-end -->
                </div>
                <div class="footer-item mt-52 second-footer">
                    <!-- single-footer-area-start -->
                    <div class="single-footer">
                        <div class="">
                            <div class="no-padding col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="footer-menu">
                                    <span class="top-link-footer">COMMERÇANTS</span>
                                    <ul>
                                        @if(!$is_user_login || Auth::user()->role_id==2)                               
                                            @if($is_user_login)
                                                <li class="footer-menu"><a href="{!! route('merchant-dashboard') !!}">Mon compte pro</a></li>
                                                <li class=""><a href="{!! url('/logout') !!}">Déconnexion</a></li>
                                            @else
                                                <li class="footer-menu"><a href="{!! route('merchant-login') !!}">Inscription / Connexion</a></li>
                                            @endif
                                            <?php $spaceM = "" ; ?>
                                        @else
                                            <?php $spaceM = "footer-menu" ; ?>
                                        @endif
                                        <li class="{!! $spaceM !!}">
                                            <a href="{!! route('vendre-avec-nous') !!}">Vendre avec Clickee</a>
                                        </li>
                                        <li>
                                            <a href="{!! route('business-faq') !!}">FAQ Boutiques</a>
                                        </li>
                                        <li>
                                            <a href="{!! route('nos-conseils-photo') !!}">Nos conseils photo</a>
                                        </li>
                                        <li>
                                            <a href="{!! route('conditions-générales-d-utilisation') !!}">CGU</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
                <div class="footer-item"> <!--  style="margin-top:15px !important;" -->
                    <div class="single-footer">
                        <div class="footer-icon"> <!-- block2 -->
                            <!-- <div class="container"> -->
                                <div class="row">
                                    
                                    <a class="fb col-lg-3 col-md-3 col-sm-6 col-xs-12" href="#" data-toggle="tooltip">&nbsp;</a>
                                    <a class="tt col-lg-3 col-md-3 col-sm-6 col-xs-12" href="#" data-toggle="tooltip">&nbsp;</a>
                                    <a class="pt col-lg-3 col-md-3 col-sm-6 col-xs-12" href="#" data-toggle="tooltip">&nbsp;</a>
                                    <a class="gg col-lg-3 col-md-3 col-sm-6 col-xs-12" href="#" data-toggle="tooltip">&nbsp;</a>

                                </div>
                            <!-- </div> -->
                        </div>
                        <div class="footer-title">
                            <h3>NEWSLETTER</h3>
                            <p>{!! trans("common/label.newsletter_text")!!}</p>
                        </div>
                        <div class="footer-box">
                            <form action="{!! url('/subscribe') !!}" method="post">
                                <input type="text" name="email" class="required email" placeholder='ENTREZ VOTRE E-MAIL ICI'/>
                                <button type="submit" id="subscribe">OK</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer-top-area-end -->
    <!-- footer-bottom-area-start -->

    <div class="footer-bottom-area ptb-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-5 col-sm-6 col-xs-12">
                    <!-- single-footer-area-start -->
                    <div class="copy-right">
                        <p>© 2018 <font color="#044651">ALTERNATEEVE</font> {!! trans("common/label.all_right_reserved")!!}</p>
                    </div>
                    <!-- single-footer-area-end -->
                </div>
                <div class="col-lg-6 col-md-7 col-sm-6 col-xs-12">
                    <!-- single-footer-area-start -->
                    <div class="footer-bottom-menu text-right">
                        <nav>
                            <ul>
                                <li><a href="{!! url('/about-us') !!}">{!! trans("common/label.about_us")!!}</a></li>
                                <li><a href="{!! url('/terms-conditions') !!}">{!! trans("common/label.terms_conditions")!!}</a></li>
                                <li><a href="{!! url('/privacy-cookies') !!}">{!! trans("common/label.privacy_cookies")!!}</a></li>
                            </ul>
                        </nav>
                    </div>
                    <!-- single-footer-area-end -->
                </div>
            </div>
        </div>
    </div>
    <!-- footer-bottom-area-end -->
</footer>
 <!-- footer-area-end -->
<!-- all js here -->

<!-- jquery latest version -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<!-- bootstrap js -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js "></script>
<!-- jquery-ui js -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- owl.carousel js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
<!-- jquery.magnific-popup.min.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<!-- jquery.nivo.slider.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nivoslider/3.2/jquery.nivo.slider.min.js"></script>
<!-- chosen.jquery.min.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<script src="{!! URL::to('/') !!}/frontend/js/vendor/jquery-1.12.0.min.js"></script>
<script src="{!! URL::to('/') !!}/frontend/js/bootstrap.min.js"></script>
<script src="{!! URL::to('/') !!}/frontend/js/jquery-ui.min.js"></script>
<script src="{!! URL::to('/') !!}/frontend/js/owl.carousel.min.js"></script>
<script src="{!! URL::to('/') !!}/frontend/js/jquery.magnific-popup.min.js"></script>
<script src="{!! URL::to('/') !!}/frontend/js/jquery.nivo.slider.js"></script>
<script src="{!! URL::to('/') !!}/frontend/js/chosen.jquery.min.js"></script>

{!! Html::script('frontend/js/jquery-ui.js') !!}

{!! Html::script('frontend/js/search-local-product.js') !!}
{!! Html::script('frontend/js/product_detail.js') !!}
{!! Html::script('frontend/js/jquery.flexslider.js') !!}

<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/locales/bootstrap-datepicker.fr.min.js"></script>-->

<!-- Loading overlay -->
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.0/dist/loadingoverlay.min.js"></script>

<!-- jquery.elevateZoom-3.0.8.min.js -->
<script src="{!! URL::to('/') !!}/frontend/js/jquery.elevatezoom.js"></script>
<!-- Zoom.min.js -->
<script src="{!! URL::to('/') !!}/frontend/js/jquery.zoom.js"></script>
<!-- meanmenu js -->
<script src="{!! URL::to('/') !!}/frontend/js/jquery.meanmenu.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script>

{!! Html::script('frontend/js/validation.js') !!}

{!! Html::script('js/jquery.validate.min.js') !!}
<!-- bootstrap date -->
{!! Html::script('backend/plugins/datepicker/bootstrap-datepicker.js') !!}
<!-- wow js -->
<script src="{!! URL::to('/') !!}/frontend/js/wow.min.js"></script>
<!-- jquery.mixitup.min.js -->
<script src="{!! URL::to('/') !!}/frontend/js/jquery.mixitup.min.js"></script>

<!-- jquery.countdown.min.js -->
<script src="{!! URL::to('/') !!}/frontend/js/jquery.countdown.min.js"></script>
<!-- autocomplete -->
<script src="{!! URL::to('/') !!}/frontend/js/jquery.easy-autocomplete.min.js"></script>
<!-- plugins js -->
<script src="{!! URL::to('/') !!}/frontend/js/plugins.js"></script>

{!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js') !!}
{!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js') !!}
<!-- main js -->
<script src="{!! URL::to('/') !!}/frontend/js/main.js"></script>
@if(isset($language) && app('language')->language_code==\App\Models\Language::FRENCH_CODE)
    {!! Html::script('frontend/js/validation_message_fr.js') !!}
@endif
{!! Html::script('frontend/js/catalog.js') !!}
<!-- script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script -->

{!! Html::script('frontend/js/my_account.js') !!}
{!! Html::script('frontend/js/cloud-zoom.js') !!}

{!! Html::script('frontend/js/jquery.rating.js') !!}
{!! Html::script('frontend/js/owl.carousel.min.js') !!}
{!! Html::script('frontend/js/jquery.panzoom.js') !!}

{!! Html::script('frontend/js/product_search.js') !!}
{!! Html::script('frontend/js/order.js') !!}

{!! Html::script('frontend/js/search-local-product.js') !!}
{!! Html::script('frontend/js/wishlist.js') !!}
{!! Html::script('frontend/js/responsive.js') !!}
<!-- Bootstrap dropdown hover -->
<!--<script src="{!! URL::to('/') !!}/frontend/js/bootstrap-dropdownhover.js"></script>-->
@yield('additional-script')
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src='https://www.google.com/recaptcha/api.js?hl={!! app('language')->language_code !!}'></script>
<script type="text/javascript" async src="//assets.pinterest.com/js/pinit.js"></script>
<script>
    var $section = $('#auto-contain');
    $section.find('.panzoom').panzoom({
        $zoomIn: $section.find(".zoom-in"),
        $zoomOut: $section.find(".zoom-out"),
        $zoomRange: $section.find(".zoom-range"),
        $reset: $section.find(".reset"),
        increment: 0.1,
        minScale: 0.5,
        contain: 'automatic'
    });
    jQuery("#latest-news-slider .slider-items").owlCarousel({
        autoplay: !0,
        items: 3,
        itemsDesktop: [1024, 3],
        itemsDesktopSmall: [900, 2],
        itemsTablet: [640, 2],
        itemsMobile: [480, 1],
        navigation: !0,
        navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
        slideSpeed: 500,
        pagination: !1
    });
</script>
<script>
    /*carousel navigation*/
   $(document).ready(function() {
        $("#owl-blog").owlCarousel({
          nav: true,
          navText: [$('.pager-left'),$('.pager-right')]
          /*["<img src='{!! URL::to('/') !!}/images/fleche_gauche_bleu.svg'>","<img src='{!! URL::to('/') !!}/images/fleche_droite_bleu.svg'>"]*/
        });
        
});
</script>
{!! Html::script('frontend/js/style.js') !!}
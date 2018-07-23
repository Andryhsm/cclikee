<header>
    <!-- fixed-header-area-start -->
    <div class="fixed-header-area" id="sticky-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2">
                    <!-- logo-start -->
                    <div class="logo sticky-logo">
                        <a href="{!! URL::to('/') !!}"><img src="{!! URL::to('/') !!}/images/logo_blancTexte.svg" alt="logo"/></a>
                    </div>
                    <!-- logo-end -->
                </div>
                <div class="col-lg-8 col-md-7 col-sm-7">
                    <!-- mean-menu-area-start -->
                    <div class="mean-menu-area">
                        <div class="mean-menu text-center">
                            <nav>
                                <ul>
                                    <li><a href="{!! Url('/') !!}">Home</a>

                                    </li>
                                    <li><a href="#">Catalogue</a>

                                    </li>
                                    <li><a href="#">Ask a Product</a>

                                    </li>
                                    <li class="static"><a href="{!! URL::to('/') !!}/blog">Blog</a>
                                    </li>
                                    <li><a href="{!! URL::to('/') !!}/contact-us">Contact</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!-- mean-menu-area-end -->
                </div>
                <div class="col-lg-2 col-md-3 col-sm-3">
                    <!-- mini-cart-total-start -->
                    @include('front.layout.cart-recent')
                    <!-- mini-cart-end -->
                </div>
            </div>
        </div>
    </div>
    <!-- fixed-header-area-end -->
    <!-- header-top-area-start -->
    <div class="header-top-area ptb-15">
        <div class="container">
            <div class="row">
                <!-- header-top-left-start -->
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="header-account text-left">
                        {!! Form::open(array('url' => \Request::route()->getName(),'id' =>'language_form','method'=>"GET",'class'=>'language-convert')) !!}
                        {!! Form::select('language', ['en' => 'English', 'fr' => 'French'],(app('language')) ? app('language')->language_code : null,['class'=>'form-control required','id'=>'language']) !!}
                        {!! Form::close() !!}
                        <ul>
                            @if(!$is_user_login)
                                <li><a href="{!! URL::to('/login') !!}" title="Login"><i class="pe-7s-lock"></i>{!! trans("common/label.sign_in_register")!!}</a></li>
                            @endif
                            <li><a href="#" title="Wishlist"><i class="pe-7s-like"></i>{!! trans("common/label.wishlist")!!}</a></li>
                            @if($is_user_login)
                                <li><a href="{!! URL::to('/logout') !!}" title="logout"><i class=""></i>{!! trans("common/label.logout")!!}</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
                <!-- header-top-left-end -->
                <!-- header-top-right-start -->
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <!-- social-icon-start -->
                    <div class="social-icon">
                        <ul>
                            <li><a href="#" data-toggle="tooltip" data-placement="bottom" title="Share on Facebook"><i
                                            class="fa fa-facebook"></i></a></li>
                            <li><a href="#" data-toggle="tooltip" data-placement="bottom" title="Share on Twitter"><i
                                            class="fa fa-twitter"></i></a></li>
                            <li><a href="#" data-toggle="tooltip" data-placement="bottom" title="Email to a Friend"><i
                                            class="fa fa-envelope-o"></i></a></li>
                            <li><a href="#" data-toggle="tooltip" data-placement="bottom" title="Pin on Pinterest"><i
                                            class="fa fa-pinterest"></i></a></li>
                            <li><a href="#" data-toggle="tooltip" data-placement="bottom" title="Share on Google+"><i
                                            class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                    <!-- social-icon-end -->
                    <!-- mini-cart-total-start -->
                    @include('front.layout.cart-recent')
                    <!-- mini-cart-end -->
                </div>
                <!-- header-top-right-end -->
            </div>
        </div>
    </div>
    <!-- header-top-area-end -->
    <!-- header-mid-area-start -->
    <div class="header-mid-area ptb-50">
        <div class="container">
            <div class="row">
                <!-- logo-start -->
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="logo main-logo">
                        <a href="{!! URL::to('/') !!}"><img src="{!! URL::to('/') !!}/images/logo.png" alt="logo"/></a>
                    </div>
                </div>
                <!-- logo-end -->
                <div class="col-lg-8 test col-md-8 col-sm-6 col-xs-12">
                    <!-- header-search-start -->
                    <div class="header-search2">
                        <ul>
                            <li><a href="#"><i class="pe-7s-search open"></i></a>

                                <form action="{!! URL::to('/search') !!}" class="search">
                                    {!! Form::open(array('url' => 'search','class'=>'search')) !!}
                                    {!! Form::text('q','',['placeholder'=>'search here']) !!}
                                    {!! Form::close() !!}
                                </form>
                            </li>
                        </ul>
                    </div>
                    <!-- header-search-end -->
                    <!-- mean-menu-start -->
                    <div class="mean-menu hidden-sm hidden-xs">
                        <nav>
                            <ul>
                                <li><a href="{!! Url('/') !!}">Home</a>

                                </li>
                                <li><a href="{!! Url('product-list') !!}">Catalogue</a>

                                </li>
                                <li><a href="#">Ask a Product</a>

                                </li>
                                <li class="static"><a href="{!! URL::to('/') !!}/blog">Blog</a>
                                </li>
                                <li><a href="{!! URL::to('/') !!}/contact-us">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                    <!-- mean-menu-start -->
                </div>
            </div>
        </div>
    </div>
    <!-- header-mid-area-end -->
    <!-- mobile-menu-area-start -->
    <div class="mobile-menu-area hidden-md hidden-lg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mobile-menu">
                        <nav id="mobile-menu-active">
                            <ul id="nav">
                                <li><a href="index.html">Home</a>
                                    <ul>
                                        <li><a href="index-2.html">Home 2</a></li>
                                        <li><a href="index-3.html">Home 3</a></li>
                                        <li><a href="index-4.html">Home 4</a></li>
                                        <li><a href="index-5.html">Home 5</a></li>
                                        <li><a href="index-6.html">Home 6</a></li>
                                        <li><a href="index-7.html">Home 7</a></li>
                                        <li><a href="index-8.html">Home 8</a></li>
                                        <li><a href="index-9.html">Home 9</a></li>
                                        <li><a href="index-10.html">Home 10</a></li>
                                        <li><a href="index-11.html">Home 11</a></li>
                                        <li><a href="index-12.html">Home 12</a></li>
                                        <li><a href="index-13.html">Home 13</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Shop</a>
                                    <ul>
                                        <li><a href="shop-full-width.html">Shop Full width</a></li>
                                        <li><a href="shop-left-sidebar.html">Shop Left Sidebar</a></li>
                                        <li><a href="shop-right-sidebar.html">Shop Right Sidebar</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Pages</a>
                                    <ul>
                                        <li><a href="#">Portfolio</a>
                                            <ul class="sub-menu sub-menu2 text-left">
                                                <li><a href="portfolio-2.html">Portfolio 2 columns</a></li>
                                                <li><a href="portfolio-3.html">Portfolio 3 columns</a></li>
                                                <li><a href="portfolio-4.html">Portfolio 4 columns</a></li>
                                                <li><a href="portfolio-detail.html">Portfolio detail</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="contact.html">Contact</a></li>
                                        <li><a href="about-us.html">About Us</a></li>
                                        <li><a href="variations-product.html">product details</a></li>
                                        <li><a href="team-testimonials.html">team member</a></li>
                                        <li><a href="my-account.html">My Account</a></li>
                                        <li><a href="faq.html">FAQ Page</a></li>
                                        <li><a href="404.html">404 Page</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Elements</a>
                                    <ul>
                                        <li><a href="product-columns.html">Product Columns</a></li>
                                        <li><a href="products-layout.html">Products Layout</a></li>
                                        <li><a href="product-left-sidebar.html">Product Left Sidebar</a></li>
                                        <li><a href="product-right-sidebar.html">Product Right Sidebar</a></li>
                                        <li><a href="product-full-width.html">Product Full width</a></li>
                                        <li><a href="product-deal.html">Product Deal</a></li>
                                        <li><a href="products-by-category.html">Products – By Category</a></li>
                                        <li><a href="variations-product.html">Variations product</a></li>
                                        <li><a href="variations-product.html">Product featured video</a></li>
                                        <li><a href="variations-product.html">Product image zoom</a></li>
                                        <li><a href="products-best-selling.html">Products – Best Selling</a></li>
                                        <li><a href="products-featured.html">Featured – Hover push</a></li>
                                        <li><a href="products-top-rate.html">Top Rate – Hover flip</a></li>
                                        <li><a href="products-recent.html">Products – Recent</a></li>
                                        <li><a href="products-on-sale.html">Products – On Sale</a></li>
                                        <li><a href="accordion-tabs.html">Accordion / Tabs</a></li>
                                        <li><a href="google-maps.html">Google Maps</a></li>
                                        <li><a href="columns.html">Columns</a></li>
                                        <li><a href="team-testimonials.html">Team & Testimonials</a></li>
                                        <li><a href="lee-banners.html">Lee Banners</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Blog</a>
                                    <ul class="sub-menu">
                                        <li><a href="blog-grid.html">Blog grid</a></li>
                                        <li><a href="blog-left-sidebar.html">Blog Left Sidebar</a></li>
                                        <li><a href="blog-right-sidebar.html">Blog Right Sidebar</a></li>
                                        <li><a href="blog-full-width.html">Blog FullWidth</a></li>
                                        <li><a href="blog-list-style.html">Blog List Style</a></li>
                                    </ul>
                                </li>
                                <li><a href="contact.html">contact</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- mobile-menu-area-end -->
</header>

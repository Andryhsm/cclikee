<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{!! $user->getProfileImage() !!}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{!! $user->first_name !!} {!! $user->last_name !!}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <ul class="sidebar-menu">
            <li class="header">NAVIGATION PRINCIPALE</li>
            @if(check_user_access(['dashboard']))
            <li class="active treeview">
                <a href="{!! route('dashboard') !!}">
                    <i class="fa fa-dashboard"></i> <span>Tableau de bord</span>
                </a>
            </li>
            @endif
            @if(check_user_access(['category','brand.index','attribute','attribute_set','special-product.index','epartner.index', 'product']))
                <li class="treeview {{ set_active(['admin/attribute','admin/attribute/*','admin/attribute-set','admin/attribute-set/*','admin/brand','admin/brand/*','admin/category','admin/category/*','admin/product','admin/product/*']) }}">
                    <a href="#">
                        <i class="fa fa-book"></i>
                        <span>Catalogue</span>
                        <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                    </a>
                    <ul class="treeview-menu">
                         <!-- @if(check_user_access('product'))
                        <li class="{{ set_active(['admin/product','admin/product/*']) }}"><a
                                    href="{!! route('product') !!}"><i class="fa fa-circle-o"></i> Liste des produits</a></li>
                        @endif -->
                        @if(check_user_access('category'))
                        <li class="{{ set_active(['admin/category','admin/category/*']) }}"><a
                                    href="{!! route('category') !!}"><i class="fa fa-circle-o"></i> Gestion des catégories </a>
                        </li>
                        @endif
                        @if(check_user_access('brand.index'))
                        <li class="{{ set_active(['admin/brand','admin/brand/*']) }}"><a
                                    href="{!! URL::to('/') !!}/admin/brand"><i class="fa fa-circle-o"></i> Gestion des marques </a>
                        </li>
                        @endif
                        @if(check_user_access('attribute'))
                        <li class="{{ set_active(['admin/attribute','admin/attribute/*']) }}"><a
                                    href="{!! route('attribute') !!}"><i class="fa fa-circle-o"></i> Attribut </a></li>
                        @endif
                        @if(check_user_access('attribute_set'))
                        <li class="{{ set_active(['admin/attribute-set','admin/attribute-set/*']) }}"><a
                                    href="{!! route('attribute_set') !!}"><i class="fa fa-circle-o"></i> Attribut Set</a>
                        </li>
                        @endif
                    </ul>
                </li>
            @endif
            
            @if(check_user_access(['page.index','email-template.index','coupon','banner.index']))
            <li class="treeview {{ set_active(['admin/page','admin/page/*','admin/banner','admin/banner/*','admin/slider','admin/slider/*','admin/coupon','admin/coupon/*','admin/special-product','admin/special-product/*','admin/faq','admin/faq/*'])}}">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Contenu</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @if(check_user_access('page.index'))
                    <li class="{{ set_active(['admin/page','admin/page/*']) }}"><a
                                href="{!! URL::to('/admin/page') !!}"><i class="fa fa-circle-o"></i> Gestion de page</a>
                    </li>
                    @endif
                    @if(check_user_access(['faq.index', 'faq.create', 'faq.edit']))
                    <li class="treeview {{ set_active(['admin/faq','admin/faq/*']) }}">
                        <a href="{!! url('admin/faq') !!}"><i class="fa fa-circle-o"></i><span> Gestion de FAQ </span></a>
                    </li>
                    @endif
                    <!-- @if(check_user_access('coupon'))
                    <li class="{{ set_active(['admin/coupon','admin/coupon/*']) }}"><a href="{!! route('coupon') !!}"><i
                                    class="fa fa-circle-o"></i> Coupon Manager</a></li>
                    @endif -->
                    @if(check_user_access('banner.index'))
                    <li class="{{ set_active(['admin/slider','admin/slider/*']) }}">
                        <a href="{!! URL::to('/admin/slider') !!}"><i class="fa fa-circle-o"></i> Gestion du slider</a>
                    </li>
                    @endif
                    @if(check_user_access('banner.index'))
                    <li class="{{ set_active(['admin/banner','admin/banner/*']) }}">
                        <a href="{!! URL::to('/admin/banner') !!}"><i class="fa fa-circle-o"></i> Gestion des bannières</a>
                    </li>
                    @endif
                    @if(check_user_access('special-product.index'))
                    <li class="{{ set_active(['admin/special-product','admin/special-product/*']) }}">
                        <a href="{!! URL::to('/admin/special-product') !!}"><i class="fa fa-circle-o"></i> Les produits dans accueil</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif

            <!-- @if(check_user_access(['blog.index','blog-category.index']))
                <li class="treeview {{ set_active(['admin/blog','admin/blog/*','admin/blog-category','admin/blog-category/*']) }}">
                    <a href="#">
                        <i class="fa fa-book"></i>
                        <span>Blog </span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(check_user_access('blog-category.index'))
                            <li class="{{ set_active(['admin/blog-category','admin/blog-category/*']) }}"><a
                                        href="{!! route('blog-category.index') !!}"><i class="fa fa-circle-o"></i> Blog Category</a>
                            </li>
                        @endif
                        @if(check_user_access('blog.index'))
                            <li class="{{ set_active(['admin/blog','admin/blog/*']) }}"><a
                                        href="{!! URL::to('admin/blog') !!}"><i class="fa fa-circle-o"></i> Blog Post</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif -->

            @if(check_user_access(['radio.index']))
            <li class="treeview {{ set_active(['admin/radio','admin/radio/*']) }}">
                <a href="#">
                    <i class="fa fa-exchange"></i>
                    <span>Communications</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <!--@if(check_user_access('product-rating.index'))
                    <li class="{{ set_active(['admin/product-rating','admin/product-rating/*']) }}"><a
                                href="{!! URL::to('/admin/product-rating') !!}"><i class="fa fa-circle-o"></i> Évaluation du produit</a></li>
                    @endif
                    @if(check_user_access('price_adjustment'))
                    <li class="{{ set_active(['admin/claim/price-adjustment','admin/claim/price-adjustment/*']) }}"><a
                                href="{!! route('price_adjustment') !!}"><i class="fa fa-circle-o"></i> Ajustement de prix</a>
                    </li>
                    @endif
                    {{--<li><a href=""><i class="fa fa-circle-o"></i> Product Enhancement</a></li>--}}
                    @if(check_user_access('affiliate.index'))
                    <li class="{{ set_active(['admin/affiliate','admin/affiliate/*']) }}"><a
                                href="{!! URL::to('admin/affiliate') !!}"><i class="fa fa-circle-o"></i> Ajustement de lien</a>
                    </li>
                    @endif-->
                    @if(check_user_access('radio.index'))
                    <li class="{{ set_active(['admin/radio','admin/radio/*']) }}"><a
                                href="{!! URL::to('admin/radio') !!}"><i class="fa fa-circle-o"></i> Gestion des radios </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif

            @if(check_user_access(['customer.index','store.index','administrator','role.index']))
            <li class="treeview {{ set_active(['admin/role','admin/role/*','admin/customer','admin/customer/*','admin/store','admin/store/*','admin/administrator','admin/administrator/*']) }}">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Comptes</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @if(check_user_access('customer.index'))
                    <li class="{{ set_active(['admin/customer','admin/customer/*']) }}"><a
                                href="{!! URL::to('admin/customer') !!}"><i class="fa fa-circle-o"></i> Clients</a>
                    </li>
                    @endif
                    @if(check_user_access('store.index'))
                    <li class="{{ set_active(['admin/store','admin/store/*']) }}"><a
                                href="{!! URL::to('admin/store') !!}"><i class="fa fa-circle-o"></i> Marchands</a>
                    </li>
                    @endif
                    @if(check_user_access('administrator'))
                    <li class="{{ set_active(['admin/administrator','admin/administrator/*']) }}"><a
                                href="{!! URL::to('admin/administrator') !!}"><i class="fa fa-circle-o"></i> Admin system</a>
                    </li>
                    @endif
                    @if(check_user_access('role.index'))
                    <li class="{{ set_active(['admin/role','admin/role/*']) }}"><a href="{!! URL::to('admin/role') !!}"><i
                                    class="fa fa-circle-o"></i> Gestion de rôle</a></li>
                    @endif
                </ul>
            </li>
            @endif

            @if(check_user_access(['orders','order-status.index']))
            <li class="treeview {{ set_active(['admin/order-status','admin/order-status/*','admin/sales/*']) }}">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Ventes</span>
                    <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                      <li class="treeview {{ set_active(['admin/sales/*']) }}">
                        <a href="#">
                            <i class="fa fa-sticky-note-o"></i>
                            <span>Tous les ordres</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            @if(check_user_access('orders'))
                            <li class="{{ set_active(['admin/sales/1','admin/sales/view/1']) }}"><a
                                        href="{!! Url('/admin/sales/1') !!}"><i class="fa fa-circle-o"></i> En cours</a></li>
                            @endif
                            @if(check_user_access('orders'))
                            <li class="{{ set_active(['admin/sales/2','admin/sales/view/2']) }}"><a
                                        href="{!! Url('/admin/sales/2') !!}"><i class="fa fa-circle-o"></i> Terminé</a></li>
                            @endif
                            @if(check_user_access('orders'))
                            <li><a href="{!! Url('/admin/sales/3') !!}"><i class="fa fa-circle-o"></i> Demande spéciale</a></li>
                            @endif
                        </ul>
                    </li>
                    @if(check_user_access('order-status.index'))
                    <li class="{{ set_active(['admin/order-status','admin/order-status/*']) }}">
                        <a href="{!! Url('/admin/order-status') !!}"><i class="fa fa-circle-o"></i>Gestion de statut</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif


            <!-- Produit -->
            <!-- @if(check_user_access(['product']))
            <li class="treeview {{ set_active(['admin/product','admin/product/*','admin/new_page','admin/new_page/*']) }}">
                <a href="#">
                    <i class="fa fa-puzzle-piece"></i>
                    <span>Products</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">

                   

                    @if(check_user_access('product'))
                    <li class="{{ set_active(['admin/new_page','admin/new_page/*']) }}"><a
                                href="{!! URL::to('admin/new_page/page') !!}"><i class="fa fa-circle-o"></i> Training</a></li>
                    @endif
                    
                    @if(check_user_access('product'))
                    <li class="{{ set_active(['admin/new_page','admin/new_page/*']) }}"><a
                                href="{!! URL::to('admin/new_page/page') !!}"><i class="fa fa-circle-o"></i> Control center</a></li>
                    @endif
                </ul>
            </li>
            @endif -->


            <!-- Catalogue -->

       <!--  @if(check_user_access(['product_billed','orders']))
            <li class="treeview {{ set_active(['admin/statistics/sales','admin/statistics/sales/*','admin/finance','admin/finance/*']) }}">
                <a href="#">
                    <i class="fa fa-bar-chart"></i>
                    <span>Statistiques</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @if(check_user_access('orders'))
                        <li class="{{ set_active(['admin/statistics/sales','admin/statistics/sales/*']) }}"><a
                                    href="#"><i class="fa fa-circle-o"></i> Ventes</a>
                        </li>
                    @endif
                    @if(check_user_access('orders'))
                        <li class="{{ set_active(['admin/finance','admin/finance/*']) }}"><a
                                    href="#"><i class="fa fa-circle-o"></i> Finance</a>
                        </li>
                    @endif -->
                    <!-- @if(check_user_access('product_billed'))
                    <li class="{{ set_active(['admin/product-billed','admin/product-billed-detail/*']) }}"><a
                                href="{!! route('product_billed') !!}"><i class="fa fa-circle-o"></i> Product Billed</a>
                    </li>
                    @endif
                    @if(check_user_access('company_account'))
                        <li class="{{ set_active(['admin/invoice','admin/invoice/*']) }}">
                            <a href="{!! url('admin/invoice') !!}"><i class="fa fa-circle-o"></i> Invoices</a>
                        </li>
                    @endif -->
                    <!-- @if(check_user_access('company_account'))
                    <li class="{{ set_active(['admin/company-account','admin/company-account/*']) }}"><a
                                href="{!! route('company_account') !!}"><i class="fa fa-circle-o"></i> Company Accounts</a>
                    </li>
                    @endif -->
                <!-- </ul>
            </li>
            @endif -->
            @if(check_user_access(['accounting_table','accounting_table_reset']))
            <li class="treeview {{ set_active(['admin/accounting']) }}">
                <a href="#">
                    <i class="fa fa-suitcase"></i>
                    <span>Comptabilité</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @if(check_user_access(['accounting_table','accounting_table_reset']))
                        <li class="{{ set_active(['admin/accounting']) }}"><a
                             href="{!! URL::to('/admin/accounting') !!}"> <i class="fa fa-circle-o"></i> Sommes dues aux marchands</a>
                        </li>
                    @endif
                </ul>
            </li>
            @endif
            @if(check_user_access(['email-template.index','update_setting', 'setting_update']))
            <li class="treeview {{ set_active(['admin/system','admin/system/*','admin/meta_og','admin/meta_og/*', 'admin/epartner','admin/epartner/*','admin/email-template','admin/email-template/*']) }}">
                <a href="#">
                    <i class="fa fa-wrench"></i>
                    <span>Système</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @if(check_user_access(['update_setting', 'setting_update']))
                        <li class="{{ set_active(['admin/system','admin/system/*']) }}"><a
                                    href="{!! URL::to('/admin/system') !!}"> <i class="fa fa-circle-o"></i> Meta & OG</a>
                        </li>
                    @endif
                    <!-- @if(check_user_access('email-template.index'))
                        <li class="{{ set_active(['admin/email-template','admin/email-template/*']) }}"><a
                                href="{!! URL::to('/admin/email-template') !!}"><i class="fa fa-circle-o"></i> Email / SMS Modèle</a></li>
                    @endif -->
                </ul>
            </li>
             @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
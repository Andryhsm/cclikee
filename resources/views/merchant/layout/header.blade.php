<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><i class="fa fa-th-list"></i></span>
        <!-- logo for regular state and mobile devices -->
        @foreach(Auth::user()->store as $index=>$stor)
        <!--<span class="logo-lg">
            <img style="max-width: 100px !important;" src="{!! URL::to('/') !!}/upload/logo/{!! $stor->logo !!}"> 
        </span>-->
            <b>{!! $stor->store_name !!}</b>
            {!! Session::put('store_to_user',$stor->store_id); !!}
        @endforeach
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle hidden-lg hidden-md" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        @foreach(Auth::user()->store as $index=>$stor)
                        <img src="{!! URL::to('/') !!}/upload/logo/{!! $stor->logo !!}" class="user-image" alt="User Image">
                        @endforeach
                        <span class="hidden-xs">{!! Auth::User()->first_name !!} {!! Auth::User()->last_name !!}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            @foreach(Auth::user()->store as $index=>$stor)
                            <img src="{!! URL::to('/') !!}/upload/logo/{!! $stor->logo !!}" class="img-circle" alt="User Image">
                             @endforeach
                            <p>
                                {!! Auth::User()->first_name !!} {!! Auth::User()->last_name !!}
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                @foreach(Auth::user()->store as $index=>$stor)
                                <a href="{!! URL::to('/fr/store/'.$stor->store_id.'/edit') !!}" class="btn btn-default btn-flat">Mon compte</a>
                                @endforeach
                            </div>
                            <div class="pull-right">
                                <a href="{!! url('/logout') !!}" class="btn btn-default btn-flat">Déconnexion</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

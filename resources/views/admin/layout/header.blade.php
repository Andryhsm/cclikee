<header class="main-header">
    <!-- Logo -->
    <a href="{!! route('dashboard') !!}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>CLICKEE</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><img style="max-width: 110px !important;" src="{!! url('backend/img/logo.svg') !!}"> </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{!! $user->getProfileImage() !!}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{!! $user->first_name !!} {!! $user->last_name !!}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="{!! $user->getProfileImage() !!}" class="img-circle" alt="User Image">
                            <p>
                                {!! $user->first_name !!} {!! $user->last_name !!}
                                {{--<small>Member since Nov. 2010</small>--}}
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{!! route('profile') !!}" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{!! url('admin/logout') !!}" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

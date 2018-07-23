<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CLICKEE | Client</title>
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    
        <!-- all css here -->
        <!-- bootstrap v3.3.6 css -->
    
        @if($local_dev == "non")
            {!! Html::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css') !!}
            {{-- {!! Html::style('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.css') !!} --}}
        @else
            {!! Html::style('frontend/css/bootstrap.min.css') !!}
            {{-- {!! Html::style('frontend/css/jquery-ui.min.css') !!} --}}
            {!! Html::style('frontend/css/jquery-ui.css') !!}
        @endif
        
        {!! Html::style('frontend/css/bootstrap-dropdownhover.css') !!}
        <!--{!! Html::style('backend/plugins/datepicker/datepicker3.css') !!}-->
        {!! Html::style('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker.min.css') !!}
        {!! Html::style('frontend/css/font-awesome.min.css') !!}
        {!! Html::style('frontend/css/style-clickee.css') !!}
        {!! Html::style('frontend/css/customer.css') !!}
        {!! Html::style('frontend/css/responsive.css') !!}
        {!! Html::style('frontend/css/customer-responsive.css') !!}
        {!! Html::style('https://fonts.googleapis.com/icon?family=Material+Icons') !!}
        <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
         
        @yield('additional-css')
        
        <!-- modernizr css -->
        <script src="{!! URL::to('/') !!}/frontend/js/vendor/modernizr-2.8.3.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/locales/bootstrap-datepicker.fr.min.js"></script>
        
    </head>
    
    <body>
        <div class='container-fluid customer-area'>
            @include('front.customer.layout.header')
            <div class="">
                <div class="aside  col-mm-4 col-lg-4 col-md-4 col-sm-2 col-xs-12" id="aside">
                    @include('front.customer.layout.nav_menu')
                </div>
                <div class="main ajax-content col-mm-8 col-lg-8 col-md-8 col-sm-10 col-xs-12" id="main">
                    @yield('content')
                </div>
            </div>
        </div>
        @include('front.layout.footer')
        @yield('footer-script')
        
        @yield('additional-script')
         <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAYvJI_Ul_xb9kOGHOtHJ9odVD43OcGz0s&callback=initMap" async defer></script>
         <script src="{!! URL::to('/') !!}/frontend/js/customer-area.js"></script>
         <script type="text/javascript">
            // Effet fix du menu gauche 
            //aside_fixed();
            Stripe.setPublishableKey('{!! config('services.stripe.publishable_key') !!}');
            var base_url = {!! "'".URL::to('/')."/'" !!};
            var base_secure_url = {!! "'".URL::to('/', [], true)."/'" !!};
            var language_code = "{!! LaravelLocalization::getCurrentLocale() !!}";
        </script>
    </body>
<!-- END BODY -->
</html>
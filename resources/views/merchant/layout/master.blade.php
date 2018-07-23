<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="_token" content="{{ csrf_token() }}"/>

    <title>CLICKEE | Marchand</title>
    <!-- Tell the browser to be responsive to screen width -->
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    
    @yield('additional-styles')
    {!! Html::style('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker.min.css') !!}
    {!! Html::style('frontend/css/bootstrap.min.css') !!}
    {!! Html::style('https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css') !!}
    {!! Html::style('frontend/css/merchant.css') !!}
    {!! Html::style('frontend/css/style-clickee.css') !!}
    {!! Html::style('frontend/css/customer.css') !!}
    {!! Html::style('frontend/css/responsive.css') !!}
    {!! Html::style('frontend/css/customer-responsive.css') !!}
    {!! Html::style('frontend/css/easy-autocomplete.min.css') !!}
    {{ Html::style('https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css') }}
    {!! Html::style('backend/plugins/bootstrap-datetime-picker/bootstrap-datetimepicker.css') !!}
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <script type="text/javascript">
        var base_url = {!! "'".URL::to('/')."/'" !!};
    </script>


</head>
<body>
   <div class='container-fluid customer-area'>
        <div class="header mt-40">
            <div class="header-container">
                <div class="logo text-center">
                    <a href="{!! URL::to('/') !!}">
                        <img src="{!! URL::to('/') !!}/images/logo.svg" alt="logo clickee"/>
                    </a>
                </div>
                <div class="two-header-section">
                    <div class="section-customer col-mm-4 col-xs-12 col-lg-4 col-md-4 col-sm-4">
                        <div class="header-item">
                            <div class="avatar">
                                <span class="text-uppercase">
                                    <?php 
                                        $t = explode(" ", Auth::user()->store->first()->store_name);
                                        $init = (sizeof($t)>1)?$t[0][0].''.$t[1][0]:$t[0][0].''.$t[0][0];
                                        echo($init);
                                    ?>
                                </span>
                            </div> 
                            <div class="hello-avatar">
                                <div class="text-uppercase text-strong">
                                    <strong>{!! Auth::user()->store->first()->store_name !!}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    @yield('page_title')
                </div>
            </div>
         </div>
        <div class="">
            <div class="aside merchant  col-mm-4 col-lg-4 col-md-4 col-sm-2 col-xs-12" id="aside">
                @include('merchant.layout.sidebar')
            </div>
            <div class="main ajax-content col-mm-8 col-lg-8 col-md-8 col-sm-10 col-xs-12">
                @yield('content')
            </div>
        </div>
    </div>
    <!--@include('front.layout.section-avantage')-->
    <script src="{!! URL::to('/') !!}/frontend/js/vendor/modernizr-2.8.3.min.js"></script>
    @include('front.layout.footer')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

{!! Html::script('backend/bootstrap/js/bootstrap.min.js') !!}
{!! Html::script('backend/dist/js/app.js') !!}
{!! Html::script('js/jquery.validate.min.js') !!}
{!! Html::script('frontend/js/validation.js') !!}
{!! Html::script('backend/plugins/ckeditor/ckeditor.js') !!}
{!! Html::script('backend/js/validation.js') !!}
{!! Html::script('backend/js/jquery.form.js') !!}
{!! Html::script('backend/js/functions.js') !!}
<script type="text/javascript">
    // Effet fix du menu gauche 
    aside_fixed();
    Stripe.setPublishableKey('{!! config('services.stripe.publishable_key') !!}');
    var base_url = {!! "'".URL::to('/')."/'" !!};
    var base_secure_url = {!! "'".URL::to('/', [], true)."/'" !!};
    var language_code = "{!! LaravelLocalization::getCurrentLocale() !!}";  
</script>
@yield('footer-scripts')
@include('merchant.layout.model', ['delete_multiple' => false])
@include('merchant.layout.model', ['delete_multiple' => true])
</body>
</html>
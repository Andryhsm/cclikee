<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    @section("meta-info")
        {!! SEOMeta::generate() !!}
        {!! OpenGraph::generate() !!}
    @show
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('additional-header')
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">

    <!-- all css here -->
    <!-- bootstrap v3.3.6 css -->

@if($local_dev == "non")
     {{-- {!! Html::style('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.css') !!} --}}
    {!! Html::style('https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.css') !!}
    {!! Html::style('https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css') !!}
    {!! Html::style('https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.min.css') !!}
@else
    {{-- {!! Html::style('frontend/css/jquery-ui.min.css') !!} --}}
    {!! Html::style('frontend/css/jquery-ui.css') !!}
    {!! Html::style('frontend/css/owl.carousel.css') !!}
    {!! Html::style('frontend/css/magnific-popup.css') !!}
    {!! Html::style('frontend/css/chosen.min.css') !!}
@endif

{!! Html::style('frontend/css/bootstrap.min.css') !!}
{!! Html::style('frontend/css/animate.css') !!}
{!! Html::style('frontend/css/animate.min.css') !!}
{!! Html::style('frontend/css/bootstrap-dropdownhover.css') !!}
{!! Html::style('frontend/css/meanmenu.min.css') !!}
{!! Html::style('frontend/css/nivo-slider.css') !!}

{!! Html::style('frontend/css/font-awesome.min.css') !!}
{!! Html::style('frontend/css/pe-icon-7-stroke.css') !!}

{!! Html::style('frontend/css/blog.css') !!}
{!! Html::style('frontend/css/flexslider.css') !!}
{!! Html::style('frontend/css/jquery.rating.css') !!}
{!! Html::style('frontend/css/easy-autocomplete.min.css') !!}
{!! Html::style('backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') !!}
{!! Html::style('backend/plugins/bootstrap-datetime-picker/bootstrap-datetimepicker.css') !!}
{!! Html::style('backend/plugins/datepicker/datepicker3.css') !!}
{!! Html::style('frontend/css/style-clickee.css') !!}
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
{!! Html::style('frontend/css/responsive.css') !!}

<script src="https://js.stripe.com/v2/"></script>


@yield('additional-css')

<!-- modernizr css -->
<script src="{!! URL::to('/') !!}/frontend/js/vendor/modernizr-2.8.3.min.js"></script>

<script type="text/javascript">
    Stripe.setPublishableKey('{!! config('services.stripe.publishable_key') !!}');
    var base_url = {!! "'".URL::to('/')."/'" !!};
    var base_secure_url = {!! "'".URL::to('/', [], true)."/'" !!};
    var language_code = "{!! LaravelLocalization::getCurrentLocale() !!}";
</script>
</head>

<body style="padding-right: 0px !important">

@include('front.layout.header')

@yield('content')
@include('front.layout.footer')

@include('front.modals.store-area.choose-area')
@include('front.modals.search_product')

@yield('additional-script')

@yield('footer-script')
<script src="https://apis.google.com/js/platform.js" async defer></script>
<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
</body>
<!-- END BODY -->
</html>
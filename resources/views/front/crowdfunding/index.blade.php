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

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">

    <!-- all css here -->
    <!-- bootstrap v3.3.6 css -->

@if($local_dev == "non")
    {!! Html::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css') !!}
    {{-- {!! Html::style('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.css') !!} --}}
    {!! Html::style('https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.css') !!}
    {!! Html::style('https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css') !!}
    {!! Html::style('https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.min.css') !!}
@else
    {!! Html::style('frontend/css/bootstrap.min.css') !!}
    {{-- {!! Html::style('frontend/css/jquery-ui.min.css') !!} --}}
    {!! Html::style('frontend/css/jquery-ui.css') !!}
    {!! Html::style('frontend/css/owl.carousel.css') !!}
    {!! Html::style('frontend/css/magnific-popup.css') !!}
    {!! Html::style('frontend/css/chosen.min.css') !!}
@endif

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
{!! Html::style('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker.min.css') !!}
{!! Html::style('frontend/css/style-clickee.css') !!}
{!! Html::style('frontend/css/responsive.css') !!}
</head>

<body>
    <div class="container-fluid">
        <div class="logo-crowdfunding text-center">
            <a href="{!! URL::to('/') !!}">
                <img src="{!! URL::to('/') !!}/images/logo.svg" alt="logo clickee"/>
            </a>
        </div>
         <div class="title mt-20">
                <h2>BIENTÔT DANS VOTRE VILLE</h2>
        </div>
        <div class="content-crowdfunding text-center mb-30">
             <div class="col-md-8 mr-b-17 youtube-video mb-50">
                    <?php $video_key = parse_youtube("https://www.youtube.com/watch?v=0G6oasOF3Ug&t=26s");?>
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item"  src="https://www.youtube.com/embed/{!! $video_key !!}"></iframe>
                    </div>
                    <button type="button" onclick="location.href=' https://fr.ulule.com/clickee/';" class="btn btn-clickee-default btn-crowdfunding mb-40">SOUTENEZ-NOUS</button>
            </div>
        </div>
    </div>
</body>
<!-- END BODY -->
</html>
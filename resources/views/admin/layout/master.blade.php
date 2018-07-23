<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="_token" content="{{ csrf_token() }}"/>

    <title>CLICKEE | Admin Panel</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    {!! Html::style('backend/bootstrap/css/bootstrap.min.css') !!}
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    
    {!! Html::style('backend/plugins/select2/select2.css') !!}

    {!! Html::style('backend/dist/css/AdminLTE.min.css') !!}
    {!! Html::style('backend/dist/css/skins/skin-black-light.css') !!}
    {!! Html::style('backend/plugins/iCheck/flat/blue.css') !!}
    {!! Html::style('backend/css/style.css') !!}
    {!! Html::style('backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') !!}
    {!! Html::style('backend/plugins/redactor/redactor.css') !!}
    {!! Html::style('backend/plugins/redactor/plugins/alignment/alignment.css') !!}
    {!! Html::style('backend/plugins/redactor/plugins/clips/clips.css') !!}

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('additional-styles')

    <script type="text/javascript">
        var base_url = {!! "'".URL::to('/')."/'" !!};
    </script>


</head>     
<body class="hold-transition skin-black-light sidebar-mini">
<div class="wrapper">

    <!-- header part -->
@include('admin.layout.header')

<!-- Left side column. contains the logo and sidebar -->
@include('admin.layout.sidebar')

<!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper">
    @yield('content')
    </div>
    <!-- footer -->
    @include('admin.layout.sidebar')

</div>
<!-- ./wrapper -->

{!! Html::script('backend/plugins/jQuery/jquery-2.2.3.min.js') !!}
@if(Route::current()->getName()!='category')
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
@endif
{!! Html::script('backend/bootstrap/js/bootstrap.min.js') !!}
{!! Html::script('backend/dist/js/app.js') !!}
{!! Html::script('js/jquery.validate.min.js') !!}
{{--
{!! Html::script('backend/plugins/redactor/redactor.js') !!}
{!! Html::script('backend/plugins/redactor/plugins/alignment/alignment.js') !!}
{!! Html::script('backend/plugins/redactor/plugins/clips/clips.js') !!}
{!! Html::script('backend/plugins/redactor/plugins/codemirror/codemirror.js') !!}
{!! Html::script('backend/plugins/redactor/plugins/counter/counter.js') !!}
{!! Html::script('backend/plugins/redactor/plugins/definedlinks/definedlinks.js') !!}
{!! Html::script('backend/plugins/redactor/plugins/filemanager/filemanager.js') !!}
{!! Html::script('backend/plugins/redactor/plugins/fontcolor/fontcolor.js') !!}
{!! Html::script('backend/plugins/redactor/plugins/fontfamily/fontfamily.js') !!}
{!! Html::script('backend/plugins/redactor/plugins/fontsize/fontsize.js') !!}
{!! Html::script('backend/plugins/redactor/plugins/fullscreen/fullscreen.js') !!}
{!! Html::script('backend/plugins/redactor/plugins/imagemanager/imagemanager.js') !!}
{!! Html::script('backend/plugins/redactor/plugins/inlinestyle/inlinestyle.js') !!}
{!! Html::script('backend/plugins/redactor/plugins/limiter/limiter.js') !!}
{!! Html::script('backend/plugins/redactor/plugins/properties/properties.js') !!}
{!! Html::script('backend/plugins/redactor/plugins/source/source.js') !!}
{!! Html::script('backend/plugins/redactor/plugins/table/table.js') !!}
{!! Html::script('backend/plugins/redactor/plugins/textdirection/textdirection.js') !!}
{!! Html::script('backend/plugins/redactor/plugins/textexpander/textexpander.js') !!}
{!! Html::script('backend/plugins/redactor/plugins/video/video.js') !!}
--}}
{!! Html::script('backend/plugins/ckeditor/ckeditor.js') !!}
{!! Html::script('backend/js/validation.js') !!}
{!! Html::script('backend/js/jquery.form.js') !!}
{!! Html::script('backend/js/functions.js') !!}


@yield('additional-scripts')
@yield('footer-scripts')
@include('admin.layout.model')
</body>
</html>

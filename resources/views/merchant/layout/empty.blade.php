<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ALTERNATEEVE | Admin Panel</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    {!! Html::style('backend/bootstrap/css/bootstrap.min.css') !!}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
{!! Html::style('backend/dist/css/AdminLTE.min.css') !!}
{!! Html::style('backend/dist/css/skins/skin-black.min.css') !!}
{!! Html::style('backend/plugins/iCheck/flat/blue.css') !!}
{!! Html::style('backend/css/style.css') !!}
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition login-page">
    @yield('content')
</div>

{!! Html::script('backend/plugins/jQuery/jquery-2.2.3.min.js') !!}
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
{!! Html::script('backend/bootstrap/js/bootstrap.min.js') !!}
{!! Html::script('backend/plugins/iCheck/icheck.min.js') !!}
{!! Html::script('js/jquery.validate.min.js') !!}
{!! Html::script('backend/js/validation.js') !!}

<script>
</script>
</body>
</html>

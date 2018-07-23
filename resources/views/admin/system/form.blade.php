@extends($layout)

@section('content')
    <section class="content-header">
        <h1>
            System Settings
        </h1>
    </section>

    <section class="content">
        @include('admin.layout.notification')
        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="hidden"><a href="#tab_1" data-toggle="tab">English</a></li>
                        <li class="active"><a href="#tab_2" data-toggle="tab">Meta & OG</a></li>
                    </ul>
                    {!! Form::open(['url' => Url("admin/system"), 'class' => 'form-horizontal','id' =>'setting_form']) !!}
                    <div class="tab-content">
                        <div class="tab-pane hidden" id="tab_1">
                            <section class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box-body">
                                            @foreach($english_settings as $english_setting)
                                                <div class="form-group">
                                                    {!! Form::label($english_setting->name, $english_setting->name, ['class' => 'col-sm-2 control-label']) !!}
                                                    <div class="col-sm-10">
                                                        {!! Form::text("setting[1][$english_setting->name]", $english_setting->value, ['class' => 'form-control required','id'=>'en_product_name']) !!}
                                                    </div>
                                                </div>
                                             @endforeach
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="tab-pane active" id="tab_2">
                            <section class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box-body">
                                            @foreach($french_settings as $french_setting)
                                                <div class="form-group">
                                                    {!! Form::label($french_setting->name, $french_setting->name, ['class' => 'col-sm-2 control-label']) !!}
                                                    <div class="col-sm-10">
                                                        {!! Form::text("setting[2][$french_setting->name]", $french_setting->value, ['class' => 'form-control required','id'=>'en_product_name']) !!}
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary pull-right" id="add-product">Update</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

    </section>
@stop

@section('additional-styles')
@stop

@section('additional-scripts')
@stop

@section('footer-scripts')
    <script type="application/javascript" language="JavaScript">
    </script>

@stop

@extends($layout)
@section('content')
    <section class="content-header">
        <h1>
            @if($radio)
                Mise à jour radio
            @else
                Nouvelle radio
            @endif
        </h1>
    </section>
    <section class="content">
        @include('admin.layout.notification')

        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    {!! Form::open(['url' => ($radio) ? Url("admin/radio/$radio->radio_id") :  route("radio.store"), 'class' => '','id' =>'radio_form','method'=>($radio)?'PATCH':'POST']) !!}
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('name', 'Nom', ['class' => '']) !!}
                            {!! Form::text('name', ($radio)? $radio->name:null, ['class' => 'form-control','id'=>'name','placeholder'=>"Nom"]) !!}
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('url', 'Url', ['class' => '']) !!}
                            {!! Form::text('url', ($radio)? $radio->url:null, ['class' => 'form-control','id'=>'url','placeholder'=>"Url"]) !!}
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('zip', 'Code postal', ['class' => '']) !!}
                            {!! Form::text('zip', ($radio)? $radio->zip:null, ['class' => 'form-control','id'=>'zip','placeholder'=>"Zip"]) !!}
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="{!! route('radio.index') !!}" class="btn btn-default">Annuler</a>
                        <button type="submit" class="btn btn-primary pull-right" id="add-radio">Enregistrer
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@stop
@section('footer-scripts')
    <script type="text/javascript" language="JavaScript">
        $(document).ready(function($) {
            $('#add-radio').click(function () {
                $('#radio_form').validate({
                    rules: {
                        name: {
                            required: true
                        },
                        zip: {
                            required: true
                        },
                        url: {
                            required: true
                        }
                    },
                    errorPlacement: function (error, element) {
                        return error.insertAfter(element);
                    }
                });
                if ($('#radio_form').valid()) {
                    $('#radio_form').submit();
                }
            });
        });

    </script>
@stop
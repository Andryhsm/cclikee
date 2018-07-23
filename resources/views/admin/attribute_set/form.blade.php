@extends($layout)
@section('content')
    <section class="content-header">
        <h1>
            @if($attribute_set)
                Modifier un Attribut Set
            @else
                Ajouter un nouveau Attribut Set
            @endif
        </h1>
    </section>
    <?php
    $selected_attribute = [];
    if ($attribute_set && count($attribute_set->attributes) > 0) {
        foreach ($attribute_set->attributes as $attribute) {
            $selected_attribute[] = $attribute->attribute_id;
        }
    }
    ?>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    {!! Form::open(['url' => ($attribute_set) ? Url("admin/attribute-set/$attribute_set->attribute_set_id") :  route('save_attribute_set'), 'class' => '','id' =>'attribute_set_form']) !!}
                    <form role="form" method="post" action="/">
                        <div class="box-body">
                            <div class="form-group">
                                {!! Form::label('attribute_set_name', "Nom de l'attribut set", ['class' => '']) !!}
                                {!! Form::text('attribute_set_name', ($attribute_set)? $attribute_set->set_name:null, ['class' => 'form-control required','id'=>'attribute_set_name','placeholder'=>"Nom de l'attribut set"]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('attribute', 'Attribut', ['class' => '']) !!}
                                {!! Form::select('attributes[]', $attributes,$selected_attribute, ['class' => 'form-control required','id'=>'attribute','multiple'=>true]) !!}
                            </div>
                        </div>
                        <div class="box-footer">
                            <a href="{!! route('attribute_set') !!}" class="btn btn-default">Annuler</a>
                            <button type="submit" class="btn btn-primary pull-right" id="add-attribute-set">Sauvergarder
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@stop
@section('footer-scripts')
    {!! Html::script('backend/js/attribute_set.js') !!}
@stop
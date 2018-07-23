@extends($layout)

@section('additional-styles')
    {!! Html::style('backend/plugins/datatables/dataTables.bootstrap.css') !!}
    {!! Html::style('backend/plugins/colorpicker/bootstrap-colorpicker.css') !!}
@stop
@section('content')
    <section class="content-header">
        <h1>
            Liste des Attributs Sets
        </h1>
        <div class="header-btn">
            <div class="clearfix">
                <div class="btn-group inline pull-left">
                    <div class="btn btn-small">
                        <a href="{!! route('create_attribute_set') !!}" class="btn btn-block btn-primary">Nouveau Attribute Set</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        @include('admin.layout.notification')
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Nom de l'Attribute Set</th>
                                <th>Attribut</th>
                                <th>Créé par</th>
                                <th class="no-sort">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($attribute_sets->data as $attribute_set)
                                    <tr>
                                        <td>{!! $attribute_set->set_name !!}</td>
                                        <td>
                                            @foreach($attribute_set->attributes as $attribute)
                                                <span class="badge bg-green mr-5">{!! $attribute->french->attribute_name !!}</span>
                                            @endforeach
                                        </td>
                                        <td>{{-- {!! $attribute_set->admin->first_name.' '.$attribute_set->admin->last_name !!} --}}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{!! Url("admin/attribute-set/edit/$attribute_set->attribute_set_id") !!}"
                                                   class="btn btn-default btn-sm" title="Edit"><i
                                                            class="fa fa-fw fa-edit"></i></a>
                                                {!! Form::open(array('url' => 'admin/attribute-set/' . $attribute_set->attribute_set_id, 'class' => 'pull-right')) !!}
                                                {!! Form::hidden('_method', 'SUPPRIMER') !!}
                                                {!! Form::button('<i class="fa fa-fw fa-trash"></i>', ['type' => 'submit', 'class' => 'btn delete-btn btn-default btn-sm','title'=>'Delete'] ) !!}
                                                {{ Form::close() }}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>


@stop

@section('additional-scripts')
    {!! Html::script('backend/plugins/datatables/jquery.dataTables.js') !!}
    {!! Html::script('backend/plugins/datatables/dataTables.bootstrap.min.js') !!}
    {!! Html::script('backend/plugins/colorpicker/bootstrap-colorpicker.js') !!}
    {!! Html::script('backend/js/attribute_set.js') !!}
@stop
@section('footer-scripts')
@stop

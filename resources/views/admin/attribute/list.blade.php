    @extends($layout)

@section('additional-styles')
    {!! Html::style('backend/plugins/datatables/dataTables.bootstrap.css') !!}
    {!! Html::style('backend/plugins/colorpicker/bootstrap-colorpicker.css') !!}
@stop
@section('content')
    <section class="content-header">
        <h1>
            Liste des attributs
        </h1>
        <div class="header-btn">
            <div class="clearfix">
                <div class="btn-group inline pull-left">
                    <div class="btn btn-small">
                        <a href="{!! route('create_attribute') !!}" class="btn btn-block btn-primary">Nouveau attribut</a>
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
                                <th>Nom de l'attribut</th>
                                <th>Type</th>
                                <th>Créé par</th>
                                <th class="no-sort">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($attributes->data as $attribute)
                                    <tr>
                                        <td>{!! (!empty($attribute->french)) ? $attribute->french->attribute_name: null !!}</td>
                                        <td>{!! $attribute->type=='1'?'Color':'Select Box' !!}</td>
                                         
                                        @if(isset($attribute->admin->first_name))
                                           <td>{!! $attribute->admin->first_name.' '.$attribute->admin->last_name !!}</td>
                                        @else
                                           <td></td>
                                        @endif
                                        <td>
                                            <div class="btn-group">
                                                <a href="{!! url("admin/attribute/edit/$attribute->attribute_id") !!}" class="btn btn-default btn-sm" title="Edit"><i
                                                            class="fa fa-fw fa-edit"></i></a>
                                                {!! Form::open(array('url' => 'admin/attribute/' . $attribute->attribute_id, 'class' => 'pull-right')) !!}
                                                {!! Form::hidden('_method', 'DELETE') !!}
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
    {!! Html::script('backend/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('backend/plugins/datatables/dataTables.bootstrap.min.js') !!}
    {!! Html::script('backend/plugins/colorpicker/bootstrap-colorpicker.js') !!}
    {!! Html::script('backend/js/attribute.js') !!}
@stop
@section('footer-scripts')
@stop

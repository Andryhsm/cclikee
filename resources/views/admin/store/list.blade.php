@extends($layout)

@section('additional-styles')
    {!! Html::style('backend/plugins/datatables/dataTables.bootstrap.css') !!}
    {!! Html::style('backend/plugins/colorpicker/bootstrap-colorpicker.css') !!}
@stop
@section('content')
    <section class="content-header">
        <h1>
            Tous les magasins
        </h1>
        <div class="header-btn">
            <div class="clearfix">
                <div class="btn-group inline pull-left">
                    <div class="btn btn-small">
                        <a href="{!! url('admin/store/create') !!}" class="btn btn-block btn-primary">Nouveau magasin</a>
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
                                <th>Nom du magasin</th>
                                <th>Numero Reg.</th>
                                <th>Téléphone</th>
                                <th>Email</th>
                                <th>Ville</th>
                                <th class="no-sort">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($stores->data as $store)
                                <tr>
                                    <td>{!! $store->store_name!!}</td>
                                    <td>
                                        {!! $store->registration_number!!}
                                    </td>
                                    <td>{!! $store->phone !!}</td>
                                    <td>{!! $store->email !!}</td>
                                    <td>{!! $store->city !!}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{!! Url("admin/store/$store->store_id/edit") !!}"
                                               class="btn btn-default btn-sm" title="Edit"><i
                                                        class="fa fa-fw fa-edit"></i></a>
                                            {!! Form::open(array('url' => 'admin/store/' . $store->store_id, 'class' => 'pull-right')) !!}
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
    {!! Html::script('backend/plugins/datatables/jquery.dataTables.js') !!}
    {!! Html::script('backend/plugins/datatables/dataTables.bootstrap.min.js') !!}
    {!! Html::script('backend/plugins/colorpicker/bootstrap-colorpicker.js') !!}
    {!! Html::script('backend/js/store.js') !!}
@stop
@section('footer-scripts')
@stop

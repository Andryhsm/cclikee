@extends($layout)

@section('additional-styles')
    {!! Html::style('backend/plugins/datatables/dataTables.bootstrap.css') !!}
@stop
@section('content')
    <section class="content-header">
        <h1>
            Filiale
        </h1>
        <div class="header-btn">
            <div class="clearfix">
                <div class="btn-group inline pull-left">
                    <div class="btn btn-small">
                        <a href="{!! URL::to('admin/affiliate/create'); !!}" class="btn btn-block btn-primary">Nouveau lien</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        @include('notification')
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Ajustement de lien</h3>
                    </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Nom du client</th>
                                <th>Lien</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($links as $link)
                            <tr>
                                <td>{{ $link->user->first_name." ".$link->user->last_name }}</td>
                                <td>{{ $link->link }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ URL::to('admin/affiliate/' . $link->link_adjustment_id . '/edit') }}"
                                           class="btn btn-default btn-sm" title="Edit"><i
                                                    class="fa fa-fw fa-edit"></i></a>
                                        {!! Form::open(array('url' => 'admin/affiliate/' . $link->link_adjustment_id,
                                        'class' => 'pull-right')) !!}
                                        {!! Form::hidden('_method', 'SUPPRIMER') !!}
                                        {!! Form::button('<i class="fa fa-fw fa-trash"></i>', ['type' => 'submit',
                                        'class' => 'btn delete-btn btn-default btn-sm'] ) !!}
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
@stop
@section('footer-scripts')
    {!! Html::script('backend/js/link_adjustment.js') !!}
@stop

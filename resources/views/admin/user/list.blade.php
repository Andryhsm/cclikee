@extends($layout)

@section('additional-styles')
    {!! Html::style('backend/plugins/datatables/dataTables.bootstrap.css') !!}
@stop
@section('content')
    <section class="content-header">
        <h1>
            Gestion de compte
        </h1>
        <div class="header-btn">
            <div class="clearfix">
                <div class="btn-group inline pull-left">
                    <div class="btn btn-small">
                        <a href="{!! URL::to('/admin/'.$type.'/create') !!}" class="btn btn-block btn-primary">Nouveau compte</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Email</th>
                                <th>Statut</th>
                                <th>Rôle</th>
                                <th class="no-sort">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{!! $user->first_name !!}</td>
                                    <td>{!! $user->last_name !!}</td>
                                    <td>{!! $user->email !!}</td>
                                    <td>
                                        @if($user->status=='1')
                                            <span class="badge bg-green">Actif</span>
                                        @else
                                            <span class="badge bg-light-blue">Inactif</span>
                                        @endif
                                    </td>
                                    <td><span class="label label-success">{!! $user->role->role_name !!}</span></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ URL::to('admin/'.$type.'/' . $user->user_id . '/edit') }}"
                                               class="btn btn-default btn-sm" title="Edit"><i
                                                        class="fa fa-fw fa-edit"></i></a>
                                            {!! Form::open(array('url' => 'admin/'.$type .'/'. $user->user_id, 'class' => 'pull-right')) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::button('<i class="fa fa-fw fa-trash"></i>', ['type' => 'submit', 'class' => 'btn delete-btn btn-default btn-sm','title'=>'Supprimer'] ) !!}
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
    {!! Html::script('backend/js/account.js') !!}
@stop

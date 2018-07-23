@extends($layout)

@section('additional-styles')
    {!! Html::style('backend/plugins/datatables/dataTables.bootstrap.css') !!}
@stop
@section('content')
    <section class="content-header">
        <h1>
            Gestion de contenu
            <small>Page</small>
        </h1>
        <div class="header-btn">
            <div class="clearfix">
                <div class="btn-group inline pull-left">
                    <div class="btn btn-small">
                        <a href="{!! URL::to('/') !!}/admin/page/create" class="btn btn-block btn-primary">Nouvelle page</a>
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
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Titre de la page</th>
                                <th>En-tête de contenu</th>
                                <th>Status</th>
                                <th class="no-sort">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($pages->data as $page)
                                    <tr>
                                        <td>{!! $page->french->page_title !!}</td>
                                        <td>{!! $page->french->content_heading !!}</td>
                                        <td>
                                            @if($page->status==1)
                                                <span class="badge bg-green">Active</span>
                                            @else
                                                <span class="badge bg-light-blue">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ URL::to('admin/page/' . $page->page_id . '/edit') }}"
                                                   class="btn btn-default btn-sm" title="Edit"><i
                                                            class="fa fa-fw fa-edit"></i></a>
                                                {!! Form::open(array('url' => 'admin/page/' . $page->page_id, 'class' => 'pull-right')) !!}
                                                {!! Form::hidden('_method', 'DELETE') !!}
                                                {!! Form::button('<i class="fa fa-fw fa-trash"></i>', ['type' => 'submit', 'class' => 'btn delete-btn btn-default btn-sm'] ) !!}
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


    <div class="modal fade" id="search-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Rechercher Page</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="/">
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Titre de la page</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">En-tête de contenu</label>
                            <input type="text" class="form-control" id="content-heading">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary">Rechercher</button>
                </div>
            </div>
        </div>
    </div>


@stop

@section('additional-scripts')
    {!! Html::script('backend/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('backend/plugins/datatables/dataTables.bootstrap.min.js') !!}
@stop
@section('footer-scripts')
    {!! Html::script('backend/js/page.js') !!}

@stop

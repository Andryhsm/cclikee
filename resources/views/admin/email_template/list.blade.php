@extends($layout)

@section('additional-styles')
    {!! Html::style('backend/plugins/datatables/dataTables.bootstrap.css') !!}
@stop
@section('content')
    <section class="content-header">
        <h1>
            Email Template
        </h1>
        <div class="header-btn">
            <div class="clearfix">
                <div class="btn-group inline pull-left">
                    <div class="btn btn-small">
                        <a href="{!! URL::to('/admin/email-template/create') !!}" class="btn btn-block btn-primary">Add
                            New Template</a>
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
                                <th>Template Name</th>
                                <th>Subject</th>
                                <th class="no-sort">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($email_templates->data as $template)
                                    <tr>
                                        <td>{!! $template->template_name !!}</td>
                                        <td>{!! $template->english->subject !!}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ URL::to('admin/email-template/' . $template->email_template_id . '/edit') }}"
                                                   class="btn btn-default btn-sm" title="Edit"><i
                                                            class="fa fa-fw fa-edit"></i></a>
                                                {!! Form::open(array('url' => 'admin/email-template/' . $template->email_template_id, 'class' => 'pull-right')) !!}
                                                {!! Form::hidden('_method', 'DELETE') !!}
                                                {!! Form::button('<i class="fa fa-fw fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-default delete-btn btn-sm'] ) !!}
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
    {!! Html::script('backend/js/email_template.js') !!}

@stop

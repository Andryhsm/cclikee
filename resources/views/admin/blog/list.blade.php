@extends($layout)

@section('additional-styles')
    {!! Html::style('backend/plugins/datatables/dataTables.bootstrap.css') !!}
    {!! Html::style('backend/plugins/colorpicker/bootstrap-colorpicker.css') !!}
@stop
@section('content')
    <section class="content-header">
        <h1>
            All Blog Post
        </h1>
        <div class="header-btn">
            <div class="clearfix">
                <div class="btn-group inline pull-left">
                    <div class="btn btn-small">
                        <a href="{!! route('blog.create') !!}" class="btn btn-block btn-primary">Add New
                            Blog Post</a>
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
                                <th>Title</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Is Popular</th>
                                <th>Created By</th>
                                <th class="no-sort">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts->data as $post)
                                <tr>
                                    <td>{!! $post->english_title !!}</td>
                                    <td>{!! ($post->category != null) ? $post->category->english_name : '' !!}</td>
                                    <td>
                                        @if($post->is_active == '1')
                                            <span class="badge bg-green mr-5">Active</span>
                                        @else
                                            <span class="badge bg-red mr-5">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($post->is_popular == '1')
                                            <span class="badge bg-green mr-5">Yes</span>
                                        @else
                                            <span class="badge bg-red mr-5">No</span>
                                        @endif
                                    </td>

                                    <td>{!! $post->admin->first_name.' '.$post->admin->last_name !!}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{!! Url("admin/blog/$post->blog_post_id/edit") !!}"
                                               class="btn btn-default btn-sm" title="Edit"><i
                                                        class="fa fa-fw fa-edit"></i></a>
                                            {!! Form::open(array('url' => 'admin/blog/' . $post->blog_post_id, 'class' => 'pull-right')) !!}
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
    {!! Html::script('backend/js/blog_post.js') !!}
@stop
@section('footer-scripts')
@stop

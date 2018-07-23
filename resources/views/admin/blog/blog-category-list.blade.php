@extends($layout)

@section('additional-styles')
    {!! Html::style('backend/plugins/datatables/dataTables.bootstrap.css') !!}
    {!! Html::style('backend/plugins/colorpicker/bootstrap-colorpicker.css') !!}
@stop
@section('content')
    <section class="content-header">
        <h1>
            All Blog Category
        </h1>
        <div class="header-btn">
            <div class="clearfix">
                <div class="btn-group inline pull-left">
                    <div class="btn btn-small">
                        <a href="{!! route('blog-category.create') !!}" class="btn btn-block btn-primary">Add New
                            Blog Category</a>
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
                                <th>Category Name</th>
                                <th>Status</th>
                                <th>Created By</th>
                                <th class="no-sort">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($blog_categories->data as $category)
                                <tr>
                                    <td>{!! $category->english_name !!}</td>
                                    <td>

                                        @if($category->is_active == '1')
                                            <span class="badge bg-green mr-5">Active</span>
                                        @else
                                            <span class="badge bg-red mr-5">Inactive</span>
                                        @endif
                                    </td>
                                    <td>{!! $category->admin->first_name.' '.$category->admin->last_name !!}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{!! Url("admin/blog-category/$category->blog_category_id/edit") !!}"
                                               class="btn btn-default btn-sm" title="Edit"><i
                                                        class="fa fa-fw fa-edit"></i></a>
                                            {!! Form::open(array('url' => 'admin/blog-category/' . $category->blog_category_id, 'class' => 'pull-right')) !!}
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
    {!! Html::script('backend/js/blog_category.js') !!}
@stop
@section('footer-scripts')
@stop

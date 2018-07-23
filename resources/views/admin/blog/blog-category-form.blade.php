@extends($layout)
@section('content')
    <section class="content-header">
        <h1>
            @if($category)
                Update Blog Category
            @else
                Add Blog Category
            @endif
        </h1>
    </section>
    <section class="content">
        @include('admin.layout.notification')

        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    {!! Form::open(['url' => ($category) ? Url("admin/blog-category/$category->blog_category_id") :  route("blog-category.store"), 'class' => '','id' =>'blog_category_form','method'=>($category)?'PATCH':'POST']) !!}
                        <div class="box-body">
                            <div class="form-group">
                                {!! Form::label('english_name', 'Category Name (English)', ['class' => '']) !!}
                                {!! Form::text('english_name', ($category)? $category->english_name:null, ['class' => 'form-control required','id'=>'english_name','placeholder'=>"Category Name (English)"]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('french_name', 'Category Name (French)', ['class' => '']) !!}
                                {!! Form::text('french_name', ($category)? $category->french_name:null, ['class' => 'form-control','id'=>'french_name','placeholder'=>"Category Name (French)"]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('is_active', 'Is Active', ['class' => 'col-sm-1 control-label']) !!}
                                <div class="col-sm-10">
                                    {!! Form::checkbox('is_active', '1',($category && $category->is_active=='1') ? true: false) !!}
                                </div>
                            </div>
                            <div class="form-group" style="clear: both">
                                {!! Form::label('is_home_page', 'Show On Home Page', ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-10">
                                    {!! Form::checkbox('is_home_page', '1',($category && $category->is_home_page=='1') ? true: false) !!}
                                </div>
                            </div>

                        </div>
                        <div class="box-footer">
                            <a href="{!! route('blog-category.index') !!}" class="btn btn-default">Cancel</a>
                            <button type="submit" class="btn btn-primary pull-right" id="add-blog-category">Save
                            </button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@stop
@section('footer-scripts')
    {!! Html::script('backend/js/blog_category.js') !!}
@stop
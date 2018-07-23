@extends($layout)
@section('content')
    <section class="content-header">
        <h1>
            @if($post)
                Update Blog Post
            @else
                Add Blog Post
            @endif
        </h1>
    </section>
    <section class="content">
        @include('admin.layout.notification')

        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">General</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Related Post</a></li>
                        <li><a href="#tab_3" data-toggle="tab">Meta Info</a></li>
                    </ul>

                    <div class="">
                        {!! Form::open(['url' => ($post) ? Url("admin/blog/$post->blog_post_id") :  route("blog.store"), 'class' => '','id' =>'blog_post_form','files' => true,'method' => ($post)?'PATCH':'POST']) !!}
                        <div class="box-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">



                                <div class="form-group">
                                    {!! Form::label('english_title', 'Title (English)', ['class' => '']) !!}
                                    {!! Form::text('english_title', ($post)? $post->english_title:null, ['class' => 'form-control required','id'=>'english_title','placeholder'=>"Title(English)"]) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('french_title', 'Title (French)', ['class' => '']) !!}
                                    {!! Form::text('french_title', ($post)? $post->french_title:null, ['class' => 'form-control','id'=>'french_title','placeholder'=>"Title(French)"]) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('url', 'URL', ['class' => '']) !!}
                                    {!! Form::text('url', ($post && !empty($post->url))? $post->url->request_url:null, ['class' => 'form-control','id'=>'url_key','placeholder'=>"URL"]) !!}
                                    <input type="hidden" name="url_id" value="{!! ($post && !empty($post->url))?$post->url->sys_url_rewrite_id : '' !!}">
                                </div>

                                <div class="form-group">
                                    {!! Form::label('publish_date', 'Publish Date', ['class' => '']) !!}
                                    {!! Form::text('publish_date', ($post && !empty($post->publish_date))? $post->publish_date:null, ['class' => 'form-control','id'=>'datepicker']) !!}
                                </div>


                                    <div class="form-group">
                                    <label for="article">Article (English)</label>
                                    <textarea class="textarea" name="english_article" id="english_article" placeholder="Article (English)"
                                              style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                        @if($post)
                                            {!! $post->english_article !!}
                                        @endif
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="article">Article (French)</label>
                                    <textarea class="textarea" name="french_article" id="french_article" placeholder="Article (French)"
                                              style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                        @if($post)
                                               {!! $post->french_article !!}
                                         @endif
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <div class="form-group tag-autocomplete">
                                        {!! Form::label('blog_tag', 'Blog Tag', ['class' => 'col-sm-5 control-label']) !!}
                                        <div class="">
                                                <span class="search-box-container">
                                                    <span class="search-box">
                                                        <ul>
                                                            <?php $blog_tags = [] ?>
                                                            @if($post && count($post->tags) > 0)
                                                                @foreach($post->tags as $tag)
                                                                    <?php $blog_tags[] = $tag->blog_tag_id ?>
                                                                    <li class="search-choice" id="{!! $tag->blog_tag_id !!}"><span class="search-box-remove">×</span>{!! $tag->tag_name !!}</li>
                                                                @endforeach
                                                            @endif

                                                            <li class="search-input"><input class="form-control auto-complete"></li>
                                                        </ul>
                                                    </span>
                                                </span>
                                        </div>
                                        <input type="hidden" name="blog_tag" value="{!! implode(',',$blog_tags) !!}" class="blog_tag">
                                    </div>

                                </div>

                                <div class="form-group">
                                    {!! Form::label('blog_category', 'Blog Category', ['class' => 'col-sm-4 control-label']) !!}
                                    {!! Form::select('blog_category', $blog_categories,($post) ? $post->blog_category_id:null,['class'=>'form-control required']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('blog_image', 'Blog Image', ['class' => 'col-sm-4 control-label']) !!}
                                        {!!  Form::file('blog_image',['class'=>"form-control"])!!}
                                        @if($post)
                                            <div class="col-sm-10">
                                            {{ Form::image('upload/blog/'.$post->banner_image, null, ['class' => 'brand-image'])}}
                                            </div>
                                        @endif
                                </div>
                                <div class="form-group" style="clear: both">
                                    {!! Form::label('is_active', 'Is Active', ['class' => 'col-sm-1 control-label']) !!}
                                    <div class="col-sm-10">
                                        {!! Form::checkbox('is_active', '1',($post && $post->is_active=='1') ? true: false) !!}
                                    </div>
                                </div>
                                <div class="form-group" style="clear: both">
                                    {!! Form::label('is_popular', 'Is Popular', ['class' => 'col-sm-1 control-label']) !!}
                                    <div class="col-sm-10">
                                        {!! Form::checkbox('is_popular', '1',($post && $post->is_active=='1') ? true: false) !!}
                                    </div>
                                </div>
                            </div>

                                <div class="tab-pane" id="tab_2">
                                    <div class="form-group">
                                        {!! Form::label('select_post', 'Select Post', ['class' => 'col-sm-2 control-label']) !!}</label>
                                        {!! Form::text('select_post','' , ['class' => 'form-control related-post-input','id'=>'select_post','placeholder'=>"Select Post"]) !!}
                                    </div>

                                    <div class="col-md-12">
                                        <div class="box box-solid">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Related Post</h3>
                                            </div>
                                            <div class="box-body" id="releated_post_container">
                                                @if($post && $post->relatedPosts)
                                                    @foreach($post->relatedPosts as $related_post)
                                                        <p>{!! $related_post->english_title !!}
                                                            <span title="Delete" class="remove_post"><i class="fa fa-fw fa-trash-o"></i></span>
                                                            <input type="hidden" name="related_post[]" value="{!! $related_post->blog_post_id !!}">
                                                        </p>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="tab-pane" id="tab_3">
                                    <div class="form-group">
                                        {!! Form::label('en_title', "Title (English)", ['class' => 'col-sm-2 control-label']) !!}
                                        {!! Form::text("en_title", ($post)? $post->en_meta_title : null , ['class' => 'form-control','id'=>'en_title','placeholder'=>"Title (English)"]) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('fr_title', "Title (French)", ['class' => 'col-sm-2 control-label']) !!}
                                        {!! Form::text("fr_title", ($post)? $post->fr_meta_title : null , ['class' => 'form-control','id'=>'fr_title','placeholder'=>"Title (French)"]) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('en_meta_description', "Meta Description (English)", ['class' => 'col-sm-2 control-label']) !!}
                                        {!! Form::text("en_meta_description",  ($post)? $post->en_meta_description : null  , ['class' => 'form-control','id'=>'en_meta_description','placeholder'=>"Meta Description (English)"]) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('fr_meta_description', "Meta Description (French)", ['class' => 'col-sm-2 control-label']) !!}
                                        {!! Form::text("fr_meta_description", ($post)? $post->fr_meta_description : null , ['class' => 'form-control','id'=>'fr_meta_description','placeholder'=>"Meta Description (French)"]) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('en_meta_keywords', "Meta Keyword (English)", ['class' => 'col-sm-2 control-label']) !!}
                                        {!! Form::text("en_meta_keywords", ($post)? $post->en_meta_keywords : null  , ['class' => 'form-control','id'=>'en_meta_keywords','placeholder'=>"Meta Keyword (English)"]) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('fr_meta_keywords', "Meta Keyword (French)", ['class' => 'col-sm-2 control-label']) !!}
                                        {!! Form::text("fr_meta_keywords",  ($post)? $post->fr_meta_keywords : null , ['class' => 'form-control','id'=>'fr_meta_keywords','placeholder'=>"Meta Keyword (French)"]) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('en_og_title', "OG Title (English)", ['class' => 'col-sm-2 control-label']) !!}
                                        {!! Form::text("en_og_title", ($post)? $post->en_og_title : null   , ['class' => 'form-control','id'=>'en_og_title','placeholder'=>"OG Title (English)"]) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('fr_og_title', "OG Title (French)", ['class' => 'col-sm-2 control-label']) !!}
                                        {!! Form::text("fr_og_title",  ($post)? $post->fr_og_title : null  , ['class' => 'form-control','id'=>'fr_og_title','placeholder'=>"OG Title (French)"]) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('en_og_description', "OG Description (English)", ['class' => 'col-sm-2 control-label']) !!}
                                        {!! Form::text("en_og_description", ($post)? $post->en_og_description : null   , ['class' => 'form-control','id'=>'en_og_title','placeholder'=>"OG Description (English)"]) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('fr_og_description', "OG Description (French)", ['class' => 'col-sm-2 control-label']) !!}
                                        {!! Form::text("fr_og_description",  ($post)? $post->fr_og_description : null  , ['class' => 'form-control','id'=>'fr_og_title','placeholder'=>"OG Description (French)"]) !!}
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <a href="{!! route('blog.index') !!}" class="btn btn-default">Cancel</a>
                            <button type="submit" class="btn btn-primary pull-right" id="add-blog-post">Save
                            </button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('additional-scripts')
    {!! Html::script('backend/plugins/datepicker/bootstrap-datepicker.js') !!}
    {!! Html::script('backend/js/blog_post.js') !!}
@stop

@section('footer-scripts')
<script type="text/javascript">
    $(document).ready(function () {
        //Date picker
        $('#datepicker').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd',
        });
    })
</script>
@stop
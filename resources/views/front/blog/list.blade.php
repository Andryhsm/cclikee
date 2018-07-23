@extends('front.layout.master')

@section('content')
    <section class="blog_post">
        <div class="container">

            <div class="row">

                <div class="col-xs-12 col-sm-9" id="center_column">
                    <div class="center_column">
                        <div class="page-title">
                            <h2>{!! trans('blog.blog_post') !!}</h2>
                        </div>
                        <ul class="blog-posts">
                            @foreach($posts as $post)
                                <li class="post-item">
                                    <article class="entry">
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <div class="entry-thumb"><a href="{!! url(LaravelLocalization::getCurrentLocale().'/'.$post->url->request_url) !!}">
                                                        <figure><img src="{!! $post->getImage() !!}" alt="Blog"></figure>
                                                    </a> <span class="blog-date"> <a href="{!! url(LaravelLocalization::getCurrentLocale().'/'.$post->url->request_url) !!}">
                                                            <span class="month-date"><small>{!! \Carbon\Carbon::parse($post->publish_date)->day !!}</small>{!! \Carbon\Carbon::parse($post->created_at)->format('M') !!}</span> </a> </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-7">
                                                <h3 class="entry-title"><a href="{!! url(LaravelLocalization::getCurrentLocale().'/'.$post->url->request_url) !!}">{!! $post->byLanguage(app('language')->language_id,'title') !!}</a></h3>
                                                <div class="entry-meta-data">
                                                    <span class="author"> <i
                                                                class="fa fa-user"></i>&nbsp;{!! trans('blog.by') !!} <a
                                                                href="#">{!! $post->admin->first_name.' '.$post->admin->last_name !!}</a></span>
                                                    <span class="cat"> <i class="fa fa-folder"></i>&nbsp;
                                                        @if(!empty($post->tags))
                                                        @foreach($post->tags as $tag)
                                                            <a href="#">{!! $tag->tag_name !!} </a>
                                                        @endforeach
                                                        @endif
                                                    </span>
                                                    <span class="date"><i class="fa fa-calendar"></i>&nbsp; {!! $post->publish_date !!}</span>
                                                </div>
                                                <div class="entry-excerpt">
                                                    {!! strip_tags(str_limit($post->byLanguage(app('language')->language_id,'article'),200,'...')) !!}
                                                </div>
                                                <a href="{!! url(LaravelLocalization::getCurrentLocale().'/'.$post->url->request_url) !!}" class=" read-more">{!! trans('blog.read_more') !!}&nbsp; <i
                                                            class="fa fa-angle-double-right"></i></a></div>
                                        </div>
                                    </article>
                                </li>
                            @endforeach
                        </ul>
                        <div class="sortPagiBar">
                            <div class="pagination-area " style="visibility: visible;">
                                {!! $posts->appends(request()->input())->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <aside class="sidebar col-xs-12 col-sm-3">
                    <div class="block blog-module">
                        <div class="sidebar-bar-title">
                            <h3>{!! trans('blog.popular_post') !!}</h3>
                        </div>
                        <div class="block_content">
                            <div class="layered">
                                <div class="layered-content">
                                    <ul class="blog-list-sidebar">
                                        @foreach($popular_posts as $popular_post)
                                        <li>
                                            <div class="post-thumb"><a href="{!! url(LaravelLocalization::getCurrentLocale().'/'.$popular_post->url->request_url) !!}"><img src="{!! $popular_post->getImage() !!}" alt="Blog"></a></div>
                                            <div class="post-info">
                                                <h5 class="entry_title"><a href="{!! url(LaravelLocalization::getCurrentLocale().'/'.$popular_post->url->request_url) !!}">{!! $popular_post->byLanguage(app('language')->language_id,'title') !!}</a></h5>
                                                <div class="post-meta"><span class="date"><i class="fa fa-calendar"></i> {!! \Carbon\Carbon::parse($popular_post->publish_date)->format("Y-m-d") !!}</span>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="popular-tags-area block">
                        <div class="sidebar-bar-title">
                            <h3>{!! trans('blog.popular_tag') !!}</h3>
                        </div>

                        <div class="tag">
                            <ul>
                                @foreach($tags as $tag)
                                    <li><a href="{!! url(LaravelLocalization::getCurrentLocale().'/blog-list')."?tag=$tag->blog_tag_id" !!}">{!! $tag->tag_name !!}</a></li>
                               @endforeach
                            </ul>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@stop
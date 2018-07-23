@extends('front.layout.master')
@section('content')

    <section class="blog_post">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-9">
                    <div class="entry-detail">
                        <div class="page-title">
                            <h1>{!! $post->byLanguage(app('language')->language_id,'title') !!}</h1>
                        </div>
                        <div class="entry-photo">
                            <figure>
                                <img src="{!! $post->getImage() !!}" alt="Blog">
                            </figure>
                        </div>
                        <div class="entry-meta-data"><span class="author"> <i
                                        class="fa fa-user"></i>&nbsp; {!! trans('blog.by') !!} <a
                                        href="#">{!! $post->admin->first_name." ".$post->admin->last_name !!}</a></span>
                            <span class="date"><i class="fa fa-calendar">&nbsp;</i>&nbsp; {!! $post->publish_date !!}</span>
                            <div class="rating">
                                <div id="fb-root"></div>
                                <script>(function (d, s, id) {
                                        var js, fjs = d.getElementsByTagName(s)[0];
                                        if (d.getElementById(id)) return;
                                        js = d.createElement(s);
                                        js.id = id;
                                        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=989710321109345";
                                        fjs.parentNode.insertBefore(js, fjs);
                                    }(document, 'script', 'facebook-jssdk'));</script>
                                <div class="fb-like" data-href="{!! url(LaravelLocalization::getCurrentLocale().'/'.$post->url->target_url) !!}"
                                     data-layout="button" data-action="like" data-size="small" data-show-faces="true"
                                     data-share="true"></div>
                            </div>
                        </div>
                        <div class="content-text clearfix mr-t-40">
                            {!! $post->byLanguage(app('language')->language_id,'article') !!}
                        </div>
                        <div class="entry-tags"><span>{!! trans('blog.tags') !!}</span>
                            @if(count($post->tags)>0)
                                @foreach($post->tags as $tag)
                                    <a href="#">{!! $tag->tag_name !!}</a>
                                @endforeach
                            @endif
                        </div>
                        <div id="share-buttons">
                            {{--<span style="font-size: 20px;">Share</span>
                            <span style="font-size: 20px;margin-left: 250px;">Become Fan</span><br/>
                            <a href="#" class="btn btn-facebook"><span>225<i
                                            class="fa fa-facebook mr-lft-5px"></i></span><span
                                        class="mr-lft-5px">Share</span></a>--}}
                            <script>(function (d, s, id) {
                                    var js, fjs = d.getElementsByTagName(s)[0];
                                    if (d.getElementById(id)) return;
                                    js = d.createElement(s);
                                    js.id = id;
                                    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=989710321109345";
                                    fjs.parentNode.insertBefore(js, fjs);
                                }(document, 'script', 'facebook-jssdk'));</script>
                            <div class="fb-share-button" data-href="{!! URL::to('/'.$post->url->target_url) !!}"
                                 data-layout="button_count" data-size="large" data-mobile-iframe="true"><a
                                        class="fb-xfbml-parse-ignore" target="_blank"
                                        href="{!! URL::to('/'.$post->url->target_url) !!}">Share</a>
                            </div>
                            <span id="twitter-sharing">
                                <a  href="https://twitter.com/share" class="btn btn-twitter twitter-share-button" data-text="{!!urlencode(addslashes($post->getPostNameByLanguage(app('language')->language_code)))!!}" data-src="{!!urlencode(URL('/') . '/'. Request::path())!!}" data-count="none" data-toggle="tooltip" title="Share on Twitter">
                                    <i class="fa fa-twitter">Twitter</i></a>
                            </span>
                       {{--     <a style="margin-left: 100px;" href="#" class="btn btn-twitter"><span><i
                                            class="fa"></i></span><span class="mr-lft-5px">Jalme</span></a><span> You and 110 other like this</span>--}}
                        </div>

                    </div>

                    <div class="single-box">
                        <h2>{!! trans('blog.related_posts') !!}</h2>
                        <div class="slider-items-products">
                            <div id="related-posts" class="product-flexslider hidden-buttons">
                                <div class="slider-items slider-width-col4 fadeInUp">
                                    @if($post->relatedPosts)
                                        @foreach($post->relatedPosts as $related_post)
                                            <div class="product-item">
                                                <article class="entry">
                                                    <div class="entry-thumb image-hover2"> <a href="{!! url(LaravelLocalization::getCurrentLocale().'/'.$related_post->url->request_url) !!}">
                                                            <img src="{!! $related_post->getImage() !!}" alt="Blog"> </a> </div>
                                                    <div class="blog-content">
                                                        <div class="title-desc"> <a href="{!! url(LaravelLocalization::getCurrentLocale().'/'.$related_post->url->request_url) !!}">
                                                                <h4>{!! $related_post->byLanguage(app('language')->language_id,'title') !!}</h4>
                                                            </a>
                                                            {!! str_limit($related_post->byLanguage(app('language')->language_id,'article'),100) !!}
                                                        </div>
                                                        <div class="blog-info"> <span class="author-name"> <i class="fa fa-user"></i>{!! trans('blog.by') !!}
                                                                <a href="#">{!! $related_post->admin->first_name." ".$related_post->admin->last_name !!}</a> </span> </div>
                                                    </div>
                                                </article>
                                            </div>
                                        @endforeach
                                     @endif
                            </div>
                        </div>
                    </div>
                </div>


                </div>


                <aside class="right sidebar col-xs-12 col-sm-3">
                    <div class="block blog-module">
                        <p class="title_block">{!! trans('blog.blog_categories') !!}</p>
                        <div class="block_content">
                            <div class="layered layered-category">
                                <div class="layered-content">
                                    <ul class="tree-menu">
                                        @foreach($blog_categories as $category)
                                            <li>
                                                <a href="{!! url(LaravelLocalization::getCurrentLocale()."/blog-list")."?category=".$category->blog_category_id !!}">
                                                    <i class="fa fa-angle-right"></i>&nbsp; {!! $category->byLanguage(app('language')->language_id,'name') !!}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block blog-module wow fadeInUp">
                        <p class="title_block">{!! trans('blog.popular_post') !!}</p>
                        <div class="block_content">
                            <!-- layered -->
                            <div class="layered">
                                <div class="layered-content">
                                    <ul class="blog-list-sidebar">
                                        @foreach($popular_posts as $popular_post)
                                            <li>
                                                <div class="post-thumb"><a
                                                            href="{!! url(LaravelLocalization::getCurrentLocale().'/'.$popular_post->url->request_url) !!}"><img
                                                                src="{!! $popular_post->getImage() !!}" alt="Blog"></a>
                                                </div>
                                                <div class="post-info">
                                                    <h5 class="entry_title"><a
                                                                href="{!! url(LaravelLocalization::getCurrentLocale().'/'.$popular_post->url->request_url) !!}">{!! $popular_post->byLanguage(app('language')->language_id,'title') !!}</a>
                                                    </h5>
                                                    <div class="post-meta"><span class="date"><i class="fa fa-calendar">&nbsp;</i> {!! \Carbon\Carbon::parse($popular_post->publish_date)->format("Y-m-d") !!}</span>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="popular-tags-area wow fadeInUp">
                        <div class="sidebar-bar-title">
                            <h3>{!! trans('blog.popular_tag') !!}</h3>
                        </div>
                        <div class="tag">
                            <ul>
                                @foreach($blog_tags as $tag)
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

@section('footer-script')
    <script type="text/javascript">
        $(document).ready(function () {
            jQuery("#related-posts .slider-items").owlCarousel({
                items: 3,
                itemsDesktop: [1024, 3],
                itemsDesktopSmall: [900, 3],
                itemsTablet: [640, 2],
                itemsMobile: [390, 1],
                navigation: !0,
                navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
                slideSpeed: 500,
                pagination: !1,
                autoPlay: true
            })

        })

    </script>
@stop
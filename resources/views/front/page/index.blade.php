@extends('front.layout.master')

@section('content')
<div class="container">
    <section class="section-element-area pt-20 ajust">
        <div class="row">
            @if(app('language')->language_id==2 && !empty($page->french) && !empty($page->french->content))
            {!! $page->french->content !!}
            @else
            {!! $page->english->content !!}
            @endif
        </div>
    </section>
</div>    
@stop

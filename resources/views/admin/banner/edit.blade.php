@extends($layout)
@section('content')

@if(Session::get('sliderORbanner') == 1)
    <section class="content-header">
        @include('notification')
        <h1>
            Modification bannière
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info alert-dismissible">                    
                    Taille de la bannière principale recommandée: 1000 x 1000, Taille de la bannière latérale: 750 x 500
                </div>
                <div class="box box-primary">
                       {{ Form::model($banner, array('method' => 'PATCH', 'url' => array('admin/banner', $banner->banner_id),'class'=>'validate_form','files' => true)) }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="content-heading">Type de bannière</label>

                                {!! Form::select('is_subbanner', [''=>'Type de bannière','1' => 'Bannière principal', '2' => 'Bannière latérale'],$banner->is_subbanner,['class'=>'form-control required','id'=>'is_subbanner']) !!}                    

                        </div>
                        <div class="form-group">
                            <label for="page_title">Nom bannière</label>
                            {!! Form::text('banner_title', null,array('class'=>'form-control required', 'placeholder'=>'Banner Name')) !!}
                        </div>
                        <div class="form-group">
                            <label for="title">Titre</label>
                            {!! Form::text('title', null,array('class'=>'form-control required', 'placeholder'=>'Banner Name')) !!}
                        </div>
                        <div class="form-group">
                            <label for="subtitle">Sous titre</label>
                            {!! Form::text('subtitle', null,array('class'=>'form-control required', 'placeholder'=>'Banner Name')) !!}
                        </div>
                         <div class="form-group">
                            <label for="page_title">Alt bannière</label>
                            {!! Form::text('alt', null,array('class'=>'form-control ', 'placeholder'=>'Alt bannière')) !!}
                        </div>
                        <div class="form-group">
                            <label for="page_title">Url bannière</label>
                            <input type="text" name="banner_url" class="form-control " id="banner_url" placeholder="Banner Url" value="{!! $banner->url !!}">
                        </div>
                        <div class="form-group">
                            <label for="content-heading">Bannière image</label>
                            {!!  Form::file('french_image',['class'=>"form-control"])!!}
                            {{ Form::image('upload/banner/'.$banner->french_banner_image, null, ['class' => 'brand-image'])}}
                        </div>
                        <div class="form-group">
                            <label for="content-heading">Bannière image hover</label>
                            {!!  Form::file('french_image_hover',['class'=>"form-control"])!!}
                            {{ Form::image('upload/banner/'.$banner->banner_image_hover, null, ['class' => 'brand-image'])}}
                        </div>
                        <div class="form-group">
                            {!! Form::label('is_active', 'Activé', ['class' => 'col-sm-1 control-label']) !!}
                            <div class="">
                                {!! Form::checkbox('is_active', '1',($banner->is_active==1)?true:false) !!}
                            </div>

                        </div>
                    </div>
                    <div class="box-footer">
                     {{--   <a href="{!!  URL::to('/admin/banner/create') !!}" class="btn btn-default">Annuler</a>--}}
                        <button type="submit" class="btn btn-primary pull-right save-form">Modifier</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@else
   <section class="content-header">
        @include('notification')
        <h1>
            Modification slider
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info alert-dismissible">
                    Taille du slider recommandée: 3000 x 1300 
                </div>
                <div class="box box-primary">
                       {{ Form::model($banner, array('method' => 'PATCH', 'url' => array('admin/banner', $banner->banner_id),'class'=>'validate_form','files' => true)) }}
                    <div class="box-body">
                        <div class="form-group">
                            <!-- <label for="content-heading">Type de bannière</label> -->
                            {!! Form::select('is_subbanner', ['4' => 'Slider'],$banner->is_subbanner,['class'=>'form-control required','id'=>'is_subbanner']) !!}

                        </div>
                        <div class="form-group">
                            <label for="page_title">Nom slider</label>
                            {!! Form::text('banner_title', null,array('class'=>'form-control required', 'placeholder'=>'Banner Name')) !!}
                        </div>
                         <div class="form-group">
                            <label for="page_title">Alt slider</label>
                            {!! Form::text('alt', null,array('class'=>'form-control ', 'placeholder'=>'Alt slider')) !!}
                        </div>
                        <div class="form-group">
                            <label for="page_title">Url slider</label>
                            <input type="text" name="banner_url" class="form-control " id="banner_url" placeholder="Banner Url" value="{!! $banner->url !!}">
                        </div>
                        <div class="form-group">
                            <label for="content-heading">Slider image</label>
                            {!!  Form::file('french_image',['class'=>"form-control"])!!}
                            {{ Form::image('upload/banner/'.$banner->french_banner_image, null, ['class' => 'brand-image'])}}
                        </div>
                        <div class="form-group">
                            {!! Form::label('is_active', 'Activé', ['class' => 'col-sm-1 control-label']) !!}
                            <div class="">
                                {!! Form::checkbox('is_active', '1',($banner->is_active==1)?true:false) !!}
                            </div>

                        </div>
                    </div>
                    <div class="box-footer">
                     {{--   <a href="{!!  URL::to('/admin/banner/create') !!}" class="btn btn-default">Annuler</a>--}}
                        <button type="submit" class="btn btn-primary pull-right save-form">Modifier</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endif



@stop
@section('footer-scripts')

@stop
@extends($layout)
@section('content')
    <section class="content-header">
        <h1>
            Ajouter une nouvelle page CMS
        </h1>

    </section>


    <section class="content">
        @include('admin.layout.notification')
        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Général</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Meta</a></li>
                    </ul>
                    <div class="box box-primary">
                        {!! Form::open(array('url' => 'admin/page','id' =>'page_form','class'=>'validate_form')) !!}
                        <div class="box-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <div class="form-group english_input hidden">
                                        {!! Form::label('en_page_title', 'Page Title (English)', ['class' => 'col-sm-2 control-label']) !!}
                                        {!! Form::text('en_page_title','for english', ['class' => 'form-control','id'=>'en_page_title','placeholder'=>"Page Title(English)"]) !!}
                                    </div>
                                    <div class="form-group french_input">
                                        {!! Form::label('fr_page_title', 'Titre de la page', ['class' => 'col-sm-2 control-label']) !!}
                                        {!! Form::text('fr_page_title','' , ['class' => 'form-control required','id'=>'fr_page_title','placeholder'=>"Titre de la page"]) !!}
                                    </div>

                                    <div class="form-group english_input hidden">
                                        {!! Form::label('en_content_heading', 'Content Heading (English)', ['class' => 'col-sm-2 control-label']) !!}</label>
                                        {!! Form::text('en_content_heading','' , ['class' => 'form-control','id'=>'en_content_heading','placeholder'=>"Content Heading (English)"]) !!}
                                    </div>
                                    <div class="form-group french_input">
                                        {!! Form::label('fr_content_heading', 'En-tête de contenu', ['class' => 'col-sm-2 control-label']) !!}</label>
                                        {!! Form::text('fr_content_heading','' , ['class' => 'form-control required','id'=>'fr_content_heading','placeholder'=>"En-tête de contenu"]) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('url_key', "Clé d'URL", ['class' => 'col-sm-2 control-label']) !!}</label>
                                        {!! Form::text('url_key','' , ['class' => 'form-control required','id'=>'url_key','placeholder'=>"Clé d'URL"]) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('is_active', 'Is Active', ['class' => 'col-sm-1 control-label']) !!}
                                        {!! Form::checkbox('is_active', '1') !!}
                                    </div>
                                    <div class="form-group english_input hidden">
                                        <label for="url_key">Content (English)</label>
                                        <textarea class="textarea" name="en_content" id="en_content" placeholder="Page Content (English)"
                                                  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                    </div>
                                    <div class="form-group french_input">
                                        <label for="url_key">Contenu</label>
                                        <textarea class="textarea" name="fr_content" id="fr_content" placeholder="Page Content (French)"
                                                  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                    </div>

                                </div>
                                <div class="tab-pane" id="tab_2">
                                    <div class="form-group hidden">
                                        {!! Form::label('en_title', "Title (English)", ['class' => 'col-sm-2 control-label']) !!}
                                        {!! Form::text("en_title", null , ['class' => 'form-control','id'=>'en_title','placeholder'=>"Title (English)"]) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('fr_title', "Title", ['class' => 'col-sm-2 control-label']) !!}
                                        {!! Form::text("fr_title", null , ['class' => 'form-control','id'=>'fr_title','placeholder'=>"Title"]) !!}
                                    </div>

                                    <div class="form-group hidden">
                                        {!! Form::label('en_meta_description', "Meta Description (English)", ['class' => 'col-sm-2 control-label']) !!}
                                        {!! Form::text("en_meta_description",  null , ['class' => 'form-control','id'=>'en_meta_description','placeholder'=>"Meta Description (English)"]) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('fr_meta_description', "Meta Description", ['class' => 'col-sm-2 control-label']) !!}
                                        {!! Form::text("fr_meta_description", null , ['class' => 'form-control','id'=>'fr_meta_description','placeholder'=>"Meta Description"]) !!}
                                    </div>

                                    <div class="form-group hidden">
                                        {!! Form::label('en_meta_keywords', "Meta Keyword (English)", ['class' => 'col-sm-2 control-label']) !!}
                                        {!! Form::text("en_meta_keywords", null , ['class' => 'form-control','id'=>'en_meta_keywords','placeholder'=>"Meta Keyword (English)"]) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('fr_meta_keywords', "Meta Keywords", ['class' => 'col-sm-2 control-label']) !!}
                                        {!! Form::text("fr_meta_keywords",  null , ['class' => 'form-control','id'=>'fr_meta_keywords','placeholder'=>"Meta Keywords"]) !!}
                                    </div>

                                    <div class="form-group hidden">
                                        {!! Form::label('en_og_title', "OG Title (English)", ['class' => 'col-sm-2 control-label']) !!}
                                        {!! Form::text("en_og_title", null , ['class' => 'form-control','id'=>'en_og_title','placeholder'=>"OG Title (English)"]) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('fr_og_title', "OG Title", ['class' => 'col-sm-2 control-label']) !!}
                                        {!! Form::text("fr_og_title",  null , ['class' => 'form-control','id'=>'fr_og_title','placeholder'=>"OG Title"]) !!}
                                    </div>
                                    <div class="form-group hidden">
                                        {!! Form::label('en_og_description', "OG Description (English)", ['class' => 'col-sm-2 control-label']) !!}
                                        {!! Form::text("en_og_description", null , ['class' => 'form-control','id'=>'en_og_title','placeholder'=>"OG Description (English)"]) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('fr_og_description', "OG Description", ['class' => 'col-sm-2 control-label']) !!}
                                        {!! Form::text("fr_og_description",  null , ['class' => 'form-control','id'=>'fr_og_title','placeholder'=>"OG Description"]) !!}
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="box-footer">
                            <a href="{!! URL::to('admin/page') !!}" class="btn btn-default">Annuler</a>
                            <button type="submit" id="add-page" class="btn btn-primary pull-right">Enregistrer</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('additional-scripts')
    {!! Html::script('backend/js/page.js') !!}
@stop
@section('footer-scripts')
@stop
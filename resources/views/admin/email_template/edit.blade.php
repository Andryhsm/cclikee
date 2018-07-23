@extends($layout)
@section('content')
    <section class="content-header">
        <h1>
            Update Email Template
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    {{ Form::model($email_template, array('method' => 'PATCH', 'url' => array('admin/email-template', $email_template->email_template_id),'class'=>'validate_form','id' => 'email_template_form')) }}
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('template_name', 'Template Name', ['class' => 'col-sm-2 control-label']) !!}

                            {!! Form::text('template_name',null , ['class' => 'form-control required','id'=>'template_name','placeholder'=>"Template Name "]) !!}
                        </div>

                        <div class="form-group english_input">
                            {!! Form::label('en_subject', 'Subject (English)', ['class' => 'col-sm-2 control-label']) !!}
                            {!! Form::text('en_subject',$email_template->english->subject, ['class' => 'form-control required','id'=>'en_subject','placeholder'=>"Subject (English)"]) !!}
                        </div>
                        <div class="form-group french_input">
                            {!! Form::label('fr_subject', 'Subject (French)', ['class' => 'col-sm-2 control-label']) !!}
                            {!! Form::text('fr_subject',(!empty($email_template->french)) ? $email_template->french->subject:null, ['class' => 'form-control','id'=>'fr_subject','placeholder'=>"Subject (French)"]) !!}
                        </div>
                        <div class="form-group english_input">
                            {!! Form::label('en_content', 'Content (English)', ['class' => 'control-label']) !!}
                            <textarea class="textarea" name="en_content" id="en_content" placeholder="Content (English)"
                                      style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                    {!! $email_template->english->content !!}
                                </textarea>
                        </div>

                        <div class="form-group french_input">
                            {!! Form::label('fr_content', 'Content (French)', ['class' => 'control-label']) !!}
                            <textarea class="textarea" name="fr_content" id="fr_content" placeholder="Content (French)" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                @if(!empty($email_template->french))
                                    {!! $email_template->french->content !!}
                                @endif
                            </textarea>
                        </div>

                        <div class="form-group">
                            {!! Form::label('enable_sms', 'Enable SMS', ['class' => 'col-sm-1 control-label']) !!}
                            {!! Form::checkbox('enable_sms', '1',($email_template && $email_template->enable_sms==1) ? true : false)     !!}
                        </div>


                        <div class="form-group english_input">
                            {!! Form::label('sms_en_content', 'SMS Content (English)', ['class' => 'control-label']) !!}
                            <textarea class="textarea" name="sms_en_content" id="sms_en_content" placeholder="SMS Content (English)" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                @if(!empty($email_template->english))
                                    {!! $email_template->english->sms_content !!}
                                @endif
                            </textarea>
                        </div>

                        <div class="form-group french_input">
                            {!! Form::label('sms_fr_content', 'SMS Content (French)', ['class' => 'control-label']) !!}
                            <textarea class="textarea" name="sms_fr_content" id="sms_fr_content" placeholder="SMS Content (French)" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                @if(!empty($email_template->french))
                                    {!! $email_template->french->sms_content !!}
                                @endif
                            </textarea>
                        </div>

                    </div>
                    <div class="box-footer">
                        <a href="{!! URL::to('admin/email-template') !!}" class="btn btn-default">Cancel</a>
                        <button type="submit" class="btn btn-primary pull-right add-template">Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@stop

@section('additional-scripts')
    {!! Html::script('backend/js/email_template.js') !!}
@stop
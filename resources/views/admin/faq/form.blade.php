@extends($layout)
@section('content')
    <section class="content-header">
        <h1>
            @if($faq)
                Mise à jour FAQ
            @else
                Nouvelle FAQ
            @endif
        </h1>
    </section>
    <section class="content">
        @include('admin.layout.notification')

        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    {!! Form::open(['url' => ($faq) ? Url("admin/faq/$faq->id") :  route("faq.store"), 'class' => '','id' =>'faq_form','method'=>($faq)?'PATCH':'POST']) !!}
                    <div class="box-body">
                        <!-- <div class="form-group">
                            {!! Form::label('english_question', 'Question (English)', ['class' => '']) !!}
                            {!! Form::text('english_question', ($faq)? $faq->english_question:null, ['class' => 'form-control required','id'=>'english_question','placeholder'=>"Question (English)"]) !!}
                        </div> -->
                        <div class="form-group">
                            {!! Form::label('french_question', 'Question', ['class' => '']) !!}
                            {!! Form::text('french_question', ($faq)? $faq->french_question:null, ['class' => 'form-control','id'=>'french_question','placeholder'=>"Question"]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('type', 'FAQ Type', ['class' => 'col-sm-2']) !!}
                            <label for="customer" class="">
                                {!! Form::radio('faq_type',1,(!$faq || ($faq && $faq->type=='1') ? true : false),['class'=>'','id'=>'customer']) !!} Client
                            </label>
                            <label for="merchant" class="">
                                {!! Form::radio('faq_type',2,($faq && $faq->type=='2') ? true : false,['class'=>'','id'=>'merchant']) !!} Marchant
                            </label>
                        </div>
                        <!-- <div class="form-group" style="clear: both">
                            {!! Form::label('english_answer', 'Answer (English)', ['class' => '']) !!}
                            <textarea class=" required" id="english_answer" placeholder="Answer (English)" name="english_answer"
                                      style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                @if($faq)
                                    {!! $faq->english_answer !!}
                                @endif
                            </textarea>
                        </div> -->
                        <div class="form-group">
                            {!! Form::label('french_answer', 'Reponse', ['class' => '']) !!}
                            <textarea class="" id="french_answer" placeholder="Answer (French)" name="french_answer"
                                      style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                @if($faq)
                                    {!! $faq->french_answer !!}
                                @endif
                            </textarea>
                        </div>

                        <div class="form-group">
                            {!! Form::label('status', 'Activé', ['class' => 'col-sm-1 control-label']) !!}
                            <div class="col-sm-10">
                                {!! Form::checkbox('status', '1',($faq && $faq->status=='1') ? true: false) !!}
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="{!! route('faq.index') !!}" class="btn btn-default">Annuler</a>
                        <button type="submit" class="btn btn-primary pull-right" id="add-faq">Enregistrer
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@stop
@section('footer-scripts')
    <script type="text/javascript" language="JavaScript">
        $(document).ready(function($) {
            $('#add-faq').click(function () {
                $('#faq_form').validate({
                    rules: {
                        english_answer: {
                            required: true
                        },
                        english_question: {
                            required: true
                        }
                    },
                    errorPlacement: function (error, element) {
                        return error.insertAfter(element);
                    }
                });
                if ($('#faq_form').valid()) {
                    $('#faq_form').submit();
                }
            });
        });

    </script>
@stop
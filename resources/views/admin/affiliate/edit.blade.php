@extends($layout)
@section('content')
    <section class="content-header">
        <h1>
            Modification du lien
        </h1>
    </section>

    <section class="content">
        @include('notification')
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    {{ Form::model($link, array('method' => 'PATCH', 'url' => array('admin/affiliate', $link->link_adjustment_id),'class'=>'validate_form','id' => 'link_adjustment_form')) }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="page_title">Nom du client</label>
                            <select class="form-control" name="user_id">
                                @foreach($users as $user)
                                    <option {!! ($user->user_id==$link->user_id)?'selected':''!!} value="{!! $user->user_id !!}">{!! $user->first_name." ".$user->last_name
                                        !!}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="user_id" value="{{ $link->user_id }}">
                        <div class="form-group">
                            {!! Form::label('link', 'Lien', ['class' => 'col-sm-2 control-label']) !!}
                            {!! Form::text('link',null ,['class' => 'form-control
                            required','id'=>'link','placeholder'=>"Lien"]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('content-heading', 'Description', ['class' => 'col-sm-2 control-label']) !!}
                            <textarea rows="2" name="description" class="textarea"
                                      style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                 {!! $link->description; !!}
                            </textarea>
                        </div>

                    </div>
                    <div class="box-footer">
                        <a href="{!! URL::to('admin/affiliate') !!}" class="btn btn-default">Annuler</a>
                        <button type="submit" class="btn btn-primary pull-right" id="save-link">Sauvegarder</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@stop
@section('footer-scripts')
    {!! Html::script('backend/js/link_adjustment.js') !!}
@stop
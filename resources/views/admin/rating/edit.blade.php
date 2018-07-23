@extends($layout)
@section('content')
    <section class="content-header">
        <h1>
           Modification du revue
        </h1>
    </section>

    <section class="content">
        @include('admin.layout.notification')
        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                   
                    <div class="box box-primary">
                        {{ Form::model($rating, array('method' => 'PATCH', 'url' => array('admin/product-rating', $rating->product_rating_id),'class'=>'validate_form','id' => 'rating_form')) }}
                        <div class="box-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <div class="form-group">
                                        {!! Form::label('Product', 'Nom du produit', ['class' => 'col-sm-2 control-label']) !!}
                                        {!! Form::label('Product', (isset($rating->product->english->product_name)) ? $rating->product->french->product_name : "", ['class' => 'col-sm-2 control-label']) !!}
                                    </div>
                                    <div class="form-group clearfix" style="clear: both">
                                        {!! Form::label('review', 'Revue', ['class' => 'col-sm-2 control-label']) !!}</label>
                                        {!! Form::textarea('review',null , ['class' => 'form-control ','id'=>'review','placeholder'=>"Revue"]) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('rating', 'Évaluation', ['class' => 'col-sm-2 control-label']) !!}</label>
                                        {!! Form::selectRange('rating', 1, 5,$rating->rating,['class' => 'form-control required','id'=>'rating']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('is_active', 'Status', ['class' => 'col-sm-2 control-label']) !!}
                                        <select name="is_active" class="form-control required">
                                            <option value="1" {!! ($rating->status==1)?"selected":"" !!}>Approuver</option>
                                            <option value="2" {!! ($rating->status==2)?"selected":"" !!}>Rejeter</option>
                                            <option value="0" {!! ($rating->status==0)?"selected":"" !!}>En attente d'approbation</option>
                                        </select>
                                    </div>
                                </div>
                               
                            </div>

                        </div>

                        <div class="box-footer">
                            <a href="{!! URL::to('admin/product-rating') !!}" class="btn btn-default">Annuler</a>
                            <button type="submit" id="update-rating" class="btn btn-primary pull-right">Sauvergarder</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@section('additional-scripts')
    {!! Html::script('backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') !!}
    {!! Html::script('backend/js/rating.js') !!}
@stop
@section('footer-scripts')
@stop
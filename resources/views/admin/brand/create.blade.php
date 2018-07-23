@extends($layout)
@section('content')
    <section class="content-header">
        @include('notification')
        <h1>
            Ajouter une nouvelle marque
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    {!! Form::open(array('url' => 'admin/brand','files' => true,'class'=>'validate_form','id'=>'brand_form')) !!}
                    <div class="box-body">
                        <div class="row mr-b-15">
                            <div class="col-md-6">
                                <div class="brands">
                                    <span class="brand-title"> MARQUES LIÉES</span>
                                    <div class="brands-list">
                                        <p class="heading-txt">ACTUELLEMENT DES MARQUES AU CATALOGUE</p>
                                        @foreach($brands as $brand)
                                            <p>{!! $brand->brand_name !!}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="brands">
                                    <span class="brand-title">DEMANDE D'AJOUT MARQUE</span>
                                    <div class="request-brand">
                                        <p class="heading-txt">DEMANDE DE MARQUE</p>
                                        @foreach($brand_requests as $brand_request)
                                            <p class="brand-name" data-name="{!! $brand_request->brand_name !!}"
                                               data-website="{!! $brand_request->website!!}">{!! $brand_request->brand_name !!}
                                                <span class="pull-right mr-r-5 remove_request_brand" id="{!! $brand_request->request_brand_id !!}">X</span>
                                            </p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                            <div class="form-group">
                                {!! Form::label('brand_name', 'Nom du marque', ['class' => '']) !!}
                                <input type="text" class="form-control brand-name required" name="brand_name"
                                       placeholder="Nom du marque">
                            </div>
                            <div class="form-group">
                                {!! Form::label('website', 'Site web', ['class' => '']) !!}
                                <input  type="text" class="form-control brand-website required" name="website"
                                       placeholder="site web">
                            </div>

                        <div class="form-group ">
                            <label for="content-heading">Image</label>
                            {!! Form::file('image',['class'=>"form-control"])!!}
                        </div>
                        <div class="form-group">
                            <div class="tag-autocomplete">
                                {!! Form::label('brand_tag', 'Tag de la marque mère', ['class' => '']) !!}
                                <div class="">
                                            <span class="search-box-container">
                                                <span class="search-box">
                                                    <ul>
                                                        <li class="search-input"><input class="form-control auto-complete"></li>
                                                    </ul>
                                                </span>
                                            </span>
                                </div>
                                <input type="hidden" name="main_brand_tag" value="" class="brand_tag">
                            </div>
                        </div>


                        <div class="form-group">
                            {!! Form::label('is_active', 'Désactiver la marque mère', ['class' => 'col-sm-2 control-label ']) !!}
                            <div class="col-sm-10 active-brand">
                                {!! Form::checkbox('is_active', '0') !!}
                            </div>
                        </div>

                        <div class="col-md-12 sub-brand-container" id="0">
                            <div class="col-md-5">
                                <div class="form-group">
                                    {!! Form::label('sub_brand', 'Sous-marque', ['class' => 'col-sm-5 control-label ']) !!}
                                    <input  type="text"  class="form-control sub_brand_name" name="sub_brand[0]" placeholder="Sub Brand">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group col-xs-12 tag-autocomplete">
                                    {!! Form::label('brand_tag', 'Tag du sous-marque', ['class' => 'col-sm-5 control-label']) !!}
                                    <div class="col-sm-12">
                                        <span class="search-box-container">
                                            <span class="search-box">
                                                <ul>
                                                    <li class="search-input"><input class="form-control auto-complete"></li>
                                                </ul>
                                            </span>
                                        </span>
                                    </div>
                                    <input type="hidden" name="sub_brand_tag[0]" value="" class="brand_tag">
                                </div>
                            </div>
                            <div class="col-md-1 add-more-btn">
                                <label>&nbsp;</label>
                                <button type="button" class="btn btn-primary btn-sm form-control" id="add_more_sub_brand">Ajouter plus</button>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-5">Tags de marque existants</label>
                            <div class="col-sm-12" id="tag-container">
                                @foreach($brand_tags as $tag)
                                    <button type="button" id="{!! $tag->brand_tag_id !!}" class="btn btn-primary btn-sm brand-category-btn">{!! $tag->tag_name !!}
                                        @if(auth()->guard('admin')->user()->role_id=='1')
                                            <span class="brand-tag-close">&times;</span>
                                        @endif
                                    </button>
                                @endforeach
                            </div>
                        </div>

                    <div class="box-footer" style="clear: both">
                        <a href="{!!  URL::to('/admin/brand') !!}" class="btn btn-default">Annuler</a>
                        <button type="submit" class="btn btn-primary pull-right save-form">Sauvergarder</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
       </div>
    </section>
@stop
@section('footer-scripts')
    <script>
        var admin_role_id = "{!! auth()->guard('admin')->user()->role_id !!}";
    </script>
    {!! Html::script('backend/js/brand.js') !!}
@stop
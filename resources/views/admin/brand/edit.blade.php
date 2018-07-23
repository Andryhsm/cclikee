@extends($layout)
@section('content')
    <section class="content-header">
        @include('notification')
        <h1>
            Modifier une marque
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                       {{ Form::model($brand, array('method' => 'PATCH', 'url' => array('admin/brand', $brand->brand_id),'class'=>'validate_form','files' => true)) }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="page_title">Nom du marque</label>
                            {!! Form::text('name', $brand->brand_name,array('class'=>'form-control required', 'placeholder'=>'Brand Name')) !!}
                        </div>
                        <div class="form-group">
                            <label for="page_title">Site web</label>
                            {!! Form::text('website', $brand->website,array('class'=>'form-control required', 'placeholder'=>'Website Name')) !!}
                        </div>
                        <div class="form-group ">
                            <label for="content-heading">Image</label>
                            {!! Form::file('image',['class'=>"form-control"])!!}
                            @if(isset($brand->brand_image) && $brand->brand_image!='')
                                {{ Form::image('upload/brand/'.$brand->brand_image, null, ['class' => 'brand-image'])}}
                            @endif
                        </div>

                        <div class="form-group">
                            <div class="tag-autocomplete">
                                {!! Form::label('brand_tag', 'Tag de la marque mère', ['class' => '']) !!}
                                <div class="">
                                            <span class="search-box-container">
                                                <span class="search-box">
                                                    <ul>
                                                        <?php $brand_tags = [] ?>
                                                        @if(count($brand->tags) >0)
                                                            @foreach($brand->tags as $tag)
                                                                <?php $brand_tags[] = $tag->brand_tag_id ?>
                                                                <li class="search-choice" id="{!! $tag->brand_tag_id !!}"><span class="search-box-remove">×</span>{!! $tag->tag_name !!}</li>
                                                            @endforeach
                                                        @endif
                                                        <li class="search-input"><input class="form-control auto-complete"></li>
                                                    </ul>
                                                </span>
                                            </span>
                                </div>
                                <input type="hidden" name="main_brand_tag" value="{!! implode(',',$brand_tags) !!}" class="brand_tag">
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('is_active', 'Désactiver la marque mère', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-10 active-brand">
                                {!! Form::checkbox('is_active', '0',($brand->is_active==0)?true:false) !!}
                            </div>
                        </div>

                        @if(count($brand->children)>0)
                            <?php $sub_brand_ids = [] ?>
                            @foreach($brand->children as $index=>$sub_brand)
                                <?php $sub_brand_ids[]= $sub_brand->brand_id; ?>
                                <div class="col-md-12 sub-brand-container" id="{!! $index !!}">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            {!! Form::label('sub_brand', 'Sous-marque', ['class' => 'col-sm-5 control-label ']) !!}
                                            <input  type="text" value="{!! $sub_brand->brand_name !!}"  class="form-control sub_brand_name" name="sub_brand[{!! $index !!}]" placeholder="Sub Brand">
                                            <input type="hidden" class="sub_brand_id" name="sub_brand_id[{!! $index !!}]" value="{!! $sub_brand->brand_id !!}">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group col-xs-12 tag-autocomplete">
                                            {!! Form::label('brand_tag', 'Tag de sous-marque', ['class' => 'col-sm-5 control-label']) !!}
                                            <div class="col-sm-12">
                                        <span class="search-box-container">
                                            <span class="search-box">
                                                <ul>
                                                <?php $sub_brand_tags = [] ?>
                                                    @if(count($sub_brand->tags) >0)
                                                        @foreach($sub_brand->tags as $tag)
                                                            <?php $sub_brand_tags[] = $tag->brand_tag_id ?>
                                                            <li class="search-choice" id="{!! $tag->brand_tag_id !!}"><span class="search-box-remove">×</span>{!! $tag->tag_name !!}</li>
                                                        @endforeach
                                                    @endif
                                                    <li class="search-input"><input class="form-control auto-complete"></li>
                                                </ul>
                                            </span>
                                        </span>
                                            </div>
                                            <input type="hidden" name="sub_brand_tag[{!! $index !!}]" value="{!! implode(',',$sub_brand_tags) !!}" class="brand_tag">
                                        </div>
                                    </div>
                                    <div class="col-md-1 add-more-btn">
                                        <label>&nbsp;</label>
                                        <button type="button" class="btn {!! ($index==0) ? "btn-primary":"btn-danger" !!}  btn-sm form-control" id="{!! ($index==0) ? "add_more_sub_brand" : "remove_sub_brand"  !!}">{!! ($index==0)?"Ajouter plus" :"Retirer"  !!}</button>
                                    </div>
                                </div>
                            @endforeach
                            <input type="hidden" name="old_sub_brand_id" value="{!! implode(',',$sub_brand_ids) !!}">
                        @endif

                        <div class="form-group">
                            <label class="col-sm-5">Tags de marque existants</label>
                            <div class="col-sm-12" id="tag-container">
                                @foreach($all_tags as $tag)
                                    <button type="button" id="{!! $tag->brand_tag_id !!}" class="btn btn-primary btn-sm brand-category-btn">{!! $tag->tag_name !!}
                                        @if(auth()->guard('admin')->user()->role_id=='1')
                                            <span class="brand-tag-close">&times;</span>
                                        @endif
                                    </button>
                                @endforeach
                            </div>
                        </div>

                    </div>
                    <div class="box-footer">
                       <a href="{!!  URL::to('/admin/brand') !!}" class="btn btn-default">Annuler</a>
                        <button type="submit" class="btn btn-primary pull-right save-form">Sauvegarder</button>
                    </div>
                    </form>
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
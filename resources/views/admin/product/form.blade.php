@extends($layout)

@section('content')

    <?php
    $selected_category = [];
    if ($product && count($product->categories) > 0) {
        foreach ($product->categories as $category) {
            $selected_category[] = $category->category_id;
        }
    }
    $attribute_set_arr = [];
    if (count($attribute_sets) > 0) {
        foreach ($attribute_sets as $attribute_set) {
            $attribute_set_arr[$attribute_set->attribute_set_id]= $attribute_set->set_name;
        }
    }

    $product_is_active_arr = [];
    if(count($product_is_active) > 0){        
        foreach ($product_is_active as $prod_is_active) {
            $product_is_active_arr[$prod_is_active->id] = $prod_is_active->status;
        }
    }

    $role_admin_arr = [];
    $role_admin_arr[10] = '';
    if (count($role_admins) > 0){
        foreach ($role_admins as $role_admin) {
            $role_admin_arr[$role_admin->admin_id] = $role_admin->last_name.' '.$role_admin->first_name;
        }
    }

    ?>
     <div class="row form-group option_row video-container master-option-container hidden">
        <div class="col-xs-3 option_name">
            <input type="text" class="form-control" placeholder="Titre du vidéo">
        </div>
        <div class="col-xs-3 option_value">
            <input type="text" class="form-control" placeholder="URL de la vidéo">
        </div>
        <div class="col-xs-3 button">
            <button type="button" class="btn btn-primary">Ajouter une option</button>
        </div>
    </div>
    <section class="content-header">
        <h1>
            @if($product)
                Modifier un produit
            @else
                Ajouter un produit
            @endif
        </h1>
    </section>

    <section class="content">
        @include('admin.layout.notification')
        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Generale</a></li>
                        <li><a href="{!! Url('admin/product/attributes') !!}" data-toggle="tabajax"
                               data-target="#attributes">Attributes</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Images</a></li>
                        <li><a href="#tab_3" data-toggle="tab">Catégorie</a></li>
                        <!--<li><a href="#tab_4" data-toggle="tab">Vidéo/Lien de presse</a></li>
                        <li><a href="#tab_5" data-toggle="tab">Filiale</a></li>-->
                        <li><a href="#tab_6" data-toggle="tab">Meta Info</a></li>
                    </ul>
                    {!! Form::open(['url' => ($product) ? Url("admin/product/$product->product_id") : route('save_product'), 'class' => 'form-horizontal','id' =>'product_form', 'enctype' => 'multipart/form-data']) !!}
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <section class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <div class="col-sm-10 col-sm-offset-2">
                                                        <div class="col-sm-2">
                                                             {!! Form::label('is_active', 'Statut', ['class' => 'col-sm-2 control-label']) !!}
                                                             {!! Form::select('is_active', $product_is_active_arr, ($product) ? $product->is_active : 2,   ['class' => 'form-control', 'id' => 'is_active'] ) !!}
                                                         </div>
                                                         <div class="col-sm-4">
                                                            {!! Form::Label('responsible', 'Responsable', ['class' => 'hidden col-sm-2 control-label']) !!}
                                                            {!! Form::select('responsible',$role_admin_arr, ($product) ?$product->responsible : 10 , ['class' => 'hidden form-control required','id'=>'attribute_set']) !!}

                                                         </div>
                                                         <div class="col-sm-6">
                                                            {!! Form::label('question_note', 'Question/note', ['class' => 'col-sm-2 hidden control-label']) !!}
                                                            {!! Form::text('question_note', '.', ['class' => 'hidden form-control','id'=>'question_note','placeholder'=>"Question/note"]) !!}
                                                         </div>

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {!! Form::label('attribute_set', 'Attribute Set', ['class' => 'col-sm-2 control-label']) !!}
                                                    <div class="col-sm-10">
                                                        {!! Form::select('attribute_set',$attribute_set_arr, ($product) ?$product->attribute_set_id : null , ['class' => 'form-control required','id'=>'attribute_set_']) !!}
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    {!! Form::label('brand', 'Marque', ['class' => 'col-sm-2 control-label']) !!}
                                                    <div class="col-sm-10">
                                                        <select name="brand_id" class="form-control required" id="brand">
                                                            <option value="">Sélectionnez une marque</option>
                                                            @foreach($brands as $brand)
                                                                <option value="{!! $brand->brand_id !!}" {!! ($product && $product->brand_id == $brand->brand_id)?"selected":"" !!}>{!! $brand->brand_name !!}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- <div class="form-group english_input">
                                                    {!! Form::label('en_product_name', 'Product Name (English)', ['class' => 'col-sm-2 control-label']) !!}
                                                    <div class="col-sm-10">
                                                        {!! Form::text('en_product_name', ($product) ?$product->english->product_name : null , ['class' => 'form-control required','id'=>'en_product_name','placeholder'=>"Product Name(English)"]) !!}
                                                    </div>
                                                </div> -->
                                                <div class="form-group french_input">
                                                    {!! Form::label('fr_product_name', 'Nom produit', ['class' => 'col-sm-2 control-label']) !!}
                                                    <div class="col-sm-10">
                                                        {!! Form::text('fr_product_name', ($product && !empty($product->french)) ?$product->french->product_name : null , ['class' => 'form-control','id'=>'fr_product_name','placeholder'=>"Product Name(French)"]) !!}
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    {!! Form::label('serial_number', 'Numéro de série / Code BAR', ['class' => 'col-sm-2 control-label']) !!}
                                                    <div class="col-sm-10">
                                                        {!! Form::text('serial_number', ($product) ?$product->sku : null, ['class' => 'form-control required','id'=>'serial_number','placeholder'=>"Serial Number / BAR Code"]) !!}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {!! Form::label('product_url', "Clé d'URL", ['class' => 'col-sm-2 control-label']) !!}
                                                    <div class="col-sm-10">
                                                        {!! Form::text('product_url', ($product) ?$product->url->request_url : null, ['class' => 'form-control','required' => 'required','id'=>'product_url','placeholder'=>"URL Key"]) !!}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {!! Form::label('price', 'Prix', ['class' => 'col-sm-2 control-label']) !!}
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            {!! Form::label('original_price', "Prix d'origine", ['class' => 'col-sm-4 control-label']) !!}
                                                            <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-eur" aria-hidden="true"></i>
                                                            </span>
                                                                {!! Form::text('original_price', ($product) ?$product->original_price : null, ['class' => 'form-control','required' => 'required','id'=>'original_price','placeholder'=>"0.00"]) !!}
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 ">
                                                            {!! Form::label('best_price', 'Meilleur prix', ['class' => 'col-sm-4 control-label']) !!}
                                                            <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-eur" aria-hidden="true"></i>
                                                            </span>
                                                                {!! Form::text('best_price', ($product) ?$product->best_price : null, ['class' => 'form-control','id'=>'best_price','placeholder'=>"0.00"]) !!}
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-group tag-autocomplete">
                                                    {!! Form::label('product_tag', 'Marque du produit', ['class' => 'col-sm-2 control-label']) !!}
                                                    <div class="col-sm-10">
                                                    <span class="search-box-container">
                                                        <span class="search-box">
                                                            <ul>
                                                                <?php
                                                                $selected_tags = [];
                                                                if(isset($product->tags) && count($product->tags) > 0){
                                                                foreach ($product->tags as $tag){
                                                                $selected_tags[] = $tag->tag_id;
                                                                ?>
                                                                <li class="search-choice" id="{!! $tag->tag_id !!}">
                                                                    <span class="search-box-remove">×</span>
                                                                    {!! $tag->tag !!}
                                                                </li>

                                                                <?php }
                                                                }
                                                                ?>
                                                                <li class="search-input"><input
                                                                            class="form-control auto-complete"></li>
                                                            </ul>
                                                        </span>
                                                    </span>
                                                    </div>
                                                    <input type="hidden" name="product_tag" value="{!! implode(',',$selected_tags) !!}" id="product_tag">
                                                </div>

                                                <div class="hidden form-group">
                                                    <label class="col-sm-2">Marques de produit existants</label>
                                                    <div class="col-sm-10" id="tag-container">
                                                        @foreach($tags as $tag)
                                                            <button type="button" id="{!! $tag->tag_id !!}" class="btn btn-primary btn-sm brand-category-btn">{!! $tag->tag !!}
                                                                @if(auth()->guard('admin')->user()->role_id=='1')
                                                                    <span class="product-tag-close">&times;</span>
                                                                @endif
                                                            </button>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                 <div class="hidden form-group french_input">
                                                        {!! Form::label('fr_summary', 'Résumé', ['class' => 'col-sm-2 control-label']) !!}
                                                        <div class="col-sm-10">
                                                        <textarea class="textarea" placeholder="Résumé" name="fr_summary" id="fr_summary"
                                                                  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                                            @if($product && !empty($product->french))
                                                                {!! $product->french->summary !!}
                                                            @endif
                                                        </textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group french_input">
                                                        {!! Form::label('fr_description', 'Description', ['class' => 'col-sm-2 control-label']) !!}
                                                        <div class="col-sm-10">
                                                        <textarea class="textarea" placeholder="Description" name="fr_description" id="fr_description"
                                                                  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                                            @if($product && !empty($product->french))
                                                                {!! $product->french->description !!}
                                                            @endif
                                                        </textarea>
                                                        </div>
                                                    </div>

                                                    <input type="hidden" name="url_id" value="{!! ($product)?$product->url->sys_url_rewrite_id : '' !!}">
                                                    <input type="hidden" name="old_attribute_set_id" value="">
                                                    <input type="hidden" name="product_id" value="{!! ($product)?$product->product_id : '' !!}">
                                            </div>
                                    </div>
                                </div>
                                </div>
                            </section>
                        </div>
                        <div id="attributes" class="tab-pane">

                        </div>
                        <div class="tab-pane" id="tab_2">
                            <div id="uploader">
                                <p>Votre navigateur n'est pas compatible avec Flash, Silverlight ou HTML5.</p>
                            </div>
                            <!-- product Image start-->

                            <section class="content" id="image_content">
                                <div class="row">
                                <div class="col-md-12">
                                    <div class="box">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Les Images téléchargées</h3>
                                        </div>
                                        <div class="box-body">
                                            <table class="table table-bordered" id="image_list">
                                                <thead>
                                                <tr>
                                                    <th width="20%">Image</th>
                                                    <th width="30%">Title</th>
                                                    <th width="30%">Alt</th>
                                                    <th width="10%">Ordre de tri</th>
                                                    <th width="10%">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if($product && count($product->images)> 0)
                                                    @foreach($product->images as $image)
                                                        <tr>
                                                            <td><img src="{!! url("upload/product/$image->image_name") !!}" width="100" height="100"></td>
                                                            <td>
                                                                <input type="hidden" name="product_image_id[]" value="{!! $image->product_image_id !!}">
                                                                <input type="text" name="image_title[]" value="{!! $image->title !!}" class="" style="width: 100%">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="image_alt[]" value="{!! $image->alt !!}" class="" style="width: 100%">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="image_sort_order[]" value="{!! $image->sort_order !!}" class="" style="width: 100%">
                                                            </td>
                                                            <td>
                                                                <a href="javascript://" class="btn delete-image btn-default btn-sm" title="Delete" data-product_image_id="{!! $image->product_image_id !!}" data-image_name="{!! $image->image_name !!}"><i class="fa fa-fw fa-trash"></i></a>
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </section>
                            <!-- product Image start-->



                        </div>
                        <div class="tab-pane" id="tab_3">
                            <div id="category"></div>
                            <input type="hidden" name="categories_id" id="category_id"
                                   value="{!! ($product)?implode(',',$selected_category) : '' !!}">
                        </div>
                        <div class="tab-pane" id="tab_4">
                          @if(isset($product_videos) && count($product_videos) > 0)
                                @foreach($product_videos as $index=>$product_video)
                                    <div class="row form-group option_row video-container" id="{!! $index !!}">
                                        <input type="hidden" name="videos[{!! $index !!}][product_video_id]"
                                               value="{!! $product_video->product_video_id !!}">

                                        <div class="col-xs-3 option_name">
                                            <input type="text" class="form-control" name="videos[{!! $index !!}][name]"
                                                   value="{!! $product_video->video_title !!}"
                                                   placeholder="Vidéo/Titre de presse">
                                        </div>
                                        <div class="col-xs-3 option_value">
                                            <input type="text" class="form-control" name="videos[{!! $index !!}][value]"
                                                   value="{!! $product_video->video_url !!}" placeholder="Link">
                                        </div>
                                        <div class="col-xs-3 button">
                                            <?php $class = ($index > 0) ? 'btn-danger remove_option' : 'btn-primary add_option'; ?>
                                            <button type="button"
                                                    class="btn {!! $class !!}">{!! ($index > 0) ? "Supprimer l'option" : 'Ajouter une option'  !!}</button>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                            <div class="row form-group option_row video-container" id="1">
                                    <div class="col-xs-3 option_name">
                                     <input type="text" class="form-control" name="videos[1][name]"
                                               placeholder="Vidéo/Titre de presse">
                                               </div>
                                    <div class="col-xs-3 option_value">
                                    <input type="text" class="form-control" name="videos[1][value]"
                                               placeholder="Lien0">
                                               </div>
                                    <div class="col-xs-3 button">
                                        <button type="button" class="btn btn-primary add_option">Ajouter une option</button>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="tab-pane" id="tab_5">
                            <div class="box-body">
                            <div class="row form-group">
                                <div class="col-xs-3">
                                    <h5>Quel produit achèteriez-vous?</h5>
                                </div>
                                <div class="col-xs-3">
                                    <input type="text" class="form-control" id="product-search">
                                </div>
                                <div class="col-xs-3">
                                    <button type="button" class="btn btn-primary" data-type="{!! ($product)?'edit':'add' !!}" id="product-search-btn">Chercher
                                    </button>
                                </div>
                            </div>
                                <div class="affiliate-container">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Nom produit</th>
                                            <th>Prix</th>
                                            <th>Image logo</th>
                                        </tr>
                                        </thead>
                                        <tbody class="table-body">
                                        @if(isset($affiliate_product) && count($affiliate_product)>0)
                                            @foreach($affiliate_product as $index=>$item)
                                                <?php $index=$index."_".$index; ?>
                                                <tr>
                                                    <input type="hidden"
                                                           name="searchproduct[{!! $index !!}][affiliate_product_id]"
                                                           value="{!! $item->affiliate_product_id !!}">
                                                    <input type="hidden" name="searchproduct[{!! $index !!}][name]"
                                                           value="{!! $item->product_name !!}">
                                                    <input type="hidden" name="searchproduct[{!! $index !!}][price]"
                                                           value="{!! $item->price !!}">
                                                    <input type="hidden" name="searchproduct[{!! $index !!}][product_url]"
                                                           value="{!! $item->product_url !!}">
                                                    <input type="hidden" name="searchproduct[{!! $index !!}][product_description]"
                                                           value="{!! $item->product_description !!}">
                                                    <input type="hidden" name="searchproduct[{!! $index !!}][advertiser_name]" value="{!! $item->advertiser_name !!}">
                                                    <td><input type="checkbox" checked
                                                               name="searchproduct[{!! $index !!}][select]" value="1"></td>
                                                    <td><img class="product-image" src="{!! $item->product_image !!}"></td>
                                                    <td><strong><a href="{!! $item->product_url !!}" target="_blank">{!! $item->product_name !!}</a></strong>
                                                    <br/>{!! \Illuminate\Support\Str::words(strip_tags($item['product_description']),25) !!}</td>
                                                    <td>{!! format_price($item->price) !!}</td>
                                                    <td>
                                                        <?php
                                                        $img_src = null;
                                                        $epartner_repo = App::make(\App\Repositories\EpartnerRepository::class);
                                                        $epartner = $epartner_repo->getByName($item['advertiser_name']);
                                                        if(!empty($epartner)){
                                                            $img_src = \App\Models\EpartnerMedia::IMAGE_PATH.'/'.$epartner->image;
                                                        }
                                                        ?>
                                                        @if($img_src!=null)
                                                            <img class="product-image" src="{!! url($img_src) !!}">
                                                        @else
                                                            {!!  $item['advertiser_name']!!}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="tab_6">
                            <section class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box-body">

                                            <div class="form-group">
                                                {!! Form::label('fr_title', "Titre", ['class' => 'col-sm-2 control-label']) !!}
                                                <div class="col-sm-10">
                                                    {!! Form::text("fr_title", ($product) ?$product->french->meta_title : null , ['class' => 'form-control','id'=>'fr_title','placeholder'=>"Entrez le nom du produit"]) !!}
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                {!! Form::label('fr_meta_description', "Meta Description", ['class' => 'col-sm-2 control-label']) !!}
                                                <div class="col-sm-10">
                                                    {!! Form::text("fr_meta_description", ($product) ?$product->french->meta_description : null , ['class' => 'form-control','id'=>'fr_meta_description','placeholder'=>"Idem + type de produit"]) !!}
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                {!! Form::label('fr_meta_keywords', "Meta Mot-clé", ['class' => 'col-sm-2 control-label']) !!}
                                                <div class="col-sm-10">
                                                    {!! Form::text("fr_meta_keywords", ($product) ?$product->french->meta_keywords : null , ['class' => 'form-control','id'=>'fr_meta_keywords','placeholder'=>"Idem"]) !!}
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                {!! Form::label('fr_og_title', "OG Titre", ['class' => 'col-sm-2 control-label']) !!}
                                                <div class="col-sm-10">
                                                    {!! Form::text("fr_og_title", ($product) ?$product->french->og_title : null , ['class' => 'form-control','id'=>'fr_og_title','placeholder'=>"Utiliser le modèle: « marque - Nom du modèle sur Clickee »"]) !!}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                {!! Form::label('fr_og_description', "OG Description", ['class' => 'col-sm-2 control-label']) !!}
                                                <div class="col-sm-10">
                                                    {!! Form::text("fr_og_description", ($product) ?$product->french->og_description : null , ['class' => 'form-control','id'=>'fr_og_title','placeholder'=>"Insérer les deux premières lignes de la description","maxlength"=>"200"]) !!}
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>



                        <div class="box-footer">
                            <a href="{!! route('product') !!}" class="btn btn-default">Annuler</a>
                            <button type="submit" class="btn btn-primary pull-right" id="add-product">Sauvegarder
                            </button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
           </div>
        </div>

    </section>
@stop

@section('additional-styles')
    {!! Html::style('backend/plugins/dynatree/src/skin/ui.dynatree.css') !!}
    {!! Html::style('backend/plugins/dropzone/dropzone.css') !!}
    {!! Html::style('backend/plugins/plupload/js/jquery.plupload.queue/css/jquery.plupload.queue.css') !!}
    {{--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">--}}
@stop

@section('additional-scripts')
 {!! Html::script('backend/js/product.js') !!}
    {!! Html::script('backend/plugins/dynatree/jquery/jquery-ui.custom.js') !!}
    {!! Html::script('backend/plugins/dynatree/src/jquery.dynatree.js') !!}
    {!! Html::script('backend/plugins/dropzone/dropzone.js') !!}
    {!! Html::script('backend/plugins/plupload/js/plupload.full.min.js') !!}
    {!! Html::script('backend/plugins/plupload/js/jquery.plupload.queue/jquery.plupload.queue.js') !!}
    {!! Html::script('backend/plugins/select2/select2.js') !!} 
   

@stop

@section('footer-scripts')
    <script type="application/javascript" language="JavaScript">
        var category_tree_data = '{!! json_encode($categories['tree_data'],JSON_HEX_APOS) !!}';
        var selected_category = '{!! json_encode($selected_category,JSON_HEX_APOS) !!}'
        var admin_role_id = "{!! auth()->guard('admin')->user()->role_id !!}";
    </script>

@stop

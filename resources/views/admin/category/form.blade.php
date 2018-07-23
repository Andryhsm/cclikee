<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Gérer la catégorie</h3>
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-info" id="add_root_category">Catégorie racine</button>
            <button type="button" class="btn btn-info" id="add_sub_category">Sous catégorie</button>
            <button type="button" class="btn btn-info" id="delete_category">Effacer</button>
        </div>

    </div>
    {!! Form::open(['url' => route('save_category'), 'class' => 'form-horizontal','id' =>'category_form']) !!}
        <div class="box-body">
            <!-- <div class="form-group english_input">
                {!! Form::label('en_category_name', 'Category Name (English)', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('en_category_name',null , ['class' => 'form-control required','id'=>'en_category_name','placeholder'=>"Category Name(English)"]) !!}
                </div>
            </div> -->

            <div class="form-group french_input">
                {!! Form::label('fr_category_name', 'Nom catégorie', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('fr_category_name',null , ['class' => 'form-control','id'=>'fr_category_name','placeholder'=>"Nom catégorie"]) !!}
                </div>
            </div>

            <!--<div class="form-group">
                {!! Form::label('category_url', 'Catégorie Url', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('category_url',null , ['class' => 'form-control required','id'=>'category_url','placeholder'=>"Catégorie Url"]) !!}
                </div>
            </div>-->

            <div class="form-group">
                {!! Form::label('is_active', "c'est actif", ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::checkbox('is_active', '1',false) !!}
                </div>
            </div>
            <!-- <div class="form-group english_input">
                {!! Form::label('en_category_description', 'Category Description (English)', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    <textarea class="" id="en_category_description" placeholder="Description" name="en_description"
                              style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
            </div> -->

            <div class="form-group french_input">
                {!! Form::label('fr_category_description', 'Description de la catégorie', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    <textarea class="" id="fr_category_description" placeholder="Description" name="fr_description"
                              style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
            </div>
            <input type="hidden" name="parent_id" value="">
            <input type="hidden" name="url_id" value="">

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="reset" class="btn btn-default">Annuler</button>
            <button type="submit" class="btn btn-info pull-right" id="add-category">Sauvergarder</button>
        </div>
        <!-- /.box-footer -->
    {!! Form::close() !!}
</div>
@extends($layout)
@section('content')
    <section class="content-header">
        <h1>
            Catégorie
        </h1>
    </section>

    <section class="content">
        @include('admin.layout.notification')
        <div class="row">
            <div class="col-md-4">
                <div id="category" class="category-tree"></div>
            </div>
            <div class="col-md-8">
                @include('admin.category.form')
            </div>

        </div>
    </section>
@stop

@section('additional-styles')
    {!! Html::style('backend/plugins/dynatree/src/skin/ui.dynatree.css') !!}

@stop


@section('additional-scripts')
    {!! Html::script('backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') !!}
    {!! Html::script('backend/plugins/dynatree/jquery/jquery-ui.custom.js') !!}
    {!! Html::script('backend/plugins/dynatree/src/jquery.dynatree.js') !!}
    {!! Html::script('backend/js/category.js') !!}
@stop

@section('footer-scripts')
    <script type="application/javascript" language="JavaScript">
        var category_tree_data = '{!! json_encode($categories['tree_data'],JSON_HEX_APOS) !!}';
    </script>

@stop
@extends($layout)
@section('content')
    <section class="content-header">
        <h1>
            Mise à jour rôle
        </h1>
    </section>
<?php
$selected_permission = [];

if ($permissions_by_role && count($permissions_by_role) > 0) {
    foreach ($permissions_by_role as $permission) {
        $selected_permission[] = (int)$permission->permission_id;
    }
}
        ?>
    <section class="content">
        @include('admin.layout.notification')
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    {{ Form::model($role, array('method' => 'PATCH', 'url' => array('admin/role', $role->admin_role_id),'class'=>'validate_form','files' => true)) }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="page_title">Role Name</label>
                            {!! Form::text('role_name',null ,array('class'=>'form-control required', 'placeholder'=>'Last Name')) !!}
                        </div>
                        <div class="tab-pane" id="tab_3">
                            <label for="page_title">Permission</label>
                            <div id="permission"></div>
                          <input type="hidden" name="permission_id" id="permission_id"
                                   value="{!! ($role)?implode(',',$selected_permission) : '' !!}">
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="{!! Url('admin/role') !!}" class="btn btn-default">Annuler</a>
                        <button type="submit save-form" class="btn btn-primary pull-right">Sauvegader</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@stop
@section('additional-styles')
    {!! Html::style('backend/plugins/dynatree/src/skin/ui.dynatree.css') !!}
    {!! Html::style('backend/plugins/dropzone/dropzone.css') !!}

@stop

@section('additional-scripts')
    {!! Html::script('backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') !!}
    {!! Html::script('backend/plugins/dynatree/jquery/jquery-ui.custom.js') !!}
    {!! Html::script('backend/plugins/dynatree/src/jquery.dynatree.js') !!}

    {!! Html::script('backend/plugins/select2/select2.js') !!}
    {!! Html::script('backend/js/role.js') !!}

@stop
@section('footer-scripts')
    <script type="application/javascript" language="JavaScript">
        var category_tree_data = '{!! json_encode($categories['tree_data']) !!}';
        var selected_category = '{!! json_encode($selected_permission) !!}';

    </script>

@stop
@extends($layout)
@section('content')
    <section class="content-header">
        <h1>
            @if($admin)
                Ajouter un nouveau admin
            @else
                Modifier un Admin
            @endif
        </h1>
    </section>

    <section class="content">
        @include('admin.layout.notification')
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    {!! Form::open(array('url' => ($admin) ? "admin/administrator/$admin->admin_id" :route('save_administrator'),'files' => true,'class'=>'','id'=>'admin_user_form')) !!}
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('first_name', 'Nom') !!}
                            {!! Form::text('first_name',($admin) ? $admin->first_name : null , ['class' => 'form-control required','id'=>'first_name','placeholder'=>"Nom"]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('last_name', 'Prénom') !!}
                            {!! Form::text('last_name',($admin) ? $admin->last_name : null , ['class' => 'form-control required','id'=>'last_name','placeholder'=>"Prénom"]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('email_address', 'Email') !!}
                            {!! Form::text('email',($admin) ? $admin->email : null , ['class' => 'form-control required','id'=>'email','placeholder'=>"Email"]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('password', 'Mot de passe') !!}
                            {!! Form::password('password',['class' => 'form-control','id'=>'password','placeholder'=>"Mot de passe"]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('confirm_password', 'Confirmation') !!}
                            {!! Form::password('confirm_password',['class' => 'form-control','id'=>'confirm_password','placeholder'=>"Confirmation"]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('role_id', 'Rôle') !!}
                            {!! Form::select('role_id', $roles,($admin) ? $admin->role_id : null,['class'=>'form-control ','id'=>'']) !!}

                        </div>
                        <div class="form-group">
                            {!! Form::label('profile_image','Photo de profil') !!}
                            {!! Form::file('profile_image',array('class'=>'form-control', 'placeholder'=>'Photo de profil')) !!}
                            @if($admin)
                                <img src="{!! Url("upload/profile/$admin->profile_image") !!}" class="brand-image">
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="is_active">Actif</label>
                            <div class="checkbox">
                                {!! Form::checkbox('is_active', '1',($admin && $admin->is_active=='1') ? true: false) !!}
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="{!! route('administrator') !!}" class="btn btn-default">Annuler</a>
                        <button type="submit" class="btn btn-primary pull-right" id="add-admin">Sauvegarder</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@stop
@section('additional-scripts')
    {!! Html::script('backend/js/admin_user.js') !!}
@stop

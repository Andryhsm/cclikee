@extends($layout)

@section('content')
    @include('admin.layout.notification')
    <section class="content-header">
        <h1>
            Profile
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle"
                             src="{!! $user->getProfileImage() !!}" alt="User profile picture">
                        <h3 class="profile-username text-center">{!! $user->first_name !!} {!! $user->last_name !!}</h3>
                        <p class="text-muted text-center">Administrateur</p>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#settings" data-toggle="tab">Paramètres</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="settings">
                            {{--{!! Form::open(array('url'=>route('profile'),'method'=>'post', 'class'=>'form-horizontal')) !!}--}}
                            {!! Form::model($user, ['method'=>'PATCH', 'route' => ['profile.update',$user->admin_id ], 'id' => 'profile_update', 'class' => 'form-horizontal validate_form','files' => true]) !!}

                            <div class="form-group">
                                {!! Form::label('first_name','Nom',array('class' => 'col-sm-2 control-label')) !!}
                                <div class="col-sm-10">
                                    {!! Form::text('first_name', $user->first_name,array('class'=>'form-control required', 'placeholder'=>'Nom')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('last_name','Prénom',array('class' => 'col-sm-2 control-label')) !!}
                                <div class="col-sm-10">
                                    {!! Form::text('last_name',null ,array('class'=>'form-control required', 'placeholder'=>'Prénom')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('email','Email',array('class' => 'col-sm-2 control-label')) !!}
                                <div class="col-sm-10">
                                    {!! Form::text('email',null,array('class'=>'form-control required', 'placeholder'=>'Email')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('password','Mot de passe',array('class' => 'col-sm-2 control-label')) !!}
                                <div class="col-sm-10">
                                    {!! Form::password('password',array('class'=>'form-control', 'placeholder'=>'Mot de passe')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('profile_image','Photo de profil',array('class' => 'col-sm-2 control-label')) !!}
                                <div class="col-sm-10">
                                    {!! Form::file('profile_image',array('class'=>'form-control ', 'placeholder'=>'Confirmation')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('is_active', 'Actif', ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-10">
                                    {!! Form::checkbox('is_active', '1') !!}
                                </div>

                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger save-form">Enregistrer</button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@extends($layout)
@section('content')
    <section class="content-header">
        <h1>
            Ajouter un nouveau compte
        </h1>
    </section>

    <section class="content">
        @include('admin.layout.notification')
        <div class="row">
            <div class="col-md-12">
                {!! Form::open(array('url' => 'admin/'.$type,'files' => true,'class'=>'user-form form-horizontal','id'=>'account_form')) !!}

                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Information</a></li>
                        @if($type=='customer')
                            <li><a href="#tab_2" data-toggle="tab">Adresse</a></li>
                        @endif
                    </ul>
                    <input type="hidden" name="type" value="{!! $type !!}">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <section class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="page_title">Nom</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="first_name" class="form-control required"
                                                           id="page_title"
                                                           placeholder="Nom">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="content-heading">Prenom</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="last_name" class="form-control required"
                                                           id="content-heading"
                                                           placeholder="Prenom">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="url_key">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="email" class="form-control required"
                                                           id="url_key"
                                                           placeholder="Email">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="url_key">Mot de passe</label>
                                                <div class="col-sm-10">
                                                    <input type="password" name="password" class="form-control"
                                                           id="password"
                                                           placeholder="Mot de passe">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="confirm_password">Confirmation</label>
                                                <div class="col-sm-10">
                                                    <input type="password" name="confirm_password"
                                                           class="form-control required"
                                                           id="confirm_password"
                                                           placeholder="Confirmation">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="is_active">Actif</label>
                                                <div class="col-sm-10 checkbox">
                                                    {!! Form::checkbox('is_active', '1',false) !!}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                {!! Form::label('profile_image','Photo de profil',array('class' => 'col-sm-2 control-label')) !!}
                                                <div class="col-sm-10">
                                                    {!! Form::file('profile_image',array('class'=>'form-control', 'placeholder'=>'Confirmation')) !!}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="phone_number" class="col-sm-2 control-label">Téléphone</label>
                                                <div class="col-sm-10">
                                                    {!! Form::text('phone_number',null,array('class'=>'form-control required', 'placeholder'=>'Téléphone')) !!}
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="radius">Rayon de la recherche (KM)</label>
                                                <div class="col-sm-10">
                                                    {!! Form::select('radius', getRadiusData(), null,['class'=>'form-control']) !!}
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="tab-pane" id="tab_2">
                            <section class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="address1">Adresse 1</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="address1"
                                                           class="form-control required"
                                                           id="address1"
                                                           placeholder="Adresse 1">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="address2">Adresse 2</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="address2"
                                                           class="form-control required"
                                                           id="address2"
                                                           placeholder="Adresse 2">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="company">Nom de la compagnie</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="company" class="form-control required"
                                                           id="company"
                                                           placeholder="Nom de la compagnie">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="city">Ville</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="city"
                                                           class="form-control required"
                                                           id="city"
                                                           placeholder="Ville">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="zip">Code postal</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="zip"
                                                           class="form-control required"
                                                           id="zip"
                                                           placeholder="Code postal">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="country">Etat</label>
                                                <div class="col-sm-10">
                                                    <select name="state_id" id="state" class="form-control required">
                                                        <option value="">Sélectionner un etat</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="country">Pays</label>
                                                <div class="col-sm-10">
                                                    <select name="country_id" id="country"
                                                            class="form-control required">
                                                        <option value="">Sélectionner un pays</option>
                                                        @foreach($countries as $country)
                                                            <option value="{!! $country->id !!}">{!! $country->name !!}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="box-footer">
                            <a href="{!! URL::to('admin/'.$type) !!}" class="btn btn-default">Annuler</a>
                            <button type="submit" class="btn btn-primary pull-right" id="add-account">Sauvergarder</button>
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@stop
@section('additional-scripts')
    {!! Html::script('backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') !!}
    {!! Html::script('backend/js/account.js') !!}
@stop
@section('footer-scripts')
    <script>
        var selected_state_id = '';
        var selected_country_id = '';
    </script>
@stop
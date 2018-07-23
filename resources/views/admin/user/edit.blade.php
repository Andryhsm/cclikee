@extends($layout)
@section('content')
    <section class="content-header">
        <h1>
            Modification du compte
        </h1>
    </section>

    <section class="content">
        @include('admin.layout.notification')
        <div class="row">
            <div class="col-md-12">
                {!! Form::model($users, array('method' => 'PATCH', 'url' => array('admin/'.$type, $users->user_id),'class'=>'user-form form-horizontal','id'=>'account_form','files' => true))!!}

                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Information</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Adresse</a></li>
                    </ul>
                    <input type="hidden" name="type" value="{!! $type !!}">
                    <input type="hidden" name="type" value="{!! $type !!}">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <section class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="page_title" class="col-sm-2 control-label">Nom</label>
                                                <div class="col-sm-10">
                                                    {!! Form::text('first_name',$users->first_name,array('class'=>'form-control required', 'placeholder'=>'Nom')) !!}
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <label for="content-heading" class="col-sm-2 control-label">Prénom</label>
                                                <div class="col-sm-10">
                                                    {!! Form::text('last_name',$users->last_name ,array('class'=>'form-control required', 'placeholder'=>'Prénom')) !!}
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <label for="url_key" class="col-sm-2 control-label">Email</label>
                                                <div class="col-sm-10">
                                                    {!! Form::text('email_address',$users->email ,array('class'=>'form-control required', 'placeholder'=>'Email')) !!}
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <label for="password" class="col-sm-2 control-label">Mot de passe</label>
                                                <div class="col-sm-10">
                                                    <input type="password" name="password" class="form-control"
                                                           id="password"
                                                           placeholder="Mot de passe">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="confirm_password" class="col-sm-2 control-label">Confirmation</label>
                                                <div class="col-sm-10">
                                                    <input type="password" name="confirm_password" class="form-control"
                                                           id="confirm_password"
                                                           placeholder="Confirmation">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="url_key" class="col-sm-2 control-label">Actif</label>
                                                <div class="col-sm-10 checkout">
                                                    {!! Form::checkbox('is_active', '1',($users->status=='1')? true:false) !!}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                {!! Form::label('profile_image','Photo de profil',array('class' => 'col-sm-2 control-label')) !!}
                                                <div class="col-sm-10">
                                                    {!! Form::file('profile_image',array('class'=>'form-control', 'placeholder'=>'Confirmation')) !!}
                                                    @if(isset($users->profile_image) && $users->profile_image!='')
                                                        {{ Form::image('upload/profile/'.$users->profile_image, null, ['class' => 'brand-image'])}}
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="phone_number" class="col-sm-2 control-label">Téléphone</label>
                                                <div class="col-sm-10">
                                                    {!! Form::text('phone_number',$users->phone_number,array('class'=>'form-control required', 'placeholder'=>'Téléphone')) !!}
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="radius">Rayon de la recherche (KM)</label>
                                                <div class="col-sm-10">
                                                    {!! Form::select('radius', getRadiusData(), $users->radius,['class'=>'form-control']) !!}
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
                                        <input type="hidden" name="user_address_id" value="{!! (count($users->address)>0) ? $users->address->user_address_id : '' !!}">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="address1">Adresse 1</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="address1"
                                                           class="form-control required"
                                                           id="address1" value="{!! (count($users->address)>0) ? $users->address->address1:'' !!}"
                                                           placeholder="Adresse 1">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="address2">Adresse 2</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="address2"
                                                           class="form-control required"
                                                           value="{!! (count($users->address)>0) ? $users->address->address2:'' !!}"
                                                           id="address2"
                                                           placeholder="Adresse 2">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="company">Nom de la compagnie</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="company" class="form-control required"
                                                           id="company"
                                                           value="{!! (count($users->address)>0) ?$users->address->company:'' !!}"
                                                           placeholder="Nom de la compagnie">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="city">Ville</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="city"
                                                           class="form-control required"
                                                           id="city"
                                                           value="{!! (count($users->address)>0) ? $users->address->city:'' !!}"
                                                           placeholder="Ville">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="zip">Code postal</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="zip"
                                                           class="form-control required"
                                                           id="zip"
                                                           value="{!! (count($users->address)>0) ? $users->address->zip:'' !!}"
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
                                                            <option value="{!! $country->id !!}" {!! (count($users->address) > 0 && $users->address->country_id==$country->id) ? "selected":'' !!}>{!! $country->name !!}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                        </div>
                        </div>
                    <div class="box-footer">
                        <a href="{!! url('admin/'.$type) !!}" class="btn btn-default">Annuler</a>
                        <button type="submit" class="btn btn-primary pull-right" id="add-account">Sauvegarder</button>
                    </div>
                </div>
                </form>
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
        var selected_state_id = '{!! (count($users->address) >0 && $users->address->state_id && $users->address->state_id!='') ? $users->address->state_id :'' !!}';
        var selected_country_id = '{!! (count($users->address) >0 && $users->address->country_id && $users->address->country_id!='') ? $users->address->country_id :'' !!}';
    </script>
@stop
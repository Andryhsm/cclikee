@if($store && !empty($store->users))
<?php $user_ids = []; ?>
@foreach($store->users as $key=>$user)
    <?php $user_ids[] = $user->user_id; ?>
    <?php 
        $key = $key+1;
     ?>
    <div class="row master_manager" id="{!! $key !!}">
        <div class="col-md-6">
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('last_name', 'Nom', ['class' => '']) !!}
                    {!! Form::text("manager[$key][last_name]", $user->last_name, ['class' => 'form-control required','id'=>'last_name','placeholder'=>"Nom"]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('first_name', 'Prénom', ['class' => '']) !!}
                    {!! Form::text("manager[$key][first_name]",$user->first_name, ['class' => 'form-control required','id'=>'first_name','placeholder'=>"Prénom"]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('password', 'Mot de passe', ['class' => '']) !!}
                {!! Form::password("manager[$key][password]", ['class' => "form-control password".$key."",'id'=>'password','placeholder'=>"Mot de passe",'onkeyup'=>"confirmPassword(".$key.");"]) !!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('sms', 'SMS', ['class' => '']) !!}
                    {!! Form::text("manager[$key][sms]", $user->phone_number, ['class' => 'form-control required','id'=>'sms','placeholder'=>"SMS"]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('email', 'Adresse email *', ['class' => '']) !!}
                    {!! Form::text("manager[$key][email]", $user->email , ['class' => 'form-control required','id'=>'email','placeholder'=>"Adresse email"]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('confirm_password', 'Confirmer le mot de passe', ['class' => '']) !!}
                    {!! Form::password("manager[$key][confirm_password]", ['class' => "form-control confirm_password".$key."",'id'=>'confirm_password','placeholder'=>"Confirmer le mot de passe",'onkeyup'=>"confirmPassword(".$key.");"]) !!}
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="box-body">
                <div class="form-group hidden">
                    <div class="checkbox">
                        <label>
                            <input checked type="checkbox" name="manager[{!! $key !!}][global_manager]" id="global_manager" {!! ($user->pivot->is_global_manager == '1') ? "checked":'' !!} value="1">
                            Compte principal / propriétaire
                        </label>
                    </div>
                </div>
                <div class="form-group hidden">
                    <div class="checkbox">
                        <label>
                            <input checked type="checkbox" name="manager[{!! $key !!}][receive_request]" id="receive_request" {!! ($user->pivot->receive_request == '1') ? "checked":'' !!} value="1">
                            Recevoir une demande d'achat
                        </label>
                    </div>
                </div>
                <div class="form-group hidden">
                    <div class="checkbox">
                        <label>
                            <input checked type="checkbox" name="manager[{!! $key !!}][reply_request]" id="reply_request" {!! ($user->pivot->reply_request == '1') ? "checked":'' !!} value="1">
                            Peut répondre à une demande
                        </label>
                    </div>
                </div>

                <div class="form-group add-user text-center">
                    @if($key > 1)
                        <button type="button" class="btn btn-danger remove_user">Effacer l'utilisateur</button>
                    @else
                        <button type="button" class="btn btn-primary add_user">Ajouter un utilisateur</button>
                    @endif
                </div>
                <input type="hidden" name="manager[{!! $key !!}][manager_id]" id="manager_id" value="{!! $user->user_id !!}">

            </div>
        </div>
    </div>

@endforeach
<input type="hidden" name="old_manager_id" value="{!! implode(',',$user_ids) !!}">


@else
<div class="row master_manager" id="1">
    <div class="col-md-6">
        <div class="box-body">
            <div class="form-group">
                {!! Form::label('last_name', 'Nom', ['class' => '']) !!}
                {!! Form::text('manager[1][last_name]', null , ['class' => 'form-control required','id'=>'last_name','placeholder'=>"Nom"]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('first_name', 'Prénom', ['class' => '']) !!}
                {!! Form::text('manager[1][first_name]', null , ['class' => 'form-control required','id'=>'first_name','placeholder'=>"Prénom"]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('password', 'Mot de passe', ['class' => '']) !!}
                {!! Form::password('manager[1][password]', ['class' => 'form-control password1','id'=>'password','placeholder'=>"Mot de passe",'onkeyup'=>'confirmPassword("1");']) !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box-body">
            <div class="form-group">
                {!! Form::label('sms', 'SMS', ['class' => '']) !!}
                {!! Form::text('manager[1][sms]', null , ['class' => 'form-control required','id'=>'sms','placeholder'=>"SMS"]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email', 'Adresse email *', ['class' => '']) !!}
                {!! Form::text('manager[1][email]', null , ['class' => 'form-control required','id'=>'email','placeholder'=>"Adresse email"]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('confirm_password', 'Mot de passe', ['class' => '']) !!}
                {!! Form::password("manager[1][confirm_password]", ['class' => 'form-control confirm_password1','id'=>'confirm_password','onkeyup'=>'confirmPassword("1");']) !!}
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="box-body">
            <div class="form-group">
                <div class="checkbox hidden">
                    <label>
                        <input checked type="checkbox" name="manager[1][global_manager]" id="global_manager" value="1">
                        Compte principal / propriétaire
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="checkbox hidden">
                    <label>
                        <input checked type="checkbox" name="manager[1][receive_request]" id="receive_request" value="1">
                        Recevoir une demande d'achat
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="checkbox hidden">
                    <label>
                        <input checked  type="checkbox" name="manager[1][reply_request]" id="reply_request" value="1">
                        Peut répondre à une demande
                    </label>
                </div>
            </div>

            <div class="form-group add-user text-center">
                <button type="button" class="btn btn-primary add_user">Ajouter un utilisateur</button>
            </div>


        </div>
    </div>
</div>
@endif
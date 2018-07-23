@extends('front.customer.layout.master')

@section('content')
    <div class="ajax-content">
        <div class="change-password">
            <div class="content col-lg-12">
                <div class="text-center text-update-password">
                    <p>N’hésitez pas à mettre à jour votre mot de passe pour que votre compte CLICKEE soit toujours sécurisé.</p>
                </div>
                <form method="post" action="{!! route('customer-update-password') !!}" id="form-update-password" class="form-content">
                <div class="password-form">
                    <div class="">
                        <label class="col-lg-5 col-md-5 col-sm-5 col-xs-5" for="ancien_password">Mot de passe actuel</label>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 input-group">
                            {{ Form::password('old_password',['class'=>"required customer-form-item",'id'=>'password-old']) }}
                            <span class="input-group-addon">
                                <i class="fa fa-eye" id="old" onclick='iconeyes(this);'></i>
                                <input type='checkbox' class="hidden" id='-old' onchange='togglePassword(this);'>
                            </span>
                        </div>
                        
                    </div>
                    <div class="">
                        <label class="col-lg-5 col-md-5 col-sm-5 col-xs-5" for="new_password">Nouveau mot de passe</label>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 input-group">
                            {{ Form::password('new_password',['class'=>"required customer-form-item",'id'=>'password-new']) }}
                            <span class="input-group-addon">
                                <i class="fa fa-eye" id="new" onclick='iconeyes(this);'></i>
                                <input type='checkbox' class="hidden" id='-new' onchange='togglePassword(this);'>
                            </span>
                        </div>
                        
                    </div>
                </div>
                <div class="text-center mt-20 col-lg-12">
                    <button type="button" class="btn btn-customer-filled" onclick="changepassword();">
                        Sauvegarder
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
@stop

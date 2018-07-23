<!--@extends('merchant.layout.master')

@section('additional-styles')
    {!! Html::style('backend/plugins/datatables/dataTables.bootstrap.css') !!}
    {!! Html::style('frontend/css/font-awesome.min.css') !!}
    {!! Html::style('backend/bootstrap/css/bootstrap.min.css') !!}
    {!! Html::style('backend/plugins/select2/select2.css') !!}
    {!! Html::style('backend/dist/css/AdminLTE.min.css') !!}
    {!! Html::style('backend/dist/css/skins/skin-black-light.css') !!}
    {!! Html::style('backend/css/style.css') !!}

    {!! Html::style('frontend/css/style-clickee.css') !!}
@stop
@section('page_title')
    <div class="section-title col-mm-8  col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <div class="header-item">  
            <div class="title title-active col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="title-icon">
                    <img class="" src="{!! URL::to('/') !!}/images/icon/encasement.svg"/>
                </div> 
                <div class="title-title">
                    <span class="text-title-active">Encaissement</span>
                </div>
            </div>
        </div>
    </div>
@stop
@section('content')
<section class="content-header">
    <h1>
        Ajouter contact
    </h1>
</section>

<section class="content">
    @include('admin.layout.notification')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                {!! Form::open(['url' => ($customer) ? route('customer.update', ['id' => $customer->customer_id]) : Url("merchant/save_contact"), 'id' =>'customer_form', 'enctype' => 'multipart/form-data', 'method' => ($customer) ? 'PATCH' : 'POST']) !!}
                <div class="box-body">                    
                    <div class="row">
                        <div class="form-group col-sm-6">
                            {!! Form::label('firt_name', 'Nom', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('first_name', ($customer) ? $customer->first_name : null , ['class' => 'form-control required','id'=>'first_name','placeholder'=>"Nom"]) !!}
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            {!! Form::label('last_name', 'Prénom', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('last_name', ($customer) ? $customer->last_name : null , ['class' => 'form-control','id'=>'last_name','placeholder'=>"Prénom"]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            {!! Form::label('address', 'Adresse', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('address', ($customer) ? $customer->address : null , ['class' => 'form-control','id'=>'address','placeholder'=>"Adresse"]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            {!! Form::label('postal_code', 'Code Postal', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('postal_code', ($customer) ? $customer->postal_code : null , ['class' => 'form-control','id'=>'postal_code','placeholder'=>"Code postal"]) !!}
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            {!! Form::label('country', 'Ville', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('country', ($customer) ? $customer->country : null , ['class' => 'form-control','id'=>'country','placeholder'=>"Ville"]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            {!! Form::label('phone_number', 'Téléphone', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('phone_number', ($customer) ? $customer->phone_number : null , ['class' => 'form-control','id'=>'phone_number','placeholder'=>"Téléphone"]) !!}
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            {!! Form::label('birthday', 'Date de naissance', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('birthday', ($customer) ? $customer->birthday : null , ['class' => 'form-control datepicker','id'=>'birthday','placeholder'=>"Date de naissance"]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            {!! Form::label('email', 'Adresse email', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('email', ($customer) ? $customer->email : null , ['type' => 'email', 'class' => 'form-control required','id'=>'email','placeholder'=>"Adresse email"]) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <a href="{!! Url('merchant/promotion') !!}" class="btn btn-default">Annuler</a>
                    <button type="submit" class="btn btn-primary pull-right" id="add-role">Enregistrer</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>
@stop-->
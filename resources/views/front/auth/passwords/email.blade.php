@extends('front.layout.master')

@section('content')
    <section class="content-block default-bg ptb-50">
        <div class="container">
            <div class="section-title animated animated fadeInUp">
                <h2> {!! trans("forgot_password.forgot_password_text")!!}</h2>
            </div>
            <div class="col-lg-12">
                @include('notification')
            </div>
            <div class="login-area">
            {!! Form::open(['route' => 'auth.reset.submit', 'method' => 'post','id'=>'forgot_password_form', 'role' => 'form','name'=>'forgotPasswordform' ,'class'=>'form-horizontal']) !!}
            <div class="">
                <label for="inputEmail3" class="col-sm-3 control-label">{!! trans("forgot_password.email") !!}</label>
                <div class="col-sm-9">
                    {!! Form::input('email', 'email', '', ['class' => 'required','autocomplete' => 'off']) !!}
                </div>
            </div>

            <div class="clearfix">
                <div class="col-sm-offset-3 col-sm-6">
                    <button class="btn btn-default default-btn" id="forgot_password">{!! trans("forgot_password.submit")!!}</button>
                </div>
            </div>
            {!! Form::close() !!}
         </div>
        </div>
    </section>
@stop
@extends('front.layout.master')
@section('content')
    <section class="my-acccount-container ptb-30">
        <div class="container my-account-box">
            <div class="header-title text-center">
                <a href="{!! url(LaravelLocalization::getCurrentLocale().'/customer/request') !!}" >{!! trans('customer.request_management') !!}</a>
            </div>
            <div class="row">
                @include('notification')
                <div class="col-md-6" >
                    <h1>{!! trans('customer.my_info') !!}</h1>
                        <div class="content">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                <div class="row">
                                <span class="user-data"><strong>{!! trans('customer.name') !!}</strong></span>
                                <span class="user-data">{!! $customer->first_name." ".$customer->last_name !!}</span>
                            </div>
                            <div class="row">
                                <span class="user-data"><strong>{!! trans('customer.email') !!}</strong></span>
                                <span class="user-data">{!! $customer->email !!}</span>
                            </div>
                            <div class="row">
                                <span class="user-data"><strong>{!! trans('customer.phone') !!}</strong></span>
                                <span class="user-data">{!! $customer->phone_number !!}</span>
                            </div>
                            <div class="row">
                                <span class="user-data"><strong>{!! trans('customer.radius') !!}</strong></span>
                                <span class="user-data">{!! $customer->radius.' KM' !!}</span>
                            </div>
                            <div class="row">
                                <span class="user-data"><strong>{!! trans('customer.postal_code') !!}</strong></span>
                                <span class="user-data">{!! (isset($customer->address) && count($customer->address)>0) ? $customer->address->zip : '' !!}</span>
                            </div>
                            <div class="row">
                                <a href="#" data-toggle="modal" data-target="#edit_password"
                                   class="edit-profile info-links" id="change_password" edit_type="change_password">{!! trans('customer.change_password') !!}</a>
                            </div>
                            <div class="row">
                                <a class="account-btn edit-profile" data-toggle="modal" data-target="#edit_info"
                                   data-placement="top" title="Quick View" href="#">
                                    {!! trans('customer.edit_info') !!}
                                </a>
                            </div>
                            </div>
                                </div>
                        </div>
                </div>

                    <div class="col-md-6">
                        <h1>{!! trans('customer.complete_order') !!}</h1>
                        <div id="completed-orders-content" class="account-info-box col-md-offset-1 content">
                        </div>
                    </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h1>{!! trans('customer.pending_order') !!}</h1>
                    <div class="content" id="pending-orders-content">
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="modal-area">
            <!-- single-modal-start -->
            <div class="modal fade" id="edit_info" tabindex="-1" role="dialog" aria-hidden="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content my-account">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="login-area">
                                {!! Form::open(array('method' => 'post', 'name' => 'userForm', 'id' =>
                                'userForm', 'url'=>url(LaravelLocalization::getCurrentLocale().'/manage-account'), 'class'=>'validate_form')) !!}
                                <div class="">
                                    <label for="username">{!! trans("form.first_name")!!} <span>*</span></label>
                                    {{ Form::text('first_name',$customer->first_name,['class'=>"required"]) }}
                                </div>
                                <div class="">
                                    <label for="last_name">{!!
                                        trans("form.last_name")!!}<span>*</span></label>
                                    {{ Form::text('last_name', $customer->last_name,['class'=>"required"]) }}
                                </div>
                                <div class="">
                                    <label for="email">{!! trans("customer.email")!!}<span>*</span></label>
                                    {{ Form::text('email', $customer->email,['class'=>"required"]) }}
                                </div>
                                <div class="">
                                    <label for="sms">{!! trans("customer.phone")!!}<span>*</span></label>
                                    {{ Form::text('phone', $customer->phone_number,['class'=>"required"]) }}
                                </div>
                                @if($customer->role_id==1)
                                    <div class="">
                                        <label for="radius">{!! trans("customer.radius")!!}<span>*</span></label>
                                        {{ Form::select('radius',getRadiusData(), $customer->radius,['class'=>"required"]) }}
                                    </div>
                                    <div class="">
                                        <label for="zip">{!! trans("customer.postal_code")!!}<span>*</span></label>
                                        {{ Form::text('zip', (isset($customer->address) && count($customer->address)>0) ? $customer->address->zip : '',['class'=>"required"]) }}
                                    </div>
                                @endif
                                <button type="submit" id="updateUserInfo">{!! trans('customer.update') !!}</button>
                                {{Form::close()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-area">
            <!-- single-modal-start -->
            <div class="modal fade" id="edit_password" tabindex="-1" role="dialog" aria-hidden="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="login-area">
                                {!! Form::open(array('method' => 'post', 'name' => 'userForm', 'id' =>
                                'updatePassword', 'url'=>url(LaravelLocalization::getCurrentLocale().'/change-password'), 'class'=>'validate_form')) !!}
                                <div class="">
                                    <label for="username">{!! trans("form.password")!!} <span>*</span></label>
                                    {{ Form::password('password','',['class'=>"required"]) }}
                                </div>
                                <div class="">
                                    <label for="password">{!!
                                        trans("form.confirm_password")!!}<span>*</span></label>
                                    {{ Form::password('last_name','',['class'=>"required"]) }}
                                </div>

                                <button type="submit" id="updatePassword">{!! trans('customer.update') !!}</button>
                                {{Form::close()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@section('footer-script')
<script>
    $(function(){
        $.fn.customerProfile({
            role_id :"{!! $customer->role_id !!}"
        });
    })
</script>
@stop
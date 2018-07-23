@extends('front.layout.master')

@section('content')

	<?php Session::put('role_user',1); ?>
	      <div class="container">
	      			<div class="member-title text-blue title text-uppercase text-center mb-60 mt-60">
                            <h2>Connectez-vous ou créez un compte</h2>
                    </div>
	                <div role="tabpanel" class="tab-panel tab-panel-customer col-lg-8 col-xs-12 col-md-10 col-sm-10">
	                	<div class="section-title">
	                	</div>
	                    <ul class="nav nav-tabs" style="font-size: 17px !important;" role="tablist">
	                        <li role="presentation" class="active"><a href="#uploadTab" class="notflip" aria-controls="uploadTab" role="tab" data-toggle="tab" id="head-tab-signing">{!! trans("common/label.login_title")!!}</a>
	                        </li>
	                        <li role="presentation"><a class="flip" href="#browseTab" aria-controls="browseTab" role="tab" data-toggle="tab" id="head-tab-register">{!! trans("common/label.register_title")!!}</a>

	                        </li>
	                        <button type="button" class="close" href="javascript:history.back()" aria-label="Close">
	                    </ul>
	                    <div class="tab-content tab-login">
	                    	<div role="tabpanel" class="tab-pane active" id="uploadTab">
	              				@include('front.auth.login', ['role_id' => 1])
	                        </div>
	                        <div role="tabpanel" class="tab-pane" id="browseTab">
	                        	@include('front.auth.register', ['role_id' => 1])
	                        </div>
	                    </div>
	                </div>
	        </div>
	        @include('front.layout.section-avantage')
@stop
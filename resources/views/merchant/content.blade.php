@extends('front.layout.master')

@section('content')

<?php Session::put('role_user',2); ?>

<div class="container mtb-40 tab-panel-customer" id="register_marchant" style="width: 80%">
       <div class="col-lg-12">
                    @include('notification')
                </div>
    <ul class="nav nav-tabs nav-width">
        <li role="presentation" class="active">
            <a class="nav-title notflip" href="#login-merchant-tab" aria-controls="cnxTab" role="tab" data-toggle="tab">CONNEXION</a>
        </li>
        <li role="presentation">
            <a class="nav-title flip" href="#register-merchant-tab" aria-controls="enregTab" role="tab" data-toggle="tab">S'ENREGISTRER</a>
        </li>
    </ul>
    <div class="tab-content"> <!--tab-login-->
        <div role="tabpanel" class="tab-pane active" id="login-merchant-tab">
            @include('merchant.login')

        </div>
        <div role="tabpanel" class="tab-pane" id="register-merchant-tab">
            @include('merchant.register_master')
        </div>
    </div>
</div>
@include('front.layout.section-avantage')
@stop
@section('footer-script')    
    {!! Html::script('backend/plugins/dynatree/jquery/jquery-ui.custom.js') !!}
    {!! Html::script('backend/plugins/select2/select2.js') !!}
    {!! Html::script('backend/plugins/dual-list-box/dual-list-box.js') !!}
    {!! Html::script('backend/plugins/bootstrap-duallistbox-master/src/jquery.bootstrap-duallistbox.js') !!}
    {!! Html::script('frontend/js/store.js') !!}
@stop
@section('additional-script')
    <script type="application/javascript">
        var selected_state_id = '{!! ($store && $store->state_id!='') ? $store->state_id :'' !!}';
        var selected_country_id = '{!! ($store && $store->country_id!='') ? $store->country_id :'' !!}';
    </script>
@stop
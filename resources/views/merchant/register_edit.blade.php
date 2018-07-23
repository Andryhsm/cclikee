@extends('merchant.layout.master')

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
                    <img class="" src="{!! URL::to('/') !!}/images/icon/my_account.svg"/>
                </div> 
                <div class="title-title">
                    <span class="text-title-active">Mon compte</span>
                </div>
            </div>
        </div>
    </div>
@stop

@section('content')
    <section class="content">
        @include('admin.layout.notification')
    
        <div class="bottle">
            <div class="col-md-12">
                <div class="">
                	
                    {!! Form::open(['url' => route('magasin.update',['store' => $store->store_id]) , 'id'=>'store_form', 'method' => 'PATCH', 'role' => 'form','class'=>'edit_product','enctype' => 'multipart/form-data']) !!}
                    <div class="">                    
                        <div class="row mb-20">
                        	<div class="text-center col-lg-12 col-md-12">
                                <strong class="text-uppercase">
                                    Votre magasin
                                </strong>
                            </div>
                        </div>
                        <div class="">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    
                                <div class="form-group">
                                    <label for="shop_name">{!! trans("merchant.shop_name")!!} *</label>
                                    {{Form::text('shop_name', ($store && $store->store_name !='') ? $store->store_name : null ,['class'=>'form-control required'])}}
                                </div>
                                <div class="form-group">
                                    <label for="address1">{!! trans("merchant.address_1")!!} *</label>
                                    {{Form::text('address1', ($store && $store->address1 !='') ? $store->address1 : null,['class'=>'form-control required','id'=>"address1"])}}
                                </div>
                                <div class="form-group">
                                    <label for="address2">{!! trans("merchant.address_2")!!}</label>
                                    {{Form::text('address2', ($store && $store->address2 !='') ? $store->address2 : null,['class'=>'form-control','id'=>"address2"])}}
                                </div>
                                <div class="form-group hidden">
                                    <label for="fix_phone">Numéro de téléphone fixe *</label>
                                    {{Form::text('fix_phone', ($store && $store->fix_phone !='') ? $store->fix_phone : null,['class'=>'form-control required','id'=>"fix_phone"])}}
                                </div>
                                <div class="form-group">
                                    <label for="country">{!! trans("merchant.country")!!}* </label>
                                    <select name="country_id" id="country"
                                            class="form-control required">
                                        <option value="">Choisissez le pays</option>
                                        @foreach($countries as $country)
                                            <option value="{!! $country->id !!}" {!! ($store && $store->country_id == $country->id) ? "selected":"" !!}>{!! $country->name !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="registration_number"> SIREN *</label>
                                    {{Form::text('registration_number', ($store) ? $store->registration_number :  null,['class'=>'form-control required'])}}
                                </div>
                                <div class="form-group">
                                    <label for="city">{!! trans("merchant.city")!!} *</label>
                                    {{Form::text('city', ($store) ? $store->city :  null ,['class'=>'form-control required','id'=>"city"])}}
                                </div>
                                <div class="form-group">
                                    <label for="zip_code">{!! trans("merchant.zip_code")!!} *</label>
                                    {{Form::text('zip_code', ($store) ? $store->zip :  null ,['class'=>'form-control required','id'=>"zip"])}}
                                </div>
                                <div class="form-group hidden">
                                    <label for="cell_phone">Numéro de téléphone portable *</label>
                                    {{Form::text('cell_phone', ($store && $store->cell_phone !='') ? $store->cell_phone : null,['class'=>'form-control required','id'=>"cell_phone"])}}
                                </div>
                                <div class="form-group">
                                    <label for="state">Région *</label>
                                    <select name="state_id" id="state" class="required form-control">
                                        <option value="">Sélectionnez l'état</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        	@if($store)
                                @foreach($store->users as $index=>$user)
                                    {{Form::text('user_id', ($store) ? $user->user_id : null ,['class'=>'hidden'])}}
                                @endforeach
                            @endif
    
                        <div class="">
                            <div class="mtb-20 col-md-12 text-center">
                                <button type="button" class="btn btn-merchant-filled"
                                        id="confirm_position">{!! trans('merchant.confirm_position') !!}</button>
                            </div>
                            <div class="">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        {!! Form::label('latitude', trans('merchant.latitude'), ['class' => 'control-label']) !!}
                                        {!! Form::text('latitude', ($store) ? $store->latitude :  null, ['class' => 'required form-control','id'=>'latitude']) !!}
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        {!! Form::label('longitude', trans('merchant.longitude'), ['class' => 'control-label']) !!}                                
                                        {!! Form::text('longitude', ($store) ? $store->longitude :  null, ['class' => 'required form-control','id'=>'longitude']) !!}
                                        
                                    </div>
                                </div>
                            </div>    
                        </div>
                        <div class="col-lg-12">
                            {!! Form::label('tva', 'Numéro TVA Intracommunautaire', ['class' => 'control-label']) !!}
                            {!! Form::text('tva', ($store) ? $store->tva :  null, ['class' => 'form-control','id'=>'tva']) !!}
                        </div>
                        <!--<div class="col-md-12 hidden">
                            <div class="form-group">
                                {!! Form::label('tva', 'Numéro TVA Intracommunautaire', ['class' => 'control-label']) !!}                                
                                {!! Form::text('tva', ($store) ? $store->tva :  null, ['class' => 'form-control','id'=>'tva']) !!}
                            </div>
                        </div>-->
                        <div class="row mb-20">
                        	<div class="text-center col-lg-12 col-md-12 col-sm-12 col-xs-12  col-md-12 mt-40">
                                <strong class="text-uppercase">
                                    Choisisser les horaires d'ouverture de votre magasin
                                </strong>
                            </div>
                        </div>
                        <?php $i=1; ?>
                        
                        @foreach($store->hours as $hour)
                        <?php 
                            $class = ($hour->opening_hour == null)?"fa-square-o":"fa-check-square";  
                            $disable = ($hour->opening_hour == null)?"disabled":"";
                        ?>
                        <div class="info-one-day col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-10">
                            <div class="form-check col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <a class="open-day" data-day="monday" href="#"><span class="capitalize-text"><i class="fa {!! $class !!}"></i>&nbsp;&nbsp;&nbsp;&nbsp;{!! $hour->day->day_name !!}</span></a>
                                <input type="hidden" name="opening_day_id[{!! $i !!}]" class="form-check-input" value="1"/>
                                <input type="hidden" name="opening_hour_id[{!! $i !!}]" class="form-check-input" value="{!! $hour->opening_hour_id !!}"/>
                            </div>
                            <div style="position: relative">
                                <input type="text" {!! $disable !!} class="col-lg-2 col-md-2 col-sm-2 col-xs-2 form-control open-time w-lg-2" name="opening_hour[{!! $i !!}]" value="{!! $hour->opening_hour !!}">
                            </div><span class="col-lg-2 col-md-2 col-sm-2 col-xs-2 text-center">à</span>
                            <div style="position: relative">
                                <input type="text" {!! $disable !!} class="col-lg-2 col-md-2 col-sm-2 col-xs-2 form-control open-time w-lg-2" name="closure_hour[{!! $i !!}]" value="{!! $hour->closure_hour !!}">
                            </div>
                        </div>
                        <?php $i++; ?>
                        @endforeach
                        <br>
                        <div class="text-center mt-40 mb-20 col-lg-12 col-md-12">
                            <strong class="text-uppercase">
                                {!! trans('merchant.contact') !!}
                            </strong>
                        </div>  
                        <div class="">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="main_phone">{!! trans('merchant.main_phone') !!} *</label>
                                    {!! Form::text('main_phone', ($store) ? $store->phone :  null  , ['class' => 'required form-control','id'=>'main_phone']) !!}
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="main_email">E-mail principal *</label>
                                    {!! Form::text('main_email',($store) ? $store->email :  null , ['class' => 'required form-control','id'=>'main_email']) !!}
                                </div> 
                            </div>
                        </div>
                        <div class="text-center mt-40 mb-20 col-lg-12 col-md-12">
                            <strong class="text-uppercase">
                                {!! trans('merchant.corporate_identity') !!}
                            </strong>
                        </div>
                        <div class="">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    {!! Form::label('logo', trans('merchant.logo'), ['class' => '']) !!}
                                    <label class="file vertically-centered " for="logo">
                                        <span class="text-uppercase">Télécharger un fichier</span>
                                    </label>
                                    {!! Form::file('logo',array('class'=>'form-control','id'=>'logo', 'onchange'=>'fileSelect(this)')) !!}
                                    
                                    <!--@if($store && file_exists(public_path('upload/logo/'.$store->logo)))
                                        <img src="{!! url('upload/logo/'.$store->logo) !!}" height="100" width="100">
                                    @endif-->
                                </div>
                                <div class="form-group">
                                    {!! Form::label('shop_image', trans('merchant.shop_picture'), ['class' => '']) !!}
                                    <label class="file vertically-centered " for="shop_image">
                                        <span class="text-uppercase">Télécharger un fichier</span>
                                    </label>
                                    {!! Form::file('shop_image',array('class'=>'form-control','id'=>'shop_image', 'onchange'=>'fileSelect(this)')) !!}
                                    <!--@if($store && file_exists(public_path('upload/shop/'.$store->shop_image)))
                                        <img src="{!! url('upload/shop/'.$store->shop_image) !!}" height="100" width="100">
                                    @endif-->
                                </div>
                            </div>                   
                            
    
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    {!! Form::label('short_description', trans('merchant.short_description'), ['class' => '']) !!}
                                    <textarea class="form-control" id="short_description" cols="30" rows="6" placeholder="Short Description"
                                              name="short_description">
                                        @if($store)
                                            {!!  $store->short_description !!}
                                        @endif
                                    </textarea>
                                </div>        
                            </div>
                        </div>
    
                         <div class="text-center mt-40 mb-20 col-lg-12 col-md-12">
                            <strong class="text-uppercase">
                                Directeur(s)
                            </strong>
                        </div>
    
                            <div class="row hidden">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mr-l-25">
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" checked="checked">
                                                {!! trans('merchant.same_as_primary') !!}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            @if(!empty($store->users) && count($store->users)>0)
                            <?php $old_manager_id = []; ?>
                            @foreach($store->users as $index=>$user)
                             <?php $key = $index+1;
                                   $old_manager_id[] =  $user->user_id;
                             ?>
                            <div class="master_manager" id="{!! $key !!}">
                                <div class="hidden">
                                    <div class="add-user">
                                        @if($key=='1')
                                            <label><button type="button" class="simple-btn btn btn-merchant-filled">{!! trans('merchant.add_user') !!}</button> </label>
                                        @else
                                            <label><button type="button" class="simple-btn btn btn-merchant-filled remove_user">{!! trans('merchant.remove_user') !!}</button> </label>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12 mb-20 title-master-manager">
                                    @if($key=='1')
                                        <i class="fa fa-circle-o mr-10"></i>
                                        <span> {!! trans('merchant.main_account') !!} / {!! $user->first_name !!} {!! $user->last_name !!}</span>
                                    @else
                                        <span> {!! trans('merchant.account') !!} #{!! $key !!} &nbsp;&nbsp;&nbsp;&nbsp; <a class="remove_user"><i class="fa fa-trash-o" aria-hidden="true"></i></a> </span>
                                    @endif    
                                </div>
                                <div class="">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            {!! Form::label('last_name', trans('merchant.last_name'), ['class' => '']) !!}
                                            {!! Form::text("manager[".$key."][last_name]", ($store && $user!=null) ?$user->last_name:null , ['class' => 'form-control required','id'=>'last_name']) !!}
                                            <input type="hidden" name="manager[{!! $key !!}][manager_id]" value="{!! ($store && $user!=null) ? $user->user_id:null  !!}">
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('sms', trans('merchant.phone'), ['class' => '']) !!}
                                            {!! Form::text("manager[".$key."][sms]", ($store && $user!=null) ? $user->phone_number:null, ['class' => 'required form-control','id'=>'sms']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('password', trans('merchant.password'), ['class' => '']) !!}
                                            {!! Form::password("manager[".$key."][password]", ['class' => "form-control password".$key."",'id'=>'password','onkeyup'=>"confirmPassword(".$key.");"]) !!}
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            {!! Form::label('first_name', trans('merchant.first_name'), ['class' => '']) !!}
                                            {!! Form::text("manager[".$key."][first_name]",($store && $user!=null) ? $user->first_name:null, ['class' => 'form-control required','id'=>'first_name']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('email', 'E-mail', ['class' => '']) !!}
                                            {!! Form::text("manager[".$key."][email]", ($store && $user !=null) ? $user->email:null, ['class' => 'required form-control','id'=>'email']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('confirm_password', trans('merchant.confirm_password'), ['class' => '']) !!}
                                            {!! Form::password("manager[".$key."][confirm_password]", ['class' => "form-control confirm_password".$key."",'id'=>'confirm_password','onkeyup'=>"confirmPassword(".$key.");"]) !!}
                                        </div>
                                    </div>
                                </div>                            
    
                                <!-- Anciens checkbox -->
                                <div class="col-md-4 hidden">
                                    <div class="mr-t-23">
                                        <div class="form-group">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" checked="checked" name="manager[{!! $key !!}][global_manager]" id="global_manager" value="1" {!! ($user->pivot->is_global_manager=='1') ? "checked":'' !!}>
                                                    {!! trans('merchant.main_account_owner') !!}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" checked="checked" name="manager[{!! $key !!}][receive_request]" id="receive_request" {!! ($user->pivot->receive_request=='1') ? "checked":'' !!} value="1">
                                                    {!! trans('merchant.receive_purchase_request') !!}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" checked="checked" name="manager[{!! $key !!}][reply_request]" id="reply_request" value="1" {!! ($user->pivot->reply_request=='1') ? "checked":'' !!}>
                                                    {!! trans('merchant.can_reply_to_request') !!}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <input type="hidden" name="old_manager_id" value="{!! implode(',',$old_manager_id) !!}">
                            
                            @endif
                            <div class="col-lg-12 mtb-20 text-center">
                                <button type="button" class="btn btn-merchant-filled call_add_user">{!! trans('merchant.add_user') !!}</button>
                            </div>
                    		               
                    </div>
                    <div class="text-center mt-20 col-lg-12">
                        <button type="submit" class="btn btn-merchant-filled" id="add-role">Sauvegarder</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    
    </section>
    <section class="content">
        <div class="bottle">
            <div class="visa-account">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <img class="pull-right" src="{!! URL::to('/') !!}/images/icon/visa.svg"/>
                </div>
                <div class="mini-height-1 col-lg-6 col-md-6 col-sm-6 col-xs-5">
                    <strong>VISA (0623)</strong><br>
                    <span class="expired">Exp : 09/06</span><br>
                    <span class="text-uppercase">DAVID BOITARD</span>
                </div>
                <div class="vertically-centered col-lg-4 col-md-4 col-sm-4 col-xs-5">
                    <a href="" class="btn-icon btn-merchant-filled">
                        <span>Supprimer</span>
                    </a>
                </div>
            </div>
            <span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center mt-20">Ceci est votre mode de paiement par défaut</span>
            <div class="visa-expired col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <img class="mr-10" src="{!! URL::to('/') !!}/images/icon/information.svg"/>
                <span>Cette carte a expiré</span>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="bottle">
            <div class="visa-account">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <img class="pull-right" src="{!! URL::to('/') !!}/images/icon/visa.svg"/>
                </div>
                <div class="mini-height-1 col-lg-6 col-md-6 col-sm-6 col-xs-5">
                    <strong>VISA (3485)</strong><br>
                    <span class="expired">Exp : 10/19</span><br>
                    <span class="text-uppercase">DAVID BOITARD</span>
                </div>
                <div class="vertically-centered col-lg-4 col-md-4 col-sm-4 col-xs-5">
                    <a href="" class="btn-icon btn-merchant-filled">
                        <span>Supprimer</span>
                    </a>
                </div>
            </div>
            <span class="default-payment col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center mt-20">
                <i class="fa fa-circle-o mr-10"></i> Définir comme mode de paiement par défaut
            </span>
        </div>
    </section>
@stop
@section('additional-script')
    {!! Html::script('frontend/js/store.js') !!}
@stop
@section('footer-scripts')
    <script>
        var selected_state_id = '{!! ($store && $store->state_id!='') ? $store->state_id :'' !!}';
        var selected_country_id = '{!! ($store && $store->country_id!='') ? $store->country_id :'' !!}';
        console.log('ici')
        function fileSelect(box){
            var filename = $(box).val().split('\\').pop();;
            var id = $(box).attr('id');
            console.log(filename, id)
            console.log($(box).val())
            var label = $('label.file[for="' + id + '"]');
            label.find('span').html(filename).css("color", "#044651");
        }
        /*$('input[type=file]').change(function(){
            var file-name = $(this).attr('data-multiple-caption');
            var input-name = $(this).attr('id');
            var label = $('.file span#' + name).html(file-name);
        });*/
    </script>
@stop
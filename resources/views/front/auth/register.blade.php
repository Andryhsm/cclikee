{{-- @extends('front.layout.master') --}}

{{-- @section('content') --}}
           <!-- register-area-start -->
                    <div class="register-area text-center">
                        <div class="section-title mb-20">
                            <div class="row">
                                    <div class="login-signup-title text-blue title text-uppercase mt-40">
                                        <h2>{!! trans("common/label.sign_up_with")!!} ...</h2>
                                    </div>    
                                     <div class="connect-social-media mt-10">   
                                        <div class="col-md-4">
                                            <button onclick="location.href='{{url('/auth/facebook')}}'" class="btn btn-lg btn-facebook mt-20 col-xs-12">
                                                    <i class="fa rs-size fa-facebook pull-left"></i><span>FACEBOOK</span>
                                            </button>
                                        </div>
                                        <div class="col-md-4">
                                            <button onclick="location.href='{{ url('/auth/google')}}'" class="btn btn-lg btn-google mt-20 col-xs-12">
                                                    <i class="fa rs-size fa-google-plus pull-left"></i><span>GOOGLE</span>
                                            </button>
                                        </div>
                                        <div class="col-md-4">
                                            <button onclick="location.href='{{ url('/auth/twitter')}}'" class="btn btn-lg btn-twitter mt-20 col-xs-12">
                                                    <i class="fa rs-size fa-twitter pull-left"></i><span>TWITTER</span>
                                            </button>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <p class="mb-20 mt-30">{!! trans("common/label.your_count_information_is_protected") !!}</p>
                </div>
                        <!-- register-area-end -->
            <div class="or-with-title text-blue mt-30">
                    <h2>
                        <span>{!! trans("common/label.or_with")!!}</span>
                    </h2>
            </div>  
            <div class="account-area mb-40 mt-50">
            <div class="row">
                @include('notification')
                <div class="register-area">
                    {!! Form::open(['url' => route('sign-up'), 'id'=>'account_form', 'method' => 'post', 'role' => 'form','class'=>'form-horizontal','autocomplete'=>'off']) !!}
                    <input type="hidden" name="role_id" value="{!! $role_id !!}">
                    <div class="member-title text-blue title text-uppercase text-center mb-40">
                            <h2>informations membre</h2>
                    </div>
                    <div class="col-md-12">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-20">
                            <!-- register-area-start -->
                            <div class="register-area">
                                <p>
                                    <span><a href="#" class="gender mt-30 mr-20" id="Femme">
                                        <i class="fa fa-dot-circle-o"></i>&nbsp;&nbsp;&nbsp;&nbsp;Mme
                                    </a></span>
                                    <span><a href="#" class="gender mt-30" id="Homme">
                                        <i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp;&nbsp;M
                                    </a></span>
                                    {{ Form::text('gender', "Femme" ,['class'=>"hidden", 'id' =>'gender']) }}
                                </p>
                                <div class="form-group row mb-0">
                                    <div class="col-sm-12">   
                                        {{Form::text('first_name', '',['class'=>'required form-control', 'placeholder' => trans("form.first_name") . " *"])}}
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-sm-12">     
                                        {{Form::text('last_name', '',['class'=>'required form-control', 'placeholder' => trans("form.last_name") . " *"])}}
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                     <div class="col-lg-12">
                                        {{ Form::text('birthday', '' ,['class'=>"customer-form-item datepicker", 'placeholder' =>  'Date Anniversaire', 'id' =>'birthday']) }}
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-sm-12">      
                                        {{Form::text('email', '',['class'=>'required form-control', 'placeholder' => trans("form.email_address") . " *"])}}
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-sm-12">     
                                        {{Form::text('phone_number', '',['class'=>' form-control', "placeholder" => trans("form.phone_number") ])}}
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                     <div class="col-sm-12">     
                                        {{Form::password('password',['class'=>'required form-control', 'id'=>"password", 'placeholder' => trans("form.password") . " *"]) }}
                                    </div>
                                </div>
                                <div class="form-group row mb-0"> 
                                     <div class="col-sm-12">     
                                        {{Form::password('confirm_password', ['class'=>'required form-control', 'id'=>"password", 'placeholder' => trans("form.confirm_password") . " *"])}}
                                    </div>
                                </div>
                                <input type="hidden" name="is_active" value="1">
                            </div>
                            <!-- register-area-end -->
                        </div>
                    </div>
                    <div class="other-info col-md-12 mt-10">   
                            <ul class="content-actuality mt-25 mb-30 pb-20">
                                <li>    
                                    <a href="#" class="receive-notification"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Oui, je souhaite recevoir les notifications d’achats par message texte.</a>             
                                </li>
                                <li>
                                    <div class="text-center pt-20 pb-20"> 
                                        <strong>
                                            Vous voulez encore plus d’actualité sur vos achats en local ? Choisissez de <br/>
                                            recevoir la Newsletter Clickee : des offres promotionnelles et toutes les <br/>
                                            nouveautés en avant-première.
                                        </strong>
                                    </div>
                                </li>
                                <li>
                                    <a href="#" class="receive-email mt-30"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Oui, je souhaite recevoir par courriel l’actualité Clickee.</a>
                                </li>
                                
                                
                            </ul>
                              <div class="recaptcha">  
                                <div class="g-recaptcha col-lg-6 col-sm-7 mt-30 mb-50" data-sitekey="6Le5eVsUAAAAAMngnmm0lir8RAwGphWiT4dkI0Dl"></div>
                              </div>
                                <div class="register-footer-area text-center">
                                    <button class="btn btn-submit btn-clickee-default" type="submit" id="register-btn">SHOPPER</button>
                                </div>
                            {!! Form::close() !!}
                            <div class="condition-confidentiality text-center pt-20">
                                <span> {!! trans("common/label.condition_create_account") !!} <a href="">{!! trans("common/label.general_condition") !!}</a></span>
                            </div>
                       </div>
                </div>
            </div>
        </div>
    </div>
{{-- @stop --}}


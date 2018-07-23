{{-- @extends('front.layout.master') --}}
             <!-- register-area-start -->
                    <div class="register-area text-center">
                        <div class="section-title mb-20">
                            <div class="row">
                                    <div class="login-signup-title text-blue title text-uppercase mt-40">
                                        <h2>{!! trans("common/label.sign_in_with")!!} ...</h2>
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
                        </div>
                        <!-- register-area-end -->
            <div class="or-with-title text-blue text-center pt-5 pb-10">
                    <h2>
                        <span>{!! trans("common/label.or_with")!!}</span>
                    </h2>
            </div>  
             <div class="account-area ">
           
            <div class="row">
                <div class="col-lg-12">
                    @include('notification')
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="login-area">
                        <!-- div class="section-title mb-20">
                            <h2>{!! trans("form.member_login")!!}</h2>
                        </div -->
                        <p></p>
                        {!! Form::open(['url' => route('login-post'), 'id'=>'login_form', 'method' => 'post', 'role' => 'form' ,'class'=>'form-horizontal','autocomplete'=>'off']) !!}
                        <div class="form-group row mb-0">
                             <div class="col-sm-12">
                                {{ Form::text('email', '',['class'=>"required form-control", 'placeholder' =>  trans("form.email_address")." *"]) }}
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-sm-12   ">
                                {{ Form::password('password',['class'=>"required form-control", 'placeholder' => trans("form.password")." *"]) }}
                            </div>
                        </div>
                        <p>
                            <a href="#" class="receive-email remember-me mt-30"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp;&nbsp;{!! trans("form.remember")!!}</a>
                        </p>
                        <div class="checkbox mg-18 check-left-for-login hidden">
                            <label for="rememberme" class="">
                                <input type="checkbox" name='memoty' id="remember-check">
                                {!! trans("form.remember")!!}
                            </label>
                        </div>    

                        <a href="{{ url('/forgot-password') }}">{!! trans("form.forgot_password")!!} ? </a>
                        <div class="text-center">
                                <button type="submit" id="login-btn" class="btn btn-clickee-default">SHOPPER</button>
                        </div>
                        {{Form::close()}}
                    </div>
                    <!-- login-area-end -->
                </div>
            </div>
                    
            
    </div>



            <div class="row">
             

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 merchant-top-bottom">
                    <div class="login-area">
                        <!-- <div class="section-title mb-20">
                            <h2>{!! trans("merchant.merchant_login")!!}</h2>
                        </div> -->

                        <p></p>
                        {!! Form::open(['url' => route('merchant-login-post'), 'id'=>'login_form', 'method' => 'post', 'role' => 'form' ,'class'=>'form-horizontal','autocomplete'=>'off']) !!}
                        <div class="form-group row mb-0">
                            <div class="col-sm-12">
                                {{ Form::text('email', '',['class'=>"form-control required", 'placeholder' => trans("form.email_address") ." *"]) }}
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-sm-12">
                                {{ Form::password('password',['class'=>"form-control required", 'placeholder' => trans("form.password") . " *"]) }}
                            </div>    
                        </div>
                        
                        <p>
                            <a href="#" class="receive-email remember-me mt-30"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;&nbsp;&nbsp;{!! trans("form.remember")!!}</a>
                        </p>
                
                        <div class="checkbox mg-18 check-merchant-left hidden">
                            <label for="rememberme">
                                <input class="check-merchant" type="checkbox" name='memoty' id="remember-check">
                                {!! trans("form.remember")!!}
                            </label>
                        </div>

                        <a href="{{ url('/forgot-password') }}">{!! trans("form.forgot_password")!!}</a>
                        <div class="text-center">
                                <button class="btn btn-clickee-default" type="submit" id="login-btn">{!! trans("form.login")!!}</button>
                        </div>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
            
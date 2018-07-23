<ul class="nav nav-tabs hidden" id="myTab" role="tablist">
    <li class="nav-item active">
      <a class="nav-link" id="1-tab" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">Info perso</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="2-tab" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">Choix pack</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="3-tab" data-toggle="tab" href="#tab3" role="tab" aria-controls="tab3" aria-selected="false">Payement</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="4-tab" data-toggle="tab" href="#tab4" role="tab" aria-controls="tab4" aria-selected="false">Boutique</a>
    </li>
  </ul>
  
  <!-- Form en dessus de tout -->
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade active in" id="tab1" role="tabpanel" aria-labelledby="1-tab">
          
        <!--debut info-->
        <div class="member-title text-blue title text-uppercase text-center mtb-40">
          <h2>informations membre</h2>
        </div>
        <!-- register-area-start -->
        <div class="register-area info-width-register">
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
                    {{Form::text('shop_name', '',['class'=>'required form-control', 'id'=>"shop_name", 'placeholder' => "Nom de l'entreprise *"])}}
                </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-sm-12">     
                    {{Form::text('siret', '',['class'=>'required form-control', 'id'=>"siret", 'placeholder' => "Siret *"])}}
                </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-sm-12">      
                    {{Form::text('email', '',['class'=>'required form-control', 'id'=>"email", 'placeholder' => "Adresse mail *"])}}
                </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-sm-12">     
                    {{Form::text('phone_number', '',['class'=>'required form-control', 'id'=>"phone_number", "placeholder" => "Numéro de téléphone *" ])}}
                </div>
            </div>
            <div class="form-group row mb-0">
                 <div class="col-sm-12">     
                    {{Form::password('password',['class'=>'required form-control', 'id'=>"password", 'placeholder' => trans("form.password") . " *"]) }}
                </div>
            </div>
            <div class="form-group row mb-0"> 
                 <div class="col-sm-12">     
                    {{Form::password('confirm_password', ['class'=>'required form-control', 'id'=>"confirm_password", 'placeholder' => trans("form.confirm_password") . " *"])}}
                </div>
            </div>
        </div>
        <!-- register-area-end -->
        <!--fin info-->
        <div class="register-footer-area text-center pt-40">
            <button class="btn btn-submit btn-clickee-default" type="button" id="btn-etape1">SHOPPER</button>
        </div>
        <div class="condition-confidentiality text-center pt-20 pb-40">
            <span> {!! trans("common/label.condition_create_account") !!} <a href="">{!! trans("common/label.general_condition") !!}</a></span>
        </div>
           
    </div>
    <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="2-tab">
        @include('merchant.pack')
    </div>
    <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="3-tab">
        @include('merchant.cart-merchant')
    </div>
    <div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="4-tab">
        @include('merchant.register')
    </div>
  </div>
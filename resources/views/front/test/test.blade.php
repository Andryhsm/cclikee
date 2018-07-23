@extends('front.layout.master')

@section('additional-css')

@stop

@section('content')

<div class="container">
  <ul class="nav nav-tabs" id="myTab" role="tablist">
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
                    {{Form::text('shop_name', '',['class'=>'required form-control', 'placeholder' => "Nom de l'entreprise *"])}}
                </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-sm-12">     
                    {{Form::text('registration_number', '',['class'=>'required form-control', 'placeholder' => "Siret *"])}}
                </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-sm-12">      
                    {{Form::text('email', '',['class'=>'required form-control', 'placeholder' => trans("form.email_address") . " *"])}}
                </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-sm-12">     
                    {{Form::text('phone_number', '',['class'=>'required form-control', "placeholder" => trans("form.phone_number *") ])}}
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
        
        <!--debut-->
        <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 pt-40">
                        <div class="row">
                             <div class="cart-order col-lg-7 col-md-7 col-sm-7 col-xs-12 mb-20">
                                <div class="cart-information row">
                                  <div class="address-fact">
                                      <div class="cart-title">
                                          <h2>ADRESSE DE FACTURATION</h2>
                                      </div>
                                      <div class="info-facture mt-40">
                                          <p>Camille Plantade</p>
                                          <p>60 chemin d’Odos</p>
                                          <p>TARBES</p>
                                          <p>65000</p>
                                          <p>FRANCE</p>
                                          <p>0619840764</p>
                                      </div>
                                  </div>    
                                    <div class="cart-product row">
                                        <div class="content-cart">
                                            <div class="paiement-title">
                                                <h2>PAIEMENT SÉCURISÉ</h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 info">
                                        <ul>
                                            
                                            <li class="text-center">    
                                                <button type="submit" class="btn btn-clickee-default mt-40  text-uppercase">Paiement</button>
                                            </li>
                                        </ul>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="cart-product-list col-lg-5 col-md-5 col-sm-5 col-xs-12 ">
                                <div class="content-cart-product">
                                    <div class="cart-title address-fact">
                                        <h2> 1 ARTICLE </h2>
                                    </div>
                                    <div class="cart-product row">
                                        
                                        <div class="col-lg-11">
                                            <h4>PACKS NAME</h4>
                                        </div>
                                        
                                        <div class="col-lg-1 product-remove pull-right">
                                          <button type="button" onclick="#" class="close">×</button>
                                        </div>
                                    </div>
                                    <div class="cart-product row">
                                        <div class="col-lg-12 fs-16 total-amount">
                                                <span>TOTAL À RÉGLER</span>
                                                <span class="pull-right total_original_amount">10</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                </div>

            </div>
            <!--fin-->
            
    </div>
    <div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="4-tab">
        @include('merchant.register')
    </div>
  </div>
</div>

@endsection

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
                                            <div class="cart-title">
                                                <h2>PAIEMENT SÉCURISÉ  <img class="image-secure" src="{!! URL::to('/').'/images/icon/cadenat.svg' !!}"/></h2>
                                            </div>
                                            <p class="secure-text pb-20">FAITES VOS ACHATS EN TOUTE CONFIANCE AVEC NOTRE PAIEMENT SÉCURISÉ</p>
                                            
                                            <div class="form-group row mb-0">
                                                <label class="col-lg-5 col-md-5 col-sm-12 col-xs-12 fw-400" for="cart_number">Numéro de carte *</label>
                                                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">     
                                                    {{Form::text('cart_number', '',['class'=>'required cart-paye', "placeholder" => "" ])}}
                                                </div>
                                            </div>
                                            <div class="form-group row mb-0">
                                                <label class="col-lg-5 col-md-5 col-sm-12 col-xs-12 fw-400" for="date_expirate">Date d’expiration *</label>
                                                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">     
                                                    {{Form::text('date_expirate', '',['class'=>'required cart-paye', "placeholder" => "" ])}}
                                                </div>
                                            </div>
                                            <div class="form-group row mb-0">
                                                <label class="col-lg-5 col-md-5 col-sm-12 col-xs-12 fw-400" for="verif_code">Code de vérification *</label>
                                                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">     
                                                    {{Form::text('verif_code', '',['class'=>'required cart-paye', "placeholder" => "" ])}}
                                                </div>
                                            </div>
                                            <div class="form-group row mb-0">
                                                <label class="col-lg-5 col-md-5 col-sm-12 col-xs-12 fw-400" for="cart_number">Numéro de carte *</label>
                                                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">     
                                                    {{Form::text('cart_number', '',['class'=>'required cart-paye', "placeholder" => "" ])}}
                                                </div>
                                            </div>
                                            
                                            <a href="#" class="save-cart fw-400"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;Sauvegarder cette carte pour recevoir vos recettes.</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 info">
                                        <ul>
                                            
                                            <li class="text-center">    
                                                <button class="btn btn-submit btn-clickee-info-plein pd-10" type="button" id="btn-etape3">CONFIRMER & PAYER</button>
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
                                        <div class="col-lg-2 product-remove pull-right">
                                          <button type="button" class="close close-article fs-22">×</button>
                                        </div>
                                        <div class="col-lg-12 text-center">
                                            <img class="engagement-logo" src="{!! URL::to('/') !!}/images/icon/logo_dans_page.svg" alt="logo"/>
                                            <span class="fs-24 fw-600 pack-name"></span>
                                        </div>
                                        <div class="subscription-type col-lg-12 text-center text-uppercase fs-16 fw-600">
                                            
                                        </div>
                                    </div>
                                    <div class="cart-product row">
                                        <div class="col-lg-12 fs-16 total-amount">
                                                <span class="fw-600">TOTAL À RÉGLER</span>
                                                <span class="pull-right total_original_amount fs-16"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                </div>

            </div>
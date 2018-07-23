<section class="">
        <div class="col-lg-12">
            <div class="">
                <div class="box-body mt-30">
                    <div class="customer_encasement">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                {!! Form::label('last_name', 'Nom', ['class' => 'control-label']) !!}
                                {!! Form::text('last_name', ($customer) ? $customer->last_name : null , ['class' => 'form-control required','id'=>'last_name','placeholder'=>"Nom", 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('address', 'Adresse', ['class' => 'control-label']) !!}
                                {!! Form::text('address', ($customer && $type_customer==1) ? $customer->address->address1 : ($customer) ? $customer->address : null , ['class' => 'form-control','id'=>'address','placeholder'=>"Adresse"]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('country', 'Ville', ['class' => 'control-label']) !!}
                                {!! Form::text('country', ($customer && $type_customer==1) ? $customer->address->city : ($customer) ? $customer->country : null , ['class' => 'form-control','id'=>'country','placeholder'=>"Ville"]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('birthday', 'Date de naissance', ['class' => 'control-label']) !!}
                                {!! Form::text('birthday', ($customer) ? $customer->birthday : null , ['class' => 'form-control datepicker','id'=>'birthday','placeholder'=>"Date de naissance"]) !!}
                            </div>
                            
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                {!! Form::label('firt_name', 'Prénom', ['class' => 'control-label']) !!}
                                {!! Form::text('first_name', ($customer) ? $customer->first_name : null , ['class' => 'form-control required','id'=>'first_name','placeholder'=>"Prénom", 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('postal_code', 'Code Postal', ['class' => 'control-label required']) !!}
                                {!! Form::text('postal_code', ($customer && $type_customer==1) ? $customer->address->zip : ($customer) ? $customer->postal_code : null , ['class' => 'form-control','id'=>'postal_code','placeholder'=>"Code postal"]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('phone_number', 'Téléphone', ['class' => 'control-label']) !!}
                                
                                {!! Form::text('phone_number', ($customer) ? $customer->phone_number : null , ['class' => 'form-control','id'=>'phone_number','placeholder'=>"Téléphone"]) !!}
                                
                            </div>
                            <div class="form-group">
                                {!! Form::label('email', 'Adresse email', ['class' => 'control-label']) !!}
                                {!! Form::text('email', ($customer) ? $customer->email : null , ['type' => 'email', 'class' => 'form-control required','id'=>'email','placeholder'=>"Adresse email"]) !!}
                                
                            </div>
                        </div>
                    </div>
                    
                    <input type="number" class="hidden" id="type_customer" name="type_customer" value="{!! ($customer) ? $type_customer : null !!}"/>
                    <input type="number" class="hidden" id="customer_id" name="customer_id" value="{!! ($customer && $type_customer==2) ? $customer->customer_id : null !!}"/>
                    <input type="text" class="hidden" id="user_id" name="user_id" value="{!! ($customer && $type_customer==1) ? $customer->user_id : null !!}"/>
                    <input type="text" class="hidden" name="store_id" value="{!! Session::get('store_to_user') !!}"/>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="box-body">
                    <a href="{!! route('client.index') !!}" class="btn btn-merchant-filled">Annuler</a>
                    <button type="button" class="btn btn-merchant-filled pull-right" onclick="validate_customer_info();"> {!! ($customer) ? "Confirmer client" : "Ajouter client"!!}
                    </button>
                    <button type="button" class="btn hidden" id="add-customer" href="#tab_2" data-toggle="tab"> {!! ($customer) ? "Confirmer client" : "Ajouter client"!!}
                    </button>
                </div>
            </div>
        </div>
    </section>
    
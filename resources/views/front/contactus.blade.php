@extends('front.layout.master')
@section('additional-css')
@stop
@section('content')
    <div class="contact-area pt-25 pb-10">
        <div class="container">
            <div class="row contact-us-content">
                @include('notification')
                
                <!-- BEGIN FORM-->
                <form action="{!! route('contact-us-post') !!}" class="default-form" role="form" method="post">
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                        <div class="bg-grey pd-c">
                            <div class="form-group">
                                <label for="subjet">Sujet</label>
                                <select name="subject" class="select_merchant">
                                    <option value="{!! trans('contact.general_request') !!}">{!! trans('contact.general_request') !!}</option>
                                    <option value="{!! trans('contact.error_product_page') !!}">{!! trans('contact.error_product_page') !!}</option>
                                    <option value="{!! trans('contact.best_price_founded') !!}">{!! trans('contact.best_price_founded') !!}</option>
                                    <option value="{!! trans('contact.support') !!}">{!! trans('contact.support') !!}</option>
                                    <option value="{!! trans('contact.press') !!}">{!! trans('contact.press') !!}</option>
                                    <option value="{!! trans('contact.investors') !!}">{!! trans('contact.investors') !!}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Nom - Prenom</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email </label>
                                <input type="text" class="form-control" id="email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="phone">Téléphone </label>
                                <input type="text" class="form-control" id="phone" name="phone">
                            </div>
                        </div>    

                    </div>    
                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">    
                        <div class="bg-grey pd-d">
                            <div class="title">
                                <h2>CONTACTEZ-NOUS</h2>
                            </div>
                            <div class="form-group">
                                <label for="message" style="margin-bottom: 8px;">Message</label>
                                <textarea class="form-control" rows="8" id="message" name="message" style="height: 32.7rem; width: 100%; font-size: 14px; line-height: 18px; border: 4px solid rgb(4, 70, 81); padding: 10px; border-radius: 0px;"></textarea>
                                </div>
                            <div class="pt-10 pb-77 pull-right">
                                <button type="submit" class="btn btn-clickee-info">ENVOYER</button>
                            </div>
                            
                        </div>    
                    </div>    
                </form>
                <!-- END FORM-->

            </div>
        </div>
    </div>
    @include('front.layout.section-avantage')
@stop


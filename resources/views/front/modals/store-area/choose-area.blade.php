<div class="user-zone-info" data-radius="{!! Cookie::has('radius') ? Cookie::get('radius') : 'null' !!}" data-zip-code="{!! Cookie::has('zip-code') ? Cookie::get('zip-code') : 'null' !!}"/>
<div class="modal fade" id="area-modal" role="dialog" data-backdrop="false">
    <div class="modal-dialog" role="document">
            <div class="modal-header">                                                                                                                                  
                <a onclick="removePaddingBody();" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-content">
                        <h5 class="title-area">Bienvenue sur <img class="choose-area-logo-popup " src="{!! URL::to('/') !!}/images/logo_popup.svg" alt="logo clickee"/> !</h5>
                        <p class="small-title-area text-center text-strong">Achetez local depuis chez vous et gagnez du temps
                        en participant au redynamisme de votre ville.</p>
                        <div class="row" style="margin: 0;">
                            <form id="search-store" class="choose-area" action="{!! route('set-location') !!}" method="post">
                                    <?php 
                                             $radius = '';
                                             $radius_lists = getRadiusData(); 
                                             $radius = Cookie::has('radius') ? Cookie::get('radius') : '';
                                    ?>  
                                 <div class="select-area dropdown">
                                    <button class="btn btn-select-area btn-secondary dropdown-toggle dropdown-filter" onclick="show_option_radius(this);" type="button" id="dropdownBrand"  aria-haspopup="true" aria-expanded="false">
                                        <span>5 KM </span><i class="fa fa-angle-down pull-rigth"></i>
                                    </button>
                                    <div class="dropdown-menu mb-30 b">
                                        @foreach($radius_lists as $index=>$value)
                                            <a href="#" class="option-area {!! ($radius == $index) ? 'selected' : '' !!}" onclick="check_icon_round_if_select(this)" data-id="{!! $index !!}"><div class="dropdown-item"><span>{!! $value !!}</span><i class="fa {!! ($radius == $index) ? 'fa-dot-circle-o ' : 'fa-circle-o' !!} pull-right"></i></div></a>
                                        @endforeach
                                    </div>
                                </div>
                                <label class="" for="sel1">autour du</label>
                                <input type="text" class="clickee-input" id="zip-code" placeholder="{!! trans('product.postal_code') !!}" name="zip-code" value="{!! Cookie::has('zip-code') ? Cookie::get('zip-code') : ''  !!}">
                                <input type="text" class="hidden" name="radius" id="input-radius" value="5"/>
                                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                <button type="button" id="check-area-info" onclick="change_area_information(this);" class="col-lg-2 btn btn-clickee-info">OK</button>
                                
                            </form>
                        
                        </div> 
                        <div class="row text-center">
                            <p class="title-radio">Vivez l’expérience Clickee en musique avec votre radio locale ! </p>
                            <button type="button" class="btn btn-clickee-info search-radio text-uppercase" onclick="searchRadio();">Atomic Radio</button>
                        </div>
            </div>
        </div>
</div>
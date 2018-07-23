 <div class="header mt-40">
    <div class="header-container">
        <div class="logo text-center">
            <a href="{!! URL::to('/') !!}">
                <img src="{!! URL::to('/') !!}/images/logo.svg" alt="logo clickee"/>
            </a>
        </div>
        <div class="two-header-section">
            <div class="section-customer col-mm-4 col-xs-12 col-lg-4 col-md-4 col-sm-4">
                <div class="header-item">
                    <div class="avatar">
                        <span class="text-uppercase">
                            {!! auth()->user()->first_name[0] !!}{!! auth()->user()->last_name[0] !!}
                        </span>
                    </div> 
                    <div class="hello-avatar">
                        <span>{!! trans('customer.hello') !!},</span><br>
                        <div class="text-uppercase text-strong"><strong>{!! auth()->user()->first_name !!} {!! auth()->user()->last_name !!}</strong></div>
                    </div>
                </div>
            </div>
            <div class="section-title col-mm-8  col-lg-8 col-md-8 col-sm-12 col-xs-12">
               <!--  <div class="header-item">  
                    <div class="title header-title-active"><img class="pull-left" src="{!! URL::to('/') !!}/images/icon/mes_commandes_en_cours.svg"/> <h2>Mes commandes en cours</h2></div>
                </div> -->
                <div class="header-item">  
                    <div class="title title-active col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="title-icon">
                            <img class="" src="{!! URL::to('/') !!}/images/icon/mes_commandes_en_cours.svg"/>
                        </div> 
                        <div class="title-title">
                            <span class="text-title-active">Mes commandes en cours</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </div>
    
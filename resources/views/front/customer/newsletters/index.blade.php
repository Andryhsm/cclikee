@extends('front.customer.layout.master')

@section('content')
<div class="ajax-content">
    <div class="newsletter col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="newsletter-containt row">
            <div class="newsletter-item-img col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <p><img class="newsletter-img news-img" src="{!! URL::to('/') !!}/images/icon/newsletter_cloche.svg"></img></p>
            </div>
            <div class="newsletter-item col-lg-6 col-md-6 col-sm-6 col-xs-9">
                <p class="title-bold-2">NOUVEAUTÉS</p>
                <p class="newsletter-height">
                    Dernières tendances, nouveautés et conseils : vous avez vu les produits en premier, vous serez les premiers à les avoir
                </p>
            </div>
            <div class="newsletter-item checkbox col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <p>
                    <a onclick="checka(this);" id="new-received-email" class="received-email"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;E-mail</a>
                </p>
                <p>
                    <a onclick="checka(this);" id="new-received-notification" class="received-notification"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;SMS</a>
                </p>
                <p>
                    <a onclick="checka(this);"  id="new-desactivate" class="desactivate"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;Désactiver</a>
                </p>
            </div>
        </div>
    </div>
    <div class="newsletter col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="newsletter-containt row">
            <div class="newsletter-item-img col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <p><img class="newsletter-img promo-img" src="{!! URL::to('/') !!}/images/icon/newsletter_portecle.svg"></img></p> 
            </div>
            <div class="newsletter-item col-lg-6 col-md-6 col-sm-6 col-xs-9">
                <p class="title-bold-2">PROMOS ET SOLDES</p>
                <p class="newsletter-height">
                    Soyez les premiers à réserver vos coups de coeurs pour moins cher.
                </p>
            </div>
            <div class="newsletter-item checkbox col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <p>
                    <a onclick="checka(this);" id="special-received-email" class="received-email"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;E-mail</a>
                </p>
                <p>
                    <a onclick="checka(this);" id="special-received-notification" class="received-notification"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;SMS</a>
                </p>
                <p>
                    <a onclick="checka(this);"  id="special-desactivate" class="desactivate"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;Désactiver</a>
                </p>
            </div>
        </div>
    </div>
    <div class="newsletter col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="newsletter-containt row">
            <div class="newsletter-item-img col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <p><img class="newsletter-img taste-img" src="{!! URL::to('/') !!}/images/icon/newsletter_etoile.svg"></img></p>
            </div>
            <div class="newsletter-item col-lg-6 col-md-6 col-sm-6 col-xs-9">
                <p class="title-bold-2">EXCLUSIVEMENT POUR VOUS</p>
                <p class="newsletter-height">
                    Des exclusivités sur-mesure, qui vous ressemblent, élaborées en fonction de vos précédants achats.
                </p>
            </div>
            <div class="newsletter-item checkbox col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <p>
                    <a onclick="checka(this);" id="exclusive-received-email" class="received-email"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;E-mail</a>
                </p>
                <p>
                    <a onclick="checka(this);" id="exclusive-received-notification" class="received-notification"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;SMS</a>
                </p>
                <p>
                    <a onclick="checka(this);"  id="exclusive-desactivate" class="desactivate"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;Désactiver</a>
                </p>
            </div>
        </div>
    </div>
</div>    
@endsection

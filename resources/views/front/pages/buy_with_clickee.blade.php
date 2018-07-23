@extends('front.layout.master')

@section('content')
    <div class="container-fluid content-page">
        <div class="title pb-30">
            <h2>ACHETER AVEC CLICKEE</h2>
        </div>
        <p>
            Découvrez tous les produits disponibles dans les <strong>boutiques autour de chez vous.</strong>
            Faites votre choix parmi de nombreux produits, en passant par le textile, la décoration d’intérieur
            ou encore les activités près de chez vous.
        </p>
        <p>
            Vos commerçants locaux vous remercient déjà par avance.
        </p>
        <div class="text-center">
             <a href="{!! route('search') !!}" class="btn btn-filled pl-r-30 mb-40 mt-20" style="font-size:16px; padding:10px 50px;">ACHETER</a>
        </div>
         <div class="title title-border-top pt-40 pb-10">
            <h2>NOS SERVICES</h2>
        </div>
        <div class="content-service">
             <div class="service">
                    <p>
                        <div class="title-service"><h4>Paiement 100% sécurisé</h4></div>
                         <span>Passez l’ensemble de vos commandes en toute sécurité.</span>
                    </p>
                </div>
                <div class="service">
                    <p>
                        <div class="title-service"><h4>Soutenez l’économie locale</h4></div>
                        <span>Encouragez votre communauté en achetant dans votre quartier.</span>
                    </p>
                </div>
                <div class="service">
                     <p>
                        <div class="title-service"><h4>Gagnez du temps</h4></div>
                        <span>En un click allez repérer vos articles préférés et récupérez-les en boutique.</span>
                    </p>
                </div>
                <div class="service">
                     <p>
                        <div class="title-service"><h4>Wishlist</h4></div>
                        <span>Composez votre wishlist et partagez la avec vos proches.</span>
                    </p>
                </div>
                <div class="service">
                    <p>
                        <div class="title-service"><h4>Produits neufs</h4></div>
                        <span>Tous les produits que vous pouvez trouver sur Clickee sont neufs.</span>
                    </p>
                </div>
           </div>
    </div>
    @include('front.layout.section-avantage')
@endsection
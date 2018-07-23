@extends('front.layout.master')

@section('content')
    <div class="container-fluid content-page">
        <div class="title pb-30">
            <h2>QUI SOMMES-NOUS ?</h2>
        </div>
        <div class="row">
            <div class="col-mg-5 col-xs-12 img-left-">
                <img src="{!! URL::to('/').'/images/image_qui_somme_nous_1.png' !!}" alt="Kevin Giordan"/>
            </div>
            <div class="col-mg-7 col-xs-12">
                <img class="img-double-quote" src="{!! URL::to('/').'/images/img_doublequote_before.png' !!}"/>
                <p>Bienvenue sur Clickee, la Place de Marché qui va
                    redynamiser votre économie locale.<p>
                <p>Clickee est la Place de Marché qui va vous permettre
                    de faire du shopping en local tout en restant chez
                    vous.</p>
                <p>En quelques cliques vous pouvez consulter les
                    produits vendus par les boutiques qui sont autour de
                    vous. Grâce à Clickee, vous conservez la flexibilité
                    d’un achat en ligne tout en maintenant un contact
                    avec vos commerçants. Vous pouvez rapidement
                    avoir accès aux produits de vos envies et les essayer
                    pour vous assurer que vous ne vous êtes pas trompé.
                </p>
            </div>
        </div>
        <p class="mt-0">
            Si vous avez la moindre question ou que vous souhaitez échanger avec notre équipe, vous pouvez
            nous contacter via le formulaire de contact.<br>
            Vous pouvez également nous suivre en temps réel sur nos réseaux-sociaux. Vous pourrez ainsi
            suivre notre actualité, nos nouveautés et les nouvelles boutiques qui entrent sur la plateforme.</p>
        <p>Alors qu’attendez-vous? Rejoignez-vite notre communauté pour ne plus rien rater.</p>
        <p>Je vous souhaite un bon shopping sur Clickee.</p>
        <img class="img-double-quote-2" src="{!! URL::to('/').'/images/img_doublequote_after.png' !!}"/>
        <div class="sub-title">
            <p><span>Kevin Giordan</span><br>
            <span>Créateur de Clickee</span></p>
        </div>
        <div style="margin-top: 12.5%;" class="title title-border-top pt-40 pb-30">
            <h2>LE CONCEPT</h2>
        </div>
        <p class="mt-0">
            Clickee est la Place de Marché de vos commerçants locaux. En quelques cliques vous pouvez
            consulter tous les produits qui sont disponibles autour de chez vous.</p>
        <p>
            Du textile en passant par la déco d’intérieur ou encore l’épicerie fine, <strong>gagnez du temps</strong> en achetant
            vos produits sur Clickee, tout <strong>en soutenant votre économie locale</strong>. Une fois votre produit réservé,
            vous n’avez plus qu’à aller le chercher dans la boutique où il se trouve. Ainsi, vous maintenez <strong>un
            contact privilégié avec vos commerçants</strong> et pouvez récupérer vos achats rapidement. Fini
            l’interminable attente du colis qui arrive le jour où vous n’êtes pas chez vous.<br>
            <strong>Clickee a été créé pour vous</strong>, shoppers impatients dont le quotidien est tellement occupé que vous
            n’avez plus le temps de prendre le temps.
        </p>
        <div class="title title-border-top pt-40 pb-10">
            <h2>NOTRE EQUIPE</h2>
        </div>
        <img class="equipe-clickee pb-15" src="{!! URL::to('/').'/images/image_qui_somme_nous_2.png' !!}" alt="Notre equipe"/>
        <p>
            <span class="text-important">Kevin</span>, <strong>créateur de Clickee</strong>. Directeur d’une agence de communication, Break-Out Company, il n’est
            jamais satisfait et souhaite toujours aller plus loin dans l’innovation et les services qu’il propose.
            Lui, on peut clairement dire que c’est un peu le papa de Clickee. Il l’a visualisé pendant des mois,
            pour finalement lui donner vie et le chouchouter.
        </p>
        <p>
            <span class="text-important">Camille Plantade</span>, <strong>graphiste novatrice</strong>. Elle est passionnée par son boulot et pond sans arrêt de
            nouvelles idées pour améliorer le design du site et les visuels de Clickee. C’est un peu la maman
            de Clickee, elle l’a façonné et fait venir au monde.
        </p>
        <p>
            <span class="text-important">Marine Monnery</span>, <strong>responsable communication dynamique</strong>. Elle a une connaissance des stratégies
            de communication les plus folles ce qui lui permet d’avoir des idées toujours plus originales. C’est
            un peu la soeur de Clickee, elle est très fière de son frère et en parle partout afin que tout le monde
            soit bien au courant. 
        </p>
         <div class="title title-border-top pt-40">
            <h2>NOS VALEURS</h2>
        </div>
        <p>
            <span class="text-important">LOCAVORISME</span><br>
            Nous souhaitons <strong>soutenir les commerçants locaux</strong> en leur donnant accès à un outil qui leur
            permettra de s’adapter aux nouveaux modes de consommation de leurs clients.
        </p>
        <p>
            <span class="text-important">DYNAMISME</span><br>
            Clickee n’est pas figé et <strong>évolue constamment</strong> dans le but de vous proposez une expérience client
            toujours plus innovante.
        </p>
        <p>
            <span class="text-important">FUN</span><br>
            Nous sommes jeunes, et souhaitons nous épanouir dans notre boulot a quotidien. Notre
            motivation est <strong>de nous faire plaisir à chaque instant</strong>, dans la vie personnelle et la vie
            professionnelle.
        </p>
        <div class="title title-border-top pt-40 mt-40">
            <h2>NOS INVESTISSEURS</h2>
        </div>
        <p>
            C’est grâce à eux que Clickee a pu voir le jour et nous leur en serons éternellement reconnaissant :
        </p>
        <p class="text-center">
            <span class="text-important">Carol Giordan</span><br>
            <span class="text-important">Sacha Colantoni</span><br>
            <span class="text-important">Romane Colantoni</span><br>
            <span class="text-important">Basile Gentil</span><br>
            <span class="text-important">Thomas Cervetti</span><br>
            <span class="text-important">Jean-Baptiste Bullet</span><br>
            <span class="text-important">Farouk Ourabah</span><br>
        </p>
        <p>
            Si vous aussi vous souhaitez rejoindre notre aventure, vous pouvez nous contacter.
        </p>
        <div class="title title-border-top pt-40 pb-20 mt-40">
            <h2>LES CHIFFRES DE CLICKEE</h2>
        </div>
        <div class="row mt--10">
                    <div class="col-mg-3 ">
                        <div class="border-green-dark text-center">
                            <p class="figure">
                                {!! $store_count !!}
                            </p>
                            <p class="figure-name">
                                Boutiques
                            </p> 
                        </div>
                    </div>
                    <div class="col-mg-3">
                        <div class="border-green-dark text-center">
                            <p class="figure">
                                {!! $product_count !!}
                            </p>
                            <p class="figure-name">
                                Produits
                            </p> 
                        </div>
                    </div>
                    <div class="col-mg-3">
                        <div class="border-green-dark text-center">
                            <p class="figure">
                                1
                            </p>
                            <p class="figure-name">
                                Villes
                            </p> 
                        </div>
                    </div>
                    <div class="col-mg-3">
                        <div class="border-green-dark text-center">
                            <p class="figure">
                                {!! $user_count !!}
                            </p>
                            <p class="figure-name">
                                Utilisateurs
                            </p> 
                        </div>
                    </div>
                </div>
    </div>
    @include('front.layout.section-avantage')
@endsection
@section('additional-css')
    <style type="text/css">
        @media (min-width: 1200px)
        {    
            .col-mg-7 {
                width: 56%;
                position: relative;
                min-height: 1px;
                padding-left: 15px;
                padding-right: 15px;
                float: left;
             }
             .col-mg-5 {
                width: 44%;
                position: relative;
                min-height: 1px;
                padding-left: 15px;
                padding-right: 15px;
                float: left;
             }
            .col-mg-3 {
                width: 25%;
                position: relative;
                min-height: 1px;
                padding: 1.5% 0.85%;
                float: left;
             }
        }
    </style>
@endsection
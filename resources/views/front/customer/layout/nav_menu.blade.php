<div class="nav-menu content">
    <ul class="list-menu nav">
        <li class="nav-item active">
            <a class="nav-link {{ set_active(['client/commande-en-cours']) }}" data-url="{!! route('customer-commande-en-cours') !!}" href="{!! route('customer-commande-en-cours') !!}"><img class="pull-left" src="{!! URL::to('/') !!}/images/icon/mes_commandes_en_cours.svg"/><span>Mes commandes en cours</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ set_active(['client/historique-commande']) }}" data-url="{!! route('customer-historique-commande') !!}" href="{!! route('customer-historique-commande') !!}"><img class="pull-left" src="{!! URL::to('/') !!}/images/icon/historique_de_mes_commandes.svg"/><span>Historique de mes commandes</span></a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link {{ set_active(['customer/customer-bills']) }}" data-url="{!! url('/customer/customer-bills') !!}" href="#"><img class="pull-left" src="{!! URL::to('/') !!}/images/icon/mes_factures.svg"/><span>Mes factures</span></a>
        </li> -->
        <li class="nav-item">
            <a class="nav-link {{ set_active(['client/informations-client']) }}" data-url="{!! route('customer-informations-client') !!}"  href="{!! route('customer-informations-client') !!}"><img class="pull-left" src="{!! URL::to('/') !!}/images/icon/mes_informations.svg"/><span>Mes informations</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ set_active(['client/newsletters']) }}" data-url="{!! route('customer-newsletters') !!}" href="{!! route('customer-newsletters') !!}"><img class="pull-left" src="{!! URL::to('/') !!}/images/icon/gestion_des_infolettres.svg"/><span>Gestion des Newsletters</span></a>
        </li>
        <li class="nav-item"> 
            <a class="nav-link {{ set_active(['client/modification-mot-de-passe']) }}" data-url="{!! route('customer-modification-mot-de-passe') !!}" href="{!! route('customer-modification-mot-de-passe') !!}"><img class="pull-left" src="{!! URL::to('/') !!}/images/icon/changer_le_mot_de_passe.svg"/><span>Changer le mot de passe</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ set_active(['client/aide-et-faq']) }}" data-url="{!! route('customer-aide-et-faq') !!}" href="{!! route('customer-aide-et-faq') !!}"><img class="pull-left" src="{!! URL::to('/') !!}/images/icon/aide_et_faq.svg"/><span>Aide & FAQ</span></a>
        </li>
        <li class="nav-item">
            <a class="lougout" href="{!! url('/logout') !!}" ><img class="pull-left" src="{!! URL::to('/') !!}/images/icon/deconnexion.svg"/><span>Déconnexion</span></a>
        </li>
    </ul>
</div>



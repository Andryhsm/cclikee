<div class="nav-menu content">
    <ul class="list-menu nav">
        <li class="nav-item active">
            <a class="nav-link {{ set_active(['marchand/tableau-de-bord','marchand/tableau-de-bord/*']) }}" href="{!! route('merchant-dashboard') !!}">
                <img class="pull-left" src="{!! URL::to('/') !!}/images/icon/dashboard.svg"/><span>Tableau de bord</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ set_active(['magasin','magasin/*']) }}" href="{!! route('magasin.edit',['store' => Session::get('store_to_user')]) !!}">
                <img class="pull-left" src="{!! URL::to('/') !!}/images/icon/my_account.svg"/><span>Mon compte</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ set_active(['marchand/article', 'marchand/article/*']) }}" href="{!! route('article.index') !!}">
                <img class="pull-left" src="{!! URL::to('/') !!}/images/icon/my_product.svg"/><span>Mes produits</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ set_active(['marchand/commande', 'marchand/commande/*']) }}" href="{!! route('commande.index') !!}">
                <img class="pull-left" src="{!! URL::to('/') !!}/images/icon/historique_de_mes_commandes.svg"/><span>Commandes &nbsp;&nbsp; <span class="badge bg-green-dark mr-5">{!! getNumberOrderPending(Auth::id()) !!}</span></span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ set_active(['marchand/code-promo', 'marchand/code-promo/*']) }}" href="{!! route('code-promo.index') !!}">
                <img class="pull-left" src="{!! URL::to('/') !!}/images/icon/code_promo.svg"/><span>Codes promo</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ set_active(['marchand/promotion', 'marchand/promotion/*']) }}" href="{!! URL::to('/marchand/promotion') !!}">
                <img class="pull-left" src="{!! URL::to('/') !!}/images/icon/communication.svg"/><span>Communication</span>
            </a>
        </li>
        <li class="nav-item"> 
            <a class="nav-link {{ set_active(['marchand/encaissement', 'marchand/client/*', 'marchand/customer']) }}" href="{!! route('encasement') !!}">
                <img class="pull-left" src="{!! URL::to('/') !!}/images/icon/encasement.svg"/><span>Encaissement</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="#">
                <img class="pull-left" src="{!! URL::to('/') !!}/images/icon/conge.svg"/><span>Congés</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="lougout" href="{!! url('/logout') !!}" >
                <img class="pull-left" src="{!! URL::to('/') !!}/images/icon/deconnexion.svg"/><span>Déconnexion</span>
            </a>
        </li>
    </ul>
</div>



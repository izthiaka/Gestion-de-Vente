<div id="sidebar-menu">

    <ul class="metismenu" id="side-menu">

        <li class="menu-title">Tableau de Bord</li>

        <li>
            <a href="{{route('admin.dashboard')}}">
                <i class="fe-airplay"></i>
                <span> Dashboard </span>
            </a>
        </li>

        <li>
            <a href="{{route('admin.approvisionnement-list')}}">
                <i class="fe-share-2"></i>
                <span> Approvisionnements </span>
            </a>
        </li>

        <li>
            <a href="{{route('admin.vente-list')}}">
                <i class="fe-dollar-sign"></i>
                <span> Ventes </span>
            </a>
        </li>

        <li class="menu-title mt-2">Paramétres</li>

        <li>
            <a href="{{route('admin.article-list')}}">
                <i class="fe-package"></i>
                <span> Articles </span>
            </a>
        </li>

        <li>
            <a href="{{route('admin.categorie-list')}}">
                <i class="fe-command"></i>
                <span> Categories </span>
            </a>
        </li>

        <li>
            <a href="{{route('admin.user-list')}}">
                <i class="fe-users"></i>
                <span> Utilisateurs </span>
            </a>
        </li>
    </ul>

</div>

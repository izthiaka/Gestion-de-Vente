<div id="sidebar-menu">

    <ul class="metismenu" id="side-menu">

        <li class="menu-title">Tableau de Bord</li>

        <li>
            <a href="{{route('agent.dashboard')}}">
                <i class="fe-airplay"></i>
                <span> Dashboard </span>
            </a>
        </li>

        <li>
            <a href="{{route('agent.approvisionnement-list')}}">
                <i class="fe-share-2"></i>
                <span> Approvisionnement </span>
            </a>
        </li>

        <li>
            <a href="{{route('agent.vente-list')}}">
                <i class="fe-dollar-sign"></i>
                <span> Vente </span>
            </a>
        </li>

        <li class="menu-title mt-2">Paramétres</li>

        <li>
            <a href="{{route('agent.client-list')}}">
                <i class="fe-package"></i>
                <span> clients </span>
            </a>
        </li>
    </ul>

</div>

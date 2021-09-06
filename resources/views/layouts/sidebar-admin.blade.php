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
            <a href="javascript: void(0);">
                <i class="fe-grid"></i>
                <span> Tables </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="nav-second-level" aria-expanded="false">
                <li><a href="tables-basic.html">Basic Tables</a></li>
                <li><a href="tables-layouts.html">Tables Layouts</a></li>
                <li><a href="tables-datatable.html">Data Tables</a></li>
                <li><a href="tables-responsive.html">Responsive Table</a></li>
                <li><a href="tables-tablesaw.html">Tablesaw Table</a></li>
                <li><a href="tables-editable.html">Editable Table</a></li>
            </ul>
        </li>

        <li class="menu-title mt-2">Paramétres</li>

        <li>
            <a href="{{route('admin.user-list')}}">
                <i class="fe-users"></i>
                <span> Utilisateurs </span>
            </a>
        </li>
    </ul>

</div>

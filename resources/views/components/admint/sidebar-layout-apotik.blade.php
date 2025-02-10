<div>
    <div class="app-menu navbar-menu">
        <!-- LOGO -->
        <div class="navbar-brand-box">
            <!-- Dark Logo-->
            <a href="{{route('adm.dashboard')}}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{asset('template/velzon/assets/images/logo-sm.png')}}" alt="" height="22">
                    </span>
                <span class="logo-lg">
                        <img src="{{asset('template/velzon/assets/images/logo-dark.png')}}" alt="" height="17">
                    </span>
            </a>
            <!-- Light Logo-->
            <a href="{{route('adm.dashboard')}}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{asset('template/velzon/assets/images/logo-sm.png')}}" alt="" height="22">
                    </span>
                <span class="logo-lg">
                        <img src="{{asset('template/velzon/assets/images/logo-light.png')}}" alt="" height="17">
                    </span>
            </a>
            <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                <i class="ri-record-circle-line"></i>
            </button>
        </div>

        <div id="scrollbar">
            <div class="container-fluid">

                <div id="two-column-menu">
                </div>
                <ul class="navbar-nav" id="navbar-nav">
                    <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                    <li class="nav-item">
                        <a class="nav-link menu-link @if($firstMenu == "dashboard") active @endif" href="{{route('apoteker.dashboard')}}">
                            <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboard</span>
                        </a>
                    </li>

                    <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">MASTER DATA</span></li>


                    <li class="nav-item">
                        <a class="nav-link menu-link @if($firstMenu == "resep") active @endif" href="{{route('apoteker.prescriptions')}}">
                            <i class="ri-asterisk"></i> <span data-key="t-dashboards">Antrian Resep</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link menu-link @if($firstMenu == "myData") active @endif" href="#sidebarForms" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarForms">
                            <i class="ri-file-list-3-line"></i> <span data-key="t-forms">Data Obat</span>
                        </a>
                        <div class="menu-dropdown navbar-expand @if($firstMenu != "myData") collapse @endif" id="sidebarForms">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="#" class="nav-link @if($secondMenu == "stock") active @endif" data-key="t-basic-elements">Input Stock
                                        Obat</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link @if($secondMenu == "golongan") active @endif" data-key="t-form-select"> Data Obat </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link @if($secondMenu == "obat") active @endif" data-key="t-checkboxs-radios">Stock Opname Obat</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                </ul>
            </div>
            <!-- Sidebar -->
        </div>

        <div class="sidebar-background"></div>
    </div>
</div>

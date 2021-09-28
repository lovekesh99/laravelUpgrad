
    <!-- MENU SIDEBAR-->
    <aside class="menu-sidebar d-none d-lg-block">
        <div class="logo">
            <a href="/">
                <h1>{{CRM_TITLE}}</h1>
            </a>
        </div>
        <div>
            <nav class="navbar-sidebar">
                <ul class="list-unstyled navbar__list">
                    <li>
                        <a  href="{{route('dashboard')}}">
                            <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                    </li>
                    <li>
                        <a href="{{route('leads')}}">
                            <i class="fas fa-chart-bar"></i>Leads</a>
                    </li>
                    <li>
                        <a href="{{route('contacts')}}">
                            <i class="fas fa-users"></i>Contact</a>
                    </li>
                    <li>
                        <a href="{{route('accounts')}}">
                            <i class="far fa-chart-bar"></i>Accounts</a>
                    </li>
                    <li>
                        <a href="{{route('activities')}}">
                            <i class="fas fa-calendar-alt"></i>Activities</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="fas fa-map-marker-alt"></i>Maps</a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
    <!-- END MENU SIDEBAR-->
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="/">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="/">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>

            <li class="nav-item  {{ $menu == 'dashboard' ? 'active' : '' }}">
                                <a href="{{route('dashboard')}}" class="nav-link "><i class="fas fa-fire"></i><span>Guru</span></a>
                        </li>
            <li class="{{ Request::is('guru') ? 'active' : '' }}"><a class="nav-link" href="#">
                <i class="far fa-square"></i> <span>Guru</span></a>
            </li>

            
        
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
            </a>
        </div>
    </aside>
</div>

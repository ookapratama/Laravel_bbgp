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
                <a href="{{ route('dashboard') }}" class="nav-link "><i
                        class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            @if (seesion('role') == 'guru' || session('role') == 'admin')
                <li class="{{ $menu == 'guru' ? 'active' : '' }}"><a class="nav-link" href="{{ route('guru.index') }}">
                        <i class="fas fa-chalkboard-teacher"></i> <span>Guru</span></a>
                </li>
            @endif
            @if (seesion('role') == 'pegawai' || session('role') == 'admin')
                <li class="{{ $menu == 'pegawai' ? 'active' : '' }}"><a class="nav-link"
                        href="{{ route('pegawai.index') }}">
                        <i class="fas fa-users"></i> <span>Pegawai</span></a>
                </li>
            @endif


        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="{{ route('logout') }}" class="btn btn-danger btn-lg btn-block btn-icon-split">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </aside>
</div>

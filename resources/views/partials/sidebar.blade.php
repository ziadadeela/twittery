<!-- BEGIN SIDEBAR -->
<div class="sidebar">
    <div class="logopanel">
        <h1>
            <a href="{{ url('dashboard') }}"></a>
        </h1>
    </div>
    <div class="sidebar-inner">
        <div class="menu-title">
            Welcome <strong>{{ user()->username }}</strong>
        </div>
        <ul class="nav nav-sidebar">
            <li class="{{ \Request::is('dashboard*')?'nav-active active':'' }}">
                <a href="{{ url('dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            @include('partials.menu.menu_item', ['menus'=>\Menus::getMenu('sidebar','active')])
        </ul>
    </div>
</div>
<!-- END SIDEBAR -->
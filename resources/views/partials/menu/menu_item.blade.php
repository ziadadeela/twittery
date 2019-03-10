@foreach($menus as $menu)
    @if($menu->hasChildren('active') && $menu->user_can_access)
        <li class="nav-parent {{ \Request::is(explode(',',$menu->active_menu_url)) ? 'nav-active active':'' }}">
            <a href="#"><i class="{{ $menu->icon }} fa-fw"></i> <span>{{ $menu->name }}</span> <span
                        class="fa arrow"></span></a>
            <ul class="children collapse">
                @include('partials.menu.menu_item', ['menus'=>$menu->getChildren('active')])
            </ul>
        </li>
    @elseif($menu->user_can_access)
        <li class="{{ \Request::is(explode(',',$menu->active_menu_url))?'nav-active active':'' }}">
            <a href="{{ url($menu->url) }}" target="{{ $menu->target??'_self' }}">
                <i class="{{ $menu->icon }} fa-fw"></i> <span>{{ $menu->name }}</span>
            </a>
        </li>
    @endif
@endforeach
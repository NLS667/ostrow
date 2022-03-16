<li class="{{ active_class(isActiveMenuItem($item), 'active') }} nav-item @if(!empty($item->children)) has-treeview @endif">
    <a class="nav-link" href="@if(!empty($item->children))#submenu{{ $item->id }}@else{{ getRouteUrl($item->url, $item->url_type) }}@endif"  @if(!empty($item->open_in_new_tab) && ($item->open_in_new_tab == 1)) {{ 'target="_blank"' }} @endif>
        <i class="fas {{ @$item->icon }} nav-icon"></i>
        {{ $item->name }}
        @if (!empty($item->children))
            <i class="fas fa-angle-left float-right"></i>
        @endif
    </a>
    @if (!empty($item->children))
     <ul class="nav flex-column nav-treeview {{ active_class(isActiveMenuItem($item), 'menu-open') }}" style="display: none; {{ active_class(isActiveMenuItem($item), 'display: block;') }}">
        {{ renderMenuItems($item->children) }}
     </ul>
    @endif
</li>
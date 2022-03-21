<li class="{{ active_class(isActiveMenuItem($item), 'active') }} nav-item">
    @if (!empty($item->children))
        <a class="nav-link"data-toggle="collapse" aria-expanded="true" href="#{{ $item->content }}">
            <span class="sidebar-mini"><i class="material-icons">{{ @$item->icon }}</i></span>
            <span class="sidebar-normal">{{ $item->name }}<b class="caret"></b></span>
    @else
        <a class="nav-link" href="{{ getRouteUrl($item->url, $item->url_type) }}">
            <span class="sidebar-mini"><i class="material-icons">{{ @$item->icon }}</i></span>
            <span class="sidebar-normal">{{ $item->name }}</span>
    @endif        
        </a>
    @if (!empty($item->children))
        <div class="collapse show" id="{{ $item->content }}">
            <ul class="nav">
                {{ renderMenuItems($item->children) }}
            </ul>
        </div>
    @endif

</li>
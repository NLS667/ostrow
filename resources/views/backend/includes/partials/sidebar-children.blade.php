<li class="{{ active_class(isActiveMenuItem($item), 'active') }} nav-item">
    @if (!empty($item->children))
        <a class="nav-link"data-toggle="collapse" aria-expanded="true" href="#{{ $item->content }}">
            <span class="sidebar-mini"><i class="material-icons">{{ @$item->icon }}</i></span>
            <span class="sidebar-normal">{{ $item->name }}<b class="caret"></b></span>
        </a>
        <div class="collapse show" id="{{ $item->content }}">
            <ul class="nav">
                {{ renderMenuItems($item->children, 'backend.includes.partials.sidebar-children') }}
            </ul>
        </div>
    @else
        <a class="nav-link" href="{{ getRouteUrl($item->url, $item->url_type) }}">
            <span class="sidebar-mini"><i class="material-icons">{{ @$item->icon }}</i></span>
            <span class="sidebar-normal">{{ $item->name }}</span>
        </a>
    @endif
</li>
<li class="{{ active_class(isActiveMenuItem($item), 'active') }} nav-item">
    @if (!empty($item->children))
        <a class="nav-link"data-toggle="collapse" aria-expanded="true" href="#{{ $item->content }}">
            <i class="material-icons">{{ @$item->icon }}</i>
            <p>{{ $item->name }}<b class="caret"></b></p>
        </a>
        <div class="collapse show" id="{{ $item->content }}">
            <ul class="nav">
                {{ renderMenuItems($item->children) }}
            </ul>
        </div>
    @else
        <a class="nav-link" href="{{ getRouteUrl($item->url, $item->url_type) }}">
            <i class="material-icons">{{ @$item->icon }}</i>
            <p>{{ $item->name }}</p>
        </a>
    @endif
</li>
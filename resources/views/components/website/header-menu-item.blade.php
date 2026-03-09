<li class="nav-item{{ count($item['children']) > 0 ? ' submenu' : '' }} {{ request()->routeIs(str_replace('/', '.', ltrim(parse_url($item['url'], PHP_URL_PATH), '/'))) || strpos((string)request()->getPathInfo(), ltrim(parse_url($item['url'], PHP_URL_PATH), '/')) === 0 ? 'active' : '' }}">
    <a class="nav-link" href="{{ $item['url'] }}" target="{{ $item['target'] }}">
        @if($item['icon'])
            <i class="fa-solid {{ $item['icon'] }}"></i>
        @endif
        {{ $item['label'] }}
    </a>
    @if(count($item['children']) > 0)
        <ul>
            @foreach($item['children'] as $child)
                <li class="nav-item">
                    <a class="nav-link" href="{{ $child['url'] }}" target="{{ $child['target'] }}">
                        @if($child['icon'])
                            <i class="fa-solid {{ $child['icon'] }}"></i>
                        @endif
                        {{ $child['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</li>

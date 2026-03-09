<li class="nav-item{{ count($item['children']) > 0 ? ' dropdown' : '' }}">
    <a class="nav-link{{ count($item['children']) > 0 ? ' dropdown-toggle' : '' }}"
       href="{{ $item['url'] }}"
       @if(count($item['children']) > 0) id="navbarDropdown{{ $item['id'] }}" role="button" data-bs-toggle="dropdown" @endif
       target="{{ $item['target'] }}">
        @if($item['icon'])
            <i class="fa-solid {{ $item['icon'] }}"></i>
        @endif
        {{ $item['label'] }}
    </a>

    @if(count($item['children']) > 0)
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown{{ $item['id'] }}">
            @foreach($item['children'] as $child)
                <li>
                    <a class="dropdown-item" href="{{ $child['url'] }}" target="{{ $child['target'] }}">
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

<li class="nav-item" style="margin-left: {{ $level * 20 }}px;">
    <a class="nav-link" href="{{ $item['url'] }}" target="{{ $item['target'] }}">
        @if($item['icon'])
            <i class="fa-solid {{ $item['icon'] }}"></i>
        @endif
        {{ $item['label'] }}
    </a>
    @if(count($item['children']) > 0)
        <ul class="nav flex-column ms-3">
            @foreach($item['children'] as $child)
                @include('admin.navigation.partials.preview-item', ['item' => $child, 'level' => $level + 1])
            @endforeach
        </ul>
    @endif
</li>

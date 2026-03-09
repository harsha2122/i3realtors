@php
    $menuData = $navigationService->getMenu($menuSlug ?? 'header-menu');
@endphp

@if($menuData)
    <ul class="navbar-nav {{ $class ?? '' }}">
        @foreach($menuData['items'] as $item)
            @include('components.website.navigation-item', ['item' => $item])
        @endforeach
    </ul>
@endif

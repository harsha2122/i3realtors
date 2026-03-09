<div class="menu-item menu-item-level-{{ $level }}" data-item-id="{{ $item->id }}" data-parent-id="{{ $item->parent_id }}">
    <div class="menu-item-content">
        <div class="menu-item-label">
            @if($item->icon)
                <i class="fa-solid {{ $item->icon }}"></i>
            @endif
            {{ $item->label }}
        </div>
        <div class="menu-item-url">
            <small>{{ $item->is_external ? '🔗 ' : '' }}{{ $item->getUrl() }}</small>
        </div>
        @if(!$item->is_visible)
            <span class="badge bg-warning text-dark mt-1">Hidden</span>
        @endif
    </div>
    <div class="btn-group btn-group-sm">
        <button type="button" class="btn btn-outline-primary" onclick="editItem({{ $item->id }})">
            <i class="fa-solid fa-edit"></i>
        </button>
        <button type="button" class="btn btn-outline-danger" onclick="deleteItem({{ $item->id }})">
            <i class="fa-solid fa-trash"></i>
        </button>
    </div>
</div>

@foreach($item->children as $child)
    @include('admin.navigation.partials.item-list-item', ['item' => $child, 'level' => $level + 1])
@endforeach

<script>
function editItem(itemId) {
    // For now, just reload - in a full implementation, would show a modal
    alert('Edit functionality coming soon. Item ID: ' + itemId);
}
</script>

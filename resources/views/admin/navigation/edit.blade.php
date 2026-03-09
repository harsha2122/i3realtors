@extends('admin.layouts.app')

@section('title', 'Edit Navigation: ' . $menu->name)

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>{{ $menu->name }}</h1>
        <div>
            <a href="{{ route('admin.navigation.preview', $menu) }}" class="btn btn-info" target="_blank">
                <i class="fa-solid fa-eye"></i> Preview
            </a>
            <a href="{{ route('admin.navigation.index') }}" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Menu Settings -->
        <div class="col-md-3">
            <div class="card mb-3">
                <div class="card-header">
                    <h6 class="mb-0">Menu Settings</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.navigation.update', $menu) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="edit_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="edit_name" name="name" value="{{ $menu->name }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit_slug" class="form-label">Slug</label>
                            <input type="text" class="form-control" id="edit_slug" name="slug" value="{{ $menu->slug }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit_position" class="form-label">Position</label>
                            <select class="form-select" id="edit_position" name="position" required>
                                <option value="header" {{ $menu->position == 'header' ? 'selected' : '' }}>Header</option>
                                <option value="footer" {{ $menu->position == 'footer' ? 'selected' : '' }}>Footer</option>
                                <option value="mobile" {{ $menu->position == 'mobile' ? 'selected' : '' }}>Mobile</option>
                                <option value="custom" {{ $menu->position == 'custom' ? 'selected' : '' }}>Custom</option>
                            </select>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="edit_is_active" name="is_active" value="1" {{ $menu->is_active ? 'checked' : '' }}>
                            <label class="form-check-label" for="edit_is_active">Active</label>
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm w-100">
                            <i class="fa-solid fa-save"></i> Update Settings
                        </button>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.navigation.export', $menu) }}" method="GET" style="display: inline;">
                        <button type="submit" class="btn btn-sm btn-outline-secondary w-100 mb-2">
                            <i class="fa-solid fa-download"></i> Export JSON
                        </button>
                    </form>
                    <form action="{{ route('admin.navigation.duplicate', $menu) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-secondary w-100 mb-2">
                            <i class="fa-solid fa-clone"></i> Duplicate Menu
                        </button>
                    </form>
                    <form action="{{ route('admin.navigation.destroy', $menu) }}" method="POST" onsubmit="return confirm('Delete this menu? Items will be permanently deleted.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger w-100">
                            <i class="fa-solid fa-trash"></i> Delete Menu
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Menu Items Editor -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Menu Items (Drag to reorder)</h6>
                </div>
                <div class="card-body">
                    <div id="menu-items-container" class="menu-items-list">
                        @if($menu->items->count() == 0)
                            <div class="alert alert-info">
                                <i class="fa-solid fa-info-circle"></i> No items yet. Add your first menu item below.
                            </div>
                        @else
                            @foreach($menu->rootItems as $item)
                                @include('admin.navigation.partials.item-list-item', ['item' => $item, 'level' => 0])
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <!-- Add Item Form -->
            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="mb-0">Add New Menu Item</h6>
                </div>
                <div class="card-body">
                    <form id="add-item-form" action="{{ route('admin.navigation.addItem', $menu) }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="item_label" class="form-label">Label <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="item_label" name="label" placeholder="e.g., About Us" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="item_icon" class="form-label">Icon</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="item_icon" name="icon" placeholder="e.g., fa-home">
                                        <button type="button" class="btn btn-outline-secondary" id="icon-picker-btn">
                                            <i class="fa-solid fa-icons"></i> Pick
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Link Type <span class="text-danger">*</span></label>
                            <div class="btn-group w-100" role="group">
                                <input type="radio" class="btn-check" name="link_type" id="link_type_route" value="route" checked>
                                <label class="btn btn-outline-primary" for="link_type_route">Route</label>

                                <input type="radio" class="btn-check" name="link_type" id="link_type_url" value="url">
                                <label class="btn btn-outline-primary" for="link_type_url">URL</label>
                            </div>
                        </div>

                        <div class="mb-3" id="route-container">
                            <label for="item_route" class="form-label">Select Route</label>
                            <select class="form-select" id="item_route" name="route_name">
                                <option value="">Choose a route...</option>
                                @foreach($routes as $routeName => $routeLabel)
                                    <option value="{{ $routeName }}">{{ $routeLabel }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3" id="url-container" style="display: none;">
                            <label for="item_url" class="form-label">Enter URL</label>
                            <input type="url" class="form-control" id="item_url" name="url" placeholder="https://example.com">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="item_parent" class="form-label">Parent Item (for submenu)</label>
                                    <select class="form-select" id="item_parent" name="parent_id">
                                        <option value="">None (Top level)</option>
                                        @foreach($menu->items->whereNull('parent_id') as $parentItem)
                                            <option value="{{ $parentItem->id }}">{{ $parentItem->label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="item_target" class="form-label">Link Target</label>
                                    <select class="form-select" id="item_target" name="target_attribute">
                                        <option value="_self">Same Window</option>
                                        <option value="_blank">New Window</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="item_is_visible" name="is_visible" value="1" checked>
                            <label class="form-check-label" for="item_is_visible">Visible</label>
                        </div>

                        <button type="submit" class="btn btn-success">
                            <i class="fa-solid fa-plus"></i> Add Menu Item
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Icon Picker Modal -->
<div class="modal fade" id="iconPickerModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Select Icon</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="text" id="icon-search" class="form-control mb-3" placeholder="Search icons...">
                <div id="icon-list" style="max-height: 400px; overflow-y: auto; display: grid; grid-template-columns: repeat(auto-fill, minmax(50px, 1fr)); gap: 10px;">
                    <!-- Icons will be loaded here -->
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Link type toggle
    document.querySelectorAll('input[name="link_type"]').forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'route') {
                document.getElementById('route-container').style.display = 'block';
                document.getElementById('url-container').style.display = 'none';
                document.getElementById('item_route').required = true;
                document.getElementById('item_url').required = false;
            } else {
                document.getElementById('route-container').style.display = 'none';
                document.getElementById('url-container').style.display = 'block';
                document.getElementById('item_route').required = false;
                document.getElementById('item_url').required = true;
            }
        });
    });

    // Sortable
    const container = document.getElementById('menu-items-container');
    if (container) {
        new Sortable(container, {
            animation: 150,
            ghostClass: 'bg-light',
            onEnd: function() {
                saveOrder();
            }
        });
    }

    // Add item form
    document.getElementById('add-item-form').addEventListener('submit', async function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        const linkType = formData.get('link_type');

        // Clear unused field
        if (linkType === 'route') {
            formData.delete('url');
        } else {
            formData.delete('route_name');
        }

        try {
            const response = await fetch(this.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
                body: formData
            });

            const data = await response.json();

            if (data.success) {
                alert('Menu item added successfully!');
                this.reset();
                location.reload(); // Reload to show new item
            } else {
                alert('Error: ' + data.message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred');
        }
    });

    // Icon picker
    document.getElementById('icon-picker-btn').addEventListener('click', function() {
        new bootstrap.Modal(document.getElementById('iconPickerModal')).show();
        loadIcons();
    });
});

function saveOrder() {
    const items = [];
    document.querySelectorAll('[data-item-id]').forEach(el => {
        items.push({
            id: el.dataset.itemId,
            parent_id: el.dataset.parentId || null
        });
    });

    fetch('{{ route("admin.navigation.reorder", $menu) }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
        body: JSON.stringify({ items })
    }).then(r => r.json()).then(data => {
        if (data.success) {
            console.log('Order saved');
        }
    });
}

function loadIcons() {
    const commonIcons = [
        'fa-home', 'fa-about', 'fa-services', 'fa-cog', 'fa-envelope', 'fa-phone',
        'fa-map', 'fa-building', 'fa-user', 'fa-heart', 'fa-star', 'fa-clock',
        'fa-check', 'fa-arrow-right', 'fa-external-link', 'fa-download', 'fa-upload'
    ];

    const iconList = document.getElementById('icon-list');
    iconList.innerHTML = commonIcons.map(icon =>
        `<button type="button" class="btn btn-sm btn-outline-secondary" onclick="selectIcon('${icon}')">
            <i class="fa-solid ${icon}"></i>
        </button>`
    ).join('');
}

function selectIcon(iconClass) {
    document.getElementById('item_icon').value = iconClass;
    bootstrap.Modal.getInstance(document.getElementById('iconPickerModal')).hide();
}

function deleteItem(itemId) {
    if (!confirm('Delete this item?')) return;

    fetch('{{ route("admin.navigation.deleteItem", "") }}/' + itemId, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
        }
    }).then(r => r.json()).then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Error: ' + data.message);
        }
    });
}
</script>
@endpush

<style>
.menu-items-list {
    list-style: none;
    padding: 0;
}

.menu-item {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 4px;
    padding: 12px;
    margin-bottom: 8px;
    cursor: move;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.menu-item:hover {
    background: #e9ecef;
}

.menu-item-content {
    flex: 1;
}

.menu-item-label {
    font-weight: 500;
}

.menu-item-url {
    font-size: 0.85rem;
    color: #6c757d;
}

.menu-item-level-1 {
    margin-left: 30px;
}

.menu-item-level-2 {
    margin-left: 60px;
}
</style>
@endsection

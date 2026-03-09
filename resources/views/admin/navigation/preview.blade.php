@extends('admin.layouts.app')

@section('title', 'Preview: ' . $menu->name)

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Preview: {{ $menu->name }}</h1>
        <a href="{{ route('admin.navigation.edit', $menu) }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left"></i> Back to Edit
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h6 class="mb-0">Menu Rendering</h6>
        </div>
        <div class="card-body">
            <ul class="nav flex-column">
                @foreach($menuData['items'] as $item)
                    @include('admin.navigation.partials.preview-item', ['item' => $item, 'level' => 0])
                @endforeach
            </ul>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header">
            <h6 class="mb-0">JSON Output</h6>
        </div>
        <div class="card-body">
            <pre><code>{{ json_encode($menuData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</code></pre>
        </div>
    </div>
</div>
@endsection

@extends('admin.layouts.app')

@section('title', 'Edit Property')
@section('page-title', 'Properties')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.properties.index') }}">Properties</a></li>
    <li class="breadcrumb-item active">Edit: {{ Str::limit($property->title, 40) }}</li>
@endsection

@section('content')
<form method="POST" action="{{ route('admin.properties.update', $property->id) }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    @include('admin.properties._form')
</form>
@endsection

@push('scripts')
<script>
function previewThumb(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.getElementById('thumb-preview');
            img.src = e.target.result;
            img.classList.remove('d-none');
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function deleteGalleryImage(id) {
    if (!confirm('Remove this image?')) return;
    fetch('{{ route('admin.properties.image.destroy', '__id__') }}'.replace('__id__', id), {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
        }
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            const el = document.getElementById('img-' + id);
            if (el) el.remove();
        }
    });
}
</script>
@endpush

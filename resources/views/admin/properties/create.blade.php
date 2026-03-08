@extends('admin.layouts.app')

@section('title', 'Add Property')
@section('page-title', 'Properties')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.properties.index') }}">Properties</a></li>
    <li class="breadcrumb-item active">Add New</li>
@endsection

@section('content')
<form method="POST" action="{{ route('admin.properties.store') }}" enctype="multipart/form-data">
    @csrf
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
</script>
@endpush

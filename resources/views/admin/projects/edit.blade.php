@extends('admin.layouts.app')

@section('title', 'Edit Project')
@section('page-title', 'Edit Project')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.projects.index') }}">Projects</a></li>
    <li class="breadcrumb-item active">Edit: {{ Str::limit($project->title, 40) }}</li>
@endsection

@section('content')
<form method="POST" action="{{ route('admin.projects.update', $project->id) }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    @include('admin.projects._form')
</form>
@endsection

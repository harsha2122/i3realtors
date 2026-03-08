@extends('layouts.website')
@section('title', 'Team - {{ \App\Models\Setting::get("site_name", config("app.name")) }}')
@section('content')
<div class="page-header bg-section dark-section" style="padding: 120px 0 60px;">
  <div class="container">
    <h1 class="text-white">Team</h1>
    <p class="text-white-50">This page content will be built in upcoming phases with dynamic data.</p>
  </div>
</div>
@endsection

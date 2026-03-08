@extends('admin.layouts.app')

@section('title', ucfirst($group) . ' Settings')
@section('page-title', 'Settings')
@section('breadcrumb')
    <li class="breadcrumb-item active">{{ ucfirst($group) }} Settings</li>
@endsection

@section('content')
<div class="row g-4">
    {{-- Settings Navigation --}}
    <div class="col-xl-3">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white border-0 pt-3 pb-1">
                <h6 class="fw-bold mb-0 small text-uppercase text-muted">Settings Categories</h6>
            </div>
            <div class="list-group list-group-flush rounded-3">
                @foreach($groups as $key => $grp)
                    <a href="{{ route('admin.settings.group', $key) }}"
                       class="list-group-item list-group-item-action border-0 py-2 px-3 {{ $group === $key ? 'active' : '' }}"
                       style="{{ $group === $key ? 'background: var(--primary); color: #fff;' : '' }}">
                        <i class="{{ $grp['icon'] }} me-2"></i>{{ $grp['label'] }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Settings Form --}}
    <div class="col-xl-9">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white border-0 pt-4 pb-0">
                <h6 class="fw-bold mb-0">
                    <i class="{{ $groups[$group]['icon'] }} me-2" style="color: var(--primary)"></i>
                    {{ $groups[$group]['label'] }} Settings
                </h6>
                <p class="text-muted small mt-1">Update your {{ strtolower($groups[$group]['label']) }} settings below.</p>
            </div>
            <div class="card-body p-4">

                <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="group" value="{{ $group }}" />

                    @if($settings->isEmpty())
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-cog fa-2x mb-2 d-block"></i>No settings in this category.
                        </div>
                    @else
                        @foreach($settings as $key => $setting)
                        <div class="mb-4">
                            <label class="form-label fw-semibold">{{ $setting->label ?? ucwords(str_replace('_', ' ', $setting->key)) }}</label>

                            @if($setting->description)
                                <p class="text-muted small mb-1">{{ $setting->description }}</p>
                            @endif

                            {{-- Color picker for color settings --}}
                            @if(str_contains($setting->key, 'color'))
                                <div class="d-flex align-items-center gap-3">
                                    <input type="color" name="{{ $setting->key }}"
                                           value="{{ $setting->value ?: '#b8962b' }}"
                                           class="form-control form-control-color" style="height: 45px; width: 80px;" />
                                    <input type="text" id="{{ $setting->key }}_hex"
                                           value="{{ $setting->value ?: '#b8962b' }}"
                                           class="form-control"
                                           placeholder="#rrggbb"
                                           oninput="document.querySelector('[name=\'{{ $setting->key }}\']').value=this.value"
                                           style="max-width: 150px;" />
                                </div>

                            {{-- Logo / image fields --}}
                            @elseif(in_array($setting->key, ['logo', 'logo_white', 'favicon']))
                                @if($setting->value)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $setting->value) }}"
                                             alt="{{ $setting->label }}"
                                             style="max-height: 60px; border: 1px solid #dee2e6; border-radius: 8px; padding: 4px; background: #f8f9fa;" />
                                    </div>
                                @endif
                                <input type="file" name="{{ $setting->key }}"
                                       class="form-control"
                                       accept="image/*" />
                                <div class="form-text">Upload a new image to replace the current one.</div>

                            {{-- Long text / Analytics code fields --}}
                            @elseif(in_array($setting->key, ['google_analytics', 'meta_pixel', 'footer_about', 'site_description']))
                                <textarea name="{{ $setting->key }}" rows="4"
                                          class="form-control"
                                          placeholder="{{ $setting->label }}">{{ old($setting->key, $setting->value) }}</textarea>

                            {{-- Regular text field --}}
                            @else
                                <input type="text" name="{{ $setting->key }}"
                                       value="{{ old($setting->key, $setting->value) }}"
                                       class="form-control"
                                       placeholder="{{ $setting->label }}" />
                            @endif
                        </div>
                        @endforeach

                        <hr class="my-4" />
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-admin-primary">
                                <i class="fas fa-save me-2"></i>Save Settings
                            </button>
                            <button type="reset" class="btn btn-outline-secondary">Reset</button>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Sync color picker with hex input
    document.querySelectorAll('input[type="color"]').forEach(function(picker) {
        picker.addEventListener('input', function() {
            const hexInput = document.getElementById(this.name + '_hex');
            if (hexInput) hexInput.value = this.value;
        });
    });
</script>
@endpush

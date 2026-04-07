@extends('admin.layouts.app')

@section('title', ucfirst($group) . ' Settings')
@section('page-title', 'Settings')
@section('breadcrumb')
    <li class="breadcrumb-item active">{{ $groups[$group]['label'] }} Settings</li>
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

                <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" id="settingsForm">
                    @csrf
                    <input type="hidden" name="group" value="{{ $group }}" />

                    @if($settings->isEmpty())
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-cog fa-2x mb-2 d-block"></i>No settings in this category.
                        </div>
                    @else
                        @foreach($settings as $key => $setting)
                        @if($setting->key === 'custom_cursor') @continue @endif
                        @php
                            $label         = $setting->label ?? ucwords(str_replace('_', ' ', $setting->key));
                            $isColorField  = str_contains($setting->key, 'color');
                            $imageKeys     = ['logo', 'logo_white', 'favicon', 'about_main_image', 'about_item_image_1', 'about_item_image_2', 'breadcrumb_bg', 'about_who_main_image', 'about_who_box1_image', 'about_who_box2_image', 'about_approach_image_1', 'about_approach_image_2', 'about_journey_image_1', 'about_journey_image_2', 'about_journey_image_3', 'about_journey_image_4', 'cta_bg_image', 'intro_bg_image'];
                            $isMediaField  = in_array($setting->key, $imageKeys);
                            $isVideoFile   = $setting->key === 'hero_video_file';
                            $isVideoType   = $setting->key === 'hero_video_type';
                            $isBoolField   = $setting->type === 'boolean';
                            $isIntField    = $setting->type === 'integer';
                            $isLongText    = in_array($setting->key, ['google_analytics', 'meta_pixel', 'footer_about', 'site_description', 'footer_cta_title', 'footer_copyright', 'address', 'meta_description', 'meta_keywords']);
                            $isSocialField = str_starts_with($setting->key, 'social_');
                            $socialIcons   = [
                                'social_facebook'  => 'fa-brands fa-facebook-f',
                                'social_twitter'   => 'fa-brands fa-x-twitter',
                                'social_instagram' => 'fa-brands fa-instagram',
                                'social_linkedin'  => 'fa-brands fa-linkedin-in',
                                'social_youtube'   => 'fa-brands fa-youtube',
                                'social_pinterest' => 'fa-brands fa-pinterest-p',
                            ];
                        @endphp

                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                @if($isSocialField && isset($socialIcons[$setting->key]))
                                    <i class="{{ $socialIcons[$setting->key] }} me-1"></i>
                                @endif
                                {{ $label }}
                            </label>

                            @if($setting->description)
                                <p class="text-muted small mb-1">{{ $setting->description }}</p>
                            @endif

                            {{-- ── BOOLEAN TOGGLE ── --}}
                            @if($isBoolField)
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                           name="{{ $setting->key }}" id="{{ $setting->key }}"
                                           value="1" {{ $setting->value ? 'checked' : '' }}
                                           style="width:48px; height:26px; cursor:pointer;">
                                    <label class="form-check-label ms-2" for="{{ $setting->key }}">
                                        {{ $setting->value ? 'Enabled' : 'Disabled' }}
                                    </label>
                                </div>

                            {{-- ── VIDEO TYPE RADIO ── --}}
                            @elseif($isVideoType)
                                <div class="d-flex gap-3 flex-wrap">
                                    @foreach(['none' => 'No Video', 'youtube' => 'YouTube Link', 'upload' => 'Upload Video'] as $val => $lbl)
                                    <div class="form-check form-check-inline border rounded-3 px-3 py-2"
                                         style="cursor:pointer; {{ ($setting->value ?? 'none') === $val ? 'border-color: var(--primary) !important; background:#faf7f0;' : '' }}">
                                        <input class="form-check-input" type="radio"
                                               name="{{ $setting->key }}" id="vtype_{{ $val }}"
                                               value="{{ $val }}" {{ ($setting->value ?? 'none') === $val ? 'checked' : '' }}>
                                        <label class="form-check-label fw-semibold" for="vtype_{{ $val }}">{{ $lbl }}</label>
                                    </div>
                                    @endforeach
                                </div>

                            {{-- ── VIDEO FILE UPLOAD ── --}}
                            @elseif($isVideoFile)
                                @if($setting->value)
                                <div class="mb-2 p-3 border rounded-3 bg-light d-flex align-items-center gap-3" style="max-width:400px;">
                                    <i class="fas fa-file-video fa-2x text-muted"></i>
                                    <div>
                                        <span class="small text-muted d-block">Current video:</span>
                                        <span class="small fw-semibold">{{ basename($setting->value) }}</span>
                                    </div>
                                </div>
                                @endif
                                <input type="file" name="{{ $setting->key }}" class="form-control" accept="video/mp4,video/webm">
                                <div class="form-text">Accepted: MP4, WebM. Max 50MB recommended.</div>

                            {{-- ── INTEGER / NUMBER ── --}}
                            @elseif($isIntField)
                                <input type="number" name="{{ $setting->key }}"
                                       value="{{ old($setting->key, $setting->value) }}"
                                       class="form-control" style="max-width:180px;"
                                       min="0" placeholder="0">

                            {{-- ── COLOR PICKER ── --}}
                            @elseif($isColorField)
                                <div class="d-flex align-items-center gap-3">
                                    <input type="color" name="{{ $setting->key }}"
                                           id="picker_{{ $setting->key }}"
                                           value="{{ $setting->value ?: '#b8962b' }}"
                                           class="form-control form-control-color flex-shrink-0"
                                           style="height: 45px; width: 80px;" />
                                    <input type="text" id="hex_{{ $setting->key }}"
                                           value="{{ $setting->value ?: '#b8962b' }}"
                                           class="form-control color-hex-input"
                                           data-target="picker_{{ $setting->key }}"
                                           placeholder="#rrggbb"
                                           style="max-width: 160px;" />
                                    <div class="rounded" id="swatch_{{ $setting->key }}"
                                         style="width:40px;height:40px;background:{{ $setting->value ?: '#b8962b' }};border:1px solid #dee2e6;flex-shrink:0;"></div>
                                    <span class="text-muted small">Live preview</span>
                                </div>

                            {{-- ── MEDIA / IMAGE UPLOAD ── --}}
                            @elseif($isMediaField)
                                <div id="media-preview-{{ $setting->key }}" class="mb-2 {{ $setting->value ? '' : 'd-none' }}">
                                    @if($setting->value)
                                        <div class="d-flex align-items-center gap-3 p-3 border rounded-3 bg-light" style="max-width:360px;">
                                            <img src="{{ $setting->getFileUrl() }}"
                                                 id="preview-img-{{ $setting->key }}"
                                                 alt="{{ $label }}"
                                                 style="max-height:70px; max-width:160px; border-radius:6px; object-fit:contain;" />
                                            <div class="d-flex flex-column gap-1">
                                                <span class="small text-muted">Current {{ $label }}</span>
                                                <button type="button"
                                                        class="btn btn-sm btn-outline-danger media-delete-btn"
                                                        data-key="{{ $setting->key }}"
                                                        data-url="{{ route('admin.media.destroy') }}">
                                                    <i class="fas fa-trash-alt me-1"></i>Remove
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <input type="file" name="{{ $setting->key }}"
                                       id="file_{{ $setting->key }}"
                                       class="form-control"
                                       accept="image/*"
                                       onchange="previewImage(this, '{{ $setting->key }}')" />
                                <div class="form-text">
                                    @if($setting->key === 'favicon')
                                        Recommended: 32×32 or 64×64 px, ICO or PNG format.
                                    @elseif($setting->key === 'logo_white')
                                        White/light version of your logo for dark backgrounds.
                                    @elseif($setting->key === 'breadcrumb_bg')
                                        Recommended: 1920×600 px, JPG or PNG. Used as the page header background.
                                    @elseif(str_starts_with($setting->key, 'about_'))
                                        Recommended: JPG or PNG. Max 4MB.
                                    @else
                                        Recommended: PNG or SVG with transparent background.
                                    @endif
                                </div>

                            {{-- ── LONG TEXT / TEXTAREA ── --}}
                            @elseif($isLongText)
                                <textarea name="{{ $setting->key }}"
                                          rows="{{ in_array($setting->key, ['google_analytics', 'meta_pixel']) ? 5 : 3 }}"
                                          class="form-control"
                                          placeholder="{{ $label }}">{{ old($setting->key, $setting->value) }}</textarea>

                            {{-- ── SOCIAL / URL ── --}}
                            @elseif($isSocialField)
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-link"></i></span>
                                    <input type="url" name="{{ $setting->key }}"
                                           value="{{ old($setting->key, $setting->value) }}"
                                           class="form-control"
                                           placeholder="https://" />
                                </div>

                            {{-- ── REGULAR TEXT INPUT ── --}}
                            @else
                                <input type="text" name="{{ $setting->key }}"
                                       value="{{ old($setting->key, $setting->value) }}"
                                       class="form-control"
                                       placeholder="{{ $label }}" />
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
// ── Color picker ↔ hex input sync ────────────────────────────────────
document.querySelectorAll('input[type="color"]').forEach(function(picker) {
    picker.addEventListener('input', function() {
        const key   = this.id.replace('picker_', '');
        const hex   = document.getElementById('hex_' + key);
        const swatch = document.getElementById('swatch_' + key);
        if (hex)    hex.value = this.value;
        if (swatch) swatch.style.background = this.value;
    });
});

document.querySelectorAll('.color-hex-input').forEach(function(input) {
    input.addEventListener('input', function() {
        const targetId = this.getAttribute('data-target');
        const picker   = document.getElementById(targetId);
        const key      = targetId.replace('picker_', '');
        const swatch   = document.getElementById('swatch_' + key);
        if (/^#[0-9a-fA-F]{6}$/.test(this.value)) {
            if (picker) picker.value = this.value;
            if (swatch) swatch.style.background = this.value;
        }
    });
});

// ── Image file preview ────────────────────────────────────────────────
function previewImage(input, key) {
    if (input.files && input.files[0]) {
        const reader  = new FileReader();
        const preview = document.getElementById('media-preview-' + key);
        reader.onload = function(e) {
            if (preview) {
                preview.classList.remove('d-none');
                const img = document.getElementById('preview-img-' + key);
                if (img) {
                    img.src = e.target.result;
                } else {
                    preview.innerHTML = '<img src="' + e.target.result + '" style="max-height:70px;border-radius:6px;" />';
                }
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// ── Media delete (AJAX) ───────────────────────────────────────────────
document.querySelectorAll('.media-delete-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        if (!confirm('Remove this image? This cannot be undone.')) return;

        const key  = this.getAttribute('data-key');
        const url  = this.getAttribute('data-url');
        const self = this;

        fetch(url, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            },
            body: JSON.stringify({ key: key }),
        })
        .then(r => r.json())
        .then(function(data) {
            if (data.success) {
                const preview = document.getElementById('media-preview-' + key);
                if (preview) preview.classList.add('d-none');
            } else {
                alert(data.message || 'Could not remove media.');
            }
        })
        .catch(function() {
            alert('An error occurred. Please try again.');
        });
    });
});
</script>
@endpush

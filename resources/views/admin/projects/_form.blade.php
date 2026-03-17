{{-- Shared form partial for create & edit --}}
@php $isEdit = isset($project); @endphp

<div class="row g-4">
    {{-- Left: Core Details --}}
    <div class="col-xl-8">

        {{-- Basic Info --}}
        <div class="card border-0 shadow-sm rounded-3 mb-4">
            <div class="card-header bg-white border-0 pt-3 pb-0">
                <h6 class="fw-bold mb-0 small text-uppercase text-muted">Basic Information</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $project->title ?? '') }}"
                           class="form-control @error('title') is-invalid @enderror" required />
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Short Description</label>
                    <textarea name="short_description" rows="2"
                              class="form-control @error('short_description') is-invalid @enderror"
                              maxlength="500">{{ old('short_description', $project->short_description ?? '') }}</textarea>
                    @error('short_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-0">
                    <label class="form-label fw-semibold">Full Description</label>
                    <textarea name="description" rows="6"
                              class="form-control">{{ old('description', $project->description ?? '') }}</textarea>
                </div>
            </div>
        </div>

        {{-- Project Details --}}
        <div class="card border-0 shadow-sm rounded-3 mb-4">
            <div class="card-header bg-white border-0 pt-3 pb-0">
                <h6 class="fw-bold mb-0 small text-uppercase text-muted">Project Details</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Type <span class="text-danger">*</span></label>
                        <select name="type" class="form-select">
                            @foreach(['residential','commercial','industrial','infrastructure','mixed_use'] as $t)
                                <option value="{{ $t }}" {{ old('type', $project->type ?? 'residential') === $t ? 'selected' : '' }}>
                                    {{ ucwords(str_replace('_',' ',$t)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select">
                            <option value="upcoming"  {{ old('status', $project->status ?? 'ongoing') === 'upcoming'  ? 'selected' : '' }}>Upcoming</option>
                            <option value="ongoing"   {{ old('status', $project->status ?? 'ongoing') === 'ongoing'   ? 'selected' : '' }}>Ongoing</option>
                            <option value="completed" {{ old('status', $project->status ?? 'ongoing') === 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Sort Order</label>
                        <input type="number" name="sort_order" min="0"
                               value="{{ old('sort_order', $project->sort_order ?? 0) }}"
                               class="form-control" />
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Area</label>
                        <input type="number" name="area" step="0.01" min="0"
                               value="{{ old('area', $project->area ?? '') }}"
                               class="form-control" placeholder="e.g. 50000" />
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Area Unit</label>
                        <select name="area_unit" class="form-select">
                            @foreach(['sq ft','sq m','acres','cents'] as $u)
                                <option value="{{ $u }}" {{ old('area_unit', $project->area_unit ?? 'sq ft') === $u ? 'selected' : '' }}>{{ $u }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">No. of Units</label>
                        <input type="number" name="units" min="0"
                               value="{{ old('units', $project->units ?? '') }}"
                               class="form-control" placeholder="e.g. 120" />
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Floors</label>
                        <input type="number" name="floors" min="0" max="200"
                               value="{{ old('floors', $project->floors ?? '') }}"
                               class="form-control" />
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Completion Year</label>
                        <input type="number" name="completion_year" min="1900" max="2100"
                               value="{{ old('completion_year', $project->completion_year ?? '') }}"
                               class="form-control" placeholder="e.g. 2025" />
                        <div class="form-text">Leave blank if ongoing / unknown.</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Location --}}
        <div class="card border-0 shadow-sm rounded-3 mb-4">
            <div class="card-header bg-white border-0 pt-3 pb-0">
                <h6 class="fw-bold mb-0 small text-uppercase text-muted">Location</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Location / Address</label>
                        <input type="text" name="location"
                               value="{{ old('location', $project->location ?? '') }}"
                               class="form-control" placeholder="Street / Area" />
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">City</label>
                        <input type="text" name="city"
                               value="{{ old('city', $project->city ?? '') }}"
                               class="form-control" />
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">State</label>
                        <input type="text" name="state"
                               value="{{ old('state', $project->state ?? '') }}"
                               class="form-control" />
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Google Maps Embed URL</label>
                        <input type="url" name="google_maps_url"
                               value="{{ old('google_maps_url', $project->google_maps_url ?? '') }}"
                               class="form-control" placeholder="https://maps.google.com/embed?..." />
                    </div>
                </div>
            </div>
        </div>

        {{-- SEO --}}
        <div class="card border-0 shadow-sm rounded-3 mb-4">
            <div class="card-header bg-white border-0 pt-3 pb-0">
                <h6 class="fw-bold mb-0 small text-uppercase text-muted">SEO</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Meta Title</label>
                    <input type="text" name="meta_title"
                           value="{{ old('meta_title', $project->meta_title ?? '') }}"
                           class="form-control" placeholder="Defaults to project title" />
                </div>
                <div class="mb-0">
                    <label class="form-label fw-semibold">Meta Description</label>
                    <textarea name="meta_description" rows="2"
                              class="form-control" maxlength="500">{{ old('meta_description', $project->meta_description ?? '') }}</textarea>
                </div>
            </div>
        </div>

    </div>

    {{-- Right: Media & Flags --}}
    <div class="col-xl-4">

        {{-- Publish --}}
        <div class="card border-0 shadow-sm rounded-3 mb-4">
            <div class="card-header bg-white border-0 pt-3 pb-0">
                <h6 class="fw-bold mb-0 small text-uppercase text-muted">Publish</h6>
            </div>
            <div class="card-body">
                <div class="form-check form-switch mb-3">
                    <input type="hidden" name="is_active" value="0" />
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                           {{ old('is_active', ($project->is_active ?? true) ? '1' : '0') == '1' ? 'checked' : '' }} />
                    <label class="form-check-label fw-semibold" for="is_active">Active (visible on site)</label>
                </div>
                <div class="form-check form-switch">
                    <input type="hidden" name="is_featured" value="0" />
                    <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured"
                           {{ old('is_featured', ($project->is_featured ?? false) ? '1' : '0') == '1' ? 'checked' : '' }} />
                    <label class="form-check-label fw-semibold" for="is_featured">
                        <i class="fas fa-star text-warning me-1"></i>Featured
                    </label>
                </div>
            </div>
            <div class="card-footer bg-white border-0 pb-3">
                <button type="submit" class="btn btn-admin-primary w-100">
                    <i class="fas fa-save me-2"></i>{{ $isEdit ? 'Update Project' : 'Create Project' }}
                </button>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary w-100 mt-2">Cancel</a>
            </div>
        </div>

        {{-- Thumbnail --}}
        <div class="card border-0 shadow-sm rounded-3 mb-4">
            <div class="card-header bg-white border-0 pt-3 pb-0">
                <h6 class="fw-bold mb-0 small text-uppercase text-muted">Thumbnail Image</h6>
            </div>
            <div class="card-body">
                @if($isEdit && $project->thumbnail)
                    <img src="{{ $project->thumbnail_url }}" alt=""
                         id="thumb-preview"
                         class="img-fluid rounded mb-2" style="max-height:150px;width:100%;object-fit:cover;" />
                @else
                    <img src="" alt="" id="thumb-preview" class="img-fluid rounded mb-2 d-none"
                         style="max-height:150px;width:100%;object-fit:cover;" />
                @endif
                <input type="file" name="thumbnail" class="form-control" accept="image/*"
                       onchange="previewThumb(this)" />
                <div class="form-text">Max 4MB. JPG, PNG, WebP.</div>
            </div>
        </div>

        {{-- Gallery --}}
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white border-0 pt-3 pb-0">
                <h6 class="fw-bold mb-0 small text-uppercase text-muted">Image Gallery</h6>
            </div>
            <div class="card-body">
                @if($isEdit && $project->images->isNotEmpty())
                    <div class="row g-2 mb-3" id="gallery-existing">
                        @foreach($project->images as $img)
                        <div class="col-4" id="img-{{ $img->id }}">
                            <div class="position-relative">
                                <img src="{{ $img->url }}" alt=""
                                     class="img-fluid rounded" style="height:70px;width:100%;object-fit:cover;" />
                                <button type="button"
                                        class="btn btn-danger btn-sm position-absolute top-0 end-0 p-0 lh-1"
                                        style="width:20px;height:20px;font-size:10px;"
                                        onclick="deleteGalleryImage({{ $img->id }}, 'projects')">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
                <input type="file" name="gallery[]" class="form-control" accept="image/*" multiple />
                <div class="form-text">Select multiple images. Max 4MB each.</div>
            </div>
        </div>

    </div>
</div>

@push('scripts')
<script>
function previewThumb(input) {
    const preview = document.getElementById('thumb-preview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function deleteGalleryImage(imageId, type) {
    if (!confirm('Remove this image?')) return;
    const url = type === 'projects'
        ? `/admin/projects/images/${imageId}`
        : `/admin/properties/images/${imageId}`;
    fetch(url, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
        }
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            document.getElementById('img-' + imageId)?.remove();
        }
    });
}
</script>
@endpush

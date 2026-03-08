{{-- Shared form partial for create & edit --}}
@php $isEdit = isset($property); @endphp

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
                    <input type="text" name="title" value="{{ old('title', $property->title ?? '') }}"
                           class="form-control @error('title') is-invalid @enderror" required />
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Short Description</label>
                    <textarea name="short_description" rows="2"
                              class="form-control @error('short_description') is-invalid @enderror"
                              maxlength="500">{{ old('short_description', $property->short_description ?? '') }}</textarea>
                    @error('short_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Full Description</label>
                    <textarea name="description" rows="6" id="description"
                              class="form-control">{{ old('description', $property->description ?? '') }}</textarea>
                </div>
            </div>
        </div>

        {{-- Pricing --}}
        <div class="card border-0 shadow-sm rounded-3 mb-4">
            <div class="card-header bg-white border-0 pt-3 pb-0">
                <h6 class="fw-bold mb-0 small text-uppercase text-muted">Pricing</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Price (numeric)</label>
                        <input type="number" name="price" step="0.01" min="0"
                               value="{{ old('price', $property->price ?? '') }}"
                               class="form-control" placeholder="e.g. 1200000" />
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Price Label</label>
                        <input type="text" name="price_label"
                               value="{{ old('price_label', $property->price_label ?? '') }}"
                               class="form-control" placeholder="e.g. ₹1.2 Cr" />
                        <div class="form-text">Shown on listing if set.</div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Price Type <span class="text-danger">*</span></label>
                        <select name="price_type" class="form-select">
                            @foreach(['sale','rent','lease'] as $pt)
                                <option value="{{ $pt }}" {{ old('price_type', $property->price_type ?? 'sale') === $pt ? 'selected' : '' }}>
                                    {{ ucfirst($pt) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        {{-- Property Details --}}
        <div class="card border-0 shadow-sm rounded-3 mb-4">
            <div class="card-header bg-white border-0 pt-3 pb-0">
                <h6 class="fw-bold mb-0 small text-uppercase text-muted">Property Details</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Type <span class="text-danger">*</span></label>
                        <select name="type" class="form-select">
                            @foreach(['residential','commercial','industrial','infrastructure','plot'] as $t)
                                <option value="{{ $t }}" {{ old('type', $property->type ?? 'residential') === $t ? 'selected' : '' }}>
                                    {{ ucfirst($t) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select">
                            @foreach(['available','under_construction','coming_soon','sold'] as $s)
                                <option value="{{ $s }}" {{ old('status', $property->status ?? 'available') === $s ? 'selected' : '' }}>
                                    {{ ucwords(str_replace('_',' ',$s)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Sort Order</label>
                        <input type="number" name="sort_order" min="0"
                               value="{{ old('sort_order', $property->sort_order ?? 0) }}"
                               class="form-control" />
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Area</label>
                        <input type="number" name="area" step="0.01" min="0"
                               value="{{ old('area', $property->area ?? '') }}"
                               class="form-control" placeholder="e.g. 1200" />
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Area Unit</label>
                        <select name="area_unit" class="form-select">
                            @foreach(['sqft','sqm','sqyd','acres','cents'] as $u)
                                <option value="{{ $u }}" {{ old('area_unit', $property->area_unit ?? 'sqft') === $u ? 'selected' : '' }}>{{ $u }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Bedrooms</label>
                        <input type="number" name="bedrooms" min="0" max="50"
                               value="{{ old('bedrooms', $property->bedrooms ?? '') }}"
                               class="form-control" />
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Bathrooms</label>
                        <input type="number" name="bathrooms" min="0" max="50"
                               value="{{ old('bathrooms', $property->bathrooms ?? '') }}"
                               class="form-control" />
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Floors</label>
                        <input type="number" name="floors" min="0" max="200"
                               value="{{ old('floors', $property->floors ?? '') }}"
                               class="form-control" />
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
                               value="{{ old('location', $property->location ?? '') }}"
                               class="form-control" placeholder="Street / Area" />
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">City</label>
                        <input type="text" name="city"
                               value="{{ old('city', $property->city ?? '') }}"
                               class="form-control" />
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">State</label>
                        <input type="text" name="state"
                               value="{{ old('state', $property->state ?? '') }}"
                               class="form-control" />
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Google Maps Embed URL</label>
                        <input type="url" name="google_maps_url"
                               value="{{ old('google_maps_url', $property->google_maps_url ?? '') }}"
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
                           value="{{ old('meta_title', $property->meta_title ?? '') }}"
                           class="form-control" placeholder="Defaults to property title" />
                </div>
                <div class="mb-0">
                    <label class="form-label fw-semibold">Meta Description</label>
                    <textarea name="meta_description" rows="2"
                              class="form-control" maxlength="500">{{ old('meta_description', $property->meta_description ?? '') }}</textarea>
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
                           {{ old('is_active', ($property->is_active ?? true) ? '1' : '0') == '1' ? 'checked' : '' }} />
                    <label class="form-check-label fw-semibold" for="is_active">Active (visible on site)</label>
                </div>
                <div class="form-check form-switch">
                    <input type="hidden" name="is_featured" value="0" />
                    <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured"
                           {{ old('is_featured', ($property->is_featured ?? false) ? '1' : '0') == '1' ? 'checked' : '' }} />
                    <label class="form-check-label fw-semibold" for="is_featured">
                        <i class="fas fa-star text-warning me-1"></i>Featured
                    </label>
                </div>
            </div>
            <div class="card-footer bg-white border-0 pb-3">
                <button type="submit" class="btn btn-admin-primary w-100">
                    <i class="fas fa-save me-2"></i>{{ $isEdit ? 'Update Property' : 'Create Property' }}
                </button>
                <a href="{{ route('admin.properties.index') }}" class="btn btn-outline-secondary w-100 mt-2">Cancel</a>
            </div>
        </div>

        {{-- Thumbnail --}}
        <div class="card border-0 shadow-sm rounded-3 mb-4">
            <div class="card-header bg-white border-0 pt-3 pb-0">
                <h6 class="fw-bold mb-0 small text-uppercase text-muted">Thumbnail Image</h6>
            </div>
            <div class="card-body">
                @if($isEdit && $property->thumbnail)
                    <img src="{{ $property->thumbnail_url }}" alt=""
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
                @if($isEdit && $property->images->isNotEmpty())
                    <div class="row g-2 mb-3" id="gallery-existing">
                        @foreach($property->images as $img)
                        <div class="col-4" id="img-{{ $img->id }}">
                            <div class="position-relative">
                                <img src="{{ $img->url }}" alt=""
                                     class="img-fluid rounded" style="height:70px;width:100%;object-fit:cover;" />
                                <button type="button"
                                        class="btn btn-danger btn-sm position-absolute top-0 end-0 p-0 lh-1"
                                        style="width:20px;height:20px;font-size:10px;"
                                        onclick="deleteGalleryImage({{ $img->id }})">
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

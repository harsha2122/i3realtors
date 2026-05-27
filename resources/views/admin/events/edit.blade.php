@extends('admin.layouts.app')
@section('title', 'Edit Event')
@section('page-title', 'Edit Event')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.events.index') }}">Events</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-9">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white border-0 pt-4 pb-3">
                <h6 class="fw-bold mb-0"><i class="fas fa-edit me-2" style="color:var(--primary)"></i>Edit: {{ $event->title }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.events.update', $event) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Event Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                               name="title" value="{{ old('title', $event->title) }}" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  name="description" rows="5">{{ old('description', $event->description) }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Event Date</label>
                            <input type="date" class="form-control @error('event_date') is-invalid @enderror"
                                   name="event_date" value="{{ old('event_date', $event->event_date?->format('Y-m-d')) }}">
                            @error('event_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Event Time</label>
                            <input type="text" class="form-control @error('event_time') is-invalid @enderror"
                                   name="event_time" value="{{ old('event_time', $event->event_time) }}"
                                   placeholder="e.g. 10:00 AM – 6:00 PM">
                            @error('event_time')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Location / Venue</label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror"
                               name="location" value="{{ old('location', $event->location) }}"
                               placeholder="e.g. The Westin, Pune">
                        @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Total Capacity</label>
                            <input type="number" class="form-control @error('total_capacity') is-invalid @enderror"
                                   name="total_capacity" value="{{ old('total_capacity', $event->total_capacity) }}" min="0">
                            @error('total_capacity')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Available Seats</label>
                            <input type="number" class="form-control @error('available_seats') is-invalid @enderror"
                                   name="available_seats" value="{{ old('available_seats', $event->available_seats) }}" min="0">
                            @error('available_seats')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    {{-- Existing Images --}}
                    @if($event->images && count($event->images) > 0)
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Current Images</label>
                        <div class="row g-2">
                            @foreach($event->images as $img)
                            <div class="col-6 col-md-3" id="img-wrap-{{ $loop->index }}">
                                <div class="position-relative border rounded overflow-hidden" style="height:100px;">
                                    <img src="{{ Storage::url($img) }}" class="w-100 h-100 object-fit-cover" alt="Event image">
                                    <label class="position-absolute top-0 end-0 m-1 bg-white rounded px-1 py-0 small"
                                           style="cursor:pointer;font-size:11px;z-index:2;">
                                        <input type="checkbox" name="keep_images[]" value="{{ $img }}" checked
                                               onchange="if(!this.checked){ document.getElementById('img-wrap-{{ $loop->index }}').style.opacity='0.35'; }
                                                         else { document.getElementById('img-wrap-{{ $loop->index }}').style.opacity='1'; }">
                                        Keep
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <small class="text-muted">Uncheck images you want to remove.</small>
                    </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Upload New Images</label>
                        <input type="file" class="form-control" name="new_images[]" accept="image/*" multiple>
                        <small class="text-muted">New images will be added alongside existing ones.</small>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Status</label>
                            <select class="form-select" name="status">
                                <option value="active"   {{ old('status', $event->status) === 'active'   ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $event->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Sort Order</label>
                            <input type="number" class="form-control" name="sort_order" value="{{ old('sort_order', $event->sort_order) }}" min="0">
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-admin-primary"><i class="fas fa-save me-1"></i>Save Changes</button>
                        <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="card border-0 shadow-sm rounded-3 mb-3">
            <div class="card-body">
                <h6 class="fw-semibold mb-2 small text-muted text-uppercase">Event Info</h6>
                <div class="small">
                    <div class="mb-1"><i class="fas fa-link fa-fw text-muted me-1"></i>
                        <a href="{{ route('events.show', $event) }}" target="_blank" class="text-truncate d-inline-block" style="max-width:170px;">
                            /events/{{ $event->slug }}
                        </a>
                    </div>
                    <div class="mb-1"><i class="fas fa-clock fa-fw text-muted me-1"></i>
                        Created {{ $event->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body">
                <h6 class="fw-bold mb-3"><i class="fas fa-info-circle me-2 text-muted"></i>Tips</h6>
                <ul class="list-unstyled small text-muted mb-0">
                    <li class="mb-2">🖼️ Uncheck existing images to delete them on save.</li>
                    <li class="mb-2">📎 New uploads are added to existing ones.</li>
                    <li>🔢 Available Seats should be ≤ Total Capacity.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .object-fit-cover { object-fit: cover; }
</style>
@endpush

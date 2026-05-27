@extends('admin.layouts.app')
@section('title', 'Add Event')
@section('page-title', 'Add Event')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.events.index') }}">Events</a></li>
    <li class="breadcrumb-item active">Add Event</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-9">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white border-0 pt-4 pb-3">
                <h6 class="fw-bold mb-0"><i class="fas fa-plus me-2" style="color:var(--primary)"></i>New Event</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Event Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                               name="title" value="{{ old('title') }}" placeholder="e.g. Real Estate Investment Summit 2025" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  name="description" rows="5" placeholder="Full description of the event...">{{ old('description') }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Event Date</label>
                            <input type="date" class="form-control @error('event_date') is-invalid @enderror"
                                   name="event_date" value="{{ old('event_date') }}">
                            @error('event_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Event Time</label>
                            <input type="text" class="form-control @error('event_time') is-invalid @enderror"
                                   name="event_time" value="{{ old('event_time') }}" placeholder="e.g. 10:00 AM – 6:00 PM">
                            @error('event_time')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Location / Venue</label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror"
                               name="location" value="{{ old('location') }}" placeholder="e.g. The Westin, Pune">
                        @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Total Capacity</label>
                            <input type="number" class="form-control @error('total_capacity') is-invalid @enderror"
                                   name="total_capacity" value="{{ old('total_capacity') }}" min="0" placeholder="e.g. 200">
                            @error('total_capacity')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Available Seats</label>
                            <input type="number" class="form-control @error('available_seats') is-invalid @enderror"
                                   name="available_seats" value="{{ old('available_seats') }}" min="0" placeholder="e.g. 150">
                            @error('available_seats')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Event Images</label>
                        <input type="file" class="form-control" name="new_images[]" accept="image/*" multiple>
                        <small class="text-muted">Upload multiple images. First image will be used as the cover.</small>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Status</label>
                            <select class="form-select" name="status">
                                <option value="active"   {{ old('status','active') === 'active'   ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Sort Order</label>
                            <input type="number" class="form-control" name="sort_order" value="{{ old('sort_order', 0) }}" min="0">
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-admin-primary"><i class="fas fa-save me-1"></i>Create Event</button>
                        <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body">
                <h6 class="fw-bold mb-3"><i class="fas fa-info-circle me-2 text-muted"></i>Tips</h6>
                <ul class="list-unstyled small text-muted mb-0">
                    <li class="mb-2">📅 Event date and time help attendees plan ahead.</li>
                    <li class="mb-2">📍 Use a full venue address for clarity.</li>
                    <li class="mb-2">🖼️ First uploaded image becomes the event cover.</li>
                    <li class="mb-2">🔢 Set "Available Seats" equal to or less than "Total Capacity".</li>
                    <li>📌 Lower sort order = displayed first.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

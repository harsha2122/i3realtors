@extends('admin.layouts.app')

@section('title', 'Testimonials')
@section('page-title', 'Testimonials')
@section('breadcrumb')
    <li class="breadcrumb-item active">Testimonials</li>
@endsection

@section('content')
<div class="card border-0 shadow-sm rounded-3">
    <div class="card-header bg-white border-0 pt-4 pb-3 d-flex justify-content-between align-items-center">
        <h6 class="fw-bold mb-0"><i class="fas fa-quote-left me-2" style="color:var(--primary)"></i>Testimonials</h6>
        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-admin-primary btn-sm">
            <i class="fas fa-plus me-1"></i>Add Testimonial
        </a>
    </div>

    <div class="card-body p-0">
        @if($testimonials->isEmpty())
            <div class="text-center text-muted py-5">
                <i class="fas fa-quote-left fa-3x mb-3 d-block opacity-25"></i>
                No testimonials. <a href="{{ route('admin.testimonials.create') }}">Add the first one.</a>
            </div>
        @else
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="60">Photo</th>
                        <th>Author</th>
                        <th>Content</th>
                        <th>Rating</th>
                        <th>Featured</th>
                        <th width="120">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($testimonials as $testimonial)
                    <tr>
                        <td>
                            @if($testimonial->author_image)
                                <img src="{{ asset('storage/' . $testimonial->author_image) }}" alt="" class="rounded-circle" style="width:40px;height:40px;object-fit:cover;">
                            @else
                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width:40px;height:40px;">
                                    <i class="fas fa-user text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="fw-semibold small">{{ $testimonial->author_name }}</div>
                            <div class="text-muted small">{{ $testimonial->author_title ?? '' }} {{ $testimonial->company ? '@ ' . $testimonial->company : '' }}</div>
                        </td>
                        <td class="small">{{ Str::limit($testimonial->content, 80) }}</td>
                        <td>
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= $testimonial->rating ? 'text-warning' : 'text-muted' }}" style="font-size:0.75rem;"></i>
                            @endfor
                        </td>
                        <td>
                            @if($testimonial->is_featured)
                                <span class="badge bg-success">Yes</span>
                            @else
                                <span class="badge bg-secondary">No</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="btn btn-sm btn-outline-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                <form method="POST" action="{{ route('admin.testimonials.destroy', $testimonial) }}" onsubmit="return confirm('Delete?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-3">{{ $testimonials->links() }}</div>
        @endif
    </div>
</div>
@endsection

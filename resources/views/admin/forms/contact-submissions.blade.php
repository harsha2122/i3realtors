@extends('admin.layouts.app')

@section('title', 'Contact Form Submissions')
@section('page-title', 'Contact Form Submissions')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Contact Submissions</li>
@endsection

@section('content')
<div class="card border-0 shadow-sm rounded-3">
    <div class="card-header bg-white border-0 pt-4 pb-3 d-flex justify-content-between align-items-center">
        <h6 class="fw-bold mb-0"><i class="fas fa-inbox me-2" style="color:var(--primary)"></i>Contact Form Submissions</h6>
        @if($form)
        <div class="d-flex gap-2">
            <a href="{{ route('contact-submissions.export') }}" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-download me-1"></i>Export CSV
            </a>
        </div>
        @endif
    </div>

    <div class="card-body p-0">
        @if(!$form)
            <div class="text-center text-muted py-5">
                <i class="fas fa-exclamation-circle fa-3x mb-3 d-block opacity-25"></i>
                <p>{{ $message ?? 'Contact form not configured.' }}</p>
            </div>
        @elseif($submissions->isEmpty())
            <div class="text-center text-muted py-5">
                <i class="fas fa-inbox fa-3x mb-3 d-block opacity-25"></i>
                No submissions yet.
            </div>
        @else
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        @foreach($form->fields()->orderBy('order')->get() as $field)
                            <th>{{ $field->label }}</th>
                        @endforeach
                        <th>Submitted</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($submissions as $submission)
                    <tr>
                        <td class="small">{{ $submission->id }}</td>
                        @foreach($form->fields()->orderBy('order')->get() as $field)
                            <td class="small">
                                @php
                                    $value = $submission->data[$field->name] ?? '-';
                                    if (is_array($value)) {
                                        $value = implode(', ', $value);
                                    }
                                @endphp
                                {{ Str::limit($value, 50) }}
                            </td>
                        @endforeach
                        <td class="small text-muted">{{ $submission->created_at->diffForHumans() }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-3">{{ $submissions->links() }}</div>
        @endif
    </div>
</div>
@endsection

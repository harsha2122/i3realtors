@extends('admin.layouts.app')
@section('title', 'Fund Raising Logos')
@section('page-title', 'Fund Raising Logos')
@section('breadcrumb')
    <li class="breadcrumb-item active">Fund Raising Logos</li>
@endsection

@section('content')

{{-- Bulk Upload Card --}}
<div class="card border-0 shadow-sm rounded-3 mb-4">
    <div class="card-header bg-white border-0 pt-4 pb-2">
        <h6 class="fw-bold mb-0"><i class="fas fa-upload me-2" style="color:var(--primary)"></i>Upload Logos</h6>
        <p class="text-muted small mt-1 mb-0">Select multiple images at once to bulk upload.</p>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.fund-raising-logos.store') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
            @csrf
            <div id="dropZone"
                 style="border:2px dashed #dee2e6; border-radius:12px; padding:40px 20px; text-align:center; cursor:pointer; transition:border-color 0.2s, background 0.2s;"
                 onclick="document.getElementById('logoInput').click()"
                 ondragover="event.preventDefault(); this.style.borderColor='var(--primary)'; this.style.background='#faf7f0';"
                 ondragleave="this.style.borderColor='#dee2e6'; this.style.background='';"
                 ondrop="handleDrop(event)">
                <i class="fas fa-cloud-upload-alt fa-3x mb-3" style="color:#ccc;"></i>
                <p class="mb-1 fw-semibold text-muted">Click to select or drag & drop images here</p>
                <p class="text-muted small mb-0">PNG, JPG, SVG — max 2MB each. Multiple files allowed.</p>
                <input type="file" id="logoInput" name="logos[]" multiple accept="image/*" class="d-none" onchange="previewFiles(this.files)">
            </div>

            <div id="previewGrid" class="row g-2 mt-3" style="display:none!important;"></div>

            <div id="uploadActions" class="mt-3 d-none">
                <button type="submit" class="btn btn-admin-primary">
                    <i class="fas fa-upload me-2"></i>Upload <span id="fileCount"></span> Logo(s)
                </button>
                <button type="button" class="btn btn-outline-secondary ms-2" onclick="clearSelection()">Clear</button>
            </div>
        </form>
    </div>
</div>

{{-- Existing Logos Grid --}}
<div class="card border-0 shadow-sm rounded-3">
    <div class="card-header bg-white border-0 pt-4 pb-2 d-flex justify-content-between align-items-center">
        <h6 class="fw-bold mb-0">Uploaded Logos <span class="badge bg-secondary ms-2">{{ $logos->total() }}</span></h6>
    </div>
    <div class="card-body">
        @if($logos->isEmpty())
            <div class="text-center text-muted py-4">
                <i class="fas fa-image fa-2x mb-2 d-block"></i>No logos uploaded yet.
            </div>
        @else
        <div class="row g-3">
            @foreach($logos as $logo)
            <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                <div style="position:relative; border:1px solid #e9ecef; border-radius:8px; overflow:hidden; background:#fff; aspect-ratio:1/1; display:flex; align-items:center; justify-content:center; padding:12px;">
                    <img src="{{ asset('uploads/' . $logo->logo) }}" alt="Logo {{ $logo->id }}"
                         style="max-width:100%; max-height:100%; object-fit:contain;">
                    <div style="position:absolute; top:6px; right:6px; display:flex; gap:4px;">
                        <a href="{{ route('admin.fund-raising-logos.edit', $logo) }}"
                           style="width:28px; height:28px; background:rgba(255,255,255,0.9); border:1px solid #dee2e6; border-radius:4px; display:flex; align-items:center; justify-content:center; text-decoration:none; color:#555;"
                           title="Replace">
                            <i class="fas fa-sync-alt" style="font-size:11px;"></i>
                        </a>
                        <form action="{{ route('admin.fund-raising-logos.destroy', $logo) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Delete this logo?')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    style="width:28px; height:28px; background:rgba(255,255,255,0.9); border:1px solid #dee2e6; border-radius:4px; display:flex; align-items:center; justify-content:center; color:#dc3545; cursor:pointer;"
                                    title="Delete">
                                <i class="fas fa-trash" style="font-size:11px;"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-3">{{ $logos->links() }}</div>
        @endif
    </div>
</div>

@endsection

@push('scripts')
<script>
function previewFiles(files) {
    const grid    = document.getElementById('previewGrid');
    const actions = document.getElementById('uploadActions');
    const count   = document.getElementById('fileCount');

    grid.innerHTML = '';
    if (!files.length) { grid.style.display = 'none'; actions.classList.add('d-none'); return; }

    grid.style.removeProperty('display');
    grid.style.display = 'flex';
    grid.style.flexWrap = 'wrap';
    grid.style.gap = '10px';
    grid.style.marginTop = '12px';

    Array.from(files).forEach(file => {
        const reader = new FileReader();
        reader.onload = e => {
            const div = document.createElement('div');
            div.style.cssText = 'width:80px; height:80px; border:1px solid #dee2e6; border-radius:8px; overflow:hidden; background:#fff; display:flex; align-items:center; justify-content:center; padding:6px;';
            div.innerHTML = `<img src="${e.target.result}" style="max-width:100%; max-height:100%; object-fit:contain;">`;
            grid.appendChild(div);
        };
        reader.readAsDataURL(file);
    });

    count.textContent = files.length;
    actions.classList.remove('d-none');
}

function handleDrop(e) {
    e.preventDefault();
    document.getElementById('dropZone').style.borderColor = '#dee2e6';
    document.getElementById('dropZone').style.background  = '';
    const input = document.getElementById('logoInput');
    input.files = e.dataTransfer.files;
    previewFiles(e.dataTransfer.files);
}

function clearSelection() {
    document.getElementById('logoInput').value     = '';
    document.getElementById('previewGrid').innerHTML = '';
    document.getElementById('previewGrid').style.display = 'none';
    document.getElementById('uploadActions').classList.add('d-none');
}
</script>
@endpush

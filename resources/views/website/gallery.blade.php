@extends('layouts.website')

@section('title', 'Gallery - ' . ($site['site_name'] ?? config('app.name')))
@section('meta_description', 'Browse our photo gallery — real estate projects, events, and milestones.')

@section('content')

    <!-- Page Header Start -->
    <div class="page-header bg-section dark-section parallaxie">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="page-header-box">
                        <h1 class="text-anime-style-2" data-cursor="-opaque">Our Gallery</h1>
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Gallery</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Gallery Section Start -->
    <div style="padding: 100px 0;">
        <div class="container">

            {{-- Category Tabs --}}
            @if($categories->isNotEmpty())
            <div class="d-flex justify-content-center mb-5 flex-wrap gap-2">
                <div style="display:inline-flex; flex-wrap:wrap; background: var(--accent-secondary-color); border-radius: 50px; padding: 6px; gap: 4px;">
                    <a href="{{ route('gallery.index') }}"
                       style="display:inline-block; padding: 10px 28px; border-radius: 50px; font-size: 14px; font-weight: 700; text-decoration: none; transition: all 0.3s;
                              {{ $activeCategory === '' ? 'background: var(--primary-color); color: var(--accent-secondary-color);' : 'background: transparent; color: var(--primary-color);' }}">
                        All
                    </a>
                    @foreach($categories as $cat)
                    <a href="{{ route('gallery.index', ['category' => $cat]) }}"
                       style="display:inline-block; padding: 10px 28px; border-radius: 50px; font-size: 14px; font-weight: 700; text-decoration: none; transition: all 0.3s;
                              {{ $activeCategory === $cat ? 'background: var(--primary-color); color: var(--accent-secondary-color);' : 'background: transparent; color: var(--primary-color);' }}">
                        {{ $cat }}
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

            @if($images->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-images fa-3x mb-3" style="color: var(--primary-color); opacity:0.4;"></i>
                    <h4>No images found</h4>
                    @if($activeCategory)
                        <a href="{{ route('gallery.index') }}" class="btn-default" style="padding: 12px 28px;">View All</a>
                    @endif
                </div>
            @else
                <div class="row g-3" id="gallery-grid">
                    @foreach($images as $image)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-6">
                        <div class="gallery-item position-relative overflow-hidden rounded wow fadeInUp"
                             style="border-radius: 12px; cursor: pointer;"
                             onclick="openLightbox('{{ $image->image_url }}', '{{ addslashes($image->title ?? '') }}', '{{ addslashes($image->caption ?? '') }}')">
                            <img src="{{ $image->image_url }}"
                                 alt="{{ $image->title ?? 'Gallery Image' }}"
                                 class="img-fluid w-100"
                                 style="height: 220px; object-fit: cover; transition: transform 0.4s ease;"
                                 onmouseover="this.style.transform='scale(1.05)'"
                                 onmouseout="this.style.transform='scale(1)'" />
                            {{-- Overlay --}}
                            <div class="position-absolute inset-0 d-flex align-items-end"
                                 style="top:0;left:0;right:0;bottom:0;
                                        background: linear-gradient(to top, rgba(0,0,0,0.65) 0%, transparent 50%);
                                        padding: 16px; opacity: 0; transition: opacity 0.3s;"
                                 onmouseover="this.style.opacity=1" onmouseout="this.style.opacity=0">
                                @if($image->title || $image->caption)
                                <div>
                                    @if($image->title)
                                        <div style="color:#fff; font-weight:700; font-size:0.9rem;">{{ $image->title }}</div>
                                    @endif
                                    @if($image->caption)
                                        <div style="color:rgba(255,255,255,0.8); font-size:0.78rem;">{{ $image->caption }}</div>
                                    @endif
                                </div>
                                @endif
                            </div>
                            @if($image->category)
                                <span style="position:absolute; top:10px; left:10px; background: var(--accent-secondary-color); color: var(--primary-color); font-size:10px; font-weight:700; padding: 3px 10px; border-radius:20px; text-transform:uppercase; letter-spacing:0.5px;">
                                    {{ $image->category }}
                                </span>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="d-flex justify-content-center mt-5">
                    {{ $images->withQueryString()->links() }}
                </div>
            @endif

        </div>
    </div>
    <!-- Gallery Section End -->

    <!-- Lightbox Modal -->
    <div id="gallery-lightbox"
         style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.92);
                z-index: 99999; align-items:center; justify-content:center; flex-direction:column;"
         onclick="closeLightbox()">
        <button onclick="closeLightbox()" style="position:absolute; top:20px; right:28px; background:none; border:none; color:#fff; font-size:2rem; cursor:pointer; z-index:1;">&times;</button>
        <img id="lightbox-img" src="" alt="" style="max-width:90vw; max-height:80vh; border-radius:8px; object-fit:contain;" onclick="event.stopPropagation()" />
        <div id="lightbox-caption" style="color:#fff; text-align:center; margin-top:16px; max-width:600px; padding: 0 20px;">
            <div id="lightbox-title" style="font-weight:700; font-size:1.1rem;"></div>
            <div id="lightbox-text" style="color:rgba(255,255,255,0.7); font-size:0.9rem; margin-top:4px;"></div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
function openLightbox(src, title, caption) {
    document.getElementById('lightbox-img').src   = src;
    document.getElementById('lightbox-title').textContent   = title;
    document.getElementById('lightbox-text').textContent    = caption;
    const lb = document.getElementById('gallery-lightbox');
    lb.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}
function closeLightbox() {
    document.getElementById('gallery-lightbox').style.display = 'none';
    document.body.style.overflow = '';
}
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLightbox(); });
</script>
@endpush

<div class="mb-3">
    <label class="form-label fw-semibold">Icon</label>
    <input type="hidden" name="icon" id="icon-value" value="{{ $currentIcon ?? '' }}">

    {{-- Search + preview --}}
    <div class="d-flex gap-2 mb-2">
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
            <input type="text" id="icon-search" class="form-control" placeholder="Search icon (e.g. building, chart, home…)">
        </div>
        <div id="icon-preview" style="width:44px;height:44px;background:#f5f5f5;border-radius:10px;border:1px solid #dee2e6;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <i class="{{ $currentIcon ?? 'fas fa-question' }}" style="font-size:18px;color:#555;"></i>
        </div>
    </div>

    {{-- Selected label --}}
    <div id="icon-selected-label" class="small text-muted mb-2">
        {{ $currentIcon ? 'Selected: '.$currentIcon : 'No icon selected' }}
    </div>

    {{-- Icon grid --}}
    <div id="icon-grid" style="display:flex;flex-wrap:wrap;gap:6px;max-height:220px;overflow-y:auto;padding:8px;background:#f9f9f9;border:1px solid #dee2e6;border-radius:8px;">
        {{-- Populated by JS --}}
    </div>
</div>

<style>
.icon-btn { width:38px;height:38px;border:2px solid transparent;border-radius:8px;background:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all 0.2s;font-size:16px;color:#444; }
.icon-btn:hover { border-color:var(--bs-primary);color:var(--bs-primary); }
.icon-btn.selected { border-color:#e05a00;background:#fff5f0;color:#e05a00; }
</style>

<script>
(function(){
    var icons = [
        'fas fa-house-chimney','fas fa-building','fas fa-store','fas fa-chart-line','fas fa-file-signature',
        'fas fa-concierge-bell','fas fa-diagram-project','fas fa-compass-drafting','fas fa-bullhorn',
        'fas fa-hand-holding-dollar','fas fa-handshake','fas fa-city','fas fa-landmark','fas fa-key',
        'fas fa-door-open','fas fa-home','fas fa-hotel','fas fa-map-marker-alt','fas fa-map',
        'fas fa-map-location-dot','fas fa-ruler-combined','fas fa-drafting-compass','fas fa-pencil-ruler',
        'fas fa-paint-roller','fas fa-hammer','fas fa-hard-hat','fas fa-tools','fas fa-wrench',
        'fas fa-layer-group','fas fa-cubes','fas fa-boxes-stacked','fas fa-warehouse',
        'fas fa-industry','fas fa-factory','fas fa-money-bill-wave','fas fa-coins',
        'fas fa-piggy-bank','fas fa-wallet','fas fa-credit-card','fas fa-dollar-sign',
        'fas fa-percent','fas fa-chart-pie','fas fa-chart-bar','fas fa-arrow-trend-up',
        'fas fa-briefcase','fas fa-user-tie','fas fa-users','fas fa-people-group',
        'fas fa-network-wired','fas fa-globe','fas fa-earth-asia','fas fa-award',
        'fas fa-trophy','fas fa-star','fas fa-medal','fas fa-shield-halved',
        'fas fa-check-double','fas fa-circle-check','fas fa-thumbs-up','fas fa-rocket',
        'fas fa-bolt','fas fa-fire','fas fa-gem','fas fa-crown',
        'fas fa-leaf','fas fa-tree','fas fa-sun','fas fa-moon',
        'fas fa-camera','fas fa-image','fas fa-film','fas fa-video',
        'fas fa-phone','fas fa-envelope','fas fa-headset','fas fa-comments',
        'fas fa-calendar','fas fa-clock','fas fa-hourglass-half','fas fa-bell',
        'fas fa-tag','fas fa-tags','fas fa-bookmark','fas fa-flag',
        'fas fa-lock','fas fa-unlock','fas fa-eye','fas fa-magnifying-glass',
        'fas fa-cog','fas fa-gears','fas fa-sliders','fas fa-filter',
    ];

    var grid        = document.getElementById('icon-grid');
    var searchInput = document.getElementById('icon-search');
    var valueInput  = document.getElementById('icon-value');
    var preview     = document.getElementById('icon-preview').querySelector('i');
    var label       = document.getElementById('icon-selected-label');
    var current     = valueInput.value;

    function render(list) {
        grid.innerHTML = '';
        list.forEach(function(cls) {
            var btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'icon-btn' + (cls === current ? ' selected' : '');
            btn.title = cls;
            btn.innerHTML = '<i class="' + cls + '"></i>';
            btn.addEventListener('click', function() {
                current = cls;
                valueInput.value = cls;
                preview.className = cls;
                label.textContent = 'Selected: ' + cls;
                grid.querySelectorAll('.icon-btn').forEach(function(b){ b.classList.remove('selected'); });
                btn.classList.add('selected');
            });
            grid.appendChild(btn);
        });
    }

    render(icons);

    searchInput.addEventListener('input', function() {
        var q = this.value.toLowerCase();
        render(q ? icons.filter(function(i){ return i.includes(q); }) : icons);
    });
})();
</script>

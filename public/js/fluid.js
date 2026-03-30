/*!
 * fluid.js – canvas fluid/ink animation for #fluidCanvas
 * Reacts to mouse movement with gold/amber colour splats.
 */
(function () {
  'use strict';

  function init() {
    var canvas = document.getElementById('fluidCanvas');
    if (!canvas) return;

    var ctx = canvas.getContext('2d');
    var section = canvas.parentElement;
    var W = 0, H = 0;

    /* ── sizing: use section bounding rect, not canvas CSS height ───── */
    function resize() {
      var r = section.getBoundingClientRect();
      W = canvas.width  = Math.max(1, Math.round(r.width));
      H = canvas.height = Math.max(1, Math.round(r.height));
      /* also pin canvas via JS so CSS height:100% isn't needed */
      canvas.style.width  = W + 'px';
      canvas.style.height = H + 'px';
    }
    resize();
    window.addEventListener('resize', function () {
      resize();
      /* repaint background after resize clears canvas */
      ctx.fillStyle = '#0a0a0a';
      ctx.fillRect(0, 0, W, H);
    });

    /* ── colour palette ─────────────────────────────────────────────── */
    var COLORS = [
      [200, 169, 106],
      [222, 192, 128],
      [180, 138,  68],
      [244, 208, 122],
      [158, 116,  52],
    ];

    var particles = [];
    var MAX_P     = 450;
    var lastX     = -1;
    var lastY     = -1;
    var inSection = false;

    /* ── mouse → canvas coords ──────────────────────────────────────── */
    function toCanvas(cx, cy) {
      var r = section.getBoundingClientRect();
      var inside = cx >= r.left && cx <= r.right && cy >= r.top && cy <= r.bottom;
      return {
        x:      ((cx - r.left) / r.width)  * W,
        y:      ((cy - r.top)  / r.height) * H,
        inside: inside,
      };
    }

    /* ── spawn a burst of particles ─────────────────────────────────── */
    function splat(x, y, vx, vy, count) {
      for (var i = 0; i < count && particles.length < MAX_P; i++) {
        var c   = COLORS[Math.floor(Math.random() * COLORS.length)];
        var spd = Math.sqrt(vx * vx + vy * vy) || 2;
        particles.push({
          x:     x + (Math.random() - 0.5) * 14,
          y:     y + (Math.random() - 0.5) * 14,
          vx:    vx * 0.3  + (Math.random() - 0.5) * Math.max(2, spd * 0.4),
          vy:    vy * 0.3  + (Math.random() - 0.5) * Math.max(2, spd * 0.4),
          r: c[0], g: c[1], b: c[2],
          alpha: 0.6  + Math.random() * 0.35,
          size:  14   + Math.random() * 40,
          life:  1.0,
          decay: 0.005 + Math.random() * 0.007,
        });
      }
    }

    /* ── mouse tracking ─────────────────────────────────────────────── */
    document.addEventListener('mousemove', function (e) {
      var p = toCanvas(e.clientX, e.clientY);
      inSection = p.inside;

      if (!p.inside) { lastX = -1; lastY = -1; return; }

      var vx  = lastX >= 0 ? p.x - lastX : 0;
      var vy  = lastY >= 0 ? p.y - lastY : 0;
      var spd = Math.sqrt(vx * vx + vy * vy);

      if (spd > 1.5) {
        splat(p.x, p.y, vx, vy, Math.min(7, Math.ceil(spd / 3) + 1));
      }

      lastX = p.x;
      lastY = p.y;
    });

    /* ── idle ambient splats (so canvas is never blank) ─────────────── */
    var idleTimer = 0;
    function idleSplat(ts) {
      if (!inSection && ts - idleTimer > 1600 && particles.length < 80) {
        idleTimer = ts;
        var cx = W * (0.15 + Math.random() * 0.70);
        var cy = H * (0.15 + Math.random() * 0.70);
        splat(cx, cy, (Math.random() - 0.5) * 4, (Math.random() - 0.5) * 4, 3);
      }
    }

    /* ── render loop ─────────────────────────────────────────────────── */
    ctx.fillStyle = '#0a0a0a';
    ctx.fillRect(0, 0, W, H);

    function animate(ts) {
      requestAnimationFrame(animate);

      idleSplat(ts || 0);

      /* slow-fade overlay */
      ctx.globalCompositeOperation = 'source-over';
      ctx.fillStyle = 'rgba(10,10,10,0.042)';
      ctx.fillRect(0, 0, W, H);

      if (!particles.length) return;

      ctx.globalCompositeOperation = 'lighter';

      for (var i = particles.length - 1; i >= 0; i--) {
        var p = particles[i];

        p.x   += p.vx;
        p.y   += p.vy;
        p.vx  *= 0.974;
        p.vy  *= 0.974;
        p.life -= p.decay;
        p.size *= 1.013;

        if (p.life <= 0 || p.size > 270) { particles.splice(i, 1); continue; }

        var a    = p.life * p.alpha * 0.48;
        var grad = ctx.createRadialGradient(p.x, p.y, 0, p.x, p.y, p.size);
        grad.addColorStop(0, 'rgba(' + p.r + ',' + p.g + ',' + p.b + ',' + a + ')');
        grad.addColorStop(1, 'rgba(' + p.r + ',' + p.g + ',' + p.b + ',0)');

        ctx.fillStyle = grad;
        ctx.beginPath();
        ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
        ctx.fill();
      }

      ctx.globalCompositeOperation = 'source-over';
    }

    requestAnimationFrame(animate);
  }

  /* wait for full page load so layout/heights are finalised */
  window.addEventListener('load', init);
})();

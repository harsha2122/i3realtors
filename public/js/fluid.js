/*!
 * fluid.js – canvas-based fluid/ink animation for #fluidCanvas
 * Reacts to mouse movement with gold/amber colour splats.
 */
(function () {
  'use strict';

  /* ── wait for DOM ─────────────────────────────────────────────────── */
  function init() {
    var canvas = document.getElementById('fluidCanvas');
    if (!canvas) return;

    var ctx = canvas.getContext('2d');
    var W, H;

    /* palette – gold/amber matching the site accent */
    var COLORS = [
      [200, 169, 106],
      [220, 190, 130],
      [180, 140,  70],
      [240, 205, 120],
      [160, 118,  55],
    ];

    var particles  = [];
    var MAX_P      = 400;
    var lastX      = -1;
    var lastY      = -1;
    var inSection  = false;

    /* ── sizing ──────────────────────────────────────────────────────── */
    function resize() {
      W = canvas.width  = canvas.offsetWidth  || canvas.parentElement.offsetWidth;
      H = canvas.height = canvas.offsetHeight || canvas.parentElement.offsetHeight;
    }
    resize();
    window.addEventListener('resize', resize);

    /* ── section bounds helper ───────────────────────────────────────── */
    var section = canvas.parentElement;

    function toCanvas(clientX, clientY) {
      var r = section.getBoundingClientRect();
      return {
        x: ((clientX - r.left) / r.width)  * W,
        y: ((clientY - r.top)  / r.height) * H,
        inside: clientX >= r.left && clientX <= r.right &&
                clientY >= r.top  && clientY <= r.bottom
      };
    }

    /* ── spawn particles on mouse move ──────────────────────────────── */
    function splat(x, y, vx, vy, count) {
      for (var i = 0; i < count && particles.length < MAX_P; i++) {
        var c   = COLORS[Math.floor(Math.random() * COLORS.length)];
        var spd = Math.sqrt(vx * vx + vy * vy);
        particles.push({
          x:     x + (Math.random() - 0.5) * 12,
          y:     y + (Math.random() - 0.5) * 12,
          vx:    vx * 0.25 + (Math.random() - 0.5) * Math.max(2, spd * 0.3),
          vy:    vy * 0.25 + (Math.random() - 0.5) * Math.max(2, spd * 0.3),
          r:     c[0], g: c[1], b: c[2],
          alpha: 0.55 + Math.random() * 0.35,
          size:  12 + Math.random() * 35,
          life:  1.0,
          decay: 0.005 + Math.random() * 0.007,
        });
      }
    }

    document.addEventListener('mousemove', function (e) {
      var p = toCanvas(e.clientX, e.clientY);
      inSection = p.inside;

      if (!p.inside) { lastX = -1; lastY = -1; return; }

      var vx = lastX >= 0 ? p.x - lastX : 0;
      var vy = lastY >= 0 ? p.y - lastY : 0;
      var spd = Math.sqrt(vx * vx + vy * vy);

      if (spd > 1.5) {
        splat(p.x, p.y, vx, vy, Math.min(6, Math.ceil(spd / 4)));
      }

      lastX = p.x;
      lastY = p.y;
    });

    /* idle ambient bubbles so the section is never completely blank */
    var idleTimer = 0;
    function idleSplat(ts) {
      if (!inSection && ts - idleTimer > 1800 && particles.length < 60) {
        idleTimer = ts;
        var cx = W * (0.2 + Math.random() * 0.6);
        var cy = H * (0.2 + Math.random() * 0.6);
        splat(cx, cy, (Math.random() - 0.5) * 3, (Math.random() - 0.5) * 3, 2);
      }
    }

    /* ── render loop ─────────────────────────────────────────────────── */
    ctx.fillStyle = 'rgba(10,10,10,1)';
    ctx.fillRect(0, 0, W, H);

    function animate(ts) {
      requestAnimationFrame(animate);

      idleSplat(ts || 0);

      /* fade canvas to background */
      ctx.globalCompositeOperation = 'source-over';
      ctx.fillStyle = 'rgba(10,10,10,0.045)';
      ctx.fillRect(0, 0, W, H);

      ctx.globalCompositeOperation = 'lighter';

      for (var i = particles.length - 1; i >= 0; i--) {
        var p = particles[i];

        p.x   += p.vx;
        p.y   += p.vy;
        p.vx  *= 0.975;
        p.vy  *= 0.975;
        p.life -= p.decay;
        p.size *= 1.012;

        if (p.life <= 0 || p.size > 260) { particles.splice(i, 1); continue; }

        var a    = p.life * p.alpha * 0.45;
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

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();

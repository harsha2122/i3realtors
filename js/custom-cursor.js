// Custom Cursor Implementation
// This file provides enhanced cursor functionality with PNG/SVG support

(function () {
  'use strict';

  const cursorEl = document.querySelector('.custom-cursor');
  const interactiveElements = document.querySelectorAll(
    'button, a, input[type="button"], input[type="submit"], .btn, [role="button"], input[type="range"]'
  );
  const textElements = document.querySelectorAll(
    'input[type="text"], input[type="number"], input[type="email"], textarea, [contenteditable="true"]'
  );

  let mouseX = 0;
  let mouseY = 0;
  let isHovering = false;

  // Track mouse movement
  document.addEventListener('mousemove', (e) => {
    mouseX = e.clientX;
    mouseY = e.clientY;

    // Update cursor position
    if (cursorEl) {
      cursorEl.style.left = mouseX - 16 + 'px';
      cursorEl.style.top = mouseY - 16 + 'px';
    }
  });

  // Add hover effects to interactive elements
  interactiveElements.forEach((el) => {
    el.addEventListener('mouseenter', () => {
      if (cursorEl) {
        cursorEl.classList.add('hover');
      }
      isHovering = true;
    });

    el.addEventListener('mouseleave', () => {
      if (cursorEl) {
        cursorEl.classList.remove('hover');
      }
      isHovering = false;
    });
  });

  // Add text cursor effects
  textElements.forEach((el) => {
    el.addEventListener('focus', () => {
      if (cursorEl) {
        cursorEl.classList.add('text-mode');
      }
    });

    el.addEventListener('blur', () => {
      if (cursorEl) {
        cursorEl.classList.remove('text-mode');
      }
    });
  });

  // Hide custom cursor on mouse leave
  document.addEventListener('mouseleave', () => {
    if (cursorEl) {
      cursorEl.classList.remove('active');
    }
  });

  // Show custom cursor on mouse enter
  document.addEventListener('mouseenter', () => {
    if (cursorEl) {
      cursorEl.classList.add('active');
    }
  });

  // Initialize cursor visibility
  setTimeout(() => {
    if (cursorEl) {
      cursorEl.classList.add('active');
    }
  }, 100);
})();

// SVG-based cursor fallback (if PNG images are not available)
function createSVGCursor(type = 'default') {
  const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
  svg.setAttribute('width', '24');
  svg.setAttribute('height', '24');
  svg.setAttribute('viewBox', '0 0 24 24');

  if (type === 'default') {
    // Default arrow cursor
    const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
    path.setAttribute('d', 'M2 2 L2 22 L10 14 L14 22 L16 22 L12 14 L20 14 Z');
    path.setAttribute('fill', '#4a90e2');
    path.setAttribute('stroke', 'white');
    path.setAttribute('stroke-width', '1');
    svg.appendChild(path);
  } else if (type === 'pointer') {
    // Pointer cursor
    const circle = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
    circle.setAttribute('cx', '12');
    circle.setAttribute('cy', '12');
    circle.setAttribute('r', '10');
    circle.setAttribute('fill', 'none');
    circle.setAttribute('stroke', '#4a90e2');
    circle.setAttribute('stroke-width', '2');
    svg.appendChild(circle);

    const dot = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
    dot.setAttribute('cx', '12');
    dot.setAttribute('cy', '12');
    dot.setAttribute('r', '4');
    dot.setAttribute('fill', '#4a90e2');
    svg.appendChild(dot);
  }

  return 'data:image/svg+xml;base64,' + btoa(svg.outerHTML);
}

// Alternative: Use CSS cursor properties directly
// This function can be called to update cursor styles dynamically
function setCustomCursor(element, cursorType = 'default') {
  const cursorMap = {
    default: 'url("data:image/svg+xml;charset=UTF-8,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2224%22 height=%2224%22 viewBox=%220 0 24 24%22%3E%3Cpath fill=%22%234a90e2%22 stroke=%22white%22 stroke-width=%221%22 d=%22M2 2 L2 22 L10 14 L14 22 L16 22 L12 14 L20 14 Z%22/%3E%3C/svg%3E") 2 2, auto',
    pointer:
      'url("data:image/svg+xml;charset=UTF-8,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2224%22 height=%2224%22 viewBox=%220 0 24 24%22%3E%3Ccircle cx=%2212%22 cy=%2212%22 r=%2710%22 fill=%22none%22 stroke=%22%234a90e2%22 stroke-width=%222%22/%3E%3Ccircle cx=%2212%22 cy=%2712%22 r=%274%22 fill=%22%234a90e2%22/%3E%3C/svg%3E") 12 12, pointer',
    text: 'text',
    grab: 'grab',
    grabbing: 'grabbing',
  };

  if (element && cursorMap[cursorType]) {
    element.style.cursor = cursorMap[cursorType];
  }
}

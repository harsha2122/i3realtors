# Custom Cursor Implementation Guide

## Overview
The calculator page now includes a custom cursor system that supports:
- **Default cursor**: Blue arrow with white outline
- **Pointer cursor**: Blue circle with dot for clickable elements
- **Text cursor**: Crosshair-style cursor for text inputs
- **Grab cursor**: For draggeable elements like range sliders

## Current Implementation

### What Was Added:
1. **`app/Http/Controllers/Website/CalculatorController.php`** - New controller for:
   - Handling calculator page requests
   - Returns the calculator view with proper data

2. **`resources/views/website/calculator.blade.php`** - Laravel Blade template with:
   - Loan amount input with range slider
   - Interest rate input with range slider
   - Loan tenure input with range slider
   - Real-time EMI calculations
   - Amortization schedule table
   - Integrated with website layout
   - Uses custom cursor styling

3. **`routes/web.php`** - Updated with:
   - New route: `GET /calculator` named `calculator`
   - Properly integrated with website routing

4. **`css/custom-cursor.css`** - Custom cursor styles using:
   - SVG data URIs (no external files needed)
   - Different cursors for different interactive elements
   - Smooth transitions and hover effects

5. **`js/custom-cursor.js`** - Enhanced cursor functionality with:
   - Mouse tracking
   - Hover effects on interactive elements
   - Focus effects for text inputs
   - Fallback cursor generation

6. **`images/cursor.svg`** - Example SVG cursor file

## How to Use Custom PNG Cursors

### Option 1: Using PNG Files (Recommended)
If you want to use your own PNG cursor images:

1. **Create or prepare your PNG cursor files:**
   - `cursor.png` (24x24px) - Default arrow cursor
   - `cursor-pointer.png` (24x24px) - Pointer/click cursor
   - `cursor-text.png` (24x24px) - Text selection cursor

2. **Place them in the `images/` folder**

3. **Update `css/custom-cursor.css`:**
   Replace the data URIs with file paths:
   ```css
   body {
     cursor: url('../images/cursor.png') 2 2, auto;
   }

   button, a, input[type='button'], .btn, [role='button'] {
     cursor: url('../images/cursor-pointer.png') 12 12, pointer;
   }

   input[type='text'], textarea {
     cursor: url('../images/cursor-text.png') 12 12, text;
   }
   ```

### Option 2: Using SVG Files
SVG cursors work great and don't require the image to be converted:

```css
body {
  cursor: url('../images/cursor.svg') 2 2, auto;
}
```

### Option 3: Current Method (SVG Data URIs)
The current implementation uses embedded SVG as data URIs:
- No external files needed
- Works in all modern browsers
- Easy to customize inline

## Cursor Hotspot
The numbers after the URL (e.g., `2 2` or `12 12`) define the **hotspot** - the precise click point:
- First number: X coordinate (0-24)
- Second number: Y coordinate (0-24)

Example: `cursor: url('...') 2 2, auto;`
- This sets the click point 2 pixels from left and 2 pixels from top

## How to Replace Cursors

### Step 1: Create Custom PNG Cursors
You can create custom cursors using:
- **Photoshop/GIMP**: Create 24x24px images
- **Online tools**: https://www.cursor.cc/
- **Figma**: Design and export as PNG

### Step 2: Place in Images Folder
```
/images/
  ├── cursor.png          (default arrow)
  ├── cursor-pointer.png  (click pointer)
  └── cursor-text.png     (text cursor)
```

### Step 3: Update CSS
Modify `css/custom-cursor.css` to reference your PNG files:

```css
/* For default cursor */
body {
  cursor: url('../images/cursor.png') 2 2, auto;
}

/* For clickable elements */
button, a, .btn {
  cursor: url('../images/cursor-pointer.png') 12 12, pointer;
}

/* For text areas */
input[type='text'], textarea {
  cursor: url('../images/cursor-text.png') 12 12, text;
}
```

### Step 4: Test
Open the page in a browser and test cursor behavior:
- Hover over buttons
- Click on input fields
- Move over text areas
- Interact with sliders

## Custom Cursor Colors

To change cursor colors in the SVG data URIs, modify the fill color:
- `fill='%234a90e2'` - Current blue color
- Change to your preferred color (hex format, URL encoded)

Example for red cursor:
```css
cursor: url("data:image/svg+xml;charset=UTF-8,%3Csvg xmlns='http://www.w3.org/2000/svg'...fill='%23ff0000'...%3E") 2 2, auto;
```

## Browser Support

| Browser | Support |
|---------|---------|
| Chrome  | ✅ Full |
| Firefox | ✅ Full |
| Safari  | ✅ Full |
| Edge    | ✅ Full |
| IE 11   | ⚠️ Fallback |

## Fallback Behavior

If custom cursors are not supported or fail to load, browsers automatically fall back to standard cursors:
- `auto` → default system cursor
- `pointer` → standard pointer
- `text` → standard text cursor
- `grab` → standard grab cursor

## EMI Calculator Features

The calculator page includes:

### Interactive Elements
- **Loan Amount Slider**: ₹1,00,000 to ₹1,00,00,000
- **Interest Rate Slider**: 3% to 15% per annum
- **Tenure Slider**: 6 to 360 months
- **Direct Input Fields**: Type or use sliders

### Calculations
- Monthly EMI
- Total Amount Payable
- Total Interest Payable
- Amortization Schedule (month-by-month breakdown)

### Features
- Real-time calculation
- Sync between sliders and input fields
- Formatted currency display
- Responsive design
- Mobile-friendly

## Navigation

The calculator is accessible from:
- **Route**: `/calculator`
- **Route Name**: `calculator`
- **Navigation Menu**: "Calculator" link under main menu
- **Template**: Located at `resources/views/website/calculator.blade.php`
- **Controller**: `App\Http\Controllers\Website\CalculatorController`
- Works with the main website layout and header navigation

## Technical Details

### Files Modified/Created:
- ✅ `app/Http/Controllers/Website/CalculatorController.php` - New controller
- ✅ `resources/views/website/calculator.blade.php` - Blade template
- ✅ `routes/web.php` - New calculator route added
- ✅ `css/custom-cursor.css` - Custom cursor styles
- ✅ `js/custom-cursor.js` - Cursor enhancement script
- ✅ `images/cursor.svg` - Example SVG cursor

### Dependencies:
- Bootstrap 4
- jQuery 3.7.1
- Font Awesome 7
- GSAP (for animations)
- Custom JavaScript for EMI calculations

## Quick Start

1. Navigate to `/calculator` route in your browser (or click "Calculator" in navigation menu)
2. Adjust loan parameters using sliders or input fields
3. Click "Calculate EMI" button to view results
4. View detailed amortization schedule in the results section
5. Try different values to see how EMI changes in real-time

## Customization Tips

### Change Primary Color
In `custom-cursor.css`, replace `%234a90e2` with your brand color:
```css
/* Change from blue to green */
fill='%2300aa00' /* Green */
```

### Adjust Cursor Size
Modify the SVG `viewBox` or path dimensions:
```svg
<svg width='32' height='32' viewBox='0 0 32 32'>
  <!-- Scaled up paths -->
</svg>
```

### Add More Cursors
Add additional cursor types in CSS:
```css
.draggable {
  cursor: url('...') 12 12, move;
}

.resizable {
  cursor: url('...') 12 12, nwse-resize;
}
```

## Troubleshooting

### Cursor Not Showing
1. Check browser console for errors
2. Verify file paths in CSS
3. Ensure PNG files are in correct location
4. Try using SVG format instead

### Cursor Appears Blurry
1. Use PNG format with exact pixel sizes
2. Ensure cursor hotspot is set correctly
3. Try next power of 2 size (24x24, 32x32, 64x64)

### Cursor Not Changing on Hover
1. Check CSS selectors match elements
2. Verify CSS file is linked in HTML
3. Clear browser cache
4. Test with simple cursor property first

## Resources

- **Cursor Editor**: https://www.cursor.cc/
- **SVG Documentation**: https://developer.mozilla.org/en-US/docs/Web/SVG
- **CSS Cursor Docs**: https://developer.mozilla.org/en-US/docs/Web/CSS/cursor
- **EMI Calculation Formula**: M = P * r * (1 + r)^n / ((1 + r)^n - 1)

## Support

For issues or questions:
1. Check browser console for JavaScript errors
2. Validate HTML and CSS
3. Test with different browsers
4. Ensure all file paths are correct

---

**Created**: 2024
**Last Updated**: March 2024
**Version**: 1.0

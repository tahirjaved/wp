# Quick Setup Guide

## Initial Setup Steps

### 1. Build Tailwind CSS (Required First Time)

The theme uses Tailwind CSS v4. You need to build the CSS file before using the theme.

**Option A: Using npm (Recommended)**
```bash
cd /path/to/wp-content/themes/snowremoval
npm install
npm run build:css
```

**Option B: Using Tailwind CLI directly**
```bash
npx tailwindcss@next -i ./assets/css/tailwind.css -o ./assets/css/style.css --minify
```

### 2. Activate the Theme

1. Go to **WordPress Admin > Appearance > Themes**
2. Find "Snow Removal Services" theme
3. Click "Activate"

### 3. Configure Basic Settings

Go to **Appearance > Customize** and set:

- **Site Identity**
  - Upload your logo
  - Set site title and tagline

- **Theme Options** (in Site Identity section)
  - Phone Number: Your business phone
  - Email Address: Your business email
  - Service Area: e.g., "Boston, MA"
  - Weather Latitude: e.g., "42.3601" (for Boston)
  - Weather Longitude: e.g., "-71.0589" (for Boston)
  - Weather Location Name: e.g., "Boston"

### 4. Set Up Navigation

1. Go to **Appearance > Menus**
2. Create a new menu or edit existing
3. Add menu items:
   - Home
   - Services (with sub-items: Residential Plowing, Commercial Plowing, etc.)
   - Contact
4. Assign to "Primary Menu" location
5. Save

### 5. Create Pages

Create these pages:

1. **Home** (use Front Page template automatically)
2. **Residential Plowing** (use "Service Page" template)
3. **Commercial Plowing** (use "Service Page" template)
4. **Snow Shoveling** (use "Service Page" template)
5. **Salting Services** (use "Service Page" template)
6. **Snow Blowing** (use "Service Page" template)
7. **Contact** (use "Contact Page" template)

### 6. Set Homepage

1. Go to **Settings > Reading**
2. Select "A static page"
3. Choose your "Home" page as the homepage
4. Save

### 7. Upload Favicon (Optional)

If you want custom favicons:
1. Replace files in `/assets/images/`:
   - `favicon-16x16.png`
   - `favicon-32x32.png`

Or use WordPress's built-in favicon feature in **Appearance > Customize > Site Identity**.

## For Multiple Sites

When setting up for a new site:

1. **Build CSS** (if you modified `assets/css/tailwind.css` source file)
2. **Activate theme**
3. **Upload logo** via Customizer
4. **Set contact info** (phone, email, service area)
5. **Set weather location** (lat/lng for that city)
6. **Create pages** with site-specific content
7. **Set up menu** with site-specific pages

## Troubleshooting

### CSS Not Loading?
- Make sure you've built Tailwind CSS (see step 1) - outputs to `/assets/css/style.css`
- Check file permissions on `/assets/css/style.css`
- Clear browser cache

### Weather Not Showing?
- Check weather coordinates in Customizer
- Verify JavaScript console for errors
- Check if Open-Meteo API is accessible

### Menu Not Working?
- Make sure menu is assigned to "Primary Menu" location
- Check if JavaScript is enabled
- Clear browser cache

### Logo Not Showing?
- Verify logo file exists in `/assets/images/`
- Check file permissions
- Try uploading via Customizer instead

## Next Steps

- Customize colors in `assets/css/tailwind.css` (source file, in `@theme` section), then run `npm run build:css` to rebuild `assets/css/style.css`
- Add custom content to pages
- Configure widgets in footer (if needed)
- Set up contact form plugin (if needed)


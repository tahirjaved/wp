# Snow Removal Services WordPress Theme

A modern, responsive WordPress theme for snow removal service businesses built with Tailwind CSS v4. Designed for multi-site deployment with easy customization options.

## Features

- **Tailwind CSS v4**: Latest version of Tailwind CSS with modern utility classes
- **Responsive Design**: Mobile-first approach, works on all devices
- **Multi-Site Ready**: Easy customization for 70+ sites via WordPress Customizer
- **Weather Integration**: Live weather ticker using Open-Meteo API
- **Customizable**: Phone, email, service area, and weather location settings
- **SEO Friendly**: Clean code structure and semantic HTML
- **Fast Loading**: Optimized assets and minimal dependencies

## Git Repository

This theme is version controlled with Git. 

### Initial Setup

```bash
# Clone or navigate to theme directory
cd wp-content/themes/snowremoval

# Install dependencies
npm install

# Build CSS
npm run build:css
```

### Development Workflow

```bash
# Make changes to assets/css/tailwind.css (source file)
# Then rebuild CSS (outputs to assets/css/style.css)
npm run build:css

# Or watch for changes
npm run watch:css
```

### Git Commands

```bash
# Check status
git status

# Add changes
git add .

# Commit changes
git commit -m "Your commit message"

# Push to remote (if configured)
git push origin main
```

### Ignored Files

The following are ignored by Git (see `.gitignore`):
- `node_modules/` - Dependencies
- `package-lock.json` - Lock file (optional)
- OS and IDE files
- WordPress config files

## Installation

1. Upload the theme folder to `/wp-content/themes/`
2. Activate the theme through the 'Themes' menu in WordPress
3. Go to **Appearance > Customize** to configure your site settings

## Configuration

### Basic Settings

Navigate to **Appearance > Customize** and configure:

- **Site Identity**: Upload your logo and set site title/tagline
- **Phone Number**: Your business phone number (displayed throughout the site)
- **Email Address**: Your business email address
- **Service Area**: The area you serve (e.g., "Boston, MA")
- **Weather Settings**: 
  - Latitude/Longitude for weather API
  - Location name for weather display

### Logo & Favicon

- **Logo**: Upload via **Appearance > Customize > Site Identity > Logo**
- **Favicon**: Place favicon files in `/assets/images/`:
  - `favicon-16x16.png`
  - `favicon-32x32.png`

Default logo and favicon files are included in the theme.

### Navigation Menu

1. Go to **Appearance > Menus**
2. Create a new menu or use existing
3. Assign to "Primary Menu" location
4. Add menu items (supports dropdown menus)

### Page Templates

The theme includes several page templates:

- **Default Template**: Standard page layout
- **Service Page**: For service pages (residential-plowing, commercial-plowing, etc.)
- **Contact Page**: Contact form template

To use a template:
1. Edit a page
2. In the Page Attributes box, select the template
3. Update the page

## Building Tailwind CSS

If you need to rebuild Tailwind CSS (after making changes to `assets/css/tailwind.css`):

### Option 1: Using npm scripts (Recommended)

```bash
npm run build:css
```

This will build from `assets/css/tailwind.css` (source) to `assets/css/style.css` (output).

### Option 2: Using Tailwind CLI directly

1. Install Tailwind CSS CLI:
```bash
npm install -D tailwindcss@next
```

2. Build CSS:
```bash
npx tailwindcss -i ./assets/css/tailwind.css -o ./assets/css/style.css --minify
```

### Option 2: Using CDN (Not Recommended for Production)

You can use Tailwind CSS via CDN, but this is not recommended for production as it increases file size.

## File Structure

```
snowremoval/
├── assets/
│   ├── css/
│   │   ├── tailwind.css          # Tailwind CSS source file
│   │   └── style.css             # Tailwind CSS built output
│   ├── js/
│   │   └── main.js               # Theme JavaScript
│   └── images/
│       ├── logo.png              # Default logo
│       ├── logo.svg              # Default logo (SVG)
│       ├── favicon-16x16.png     # Favicon
│       └── favicon-32x32.png     # Favicon
├── style.css                     # Theme stylesheet (header)
├── functions.php                 # Theme functions
├── header.php                    # Header template
├── footer.php                    # Footer template
├── index.php                     # Main template
├── page.php                      # Page template
├── front-page.php                # Homepage template
├── page-contact.php              # Contact page template
├── page-service.php              # Service page template
└── README.md                     # This file
```

## Customization for Multiple Sites

The theme is designed to be easily customized for multiple sites:

1. **Logo**: Upload different logos per site via Customizer
2. **Contact Info**: Set phone, email, and service area per site
3. **Weather Location**: Configure weather location per site
4. **Content**: Create pages with different content per site
5. **Colors**: Modify Tailwind CSS theme variables in `assets/css/tailwind.css` (source file), then run `npm run build:css` to rebuild `assets/css/style.css`

### Quick Site Setup Checklist

- [ ] Upload logo via Customizer
- [ ] Set phone number
- [ ] Set email address
- [ ] Set service area
- [ ] Configure weather location (lat/lng)
- [ ] Create navigation menu
- [ ] Create pages (Home, Services, Contact)
- [ ] Set homepage (Settings > Reading)

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

## Support

For issues or questions:
1. Check WordPress documentation
2. Review Tailwind CSS documentation: https://tailwindcss.com
3. Check theme files for inline comments

## License

This theme is licensed under the GPL v2 or later.

## Credits

- **Tailwind CSS**: https://tailwindcss.com
- **Open-Meteo API**: https://open-meteo.com (for weather data)


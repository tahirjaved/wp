# Manual Theme Copy Instructions

Since the theme files aren't in the source directory on the server, you have two options:

## Option 1: Copy Files Directly to Server (Quick Fix)

On your **local machine**, run:

```bash
# From your local wp directory
cd /Users/apple/Documents/intermedia/wp

# Copy theme to server using SCP
scp -r wp-content/themes/custom-theme root@your-server-ip:/data/coolify/applications/fkc08k04okos0sswo080sg0o/wp-content/themes/

# Then SSH into server and set permissions
ssh root@your-server-ip
chown -R www-data:www-data /data/coolify/applications/fkc08k04okos0sswo080sg0o/wp-content/themes/custom-theme
chmod -R 755 /data/coolify/applications/fkc08k04okos0sswo080sg0o/wp-content/themes/custom-theme

# Restart container
docker restart wordpress-fkc08k04okos0sswo080sg0o-163732317117
```

## Option 2: Fix Git Push and Redeploy (Proper Solution)

### Step 1: Verify files are in Git
```bash
git ls-files wp-content/themes/custom-theme/
```

### Step 2: Push to Git (if not already pushed)
```bash
git push origin main
```

### Step 3: In Coolify
1. Go to your WordPress application
2. Click "Deploy" or "Redeploy"
3. Wait for deployment

### Step 4: On Server - Check if files are in source
```bash
ls -la /data/coolify/source/jkgck0w8ww4kwws0gk8kg0wc/wp-content/themes/custom-theme/
```

### Step 5: Copy from source to applications
```bash
bash /data/coolify/source/jkgck0w8ww4kwws0gk8kg0wc/COPY_THEME.sh
```

## Option 3: Create Theme Directory Manually on Server

If you can't copy from local, create the theme files directly on the server:

```bash
# On server
mkdir -p /data/coolify/applications/fkc08k04okos0sswo080sg0o/wp-content/themes/custom-theme
cd /data/coolify/applications/fkc08k04okos0sswo080sg0o/wp-content/themes/custom-theme

# Create style.css
cat > style.css << 'EOF'
/*
Theme Name: Custom Theme
Theme URI: https://example.com
Author: Your Name
Author URI: https://example.com
Description: A custom WordPress theme
Version: 1.0.0
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: custom-theme
*/

/* Your custom styles here */

body {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
    line-height: 1.6;
    color: #333;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}
EOF

# Create index.php
cat > index.php << 'EOF'
<?php
/**
 * The main template file
 */

get_header(); ?>

<main id="main" class="site-main">
    <div class="container">
        <?php
        if (have_posts()) :
            while (have_posts()) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                    </header>
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                </article>
                <?php
            endwhile;
        endif;
        ?>
    </div>
</main>

<?php get_footer(); ?>
EOF

# Create functions.php
cat > functions.php << 'EOF'
<?php
/**
 * Custom Theme Functions
 */

function custom_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
}
add_action('after_setup_theme', 'custom_theme_setup');

function custom_theme_scripts() {
    wp_enqueue_style('custom-theme-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'custom_theme_scripts');
EOF

# Create header.php
cat > header.php << 'EOF'
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header class="site-header">
        <div class="container">
            <h1 class="site-title"><?php bloginfo('name'); ?></h1>
        </div>
    </header>
EOF

# Create footer.php
cat > footer.php << 'EOF'
    <footer class="site-footer">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
        </div>
    </footer>
    <?php wp_footer(); ?>
</body>
</html>
EOF

# Set permissions
chown -R www-data:www-data /data/coolify/applications/fkc08k04okos0sswo080sg0o/wp-content/themes/custom-theme
chmod -R 755 /data/coolify/applications/fkc08k04okos0sswo080sg0o/wp-content/themes/custom-theme

# Restart container
docker restart wordpress-fkc08k04okos0sswo080sg0o-163732317117
```


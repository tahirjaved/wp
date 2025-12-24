# Quick Fix: Copy Theme to Container

Since your theme isn't showing up, here's how to copy it manually using Coolify's terminal:

## Option 1: Copy via Terminal (Immediate Fix)

1. In Coolify, go to your WordPress resource → **Terminal**
2. Run these commands:

```bash
# Create themes directory if needed
mkdir -p /var/www/html/wp-content/themes

# Download or create the theme files directly
# You can use git, wget, or manually create files
```

## Option 2: Use Volume Mount (Permanent Solution)

1. In Coolify, go to your WordPress resource → **Volumes**
2. Add a new volume mount:
   - **Host Path**: `/data/coolify/source/your-project-name/wp-content/themes`
   - **Container Path**: `/var/www/html/wp-content/themes`
   - **Type**: Bind Mount
3. Save and redeploy

## Option 3: Use Git Repository

If your code is in a Git repository:

1. In Coolify, configure your WordPress resource to use a Git repository
2. Make sure `wp-content/themes/custom-theme/` is committed to your repo
3. Coolify will automatically sync the files on deployment

## Option 4: Manual File Creation

You can create the theme files directly in the container via terminal:

```bash
# Navigate to themes directory
cd /var/www/html/wp-content/themes

# Create theme directory
mkdir -p custom-theme
cd custom-theme

# Create style.css (copy from your local file)
cat > style.css << 'EOF'
/*
Theme Name: Custom Theme
Theme URI: https://example.com
Author: Your Name
Description: A custom WordPress theme
Version: 1.0.0
*/
EOF

# Create index.php
cat > index.php << 'EOF'
<?php
get_header(); ?>
<main>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article>
            <h1><?php the_title(); ?></h1>
            <?php the_content(); ?>
        </article>
    <?php endwhile; endif; ?>
</main>
<?php get_footer(); ?>
EOF

# Create functions.php
cat > functions.php << 'EOF'
<?php
function custom_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'custom_theme_setup');
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
<header>
    <h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
</header>
EOF

# Create footer.php
cat > footer.php << 'EOF'
<footer>
    <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
</footer>
<?php wp_footer(); ?>
</body>
</html>
EOF

# Set permissions
chown -R www-data:www-data /var/www/html/wp-content/themes/custom-theme
chmod -R 755 /var/www/html/wp-content/themes/custom-theme
```

Then refresh your WordPress admin → Appearance → Themes



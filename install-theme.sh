#!/bin/bash
# Copy and paste this entire script into Coolify's terminal
# This will create your custom theme directly in the WordPress container

cd /var/www/html/wp-content/themes

# Create theme directory
mkdir -p custom-theme
cd custom-theme

# Create style.css
cat > style.css << 'STYLECSS'
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
STYLECSS

# Create functions.php
cat > functions.php << 'FUNCTIONSPHP'
<?php
/**
 * Custom Theme functions and definitions
 *
 * @package Custom Theme
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Theme setup
 */
function custom_theme_setup() {
    // Add theme support for various features
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
}
add_action('after_setup_theme', 'custom_theme_setup');

/**
 * Enqueue scripts and styles
 */
function custom_theme_scripts() {
    wp_enqueue_style('custom-theme-style', get_stylesheet_uri(), array(), '1.0.0');
}
add_action('wp_enqueue_scripts', 'custom_theme_scripts');
FUNCTIONSPHP

# Create header.php
cat > header.php << 'HEADERPHP'
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header id="masthead" class="site-header">
    <div class="container">
        <div class="site-branding">
            <h1 class="site-title">
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                    <?php bloginfo('name'); ?>
                </a>
            </h1>
            <?php
            $description = get_bloginfo('description', 'display');
            if ($description || is_customize_preview()) :
                ?>
                <p class="site-description"><?php echo $description; ?></p>
            <?php endif; ?>
        </div>

        <nav id="site-navigation" class="main-navigation">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_id'        => 'primary-menu',
            ));
            ?>
        </nav>
    </div>
</header>
HEADERPHP

# Create footer.php
cat > footer.php << 'FOOTERPHP'
<footer id="colophon" class="site-footer">
    <div class="container">
        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
FOOTERPHP

# Create index.php
cat > index.php << 'INDEXPHP'
<?php
/**
 * The main template file
 *
 * @package Custom Theme
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
                        <h1 class="entry-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h1>
                    </header>

                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                </article>
                <?php
            endwhile;
        else :
            ?>
            <p><?php esc_html_e('No posts found.', 'custom-theme'); ?></p>
            <?php
        endif;
        ?>
    </div>
</main>

<?php
get_footer();
INDEXPHP

# Set proper permissions
chown -R www-data:www-data /var/www/html/wp-content/themes/custom-theme
chmod -R 755 /var/www/html/wp-content/themes/custom-theme

# Verify installation
echo "Theme files created successfully!"
echo ""
echo "Files created:"
ls -la /var/www/html/wp-content/themes/custom-theme/
echo ""
echo "Now go to WordPress Admin → Appearance → Themes to activate 'Custom Theme'"



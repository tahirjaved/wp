<?php
/**
 * Snow Removal Services Theme Functions
 *
 * @package SnowRemoval
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Theme Setup
 */
function snowremoval_setup() {
    // Add theme support for various features
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'snowremoval'),
    ));
}
add_action('after_setup_theme', 'snowremoval_setup');

/**
 * Include shortcodes
 */
require_once get_template_directory() . '/inc/shortcodes.php';

/**
 * Include Customizer settings
 */
require_once get_template_directory() . '/inc/customizer.php';

/**
 * Include Custom Post Types
 */
require_once get_template_directory() . '/inc/post-types.php';

/**
 * Include Widget Areas
 */
require_once get_template_directory() . '/inc/widgets.php';

/**
 * Enqueue Scripts and Styles
 */
function snowremoval_scripts() {
    // Enqueue Tailwind CSS (built as style.css)
    wp_enqueue_style(
        'snowremoval-tailwind',
        get_template_directory_uri() . '/assets/css/style.css',
        array(),
        wp_get_theme()->get('Version')
    );
    
    // Enqueue theme styles
    wp_enqueue_style(
        'snowremoval-style',
        get_stylesheet_uri(),
        array('snowremoval-tailwind'),
        wp_get_theme()->get('Version')
    );
    
    // Enqueue JavaScript
    wp_enqueue_script(
        'snowremoval-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        wp_get_theme()->get('Version'),
        true
    );
    
    // Localize script for AJAX and theme options
    wp_localize_script('snowremoval-main', 'snowremovalData', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('snowremoval_nonce'),
        'phone' => snowremoval_get_option('phone', ''),
        'weatherLat' => snowremoval_get_option('weather_lat', '42.3601'),
        'weatherLng' => snowremoval_get_option('weather_lng', '-71.0589'),
        'weatherLocation' => snowremoval_get_option('cname', 'Boston'),
    ));
}
add_action('wp_enqueue_scripts', 'snowremoval_scripts');

/**
 * Enqueue ClientHub form styles for pages using the form
 */
function snowremoval_enqueue_clienthub_form_styles() {
    // Check if current page is quote or contact page
    if (is_page('quote') || is_page('contact') || is_page('callback')) {
        wp_enqueue_style(
            'clienthub-work-request-form',
            'https://d3ey4dbjkt2f6s.cloudfront.net/assets/external/work_request_embed.css', array(), null, 'all'
        );
    }
}
add_action('wp_enqueue_scripts', 'snowremoval_enqueue_clienthub_form_styles');


/**
 * Get Theme Option Helper
 * For multi-site customization
 */
function snowremoval_get_option($option, $default = '') {
    return get_theme_mod($option, $default);
}


/**
 * Add Favicon Support
 */
function snowremoval_favicon() {
    $favicon_16 = get_template_directory_uri() . '/assets/images/favicon-16x16.png';
    $favicon_32 = get_template_directory_uri() . '/assets/images/favicon-32x32.png';
    
    if (file_exists(get_template_directory() . '/assets/images/favicon-16x16.png')) {
        echo '<link rel="icon" type="image/png" sizes="16x16" href="' . esc_url($favicon_16) . '">' . "\n";
    }
    if (file_exists(get_template_directory() . '/assets/images/favicon-32x32.png')) {
        echo '<link rel="icon" type="image/png" sizes="32x32" href="' . esc_url($favicon_32) . '">' . "\n";
    }
}
add_action('wp_head', 'snowremoval_favicon');

/**
 * Custom Excerpt Length
 */
function snowremoval_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'snowremoval_excerpt_length');

/**
 * Custom Excerpt More
 */
function snowremoval_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'snowremoval_excerpt_more');

/**
 * Theme Content Support
 * Add support for editor styles and block features
 */
function snowremoval_content_support() {
    // Add theme support for editor styles
    add_theme_support('editor-styles');
    add_editor_style('assets/css/style.css');
    
    // Support for wide and full-width blocks
    add_theme_support('align-wide');
    
    // Support for responsive embeds
    add_theme_support('responsive-embeds');
}
add_action('after_setup_theme', 'snowremoval_content_support');


/**
 * Custom Nav Menu Walker for dropdown support
 */
class SnowRemoval_Walker_Nav_Menu extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<div class=\"dropdown-menu absolute top-full left-0 mt-2 bg-white shadow-lg rounded-lg py-2 min-w-[200px] opacity-0 invisible transition-all duration-300\">\n";
    }
    
    function end_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</div>\n";
    }
    
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        // Build nav-link classes including current-menu-item
        $link_classes = array('nav-link');
        
        // Add current-menu-item class if item is current
        if (in_array('current-menu-item', $classes) || in_array('current_page_item', $classes)) {
            $link_classes[] = 'current-menu-item';
        }
        if (in_array('current_page_item', $classes)) {
            $link_classes[] = 'current_page_item';
        }
        // If parent has current child (current-menu-ancestor), also add current-menu-item
        if (in_array('current-menu-ancestor', $classes)) {
            $link_classes[] = 'current-menu-ancestor';
            $link_classes[] = 'current-menu-item';
        }
        
        $link_class_string = implode(' ', $link_classes);
        
        $has_children = in_array('menu-item-has-children', $classes);
        
        if ($has_children && $depth === 0) {
            $output .= $indent . '<div class="nav-dropdown relative">';
            $output .= '<a href="' . esc_url($item->url) . '" class="' . esc_attr($link_class_string) . ' text-gray-900 hover:text-green-600 transition-colors flex items-center">';
            $output .= esc_html($item->title);
            $output .= '<span class="dropdown-arrow ml-1">▼</span>';
            $output .= '</a>';
        } else {
            $output .= $indent . '<a href="' . esc_url($item->url) . '" class="' . esc_attr($link_class_string) . ' text-gray-900 hover:text-green-600 transition-colors">';
            $output .= esc_html($item->title);
            $output .= '</a>';
        }
    }
    
    function end_el(&$output, $item, $depth = 0, $args = null) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $has_children = in_array('menu-item-has-children', $classes);
        
        if ($has_children && $depth === 0) {
            $output .= '</div>';
        } else {
            $output .= '</a>';
        }
        $output .= "\n";
    }
}


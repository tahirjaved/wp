<?php
/**
 * Custom Post Types
 * 
 * All custom post type registrations and related functions
 * 
 * @package SnowRemoval
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Services CPT (no slug in URL)
 */
function snowremoval_register_services_cpt() {
    $labels = array(
        'name'                  => __('Services', 'snowremoval'),
        'singular_name'         => __('Service', 'snowremoval'),
        'menu_name'             => __('Services', 'snowremoval'),
        'name_admin_bar'        => __('Service', 'snowremoval'),
        'add_new'               => __('Add New', 'snowremoval'),
        'add_new_item'          => __('Add New Service', 'snowremoval'),
        'new_item'              => __('New Service', 'snowremoval'),
        'edit_item'             => __('Edit Service', 'snowremoval'),
        'view_item'             => __('View Service', 'snowremoval'),
        'all_items'             => __('All Services', 'snowremoval'),
        'search_items'          => __('Search Services', 'snowremoval'),
        'parent_item_colon'     => __('Parent Services:', 'snowremoval'),
        'not_found'             => __('No services found.', 'snowremoval'),
        'not_found_in_trash'    => __('No services found in Trash.', 'snowremoval'),
        'featured_image'        => __('Service Image', 'snowremoval'),
        'set_featured_image'    => __('Set service image', 'snowremoval'),
        'remove_featured_image' => __('Remove service image', 'snowremoval'),
        'use_featured_image'    => __('Use as service image', 'snowremoval'),
    );

    $args = array(
        'labels'                => $labels,
        'public'                => true,
        'show_in_rest'          => true,
        'has_archive'           => false,
        'rewrite'               => false,  // Important
        'menu_icon'             => 'dashicons-hammer',
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'custom-fields'),
        'show_in_nav_menus'     => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'publicly_queryable'    => true,
        'query_var'             => 'services',
        'exclude_from_search'   => false,
        'capability_type'       => 'post',
    );

    register_post_type('services', $args);
}
add_action('init', 'snowremoval_register_services_cpt');

/**
 * Remove "services" slug from permalink
 */
function snowremoval_services_permalink($post_link, $post) {
    if ($post->post_type === 'services') {
        return home_url( user_trailingslashit($post->post_name) );
    }
    return $post_link;
}
add_filter('post_type_link', 'snowremoval_services_permalink', 10, 2);

/**
 * Safe rewrite rule for Services CPT — does NOT break pages
 */
function snowremoval_services_smart_rewrite() {

    // Get all service posts with correct fields
    $services = get_posts([
        'post_type'      => 'services',
        'posts_per_page' => -1,
        'fields'         => 'ids', // Get only IDs (fixes WP_Post object error)
    ]);

    if (!empty($services)) {
        foreach ($services as $service_id) {

            // Get the post slug
            $service_slug = get_post_field('post_name', $service_id);

            if ($service_slug) {
                add_rewrite_rule(
                    '^' . $service_slug . '/?$',
                    'index.php?services=' . $service_slug,
                    'top'
                );
            }
        }
    }
}
add_action('init', 'snowremoval_services_smart_rewrite', 999);


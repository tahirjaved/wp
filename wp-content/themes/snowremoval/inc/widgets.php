<?php
/**
 * Widget Areas
 * 
 * All widget area registrations
 * 
 * @package SnowRemoval
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Widget Areas
 */
function snowremoval_widgets_init() {
    register_sidebar(array(
        'name'          => __('Footer Column 1', 'snowremoval'),
        'id'            => 'footer-1',
        'description'   => __('Add widgets here to appear in your footer.', 'snowremoval'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer Column 2', 'snowremoval'),
        'id'            => 'footer-2',
        'description'   => __('Add widgets here to appear in your footer.', 'snowremoval'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'snowremoval_widgets_init');


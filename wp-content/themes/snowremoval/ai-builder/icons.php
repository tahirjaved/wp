<?php
/**
 * Icon Mapping
 * 
 * Shared icon definitions for AI builder templates
 * 
 * @package SnowRemoval
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Get SVG icon by name
 * 
 * @param string $icon_name Icon name to lookup
 * @return string SVG icon HTML or empty string if not found
 */
function snowremoval_get_icon( $icon_name ) {
    $icons = array(
        'eco' => '<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"></path><path d="M2 17l10 5 10-5M2 12l10 5 10-5"></path></svg>',
        'shield' => '<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>',
        'location' => '<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>',
        'team' => '<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>',
        'equipment' => '<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polygon points="10 8 16 12 10 16 10 8"></polygon></svg>',
        'check' => '<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>',
        'licensed' => '<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>',
        'guarantee' => '<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>',
        'hashtag' => '<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="4" y1="9" x2="20" y2="9"></line><line x1="4" y1="15" x2="20" y2="15"></line><line x1="10" y1="3" x2="8" y2="21"></line><line x1="16" y1="3" x2="14" y2="21"></line></svg>',
        'arrow-down' => '<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><polyline points="19 12 12 19 5 12"></polyline></svg>',
        'home' => '<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>',
        'landscape' => '<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"></circle><path d="M12 1v6m0 6v6m5.2-11.8l-4.2 4.2m0 3.6l4.2 4.2m-11.8-7.4l4.2 4.2m3.6 0l4.2 4.2"></path></svg>',
        'contract' => '<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>',
        'truck' => '<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>',
        'cardiogram' => '<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"></path></svg>',
        'briefcase' => '<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>',
        'cart' => '<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>',
        'steps' => '<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>',
        'wheelchair' => '<svg width="40" height="40" viewBox="-2 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#FFFFFF"><g id="SVGRepo_iconCarrier"><g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="Dribbble-Light-Preview" transform="translate(-222.000000, -5279.000000)" fill="#FFFFFF"> <g id="icons" transform="translate(56.000000, 160.000000)"> <path d="M179,5137 C178.449,5137 178,5136.551 178,5136 C178,5135.449 178.449,5135 179,5135 C179.551,5135 180,5135.449 180,5136 C180,5136.551 179.551,5137 179,5137 M170,5137 C168.897,5137 168,5136.103 168,5135 C168,5133.897 168.897,5133 170,5133 C171.103,5133 172,5133.897 172,5135 C172,5136.103 171.103,5137 170,5137 M180,5133.184 L180,5130 L171,5130 L171,5128 L175,5128 L175,5126 L171,5126 L171,5119 L166,5119 L166,5121 L169,5121 L169,5131.141 C167,5131.587 166,5133.138 166,5135 C166,5137.209 167.791,5139 170,5139 C172.209,5139 174,5137.209 174,5135 C174,5133.798 173.459,5132.733 172.62,5132 L178,5132 L178,5133.184 C177,5133.597 176,5134.696 176,5136 C176,5137.657 177.343,5139 179,5139 C180.657,5139 182,5137.657 182,5136 C182,5134.696 181,5133.597 180,5133.184" id="wheelchair-[#664]"> </path> </g> </g> </g> </g></svg>',
        'store' => '<svg width="40" height="40" fill="#ffffff" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M0 10.016l4-10.016h24l4 10.016q0 1.664-1.184 2.816t-2.816 1.184-2.816-1.184-1.184-2.816q0 1.664-1.184 2.816t-2.816 1.184-2.816-1.184-1.184-2.816q0 1.664-1.184 2.816t-2.816 1.184-2.816-1.184-1.184-2.816q0 1.664-1.184 2.816t-2.816 1.184-2.816-1.184-1.184-2.816zM2.016 30.016h28v1.984h-28v-1.984zM4 28v-12q2.272 0 4-1.536v9.536h16v-9.536q1.728 1.536 4 1.536v12h-24z"></path> </g></svg>',
        'book' => '<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>',
        'shovel' => '<svg width="40" height="40" viewBox="0 -0.5 17 17" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="si-glyph si-glyph-shovel" fill="#FFFFFF"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <path d="M15.732,2.509 L13.495,0.274 C13.064,-0.159 12.346,-0.141 11.892,0.312 C11.848,0.356 11.817,0.411 11.8,0.471 C11.241,2.706 11.253,3.487 11.346,3.794 L5.081,10.059 L3.162,8.142 L0.872,10.432 C0.123,11.18 -0.503,13.91 0.795,15.207 C2.092,16.504 4.819,15.875 5.566,15.128 L7.86,12.836 L5.981,10.958 L12.265,4.675 C12.607,4.752 13.423,4.732 15.535,4.205 C15.595,4.188 15.65,4.158 15.694,4.114 C16.147,3.661 16.163,2.941 15.732,2.509 L15.732,2.509 Z M15.15,3.459 C14.047,3.77 12.765,4.046 12.481,3.992 L12.046,3.557 C11.984,3.291 12.262,1.996 12.576,0.886 C12.757,0.752 12.989,0.748 13.129,0.888 L15.147,2.906 C15.285,3.045 15.281,3.277 15.15,3.459 L15.15,3.459 Z" fill="#FFFFFF" class="si-glyph-fill"> </path> </g> </g></svg>',
        'calendar' => '<svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M3 9H21M7 3V5M17 3V5M6 12H8M11 12H13M16 12H18M6 15H8M11 15H13M16 15H18M6 18H8M11 18H13M16 18H18M6.2 21H17.8C18.9201 21 19.4802 21 19.908 20.782C20.2843 20.5903 20.5903 20.2843 20.782 19.908C21 19.4802 21 18.9201 21 17.8V8.2C21 7.07989 21 6.51984 20.782 6.09202C20.5903 5.71569 20.2843 5.40973 19.908 5.21799C19.4802 5 18.9201 5 17.8 5H6.2C5.0799 5 4.51984 5 4.09202 5.21799C3.71569 5.40973 3.40973 5.71569 3.21799 6.09202C3 6.51984 3 7.07989 3 8.2V17.8C3 18.9201 3 19.4802 3.21799 19.908C3.40973 20.2843 3.71569 20.5903 4.09202 20.782C4.51984 21 5.07989 21 6.2 21Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round"></path> </g></svg>',
    );
    
    $icon_name = strtolower( trim( $icon_name ) );
    
    if ( isset( $icons[ $icon_name ] ) ) {
        return $icons[ $icon_name ];
    }
    
    return '';
}

/**
 * Get icon for a specific service by post ID, slug, or order index
 * 
 * @param int|string $identifier Post ID, post slug, or order index (0-based)
 * @param int $order_index Optional order index (0-based) for sequential mapping
 * @return string Icon name or empty string
 */
function snowremoval_get_service_icon_mapping( $identifier, $order_index = null ) {
    // Map service IDs or slugs to icon names
    // You can use post ID (integer) or post slug (string)
    $service_icons = array(
        // Example: Map by post ID
        // 123 => 'home',
        // 124 => 'shield',
        
        // Example: Map by post slug
        // 'service-slug-1' => 'home',
        // 'service-slug-2' => 'shield',
        
        // Add your service IDs or slugs here with their corresponding icon names
        // Example:
        // 45 => 'home',
        // 46 => 'shield',
        // 47 => 'location',
        // 48 => 'team',
        // 49 => 'equipment',
        // 50 => 'check',
    );
    
    // Sequential icon mapping for first 6 services (by order)
    $sequential_icons = array(
        'home',      // 1st service
        'shield',    // 2nd service
        'location',  // 3rd service
        'team',      // 4th service
        'equipment', // 5th service
        'check',     // 6th service
    );
    
    // Try to find by ID first
    if ( is_numeric( $identifier ) && isset( $service_icons[ intval( $identifier ) ] ) ) {
        return $service_icons[ intval( $identifier ) ];
    }
    
    // Try to find by slug
    if ( is_string( $identifier ) && isset( $service_icons[ $identifier ] ) ) {
        return $service_icons[ $identifier ];
    }
    
    // If order index is provided and within range, use sequential mapping
    if ( $order_index !== null && isset( $sequential_icons[ $order_index ] ) ) {
        return $sequential_icons[ $order_index ];
    }
    
    return '';
}

/**
 * Get allowed SVG tags for wp_kses
 * 
 * @return array Allowed SVG tags and attributes
 */
function snowremoval_get_allowed_svg_tags() {
    return array(
        'svg' => array(
            'width' => array(),
            'height' => array(),
            'viewbox' => array(),
            'viewBox' => array(),
            'fill' => array(),
            'stroke' => array(),
            'stroke-width' => array(),
            'xmlns' => array(),
            'xmlns:xlink' => array(),
            'version' => array(),
            'class' => array(),
            'id' => array(),
        ),
        'g' => array(
            'id' => array(),
            'class' => array(),
            'transform' => array(),
            'fill' => array(),
            'stroke' => array(),
            'stroke-width' => array(),
            'fill-rule' => array(),
            'stroke-linecap' => array(),
            'stroke-linejoin' => array(),
            'opacity' => array(),
        ),
        'path' => array(
            'd' => array(),
            'id' => array(),
            'class' => array(),
            'fill' => array(),
            'stroke' => array(),
            'stroke-width' => array(),
            'fill-rule' => array(),
        ),
        'circle' => array(
            'cx' => array(),
            'cy' => array(),
            'r' => array(),
            'id' => array(),
            'class' => array(),
            'fill' => array(),
            'stroke' => array(),
            'stroke-width' => array(),
        ),
        'polygon' => array(
            'points' => array(),
            'id' => array(),
            'class' => array(),
            'fill' => array(),
            'stroke' => array(),
            'stroke-width' => array(),
        ),
        'polyline' => array(
            'points' => array(),
            'id' => array(),
            'class' => array(),
            'fill' => array(),
            'stroke' => array(),
            'stroke-width' => array(),
        ),
        'rect' => array(
            'x' => array(),
            'y' => array(),
            'width' => array(),
            'height' => array(),
            'rx' => array(),
            'ry' => array(),
            'id' => array(),
            'class' => array(),
            'fill' => array(),
            'stroke' => array(),
            'stroke-width' => array(),
        ),
        'line' => array(
            'x1' => array(),
            'y1' => array(),
            'x2' => array(),
            'y2' => array(),
            'id' => array(),
            'class' => array(),
            'stroke' => array(),
            'stroke-width' => array(),
            'stroke-linecap' => array(),
        ),
    );
}


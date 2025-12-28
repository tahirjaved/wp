<?php
/**
 * Theme Customizer Settings
 * 
 * All Customizer settings and controls
 * 
 * @package Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add Customizer Settings
 */
function theme_customize_register($wp_customize) {
   
     // State
     $wp_customize->add_setting('state', array(
        'type' => 'theme_mod',
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('state', array(
        'label' => __('State', 'theme'),
        'section' => 'title_tagline',
        'type' => 'select',
        'choices' => array(
            '' => __('Select a State', 'theme'),
            'AL' => 'Alabama',
            'AK' => 'Alaska',
            'AZ' => 'Arizona',
            'AR' => 'Arkansas',
            'CA' => 'California',
            'CO' => 'Colorado',
            'CT' => 'Connecticut',
            'DE' => 'Delaware',
            'FL' => 'Florida',
            'GA' => 'Georgia',
            'HI' => 'Hawaii',
            'ID' => 'Idaho',
            'IL' => 'Illinois',
            'IN' => 'Indiana',
            'IA' => 'Iowa',
            'KS' => 'Kansas',
            'KY' => 'Kentucky',
            'LA' => 'Louisiana',
            'ME' => 'Maine',
            'MD' => 'Maryland',
            'MA' => 'Massachusetts',
            'MI' => 'Michigan',
            'MN' => 'Minnesota',
            'MS' => 'Mississippi',
            'MO' => 'Missouri',
            'MT' => 'Montana',
            'NE' => 'Nebraska',
            'NV' => 'Nevada',
            'NH' => 'New Hampshire',
            'NJ' => 'New Jersey',
            'NM' => 'New Mexico',
            'NY' => 'New York',
            'NC' => 'North Carolina',
            'ND' => 'North Dakota',
            'OH' => 'Ohio',
            'OK' => 'Oklahoma',
            'OR' => 'Oregon',
            'PA' => 'Pennsylvania',
            'RI' => 'Rhode Island',
            'SC' => 'South Carolina',
            'SD' => 'South Dakota',
            'TN' => 'Tennessee',
            'TX' => 'Texas',
            'UT' => 'Utah',
            'VT' => 'Vermont',
            'VA' => 'Virginia',
            'WA' => 'Washington',
            'WV' => 'West Virginia',
            'WI' => 'Wisconsin',
            'WY' => 'Wyoming',
        ),
        'description' => __('Select your state', 'theme'),
    ));
    // City/County Name
    $wp_customize->add_setting('cname', array(
        'type' => 'theme_mod',
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('cname', array(
        'label' => __('Name', 'theme'),
        'section' => 'title_tagline',
        'type' => 'text',
        'description' => __('City/County Name (e.g., Boston)', 'theme'),
    ));
    // Domain
    $wp_customize->add_setting('domain', array(
        'type' => 'theme_mod',
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('domain', array(
        'label' => __('Domain', 'theme'),
        'section' => 'title_tagline',
        'type' => 'text',
        'description' => __('Website domain (e.g., example.com)', 'theme'),
    ));
     // Phone Number
     $wp_customize->add_setting('phone', array(
        'type' => 'theme_mod',
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('phone', array(
        'label' => __('Phone Number', 'theme'),
        'section' => 'title_tagline',
        'type' => 'text',
    ));
    // Email Address
    $wp_customize->add_setting('email', array(
        'type' => 'theme_mod',
        'default' => '',
        'sanitize_callback' => 'sanitize_email',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('email', array(
        'label' => __('Email Address', 'theme'),
        'section' => 'title_tagline',
        'type' => 'email',
    ));
    // Weather Latitude
    $wp_customize->add_setting('weather_lat', array(
        'type' => 'theme_mod',
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('weather_lat', array(
        'label' => __('Weather Latitude', 'theme'),
        'section' => 'title_tagline',
        'type' => 'text',
        'description' => __('Latitude for weather API (e.g., 42.3601 for Boston)', 'theme'),
    ));
    // Weather Longitude
    $wp_customize->add_setting('weather_lng', array(
        'type' => 'theme_mod',
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('weather_lng', array(
        'label' => __('Weather Longitude', 'theme'),
        'section' => 'title_tagline',
        'type' => 'text',
        'description' => __('Longitude for weather API (e.g., -71.0589 for Boston)', 'theme'),
    ));
}
add_action('customize_register', 'theme_customize_register');


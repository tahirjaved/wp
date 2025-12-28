<?php
/**
 * Theme Shortcodes
 * 
 * All shortcode functions for the theme
 * 
 * @package SnowRemoval
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Get ClientHub form configuration by state
 * 
 * @return array Form configurations keyed by state code (e.g., 'MA', 'AL')
 */
function snowremoval_get_state_forms() {
    return array(
        'MA' => array(
            'container_id' => '151f2094-ee4c-41ba-b852-2b733e7b246f',
            'clienthub_id' => '151f2094-ee4c-41ba-b852-2b733e7b246f-2119451',
            'form_id' => '2119451'
        )
        // Add more states as needed using state codes (e.g., 'TX', 'NY', 'CA')
        // 'TX' => array(
        //     'container_id' => 'your-texas-container-id',
        //     'clienthub_id' => 'your-texas-clienthub-id',
        //     'form_id' => 'your-texas-form-id',
        //     'form_url' => 'https://clienthub.getjobber.com/...',
        // ),
    );
}

/**
 * Jobber form function
 * 
 * Can be called directly as a function or via shortcode
 * 
 * @param array $args {
 *     Optional. Array of arguments.
 *     @type string $state Optional state code to override Customizer value (e.g., 'MA', 'AL')
 * }
 * @return string Form HTML output
 */
function snowremoval_jobber_form($args = array()) {
    // Parse arguments with defaults
    $defaults = array(
        'state' => '', // Optional state override, defaults to Customizer value
    );
    
    $args = wp_parse_args($args, $defaults);
    
    // Get state from argument or Customizer
    $state = !empty($args['state']) ? $args['state'] : snowremoval_get_option('state', '');
    
    // Normalize to uppercase
    $state = strtoupper($state);

    // Get form configurations
    $state_forms = snowremoval_get_state_forms();
    
    // Get form config for current state, or use first available
    if ($state && isset($state_forms[$state])) {
        $form_config = $state_forms[$state];
    } elseif (!empty($state_forms)) {
        // Fallback to first form if state not found
        $form_config = reset($state_forms);
    } else {
        // No forms configured
        return '';
    }
    
    $container_id = $form_config['container_id'];
    $clienthub_id = $form_config['clienthub_id'];
    $form_id = $form_config['form_id'];
    
    // Build form URL
    $form_url = 'https://clienthub.getjobber.com/client_hubs/' . esc_attr($container_id) . '/public/work_request/embedded_work_request_form?form_id=' . esc_attr($form_id);
    
    // Return form HTML (minimal - just the form container and script)
    ob_start();
    ?>
    <!-- Embedded Work Request Form for <?php echo esc_html(ucfirst($state ?: 'default')); ?> -->
    <div id="<?php echo esc_attr($clienthub_id); ?>"></div>
    <script src="https://d3ey4dbjkt2f6s.cloudfront.net/assets/static_link/work_request_embed_snippet.js" clienthub_id="<?php echo esc_attr($clienthub_id); ?>" form_url="<?php echo esc_url($form_url); ?>"></script>
    <?php
    return ob_get_clean();
}

/**
 * Jobber form shortcode
 * 
 * Usage: [jobber_form]
 * Usage: [jobber_form state="MA"]
 * Uses state from Customizer automatically unless overridden
 * 
 * @param array $atts Shortcode attributes
 * @return string Form HTML output
 */
function snowremoval_jobber_form_shortcode($atts) {
    // Parse shortcode attributes
    $atts = shortcode_atts(array(
        'state' => '', // Optional state code to override Customizer value
    ), $atts, 'jobber_form');
    
    // Call the main function
    $form_html = snowremoval_jobber_form(array(
        'state' => $atts['state'],
    ));
    
    // Return empty if no form HTML
    if (empty($form_html)) {
        return '';
    }
    
    // Wrap in section with full styling and return
    return '<section class="jobber-form-section py-16 bg-gray-100">' .
           '<div class="container">' .
           '<div class="jobber-form max-w-4xl mx-auto min-h-[200px] relative shadow-xl bg-white">' .
           $form_html .
           '</div>' .
           '</div>' .
           '</section>';
}
add_shortcode('jobber_form', 'snowremoval_jobber_form_shortcode');

/**
 * Page header/hero shortcode
 * Uses hero.php template from ai-builder/templates
 * 
 * Usage: 
 * [page_header]
 * [page_header title="Custom Title" text="Subtitle text"]
 * [page_header title="Title" text="Subtitle" features="icon1|text1,icon2|text2"]
 * 
 * @param array $atts Shortcode attributes
 * @return string Page header HTML output
 */
function snowremoval_page_header_shortcode($atts) {
    // Parse shortcode attributes
    $atts = shortcode_atts(array(
        'title' => '', // Optional custom title, defaults to page title
        'text' => '', // Optional subtitle/text
        'features' => '', // Optional features: "icon1|text1,icon2|text2"
    ), $atts, 'page_header');
    
    // Get title (use provided title or page title)
    $title = !empty($atts['title']) ? $atts['title'] : get_the_title();
    ob_start();
    
    // Load hero template
    $template_path = get_template_directory() . '/ai-builder/templates/hero.php';
    if (file_exists($template_path)) {
        // Prepare data for template (same structure as ai_section)
        $data = array(
            'title' => $title,
            'text' => $atts['text'],
            'hide_buttons' => true
        );
        
        include $template_path;
    }
    
    return ob_get_clean();
}
add_shortcode('page_header', 'snowremoval_page_header_shortcode');

/**
 * Handle [service_posts] shortcode
 * Static shortcode to display posts from any post type
 * 
 * Usage: 
 * [service_posts]
 * [service_posts limit="6" orderby="title" order="ASC"]
 * [service_posts ids="1,2,3" title="Our Services"]
 * [service_posts posttype="post"] (to use different post type)
 */
function snowremoval_service_posts_shortcode( $atts ) {
	// Parse shortcode attributes
	$atts = shortcode_atts( array(
		'posttype' => 'services', // Post type to query (defaults to 'services')
		'limit'    => -1,      // Number of posts (-1 for all)
		'orderby'  => 'date',  // Order by field
		'order'    => 'DESC',  // Sort order
		'ids'      => '',      // Comma-separated post IDs
		'title'    => '',      // Section title
		'subtitle' => '',      // Section subtitle
		'show_icon' => 'false',  // Show service icons
		'link_titles' => 'true', // Make titles clickable
		'show_content' => 'false', // Show full content
		'show_link' => 'true',   // Show "Learn More" link
		'no_posts_message' => '', // Message when no posts found
	), $atts, 'service_posts' );
	
	$post_type = sanitize_text_field( $atts['posttype'] );
	
	// Start output buffering
	ob_start();
	
	// Load template
	$template_path = get_template_directory() . '/ai-builder/templates/post-services.php';
	if ( file_exists( $template_path ) ) {
		// Prepare data for template
		$data = array(
			'post_type' => $post_type,
			'limit'     => $atts['limit'],
			'orderby'   => $atts['orderby'],
			'order'     => $atts['order'],
			'ids'       => ! empty( $atts['ids'] ) ? array_map( 'trim', explode( ',', $atts['ids'] ) ) : array(),
			'title'     => $atts['title'],
			'subtitle'  => $atts['subtitle'],
			'show_icon' => filter_var( $atts['show_icon'], FILTER_VALIDATE_BOOLEAN ),
			'link_titles' => filter_var( $atts['link_titles'], FILTER_VALIDATE_BOOLEAN ),
			'show_content' => filter_var( $atts['show_content'], FILTER_VALIDATE_BOOLEAN ),
			'show_link' => filter_var( $atts['show_link'], FILTER_VALIDATE_BOOLEAN ),
			'no_posts_message' => $atts['no_posts_message'],
		);
		
		include $template_path;
	}
	
	return ob_get_clean();
}
add_shortcode( 'service_posts', 'snowremoval_service_posts_shortcode' );


<?php
/**
 * Posts Template
 * 
 * Template for [service_posts:posttype] shortcode
 * Displays posts from any post type in a grid layout
 * 
 * @package SnowRemoval
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Load shared icons file
require_once get_template_directory() . '/ai-builder/icons.php';

// Get post type from data (set by shortcode handler)
$post_type = ! empty( $data['post_type'] ) ? $data['post_type'] : 'services';

// Build query args
$query_args = array(
    'post_type'      => $post_type,
    'posts_per_page' => ! empty( $data['limit'] ) ? intval( $data['limit'] ) : -1,
    'post_status'    => 'publish',
    'orderby'        => ! empty( $data['orderby'] ) ? $data['orderby'] : 'date',
    'order'          => ! empty( $data['order'] ) ? $data['order'] : 'DESC',
);

// If specific IDs are provided
if ( ! empty( $data['ids'] ) && is_array( $data['ids'] ) ) {
    $query_args['post__in'] = array_map( 'intval', $data['ids'] );
    $query_args['orderby'] = 'post__in';
}

$posts_query = new WP_Query( $query_args );
?>

<section class="services-section">
    <div class="container">
        <div class="section-header">
            <?php 
            $cname = snowremoval_get_option('cname', '');
            $heading_text = !empty($cname) 
                ? sprintf('Our Snow Removal Services in %s', $cname)
                : 'Our Snow Removal Services';
            ?>
            <h2><?php echo esc_html( $heading_text ); ?></h2>
            
            <?php if ( ! empty( $data['subtitle'] ) ) : ?>
                <p class="section-subtitle"><?php echo esc_html( $data['subtitle'] ); ?></p>
            <?php endif; ?>
        </div>

        <?php if ( $posts_query->have_posts() ) : ?>
            <div class="services-grid lg:grid-cols-3">
                <?php 
                $service_index = 0; // Track order for sequential icon mapping
                while ( $posts_query->have_posts() ) : $posts_query->the_post(); 
                ?>
                    <div class="service-card">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="service-image">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'medium', array( 'alt' => get_the_title() ) ); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <?php
                        // Get icon for this service (by ID, slug, or order)
                        $service_id = get_the_ID();
                        $service_slug = get_post_field( 'post_name', $service_id );
                        $icon_name = snowremoval_get_service_icon_mapping( $service_id, $service_index );
                        
                        // If not found by ID, try slug
                        if ( empty( $icon_name ) ) {
                            $icon_name = snowremoval_get_service_icon_mapping( $service_slug, $service_index );
                        }
                        
                        // Get the icon SVG
                        $service_icon = '';
                        if ( ! empty( $icon_name ) ) {
                            $service_icon = snowremoval_get_icon( $icon_name );
                        }
                        
                        // Always show icon if we have one, or if show_icon is enabled
                        if ( ! empty( $service_icon ) || ( ! empty( $data['show_icon'] ) && $data['show_icon'] ) ) : ?>
                            <div class="service-icon" data-icon="<?php echo esc_attr( $icon_name ); ?>">
                                <?php echo wp_kses( $service_icon, snowremoval_get_allowed_svg_tags() ); ?>
                            </div>
                        <?php endif; ?>
                        
                        <h3><?php the_title(); ?></h3>

                        <?php
                        // Get raw post excerpt
                        $raw_excerpt = '';
                        global $wpdb;

                        // Get raw post ID from current post meta
                        $raw_post_id = $wpdb->get_var( $wpdb->prepare(
                            "SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = %d AND meta_key = %s ORDER BY meta_id DESC LIMIT 1",
                            get_the_ID(),
                            '_msai_raw_post_id'
                        ) );

                        // If raw post ID not found, try to find raw post by matching title
                        if ( empty( $raw_post_id ) ) {
                            $main_site_id = get_main_site_id();
                            switch_to_blog( $main_site_id );
                            $raw_post = $wpdb->get_var( $wpdb->prepare(
                                "SELECT ID FROM {$wpdb->posts} WHERE post_title = %s AND post_type = 'msai_raw_page' AND post_status = 'publish' LIMIT 1",
                                get_the_title()
                            ) );
                            restore_current_blog();
                            if ( $raw_post ) {
                                $raw_post_id = $raw_post;
                            }
                        }

                        if ( ! empty( $raw_post_id ) ) {
                            // Get raw post excerpt from main site
                            $main_site_id = get_main_site_id();
                            switch_to_blog( $main_site_id );
                            $raw_excerpt = $wpdb->get_var( $wpdb->prepare(
                                "SELECT post_excerpt FROM {$wpdb->posts} WHERE ID = %d",
                                $raw_post_id
                            ) );
                            restore_current_blog();
                            
                            // Normalize empty values
                            $raw_excerpt = ( $raw_excerpt === null || $raw_excerpt === false ) ? '' : trim( $raw_excerpt );
                            
                            // Remove ! prefix if present (for template strings)
                            if ( ! empty( $raw_excerpt ) ) {
                                $raw_excerpt = ltrim( $raw_excerpt, '!' );
                                $raw_excerpt = trim( $raw_excerpt );
                                
                                // Process template variables using plugin functions
                                if ( function_exists( 'msai_get_site_data' ) && function_exists( 'msai_replace_prompt_placeholders' ) ) {
                                    $site_data = msai_get_site_data();
                                    $raw_excerpt = msai_replace_prompt_placeholders( $raw_excerpt, $site_data );
                                }
                            }
                        }

                        // Display excerpt (raw post excerpt if available, otherwise fallback to regular excerpt)
                        if ( ! empty( $raw_excerpt ) ) : ?>
                            <p><?php echo esc_html( $raw_excerpt ); ?></p>
                        <?php elseif ( has_excerpt() ) : ?>
                            <?php the_excerpt(); ?>
                        <?php endif; ?>
                        
                        <?php if ( ! empty( $data['show_link'] ) && $data['show_link'] ) : ?>
                            <a href="<?php the_permalink(); ?>" class="learn-more">Learn More →</a>
                        <?php endif; ?>
                    </div>
                <?php 
                    $service_index++; // Increment for next service
                    endwhile;
                    $cname = snowremoval_get_option('cname', '')."'s";
                ?>
                
                <!-- Static Seasonal Contracts Card -->
                <div class="service-card">
                    <div class="service-icon">
                        <?php echo snowremoval_get_icon( 'contract' ); ?>
                    </div>
                    <span class="popular-badge">Most Popular</span>
                    <h3>Seasonal Contracts</h3>
                    <p>Secure your winter snow removal with our seasonal contracts. Priority scheduling and guaranteed service throughout <?= $cname ?> winter season.</p>
                    <a href="<?php echo home_url('/contact/'); ?>" class="learn-more">Learn More →</a>
                </div>
            </div>
            <?php wp_reset_postdata(); ?>
        <?php else : ?>
            <div class="no-posts-message">
                <?php if ( ! empty( $data['no_posts_message'] ) ) : ?>
                    <p class="no-services"><?php echo esc_html( $data['no_posts_message'] ); ?></p>
                <?php else : ?>
                    <p class="no-services">No <?php echo esc_html( $post_type ); ?> posts found.</p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
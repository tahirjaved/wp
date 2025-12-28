<?php
/**
 * Services Section Template
 * 
 * Template for [AI_SECTION:services] shortcode
 * Displays services in a grid layout
 * 
 * @package SnowRemoval
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Load shared icons file
require_once get_template_directory() . '/ai-builder/icons.php';

// Determine grid columns based on number of items
$solutions_count = ! empty( $data['solutions'] ) && is_array( $data['solutions'] ) ? count( $data['solutions'] ) : 0;
$grid_cols = 'grid-cols-1';
if ( $solutions_count === 4 ) {
    $grid_cols = 'lg:grid-cols-2';
} elseif ( $solutions_count === 6 ) {
    $grid_cols = 'lg:grid-cols-3';
}
?>

<section class="services-section">
    <div class="container">
        <?php if ( ! empty( $data['title'] ) || ! empty( $data['subtitle'] ) ) : ?>
            <div class="section-header">
                <?php if ( ! empty( $data['title'] ) ) : ?>
                    <h2><?php echo esc_html( $data['title'] ); ?></h2>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if ( ! empty( $data['solutions'] ) && is_array( $data['solutions'] ) ) : ?>
            <div class="services-grid <?php echo esc_attr( $grid_cols ); ?>">
                <?php foreach ( $data['solutions'] as $item ) : ?>
                    <div class="service-card">
                        <?php if ( ! empty( $item['icon'] ) ) : ?>
                            <div class="service-icon" data-icon="<?php echo esc_attr( $item['icon'] ); ?>">
                                <?php
                                if ( ! empty( $item['icon'] ) ) {
                                    $icon_value = $item['icon'];
                                    
                                    // Check if icon is HTML/SVG (contains <) or just a name
                                    if ( strpos( $icon_value, '<' ) !== false ) {
                                        // It's HTML/SVG, output as-is (allow SVG tags)
                                        echo wp_kses( $icon_value, snowremoval_get_allowed_svg_tags() );
                                    } else {
                                        // It's an icon name, get the SVG
                                        $icon_name = trim( $icon_value );
                                        $svg_icon = snowremoval_get_icon( $icon_name );
                                        if ( ! empty( $svg_icon ) ) {
                                            // Allow SVG tags
                                            echo wp_kses( $svg_icon, snowremoval_get_allowed_svg_tags() );
                                        }
                                    }
                                }
                                ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ( ! empty( $item['title'] ) ) : ?>
                            <h3><?php echo esc_html( $item['title'] ); ?></h3>
                        <?php endif; ?>
                        
                        <?php if ( ! empty( $item['description'] ) ) : ?>
                            <p><?php echo esc_html( $item['description'] ); ?></p>
                        <?php endif; ?>
                        
                        <?php if ( ! empty( $item['bullets'] ) && is_array( $item['bullets'] ) ) : ?>
                            <ul class="checkmark-list">
                                <?php foreach ( $item['bullets'] as $bullet ) : ?>
                                    <li><?php echo esc_html( $bullet ); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                        
                        <?php if ( ! empty( $item['cta'] ) ) : ?>
                            <?php if ( ! empty( $item['link'] ) ) : ?>
                                <a href="<?php echo esc_url( $item['link'] ); ?>" class="learn-more">
                                    <?php echo esc_html( $item['cta'] ); ?>
                                </a>
                            <?php else : ?>
                                <a href="<?php echo esc_url('/contact/'); ?>" class="learn-more"><?php echo esc_html( $item['cta'] ); ?></a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>


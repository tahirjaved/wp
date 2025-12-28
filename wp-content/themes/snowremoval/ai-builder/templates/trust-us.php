<?php
/**
 * Trust Us Section Template
 * 
 * Template for [AI_SECTION:trust-us] shortcode
 * 
 * @package SnowRemoval
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Load shared icons file
require_once get_template_directory() . '/ai-builder/icons.php';
?>

<section class="why-trust-section">
    <div class="container">
        <?php if ( ! empty( $data['title'] ) || ! empty( $data['subtitle'] ) ) : ?>
            <div class="section-header">
                <?php if ( ! empty( $data['title'] ) ) : ?>
                    <h2><?php echo esc_html( $data['title'] ); ?></h2>
                <?php endif; ?>
                
                <?php if ( ! empty( $data['subtitle'] ) ) : ?>
                    <p class="section-subtitle"><?php echo esc_html( $data['subtitle'] ); ?></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if ( ! empty( $data['features'] ) && is_array( $data['features'] ) ) : ?>
            <div class="trust-grid">
                <?php foreach ( $data['features'] as $item ) : ?>
                    <div class="trust-card">
                        <div class="trust-icon">
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
                        
                        <?php if ( ! empty( $item['title'] ) ) : ?>
                            <h3><?php echo esc_html( $item['title'] ); ?></h3>
                        <?php endif; ?>
                        
                        <?php if ( ! empty( $item['description'] ) ) : ?>
                            <p><?php echo esc_html( $item['description'] ); ?></p>
                        <?php elseif ( ! empty( $item['content'] ) ) : ?>
                            <p><?php echo esc_html( $item['content'] ); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>


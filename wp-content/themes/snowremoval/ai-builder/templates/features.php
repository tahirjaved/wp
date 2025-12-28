<?php
/**
 * Features Section Template
 * 
 * Template for [ai_section type="features"] shortcode
 * 
 * @package SnowRemoval
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<section class="features-section">
    <div class="container">
        <?php if ( ! empty( $data['title'] ) ) : ?>
            <div class="section-header">
                <h2><?php echo esc_html( $data['title'] ); ?></h2>
                <?php if ( ! empty( $data['subtitle'] ) ) : ?>
                    <p class="section-subtitle"><?php echo esc_html( $data['subtitle'] ); ?></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        
        <?php if ( ! empty( $data['items'] ) && is_array( $data['items'] ) ) : ?>
            <div class="features-grid">
                <?php foreach ( $data['items'] as $item ) : ?>
                    <div class="feature-card">
                        <?php if ( ! empty( $item['icon'] ) ) : ?>
                            <div class="feature-icon">
                                <?php echo wp_kses_post( $item['icon'] ); ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ( ! empty( $item['title'] ) ) : ?>
                            <h3><?php echo esc_html( $item['title'] ); ?></h3>
                        <?php endif; ?>
                        
                        <?php if ( ! empty( $item['description'] ) ) : ?>
                            <p><?php echo esc_html( $item['description'] ); ?></p>
                        <?php endif; ?>
                        
                        <?php if ( ! empty( $item['link'] ) ) : ?>
                            <a href="<?php echo esc_url( $item['link'] ); ?>" class="learn-more">
                                Learn More →
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>


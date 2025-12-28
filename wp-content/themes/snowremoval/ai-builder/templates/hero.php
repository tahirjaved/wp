<?php
/**
 * Hero Section Template
 * 
 * Template for [ai_section type="hero"] shortcode
 * 
 * @package SnowRemoval
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
$phone = snowremoval_get_option('phone', '');
?>

<section class="hero">
    <div class="container">
        <?php if ( ! empty( $data['title'] ) ) : ?>
            <h1><?php echo esc_html( $data['title'] ); ?></h1>
        <?php endif; ?>
        
        <?php if ( ! empty( $data['text'] ) ) : ?>
            <p class="hero-subtitle"><?php echo esc_html( $data['text'] ); ?></p>
        <?php endif; ?>
        
        <?php if ( ! isset( $data['hide_buttons'] ) || $data['hide_buttons'] !== true ) : ?>
            <div class="hero-buttons">
                <a href="<?php echo esc_url( home_url('/quote/') ); ?>" class="btn btn-primary">Get Free Quote</a>
                <a href="<?php echo esc_url( home_url('/callback/') ); ?>" class="btn btn-secondary">Request a Callback</a>
                <?php if ( ! empty( $phone ) ) : ?>
                    <a href="tel:<?php echo esc_attr( preg_replace('/[^0-9]/', '', $phone) ); ?>" class="btn btn-secondary">
                        <span class="phone-icon">📞</span> <?php echo esc_html( $phone ); ?>
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        
        <?php if ( ! empty( $data['features'] ) && is_array( $data['features'] ) ) : ?>
            <div class="hero-features">
                <?php foreach ( $data['features'] as $feature ) : ?>
                    <div class="hero-feature">
                        <?php if ( ! empty( $feature['icon'] ) ) : ?>
                            <div class="hero-feature-icon"><?php echo esc_html( $feature['icon'] ); ?></div>
                        <?php endif; ?>
                        <?php if ( ! empty( $feature['text'] ) ) : ?>
                            <span><?php echo esc_html( $feature['text'] ); ?></span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>


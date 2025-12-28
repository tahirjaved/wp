<?php
/**
 * Default Section Template
 * 
 * Fallback template for [ai_section] shortcode when specific template is not found
 * 
 * @package SnowRemoval
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<div class="msai-section msai-section-default">
    <?php if ( ! empty( $data['title'] ) ) : ?>
        <h2><?php echo esc_html( $data['title'] ); ?></h2>
    <?php endif; ?>
    
    <?php if ( ! empty( $data['subtitle'] ) ) : ?>
        <p class="subtitle"><?php echo esc_html( $data['subtitle'] ); ?></p>
    <?php endif; ?>
    
    <?php if ( ! empty( $data['content'] ) ) : ?>
        <div class="section-content">
            <?php echo wp_kses_post( $data['content'] ); ?>
        </div>
    <?php endif; ?>
    
    <?php if ( ! empty( $data['image'] ) ) : ?>
        <div class="section-image">
            <img src="<?php echo esc_url( $data['image'] ); ?>" alt="<?php echo esc_attr( $data['title'] ?? '' ); ?>">
        </div>
    <?php endif; ?>
    
    <?php if ( ! empty( $data['items'] ) && is_array( $data['items'] ) ) : ?>
        <div class="section-items">
            <?php foreach ( $data['items'] as $item ) : ?>
                <div class="section-item">
                    <?php if ( ! empty( $item['title'] ) ) : ?>
                        <h3><?php echo esc_html( $item['title'] ); ?></h3>
                    <?php endif; ?>
                    
                    <?php if ( ! empty( $item['content'] ) ) : ?>
                        <div class="item-content">
                            <?php echo wp_kses_post( $item['content'] ); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    
    <?php if ( ! empty( $data['button_text'] ) && ! empty( $data['button_url'] ) ) : ?>
        <div class="section-actions">
            <a href="<?php echo esc_url( $data['button_url'] ); ?>" class="btn btn-primary">
                <?php echo esc_html( $data['button_text'] ); ?>
            </a>
        </div>
    <?php endif; ?>
</div>


<?php
/**
 * SEO Content Section Template
 * 
 * Template for [AI_SECTION:seo-content] shortcode
 * 
 * @package SnowRemoval
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<section class="seo-content py-16 bg-white">
    <div class="container">
        <?php if ( ! empty( $data['content'] ) ) : ?>
            <div class="prose max-w-4xl mx-auto">
                <?php echo wp_kses_post( $data['content'] ); ?>
            </div>
        <?php endif; ?>
    </div>
</section>


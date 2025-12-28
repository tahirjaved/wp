<?php
/**
 * Template Name: Contact Page
 *
 * @package SnowRemoval
 */

get_header();
?>

<!-- Hero Section -->
<section class="hero ">
    <div class="container">
        <h1>Contact Us</h1>
        <p class="hero-subtitle">Get your free quote today and ensure your property stays safe and accessible all winter long.</p>
    </div>
</section>

<!-- Contact Form Section -->
<section class="contact-section py-16 bg-gray-100">
    <div class="container">
        <div class="grid grid-cols-1 gap-12">
            <!-- Contact Form -->
            <div class=" contact-form">
                <h2 class="text-3xl font-bold mb-6">Get Your Free Quote</h2>
                <div class="bg-white p-2 rounded-lg shadow-md">
                    <div class="min-h-[200px] relative">
                        <?php echo snowremoval_jobber_form(); ?>
                    </div>
                </div>
            </div>
            <?php /* ?>
            <!-- Contact Information -->
            <div class="contact-info">
                <?php
                $state = snowremoval_get_option('state', '');
                $cname = snowremoval_get_option('cname', '');
                $phone = snowremoval_get_option('phone', '');
                $email = snowremoval_get_option('email', '');
                ?>
                
                <div class="">
                    <h2>Contact Information</h2>
                    <?php if ( ! empty( $phone ) ) : ?>
                        <div class="contact-card">
                            <div class="contact-card-icon">📞</div>
                            <h3>Phone</h3>
                            <p><a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $phone)); ?>"><?php echo esc_html($phone); ?></a></p>
                            <p class="contact-note">Available 24/7 for emergencies</p>
                        </div>
                    <?php endif; ?>
                    <?php if ( ! empty( $email ) ) : ?>
                    <div class="contact-card">
                        <div class="contact-card-icon">✉️</div>
                        <h3>Email</h3>
                        <p><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></p>
                        <p class="contact-note">We respond within 24 hours</p>
                    </div>
                    <?php endif; ?>
                    <div class="contact-card">
                        <div class="contact-card-icon">🏘️</div>
                        <h3>Service Area</h3>
                        <p>All <?php echo esc_html($cname); ?> Neighborhoods</p>
                        <p class="contact-note">Covering all of Greater <?php echo esc_html($cname); ?></p>
                    </div>
                    <div class="contact-card">
                        <div class="contact-card-icon">⏰</div>
                        <h3>Hours</h3>
                        <p>24/7 Emergency Service</p>
                        <p class="contact-note">Office: Mon-Fri 8AM-6PM</p>
                    </div>
                </div>
            </div>
            <?php */ ?>
        </div>
    </div>
</section>

<?php while (have_posts()) : the_post(); ?>
    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="entry-content">
            <?php the_content(); ?>
        </div>
    </div>
<?php endwhile; ?>

<?php
get_footer();


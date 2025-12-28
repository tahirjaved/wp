<?php
/**
 * The main template file
 *
 * @package SnowRemoval
 */

get_header();
?>

<main id="main" class="site-main">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <!-- <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header> -->
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile; ?>
    <?php else : ?>
        <div class="container mx-auto px-3 sm:px-4 py-12">
            <h1 class="text-4xl font-bold mb-4">Nothing Found</h1>
            <p>It seems we can't find what you're looking for.</p>
        </div>
    <?php endif; ?>
</main>

<?php
get_footer();


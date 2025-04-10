<?php get_header(); ?>

<main id="primary" class="site-main">
    <?php if (have_posts()) : ?>
        <div class="posts-container">
            <?php
            while (have_posts()) :
                the_post();
                get_template_part('template-parts/content', get_post_type());
            endwhile;
            ?>
        </div>

        <?php
        the_posts_navigation(array(
            'prev_text' => __('Older posts', 'bakery-treats'),
            'next_text' => __('Newer posts', 'bakery-treats'),
        ));
        ?>

    <?php else : ?>
        <div class="no-posts">
            <h2><?php _e('No posts found', 'bakery-treats'); ?></h2>
            <p><?php _e('Sorry, no posts matched your criteria.', 'bakery-treats'); ?></p>
        </div>
    <?php endif; ?>
</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?> 
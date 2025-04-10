<?php
/**
 * Template Name: Homepage
 * Description: Custom homepage template with featured products section
 */

get_header();
?>

<main id="primary" class="site-main">
    <!-- Hero Section with Logo -->
    <section class="hero-section">
        <div class="hero-content">
            <div class="logo-container">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/pandaria-screenshot.png" alt="<?php bloginfo('name'); ?>" class="custom-logo">
                <?php endif; ?>
            </div>
            <div class="hero-text">
                <h1 class="animate-fade-in"><?php bloginfo('name'); ?></h1>
                <p class="animate-fade-in-delay"><?php bloginfo('description'); ?></p>
                <p class="hero-description">Welcome to our bakery, where tradition meets innovation. We craft each product with the finest ingredients and a passion for baking that's been passed down through generations.</p>
            </div>
            <a href="#featured-products" class="scroll-down-btn">
                <span class="scroll-icon">↓</span>
                <span class="scroll-text">Discover Our Products</span>
            </a>
        </div>
    </section>

    <!-- Featured Products Section with Slider -->
    <section id="featured-products" class="featured-products">
        <div class="container">
            <h2 class="section-title">Our Featured Products</h2>
            <div class="products-slider">
                <?php
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 8,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'product_visibility',
                            'field'    => 'name',
                            'terms'    => 'featured',
                        ),
                    ),
                );
                $featured_query = new WP_Query($args);
                
                if ($featured_query->have_posts()) :
                    while ($featured_query->have_posts()) : $featured_query->the_post();
                        ?>
                        <div class="product-slide">
                            <div class="product-card">
                                <div class="product-image">
                                    <?php the_post_thumbnail('medium'); ?>
                                    <div class="product-overlay">
                                        <a href="<?php the_permalink(); ?>" class="view-product">View Details</a>
                                        <?php woocommerce_template_loop_add_to_cart(); ?>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <h3><?php the_title(); ?></h3>
                                    <div class="price"><?php woocommerce_template_loop_price(); ?></div>
                                </div>
                            </div>
                        </div>
                        <?php
                    endwhile;
                endif;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>

    <!-- Interactive Recipe Section -->
    <section class="recipe-section">
        <div class="container">
            <h2 class="section-title">Today's Special Recipe</h2>
            <div class="recipe-card">
                <?php
                $recipe_args = array(
                    'post_type' => 'recipe',
                    'posts_per_page' => 1,
                    'orderby' => 'rand'
                );
                $recipe_query = new WP_Query($recipe_args);
                
                if ($recipe_query->have_posts()) :
                    while ($recipe_query->have_posts()) : $recipe_query->the_post();
                        ?>
                        <div class="recipe-content">
                            <div class="recipe-image">
                                <?php the_post_thumbnail('large'); ?>
                            </div>
                            <div class="recipe-details">
                                <h3><?php the_title(); ?></h3>
                                <div class="recipe-meta">
                                    <span class="prep-time">⏱️ <?php echo get_field('preparation_time'); ?></span>
                                    <span class="difficulty">⭐ <?php echo get_field('difficulty_level'); ?></span>
                                </div>
                                <div class="recipe-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="view-recipe">View Full Recipe</a>
                            </div>
                        </div>
                        <?php
                    endwhile;
                endif;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>

    <!-- Newsletter Signup -->
    <section class="newsletter-section">
        <div class="container">
            <h2 class="section-title">Stay Updated</h2>
            <p>Subscribe to our newsletter for the latest recipes and special offers</p>
            <form class="newsletter-form" id="newsletter-form">
                <input type="email" placeholder="Your email address" required>
                <button type="submit" class="subscribe-btn">Subscribe</button>
            </form>
        </div>
    </section>
</main>

<?php
get_footer();
?> 
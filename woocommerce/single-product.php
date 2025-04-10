<?php
/**
 * The Template for displaying all single products
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

get_header('shop'); ?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <?php
            while (have_posts()) :
                the_post();
                ?>
                <div class="product-gallery">
                    <?php
                    // Display product gallery
                    woocommerce_show_product_images();
                    ?>
                </div>

                <div class="product-summary">
                    <h1 class="product-title"><?php the_title(); ?></h1>
                    
                    <div class="product-meta">
                        <?php
                        // Display product price
                        woocommerce_template_single_price();
                        
                        // Display product rating
                        woocommerce_template_single_rating();
                        ?>
                    </div>

                    <div class="product-description">
                        <?php
                        // Display product description
                        woocommerce_template_single_excerpt();
                        ?>
                    </div>

                    <div class="product-actions">
                        <?php
                        // Display add to cart button
                        woocommerce_template_single_add_to_cart();
                        ?>
                    </div>

                    <div class="product-meta-details">
                        <?php
                        // Display SKU, categories, and tags
                        woocommerce_template_single_meta();
                        ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <div class="col-md-4">
            <div class="product-sidebar">
                <?php
                // Display related products
                woocommerce_output_related_products();
                
                // Display product categories
                echo '<div class="product-categories">';
                echo '<h3>' . esc_html__('Categories', 'panadaria') . '</h3>';
                echo wc_get_product_category_list(get_the_ID(), ', ');
                echo '</div>';
                
                // Display product tags
                echo '<div class="product-tags">';
                echo '<h3>' . esc_html__('Tags', 'panadaria') . '</h3>';
                echo wc_get_product_tag_list(get_the_ID(), ', ');
                echo '</div>';
                ?>
            </div>
        </div>
    </div>
</div>

<?php
get_footer('shop'); 
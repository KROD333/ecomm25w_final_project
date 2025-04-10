<?php
/**
 * Bakery Treats Theme functions and definitions
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function bakery_treats_setup() {
    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title.
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support('post-thumbnails');

    // Add support for custom logo
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-width'  => true,
        'flex-height' => true,
    ));

    // Add support for WooCommerce
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

    // Add support for HTML5 markup
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Add support for responsive embeds
    add_theme_support('responsive-embeds');

    // Add support for custom background
    add_theme_support('custom-background', array(
        'default-color' => 'ffffff',
        'default-image' => '',
    ));

    // Register navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'bakery-treats'),
        'footer'  => esc_html__('Footer Menu', 'bakery-treats'),
    ));
}
add_action('after_setup_theme', 'bakery_treats_setup');

/**
 * Enqueue scripts and styles.
 */
function bakery_treats_scripts() {
    // Enqueue main stylesheet
    wp_enqueue_style('bakery-treats-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Enqueue Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css', array(), '6.0.0');

    // Enqueue Slick Slider CSS
    wp_enqueue_style('slick-slider', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array(), '1.8.1');
    wp_enqueue_style('slick-theme', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css', array('slick-slider'), '1.8.1');

    // Enqueue jQuery (included with WordPress)
    wp_enqueue_script('jquery');

    // Enqueue Slick Slider JS
    wp_enqueue_script('slick-slider', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), '1.8.1', true);

    // Enqueue Parallax JS
    wp_enqueue_script('parallax', 'https://cdnjs.cloudflare.com/ajax/libs/parallax.js/1.5.0/parallax.min.js', array('jquery'), '1.5.0', true);

    // Enqueue main navigation script
    wp_enqueue_script('bakery-treats-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '1.0.0', true);

    // Enqueue main theme script
    wp_enqueue_script('bakery-treats-main', get_template_directory_uri() . '/js/main.js', array('jquery', 'slick-slider', 'parallax'), '1.0.0', true);

    // Enqueue product slider script
    wp_enqueue_script('bakery-treats-slider', get_template_directory_uri() . '/js/slider.js', array('jquery', 'slick-slider'), '1.0.0', true);

    // Add script localization
    wp_localize_script('bakery-treats-main', 'bakeryTreats', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('bakery-treats-nonce'),
    ));

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'bakery_treats_scripts');

// Register Custom Post Type for Recipes
function bakery_treats_register_recipe_post_type() {
    $labels = array(
        'name'                  => 'Recipes',
        'singular_name'         => 'Recipe',
        'menu_name'            => 'Recipes',
        'add_new'              => 'Add New',
        'add_new_item'         => 'Add New Recipe',
        'edit_item'            => 'Edit Recipe',
        'new_item'             => 'New Recipe',
        'view_item'            => 'View Recipe',
        'search_items'         => 'Search Recipes',
        'not_found'            => 'No recipes found',
        'not_found_in_trash'   => 'No recipes found in Trash',
    );

    $args = array(
        'label'               => 'recipe',
        'description'         => 'Bakery recipes and instructions',
        'labels'              => $labels,
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt', 'comments'),
        'taxonomies'          => array('recipe_category'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-food',
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    );

    register_post_type('recipe', $args);
}
add_action('init', 'bakery_treats_register_recipe_post_type');

// Register Recipe Category Taxonomy
function bakery_treats_register_recipe_taxonomy() {
    $labels = array(
        'name'              => 'Recipe Categories',
        'singular_name'     => 'Recipe Category',
        'search_items'      => 'Search Recipe Categories',
        'all_items'         => 'All Recipe Categories',
        'parent_item'       => 'Parent Recipe Category',
        'parent_item_colon' => 'Parent Recipe Category:',
        'edit_item'         => 'Edit Recipe Category',
        'update_item'       => 'Update Recipe Category',
        'add_new_item'      => 'Add New Recipe Category',
        'new_item_name'     => 'New Recipe Category Name',
        'menu_name'         => 'Recipe Categories',
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'recipe-category'),
    );

    register_taxonomy('recipe_category', array('recipe'), $args);
}
add_action('init', 'bakery_treats_register_recipe_taxonomy');

// Create Shortcode for Featured Recipes
function bakery_treats_featured_recipes_shortcode($atts) {
    $atts = shortcode_atts(array(
        'count' => 3,
    ), $atts);

    $args = array(
        'post_type' => 'recipe',
        'posts_per_page' => $atts['count'],
        'meta_key' => '_featured_recipe',
        'meta_value' => 'yes',
    );

    $query = new WP_Query($args);
    
    $output = '<div class="featured-recipes">';
    
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $output .= '<div class="recipe-card">';
            $output .= '<h3>' . get_the_title() . '</h3>';
            $output .= '<div class="recipe-excerpt">' . get_the_excerpt() . '</div>';
            $output .= '<a href="' . get_permalink() . '" class="read-more">View Recipe</a>';
            $output .= '</div>';
        }
    }
    
    $output .= '</div>';
    wp_reset_postdata();
    
    return $output;
}
add_shortcode('featured_recipes', 'bakery_treats_featured_recipes_shortcode');

// Create Shortcode for Featured Products
function bakery_treats_featured_products_shortcode($atts) {
    $atts = shortcode_atts(array(
        'limit' => 3,
    ), $atts);

    ob_start();
    
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $atts['limit'],
        'tax_query' => array(
            array(
                'taxonomy' => 'product_visibility',
                'field'    => 'name',
                'terms'    => 'featured',
            ),
        ),
    );

    $featured_query = new WP_Query($args);

    if ($featured_query->have_posts()) {
        echo '<div class="featured-products">';
        echo '<h2>' . __('Featured Products', 'bakery-treats') . '</h2>';
        echo '<div class="products">';
        
        while ($featured_query->have_posts()) {
            $featured_query->the_post();
            wc_get_template_part('content', 'product');
        }
        
        echo '</div>';
        echo '</div>';
    }

    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('featured_products', 'bakery_treats_featured_products_shortcode');

// Register Custom Post Type for Daily Specials
function bakery_treats_register_daily_special_post_type() {
    $labels = array(
        'name'                  => 'Daily Specials',
        'singular_name'         => 'Daily Special',
        'menu_name'            => 'Daily Specials',
        'add_new'              => 'Add New',
        'add_new_item'         => 'Add New Daily Special',
        'edit_item'            => 'Edit Daily Special',
        'new_item'             => 'New Daily Special',
        'view_item'            => 'View Daily Special',
        'search_items'         => 'Search Daily Specials',
        'not_found'            => 'No daily specials found',
        'not_found_in_trash'   => 'No daily specials found in Trash',
    );

    $args = array(
        'label'               => 'daily_special',
        'description'         => 'Daily special items offered by the bakery',
        'labels'              => $labels,
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt'),
        'taxonomies'          => array('special_category'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-calendar-alt',
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest'        => true, // Enable Gutenberg editor
    );

    register_post_type('daily_special', $args);
}
add_action('init', 'bakery_treats_register_daily_special_post_type');

// Register Custom Taxonomy for Special Categories
function bakery_treats_register_special_taxonomy() {
    $labels = array(
        'name'              => 'Special Categories',
        'singular_name'     => 'Special Category',
        'search_items'      => 'Search Special Categories',
        'all_items'         => 'All Special Categories',
        'parent_item'       => 'Parent Special Category',
        'parent_item_colon' => 'Parent Special Category:',
        'edit_item'         => 'Edit Special Category',
        'update_item'       => 'Update Special Category',
        'add_new_item'      => 'Add New Special Category',
        'new_item_name'     => 'New Special Category Name',
        'menu_name'         => 'Special Categories',
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'special-category'),
        'show_in_rest'      => true,
    );

    register_taxonomy('special_category', array('daily_special'), $args);
}
add_action('init', 'bakery_treats_register_special_taxonomy');

// Add Custom Meta Boxes for Daily Specials
function bakery_treats_add_daily_special_meta_boxes() {
    add_meta_box(
        'daily_special_details',
        'Daily Special Details',
        'bakery_treats_daily_special_meta_box_callback',
        'daily_special',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'bakery_treats_add_daily_special_meta_boxes');

// Meta Box Callback Function
function bakery_treats_daily_special_meta_box_callback($post) {
    // Add nonce for security
    wp_nonce_field('daily_special_meta_box', 'daily_special_meta_box_nonce');

    // Get existing values
    $availability_date = get_post_meta($post->ID, '_availability_date', true);
    $price = get_post_meta($post->ID, '_price', true);
    $ingredients = get_post_meta($post->ID, '_ingredients', true);
    $is_featured = get_post_meta($post->ID, '_is_featured', true);
    $allergens = get_post_meta($post->ID, '_allergens', true);

    // Output the fields
    ?>
    <div class="daily-special-meta">
        <p>
            <label for="availability_date">Availability Date:</label>
            <input type="date" id="availability_date" name="availability_date" value="<?php echo esc_attr($availability_date); ?>" />
        </p>
        <p>
            <label for="price">Price:</label>
            <input type="text" id="price" name="price" value="<?php echo esc_attr($price); ?>" />
        </p>
        <p>
            <label for="ingredients">Ingredients:</label>
            <textarea id="ingredients" name="ingredients" rows="4"><?php echo esc_textarea($ingredients); ?></textarea>
        </p>
        <p>
            <label for="allergens">Allergens:</label>
            <input type="text" id="allergens" name="allergens" value="<?php echo esc_attr($allergens); ?>" placeholder="e.g., Contains nuts, dairy" />
        </p>
        <p>
            <label for="is_featured">
                <input type="checkbox" id="is_featured" name="is_featured" <?php checked($is_featured, 'yes'); ?> />
                Feature this special
            </label>
        </p>
    </div>
    <?php
}

// Save Meta Box Data
function bakery_treats_save_daily_special_meta($post_id) {
    // Check if our nonce is set
    if (!isset($_POST['daily_special_meta_box_nonce'])) {
        return;
    }

    // Verify that the nonce is valid
    if (!wp_verify_nonce($_POST['daily_special_meta_box_nonce'], 'daily_special_meta_box')) {
        return;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check the user's permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Sanitize and save the data
    $fields = array(
        'availability_date',
        'price',
        'ingredients',
        'allergens',
        'is_featured'
    );

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            $value = sanitize_text_field($_POST[$field]);
            update_post_meta($post_id, '_' . $field, $value);
        }
    }
}
add_action('save_post_daily_special', 'bakery_treats_save_daily_special_meta');

// Create Shortcode for Displaying Daily Specials
function bakery_treats_daily_specials_shortcode($atts) {
    $atts = shortcode_atts(array(
        'limit' => 5,
        'featured' => false,
    ), $atts);

    $args = array(
        'post_type' => 'daily_special',
        'posts_per_page' => $atts['limit'],
        'meta_key' => '_availability_date',
        'orderby' => 'meta_value',
        'order' => 'ASC',
    );

    if ($atts['featured']) {
        $args['meta_query'] = array(
            array(
                'key' => '_is_featured',
                'value' => 'yes',
            ),
        );
    }

    $query = new WP_Query($args);
    
    $output = '<div class="daily-specials-grid">';
    
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $availability_date = get_post_meta(get_the_ID(), '_availability_date', true);
            $price = get_post_meta(get_the_ID(), '_price', true);
            $ingredients = get_post_meta(get_the_ID(), '_ingredients', true);
            $allergens = get_post_meta(get_the_ID(), '_allergens', true);
            
            $output .= '<div class="daily-special-card">';
            $output .= '<div class="special-image">' . get_the_post_thumbnail(get_the_ID(), 'medium') . '</div>';
            $output .= '<div class="special-content">';
            $output .= '<h3>' . get_the_title() . '</h3>';
            $output .= '<div class="special-date">Available: ' . date('F j, Y', strtotime($availability_date)) . '</div>';
            $output .= '<div class="special-price">Price: ' . esc_html($price) . '</div>';
            $output .= '<div class="special-ingredients">' . wpautop(esc_html($ingredients)) . '</div>';
            if ($allergens) {
                $output .= '<div class="special-allergens">Allergens: ' . esc_html($allergens) . '</div>';
            }
            $output .= '</div>';
            $output .= '</div>';
        }
    } else {
        $output .= '<p>No daily specials available at this time.</p>';
    }
    
    $output .= '</div>';
    wp_reset_postdata();
    
    return $output;
}
add_shortcode('daily_specials', 'bakery_treats_daily_specials_shortcode'); 
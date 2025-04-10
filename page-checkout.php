<?php
/**
 * Template Name: Checkout Page
 * Description: Custom template for the checkout page with enhanced styling
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="checkout-page">
        <div class="container">
            <h1 class="page-title">Checkout</h1>
            
            <?php
            if (WC()->cart->is_empty()) {
                ?>
                <div class="checkout-empty">
                    <p class="checkout-empty-message">Your cart is currently empty.</p>
                    <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="return-to-shop">
                        Return to shop
                    </a>
                </div>
                <?php
            } else {
                do_action('woocommerce_before_checkout_form', WC()->checkout());

                // If checkout registration is disabled and not logged in, the user cannot checkout
                if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
                    echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
                    return;
                }
                ?>

                <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">
                    <div class="checkout-wrapper">
                        <div class="checkout-column billing-column">
                            <?php if ($checkout->get_checkout_fields()) : ?>
                                <?php do_action('woocommerce_checkout_before_customer_details'); ?>

                                <div class="col2-set" id="customer_details">
                                    <div class="col-1">
                                        <?php do_action('woocommerce_checkout_billing'); ?>
                                    </div>

                                    <div class="col-2">
                                        <?php do_action('woocommerce_checkout_shipping'); ?>
                                    </div>
                                </div>

                                <?php do_action('woocommerce_checkout_after_customer_details'); ?>
                            <?php endif; ?>
                        </div>

                        <div class="checkout-column order-column">
                            <h3 id="order_review_heading"><?php esc_html_e('Your order', 'woocommerce'); ?></h3>

                            <?php do_action('woocommerce_checkout_before_order_review'); ?>

                            <div id="order_review" class="woocommerce-checkout-review-order">
                                <?php do_action('woocommerce_checkout_order_review'); ?>
                            </div>

                            <?php do_action('woocommerce_checkout_after_order_review'); ?>
                        </div>
                    </div>
                </form>

                <?php do_action('woocommerce_after_checkout_form', WC()->checkout()); ?>
                <?php
            }
            ?>
        </div>
    </div>
</main>

<?php
get_footer();
?> 
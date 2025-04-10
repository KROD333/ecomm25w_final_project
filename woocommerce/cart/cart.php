<?php
/**
 * Cart Page
 */

if (!defined('ABSPATH')) {
    exit;
}

do_action('woocommerce_before_cart'); ?>

<div class="cart-page">
    <div class="container">
        <h1 class="page-title">Your Shopping Cart</h1>
        
        <form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
            <?php do_action('woocommerce_before_cart_table'); ?>

            <div class="cart-table">
                <div class="cart-header">
                    <div class="cart-header-product">Product</div>
                    <div class="cart-header-price">Price</div>
                    <div class="cart-header-quantity">Quantity</div>
                    <div class="cart-header-subtotal">Subtotal</div>
                    <div class="cart-header-remove"></div>
                </div>

                <?php do_action('woocommerce_before_cart_contents'); ?>

                <?php
                foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                    $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                    $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

                    if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
                        $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                        ?>
                        <div class="cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">
                            <div class="cart-item-product">
                                <?php
                                $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
                                if (!$product_permalink) {
                                    echo $thumbnail;
                                } else {
                                    printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail);
                                }
                                ?>
                                <div class="cart-item-details">
                                    <h3 class="product-title">
                                        <?php
                                        if (!$product_permalink) {
                                            echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . '&nbsp;');
                                        } else {
                                            echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s">%s</a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key));
                                        }
                                        ?>
                                    </h3>
                                    <?php echo wc_get_formatted_cart_item_data($cart_item); ?>
                                </div>
                            </div>

                            <div class="cart-item-price">
                                <?php
                                echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
                                ?>
                            </div>

                            <div class="cart-item-quantity">
                                <?php
                                if ($_product->is_sold_individually()) {
                                    $product_quantity = sprintf('1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key);
                                } else {
                                    $product_quantity = woocommerce_quantity_input(
                                        array(
                                            'input_name'   => "cart[{$cart_item_key}][qty]",
                                            'input_value'  => $cart_item['quantity'],
                                            'max_value'    => $_product->get_max_purchase_quantity(),
                                            'min_value'    => '0',
                                            'product_name' => $_product->get_name(),
                                        ),
                                        $_product,
                                        false
                                    );
                                }
                                echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item);
                                ?>
                            </div>

                            <div class="cart-item-subtotal">
                                <?php
                                echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key);
                                ?>
                            </div>

                            <div class="cart-item-remove">
                                <?php
                                echo apply_filters(
                                    'woocommerce_cart_item_remove_link',
                                    sprintf(
                                        '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                                        esc_url(wc_get_cart_remove_url($cart_item_key)),
                                        esc_html__('Remove this item', 'woocommerce'),
                                        esc_attr($product_id),
                                        esc_attr($_product->get_sku())
                                    ),
                                    $cart_item_key
                                );
                                ?>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>

                <?php do_action('woocommerce_cart_contents'); ?>

                <div class="cart-actions">
                    <button type="submit" class="button update-cart" name="update_cart" value="<?php esc_attr_e('Update cart', 'woocommerce'); ?>"><?php esc_html_e('Update cart', 'woocommerce'); ?></button>
                    <?php do_action('woocommerce_cart_actions'); ?>
                    <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
                </div>

                <?php do_action('woocommerce_after_cart_contents'); ?>
            </div>

            <?php do_action('woocommerce_after_cart_table'); ?>
        </form>

        <div class="cart-collaterals">
            <?php
            do_action('woocommerce_before_cart_collaterals');
            ?>
            <div class="cart-totals">
                <?php
                do_action('woocommerce_before_cart_totals');
                ?>
                <h2><?php esc_html_e('Cart totals', 'woocommerce'); ?></h2>
                <div class="cart-totals-content">
                    <div class="cart-subtotal">
                        <span><?php esc_html_e('Subtotal', 'woocommerce'); ?></span>
                        <span><?php wc_cart_totals_subtotal_html(); ?></span>
                    </div>

                    <?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
                        <div class="cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?>">
                            <span><?php wc_cart_totals_coupon_label($coupon); ?></span>
                            <span><?php wc_cart_totals_coupon_html($coupon); ?></span>
                        </div>
                    <?php endforeach; ?>

                    <?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>
                        <div class="shipping">
                            <span><?php esc_html_e('Shipping', 'woocommerce'); ?></span>
                            <span><?php wc_cart_totals_shipping_html(); ?></span>
                        </div>
                    <?php endif; ?>

                    <?php foreach (WC()->cart->get_fees() as $fee) : ?>
                        <div class="fee">
                            <span><?php echo esc_html($fee->name); ?></span>
                            <span><?php wc_cart_totals_fee_html($fee); ?></span>
                        </div>
                    <?php endforeach; ?>

                    <?php
                    if (wc_tax_enabled() && !WC()->cart->display_prices_including_tax()) {
                        $taxable_address = WC()->customer->get_taxable_address();
                        $estimated_text = '';

                        if (WC()->customer->is_customer_outside_base() && !WC()->customer->has_calculated_shipping()) {
                            $estimated_text = sprintf(' <small>' . esc_html__('(estimated for %s)', 'woocommerce') . '</small>', WC()->countries->estimated_for_prefix($taxable_address[0]) . WC()->countries->countries[$taxable_address[0]]);
                        }

                        if ('itemized' === get_option('woocommerce_tax_total_display')) {
                            foreach (WC()->cart->get_tax_totals() as $code => $tax) {
                                ?>
                                <div class="tax-rate tax-rate-<?php echo esc_attr(sanitize_title($code)); ?>">
                                    <span><?php echo esc_html($tax->label) . $estimated_text; ?></span>
                                    <span><?php echo wp_kses_post($tax->formatted_amount); ?></span>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                            <div class="tax-total">
                                <span><?php echo esc_html(WC()->countries->tax_or_vat()) . $estimated_text; ?></span>
                                <span><?php wc_cart_totals_taxes_total_html(); ?></span>
                            </div>
                            <?php
                        }
                    }
                    ?>

                    <?php do_action('woocommerce_cart_totals_before_order_total'); ?>

                    <div class="order-total">
                        <span><?php esc_html_e('Total', 'woocommerce'); ?></span>
                        <span><?php wc_cart_totals_order_total_html(); ?></span>
                    </div>

                    <?php do_action('woocommerce_cart_totals_after_order_total'); ?>
                </div>

                <div class="wc-proceed-to-checkout">
                    <?php do_action('woocommerce_proceed_to_checkout'); ?>
                </div>

                <?php do_action('woocommerce_after_cart_totals'); ?>
            </div>
        </div>
    </div>
</div>

<?php do_action('woocommerce_after_cart'); ?> 
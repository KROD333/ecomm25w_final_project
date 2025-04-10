<?php
/**
 * My Account Page
 */

if (!defined('ABSPATH')) {
    exit;
}

do_action('woocommerce_before_account_navigation'); ?>

<div class="my-account-page">
    <div class="container">
        <h1 class="page-title">My Account</h1>
        
        <div class="my-account-content">
            <nav class="woocommerce-MyAccount-navigation">
                <ul>
                    <?php foreach (wc_get_account_menu_items() as $endpoint => $label) : ?>
                        <li class="<?php echo wc_get_account_menu_item_classes($endpoint); ?>">
                            <a href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>">
                                <?php echo esc_html($label); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>

            <div class="woocommerce-MyAccount-content">
                <?php
                do_action('woocommerce_account_content');
                ?>
            </div>
        </div>
    </div>
</div>

<?php do_action('woocommerce_after_account_navigation'); ?> 
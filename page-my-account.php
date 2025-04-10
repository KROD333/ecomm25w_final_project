<?php
/**
 * Template Name: My Account Page
 * Description: Custom template for the my account page with enhanced styling
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="my-account-page">
        <div class="container">
            <h1 class="page-title">My Account</h1>
            
            <?php
            if (!is_user_logged_in()) {
                ?>
                <div class="account-login">
                    <div class="login-form">
                        <h2><?php esc_html_e('Login', 'woocommerce'); ?></h2>
                        <?php
                        woocommerce_login_form(
                            array(
                                'redirect' => wc_get_page_permalink('myaccount'),
                                'hidden'   => false,
                            )
                        );
                        ?>
                    </div>

                    <div class="register-form">
                        <h2><?php esc_html_e('Register', 'woocommerce'); ?></h2>
                        <?php
                        woocommerce_register_form(
                            array(
                                'redirect' => wc_get_page_permalink('myaccount'),
                            )
                        );
                        ?>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div class="account-navigation">
                    <nav class="woocommerce-MyAccount-navigation">
                        <ul>
                            <?php foreach (wc_get_account_menu_items() as $endpoint => $label) : ?>
                                <li class="<?php echo wc_get_account_menu_item_classes($endpoint); ?>">
                                    <a href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>"><?php echo esc_html($label); ?></a>
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
                <?php
            }
            ?>
        </div>
    </div>
</main>

<?php
get_footer();
?> 
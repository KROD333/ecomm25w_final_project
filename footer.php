    </div><!-- #content -->

    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="footer-widgets">
                <div class="footer-widget">
                    <h3>About Panadaria</h3>
                    <p>Freshly baked goods made with love and traditional recipes. Visit our bakery for the best pastries in town.</p>
                </div>
                
                <div class="footer-widget">
                    <h3>Quick Links</h3>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer',
                        'menu_class'     => 'footer-menu',
                        'depth'          => 1,
                    ));
                    ?>
                </div>
                
                <div class="footer-widget">
                    <h3>Contact Us</h3>
                    <p>
                        123 Bakery Street<br>
                        City, State 12345<br>
                        Phone: (123) 456-7890<br>
                        Email: info@panadaria.com
                    </p>
                </div>
                
                <div class="footer-widget">
                    <h3>Follow Us</h3>
                    <div class="social-links">
                        <a href="https://facebook.com/panadaria" class="social-link" target="_blank" rel="noopener noreferrer">
                            <span class="screen-reader-text">Facebook</span>
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="https://instagram.com/panadaria" class="social-link" target="_blank" rel="noopener noreferrer">
                            <span class="screen-reader-text">Instagram</span>
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://twitter.com/panadaria" class="social-link" target="_blank" rel="noopener noreferrer">
                            <span class="screen-reader-text">Twitter</span>
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://pinterest.com/panadaria" class="social-link" target="_blank" rel="noopener noreferrer">
                            <span class="screen-reader-text">Pinterest</span>
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <div class="copyright">
                    &copy; <?php echo date('Y'); ?> Panadaria. All rights reserved.
                </div>
                <div class="footer-links">
                    <a href="<?php echo esc_url(home_url('/privacy-policy')); ?>">Privacy Policy</a>
                    <a href="<?php echo esc_url(home_url('/terms-of-service')); ?>">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html> 
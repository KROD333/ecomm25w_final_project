<?php
/**
 * Template Name: Contact Page
 * Description: Contact page template with form and location information
 */

get_header();
?>

<main id="primary" class="site-main">
    <section class="contact-hero">
        <div class="container">
            <h1>Contact Us</h1>
            <p>We'd love to hear from you</p>
        </div>
    </section>

    <section class="contact-content">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="contact-info">
                        <h2>Get in Touch</h2>
                        <div class="info-item">
                            <h3>Address</h3>
                            <p>123 Bakery Street<br>City, State 12345</p>
                        </div>
                        <div class="info-item">
                            <h3>Phone</h3>
                            <p>(123) 456-7890</p>
                        </div>
                        <div class="info-item">
                            <h3>Email</h3>
                            <p>info@panadaria.com</p>
                        </div>
                        <div class="info-item">
                            <h3>Hours</h3>
                            <p>Monday - Friday: 7am - 7pm<br>
                               Saturday: 8am - 6pm<br>
                               Sunday: 9am - 5pm</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="contact-form">
                        <h2>Send Us a Message</h2>
                        <?php
                        $contact_form = do_shortcode('[contact-form-7 id="' . get_option('panadaria_contact_form_id', '') . '" title="Contact form 1"]');
                        if (empty($contact_form)) {
                            echo '<div class="contact-form-fallback">';
                            echo '<p>Our contact form is currently unavailable. Please email us directly at <a href="mailto:info@panadaria.com">info@panadaria.com</a> or call us at (123) 456-7890.</p>';
                            echo '</div>';
                        } else {
                            echo $contact_form;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="map-section">
        <div class="container">
            <h2>Find Us</h2>
            <div class="map-container">
                <!-- Replace with your actual Google Maps embed code -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.215319027345!2d-73.98784492416418!3d40.75798597138948!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25855c6480299%3A0x55194ec5a1ae072e!2sTimes%20Square!5e0!3m2!1sen!2sus!4v1712688000000!5m2!1sen!2sus" 
                        width="100%" 
                        height="450" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
?> 
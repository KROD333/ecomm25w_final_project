<?php
/**
 * Template Name: About Page
 * Description: About page template with bakery story and team sections
 */

get_header();
?>

<main id="primary" class="site-main">
    <!-- Hero Section with Parallax -->
    <section class="about-hero" data-parallax="scroll" data-image-src="<?php echo get_template_directory_uri(); ?>/assets/images/about-hero.jpg">
        <div class="hero-content">
            <h1 class="animate-fade-in">Our Story</h1>
            <p class="animate-fade-in-delay">Discover the passion behind our bakery</p>
        </div>
    </section>

    <!-- Timeline Section -->
    <section class="timeline-section">
        <div class="container">
            <h2 class="section-title">Our Journey</h2>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h3>2024</h3>
                        <p>Panadaria opens its doors, bringing traditional baking methods to the modern world.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h3>2025</h3>
                        <p>Expanded our menu to include artisanal breads and pastries.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h3>2026</h3>
                        <p>Launched our online store, bringing our baked goods to customers nationwide.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section with Hover Effects -->
    <section class="team-section">
        <div class="container">
            <h2 class="section-title">Meet Our Team</h2>
            <div class="team-grid">
                <div class="team-member">
                    <div class="member-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/team-member-1.jpg" alt="Team Member">
                        <div class="member-overlay">
                            <div class="member-info">
                                <h3>Head Baker</h3>
                                <p>With over 15 years of experience in traditional baking</p>
                                <div class="member-social">
                                    <a href="#" class="social-link">📘</a>
                                    <a href="#" class="social-link">📸</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="team-member">
                    <div class="member-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/team-member-2.jpg" alt="Team Member">
                        <div class="member-overlay">
                            <div class="member-info">
                                <h3>Pastry Chef</h3>
                                <p>Specializing in French pastries and desserts</p>
                                <div class="member-social">
                                    <a href="#" class="social-link">📘</a>
                                    <a href="#" class="social-link">📸</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section with Interactive Cards -->
    <section class="values-section">
        <div class="container">
            <h2 class="section-title">Our Values</h2>
            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon">🌟</div>
                    <h3>Quality</h3>
                    <p>We use only the finest ingredients in all our products</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">🍞</div>
                    <h3>Tradition</h3>
                    <p>Preserving traditional baking methods and recipes</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">✨</div>
                    <h3>Innovation</h3>
                    <p>Constantly exploring new flavors and techniques</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section with Slider -->
    <section class="testimonials-section">
        <div class="container">
            <h2 class="section-title">What Our Customers Say</h2>
            <div class="testimonials-slider">
                <div class="testimonial-slide">
                    <div class="testimonial-content">
                        <div class="testimonial-text">
                            "The best bakery in town! Their croissants are absolutely divine."
                        </div>
                        <div class="testimonial-author">
                            <span class="author-name">Sarah Johnson</span>
                            <span class="author-role">Regular Customer</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial-slide">
                    <div class="testimonial-content">
                        <div class="testimonial-text">
                            "I love their commitment to quality and traditional baking methods."
                        </div>
                        <div class="testimonial-author">
                            <span class="author-name">Michael Brown</span>
                            <span class="author-role">Food Blogger</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
?> 
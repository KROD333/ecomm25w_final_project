/**
 * Main JavaScript file for Bakery Treats theme
 */

(function($) {
    'use strict';

    // Document ready
    $(document).ready(function() {
        // Initialize mobile menu
        initMobileMenu();
        
        // Initialize product sliders if Slick is available
        if (typeof $.fn.slick !== 'undefined') {
            initProductSliders();
        } else {
            console.warn('Slick slider not loaded');
        }
        
        // Initialize parallax effects if Parallax is available
        if (typeof $.fn.parallax !== 'undefined') {
            initParallax();
        } else {
            console.warn('Parallax not loaded');
        }
        
        // Initialize smooth scrolling
        initSmoothScroll();
    });

    // Mobile menu functionality
    function initMobileMenu() {
        const $menuToggle = $('.menu-toggle');
        const $mainNav = $('.main-navigation');

        if ($menuToggle.length && $mainNav.length) {
            $menuToggle.on('click', function() {
                $mainNav.toggleClass('toggled');
                $(this).toggleClass('toggled');
            });

            // Close menu when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.main-navigation, .menu-toggle').length) {
                    $mainNav.removeClass('toggled');
                    $menuToggle.removeClass('toggled');
                }
            });
        }
    }

    // Product sliders initialization
    function initProductSliders() {
        if ($('.products-slider').length) {
            try {
                $('.products-slider').slick({
                    dots: true,
                    infinite: true,
                    speed: 300,
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    responsive: [
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        }
                    ]
                });
            } catch (e) {
                console.error('Error initializing product sliders:', e);
            }
        }
    }

    // Parallax effect initialization
    function initParallax() {
        if ($('[data-parallax="scroll"]').length) {
            try {
                $('[data-parallax="scroll"]').parallax({
                    imageSrc: $(this).data('image-src'),
                    speed: 0.5
                });
            } catch (e) {
                console.error('Error initializing parallax:', e);
            }
        }
    }

    // Smooth scrolling initialization
    function initSmoothScroll() {
        $('a[href*="#"]').not('[href="#"]').not('[href="#0"]').click(function(event) {
            if (
                location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
                && 
                location.hostname == this.hostname
            ) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    event.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                }
            }
        });
    }

    // Add to cart AJAX functionality
    $(document).on('click', '.add_to_cart_button', function(e) {
        e.preventDefault();
        const $button = $(this);
        const product_id = $button.data('product_id');
        const quantity = $button.closest('.product').find('.quantity input').val() || 1;

        if (typeof bakeryTreats === 'undefined') {
            console.error('bakeryTreats object not defined');
            return;
        }

        $.ajax({
            url: bakeryTreats.ajaxurl,
            type: 'POST',
            data: {
                action: 'add_to_cart',
                product_id: product_id,
                quantity: quantity,
                nonce: bakeryTreats.nonce
            },
            beforeSend: function() {
                $button.addClass('loading');
            },
            success: function(response) {
                if (response.success) {
                    // Update cart fragment
                    $(document.body).trigger('wc_fragment_refresh');
                    // Show success message
                    $button.closest('.product').append('<div class="added-to-cart-message">Added to cart!</div>');
                    setTimeout(function() {
                        $('.added-to-cart-message').fadeOut();
                    }, 2000);
                }
            },
            complete: function() {
                $button.removeClass('loading');
            }
        });
    });

})(jQuery); 
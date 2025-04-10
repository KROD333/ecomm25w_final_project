/**
 * Slider functionality for Bakery Treats theme
 */

(function($) {
    'use strict';

    // Initialize product sliders
    function initProductSliders() {
        $('.products-slider').each(function() {
            const $slider = $(this);
            
            $slider.slick({
                dots: true,
                infinite: true,
                speed: 300,
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 3000,
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

            // Add custom navigation arrows
            $slider.append('<div class="slick-custom-arrows"><button class="slick-prev"><i class="fas fa-chevron-left"></i></button><button class="slick-next"><i class="fas fa-chevron-right"></i></button></div>');
        });
    }

    // Initialize testimonial sliders
    function initTestimonialSliders() {
        $('.testimonials-slider').each(function() {
            const $slider = $(this);
            
            $slider.slick({
                dots: true,
                infinite: true,
                speed: 500,
                fade: true,
                cssEase: 'linear',
                autoplay: true,
                autoplaySpeed: 5000
            });
        });
    }

    // Initialize recipe sliders
    function initRecipeSliders() {
        $('.recipe-slider').each(function() {
            const $slider = $(this);
            
            $slider.slick({
                dots: true,
                infinite: true,
                speed: 300,
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 4000,
                fade: true,
                cssEase: 'linear'
            });
        });
    }

    // Document ready
    $(document).ready(function() {
        // Check if Slick is loaded
        if (typeof $.fn.slick !== 'undefined') {
            initProductSliders();
            initTestimonialSliders();
            initRecipeSliders();
        } else {
            console.error('Slick slider is not loaded');
        }
    });

})(jQuery); 
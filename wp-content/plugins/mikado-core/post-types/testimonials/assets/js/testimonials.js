(function($) {
    'use strict';

    $(document).ready(function(){
	    mkdInitTestimonials();
    });

	/**
	 * Init testimonials shortcode
	 */
	function mkdInitTestimonials(){
		var testimonialsHolder = $('.mkd-testimonials-holder');

		if(testimonialsHolder.length){
			testimonialsHolder.each(function(){
				var thisTestimonials = $(this),
					testimonials = thisTestimonials.children('.mkd-testimonials'),
					numberOfItems = 3,
					loop = true,
					autoplay = true,
					number = 0,
					speed = 5000,
					animationSpeed = 600,
					navArrows = true,
					navDots = true,
					margin = 26;

				if (typeof testimonials.data('number') !== 'undefined' && testimonials.data('number') !== false) {
					number = parseInt(testimonials.data('number'));
				}

				if (typeof testimonials.data('number-visible') !== 'undefined' && testimonials.data('number-visible') !== false) {
					numberOfItems = parseInt(testimonials.data('number-visible'));
				}

				if (typeof testimonials.data('speed') !== 'undefined' && testimonials.data('speed') !== false) {
					speed = testimonials.data('speed');
				}

				if (typeof testimonials.data('animation-speed') !== 'undefined' && testimonials.data('animation-speed') !== false) {
					animationSpeed = testimonials.data('animation-speed');
				}

				if (typeof testimonials.data('nav-arrows') !== 'undefined' && testimonials.data('nav-arrows') !== false && testimonials.data('nav-arrows') === 'no') {
					navArrows = false;
				}

				if (typeof testimonials.data('nav-dots') !== 'undefined' && testimonials.data('nav-dots') !== false && testimonials.data('nav-dots') === 'no') {
					navDots = false;
				}

				if(number === 1) {
					loop = false;
					autoplay = false;
					navArrows = false;
					navDots = false;
				}

                var responsiveNumberOfItems1 = 1,
                    responsiveNumberOfItems2 = 2;

                if (numberOfItems < 3) {
                    responsiveNumberOfItems1 = numberOfItems;
                    responsiveNumberOfItems2 = numberOfItems;
                }

				testimonials.owlCarousel({
					items: numberOfItems,
					loop: loop,
					autoplay: autoplay,
					autoplayTimeout: speed,
					smartSpeed: animationSpeed,
					margin: margin,
					nav: navArrows,
					dots: navDots,
                    responsive: {
						0: {
                            items: responsiveNumberOfItems1,
                            margin: 0,
                            center: false,
                            autoWidth: false
                        },
                        769: {
                            items: responsiveNumberOfItems2
                        },
                        1025: {
                            items: numberOfItems
                        }
                    },
					navText: [
						'<span class="mkd-prev-icon"><span class="mkd-icon-linear-icon lnr lnr-arrow-left"></span></span>',
						'<span class="mkd-next-icon"><span class="mkd-icon-linear-icon lnr lnr-arrow-right"></span></span>'
					]
				});
				thisTestimonials.css({'visibility': 'visible'});
			});
		}
	}

})(jQuery);
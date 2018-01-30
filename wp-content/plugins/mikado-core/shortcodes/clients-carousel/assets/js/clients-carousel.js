(function($) {
	'use strict';
	
	$(document).ready(function(){
		mkdInitClientsCarousel();
	});
	
	/**
	 * Init clients carousel shortcode
	 */
	function mkdInitClientsCarousel(){
		var carouselHolder = $('.mkd-clients-carousel-holder');
		
		if(carouselHolder.length){
			carouselHolder.each(function(){
				
				var thisCarouselHolder = $(this),
					thisCarousel = thisCarouselHolder.children('.mkd-cc-inner'),
					numberOfItems = 4,
					autoplay = true,
					autoplayTimeout = 5000,
					loop = true,
					speed = 650;
				
				if (typeof thisCarousel.data('number-of-items') !== 'undefined' && thisCarousel.data('number-of-items') !== false) {
					numberOfItems = parseInt(thisCarousel.data('number-of-items'));
				}
				
				if (typeof thisCarousel.data('autoplay') !== 'undefined' && thisCarousel.data('autoplay') !== false) {
					autoplay = thisCarousel.data('autoplay');
				}
				
				if (typeof thisCarousel.data('autoplay-timeout') !== 'undefined' && thisCarousel.data('autoplay-timeout') !== false) {
					autoplayTimeout = thisCarousel.data('autoplay-timeout');
				}
				
				if (typeof thisCarousel.data('loop') !== 'undefined' && thisCarousel.data('loop') !== false) {
					loop = thisCarousel.data('loop');
				}
				
				if (typeof thisCarousel.data('speed') !== 'undefined' && thisCarousel.data('speed') !== false) {
					speed = thisCarousel.data('speed');
				}
				
				if(numberOfItems === 1) {
					autoplay = false;
					loop = false;
				}
				
				var responsiveNumberOfItems1 = 1,
					responsiveNumberOfItems2 = 2,
					responsiveNumberOfItems3 = 3;
				
				if (numberOfItems < 3) {
					responsiveNumberOfItems1 = numberOfItems;
					responsiveNumberOfItems2 = numberOfItems;
					responsiveNumberOfItems3 = numberOfItems;
				}
				
				thisCarousel.owlCarousel({
					items: numberOfItems,
					autoplay: autoplay,
					autoplayTimeout: autoplayTimeout,
					autoplayHoverPause:true,
					loop: loop,
					smartSpeed: speed,
					nav: false,
					dots: false,
					responsive: {
						0: {
							items: responsiveNumberOfItems1,
						},
						600: {
							items: responsiveNumberOfItems2
						},
						768: {
							items: responsiveNumberOfItems3,
						},
						1025: {
							items: numberOfItems
						}
					}
				});

				thisCarousel.css({'visibility': 'visible'});
			});
		}
	}
	
})(jQuery);
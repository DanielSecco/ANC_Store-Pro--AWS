(function($) {
	'use strict';
	
	$(window).load(function(){
		mkdInitFrameSlider();
	});
	
	/*
	 **	Init Frame Slider shortcode
	 */
	function mkdInitFrameSlider() {
		var sliders = $('.mkd-frame-slider-holder');
		
		if (sliders.length) {
			sliders.each(function() {
				var sliderHolder = $(this),
					slider = sliderHolder.children('.mkd-fs-slides');
				
				slider.owlCarousel({
					loop: true,
					nav: false,
					dots: false,
					center: true,
					responsive: {
						0: {
							items: 1,
							margin: 0,
							autoWidth: false
						},
						681: {
							items: 3,
							margin: 36,
							autoWidth: true
						},
						1441: {
							items: 5,
							margin: 36,
							autoWidth: true
						}
					}
				});
				
				slider.css({'visibility': 'visible'});
			});
		}
	}
	
})(jQuery);
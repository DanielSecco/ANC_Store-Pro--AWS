(function($) {
    'use strict';

    $(document).ready(function(){
	    // mkdInitTeamSlider();
    });
	
	/**
	 * Init team slider shortcode
	 */
	function mkdInitTeamSlider() {
		var teamSliders = $('.mkd-team-slider-holder');
		
		if (teamSliders.length) {
			teamSliders.each(function () {
				
				var thisTeamSlider = $(this),
					teamHolder = thisTeamSlider.children('.mkd-team-list-holder'),
					teamSlider = teamHolder.children('.mkd-tl-inner');
				
				var dots = (teamHolder.data('dots') == 'yes');
				
				var numberOfItems = teamHolder.data('number_of_items');
				
				var responsiveItems1 = numberOfItems;
				var responsiveItems2 = 3;
				var responsiveItems3 = 2;
				var responsiveItems4 = 1;
				
				if (numberOfItems > 4) {
					responsiveItems1 = 4;
				}
				
				if(numberOfItems < 3) {
					responsiveItems2 = numberOfItems;
				}
				
				if (numberOfItems < 2) {
					responsiveItems3 = numberOfItems;
				}
				
				if (numberOfItems === 1) {
					responsiveItems4 = numberOfItems;
				}
				
				teamSlider.owlCarousel({
					dots: dots,
					nav: false,
					items: numberOfItems,
					responsive:{
						1200:{
							items: numberOfItems
						},
						1024:{
							items: responsiveItems1
						},
						769:{
							items: responsiveItems2
						},
						601:{
							items: responsiveItems3
						},
						0:{
							items: responsiveItems4
						}
					},
					onInitialized: function() {
						teamSlider.css({'opacity': 1});
					}
				});
			});
		}
	}

})(jQuery);
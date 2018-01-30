(function($) {
	'use strict';
	
	$(document).ready(function(){
		mkdInitCounter();
	});
	
	/**
	 * Counter Shortcode
	 */
	function mkdInitCounter() {
		var counterHolder = $('.mkd-counter-holder');
		
		if (counterHolder.length) {
			counterHolder.each(function() {
				var thisCounterHolder = $(this),
					thisCounter = thisCounterHolder.find('.mkd-counter');
				
				thisCounterHolder.appear(function() {
					thisCounterHolder.css('opacity', '1');
					
					//Counter zero type
					if (thisCounter.hasClass('mkd-zero-counter')) {
						var max = parseFloat(thisCounter.text());
						thisCounter.countTo({
							from: 0,
							to: max,
							speed: 1500,
							refreshInterval: 100
						});
					} else {
						thisCounter.absoluteCounter({
							speed: 2000,
							fadeInDelay: 1000
						});
					}
				},{accX: 0, accY: mkdGlobalVars.vars.mkdElementAppearAmount});
			});
		}
	}
	
})(jQuery);
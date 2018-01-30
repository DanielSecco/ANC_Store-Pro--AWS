(function($) {
	'use strict';
	
	$(document).ready(function(){
		mkdInitProgressBars();
	});
	
	/*
	 **	Horizontal progress bars shortcode
	 */
	function mkdInitProgressBars(){
		var progressBar = $('.mkd-progress-bar');
		
		if(progressBar.length){
			progressBar.each(function() {
				var thisBar = $(this),
					thisBarContent = thisBar.find('.mkd-pb-content'),
					percentage = thisBarContent.data('percentage');
				
				thisBar.appear(function() {
					mkdInitToCounterProgressBar(thisBar, percentage);
					
					thisBarContent.css('width', '0%');
					thisBarContent.animate({'width': percentage+'%'}, 2000);
				});
			});
		}
	}
	
	/*
	 **	Counter for horizontal progress bars percent from zero to defined percent
	 */
	function mkdInitToCounterProgressBar(progressBar, $percentage){
		var percentage = parseFloat($percentage),
			percent = progressBar.find('.mkd-pb-percent');
		
		if(percent.length) {
			percent.each(function() {
				var thisPercent = $(this);
				thisPercent.css('opacity', '1');
				
				thisPercent.countTo({
					from: 0,
					to: percentage,
					speed: 2000,
					refreshInterval: 50
				});
			});
		}
	}
	
})(jQuery);
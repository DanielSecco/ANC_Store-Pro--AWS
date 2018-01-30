(function($) {
	'use strict';
	
	$(document).ready(function(){
		mkdInitTabs();
	});
	
	/*
	 **	Init tabs shortcode
	 */
	function mkdInitTabs(){
		var tabs = $('.mkd-tabs');
		
		if(tabs.length){
			tabs.each(function(){
				var thisTabs = $(this);
				
				thisTabs.children('.mkd-tab-container').each(function(index){
					index = index + 1;
					var that = $(this),
						link = that.attr('id'),
						navItem = that.parent().find('.mkd-tabs-nav li:nth-child('+index+') a'),
						navLink = navItem.attr('href');
					
					link = '#'+link;
					
					if(link.indexOf(navLink) > -1) {
						navItem.attr('href',link);
					}
				});
				
				thisTabs.tabs();
			});
		}
	}
	
})(jQuery);
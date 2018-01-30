(function($) {
	'use strict';
	
	$(document).ready(function(){
		mkdInitItemShowcase();
	});
	
	/**
	 * Init item showcase shortcode
	 */
	function mkdInitItemShowcase() {
		var itemShowcase = $('.mkd-item-showcase-holder');
		
		if (itemShowcase.length) {
			itemShowcase.each(function(){
				var thisItemShowcase = $(this),
					leftItems = thisItemShowcase.find('.mkd-is-left'),
					rightItems = thisItemShowcase.find('.mkd-is-right'),
					itemImage = thisItemShowcase.find('.mkd-is-image');
				
				//logic
				leftItems.wrapAll( "<div class='mkd-is-item-holder mkd-is-left-holder' />");
				rightItems.wrapAll( "<div class='mkd-is-item-holder mkd-is-right-holder' />");
				thisItemShowcase.animate({opacity:1},200);
				
				setTimeout(function(){
					thisItemShowcase.appear(function(){
						itemImage.addClass('mkd-appeared');
						thisItemShowcase.on('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',
							function(e) {
								if(mkd.windowWidth > 1200) {
									itemAppear('.mkd-is-left-holder .mkd-is-item');
									itemAppear('.mkd-is-right-holder .mkd-is-item');
								} else {
									itemAppear('.mkd-is-item');
								}
							});
					},{accX: 0, accY: mkdGlobalVars.vars.mkdElementAppearAmount});
				},100);
				
				//appear animation trigger
				function itemAppear(itemCSSClass) {
					thisItemShowcase.find(itemCSSClass).each(function(i){
						var thisListItem = $(this);
						setTimeout(function(){
							thisListItem.addClass('mkd-appeared');
						}, i*150);
					});
				}
			});
		}
	}
	
})(jQuery);
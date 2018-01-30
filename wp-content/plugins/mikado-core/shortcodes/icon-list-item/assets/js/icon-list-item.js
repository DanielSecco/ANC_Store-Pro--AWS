(function($) {
	'use strict';
	
	$(document).ready(function(){
		mkdInitIconList().init();
	});
	
	/**
	 * Button object that initializes icon list with animation
	 * @type {Function}
	 */
	var mkdInitIconList = function() {
		var iconList = $('.mkd-animate-list');
		
		/**
		 * Initializes icon list animation
		 * @param list current slider
		 */
		var iconListInit = function(list) {
			setTimeout(function(){
				list.appear(function(){
					list.addClass('mkd-appeared');
				},{accX: 0, accY: mkdGlobalVars.vars.mkdElementAppearAmount});
			},30);
		};
		
		return {
			init: function() {
				if(iconList.length) {
					iconList.each(function() {
						iconListInit($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
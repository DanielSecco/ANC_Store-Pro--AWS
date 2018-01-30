(function($) {
	'use strict';
	
	$(document).ready(function(){
		mkdInitVerticalSplitSlider();
	});
	
	/*
	 **	Vertical Split Slider
	 */
	function mkdInitVerticalSplitSlider() {
		var slider = $('.mkd-vertical-split-slider');
		
		if (slider.length) {
			if (mkd.body.hasClass('mkd-vss-initialized')) {
				mkd.body.removeClass('mkd-vss-initialized');
				$.fn.multiscroll.destroy();
			}
			
			slider.height(mkd.windowHeight).animate({opacity: 1}, 300);
			
			var defaultHeaderStyle = '';
			if (mkd.body.hasClass('mkd-light-header')) {
				defaultHeaderStyle = 'light';
			} else if (mkd.body.hasClass('mkd-dark-header')) {
				defaultHeaderStyle = 'dark';
			}
			
			slider.multiscroll({
				scrollingSpeed: 700,
				easing: 'easeInOutQuart',
				navigation: true,
				useAnchorsOnLoad: false,
				sectionSelector: '.mkd-vss-ms-section',
				leftSelector: '.mkd-vss-ms-left',
				rightSelector: '.mkd-vss-ms-right',
                loopTop: true,
                loopBottom: true,
				afterRender: function () {
					mkdCheckVerticalSplitSectionsForHeaderStyle($('.mkd-vss-ms-left .mkd-vss-ms-section:last-child').data('header-style'), defaultHeaderStyle);
					mkd.body.addClass('mkd-vss-initialized');
					
					var contactForm7 = $('div.wpcf7 > form');
					if (contactForm7.length) {
						_wpcf7.supportHtml5 = $.wpcf7SupportHtml5();
						contactForm7.wpcf7InitForm();
					} // this function need to be initialized after initVerticalSplitSlide
					
					//prepare html for smaller screens - start //
					var verticalSplitSliderResponsive = $('<div class="mkd-vss-responsive"></div>'),
						leftSide = slider.find('.mkd-vss-ms-left > div'),
						rightSide = slider.find('.mkd-vss-ms-right > div');
					
					slider.after(verticalSplitSliderResponsive);
					
					for (var i = 0; i < leftSide.length; i++) {
						verticalSplitSliderResponsive.append($(leftSide[i]).clone(true));
						verticalSplitSliderResponsive.append($(rightSide[leftSide.length - 1 - i]).clone(true));
					}
					
					//prepare google maps clones
					var googleMapHolder = $('.mkd-vss-responsive .mkd-google-map');
					if (googleMapHolder.length) {
						googleMapHolder.each(function () {
							var map = $(this);
							map.empty();
							var num = Math.floor((Math.random() * 100000) + 1);
							map.attr('id', 'mkd-map-' + num);
							map.data('unique-id', num);
						});
					}
					
					if (typeof mkdButton === "function") {
						mkdButton().init();
					}
					
					if (typeof mkdInitElementsHolderResponsiveStyle === "function") {
						mkdInitElementsHolderResponsiveStyle();
					}
					
					if (typeof mkdShowGoogleMap === "function") {
						mkdShowGoogleMap();
					}
					
					if (typeof mkdInitProgressBars === "function") {
						mkdInitProgressBars();
					}
					
					if (typeof mkdInitTestimonials === "function") {
						mkdInitTestimonials();
					}
				},
				onLeave: function (index, nextIndex, direction) {
					mkdCheckVerticalSplitSectionsForHeaderStyle($($('.mkd-vss-ms-left .mkd-vss-ms-section')[$(".mkd-vss-ms-left .mkd-vss-ms-section").length - nextIndex]).data('header-style'), defaultHeaderStyle);
				}
			});
			
			if (mkd.windowWidth <= 1024) {
				$.fn.multiscroll.destroy();
			} else {
				$.fn.multiscroll.build();
			}
			
			$(window).resize(function () {
				if (mkd.windowWidth <= 1024) {
					$.fn.multiscroll.destroy();
				} else {
					$.fn.multiscroll.build();
				}
			});
		}
	}
	
	/*
	 **	Check slides on load and slide change for header style changing
	 */
	function mkdCheckVerticalSplitSectionsForHeaderStyle(section_header_style, default_header_style) {
		if (section_header_style !== undefined && section_header_style !== '') {
			mkd.body.removeClass('mkd-light-header mkd-dark-header').addClass('mkd-' + section_header_style + '-header');
		} else if (default_header_style !== '') {
			mkd.body.removeClass('mkd-light-header mkd-dark-header').addClass('mkd-' + default_header_style + '-header');
		} else {
			mkd.body.removeClass('mkd-light-header mkd-dark-header');
		}
	}
	
})(jQuery);
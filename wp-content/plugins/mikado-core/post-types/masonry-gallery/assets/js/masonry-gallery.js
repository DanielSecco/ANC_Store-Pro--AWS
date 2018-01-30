(function($) {
    'use strict';

    $(document).ready(function(){
	    mkdInitMasonryGallery();
    });
	
	/**
	 * Masonry gallery, init masonry and resize pictures in grid
	 */
	function mkdInitMasonryGallery(){
		var galleryHolder = $('.mkd-masonry-gallery-holder'),
			gallery = galleryHolder.children('.mkd-mg-inner'),
			gallerySizer = gallery.children('.mkd-mg-grid-sizer');
		
		resizeMasonryGallery(gallerySizer.outerWidth(), gallery);
		
		if(galleryHolder.length){
			galleryHolder.each(function(){
				var holder = $(this),
					holderGallery = holder.children('.mkd-mg-inner');
				
				holderGallery.waitForImages(function(){
					holderGallery.animate({opacity:1});
					
					holderGallery.isotope({
						layoutMode: 'packery',
						itemSelector: '.mkd-mg-item',
						percentPosition: true,
						packery: {
							gutter: '.mkd-mg-grid-gutter',
							columnWidth: '.mkd-mg-grid-sizer'
						}
					});
				});
			});
			
			$(window).resize(function(){
				resizeMasonryGallery(gallerySizer.outerWidth(), gallery);
				
				gallery.isotope('reloadItems');
			});
		}
	}
	
	function resizeMasonryGallery(size, holder){
		var rectangle_portrait = holder.find('.mkd-mg-rectangle-portrait'),
			rectangle_landscape = holder.find('.mkd-mg-rectangle-landscape'),
			square_big = holder.find('.mkd-mg-square-big'),
			square_small = holder.find('.mkd-mg-square-small');
		
		rectangle_portrait.css('height', 2*size);
		
		if (window.innerWidth <= 680) {
			rectangle_landscape.css('height', size/2);
		} else {
			rectangle_landscape.css('height', size);
		}
		
		square_big.css('height', 2*size);
		
		if (window.innerWidth <= 680) {
			square_big.css('height', square_big.width());
		}
		
		square_small.css('height', size);
	}

})(jQuery);
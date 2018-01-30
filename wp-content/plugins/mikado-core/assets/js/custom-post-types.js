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
(function($) {
    'use strict';

    var portfolio = {};
    mkd.modules.portfolio = portfolio;

    portfolio.mkdOnDocumentReady = mkdOnDocumentReady;
    portfolio.mkdOnWindowLoad = mkdOnWindowLoad;
    portfolio.mkdOnWindowResize = mkdOnWindowResize;
    portfolio.mkdOnWindowScroll = mkdOnWindowScroll;

    $(document).ready(mkdOnDocumentReady);
    $(window).load(mkdOnWindowLoad);
    $(window).resize(mkdOnWindowResize);
    $(window).scroll(mkdOnWindowScroll);
    
    /* 
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdOnDocumentReady() {
        mkdInitPortfolioSlider();
    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function mkdOnWindowLoad() {
        mkdInitPortfolioMasonry();
        mkdInitPortfolioFilter();
        initPortfolioSingleMasonry();
        mkdInitPortfolioListAnimation();
	    mkdInitPortfolioPagination().init();
        mkdPortfolioSingleFollow().init();
    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function mkdOnWindowResize() {
        mkdInitPortfolioMasonry();
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function mkdOnWindowScroll() {
	    mkdInitPortfolioPagination().scroll();
    }

    /**
     * Initializes portfolio list article animation
     */
    function mkdInitPortfolioListAnimation(){
        var portList = $('.mkd-portfolio-list-holder.mkd-pl-has-animation');

        if(portList.length){
            portList.each(function(){
                var thisPortList = $(this).children('.mkd-pl-inner'),
                	articles = thisPortList.find('article'),
                    rewindCalc = 0,
                    cycle = 0,
                    delay = 250,
                    yOffset = mkdGlobalVars.vars.mkdElementAppearAmount;

                articles.each(function() {
                    var article = $(this);

                    if (article.offset().top == articles.first().offset().top) { //find the number of articles in the same row
                        rewindCalc ++;
                    }

                    article.appear(function(){
                        if (cycle == rewindCalc) {
                            cycle = 0;
                        }

                        setTimeout(function(){
    		            	showItem(article);
                        }, cycle*delay);

                        cycle++;
                    }, {accX: 0, accY: yOffset});
                });
            });

			//show item function
			var showItem = function(article) {
				article.addClass('mkd-item-show');

				article.one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
				    article.addClass('mkd-item-shown');
				});
			}
        }
    }

    /**
     * Initializes portfolio list
     */
    function mkdInitPortfolioMasonry(){
        var portList = $('.mkd-portfolio-list-holder.mkd-pl-masonry');

        if(portList.length){
            portList.each(function(){
                var thisPortList = $(this),
                    masonry = thisPortList.children('.mkd-pl-inner'),
                    size = thisPortList.find('.mkd-pl-grid-sizer').width();
                
                mkdResizePortfolioItems(size, thisPortList);

                masonry.isotope({
                    layoutMode: 'packery',
                    itemSelector: 'article',
                    percentPosition: true,
                    packery: {
                        gutter: '.mkd-pl-grid-gutter',
                        columnWidth: '.mkd-pl-grid-sizer'
                    }
                });

                masonry.css('opacity', '1');
            });
        }
    }

    /**
     * Init Resize Blog Items
     */
    function mkdResizePortfolioItems(size,container){

        if(container.hasClass('mkd-pl-images-fixed')) {
            var padding = parseInt(container.find('article').css('padding-left')),
                defaultMasonryItem = container.find('.mkd-pl-masonry-default'),
                largeWidthMasonryItem = container.find('.mkd-pl-masonry-large-width'),
                largeHeightMasonryItem = container.find('.mkd-pl-masonry-large-height'),
                largeWidthHeightMasonryItem = container.find('.mkd-pl-masonry-large-width-height');

            if (mkd.windowWidth > 680) {
                defaultMasonryItem.css('height', size - 2 * padding);
                largeHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
                largeWidthHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
                largeWidthMasonryItem.css('height', size - 2 * padding);
            } else {
                defaultMasonryItem.css('height', size);
                largeHeightMasonryItem.css('height', size);
                largeWidthHeightMasonryItem.css('height', size);
                largeWidthMasonryItem.css('height', Math.round(size / 2));
            }
        }
    }

    /**
     * Initializes portfolio masonry filter
     */
    function mkdInitPortfolioFilter(){
        var filterHolder = $('.mkd-portfolio-list-holder .mkd-pl-filter-holder');

        if(filterHolder.length){
            filterHolder.each(function(){
                var thisFilterHolder = $(this),
                    thisPortListHolder = thisFilterHolder.closest('.mkd-portfolio-list-holder'),
                    thisPortListInner = thisPortListHolder.find('.mkd-pl-inner'),
                    portListHasLoadMore = thisPortListHolder.hasClass('mkd-pl-pag-load-more') ? true : false;

                thisFilterHolder.find('.mkd-pl-filter:first').addClass('mkd-pl-current');
	            
	            if(thisPortListHolder.hasClass('mkd-pl-gallery')) {
		            thisPortListInner.isotope();
	            }

                thisFilterHolder.find('.mkd-pl-filter').click(function(){
                    var thisFilter = $(this),
                        filterValue = thisFilter.attr('data-filter'),
                        filterClassName = filterValue.length ? filterValue.substring(1) : '',
                        portListHasArtciles = thisPortListInner.children().hasClass(filterClassName) ? true : false;

                    thisFilter.parent().children('.mkd-pl-filter').removeClass('mkd-pl-current');
                    thisFilter.addClass('mkd-pl-current');

                    if(portListHasLoadMore && !portListHasArtciles) {
                        mkdInitLoadMoreItemsPortfolioFilter(thisPortListHolder, filterValue, filterClassName);
                    } else {
                        thisFilterHolder.parent().children('.mkd-pl-inner').isotope({ filter: filterValue });
                    }
                });
            });
        }
    }

    /**
     * Initializes load more items if portfolio masonry filter item is empty
     */
    function mkdInitLoadMoreItemsPortfolioFilter($portfolioList, $filterValue, $filterClassName) {

        var thisPortList = $portfolioList,
            thisPortListInner = thisPortList.find('.mkd-pl-inner'),
            filterValue = $filterValue,
            filterClassName = $filterClassName,
            maxNumPages = 0;

        if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {
            maxNumPages = thisPortList.data('max-num-pages');
        }

        var	loadMoreDatta = mkd.modules.common.getLoadMoreData(thisPortList),
            nextPage = loadMoreDatta.nextPage,
	        ajaxData = mkd.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'mkd_core_portfolio_ajax_load_more'),
            loadingItem = thisPortList.find('.mkd-pl-loading');

        if(nextPage <= maxNumPages) {
            loadingItem.addClass('mkd-showing mkd-filter-trigger');
            thisPortListInner.css('opacity', '0');

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: MikadoAjaxUrl,
                success: function (data) {
                    nextPage++;
                    thisPortList.data('next-page', nextPage);
                    var response = $.parseJSON(data),
                        responseHtml = response.html;

                    thisPortList.waitForImages(function () {
                        thisPortListInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
                        var portListHasArtciles = thisPortListInner.children().hasClass(filterClassName) ? true : false;

                        if(portListHasArtciles) {
                            setTimeout(function() {
                                mkdResizePortfolioItems(thisPortListInner.find('.mkd-pl-grid-sizer').width(), thisPortList);
                                thisPortListInner.isotope('layout').isotope({filter: filterValue});
                                loadingItem.removeClass('mkd-showing mkd-filter-trigger');

                                setTimeout(function() {
                                    thisPortListInner.css('opacity', '1');
                                }, 150);
                            }, 400);
                        } else {
                            loadingItem.removeClass('mkd-showing mkd-filter-trigger');
                            mkdInitLoadMoreItemsPortfolioFilter(thisPortList, filterValue, filterClassName);
                        }
                    });
                }
            });
        }
    }
	
	/**
	 * Initializes portfolio pagination functions
	 */
	function mkdInitPortfolioPagination(){
		var portList = $('.mkd-portfolio-list-holder');
		
		var initStandardPagination = function(thisPortList) {
			var standardLink = thisPortList.find('.mkd-pl-standard-pagination li');
			
			if(standardLink.length) {
				standardLink.each(function(){
					var thisLink = $(this).children('a'),
						pagedLink = 1;
					
					thisLink.on('click', function(e) {
						e.preventDefault();
						e.stopPropagation();
						
						if (typeof thisLink.data('paged') !== 'undefined' && thisLink.data('paged') !== false) {
							pagedLink = thisLink.data('paged');
						}
						
						initMainPagFunctionality(thisPortList, pagedLink);
					});
				});
			}
		};
		
		var initLoadMorePagination = function(thisPortList) {
			var loadMoreButton = thisPortList.find('.mkd-pl-load-more a');
			
			loadMoreButton.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				
				initMainPagFunctionality(thisPortList);
			});
		};
		
		var initInifiteScrollPagination = function(thisPortList) {
			var portListHeight = thisPortList.outerHeight(),
				portListTopOffest = thisPortList.offset().top,
				portListPosition = portListHeight + portListTopOffest - mkdGlobalVars.vars.mkdAddForAdminBar;
			
			if(!thisPortList.hasClass('mkd-pl-infinite-scroll-started') && mkd.scroll + mkd.windowHeight > portListPosition) {
				initMainPagFunctionality(thisPortList);
			}
		};
		
		var initMainPagFunctionality = function(thisPortList, pagedLink) {
			var thisPortListInner = thisPortList.find('.mkd-pl-inner'),
				nextPage,
				maxNumPages;
			
			if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {
				maxNumPages = thisPortList.data('max-num-pages');
			}
			
			if(thisPortList.hasClass('mkd-pl-pag-standard')) {
				thisPortList.data('next-page', pagedLink);
			}
			
			if(thisPortList.hasClass('mkd-pl-pag-infinite-scroll')) {
				thisPortList.addClass('mkd-pl-infinite-scroll-started');
			}
			
			var loadMoreDatta = mkd.modules.common.getLoadMoreData(thisPortList),
				loadingItem = thisPortList.find('.mkd-pl-loading');
			
			nextPage = loadMoreDatta.nextPage;
			
			if(nextPage <= maxNumPages){
				if(thisPortList.hasClass('mkd-pl-pag-standard')) {
					loadingItem.addClass('mkd-showing mkd-standard-pag-trigger');
					thisPortList.addClass('mkd-pl-pag-standard-animate');
				} else {
					loadingItem.addClass('mkd-showing');
				}
				
				var ajaxData = mkd.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'mkd_core_portfolio_ajax_load_more');
				
				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: MikadoAjaxUrl,
					success: function (data) {
						if(!thisPortList.hasClass('mkd-pl-pag-standard')) {
							nextPage++;
						}
						
						thisPortList.data('next-page', nextPage);
						
						var response = $.parseJSON(data),
							responseHtml =  response.html;
						
						if(thisPortList.hasClass('mkd-pl-pag-standard')) {
							mkdInitStandardPaginationLinkChanges(thisPortList, maxNumPages, nextPage);
							
							thisPortList.waitForImages(function(){
								if(thisPortList.hasClass('mkd-pl-masonry')){
                                    mkdResizePortfolioItems(thisPortListInner.find('.mkd-pl-grid-sizer').width(), thisPortList);
									mkdInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else if (thisPortList.hasClass('mkd-pl-gallery') && thisPortList.hasClass('mkd-pl-has-filter')) {
									mkdInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else {
									mkdInitHtmlGalleryNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								}
							});
						} else {
							thisPortList.waitForImages(function(){
								if(thisPortList.hasClass('mkd-pl-masonry')){
									mkdInitAppendIsotopeNewContent(thisPortListInner, loadingItem, responseHtml);
								} else if (thisPortList.hasClass('mkd-pl-gallery') && thisPortList.hasClass('mkd-pl-has-filter')) {
									mkdInitAppendIsotopeNewContent(thisPortListInner, loadingItem, responseHtml);
								} else {
									mkdInitAppendGalleryNewContent(thisPortListInner, loadingItem, responseHtml);
								}
							});
						}
						
						if(thisPortList.hasClass('mkd-pl-infinite-scroll-started')) {
							thisPortList.removeClass('mkd-pl-infinite-scroll-started');
						}
					}
				});
			}
			
			if(nextPage === maxNumPages){
				thisPortList.find('.mkd-pl-load-more-holder').hide();
			}
		};
		
		var mkdInitStandardPaginationLinkChanges = function(thisPortList, maxNumPages, nextPage) {
			var standardPagHolder = thisPortList.find('.mkd-pl-standard-pagination'),
				standardPagNumericItem = standardPagHolder.find('li.mkd-pl-pag-number'),
				standardPagPrevItem = standardPagHolder.find('li.mkd-pl-pag-prev a'),
				standardPagNextItem = standardPagHolder.find('li.mkd-pl-pag-next a');
			
			standardPagNumericItem.removeClass('mkd-pl-pag-active');
			standardPagNumericItem.eq(nextPage-1).addClass('mkd-pl-pag-active');
			
			standardPagPrevItem.data('paged', nextPage-1);
			standardPagNextItem.data('paged', nextPage+1);
			
			if(nextPage > 1) {
				standardPagPrevItem.css({'opacity': '1'});
			} else {
				standardPagPrevItem.css({'opacity': '0'});
			}
			
			if(nextPage === maxNumPages) {
				standardPagNextItem.css({'opacity': '0'});
			} else {
				standardPagNextItem.css({'opacity': '1'});
			}
		};
		
		var mkdInitHtmlIsotopeNewContent = function(thisPortList, thisPortListInner, loadingItem, responseHtml) {
			thisPortListInner.html(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('mkd-showing mkd-standard-pag-trigger');
			thisPortList.removeClass('mkd-pl-pag-standard-animate');
			
			setTimeout(function() {
				thisPortListInner.isotope('layout');
				mkdInitPortfolioListAnimation();
			}, 400);
		};
		
		var mkdInitHtmlGalleryNewContent = function(thisPortList, thisPortListInner, loadingItem, responseHtml) {
			loadingItem.removeClass('mkd-showing mkd-standard-pag-trigger');
			thisPortList.removeClass('mkd-pl-pag-standard-animate');
			thisPortListInner.html(responseHtml);
			mkdInitPortfolioListAnimation();
		};
		
		var mkdInitAppendIsotopeNewContent = function(thisPortListInner, loadingItem, responseHtml) {
			thisPortListInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('mkd-showing');
			
			setTimeout(function() {
				thisPortListInner.isotope('layout');
				mkdInitPortfolioListAnimation();
			}, 400);
		};
		
		var mkdInitAppendGalleryNewContent = function(thisPortListInner, loadingItem, responseHtml) {
			loadingItem.removeClass('mkd-showing');
			thisPortListInner.append(responseHtml);
			mkdInitPortfolioListAnimation();
		};
		
		return {
			init: function() {
				if(portList.length) {
					portList.each(function() {
						var thisPortList = $(this);
						
						if(thisPortList.hasClass('mkd-pl-pag-standard')) {
							initStandardPagination(thisPortList);
						}
						
						if(thisPortList.hasClass('mkd-pl-pag-load-more')) {
							initLoadMorePagination(thisPortList);
						}
						
						if(thisPortList.hasClass('mkd-pl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisPortList);
						}
					});
				}
			},
			scroll: function() {
				if(portList.length) {
					portList.each(function() {
						var thisPortList = $(this);
						
						if(thisPortList.hasClass('mkd-pl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisPortList);
						}
					});
				}
			}
		};
	}

    /**
     * Initializes portfolio slider
     */
    function mkdInitPortfolioSlider(){
        var portSlider = $('.mkd-portfolio-slider-holder');
	
	    if(portSlider.length) {
		    portSlider.each(function () {
			    var thisPortSlider = $(this),
				    portHolder = thisPortSlider.children('.mkd-portfolio-list-holder'),
				    portSlider = portHolder.children('.mkd-pl-inner'),
				    numberOfItems = 4,
				    margin = 0,
				    marginLabel,
				    sliderSpeed = 5000,
				    loop = true,
				    padding = false,
				    navigation = true,
				    pagination = true;
			
			    if (typeof portHolder.data('number-of-columns') !== 'undefined' && portHolder.data('number-of-columns') !== false) {
				    numberOfItems = portHolder.data('number-of-columns');
			    }
			
			    if (typeof portHolder.data('space-between-items') !== 'undefined' && portHolder.data('space-between-items') !== false) {
				    marginLabel = portHolder.data('space-between-items');
				
				    if (marginLabel === 'normal') {
                        margin = 30;
                    } else if (marginLabel === 'small') {
					    margin = 20;
				    } else if (marginLabel === 'tiny') {
                        margin = 10;
                    } else {
					    margin = 0;
				    }
			    }
			
			    if (typeof portHolder.data('slider-speed') !== 'undefined' && portHolder.data('slider-speed') !== false) {
				    sliderSpeed = portHolder.data('slider-speed');
			    }
			    if (typeof portHolder.data('enable-loop') !== 'undefined' && portHolder.data('enable-loop') !== false && portHolder.data('enable-loop') === 'no') {
				    loop = false;
			    }
			    if (typeof portHolder.data('enable-padding') !== 'undefined' && portHolder.data('enable-padding') !== false && portHolder.data('enable-padding') === 'yes') {
				    padding = true;
			    }
			    if (typeof portHolder.data('enable-navigation') !== 'undefined' && portHolder.data('enable-navigation') !== false && portHolder.data('enable-navigation') === 'no') {
				    navigation = false;
			    }
			    if (typeof portHolder.data('enable-pagination') !== 'undefined' && portHolder.data('enable-pagination') !== false && portHolder.data('enable-pagination') === 'no') {
				    pagination = false;
			    }
			
			    var responsiveNumberOfItems1 = 1,
				    responsiveNumberOfItems2 = 2,
				    responsiveNumberOfItems3 = 3;
			
			    if (numberOfItems < 3) {
				    responsiveNumberOfItems1 = numberOfItems;
				    responsiveNumberOfItems2 = numberOfItems;
				    responsiveNumberOfItems3 = numberOfItems;
			    }
			
			    portSlider.owlCarousel({
				    items: numberOfItems,
				    margin: margin,
				    loop: loop,
				    autoplay: true,
				    autoplayTimeout: sliderSpeed,
				    autoplayHoverPause: true,
				    smartSpeed: 800,
				    nav: navigation,
				    navText: [
					    '<span class="mkd-prev-icon"><span class="mkd-icon-arrow icon-arrows-left"></span></span>',
					    '<span class="mkd-next-icon"><span class="mkd-icon-arrow icon-arrows-right"></span></span>'
				    ],
				    dots: pagination,
				    responsive: {
					    0: {
						    items: responsiveNumberOfItems1,
						    stagePadding: 0
					    },
					    600: {
						    items: responsiveNumberOfItems2
					    },
					    768: {
						    items: responsiveNumberOfItems3
					    },
					    1024: {
						    items: numberOfItems
					    }
				    }
			    });
			
			    thisPortSlider.css('opacity', '1');
		    });
	    }
    }

    var mkdPortfolioSingleFollow = function() {

        var info = $('.mkd-follow-portfolio-info .mkd-portfolio-single-holder .mkd-ps-info-sticky-holder');

        if (info.length) {
            var infoHolderOffset = info.offset().top,
                infoHolderHeight = info.height(),
                mediaHolder = $('.mkd-ps-image-holder'),
                mediaHolderHeight = mediaHolder.height(),
                header = $('.header-appear, .mkd-fixed-wrapper'),
                headerHeight = (header.length) ? header.height() : 0;
        }

        var infoHolderPosition = function() {

            if(info.length) {

                if (mediaHolderHeight > infoHolderHeight) {
                    if(mkd.scroll > infoHolderOffset) {
                        var marginTop = mkd.scroll + headerHeight + mkdGlobalVars.vars.mkdAddForAdminBar - infoHolderOffset;
                        // if scroll is initially positioned below mediaHolderHeight
                        if(marginTop + infoHolderHeight > mediaHolderHeight){
                            marginTop = mediaHolderHeight - infoHolderHeight;
                        }
                        info.animate({
                            marginTop: marginTop
                        });
                    }
                }
            }
        };

        var recalculateInfoHolderPosition = function() {

            if (info.length) {
                if(mediaHolderHeight > infoHolderHeight) {
                    if(mkd.scroll > infoHolderOffset) {
                    	
                        if(mkd.scroll + headerHeight + infoHolderHeight <  mediaHolderHeight) {
                            //Calculate header height if header appears
                            if ($('.header-appear, .mkd-fixed-wrapper').length) {
                                headerHeight = $('.header-appear, .mkd-fixed-wrapper').height();
                            }
                            info.stop().animate({
                                marginTop: (mkd.scroll + headerHeight + mkdGlobalVars.vars.mkdAddForAdminBar - infoHolderOffset)
                            });
                            //Reset header height
                            headerHeight = 0;
                        } else{
                            info.stop().animate({
                            	marginTop: mediaHolderHeight - infoHolderHeight
                            });
                        }
                    } else {
                        info.stop().animate({
                            marginTop: 0
                        });
                    }
                }
            }
        };

        return {
            init : function() {
                infoHolderPosition();
                $(window).scroll(function(){
                    recalculateInfoHolderPosition();
                });
            }
        };
    };
	
	function initPortfolioSingleMasonry(){
		var masonryHolder = $('.mkd-portfolio-single-holder .mkd-ps-masonry-images'),
			masonry = masonryHolder.children();
		
		if(masonry.length){
            masonry.isotope({
                layoutMode: 'packery',
                itemSelector: '.mkd-ps-image',
                percentPosition: true,
                packery: {
                    gutter: '.mkd-ps-grid-gutter',
                    columnWidth: '.mkd-ps-grid-sizer'
                }
            });

            masonry.css('opacity', '1');
		}
	}

})(jQuery);
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
(function($) {
    'use strict';

    $(document).ready(function(){
	    mkdInitTestimonials();
    });

	/**
	 * Init testimonials shortcode
	 */
	function mkdInitTestimonials(){
		var testimonialsHolder = $('.mkd-testimonials-holder');

		if(testimonialsHolder.length){
			testimonialsHolder.each(function(){
				var thisTestimonials = $(this),
					testimonials = thisTestimonials.children('.mkd-testimonials'),
					numberOfItems = 3,
					loop = true,
					autoplay = true,
					number = 0,
					speed = 5000,
					animationSpeed = 600,
					navArrows = true,
					navDots = true,
					margin = 26;

				if (typeof testimonials.data('number') !== 'undefined' && testimonials.data('number') !== false) {
					number = parseInt(testimonials.data('number'));
				}

				if (typeof testimonials.data('number-visible') !== 'undefined' && testimonials.data('number-visible') !== false) {
					numberOfItems = parseInt(testimonials.data('number-visible'));
				}

				if (typeof testimonials.data('speed') !== 'undefined' && testimonials.data('speed') !== false) {
					speed = testimonials.data('speed');
				}

				if (typeof testimonials.data('animation-speed') !== 'undefined' && testimonials.data('animation-speed') !== false) {
					animationSpeed = testimonials.data('animation-speed');
				}

				if (typeof testimonials.data('nav-arrows') !== 'undefined' && testimonials.data('nav-arrows') !== false && testimonials.data('nav-arrows') === 'no') {
					navArrows = false;
				}

				if (typeof testimonials.data('nav-dots') !== 'undefined' && testimonials.data('nav-dots') !== false && testimonials.data('nav-dots') === 'no') {
					navDots = false;
				}

				if(number === 1) {
					loop = false;
					autoplay = false;
					navArrows = false;
					navDots = false;
				}

                var responsiveNumberOfItems1 = 1,
                    responsiveNumberOfItems2 = 2;

                if (numberOfItems < 3) {
                    responsiveNumberOfItems1 = numberOfItems;
                    responsiveNumberOfItems2 = numberOfItems;
                }

				testimonials.owlCarousel({
					items: numberOfItems,
					loop: loop,
					autoplay: autoplay,
					autoplayTimeout: speed,
					smartSpeed: animationSpeed,
					margin: margin,
					nav: navArrows,
					dots: navDots,
                    responsive: {
						0: {
                            items: responsiveNumberOfItems1,
                            margin: 0,
                            center: false,
                            autoWidth: false
                        },
                        769: {
                            items: responsiveNumberOfItems2
                        },
                        1025: {
                            items: numberOfItems
                        }
                    },
					navText: [
						'<span class="mkd-prev-icon"><span class="mkd-icon-linear-icon lnr lnr-arrow-left"></span></span>',
						'<span class="mkd-next-icon"><span class="mkd-icon-linear-icon lnr lnr-arrow-right"></span></span>'
					]
				});
				thisTestimonials.css({'visibility': 'visible'});
			});
		}
	}

})(jQuery);
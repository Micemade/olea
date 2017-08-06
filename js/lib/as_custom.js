jQuery.noConflict();
(function( $ ) {
"use strict";

if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
	window.isMobile = true;
}

/*
 * hoverIntent r7 // 2013.03.11 // jQuery 1.9.1+
 * http://cherne.net/brian/resources/jquery.hoverIntent.html
 *
 * You may use hoverIntent under the terms of the MIT license. Basically that
 * means you are free to use hoverIntent as long as this header is left intact.
 * Copyright 2007, 2013 Brian Cherne
 */

/* hoverIntent is similar to jQuery's built-in "hover" method except that
 * instead of firing the handlerIn function immediately, hoverIntent checks
 * to see if the user's mouse has slowed down (beneath the sensitivity
 * threshold) before firing the event. The handlerOut function is only
 * called after a matching handlerIn.
 *
 * // basic usage ... just like .hover()
 * .hoverIntent( handlerIn, handlerOut )
 * .hoverIntent( handlerInOut )
 *
 * // basic usage ... with event delegation!
 * .hoverIntent( handlerIn, handlerOut, selector )
 * .hoverIntent( handlerInOut, selector )
 *
 * // using a basic configuration object
 * .hoverIntent( config )
 *
 * @param  handlerIn   function OR configuration object
 * @param  handlerOut  function OR selector for delegation OR undefined
 * @param  selector    selector OR undefined
 * @author Brian Cherne <brian(at)cherne(dot)net>
 */

(function($) {

	$.fn.hoverIntent = function(handlerIn,handlerOut,selector) {

        // default configuration values
        var cfg = {
            interval: 100,
            sensitivity: 7,
            timeout: 0
        };

        if ( typeof handlerIn === "object" ) {
            cfg = $.extend(cfg, handlerIn );
        } else if ($.isFunction(handlerOut)) {
            cfg = $.extend(cfg, { over: handlerIn, out: handlerOut, selector: selector } );
        } else {
            cfg = $.extend(cfg, { over: handlerIn, out: handlerIn, selector: handlerOut } );
        }

        // instantiate variables
        // cX, cY = current X and Y position of mouse, updated by mousemove event
        // pX, pY = previous X and Y position of mouse, set by mouseover and polling interval
        var cX, cY, pX, pY;

        // A private function for getting mouse position
        var track = function(ev) {
            cX = ev.pageX;
            cY = ev.pageY;
        };

        // A private function for comparing current and previous mouse position
        var compare = function(ev,ob) {
            ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t);
            // compare mouse positions to see if they've crossed the threshold
            if ( ( Math.abs(pX-cX) + Math.abs(pY-cY) ) < cfg.sensitivity ) {
                $(ob).off("mousemove.hoverIntent",track);
                // set hoverIntent state to true (so mouseOut can be called)
                ob.hoverIntent_s = 1;
                return cfg.over.apply(ob,[ev]);
            } else {
                // set previous coordinates for next time
                pX = cX; pY = cY;
                // use self-calling timeout, guarantees intervals are spaced out properly (avoids JavaScript timer bugs)
                ob.hoverIntent_t = setTimeout( function(){compare(ev, ob);} , cfg.interval );
            }
        };

        // A private function for delaying the mouseOut function
        var delay = function(ev,ob) {
            ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t);
            ob.hoverIntent_s = 0;
            return cfg.out.apply(ob,[ev]);
        };

        // A private function for handling mouse 'hovering'
        var handleHover = function(e) {
            // copy objects to be passed into t (required for event object to be passed in IE)
            var ev = jQuery.extend({},e);
            var ob = this;

            // cancel hoverIntent timer if it exists
            if (ob.hoverIntent_t) { ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t); }

            // if e.type == "mouseenter"
            if (e.type === "mouseenter") {
                // set "previous" X and Y position based on initial entry point
                pX = ev.pageX; pY = ev.pageY;
                // update "current" X and Y position based on mousemove
                $(ob).on("mousemove.hoverIntent",track);
                // start polling interval (self-calling timeout) to compare mouse coordinates over time
                if (ob.hoverIntent_s !== 1) { ob.hoverIntent_t = setTimeout( function(){compare(ev,ob);} , cfg.interval );}

                // else e.type == "mouseleave"
            } else {
                // unbind expensive mousemove event
                $(ob).off("mousemove.hoverIntent",track);
                // if hoverIntent state is true, then call the mouseOut function after the specified delay
                if (ob.hoverIntent_s === 1) { ob.hoverIntent_t = setTimeout( function(){delay(ev,ob);} , cfg.timeout );}
            }
        };

        // listen for mouseenter and mouseleave
        return this.on({'mouseenter.hoverIntent':handleHover,'mouseleave.hoverIntent':handleHover}, cfg.selector);
    };
})(jQuery);

/**
 *	CUSTOM AS PLUGIN as_Hover: Site-wide buttons, images, over effect
 *
 */
(function( $ ){
	$.fn.as_Hover = function() {

	return this.each(function() {

		var whichEase = 'easeOutQuad';
		var time = 500;

		var imgHover	= $(this).find('.back');
		var ua		= navigator.userAgent,
			isIE9	= /MSIE 9.0/.test(ua); //  is Internet Explorer 9


		if( !$('html').hasClass('csstransforms') || isIE9 ) {

			$( imgHover ).hover(
				function () {
					$(this).stop().animate( {'opacity':1 },{duration: time} );
				},
				function () {
					$(this).stop().animate( {'opacity':0 },{duration: time} );
				}
			);

		}

	});
  };//end $.fn.as_Hover = function()
})( jQuery );
//

/**
 * CUSTOM AS PLUGIN: hasAnyClass
 *
 */
(function( $ ){
	$.fn.hasAnyClass = function() {
		for (var i = 0; i < arguments.length; i++) {
			var classes = arguments[i].split(" ");
			for (var j = 0; j < classes.length; j++) {
				if (this.hasClass(classes[j])) {
					return true;
				}
			}
		}
		return false;
	};
})( jQuery );
//
/**
 * CUSTOM AS PLUGIN: equalizeHeights
 *
 */
(function( $ ){
	$.fn.equalizeHeights = function() {

	  var maxHeight = this.map(function(i,e) {
		return $(e).height();
	  }).get();

	  return this.height( Math.max.apply(this, maxHeight) );
	};
})( jQuery );


/**
 *	CUSTOM AS PLUGIN: eqHeights
 *
 */
(function( $ ) {
$.fn.extend({
equalHeights: function(){
    var top=0;
    var classname=('equalHeights'+Math.random()).replace('.','');
    $(this).each(function(){
      if ($(this).is(':visible')){
        var thistop=$(this).offset().top;
        if (thistop>top) {
            $('.'+classname).removeClass(classname);
            top=thistop;
        }
        $(this).addClass(classname);
        $(this).height('auto');
        var h=(Math.max.apply(null, $('.'+classname).map(function(){ return $(this).outerHeight(); }).get()));
        $('.'+classname).height(h);
      }
    }).removeClass(classname);
}

});
})( jQuery );
//
//
//
//
/*********************************************************
 *	AS FUNCTION AND PLUGIN CALLS
 *
 *	small jQuery code snippets.
 *
 ********************************************************/
$(document).ready(function() {

	/***************************************
	 *
	 *	DO THE FOUNDATION SCRIPTS:
	 *
	 *************************************/
	$(document).foundation();


	if( window.isMobile ) { $('body, #site-menu.vertical, .mega-clone').css('overflow','auto'); }

	// SMALL HELPER FUNCTIONS - used for SIMPLE STICKY HEADER:
	function getPageScroll() {
		var xScroll, yScroll;
		if (self.pageYOffset) {
			yScroll = self.pageYOffset;
			xScroll = self.pageXOffset;
		} else if (document.documentElement && document.documentElement.scrollTop) {
			yScroll = document.documentElement.scrollTop;
			xScroll = document.documentElement.scrollLeft;
		} else if (document.body) {// all other Explorers
			yScroll = document.body.scrollTop;
			xScroll = document.body.scrollLeft;
		}
		return new Array(xScroll,yScroll);
	}
	// Adapted from getPageSize() by quirksmode.com
	function getPageHeight() {
		var windowHeight;
		if (self.innerHeight) { // all except Explorer
			windowHeight = self.innerHeight;
		} else if (document.documentElement && document.documentElement.clientHeight) {
			windowHeight = document.documentElement.clientHeight;
		} else if (document.body) { // other Explorers
			windowHeight = document.body.clientHeight;
		}
		return windowHeight;
	}

/**
 *	INTERNET EXPLORERS "SNIFFER":
 *
 */
	var ua = navigator.userAgent;
	var	isIE11	= ua.match(/Trident\/7\./); //  is Internet Explorer 11
	var	isIE10	= /MSIE 10.0/.test(ua); //  is Internet Explorer 10
	var	isIE9	= /MSIE 9.0/.test(ua); //  is Internet Explorer 9
	var	isMobWebkit = /WebKit/.test(ua) && /Mobile/.test(ua); //  is iPad / iPhone

	if( isIE9 ) {
		$('html').addClass('ie9');
	}else if( isIE10 ) {
		$('html').addClass('ie10');
	}else if( isIE11 ) {
		$('html').addClass('ie11');
	}


/**
 *	REMOVE CLASS TO ANIM FOR MOBILE DEVICES
 * 	no viewport entering animation
 *
 */
	if( window.isMobile ) {
		$('.to-anim').removeClass('to-anim');

	}


/**
 *	REMOVE EMPTY <P> TAGS FROM CONTENT .
 *
 */
	$('p').filter(function() {

		return $.trim($(this).text()) === '' && $(this).children().length === 0;

	})
	.remove();


/**
 *	MENUS (main, secondary, and block categories menus)
 *
 */


	$('.product-categories, .widget_nav_menu ul').superfish({
		autoArrows		: false,
		animation		: { opacity:'show', height:'show' },
		cssArrows		: false,
		delay			: 0
	});

/**
 *	TOGGLING MENUS (TAXONOMIES AND MOBILE MENU)
 *
 */
	$('.tax-toggle-dropdown').hide();
	$('.menu-toggler a').click(function(e) {
		e.preventDefault();

		var main = $(this).parent().parent();

		main.find('.mobile-dropdown, .tax-toggle-dropdown, #secondary-nav').slideToggle('medium', function() {});

		return false;

	});

	$('.mobile-dropdown').find('.navigation > li.menu-item-has-children').hover(function(e) {

		e.preventDefault();

		$(this).find('> .sub-menu').slideToggle();
	});



/**
 *	PRODUCT FILTERS WIDGET TOGGLE.
 *
 */
	var prod_filters = false;
	$('.product-filters-title, .product-filters .icon').click(function() {

		var filters		= $(this).parent().find('.product-filters');
		if( $(this).hasClass('icon') ) {
			filters		= $(this).parent().parent().find('.product-filters');
		}

		if ( prod_filters === false ) {

			filters.slideDown( 300, 'easeInOutQuart', function() {
				prod_filters = true;
				$('.product-filters .icon').fadeIn(300);

			} );

		}else{

			$('.product-filters .icon').fadeOut(300);

			filters.slideUp( 300, 'easeInOutQuart', function() {
				prod_filters = false;

			} );

		}

	});

/**
 *	MINICART TOGGLE.
 *
 */
	var minicart_active = false;
	$(document).on('click','#site-menu .olea-head-cart, #site-menu-mobile .olea-head-cart', function(e) {

		if( !$(this).hasClass('mini-cart-toggle') )
			return;

		e.preventDefault();

		var vertParent	= $(this).parent().parent().parent(),
			minicart	= $(this).parent().find('.mini-cart-list'),
			minicartPos	= $(this).find('.count').position().left - minicart.width()/2;

		// MINI CART GOES OUTSIDE WIINDOW
		var horizFix	= 0;
		var cartHPos	= minicart.offset().left + minicart.outerWidth(true),
			docWidth	= $(document).width();
		if( cartHPos >= docWidth ){
			horizFix	=  cartHPos - docWidth;
		}


		// IF VERTICAL HEADER ( Side Menu )
		if( vertParent.hasClass('vertical') || vertParent.hasClass('mobile-sticky')  ) {
			minicart.css('left', 0 );
		}else{
			minicart.css('left', minicartPos - horizFix );
		}

		if ( minicart_active === false ) {

			minicart.slideDown( 300, 'easeInOutQuart', function() {

				minicart_active = true;

				var minicartEl		= $(this),
					minicartOffTop	= minicartEl.offset().top - $(window).scrollTop(),
					minicartHeight	= minicartEl.height(),
					minicartBottom 	= minicartOffTop + minicartHeight,
					adminbar		= $('#wpadminbar').height();

				if( minicartBottom > $(window).height() ) {

					minicartEl.height( $(window).height() - minicartOffTop - adminbar - 10  );

					minicartEl.css( "overflow", "auto" );

				}

			});

		}else{

			minicart.slideUp( 300, 'easeInOutQuart', function() {
				minicart_active = false;

			} );
		}

	});
	$(document).on('mouseleave', '.wrap-mini-cart, .wrap-mini-cart-mobile',
		function () {
			if( minicart_active === true) {
				$('.mini-cart-list').delay(300).slideUp( 300, 'easeInOutQuart', function() {
					minicart_active = false;
					$(this).width( 220 );
				} );
			}
		}
	);
/** end minicart toggle */

/**
 *	ADD BUTTON CLASS TO:
 */
	$('#comments').find('input#submit').addClass('button');
	$('ul.page-numbers').find('a.page-numbers, span.page-numbers').addClass('button');
	$('.page-link').find('span').addClass('button');
	$('.tagcloud').find('a').addClass('button');
	$('input[type="submit"], input[type="reset"], input[type="button"]').addClass('button');

	$('.btn').addClass('button');
	$('.clear-all').addClass('button');


/**
 *	EQUALIZE BLOCKS IN SELECTED ROW BLOCK
 *
 *	in Page builder edit page - row block settings check the "Equalize inner blocks heights"
 */


	$(window).resize(function() {
        $('.eq_heights .row').each(function() {
			$(this).find('.inner-wrapper').equalizeHeights();
		});
    }).trigger('resize');

/**
 *	POST META and NAV TOGGLER:
 *
 */

	$('.post-meta-bottom .date_meta, .post-meta-bottom .user_meta, .post-meta-bottom .permalink, .post-meta-bottom .cat_meta ,.post-meta-bottom .tag_meta, .post-meta-bottom .comments_meta, .nav-single a, .wishlist-compare > div').hover(function() {

			var parent = $(this).parent();
			var hoverBox = $(this).find('.hover-box');
			var leftPos = - ( hoverBox.outerWidth(true)/2 - $(this).outerWidth(true)/2 );

			if( $(this).hasClass('left') || parent.hasClass('left') ) {
				hoverBox.css('left', 30);
			}else if( $(this).hasClass('right') || parent.hasClass('right') ) {
				hoverBox.css('left', 'auto').css('right', 30);
			}else{
				hoverBox.css('left', leftPos);
			}

			hoverBox.fadeToggle(400);
		},
		function () {
			var hoverBox = $(this).find('.hover-box');

			hoverBox.fadeToggle(150);
		}

	);
	/** END POST META*/


/**
 *	SIDEBAR WIDGETS - if full page AND
 *
 */
	var numW = 0;
	$('#secondary > .widget').each(function() {
		if ( numW === 0 || numW - 3 === 0 ) {
			$(this).addClass("first");
			numW = 0;
        }
		numW++;
	});

/**
 *	FOOTER WIDGETS - add scaffolding css depending on widgets number
 *
 */
	var footerWidgets = $('#footerwidgets').find('.row').children();
	var fwNum = footerWidgets.length;
	footerWidgets.each(function() {
		$(this).addClass('large-'+ (Math.floor(12/fwNum))).addClass('small-12').addClass('column');
	});

/**
 *	HEADER IMAGES FIXES:
 *
 */

	if( window.isMobile ) {
		$('.header-background').addClass('no-cover-ipad');
	}

	function headerImgTop() {

		var imgHeader		= $('.horizontal').find('.header-background');

		if( !imgHeader.hasClass('under-head') )
			return;

		var siteHeaderHeight= $('#site-menu.horizontal').outerHeight(true),
			imgHeadHeight	= $('.page-header, .archive-header').outerHeight(true);

		if ( $.browser.mozilla ) {
			imgHeader.css( 'top', - siteHeaderHeight ).css('height', siteHeaderHeight + imgHeadHeight );

		}else{
			imgHeader.css( 'margin-top', - siteHeaderHeight ).css('height', siteHeaderHeight + imgHeadHeight );
		}

	}
	headerImgTop();


	function pageUnderHead() {

		var page		= $('.horizontal-layout').find('#page'),
			pageTitle	= $('.titles-holder');

		if( !page.hasClass('page-under-head') )
			return;

		var siteHeaderHeight= $('#site-menu.horizontal').outerHeight(true);

		page.css( 'top', - siteHeaderHeight );
		page.css( 'margin-bottom',  -siteHeaderHeight );
		pageTitle.css( 'margin-top',  siteHeaderHeight );

	}
	pageUnderHead();



	$(window).resize(function() {
		headerImgTop();
		pageUnderHead();
	});


/**
 *	SOCIAL INFO
 *
 */

	$('.topbar-info-item').hover(function() {
		if( $(this).find('.icon').hasClass('toggle') ) {
			$(this).find('.title').stop().show( "blind" );

		}
	},function() {
		if( $(this).find('.icon').hasClass('toggle') ) {
			$(this).find('.title').stop().hide( "blind" );

		}
	});


	var topbar_active = false;
	$('.topbar-toggle').click(function() {



		var $this = $(this);

		if( !topbar_active ) {

			$this.prev().stop().slideDown( 300, function() {

				headerImgTop();
				pageUnderHead();

				$this.css('transform','rotate(180deg)');
				topbar_active = true;
			});

		}else{
			$this.prev().stop().slideUp( 300, function (){
				$this.css('transform','rotate(0deg)');
				topbar_active = false;
			});
		}

	});


/**
 *	BEGIN ON WINDOW LOAD
 *
 */

	$(window).load(function(){

/**
 *	AQUA PAGE BUILDER
 *
 */
		/* CONVERT AQUA GRID  TO FOUNDATION GRID */

		$('.aq-block').each(function() {
			var gridSuf = 0;
			for ( var i=1; i<=12; i++ ) {

				if ( $(this).hasClass('aq_span'+i) ) {
					$(this).removeClass('aq_span'+i).addClass('large-'+i+' medium-'+i+' small-12 column');
				}

			}

			if( $(this).parent().hasClass('aq-block-aq_column_block') ) {

				var elm = $(this);
				var regEx = /^grid-/;
				var classes = elm.attr('class').split(/\s+/); //it will return  span1, span2, span3, span4

				for ( i = 0; i < classes.length; i++) {
				  var className = classes[i];

				  if (className.match(regEx)) {
					elm.removeClass(className);
				  }
				}

				elm.addClass('grid-100');

			}
		});

		$('.block-recent').each(function() {

			if( $(this).find('.more-block').length ) {
				$(this).css('margin-bottom', 120);
			}
		});

/** end AQUA PAGE BUILDER */



/**
 *	ANIMATE ELEMENTS ON HOVER ETC.
 *
 */

	$('.item').as_Hover();
	/*
	$('.item').bind('touchstart', function(e) {

		e.stopPropagation();

		e.preventDefault();

		$(this).addClass('hover_eff');

	});

	$(document).bind('touchstart', function (e) {

		e.preventDefault();
		var container = $(".item");

		if (!container.is(e.target) && container.has(e.target).length === 0) {
			container.removeClass('hover_eff');
		}

	});
	*/

/**
 *	BANNER ANIMATE COLOR (transitions in css)
 *
 */

	$('.banner-block, .category-image, .product-categories > .item').each(function () {

		if( $(this).hasClass('disable-invert') ) {

			return;

		}else{
			// from block settings:
			var fontSet	= $(this).find('.varsHolder').attr('data-fontColor'),
				boxSet	= $(this).find('.varsHolder').attr('data-boxColor');

			// define all inner elements:
			var box			= $(this).find('.item-overlay'),
				title		= $(this).find('.box-title'),
				text		= $(this).find('.text'),
				subtitle	= $(this).find('.block-subtitle');

			// get elem. default vaules:
			var boxDef		= box.css('background-color'),
				titleDef	= title.css('color'),
				textDef		= text.css('color'),
				subtitleDef = subtitle.css('color');
			//invert values on hover:
			$(this).hover(
				function (){

					if( fontSet ) 	{ box.css('background-color', fontSet); }else{ box.css('background-color', titleDef);}
					if( boxSet )	{ title.css('color', boxSet); }else{title.css('color', boxDef);}
					if( boxSet )	{ text.css('color', boxSet);}else{text.css('color', boxDef);}
					if( boxSet )	{ subtitle.css('color', boxSet);}else{subtitle.css('color', boxDef);}
				},
				function () {

					if( boxSet )	{ box.css('background-color', boxSet);}else{box.css('background-color', boxDef);}
					if( fontSet ) 	{ title.css('color', fontSet); }else{ title.css('color', titleDef);}
					if( fontSet ) 	{ text.css('color', fontSet);}else{ text.css('color', textDef);	}
					if( fontSet ) 	{ subtitle.css('color', fontSet);}else{subtitle.css('color',subtitleDef);}
				}
			);

		} // end if

	});

	function inverter( element ) {

	}


/**
 *	PRETTYPHOTO
 *
 */

	$('#review_form_wrapper').hide();


		$('a[data-rel]').each(function() {
			$(this).attr('rel', $(this).data('rel'));
		});
		$('a[rel^="prettyPhoto"]').prettyPhoto(
			{	theme: 'light_square',
				slideshow:			5000,
				social_tools:		false,
				autoplay_slideshow:	false,
				show_title:			false,
				deeplinking:		false,
				markup: 			'<div class="pp_pic_holder"><div class="ppt">&nbsp;</div><div class="pp_top"><div class="pp_left"></div><div class="pp_middle"></div><div class="pp_right"></div></div><div class="pp_content_container"><div class="pp_left"><div class="pp_right"><div class="pp_content"><div class="pp_loaderIcon"></div><div class="pp_fade"><a href="#" class="pp_expand" title="Expand the image"></a><div class="pp_hoverContainer"><a class="pp_next" href="#"></a><a class="pp_previous" href="#"></a></div><div id="pp_full_res"></div><div class="pp_details"><div class="pp_nav"><a href="#" class="pp_arrow_previous"></a><p class="currentTextHolder">0/0</p><a href="#" class="pp_arrow_next"></a></div><p class="pp_description"></p>{pp_social}<a class="pp_close" href="#"></a></div></div></div><div class="clearfix"></div></div></div></div><div class="pp_bottom"><div class="pp_left"></div><div class="pp_middle"></div><div class="pp_right"></div></div></div><div class="pp_overlay"></div>',
					ajaxcallback: function(){
						if( $("video,audio").length ) {
							$("video,audio").mediaelementplayer();
						}
					}
			});
/** END PRETTYPHOTO */



/**
 *	STICKY ONEPAGER MENU
 *



	$('.sticky-block').waypoint('sticky', {
		stuckClass: 'stuck',
		offset: 1,
		handler:	function(){
			var stickyBlock		= $('.sticky-block'),
				stickHeader		= $('.stick-it-header'),
				stickHeadHeight = stickHeader.outerHeight(true),
				wpadminbarH		= $('#wpadminbar').outerHeight(true);

				stickyBlock.css('top', stickHeadHeight + wpadminbarH );
			}
	});
**/
	function correctStickyWidth() {

		var stickyBlock = $('.sticky-block');
		stickyBlock.width( stickyBlock.parent().width() );

		stickyBlock.parent().closest('.aq-block').css('z-index', '10');

	}

	function correctStickyTop() { // same function as handler in waypoint

		var stickyBlock		= $('.sticky-block'),
			stickHeader		= $('.stick-it-header'),
			stickHeadHeight = stickHeader.outerHeight(true),
			wpadminbarH		= $('#wpadminbar').outerHeight(true);

		stickyBlock.css('top', stickHeadHeight + wpadminbarH );
	}

	$( window ).resize( function () {
		correctStickyWidth();
		correctStickyTop();
	});

	correctStickyWidth();
	correctStickyTop();

/**
 *	SIMPLE STICKY HEADER
 *
 **/


	function stickyHeadElements( nav, logo_title ) {

		if( nav.length && logo_title.length ) {

			// jQuery version
			var scrollTop     	= $(window).scrollTop(),
				elementOffset 	= logo_title.offset().top,
				distance		= (elementOffset - scrollTop),
				header			= nav.closest('#site-menu');

			// pure JS - getPageScroll()
			var height 	= logo_title.height(),
				shift	=  parseInt( getPageScroll()[1]);

			//if( logo_title.offset().top + height < shift ) {
			if( distance + height < 0 ) {


				$('.mega-clone, .sub-clone' ).fadeOut(10);


				if( nav.parent().hasClass('stick-it-header') ) // if already STICKED - STOP
					return;

				header.addClass('sticked');

				nav.wrapAll( "<div class='stick-it-header' />");

				// CLONE AND APPEND LOGO AND MINICART :
				logo_title.find('a.home-link').clone().appendTo('.stick-it-header');

				$('.wrap-mini-cart').clone().appendTo('.stick-it-header');

				$('.mini-cart-list').slideUp( 300, 'easeInOutQuart', function() {
					minicart_active = false;
				} );


			}else{
				if( !nav.parent().hasClass('stick-it-header') )
					return;
				header.removeClass('sticked');
				nav.unwrap();
				nav.parent().find('a.home-link').remove();
				nav.parent().find('.wrap-mini-cart').remove();
			}

		}

	}
	$( window ).scroll(function() {
		stickyHeadElements( $('.to-stick' ), $('#site-title') );
	});
	$( window ).load(function() {
		stickyHeadElements( $('.to-stick' ), $('#site-title') );
	});





/**
 *	SHUFFLE PLUGIN initiate and setup filters.
 *
 */
	$('.shuffle-filter-holder, .wc-catalog-page, .vc_column_container .woocommerce').each( function () {

		var filterBlock = $(this),
			$grid		= filterBlock.find('.shuffle');

		if( ! $grid.length ) return;

		var	$sizer			= $grid.find('.item'),
			$filterOptions	= filterBlock.find('ul.tax-filters');



		$grid.shuffle({
			group: 'all',
			itemSelector: '.item',
			sizer: null,
			throttle: $.throttle,
			speed: 450,
			easing: 'ease-out'
		});

		function setupFilters() {

			var $btns = $filterOptions.children();

			$btns.find('a').on('click', function(event) {

				event.preventDefault();

				var $this = $(this),
				isActive = $this.hasClass( 'active' ),
				group = isActive ? 'all' : $this.data('group');

				// Hide current label, show current label in title
				if ( !isActive ) {
					$('ul.tax-filters .active').removeClass('active');
				}

				$this.toggleClass('active');

				// Filter elements
				$grid.shuffle( 'shuffle', group );

			});

			$btns = null;

		}
		setupFilters();

		function setupSorting() {
			// Sorting options
			filterBlock.find('.sort-options').on('change', function() {
				var sort = this.value,
					opts = {};

				// We're given the element wrapped in jQuery
				if ( sort === 'date-created' ) {
					opts = {
					  reverse: true,
					  by: function($el) {
						return $el.data('date-created');
					  }
					};
				}else if ( sort === 'title' ){
					opts = {
						by: function($el) {
						return $el.data('title').toLowerCase();
						}
					};
				}

				// Sort elements
				$grid.shuffle('sort', opts);
			});
		}

		setupSorting();

		$grid.on('layout.shuffle', function() {
			$.waypoints('refresh');
		});

	});
/** end Shuffle plugin setup */


/**/});// ||||||||||||||| 	END ON WINDOW LOAD

// continue on document ready:



/**
 *	MEGA MENU and REGULAR MENU SYSTEM
 *
 */
	//#######  1. REMOVE MEGA MENU FOR MOBILE DEVICES ( displays as regular submenu )#######

	$('.mobile-dropdown').find('.sub-menu').removeClass('as-megamenu').css('display','none');
	$('.mobile-dropdown').find('.mega-parent').removeClass('mega-parent');
	//
	//#######  2a CLONE SUBMENUS WITH CLASS as-megamenu #######
	//
	var $megaID = 0;
	$('.as-megamenu').each(function () {

		$megaID ++;

		var header			= $(this).closest('#site-menu'),
			parentOfMenu	= $(this).closest('.row'),
			customMenu		= $(this).closest('.custom-menu'); //++

		if( header.hasClass('header-template-simple') )
			return;

		if( header.hasClass('vertical')  || customMenu.hasClass('vertical')) { //++
			$(this).clone().addClass('mega-clone').addClass('vertical-mega').removeClass('sub-menu').attr('id','mega-'+$megaID).appendTo( 'body' );
		}else if( header.hasClass('horizontal') ){
			$(this).clone().addClass('mega-clone').addClass('horizontal-mega').removeClass('sub-menu').attr('id','mega-'+$megaID).appendTo( parentOfMenu );
		}

		//verticalMega_Position();

		$(this).parent().find('a.dropdown').attr('data-megaid', 'mega-'+$megaID);

		$('.mega-clone').css('display','none');

	});
	//
	//####### 2b - CLONE REGULAR SUBMENUS: #######
	//
	var $subCloneID = 0;
	$('.navigation > li > .sub-menu').each(function () {

		if( $(this).closest('.navigation').hasClass('secondary') ) // don't clone secondary menu
			return;

		$subCloneID ++;

		var header		= $(this).closest('#site-menu'),
			parentOfMenu	= $(this).closest('.row'),
			thisParent	= $(this).parent(),
			customMenu	= $(this).closest('.custom-menu');

		if( thisParent.hasClass('mega-parent') || header.hasClass('header-template-simple') )
			return;

		if( header.hasClass('vertical') || customMenu.hasClass('vertical') ) {

			$(this).clone().addClass('sub-clone')
							.addClass('vertical-sub')
							.attr('id','sub-'+$subCloneID)
							.removeClass('sub-menu')
							.appendTo( 'body' );

		}else if( header.hasClass('horizontal') ) {

			$(this).clone().addClass('sub-clone')
							.addClass('horizontal-sub')
							.attr('id','sub-'+$subCloneID)
							.removeClass('sub-menu')
							.appendTo( parentOfMenu );

		}

		$(this).parent().find('a.dropdown').attr('data-subid', 'sub-'+$subCloneID);

		$('.sub-clone').css('display','none');


	});




	//####### 3 - MAKE SUBS AND/OR MEGA VISIBLE:#######


	$('#main-nav-wrapper  ul.navigation > .menu-item-has-children > a, .custom-menu  ul.navigation > .menu-item-has-children > a').mouseenter(

		function(e) {

			var $this 	= $(this), // <--- MAIN TRIGGER - THE MENU LINK ELEMENT WITH CHILDREN
				$is_custom_menu = $this.parent().parent().hasClass('custom-nav') ? true : false; // <--- IF TRIGGER IS IN CUSTOM MENU

			if( $is_custom_menu && $(document).width() <= 768 )
				return;

			// FIX FOR MEGA PARENT OFFSET TOP:
			var adminbar	= $('#wpadminbar').height(), // if there's admin bar, add this to fix
				offsetTop	=  $this.offset().top;

			var offsetFix = '';
			if( $is_custom_menu ) {
				offsetFix = adminbar;
			}else{
				offsetFix =  $('#site-menu').offset().top - ($this.outerHeight(true)/2 + adminbar);
			}


			if( $('.mega-clone').length || $('.sub-clone').length ) {
				horiz_megaPosition( $this );
			}

			e.preventDefault();
			e.stopPropagation();

			// RESET (HIDE) ANY SUB OR MEGA, FIRST:
			$(' .mega-clone, .sub-clone').css('display','none');


			// get ID's to show proper sub / mega
			var mega_link = $this.attr('data-megaid');
			var sub_link = $this.attr('data-subid');


			// VERTICAL POS. OF REGULAR SUB-MENU
			if( $('#'+ sub_link).hasClass('vertical-sub') ) {
				var offsetSub = offsetFix + ( $('#'+ sub_link).outerHeight(true) /2 );
				$('#'+ sub_link).css('top', $this.offset().top - offsetSub );
			}

			// FIX POSITION
			var menuHolder = $this.closest('.navigation');
			verticalMega_Position( menuHolder , $this );

			// MAKE VISIBLE:
			$('#'+ mega_link).stop(true,false).css('display','block').animate({'opacity':1 },{duration:300, easing: 'linear'});
			$('#'+ sub_link).stop(true,false).css('display','block').animate({'opacity':1 },{duration:300, easing: 'linear'});


			// ARROW VERTICAL POS. and OPACITY (IF NOT HORIZONTAL MENU)
			//$('.active-mega').css('top',offsetTop - offsetFix  );
			if( ! menuHolder.hasClass('horizontal') ) {
				$('.active-mega').stop(true,false).css('display','block').animate({'opacity':1 },{duration:300, easing: 'linear'});
			}


		}
	).mouseleave(

		function (e) {

			var $this = $(this); // <--- MAIN TRIGGER - THE MENU LINK ELEMENT WITH CHILDREN

			var mega_link = $this.attr('data-megaid');
			var sub_link = $this.attr('data-subid');

			$('#'+ mega_link).stop(true,false).delay(300).animate( {'opacity':0 },{duration:100, easing: 'linear', complete:
				function() {
					$('#'+ mega_link).css('display','none');
				}
			} );

			$('#'+ sub_link).stop(true,false).delay(300).animate( {'opacity':0 },{duration:100, easing: 'linear', complete:
				function() {
					$('#'+ sub_link).css('display','none');
				}
			} );

			$( '.active-mega').stop(true,true).delay(300).animate( {'opacity':0 },{duration:300, easing: 'linear'});

		}

	);
	// MAKE SUB CLONES VISIBLE ( PREVENT GETTING OFF SCREEN ) :
	$('.sub-clone li, .sub-menu > li').mouseenter(

		function(e) {

			e.stopPropagation();

			var $this	= $(this),
				sub		= $this.find('> .sub-menu'),
				subPos	= $this.offset().left + $this.outerWidth(true) + 220;


			if( subPos >= $( document ).width() ) {
				sub.css('left','-100%');
			}

			sub.fadeIn();
		}

	)
	.mouseleave(
		function(e) {
			var sub = $(this).find('> .sub-menu');
			sub.fadeOut();
		}
	);
	//
	// MEGA or SUB MENU CONFIRM IS ACTIVE:
	$(document).on('mouseover','.mega-clone, .sub-clone', function (e) {
		e.stopPropagation();

		$(this).stop(true, false).css('display','block').animate({'opacity':1 },{duration:300, easing: 'linear'});

		if( $(this).hasClass('vertical-mega') ) {
			$( '.active-mega').stop(true,false).css('display','block').animate({'opacity':1 },{duration:300, easing: 'linear'});
		}

	});
	// HIDE MEGA MENU WHEN MOUSE LEAVES MEGA MENU
	$(document).on('mouseleave','.mega-clone, .sub-clone', function (e) {
		e.stopPropagation();
		$(this).stop(false,true).delay(300).fadeOut( 200 );
		$('.active-mega').delay(300).css('display','none');
	});


	$(document).click(function () {
		if( !window.isMobile ) {
			$('.mega-clone').fadeOut( 200, function() {$('.mega-clone').fadeOut(); } );
		}
	});


	$('.horizontal ul.navigation > li').find('> .sub-menu').each(
		function () {
			var sub = $(this),
				sub_parent = $(this).parent(),
				horiz_sub_pos	= sub_parent.outerWidth(true)/2  - sub.outerWidth(true)/2  ;

			sub.css('left', horiz_sub_pos );
		}
	);

/**
 *	MENU POSITION ON HORIZONTAL LAYOUT:
 */
function horiz_megaPosition( triggered ) {

	var megaid	= triggered.attr("data-megaid"),
		mega	= $('#' + megaid ),
		subid	= triggered.attr("data-subid"),
		sub		= $('#' + subid);

	if( mega.hasClass('horizontal-mega') || sub.hasClass('horizontal-sub') ) {

		var top_shift		= triggered.offset().top, // top position of hovered nav element
			parentoffsetTop	= triggered.closest('.row').offset().top, // first positioned el. top
			parentoffsetLeft= triggered.closest('.row').offset().left,// first positioned el. left
			triggered_H		= triggered.outerHeight(true), // height of hovered nav element
			triggered_L		= triggered.offset().left, // left position of hovered nav element
			triggered_W		= triggered.outerWidth(true) / 2, // width of hovered nav element
			sub_W			= sub.outerWidth(true) / 2 ; // width of sub element

		// calculate positions
		var topPosition		= top_shift - parentoffsetTop + triggered_H,
			leftPosition	= ( triggered_L + triggered_W )- sub_W - parentoffsetLeft ;

		// apply positions
		mega.css('top', topPosition );
		sub.css('top', topPosition );
		sub.css('left',leftPosition );

	}

}
/** end position of mega menu */

/**
 *	VERTICAL (AND CUSTOM MENU) SUB/MEGA - vertical position fix
 */
function verticalMega_Position( theMenu, parentItem ) {

	var htmlW		= $('html').width(),
		bodyW		= $('#bodywrap').width(),
		scrollT		= $('body').scrollTop();

	if( htmlW >= bodyW && !theMenu.hasClass('horizontal')) { // IF MENU ISN'T HORIZONTAL

		// IDENTIFY WHICH SUB OR MEGA BY PARENT ITEM DATA-MEGAID OR DATA-SUBID ATTRIBUTE
		var target		= parentItem.attr('data-megaid');
		if( !target ) { // if no mega
			target		= parentItem.attr('data-subid');
		}

		if( theMenu.hasClass('custom-nav') ) {
			$('#'+ target ).css('bottom','auto') ; // remove vertical mega stretching to bottom
		}

		var	megaHeight	= $('#'+ target ).outerHeight(true),
			megaShift	= htmlW/2 - bodyW/2 - $('#bodywrap').offset().left,
			menuW		= theMenu.offset().left + theMenu.outerWidth(true),
			arrow		= $('.active-mega');


		//  LEFT POSITION
		$('#'+ target ).css( 'left', megaShift + menuW );
		arrow.css( 'left', megaShift + menuW - 6 );
		// TOP POSITION
		var finalPosition	= (parentItem.offset().top - scrollT ) - megaHeight/2 + (parentItem.height()/2),
			arrowPosition	= (parentItem.offset().top - scrollT) + (parentItem.height()/2) - 6;

		// CUSTOM MENU - VERTICAL POSITION OF SUB/MEGA AND ARROW
		if( theMenu.hasClass('custom-nav') ) {

			$('#'+ target ).css('top', finalPosition );

		}
		arrow.css( 'top', arrowPosition );

	}
}
//verticalMega_Position();

/**
 *	SECONDARY MENU TOGGLE:
 */
$('#secondary-nav li.dropdown, #main-nav-wrapper.side-subs li.dropdown').mouseover(
	function (e) {


		var thisSub		= $(this).find('> ul.sub-menu'),
			bigParent	= $(this).closest('.navigation').parent();

		if( bigParent.hasClass('side-subs') ) {
			thisSub.css('left','100%');
		}else{
			thisSub.css('left',0);
		}

		$(this).siblings().find('ul.sub-menu').css('display','none'); // first hide all other subs
		thisSub.fadeIn();

	}
).mouseleave(
	function (e) {
		$(this).find(' > ul.sub-menu').delay(300).fadeOut();
	}
);

$('.custom-menu  ul.navigation > .menu-item-has-children').mouseover(
	function () {
		if( $(document).width() <= 768 ) {
			$(this).find('> .sub-menu').slideDown().css('left',0);
		}
	}).mouseleave(
	function() {
		if( $(document).width() <= 768 ) {
			$(this).find('> .sub-menu').slideUp();
		}
	}
);


/**
 *	MAKE RELATIVE - depending on WATCH plugin
 *
 *	if element's height is exceeding parent change css position absolute to relative.
 *	used in single product block ( AQPB )
 */
if ( $.browser.mozilla ) {
	$('.wrap').closest('.single-product-block').addClass('mozilla');
}else{
	$('.wrap').closest('.single-product-block').addClass('not-mozilla');
}
function makeRelative( el ) {

	var parent		= el.parent(),
		parentH		= parent.height(),
		thisH		= el.height();

	if( parentH >= thisH ) {
		parent.removeClass('adapt-to-child');
	}else
	if( parentH < thisH) {
		parent.addClass('adapt-to-child');
	}

}
$('.wrap').watch("height",
	function() {
		makeRelative( $('.wrap') );
	},
100);
/** end MAKE RELATIVE */




/**
 *	WINDOW RESIZE EVENTS.
 *
 */
	$(window).resize(function() {

		makeRelative( $('.wrap') );

		//verticalMega_Position();

	});

/** end WINDOW RESIZE */


/**
 *
 * OWL CAROUSELS.
 *
 */
	function owlCarousels() {

		// CONTENT SLIDERS - posts, product, portfolio lists
		var contentSlides = $(".contentslides");

		contentSlides.each(	function() {

			var $this	= $(this),
				config	= $this.parent().find('input.slides-config');

			var cs_navig	= config.attr('data-navigation'),
				cs_pagin	= config.attr('data-pagination'),
				cs_auto		= config.attr('data-auto'),
				sc_desk		= config.attr('data-desktop'),
				sc_tablet	= config.attr('data-tablet'),
				sc_mobile	= config.attr('data-mobile'),
				sc_loop		= config.attr('data-loop');


			// WHEN CAROUSEL IS INITALIZED (must be before owlCarousel() call):
			$this.on('initialized.owl.carousel', function(event) {
				Foundation.libs.equalizer.reflow();
			});


			// OWL 2
			$this.owlCarousel({
				//loop:true,
				margin:0,
				navRewind: true,
				responsiveClass:true,
				nav: cs_navig == '1' ? true : false,
				dots:  cs_pagin == '1' ? true : false,
				autoplay:  cs_auto ? true : false,
				autoplayTimeout:  cs_auto  ? cs_auto : 0,
				autoplayHoverPause: true,
				navText: ["<span class=\"icon-chevron-left\"></span>","<span class=\"icon-chevron-right\"></span>"],
				responsive:{
					0:{
						items:sc_mobile ? sc_mobile : 1,
						nav:true
					},
					768:{
						items:sc_tablet ? sc_tablet : 3,
						nav:false
					},
					960:{
						items: sc_desk ? sc_desk : 4,
						nav:cs_navig == '1' ? true : false,
						loop: sc_loop == '1' ? sc_loop : false
					}
				}
			});

		}); // end contentSlides.each

		// SINGLE PRODUCT BLOCK IMAGES SLIDER
		var singleSlides = $(".singleslides");

		singleSlides.each(	function() {

			var $this	= $(this),
				config	= $this.prev('input.slides-config');

			var sp_navig		= config.attr('data-navigation');
			var sp_pagin		= config.attr('data-pagination');
			var sp_auto			= config.attr('data-auto');

			// OWL 2
			$this.owlCarousel({
				margin				: 0,
				responsiveClass		: true,
				autoplay			: false,
				navText				: ["<span class=\"icon-chevron-left\"></span>","<span class=\"icon-chevron-right\"></span>"],
				responsive:{
					0:{
						items: 1,
						nav:false,
						dots:true
					},
					768:{
						items: 1,
						nav:false,
						dots:true
					},
					960:{
						items: 1,
						nav:true,
						loop:true,
						dots:true
					}
				}
			});

		}); // end singleSlides.each

	}


	$(window).load(function() {
		owlCarousels();
	});

	$( '.contentslides, .singleslides, .slider, .simpleslides' )
		.hover(function() {
			$('.owl-nav', this).stop(false,true).animate({'left': 0, 'right':  0 },{duration:200, easing: 'linear'});
			$('.owl-dots', this).stop(false,true).animate({'bottom': 0 },{duration:200, easing: 'linear'});

		},
		function() {
			$('.owl-nav', this).stop(false,true).animate({'left':-80, 'right': -80 },{duration:200, easing: 'linear'});
			$('.owl-dots', this).stop(false,true).animate({'bottom':-50 },{duration:200, easing: 'linear'});
		});
/**
 *
 *	Sliders styles.
 *	different styles of animation of slider block
 *
 */

	/**
	 *	Functions for current and new slide for out and in animations
	 *	called from sliders() function
	 *
	 */
	function initLayers ( item ){

		item.find('.text').children().each( function(index, value) {

				$(this).addClass('inactive');

				if( item.index() === 0 ){
					$(this).removeClass('inactive').addClass('active');
				}
			}
		);

	}
	function slider_anim_in (new_in) {

		new_in.find('.text').children().each( function(index, value) {
			$(this).delay(200 * index).queue(
				function() {
					$(this).removeClass('inactive').addClass('active');
				}
			).dequeue();
		});

	}

	function slider_anim_out(old_out) {

		old_out.find('.text').children().each( function(index, value) {
			$(this).delay(300 * index).removeClass('active').addClass('inactive');
		});

	}



/**
 *
 *	Google maps initiate and unload.
 *
 *	if issues with this - add in body tag - <body onload="initialize()" onunload="GUnload()">


	if( $('.google-map').length ) {
		$(window).load(function() {
			initialize();
		});
		$(window).unload(function() {
			unload();
		});
	}
*/
/** end Slider styles */

/**
 *	BACK TO TOP
 *
 */
	function backToTop () {
		var offset = 300,
			//browser window scroll (in pixels) after which the "back to top" link opacity is reduced
			offset_opacity = 1200,
			//duration of the top scrolling animation (in ms)
			scroll_top_duration = 700,
			//grab the "back to top" link
			$back_to_top = $('.to-top');

		//hide or show the "back to top" link
		$(window).scroll(function(){
			if( $(this).scrollTop() > offset ) {
				$back_to_top.addClass('to-top-is-visible') ;
			}else{
				$back_to_top.removeClass('to-top-is-visible to-top-fade-out');
			}

			if( $(this).scrollTop() > offset_opacity ) {
				$back_to_top.addClass('to-top-fade-out');
			}
		});

		//smooth scroll to top
		$back_to_top.on('click', function(event){
			event.preventDefault();
			$('body,html').animate({
				scrollTop: 0 ,
				}, scroll_top_duration
			);
		});
	}

	backToTop();

/**
 *	WAYPOINTS REFRESH
 *
 */
	$(window).resize(function() {
		$.waypoints('refresh');
	});

// prevent empty a href
	$('a[href=""]').attr('href', '#');


/**
 *	ADD GRAB / GRABBING CURSOR ON CAROUSELS
 *
 */
$( ".slick-list, .owl-carousel" )
	.hover(function() {
			$( this ).addClass( 'to-drag');
		},
		function() {
			$( this ).removeClass( 'to-drag');
		}
	)
	.mouseup(function() {
		$( this ).removeClass( 'dragged').addClass( 'to-drag');
	})
	.mousedown(function() {
		$( this ).addClass( 'dragged' ).removeClass( 'to-drag');
	});


/**
 *	GRID / LIST FUNCTIONS FOR WOOCOMMERCE CATALOG PAGE
 *
 */
	var itemsHolder = $('ul.products');
	if( itemsHolder.length ) {

		var default_view = 'grid'; // choose the view to show by default (grid/list)
		// check the presence of the cookie, if not create view cookie with the default view value
		if($.cookie('view') !== 'undefined'){
			$.cookie('view', default_view, { expires: 7, path: '/' });
		}

		var itemList	= $('.item-data-list');


		if($.cookie('view') == 'list'){
			// we dont use the get_list function here to avoid the animation
			$('#grid').removeClass('active');
			$('#list').addClass('active');
			itemsHolder.animate({opacity:0});
			itemsHolder.addClass('list');
			itemList.css('display','block');
			itemsHolder.stop().animate({opacity:1});
			$.waypoints('refresh');
		}

		if($.cookie('view') == 'grid'){
			$('#list').removeClass('active');
			$('#grid').addClass('active');
			itemsHolder.animate({opacity:0});
				itemsHolder.removeClass('list');
				itemList.css('display','none');
				itemsHolder.stop().animate({opacity:1});
				$.waypoints('refresh');
		}

		$('#list').click(function(event){
			event.preventDefault();
			$.cookie('view', 'list');
			get_list();
		});

		$('#grid').click(function(event){
			event.preventDefault();
			$.cookie('view', 'grid');
			get_grid();
		});

	}
	function get_grid(){
		$('#list').removeClass('active');
		$('#grid').addClass('active');
		itemsHolder.animate({opacity:0},function(){
			itemsHolder.removeClass('list');
			itemList.css('display','none');
			itemsHolder.stop().animate({opacity:1});
			$.waypoints('refresh');
			$('.shuffle').shuffle('update');
		});
	} // end get_grid function
	function get_list(){
		$('#grid').removeClass('active');
		$('#list').addClass('active');
		itemsHolder.animate({opacity:0},function(){
			itemsHolder.addClass('list');
			itemList.css('display','block');
			itemsHolder.stop().animate({opacity:1});
			$.waypoints('refresh');
			$('.shuffle').shuffle('layout');
		});
	} // end get_list function


	/**
	 *	VISUAL COMPOSER "TWEAKS"
	 *
	 */
	$('.ui-tabs-nav li').mousedown(function() {
		var tabsParent	= $(this).closest('.ui-tabs'),
			tabContent	= tabsParent.find('.wpb_tab');

		tabContent.each(function(){
			$(this).css('opacity', 0 ).animate( {opacity:1});
		});

	});
	$('.ui-tabs-nav li').mouseup(function() {
		setTimeout(
			function() {
				$.waypoints('refresh');
				$(window).trigger('resize');
				Foundation.libs.equalizer.reflow();
			},1000);
	});


	/**
	 *	WC Variations image changes ( magnifier, slider or default view )
	 */
	
	window.variableProductImages = function () {
		
		var single_product		= $('.single-product .product, .qv-holder .product');
		
		single_product.each( function() {
			
			var $_this			= $(this),										// single product object
				$_images		= $_this.find('.images');
			
			var	featuredProdImage	= $_images.find('.featured'),
				larger_image_url	= $_images.find('a.larger-image-link'),		// modal image url
				defaultProdImage	= larger_image_url.attr('data-zoom-image'),	// cache featured image ( for reset dropdown select )
				defaultLargeImage	= larger_image_url.attr( 'data-o_href' ),	// cache large featured image
				productsOwlSlider	= $_this.find('.owl-carousel');				// option: images slider
											
			if( productsOwlSlider.length ) {
				productsOwlSlider.on('initialized.owl.carousel', function(event) { 
					featuredProdImage	= $_images.find('.featured');
				});
			}
			
			// Variations form in this single product object
			var var_form = $_this.find('form.variations_form ');
			
			// Change event on select element
			var_form.on('change','.variations select' , function(e){ 
				
				var zoomWindow			= $('.zoomWindow');
				
				// Get select dropdown data :  all variations data and get selected index
				var select			= $(this),
					parse_form_data	= $.parseJSON( var_form.attr('data-product_variations') ),
					form_data		= parse_form_data.reverse(),
					selected_index	= select.find('option:selected').index(),
					selected		= form_data[selected_index -1];

				// Get variation data by selected dropdown index
				var var_id, image_src = '';
				if( selected !== undefined  ) {
					// 3.0.0 < Fallback conditional
					if( ! $("body").hasClass( "WC2.7" ) ) {
						var_id			= form_data[selected_index -1].variation_id;
						image_src		= form_data[selected_index -1].image_src;
					}else{
						var_id			= form_data[selected_index -1].id;
						image_src		= form_data[selected_index -1].image.src;
					}
					
					
				}else{
					// BACK TO DEFAULT IMAGE ( if select is set to default (no variataion))
					featuredProdImage.attr( 'src', defaultProdImage );
					zoomWindow.css('background-image', 'url(' + defaultProdImage + ')');
					larger_image_url.attr( 'href', defaultLargeImage );
					// if slider: reset Owl carosel to first (featured) image
					if( productsOwlSlider.length ) {
						productsOwlSlider.trigger('to.owl.carousel', [0]);
					}
					return;
				}
				
				// if no variation image - ABORT MISSION - back to default image (same as above):
				if( image_src === '' ) {
					// BACK TO DEFAULT IMAGE
					featuredProdImage.attr( 'src', defaultProdImage );
					zoomWindow.css('background-image', 'url(' + defaultProdImage + ')');
					larger_image_url.attr( 'href', defaultLargeImage );
					// if slider: reset Owl carosel to first (featured) image
					if( productsOwlSlider.length ) {
						productsOwlSlider.trigger('to.owl.carousel', [0]);
					}
					return;
				}
				
				// AJAX load image (background-image) to zoomWindow,  with preload:
				var preload = '<div class="zoom-image-preload"><span class="icon-spinner"></span></div>';
				zoomWindow.html( preload );
				$_images.append( preload );
				// Clear Zoom window background-image:
				zoomWindow.css('background-image', '' );
				// Resize trigger quick view window when price toggles on change variation:
				setTimeout( function() { $(window).trigger("resize"); }, 300 );
				
				console.log( image_src + " || " + zoomWindow.attr( "class" ) );
				
				$.ajax({

					type: "POST",
					url: window.olea_ajaxurl,
					data: { "action": "var-image", var_id: var_id  },
					success: function(response) {

						// Remove preloaders
						$('.zoom-image-preload').fadeOut( 300, function() { $(this).remove(); } );
						zoomWindow.html( '' );
						
						// replace featured image
						featuredProdImage.attr( 'src', image_src );
						
						// Link to larger image / zoom window image
						larger_image_url.attr( 'href', $.trim( response ) );							
						zoomWindow.css('background-image', 'url(' + $.trim( image_src )  + ')' );
													
						// if slider: reset Owl carosel to first (featured) image
						if( productsOwlSlider.length ) {
							productsOwlSlider.trigger('to.owl.carousel', [0]);
							featuredProdImage.attr( 'src', image_src );
						}
						
						$(window).trigger("resize");

					}, // end success
					error: function () {
						alert("Ajax error");
					} //end error
				});
				
			}); // end on change
			var_form.on( 'click','.reset_variations', function(){
				
				var zoomWindow	= $('.zoomWindow');
				
				zoomWindow.css('background-image', 'url(' + defaultProdImage + ')');
				larger_image_url.attr( 'href', defaultLargeImage );
				
				if( productsOwlSlider.length ) {
					productsOwlSlider.trigger('to.owl.carousel', [0]);
					featuredProdImage.attr( 'src', defaultProdImage );
				}
			}); // end on click
			
		}); // end images.each
		
	}; // end function variableProductImages()
	
	var variableProductImages = window.variableProductImages();
	// end WC Variations image changes

}); // end document.ready


/**
 *	WooCommerce messages
 *
 */
	$('.theme-shop-message, .before-wc-loop-wrap').find('.woocommerce-message').append('<div class="message-remove"></div>');
	$('.theme-shop-message,.woocommerce-message .message-remove').on('click',function() {
		$('.theme-shop-message').fadeOut();
		$('.before-wc-loop-wrap').find('.woocommerce-message').fadeOut();
	});

	setTimeout(
		function() {
			jQuery('.theme-shop-message').fadeOut();
		}, 5000 );


})( jQuery );
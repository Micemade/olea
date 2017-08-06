//var $ = jQuery.noConflict();
jQuery(document).ready( function($) {
	/**
	 *	Remove WooCommerce setting field for turn on Woo CSS:
	 *
	 */
	
	$('input#woocommerce_frontend_css').parent().parent().html('<strong>WooCommerce styles disabled by olea theme.</strong><p class="description">WooCommerce frontend styles are not supported by olea theme.</p>');
	
	
	
	/**
	 *	Custom wp_nav_menu fields control.
	 *
	 *	for mega menu control input fields.	 
	 */
	 	
	$('.custom-menu-megamenu').find('input[type=checkbox]').each( function () {
		
		var $this = $(this);
		var itemParent = $this.parent().parent().parent().parent();
		var itemTypeLabel = itemParent.find('.item-type');
		
		if( $this.prop( "checked" ) ) {
			itemTypeLabel.prepend('<span class="label-mega">Mega menu - </span>');
		}
		
		$this.on('click', function () {
			
			if ( $(this).prop( "checked" ) ) {
				itemTypeLabel.prepend('<span class="label-mega">Mega menu - </span>')
			}else{
				$(this).val('');
				itemTypeLabel.find('span.label-mega').remove();
			}	
			
		});
	
	});// end each
	 	
	$('.custom-menu-clear').find('input[type=checkbox]').each( function () {
		
		var $this = $(this);
		var itemParent = $this.parent().parent().parent().parent();
		var itemTypeLabel = itemParent.find('.item-type');
		
		if( $this.prop( "checked" ) ) {
			itemTypeLabel.prepend('<span class="label-clear">Clear (new row) - </span>');
		}
		
		$this.on('click', function () {
			
			if ( $(this).prop( "checked" ) ) {
				itemTypeLabel.prepend('<span class="label-clear">Clear (new row) - </span>')
			}else{
				$(this).val('');
				itemTypeLabel.find('span.label-clear').remove();
			}	
			
		});
	
	});// end each	
	 	
	$('.custom-menu-post_thumb').find('input[type=checkbox]').each( function () {
		
		var $this = $(this);
		var itemParent = $this.parent().parent().parent().parent();
		var itemTypeLabel = itemParent.find('.item-type');
		
		if( $this.prop( "checked" ) ) {
			itemTypeLabel.prepend('<span class="label-clear">Post thumb w. excerpt - </span>');
		}
		
		$this.on('click', function () {
			
			if ( $(this).prop( "checked" ) ) {
				itemTypeLabel.prepend('<span class="label-clear">Post thumb w. excerpt - </span>')
			}else{
				$(this).val('');
				itemTypeLabel.find('span.label-clear').remove();
			}	
			
		});
	
	});// end each	
	
	$('.custom-menu-image').find('input.input-upload').each( function () {
		
		var $this = $(this);
		var itemParent = $this.parent().parent().parent().parent().parent();
		var itemTypeLabel = itemParent.find('.item-type');
		
		if( $.trim(this.value).length ) {
			itemTypeLabel.prepend('<span class="label-image">Custom image - </span>');
		}
		
		$this.parent().find('.remove-media').on('click', function () {

			$(this).val('');
			itemTypeLabel.find('span.label-image').remove();	
		
		});
	
	});// end each
	
	/** 
	 *	Media Uploader
	 *
	 */
	$(document).on('click', '.as_upload_button', function(event) {
		var $clicked = $(this), frame,
			input_id = $clicked.prev().attr('id'),
			img_size = $clicked.prev().attr("data-size"),
			media_type = $clicked.attr('rel');
			itemParent = $clicked.parent().parent().parent().parent().parent(); // main menu holder (li)
			itemTypeLabel = itemParent.find('.item-type'); // menu item label
			
		event.preventDefault();
		
		// If the media frame already exists, reopen it.
		if ( frame ) {
			frame.open();
			return;
		}
		
		// Create the media frame.
		frame = wp.media.frames.aq_media_uploader = wp.media({
			// Set the media type
			library: {
				type: media_type
			},
			view: {
				
			}
		});
		
		// When an image is selected, run a callback.
		frame.on( 'select', function() {
			// Grab the selected attachment.
			var attachment = frame.state().get('selection').first();
			
			$('#' + input_id).val(attachment.attributes.id);
			
			if(media_type == 'image') $('#' + input_id).parent().parent().parent().find('.image-holder img.att-image').attr('src', attachment.attributes.sizes[img_size].url);
			
			itemTypeLabel.prepend('<span class="label-image">Image - </span>');
			
		});

		frame.open();
	
	});
	$(document).on('click', 'a.remove-media', function(event) {
		
		event.preventDefault();
		
		var imgDiv = $(this).parent().parent().find('.image-holder');
		var placeHolderImg = imgDiv.find('input.placeholder').val();
		
		imgDiv.find('img.att-image').attr('src', placeHolderImg );
		
		$(this).parent().parent().find('input.input-upload').val('');
		
	});
	
	/**
	 * OLEA 1.2.0 UPDATE NOTICE
	 */

	$(document).on( 'click', '.olea-120-notice .notice-dismiss, .tgmpa-olea-install-link', function(e) {

		e.preventDefault();
		
		var redirect_url = $('.tgmpa-olea-install-link').attr("href");
		
		$.ajax({
			url: ajaxurl,
			data: {
				action: 'olea120-update-option'
			},
			success: function() {
				window.location = redirect_url;
			},
			complete: function() {
				$('.olea-120-notice').fadeOut();
				
			}
		})

	});
	
	$(document).on( 'change', '#theme_skin', function(e) {
		
		var skin = $(this).val(),
			heading_sel		= $('#google_headings'),
			heading_span	= heading_sel.parent().find("span"),
			bodytext_sel	= $('#google_body'),
			bodytext_span	= bodytext_sel.parent().find("span");

		if( skin == 'montserrat.php' ) {
			
			heading_sel.val( "Montserrat" );
			heading_span.html( "Montserrat" );
			bodytext_sel.val( "Montserrat" );
			bodytext_span.html( "Montserrat" );
			
		}else if( skin == 'narrow_red_rustic.php' ) {
			
			heading_sel.val( "Crushed" );
			heading_span.html( "Crushed" );
			bodytext_sel.val( "Lato" );
			bodytext_span.html( "Lato" );
			
		}else if( skin == 'narrow_titles.php' ) {
			
			heading_sel.val( "Fjalla One" );
			heading_span.html( "Fjalla One" );
			bodytext_sel.val( "Raleway" );
			bodytext_span.html( "Raleway" );
			
		}else if( skin == 'open_sans_light.php' ) {
			
			heading_sel.val( "Open Sans" );
			heading_span.html( "Open Sans" );
			bodytext_sel.val( "Cabin" );
			bodytext_span.html( "Cabin" );
			
		}else if( skin == 'playfair.php' ) {
			
			heading_sel.val( "Playfair Display" );
			heading_span.html( "Playfair Display" );
			bodytext_sel.val( "Lato" );
			bodytext_span.html( "Lato" );
			
		}else if( skin == 'rose_sorts_mill_goudy.php' ) {
			
			heading_sel.val( "Sorts Mill Goudy" );
			heading_span.html( "Sorts Mill Goudy" );
			bodytext_sel.val( "Dosis" );
			bodytext_span.html( "Dosis" );
			
		}
		
		var headingID = heading_sel.attr("id");
		window.GoogleFontSelect( heading_sel, headingID );
		var bodytextID = bodytext_sel.attr("id");
		window.GoogleFontSelect( bodytext_sel, bodytextID );
		
	});
});

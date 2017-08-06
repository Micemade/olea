<?php
if( !isset($_GET['activated'])) {
header("Content-type: text/css; charset: UTF-8");
};

$g_FontToggle 		= apply_filters( "olea_options", "google_typekit_toggle", "google" ); // applies to body and titles
$site_bg_toggle 	= apply_filters( "olea_options", "site_bg_toggle", "none" );
$site_bg_default	= apply_filters( "olea_options", "site_bg_default", "" ); //default tiles

$site_bg_uploaded	= apply_filters( "olea_options", "site_bg_uploaded", "" ); // uploaded site bg images
$site_bg_controls	= apply_filters( "olea_options", "site_bg_controls", "" );
$site_bg_repeat		= $site_bg_controls['repeat'];
$site_bg_position	= $site_bg_controls['position'];
$site_bg_attachment	= $site_bg_controls['attachment'];
$site_bg_color		= apply_filters( "olea_options", "site_back_color", "" );

$google_body		= apply_filters( "olea_options", "google_body", array('face'=>'Roboto', 'size'=>'16px', 'weight'=>'400', 'color'=>'#333333') );
$g_FontBody			= $google_body['face'];
$g_FontBodySize		= $google_body['size'];
$g_FontBodyWeight	= $google_body['weight'];
$g_FontBodyColor	= $google_body['color'];

$sys_body_font			= apply_filters( "olea_options", "sys_body_font", array() );
$sys_body_font_face		= $sys_body_font['face'];
$sys_body_font_size		= $sys_body_font['size'];
$sys_body_font_height	= $sys_body_font['height'];
$sys_body_font_style	= $sys_body_font['style'];
$sys_body_font_color	= $sys_body_font['color'];
/**
 *	ROOT (HTML)
 *
*/
$theme_styles = "";
$theme_styles .= "html, body { \n";
	if( $g_FontToggle == 'google' ) {
		$theme_styles .= !empty( $g_FontBodySize )	? "font-size:".$g_FontBodySize.";\n" : null;
	}elseif( $g_FontToggle == 'none' || $g_FontToggle == 'typekit' ) {
		$theme_styles .= ( $sys_body_font_size ? "font-size:" . $sys_body_font_size . ";\n" : null );
	}
	
$theme_styles .= "}\n\n";

/**
 *	BODY styles
 *
 */
$theme_styles .= "body { \n";
	
	if( $g_FontToggle ) {
		$theme_styles .= "/* BODY FONT STYLE - GOOGLE FONT */\n";
		
		$theme_styles .= !empty( $g_FontBody )		? "font-family:\"".$g_FontBody."\", Helvetica, Arial, sans-serif ;\n" : null;
		$theme_styles .= !empty( $g_FontBodyWeight )	? "font-weight:".$g_FontBodyWeight.";\n" : null;
		$theme_styles .= !empty( $g_FontBodyColor )	? "color:".$g_FontBodyColor.";\n" : null;
	
	};
	
	if( $g_FontToggle == 'none' || $g_FontToggle == 'typekit' ) {
		$theme_styles .= "/* BODY FONT STYLE - TYPEKIT - FALLBACK FONTS */\n";
		
		$theme_styles .= "font-family:". $sys_body_font_face .", Helvetica, Arial, sans-serif;\n";
		
		$theme_styles .= ( $sys_body_font_height	? "line-height:" . $sys_body_font_height . " ;\n " : null );
		$theme_styles .= ( $sys_body_font_style		? "font-style:" . $sys_body_font_style . ";\n " : null );
		$theme_styles .= ( $sys_body_font_color		? "color:" . $sys_body_font_color . ";\n " : null ); 
		
	};
	
	if( $site_bg_toggle != 'none' ) {
		$theme_styles .= "/* BODY BACKGROUND */\n";
		$theme_styles .= ($site_bg_toggle == 'default' && $site_bg_default ) ? "background-image: url(". $site_bg_default .");\n" : null;
		$theme_styles .= ($site_bg_toggle == 'upload' && $site_bg_uploaded) ? "background-image: url(". $site_bg_uploaded .");\n " : null;
		
		$theme_styles .= $site_bg_repeat	 ? "background-repeat: ".$site_bg_repeat.";\n" : null;
		$theme_styles .= $site_bg_position	 ? "background-position: ".$site_bg_position.";\n" : null;
		$theme_styles .= $site_bg_attachment ? "background-attachment: ".$site_bg_attachment.";\n" : null;
		
	};
	
	$theme_styles .= $site_bg_color ? "background-color: ".$site_bg_color.";\n" : null;
	
$theme_styles .= "}\n\n"; // end $theme_styles .= body
/**  end BODY styles */


/** DEPENDENCIES - OTHER SELECTORS WITH CSS's AS BODY ( overrides )*/
if( $g_FontToggle == 'google' && $g_FontBody ) {
	$theme_styles .= ".button, .onsale, .taxonomy-menu h4, button, input#s, input[type=\"button\"], input[type=\"email\"], input[type=\"reset\"], input[type=\"submit\"], input[type=\"text\"], select, textarea { \n font-family: ".$g_FontBody.", Helvetica, Arial, sans-serif !important;\n }\n\n";
	
}elseif(  $g_FontToggle == 'none' || $g_FontToggle == 'typekit' ) {
	$theme_styles .= "#site-menu, .block-subtitle, .bottom-block-link a, .button, .onsale, .taxonomy-menu h4, button, input#s, input[type=\"button\"], input[type=\"email\"], input[type=\"reset\"], input[type=\"submit\"], input[type=\"text\"], select, textarea, ul.post-portfolio-tax-menu li a { \n font-family: ". $sys_body_font_face .", Helvetica, Arial, sans-serif;\n }\n\n";
}

/**
 *	HEADINGS styles ( and MAIN MENU )
 *
 */
$google_headings		= apply_filters( "olea_options", "google_headings", array('face'=>'Crushed', 'weight'=>'400', 'color'=>'') );
$g_FontHeadings			= $google_headings['face'];
$g_FontHeadingsWeight	= $google_headings['weight'];
$g_FontHeadingsColor	= $google_headings['color'];

$sys_heading_font		= apply_filters( "olea_options", "sys_heading_font", array() );
$sys_Headings			= $sys_heading_font['face'];
$sys_HeadingsWeight		= $sys_heading_font['weight'];
$sys_HeadingsColor		= $sys_heading_font['color'];
$sys_HeadingsStyle		= $sys_heading_font['color'];

if ( $g_FontToggle == 'google'  ) {
	
	$theme_styles .= "/* HEADING STYLE - GOOGLE FONT */\n";
	
	if( !empty($g_FontHeadings)) {
		$theme_styles .=  "h1, h2, h3, h4, h5, h6 { \nfont-family: \"".$g_FontHeadings."\", Helvetica, Arial, sans-serif;\n"; 
		$theme_styles .= !empty($g_FontHeadingsWeight) ? "font-weight: ".$g_FontHeadingsWeight.";\n" : null;
		$theme_styles .= !empty($g_FontHeadingsColor) ? "color: ". $g_FontHeadingsColor .";\n" : null;
		$theme_styles .= "}\n\n";
	}
	
	
}else{
	
	$theme_styles .= "/* HEADING STYLE - SYSTEM FONT */\n";
	$theme_styles .= "h1, h2, h3, h4, h5, h6  { \n";
	$theme_styles .= "font-family:". $sys_Headings. ", Helvetica, Arial, sans-serif;\n";
	$theme_styles .= $sys_HeadingsWeight ? "font-weight:". $sys_HeadingsWeight .";\n" : "font-weight:normal;\n";
	$theme_styles .= $sys_HeadingsColor ? "color:". $sys_HeadingsColor .";\n" : null;
	$theme_styles .= $sys_HeadingsStyle ? 'font-style:'. $sys_HeadingsStyle .";\n" : null ;
	$theme_styles .= "} \n\n";
		
}
/* end HEADINGS styles  */


$under_head_opacity	= apply_filters( "olea_options", "under_head_opacity", "30" );

if( $under_head_opacity ){
	$theme_styles .= "/* UNDER PAGE TITLE IMAGE OPACITY */\n";
	$theme_styles .= ".header-background{ \n";
	$theme_styles .= "opacity: ".$under_head_opacity/100  ." !important;\n";
	$theme_styles .= "} \n\n";
}


/**
 *	HEADINGS (TITLES) DECORATIONS
 *
 */

$head_decor_toggle	= apply_filters( "olea_options", "head_decor_toggle", "tiles" );
$head_decor			= apply_filters( "olea_options", "head_decor", "" );
$head_decor_opacity	= apply_filters( "olea_options", "head_decor_opacity", "30" );

if( $head_decor_toggle && $head_decor ) {
	$theme_styles .= "/* HEADINGS (TITLES) DECORATIVE STYLES */\n";
	$theme_styles .= ".archive-title:before, .archive-title:after, .page-title:before, .page-title:after, .block-title:before, .block-title:after { \n";
	$theme_styles .= "background-image: url(". $head_decor .");\n";
	$theme_styles .= "opacity: ". $head_decor_opacity .";\n";
	$theme_styles .= "}\n\n";
}


/**
 *	IMAGES HOVER OVERLAY
 *
 */

$item_overlay_color		= apply_filters( "olea_options", "item_overlay_color", "" );	
$item_overlay_opacity	= apply_filters( "olea_options", "item_overlay_opacity", "30" );	
$io_opac 				= $item_overlay_opacity / 100;
if( $item_overlay_color ) {
	$theme_styles .= "/* ITEM OVERLAY COLOR */\n";
	$theme_styles .= ".item-overlay { \nbackground: ".$item_overlay_color ."; \n opacity: ".$io_opac.";\n}\n\n";
}


/**
 *	LINKS TEXT COLOR:
 *
 */
$links_color			= apply_filters( "olea_options", "links_color", "" );	
$links_hover_color		= apply_filters( "olea_options", "links_hover_color", "" );	

if( $links_color ) {
	$theme_styles .= "/* LINKS TEXT COLOR */\n";
	$theme_styles .= "a, a:link, a:visited, .breadcrumbs > * , .has-tip, .has-tip:focus, .tooltip.opened, .panel.callout a:not(.button) , .side-nav li a:not(.button), .side-nav li.heading, .wc-loop-button, .wc-loop-button:focus {\ncolor: ". $links_color ." \n}\n\n";
	
	
}

if( $links_hover_color ) {
	$theme_styles .= "/* LINKS HOVER TEXT COLOR */\n";
	$theme_styles .= "a:hover, a:focus, .breadcrumbs > *:hover, .has-tip:hover, .wc-loop-button:hover { \ncolor: ". $links_hover_color ." \n}\n\n";

}



/**
 *	BUTTONS FONT AND BACKGROUND COLOR:
 *
 */
$buttons_bck_color			= apply_filters( "olea_options", "buttons_bck_color", "" );	
$buttons_hover_bck_color	= apply_filters( "olea_options", "buttons_hover_bck_color", "" );	
$buttons_focus_bck_color	= apply_filters( "olea_options", "buttons_focus_bck_color", "" );	
$buttons_font_color			= apply_filters( "olea_options", "buttons_font_color", "" );	
$buttons_hover_font_color	= apply_filters( "olea_options", "buttons_hover_font_color", "" );	

if( $buttons_bck_color || $buttons_font_color ) {
	$theme_styles .= "/* BUTTONS BACK AND TEXT COLORS */\n";
	$theme_styles .= "button, .button:not(.wc-loop-button), a.button:not(.wc-loop-button), button.disabled, button[disabled], button.disabled:focus,  button[disabled]:focus, .woocommerce .quantity .plus, .woocommerce .quantity .minus, .woocommerce #content .quantity .plus, .woocommerce #content .quantity .minus, .woocommerce-page .quantity .plus, .woocommerce-page .quantity .minus, .woocommerce-page #content .quantity .plus, .woocommerce-page #content .quantity .minus {\nbackground-color: rgba(". hex2rgb($buttons_bck_color) .", 1); color: ".$buttons_font_color ."\n}\n\n";
}
if( $buttons_hover_bck_color || $buttons_hover_font_color ) {
	$theme_styles .= "/* BUTTONS HOVER BACK AND TEXT COLORS */\n";
	$theme_styles .= "button:hover, .button:hover:not(.wc-loop-button), a.button:hover:not(.wc-loop-button), button.disabled:hover, button[disabled]:hover, .woocommerce .quantity .plus:hover, .woocommerce .quantity .minus:hover, .woocommerce #content .quantity .plus:hover, .woocommerce #content .quantity .minus:hover, .woocommerce-page .quantity .plus:hover, .woocommerce-page .quantity .minus:hover, .woocommerce-page #content .quantity .plus:hover, .woocommerce-page #content .quantity .minus:hover { \n";
	
	$theme_styles .= $buttons_hover_bck_color ? "background-color: rgba(". hex2rgb($buttons_hover_bck_color) .", 1) !important; \n" : "";
	$theme_styles .= $buttons_hover_font_color ? "color: ".$buttons_hover_font_color.";\n" : "";
	$theme_styles .= "}\n\n";
}
if( $buttons_focus_bck_color  ) {
	$theme_styles .= "/* BUTTONS FOCUS BACK AND TEXT COLORS */\n";
	$theme_styles .= "button:focus, .button:focus:not(.wc-loop-button), a.button:focus:not(.wc-loop-button), button.disabled:focus, button[disabled]:focus, .woocommerce .quantity .plus:focus, .woocommerce .quantity .minus:focus, .woocommerce #content .quantity .plus:focus, .woocommerce #content .quantity .minus:focus, .woocommerce-page .quantity .plus:focus, .woocommerce-page .quantity .minus:focus, .woocommerce-page #content .quantity .plus:focus, .woocommerce-page #content .quantity .minus:focus { \n";
	
	$theme_styles .= $buttons_focus_bck_color ? "background-color: rgba(". hex2rgb($buttons_focus_bck_color) .", 1) !important;\n}\n\n" : "";
}


/**
 *	HEADER FONTS, LINKS, BACKGROUND and BORDER:
 *
 */
$header_font_color				= apply_filters( "olea_options", "header_font_color", "" );	
$header_links_color				= apply_filters( "olea_options", "header_links_color", "" );	
$header_links_hover_color		= apply_filters( "olea_options", "header_links_hover_color", "" );	
$header_back_color				= apply_filters( "olea_options", "header_back_color", "#ffffff" );
$header_back_opacity			= apply_filters( "olea_options", "header_back_opacity", "85" );
$sidemenu_back_opacity			= apply_filters( "olea_options", "sidemenu_back_opacity", "85" );
$borders_lines_color			= apply_filters( "olea_options", "borders_lines_color", "85" );
$borders_lines_opacity			= apply_filters( "olea_options", "borders_lines_opacity", "20" );


if( $header_font_color ) {

	$theme_styles .= "/* HEADER FONT COLOR */\n";
	
	$theme_styles .= "#site-menu, .searchform-menu input[type=\"search\"] { \ncolor:".$header_font_color."; \n}\n\n";
			
	$theme_styles .= ".searchform-menu input::input-placeholder,\n";
	$theme_styles .= ".searchform-menu input::-webkit-input-placeholder,\n";
	$theme_styles .= ".searchform-menu input:-moz-placeholder,\n";
	$theme_styles .= ".searchform-menu input:-ms-input-placeholder ,\n";
	$theme_styles .= "#yith-ajaxsearchform input::-webkit-input-placeholder, \n";
	$theme_styles .= "#yith-ajaxsearchform input:-moz-placeholder,\n";
	$theme_styles .= "#yith-ajaxsearchform input:-ms-input-placeholder{ \ncolor:".$header_font_color."; \n}\n\n";
	
}
// HEADER LINKS AND HOVERS :
if( $header_links_color ) {
	$theme_styles .= "/* HEADER LINKS */\n";
	$theme_styles .= "#site-menu a, #main-nav-wrapper a, #secondary-nav a, .mega-clone a, .sub-clone a { \ncolor: ". $header_links_color ." \n}\n\n";
}
if( $header_links_hover_color ) {
	$theme_styles .= "/* HEADER LINKS HOVERS */\n";	
	$theme_styles .= "#site-menu a:hover, #main-nav-wrapper a:hover, #secondary-nav a:hover, .mega-clone a:hover, .sub-clone a:hover { \ncolor: ". $header_links_hover_color ." \n}\n\n";
}

//  HEADER MENU / SIDE MENUBACKGROUND COLOR:
if( $header_back_color ) {

	$theme_styles .= "/* HEADER BACK COLOR */\n";
	$theme_styles .= "#site-menu.horizontal, #site-menu-mobile { \nbackground-color:rgba(".hex2rgb($header_back_color).", ".$header_back_opacity / 100 .");  \n}\n\n";
		
	$theme_styles .= "/* SIDEMENU BACK COLOR */\n";
	$theme_styles .= "#site-menu.vertical, nav.st-menu   { \nbackground-color:rgba(".hex2rgb($header_back_color).", ".$sidemenu_back_opacity / 100 .");  \n}\n\n";
	
	$theme_styles .= ".stick-it-header, ul.navigation li ul { \nbackground-color:rgba(".hex2rgb($header_back_color).", 0.9 );  \n}\n\n";
	
	$theme_styles .= "/* SUBS, MEGAS and MINI CART back color */\n";
	$theme_styles .= ".mega-clone, .sub-clone, .sub-clone li .sub-menu ,.mobile-sticky.stuck, #secondary-nav ul.navigation li ul, .mini-cart-list { \nbackground-color: ".$header_back_color .";  \n}\n\n";
	
	$theme_styles .= ".mini-cart-list .arrow-up, .mini-cart-list .arrow-up:before { \n border-bottom-color: ".$header_back_color .";  \n}\n\n";
	
	$theme_styles .= ".menu-border:before { \nbackground-color:". $header_back_color ."; \n}\n\n";
	
	$theme_styles .= ".active-mega span { \nborder-right-color:". $header_back_color ." \n}\n\n";
}

if( $borders_lines_color ){
	
	$border_c =  "rgba(".hex2rgb($borders_lines_color).", ".$borders_lines_opacity/100 .")";
	
	$theme_styles .= "/* BORDER COLOR FOR HEADER AND FEW OTHERS */\n";
	$theme_styles .= "#site-menu.horizontal .topbar, .horizontal ul.navigation > li > a:before, .sub-clone li a,  .border-bottom, .border-top, .searchform-menu input[type=\"search\"], #searchform input[type=\"search\"], #secondary .widget h4, #site-menu .widget h4, .product-filters h4.widget-title, .woocommerce ul.products.list li:after, ul.tabs:before, ul.tabs:after, .mega-clone > li ul li a, .sub-clone li a, .sub-menu li a, .mega-clone > li.section-title a, .lookbook-product, article, .woocommerce.widget_layered_nav li, .woocommerce.widget_product_categories li, article h2.post-title, .horizontal #main-nav-wrapper ul.navigation > li > a, \n ";
	
	$theme_styles .= "body.vertical-layout .mega-clone, body.vertical-layout .sub-clone,\n";
	
	$theme_styles .= ".wpb_tabs_nav:before, .wpb_tabs_nav:after , \n";
	$theme_styles .= ".taxonomy-menu:before, .taxonomy-menu:after , \n";
	
	$theme_styles .= ".wpb_accordion .wpb_accordion_wrapper .wpb_accordion_section .wpb_accordion_header, .vc_toggle_title,";
	
	/* TO DO - line bellow place in separate control */
	$theme_styles .= ".custom-menu.vertical > ul.custom-nav > li:first-child a:before { \n ";
	$theme_styles .= "border-color:".$border_c." !important; \n} \n\n";
	
	$theme_styles .= ".active-mega span.arrow-left.second {\n";
		$theme_styles .= "border-right-color:".( $border_c ? $border_c : "inherit")  . ";\n";
	$theme_styles .= "} \n\n";
	
	$theme_styles .= ".anim-wrap:hover {\n";
		$theme_styles .= "box-shadow: inset 0 0 1px 1px ".$border_c.";\n";
	$theme_styles .= "}\n\n";
	
	$theme_styles .= ".mega-clone, .sub-clone, .sub-clone ul, .mini-cart-list {\n";
		$theme_styles .= "box-shadow: inset 0 0 0 5px ".$border_c.", 5px 0 15px rgba(0, 0, 0, 0.15);\n";
	$theme_styles .= "}\n\n";
		
}


/**
 *	LOGO AND TITLE SETTINGS
 *
 *	- logo width (height s auto)
 *	- title font size and word-wrap: break-word toggle 
 *
 */
$logo_width		  = apply_filters( "olea_options", "logo_width", "" );
$logo_height	  = apply_filters( "olea_options", "logo_height", "" );
$title_size		  = apply_filters( "olea_options", "title_font_size", "100" );
$title_break_word = apply_filters( "olea_options", "title_break_word", 0 );
 
if( $logo_width  ) {
	if( $logo_width >= 300 ) {
		$theme_styles .= "/* LOGO WIDTH - IF SET > 300 px */\n";
		$theme_styles .= "#site-menu.vertical  { width: 320px; }\n";
		$theme_styles .= ".vertical #site-title h1 img  { width: 100%; }\n";
		$theme_styles .= "#page.vertical, footer.vertical { margin-left: 320px; }\n\n";

	}elseif ( $logo_width < 300 && $logo_width >= 250 ) {
		$theme_styles .= "/* LOGO WIDTH - IF SET 250 - 300 px */\n";
		$theme_styles .= "#site-menu.vertical  { width: ". ( $logo_width + 20 ) ."px; }\n";
		$theme_styles .= ".vertical #site-title h1 img  { width: ". $logo_width ."px; }\n";
		$theme_styles .= "#page.vertical, footer.vertical { margin-left: ". ( $logo_width + 20 ) ."px; }\n\n";
		 
	}elseif ( $logo_width < 250 ) {
		$theme_styles .= "/* LOGO WIDTH - IF SET < 250px */\n";
		$theme_styles .= "#site-menu.vertical  { width: 270px; }\n";
		$theme_styles .= ".vertical #site-title h1 img  { width: ". $logo_width ."px; }\n";
		$theme_styles .= "#page.vertical, footer.vertical { margin-left: 270px; }\n\n";
	}
}

if(	$logo_height ) {
	$theme_styles .= "/* LOGO HEIGHT - FOR HORIZ LAYOUT */\n";
	$theme_styles .= ".horizontal #site-title h1 img { \nmax-height: ".$logo_height."px \n}\n\n";
}

if( $title_size ) {
	$theme_styles .= "/* SITE TITLE FONT SIZE */\n";
	$theme_styles .= "#site-title h1, .stick-it-header h1 {\nfont-size: ".$title_size."%;\n}\n\n";
}
if( $title_break_word ) {
	$theme_styles .= "/* SITE TITLE BREAK-WORD PROPERTY */\n";
	$theme_styles .= "#site-title h1 {\n word-wrap: break-word; \n}\n\n";
}



/**
 *	BODY BACKGROUND PROPERTIES:
 *
 */
$body_bg_toggle 	= apply_filters( "olea_options", "body_bg_toggle", "none" );
$body_bg_default	= apply_filters( "olea_options", "body_bg_default", "" ); //default tiles
$body_bg_uploaded	= apply_filters( "olea_options", "body_bg_uploaded", "" ); // uploaded site bg images
$body_bg_properties	= apply_filters( "olea_options", "body_bg_controls", array() );
$body_bg_repeat		= $body_bg_properties['repeat'];
$body_bg_position	= $body_bg_properties['position'];
$body_bg_attachment	= $body_bg_properties['attachment'];
$body_bg_size		= $body_bg_properties['size'];
$body_bg_color		= apply_filters( "olea_options", "body_back_color", array() );
$body_c_opacity		= apply_filters( "olea_options", "body_back_color_opacity", "100" );

if( $body_bg_toggle != 'none' ) {

$theme_styles .= "#page, .page-template-page-blank > section, .page-template-page-blank_footerwidgets > section {\n";

	if( $body_bg_toggle != 'none' ) {
		$theme_styles .= "/* PAGE ( CONTENT - #page element) BACK IMAGE  */\n";
		$theme_styles .= ($body_bg_toggle == 'default' && $body_bg_default ) ? "\nbackground-image: url(". $body_bg_default .") ;\n" : null;
		$theme_styles .= ($body_bg_toggle == 'upload' && $body_bg_uploaded) ? "\nbackground-image: url(". $body_bg_uploaded .") ;\n" : null;
		
		
		$theme_styles .= $body_bg_repeat	 ? "background-repeat: ".$body_bg_repeat.";\n" : null;
		$theme_styles .= $body_bg_position	 ? "background-position: ".$body_bg_position.";\n" : null;
		$theme_styles .= $body_bg_attachment ? "background-attachment: ".$body_bg_attachment.";\n" : null;
		$theme_styles .= $body_bg_size		 ? "background-size: ".$body_bg_size.";\n" : null;
		
	};

$theme_styles .= "}\n\n";
	
};

if( $body_bg_color ) {
	$theme_styles .= "/* PAGE BACK COLOR  */\n";
	$theme_styles .= "#page {\nbackground-color: rgba(".hex2rgb($body_bg_color).', '.$body_c_opacity / 100 .");\n}\n\n";

	// BODY BACK FOR ONEPAGER MENU BACK
	$theme_styles .= "/* ONEPAGER BACK COLOR  */\n";
	$theme_styles .= ".aq_block_onepager_menu { \nbackground-color: rgba(".hex2rgb( $body_bg_color ).", 0.9);  \n}\n\n";

	$theme_styles .= ".product-filters-wrap { \nbackground-color: rgba(".hex2rgb($body_bg_color).", 0.9); \n}\n\n";

	// WIDGET ICONS BACKGROUNDS
	$theme_styles .= ".widget h4:before { \nbackground: ".$body_bg_color."; \n}\n\n";
}



/**
 *	FOOTER LINKS AND BUTTONS COLOR:
 *
 */
$footer_font_color			= apply_filters( "olea_options", "footer_font_color", "" );	
$footer_links_color			= apply_filters( "olea_options", "footer_links_color", "" );	
$footer_links_hover_color	= apply_filters( "olea_options", "footer_links_hover_color", "" );	
$footer_back_color			= apply_filters( "olea_options", "footer_back_color", "" );
$footer_back_opacity		= apply_filters( "olea_options", "footer_back_opacity", "80" );

$footer_bc_IE8 = str_replace('#','', $footer_back_color);

// text colors
if( $footer_font_color ) {
	$theme_styles .= "\n /* FOOTER TEXT COLOR  */\n";
	$theme_styles .= "footer { \ncolor: ". $footer_font_color ." \n}\n\n";
}
// links and hovers
if( $footer_links_color ) {
	$theme_styles .= "/* FOOTER LINKS COLOR  */\n";
	$theme_styles .= "footer a:link, footer a:visited, footer button, footer .button { \ncolor: ". $footer_links_color ." \n}\n\n";
}
if( $footer_links_hover_color ) {
	$theme_styles .= "/* FOOTER LINKS HOVER COLOR  */\n";	
	$theme_styles .= "footer a:hover, footer button:hover, footer .button:hover { \ncolor: ". $footer_links_hover_color ." \n}\n\n";
}
if( $footer_back_color ) {	
	$theme_styles .= "/* FOOTER BACK COLOR  */\n";	
	$theme_styles .= "footer { \nbackground-color: rgba(". hex2rgb($footer_back_color) .", ". $footer_back_opacity/100 ."); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\"#cc".$footer_bc_IE8."\", endColorstr=\"#cc".$footer_bc_IE8."\",GradientType=0 );  \n}\n\n";
}
/**
 *	FOOTER BACKGROUND:
 *
 */
$footer_bg_toggle 		= apply_filters( "olea_options", "footer_bg_toggle", "none" );
$footer_bg_default		= apply_filters( "olea_options", "footer_bg_default", "none" ); //default tiles
$footer_bg_uploaded		= apply_filters( "olea_options", "footer_bg_uploaded", "none" ); // uploaded site bg images
$footer_bg_controls		= apply_filters( "olea_options", "footer_bg_controls", "none" ); // uploaded site bg images
$footer_bg_repeat		= $footer_bg_controls['repeat'];
$footer_bg_position		= $footer_bg_controls['position'];
$footer_bg_attachment	= $footer_bg_controls['attachment'];
$footer_bg_size			= $footer_bg_controls['size'];

if( $footer_bg_toggle != 'none' ) {

	$theme_styles .= "footer {\n";

		if( $footer_bg_toggle != 'none' ) {
			$theme_styles .= "/* FOOTER BACK IMAGE  */\n";
			$theme_styles .= ($footer_bg_toggle == 'default' && $footer_bg_default ) ? "\nbackground-image: url(". $footer_bg_default .") ;\n" : null;
			$theme_styles .= ($footer_bg_toggle == 'upload' && $footer_bg_uploaded) ? "\nbackground-image: url(". $footer_bg_uploaded .") ;\n" : null;
			
			
			$theme_styles .= $footer_bg_repeat	 	? "background-repeat: ".$footer_bg_repeat.";\n" : null;
			$theme_styles .= $footer_bg_position	? "background-position: ".$footer_bg_position.";\n" : null;
			$theme_styles .= $footer_bg_attachment	? "background-attachment: ".$footer_bg_attachment.";\n" : null;
			$theme_styles .= $footer_bg_size		? "background-size: ".$footer_bg_size.";\n" : null;
			
		};

	$theme_styles .= "}\n\n";

}

/**
 *	CUSTOM CSS
 *
 */
$header_custom_css	= apply_filters( "olea_options", "header_custom_css", "" );
$orientation		= apply_filters( "olea_options", "orientation", "horizontal" );
if( $header_custom_css && $orientation == 'horizontal' ) {
	$theme_styles .= "\n\n /* THEME OPTIONS CUSTOM CSS STYLES - HEADER */\n\n ";
	$theme_styles .= $header_custom_css;
}
$custom_css		=  apply_filters( "olea_options", "custom_css", "" );
if( $custom_css ) {
	$theme_styles .= "\n\n /* THEME OPTIONS CUSTOM CSS STYLES */\n\n ";
	$theme_styles .= $custom_css;
}

//echo wp_kses_decode_entities( $theme_styles );
echo html_entity_decode( $theme_styles , ENT_QUOTES, 'UTF-8' );

?>
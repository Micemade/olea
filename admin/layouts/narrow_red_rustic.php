<?php
if( !isset($_GET['activated'])) {
header("Content-type: text/css; charset: UTF-8");
};
$skin_styles = "";
$skin_styles .= '
html, body { 
font-size:16px;
}

body { 
/* BODY FONT STYLE - GOOGLE FONT */
font-family:"Lato", Helvetica, Arial, sans-serif ;
font-weight:400;
color:#333333;
}
	
	 .button, .onsale, .taxonomy-menu h4, button, input#s, input[type="button"], input[type="email"], input[type="reset"], input[type="submit"], input[type="text"], select, textarea { 
	 font-family: "Lato", Helvetica, Arial, sans-serif;
	 }
	 
/* HEADING STYLE - GOOGLE FONT */
h1, h2, h3, h4, h5, h6 { 
font-family: "Amatic SC", Helvetica, Arial, sans-serif ;
font-weight: 400;
}
	/* 
	.navigation a, .as-megamenu a, .sub-clone a, .taxonomy-menu a, .wpb_tabs_nav li,  .billing_country_chzn, .chzn-drop, .navbar .nav, .price, footer  { 
	font-family: "Amatic SC", Helvetica, Arial, sans-serif; 
	}
	 */
/* UNDER PAGE TITLE IMAGE OPACITY */
.header-background{ 
opacity: 0.3 !important;
} 

/* HEADINGS (TITLES) DECORATIVE STYLES */
.archive-title:before, .archive-title:after, .page-title:before, .page-title:after, .block-title:before, .block-title:after { 
background-image: url('. get_template_directory_uri() .'/img/head_decor/lines_05.png);
opacity: 0.3;
}

/* LINKS TEXT COLOR */
a, a:link, a:visited, .breadcrumbs > * , .has-tip, .has-tip:focus, .tooltip.opened, .panel.callout a:not(.button) , .side-nav li a:not(.button), .side-nav li.heading, .wc-loop-button, .wc-loop-button:focus {
color: #E47575 
}

/* LINKS TEXT COLOR */
a:hover, a:focus, .breadcrumbs > *:hover, .has-tip:hover, .wc-loop-button:hover { 
color: #E47575 
}

/* BUTTONS BACK AND TEXT COLORS */
button, .button:not(.wc-loop-button), a.button:not(.wc-loop-button), button.disabled, button[disabled], button.disabled:focus,  button[disabled]:focus, .woocommerce .quantity .plus, .woocommerce .quantity .minus, .woocommerce #content .quantity .plus, .woocommerce #content .quantity .minus, .woocommerce-page .quantity .plus, .woocommerce-page .quantity .minus, .woocommerce-page #content .quantity .plus, .woocommerce-page #content .quantity .minus {
background-color: rgba(247, 247, 247, 1); color: #080808
}

/* BUTTONS HOVER BACK AND TEXT COLORS */
button:hover, .button:hover:not(.wc-loop-button), a.button:hover:not(.wc-loop-button), button.disabled:hover, button[disabled]:hover, .woocommerce .quantity .plus:hover, .woocommerce .quantity .minus:hover, .woocommerce #content .quantity .plus:hover, .woocommerce #content .quantity .minus:hover, .woocommerce-page .quantity .plus:hover, .woocommerce-page .quantity .minus:hover, .woocommerce-page #content .quantity .plus:hover, .woocommerce-page #content .quantity .minus:hover { 
background-color: rgba(228, 117, 117, 1) !important; color: #f5f5f5
}

/* BUTTONS FOCUS BACK AND TEXT COLORS */
button:focus, .button:focus:not(.wc-loop-button), a.button:focus:not(.wc-loop-button), button.disabled:focus, button[disabled]:focus, .woocommerce .quantity .plus:focus, .woocommerce .quantity .minus:focus, .woocommerce #content .quantity .plus:focus, .woocommerce #content .quantity .minus:focus, .woocommerce-page .quantity .plus:focus, .woocommerce-page .quantity .minus:focus, .woocommerce-page #content .quantity .plus:focus, .woocommerce-page #content .quantity .minus:focus { 
background-color: rgba(181, 181, 181, 1) !important;
}

/* HEADER BACK COLOR */
#site-menu.horizontal, #site-menu-mobile { 
background-color:rgba(255, 255, 255, 0.75);  
}

/* SIDEMENU BACK COLOR */
#site-menu.vertical, nav.st-menu   { 
background-color:rgba(255, 255, 255, 0.75);  
}

.stick-it-header, ul.navigation li ul { 
background-color:rgba(255, 255, 255, 0.9 );  
}

/* SUBS, MEGAS and MINI CART back color */
.mega-clone, .sub-clone, .sub-clone li .sub-menu ,.mobile-sticky.stuck, #secondary-nav ul.navigation li ul, .mini-cart-list { 
background-color: #ffffff;  
}

.mini-cart-list .arrow-up, .mini-cart-list .arrow-up:before { 
 border-bottom-color: #ffffff;  
}

.menu-border:before { 
background-color:#ffffff; 
}

.active-mega span { 
border-right-color:#ffffff 
}

/* BORDER COLOR FOR HEADER AND FEW OTHERS */
#site-menu.horizontal .topbar, .horizontal ul.navigation > li > a:before, .sub-clone li a,  .border-bottom, .border-top, .searchform-menu input[type="search"], #searchform input[type="search"], #secondary .widget h4, #site-menu .widget h4, .product-filters h4.widget-title, .woocommerce ul.products.list li:after, ul.tabs:before, ul.tabs:after, .mega-clone > li ul li a, .sub-clone li a, .sub-menu li a, .mega-clone > li.section-title a, .lookbook-product, article, .woocommerce.widget_layered_nav li, .woocommerce.widget_product_categories li, article h2.post-title,
.horizontal #main-nav-wrapper ul.navigation > li > a,
body.vertical-layout .mega-clone, body.vertical-layout .sub-clone,
.wpb_tabs_nav:before, .wpb_tabs_nav:after , 
.taxonomy-menu:before, .taxonomy-menu:after , 
.wpb_accordion .wpb_accordion_wrapper .wpb_accordion_section .wpb_accordion_header, .vc_toggle_title,.custom-menu.vertical > ul.custom-nav > li:first-child a:before { 
 border-color:rgba(33, 33, 33, 0.3) !important; 
} 

.active-mega span.arrow-left.second {
border-right-color:rgba(33, 33, 33, 0.3);
} 

.anim-wrap:hover {
box-shadow: inset 0 0 1px 1px rgba(33, 33, 33, 0.3);
}

.mega-clone, .sub-clone, .sub-clone ul, .mini-cart-list {
box-shadow: inset 0 0 0 5px rgba(33, 33, 33, 0.3), 5px 0 15px rgba(0, 0, 0, 0.15);
}


/* SITE TITLE FONT SIZE */
#site-title h1, .stick-it-header h1 {
font-size: 100%;
}

#page, .page-template-page-blank > section, .page-template-page-blank_footerwidgets > section {
/* PAGE ( CONTENT - #page element) BACK IMAGE  */

background-image: url('. get_template_directory_uri() .'/img/bg/znoimage.png) ;
background-repeat: repeat;
background-position: center;
background-attachment: scroll;
}

/* PAGE BACK COLOR  */
#page {
background-color: rgba(255, 255, 255, 1);
}

/* ONEPAGER BACK COLOR  */
.aq_block_onepager_menu { 
background-color: rgba(255, 255, 255, 0.9);  
}

.product-filters-wrap { 
background-color: rgba(255, 255, 255, 0.9); 
}

.widget h4:before { 
background: #ffffff; 
}



/* THEME OPTIONS CUSTOM CSS STYLES */

.anim-wrap,  .taxonomy-menu li.category-link a, .taxonomy-menu li.one-pager-item a, .wpb_tabs_nav li a, .single-item-block .item-img, .category-image .term, .product-categories .term, .lookbook-product .entry-image {
	border: 1px solid !important;
	border-color: rgba(33, 33, 33, 0.3) !important;
	background: none;
}
.owl-carousel .owl-prev,
.owl-carousel .owl-next,
.entry-image {
	overflow: hidden;
}
button, .button, a.button, button.disabled, button[disabled], button.disabled:focus, button[disabled]:focus, .woocommerce .quantity .plus, .woocommerce .quantity .minus, .woocommerce #content .quantity .plus, .woocommerce #content .quantity .minus, .woocommerce-page .quantity .plus, .woocommerce-page .quantity .minus, .woocommerce-page #content .quantity .plus, .woocommerce-page #content .quantity .minus {
	border: 1px solid;
	border-color: rgba(33, 33, 33, 0.3);
}

li.category-link a.active:after, li.category-link.current a:after, li.one-pager-item.current a:after, .wpb_tabs_nav li.ui-tabs-active a:after {
	border-top: 8px solid rgba(150, 150, 150, 0.7);
}

.cb-2 .style2 h4:after,
.cb-3 .style2 h4:after {
	content: "";
	display: block;
	position: absolute;
	bottom: 0;
	width: 50px;
	height: 1px;
	border-top: 1px solid;
	left: 50%;
	margin-left: -25px;
	opacity: 0.5;
}
.content-block h4, .woocommerce ul.products li h3 {
	letter-spacing: -0.02rem; 
}
.content-block .item .excerpt p {
	font-size: 0.84rem;
}
';

$g_FontBody	= apply_filters( "olea_options", "google_body", array('face'=>'Roboto', 'size'=>'16px', 'weight'=>'400', 'color'=>'#333333') );
$g_FontHeadings	= apply_filters( "olea_options", "google_headings", array('face'=>'Crushed', 'weight'=>'400', 'color'=>'') );
$google_typekit = apply_filters( "olea_options", "google_typekit_toggle", "google" );

// FONT TWEAKS FOR CURRENT SKIN ( demo uses Typekit fonts for headings, differently rendered )

if( $google_typekit == 'google' || $g_FontHeadings['face'] == 'Amatic SC'  ) {
	
	$skin_styles .= 'article h2.post-title { font-size: 2.9rem; }';
	$skin_styles .= 'h1,h2,h3,h4,h5,h6 { font-weight: bold;}';
	$skin_styles .= '#secondary .widget h4, #site-menu .widget h4, .product-filters h4.widget-title, .bottom-widgets .widget h4, footer .widget h5 { font-size: 1.6rem; }';
	$skin_styles .= '.content-block h4, .content-block .back h4.prod-title, .woocommerce ul.products li h3 { font-size: 2.4em; }';
	$skin_styles .= '.single-item-block h3 { font-size: 2.2rem; }';
	$skin_styles .= '.content-block span.posted_in a { font-size: 1.4rem;font-weight: bold;}';
	$skin_styles .= '.woocommerce-tabs .panel h2 { font-size: 2rem; }';
	$skin_styles .= '.single-item-block .lookbook-product h3 {font-size: 1.6rem; }';
	$skin_styles .= '.type-lookbook h2.lookbook-title { font-size: 1.8rem;}';
	$skin_styles .= '.ship-to-different-address label { font-size: 1.6rem;}';
	$skin_styles .= '.woocommerce .product-category h4, .woocommerce-page .product-category h4 { font-size: 1.6rem; }';
	$skin_styles .= '.article .caption h5 { font-size: 1.5rem; }';
}

//echo wp_kses_decode_entities($skin_styles);
echo html_entity_decode( $skin_styles , ENT_QUOTES, 'UTF-8' );

?>
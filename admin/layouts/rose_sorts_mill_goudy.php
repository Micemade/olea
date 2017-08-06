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
font-family:Dosis, Helvetica, Arial, sans-serif;
font-weight:400;
color:#333333;
/* BODY BACKGROUND */
background-image: url('. get_template_directory_uri() .'/img/bg/skulls.png);
background-repeat: repeat;
background-position: center;
background-attachment: scroll;
}

	.button, .onsale, .taxonomy-menu h4, button, input#s, input[type="button"], input[type="email"], input[type="reset"], input[type="submit"], input[type="text"], select, textarea { 
	 font-family: Dosis, Helvetica, Arial, sans-serif;
	}


/* HEADING STYLE - GOOGLE FONT */
h1, h2, h3, h4, h5, h6 { 
font-family: "Sorts Mill Goudy", Helvetica, Arial, sans-serif;
font-weight: 400;
}

	/* 
	.navigation a, .as-megamenu a, .sub-clone a, .taxonomy-menu a, .wpb_tabs_nav li,  .billing_country_chzn, .chzn-drop, .navbar .nav, .price, footer  { 
	font-family: "Sorts Mill Goudy", Helvetica, Arial, sans-serif; 
	}
	*/
	
/* UNDER PAGE TITLE IMAGE OPACITY */
.header-background{ 
opacity: 0.3 !important;
} 

/* HEADINGS (TITLES) DECORATIVE STYLES */
.archive-title:before, .archive-title:after, .page-title:before, .page-title:after, .block-title:before, .block-title:after { 
background-image: url('. get_template_directory_uri() .'/img/head_decor/vertical_03.png);
opacity: 0.3;
}

/* LINKS TEXT COLOR */
a, a:link, a:visited, .breadcrumbs > * , .has-tip, .has-tip:focus, .tooltip.opened, .panel.callout a:not(.button) , .side-nav li a:not(.button), .side-nav li.heading,.wc-loop-button,.wc-loop-button:focus {
color: #E25A5A 
}

/* LINKS TEXT COLOR */
a:hover, a:focus, .breadcrumbs > *:hover, .has-tip:hover,.wc-loop-button:hover { 
color: #E25A5A 
}

/* BUTTONS BACK AND TEXT COLORS */
button, .button:not(.wc-loop-button), a.button:not(.wc-loop-button), button.disabled, button[disabled], button.disabled:focus,  button[disabled]:focus, .woocommerce .quantity .plus, .woocommerce .quantity .minus, .woocommerce #content .quantity .plus, .woocommerce #content .quantity .minus, .woocommerce-page .quantity .plus, .woocommerce-page .quantity .minus, .woocommerce-page #content .quantity .plus, .woocommerce-page #content .quantity .minus {
background-color: rgba(226, 90, 90, 1); color: #ebebeb
}

/* BUTTONS HOVER BACK AND TEXT COLORS */
button:hover, .button:hover:not(.wc-loop-button), a.button:hover:not(.wc-loop-button), button.disabled:hover, button[disabled]:hover, .woocommerce .quantity .plus:hover, .woocommerce .quantity .minus:hover, .woocommerce #content .quantity .plus:hover, .woocommerce #content .quantity .minus:hover, .woocommerce-page .quantity .plus:hover, .woocommerce-page .quantity .minus:hover, .woocommerce-page #content .quantity .plus:hover, .woocommerce-page #content .quantity .minus:hover { 
background-color: rgba(235, 235, 235, 1) !important; color: #2b2b2b
}

/* BUTTONS FOCUS BACK AND TEXT COLORS */
button:focus, .button:focus:not(.wc-loop-button), a.button:focus:not(.wc-loop-button), button.disabled:focus, button[disabled]:focus, .woocommerce .quantity .plus:focus, .woocommerce .quantity .minus:focus, .woocommerce #content .quantity .plus:focus, .woocommerce #content .quantity .minus:focus, .woocommerce-page .quantity .plus:focus, .woocommerce-page .quantity .minus:focus, .woocommerce-page #content .quantity .plus:focus, .woocommerce-page #content .quantity .minus:focus { 
background-color: rgba(181, 181, 181, 1) !important;
}

/* HEADER BACK COLOR */
#site-menu.horizontal, #site-menu-mobile { 
background-color:rgba(251, 252, 235, 0.75);  
}

/* SIDEMENU BACK COLOR */
#site-menu.vertical, nav.st-menu   { 
background-color:rgba(251, 252, 235, 0.75);  
}

.stick-it-header, ul.navigation li ul { 
background-color:rgba(251, 252, 235, 0.9 );  
}

/* SUBS, MEGAS and MINI CART back color */
.mega-clone, .sub-clone, .sub-clone li .sub-menu ,.mobile-sticky.stuck, #secondary-nav ul.navigation li ul, .mini-cart-list { 
background-color: #FBFCEB;  
}

.mini-cart-list .arrow-up, .mini-cart-list .arrow-up:before { 
 border-bottom-color: #FBFCEB;  
}

.menu-border:before { 
background-color:#FBFCEB; 
}

.active-mega span { 
border-right-color:#FBFCEB 
}

/* BORDER COLOR FOR HEADER AND FEW OTHERS */
#site-menu.horizontal .topbar, .horizontal ul.navigation > li > a:before, .sub-clone li a,  .border-bottom, .border-top, .searchform-menu input[type="search"], #searchform input[type="search"], #secondary .widget h4, #site-menu .widget h4, .product-filters h4.widget-title, .woocommerce ul.products.list li:after, ul.tabs:before, ul.tabs:after, .mega-clone > li ul li a, .sub-clone li a, .sub-menu li a, .mega-clone > li.section-title a, .lookbook-product, article, .woocommerce.widget_layered_nav li, .woocommerce.widget_product_categories li, article h2.post-title,
.horizontal #main-nav-wrapper ul.navigation > li > a,
body.vertical-layout .mega-clone, body.vertical-layout .sub-clone,
.wpb_tabs_nav:before, .wpb_tabs_nav:after , 
.taxonomy-menu:before, .taxonomy-menu:after , 
.wpb_accordion .wpb_accordion_wrapper .wpb_accordion_section .wpb_accordion_header, .vc_toggle_title,.custom-menu.vertical > ul.custom-nav > li:first-child a:before { 
 border-color:rgba(226, 90, 90, 0.2) !important; 
} 

.active-mega span.arrow-left.second {
border-right-color:rgba(226, 90, 90, 0.2);
} 

.anim-wrap:hover {
box-shadow: inset 0 0 1px 1px rgba(226, 90, 90, 0.2);
}

.mega-clone, .sub-clone, .sub-clone ul, .mini-cart-list {
box-shadow: inset 0 0 0 5px rgba(226, 90, 90, 0.2), 5px 0 15px rgba(0, 0, 0, 0.15);
}

/* SITE TITLE FONT SIZE */
#site-title h1, .stick-it-header h1 {
font-size: 100%;
}

/* PAGE BACK COLOR  */
#page {
background-color: rgba(251, 252, 235, 0.8);
}

/* ONEPAGER BACK COLOR  */
.aq_block_onepager_menu { 
background-color: rgba(251, 252, 235, 0.9);  
}

.product-filters-wrap { 
background-color: rgba(251, 252, 235, 0.9); 
}

.widget h4:before { 
background: #FBFCEB; 
}

/* FOOTER BACK COLOR  */
footer { 
background-color: rgba(219, 219, 219, 0.8); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#ccdbdbdb", endColorstr="#ccdbdbdb",GradientType=0 );  
}



 /* THEME OPTIONS CUSTOM CSS STYLES */
 .taxonomy-menu li.category-link a, .taxonomy-menu li.one-pager-item a, .wpb_tabs_nav li a {
	background: none;
	border-top: 1px solid !important;
	border-bottom: 3px solid !important;
	border-color: inherit;
	border-radius: 0;
	margin: 0 0.3rem;
}

li.category-link a.active:after, li.category-link.current a:after, li.one-pager-item.current a:after, .wpb_tabs_nav li.ui-tabs-active a:after {
	bottom: -12px;
	border-top-color: inherit;
}
.menu-item span.desc,
.sub-clone .menu-item span.desc {
font-size: 0.9rem;
}
';

//echo wp_kses_decode_entities( $skin_styles );
echo html_entity_decode( $skin_styles , ENT_QUOTES, 'UTF-8' );
?>
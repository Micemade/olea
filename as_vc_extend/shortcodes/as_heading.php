<?php
function as_heading_func( $atts, $content = null ) {

extract( shortcode_atts( array(
		'title'			=> '',
		'subtitle'		=> '',
		'sub_position'	=> 'bellow',
		'title_style'	=> 'center',
		'title_color'	=> '',
		'subtitle_color'=> '',
		'bck_color'		=> '',
		'tag'			=> '',
		'enter_anim'	=> 'none',
		'anim_delay'	=> 0,
		'no_decoration'	=> '',
		'title_size'	=> '',
		'abs_heading'	=> '',
		'abs_top'		=> '',
		'abs_left'		=> '',
		'abs_right'		=> '',
		
		'css_classes'	=> '',
		'block_id'		=> generateRandomString()
		  
	), $atts ) );
		

####################  HTML STARTS HERE: #########################

ob_start();
echo $css_classes ? '<div class="'.esc_attr($css_classes).'">' : null;
?>

<?php
if( $abs_heading || $bck_color ) {
	echo '<style scoped>';
	echo '#heading-'.$block_id.' {';
	echo $abs_top	? 'top:'.$abs_top.';' : '';
	echo $abs_left	? 'left:'.$abs_left.';' : '';
	echo $abs_right ? 'right:'.$abs_right.';' : '';
	echo $bck_color	? 'background-color: '.$bck_color.';' : '';
	echo '}';
	echo '</style>';
}
?>

<div class="header-holder categories-block <?php echo esc_attr($title_style); ?> titles-holder<?php echo $no_decoration ? ' no-decor' : ''; ?> <?php echo $abs_heading ? ' absolute' : ''; ?>" id="heading-<?php echo esc_attr($block_id) ?>">
<?php 
// DISPLAY BLOCK TITLE AND "SUBTITLE":
$sub = $subtitle ? '<div class="block-subtitle '. esc_attr($sub_position). ' ' .esc_attr($title_style) .'"'. ($subtitle_color ? ' style="color:'.$subtitle_color.';"' : '') . '>' . esc_html($subtitle) . '</div>' : '';

$title_css  = 'style="';
$title_css .= $title_color ? 'color:'. esc_attr($title_color) .'; ' : '';
$title_css .= $title_size ? 'font-size:'. esc_attr($title_size) .';' : '';
$title_css .= '"';

echo $sub_position == 'above'  ? wp_kses_post($sub) : '';

$h = $tag ? $tag : 'h3';
echo $title ? '<'.$h.' class="block-title '. esc_attr($title_style) .'" '. $title_css . '>' . esc_html($title) . '</'.$h.'>' : '';

echo $sub_position == 'bellow'  ? wp_kses_post($sub) : '';
?>
</div> 

<?php $delay = $anim_delay ? $anim_delay : 100 ?>

<script>
jQuery(document).ready( function($) {

var thisBlock = $('#map-<?php echo esc_js($block_id); ?>-holder');

if ( !window.isMobile && !window.isIE9 ) {

	thisBlock.waypoint(
	
		function(direction) {
			
			if( direction === "up" ) {	
				
				thisBlock.removeClass('animated <?php echo esc_js($enter_anim);?>').addClass('to-anim');
				
			}else if( direction === "down" ) {
				
				setTimeout(function(){
				   thisBlock.addClass('animated <?php echo esc_js($enter_anim);?>').removeClass('to-anim');
				}, <?php echo esc_js($delay); ?>);
			}
		}, 
		{ offset: "98%" }	
	
	);

}else{

	thisBlock.each( function() {
		
		$(this).removeClass('to-anim');
	
	});
	
}

});
</script>


<?php
####################  HTML ENDS HERE: ###########################
echo $css_classes ? '</div>' : null;
	
$output_string = ob_get_contents();

ob_end_clean();

return $output_string ;
####################  HTML ENDS HERE: ###########################

}
?>
<?php
/**
 * The template for displaying Search results.
 *
 * @since olea 1.0
 */

get_header();
//
$layout				= apply_filters( "olea_options", "layout", "float_left" );
$enter_anim 		= apply_filters( "olea_options", "post_enter_anim_archive", "fadeIn" );
?>	
		
<header class="archive-header">

	<?php	
	$blog_title_bcktoggle	= apply_filters( "olea_options", "blog_title_bcktoggle", 1 );
	$blog_title_backimg		= apply_filters( "olea_options", "blog_title_backimg", get_template_directory_uri(). '/img/default/header-archive.jpg' );
	if( $blog_title_bcktoggle ) {
		
		$image =  $blog_title_backimg;
		
		echo'<div class="header-background'. ( AS_UNDERHEAD_IMAGE ? ' under-head' : '') .'" style="background-image: url('. esc_url($image) .');"></div>';
	}
	?>
	
	<div class="row">
			
		<div class="small-12 table titles-holder">
		
			<h1 class="archive-title"><?php echo esc_html__("Your search: ","olea") . get_search_query(); ?></h1>
			
		</div><!-- /.row -->		
	
	</div><!-- /.row -->	

</header><!-- .archive-header -->


<div class="row">

	<div class="search-results-title"><?php esc_html_e( 'Search result(s):', 'olea' ); ?></div>

	<div id="primary" class="large-<?php echo (  $layout =='full_width' ) ? '12' : '8'; ?> <?php echo $layout ? esc_attr( $layout ) : null; ?> medium-12 small-12" role="main">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 

			get_template_part( 'content', 'search' );
		
		endwhile;

			as_show_pagination() ? as_pagination( 'nav-below' ) : null;
		
		else :
		
		?>
		
		<article>
		
			<div class="search-notfound-text">
			
				<span class="icon-no-results icon-sad"></span>
				
				<h3 class="mag_button"><?php echo esc_html__('Your search "','olea') . get_search_query() . esc_html__('" did not return any result.','olea'); ?></h3>
				
				<p><strong><?php esc_html_e("Please, try to:","olea"); ?></strong></p>
				
				<ul>
					<li><?php esc_html_e("click browser \"Back\" button","olea")?></li>
					<li><?php esc_html_e("use search to find what are you looking for","olea")?></li>
					<li><?php esc_html_e("or use sitemap bellow this message","olea")?></li>
				</ul>
				
			</div>				
				
			<?php get_template_part('site','map'); ?>
					
		</article><!-- #primary -->
		
		
		
		<?php endif; ?>

	</div><!-- /#primary -->

	<?php get_sidebar(); ?>
	
</div><!-- /.row -->
	
<?php
/*	if ( $enter_anim != 'none' && !wp_style_is( 'animate', 'enqueued' )) {wp_register_style( 'animate', get_template_directory_uri() . '/css/animate.css');wp_enqueue_style( 'animate' );} */
?>
<?php if ( $enter_anim != 'none') { ?>
<script>
jQuery(document).ready( function($) {
	
	var thisBlock	= $('#primary'),
		article		= thisBlock.find('article');
	
	if ( !window.isMobile && !window.isIE9 ) {

		article.each( function() {
		
			var thisShit = $(this);
			
			thisShit.waypoint(
			
				function(direction) {
					
					if( direction === "up" ) {	
						
						thisShit.removeClass('animated <?php echo esc_js($enter_anim);?>').addClass('to-anim');
						
					}else if( direction === "down" ) {
						
						setTimeout(function(){
						   thisShit.addClass('animated <?php echo esc_js($enter_anim);?>').removeClass('to-anim');
						}, 100);
					}
				}, 
				{ offset: "98%" }	
				
			);
			
		});

	}else{

		article.each( function() {
			
			$(this).removeClass('to-anim');
		
		});
		
	}

});
</script>
<?php } // end if ?>

<?php get_footer(); ?>
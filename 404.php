<?php
/**
 * The 404 page - 
 *
 *
 * @since olea1.0
 **/
get_header(); 
?>	
					
<header class="page-header">
	
	<?php	
	$blog_title_bcktoggle	= apply_filters( "olea_options", "blog_title_bcktoggle", 1 );
	$blog_title_backimg		= apply_filters( "olea_options", "blog_title_backimg", get_template_directory_uri(). '/img/default/header-archive.jpg' );
	
	if( $blog_title_bcktoggle ) {
		
		$image =  $blog_title_backimg;
		
		echo'<div class="header-background'. ( AS_UNDERHEAD_IMAGE ? ' under-head' : '') .'" style="background-image: url('. esc_url($image) .');"></div>';
	}
	?>
	
	<div class="row">
	
		<div class="large-12 table titles-holder">
		
			<h1 class="page-title"><?php esc_html_e( 'Page missing - 404', 'olea' ); ?></h1>
	
		</div>
		
	</div><!-- /.row -->

</header>


<div class="row">

	<div id="primary" role="main" class="large-12 column">
		
		<article id="post-0" class="post error404 not-found" style="margin-top: 3rem">

		<div aria-hidden="true">
			
			<span class="icon icon-sad"></span>
			
			<h3><?php esc_html_e('Something went wrong','olea'); ?></h3>
			<h5><?php esc_html_e("This search can help you find what you need",'olea'); ?></h5>
			<?php get_template_part('searchform','nav'); ?>
			
		</div>

		<hr>		
		
		<h4><?php esc_html_e("The reason why you're seeing this page could be one of the following:",'olea'); ?></h4>
			
		<ul>
			<li><?php esc_html_e("You clicked the broken link","olea"); ?></li>
			<li><?php esc_html_e("You typed incorrect link directly in the address bar","olea"); ?></li>
			<li><?php esc_html_e("There is a glitch in the server, database or system, or","olea"); ?></li>
			<li><?php esc_html_e("Maybe, but just maybe, it might be our mistake","olea"); ?></li>
		</ul>	
		
				
		</article>
		
	</div><!-- #primary -->		

</div><!-- /.row -->
	
<?php get_footer(); ?>
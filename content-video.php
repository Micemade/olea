<?php
/**
 *	The template part used for displaying page content - VIDEO template.
 *
 *	@since olea 1.0
 *
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
//
include( trailingslashit( get_template_directory() ) . 'template_vars.php' );
//
//
$has_content		= get_the_content();
$id = get_the_ID();
$hide_title			= get_post_meta( $id , 'as_hide_archive_titles', true);
$hide_feat_img		= get_post_meta( $id, 'as_hide_featured_image', true);
//
$classes = array();
$classes[] = ($enter_anim != 'none') ? ' to-anim' : '';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?> <?php echo ( !$has_content ? 'style="margin-bottom:0;"' : '' ); ?>>
	
	<?php if( !$hide_title ) {?>
	<a href="<?php esc_attr(the_permalink());?>" title="<?php the_title_attribute();?>" class="post-link">
	
		<h2 class="post-title"><?php the_title(); ?></h2>
		
	</a>
	<?php } ?>
	
	<?php as_entry_author(); ?>
	
	<?php as_entry_date(); ?>
	
	
	<?php
	
	$video_host			= get_post_meta( $id,'as_video_host', true);
	$video_id			= get_post_meta( $id,'as_video_id', true);
	$w					= get_post_meta( $id,'as_video_width', true);
	$h					= get_post_meta( $id,'as_video_height', true) ;
	
	echo '<div class="post-content'.($hide_feat_img ? ' no-feat-img' : '').'">';
		
		if( $video_host ){
		
			do_action('as_embed_video_action', $video_host, $video_id, $w, $h );
		
		}
		
		do_action('as_archive_content'); // smart excerpt - "inc/functions/misc_post_functions.php
		
	echo '</div>';
	
	$wlp_args = array( 
			'before'		=> '<div class="page-link"><p>' . __( 'Pages:', 'olea' ) . '</p>',
			'after'			=> '</div>',
			'link_before'	=> '<span>',
			'link_after'	=> '</span>',
		);
	
	wp_link_pages( $wlp_args );
	?>

				
	<div class="clearfix"></div>

	<div class="post-meta-bottom">
	
		<?php
		as_entryMeta_comments();
		
		if( has_category() || has_tag() || has_term( '', 'portfolio_category' ) || has_term( '', 'portfolio_tag' ) ) {
		as_entryMeta_cats_tags();
		}
		?>
		
	</div>
		
</article><!-- #post-<?php the_ID(); ?> -->
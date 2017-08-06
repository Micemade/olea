<?php
/**
 *	The template part used for displaying SINGULAR content (post, page, attachment).
 *
 *	@since olea 1.0
 *
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
//
include( trailingslashit( get_template_directory() ) . 'template_vars.php' );
//
/*	THEME OPTIONS -  */
//POST META ( date, author, cats, tags):
$of_pm			= apply_filters( "olea_options", "post_meta", array() );
$date_author	= isset( $of_pm['date_author']) ? true : false;
$categories_tags= isset( $of_pm['categories_tags'] ) ? true : false;
$comments		= isset( $of_pm['comments'] ) ? true : false;


//
//	POST CUSTOM META:
$id = get_the_ID();
$hide_feat_img = get_post_meta( $id ,'as_hide_featured_image', true);
//
//	POST TYPE AND FORMAT vars:
$post_type	= get_post_type( $id );
$format		= get_post_format( $id );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
			
	<?php
	
	$before_content = '<div class="post-content'.( ($hide_feat_img || $format == 'video') ? ' no-featured': '') .'">';
	
	$after_content = '</div>';
	
	if( $post_type == 'portfolio' ) {
		
		get_template_part('content','single-portfolio' );
	
	}elseif( $post_type == 'lookbook' ){
		
		get_template_part('content','single-lookbook' );
	
	}else{ // is regular post type - now, the post FORMATS:
		
		if ( $format == '' ) { // <------ IF POST FORMAT IS STANDARD
		
			if ( $post_type != 'attachment'  ) {
				echo $hide_feat_img ? null : as_image( 'as-landscape', $fimg_width,	$fimg_height );
			}
			
			echo wp_kses_data($before_content);
			the_content(); 
			echo wp_kses_data($after_content);
		
		}elseif ( $format == 'chat' || $format == 'status' || $format == 'aside') { // <------ IF POST FORMAT IS CHAT OR STATUS
					
			echo wp_kses_data($before_content);
			the_content(); 
			echo wp_kses_data($after_content);
		
		}elseif ( $format == 'link') { // <------------------ IF POST FORMAT IS LINK
		
			
			echo wp_kses_data($before_content);
			echo the_content();
			echo wp_kses_data($after_content);
		
		}elseif( $format == 'image' ) { // <------------------ IF POST FORMAT IS IMAGE
		
			if( !$hide_feat_img && has_post_thumbnail() ){
				echo '<div class="post-image-single">';
				the_post_thumbnail();
				echo '<div class="caption">' ;
				echo '<p>' . esc_html( as_post_thumbnail_caption() ) .'</p>';
				echo '</div>';
				echo '</div>';
			}
			
			echo wp_kses_data($before_content);
			the_content();
			echo wp_kses_data($after_content);
		
		}elseif( $format == 'gallery' ) { // <------------------ IF POST FORMAT IS GALLERY
		
			// WP GALLERY shortcode img id's
			$wpgall_ids			= apply_filters('as_wpgallery_ids','as_wp_gallery');
			
			//
			// AS GALLERY POST META:
			//
			$gall_img_array		= get_post_meta( $id,'as_gallery_images');
			$gall_image_format	= get_post_meta( $id,'as_gall_image_format', true) ; 
			$slider_thumbs		= get_post_meta( $id,'as_slider_thumbs', true); 
			$thumb_columns		= get_post_meta( $id,'as_thumb_columns', true) ; 
			
			// image ID's from meta:
			$images_ids = '';
			if( !empty($wpgall_ids) ) {
				$images_ids = implode(', ', $wpgall_ids); // get images from WP gallery
			}else{
				$images_ids = implode(', ', $gall_img_array); // get images from AS gallery
			}
			
			// function to display images with link to larger:
			echo as_gallery_output( $id, $images_ids, $slider_thumbs, $thumb_columns, $gall_image_format );
			
			echo wp_kses_data($before_content);
			the_content();
			echo wp_kses_data($after_content);
			
		}elseif( $format == 'audio' ) { // <------------------ IF POST FORMAT IS AUDIO
			
			$audio_file_id	= get_post_meta( $id,'as_audio_file', true);
			$audio_file		= wp_get_attachment_url( $audio_file_id );
			
			echo wp_kses_data($before_content);
			
			if( $audio_file ){
				
				$attr = array(
					'src'      => $audio_file,
					'loop'     => false,
					'autoplay' => false,
					'preload'  => 'none'
				);
				
				echo wp_audio_shortcode($attr);
			} 			
			
			the_content();
			
			echo wp_kses_data($after_content);

			
		}elseif( $format == 'video' ) { // <------------------ IF POST FORMAT IS VIDEO
		
			$video_host	= get_post_meta( $id,'as_video_host', true);
			$video_id	= get_post_meta( $id,'as_video_id', true);
			$w			= get_post_meta( $id,'as_video_width', true);
			$h			= get_post_meta( $id,'as_video_height', true);
			
			echo wp_kses_data($before_content);
			
			if( $video_host ){
				do_action('as_embed_video_action', $video_host, $video_id, $w, $h );
			};
			
			the_content();
			
			echo wp_kses_data($after_content);				
		
		}elseif( $format == 'quote' ) { // <------------------ IF POST FORMAT IS QUOTE
		
			$quote_author	= get_post_meta( $id,'as_quote_author', true);
			$quote_url		= get_post_meta( $id,'as_quote_author_url', true);
			$avatar			= get_post_meta( $id,'as_avatar_email', true);
		?>
			
			<?php 
			echo wp_kses_data($before_content);
			
			if( $avatar || has_post_thumbnail() ) { ?>
			<div class="avatar-img">
			
				<?php 
				echo $quote_url ? '<a href="'. esc_url($quote_url) .'" title="'. esc_attr($quote_author) .'">' : '';
				if( $avatar ) {
					echo get_avatar( $avatar , 120 );
				}elseif( has_post_thumbnail() ){
					the_post_thumbnail('thumbnail');
				}
				echo $quote_url ? '</a>' : '';
				
				$no_image = '';
				
				?>
				
			</div>
			<?php 
			}else{
				$no_image = ' no-image';
			};
			?>
		
			<div class="quote<?php echo esc_attr($no_image); ?>">
			
				<div class="arrow-left"></div>
				<?php 
				the_content(); 
				echo $quote_url ? '<a href="'. esc_url($quote_url) .'" title="'. esc_attr($quote_author) .'">' : '';
				echo $quote_author ? '<h5>'. esc_html($quote_author) .'</h5>' : '';
				echo $quote_url ? '</a>' : '';
				?>
		
			</div>
			<?php
			echo wp_kses_data($after_content);
	
		}	
	
	} // if get_post_type ...
	
	?>
	
	<?php 
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
		
		if( has_category() || has_tag() || has_term( '', 'portfolio_category' ) || has_term( '', 'portfolio_tag' )) {
		
			as_entryMeta_cats_tags();
		}
		?>
		
	</div>
	
		
</article><!-- #post-<?php the_ID(); ?> -->

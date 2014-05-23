<?php
	$options = array(
		'disable_icons' => of_get_option('disable_icons', false),
		'disable_post_header' => of_get_option('disable_post_header', false),
		'image_icon' => of_get_option('image_icon', false),
		'header_art' => of_get_option('header_art', false),
		);

	if(is_sticky()){
		$post_icon = of_get_option('post_icon_edit', 'icon-pin');
	}else{
		$post_icon = of_get_option('image_icon', 'icon-picture-1');
	}	

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-title box">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		<div class="post-meta">
			<?php get_template_part( 'inc/meta-top' ); ?>
		</div>
		<div class="post-format-badge post-format-image">
			<i class="<?php echo $post_icon; ?>"></i>
		</div>
	</div>
	<?php  /* if ( has_post_thumbnail() ) { */ ?>
	<div class="entry-image">
		<?php 
		if(!of_get_option('post_image_lightbox')){ ?>
			<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'bluth'), the_title_attribute('echo=0') ); ?>" rel="bookmark">
				<?php the_post_thumbnail('gallery-large'); ?>
			</a><?php 
		}else{
			$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large', false, '' ); ?>
			<a href="<?php echo $src[0]; ?>" class="lightbox" title="<?php the_title(); ?>" rel="bookmark">
				<?php the_post_thumbnail('gallery-large'); ?>
			</a><?php 
		} ?>
	</div>
	<div class="entry-container">
		<div class="entry-content">
			<?php 
				if(of_get_option('enable_excerpt')){
					the_excerpt();
				}else{
					the_content(__('Continue reading...', 'bluth')); 
				}
			?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'bluth' ), 'after' => '</div>' ) ); ?>
			<footer class="entry-meta clearfix">
				<?php get_template_part( 'inc/meta-bottom' ); ?>
			</footer><!-- .entry-meta -->
		</div><!-- .entry-content -->
	</div><!-- .entry-container -->
</article><!-- #post-<?php the_ID(); ?> -->
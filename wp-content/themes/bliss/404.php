<?php get_header(); ?>
<div id="primary" class="row">
	<div class="span10 offset1">
		<article class="type-page box" style="padding:40px;">
			<h1 class="title" style="padding:0; padding-bottom:25px; margin-bottom:25px;"><?php _e('Page not found', 'bluth'); ?></h1>
			<p class="lead"><?php _e('We could not find the page you were looking for.', 'bluth'); ?></p>
			<br>
			<h3><?php _e('Try searching', 'bluth') ?></h3>
			<?php echo get_search_form(); ?>
			<?php get_template_part( 'inc/recent-posts' ); ?>				
		</article>
	</div>
</div>
<?php get_footer(); ?>
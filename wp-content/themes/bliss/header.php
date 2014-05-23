<!DOCTYPE html>
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<?php
	// check if Yoast SEO plugin is active
	if ( of_get_option('seo_plugin') ){
		echo '<title>';
		wp_title('');
		echo '</title>';
	}else{

		global $page, $paged;

		// add title tag
		echo '<title>';
		bloginfo('name');
		wp_title(' - ', true, 'left');
		echo '</title>';

		if (is_single() || is_page() ){ 
			if ( have_posts() ) {
				while ( have_posts() ){ 
					the_post();
					echo '<meta name="description" content="';
					echo the_excerpt_rss(155, 2);
					echo '" />';
				} 
			}
		}elseif(is_home()){ 
				echo '<meta name="description" content="';
				bloginfo('description');
				echo '" />';
		}
	}
?>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php

//render google tracking code if present
$google_analytics = of_get_option('google_analytics', false);
if($google_analytics){
	echo (strpos($google_analytics, '<script') === false) ? '<script>'.of_get_option('google_analytics').'</script>' : of_get_option('google_analytics');
}

wp_head(); 

?>
</head>
<body <?php body_class(); ?>>
<div class="bl_search_overlay"></div>

	<script type="text/javascript">
	<?php if(!of_get_option('disable_fixed_header')){ ?>

		if(jQuery(window).width() > 768){
			// Shrink menu on scroll
			var didScroll = false;
			jQuery(window).scroll(function() {
			    didScroll = true;
			});
			var y;
			setInterval(function() {
			    if ( didScroll ) {
			        didScroll = false;
			        y = jQuery(window).scrollTop();
			        if(y > 70){
			        	jQuery('#masthead .bluth-navigation').addClass('fixed');
			        }else{
			        	jQuery('#masthead .bluth-navigation').removeClass('fixed');
			        }
			        if(y > 170){
			        	jQuery('#masthead .bluth-navigation').addClass('shrunk');
			        }else{
			        	jQuery('#masthead .bluth-navigation').removeClass('shrunk');
			        }
			    }
			}, 50);
		}
		
	<?php } ?>
	jQuery(function() {
		<?php if( of_get_option('menu_hover') ){ ?>
			jQuery('.dropdown-toggle').parent().mouseover(function(){
				jQuery( this ).addClass('open');
			});
			jQuery('.dropdown-toggle').parent().mouseout(function(){
				jQuery( this ).removeClass('open');
			});
		<?php } ?>
		resetNavLine(250);

		jQuery('#masthead .nav li').mouseover(function(){
			jQuery('.nav-line').stop();
			jQuery('.nav-line').animate({
				left : jQuery(this).offset().left-jQuery('.bluth-navigation .container .navbar').offset().left,
				width: jQuery(this).width()
			}, 250);
		});
		jQuery('#masthead .nav li').mouseout(function(){
			resetNavLine(250);
		});
	});

	function resetNavLine(time){
		// didScroll = true;
		jQuery('.nav-line').stop();
		if(jQuery('.nav').children('li').hasClass('current-menu-item')){
			jQuery('.nav-line').animate({
				left : jQuery('.current-menu-item').offset().left-jQuery('.bluth-navigation .container .navbar').offset().left,
				width: jQuery('.current-menu-item').width()
			}, time);
		}else if(jQuery('.nav').children('li').hasClass('current-menu-ancestor')){
			jQuery('.nav-line').animate({
					left : jQuery('.current-menu-ancestor').offset().left-jQuery('.bluth-navigation .container .navbar').offset().left,
					width: jQuery('.current-menu-ancestor').width()
			}, time);
		}else{
			jQuery('.nav-line').animate({
				width : 0
			});
		}
	}
	</script>
<?php 

	// Facebook Javascript SDK
	if(of_get_option('facebook_app_id')){ ?>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=<?php echo of_get_option('facebook_app_id'); ?>";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<?php }	


	// background image or pattern
	switch (of_get_option('background_mode')) {
		case 'image':
			if(of_get_option('background_image')){

				echo '<div class="bl_background">'.(of_get_option('show_stripe') ? '<div id="stripe"></div>' : ''). '<img src="'.of_get_option('background_image').'"></div>';
			}
		break;
		case 'pattern':
			if( of_get_option('background_pattern_custom') ){

				echo '<div style="background-image: url(\''.of_get_option('background_pattern_custom').'\')" id="background_pattern"></div>';
			
			}elseif (of_get_option('background_pattern')) {

				echo '<div style="background-image: url(\''.get_template_directory_uri() . '/assets/img/pattern/large/'.of_get_option('background_pattern').'\')" id="background_pattern"></div>';
			}
		break;
	}
?>
<?php
	// Advert above header
	$ad_header_mode = of_get_option('ad_header_mode', 'none');

	if($ad_header_mode != 'none'){
		echo '<div class="above_header">';
			if($ad_header_mode == 'image'){
				echo '<a href="'.of_get_option('ad_header_image_link').'" target="_blank"><img src="'.of_get_option('ad_header_image').'"></a>';
			}elseif($ad_header_mode == 'html'){
				echo apply_filters('shortcode_filter',do_shortcode(of_get_option('ad_header_code')));
			}
		echo '</div>';
	}
?>

<style></style>

<ul class="scroll">
	<li class="sct">
		<a href="#">&nbsp;&nbsp;&nbsp;</a>
		<div style="right: 0px; opacity: 0; display: block;"><a title="返回顶部" class="scroll_t">返回顶部</a></div>
	</li>
		<li class="scc">
		<a href="#">&nbsp;&nbsp;&nbsp;</a>
		<div><a title="查看评论" class="scroll_c">查看留言</a></div>
	</li>
		<li class="scb">
		<a href="#">&nbsp;&nbsp;&nbsp;</a>
		<div><a title="转到底部" class="scroll_b">转到底部</a></div>
	</li>
</ul>

<div id="page" class="site">
	<?php do_action( 'before' ); ?>
	<header id="masthead" role="banner">
		<div class="row-fluid top-banner">
			<div class="container">
				<div class="banner-overlay"></div>
				<?php 
				$logo = of_get_option('logo', '' );
				if ( !empty( $logo ) ) { ?>
					<a class="brand brand-image" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo $logo; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><h1><?php if(!of_get_option('disable_description')){ ?><small><?php bloginfo( 'description' ); ?></small><?php } ?></h1></a>
				<?php }else{ ?>
					<a class="brand brand-text" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><h1><?php bloginfo( 'name' ); ?><?php if(!of_get_option('disable_description')){ ?><small><?php bloginfo( 'description' ); ?></small><?php } ?></h1></a>
				<?php } 
				if(of_get_option('disable_description')){ $top_banner_fix = 'style="top:15px;"'; }else{ $top_banner_fix = ''; }
				?>
				<div class="top-banner-social pull-right" <?php echo $top_banner_fix; ?>><?php
					echo (!of_get_option('social_facebook')) 	? '' : '<a target="_blank" href="' . of_get_option('social_facebook') . '"><i class="icon-facebook-1"></i></a>';
					echo (!of_get_option('social_twitter')) 	? '' : '<a target="_blank" href="' . of_get_option('social_twitter') . '"><i class="icon-twitter-1"></i></a>';
					echo (!of_get_option('social_google')) 		? '' : '<a target="_blank" href="' . of_get_option('social_google') . '"><i class="icon-gplus-1"></i></a>';
					echo (!of_get_option('social_linkedin')) 	? '' : '<a target="_blank" href="' . of_get_option('social_linkedin') . '"><i class="icon-linkedin-1"></i></a>';
					echo (!of_get_option('social_youtube')) 	? '' : '<a target="_blank" href="' . of_get_option('social_youtube') . '"><i class="icon-youtube"></i></a>';
					echo (!of_get_option('social_rss')) 		? '' : '<a target="_blank" href="' . of_get_option('social_rss') . '"><i class="icon-rss-1"></i></a>';
					echo (!of_get_option('social_flickr')) 		? '' : '<a target="_blank" href="' . of_get_option('social_flickr') . '"><i class="icon-flickr-1"></i></a>';
					echo (!of_get_option('social_vimeo')) 		? '' : '<a target="_blank" href="' . of_get_option('social_vimeo') . '"><i class="icon-vimeo-1"></i></a>';
					echo (!of_get_option('social_pinterest')) 	? '' : '<a target="_blank" href="' . of_get_option('social_pinterest') . '"><i class="icon-pinterest-1"></i></a>';
					echo (!of_get_option('social_dribbble')) 	? '' : '<a target="_blank" href="' . of_get_option('social_dribbble') . '"><i class="icon-dribbble-1"></i></a>';
					echo (!of_get_option('social_tumblr')) 		? '' : '<a target="_blank" href="' . of_get_option('social_tumblr') . '"><i class="icon-tumblr-1"></i></a>';
					echo (!of_get_option('social_instagram')) 	? '' : '<a target="_blank" href="' . of_get_option('social_instagram') . '"><i class="icon-instagram-1"></i></a>'; 
					echo (!of_get_option('social_viadeo')) 		? '' : '<a target="_blank" href="' . of_get_option('social_viadeo') . '"><i class="icon-viadeo"></i></a>'; ?>
				</div>
			</div>
		</div>
		<div class="row-fluid bluth-navigation">
			<div class="container">
				<div class="mini-logo">
				<?php	
				$minilogo = of_get_option('minilogo', '' );
				if ( !empty( $minilogo ) ) { ?>
					<a class="mini mini-image" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo $minilogo; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a>
				<?php }else{ ?>
					<a class="mini mini-text" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><h1><?php bloginfo( 'name' ); ?></h1></a>
				<?php } ?>
				</div>
				<div class="navbar navbar-inverse">
				  <div class="navbar-inner">
				    <?php if(of_get_option('show_search_header')){ ?>
						<div class="visible-tablet visible-phone bl_search">
							<?php echo get_search_form(); ?>
						</div>
					<?php } ?>
				    <!-- Responsive Navbar Part 1: Button for triggering responsive navbar (not covered in tutorial). Include responsive CSS to utilize. -->
				    <button data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar" type="button"><i class="icon-menu-1"></i></button>
					<?php
						if ( has_nav_menu( 'primary' ) ) {
							wp_nav_menu( array( 
								'container' => 'div',
								'container_class' => 'nav-collapse collapse',
								'theme_location' => 'primary',
								'menu_class' => 'nav',
								'walker' => new Bootstrap_Walker(),									
								) );
						}
					?>
				  </div><!-- /.navbar-inner -->
					<div class="nav-line"></div>
				</div>
				<?php if(of_get_option('show_search_header')){ ?>
				<div class="bl_search visible-desktop nav-collapse collapse">
					<?php echo get_search_form(); ?>
				</div>
				<?php } ?>

			</div>
		</div>
	</header><!-- #masthead .site-header -->
	<div id="main" class="container">
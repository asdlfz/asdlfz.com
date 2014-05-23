<?php
	global $bluthemes;
	$bluthemes = 'on';	
	// load language
	load_theme_textdomain( 'bluth', get_template_directory() . '/inc/lang' );

	// Define the version so we can easily replace it throughout the theme
	define( 'BLISS_VERSION', 1.2 );
	define( 'BLUTHEMES', true );	

	/*  Set the content width based on the theme's design and stylesheet  */
	if ( ! isset( $content_width ) ){
		$content_width = 740; /* pixels */
	}

	/*  Add Rss feed support to Head section  */
	add_theme_support( 'automatic-feed-links' );

	/*  Register main menu for Wordpress use  */
	if(!function_exists('bluth_register_nav_menu')){
		function bluth_register_nav_menu() {
			register_nav_menus( 
				array(
					'primary'	=>	'Primary Menu', // Register the Primary menu
					// Copy and paste the line above right here if you want to make another menu, 
					// just change the 'primary' to another name
				)
			);
		}
	}
	add_action( 'after_setup_theme', 'bluth_register_nav_menu' );

	/*  Add support for the multiple Post Formats  */
	add_theme_support( 'post-formats', array('gallery', 'image', 'link', 'quote', 'audio', 'video', 'status')); 


	/*  Widgets  */
	include_once('inc/widgets/widgets.php');   // Register widget
	include_once "inc/widgets/bl_tabs.php"; // Tabs: (Recent posts, Recent comments, Tags)
	include_once "inc/widgets/bl_socialbox.php"; // Social network links
	include_once "inc/widgets/bl_tweets.php"; // Display recent tweets
	include_once "inc/widgets/bl_instagram.php"; // Display recent instagram images
	include_once "inc/widgets/bl_newsletter.php"; // Display recent instagram images
	include_once "inc/widgets/bl_likebox.php"; // Display a facebook likebox
	include_once "inc/widgets/bl_flickr2.php"; // Display a recent flickr images
	include_once "inc/widgets/bl_html.php"; // Display HTML
	include_once "inc/widgets/bl_author.php"; // Display Author Badge
	include_once "inc/widgets/bl_featured_post.php"; // Display Featured Post
	include_once "inc/widgets/bl_imagebox.php"; // Display Image Box

	// include_once('inc/shortcodes.php'); // Load Shortcodes
	include_once('inc/theme-options.php'); // Load Theme Options Panel
	include_once('inc/custom-css.php'); // Load Theme Options Panel
	include_once('inc/meta-box.php'); // Load Meta Boxes
	
	/* Include the TGM_Plugin_Activation class  */
	include_once('inc/class-tgm-plugin-activation.php');
	add_action('tgmpa_register', 'bluth_register_required_plugins');

	/* Bootstrap type menu  */
	include_once('inc/bootstrap-walker.php');

	/*  Register required plugins  */
	if(!function_exists('bluth_register_required_plugins')){
		function bluth_register_required_plugins() {
			$plugins = array(
				array(
					'name'     				=> 'CF-Post-Formats', // The plugin name
					'slug'     				=> 'wp-post-formats-master', // The plugin slug (typically the folder name)
					'source'   				=> 'https://github.com/crowdfavorite/wp-post-formats/archive/master.zip', //get_template_directory_uri() . '/inc/plugins/cf-post-formats.zip', // The plugin source
					'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
					'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
					'force_activation' 		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
					'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
					'external_url' 			=> 'https://github.com/crowdfavorite/wp-post-formats/archive/master.zip', // If set, overrides default API URL and points to an external URL
				),
				array(
					'name'     				=> 'Bluthcodes', // The plugin name
					'slug'     				=> 'bluthcodes', // The plugin slug (typically the folder name)
					'source'   				=> 'http://bluth.is/wordpress/bluthcodes.zip', //get_template_directory_uri() . '/inc/plugins/cf-post-formats.zip', // The plugin source
					'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
					'version' 				=> '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
					'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
					'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
					'external_url' 			=> 'http://bluth.is/wordpress/bluthcodes.zip', // If set, overrides default API URL and points to an external URL
				),
			);
		
		
			/**
			 * Array of configuration settings. Amend each line as needed.
			 * If you want the default strings to be available under your own theme domain,
			 * leave the strings uncommented.
			 * Some of the strings are added into a sprintf, so see the comments at the
			 * end of each line for what each argument will be.
			 */
			$config = array(
				'domain'       		=> 'bluth',         	// Text domain - likely want to be the same as your theme.
				'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
				'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
				'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
				'menu'         		=> 'install-required-plugins', 	// Menu slug
				'has_notices'      	=> true,                       	// Show admin notices or not
				'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
				'message' 			=> '',							// Message to output right before the plugins table
				'strings'      		=> array(
					'page_title'                       			=> __( 'Install Required Plugins', 'bluth' ),
					'menu_title'                       			=> __( 'Install Plugins', 'bluth' ),
					'installing'                       			=> __( 'Installing Plugin: %s', 'bluth' ), // %1$s = plugin name
					'oops'                             			=> __( 'Something went wrong with the plugin API.', 'bluth' ),
					'notice_can_install_required'     			=> _n_noop( 'Bliss主题需要安装下面的插件（汉化版本请直接安装下载包中的汉化插件）: %1$s.', 'Bliss主题需要安装下面的插件（汉化版本请直接安装下载包中的汉化插件）: %1$s.' ), // %1$s = plugin name(s)
					'notice_can_install_recommended'			=> _n_noop( 'Bliss主题推荐安装下面的插件（汉化版本请直接安装下载包中的汉化插件）: %1$s.', 'Bliss主题推荐安装下面的插件（汉化版本请直接安装下载包中的汉化插件）: %1$s.' ), // %1$s = plugin name(s)
					'notice_cannot_install'  					=> _n_noop( '对不起，您没有权限安装%s插件.请联系网站管理员安装.', '对不起，您没有权限安装%s插件.请联系网站管理员安装..' ), // %1$s = plugin name(s)
					'notice_can_activate_required'    			=> _n_noop( '必需的插件没有被启用: %1$s.', '必需的插件没有被启用: %1$s.' ), // %1$s = plugin name(s)
					'notice_can_activate_recommended'			=> _n_noop( '推荐的插件没有被启用: %1$s.', '推荐的插件没有被启用: %1$s.' ), // %1$s = plugin name(s)
					'notice_cannot_activate' 					=> _n_noop( '对不起，您没有权限启用%s插件，请联系网站管理员启用插件.', '对不起，您没有权限启用%s插件，请联系网站管理员启用插件.' ), // %1$s = plugin name(s)
					'notice_ask_to_update' 						=> _n_noop( '为了获得最好的兼容性，请更新插件（注意：更新后将不再是汉化版本）: %1$s.', '为了获得最好的兼容性，请更新插件（注意：更新后将不再是汉化版本）: %1$s.' ), // %1$s = plugin name(s)
					'notice_cannot_update' 						=> _n_noop( '对不起，您没有权限更新%s插件，请联系网站管理员更新d.', '对不起，您没有权限更新%s插件，请联系网站管理员更新.' ), // %1$s = plugin name(s)
					'install_link' 					  			=> _n_noop( '开始安装插件', '开始安装插件' ),
					'activate_link' 				  			=> _n_noop( '启用已安装的插件', '启用已安装的插件' ),
					'return'                           			=> __( 'Return to Required Plugins Installer', 'bluth' ),
					'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'bluth' ),
					'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'bluth' ), // %1$s = dashboard link
					'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
				)
			);
			tgmpa($plugins, $config);
		}
	}

	/* Enqueue Styles and Scripts  */
	if(!function_exists('bliss_assets')){
		function bliss_assets()  { 

			$protocol 			= is_ssl() ? 'https' : 'http';
			$disable_responsive = of_get_option('disable_responsive', false);

			$enable_rtl 		= of_get_option('enable_rtl', false);

			// add theme css
			wp_enqueue_style( 'bluth-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );
			wp_enqueue_style( 'bluth-style', get_template_directory_uri() . '/style.css', array('bluth-bootstrap') );
			// if disable responsive
			if(!$disable_responsive){
				wp_enqueue_style( 'bluth-responsive', get_template_directory_uri() . '/assets/css/style-responsive.css' );
			}
			// if RTL enabled
			if($enable_rtl){
				wp_enqueue_style( 'bluth-rtl', get_template_directory_uri() . '/assets/css/style-rtl.css' );
			}
			wp_enqueue_style( 'bluth-fontello', get_template_directory_uri() . '/assets/css/fontello.css' );
			wp_enqueue_style( 'bluth-nivo', get_template_directory_uri() . '/assets/css/nivo-slider.css' );
			wp_enqueue_style( 'bluth-magnific', get_template_directory_uri() . '/assets/css/magnific-popup.css' );
			wp_enqueue_style( 'bluth-snippet', get_template_directory_uri() . '/assets/css/jquery.snippet.min.css' );
			wp_enqueue_style( 'bluth-player', get_template_directory_uri() . '/assets/css/mediaelementplayer.css' );

				
			// add theme scripts
			wp_enqueue_script( 'bluth-jquery-ui', $protocol.'://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js', array('jquery'), BLISS_VERSION, true );
			wp_enqueue_script( 'bluth-snippet', get_template_directory_uri() . '/assets/js/jquery.snippet.min.js', array('jquery'), BLISS_VERSION, true );
			wp_enqueue_script( 'bluth-nivo', get_template_directory_uri() . '/assets/js/jquery.nivo.slider.pack.js', array(), BLISS_VERSION, true );
			wp_enqueue_script( 'bluth-timeago', get_template_directory_uri() . '/assets/js/jquery.timeago.js', array('jquery'), BLISS_VERSION, true );
			wp_enqueue_script( 'bluth-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), BLISS_VERSION, true );
			wp_enqueue_script( 'bluth-magnific', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.js', array('jquery'), BLISS_VERSION, true );
			wp_enqueue_script( 'bluth-player', get_template_directory_uri() . '/assets/js/mediaelement-and-player.js', array('jquery'), BLISS_VERSION, true );
			wp_enqueue_script( 'bluth-theme', get_template_directory_uri() . '/assets/js/theme.min.js', array('jquery'), BLISS_VERSION, true );


			$fonts = array();
			$fonts['heading_font'] 	= of_get_option('heading_font', false);
			$fonts['text_font'] 	= of_get_option('text_font', false);
			$fonts['menu_font'] 	= of_get_option('menu_font', false);
			$fonts['brand_font'] 	= of_get_option('brand_font', false);

			// defaults
			$heading_font 	= 'Crete+Round:400,400italic';
			$text_font 		= 'Lato:400,700,400italic';

			// empty font array
			$font_names 	= array();
			$font_subset 	= array();
			$subset_array 	= array();

			foreach ($fonts as $key => $value) {
				if($value){
					$selected_font = explode('&subset=', $value);
					$font_names[] = str_replace(' ', '+', $selected_font[0]);
					if(count($selected_font) > 1){
						$font_subset = explode(',', $selected_font[1]);
						array_fill_keys($font_subset, $font_subset);
						$subset_array = array_merge($subset_array, $font_subset);
					}
				}
			}
			$subset_array = array_unique($subset_array);

			wp_enqueue_style( 'bluth-googlefonts', $protocol.'://fonts.googleapis.com/css?family='.(!empty($font_names) ? implode('|', $font_names) : $text_font.'|'.$heading_font) . (!empty($subset_array) ? '&subset='.implode(',', $subset_array) : '')  );	

		    if ( is_singular() && get_option( 'thread_comments' ) )
		        wp_enqueue_script( 'comment-reply' );			
		}
	}
	add_action( 'wp_enqueue_scripts', 'bliss_assets' ); // Register this fxn and allow Wordpress to call it automatcally in the header


	/* 
	 * Outputs the selected option panel styles inline into the <head>
	 */
	if(!function_exists('options_typography_styles')){ 
		function options_typography_styles() {

			$output = '';
			$heading_font 		= of_get_option('heading_font', false);
			$text_font 			= of_get_option('text_font', false);
			$menu_font 			= of_get_option('menu_font', false);
			$brand_font 		= of_get_option('brand_font', false);

			if($heading_font){
				$selected_font = explode(':', $heading_font);
				$output .= 'h1,h2,h3,h4,h5{font-family: "'.str_replace('+', ' ', $selected_font[0]).'",serif;} .widget_calendar table > caption{font-family: "'.str_replace('+', ' ', $selected_font[0]).'",serif;} ';
			}

			if($text_font){
				$selected_font = explode(':', $text_font);
				$output .= 'body{font-family: "'.str_replace('+', ' ', $selected_font[0]).'",Helvetica,sans-serif;} ';
			}

			if($menu_font){
				$selected_font = explode(':', $menu_font);
				$output .= '.navbar .nav > li > a{font-family: "'.str_replace('+', ' ', $selected_font[0]).'",Helvetica,sans-serif;} ';
			}

			if($brand_font){
				$selected_font = explode(':', $brand_font);
				$output .= '.brand-text h1, .mini-text h1{font-family: "'.str_replace('+', ' ', $selected_font[0]).'",Helvetica,sans-serif;} ';
			}

		     if ( $output != '' ) {
				$output = "\n<style>\n" . $output . "</style>\n";
				echo $output;
		     }
		}
	}
	add_action('wp_head', 'options_typography_styles');




	/*  Attach a class to linked images' parent anchors  */
	if(!function_exists('give_linked_images_class')){
		function give_linked_images_class($html, $id, $caption, $title, $align, $url, $size, $alt = '' ){
		  $classes = 'lightbox'; // separated by spaces, e.g. 'img image-link'

		  // check if there are already classes assigned to the anchor
		  if ( preg_match('/<a.*? class=".*?">/', $html) ) {
		    $html = preg_replace('/(<a.*? class=".*?)(".*?>)/', '$1 ' . $classes . '$2', $html);
		  } else {
		    $html = preg_replace('/(<a.*?)>/', '$1 class="' . $classes . '" >', $html);
		  }
		  return $html;
		}
	}
	add_filter('image_send_to_editor','give_linked_images_class',10,8);


	/*  Custom Pagination ( thanks to kriesi.at )  */
	if(!function_exists('kriesi_pagination')){ 
		function kriesi_pagination($pages = '', $range = 2){  
		     $showitems = ($range * 2)+1;  

		     global $paged;
		     if(empty($paged)) $paged = 1;

		     if($pages == '')
		     {
		         global $wp_query;
		         $pages = $wp_query->max_num_pages;
		         if(!$pages)
		         {
		             $pages = 1;
		         }
		     }   

		     if(1 != $pages)
		     {
		         echo "<div class='pagination'>";
				echo get_previous_posts_link( '<i class="icon-left-open-1"></i> '.__('Previous Page', 'bluth') );
		         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a class='box' href='".get_pagenum_link(1)."'>&laquo;</a>";
		         if($paged > 1 && $showitems < $pages) echo "<a class='box' href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

		         for ($i=1; $i <= $pages; $i++)
		         {
		             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
		             {
		                 echo ($paged == $i)? "<span class='current box'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive box' >".$i."</a>";
		             }
		         }

		         if ($paged < $pages && $showitems < $pages) echo "<a class='box' href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
		         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a class='box' href='".get_pagenum_link($pages)."'>&raquo;</a>";
				echo get_next_posts_link( __('Next Page', 'bluth').' <i class="icon-right-open-1"></i>' );
		        echo "</div>\n";
		     }
		}
	}

	/*  Add open graph meta tags  */
	if(!function_exists('add_open_graph_tags')){ 
		function add_open_graph_tags() {

			global $post; 
			// $image = get_post_meta($post->ID, 'thumbnail', $single = true); 
			if(!empty($post)){
				$images = get_children(array('post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image' ));	
			}
			if(!empty($images)){
				$image = current($images);
				$image = wp_get_attachment_image_src($image->ID, 'gallery-large');
				echo '<meta property="og:image" content="'.(is_array($image) ? $image[0] : $image).'" />';
			}
			?>	
			<meta property="og:type" content="article" />
			<meta property="og:url" content="<?php the_permalink(); ?>" />
			<?php
			if (is_single() || is_page() ){ 
				if ( have_posts() ) {
					while ( have_posts() ){ 
						the_post();
						echo '<meta property="og:description" content="'.mb_substr(strip_tags(get_the_excerpt()), 0, 155).'" />';
						echo '<meta property="og:title" content="';
						bloginfo('name');
						echo ' - ';
						the_title();
						echo '" />';
					} 
				}
			}elseif(is_home()){ 
				echo '<meta property="og:title" content="';
				bloginfo('name');
				wp_title(' - ', true, 'left');
				echo '" />';
				echo '<meta property="og:description" content="'.get_bloginfo('description').'" />';
			}		
			?>	
			<meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>" />
			<?php 
		}
	}
	// only run this function if the user is not using an seo plugin
	if ( !of_get_option('seo_plugin') ){
		add_action('wp_head', 'add_open_graph_tags',99); 
	}


	/*  Post Thumbnails  */
	if ( function_exists( 'add_image_size' ) ) {

		add_theme_support( 'post-thumbnails' );

		add_image_size( 'gallery-large', 870, 400, true );		// Large Blog Image
		add_image_size( 'featured_post', 400, 250, true );		// Featured Widget Image
		add_image_size( 'standard', 700, 300, true );			// Standard Blog Image
		add_image_size( 'small', 194, 150, true ); 				// Related posts image
		add_image_size( 'mini', 80, 80, true ); 				// sidebar widget image
	}


	/**
	 * Template for comments and pingbacks.
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 */
	if(!function_exists('bluth_comment')){
		function bluth_comment( $comment, $args, $depth ) {
		    $GLOBALS['comment'] = $comment;
		    switch ( $comment->comment_type ) :
		        case 'pingback' :
		        case 'trackback' :
		    ?>
		    <li class="post pingback">
		        <p><?php _e( 'Pingback:', 'bluth' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'bluth' ), ' ' ); ?></p>
		    <?php
		            break;
		        default :
		    ?>
		    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		        <article id="comment-<?php comment_ID(); ?>" class="comment">
		            <div>
		                <div class="comment-author">
		                    <?php echo get_avatar( $comment, 45 ); ?>
		                    <?php printf( __( '%s', 'bluth' ), sprintf( '<cite class="commenter">%s</cite>', get_comment_author_link() ) ); ?>
		                	<small class="muted">&nbsp;&nbsp;•&nbsp;&nbsp;<time class="timeago" datetime="<?php comment_time( 'c' ); ?>"></time></small>
		                	<?php if ($comment->user_id == get_queried_object()->post_author){ ?>
		                	&nbsp;&nbsp;<span class="label label-success"><?php _e('Author', 'bluth'); ?></span>
		                	<?php } ?>
		                </div><!-- .comment-author .vcard -->
		                <?php if ( $comment->comment_approved == '0' ) : ?>
		                    <em><?php _e( 'Your comment is awaiting moderation.', 'bluth' ); ?></em>
		                    <br />
		                <?php endif; ?>
		            </div>
		 
		            <div class="comment-content"><?php comment_text(); ?></div>
		 
		            <div class="reply">
		                <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		                <?php edit_comment_link( __( '(Edit)', 'bluth' ), '&nbsp;&nbsp;' ); ?>
		            </div><!-- .reply -->
		        </article><!-- #comment-## -->
		 
		    <?php
		            break;
		    endswitch;
		}
	}

	// add span tag around categories post count
	if(!function_exists('cat_count_span')){ 
		function cat_count_span($links) {
			return str_replace(array('</a> (',')'), array('</a> <span class="badge">','</span>'), $links);
		}
	}
	add_filter('wp_list_categories', 'cat_count_span');

	// add span tag around archives post count
	if(!function_exists('archive_count_no_brackets')){ 
		function archive_count_no_brackets($links) {
		  	return str_replace(array('</a>&nbsp;(',')'), array('</a> <span class="badge">','</span>'), $links);
		}
	}
	add_filter('get_archives_link', 'archive_count_no_brackets');

	// Excerpt read more link
	if(!function_exists('excerpt_read_more_link')){ 
		function excerpt_read_more_link($output) {
		 global $post;
		 $more_link = '';
		 $excerpt_length = of_get_option('excerpt_length', 55);
		 if(str_word_count($output, 0) > $excerpt_length){
		 	$more_link = '<p><a class="more-link" href="'. get_permalink($post->ID) . '"> '.__('Continue reading...', 'bluth').'</a></p>';
		 }
		 return $output . $more_link;
		}
	}
	add_filter('the_excerpt', 'excerpt_read_more_link');

	// Excerpt length
	if(!function_exists('new_excerpt_length')){ 
		function new_excerpt_length($length) {
			return of_get_option('excerpt_length', '55');
		}
	}
	add_filter('excerpt_length', 'new_excerpt_length');

	//remove empty p tags
	add_filter('the_content', 'remove_empty_p', 20, 1);
	function remove_empty_p($content){
		$content = force_balance_tags($content);
		return preg_replace('#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content);
	}

	// get gravatar URL
	function get_avatar_url( $get_avatar ) {
	    preg_match("/src='(.*?)'/i", $get_avatar, $matches);
	    return $matches[1];
	}

	// get the post image
	function get_post_image( $post_id, $size = 'small', $author_fallback = true ) {
		if( has_post_thumbnail( $post_id )){
			$thumb_id = get_post_thumbnail_id( $post_id );
			$thumb_url = wp_get_attachment_image_src( $thumb_id, $size, true );

			return $thumb_url[0];
		}else if ( $images = get_children(array('post_parent' =>  $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image' ))){ 

			$image = current($images);
			$image = wp_get_attachment_image_src($image->ID, $size);
			return $image[0];
		}else if( $author_fallback ){
			return get_avatar_url(get_avatar( get_the_author_meta( 'ID' ) , 120 ));
		}else{
			return false;
		} 
	}
	// get the post icon
	function get_post_icon( $post_id ) {

		$post_format = (get_post_format( $post_id )) ? get_post_format( $post_id ) : 'standard'; 	

		$icon = of_get_option($post_format.'_icon', false);
		$icon_default = array('standard' => 'icon-calendar-3', 'audio' => 'icon-volume-up', 'video' => 'icon-videocam','quote' => 'icon-quote-left', 'link' => 'icon-link', 'image' => 'icon-picture-1', 'gallery' => 'icon-picture');
		$icon = ($icon !== false) ? $icon : $icon_default[$post_format];

		return $icon;

	}

	function hrw_enqueue()
	{
	  wp_enqueue_media();
	  wp_enqueue_script('hrw',  get_template_directory_uri() . '/assets/js/admin-script.js', array( 'jquery' ), BLISS_VERSION, true);
	}
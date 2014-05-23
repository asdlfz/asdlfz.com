<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {


	$background_mode = array(
		'image' => __('Image', 'options_framework_theme'),
		'pattern' => __('Pattern', 'options_framework_theme'),
		'color' => __('Solid Color', 'options_framework_theme')
	);


	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/assets/img/';

	$options = array();


	$options[] = array(
		'name' => __('Theme Options', 'options_framework_theme'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Background', 'options_framework_theme'),
		'desc' => __('What kind of background do you want?', 'options_framework_theme'),
		'id' => 'background_mode',
		'std' => 'image',
		'type' => 'radio',
		'options' => $background_mode);

	$options[] = array(
		'name' => __('Background Image', 'options_framework_theme'),
		'desc' => __('Upload your background image here.', 'options_framework_theme'),
		'id' => 'background_image',
		'std' => get_template_directory_uri() . '/assets/img/bg.jpg',
		'class' => 'background_image',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Show stripe overlay', 'options_framework_theme'),
		'desc' => __('Uncheck this to remove the stripe overlay that covers the background image', 'options_framework_theme'),
		'id' => 'show_stripe',
		'std' => '1',
		'class' => 'background_image',
		'type' => 'checkbox');

	$options[] = array(
		'name' => "Select a background pattern",
		'desc' => "Select a background pattern from the list or upload your own below.",
		'id' => "background_pattern",
		'std' => "brick_wall.jpg",
		'type' => "images",
		'class' => "hide background_pattern",
		'options' => array(
			'az_subtle.png' => $imagepath . '/pattern/sample/az_subtle_50.png',
			'cloth_alike.png' => $imagepath . '/pattern/sample/cloth_alike_50.png',
			'cream_pixels.png' => $imagepath . '/pattern/sample/cream_pixels_50.png',
			'gray_jean.png' => $imagepath . '/pattern/sample/gray_jean_50.png',
			'grid.png' => $imagepath . '/pattern/sample/grid_50.png',
			'light_noise_diagonal.png' => $imagepath . '/pattern/sample/light_noise_diagonal_50.png',
			'light_paper.png' => $imagepath . '/pattern/sample/light_paper_50.png',
			'noise_lines.png' => $imagepath . '/pattern/sample/noise_lines_50.png',
			'pw_pattern.png' => $imagepath . '/pattern/sample/pw_pattern_50.png',
			'shattered.png' => $imagepath . '/pattern/sample/shattered_50.png',
			'squairy_light.png' => $imagepath . '/pattern/sample/squairy_light_50.png',
			'striped_lens.png' => $imagepath . '/pattern/sample/striped_lens_50.png',
			'textured_paper.png' => $imagepath .'/pattern/sample/textured_paper_50.png')
	);

	$options[] = array(
		'name' => __('Upload Pattern', 'options_framework_theme'),
		'desc' => __('Upload a new pattern here. If this feature is used it will overwrite the selection above.', 'options_framework_theme'),
		'id' => 'background_pattern_custom',
		'class' => 'background_pattern',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Background Color', 'options_framework_theme'),
		'desc' => __('Select the background color ( Only works if the custom color option is chosen )', 'options_framework_theme'),
		'id' => 'background_color',
		'std' => '#E9F0F4',
		'class' => "hide background_color",
		'type' => 'color' );


	$options[] = array(
		'name' => __('Facebook App Id', 'options_framework_theme'),
		'desc' => __('Insert you Facebook app id here. If you don\'t have one for your webpage you can create it <a target="_blank" href="https://developers.facebook.com/apps">here</a>', 'options_framework_theme'),
		'id' => 'facebook_app_id',
		'type' => 'text');

	$options[] = array(
		'name' => __('Enable Facebook comments for posts', 'options_framework_theme'),
		'desc' => __('Check this to use Facebook comments instead of regular wordpress comments for posts. Requires a Facebook app id in the field above.', 'options_framework_theme'),
		'id' => 'facebook_comments',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Disable Responsive CSS', 'options_framework_theme'),
		'desc' => __('Check this to disable responsive css. Responsive css enable the webpage to adapt to every screen size allowing mobile users to browse the website more easily.', 'options_framework_theme'),
		'id' => 'disable_responsive',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Layout', 'options_framework_theme'),
		'desc' => __('Select the layout you want, left sidebar, right sidebar or no sidebar. Default: Right sidebar', 'options_framework_theme'),
		'id' => "side_bar",
		'std' => "right_side",
		'type' => "images",
		'options' => array(
			'single' => $imagepath . '1col.png',
			'left_side' => $imagepath . '2cl.png',
			'right_side' => $imagepath . '2cr.png',
			'both_side' => $imagepath . '2cb.png')
	);

	$options[] = array(
		'name' => __('Blog Layout', 'options_framework_theme'),
		'desc' => __('Select the default blog layout.', 'options_framework_theme'),
		'id' => 'blog_layout',
		'std' => 'margin',
		'type' => 'images',
		'options' => array(
			'margin' => $imagepath . 'blm.png',
			'twocolumn' => $imagepath . 'bl2.png',
		));

	$options[] = array(
		'name' => __('Right-to-Left Language', 'options_framework_theme'),
		'desc' => __('Check this if your language is written in a Right-to-Left direction', 'options_framework_theme'),
		'id' => 'enable_rtl',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Footer text', 'options_framework_theme'),
		'desc' => __('{year} will be replaced with the current year', 'options_framework_theme'),
		'id' => 'footer_text',
		'std' => 'Copyright &copy; {year} · Theme design by the Bluth Company · www.bluth.is',
		'type' => 'text');

	$options[] = array(
		'name' => __('Google Analytics', 'options_framework_theme'),
		'desc' => __('Add your Google Analytics tracking code here. Google Analytics is a free web analytics service more info here: <a href="http://www.google.com/analytics/">Google Analytics</a>', 'options_framework_theme'),
		'id' => 'google_analytics',
		'std' => '',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('SEO plugin support', 'options_framework_theme'),
		'desc' => __('Check this to give an SEO plugin control of meta description, title and open graph tags.', 'options_framework_theme'),
		'id' => 'seo_plugin',
		'std' => '0',
		'type' => 'checkbox');


	$options[] = array(
		'name' => __('Header & Menu', 'options_framework_theme'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Logo', 'options_framework_theme'),
		'desc' => __('Upload your logo here. Remove the image to show the name of the website in text instead. (Recommended: 45x45)', 'options_framework_theme'),
		'id' => 'logo',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Mini Logo', 'options_framework_theme'),
		'desc' => __('Upload your mini logo here. Logo that appears in the header when the user scrolls down on your website.', 'options_framework_theme'),
		'id' => 'minilogo',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Enable menu hover', 'options_framework_theme'),
		'desc' => __('Check this to show the menus sub-items when hovered over the top item.', 'options_framework_theme'),
		'id' => 'menu_hover',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Disable header description', 'options_framework_theme'),
		'desc' => __('Check this to disable the description showing up in the header.', 'options_framework_theme'),
		'id' => 'disable_description',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Disable Sticky Header', 'options_framework_theme'),
		'desc' => __('Check this to disable the sticky header feature. (The header won\'t stay fixed at the top of the window when you scroll down)', 'options_framework_theme'),
		'id' => 'disable_fixed_header',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Show search in header', 'options_framework_theme'),
		'desc' => __('Uncheck this to remove the search input from the header', 'options_framework_theme'),
		'id' => 'show_search_header',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Posts & Pages', 'options_framework_theme'),
		'type' => 'heading');


/*	$options[] = array(
		'name' => __('Enable link animations', 'options_framework_theme'),
		'desc' => __('Uncheck this to remove the link animations for each post.', 'options_framework_theme'),
		'id' => 'anchor_anim',
		'std' => '1',
		'type' => 'checkbox');*/

	$options[] = array(
		'name' => __('Enable page comments', 'options_framework_theme'),
		'desc' => __('Check this to enable comments on all pages as well as posts.', 'options_framework_theme'),
		'id' => 'enable_page_comments',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Disable share buttons at the bottom of posts', 'options_framework_theme'),
		'desc' => __('Check this to remove the "Share" button in the post footer.', 'options_framework_theme'),
		'id' => 'disable_share_story',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Show share buttons on:', 'options_framework_theme'),
		'desc' => __('Where do you want the share buttons to appear?', 'options_framework_theme'),
		'id' => 'share_buttons_position',
		'class' => 'disable_share_story',
		'std' => array(
			'pages' 	=> '0',
			'single' 	=> '1',
			'blog' 		=> '0'
		),
		'type' => 'multicheck',
		'options' => array(
			'pages' 	=> __('Pages', 'options_framework_theme'),
			'single' 	=> __('Posts', 'options_framework_theme'),
			'blog' 	=> __('Front page', 'options_framework_theme')));

	$options[] = array(
		'name' => __('Disable the tags for posts', 'options_framework_theme'),
		'desc' => __('Check this to remove the post tags on all posts', 'options_framework_theme'),
		'id' => 'disable_footer_post',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Disable next/previous buttons', 'options_framework_theme'),
		'desc' => __('Check this to remove the Next/Previous buttons at the bottom of each post.', 'options_framework_theme'),
		'id' => 'disable_pagination',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Disable Related Posts', 'options_framework_theme'),
		'desc' => __('Related articles are show below each post when you view it. Check this to disable that feature.', 'options_framework_theme'),
		'id' => 'disable_related_posts',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Enable author box', 'options_framework_theme'),
		'desc' => __('Uncheck this to remove the author box below each post.', 'options_framework_theme'),
		'id' => 'author_box',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Author Box Image', 'options_framework_theme'),
		'desc' => __('Upload a cover for the author box', 'options_framework_theme'),
		'id' => 'author_box_image',
		'type' => 'upload');


	$options[] = array(
		'name' => __('Enable posts excerpt (post summary)', 'options_framework_theme'),
		'desc' => __('Check this to only show the post excerpt or the summary of a post in the browse page. The default behavior is to show the whole post but you can provide a cut-off point by adding the <a href="http://codex.wordpress.org/Customizing_the_Read_More" target="_blank">More</a> tag.', 'options_framework_theme'),
		'id' => 'enable_excerpt',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Exerpt Length', 'options_framework_theme'),
		'desc' => __('How many words would you like to show in the post summary. Default: 55 words', 'options_framework_theme'),
		'id' => 'excerpt_length',
		'std' => '55',
		'class' => 'hide',
		'type' => 'text');

	$options[] = array(
		'name' => __('Show Continue Reading link', 'options_framework_theme'),
		'desc' => __('Uncheck this to hide the Continue Reading link that appears below the post conent.', 'options_framework_theme'),
		'id' => 'show_continue_reading',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Open featured post images in lightbox', 'options_framework_theme'),
		'desc' => __('Check this to open featured post images in a lightbox instead of linking to the post itself.', 'options_framework_theme'),
		'id' => 'post_image_lightbox',
		'std' => '0',
		'type' => 'checkbox');

/*	$options[] = array(
		'name' => __('Show Post Header', 'options_framework_theme'),
		'desc' => __('Uncheck this to disable the header that renders above standard posts.', 'options_framework_theme'),
		'id' => 'disable_post_header',
		'std' => '1',
		'type' => 'checkbox');*/

/*	$options[] = array(
		'name' => __('Show Post Icons and Avatars', 'options_framework_theme'),
		'desc' => __('Uncheck this to disable the icons and avatars on posts', 'options_framework_theme'),
		'id' => 'disable_icons',
		'std' => '1',
		'type' => 'checkbox');*/


/*	$options[] = array(
		'name' => __('Post header art', 'options_framework_theme'),
		'desc' => __('Display Avatar or Icon in post headers', 'options_framework_theme'),
		'id' => 'header_art',
		'std' => 'icon',
		'type' => 'radio',
		'options' => array(
			'avatar' => __('Avatar', 'options_framework_theme'),
			'icon' 	=> __('Icon', 'options_framework_theme')
		));*/

	$options[] = array(
		'name' => __('Standard Post Icon', 'options_framework_theme'),
		'desc' => __('Select an icon for the standard post type. (Default: icon-calendar-3)', 'options_framework_theme'),
		'id' => 'standard_icon',
		'std' => 'icon-calendar-3',
		'class' => 'header_art_icon post_icon_edit',
		'type' => 'text');

	$options[] = array(
		'name' => __('Standard Post Color', 'options_framework_theme'),
		'desc' => __('Select the color for the standard post icon and links', 'options_framework_theme'),
		'id' => 'standard_post_color',
		'std' => '#556270',
		'class' => 'header_art_icon',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Gallery Post Icon', 'options_framework_theme'),
		'desc' => __('Select an icon for the gallery post type. (Default: icon-picture)', 'options_framework_theme'),
		'id' => 'gallery_icon',
		'std' => 'icon-picture',
		'class' => 'header_art_icon post_icon_edit',
		'type' => 'text');

	$options[] = array(
		'name' => __('Gallery Post Color', 'options_framework_theme'),
		'desc' => __('Select the color for the gallery post icon and links', 'options_framework_theme'),
		'id' => 'gallery_post_color',
		'std' => '#4ECDC4',
		'class' => 'header_art_icon',
		'type' => 'color' );
	
	$options[] = array(
		'name' => __('Image Post Icon', 'options_framework_theme'),
		'desc' => __('Select an icon for the image post type. (Default: icon-picture-1)', 'options_framework_theme'),
		'id' => 'image_icon',
		'std' => 'icon-picture-1',
		'class' => 'header_art_icon post_icon_edit',
		'type' => 'text');

	$options[] = array(
		'name' => __('Image Post Color', 'options_framework_theme'),
		'desc' => __('Select the color for the image post icon and links', 'options_framework_theme'),
		'id' => 'image_post_color',
		'std' => '#C7F464',
		'class' => 'header_art_icon',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Link Post Icon', 'options_framework_theme'),
		'desc' => __('Select an icon for the link post type. (Default: icon-link)', 'options_framework_theme'),
		'id' => 'link_icon',
		'std' => 'icon-link',
		'class' => 'header_art_icon post_icon_edit',
		'type' => 'text');

	$options[] = array(
		'name' => __('Link Post Color', 'options_framework_theme'),
		'desc' => __('Select the color for the link post icon and links', 'options_framework_theme'),
		'id' => 'link_post_color',
		'std' => '#FF6B6B',
		'class' => 'header_art_icon',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Quote Post Icon', 'options_framework_theme'),
		'desc' => __('Select an icon for the quote post type. (Default: icon-quote-left)', 'options_framework_theme'),
		'id' => 'quote_icon',
		'std' => 'icon-quote-left',
		'class' => 'header_art_icon post_icon_edit',
		'type' => 'text');

	$options[] = array(
		'name' => __('Quote Post Color', 'options_framework_theme'),
		'desc' => __('Select the color for the quote post icon and links', 'options_framework_theme'),
		'id' => 'quote_post_color',
		'std' => '#C44D58',
		'class' => 'header_art_icon',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Audio Post Icon', 'options_framework_theme'),
		'desc' => __('Select an icon for the audio post type. (Default: icon-volume-up)', 'options_framework_theme'),
		'id' => 'audio_icon',
		'std' => 'icon-volume-up',
		'class' => 'header_art_icon post_icon_edit',
		'type' => 'text');

	$options[] = array(
		'name' => __('Audio Post Color', 'options_framework_theme'),
		'desc' => __('Select the color for the audio post icon and links', 'options_framework_theme'),
		'id' => 'audio_post_color',
		'std' => '#5EBCF2',
		'class' => 'header_art_icon',
		'type' => 'color' );	

	$options[] = array(
		'name' => __('Video Post Icon', 'options_framework_theme'),
		'desc' => __('Select an icon for the video post type. (Default: icon-videocam)', 'options_framework_theme'),
		'id' => 'video_icon',
		'std' => 'icon-videocam',
		'class' => 'header_art_icon post_icon_edit',
		'type' => 'text');

	$options[] = array(
		'name' => __('Video Post Color', 'options_framework_theme'),
		'desc' => __('Select the color for the video post icon and links', 'options_framework_theme'),
		'id' => 'video_post_color',
		'std' => '#A576F7',
		'class' => 'header_art_icon',
		'type' => 'color' );	

	$options[] = array(
		'name' => __('Status Post Icon', 'options_framework_theme'),
		'desc' => __('Select an icon for the status post type. (Default: icon-book-1)', 'options_framework_theme'),
		'id' => 'status_icon',
		'std' => 'icon-book-1',
		'class' => 'header_art_icon post_icon_edit',
		'type' => 'text');

	$options[] = array(
		'name' => __('Status Post Color', 'options_framework_theme'),
		'desc' => __('Select the color for the status post icon and links', 'options_framework_theme'),
		'id' => 'status_post_color',
		'std' => '#556270',
		'class' => 'header_art_icon',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Sticky Post Icon', 'options_framework_theme'),
		'desc' => __('Select an icon for sticky posts. (Default: icon-pin)', 'options_framework_theme'),
		'id' => 'sticky_icon',
		'std' => 'icon-pin',
		'class' => 'header_art_icon post_icon_edit',
		'type' => 'text');

	$options[] = array(
		'name' => __('Sticky Post Color', 'options_framework_theme'),
		'desc' => __('Select the color for the sticky post icon and links', 'options_framework_theme'),
		'id' => 'sticky_post_color',
		'std' => '#90DB91',
		'class' => 'header_art_icon',
		'type' => 'color' );		




	$options[] = array(
		'name' => __('Colors & Fonts', 'options_framework_theme'),
		'type' => 'heading');


	$options[] = array(
		'name' => __('Color Theme', 'options_framework_theme'),
		'desc' => __('Choose a predefined color theme', 'options_framework_theme'),
		'id' => 'predefined_theme',
		'std' => 'default',
		'type' => 'images',
		'options' => array(
			'default' => $imagepath . '/colorthemes/default.png',
			'blue' => $imagepath . '/colorthemes/blue.png',
			'orange' => $imagepath . '/colorthemes/orange.png',
			'green' => $imagepath . '/colorthemes/green.png',
		));

	$options[] = array(
		'name' => __('Custom Color Theme', 'options_framework_theme'),
		'desc' => __('Check this to make your own color theme', 'options_framework_theme'),
		'id' => 'custom_color_picker',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Main Theme Color', 'options_framework_theme'),
		'desc' => __('Select the theme\'s main color', 'options_framework_theme'),
		'id' => 'theme_color',
		'class' => 'hide custom_color',
		'std' => '#45b0ee',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Top Banner Color', 'options_framework_theme'),
		'desc' => __('Select the color for the top header that includes the logo', 'options_framework_theme'),
		'id' => 'top_banner_color',
		'class' => 'hide custom_color',
		'std' => '#ffffff',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Top Banner Font Color', 'options_framework_theme'),
		'desc' => __('Select the color for the top header that includes the logo', 'options_framework_theme'),
		'id' => 'top_banner_font_color',
		'class' => 'hide custom_color',
		'std' => '#999999',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Top Banner Social Buttons', 'options_framework_theme'),
		'desc' => __('Select the color for the social buttons in the top banner', 'options_framework_theme'),
		'id' => 'top_banner_social_color',
		'class' => 'hide custom_color',
		'std' => '#ffffff',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Top Header Color', 'options_framework_theme'),
		'desc' => __('Select the color for the top header that includes the menu', 'options_framework_theme'),
		'id' => 'header_color',
		'class' => 'hide custom_color',
		'std' => '#ffffff',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Top Header Font Color', 'options_framework_theme'),
		'desc' => __('Select the color for the top header menu links', 'options_framework_theme'),
		'id' => 'header_font_color',
		'class' => 'hide custom_color',
		'std' => '#333333',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Post Header Color', 'options_framework_theme'),
		'desc' => __('Select the color for the top header of each post', 'options_framework_theme'),
		'id' => 'post_header_color',
		'class' => 'hide custom_color',
		'std' => '#444444',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Widget Header Color', 'options_framework_theme'),
		'desc' => __('Select the default color for the top header of each widget', 'options_framework_theme'),
		'id' => 'widget_header_color',
		'class' => 'hide custom_color',
		'std' => '#ffffff',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Widget Header Font Color', 'options_framework_theme'),
		'desc' => __('Select the color for the heading font in each widget', 'options_framework_theme'),
		'id' => 'widget_header_font_color',
		'class' => 'hide custom_color',
		'std' => '#717171',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Footer Color', 'options_framework_theme'),
		'desc' => __('Select the default color for the footer', 'options_framework_theme'),
		'id' => 'footer_color',
		'class' => 'hide custom_color',
		'std' => '#FFFFFF',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Footer Header Color', 'options_framework_theme'),
		'desc' => __('Select the default color for the footer headers', 'options_framework_theme'),
		'id' => 'footer_header_color',
		'class' => 'hide custom_color',
		'std' => '#333333',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Footer Font Color', 'options_framework_theme'),
		'desc' => __('Select the default color for the footer font', 'options_framework_theme'),
		'id' => 'footer_font_color',
		'class' => 'hide custom_color',
		'std' => '#333333',
		'type' => 'color' );



	$options[] = array(
		'name' => __('Heading font', 'options_framework_theme'),
		'desc' => __('Select a font type for all heading', 'options_framework_theme'),
		'id' => 'heading_font',
		'std' => 'Merriweather:400,400italic,700,900',
		'type' => 'text');

	$options[] = array(
		'name' => __('Main font', 'options_framework_theme'),
		'desc' => __('Select a font type for normal text', 'options_framework_theme'),
		'id' => 'text_font',
		'std' => 'Lato:400,700,400italic',
		'type' => 'text');

	$options[] = array(
		'name' => __('Menu links font', 'options_framework_theme'),
		'desc' => __('Select a font type for the menu items in the header', 'options_framework_theme'),
		'id' => 'menu_font',
		'std' => 'Lato:400,700,400italic',
		'type' => 'text');

	$options[] = array(
		'name' => __('Brand font', 'options_framework_theme'),
		'desc' => __('Select a font type for the brand. If you use text instead of a logo in your header this setting changes the font family for that text.', 'options_framework_theme'),
		'id' => 'brand_font',
		'std' => 'Lato:400,700,400italic',
		'type' => 'text');





	$options[] = array(
		'name' => __('Advertising', 'options_framework_theme'),
		'type' => 'heading');



	$options[] = array(
		'name' => __('Ad spot #1 - Above the header.', 'options_framework_theme'),
		'desc' => __('Select what kind of ad you want added above the top menu. <a target="_blank" href="http://bluth.is/wordpress/bliss/wp-content/uploads/2013/08/adspace_top.jpg">See Example</a>', 'options_framework_theme'),
		'id' => 'ad_header_mode',
		'std' => 'none',
		'type' => 'radio',
		'options' => array(
			'none' => __('None', 'options_framework_theme'),
			'html' => __('Shortcode or HTML code like Adsense', 'options_framework_theme'),
			'image' => __('Image with a link', 'options_framework_theme')
		));

	$options[] = array(
		'name' => __('Add Shortcode or HTML code here', 'options_framework_theme'),
		'desc' => __('Insert a shortcode provided by this theme or any plugin. You can also add advertising code from any provider or use plain html. To add Adsense just paste the embed code here that they provide and save.', 'options_framework_theme'),
		'id' => 'ad_header_code',
		'class' => 'hide ad_header_code',
		'std' => '',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('Upload Image', 'options_framework_theme'),
		'desc' => __('Upload an image to add above the header menu and add a link for it in the input box below', 'options_framework_theme'),
		'id' => 'ad_header_image',
		'class' => 'hide ad_header_image',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Image link', 'options_framework_theme'),
		'desc' => __('Add a link to the image', 'options_framework_theme'),
		'id' => 'ad_header_image_link',
		'class' => 'hide ad_header_image',
		'std' => '',
		'type' => 'text');


	$options[] = array(
		'name' => __('Ad spot #2 - Between posts', 'options_framework_theme'),
		'desc' => __('Here you can add advertising between posts. <a target="_blank" href="http://bluth.is/wordpress/bliss/wp-content/uploads/2013/08/adspace_between.jpg">See Example</a>', 'options_framework_theme'),
		'id' => 'ad_posts_mode',
		'std' => 'none',
		'type' => 'radio',
		'options' => array(
			'none' => __('None', 'options_framework_theme'),
			'html' => __('Shortcode or HTML code like Adsense', 'options_framework_theme'),
			'image' => __('Image with a link', 'options_framework_theme')
		));

	$options[] = array(
		'name' => __('Add Shortcode or HTML code here', 'options_framework_theme'),
		'desc' => __('Insert a shortcode provided by this theme or any plugin. You can also add advertising code from any provider or use plain html. To add Adsense just paste the embed code here that they provide and save.', 'options_framework_theme'),
		'id' => 'ad_posts_code',
		'class' => 'hide ad_posts_code',
		'std' => '',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('Upload Image', 'options_framework_theme'),
		'desc' => __('Upload an image to add between posts and add a link for it in the input box below', 'options_framework_theme'),
		'id' => 'ad_posts_image',
		'class' => 'hide ad_posts_image',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Image link', 'options_framework_theme'),
		'desc' => __('Add a link to the image', 'options_framework_theme'),
		'id' => 'ad_posts_image_link',
		'class' => 'hide ad_posts_image',
		'std' => '',
		'type' => 'text');	

	$options[] = array(
		'name' => __('Display Frequency', 'options_framework_theme'),
		'desc' => __('How often do you want the ad to appear?', 'options_framework_theme'),
		'id' => 'ad_posts_frequency',
		'std' => 'one',
		'type' => 'select',
		'class' => 'mini hide ad_posts_options', //mini, tiny, small
		'options' => array(
			'1' => __('Between every post', 'options_framework_theme'),
			'2' => __('Every 2th posts', 'options_framework_theme'),
			'3' => __('Every 3th post', 'options_framework_theme'),
			'4' => __('Every 4th post', 'options_framework_theme'),
			'5' => __('Every 5th post', 'options_framework_theme')
		));

	$options[] = array(
		'name' => __('Add white background', 'options_framework_theme'),
		'desc' => __('Check this to wrap the ad content in a white box', 'options_framework_theme'),
		'id' => 'ad_posts_box',
		'std' => '1',
		'class' => 'hide ad_posts_options',
		'type' => 'checkbox');



	$options[] = array(
		'name' => __('Ad spot #3 - Above the content.', 'options_framework_theme'),
		'desc' => __('Select what kind of ad you want added above the main container. <a target="_blank" href="http://bluth.is/wordpress/bliss/wp-content/uploads/2013/08/adspace_above_content.jpg">See Example</a>', 'options_framework_theme'),
		'id' => 'ad_content_mode',
		'std' => 'none',
		'type' => 'radio',
		'options' => array(
			'none' => __('None', 'options_framework_theme'),
			'html' => __('Shortcode or HTML code like Adsense', 'options_framework_theme'),
			'image' => __('Image with a link', 'options_framework_theme')
		));

	$options[] = array(
		'name' => __('Add Shortcode or HTML code here', 'options_framework_theme'),
		'desc' => __('Insert a shortcode provided by this theme or any plugin. You can also add advertising code from any provider or use plain html. To add Adsense just paste the embed code here that they provide and save.', 'options_framework_theme'),
		'id' => 'ad_content_code',
		'class' => 'hide ad_content_code',
		'std' => '',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('Upload Image', 'options_framework_theme'),
		'desc' => __('Upload an image to add above the header menu and add a link for it in the input box below', 'options_framework_theme'),
		'id' => 'ad_content_image',
		'class' => 'hide ad_content_image',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Image link', 'options_framework_theme'),
		'desc' => __('Add a link to the image', 'options_framework_theme'),
		'id' => 'ad_content_image_link',
		'class' => 'hide ad_content_image',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Add white background', 'options_framework_theme'),
		'desc' => __('Check this to wrap the ad content in a white box', 'options_framework_theme'),
		'id' => 'ad_content_box',
		'std' => '1',
		'class' => 'hide ad_content_options',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Add padding', 'options_framework_theme'),
		'desc' => __('Add padding to the banner container', 'options_framework_theme'),
		'id' => 'ad_content_padding',
		'class' => 'hide ad_content_options',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Banner placement', 'options_framework_theme'),
		'desc' => __('Where do you want the banner to appear?', 'options_framework_theme'),
		'id' => 'ad_content_placement',
		'class' => 'hide ad_content_options',
		'std' => array(
			'home' => '1',
			'pages' => '1',
			'posts' => '1'
		),
		'type' => 'multicheck',
		'options' => array(
			'home' => __('Frontpage', 'options_framework_theme'),
			'pages' => __('Pages', 'options_framework_theme'),
			'posts' => __('Posts', 'options_framework_theme')
		));

	$options[] = array(
		'name' => __('Social', 'options_framework_theme'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Facebook', 'options_framework_theme'),
		'desc' => __('Your facebook link', 'options_framework_theme'),
		'id' => 'social_facebook',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Twitter', 'options_framework_theme'),
		'desc' => __('Your twitter link', 'options_framework_theme'),
		'id' => 'social_twitter',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Google+', 'options_framework_theme'),
		'desc' => __('Your google+ link', 'options_framework_theme'),
		'id' => 'social_google',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('LinkedIn', 'options_framework_theme'),
		'desc' => __('Your LinkedIn link', 'options_framework_theme'),
		'id' => 'social_linkedin',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Youtube', 'options_framework_theme'),
		'desc' => __('Your youtube link', 'options_framework_theme'),
		'id' => 'social_youtube',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('RSS', 'options_framework_theme'),
		'desc' => __('Your RSS feed', 'options_framework_theme'),
		'id' => 'social_rss',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Flickr', 'options_framework_theme'),
		'desc' => __('Your Flickr link', 'options_framework_theme'),
		'id' => 'social_flickr',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Vimeo', 'options_framework_theme'),
		'desc' => __('Your vimeo link', 'options_framework_theme'),
		'id' => 'social_vimeo',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Pinterest', 'options_framework_theme'),
		'desc' => __('Your pinterest link', 'options_framework_theme'),
		'id' => 'social_pinterest',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Dribbble', 'options_framework_theme'),
		'desc' => __('Your dribbble link', 'options_framework_theme'),
		'id' => 'social_dribbble',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Tumblr', 'options_framework_theme'),
		'desc' => __('Your tumblr link', 'options_framework_theme'),
		'id' => 'social_tumblr',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Instagram', 'options_framework_theme'),
		'desc' => __('Your instagram link', 'options_framework_theme'),
		'id' => 'social_instagram',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Viadeo', 'options_framework_theme'),
		'desc' => __('Your viadeo link', 'options_framework_theme'),
		'id' => 'social_viadeo',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Custom CSS', 'options_framework_theme'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Add Custom CSS rules here', 'options_framework_theme'),
		'desc' => __('Here you can overwrite specific css rules if you want to customize your theme a little. Write into this box just like you would do in a regular css file. Example: body{ color: #444; }', 'options_framework_theme'),
		'id' => 'custom_css',
		'class' => 'custom_css',
		'std' => '',
		'type' => 'textarea');



	return $options;
}
<?php
/*
Plugin Name: bl Featured Post
Description: Display posts tagged with "featured"
Author: Ivar Rafn
Version: 1
Author URI: http://www.bluth.is/
*/
class bl_featured_post extends WP_Widget {

	function bl_featured_post(){
		$widget_ops = array('classname' => 'bl_featured_post', 'description' => '没使用过挂件，不知道什么功能，如果您清楚可以联系天屹' );
		$this->WP_Widget('bl_featured_post', 'Bluth Featured Post', $widget_ops);
	}


	function widget( $args, $instance ) {
		extract($args);
		$title 	= apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$text 	= apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );

		echo $before_widget;
		echo !empty($title) ? '<h3 class="widget-head">'.$title.'</h3>' : '';

			echo '<div class="widget-body">';
		        global $post;
		        $args = array(
	    		'tag' => 'featured',
	    		'numberposts' => 1 );

		        $myposts = get_posts( $args );
		        	echo '<img src="' . get_post_image( $myposts[0]->ID, 'featured_post' ) . '">';
		        	echo '<div class="featured_post_overlay"></div>';
		        	echo '<h4><a class="scale" href="' . get_permalink( $myposts[0]->ID ) . '">' . $myposts[0]->post_title . '</a></h4>';
			echo '</div>';
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] 			= strip_tags($new_instance['title']);

		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) );
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
		$title = strip_tags($instance['title']);
		$text = esc_textarea($instance['text']);
?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'bluth'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>

<?php
	}
}
add_action( 'widgets_init', create_function('', 'return register_widget("bl_featured_post");') );
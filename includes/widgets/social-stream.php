<?php
/**
 * Widgets for the Social Stream plugin
 *
 * @since {{VERSION}}
 *
 * @package Inosencio
 */

defined( 'ABSPATH' ) || die();

class Inosencio_Social_Stream extends WP_Widget {

	/**
	 * Inosencio_Social_Stream constructor.
	 *
	 * @since {{VERSION}}
	 */
	function __construct() {

		parent::__construct(
			'Inosencio_Social_Stream', // Base ID
			'Social Stream', // Name
			array(
				'classname'   => 'inosencio-social-stream',
				'description' => 'Outputs a Social Stream. Can be done as a "Feed" or a "Wall".',
			) // Args
		);

	}

	/**
	 * Front-end display of widget
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param        array $args Widget arguments
	 * @param        array $instance Saved values from database
	 *
	 * @access        public
	 * @since        {{VERSION}}
	 * @return        HTML
	 */
	public function widget( $args, $instance ) {

		$instance = wp_parse_args( $instance, array(
			'title' => '',
			'stream' => '',
			'format' => 'feed',
		) );

		echo $args['before_widget'];
		
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }
		
		if ( ! empty( $instance['stream'] ) ) {
			
			if ( $instance['format'] == 'feed' ) {
				
				echo do_shortcode( '[dc_social_feed id="' . $instance['stream'] . '"]' );
				
			}
			else {
				
				echo do_shortcode( '[dc_social_wall id="' . $instance['stream'] . '"]' );
				
			}
			
		}
		else {
			echo 'Please set a Stream in the Widget\'s settings';
		}
		
		echo $args['after_widget'];

	}

	/**
	 * Back-end widget form
	 *
	 * @see WP_Widget::form()
	 *
	 * @param        array $instance Previously saved values from database
	 *
	 * @access        public
	 * @since        {{VERSION}}
	 * @return        HTML
	 */
	public function form( $instance ) {

		// Previously saved Values
		$saved_title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$saved_stream = ! empty( $instance['stream'] ) ? $instance['stream'] : '';
		$saved_format = ! empty( $instance['format'] ) ? $instance['format'] : 'feed';

		$streams = new WP_Query( array(
			'post_type' => 'dc_streams',
			'posts_per_page' => -1,
			'orderby' => 'title',
			'order' => 'DESC',
		) );
		
		$streams_array = wp_list_pluck( $streams->posts, 'post_title', 'ID' );

		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
				Title:
			</label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $saved_title ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'stream' ); ?>">
				Stream:
			</label>
			
			<select id="<?php echo $this->get_field_id( 'stream' ); ?>" name="<?php echo $this->get_field_name( 'stream' ); ?>">
				
				<option value="" disabled<?php echo ( empty( $saved_stream ) ) ? ' selected' : ''; ?>>
					Select a Stream
				</option>
				
				<?php foreach ( $streams_array as $key => $value ) : ?>
				
					<option value="<?php echo $key; ?>"<?php echo ( $saved_stream == $key ) ? ' selected' : ''; ?>>
						<?php echo $value; ?>
					</option>
				
				<?php endforeach; ?>
				
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'format' ); ?>">
				Format:
			</label>
			<br />
			
			<input type="radio" name="<?php echo $this->get_field_name( 'format' ); ?>" value="feed"<?php echo ( $saved_format == 'feed' ) ? ' checked' : ''; ?> /> Feed
			<br />
			
			<input type="radio" name="<?php echo $this->get_field_name( 'format' ); ?>" value="wall"<?php echo ( $saved_format == 'wall' ) ? ' checked' : ''; ?> /> Wall
		</p>

		<?php

	}

	/**
	 * Sanitize widget form values as they are saved
	 *
	 * @see WP_Widget::update()
	 *
	 * @param        array $new_instance Values just sent to be saved
	 * @param        array $old_instance Previously saved values from database
	 *
	 * @access        public
	 * @since        {{VERSION}}
	 * @return        array Updated safe values to be saved
	 */
	public function update( $new_instance, $old_instance ) {

		$instance              = array();
		$instance['title']   = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['stream'] = ( ! empty( $new_instance['stream'] ) ) ? strip_tags( $new_instance['stream'] ) : '';
		$instance['format'] = ( ! empty( $new_instance['format'] ) ) ? strip_tags( $new_instance['format'] ) : 'feed';

		return $instance;

	}

}

register_widget( 'Inosencio_Social_Stream' );
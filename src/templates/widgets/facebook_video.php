<?php

class ANRed_Facebook_Video extends WP_Widget {

	function __construct() {
		parent::__construct(
			'anred_facebook_video',
			'Redes Sociales - Video de Facebook'
		);
	}
	 
	public function widget( $args, $instance ) {
		$defaults = array(
			'title' => '',
			'url' => 'https://www.facebook.com/AgenciaANRed/videos/1549602321790554/'
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		wp_enqueue_script( 'facebook', get_template_directory_uri() . '/scripts/facebook.js', array(), false, true );

		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) )
				echo $args['before_title'] . $instance['title'] . $args['after_title'] . '<br>';
/**
 * TODO:
 * - Averiguar porque .fb-video ignora margin-bottom y padding-bottom en celulares
 * - Hacer responsive
 */
?>
<div class="fb-video" data-href="<?php echo $instance['url'] ?>" data-show-text="false"></div><br><br>
<?php
		echo $args['after_widget'];
	}
			 
	public function form( $instance ) {
		$defaults = array(
			'title' => '',
			'url' => 'https://www.facebook.com/AgenciaANRed/videos/1549602321790554/'
		);

		$args = wp_parse_args( (array) $instance, $defaults );

?>
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>">Título</label>
		<input
				class="widefat"
				id="<?php echo $this->get_field_id( 'title' ); ?>"
				name="<?php echo $this->get_field_name( 'title' ); ?>"
				type="text"
				value="<?php echo sanitize_text_field( $args['title'] ); ?>"
			>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'url' ); ?>">URL</label>
		<input
				class="widefat"
				id="<?php echo $this->get_field_id( 'url' ); ?>"
				name="<?php echo $this->get_field_name( 'url' ); ?>"
				type="text"
				value="<?php echo sanitize_text_field( $args['url'] ); ?>"
			>
	</p>
<?php

	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = ( !empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['url'] = ( !empty( $new_instance['url'] ) ) ? sanitize_text_field( $new_instance['url'] ) : '';
		
		return $instance;
	}
}

register_widget( 'ANRed_Facebook_Video' );
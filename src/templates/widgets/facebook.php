<?php

class ANRed_Facebook extends WP_Widget {

	function __construct() {
		parent::__construct(
			'anred_facebook',
			'Redes Sociales - Facebook'
		);
	}
	 
	public function widget( $args, $instance ) {
		$defaults = array(
			'height' => '500',
			'account' => 'AgenciaANRed',
			'title' => 'ANRed - Agencia de Noticias RedAcción'
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		wp_enqueue_script( 'facebook', get_template_directory_uri() . '/scripts/facebook.js', array(), false, true );

		echo $args['before_widget'];
?>
<div
	class="fb-page"
	data-href="https://www.facebook.com/<?php echo $instance['account'] ?>/"
	data-tabs="timeline"
	data-height="<?php echo $instance['height'] ?>"
	data-small-header="false"
	data-width="500"
	data-adapt-container-width="true"
	data-hide-cover="false"
	data-show-facepile="true"><blockquote cite="https://www.facebook.com/AgenciaANRed/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/<?php echo $instance['account'] ?>/"><?php echo $instance['title'] ?></a></blockquote></div>
<?php
		echo $args['after_widget'];
	}
			 
	public function form( $instance ) {
		$defaults = array(
			'height' => '500',
			'account' => 'AgenciaANRed',
			'title' => 'ANRed - Agencia de Noticias RedAcción'
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
		<label for="<?php echo $this->get_field_id( 'account' ); ?>">Cuenta</label>
		<input
				class="widefat"
				id="<?php echo $this->get_field_id( 'account' ); ?>"
				name="<?php echo $this->get_field_name( 'account' ); ?>"
				type="text"
				value="<?php echo sanitize_text_field( $args['account'] ); ?>"
			>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'height' ); ?>">Alto (en px)</label>
		<input
				class="widefat"
				id="<?php echo $this->get_field_id( 'height' ); ?>"
				name="<?php echo $this->get_field_name( 'height' ); ?>"
				type="number"
				required="required"
				min="0"
				value="<?php echo sanitize_text_field( $args['height'] ); ?>"
			>
	</p>
<?php

	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = ( !empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['account'] = ( !empty( $new_instance['account'] ) ) ? sanitize_text_field( $new_instance['account'] ) : '';
		$instance['height'] = sanitize_option( 'comments_per_page', $new_instance['height'] );
		
		return $instance;
	}
}

register_widget( 'ANRed_Facebook' );
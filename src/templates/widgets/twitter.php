<?php

class ANRed_Twitter extends WP_Widget {

	function __construct() {
		parent::__construct(
			'anred_twitter',
			'Redes Sociales - Twitter'
		);
	}
	 
	public function widget( $args, $instance ) {
		$defaults = array(
			'height' => '500',
			'account' => 'Red__Accion'
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		wp_enqueue_script( 'twitter', 'https://platform.twitter.com/widgets.js', array(), false, true );
		

		echo $args['before_widget'];
?>
<a class="twitter-timeline" data-lang="es" data-height="<?php echo $instance['height'] ?>" href="https://twitter.com/<?php echo $instance['account'] ?>">Tweets by <?php echo $instance['account'] ?></a>
<?php
		echo $args['after_widget'];
	}
			 
	public function form( $instance ) {
		$defaults = array(
			'height' => '500',
			'account' => 'Red__Accion'
		);

		$args = wp_parse_args( (array) $instance, $defaults );

?>
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

		$instance['account'] = ( !empty( $new_instance['account'] ) ) ? sanitize_text_field( $new_instance['account'] ) : '';
		$instance['height'] = sanitize_option( 'comments_per_page', $new_instance['height'] );
		
		return $instance;
	}
}

register_widget( 'ANRed_Twitter' );
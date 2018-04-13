<?php

class ANRed_Populares extends WP_Widget {
	function __construct() {
		parent::__construct(
			'anred_populares',
			'Populares'
		);
	}
	 
	public function widget( $args, $instance ) {
		$defaults = array(
			'count' => 10,
			'title' => ''
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		$query_params = array(
			'posts_per_page' => $instance['count'],
			'post_type' => 'post',
			'suppress_filters' => true,
			'post_status' => 'publish',
			'order' => 'DESC',
			'orderby' => 'meta_value_num',
			'meta_key' => 'anred_view_count',
			'date_query' => array(
				array(
					'column' => 'post_date_gmt',
					'after' => '5 day ago'
				)
			)
		);

		global $wp_query;
		if ( get_the_ID() )
			$query_params['post__not_in'] = array( get_the_ID() );

		$query = new WP_Query( $query_params );

		if ( $query->have_posts() ) {
			echo $args['before_widget'];
			if ( ! empty( $instance['title'] ) )
				echo $args['before_title'] . $instance['title'] . $args['after_title'];
			echo '<ol class="populares">';
			while ( $query->have_posts() ) {
				$query->the_post();
				$who = get_post_meta(get_the_ID(), 'who', true);
				echo '<li>';
				if ($who != '')
					echo '<b>' . $who . ':</b> ';
				echo '<a href="' . get_the_permalink() . '">' . get_the_title() . '</a>';
				echo '</li>';
			}
			echo '</ul>';
			echo $args['after_widget'];
		}

		wp_reset_postdata();
	}
			 
	public function form( $instance ) {
		$defaults = array(
			'title' => '',
			'count' => 5
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
		<label for="<?php echo $this->get_field_id( 'count' ); ?>">Cantidad de entradas</label>
		<input
				class="widefat"
				id="<?php echo $this->get_field_id( 'count' ); ?>"
				name="<?php echo $this->get_field_name( 'count' ); ?>"
				type="number"
				required="required"
				min="0"
				value="<?php echo sanitize_text_field( $args['count'] ); ?>"
			>
	</p>
<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = ( !empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['count'] = sanitize_option( 'comments_per_page', $new_instance['count'] );

		return $instance;
	}
}

register_widget( 'ANRed_Populares' );
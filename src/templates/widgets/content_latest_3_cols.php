<?php

class ANRed_Content_Latest_3_Cols extends WP_Widget {
	function __construct() {
		parent::__construct(
			'anred_content_latest_3_cols',
			'Contenido - Últimas - 3 Columnas'
		);
	}
	 
	public function widget( $args, $instance ) {
		$defaults = array(
			'count' => 3
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		$query = new WP_Query( array(
			'posts_per_page' => $instance['count'],
			'cat' => 0,
			'orderby' => 'date',
			'order' => 'DESC',
			'post_type' => 'post',
			'suppress_filters' => true,
			'post_status' => 'publish',
			'post__not_in' => Deduplicator::get()
		) );

		if ( $query->have_posts() ) {
			echo $args['before_widget'];
			if ( ! empty( $instance['title'] ) )
				echo $args['before_title'] . $instance['title'] . $args['after_title'];

			$i = 0;
			while ( $query->have_posts() ) {
				$query->the_post();
				Deduplicator::add(get_the_ID());
				if ($i % 3 == 0)
					echo '<div class="card-deck article-deck">';

				get_template_part( 'partials/card' );
				$i++;

				if ($i % 3 == 0)
					echo '</div>';
			}

			echo $args['after_widget'];
		}

		wp_reset_postdata();
	}
			 
	public function form( $instance ) {
		$defaults = array(
			'title' => '',
			'count' => 3
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
		<label for="<?php echo $this->get_field_id( 'count' ); ?>">Cantidad de artículos</label>
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

register_widget( 'ANRed_Content_Latest_3_Cols' );
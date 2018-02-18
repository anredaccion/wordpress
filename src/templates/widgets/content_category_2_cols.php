<?php

class ANRed_Content_Category_2_Cols extends WP_Widget {
	function __construct() {
		parent::__construct(
			'anred_content_category_2_cols',
			'Contenido - Categoría - 2 Columnas'
		);
	}
	 
	public function widget( $args, $instance ) {
		$defaults = array(
			'count' => 2,
			'category' => get_queried_object_id()
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		$query = new WP_Query( array(
			'posts_per_page' => $instance['count'],
			'cat' => $instance['category'],
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
				echo $args['before_title'] . '<a href="'. esc_url( get_category_link( $instance['category'] ) ) .'">' . $instance['title'] . '</a>' . $args['after_title'];

			$i = 0;
			while ( $query->have_posts() ) {
				$query->the_post();
				Deduplicator::add(get_the_ID());
				
				if ($i % 2 == 0)
					echo '<div class="card-deck article-deck">';

				get_template_part( 'partials/card' );
				$i++;

				if ($i % 2 == 0)
					echo '</div>';
			}

			echo $args['after_widget'];
		}

		wp_reset_postdata();
	}
			 
	public function form( $instance ) {
		$defaults = array(
			'title' => '',
			'count' => 2,
			'category' => 0
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
		<label for="<?php echo $this->get_field_id( 'category' ); ?>">Categoría</label>
		<?php wp_dropdown_categories( [
			'name' => $this->get_field_name( 'category' ),
			'id' => $this->get_field_id( 'category' ),
			'selected' => $args['category'],
			'show_option_none' => 'Seleccionar categoría',
			'orderby' => 'name',
			'show_count' => 1
		] ); ?>
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
		if ($new_instance['category'] != "-1")
			$instance['category'] = sanitize_option( 'default_category', $new_instance['category'] );
		$instance['count'] = sanitize_option( 'comments_per_page', $new_instance['count'] );

		return $instance;
	}
}

register_widget( 'ANRed_Content_Category_2_Cols' );
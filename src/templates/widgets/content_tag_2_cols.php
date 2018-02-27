<?php

class ANRed_Content_Tag_2_Cols extends WP_Widget {
	function __construct() {
		parent::__construct(
			'anred_content_tag_2_cols',
			'Contenido - Etiqueta - 2 Columnas'
		);
	}
	 
	public function widget( $args, $instance ) {
		$defaults = array(
			'count' => 2,
			'tag' => get_queried_object_id()
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		$query_params = array(
			'posts_per_page' => $instance['count'],
			'tag_id' => $instance['tag'],
			'orderby' => 'date',
			'order' => 'DESC',
			'post_type' => 'post',
			'suppress_filters' => true,
			'post_status' => 'publish'
		);

		if (0 == $instance['repeat'])
			$query_params['post__not_in'] = Deduplicator::get();

		$query = new WP_Query( $query_params );

		if ( $query->have_posts() ) {
			echo $args['before_widget'];
			if ( ! empty( $instance['title'] ) )
				echo $args['before_title'] . $instance['title'] . $args['after_title'];

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

			if ($i % 2 != 0)
					echo '</div>';

			echo $args['after_widget'];
		}

		wp_reset_postdata();
	}
			 
	public function form( $instance ) {
		$defaults = array(
			'title' => '',
			'count' => 2,
			'tag' => 0,
			'repeat' => 0
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
		<label for="<?php echo $this->get_field_id( 'tag' ); ?>">Categoría</label>
		<?php wp_dropdown_categories( array(
			'name' => $this->get_field_name( 'tag' ),
			'id' => $this->get_field_id( 'tag' ),
			'selected' => $args['tag'],
			'show_option_none' => 'Seleccionar etiqueta',
			'taxonomy' => 'post_tag',
			'orderby' => 'name',
			'show_count' => 1
		) ); ?>
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
	<p>
		<input
				class="checkbox" type="checkbox"
				<?php checked( $args['repeat'] ); ?>
				id="<?php echo $this->get_field_id( 'repeat' ); ?>"
				name="<?php echo $this->get_field_name( 'repeat' ); ?>"
			>
		<label for="<?php echo $this->get_field_id( 'repeat' ); ?>">Repetir artículos</label>
	</p>
<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = ( !empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		if ($new_instance['tag'] != "-1")
			$instance['tag'] = sanitize_option( 'default_category', $new_instance['tag'] );
		$instance['count'] = sanitize_option( 'comments_per_page', $new_instance['count'] );
		$instance['repeat'] = ( isset( $new_instance['repeat'] ) && $new_instance['repeat'] ) ? 1 : 0;

		return $instance;
	}
}

register_widget( 'ANRed_Content_Tag_2_Cols' );
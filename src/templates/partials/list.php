<?php

function make_query_params( $counter, $offset = 0 ) {
	$query_params = array(
		'posts_per_page'   => $counter,
		'orderby'          => 'date',
		'order'            => 'DESC',
		'post_type'        => 'post',
		'suppress_filters' => true,
		'post_status'      => 'publish',
		'post__not_in'     => Deduplicator::get(),
	);

	if ( get_query_var( 'paged' ) ) {
		$query_params['paged'] = get_query_var( 'paged' );
		$offset += (get_query_var( 'paged' ) - 1) * 10;
	}
	$query_params['offset'] = $offset;

	if ( get_query_var( 'cat' ) ) {
		$query_params['cat'] = get_query_var( 'cat' );
	}

	if ( get_query_var( 'tag' ) ) {
		$query_params['tag'] = get_query_var( 'tag' );
	}

	return $query_params;
}

$query = new WP_Query( make_query_params( 4 ) );

if ( $query->have_posts() ) {

	$i = 0;
	while ( $query->have_posts() ) {
		$query->the_post();
		
		if ($i % 2 == 0)
			echo '<div class="card-deck article-deck">';

		get_template_part( 'partials/card' );
		$i++;

		if ($i % 2 == 0)
			echo '</div>';
	}

	if ($i % 2 != 0)
		echo '</div>';
}

$query = new WP_Query( make_query_params( 6, 4 ) );

if ( $query->have_posts() ) {

	$i = 0;
	while ( $query->have_posts() ) {
		$query->the_post();
		
		if ($i % 3 == 0)
			echo '<div class="card-deck article-deck">';

		get_template_part( 'partials/card' );
		$i++;

		if ($i % 3 == 0)
			echo '</div>';
	}

	if ($i % 3 != 0)
		echo '</div>';
}
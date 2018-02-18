<?php
$query = new WP_Query( [
	'posts_per_page' => 5,
	'orderby' => 'date',
	'order' => 'DESC',
	'post_type' => 'post',
	'suppress_filters' => true,
	'post_status' => 'publish'
] );
?>
<div id="hero-news" class="carousel slide" data-ride="carousel" data-interval="5000">
	<div class="carousel-inner">
		<ol class="carousel-indicators">
		<?php for($i = 0; $i < $query->post_count; $i++): ?>
			<li data-target="#hero-news" data-slide-to="<?php echo $i ?>"<?php echo ( $i == 0 ? ' class="active"' : '' ) ?>></li>
		<?php endfor; ?>
		</ol>

		<?php
		while ( $query->have_posts() ) {
			$query->the_post();
			Deduplicator::add( get_the_ID() );
			set_query_var( 'current_post', $query->current_post );
			if ( has_post_format( 'video' ) ) {
				get_template_part( 'partials/hero', 'video' );
			} else {
				get_template_part( 'partials/hero', 'std' );
			}
		}
		?>
	</div>

	<?php if (!wp_is_mobile()): ?>
	<a class="carousel-control-prev" href="#hero-news" role="button" data-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="carousel-control-next" href="#hero-news" role="button" data-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
	<?php endif; ?>
</div>
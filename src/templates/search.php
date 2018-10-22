<?php

global $query_string;

wp_parse_str( $query_string, $search_query );
$query = new WP_Query( $search_query );

?>
<?php get_header(); ?>
<div class="container">
<?php if ( $query->have_posts() ) : ?>
	<ul class="search-results">
	<?php while ($query->have_posts()) : $query->the_post(); ?>
		<li class="result clearfix">
			<?php
				if ( has_post_format( 'video' ) ) {
					echo '<img width="100" height="100" src="' . anred_get_video_thumbnail( get_the_ID(), 'small' ) . '" class="attachment-100x100 size-100x100 wp-post-image" alt="">';
				} else {
					the_post_thumbnail( array( 100, 100 ) );
				}
			?>
			<h5><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h5>
			<div class="date text-muted"><i class="fa fa-calendar"></i> <?php the_date() ?></div>
			<?php the_excerpt(); ?>
		</li>
	<?php endwhile; ?>
	</ul>
	<?php anred_paging_nav() ?>
<?php endif; ?>
</div>
<?php get_footer(); ?>
<div class="carousel-item <?php echo ($current_post == 0 ? 'active' : ''); ?>">
	<div class="d-block w-100 image" style="background-image: -webkit-image-set(
		url('<?php the_post_thumbnail_url('medium_large') ?>') 0.5x,
		url('<?php the_post_thumbnail_url('full') ?>') 1.0x
	);"></div>
	<div class="carousel-caption d-md-block">
		<h3><a href="<?php the_permalink() ?>" alt="<?php the_title(); ?>"><?php the_title(); ?></a></h3>

		<div class="tags">
		<?php
		$tags = get_the_category();
		foreach($tags as $tag) {
			echo '<div class="tag"><a href="'. esc_url( get_category_link( $tag->term_id ) ) .'">' . $tag->name . '</a></div>';
		}
		?>
		</div>
	</div>
</div>
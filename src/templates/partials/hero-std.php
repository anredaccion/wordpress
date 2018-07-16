<div class="carousel-item <?php echo ($current_post == 0 ? 'active' : ''); ?>">
	<picture>
		<source media="(min-width: 1101px)" srcset="<?php the_post_thumbnail_url( 'full' ) ?>">
		<source media="(min-width: 826px)" srcset="<?php the_post_thumbnail_url( 'post-thumbnail' ) ?>">
		<source media="(min-width: 691px)" srcset="<?php the_post_thumbnail_url( 'article-large' ) ?>">
		<source media="(min-width: 511px)" srcset="<?php the_post_thumbnail_url( 'article-medium' ) ?>">
		<source media="(min-width: 384px)" srcset="<?php the_post_thumbnail_url( 'article-small' ) ?>">
		<source media="(min-width: 316px)" srcset="<?php the_post_thumbnail_url( 'frontpage-2x-big' ) ?>">
		<source media="(min-width: 226px)" srcset="<?php the_post_thumbnail_url( 'frontpage-2x-medium' ) ?>">
		<img class="d-block w-100" src="<?php the_post_thumbnail_url( 'frontpage-2x-small' ) ?>">
	</picture>
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
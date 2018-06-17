<div class="carousel-item <?php echo ($current_post == 0 ? 'active' : ''); ?>">
	<div class="carousel-caption d-md-block">
		<h3><a href="<?php the_permalink() ?>" alt="<?php the_title(); ?>"><?php the_title(); ?></a></h3>

		<div class="tags">
		<?php
		$cats = get_the_category();
		foreach($cats as $cat) {
			echo '<div class="tag"><a href="'. esc_url( get_category_link( $cat->term_id ) ) .'">' . $cat->name . '</a></div>';
		}
		?>
		</div>
	</div>
	<div
		class="d-block w-100 video"
		style="background-image: url('<?php echo anred_get_video_thumbnail( get_the_ID() ) ?>');"
		data-video="<?php echo anred_get_video_url( get_the_ID() ) ?>?modestbranding=1&rel=0&showinfo=0&html5=1&autoplay=1"
		data-toggle="modal"
		data-target="#videoModal"
	>
		<i class="far fa-play-circle play-icon" aria-hidden="true"></i>
	</div>
</div>
<?php get_header(); ?>
<div class="article container">
	<div class="row">
		<div class="col-md-9 col-sm-12">
			<?php while (have_posts()) : the_post(); ?>
			<article <?php post_class(); ?>>
				<header>
					<div class="date text-muted">
						<i class="fa fa-calendar"></i> <?php the_date() ?>
					</div>
					<div class="cats">
						<?php
						$cats = get_the_category();
						$output = array();

						foreach($cats as $cat)
							$output[] = '<a class="tag" href="'. esc_url( get_category_link( $cat->term_id ) ) .'">' . $cat->name . '</a>';
						
						echo implode(' | ', $output);
						?>
					</div>
					<div class="tags">
						<?php
						$tags = get_the_tags();
						if ($tags) {
							$output = array();

							foreach($tags as $tag)
								$output[] = '<a class="tag" href="'. esc_url( get_tag_link( $tag->term_id ) ) .'">' . $tag->name . '</a>';
							
							echo implode(', ', $output);
						}
						?>
					</div>
					<h1><?php the_title(); ?></h1>
				</header>
				<div>
					<!-- the_content() begin -->
					<?php the_content(); ?>
					<!-- the_content() end -->
				</div>
				<hr>
				<footer>
					<div class="comments-counter ">
						<i class="fa fa-comments" aria-hidden="true"></i> <?php echo get_comments_number(); ?> comentarios
					</div>
					<br>
					<?php comments_template() ?>
				</footer>
			</article>
			<?php endwhile; ?>
		</div>
		<div class="col-md-3 col-sm-12">
			<?php dynamic_sidebar( 'article' ); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
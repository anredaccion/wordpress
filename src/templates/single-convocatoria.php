<?php get_header(); ?>
<div class="convocatoria container">
	<div class="row">
		<div class="col-12">
			<?php
				while (have_posts()):
					the_post();
					$date = get_post_meta( get_the_ID(), 'when-date', true );
					$time = get_post_meta( get_the_ID(), 'when-time', true );
					$when = mysql2date('d/m/Y', $date) . ' ' . $time;

					$where = get_post_meta( get_the_ID(), 'where', true );

					$who = get_post_meta( get_the_ID(), 'who', true );

			?>
			<article <?php post_class(); ?>>
				<header>
					<div class="text-muted">
						<i class="fa fa-calendar"></i> <?php echo $when; ?> <i class="fa fa-map-marker"></i> <?php echo $where; ?>
					</div>
					<h1><?php the_title(); ?></h1>
				</header>
				<div>
					<?php the_content(); ?>
				</div>
			</article>
			<?php endwhile; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
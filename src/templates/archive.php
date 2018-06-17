<?php get_header(); ?>

<div class="container archive">
	<div class="row">
		<div class="col-md-3 col-sm-12">
			<?php dynamic_sidebar( 'archive' ); ?>
		</div>
		<div class="col-md-9 col-sm-12">

			<h1 class="page-title">
				<?php
				if ( is_day() ) :
						echo 'Archivo del '. get_the_date( 'l j F, Y');
					elseif ( is_month() ) :
						echo 'Archivo de ' . get_the_date( 'F Y' );
					elseif ( is_year() ) :
						echo 'Archivo año ' . get_the_date( 'Y' );
					else :
						_e( 'Archivos', 'anred' );
					endif;
				?>
			</h1>

			<?php if ( have_posts() ) : ?>
				<ul>
				<?php while ( have_posts() ) : the_post(); ?>
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
	</div>
</div>

<?php get_footer(); ?>
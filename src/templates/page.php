<?php
get_header();
?>
<div class="article container">
	<div class="row">
		<div class="col-md-9 col-sm-12">
			<?php while (have_posts()) : the_post(); ?>
			<article <?php post_class(); ?>>
				<header>
					<h1><?php the_title(); ?></h1>
				</header>
				<div>
					<?php the_content(); ?>
				</div>
			</article>
			<?php endwhile; ?>
		</div>
		<div class="col-md-3 col-sm-12">
			<?php dynamic_sidebar( 'sidebar' ); ?>
		</div>
	</div>
</div>
<?php
get_footer();
?>
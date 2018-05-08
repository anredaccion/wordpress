<?php get_header(); ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-9 col-sm-12">
			<?php dynamic_sidebar( 'content' ); ?>
			<br>
			<div class="nav-previous alignleft"><?php next_posts_link( '&#8592; Anteriores' ); ?></div>
			<div class="nav-next alignright"><?php previous_posts_link( 'Siguientes &#8594;' ); ?></div>
		</div>
		<div class="col-md-3 col-sm-12">
			<?php dynamic_sidebar( 'sidebar' ); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
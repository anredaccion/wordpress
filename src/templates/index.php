<?php get_header(); ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-9 col-sm-12">
			<?php dynamic_sidebar( 'content' ); ?>
		</div>
		<div class="col-md-3 col-sm-12">
			<?php dynamic_sidebar( 'sidebar' ); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
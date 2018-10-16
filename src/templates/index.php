<?php get_header(); ?>
<div class="container">
	<div class="row">
		<div class="col-md-9 col-sm-12">
			<?php dynamic_sidebar( 'content' ); ?>
			<?php get_template_part( 'partials/list' ); ?>
			<?php anred_simple_nav() ?>
		</div>
		<div class="col-md-3 col-sm-12">
			<?php dynamic_sidebar( 'sidebar' ); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
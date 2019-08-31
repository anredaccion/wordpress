<?php
$term = get_term_by(
	'slug',
	get_query_var( 'tag' ),
	'post_tag'
);
get_header();
?>
<div class="container tags">
	<div class="row">
		<div class="col-12">
			<h1><?php echo $term->name; ?></h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-9 col-sm-12">
			<?php get_template_part( 'partials/list' ); ?>
			<?php anred_simple_nav() ?>
		</div>
		<div class="col-md-3 col-sm-12">
			<?php dynamic_sidebar( 'sidebar' ); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
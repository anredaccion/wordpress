<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php get_template_part( 'partials/navbar' ); ?>
<?php $show_hero = get_theme_mod( 'anred_show_hero', true ); ?>
<?php if ( is_front_page() && is_home() && $show_hero): ?>
<div class="main header container">
	<?php get_template_part( 'partials/hero' ); ?>
	</div>
<?php endif; ?>

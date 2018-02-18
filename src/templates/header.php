<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Agencia de Noticias RedAcci&oacute;n. 20 a&ntilde;os de comunicaci&oacute;n alternativa, comunitaria y popular.">
	<title>ANRed</title>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php get_template_part( 'partials/navbar' ); ?>
<div class="main header">
<?php
if ( is_front_page() && is_home() )
	get_template_part( 'partials/hero' );
else
	echo '&nbsp;';
?>
</div>
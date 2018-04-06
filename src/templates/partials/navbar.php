<?php
$custom_logo_id = get_theme_mod( 'custom_logo' );
$logo = wp_get_attachment_image_src( $custom_logo_id , 'medium' );
?>
<nav class="navbar justify-content-between navbar-light bg-light sticky-navbar">
	<div class="btn-expand-sidebar"><span class="navbar-toggler-icon"></span></div>
	<a class="navbar-brand" href="<?php echo get_site_url(); ?>"><img src="<?php echo $logo[0] ?>" class="logo" alt="Logo Sitio"></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#header-search" aria-controls="header-search" aria-expanded="<?php echo ((get_search_query() != '') ? 'true' : 'false') ?>" aria-label="Buscar">
		<i class="fa fa-search" aria-hidden="true"></i>
	</button>
	<div class="collapse navbar-collapse<?php echo ((get_search_query() != '') ? ' show' : '') ?>" id="header-search">
		<?php get_search_form() ?>
	</div>
</nav>
<div class="navbar-primary">
	<a class="navbar-brand" href="<?php echo get_site_url(); ?>"><img src="<?php echo get_template_directory_uri() ?>/images/logo-invertido.png" class="logo" alt="Logo Sitio"></a>
	<?php if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ 'primary_navigation' ] ) )
		wp_nav_menu( array( 'theme_location' => 'primary_navigation' ) );
	?>
	<div class="nav-link ml-auto"><?php dynamic_sidebar( 'header-social' ); ?></div>
	<br>
</div>
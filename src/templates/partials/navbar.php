<?php
$custom_logo_id = get_theme_mod( 'custom_logo' );
$logo = wp_get_attachment_image_src( $custom_logo_id , 'medium' );
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
	<div class="container">
			<a class="navbar-brand" href="<?php echo get_site_url(); ?>"><img src="<?php echo $logo[0] ?>" class="logo" alt="Logo Sitio"></a>
			
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarPrimary" aria-controls="navbarPrimary" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			
			<div class="collapse navbar-collapse" id="navbarPrimary">
				<ul class="navbar-nav mr-auto">
				<?php
if (($locations = get_nav_menu_locations()) && isset($locations['primary_navigation'])) {
	$menu = wp_get_nav_menu_object($locations['primary_navigation']);
	$menu_items = wp_get_nav_menu_items($menu->term_id);

	function nav_get_children($items, $parentId, $depth) {
		$children = array();
		foreach($items as $id => $child)
		{
			if($child->menu_item_parent == $parentId)
			{
				$child->depth = $depth;
				$child->children = nav_get_children($items, $child->ID, $depth + 1);
				$children[] = $child;
			}
		}
		return $children;
	}

	$menu_items = nav_get_children($menu_items, 0, 0);

	$menu_list = "";
	foreach ((array) $menu_items as $menu_item) {
		if ( $menu_item->children ) {
			$menu_list .= '<li class="nav-item dropdown">';
			$menu_list .= '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown' . $menu_item->ID . '" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . $menu_item->title . '</a>';
			$menu_list .= '<div class="dropdown-menu" aria-labelledby="navbarDropdown' . $menu_item->ID . '">';
			
			foreach ((array) $menu_item->children as $submenu_item) {
				$menu_list .= "<a class=\"dropdown-item\" href=\"$submenu_item->url\">$submenu_item->title</a>\n";
			}
			$menu_list .= '</div>';
			$menu_list .= '</li>';
		} else {
			$menu_list .= "<li class=\"nav-item\"><a class=\"nav-link\" href=\"$menu_item->url\">$menu_item->title</a></li>\n";
		}
	}

	echo $menu_list;
}
?>
				</ul>
				<?php get_search_form() ?>
			</div>
	</div>
</nav>
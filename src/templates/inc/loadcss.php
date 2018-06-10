<?php

function anred_loadcss_script() {
	if (!$filepath = locate_template('scripts/loadcss.js')) {
		trigger_error( __('Error localizando el script loadcss.js para su inclusión', 'anred' ), E_USER_ERROR );
	}

	echo '<script>';
	require_once $filepath;
	echo '</script>';
}

add_action( 'wp_head', 'anred_loadcss_script', 5 );

function anred_style_loader_tag( $html, $handle, $href, $media ) {
    return "<script>loadCSS('$href', 0, '$media');</script>\n";
}

add_filter( 'style_loader_tag', 'anred_style_loader_tag', 9999, 4 );
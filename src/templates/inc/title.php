<?php

function anred_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}

	global $page, $paged;

	$title .= " $sep " . get_bloginfo( 'name', 'display' );
 
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= " $sep " . sprintf( __( 'Page %s', '_s' ), max( $paged, $page ) );
	}

	return $title;
}

add_filter( 'wp_title', 'anred_title', 10, 2 );
<?php

function anred_default_meta( $data ) {
	$properties = array();

	$properties['language'] = get_locale();

	if ( is_single() ) {
		global $post;
		setup_postdata( $post->ID );

		$properties['description'] = wp_strip_all_tags( get_the_excerpt(), true );
		$properties['keywords'] = $data['keywords'];
		$properties['category'] = $data['category'];
	}

	return $properties;
}

function anred_opengraph_meta() {
	$properties = array();
	$properties['og:locale'] = get_locale();

	if ( is_single() ) {
		global $post;
		setup_postdata( $post->ID );

		$properties['og:site_name'] = get_bloginfo('name');
		$properties['og:title'] = get_the_title() . ' | ' . get_bloginfo('name');
		$properties['og:description'] = wp_strip_all_tags( get_the_excerpt(), true );
		$properties['og:url'] = get_the_permalink();

		switch ( get_post_format() ) {
			case 'video':
				$properties['og:type'] = 'video.other';
				$properties['og:image'] = anred_get_video_thumbnail( get_the_ID(), 'full' );
				$properties['og:video'] = anred_get_video_url( get_the_ID() );
				break;
			default:
				$properties['og:type'] = 'article';
				if ( has_post_thumbnail() ) {
					$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
					$properties['og:image'] = $image[0];
					$properties['og:image:width'] = $image[1];
					$properties['og:image:height'] = $image[2];
				}
		}
	} else {
		$properties['og:title'] = get_bloginfo('name');
		$properties['og:description'] = get_bloginfo('description');
		$properties['og:type'] = 'website';
		if ( has_custom_logo() ) {
			$image = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ) , 'full' );
			$properties['og:image'] = $image[0];
			$properties['og:image:width'] = $image[1];
			$properties['og:image:height'] = $image[2];
		}
		$properties['og:url'] = get_site_url();
	}

	return $properties;
}

function anred_facebook_meta( $data ) {
	$properties = array();

	// TODO: Agregar al customizer la posibilidad de personalizar estos valores
	$properties['fb:app_id'] = '1064341813650267';
	$properties['fb:pages'] = '153390948078372';

	if ( is_single() ) {
		$properties['article:publisher'] = 'https://www.facebook.com/AgenciaANRed/';
		$properties['article:section'] = $data['category'];
		$properties['article:tag'] = $data['keywords'];
	}

	return $properties;
}

function anred_twitter_meta() {
	$properties = array();
	
	// TODO: Agregar al customizer la posibilidad de personalizar estos valores
	$properties['twitter:site'] = '@Red__Accion';
	$properties['twitter:site:id'] = '158505485';

	if ( is_single() ) {
		global $post;
		setup_postdata( $post->ID );

		// TODO: Agregar al post la posibilidad de cambiar estos valores
		$properties['twitter:creator'] = '@Red__Accion';
		$properties['twitter:creator:id'] = '158505485';

		$properties['twitter:title'] = get_the_title() . ' | ' . get_bloginfo('name');
		$properties['twitter:description'] = wp_strip_all_tags( get_the_excerpt(), true );

		switch ( get_post_format() ) {
			case 'video':
				$properties['twitter:card'] = 'player';
				$properties['twitter:player'] = anred_get_video_url( get_the_ID() );
				$properties['twitter:image'] = anred_get_video_thumbnail( get_the_ID(), 'full' );
				break;
			default:
				$properties['twitter:card'] = 'summary_large_image';
				if ( has_post_thumbnail() )
					$properties['twitter:image'] = wp_get_attachment_image_url( get_post_thumbnail_id(), 'full' );
		}
	} else {
		$properties['twitter:card'] = "summary";
		$properties['twitter:title'] = get_bloginfo('name');
		$properties['twitter:description'] = get_bloginfo('description');
		if ( has_custom_logo() )
			$properties['twitter:image'] = wp_get_attachment_image_url( get_theme_mod( 'custom_logo' ) , 'full' );
	}

	return $properties;
}

function add_meta_tags() {
	$data = array();

	if ( is_single() ) {
		$_cats = wp_list_pluck( get_the_category(), 'name' );
		$data['category'] = $_cats[0];

		$_tags = wp_list_pluck( get_the_tags(), 'name' );

		$_keywords = array_merge( $_cats, $_tags );
		$data['keywords'] = implode( $_keywords, ', ' );
	} else {
		// TODO: Agregar al customizer la posibilidad de personalizar estos valores
		$data['keywords'] = 'anred agencia de noticias redaccion argentina';
	}


	$dm = anred_default_meta( $data );
	foreach ( $dm as $property => $content )
		echo '<meta name="' . $property . '" content="' . $content . '" /> ';

	$og = anred_opengraph_meta();
	foreach ( $og as $property => $content )
		echo '<meta property="' . $property . '" content="' . $content . '" /> ';

	$fb = anred_facebook_meta( $data );
	foreach ( $fb as $property => $content )
		echo '<meta property="' . $property . '" content="' . $content . '" /> ';

	$tw = anred_twitter_meta( $data );
	foreach ( $tw as $property => $content )
		echo '<meta name="' . $property . '" content="' . $content . '" /> ';
}

add_action( 'wp_head', 'add_meta_tags' , 2 );
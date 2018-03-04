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
	$properties['og:locale'] = 'es_LA';
    $properties['og:site_name'] = get_bloginfo('name');

	if ( is_single() ) {
		global $post;
		setup_postdata( $post->ID );

		switch ( get_post_format() ) {
			case 'video':
				$properties['og:type'] = 'video.other';
				$properties['og:image'] = anred_get_video_thumbnail( get_the_ID(), 'full' );
				$properties['og:image:width'] = '1280';
				$properties['og:image:height'] = '720';
				$properties['og:video'] = str_replace( '/embed/', '/v/', anred_get_video_url( get_the_ID() ) );
				$properties['og:video:secure_url'] = $properties['og:video'];
				$properties['og:video:type'] = 'application/x-shockwave-flash';
				$properties['og:video:width'] = '1280';
				$properties['og:video:height'] = '720';
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

		$properties['og:title'] = get_the_title() . ' | ' . get_bloginfo('name');
		$properties['og:image:alt'] = $properties['og:title'];
		$properties['og:description'] = wp_strip_all_tags( get_the_excerpt(), true );
		if ( '' == $properties['og:description'] )
			$properties['og:description'] = get_the_title();
		$properties['og:url'] = get_the_permalink();
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

	if ( is_single() && ! has_post_format( 'video' ) ) {
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
		if ( '' == $properties['twitter:description'] )
			$properties['twitter:description'] = get_the_title();

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
		global $post;
		setup_postdata( $post->ID );

		$_cats = wp_list_pluck( get_the_category(), 'name' );
		$data['category'] = $_cats[0];

		if ( get_the_tags() ) {
			$_tags = wp_list_pluck( get_the_tags(), 'name' );
			$_keywords = array_merge( $_cats, $_tags );
		} else {
			$_keywords = $_cats;
		}

		$data['keywords'] = implode( $_keywords, ', ' );

	} else {
		// TODO: Agregar al customizer la posibilidad de personalizar estos valores
		$data['keywords'] = 'anred agencia de noticias redaccion argentina';
	}


	$dm = anred_default_meta( $data );
	foreach ( $dm as $property => $content )
		echo '<meta name="' . $property . '" content="' . $content . '" />' . "\n";

	$og = anred_opengraph_meta();
	foreach ( $og as $property => $content )
		echo '<meta property="' . $property . '" content="' . $content . '" />' . "\n";

	$fb = anred_facebook_meta( $data );
	foreach ( $fb as $property => $content )
		echo '<meta property="' . $property . '" content="' . $content . '" />' . "\n";

	$tw = anred_twitter_meta( $data );
	foreach ( $tw as $property => $content )
		echo '<meta name="' . $property . '" content="' . $content . '" />' . "\n";
}

add_action( 'wp_head', 'add_meta_tags' , 2 );
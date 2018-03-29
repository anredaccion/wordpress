<?php

/*
** TODO:
** - Modificar la función para que se pueda utilizar sin pasar el post id
** - Agregar soporte para otras fuentes (prioritariamente Facebook)
** - Adaptar al estilo de funciones de wp: the_thumb, get_the_thumb
*/
function anred_get_video_url( $post_id ) {

	$content_post = get_post( $post_id );
	$content      = $content_post->post_content;
	$content      = apply_filters( 'the_content', $content );
	$content      = str_replace( ']]>', ']]&gt;', $content );

	$content = substr( $content, 0, 500 );

	preg_match( '/\/\/(www\.)?(youtu|youtube)\.(com|be)\/(watch|embed)?\/?(\?v=)?([a-zA-Z0-9\-\_]+)/', $content, $youtube_matches );
	preg_match( '#https?://(.+\.)?vimeo\.com/.*#i', $content, $vimeo_matches );

	$youtube_id = ! empty( $youtube_matches ) ? $youtube_matches[6] : '';

	$vimeo_id = '';
	if ( ! empty( $vimeo_matches ) ) {
		$data     = preg_replace( '/ .*$/m', '', $vimeo_matches[0] );
		$vimeo_id = preg_replace( '/[^0-9]/', '', $data );
	}

	if ( $youtube_id ) {
		return 'https://www.youtube.com/embed/' . $youtube_id;

	} elseif ( $vimeo_id ) {
		return 'https://player.vimeo.com/video/' . $vimeo_id;
	}
}

/**
 * Tamaños: full, medium, small
 * 
 * TODO:
 * - Modificar la función para que se pueda utilizar sin pasar el post id
 * - Agregar soporte para otras fuentes (prioritariamente Facebook)
 * - Adaptar al estilo de funciones de wp: the_thumb, get_the_thumb
 */
function anred_get_video_thumbnail( $post_id, $size = 'full' ) {
	$video_thumbnail_url = false;

	$content_post = get_post( $post_id );
	$content      = $content_post->post_content;
	$content      = apply_filters( 'the_content', $content );
	$content      = str_replace( ']]>', ']]&gt;', $content );

	$content = substr( $content, 0, 500 );

	$do_video_thumbnail = (
		$post_id
		&& $content
		&& ( preg_match( '/\/\/(www\.)?(youtu|youtube)\.(com|be)\/(watch|embed)?\/?(\?v=)?([a-zA-Z0-9\-\_]+)/', $content, $youtube_matches ) || preg_match( '#https?://(.+\.)?vimeo\.com/.*#i', $content, $vimeo_matches ) )
	);

	if ( ! $do_video_thumbnail ) {
		return $video_thumbnail_url;
	}

	$youtube_id = ! empty( $youtube_matches ) ? $youtube_matches[6] : '';

	$vimeo_id = '';
	if ( ! empty( $vimeo_matches ) ) {
		$data     = preg_replace( '/ .*$/m', '', $vimeo_matches[0] );
		$vimeo_id = preg_replace( '/[^0-9]/', '', $data );
	}

	if ( $youtube_id ) {
		switch ($size) {
			case 'small':
				$filename = 'mqdefault.jpg';
				break;
			case 'medium':
				$filename = 'sddefault.jpg';
				break;
			case 'full':
				$filename = 'maxresdefault.jpg';
				break;
			default:
				$filename = 'maxresdefault.jpg';
		}

		$remote_headers      = wp_remote_head( 'http://img.youtube.com/vi/' . $youtube_id . '/' . $filename );
		$is_404              = ( 404 === wp_remote_retrieve_response_code( $remote_headers ) );
		$video_thumbnail_url = ( ! $is_404 ) ? 'http://img.youtube.com/vi/' . $youtube_id . '/' . $filename : 'http://img.youtube.com/vi/' . $youtube_id . '/sddefault.jpg';

	} elseif ( $vimeo_id ) {

		$vimeo_data = wp_remote_get( 'http://www.vimeo.com/api/v2/video/' . intval( $vimeo_id ) . '.php' );
		if ( isset( $vimeo_data['response']['code'] ) && '200' == $vimeo_data['response']['code'] ) {
			$response            = unserialize( $vimeo_data['body'] );
			$video_thumbnail_url = isset( $response[0]['thumbnail_large'] ) ? $response[0]['thumbnail_large'] : false;
		}
	}

	return $video_thumbnail_url;
}
<?php

function anred_oembed_facebook( $result, $url, $args, $post_id ) {
	return preg_replace('/data-width="(\d+)"/', 'data-width="auto"', $result);
}

add_filter('embed_oembed_html', 'anred_oembed_facebook', 11, 4);
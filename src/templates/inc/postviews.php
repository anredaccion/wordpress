<?php

function anred_set_post_views( $postID ) {
	$count = get_post_meta( $postID, 'anred_view_count', true );
	if( $count == '' ) {
		$count = 0;
		delete_post_meta( $postID, 'anred_view_count' );
		add_post_meta( $postID, 'anred_view_count', '0' );
	}else{
		$count++;
		update_post_meta( $postID, 'anred_view_count', $count );
	}
}
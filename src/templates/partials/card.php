<?php
?>
<div id="post-<?php the_ID(); ?>" <?php post_class( array( 'card', 'article-card' ) ); ?>>
<?php if ( has_post_format( 'video' ) ): ?>
	<div class="embed-responsive embed-responsive-anred">
		<iframe class="embed-responsive-item" src="<?php echo anred_get_video_url( get_the_ID() ) ?>"></iframe>
	</div>
<?php else: ?>
	<img class="card-img-top" src="<?php echo get_template_directory_uri(); ?>/images/placemark.png" <?php
	if ( has_post_thumbnail() ) {
		$grid_size = get_query_var('grid_size');
		$post_thumbnail_id = get_post_thumbnail_id();

		echo 'data-srcset="';
		$image_attributes = wp_get_attachment_image_src( $post_thumbnail_id, "frontpage-{$grid_size}x-big" );
		echo $image_attributes[0] . ' ' . $image_attributes[1] . 'w, ';
		$image_attributes = wp_get_attachment_image_src( $post_thumbnail_id, "frontpage-{$grid_size}x-medium" );
		echo $image_attributes[0] . ' ' . $image_attributes[1] . 'w, ';
		$image_attributes = wp_get_attachment_image_src( $post_thumbnail_id, "frontpage-{$grid_size}x-small" );
		echo $image_attributes[0] . ' ' . $image_attributes[1] . 'w';
		echo '"';
	} else {
		echo 'data-src="' . get_template_directory_uri() . '/images/logo-nada.png"';
	}
?> alt="<?php  the_title() ?>" />
<?php endif; ?>
	<div class="card-body">
		<h5 class="card-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
	</div>
	<div class="card-footer text-muted">
		<div class="addthis_toolbox addthis_default_style addthis_16x16_style float-left" addthis:url="<?php the_permalink() ?>" addthis:title="<?php the_title_attribute(); ?>">
			<a class="addthis_button_twitter"></a>
			<a class="addthis_button_facebook"></a>
			<a class="addthis_button_whatsapp"></a>
			<a class="addthis_button_telegram"></a>
			<a class="addthis_button_compact"></a>
		</div>
		<div class="comments-counter float-right ">
			<i class="fa fa-comments" aria-hidden="true"></i> <?php echo get_comments_number(); ?>
		</div>
	</div>
</div>
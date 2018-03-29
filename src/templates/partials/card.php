<?php
$image = get_the_post_thumbnail_url();

if ( ! $image ) { // No hay imagen destacada seleccionada
	$images = get_attached_media( 'image' );
	if ( count( $images ) > 0 ) { // Hay imagenes attached al post
		foreach ( $images as $attachment ) {
			$info = @getimagesize( $attachment->guid );
			if ( !empty( $info ) ) {
				$image = $attachment->guid;
				set_post_thumbnail( get_the_ID(), $attachment->ID );
				break;
			}
			
		}
	} else { // No hay imagenes attached al post
		$document = new DOMDocument();
		@$document->loadHTML( get_the_content() );
		$xml = simplexml_import_dom( $document );
		$images = $xml->xpath('//img');

		if ( count( $images ) > 0 ) {
			foreach ( $images as $item ) {
				$info = @getimagesize( $item->src );
				if ( !empty( $info ) ) {
					$image = esc_url( $item->src );
	
					$wp_filetype = wp_check_filetype( basename($image), null );
			
					$attachment = array(
						'post_mime_type' => $wp_filetype['type'],
						'post_parent'    => get_the_ID(),
						'post_title'     => preg_replace( '/\.[^.]+$/', '', basename($image) ),
						'post_content'   => '',
						'post_status'    => 'inherit'
					);
			
					$attachment_id = wp_insert_attachment( $attachment, $image, get_the_ID() );
					$attachment_data = wp_generate_attachment_metadata( $attachment_id, $image );
					wp_update_attachment_metadata( $attachment_id,  $attachment_data );
					set_post_thumbnail( get_the_ID(), $attachment_id );
				}
			}
		} else { // No hay attachments ni tags img en el contenido
			$image = get_template_directory_uri() . "/images/logo-nada.png";
		}
	}
}
?>
<div id="post-<?php the_ID(); ?>" <?php post_class( array( 'card', 'article-card' ) ); ?>>
<?php if ( has_post_format( 'video' ) ): ?>
	<div class="embed-responsive embed-responsive-anred">
		<iframe class="embed-responsive-item" src="<?php echo anred_get_video_url( get_the_ID() ) ?>"></iframe>
	</div>
<?php else: ?>
	<img class="card-img-top" src="<?php echo $image; ?>" alt="<?php the_title() ?>">
<?php endif; ?>
	<div class="card-body">
		<h5 class="card-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
	</div>
	<div class="card-footer text-muted">
		<div class="addthis_toolbox addthis_default_style float-left" data-url="<?php the_permalink() ?>">
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
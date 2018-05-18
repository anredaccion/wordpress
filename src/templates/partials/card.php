<?php
$image = get_the_post_thumbnail_url();

if ( ! $image ) {
	$image = get_template_directory_uri() . "/images/logo-nada.png";
}
?>
<div id="post-<?php the_ID(); ?>" <?php post_class( array( 'card', 'article-card' ) ); ?>>
<?php if ( has_post_format( 'video' ) ): ?>
	<div class="embed-responsive embed-responsive-anred">
		<iframe class="embed-responsive-item" src="<?php echo anred_get_video_url( get_the_ID() ) ?>"></iframe>
	</div>
<?php else: ?>
	<img class="card-img-top" src="<?php echo get_template_directory_uri(); ?>/images/placemark.png" data-src="<?php echo $image; ?>" alt="<?php the_title() ?>">
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
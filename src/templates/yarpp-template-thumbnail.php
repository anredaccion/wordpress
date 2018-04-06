<?php

if ( !$this->diagnostic_using_thumbnails() )
	$this->set_option( 'manually_using_thumbnails', true );

$options = array( 'thumbnails_heading', 'thumbnails_default', 'no_results' );
extract( $this->parse_args( $args, $options ) );

$thumbnails_default = get_template_directory_uri() . "/images/logo-cuadrado.png";

$dimensions = $this->thumbnail_dimensions();

if (have_posts()) {
	$output .= '<h3>Más noticias</h3>' . "\n";
	$output .= '<div class="yarpp-thumbnails-horizontal">' . "\n";
	while (have_posts()) {
		the_post();

		$output .= "<a class='yarpp-thumbnail' href='" . get_permalink() . "' title='" . the_title_attribute('echo=0') . "'>" . "\n";

		$post_thumbnail_html = '';
		if ( has_post_thumbnail() )
			$post_thumbnail_html = get_the_post_thumbnail( null, 'yarpp-thumbnail');
		
		if ( trim($post_thumbnail_html) != '' )
			$output .= $post_thumbnail_html;
		else
			$output .= '<span class="yarpp-thumbnail-default"><img src="' . esc_url($thumbnails_default) . '"/></span>';

		$output .= '<span class="yarpp-thumbnail-title">' . get_the_title() . '</span>';
		$output .= '</a>' . "\n";

	}
	$output .= "</div>\n";
}

$this->enqueue_thumbnails( $dimensions );

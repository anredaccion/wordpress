<?php
if ( !defined( 'ABSPATH' ) ) exit;

include get_template_directory() . '/inc/customizer.php';
include get_template_directory() . '/inc/clipboard.php';
include get_template_directory() . '/inc/meta.php';
include get_template_directory() . '/inc/gallery.php';
include get_template_directory() . '/inc/video.php';
include get_template_directory() . '/inc/navigation.php';
include get_template_directory() . '/inc/deduplicator.php';
include get_template_directory() . '/inc/utils.php';
include get_template_directory() . '/inc/postviews.php';
include get_template_directory() . '/inc/recaptcha.php';
include get_template_directory() . '/inc/keepalive.php';
include get_template_directory() . '/inc/oembed.php';

function anred_add_theme_scripts() {
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/styles/bootstrap.css' );
	wp_enqueue_style( 'font-awesome', 'https://use.fontawesome.com/releases/v5.0.13/css/all.css' );
	wp_enqueue_style( 'anred', get_stylesheet_uri() );

	wp_deregister_script( 'jquery' );

	wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-3.3.1.slim.min.js', array(), false, true );
	wp_enqueue_script( 'preload', get_template_directory_uri() . '/scripts/preload.js', array(), false, true );
	wp_enqueue_script( 'lazyload', get_template_directory_uri() . '/scripts/lazyload.js', array(), false, true );
	wp_enqueue_script( 'popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js', array(), false, true );
	wp_enqueue_script( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js', array(), false, true );
	wp_enqueue_script( 'anred', get_template_directory_uri() . '/scripts/anred.js', array(), false, true );

	wp_enqueue_script( 'addthis', 'https://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5473d03b29cf0382&async=1&domready=1', array(), false, true );
}

add_action( 'wp_enqueue_scripts', 'anred_add_theme_scripts' );

function anred_theme_setup() {

	register_nav_menus( array(
		'primary_navigation' => 'Menú principal'
	) );

	register_sidebar( array(
		'name'          => __('Página Principal - Contenido', 'anred'),
		'id'            => 'content',
		'before_widget' => '<div class="container-fluid">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="title">',
		'after_title'   => '</h3>'
	) );

	register_sidebar( array(
		'name'          => __('Página Principal - Barra Lateral', 'anred'),
		'id'            => 'sidebar'
	) );

	register_sidebar( array(
		'name'          => __('Artículos - Barra Lateral', 'anred'),
		'id'            => 'article'
	) );

	register_sidebar( array(
		'name'          => __('Archivo - Barra Lateral', 'anred'),
		'id'            => 'archive'
	) );

	register_sidebar( array(
		'name'          => __('Pié de página - Lugar 1', 'anred'),
		'id'            => 'footer-1',
		'before_widget' => '<section class="widget %1$s %2$s">',
		'after_widget'  => '</section>'
	) );

	register_sidebar( array(
		'name'          => __('Pié de página - Lugar 2', 'anred'),
		'id'            => 'footer-2',
		'before_widget' => '<section class="widget %1$s %2$s">',
		'after_widget'  => '</section>'
	) );

	register_sidebar( array(
		'name'          => __('Pié de página - Lugar 3', 'anred'),
		'id'            => 'footer-3',
		'before_widget' => '<section class="widget %1$s %2$s">',
		'after_widget'  => '</section>'
	) );

	register_sidebar( array(
		'name'          => __('Pié de página - Lugar 4', 'anred'),
		'id'            => 'footer-4',
		'before_widget' => '<section class="widget %1$s %2$s">',
		'after_widget'  => '</section>'
	) );


	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form' ) );
	add_theme_support( 'post-formats', array( 'video', 'gallery' ) );

	add_image_size( 'article-big', 825 );
	add_image_size( 'article-medium', 690 );
	add_image_size( 'article-small', 510 );

	add_image_size( 'frontpage-2x-big', 383, 287, array( 'center', 'center') );
	add_image_size( 'frontpage-2x-medium', 315, 237, array( 'center', 'center') );
	add_image_size( 'frontpage-2x-small', 225, 169, array( 'center', 'center') );

	add_image_size( 'frontpage-3x-big', 245, 184, array( 'center', 'center') );
	add_image_size( 'frontpage-3x-medium', 200, 150, array( 'center', 'center') );
	add_image_size( 'frontpage-3x-small', 140, 105, array( 'center', 'center') );

	add_image_size( 'post-thumbnail', 1100, 0, false );

	add_editor_style( get_template_directory_uri() . '/styles/editor-style.css' );
}

add_action( 'after_setup_theme', 'anred_theme_setup' );

function anred_register_widgets() {
	include get_template_directory() . '/widgets/comunicados.php';
	include get_template_directory() . '/widgets/convocatorias.php';
	include get_template_directory() . '/widgets/facebook_video.php';
	include get_template_directory() . '/widgets/facebook.php';
	include get_template_directory() . '/widgets/populares.php';
	include get_template_directory() . '/widgets/social_follow.php';
	include get_template_directory() . '/widgets/twitter.php';
}

add_action( 'widgets_init', 'anred_register_widgets' );

add_filter( 'is_protected_meta', '__return_false' ); 

function anred_custom_image_sizes( $size_names ) {
	$new_sizes = array(
		'article-big'         => 'Artículo - Grande',
		'article-medium'      => 'Artículo - Mediana',
		'article-small'       => 'Artículo - Chica',
		'frontpage-2x-big'    => 'Página principal - 2x - Grande',
		'frontpage-2x-medium' => 'Página principal - 2x - Mediana',
		'frontpage-2x-small'  => 'Página principal - 2x - Chica',
		'frontpage-3x-big'    => 'Página principal - 3x - Grande',
		'frontpage-3x-medium' => 'Página principal - 3x - Mediana',
		'frontpage-3x-small'  => 'Página principal - 3x - Chica',
	);

	return array_merge( $size_names, $new_sizes );
}
add_filter( 'image_size_names_choose', 'anred_custom_image_sizes' );

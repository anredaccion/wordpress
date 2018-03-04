<?php
if ( !defined( 'ABSPATH' ) ) exit;

include get_template_directory() . '/inc/customizer.php';
include get_template_directory() . '/inc/meta.php';

function anred_add_theme_scripts() {
	wp_enqueue_style( 'bootstrap_css', get_template_directory_uri() . '/vendor/bootstrap/bootstrap.css' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/vendor/font-awesome/font-awesome.css' );
	wp_enqueue_style( 'style', get_stylesheet_uri() );

	wp_deregister_script( 'jquery' );

	wp_enqueue_script( 'jquery', get_template_directory_uri() . '/vendor/jquery/jquery.js', array(), false, true );
	wp_enqueue_script( 'popper', get_template_directory_uri() . '/vendor/popper.js/popper.js', array(), false, true );
	wp_enqueue_script( 'bootstrap_js', get_template_directory_uri() . '/vendor/bootstrap/bootstrap.js', array(), false, true );
	wp_enqueue_script( 'scrollbar', get_template_directory_uri() . '/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.js', array(), false, true );
	wp_enqueue_script( 'hammer', get_template_directory_uri() . '/vendor/hammerjs/hammer.js', array(), false, true );
	wp_enqueue_script( 'jquery-hammer', get_template_directory_uri() . '/vendor/jquery-hammerjs/jquery.hammer.js', array(), false, true );
	wp_enqueue_script( 'script', get_template_directory_uri() . '/scripts/anred.js', array(), false, true );

	wp_enqueue_script( 'addthis', '//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5473d03b29cf0382', array(), false, true );
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
		'id'            => 'sidebar',
		'before_widget' => '<div class="container-fluid widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="title">',
		'after_title'   => '</h3>'
	) );

	register_sidebar( array(
		'name'          => __('Categorias - Contenido', 'anred'),
		'id'            => 'categories',
		'before_widget' => '<div class="container categories">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="title">',
		'after_title'   => '</h3>'
	) );

	register_sidebar( array(
		'name'          => __('Etiquetas - Contenido', 'anred'),
		'id'            => 'tags',
		'before_widget' => '<div class="container tags">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="title">',
		'after_title'   => '</h3>'
	) );

	register_sidebar( array(
		'name'          => __('Artículos - Barra Lateral', 'anred'),
		'id'            => 'article',
		'before_widget' => '<div class="container-fluid widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="title">',
		'after_title'   => '</h3>'
	) );

	register_sidebar( array(
		'name'          => __('Archivo - Barra Lateral', 'anred'),
		'id'            => 'archive',
		'before_widget' => '<div class="container-fluid widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="title">',
		'after_title'   => '</h3>'
	) );

	register_sidebar( array(
		'name'          => __('Redes Sociales - Menú', 'anred'),
		'id'            => 'header-social',
		'before_widget' => '<section class="widget %1$s %2$s">',
		'after_widget'  => '</section>'
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

	set_post_thumbnail_size(640, 480, true);
}

add_action( 'after_setup_theme', 'anred_theme_setup' );

/*
** FIXME:
** - Development feature. Corregir antes de sacar a producción.
*/
function anred_register_widgets() {
	$widgets = array_diff(scandir(get_template_directory() . '/widgets'), array('..', '.'));
	foreach ($widgets as $file) {
		if (!$filepath = locate_template('widgets/' . $file))
			trigger_error(sprintf(__('Error localizando el widget %s para su inclusión', 'anred'), $file), E_USER_ERROR);
		
			require_once $filepath;
	}
}

add_action( 'widgets_init', 'anred_register_widgets' );

/*
** TODO:
** - Modificar la función para que se pueda utilizar sin pasar el post id
*/
class Deduplicator {
	private static $published = array();

	public static function add($id) {
		if ( !in_array( $id, self::$published ) )
			array_push( self::$published, $id );
	}

	public static function get() {
		return self::$published;
	}
}

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

function anred_sanitize_checkbox( $input ) {
	return ( ( isset( $input ) && true == $input ) ? true : false );
}

function anred_paging_nav() {
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $GLOBALS['wp_query']->max_num_pages,
		'current'  => $paged,
		'mid_size' => 3,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => 'Anterior',
		'next_text' => 'Siguiente',
		'type'      => 'list',
	) );

	if ( $links ) :

	?>
	<nav class="navigation paging-navigation" role="navigation">
		<?php echo $links; ?>
	</nav>
	<?php
	endif;
}

function anred_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}

	global $page, $paged;

	$title .= " $sep " . get_bloginfo( 'name', 'display' );
 
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= " $sep " . sprintf( __( 'Page %s', '_s' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'anred_title', 10, 2 );
<?php
if ( !defined( 'ABSPATH' ) ) exit;

function anred_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'anred_panel_header',
		array(
			'title'			=> 'Cabecera',
			'description'	=> 'Opciones relacionadas con la cabecera del sitio',
			'priority'		=> 21
		)
	);

	$wp_customize->add_setting(
		'anred_show_hero',
		array(
			'default'			=> false,
			'capability'		=> 'edit_theme_options',
			'sanitize_callback' => 'anred_sanitize_checkbox'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'show_hero',
			array(
				'label'				=> 'Mostrar Carrousel',
				'description'		=> 'Muestra/oculta el carrousel con noticias en la página principal',
				'section'			=> 'anred_panel_header',
				'settings'			=> 'anred_show_hero',
				'type'				=> 'checkbox',
			)
		)
	);

	$wp_customize->add_setting(
		'anred_hero_time',
		array(
			'default'			=> '5000',
			'sanitize_callback' => 'absint'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'hero_time',
			array(
				'label'				=> 'Retardo',
				'description'		=> 'Tiempo en milisegundos que se verá cada imagen en la cabecera',
				'section'			=> 'anred_panel_header',
				'settings'			=> 'anred_hero_time',
				'type'				=> 'number',
				'input_attrs'		=> array( 'min' => '1000' )
			)
		)
	);

	$wp_customize->add_setting(
		'anred_hero_quantity',
		array(
			'default'			=> '5',
			'sanitize_callback' => 'absint'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'hero_quantity',
			array(
				'label'				=> 'Artículos en carrousel',
				'description'		=> 'Cantidad de artículos a mostrar en el carrousel',
				'section'			=> 'anred_panel_header',
				'settings'			=> 'anred_hero_quantity',
				'type'				=> 'number',
				'input_attrs'		=> array( 'min' => '3', 'max' => '10' )
			)
		)
	);
}

add_action( 'customize_register', 'anred_customize_register' );
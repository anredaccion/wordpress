<?php

function anred_validate_recaptcha() {
	if ( isset( $_POST['g-recaptcha-response'] ) == true && get_option( 'anred_recaptcha_secret' ) ) {
		$response = wp_remote_post( 'https://www.google.com/recaptcha/api/siteverify', array(
			'method' => 'POST',
			'body'   => array(
				'secret'   => get_option( 'anred_recaptcha_secret' ),
				'response' => $_POST['g-recaptcha-response']
			)
		) );

		$data = json_decode( $response['body'], true);

		if ( $data['success'] === true ) {
			return;
		}
	}

	wp_die( 'Por favor, complete la casilla de verificación de reCAPTCHA. En caso de no verla o de cualquier otro problema, comunicarse con redaccion@anred.org' );
}

add_action('pre_comment_on_post', 'anred_validate_recaptcha');

function anred_recaptcha_settings_init() {
	register_setting(
		'discussion',
		'anred_recaptcha_secret',
		'anred_recaptcha_settings_sanitize'
	);

	add_settings_section(
		'anred_recaptcha',
		'reCAPTCHA',
		'anred_recaptcha_settings_description',
		'discussion'
	);

	add_settings_field(
		'anred_recaptcha_secret',
		'Secreto',
		'anred_recaptcha_secret_callback',
		'discussion',
		'anred_recaptcha'
	);
}

function anred_recaptcha_settings_sanitize( $input ) {
	return $input;
}

function anred_recaptcha_settings_description(){
    echo "Opciones relacionadas con el funcionamiento de reCAPTCHA para evitar los comentarios automatizados.";
}

function anred_recaptcha_secret_callback(){
    ?>
	<input id="anred_recaptcha_secret" type="text" value="<?php echo get_option( 'anred_recaptcha_secret', '' ) ?>" name="anred_recaptcha_secret" />
    <?php
}

add_action( 'admin_init', 'anred_recaptcha_settings_init' );
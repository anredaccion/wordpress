<?php

class ANRed_Social_Follow extends WP_Widget {
	private $list = array(
		'facebook' => array(
			'name' => 'Facebook',
			'icon' => 'fa-facebook-square',
			'mobile' => 'fb://page/{id}',
			'desktop' => 'https://www.facebook.com/{id}'
		),
		'instagram' => array(
			'name' => 'Instagram',
			'icon' => 'fa-instagram',
			'mobile' => 'instagram://user?username={id}',
			'desktop' => 'https://www.instagram.com/{id}'
		),
		'mastodon' => array(
			'name' => 'Mastodon',
			'icon' => 'fa-mastodon',
			'mobile' => 'https://todon.nl/{id}',
			'desktop' => 'https://todon.nl/{id}'
		),
		'telegram' => array(
			'name' => 'Telegram',
			'icon' => 'fa-telegram',
			'mobile' => 'tg://resolve?domain={id}',
			'desktop' => 'https://web.telegram.org/#/im?tgaddr=tg%3A%2F%2Fresolve%3Fdomain%3D{id}'
		),
		'twitter' => array(
			'name' => 'Twitter',
			'icon' => 'fa-twitter',
			'mobile' => 'https://twitter.com/{id}',
			'desktop' => 'https://twitter.com/{id}'
		),
		'youtube' => array(
			'name' => 'YouTube',
			'icon' => 'fa-youtube-square',
			'mobile' => 'https://www.youtube.com/user/{id}',
			'desktop' => 'https://www.youtube.com/user/{id}'
		),
	);

	function __construct() {
		parent::__construct(
			'anred_social_follow',
			'Redes Sociales - Follow'
		);
	}
	 
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		foreach ($instance as $id => $data) {
			if (wp_is_mobile()) {
				echo '<a href="' . str_replace('{id}', urlencode($data), $this->list[$id]['mobile']) . '" alt="' . $this->list[$id]['name']  . '">';
			} else {
				echo '<a href="' . str_replace('{id}', urlencode($data), $this->list[$id]['desktop']) . '" alt="' . $this->list[$id]['name']  . '" target="_blank" rel="nofollow">';
			}
			echo '<i class="fab ' . $this->list[$id]['icon']  . '"></i>';
			echo '</a>';
		}
		echo $args['after_widget'];
	}
			 
	public function form( $instance ) {
		$defaults = array();
		foreach($this->list as $id => $data)
			$defaults[$id] = '';

		$args = wp_parse_args( (array) $instance, $defaults );

		foreach($this->list as $id => $data) {
?>
	<p>
		<label for="<?php echo $this->get_field_id( $id ); ?>"><?php echo $data['name']; ?></label>
		<input
			class="widefat"
			id="<?php echo $this->get_field_id( $id ); ?>"
			name="<?php echo $this->get_field_name( $id ); ?>"
			type="text"
			value="<?php echo sanitize_text_field( $args[$id] ); ?>"
		>
	</p>
<?php
		}
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		foreach($new_instance as $id => $data) {
			if (! empty($data) )
				$instance[$id] = sanitize_text_field( $data );
		}

		return $instance;
	}
}

register_widget( 'ANRed_Social_Follow' );
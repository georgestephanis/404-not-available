<?php

/**
 * Plugin name: 404 Not Available In Your Country
 */

function four_oh_four_not_available_in_your_country() {
	if ( ! is_404() ) return;

	function four_oh_four_purge_styles() {
		// Remove all theme styles...
		global $wp_styles;
		foreach ( $wp_styles->queue as $handle ) {
			if ( $wp_styles->registered[ $handle ] && ( false !== strpos( $wp_styles->registered[ $handle ]->src, 'themes' ) ) ) {
				wp_dequeue_style( $handle );
			}
		}
	}
	add_action( 'wp_enqueue_scripts', 'four_oh_four_purge_styles', 999 );
	add_filter( 'wp_get_custom_css', '__return_empty_string' );

	?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php esc_html_e( 'This content is not available in your country.', '404-not-available' ); ?> | <?php bloginfo( 'name' ); ?></title>
	<meta name="reference" content="https://xkcd.com/1969/" />
	<?php wp_head(); ?>
	<style>
		html,
		body {
			background: #000;
		}
		h1 {
			color: #fff;
			background: #888;
			background: rgba( 255, 255, 255, 0.5 );
			padding: 1em 2em;
			margin: 1em auto;
			max-width: 10em;
			border-radius: 1em;
			text-transform: uppercase;
			text-align: center;
			font-family: Tahoma, Verdana, Segoe, sans-serif;
			font-size: 35pt;
			cursor: default;
		}
	</style>
</head>
<body>
	<h1><?php esc_html_e( 'This content is not available in your country.', '404-not-available' ); ?></h1>
	<?php wp_footer(); ?>
</body>
</html>
	<?php exit;
}

add_action( 'template_redirect', 'four_oh_four_not_available_in_your_country' );

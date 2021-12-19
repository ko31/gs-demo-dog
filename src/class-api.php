<?php

namespace Gs_Demo_Dog;

/**
 * Class Api
 * @package Gs_Demo_Dog
 */
class Api {

	/**
	 * API endpoint.
	 *
	 * @var string
	 */
	private $endpoint_breed = 'https://dog.ceo/api/breed/';

	/**
	 * Api constructor.
	 */
	public function __construct() {
		add_shortcode( 'gs-dogs', [ $this, 'output' ] );
	}

	public function request( $breed, $count ) {
		$url = sprintf( '%s%s/images/random/%s', $this->endpoint_breed, $breed, $count );

		$response = wp_remote_get( $url );
		if ( is_wp_error( $response ) ) {
			error_log( $response->get_error_message() );

			return null;
		}

		$body = json_decode( $response['body'] );
		if ( $body->status !== 'success' ) {
			return null;
		}

		return $body->message;
	}

	/**
	 * Shortcode callback function to output response from API.
	 *
	 * @param $atts
	 *
	 * @return string
	 */
	public function output( $atts ) {
		$atts = shortcode_atts( [
			'breed' => 'shiba',
			'count' => 1,
		], $atts );

		$data = $this->request( $atts['breed'], $atts['count'] );
		if ( empty( $data ) ) {
			return;
		}

		ob_start();

		foreach ( $data as $image ):
			?>
			<figure class="wp-block-image"><img src="<?php echo esc_url( $image ); ?>"/></figure>
			<figcaption><?php echo esc_html( $image ); ?></figcaption>
		<?php
		endforeach;

		return ob_get_clean();
	}
}

<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class WPSEO_News_Upgrade_Manager {

	/**
	 * Check if there's a plugin update
	 */
	public function check_update() {

		// Get options
		$options = WPSEO_News::get_options();

		// Check if update is required
		if ( 1 === version_compare( WPSEO_News::VERSION, $options['version'] ) ) {

			// Do update
			$this->do_update( $options['version'] );

			// Update version code
			$this->update_current_version_code();

		}

	}

	/**
	 * An update is required, do it
	 *
	 * @param $current_version
	 */
	private function do_update( $current_version ) {

		// Update to version 2.0
		if ( 1 === version_compare( '2.0', $current_version ) ) {

			// Get current options
			$current_options = get_option( 'wpseo_news' );

			// Set new options
			$new_options = array(
					'name'             => ( ( isset( $current_options['newssitemapname'] ) ) ? $current_options['newssitemapname'] : '' ),
					'default_genre'    => ( ( isset( $current_options['newssitemap_default_genre'] ) ) ? $current_options['newssitemap_default_genre'] : '' ),
					'default_keywords' => ( ( isset( $current_options['newssitemap_default_keywords'] ) ) ? $current_options['newssitemap_default_keywords'] : '' ),
			);

			// Save new options
			update_option( 'wpseo_news', $new_options );

		}

	}

	/**
	 * Update the current version code
	 */
	private function update_current_version_code() {
		$options            = WPSEO_News::get_options();
		$options['version'] = WPSEO_News::VERSION;
		update_option( 'wpseo_news', $options );
	}

}
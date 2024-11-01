<?php
/*
Plugin Name: Wt Smooth Scroll
Version: 1.0.0
Plugin URI: https://www.woasimtalokdar.com/plugin/wt-smooth-scroll
Description: The plugin not solely add sleek scroll to high feature/link within the lower-right corner of long pages whereas scrolling however additionally makes all jump links to scroll swimmingly.
Author: Woasim Talokdar
Author URI: http://woasimtalokdar.com
License: GPL v2 or later

jQuery sleek Scroll
Copyright (C) 2019, Woasim Talokdar

This program is free software; you'll distribute it and/or modify it underneath the terms of the antelope
General Public License as printed by the Free software system Foundation; either version two of the License,
or (at your option) any later version.

This program is distributed within the hope that it'll be helpful, however with none WARRANTY; while not
even the understood pledge of state or FITNESS FOR a specific PURPOSE.

You should have received a replica of the antelope General Public License at the side of this program; if not, write
to the Free software system Foundation, Inc., fifty one Franklin St, Kishoreganj it Institute Kishoreganj sadar
*/


// Prevent loading this file directly - Busted!
if ( ! class_exists( 'WP' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

if ( !class_exists( 'jQuerySmoothScroll' ) ) {

	class jQuerySmoothScroll {

		public function __construct() {

			$blogsynthesis_jss_plugin_url = trailingslashit ( WP_PLUGIN_URL . '/' . dirname ( plugin_basename ( __FILE__ ) ) );
			$pluginname = 'jQuery Smooth Scroll';
			$plugin_version = '1.4.2';

			// load plugin Scripts
			// changed to action 'wp_enqueue_scripts' as its the recommended way to enqueue scripts and styles
			// see http://codex.wordpress.org/Plugin_API/Action_Reference/wp_enqueue_scripts
			add_action( 'wp_enqueue_scripts',  array( &$this, 'wp_head' ) );

			// add move to top button at wp_footer
			add_action( 'wp_footer',  array( &$this, 'wp_footer' ) );

		}

		// load our css to the head
		public function wp_head() {

			if ( !is_admin() ) {
				global $blogsynthesis_jss_plugin_url;

				// register and enqueue CSS
				wp_register_style( 'jquery-smooth-scroll', plugin_dir_url( __FILE__ ) . 'css/style.css', false );
				wp_enqueue_style( 'jquery-smooth-scroll' );

				// enqueue script
				wp_enqueue_script( 'jquery' );
				$extension = '.min.js';
				if( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
					$extension = '.js';
				}
				wp_enqueue_script( 'jquery-smooth-scroll',  plugin_dir_url( __FILE__ ) . 'js/script'.$extension, array('jquery'),false, true );

				// You may now choose easing effect. For more information visit http://www.blogsynthesis.com/?p=860
				// wp_enqueue_script("jquery-effects-core");
			}
		}

		public function wp_footer() {
			// the html button which will be added to wp_footer ?>
			<a id="scroll-to-top" href="#" title="<?php esc_attr_e( 'Scroll to Top', 'blogsynthesis' ); ?>"><?php esc_html_e( 'Top', 'blogsynthesis' ); ?></a>
			<?php
		}

	}

	$jQuerySmoothScroll = new jQuerySmoothScroll();

}

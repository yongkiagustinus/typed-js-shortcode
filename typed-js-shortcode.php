<?php
/**
 * Plugin Name: Typed JS Shortcode
 * Plugin URI: https://yongki.id/
 * Description: This plugin add shortcode to create an animated typing effect with Typed JS. No settings needed, just plug and play.  
 * Version: 1.0
 * Author: Yongki Agustinus
 * Author URI: https://yongki.id
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.en.html
 * Domain Path: /languages
 * Text Domain: typed-js-shortcode
 */

/*
 	Copyright (C) 2020 Yongki Agustinus

	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

if ( ! defined( 'ABSPATH' ) ) { die( 'Forbidden' ); }

define( 'TYPEDJSSHORTCODE_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

class TypedJSShortcode {
	function __construct(){
		if( is_admin() ){
			add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
		}
	}

	/**
	 * Load plugin text domain
	 */
	public static function load_textdomain(){
		load_plugin_textdomain( 'typed-js-shortcode', false, basename( TYPEDJSSHORTCODE_PLUGIN_DIR ) . '/languages' );
	}
}

$TypedJSShortcode = new TypedJSShortcode();
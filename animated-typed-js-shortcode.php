<?php
/**
 * Plugin Name: Animated Typed JS Shortcode
 * Plugin URI: https://yongki.id/
 * Description: This plugin add shortcode to create an animated typing effect with Typed JS. No settings needed, just plug and play.  
 * Version: 1.0
 * Author: Yongki Agustinus
 * Author URI: https://yongki.id
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.en.html
 * Domain Path: /languages
 * Text Domain: animated-typed-js-shortcode
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

define( 'ANIMATEDTYPEDJSSHORTCODE_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'ANIMATEDTYPEDJSSHORTCODE_PLUGIN_URI', plugin_dir_url( __FILE__ ) );


class AnimatedTypedJSShortcode {
	function __construct(){
		if( is_admin() ){
			add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
		}

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );

		add_shortcode( 'typedjs', array( $this, 'typedjs_shortcode' ) );
	}

	/**
	 * Load plugin text domain
	 * 
	 * @since 1.0
	 */
	public static function load_textdomain(){
		load_plugin_textdomain( 'typed-js-shortcode', false, basename( ANIMATEDTYPEDJSSHORTCODE_PLUGIN_DIR ) . '/languages' );
	}

	/**
	 * Enqueue scripts
	 * 
	 * @since 1.0
	 */
	public static function enqueue(){
		wp_enqueue_script( 'typedjsshortcode', ANIMATEDTYPEDJSSHORTCODE_PLUGIN_URI . 'js/typed.min.js', array(), '2.0.11', false );
	}

	/**
	 * [typedjs] shortcode
	 * 
	 * @param	array	$atts			Array of attributes
	 * @param	string $content	Content of the shortcode
	 * @since 1.0
	 */
	public static function typedjs_shortcode( $atts, $content = null ){

		if( ! $content )
			return null;

		// Default attributes
		$atts = shortcode_atts( array(
			'typespeed' 		=> 50,
			'backspeed'			=> 50,
			'backdelay'			=> 500,
			'startdelay'		=> 500,
			'loop'				=> 'false',
			'loopcount'			=> 'Infinity',
			'fadeout'			=> 'false',
			'fadeoutdelay'		=> 500,
			'smartbackspace'	=> 'true',
			'shuffle'			=> 'false',
			'cursorchar'		=> '|',
		), $atts, 'typedjs' );

		$instance_id			= 'typedjs' . rand(1,99);
		$strings_exp			= explode( '::', $content );
		foreach( $strings_exp as $string_exp ){
			$strings[] = '"' . $string_exp . '"';
		}
		
		ob_start(); ?>
			<span id="<?php echo $instance_id; ?>"></span>
			<script>
			var <?php echo $instance_id; ?> = new Typed('#<?php echo $instance_id; ?>', {
				strings: [<?php echo implode( ',', $strings ); ?>],
				typeSpeed: <?php echo $atts['typespeed']; ?>,
				backSpeed: <?php echo $atts['backspeed']; ?>,
				backDelay: <?php echo $atts['backdelay']; ?>,
				startDelay: <?php echo $atts['startdelay']; ?>,
				loop: <?php echo $atts['loop']; ?>,
				loopCount: <?php echo $atts['loopcount']; ?>,
				fadeOut: <?php echo $atts['fadeout']; ?>,
				fadeOutDelay: <?php echo $atts['fadeoutdelay']; ?>,
				smartBackspace: <?php echo $atts['smartbackspace']; ?>,
				shuffle: <?php echo $atts['shuffle']; ?>,
				cursorChar: "<?php echo $atts['cursorchar']; ?>"
			});
			</script>

		<?php return ob_get_clean();
	}
}

$AnimatedTypedJSShortcode = new AnimatedTypedJSShortcode();
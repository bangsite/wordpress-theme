<?php

include_once 'theme-constants.php';
include_once 'class-theme-string.php';

class Theme_SVG {
	public static function render( $path, $alt_text = '', $css_class = '' ) {
		$svg_url  = is_int( strpos( $path, THEME_IMG_PATH ) ) ? str_replace( THEME_IMG_PATH, THEME_IMG_URI, $path ) : false;
		$img_path = str_replace( '.svg', '.png', $path );
		$img_url  = ( file_exists( $img_path ) ) ? str_replace( THEME_IMG_PATH, THEME_IMG_URI, $img_path ) : false;
		$basename = basename( $path, '.svg' );

		// grab svg
		$svg = self::parse( $path );

		// add alt text to svg
		$svg = self::add_aria_label( $svg, $alt_text );

		// css classes
		$css_class = 'svg svg--' . Theme_String::camelize( $basename ) . ( $css_class ? ' ' . $css_class : '' );

		// output
		$output = '';
		$output .= '<b class="' . $css_class .'"';
		$output .= ( $svg_url ) ? ' data-svg-url="' . $svg_url . '"' : '';
		$output .= ( $img_url ) ? ' data-img-url="' . $img_url . '"' : '';
		$output .= ' data-icon="' . $basename . '"';
		$output .= '>';
		$output .= $svg;
		$output .= '</b>';

		return $output;
	}

	public static function parse( $path ) {
		if ( ! file_exists( $path ) ) {
			return false;
		}

		$content = file_get_contents( $path );

		// remove <?xml
		$content = preg_replace( '/<?[^>]*\?>/', '', $content );

		// remove comments
		$content = preg_replace( '/<!--[^>]*-->/', '', $content );

		// remove doctype
		$content = preg_replace( '/<!DOCTYPE[^>]*>/', '', $content );

		// add role="img" for accessibility
		$content = str_replace( '<svg ', '<svg role="img" ', $content );

		return $content;
	}

	public static function add_aria_label( $svg, $alt_text = '' ) {
		if ( $alt_text ) {
			$svg = str_replace( '<svg ', sprintf( '<svg aria-label="%s" ', $alt_text ), $svg );
		}

		return $svg;
	}
}

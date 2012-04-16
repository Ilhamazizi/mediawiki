<?php
/**
 * Dynamically create a simple stylesheet for unit tests in MediaWiki.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 * @package MediaWiki
 * @author Timo Tijhof
 * @since 1.20
 */
header( 'Content-Type: text/css; charset=utf-8' );

/**
 * Allows characters in ranges [a-z], [A-Z], [0-9] as well as a dot ("."), dash ("-") and hash ("#").
 * @since 1.20
 *
 * @param $val string
 * @return string: input with illigal characters removed 
 */
function cssfilter( $val ) {
	return preg_replace( '/[^A-Za-z0-9\.\-#]/', '', $val );
}

// Do basic sanitization
$params = array_map( 'cssfilter', $_GET );

// Defaults
$selector = isset( $params['selector'] ) ? $params['selector'] : '.mw-test-example';
$property = isset( $params['prop'] ) ? $params['prop'] : 'float';
$value = isset( $params['val'] ) ? $params['val'] : 'right';

$css =  "
/**
 * Generated: " . gmdate( 'r' ) .  "
 */

$selector {
	$property: $value;
}
";

echo trim( $css ) . "\n";

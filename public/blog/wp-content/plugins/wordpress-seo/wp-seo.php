<?php
/**
 * @package WPSEO\Main
 */

/**
 * Plugin Name: Yoast SEO
 * Version: 7.0.3
 * Plugin URI: https://yoa.st/1uj
 * Description: The first true all-in-one SEO solution for WordPress, including on-page content analysis, XML sitemaps and much more.
 * Author: Team Yoast
 * Author URI: https://yoa.st/1uk
 * Text Domain: wordpress-seo
 * Domain Path: /languages/
 * License: GPL v3
 */

/**
 * Yoast SEO Plugin
 * Copyright (C) 2008-2016, Yoast BV - support@yoast.com
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

if ( ! function_exists( 'add_filter' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

if ( ! defined( 'WPSEO_FILE' ) ) {
	define( 'WPSEO_FILE', __FILE__ );
}

// Load the Yoast SEO plugin.
require_once dirname( WPSEO_FILE ) . '/wp-seo-main.php';

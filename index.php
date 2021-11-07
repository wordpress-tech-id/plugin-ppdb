<?php

/**
 * Plugin Name
 *
 * @package           PPDB
 * @author            Mulyawan Sentosa
 * @copyright         2021 FlazHost.Com
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       PPDB
 * Plugin URI:        https://flazhost.com
 * Description:       Penerimaan Peserta Didik Baru
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      5.6
 * Author:            Mulyawan Sentosa
 * Author URI:        https://flazhost.com
 * Text Domain:       crud
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Update URI:        https://flazhost.com/ppdb
 */

require_once "boot.php";

register_activation_hook( __FILE__ , 'ppdbActivate' );
// register_deactivation_hook( __FILE__ , 'ppdbDeactivate' );
register_uninstall_hook( __FILE__ , 'ppdbUninstall' );

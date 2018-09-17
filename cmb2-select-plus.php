<?php
/**
 *
 * Plugin Name:  CMB2 Select Plus
 * Plugin URI:   https://github.com/manzoorwanijk/cmb2-select-plus
 * Description:  Smart Select field for CMB2 with optgroup and multiple support
 * Author:       Manzoor Wani
 * Author URI:   https://github.com/manzoorwanijk
 * Contributors: Manzoor Wani (@manzoorwanijk)
 *
 * Version:      1.0.0
 *
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 */

spl_autoload_register( 'cmb2_select_plus_autoload_classes' );

function cmb2_select_plus_autoload_classes( $class_name ) {
	
	if ( 0 !== strpos( $class_name, 'Select_Plus_CMB2' ) ) {
		return;
	}

	$path = dirname( __FILE__ ) . '/includes';

	$file = "$path/{$class_name}.php";

	if ( file_exists( $file ) ) {

		include_once( $file );
	}
}
// press the trigger
$cmb2_field_select_plus = new Select_Plus_CMB2_Field();
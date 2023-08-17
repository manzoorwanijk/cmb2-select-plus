<?php

/**
 * Class Select_Plus_CMB2_Field
 */
class Select_Plus_CMB2_Field {

	/**
	 * Class instance.
	 *
	 * @since 1.0.0
	 *
	 * @var self
	 */
	private static $instance = null;

	/**
	 * Return only one instance of this class.
	 *
	 * @since 1.0.0
	 *
	 * @return self
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Initialize the plugin by hooking into CMB2
	 */
	public function __construct() {
		// set the Class name to handle the rendering
		add_filter( 'cmb2_render_class_select_plus', array( $this, 'render_class_select_plus' ) );

		// render the actual field
		add_filter( 'cmb2_render_select_plus', array( $this, 'render_select_plus' ), 10, 5 );

		// sanitize the value(s)
		add_filter( 'cmb2_sanitize_select_plus', array( $this, 'sanitize_select_plus' ), 10, 2 );
	}

	public function render_class_select_plus() {

		return 'Select_Plus_CMB2_Type';
	}

	public function render_select_plus( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {

		$types = new Select_Plus_CMB2_Types( $field );
		$types->render();
	}

	/**
	 * Sanitize the input.
	 *
	 * @param  mixed $input  The input.
	 *
	 * @return mixed
	 */
	public static function sanitize( $input ) {

		if ( ! $input ) {
			return $input;
		}

		if ( is_array( $input ) ) {

			$result = [];

			foreach ( $input as $key => $value ) {

				$result[ sanitize_text_field( $key ) ] = self::sanitize( $value );
			}

			return $result;
		}

		// These are safe types.
		if ( is_bool( $input ) || is_int( $input ) || is_float( $input ) ) {
			return $input;
		}

		if ( ! is_string( $input ) ) {
			return '';
		}

		return sanitize_text_field( $input );
	}

	public function sanitize_select_plus( $check, $meta_value ) {
		return self::sanitize($meta_value);
	}
}

<?php

class DateFieldsAssetsTestCase extends WP_UnitTestCase {

	function setUp() {
		parent::setUp();
		$this->old_wp_scripts = isset( $GLOBALS['wp_scripts'] ) ? $GLOBALS['wp_scripts'] : null;
		$GLOBALS['wp_scripts'] = new WP_Scripts();
		$GLOBALS['wp_scripts']->default_version = get_bloginfo( 'version' );
	}

	function tearDown() {
		$GLOBALS['wp_scripts'] = $this->old_wp_scripts;
		parent::tearDown();
	}

	/** 
	 * Test that all required scripts & styles are correctly loaded.
	 */
	function testDateFieldAssets() {

		$field = new AS_Date_Field( 'foo', 'Title', array() );		
			
		// Register AS-Scripts as this is a dependency.
		wp_register_script( 'as-scripts', trailingslashit( AS_URL ) . 'js/as.js', array( 'jquery' ) );
		
		$field->enqueue_scripts();
		$field->enqueue_styles();
		
		$scripts_output = get_echo( 'wp_print_scripts' );
		$styles_output = get_echo( 'wp_print_styles' );

		// Scripts
		$this->assertContains( '/js/field.datetime.js', $scripts_output );
		$this->assertContains( '/js/as.js', $scripts_output );
		$this->assertContains( site_url() . '/wp-includes/js/jquery/ui/jquery.ui.core.min.js', $scripts_output );
		$this->assertContains( site_url() . '/wp-includes/js/jquery/ui/jquery.ui.datepicker.min.js', $scripts_output );
		
		// Styles
		$this->assertContains( 'css/vendor/jquery-ui/jquery-ui.css', $styles_output );
		
	}

	function testTimeFieldAssets() {

		$field = new AS_Time_Field( 'foo', 'Title', array() );		
			
		// Register AS-Scripts as this is a dependency.
		wp_enqueue_script( 'as-scripts', trailingslashit( AS_URL ) . 'js/as.js', array( 'jquery' ) );
		
		$field->enqueue_scripts();
		
		$scripts_output = get_echo( 'wp_print_scripts' );
		
		// Scripts
		$this->assertContains( AS_URL . '/js/as.js', $scripts_output );
		$this->assertContains( AS_URL . '/js/jquery.timePicker.min.js', $scripts_output );
		$this->assertContains( AS_URL . '/js/field.datetime.js', $scripts_output );
			
	}

	function testDateTimestampFieldAssets() {

		$field = new AS_Date_Timestamp_Field( 'foo', 'Title', array() );		
			
		// Register AS-Scripts as this is a dependency.
		wp_enqueue_script( 'as-scripts', trailingslashit( AS_URL ) . 'js/as.js', array( 'jquery' ) );
		
		$field->enqueue_scripts();
		
		$scripts_output = get_echo( 'wp_print_scripts' );
		
		// Scripts
		$this->assertContains( AS_URL . '/js/as.js', $scripts_output );
		$this->assertContains( AS_URL . '/js/jquery.timePicker.min.js', $scripts_output );
		$this->assertContains( AS_URL . '/js/field.datetime.js', $scripts_output );
			
	}

	function testDatetimeTimestampFieldAssets() {

		$field = new AS_Datetime_Timestamp_Field( 'foo', 'Title', array() );		
			
		// Register AS-Scripts as this is a dependency.
		wp_enqueue_script( 'as-scripts', trailingslashit( AS_URL ) . 'js/as.js', array( 'jquery' ) );
		
		$field->enqueue_scripts();
		
		$scripts_output = get_echo( 'wp_print_scripts' );
		
		// Scripts
		$this->assertContains( AS_URL . '/js/as.js', $scripts_output );
		$this->assertContains( AS_URL . '/js/jquery.timePicker.min.js', $scripts_output );
		$this->assertContains( AS_URL . '/js/field.datetime.js', $scripts_output );
			
	}

}
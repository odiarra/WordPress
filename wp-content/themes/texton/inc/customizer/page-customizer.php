<?php
/**
 * Page Customizer Options
 *
 * @package texton
 */

// Add excerpt section
$wp_customize->add_section( 'texton_page_section', array(
	'title'             => esc_html__( 'Page Setting','texton' ),
	'description'       => esc_html__( 'Page Setting Options', 'texton' ),
	'panel'             => 'texton_theme_options_panel',
) );

// sidebar layout setting and control.
$wp_customize->add_setting( 'texton_theme_options[sidebar_page_layout]', array(
	'sanitize_callback'   => 'texton_sanitize_select',
	'default'             => texton_theme_option('sidebar_page_layout'),
) );

$wp_customize->add_control(  new Texton_Radio_Image_Control ( $wp_customize, 'texton_theme_options[sidebar_page_layout]', array(
	'label'               => esc_html__( 'Sidebar Layout', 'texton' ),
	'section'             => 'texton_page_section',
	'choices'			  => texton_sidebar_position(),
) ) );

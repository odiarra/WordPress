<?php
/**
 * Global Customizer Options
 *
 * @package texton
 */

// Add Global section
$wp_customize->add_section( 'texton_global_section', array(
	'title'             => esc_html__( 'Global Setting','texton' ),
	'description'       => esc_html__( 'Global Setting Options', 'texton' ),
	'panel'             => 'texton_theme_options_panel',
) );

// header sticky setting and control.
$wp_customize->add_setting( 'texton_theme_options[enable_sticky_header]', array(
	'default'           => texton_theme_option( 'enable_sticky_header' ),
	'sanitize_callback' => 'texton_sanitize_switch',
) );

$wp_customize->add_control( new Texton_Switch_Control( $wp_customize, 'texton_theme_options[enable_sticky_header]', array(
	'label'             => esc_html__( 'Make Header Sticky', 'texton' ),
	'section'           => 'texton_global_section',
	'on_off_label' 		=> texton_show_options(),
) ) );

// breadcrumb setting and control.
$wp_customize->add_setting( 'texton_theme_options[enable_breadcrumb]', array(
	'default'           => texton_theme_option( 'enable_breadcrumb' ),
	'sanitize_callback' => 'texton_sanitize_switch',
) );

$wp_customize->add_control( new Texton_Switch_Control( $wp_customize, 'texton_theme_options[enable_breadcrumb]', array(
	'label'             => esc_html__( 'Enable Breadcrumb', 'texton' ),
	'section'           => 'texton_global_section',
	'on_off_label' 		=> texton_show_options(),
) ) );

// site layout setting and control.
$wp_customize->add_setting( 'texton_theme_options[site_layout]', array(
	'sanitize_callback'   => 'texton_sanitize_select',
	'default'             => texton_theme_option('site_layout'),
) );

$wp_customize->add_control(  new Texton_Radio_Image_Control ( $wp_customize, 'texton_theme_options[site_layout]', array(
	'label'               => esc_html__( 'Site Layout', 'texton' ),
	'section'             => 'texton_global_section',
	'choices'			  => texton_site_layout(),
) ) );

// loader setting and control.
$wp_customize->add_setting( 'texton_theme_options[enable_loader]', array(
	'default'           => texton_theme_option( 'enable_loader' ),
	'sanitize_callback' => 'texton_sanitize_switch',
) );

$wp_customize->add_control( new Texton_Switch_Control( $wp_customize, 'texton_theme_options[enable_loader]', array(
	'label'             => esc_html__( 'Enable Loader', 'texton' ),
	'section'           => 'texton_global_section',
	'on_off_label' 		=> texton_show_options(),
) ) );

// loader type control and setting
$wp_customize->add_setting( 'texton_theme_options[loader_type]', array(
	'default'          	=> texton_theme_option('loader_type'),
	'sanitize_callback' => 'texton_sanitize_select',
) );

$wp_customize->add_control( 'texton_theme_options[loader_type]', array(
	'label'             => esc_html__( 'Loader Type', 'texton' ),
	'section'           => 'texton_global_section',
	'type'				=> 'select',
	'choices'			=> texton_get_spinner_list(),
) );

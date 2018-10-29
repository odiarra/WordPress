<?php
/**
 * Single Post Customizer Options
 *
 * @package texton
 */

// Add excerpt section
$wp_customize->add_section( 'texton_single_section', array(
	'title'             => esc_html__( 'Single Post Setting','texton' ),
	'description'       => esc_html__( 'Single Post Setting Options', 'texton' ),
	'panel'             => 'texton_theme_options_panel',
) );

// sidebar layout setting and control.
$wp_customize->add_setting( 'texton_theme_options[sidebar_single_layout]', array(
	'sanitize_callback'   => 'texton_sanitize_select',
	'default'             => texton_theme_option('sidebar_single_layout'),
) );

$wp_customize->add_control(  new Texton_Radio_Image_Control ( $wp_customize, 'texton_theme_options[sidebar_single_layout]', array(
	'label'               => esc_html__( 'Sidebar Layout', 'texton' ),
	'section'             => 'texton_single_section',
	'choices'			  => texton_sidebar_position(),
) ) );

// Archive date meta setting and control.
$wp_customize->add_setting( 'texton_theme_options[show_single_date]', array(
	'default'           => texton_theme_option( 'show_single_date' ),
	'sanitize_callback' => 'texton_sanitize_switch',
) );

$wp_customize->add_control( new Texton_Switch_Control( $wp_customize, 'texton_theme_options[show_single_date]', array(
	'label'             => esc_html__( 'Show Date', 'texton' ),
	'section'           => 'texton_single_section',
	'on_off_label' 		=> texton_show_options(),
) ) );

// Archive category meta setting and control.
$wp_customize->add_setting( 'texton_theme_options[show_single_category]', array(
	'default'           => texton_theme_option( 'show_single_category' ),
	'sanitize_callback' => 'texton_sanitize_switch',
) );

$wp_customize->add_control( new Texton_Switch_Control( $wp_customize, 'texton_theme_options[show_single_category]', array(
	'label'             => esc_html__( 'Show Category', 'texton' ),
	'section'           => 'texton_single_section',
	'on_off_label' 		=> texton_show_options(),
) ) );

// Archive category meta setting and control.
$wp_customize->add_setting( 'texton_theme_options[show_single_tags]', array(
	'default'           => texton_theme_option( 'show_single_tags' ),
	'sanitize_callback' => 'texton_sanitize_switch',
) );

$wp_customize->add_control( new Texton_Switch_Control( $wp_customize, 'texton_theme_options[show_single_tags]', array(
	'label'             => esc_html__( 'Show Tags', 'texton' ),
	'section'           => 'texton_single_section',
	'on_off_label' 		=> texton_show_options(),
) ) );

// Archive author meta setting and control.
$wp_customize->add_setting( 'texton_theme_options[show_single_author]', array(
	'default'           => texton_theme_option( 'show_single_author' ),
	'sanitize_callback' => 'texton_sanitize_switch',
) );

$wp_customize->add_control( new Texton_Switch_Control( $wp_customize, 'texton_theme_options[show_single_author]', array(
	'label'             => esc_html__( 'Show Author', 'texton' ),
	'section'           => 'texton_single_section',
	'on_off_label' 		=> texton_show_options(),
) ) );

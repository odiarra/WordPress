<?php
/**
 * Topbar Customizer Options
 *
 * @package texton
 */

// Add topbar section
$wp_customize->add_section( 'texton_topbar_section', array(
	'title'             => esc_html__( 'Top Bar Section','texton' ),
	'description'       => sprintf( '%1$s <a class="menu_locations" href="#"> %2$s </a> %3$s', esc_html__( 'Note: To show social menu.', 'texton' ), esc_html__( 'Click Here', 'texton' ), esc_html__( 'to create menu.', 'texton' ) ),
	'panel'             => 'texton_theme_options_panel',
) );

// topbar enable setting and control.
$wp_customize->add_setting( 'texton_theme_options[enable_topbar]', array(
	'default'           => texton_theme_option('enable_topbar'),
	'sanitize_callback' => 'texton_sanitize_switch',
) );

$wp_customize->add_control( new Texton_Switch_Control( $wp_customize, 'texton_theme_options[enable_topbar]', array(
	'label'             => esc_html__( 'Enable Topbar', 'texton' ),
	'section'           => 'texton_topbar_section',
	'on_off_label' 		=> texton_show_options(),
) ) );

// topbar phone control and setting
$wp_customize->add_setting( 'texton_theme_options[topbar_phone]', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Texton_Dropdown_Chosen_Control( $wp_customize, 'texton_theme_options[topbar_phone]', array(
	'label'             => esc_html__( 'Phone No', 'texton' ),
	'section'           => 'texton_topbar_section',
	'type'				=> 'text',
) ) );

// topbar email control and setting
$wp_customize->add_setting( 'texton_theme_options[topbar_email]', array(
	'sanitize_callback' => 'sanitize_email',
) );

$wp_customize->add_control( new Texton_Dropdown_Chosen_Control( $wp_customize, 'texton_theme_options[topbar_email]', array(
	'label'             => esc_html__( 'Email ID', 'texton' ),
	'section'           => 'texton_topbar_section',
	'type'				=> 'email',
) ) );

// topbar social menu enable setting and control.
$wp_customize->add_setting( 'texton_theme_options[show_social_menu]', array(
	'default'           => texton_theme_option('show_social_menu'),
	'sanitize_callback' => 'texton_sanitize_switch',
) );

$wp_customize->add_control( new Texton_Switch_Control( $wp_customize, 'texton_theme_options[show_social_menu]', array(
	'label'             => esc_html__( 'Show Social Menu', 'texton' ),
	'section'           => 'texton_topbar_section',
	'on_off_label' 		=> texton_show_options(),
) ) );

// topbar search enable setting and control.
$wp_customize->add_setting( 'texton_theme_options[show_top_search]', array(
	'default'           => texton_theme_option('show_top_search'),
	'sanitize_callback' => 'texton_sanitize_switch',
) );

$wp_customize->add_control( new Texton_Switch_Control( $wp_customize, 'texton_theme_options[show_top_search]', array(
	'label'             => esc_html__( 'Show Search', 'texton' ),
	'section'           => 'texton_topbar_section',
	'on_off_label' 		=> texton_show_options(),
) ) );
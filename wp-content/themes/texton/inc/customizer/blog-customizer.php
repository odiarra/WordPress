<?php
/**
 * Blog / Archive / Search Customizer Options
 *
 * @package texton
 */

// Add blog section
$wp_customize->add_section( 'texton_blog_section', array(
	'title'             => esc_html__( 'Blog/Archive Page Setting','texton' ),
	'description'       => esc_html__( 'Blog/Archive/Search Page Setting Options', 'texton' ),
	'panel'             => 'texton_theme_options_panel',
) );

// latest blog title drop down chooser control and setting
$wp_customize->add_setting( 'texton_theme_options[latest_blog_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'          	=> texton_theme_option( 'latest_blog_title' ),
) );

$wp_customize->add_control( new Texton_Dropdown_Chosen_Control( $wp_customize, 'texton_theme_options[latest_blog_title]', array(
	'label'             => esc_html__( 'Latest Blog Title', 'texton' ),
	'description'       => esc_html__( 'Note: This title is displayed when your homepage displays option is set to latest posts.', 'texton' ),
	'section'           => 'texton_blog_section',
	'type'				=> 'text',
) ) );

// sidebar layout setting and control.
$wp_customize->add_setting( 'texton_theme_options[sidebar_layout]', array(
	'sanitize_callback'   => 'texton_sanitize_select',
	'default'             => texton_theme_option( 'sidebar_layout' ),
) );

$wp_customize->add_control(  new Texton_Radio_Image_Control ( $wp_customize, 'texton_theme_options[sidebar_layout]', array(
	'label'               => esc_html__( 'Sidebar Layout', 'texton' ),
	'section'             => 'texton_blog_section',
	'choices'			  => texton_sidebar_position(),
) ) );

// column control and setting
$wp_customize->add_setting( 'texton_theme_options[column_type]', array(
	'default'          	=> texton_theme_option( 'column_type' ),
	'sanitize_callback' => 'texton_sanitize_select',
) );

$wp_customize->add_control( 'texton_theme_options[column_type]', array(
	'label'             => esc_html__( 'Column Layout', 'texton' ),
	'section'           => 'texton_blog_section',
	'type'				=> 'select',
	'choices'			=> array( 
		'column-1' 		=> esc_html__( 'One Column', 'texton' ),
		'column-2' 		=> esc_html__( 'Two Column', 'texton' ),
	),
) );

// excerpt count control and setting
$wp_customize->add_setting( 'texton_theme_options[excerpt_count]', array(
	'default'          	=> texton_theme_option( 'excerpt_count' ),
	'sanitize_callback' => 'texton_sanitize_number_range',
	'validate_callback' => 'texton_validate_excerpt_count',
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'texton_theme_options[excerpt_count]', array(
	'label'             => esc_html__( 'Excerpt Length', 'texton' ),
	'description'       => esc_html__( 'Note: Min 1 & Max 50.', 'texton' ),
	'section'           => 'texton_blog_section',
	'type'				=> 'number',
	'input_attrs'		=> array(
		'min'	=> 1,
		'max'	=> 50,
		),
) );

// pagination control and setting
$wp_customize->add_setting( 'texton_theme_options[pagination_type]', array(
	'default'          	=> texton_theme_option( 'pagination_type' ),
	'sanitize_callback' => 'texton_sanitize_select',
) );

$wp_customize->add_control( 'texton_theme_options[pagination_type]', array(
	'label'             => esc_html__( 'Pagination Type', 'texton' ),
	'section'           => 'texton_blog_section',
	'type'				=> 'select',
	'choices'			=> array( 
		'default' 		=> esc_html__( 'Default', 'texton' ),
		'numeric' 		=> esc_html__( 'Numeric', 'texton' ),
	),
) );

// Archive date meta setting and control.
$wp_customize->add_setting( 'texton_theme_options[show_date]', array(
	'default'           => texton_theme_option( 'show_date' ),
	'sanitize_callback' => 'texton_sanitize_switch',
) );

$wp_customize->add_control( new Texton_Switch_Control( $wp_customize, 'texton_theme_options[show_date]', array(
	'label'             => esc_html__( 'Show Date', 'texton' ),
	'section'           => 'texton_blog_section',
	'on_off_label' 		=> texton_show_options(),
) ) );

// Archive category meta setting and control.
$wp_customize->add_setting( 'texton_theme_options[show_category]', array(
	'default'           => texton_theme_option( 'show_category' ),
	'sanitize_callback' => 'texton_sanitize_switch',
) );

$wp_customize->add_control( new Texton_Switch_Control( $wp_customize, 'texton_theme_options[show_category]', array(
	'label'             => esc_html__( 'Show Category', 'texton' ),
	'section'           => 'texton_blog_section',
	'on_off_label' 		=> texton_show_options(),
) ) );

// Archive author meta setting and control.
$wp_customize->add_setting( 'texton_theme_options[show_author]', array(
	'default'           => texton_theme_option( 'show_author' ),
	'sanitize_callback' => 'texton_sanitize_switch',
) );

$wp_customize->add_control( new Texton_Switch_Control( $wp_customize, 'texton_theme_options[show_author]', array(
	'label'             => esc_html__( 'Show Author', 'texton' ),
	'section'           => 'texton_blog_section',
	'on_off_label' 		=> texton_show_options(),
) ) );

// Archive comment meta setting and control.
$wp_customize->add_setting( 'texton_theme_options[show_comment]', array(
	'default'           => texton_theme_option( 'show_comment' ),
	'sanitize_callback' => 'texton_sanitize_switch',
) );

$wp_customize->add_control( new Texton_Switch_Control( $wp_customize, 'texton_theme_options[show_comment]', array(
	'label'             => esc_html__( 'Show Comment', 'texton' ),
	'section'           => 'texton_blog_section',
	'on_off_label' 		=> texton_show_options(),
) ) );
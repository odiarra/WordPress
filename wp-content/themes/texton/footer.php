<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package texton
 */

/**
 * texton_site_content_ends_action hook
 *
 * @hooked texton_site_content_ends -  10
 *
 */
do_action( 'texton_site_content_ends_action' );

/**
 * texton_footer_start_action hook
 *
 * @hooked texton_footer_start -  10
 *
 */
do_action( 'texton_footer_start_action' );

/**
 * texton_site_info_action hook
 *
 * @hooked texton_site_info -  10
 *
 */
do_action( 'texton_site_info_action' );

/**
 * texton_footer_ends_action hook
 *
 * @hooked texton_footer_ends -  10
 * @hooked texton_slide_to_top -  20
 *
 */
do_action( 'texton_footer_ends_action' );

/**
 * texton_page_ends_action hook
 *
 * @hooked texton_page_ends -  10
 *
 */
do_action( 'texton_page_ends_action' );

wp_footer();

/**
 * texton_body_html_ends_action hook
 *
 * @hooked texton_body_html_ends -  10
 *
 */
do_action( 'texton_body_html_ends_action' );

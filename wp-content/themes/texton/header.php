<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package texton
 */

/**
 * texton_doctype_action hook
 *
 * @hooked texton_doctype -  10
 *
 */
do_action( 'texton_doctype_action' );

/**
 * texton_head_action hook
 *
 * @hooked texton_head -  10
 *
 */
do_action( 'texton_head_action' );

/**
 * texton_body_start_action hook
 *
 * @hooked texton_body_start -  10
 *
 */
do_action( 'texton_body_start_action' );
 
/**
 * texton_page_start_action hook
 *
 * @hooked texton_page_start -  10
 * @hooked texton_loader -  20
 *
 */
do_action( 'texton_page_start_action' );

/**
 * texton_header_start_action hook
 *
 * @hooked texton_header_start -  10
 *
 */
do_action( 'texton_header_start_action' );

/**
 * texton_site_branding_action hook
 *
 * @hooked texton_site_branding -  10
 *
 */
do_action( 'texton_site_branding_action' );

/**
 * texton_primary_nav_action hook
 *
 * @hooked texton_primary_nav -  10
 *
 */
do_action( 'texton_primary_nav_action' );

/**
 * texton_header_ends_action hook
 *
 * @hooked texton_header_ends -  10
 *
 */
do_action( 'texton_header_ends_action' );

/**
 * texton_site_content_start_action hook
 *
 * @hooked texton_site_content_start -  10
 *
 */
do_action( 'texton_site_content_start_action' );

/**
 * texton_primary_content_action hook
 *
 * @hooked texton_add_slider_section -  10
 *
 */
do_action( 'texton_primary_content_action' );
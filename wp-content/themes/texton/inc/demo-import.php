<?php
/**
 * demo import
 *
 * @package texton_pro
 */

/**
 * Imports predefine demos.
 * @return [type] [description]
 */
function texton_ocdi_import_files() {
    return array(
        array(
            'import_file_name'           => esc_html__( 'Texton Demo', 'texton' ),
            'import_file_url'            => get_template_directory_uri() . '/assets/demo/texton-all-content.xml',
            'import_widget_file_url'     => get_template_directory_uri() . '/assets/demo/texton-widgets.wie',
            'import_customizer_file_url' => get_template_directory_uri() . '/assets/demo/texton-customizer.dat',
            'import_preview_image_url'     => get_template_directory_uri() .'/screenshot.png',
            'import_notice'                => esc_html__( 'Please wait for a few minutes, do not close the window or refresh the page until the data is imported.', 'texton' ),
        ),
    );
}
add_filter( 'pt-ocdi/import_files', 'texton_ocdi_import_files' );

/**
 * 
 * Automatically assign "Front page", "Posts page" and menu locations after the importer is done
 * 
 */
function texton_ocdi_after_import_setup() {
    // Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'Primary', 'nav_menu' );
    $social = get_term_by('name', 'Social', 'nav_menu');

    set_theme_mod( 'nav_menu_locations', array(
            'primary' => $main_menu->term_id,
            'social' => $social->term_id,
        )
    );

    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'Home' );
    $blog_page_id  = get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );

}
add_action( 'pt-ocdi/after_import', 'texton_ocdi_after_import_setup' );

// Disable the ProteusThemes branding notice after successful demo import
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

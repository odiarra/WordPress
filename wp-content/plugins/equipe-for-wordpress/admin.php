<?php
if( !defined('ABSPATH') ) exit;
add_action('admin_menu', 'equipe_admin_menu');

function equipe_admin_menu() {
    add_menu_page(__('Equipe Results', 'equipe'), __('Equipe Results', 'equipe'), 'edit_pages', 'equipe-admin', 'equipe_admin', plugins_url('equipe-for-wordpress/icon.png'));
	add_action( 'admin_action_equipe_settings_page', 'equipe_admin' );
}

function equipe_admin()
{
	if ('POST' == $_SERVER['REQUEST_METHOD']) {
		if(isset($_POST['equipe_fetch_now']))
		{
			// Run fetch once now
			wp_clear_scheduled_hook( 'equipe-fetch-from-api' ); // Clear the schedule
			wp_schedule_event( time(), null, 'equipe-fetch-from-api' ); // Run now
			wp_schedule_event( strtotime('01:00:00'), 'daily', 'equipe-fetch-from-api' ); // Add back in schedule
			
			// Redirect
			wp_redirect( add_query_arg( array('page' => 'equipe-admin', 'message'=> '2'), 'admin.php' ));
			
		} elseif(isset($_POST['equipe_clear_posts']))
		{
			// Remove all Equipe posts
			$query = new WP_Query( array(
				'post_type' => 'post',
				'meta_key' => 'equipe_id',
				'posts_per_page' => -1,
			) );
			while ( $query->have_posts() ) {
				$query->the_post();
				wp_delete_post($query->post->ID);
			}
			wp_reset_postdata();
			
			// Reset last fetch so data can be fetched again
			delete_option('equipe_last_fetch_date');
			
			// Redirect
			wp_redirect( add_query_arg( array('page' => 'equipe-admin', 'message'=> '3'), 'admin.php' ));
			
		} elseif(isset($_POST['equipe_clear_data']))
		{
			global $wpdb;
			
			// Empty all data in Equipe tables
			$wpdb->query("TRUNCATE TABLE {$wpdb->prefix}equipe_results");
			$wpdb->query("TRUNCATE TABLE {$wpdb->prefix}equipe_classes");
			$wpdb->query("TRUNCATE TABLE {$wpdb->prefix}equipe_competitions");
			
			// Reset last fetch so data can be fetched again
			delete_option('equipe_last_fetch_date');
			
			// Redirect
			wp_redirect( add_query_arg( array('page' => 'equipe-admin', 'message'=> '4'), 'admin.php' ));

		} else
		{
			// Save settings
			update_option('equipe_club_id', $_POST['equipe_club_id']);
			update_option('equipe_rider_licences', $_POST['equipe_rider_licences']);
			update_option('equipe_cat_show_jumping', intval($_POST['cat_show_jumping']));
			update_option('equipe_cat_dressage', intval($_POST['cat_dressage']));
			update_option('equipe_cat_eventing', intval($_POST['cat_eventing']));
			update_option('equipe_cat_endurance', intval($_POST['cat_endurance']));
			update_option('equipe_cat_breed_eval', intval($_POST['cat_breed_eval']));
			update_option('equipe_cat_multi', intval($_POST['cat_multi']));
			update_option('equipe_cat_default', intval($_POST['cat_default']));
			
			// Remove notice
			global $current_user;
			add_user_meta($current_user->ID, 'equipe_after_install_ignore_notice', 'true', true);
			
			// Redirect
			wp_redirect( add_query_arg( array('page' => 'equipe-admin', 'message'=> '1'), 'admin.php' ));
		}
	}
	
	/* Get all categories */
	$categories = get_categories();
	
	require_once(ABSPATH . "wp-content/plugins/equipe-for-wordpress/admin_layout.php");
}

// Notices
function equipe_notices_action() {
	if(isset($_GET['message'])) switch($_GET['message'])
	{
		case'1':
			echo'<div class="updated"><p>'.__('Settings has been saved.', 'equipe').'</p></div>';
		break;
		case'2':
			echo'<div class="updated"><p>'.__('A new fetch job has started in the background.', 'equipe').'</p></div>';
		break;
		case'3':
			echo'<div class="updated"><p>'.__('All results post successfully deleted.', 'equipe').'</p></div>';
		break;
		case'4':
			echo'<div class="updated"><p>'.__('All widget data is now cleared.', 'equipe').'</p></div>';
		break;
	}
}
add_action( 'admin_notices', 'equipe_notices_action' );
?>
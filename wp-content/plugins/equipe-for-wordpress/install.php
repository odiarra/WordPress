<?php
if( !defined('ABSPATH') ) exit;

/* Install and default settings */
function equipe_install() 
{
	global $equipe_current_version;
	global $wpdb;
	$table_name = $wpdb->prefix . "equipe";

	if ( equipe_table_exists() )
	{
		$installed_ver = get_option( "equipe_version" );

		if( $installed_ver < 1.4 ) 
		{
			$wpdb->query("ALTER TABLE  `".$table_name."_classes` ADD `date` DATE NOT NULL;");
		}
		
		if( $installed_ver < 2.0 ) 
		{
			$wpdb->query("ALTER TABLE  `".$table_name."_results` ADD `rider_licence` INT(12) NULL;");
			$wpdb->query("ALTER TABLE  `".$table_name."_results` ADD INDEX `rider_licence` (`rider_licence`);");
			$wpdb->query("ALTER TABLE  `".$table_name."_results` ADD `club_id` INT(12) NULL;");
			$wpdb->query("ALTER TABLE  `".$table_name."_results` ADD INDEX `club_id` (`club_id`);");
			
			$club_id = get_option("equipe_club_id");
			$wpdb->query("UPDATE  `".$table_name."_results` SET `club_id` = '".$club_id."';");
		}
		
		update_option( "equipe_version", $equipe_current_version );
		
	} else
	{
		$wpdb->query("
		CREATE TABLE IF NOT EXISTS `".$table_name."_classes` (
		  `id` int(11) NOT NULL,
		  `competition` int(11) NOT NULL,
		  `name` varchar(100) NOT NULL,
		  `date` date NOT NULL,
		  PRIMARY KEY  (`id`)
		) ;
		");
		
		$wpdb->query("
		CREATE TABLE IF NOT EXISTS `".$table_name."_competitions` (
		  `id` int(11) NOT NULL,
		  `name` varchar(100) NOT NULL,
		  `start_date` date NOT NULL,
		  `end_date` date NOT NULL,
		  `discipline` varchar(30) NOT NULL,
		  PRIMARY KEY  (`id`)
		) ;
		");

		$wpdb->query("
		CREATE TABLE IF NOT EXISTS `".$table_name."_results` (
		  `id` int(11) NOT NULL,
		  `class` int(11) NOT NULL,
		  `place` int(5) NOT NULL,
		  `rider` varchar(100) NOT NULL,
		  `rider_licence` int(12) NULL,
		  `horse` varchar(100) NOT NULL,
		  `club_id` int(12) NULL,
		  `result` varchar(30) NOT NULL,
		  PRIMARY KEY  (`id`),
		  KEY  (`rider_licence`),
		  KEY  (`club_id`)
		) ;
		");
		
		if ( ! equipe_table_exists() )
		{
			wp_die( __('Failed to create new tables in the database.', 'equipe'));
			return false; // Failed to create
		}
	}
}

add_action('admin_notices', 'equipe_after_install_notice');
function equipe_after_install_notice() {
	global $current_user;
	if ( ! get_user_meta($current_user->ID, 'equipe_after_install_ignore_notice') ) {
		echo '<div class="updated"><p>'; 
		parse_str($_SERVER['QUERY_STRING'], $params);
		printf(__('You need to <a href="%1$s">configure Equipe for Wordpress</a> for it to work. | <a href="%2$s">Hide Notice</a>', 'equipe'), 'admin.php?page=equipe-admin', '?' . http_build_query(array_merge($params, array('equipe_after_install_ignore'=>'0'))));
		echo "</p></div>";
	}
}

add_action('admin_init', 'equipe_after_install_notice_ignore');
function equipe_after_install_notice_ignore() {
	global $current_user;
	if ( isset($_GET['equipe_after_install_ignore']) && '0' == $_GET['equipe_after_install_ignore'] ) {
		add_user_meta($current_user->ID, 'equipe_after_install_ignore_notice', 'true', true);
	}
}

function equipe_table_exists() 
{
	global $wpdb;
	$table_name = $wpdb->prefix . "equipe_results";
	return strtolower( $wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) ) == strtolower( $table_name );
}
		
?>
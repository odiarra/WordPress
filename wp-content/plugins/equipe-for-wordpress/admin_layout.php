<?php if( !defined('ABSPATH') ) exit; ?>
<div class="wrap">
	<h2><?php _e('Equipe for Wordpress Settings', 'equipe'); ?></h2>

	<p><?php echo sprintf( __( 'Plugin created by <a href="%1$s">Starck Enterprises</a>. Data fetched from our friends at <a href="%2$s">Equipe</a>.', 'equipe' ), esc_url( "http://www.starck.nu/" ), esc_url( "http://online.equipe.com" ) );; ?></p>

	<form method="post" action="<?php echo self_admin_url( 'admin.php' ); ?>" enctype="multipart/form-data">
	<input type="hidden" name="page" value="<?php echo $_REQUEST['page'];?>" />
	<input type="hidden" name="action" value="equipe_settings_page" />

	<h3 class="title"><?php _e('Data sources', 'equipe'); ?></h3>	  
	<table class="form-table">
		<tr>
		 <th scope="row"><?php _e('Equipe Club IDs', 'equipe'); ?></th>
		 <td>
		  <input type="text" name="equipe_club_id" size="30" value="<?php echo get_option('equipe_club_id'); ?>" />
		  <p class="description"><?php _e('You can separate several clubs by comma.', 'equipe'); ?></p>
		 </td>
		</tr>
		
		<tr>
		 <th scope="row"><?php _e('Rider Licences', 'equipe'); ?></th>
		 <td>
		  <input type="text" name="equipe_rider_licences" size="30" value="<?php echo get_option('equipe_rider_licences'); ?>" />
		  <p class="description"><?php _e('You can separate several licences by comma.', 'equipe'); ?></p>
		 </td>
		</tr>
	</table>
	
	<h3 class="title"><?php _e('Publish results posts', 'equipe'); ?></h3>
	<?php _e('When a competition is finished where riders from selected data sources was placed, a post will be created with the results from that competition.', 'equipe'); ?><br />
	<?php _e('Below you can select what category these posts will be posted in. Select None to deactivate a discipline.', 'equipe'); ?>
	<table class="form-table">
		<tr>
		 <th scope="row"><?php _e('Show Jumping', 'equipe'); ?></th>
		 <td>
		  <?php echo wp_dropdown_categories( array(
						'show_option_none' => __('None', 'equipe'),
						'selected' => get_option("equipe_cat_show_jumping"),
						'echo' => false,
						'name' => 'cat_show_jumping',
						'hide_empty' => 0,
					) );
		  ?>
		 </td>
		</tr>	  
		<tr>
		 <th scope="row"><?php _e('Dressage', 'equipe'); ?></th>
		 <td>
		  <?php echo wp_dropdown_categories( array(
						'show_option_none' => __('None', 'equipe'),
						'selected' => get_option("equipe_cat_dressage"),
						'echo' => false,
						'name' => 'cat_dressage',
						'hide_empty' => 0,
					) );
		  ?>
		 </td>
		</tr>
		<tr>
		 <th scope="row"><?php _e('Eventing', 'equipe'); ?></th>
		 <td>
		  <?php echo wp_dropdown_categories( array(
						'show_option_none' => __('None', 'equipe'),
						'selected' => get_option("equipe_cat_eventing"),
						'echo' => false,
						'name' => 'cat_eventing',
						'hide_empty' => 0,
					) );
		  ?>
		 </td>
		</tr>	  
		<tr>
		 <th scope="row"><?php _e('Endurance', 'equipe'); ?></th>
		 <td>
		  <?php echo wp_dropdown_categories( array(
						'show_option_none' => __('None', 'equipe'),
						'selected' => get_option("equipe_cat_endurance"),
						'echo' => false,
						'name' => 'cat_endurance',
						'hide_empty' => 0,
					) );
		  ?>
		 </td>
		</tr>	  
		<tr>
		 <th scope="row"><?php _e('Breeding Evaluation', 'equipe'); ?></th>
		 <td>
		  <?php echo wp_dropdown_categories( array(
						'show_option_none' => __('None', 'equipe'),
						'selected' => get_option("equipe_cat_breed_eval"),
						'echo' => false,
						'name' => 'cat_breed_eval',
						'hide_empty' => 0,
					) );
		  ?>
		 </td>
		</tr>
		<tr>
		 <th scope="row"><?php _e('Multi', 'equipe'); ?></th>
		 <td>
		  <?php echo wp_dropdown_categories( array(
						'show_option_none' => __('None', 'equipe'),
						'selected' => get_option("equipe_cat_multi"),
						'echo' => false,
						'name' => 'cat_multi',
						'hide_empty' => 0,
					) );
		  ?>
		 </td>
		</tr>
		<tr>
		 <th scope="row"><?php _e('Default', 'equipe'); ?></th>
		 <td>
		  <?php echo wp_dropdown_categories( array(
						'show_option_none' => __('None', 'equipe'),
						'selected' => get_option("equipe_cat_default"),
						'echo' => false,
						'name' => 'cat_default',
						'hide_empty' => 0,
					) );
					
		  ?>
		 </td>
		</tr>
	</table>
	
	<input type="submit" name="sub" class="button button-primary" value="<?php _e('Save Settings', 'equipe'); ?>" />
	<p>&nbsp;</p>
	<h3><?php _e('Fetch from Equipe', 'equipe'); ?></h3>
	<?php printf( __('Data is fetched on a daily basis. Last fetch was done %s.', 'equipe'), date_i18n( 'Y-m-d H:i:s', get_option('equipe_last_fetch_date') )); ?>
	<p />
	<input type="submit" name="equipe_fetch_now" class="button" value="<?php _e('Run now', 'equipe'); ?>" />

	<h3><?php _e('Clear data', 'equipe'); ?></h3>
	<p />
	<input type="submit" name="equipe_clear_posts" class="button" value="<?php _e('Remove all results posts', 'equipe'); ?>" onClick="return confirm('<?php _e('Are you sure? This cannot be undone.', 'equipe'); ?>');" />
	<input type="submit" name="equipe_clear_data" class="button" value="<?php _e('Clear all widget data', 'equipe'); ?>" onClick="return confirm('<?php _e('Are you sure? This cannot be undone.', 'equipe'); ?>');" />

	</form>
	
</div>
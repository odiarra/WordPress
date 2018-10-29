<?php
if( !defined('ABSPATH') ) exit;
if( !class_exists('EquipeWidget') ){
class EquipeWidget extends WP_Widget
{
	var $pluginDomain = 'equipe_widget';

	function __construct() {
		$widget_ops = array('classname' => 'EquipeWidget', 'description' => __('Displays results from Equipe.', 'equipe') );
		parent::__construct('EquipeWidget', __('Results from Equipe', 'equipe'), $widget_ops);
	}

	function form($instance)
	{
		$instance = wp_parse_args( (array) $instance, array( 'nr_of_results' => '', 'club_id_filter' => '', 'rider_id_filter' => '' ) );
		$nr_of_results = $instance['nr_of_results'];
		$club_id_filter = $instance['club_id_filter'];
		$rider_id_filter = $instance['rider_id_filter'];
		?>
		<p><label for="<?php echo $this->get_field_id('nr_of_results'); ?>">
		<?php _e('Number of results:', 'equipe'); ?>
		<input class="widefat" id="<?php echo $this->get_field_id('nr_of_results'); ?>" name="<?php echo $this->get_field_name('nr_of_results'); ?>" type="text" value="<?php echo esc_attr($nr_of_results); ?>" /></label></p>
		
		<p><label for="<?php echo $this->get_field_id('club_id_filter'); ?>">
		<?php _e('Club ID filter:', 'equipe'); ?>
		<input class="widefat" id="<?php echo $this->get_field_id('club_id_filter'); ?>" name="<?php echo $this->get_field_name('club_id_filter'); ?>" type="text" value="<?php echo esc_attr($club_id_filter); ?>" /></label></p>
		
		<p><label for="<?php echo $this->get_field_id('rider_id_filter'); ?>">
		<?php _e('Riders licence filter:', 'equipe'); ?>
		<input class="widefat" id="<?php echo $this->get_field_id('rider_id_filter'); ?>" name="<?php echo $this->get_field_name('rider_id_filter'); ?>" type="text" value="<?php echo esc_attr($rider_id_filter); ?>" /></label></p>
  
<?php
	}
 
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['nr_of_results'] = $new_instance['nr_of_results'];
		$instance['club_id_filter'] = $new_instance['club_id_filter'];
		$instance['rider_id_filter'] = $new_instance['rider_id_filter'];
		return $instance;
	}
 
	function widget($args, $instance)
	{
		extract($args, EXTR_SKIP);

		echo $before_widget;
		
		global $wpdb;
		?>
		<h3 class="widget-title"><?php printf( __('Results from %s', 'equipe'), '<a href="http://online.equipe.com/"><img src="'.plugins_url( 'equipe.png' , __FILE__ ).'" alt="Equipe" style="width:62px !important;height:29px !important;vertical-align:bottom !important;margin-left:5px;" /></a>'); ?></h3>
		<ul class="equipe-widget">
		<?php
		/* Get latest results */
		$enough = 0; // When to end the loop
		$i = 0;
		$limit = intval($instance['nr_of_results']);
		
		$equipe = new Equipe;
		$equipe->club_id = $instance['club_id_filter'];
		$equipe->rider_licence = $instance['rider_id_filter'];
		
		$nrOfCompetitions = 0;
		while($enough == 0)
		{
			$competition = $equipe->equipe_get_next_competition($nrOfCompetitions);
			$nrOfCompetitions++;

			/* Get results */
			$equipe->sort_order = 'DESC';
			$classes = $equipe->get_classes($competition->id);
			
			if($classes)
			{
				foreach($classes AS $class)
				{
					if($i <= $limit)
					{
					?>
					<li>
					<a href="http://online.equipe.com/sv/class_sections/<?php echo $class->id; ?>/results"><b>
					<?php echo $competition->name; ?> <?php echo date_i18n("j/n", strtotime($class->date)); ?> - <?php echo $class->name; ?>
					</b></a><br />
					<?php
					$equipe->sort_order = 'ASC';
					$results = $equipe->get_results($class->id);
					foreach($results AS $result)
					{
						$num = $result->place % 100; // protect against large numbers
						if($num < 4 || $num > 20)
						{
							switch($num % 10){
								default:  $place = $result->place.__('th', 'equipe'); break;
								case '1':  $place = $result->place.__('st', 'equipe'); break;
								case '2':  $place = $result->place.__('nd', 'equipe'); break;
								case '3':  $place = $result->place.__('rd', 'equipe'); break;
							}	
						} else
							$place = $result->place.__('th', 'equipe');
							
						echo $place.', '.$result->rider.' - '.$result->horse.', '.$result->result.'<br />';
						$i++;
					}
					?>
					</li>
					<?php
					}
				}
			} else
				$enough = 1;
				
			if($i >= $limit)
				$enough = 1;
		}
		?>
		</ul>
		<?php
		echo $after_widget;
	}
}	
}
?>
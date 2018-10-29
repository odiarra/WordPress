<?php
if( !defined('ABSPATH') ) exit;

if( !class_exists('Equipe') )
{
	class Equipe {

		// Filter criterias
		public $year;
		public $month;
		public $discipline;
		public $sort_order;
		public $club_id;
		public $rider_licence;
		
		public function __construct()
		{
			$this->sort_order = 'ASC';
	    }
		
		public function fetch_from_api()
		{
			global $wpdb;
			$last_fetch_date = get_option('equipe_last_fetch_date');

			// Check when last fetch was done
			if(empty($last_fetch_date))
				$days_ago = 30;
			else
				$days_ago = round((time() - strtotime($last_fetch_date)) / 86400);
			
			// Time to fetch new results
			$starts = array();
			$clubs = explode(",", get_option('equipe_club_id'));
			$riders = explode(",", get_option('equipe_rider_licences'));

			// Fetch club results
			foreach($clubs AS $club_id)
			{
				if(!empty($club_id))
				{
					$content = file_get_contents("http://online.equipe.com/api/v1/clubs/$club_id/starts.json?days_ago=$days_ago");
					$starts[$club_id] = array(
						'club' => true,
						'starts' => json_decode($content),
					);
				}
			}

			// Fetch riders results
			foreach($riders AS $rider_id)
			{
				if(!empty($rider_id))
				{
					$content = file_get_contents("http://online.equipe.com/api/v1/riders/$rider_id/starts.json");
					$starts[$rider_id] = array(
						'rider' => true,
						'starts' => json_decode($content),
					);
				}
			}

			$competitions = array(); 	// Results that will be saved
			$meetings = array(); 		// All meetings
			foreach($starts AS $id => $data)
			{
				if($data['club'])
				{
					$club_id = $id;
					$rider_id = '';
				} else
				{
					$rider_id = $id;
					$club_id = '';
				}
		  
				foreach($data['starts'] AS $r)
				{
					// Check if we got meeting info
					if(!in_array($r->meeting_id, $meetings) && !empty($r->meeting_id))
					{
						$context = stream_context_create(array('http' => array('header'=>'Connection: close'))); 
						$content = file_get_contents("http://online.equipe.com/api/v1/meetings/{$r->meeting_id}/schedule.json");
						$meeting = json_decode($content);

						// List all classes
						$classes = array();
						$start_date = '';
						$stop_date = '';
						foreach($meeting->days AS $d => $date)
						{
							foreach($date->meeting_classes AS $mc => $class)
							{
								// Check start and stop date for the meeting 
								if($date->date < $start_date || empty($start_date))
									$start_date = substr($date->date, 0, 10);
									
								if($date->date > $stop_date || empty($stop_date))
									$stop_date = substr($date->date, 0, 10);
					
								$team_class = false;
								foreach($class->class_sections AS $s => $sections)
								{
									if($sections->team)
										$team_class = true;
										
									// Only save if there is any riders placed
									// Don't save individual results for teams in show jumping
									if($sections->placed > 0 && ($class->discipline != 'show_jumping' || $sections->name != 'Ind' || !$team_class))
									{	
										$classes[$sections->id]['placed'] = $sections->placed;
										$classes[$sections->id]['name'] = $class->name.' '.$sections->name;
										$classes[$sections->id]['date'] = substr($class->start_at, 0, 10);
									}
								}
							}
						}

						$meetings[$meeting->id]['name'] = $meeting->name;
						$meetings[$meeting->id]['discipline'] = $meeting->discipline;
						$meetings[$meeting->id]['start_date'] = $start_date;
						$meetings[$meeting->id]['stop_date'] = $stop_date;
						$meetings[$meeting->id]['classes'] = $classes;
					}

					// Only continue with riders placed
					if($r->rank > 0 && $r->rank <= $meetings[$r->meeting_id]['classes'][$r->class_section_id]['placed'] && $r->class_section_id > 0)
					{
						// Team results
						if(isset($r->type) && $r->type == 'Team')
						{
							$competitions[$r->meeting_id]['id'] = $r->meeting_id;
							$competitions[$r->meeting_id]['name'] = utf8_decode($meetings[$r->meeting_id]['name']); 
							$competitions[$r->meeting_id]['discipline'] = utf8_decode($meetings[$r->meeting_id]['discipline']); 
							$competitions[$r->meeting_id]['start_date'] = utf8_decode($meetings[$r->meeting_id]['start_date']); 
							$competitions[$r->meeting_id]['stop_date'] = utf8_decode($meetings[$r->meeting_id]['stop_date']); 
							$competitions[$r->meeting_id]['classes'][$r->class_section_id]['name'] = utf8_decode($meetings[$r->meeting_id]['classes'][$r->class_section_id]['name']);
							$competitions[$r->meeting_id]['classes'][$r->class_section_id]['date'] = utf8_decode($meetings[$r->meeting_id]['classes'][$r->class_section_id]['date']);
							$competitions[$r->meeting_id]['classes'][$r->class_section_id]['team'] = true;
							$competitions[$r->meeting_id]['classes'][$r->class_section_id]['result'][$r->rank][] = array(
									'id' => $r->id,
									'nr' => $r->rank,
									'name' => 'Lagledare: '.utf8_decode($r->rider_name),
									'horse' => '',
									'licence' => $rider_id,
									'club_id' => $club_id,
									'results' => $r->result_preview
								);
								
							// Add team members
							foreach($r->starts AS $start)
							{
								$competitions[$r->meeting_id]['classes'][$r->class_section_id]['result'][$r->rank][] = array(
									'id' => $start->id,
									'nr' => $start->rank,
									'name' => utf8_decode($start->rider_name),
									'horse' => utf8_decode($start->horse_name),
									'licence' => $rider_id,
									'club_id' => $club_id,
									'results' => $start->result_preview
								);
							}
							
						// Individual	
						} elseif(!empty($r->rider_name))
						{	
							$competitions[$r->meeting_id]['id'] = $r->meeting_id;
							$competitions[$r->meeting_id]['name'] = utf8_decode($meetings[$r->meeting_id]['name']); 
							$competitions[$r->meeting_id]['discipline'] = utf8_decode($meetings[$r->meeting_id]['discipline']); 
							$competitions[$r->meeting_id]['start_date'] = utf8_decode($meetings[$r->meeting_id]['start_date']); 
							$competitions[$r->meeting_id]['stop_date'] = utf8_decode($meetings[$r->meeting_id]['stop_date']); 
							$competitions[$r->meeting_id]['classes'][$r->class_section_id]['name'] = utf8_decode($meetings[$r->meeting_id]['classes'][$r->class_section_id]['name']);
							$competitions[$r->meeting_id]['classes'][$r->class_section_id]['date'] = utf8_decode($meetings[$r->meeting_id]['classes'][$r->class_section_id]['date']);
							$competitions[$r->meeting_id]['classes'][$r->class_section_id]['result'][$r->rank][] = array(
								'id' => $r->id,
								'nr' => $r->rank,
								'name' => utf8_decode($r->rider_name),
								'horse' => utf8_decode($r->horse_name),
								'licence' => $rider_id,
								'club_id' => $club_id,
								'results' => $r->result_preview
							);
							
						}
					}
				}
			}	

			foreach($competitions AS $id => $r)
			{
				$wpdb->query(
					$wpdb->prepare(
						"INSERT INTO {$wpdb->prefix}equipe_competitions
							(
								id,
								name,
								start_date,
								end_date,
								discipline
							)
							VALUES ( %d, %s, %s, %s, %s )
						",
						$r['id'],
						utf8_encode($r['name']),
						$r['start_date'],
						$r['stop_date'],
						$r['discipline']
					)
				);
				
				foreach($r['classes'] AS $id2 => $r2)
				{
					$wpdb->query(
						$wpdb->prepare(
							"INSERT INTO {$wpdb->prefix}equipe_classes
							(
								id,
								competition,
								name,
								date
							)
							VALUES ( %d, %d, %s, %s )",
							$id2,
							$r['id'],
							utf8_encode($r2['name']),
							utf8_encode($r2['date'])
						)
					);
					
					ksort($competitions[$id]['classes'][$id2]['result']);

					foreach($competitions[$id]['classes'][$id2]['result'] AS $nr => $resultat1)
					{
						foreach($resultat1 AS $id3 => $resultat)
						{
							$wpdb->query(
								$wpdb->prepare(
									"INSERT INTO {$wpdb->prefix}equipe_results
									(
										id,
										class,
										place,
										rider,
										rider_licence,
										horse,
										club_id,
										result
									)
									VALUES ( %d, %d, %d, %s, %d, %s, %d, %s )
									",
									utf8_encode($resultat['id']),
									$id2,
									$resultat['nr'],
									utf8_encode($resultat['name']),
									utf8_encode($resultat['licence']),
									utf8_encode($resultat['horse']),
									utf8_encode($resultat['club_id']),
									utf8_encode($resultat['results'])
								)
							);
						}
					}
				}
				
				// Dont save as a post until competition is over 
				if(date('Y-m-d', strtotime($r['stop_date'])) < date('Y-m-d'))
				{
					switch($r['discipline'])
					{
						case'show_jumping':
							$category = get_option('equipe_cat_show_jumping'); break;
						case'dressage':
							$category = get_option('equipe_cat_dressage'); break;
						case'eventing':
							$category = get_option('equipe_cat_eventing'); break;
						case'endurance':
							$category = get_option('equipe_cat_endurance'); break;
						case'breed_eval':
							$category = get_option('equipe_cat_breed_eval'); break;
						case'multi':
							$category = get_option('equipe_cat_multi'); break;	
						default:
							$category = get_option('equipe_cat_default'); break;
					}
					
					if(!empty($category) && $category > 0) // If category <= 0 or empty, no post will be saved.
					{
						// Check if competition already is posted */
						$args = array(
						'posts_per_page' => 1,
						'meta_query' => array(
										array(
										'key' => 'equipe_id',
										'value' => $r['id']
										))
						);
						$existing_post = new WP_Query($args);
						if($existing_post->have_posts())
						{
							/* Already exists, action? */
							
						} else
						{
							// Select all results from the competition 
							$post_content = '';
							
							$equipe = new Equipe;
							
							foreach($equipe->get_classes($r['id']) AS $class)
							{
								$post_content .= "<h3>".$class->name."</h3>";
								$post_content .= "<div><table><tr><td><b>".__('Place', 'equipe')."</b></td><td width=\"200\"><b>".__('Rider', 'equipe')."</b></td><td width=\"200\"><b>".__('Horse', 'equipe')."</b></td><td>&nbsp;</td></tr>";

								foreach($equipe->get_results($class->id) AS $resultat)
								{
									$post_content .= "<tr><td>".$resultat->place."</td><td>".$resultat->rider."</td><td>".$resultat->horse."</td>";
									$post_content .= "<td>".$resultat->result."</td>";
									$post_content .= "</tr>";
								}
								
								$post_content .= "</table></div><p />";
							}
							
							if($r['start_date'] == $r['stop_date'])
								$datum = date_i18n("j F", strtotime($r['start_date']));
							else
							{
								if(date("Ym", strtotime($r['start_date'])) == date("Ym", strtotime($r['stop_date'])))
									$datum = date_i18n("j", strtotime($r['start_date'])).' - '.date_i18n("j F", strtotime($r['stop_date']));
								else
									$datum = date_i18n("j F", strtotime($r['start_date'])).' - '.date_i18n("j F", strtotime($r['stop_date']));
							}
							
							// Create post object
							$my_post = array(
								'post_title' => utf8_encode("{$r['name']} - $datum"),
								'post_date' => date_i18n("Y-m-d H:i:s", strtotime($r['stop_date'])),
								'post_content' => $post_content,
								'post_status' => 'publish',
								'post_author' => 1,
								'post_category' => array($category),
								'comment_status' => 'closed',
							);

							// Insert the post into the database
							$post_id = wp_insert_post( $my_post );
							
							add_post_meta($post_id, 'equipe_id', $r['id']);
							add_post_meta($post_id, 'equipe_start_date', date('Y-m-d', strtotime($r['start_date'])));
							add_post_meta($post_id, 'equipe_end_date', date('Y-m-d', strtotime($r['stop_date'])));
						}
					}
				}

			}
			
			update_option('equipe_last_fetch_date', current_time('timestamp'));
		}
		
		private function get_competition_filters()
		{
			$where = '';
			
			if(!empty($this->discipline))
				$where .= "AND discipline = '".$this->discipline."'";
				
			if(!empty($this->year))
				$where .= "AND YEAR(start_date) = '".$this->year."'";
				
			if(!empty($this->month))
				$where .= "AND MONTH(start_date) = '".$this->month."'";
				
			return $where;
		}
		
		private function get_results_filters()
		{
			global $wpdb;
			$where = '';
			
			if(!empty($this->club_id))
			{
				$where .= " AND ({$wpdb->prefix}equipe_results.club_id IN (".$this->club_id.")";
				if(!empty($this->rider_licence))
					$where .= "OR {$wpdb->prefix}equipe_results.rider_licence IN (".$this->rider_licence.")";
				$where .=")";
			} elseif(!empty($this->rider_licence))
				$where .= " AND {$wpdb->prefix}equipe_results.rider_licence IN (".$this->rider_licence.")";
				
			return $where;
		}
		
		private function get_joins($source = 'competitions')
		{
			global $wpdb;
			$join = '';
			if(!empty($this->club_id) || !empty($this->rider_licence))
			{
				if($source == 'competitions')
					$join .= "JOIN {$wpdb->prefix}equipe_classes ON {$wpdb->prefix}equipe_classes.competition = {$wpdb->prefix}equipe_competitions.id ";
				$join .= "JOIN {$wpdb->prefix}equipe_results ON {$wpdb->prefix}equipe_classes.id = {$wpdb->prefix}equipe_results.class";
			}
			return $join;
		}
		
		public function loadData($data)
		{
			if(isset($data['year']) && preg_match("/(\d\d\d\d)/", $data['year'], $m))
				$this->year = $data['year'];
				
			if(isset($data['month']) && preg_match("/(\d\d)/", $data['month'], $m))
				$this->month = $data['month'];
				
			if(isset($data['year_and_month']) && preg_match("/(\d\d\d\d\d\d)/", $data['year_and_month'], $m))
			{
				$this->year = substr($data['year_and_month'], 0, 4);
				$this->month = substr($data['year_and_month'], 3, 2);
			}
			
			if(isset($data['discipline']) && preg_match("/([a-z_-]*)/", $data['discipline'], $m))
				$this->discipline = $data['discipline'];
		}

		function get_competitions()
		{
			global $wpdb;

			return $wpdb->get_results("
			SELECT {$wpdb->prefix}equipe_classes.id,name
			FROM {$wpdb->prefix}equipe_competitions
			".$this->get_joins()."
			WHERE 1=1
			".$this->get_competition_filters()
			.$this->get_results_filters()
			);
		}

		function get_classes($competition)
		{
			global $wpdb;

			return $wpdb->get_results("
			SELECT {$wpdb->prefix}equipe_classes.id,{$wpdb->prefix}equipe_classes.name,{$wpdb->prefix}equipe_classes.date
			FROM {$wpdb->prefix}equipe_classes
			".$this->get_joins('classes')."
			WHERE competition = '$competition'
			".$this->get_results_filters()."
			GROUP BY {$wpdb->prefix}equipe_classes.id
			ORDER BY date ".$this->sort_order
			);
		}

		function get_results($class)
		{
			global $wpdb;
			
			return $wpdb->get_results("
			SELECT {$wpdb->prefix}equipe_results.id,place,rider,horse,result
			FROM {$wpdb->prefix}equipe_results
			WHERE class = '$class'
			".$this->get_results_filters()."
			ORDER BY place ".$this->sort_order
			);
		}
		
		function get_disciplines()
		{
			global $wpdb;
			
			return $wpdb->get_results("
			SELECT discipline
			FROM {$wpdb->prefix}equipe_competitions
			GROUP BY discipline
			");
		}
		
		function get_years_and_months()
		{
			global $wpdb;
			
			$dates = $wpdb->get_results("
			SELECT UNIX_TIMESTAMP(start_date) AS start_date
			FROM {$wpdb->prefix}equipe_competitions
			GROUP BY YEAR(start_date), MONTH(start_date)
			ORDER BY start_date DESC
			");
			
			$return = array();
			
			foreach($dates AS $date)
			{
				$return[] = array(
					'year' => date('Y', $date->start_date),
					'month' => date('m', $date->start_date)
				);
			}
			
			return $return;
		}
		
		public function equipe_get_next_competition($page)
		{
			global $wpdb;

			$result = $wpdb->get_row("
			SELECT {$wpdb->prefix}equipe_competitions.id AS id,{$wpdb->prefix}equipe_competitions.name AS name,start_date,end_date,discipline
			FROM {$wpdb->prefix}equipe_competitions
			".$this->get_joins()."
			WHERE 1=1
			".$this->get_results_filters()."
			GROUP BY {$wpdb->prefix}equipe_competitions.id
			ORDER BY end_date DESC
			LIMIT $page,1
			");

			return $result;
		}

	}
}
?>
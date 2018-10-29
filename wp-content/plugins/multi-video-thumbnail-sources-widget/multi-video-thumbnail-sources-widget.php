<?php

/*

Plugin Name: Lys Creation Multi-Video Thumbnails Widgets

Plugin URI: http://www.lyscreation.net/

Description: Adds a sidebar widget to display (random) videos of your own choice. You can mix different Media videos sources: Google, Myspace, Vimeo, DailyMotion and YouTube videos. Make your own videolist in the widget-control-panel. 

Syntax: [myspace, google, youtube, vimeo, dailymotion]@[ID]@[titre]@[categorie (dailymotion)*]<Line Brake>. * Is optional. Do not add a <Line Brake> after the last video in the list.

Author: Mohammed BELAADEL

Version: 0.1.2

License: GPL

Author URI: http://www.lyscreation.net

Copyright: Released under GNU GENERAL PUBLIC LICENSE
*/

if ( ! defined( 'WP_MULTI_VIDEO_PLUGIN_BASENAME' ) )
	define( 'WP_MULTI_VIDEO_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

if ( ! defined( 'WP_MULTI_VIDEO_PLUGIN_NAME' ) )
	define( 'WP_MULTI_VIDEO_PLUGIN_NAME', trim( dirname( WP_MULTI_VIDEO_PLUGIN_BASENAME ), '/' ) );

if ( ! defined( 'WP_MULTI_VIDEO_PLUGIN_DIR' ) )
	define( 'WP_MULTI_VIDEO_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . WP_MULTI_VIDEO_PLUGIN_NAME );

define( 'widget_max_nbre', '8' );
define( 'produit', 'multi-video-sources' );


function widget_google_adsense_set_plugin_meta($links, $file){
  $plugin = WP_MULTI_VIDEO_PLUGIN_BASENAME;  
  if ($file == $plugin) 
  {
	$lien = 'http://www.lyscreation.net/donate?plugin='.produit;

	$links[] = '<a href="http://wordpress.org/extend/plugins/multi-video-thumbnails-sources-widget/" title="WordPress Site" target="_blank">' . 'Download plugin' . '</a>';    
	$links[] = '<a href="'.$lien.'" title="Donate / Don" target="_blank">' . '"Donate / Don" - PayPal' . '</a>';
  }
  return $links;
}
if( is_admin() )
{
  add_filter( 'plugin_row_meta', 'widget_multi_videos_set_plugin_meta', 10, 2 );
}


function widget_videos_init_thumbs() {            



	if ( !function_exists('register_sidebar_widget') || !function_exists('register_widget_control') )



		return;



	function widget_videos_control_thumbs($number) {

		$options = $newoptions = get_option('widget_videos_thumbs');

		if ( $_POST["videos-submit-$number"] ) {

			$newoptions[$number]['title'] = strip_tags(stripslashes($_POST["videos-title-$number"]));

			$newoptions[$number]['width'] = strip_tags(stripslashes($_POST["videos-width-$number"]));

			$newoptions[$number]['height'] = strip_tags(stripslashes($_POST["videos-height-$number"]));

			$newoptions[$number]['format'] = strip_tags(stripslashes($_POST["videos-format-$number"]));

			$newoptions[$number]['content'] = strip_tags(stripslashes($_POST["videos-content-$number"]));

			$newoptions[$number]['show'] = $_POST["videos-show-$number"];

			$newoptions[$number]['slug'] = strip_tags(stripslashes($_POST["videos-slug-$number"]));

			$newoptions['googlesimpleplayer'] = $_POST["videos-simplePlayer"];

		}

		if ($options[$number]['content']=='') {

			$newoptions[$number]['content'] = '';

		}

		if ( $options != $newoptions ) {

			$options = $newoptions;

			update_option('widget_videos_thumbs', $options);

		}

		$allSelected = $homeSelected = $postSelected = $pageSelected = $categorySelected = false;

		switch ($options[$number]['show']) {

			case "all":

			$allSelected = true;

			break;

			case "":

			$allSelected = true;

			break;

			case "home":

			$homeSelected = true;

			break;

			case "post":

			$postSelected = true;

			break;

			case "page":

			$pageSelected = true;

			break;

			case "category":

			$categorySelected = true;

			break;

		}    

		$formatws = ($options[$number]['format']=="ws");

		$GoogleSimplePlayer =  ($options['googlesimpleplayer']=="GoogleSimplePlayer");

	?>



		<label for="videos-title-<?php echo "$number"; ?>" title="Title above the widget" style="line-height:35px;display:block;">Title: <input type="text" style="width: 442px;" id="videos-title-<?php echo "$number"; ?>" name="videos-title-<?php echo "$number"; ?>" value="<?php echo htmlspecialchars($options[$number]['title']); ?>" /></label>



		<label for="videos-width-<?php echo "$number"; ?>" title="Specify Width (optional if Height is specified)" style="line-height:35px;">Width: <input type="integer" style="width: 80px;" id="videos-width-<?php echo "$number"; ?>" name="videos-width-<?php echo "$number"; ?>" value="<?php echo htmlspecialchars($options[$number]['width']); ?>" /></label>



		<label for="videos-height-<?php echo "$number"; ?>" title="Specify Height (optional if Width is specified)" style="line-height:35px;">Height: <input type="integer" style="width: 80px;" id="videos-height-<?php echo "$number"; ?>" name="videos-height-<?php echo "$number"; ?>" value="<?php echo htmlspecialchars($options[$number]['height']); ?>" /></label></br>



		<label for="videos-format-<?php echo "$number"; ?>"  title="Indicate whether you mainly have videos in 16:9 or 4:3. Not crucial but helps calculate width/height." style="line-height:35px;">Format: <input type="radio" name="videos-format-<?php echo "$number"; ?>" value="ns" <?php if ($formatws==false){echo "checked";} ?>> 4:3 <input type="radio" name="videos-format-<?php echo "$number"; ?>" value="ws" <?php if ($formatws==true){echo "checked";} ?>> 16:9 </label>



		<label for="videos-content-<?php echo "$number"; ?>" title="Insert your list of videos from MySpace, Google or YouTube separated by Line Brake. The options marked with * are optional. IMPORTANT: No Line Break after the last video!" style="width: 495px; height: 280px;display:block;">Videos [myspace, google, youtube, vimeo, dailymotion]@[ID]@[titre]@[categorie (dailymotion)*]<textarea style="width: 470px; height: 240px;" id="videos-content-<?php echo "$number"; ?>" name="videos-content-<?php echo "$number"; ?>"><?php echo htmlspecialchars($options[$number]['content']); ?></textarea></label>



		<label for="videos-show-<?php echo "$number"; ?>"  title="Show only on specified page(s)/post(s)/category. Default is All" style="line-height:35px;">Display only on: <select name="videos-show-<?php echo"$number"; ?>" id="videos-show-<?php echo"$number"; ?>"><option label="All" value="all" <?php if ($allSelected){echo "selected";} ?>>All</option><option label="Home" value="home" <?php if ($homeSelected){echo "selected";} ?>>Home</option><option label="Post" value="post" <?php if ($postSelected){echo "selected";} ?>>Post(s)</option><option label="Page" value="page" <?php if ($pageSelected){echo "selected";} ?>>Page(s)</option><option label="Category" value="category" <?php if ($categorySelected){echo "selected";} ?>>Category</option></select></label> 



		<label for="videos-slug-<?php echo "$number"; ?>"  title="Optional limitation to specific page, post or category. Use ID, slug or title." style="line-height:35px;">Slug/Title/ID: <input type="text" style="width: 150px;" id="videos-slug-<?php echo "$number"; ?>" name="videos-slug-<?php echo "$number"; ?>" value="<?php echo htmlspecialchars($options[$number]['slug']); ?>" /></label>



		<label for="videos-simplePlayer"  title="Use Google's Simple Player, very useful in tight sidebars (below 200px)" style="line-height:25px;display:block;">Use Google Simple Player: <input type="checkbox" name="videos-simplePlayer" value="GoogleSimplePlayer" <?php if ($GoogleSimplePlayer==true){echo "checked";} ?>></label>



		<label for="videos-help" title="You can get more help and instructionc on www.LysCreation.net!" style="line-height:25px;display:block;"><a href="http://www.LysCreation.net/LysCreation-video-widget/">Help</a></label>



		<input type="hidden" name="videos-submit-<?php echo "$number"; ?>" id="videos-submit-<?php echo "$number"; ?>" value="1" />

	<?php

	}

	

	function getVimeoInfo($id, $info = 'thumbnail_small') {

		if (!function_exists('curl_init')) die('CURL is not installed!');

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, "http://vimeo.com/api/v2/video/$id.php");

		curl_setopt($ch, CURLOPT_HEADER, 0);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($ch, CURLOPT_TIMEOUT, 10);

		$output = unserialize(curl_exec($ch));

		$output = $output[0][$info];

		curl_close($ch);

		return $output;

	}



	function widget_videos_thumbs($args, $number = 1) {

		$dvwVersion = "Multi-Video Thumbnails Widgets v. 0.1.2";

		extract($args);

		$options = get_option('widget_videos_thumbs');

		$title = $options[$number]['title'];

		$GoogleSimplePlayer =  ($options['googlesimpleplayer']=="GoogleSimplePlayer");

		if ($options[$number]['content']!='') {

			$videos = $options[$number]['content'];

		}

		else {

			$videos = '';

		}

		$videos = explode("\n", $videos);										// First we make an array of the videolist

		$i	= 0;

		$starting = '<div class="ngg-galleryoverview" id="ngg-gallery-1-317">

                <link rel="stylesheet" type="text/css" href="<?php echo get_option('home')?>/wp-content/plugins/<?php echo WP_MULTI_VIDEO_PLUGIN_NAME; ?>/shadowbox/shadowbox.css">

                <script type="text/javascript" src="<?php echo get_option('home')?>/wp-content/plugins/<?php echo WP_MULTI_VIDEO_PLUGIN_NAME; ?>/shadowbox/shadowbox.js"></script>

                <script type="text/javascript">

                Shadowbox.init({

                    handleOversize: "drag",

                    modal: true

                });

                </script>

'; 

		$ending = '

 	<div class="ngg-clear" style="text-align:right"><br><a href="'.get_option("home").'/videos">All videos</a></div>

</div>

'; 

		for($j=0; $j<sizeof($videos); $j++){

			/*

			$video = wptexturize( $videos[ mt_rand(0, count($videos) - 1 ) ] );     // Select a random video and make sure it contains regular text

			*/

			$video = wptexturize( $videos[$j] );     								// Select a random video and make sure it contains regular text

			$pieces = explode("@", $video);                                         // Split the selected video into the various options

			$show = $options[$number]['show'];                                      // Get the setting on where to show the widget

			$slug = $options[$number]['slug'];                                      // Optional Slug/Title/PageID on where to show it

			$width = $options[$number]['width'];                                    // User specified with of player

			$height = $options[$number]['height'];                                  // User specified height of player

			$videoformat = $options[$number]['format'];                             // 16:9 or 4:3 format of videos

			$objecttype = 'application/x-shockwave-flash';                          // Set the object type for inclusion in the object finally displayed

			$player = $pieces[0];

			$mediaID = $pieces[1];                                                  // place the mediaID in a variable

			if ($mediaID{0}=="*") {                                                 // If ID is preceeded by a * then the videoformat is 16:9

				$videoformat="ws"; 

				$mediaID=substr($mediaID, 1);

				$pieces[1]=substr($pieces[1],1);

			}

			$simplePlayer = ''; 

			if ($GoogleSimplePlayer==true) {

				$simplePlayer =  '&amp;playerMode=simple';

			}

	/* Identify where the video is from by checking the ID property */

	/* First we check if the ID is 18+ characters long. Typically Google Video operates with 18 digits IDs with the occasional - in front of it. */

			$player = strtolower($player);

			if ($player=='google' and strlen($mediaID)>=18) {

				$murl = 'http://video.google.com/googleplayer.swf?docId=';          // Write the base url for Google's videoplayer

				$medialoc = 'http://video.google.com/videoplay?docid=';             // Write the url for the movie on Google Video

				$mediavalue = implode('',array($murl,$pieces[1],$simplePlayer));                  // Set value for object and parameters compliant with Google Video object

				$leadingtext = 'Watch on Google Video';                             // Set standard leading text

				$objectid ='id="VideoPlayback-'.$number.'" ';                       // Set object ID

				$parameters = '<param name="movie" value="'.$mediavalue.'" /><param name="allowScriptAccess" value="sameDomain" /><param name="quality" value="best" /><param name="scale" value="noScale" /><param name="salign" value="TL" />';	

				$thumbnail = 'http://1.gvt0.com/vi/'.str_replace("-","",$pieces[1]).'/default.jpg';

				$videoURL  = 'http://video.google.com/googleplayer.swf?docid='.$pieces[1].'&fs=true';

			}						

			elseif ($player=='myspace' and is_numeric($mediaID)) {                                         

				// If the mediaID is less than 18 characters but still an Integer then it is most likely a MySpace Video.

				$murl = 'http://lads.myspace.com/videos/vplayer.swf';

				$medialoc = 'http://vids.myspace.com/index.cfm?fuseaction=vids.individual&n=2&videoid=';

				$mediavalue = $murl;

				$objectid = '';

				$leadingtext = 'Watch on MySpace';

				$parameters = '<param name="allowScriptAccess" value="always" /><param name="quality" value="high" /><<param name="Align" value="" /><param name="flashvars" value="m='.$mediaID.'&type=video" />';

				$thumbnail = 'http://d2.ac-videos.myspacecdn.com/videos02/204/thumb1_'.$pieces[1].'.jpg';

				$videoURL  = 'http://mediaservices.myspace.com/services/media/embed.aspx/m='.$pieces[1].',t=1,mt=video';

			}

			elseif ($player=='youtube' and (strlen($mediaID)>8 and strlen($mediaID)<=12) ) {            	

				// If the mediaID is less than 18 characters and non-Integer it is most likely a YouTube Video.

				$murl = 'http://www.youtube.com/v/';

				$medialoc = 'http://www.youtube.com/watch?v=';

				$mediavalue = implode('',array($murl,$pieces[1]));

				$objectid = '';

				$leadingtext = 'Watch on YouTube';

				$parameters = '<param name="movie" value="'.$mediavalue.'" />';

				$thumbnail = 'http://i3.ytimg.com/vi/'.$pieces[1].'/default.jpg'; 

				// http://img.youtube.com/vi/{gallery_youtube}/0.jpg

				$videoURL = $murl.$pieces[1].'?fs=1&hl=fr_FR&autoplay=1';

			}

	/* Make a test for individual WS-switch to calculate the width and height according to the videoformat. It uses 16:9 or 4:3 formats.*/

			elseif ($player=='dailymotion' and strlen($mediaID)<=7) {                 

				/* If the mediaID is less than 18 characters and non-Integer it is most likely a YouTube Video.*/

				$murl = 'http://www.dailymotion.com/swf/video/';

				$medialoc = 'http://www.dailymotion.com/video/';

				$mediavalue = implode('',array($murl,$pieces[1],$pieces[2]));

				$mediavaleur = implode('_',$mediavalue);

				$mediadescription = str_replace(" ","-",$pieces[2]);

				$mediadescription = strtolower($mediadescription.'_'.$pieces[3]);

				$objectid = '';

				$leadingtext = 'Watch on DailyMotion';

				$parameters = '<param name="movie" value="'.$mediavalue.'" />';

				$thumbnail = 'http://www.dailymotion.com/thumbnail/video/'.$pieces[1].'_'.$mediadescription; 

				/* http://img.youtube.com/vi/{gallery_youtube}/0.jpg*/

				$videoURL = $murl.$pieces[1].'_'.$mediadescription.'?theme=none&autoplay=1';

			}

	/* Make a test for individual WS-switch to calculate the width and height according to the videoformat. It uses 16:9 or 4:3 formats.*/

			elseif ($player=='yahoo' and is_numeric($mediaID)) {                 

				/* If the mediaID is less than 18 characters and non-Integer it is most likely a YouTube Video.*/

				$murl = 'http://new.music.yahoo.com/';

				$medialoc = 'http://new.music.yahoo.com/';

				$mediavalue = implode('',array($murl,$pieces[1],$pieces[2]));

				$mediavaleur = implode('_',$mediavalue);

				$mediadescription = str_replace(" ","-",$pieces[2]);

				$mediadescription = strtolower($mediadescription);

				$objectid = '';

				$leadingtext = 'Watch on Yahoo';

				$parameters = '<param name="movie" value="'.$mediavalue.'" />';

				$thumbnail = 'http://d.yimg.com/ec/image/v1/video/'.$pieces[1].';encoding=jpg;size=130x78;locale=us;'; 

				/* http://img.youtube.com/vi/{gallery_youtube}/0.jpg*/

				$videoURL = 'http://d.yimg.com/m/up/fop/embedflv/swf/fop.swf?id=v'.$pieces[1].'&amp;eID=1301797&amp;lang=us&amp;enableFullScreen=0&amp;shareEnable=1';

			}

	/* Make a test for individual WS-switch to calculate the width and height according to the videoformat. It uses 16:9 or 4:3 formats.*/

			elseif ($player=='vimeo' and strlen($mediaID)<=8) {                 

				/* If the mediaID is less than 18 characters and non-Integer it is most likely a YouTube Video.*/

				$murl = 'http://player.vimeo.com/video/';

				$medialoc = 'http://vimeo.com/';

				$mediavalue = implode('',array($murl,$pieces[1]));

				$thumbnail = getVimeoInfo($pieces[1], 'thumbnail_small'); 

				$videoURL = $murl.$pieces[1].'?autoplay=1';

			}

	/* Make a test for individual WS-switch to calculate the width and height according to the videoformat. It uses 16:9 or 4:3 formats.*/

			if ($videoformat=='ws'){$GVfactor = 9/16;$MSfactor = 0.60348837;$YTfactor = 0.61764706;}

			else {$GVfactor = 3/4;$MSfactor = 0.80465116;$YTfactor = 0.82352941;}

			$Googlepix = 27; 

			if ($GoogleSimplePlayer==true) {

				$Googlepix = 0; 

			}

			if ($height=='') {

				if ($width==''){$width = 100;}

				switch ($murl) {

					case "http://video.google.com/googleplayer.swf?docId=":

						$height = round(($width*$GVfactor)+$Googlepix);

						break;

					case "http://lads.myspace.com/videos/vplayer.swf":

						$height = round($width*$MSfactor);

						break;						

					case "http://www.youtube.com/v/":

						$height = round($width*$YTfactor);

						break;						

					}

				}

			if ($width=='') {

				if ($height==''){$height = 75;}

				switch ($murl) {

					case "http://video.google.com/googleplayer.swf?docId=":

						$width = round(($height-$Googlepix)/$GVfactor);

						break;

					case "http://lads.myspace.com/videos/vplayer.swf":

						$width = round($height/$MSfactor);

						break;						

					case "http://www.youtube.com/v/":

						$width = round($height/$YTfactor);

						break;						

					}

				}                         

	/* Check the optional parameters and change the link and leading text accordingly */

			/*

			if ($pieces[3]==''){$mediaURL = $medialoc.$mediaID;}

			else {$mediaURL=$pieces[3]; $leadingtext = $pieces[2];}

			*/

			$leadingtext = $pieces[2];

			if ($pieces[2]==''){$videotitlelink='';}

			else {$videotitlelink='<a href="'.$mediaURL.'" title="'.$leadingtext.'">'.$pieces[2].'</a>'.'<br>Source: '.$pieces[0];}

	/* Print trailling credits. Not crucial for anything but support in marketing and credits to development efforts. */

	/*

			$credits = '<br /><small><a href="http://www.LysCreation.net" title="'.$dvwVersion.'">Video Widget by LysCreation</a></small>'; 

	*/		

	/* Compose the actual media object to play the video. */

			/*

			$embeddedvideo = '<object '.$objectid.'type="'.$objecttype.'" data="'.$mediavalue.'" width="'.$width.'" height="'.$height.'">'.$parameters.'</object>'; 

			*/

			$embeddedvideo .= '

		<div id="ngg-image-'.$i++.'" class="ngg-gallery-thumbnail-box" >

			<div class="ngg-gallery-thumbnail">

				<!--<small><a href="'.$videoURL.'" title="'.$leadingtext.'" rel="shadowbox;width=778;height=432;external nofollow">'.$leadingtext.'</a></small>-->

				<a href="'.$videoURL.'" title="'.$leadingtext.'" class="shutterset_set_1" rel="shadowbox;width=778;height=432;external nofollow">

					<img title="'.$leadingtext.'" alt="'.$leadingtext.'" src="'.$thumbnail.'" width="'.$width.'" height="'.$height.'" />

				</a>

				<small style="font-size:11px;"><a href="'.$videoURL.'" title="'.$leadingtext.'" rel="shadowbox;width=778;height=432;external nofollow">'.$leadingtext.'</a></small>

			</div>

		</div>

	';

		}

/* Put it all together */

		$fulltext = $starting.$embeddedvideo.$ending;

/* And do the widget dance! */

		?>

		<?php echo $before_widget; ?>

		<?php 

             echo "<div class='Lys_Creation_Videos'>"; 

/* Do the conditional tag checks. */

   		switch ($show) {

				case "all": 

					$title ? print($before_title . $title . $after_title) : null;

                	echo $fulltext;

					break;

				case "home":

				if (is_home()) {

					$title ? print($before_title . $title . $after_title) : null;

                	echo $fulltext;

		  		}

          		else {

            		echo "<!-- Multi-Video Thumbnails Widgets is disabled for this page/post! -->";

          		}

				break;

				case "post":

				if (is_single($slug)) {

					$title ? print($before_title . $title . $after_title) : null;

                	echo $fulltext;

		  		}

          		else {

            		echo "<!-- Multi-Video Thumbnails Widgets is disabled for this page/post! -->";

          		}

				break;

				case "page":

				if (is_page($slug)) {

					$title ? print($before_title . $title . $after_title) : null;

                	echo $fulltext;

		  		}

          		else {

            		echo "<!-- Multi-Video Thumbnails Widgets is disabled for this page/post! -->";

          		}

				break;

				case "category":

				if (is_category($slug)) {

					$title ? print($before_title . $title . $after_title) : null;

                	echo $fulltext;

		  		}

          		else {

            		echo "<!-- Multi-Video Thumbnails Widgets is disabled for this page/post! -->";

          		}

				break;				

			}

              echo "</div>"; ?>

			<?php echo $after_widget; ?>

			<?php

	}

	function widget_videos_thumbs_setup() {

		$options = $newoptions = get_option('widget_videos_thumbs');

		if ( isset($_POST['number-videos-submit']) ) {

			$number = (int) $_POST['videos-number'];

			if ( $number > widget_max_nbre ) $number = widget_max_nbre;

			if ( $number < 1 ) $number = 1;

			$newoptions['number'] = $number;

		}

		if ( $options != $newoptions ) {

			$options = $newoptions;

			update_option('widget_videos_thumbs', $options);

			widget_videos_thumbs_register($options['number']);

		}

	}

	function widget_videos_thumbs_page() {

		$options = $newoptions = get_option('widget_videos_thumbs');

	?>

		<div class="wrap">

			<form method="POST">

				<h2><?php _e("Multi-Video Thumbnails Widgetss", "widgets"); ?></h2>

				<p style="line-height: 30px;"><?php _e('How many video widgets would you like?', 'widgets'); ?>

				<select id="videos-number" name="videos-number" value="<?php echo $options['number']; ?>">

	<?php for ( $i = 1; $i < widget_max_nbre+1; ++$i ) echo "<option value='$i' ".($options['number']==$i ? "selected='selected'" : '').">$i</option>"; ?>

				</select>

				<span class="submit"><input type="submit" name="number-videos-submit" id="number-videos-submit" value="<?php _e('Save'); ?>" /></span></p>

			</form>

		</div>

	<?php

	}

	function widget_videos_thumbs_register() {

		$options = get_option('widget_videos_thumbs');

		$number = $options['number'];

		if ( $number < 1 ) $number = 1;

		if ( $number > widget_max_nbre ) $number = widget_max_nbre;

		for ($i = 1; $i <= widget_max_nbre; $i++) {

			$name = array('Multi-Video Thumbnails Widgets %s', 'widgets', $i);

			register_sidebar_widget($name, $i <= $number ? 'widget_videos_thumbs' : /* unregister */ '', $i);

			register_widget_control($name, $i <= $number ? 'widget_videos_control_thumbs' : /* unregister */ '', 490, 455, $i);

		}

		add_action('sidebar_admin_setup', 'widget_videos_thumbs_setup');

		add_action('sidebar_admin_page', 'widget_videos_thumbs_page');

	}

	add_action('init', 'widget_videos_thumbs_register', 6);

}

add_action('plugins_loaded', 'widget_videos_init_thumbs'); 

?>
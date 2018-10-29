=== Plugin Name ===
Contributors: frofrik
Donate link:
Tags: equipe
Requires at least: 3.2.1
Tested up to: 4.7.3
Stable tag: 2.1

Fetching results from Equipe Online, publishing as posts and widgets.

== Description ==

This plugin will fetch equestrian results from Equipe Online and post them to your Wordpress site.

The results will be displayed as posts in Wordpress.
It will also add a widget to your site that you can use to display the latest results.


== Installation ==

1. Upload folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to Equipe Results in the admin menu.
4. Configure club and/or riders licences to fetch results from.
5. Select what categories the results will be posted in.

== Frequently Asked Questions ==

= Where do I find our club ID? =

For Swedish clubs, log in to an organizer acount in TDB, then click on the name of your club -> Klubbprofil.
The club name is then followed by a one to four digit number, this is the club ID.

For foreign clubs, please use this link to find your ID: http://ridsport.starck.nu/equipe-for-wordpress.php

= When is the results fetched? =

The script will run once a day (if someone visits the site).
Results from today will then show up tomorrow on the site.

When it's a meeting, the results will show up as a post first the day after the meeting is finished.
It will though show upp in the widget after each day.


== Changelog ==

= 2.1 =
* Replacing deprecated functions.

= 2.0 - BRAND NEW PLUGIN! =
* New easy configuration page in the main admin menu. 
* Fetch results from individual riders by their licence number.
* Using WP-Cron now so the job will run in the background.
* Possible to run a data fetch manually.
* Support for translations. Supported languages: English and Swedish. 
* Remake and clean up of the code. 

= 1.4 =
* Updated queries, bug with results not dislayed is now corrected.

= 1.3 =
* Better handling of team results. Don't fetch individual results from team classes in show jumping. 

= 1.2.2 =
* Small dislay updates.

= 1.2.1 =
* Removed WPDB Prepare function since it isn't used.

= 1.2 =
* Changed path to Equipe API due to updates on their side.

= 1.1 =
* Fixed minor path bug.

= 1.0 =
* Total remake of the code since Equipe has changed the API.

= 0.3 =
* Makeover of the fetch so that all results from a competition will be posted and not only results from the last day.
* Also updated the widget so it will display the latest classes, from latest competitions.

= 0.2.1 =
* Bugfix of failing upgrade procedure in 0.2.

= 0.2 =
* Added dates and links to the widget.
* Corrected a bug regarding i18n of dates.

= 0.1 =
* First version of the plugin.
<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'wrPM5r*sL4.wvr~r;} -2_fs7s]7Eb cbw,ILx-^u`0r 4B:y3fqu/vyU?x!~tu4');
define('SECURE_AUTH_KEY',  '9.;*?LgDn8fR0&se%=?_~y+sJ]pP2@@oHWO9/AKVO:v4FfcpN^)%?UzdqD>32zw2');
define('LOGGED_IN_KEY',    '*QG4::-!qA((&faIW0#ox^Ofn*`_5rgsB3=+C)yKKmJ7u$x`TJv405KX$O~BWpX/');
define('NONCE_KEY',        'yke^c1$-=%S:eq!eL1`l/b[,.@mXH2=N,vEMf)EArsWqJlD)~l`kjTSg~0PRPr =');
define('AUTH_SALT',        'F/O<R.co44uE;0qm>!B#CNG^giG,b9qdUdzDyC=?.)l;u0vK!mbVUcZdbaz/~7q=');
define('SECURE_AUTH_SALT', 'vZ KwVm,{Vh%[iGgx 4ewg{MX!W7:dcUmh 4Scz@w@9uVqr#V=JNN (y47j)klT$');
define('LOGGED_IN_SALT',   'n_&1J<~o<%,|Qx#~QRf2Um#N*E)%)^NZ*.Hv)wS<u3M,u=f6~)y(Qt5F6]},`IFg');
define('NONCE_SALT',       'K-L9!9 ?ep`$f&L?T= 4|[rm7J-GGy<#<wdkSu4+Re@2M,WVKBNW`^/:2G dr!x5');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

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
define('DB_NAME', '382TVNSummerSolstice468');

/** MySQL database username */
define('DB_USER', 'phpMyAdmin');

/** MySQL database password */
define('DB_PASSWORD', 'phpMyAdmin');

/** MySQL hostname */
define('DB_HOST', 'phpmyadmin.cw637ad2cjeo.us-west-1.rds.amazonaws.com');

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
define('AUTH_KEY',         '@M:$d#2[Nic[cC!-w60(lyfl_+Dx,Z#s0*f*;%DU^k?)Y[2.y~]x,`xP=gCV.p>u');
define('SECURE_AUTH_KEY',  'N2~4z<b25g&Qhb]/Q%N>oP?&<X:gG(O[E;&gp[#h2yzu#pLE)oJq24wGQA{_9O7.');
define('LOGGED_IN_KEY',    'cK(]b6;K-oPbG((T|B3wQ:kDN>g#wuz8V1*t43t [/Awj(Q&4U^e=UW%!EWAW_@<');
define('NONCE_KEY',        'YgBM`!VxG9`BKi O#>=~x&9[iO_{nP~4uko?|O}1(|n;)fnr]%R~]fH2;429(yHQ');
define('AUTH_SALT',        'd*r5Ge.S}-|jIjw.ft/K5U^55MZ8OS6ELVdH}<6tNZ4@oB8sZ%QNO-gSr@Ne1q3N');
define('SECURE_AUTH_SALT', 'VQVjYvMi4(*}jZENW{hxT>U$ib1w>eZqD9Q~/hEVkn0n(#XIIre^rNvkF!g^$0~M');
define('LOGGED_IN_SALT',   '-@YdWkc/1j:YFEgET:1%k<P1iSeEgjl16CNKj9/*d0deS04[;U{<;7M%[^8qK4A}');
define('NONCE_SALT',       '6yVk%nsk;a1Euo(}Y/b?uQTaNGx2HE14gt+D!067W0HeW.xasGThKTo?|<4{aZI#');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = '468LoveWealthAbundance382_';

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

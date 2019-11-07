<?php
define('WP_CACHE', false); // Added by WP Rocket
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
define( 'DB_NAME', 'kitatech_citinine' );

/** MySQL database username */
define( 'DB_USER', 'kitatech_citininewp' );

/** MySQL database password */
define( 'DB_PASSWORD', '*Qu35tionM4rk?!ctne' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '&7C1^BHL7b=4LeB. dW9a{<Kb<{z!k[`iZ[=3Ryi!G LUJ1(iw,hi@b}QCS=$ cF' );
define( 'SECURE_AUTH_KEY',  '1#LZ!dDEvq]logLwA3{-zR9O/L1qso++))dE`?`!!lbIGi&!P8w 9)!j:&1l} ,x' );
define( 'LOGGED_IN_KEY',    'kkI^+|JHwI. zzdM[OTC}j{LpR|T5kr?/+)!n%_am$zRl?8:PcpR0S.QQe5O.C@6' );
define( 'NONCE_KEY',        'o<EyM,%_4hXFyYNQn_6jSp,]maqx?7>[(B ^:li)TsjZl+hWo[?ufd{IxInqWUaA' );
define( 'AUTH_SALT',        'x^6sJ.4~|j<f|:(PDQ:s<s%]R9]V%@pw+>S2$/8Qf{L+V+>-#YS`Cl6cs,DAhIWv' );
define( 'SECURE_AUTH_SALT', 'd@[9,?xAmH]1?v&tvLM$F;O`FN>u9$-]DF.p =M05[[[IZ>yx9Qoe3LD`D6+&e*4' );
define( 'LOGGED_IN_SALT',   '_OqKlY)#h/LP$v$y<ZO1z~-<No)u*NMo*j$x>S>!zCj|X.-efc&xXdn+vM>r$9gF' );
define( 'NONCE_SALT',       'soU_YmRi9w3L>v#E2Y59Oq62Xo1j#&3}#hg`V4VRfn27UQ0MxdUA9na~tku,iseb' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'ctn_';

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );

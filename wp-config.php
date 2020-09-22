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
define( 'DB_NAME', 'travel-blog' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '^N^%&~e$VV&,T*i|(?E[I%^VWaoh:ZU{mBE#uP%[2{pUh|6X{kn;JM716[CXe4v/' );
define( 'SECURE_AUTH_KEY',  'UDfa?9U!Jo2nbd%&t6NXISql#gNX-LoKgiN$#wT[?$Jg9)E?0)QcnUihpO6k(lp|' );
define( 'LOGGED_IN_KEY',    '51GaE[9A XBsB2G@i_Cb ,&ZiO~|I`OXRBr.,OyKuN>GL{@v$VHG#0yT C&Z4,BA' );
define( 'NONCE_KEY',        '9#<F>IdpG@o&dlR#6~7]:w.CbgZ.eNY(_f*kFpccI<SSWihv$zspDfys*gs!*qb2' );
define( 'AUTH_SALT',        '86*W_M7Z0{jwZf,.R%)n2QSOu!BEB5HZ-UMvr _?TGf>/Sp6pxd1u>|wjHbXJZiW' );
define( 'SECURE_AUTH_SALT', ' MqC|R4/qO7Z*G;ybw$&`tiZ@d@]u<@U3[V @Garp|U^$;K#z{vfH x##37wDnaj' );
define( 'LOGGED_IN_SALT',   '87g!#>_&y<@!~UI|#}>LCk8WL:aS!ho}PNTwKlMo66vB]#SGo}0#i1>zUKfl<RX|' );
define( 'NONCE_SALT',       ')<ECg4B^:X8-,n?E[YK[P~`aP<jzLotvUnN=VZoDPf95s<WQ8ReDqx(hP)PcYto ' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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

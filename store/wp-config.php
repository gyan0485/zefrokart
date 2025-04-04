<?php
define( 'WP_CACHE', true );
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u931770207_RwLCC' );

/** Database username */
define( 'DB_USER', 'u931770207_QqPyt' );

/** Database password */
define( 'DB_PASSWORD', 'oejW78zLAb' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          '[k8YHv(:;7:<R>f8j!iJE!Qk~kiEIRG^{7:iZjXtYg,66xb%0[gBq4-*yz0Ho[s|' );
define( 'SECURE_AUTH_KEY',   '8,h/lqWaGpt`Rc*y :sWAN_L@#!ln/mZsr|fm0)+YG-&Lp0c^)6(k(>TzbxW8]VY' );
define( 'LOGGED_IN_KEY',     '!N<vv/@GE`vI#AZBieo?6XQ$cO]E9^?]2~0Lq;,X:wC!|tJOB^Zo8KIswB8PaB,I' );
define( 'NONCE_KEY',         'P~KEC>3T{%h9}IGZdD>g0^veVO3aXvbJM/N/A&0;LNs}`M#+6WQerN1 0_3#yfvn' );
define( 'AUTH_SALT',         ':c&D!C >xa]U1E:&-2lC]+(pY`6{rcrHGbO* I-&hlGq`d_/<~#_etCW)( GS;|Z' );
define( 'SECURE_AUTH_SALT',  '1DS3VQ6Nwn%y2~cH*Og;2oL [T{poZPp4;0rrp+u6. Z7RUQ6^jNIlZ5a+T>HFdH' );
define( 'LOGGED_IN_SALT',    'Nk-IHV+qH0syDf[^p@&uD?Ovkl!4w+< Jr-]g!0r5b%n,GfB}g-V?[Y!NC~m@~$W' );
define( 'NONCE_SALT',        'i7$UfZH5qVc+B9=(?u>[f9RzVWa[k) ,BBth2WTF9q.tM.wCBPsmX~dw(z(A22EA' );
define( 'WP_CACHE_KEY_SALT', '>YjA%JtIFC$j4_<N?1]<FxQa1lpWv[Spv!>hL9=]g9XOF2/{vbrn8C}<4PO3}H>E' );


/**#@-*/

/**
 * WordPress database table prefix.
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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );


/* Add any custom values between this line and the "stop editing" line. */



define( 'FS_METHOD', 'direct' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

<?php
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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'txge?a0No.{JRIV/ioFmWO(z?xYM=L62]T3a68~r*4!&#nLP_*|NG/prmLZjg-U<' );
define( 'SECURE_AUTH_KEY',  ':{)4p+mQ=eU&:B*M,)i|(9o]8%T95G-{Ik}B%oYho]R;dn1JY,N,`=<=f,Q?MOyG' );
define( 'LOGGED_IN_KEY',    'D;^QzOA^s_mpQL8c^Ymj77,CL)nOr7!U Z;$mINm5Tpqf0naBL;z9iGgs9f{T2oj' );
define( 'NONCE_KEY',        '5NRM7=Vhfzn6!XbE9r!.uc3JGPQMNFk$W.*::{!* P+;XRT/S)!jk9ly6h~!?n!p' );
define( 'AUTH_SALT',        'QiwV:@vgD})v?F8UF+cxW6B}aN-/OPUB4n.!%D%ZVYccGGB+X9Uo,(qK[[(,wve6' );
define( 'SECURE_AUTH_SALT', '!|A^Z(mG._t^]GGRR!@~&l[[+-0XS{KNQBzkoV[CP0)As%A4Zs&[Zn0/z.;Cdf.g' );
define( 'LOGGED_IN_SALT',   'Y>##U?a)cDMP*MC:dtc&FJS?gP4jib0zxu,JY-YMAd`}#`GeWjhWjlfG46ZRgNkN' );
define( 'NONCE_SALT',       'T^^^:s.j_y`b/Y.QMA E0sLF*]TSD+-``-#*cAXqTl9AI<W>*x`;$RtHf2n7b3Zu' );

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



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

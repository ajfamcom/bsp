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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'bspresearch' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         'vl]Z$7}l]n]i|DYJ?o<>]CnxS0kix@}Qtb( oHp?,*5,mji^/EL7rn4-BQ|=VX8j' );
define( 'SECURE_AUTH_KEY',  'Oj:)-j>eqQrI*1U`{}* ~_C0U@iq*[lajm}];%HvR%w{._@]h;C*B}~$h/m-%qVG' );
define( 'LOGGED_IN_KEY',    '{btZM[cYZ:Ti)Fw&WT&s> >*f7qpPIT:04|}2{}b7(41K=`GConJfHPGGRx(eYD,' );
define( 'NONCE_KEY',        'ZS{(O/+_Y5qOC_Xf*U #BG(h{0~DsnG.//@J@~bjpUf}IoFA=%GId;J=P)wclm/(' );
define( 'AUTH_SALT',        '@),<KpXr7]9vDK%gG1Wja2w 5w|:2^hpg9d;=M0kG2})N#B`6(>t@L~_%MO0Gsdp' );
define( 'SECURE_AUTH_SALT', 'AS7u/-/atHX*+iG%dBnnL Lo!wQOK*k1[j7mSIWL{2U`t->he|lC_0/L_ncl$.tf' );
define( 'LOGGED_IN_SALT',   'S%{pVT8,.5=IS3~{=p8Og0p_BJ-y)llK|/H}XVPxiPcd7y;nO/L0q@|Tqd]~lYwe' );
define( 'NONCE_SALT',       'Cx^( oG5$qO&46O3A)NFL_i8t{_kmzzB*(lXLxVgB`}@5 WD);JyHa3gAh6L<:Yl' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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

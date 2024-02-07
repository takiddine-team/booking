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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'takiddine-booking' );

/** Database username */
define( 'DB_USER', 'takiddine-booking' );

/** Database password */
define( 'DB_PASSWORD', 'akn7NjjMU5SjIzLAwJUs' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1:3306' );

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
define( 'AUTH_KEY',          'XotfrXQ9~;A(Tx9aM3c]3X-_]V0)<^T-.,zp)%M^A:PMR39:.+uG$Cn%I*!}fM)i' );
define( 'SECURE_AUTH_KEY',   'pU>1u4~pD]@q3y-vOJl_{i5LF:dj2h--e*P6bhN~tw7HO%#S+)71Ir|l=qQ[~n0}' );
define( 'LOGGED_IN_KEY',     'THcqK8{f{GVK$mFP+f>{?eYr5L.-l`OXqX!vvMbZJ4lm.q!9;(o/Q+c#&>Ck_t}O' );
define( 'NONCE_KEY',         'JL/(Z1o/1;mmt^zHL3ZKYr(Y<cY%mH9oc, )Znr k@kY^OF27I1c{:z}{,prQdBx' );
define( 'AUTH_SALT',         'faiu7m&}DlQHLL0vLIv@eXk&_yun3: @_HpX*RjfjV?EP3Z9Q|[L-P%~EDZxOMER' );
define( 'SECURE_AUTH_SALT',  'Syk16G4rD/BRggc%QJ(>8v8f3*-Dw`WkAA%*P|%:&N`<fJg7_r{;tctp9Wf;)bMi' );
define( 'LOGGED_IN_SALT',    '.Ask=e m#v!2MCP=7nO-zq,&p=+DJ.|&~6~PW:1_oPn!}y&XiyF,RCIB;.~f]*]o' );
define( 'NONCE_SALT',        'fWY}8I6Q;-lSyU2fa<9T`RS.DBmKt318@]@<!pkX2hv!lTvXlk|dZ6?P<.q9ev s' );
define( 'WP_CACHE_KEY_SALT', 't/b]+t$,;pw 8HyuuXjY>u<fp%d!n90zjU(+P.2oQLl0MG3;u*k?1Vy,n18+_4A]' );


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
define( 'WP_DEBUG_DISPLAY', false );
define( 'WP_MEMORY_LIMIT', '256M' );
define( 'WP_MAX_MEMORY_LIMIT', '512M' );
define( 'WP_DEBUG_LOG', true );
define( 'CONCATENATE_SCRIPTS', false );
define( 'AUTOSAVE_INTERVAL', 600 );
define( 'WP_POST_REVISIONS', 5 );
define( 'EMPTY_TRASH_DAYS', 21 );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

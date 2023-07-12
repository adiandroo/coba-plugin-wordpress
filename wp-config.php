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
define( 'DB_NAME', 'test' );

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

if ( !defined('WP_CLI') ) {
    define( 'WP_SITEURL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
    define( 'WP_HOME',    $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
}



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
define( 'AUTH_KEY',         'EKD9TSdLiqo6ffJ8fxTo689ewyXe80FAkDbNChY6Dz7huRK0xAGwtODotnfbQRvJ' );
define( 'SECURE_AUTH_KEY',  '0WprF7LBEh9l4yBk7IH7I303IrzzsDtuABP7OFLd47ffqI68CebE2g9op3FtXn8F' );
define( 'LOGGED_IN_KEY',    'ZH1h5KB1SmC7FgzpvmU3hBORptMJhQf0bmcAHkuOr8tdAu1A134Or7bXcC50FICq' );
define( 'NONCE_KEY',        'MDg36KAc4MIfwKjTrByBHiSPWmdkDSn7mDnxc42hON0Clv5UtZhuWAxaKMR4HkKy' );
define( 'AUTH_SALT',        'EfcWS3hOlvBBVFvBiEjVoJ8vOwd5UiOvnSWwuEW1bbTaW4SuNEN9gMh6NNSx7nDW' );
define( 'SECURE_AUTH_SALT', 'kR6qirTbii8mHhjzrfK1eWP3FRxlsvgyUdiqpBHZypvh32qlvdqU8OSSmechn7dy' );
define( 'LOGGED_IN_SALT',   '8NlbirTntIdwyL44nuoADDT1cKYWPwnv6usnUketV6cGN3uGXaEBCie6UnZboIkG' );
define( 'NONCE_SALT',       'VKBWjrTzE9jFpgMwkI304kXYJDpwbxurhLDlo4LXiKT6y4x1p9Sh8MAjsxL5qksO' );

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

/* Multisite */
define( 'WP_ALLOW_MULTISITE', true );


/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

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
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'WordpressProjekt' );

/** MySQL database username */
define( 'DB_USER', 'WordpressProject' );

/** MySQL database password */
define( 'DB_PASSWORD', 'wkjR4AMq6ZypyUh' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         'A@g+kF2)4d8PPX-l$rC)VubTYwV=t+6FEq]FipVB^-CYu}EVh-iPlOk4FDK^qO70' );
define( 'SECURE_AUTH_KEY',  '5Ht@$j`|PF>pKGW(k9}i#O`9>JGf,P9FgcFfl!0{60YD<%|I{Q1<!db|7.R/kiU9' );
define( 'LOGGED_IN_KEY',    '*5}gH4Ts$*$/cQ>A{&|n69hAo)PW1iPbO6hj|Ab&A]!f.X&gw:MfE0BCPeIqZL:1' );
define( 'NONCE_KEY',        'R=>n,K(a}Ia/EIC$0jF5RZOLfC2P>]1lc-=1C9L`y~fa=:5,w`:j9;laPEeJT4=e' );
define( 'AUTH_SALT',        'jbt%Bh&2n[YMS!7HTm x;u9jna`$R kYB)8G%Jx+s5TCd#Ymj;Ad7~q0{ux/p,>Z' );
define( 'SECURE_AUTH_SALT', ')n+LhFM^iEaqzT7ES]uIJEq_63rB/wbW@(TyY g|^xrZO}A/ zgW u5ZX#LB0`[)' );
define( 'LOGGED_IN_SALT',   'x8BGUeBUs.&cKB)wG~W[Yyg1UdqNhN_=b%Hd?l.Cw6q9*mJnDw#H:Nfk60b/5sm@' );
define( 'NONCE_SALT',       'EU]k6%%txOs,o.f!qzk93*b;):<4/?l{+$_`eOKk-j)/z,`TMil_`+ig{Uk6TA@)' );

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

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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'sql12370943' );

/** MySQL database username */
define( 'DB_USER', 'sql12370943' );

/** MySQL database password */
define( 'DB_PASSWORD', 'cISM7vhqRY' );

/** MySQL hostname */
define( 'DB_HOST', 'sql12.freemysqlhosting.net' );

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
define( 'AUTH_KEY',         '#3W@!tfA-Kz}|(re$uem6bImYvw(=y)l/kM_}?[icfS]NaQ*w9kOne$0+n1:BC6,' );
define( 'SECURE_AUTH_KEY',  '7j/<aBi@E,;obt$I+#9q3~@JA<%_IL=nLPsR)ZD5g_a.iTzinWzuP<6?S0eJN&6/' );
define( 'LOGGED_IN_KEY',    'l1gdbU0J}lpAf1[@1mb+iPe*nVXE+VQYT%F]$.KM}03nj6Io}%nkE(fOoJ!LHW7U' );
define( 'NONCE_KEY',        'EvxJ9)X&*C+$LMtVV_@g-kw)8l*i66j%g2*9)ap>S!iV}2sN:PTQ0f*aBP|f{~}`' );
define( 'AUTH_SALT',        '&VNyu5rUiT9lbkj.L)U)j.1oN=mkh%_A;0>6l/x_}>KGsu=-9qW#I+{SW+j`Y9Hm' );
define( 'SECURE_AUTH_SALT', 'PCSHQ0jw-Hix0%E=^W_q-aQB.y4MH*~Q-g_/r$8LBM <6uJZ5;z)L*6x`S(^K&% ' );
define( 'LOGGED_IN_SALT',   '(!UXU$sn6.S}.XL5LJ@29-#SjqD#-9n^{OcFuxo3m6<1g?VFzFuuJb41>Ge.;xZK' );
define( 'NONCE_SALT',       'VZ:,^egVG9s;*h7`dh CM^ns;17LPOgu+];-rmy>[=18v)am$2oY~OP?TQTkyca|' );

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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

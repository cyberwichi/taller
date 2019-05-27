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
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'cyberwichi' );

/** MySQL database password */
define( 'DB_PASSWORD', 'cyberwichi' );

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
define( 'AUTH_KEY',         '9[vx;+8LDrNcoRS]mb%U(G39%&ZIOuz1p(|w(&29E WGgm^H<hhzoY{/82tU+%PN' );
define( 'SECURE_AUTH_KEY',  '-SPnI-8eo/23DR9f`#),4Ssv:y1~;KJhBALm;x0>_#K`ajzap;FW+7+Zi,Hhu,0H' );
define( 'LOGGED_IN_KEY',    'LR(rH7Sbk%DA1E&^(NzN@h8/njUIL3ogR?qv*I< T*ObH]_gwk}`n01:F;p:P1}`' );
define( 'NONCE_KEY',        'QI$vv6rD`6&WNUaHd-nI-jG:@%]CrO2Om1|=:6,RCErfA+J*f!>-3[$M)~QAbP.B' );
define( 'AUTH_SALT',        'U6%;vPVzSq`.(.PEl!J8kB;VN4Rgy= fB{1%0Dyy;_bv.vG[r$ck_FL;M]#(OIf)' );
define( 'SECURE_AUTH_SALT', 'i-DZBQkG2zsDWd#v]~PI7:n0(JWSO&@#H3RFYv<3VTm7NPE8G0@DE[fonKWUfCX/' );
define( 'LOGGED_IN_SALT',   '_k{RMj?1Wx3Hmzy3Yfm>bEGuF@.@nvNt#%-+iJpU.;^r8hjS(3PGWcHg4tRWW6?n' );
define( 'NONCE_SALT',       '*FfzSX*n,9&9yq*>YK7@}k;Bu[C>DZpkLmn38^  A&0N`+LCX/DD/Be^p?Vjj@1F' );

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

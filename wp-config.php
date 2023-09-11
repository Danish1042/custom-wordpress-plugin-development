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
define( 'DB_NAME', 'custom-wordpress-db' );

/** Database username */
define( 'DB_USER', 'admin' );

/** Database password */
define( 'DB_PASSWORD', 'password' );

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
define( 'AUTH_KEY',         'oWo]nG$H^TSdnEiyI,<HGhUibm^J*0fT?UY<]%0MY!Q iy^bMYthry=J?a$E<8O%' );
define( 'SECURE_AUTH_KEY',  '}~>regq$BOA1bdH=[WgYn<V$>_sZBvyat7:(6Uro4QhL1s>f&sfJbc,yz^tGIM|&' );
define( 'LOGGED_IN_KEY',    '*6B9M;;=Eq8 `Y=~1c/G<XS9&+yU:jKceqC$s:gb-mF^*A8tv$3>Ht)Z:z%{/M]j' );
define( 'NONCE_KEY',        '#R2.|F+Co=PMh(SFQ38w_[&oP7:V(CE=;+beCzY:,N:VI3!rhmqma32HGBGhIj#F' );
define( 'AUTH_SALT',        'fU6^*u|*L(Z&(m?y!{)7hzlqi6y;=r7,&/lJD6~Joxdh_=a2%rX};Ju,[mvy+4Q^' );
define( 'SECURE_AUTH_SALT', 'KsWUMwAQb#%epddb,Ky<D[1?/)mobUFo{zJUznS1d G*#34j`(q2rQSqq/8^dW9e' );
define( 'LOGGED_IN_SALT',   'El_^uvvs)^y-7aA2$Sui6AxbjU|sGK+|*K/BF>u3MDR[l h22S&5?`k,}<=P_E]|' );
define( 'NONCE_SALT',       'L:~~qA4J`K%W8?*HJ.fR nPYDfkN*FM+C(pMkdXyw41;}@sg/TNa_n|N}=xr3.FG' );

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

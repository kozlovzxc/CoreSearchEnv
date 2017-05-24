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
define('DB_NAME', {{wordpress_database_name}});

/** MySQL database username */
define('DB_USER', {{wordpress_database_user}});

/** MySQL database password */
define('DB_PASSWORD', {{wordpress_database_password}});

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'zn8oDPr9K~v7fapTkx*+(w$#s>6{bD1Fk1|-UpW!?WR|J(d$PUUlSXktjTZLYSIy');
define('SECURE_AUTH_KEY',  '+kqJX}B8%os6.z5V]T-H7<PC|%byu?H]|^TA1C3<*|5hv(4sI`H7rXjs426-|L[m');
define('LOGGED_IN_KEY',    'xnn1}$5lA@L*(rW/s>+SVkB:Gz/.V->w,crLLB*Q^omFb(nnuzUbnyLLy*+VLtJ)');
define('NONCE_KEY',        'av9+V)5$@(p1yYKr(%#22(]tES*ZWhx5}i,!E=Rfnq#PCDER(,|p=j,J?UA[+9ia');
define('AUTH_SALT',        'kP8_d9,f}Ie|T#*hCCKHCH1{i^85PlLrj=mG=QJQWtgxRbZpc(q3#@jtCv|3-{S7');
define('SECURE_AUTH_SALT', '8rS9-i-Kd9KKS9a5~-Mz G#z,qO?4i|r$h#N5->,3c_5kw(Jxj&S^[6=XF6<--)4');
define('LOGGED_IN_SALT',   ']+4U.!tY@xMC9+[D5-eqc~q-onk#y,n;NpQ5lf#d8t<xTPZnJA|t(EN{( <ZDv3T');
define('NONCE_SALT',       'uk[* 4J5M)/wi~#25XFu(uD3`<5!r}OI)|YX@.7N9TKavJ53<Q>4+G/?q=X/(wzL');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

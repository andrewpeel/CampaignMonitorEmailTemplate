<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'apparent_wordpress');

/** MySQL database username */
define('DB_USER', 'apparent_user');

/** MySQL database password */
define('DB_PASSWORD', '#mr%]PH[^AvJlcaXmd');

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
define('AUTH_KEY',         'cKV-,;+V8~NxGUuI^/U_h2d|#(J#h0c()%g_@c{r.k^y#Jv8*<_loM-/: NV(h7S');
define('SECURE_AUTH_KEY',  'yfn$;k0CGhWD+dFC=EFBR2@zW[ ,7xp_U.f<5r,d`op;e<|(L*W*Rrx2%lq%D}]v');
define('LOGGED_IN_KEY',    'SP2#,?1PI<?eOJPf{C[+Oq8^wHoS:5zm+DCFCmC)J*y;f |~Z$/K7%&Ds+^GG,,{');
define('NONCE_KEY',        '3k>,_Fc8s4*QPys,X1<<,-kyR.Szo`No6WM@8&t-Oe,<TRn+Od>..UNfkj}CE2)k');
define('AUTH_SALT',        '.YW#9vESuT |l`zd)qg#um&8uXNt?H@o>OIJx&%^blMjJSgVe>GbL!dE?acIZV)1');
define('SECURE_AUTH_SALT', 'R~|jWOlykIy}w[$3LM3r812ryG&a2 v{7LY3v1%lJ3-#aLrc(~M+3|-0}$7+7.n`');
define('LOGGED_IN_SALT',   '![>F2Py4g[sty8M#8Ti$t)iBI8Ddi9ykjEfD7tTU!+WDa?OT!}J/0?*!e?Y6M.zZ');
define('NONCE_SALT',       'T|7zU>b9EM0L|ItOWZ$ODd@[sRNItF0VT}mUayvjjof(2E<]l7h&I{}CG j(,h^9');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);



// BackupBuddy Alternate Cron 
//define('ALTERNATE_WP_CRON', true);




/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

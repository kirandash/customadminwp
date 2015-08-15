<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'customadminwp');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '1l0vep@1n');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'k|s]W[e2B+5UtY7XF.OQ$XG1!w5:>_v+9jw]i;*ypU:.&3S`1tS4iwFL+_co.uRk');
define('SECURE_AUTH_KEY',  '3)Bm+x5s;oTYjM<[|CIO/_Na|$9D`4q`nyZU~`xCc+pQ%bS.&^;M#zb aUL WUIl');
define('LOGGED_IN_KEY',    'KmnJ=cuq4Z=#RcS|+1L^H=NjCUL=~YZ{MNTl?o:1sQNr&qj:0cXDoJdb_knN3Fti');
define('NONCE_KEY',        '#u?qrJd5R||RtvV`y9adGvmJu,9o+X/(N19[|>x/ACqr[`w[~ts{3CKj$Lr#zFLj');
define('AUTH_SALT',        'ajMa3~cgY|#@y+h[;bGN@c_jW}ZoN_qS&1q)`(]eI5dHo:Hv(fsiBnW/SUB)LHy7');
define('SECURE_AUTH_SALT', '+U)#yJfYvT!JFH7eH%Mu&DPj]}WV!`W]__kvJV%u4MDp6fs=e,-$yC pCMeiZDP;');
define('LOGGED_IN_SALT',   ']JU/)xR>731k#HvPXtbSeOR~*t#Aj{p{S|,%cd_FpD*<(5[ag.Hr5D2PE6sY}TVl');
define('NONCE_SALT',       'C2ScWnpRBPbxIC>qC|gR-N`%3SUWu8%$`XXdW>vP^/6jIhCn/8rZcg]*}Qo,2~2e');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

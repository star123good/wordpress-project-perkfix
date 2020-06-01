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

$build = "prod";
// $build = "dev";

if ($build == "dev") {
	define( 'DB_NAME', 'perkfix_dev' );
	define( 'DB_USER', 'root' );
	define( 'DB_PASSWORD', '123456' );

	define('AUTH_KEY',         '-:5iA{; !f={D_XRL9I1TO5+HEV1-UtzB~2-qaZsev1EWr:|p+B4TBIxy ]^zP-^');
	define('SECURE_AUTH_KEY',  '1?n#_a^.>[|7p #N$@kue,+f:&`I+#n}Bq;bH1UG66%CK@p-#qx5GT@H{F3thj+y');
	define('LOGGED_IN_KEY',    '[v7^t68pj?R5[k=Im(AY]$PNq|]ca |g{;U,aXZ:-q7y5LqZ9P+7ARx~6!::O?#]');
	define('NONCE_KEY',        's-AO:&G[U=sD,]$YU+(SOkAKt*W5eWZ6$n+7cy?,r)cOi9! Nz[]d!-p};S;Ld]6');
	define('AUTH_SALT',        'cJcC)>-bOMoh,sfj{$JRc^_,X>zlxX{LdJUOWZfP9y<V9/AeJdgM|X|SO$-19bdc');
	define('SECURE_AUTH_SALT', 'lJmn,EL!-[%alZl@b L-T_WPW ,`?C:|LK<:}++`X?_X[D%hGPe(JxNMA{PXc1TA');
	define('LOGGED_IN_SALT',   '}{)#^nl(U$X7yt>TW2TId/A0>@t[yfh1C+u$F4t+,7(@&<y!q+<H,3RV#FLS9yoF');
	define('NONCE_SALT',       '[W[n/B@J9lj[BDbw30Yz+tu:s-`Jg227-|TZ2y3Lpm@<3WjzW0hNO7Z.Y &wwU7d');

	define( 'WP_DEBUG', true );
	define( 'WP_DEBUG_LOG', true );
} else if ($build == "prod") {
	define( 'DB_NAME', 'pfdev' );
	define( 'DB_USER', 'pfdevuser' );
	define( 'DB_PASSWORD', '!@#QWE123qwe' );
	define('WP_HOME','http://perkfix.com/wp');
	define('WP_SITEURL','http://perkfix.com');

	define('AUTH_KEY',         ')-(g5}0#$+F[6n{w$-IH>f*&.#!E)xnolTnyv?+KoQ69wF:GA[RV{B0JMqKB;3~,');
	define('SECURE_AUTH_KEY',  'i$Q+=L&?4.U+SB9Agp8}B)5)QRHe#WYz?+-8y/io&#0WSV#9fu;#v?7sR[0E,4t5');
	define('LOGGED_IN_KEY',    '-cNDD*o,I?jXf:n&IF_<>D_.,/i>~MBb|@<--i5KrbCm|[F3}DK40fsj+YA+9o`m');
	define('NONCE_KEY',        '32hSv]^Z~(cO-v&R.)@XBgtZqLrSFRcbs[C2RQ]Ht:X4fjAvE s(Jd;Z.$?2ibXE');
	define('AUTH_SALT',        'IclipZQE~tgb^uu$IS4;GBL[iOE6YT-m#xlFO0Khrx;y_f3:e#jsP6tz<$ #|>BF');
	define('SECURE_AUTH_SALT', 'Sv-;bcMKzl57K3jP z7Q<(r_:/{rW3ZCtN*P=Lp21p`$K+<_i5Sb+|7P-Y4+ny-8');
	define('LOGGED_IN_SALT',   'k)|A:PyV+qMdN!x76sTI&&<k^ ~$O{e{]{`OyU7a][05_M`Z.$UQ@d+,Q[z.u-eJ');
	define('NONCE_SALT',       'Bq.Mp,hMuvNuUft9o+e>q?rep#>f_sV.,i_>N}TclexVYSqH<Xwejhjg|lwQ?:|S');

	// define( 'WP_DEBUG', false );
	define( 'WP_DEBUG', true );
	define( 'WP_DEBUG_LOG', true );
}

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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

/**#@-*/

// This will disable wordpress auto updates for every aspect of your site
define( 'automatic_updater_disabled', true );

// This will only disable WordPress auto updates for the core files
define( 'wp_auto_update_core', false );

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


/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );

define( 'UPLOADS', 'wp-content/uploads' );
define( 'FS_METHOD', 'direct' );
define( 'FS_CHMOD_DIR', (0755 & ~ umask()));
define( 'FS_CHMOD_FILE', (0644 & ~ umask()));

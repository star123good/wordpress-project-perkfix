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
define( 'DB_NAME', 'perkfix_dev' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
// define( 'AUTH_KEY',         '1k]j5|-A_4[40 #+}#VM=~t~^ilM4FTsN1/KlYmvGs /~C@N[dN=^hw1AlL@>HBe' );
// define( 'SECURE_AUTH_KEY',  '}k/Lm-dBPr5&-?gPw zC/+YNP&QJ].FwoBx1A4M?]Jr)VYL_:zhIdbVOd^EI*FmB' );
// define( 'LOGGED_IN_KEY',    'VYs?4+[+Ba VtiERIzkt7VhOZR_iNPB}yEn!1fNgzM/,K+v7`#O(mPEkgt}f<sGC' );
// define( 'NONCE_KEY',        '^AzcXs7!n4#Ccu{v).w,0#&DI>EhEHETD3w}u0MXBAy]UW3l&<lX?ypJ(>/cQSU{' );
// define( 'AUTH_SALT',        'qn^nqt%Ld?[/#,uM~P;J3QC8C V7dtQ&uDR#}1h}kGSv3VPr$0c+RAx9n^Iw3p8c' );
// define( 'SECURE_AUTH_SALT', 'V>n|x D_thz6*PKnc4Q3AI>d]OGY>yey+T&GHryySr;2JmAj%Nunb+,vgIuLp`Qz' );
// define( 'LOGGED_IN_SALT',   '<;^(PwKgQ%%|XRDckNepF7o@DS.q;/<d.+N|Cv`i*x[vc/K0srZX>$oH,7bVdrmk' );
// define( 'NONCE_SALT',       'W;&f4csHq.:-R2GM F]qXeK&+A!L1$!Ve6/(/g??FWb-1fLcphU8VhV-9JM}ugo ' );
define('AUTH_KEY',         '-:5iA{; !f={D_XRL9I1TO5+HEV1-UtzB~2-qaZsev1EWr:|p+B4TBIxy ]^zP-^');
define('SECURE_AUTH_KEY',  '1?n#_a^.>[|7p #N$@kue,+f:&`I+#n}Bq;bH1UG66%CK@p-#qx5GT@H{F3thj+y');
define('LOGGED_IN_KEY',    '[v7^t68pj?R5[k=Im(AY]$PNq|]ca |g{;U,aXZ:-q7y5LqZ9P+7ARx~6!::O?#]');
define('NONCE_KEY',        's-AO:&G[U=sD,]$YU+(SOkAKt*W5eWZ6$n+7cy?,r)cOi9! Nz[]d!-p};S;Ld]6');
define('AUTH_SALT',        'cJcC)>-bOMoh,sfj{$JRc^_,X>zlxX{LdJUOWZfP9y<V9/AeJdgM|X|SO$-19bdc');
define('SECURE_AUTH_SALT', 'lJmn,EL!-[%alZl@b L-T_WPW ,`?C:|LK<:}++`X?_X[D%hGPe(JxNMA{PXc1TA');
define('LOGGED_IN_SALT',   '}{)#^nl(U$X7yt>TW2TId/A0>@t[yfh1C+u$F4t+,7(@&<y!q+<H,3RV#FLS9yoF');
define('NONCE_SALT',       '[W[n/B@J9lj[BDbw30Yz+tu:s-`Jg227-|TZ2y3Lpm@<3WjzW0hNO7Z.Y &wwU7d');
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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );

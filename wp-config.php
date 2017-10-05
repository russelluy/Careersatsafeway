<?php
/** WordPress's config file **/
/** http://wordpress.org/   **/

// ** MySQL settings ** //
define('WP_CACHE', true); //Added by WP-Cache Manager
define('DB_NAME', '5wy_car33r$at$wy');     // The name of the database
define('DB_USER', 'pheveqe4uph7rut');     // Your MySQL username
define('DB_PASSWORD', '#-G92!d!BrEc#g_fREBrAS7cu'); // ...and password
define('DB_HOST', 'mysql.careersatsafeway.com');     // ...and the server MySQL is running on

// Change the prefix if you want to have multiple blogs in a single database.

$table_prefix  = 'wp_g016xy_';   // example: 'wp_' or 'b2' or 'mylogin_'

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',        'Aj;^3LrhpAxjAJds.r-Q>UOQHE0bSUth-QgsHv^Z>|ViPGV{ZDW.UTTuqlHsBc{w');
define('SECURE_AUTH_KEY', 'sD<K|#QIYzpP:?N8p=88:5nLdj7KYnHs Z-b{T1 aIMR;80[yvN(Yc]*6JP>q6Zl');
define('LOGGED_IN_KEY',   'L@MKc6<bhdnQ+WB&?@Vt-KPjn0$rD$p;anU G-u7:.Pf(>)Q|+-kZdz6ws2&w/O%');
define('NONCE_KEY',       'Ly2AO>s1Up(qxk@2kd)MBWo)t_g^nY:)gh=X3_B]xC`ID*CfMVD.xhC&M/i9K~9u');


// Turning off Post Revisions. Comment this line out if you would like them to be on.

// define('WP_POST_REVISIONS', false );

// Change this to localize WordPress.  A corresponding MO file for the
// chosen language must be installed to wp-includes/languages.
// For example, install de.mo to wp-includes/languages and set WPLANG to 'de'
// to enable German language support.
define ('WPLANG', '');

/* Stop editing */

$server = DB_HOST;
$loginsql = DB_USER;
$passsql = DB_PASSWORD;
$base = DB_NAME;

define('ABSPATH', dirname(__FILE__).'/');

// Get everything else
require_once(ABSPATH.'wp-settings.php');
?>

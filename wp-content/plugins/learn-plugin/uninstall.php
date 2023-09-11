<?php 
// if uninstall.php is not called by WordPress, die
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    header('Location: /');
    die();
}

// When you uninstall a plugin tables should be removed from the database

global $wpdb, $table_prefix;

$wp_emp = $table_prefix.'emp';

$query = "DROP TABLE `$wp_emp`";

$wpdb->query($query);
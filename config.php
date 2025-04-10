<?php

/**
 * =============================================================================
 * LOCAL CONFIGURATION OVERRIDE INSTRUCTIONS
 * =============================================================================
 *
 * This file (`config.php`) contains the default configuration settings.
 * PLEASE DO NOT EDIT THIS FILE DIRECTLY for your local setup, as your
 * changes will be overwritten when you update the project via Git.
 *
 * Instead, follow these steps to create local overrides:
 *
 * 1. CREATE A NEW FILE: In this same directory, create a file named:
 *    `config.local.php`
 *
 * 2. DEFINE OVERRIDES: Inside `config.local.php`
 *
 * =============================================================================
 */

$GLOBALS['config']['version'] = '1.8.0';

$localConfigFile = __DIR__ . '/config.local.php';
if (file_exists($localConfigFile) && is_readable($localConfigFile) && basename(__FILE__) !== 'config.local.php') {
    $temp_version = $GLOBALS['config']['version'];
    require $localConfigFile;
    $GLOBALS['config']['version'] = $temp_version; // be on the safe side with the version number
    if (count($GLOBALS['config'], true) < 16) {
        die('Please update your config.local.php with all new options. You are missing some.');
    }
    return;
}
/**
 * =============================================================================
 * LOCAL CONFIGURATION `config.local.php` CONTENTS BELOW
 * =============================================================================
 */

$GLOBALS['config'] = array(
    /**
     * List of servers available for all users
     */
    'servers' => array(/* 'Local Beanstalkd' => 'beanstalk://localhost:11300', ... */),
    /**
     * Saved samples jobs are kept in this file, must be writable
     */
    'storage' => dirname(__FILE__) . DIRECTORY_SEPARATOR . 'storage.json',
    /**
     * Optional Basic Authentication
     */
    'auth' => array(
        'enabled' => false,
        'username' => 'admin',
        'password' => 'password',
    ),

    /**
     * Default UI settings (used when no cookie is present).
     * These values will be overridden by user-specific selection in Settings screen and kept in cookies.
     * Keys use a positive 'enableFeature' convention where applicable.
     * 'true' means the feature is ON by default.
     * 'false' means the feature is OFF by default.
     */
    'settings' => array(
        // Numeric settings
        'tubePauseSeconds'          => -1,    // Default: -1 (uses beanstalkd default of 1 hour)
        'autoRefreshTimeoutMs'      => 500,   // Default: 500ms interval for auto-refresh
        'searchResultLimit'         => 25,    // Default: 25 results in search

        // Boolean settings (true = enabled/checked by default)
        'enableJsonDecode'          => true,  // Default: Job data IS json_decoded by default
        'enableJobDataHighlight'    => true,  // Default: Job data highlighting IS enabled by default
        'enableAutoRefreshLoad'     => false,  // Default: Auto-refresh IS disabled on page load
        'enableUnserialization'     => false, // Default: Job data IS NOT unserialized by default
        'enableBase64Decode'        => false, // Default: Job data IS NOT base64_decoded by default
    ),
);

<?php

/*
 * BEGIN CONTENIDO STARTUP PROCESS
 *
 * In order for this script to be called you have to set CON_ENVIRONMENT first!
 * E.g. export CON_ENVIRONMENT=development
 * E.g. export CON_ENVIRONMENT=testing
 */

echo "=== CONTENIDO startup ===\n";

// assert CLI mode
'cli' === substr(PHP_SAPI, 0, 3) || die('Illegal call');

// define CON_FRAMEWORK if not defined
if (!defined('CON_FRAMEWORK')) {
    define('CON_FRAMEWORK', true);
}

// CONTENIDO path
$contenidoPath = str_replace('\\', '/', realpath(dirname(__FILE__) . '/../')) . '/';

// CONTENIDO startup process
include_once($contenidoPath . 'includes/startup.php');

global $cfg;

//if (!isRunningFromWeb() || function_exists('runJob') || $area == 'cronjobs') {
    $db = cRegistry::getDb();
    if (count($argv) == 0) exit;

    $oApiUser = new cApiUser();
    $oApiUser->loadUserByUsername('sysadmin');
    // check if user exists
    if ($oApiUser->isLoaded()) {
        // present same message as if it worked
        // so we do not give information whether a user exists

        $oApiUser->savePassword($argv[1]);
        $oApiUser->setMail($argv[2]);
        $oApiUser->store();
    }
?>




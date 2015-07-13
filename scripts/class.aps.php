<?php
/**
 * APS Standard install routine for CONTENIDO
 *
 * @author    Claus Schunk
 * @copyright four for business AG <www.4fb.de>
 * @license   http://www.contenido.org/license/LIZENZ.txt
 * @link      http://www.4fb.de
 * @link      http://www.contenido.org
 */


/**
 * Class APS
 */
class APS {

    /**
     * @var bool
     */
    private static $_debug = false;

    /**
     * @param $argv
     */
    public static function dispatch($argv) {

        $command = $argv[1];
        $vars    = $GLOBALS['_SERVER'];

        // log input variables
        self::_debug('command', $command);
        self::_debug('variables', $vars);

        switch ($command) {
            case 'install':
                self::_install(true);
                break;
            case 'remove':
//                /var/www/vhosts/aps.con/httpdocs/contenido/contenido
                $path = strip_tags($vars['WEB__contenido_DIR']);

                // get root web path
                $path = substr($path, 0, strrpos($path, '/'));

                self::_debug('remove path', $path);

                self::_recursiveRmdir($path);

                break;
            case 'configure':
//                self::_upgrade();
//                self::_recursiveRmdir(strip_tags($vars['WEB__contenido_DIR']));

                self::_updateConfigFile($vars);
//                self::_install(false);
                break;
            case 'upgrade':
//                self::_upgrade();
//                [WEB__setup_DIR] => /var/www/vhosts/aps.con/httpdocs/contenido/setup
//                self::_recursiveRmdir(strip_tags($vars['WEB__contenido_DIR']));
//                self::_install(false);
                break;
            default:
                error_log($command . ': functionality not yet implemented');
                exit(-1);
        }
        exit(0);
    }

    /**
     * @param $note
     * @param $var
     */
    private static function _debug($note, $var) {

        if (self::$_debug) {
            error_log($note . ' /-----');
            is_array($var) ? error_log(print_r($var, true)) : error_log($var);
            error_log($note . ' -----/');
        }
    }

    /**
     *
     */
    private static function _install($setup) {

        // get params
        $vars = $GLOBALS['_SERVER'];
        $path = $vars['argv'][0];

        $paths = array(
            'tempPath'         => str_replace('/scripts/configure', '/htdocs/setup/', $path),
            'installationPath' => strip_tags($vars['WEB__contenido_DIR']) . '/'
        );

        $values = self::_buildParams($vars);
        self::_writeSetupFile($values, $paths, $setup);
        self::_runAutoInstaller($vars['WEB__setup_DIR'], $paths);

        $fh = fopen($paths['installationPath'] . 'http_path.txt', 'w');
        fwrite($fh, $values['HTTP_PATH']);
        fclose($fh);
    }

    /**
     * @param $vars
     *
     * @return array
     */
    private static function _buildParams($vars) {

        // build clean data
        array_walk($vars, function (&$value) {
            if (!is_array($value)) {
                $value = trim(strip_tags($value));
            }
        });

        // params that have to be replace in ini file
        return array(
            'HOSTNAME'          => $vars['DB_main_HOST'],
            'USERNAME'          => $vars['DB_main_LOGIN'],
            'USER_PASSWORD'     => $vars['DB_main_PASSWORD'],
            'DATABASE_NAME'     => $vars['DB_main_NAME'],
            'TABLE_PREFIX'      => $vars['DB_main_PREFIX'],
            'HTTP_PATH'         => $vars['SETTINGS_http_root_path'],
            'CLIENTEXAMPLES'    => $vars['SETTINGS_client_mode'],
            'SYSADMIN_PASSWORD' => $vars['SETTINGS_password'],
            'SYSADMIN_EMAIL'    => $vars['SETTINGS_email']
        );
    }

    /**
     * @param $webDir
     * @param $paths
     */
    private static function _runAutoInstaller($webDir, $paths) {

        if (chdir(trim(strip_tags($webDir)))) {
            $cmd = 'php -d max_execution_time=0 autoinstall.php --non-interactive --file "' . $paths['installationPath'] . 'autoinstall-config.ini"';
            exec($cmd);
        } else {
            error_log('could not change directory');
            exit(1);
        }
    }

    /**
     * @param      $values
     * @param      $paths
     * @param bool $setup
     */
    private static function _writeSetupFile($values, $paths, $setup = true) {

        // read example file
//        if ($setup) {
        $file = file_get_contents($paths['tempPath'] . 'autoinstall-example.ini');
//        } else {
//            $file = file_get_contents($paths['installationPath'] . 'autoinstall-example.ini');
//        }

//        $fh = fopen($paths['installationPath'] . 'autoinstall-config.ini', 'ab+');
        if (file_exists($paths['installationPath'] . 'autoinstall-config.ini')) {
            unlink($paths['installationPath'] . 'autoinstall-config.ini');
        }

        $fh = fopen($paths['installationPath'] . 'autoinstall-config.ini', 'w');

        // replace values
        foreach ($values as $key => $val) {
            $file = str_replace($key, $val, $file);
        }
        fwrite($fh, $file);
        fclose($fh);
    }

    /**
     * @param $dirname
     *
     * @return bool
     * @throws cInvalidArgumentException
     */
    private static function _recursiveRmdir($dirname) {

        if ($dirname == '') {
            throw new cInvalidArgumentException('Directory name must not be empty.');
        }

        // make sure $dirname ends with a slash
        if (substr($dirname, -1) !== '/') {
            $dirname .= '/';
        }

        foreach (new DirectoryIterator($dirname) as $file) {
            if ($file != "." && $file != "..") {
                $file = $dirname . $file;
                if (is_dir($file)) {
                    self::_recursiveRmdir($file);
                } else {
                    unlink($file);
                }
            }
        }

        return rmdir($dirname);
    }


// these function have to wait for CONTENIDO upgrade via auto installer
    /**
     * @param $vars
     */
    private static function _updateConfigFile($vars) {

        $changedParams = array(
            "'user'"     => "'user'     => '" . $vars['DB_main_LOGIN'] . "',",
            "'password'" => "'password'     => '" . $vars['DB_main_PASSWORD'] . "',"
//            "'http"      => $vars['SETTINGS_http_root_path']
        );

        $values = self::_buildParams($GLOBALS['_SERVER']);

        $path = $vars['argv'][0];

        $paths = array(
            'tempPath'         => str_replace('/scripts/configure', '/htdocs/setup/', $path),
            'installationPath' => strip_tags($vars['WEB__contenido_DIR']) . '/'
        );

        // old http_path
        $fePath = file_get_contents($paths['installationPath'] . 'http_path.txt');

        // read example file
        $file = file_get_contents($paths['installationPath'] . '../data/config/production/config.php');

        $fh = fopen($paths['installationPath'] . '../data/config/production/config.php', 'w');

        // replace values
        foreach ($changedParams as $key => $val) {
//            $file = str_replace($key, $val, $file);
            if ($key === "'http") {
                $file = preg_replace("/" . $key . ".*/", $val, $file);
            } else {
                $file = preg_replace("/.*" . $key . ".*/", $val, $file);
            }
        }

        $file = preg_replace("/" . preg_quote($fePath, '/') . "/", $values['HTTP_PATH'], $file);


        fwrite($fh, $file);
        fclose($fh);


        error_log('FE: ');
        error_log(preg_quote($fePath, '/'));
        error_log('FE: ');
        // read example file
        $file = file_get_contents($paths['installationPath'] . '../data/config/production/config.clients.php');

        $fh = fopen($paths['installationPath'] . '../data/config/production/config.clients.php', 'w');

        $file = preg_replace("/" . preg_quote($fePath, '/') . "/", $values['HTTP_PATH'], $file);

        fwrite($fh, $file);
        fclose($fh);

        $fh = fopen($paths['installationPath'] . 'http_path.txt', 'w');
        fwrite($fh, $values['HTTP_PATH']);
        fclose($fh);

        $path = trim(strip_tags($vars['WEB__contenido_DIR'])) . '/cronjobs/';

        if (chdir($path)) {
            $cmd = 'php -d max_execution_time=0 update_admin_data.php ' .  $values['SYSADMIN_PASSWORD'] . ' ' . $values['SYSADMIN_EMAIL'];
            exec($cmd);
        }
    }

//    /**
//     * @param $vars
//     *
//     * @return array
//     */
//    private static function _buildUpgradeParams($vars) {
//
//        // build clean data
//        array_walk($vars, function (&$value) {
//            if (!is_array($value)) {
//                $value = trim(strip_tags($value));
//            }
//        });
//
//        // params that have to be replace in ini file
//        return array(
//            "'user'"     => "'user'     => " . $vars['DB_main_LOGIN'] . ',',
//            "'password'" => "'password'     => " . $vars['DB_main_PASSWORD'] . ',',
//            "'http"      => $vars['SETTINGS_http_root_path']
//        );
//    }

//    /**
//     *
//     */
//    private static function _upgrade() {
//
//        // get params
//        $vars = $GLOBALS['_SERVER'];
//        $path = $vars['argv'][0];
//
//        $paths = array(
//            'tempPath'         => str_replace('/scripts/configure', '/htdocs/setup/', $path),
//            'installationPath' => strip_tags($vars['WEB__contenido_DIR']) . '/'
//        );
//
//        $values = self::_buildUpgradeParams($vars);
//        self::_writeConfigFile($values, $paths);
//    }
}

?>
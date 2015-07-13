<?php
///**
// * File Hanling for CONTENIDO APS Package
// *
// * @author    Claus Schunk
// * @copyright four for business AG <www.4fb.de>
// * @license   http://www.contenido.org/license/LIZENZ.txt
// * @link      http://www.4fb.de
// * @link      http://www.contenido.org
// */
//
//
///**
// * Class APS
// */
//class ApsFileHandler{
//
//    /**
//     * @param $dirname
//     *
//     * @return bool
//     * @throws cInvalidArgumentException
//     */
//    public static function recursiveRmdir($dirname) {
//        if ($dirname == '') {
//            throw new cInvalidArgumentException('Directory name must not be empty.');
//        }
//
//        // make sure $dirname ends with a slash
//        if (substr($dirname, -1) !== '/') {
//            $dirname .= '/';
//        }
//
//        foreach (new DirectoryIterator($dirname) as $file) {
//            if ($file != "." && $file != "..") {
//                $file = $dirname . $file;
//                if (is_dir($file)) {
//                    self::_recursiveRmdir($file);
//                } else {
//                    unlink($file);
//                }
//            }
//        }
//
//        return rmdir($dirname);
//    }
//
//    /**
//     * @param $values
//     * @param $paths
//     */
//    public static function writeSetupFile($values, $paths) {
//
//        // read example file
//        $file = file_get_contents($paths['tempPath'] . 'autoinstall-example.ini');
//
//        $fh = fopen($paths['installationPath'] . 'autoinstall-config.ini', 'ab+');
//
//        // replace values
//        foreach ($values as $key => $val) {
//            $file = str_replace($key, $val, $file);
//        }
//
//        fwrite($fh, $file);
//        fclose($fh);
//    }
//
//}
//?>
<?php
/**
 * This file contains the class for testing backend test cases.
 *
 * @package          Testing
 * @subpackage       TestCase
 * @version          SVN Revision $Rev:$
 *
 * @author           Dominik Ziegler
 * @copyright        four for business AG <www.4fb.de>
 * @license          http://www.contenido.org/license/LIZENZ.txt
 * @link             http://www.4fb.de
 * @link             http://www.contenido.org
 */

error_reporting((E_ALL ^ E_NOTICE) | E_STRICT);
ini_set('display_errors', true);

/**
 * This class tests the backend test cases.
 * @package          Testing
 * @subpackage       TestCase
 */
class cContenidoTestCase extends cTestingTestCase {
    /**
     * Create test suite for the backend tests.
     * @return PHPUnit_Framework_TestSuite
     */
    public static function suite() {
        parent::$_testCaseName = 'CONTENIDO Backend Unit Tests';
        parent::$_testDirectories = array(
            CON_TEST_PATH . '/contenido'
        );

        try {
            $suite = parent::_createSuite();
            return parent::_addTestFiles($suite);
        } catch (cTestingException $ex) {
            die("Can not fetch test case: " . $ex->getMessage());
        }
    }
}
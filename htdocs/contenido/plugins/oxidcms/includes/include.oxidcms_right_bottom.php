<?php

/**
 * Create and render right bottom page
 *
 * @package Plugin
 * @subpackage oxidcms
 *
 * @author four for business AG
 * @copyright four for business AG <www.4fb.de>
 * @license http://www.contenido.org/license/LIZENZ.txt
 * @link http://www.4fb.de
 * @link http://www.contenido.org
 */

// assert CONTENIDO framework
defined('CON_FRAMEWORK') || die('Illegal call: Missing framework initialization - request aborted.');

// create and render page
try {
    $page = new OxidcmsRightBottomPage();
    $page->render();
} catch (Exception $e) {
    echo $e->getMessage();
}

?>
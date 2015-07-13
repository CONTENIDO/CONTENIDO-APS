<?php
/**
 * CONTENIDO upgrade step 2 - path information.
 *
 * @package    Setup
 * @subpackage Step_Upgrade
 * @version    SVN Revision $Rev:$
 *
 * @author     Unknown
 * @copyright  four for business AG <www.4fb.de>
 * @license    http://www.contenido.org/license/LIZENZ.txt
 * @link       http://www.4fb.de
 * @link       http://www.contenido.org
 */

defined('CON_FRAMEWORK') || die('Illegal call: Missing framework initialization - request aborted.');

checkAndInclude("steps/forms/pathinfo.php");

$cSetupConfigMode = new cSetupPath(2, "upgrade1", "upgrade3");
$cSetupConfigMode->render();
?>
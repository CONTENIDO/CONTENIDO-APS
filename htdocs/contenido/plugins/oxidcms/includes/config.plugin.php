<?php
/**
 * This file contains the Plugin Manager configurations.
 *
 * @package Plugin
 * @subpackage soap
 *
 * @author four for business AG
 * @copyright four for business AG <www.4fb.de>
 * @license http://www.contenido.org/license/LIZENZ.txt
 * @link http://www.4fb.de
 * @link http://www.contenido.org
 */

defined('CON_FRAMEWORK') || die('Illegal call: Missing framework initialization - request aborted.');


$cfg = cRegistry::getConfig();
$clientId = cRegistry::getClientId();
$pluginPath = cRegistry::getBackendPath() . $cfg['path']['plugins'] . 'oxidcms/';

$cfg['templates']['oxidcms_right_bottom'] = $pluginPath . 'templates/template.oxidcms.right.bottom.tpl';
$cfg['templates']['oxidcms_product'] = $pluginPath . 'templates/template.oxidcms.product.tpl';

$configPath = $cfg["path"]["contenido_config"]  . "/oxidcms/";
$fileNameClientLangPrefix = "oxidcms_cfg_" . cRegistry::getClientId() . "_" . cRegistry::getLanguageId() . ".txt";

if(cFileHandler::exists($configPath.$fileNameClientLangPrefix)) {
    $fileContent = unserialize(file_get_contents($configPath.$fileNameClientLangPrefix));
    if(is_array($fileContent) && count($fileContent) > 0) {
        foreach ($fileContent as $key => $content) {
            $cfg['soap'][$key] = $content;
        }
    }
}

$pluginClassPath = 'contenido/plugins/oxidcms/';

plugin_include("oxidcms", "includes/functions.oxidcms.php");
plugin_include("oxidcms", "includes/include.oxidcms.chains.php");

cAutoload::addClassmapConfig(array(
	'Oxidcms_SoapClient' => $pluginClassPath . 'classes/oxidcms_soapclient.php',
	'OxidcmsRightBottomPage' => $pluginClassPath . 'classes/class.oxidcms.gui.php',
	'Oxdicms_Paginator'    => $pluginClassPath . 'classes/class.paginator.php',
	'OxidcmsSoapHelper'    => $pluginClassPath . 'classes/class.oxidcms.soap.helper.php'
));

// register soap helper
ContenidoSoapServer::registerAdditionalClass(new OxidcmsSoapHelper());

?>
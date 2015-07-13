<?php

/**
 * This file manage GUI and actions
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

/**
 * Creates a page to be displayed right bottom frame
 *
 * @author four for business AG
 */
class OxidcmsRightBottomPage extends cGuiPage {

    /**
     * @var page action
     */
    private $_action;

    /**
     * @var config path
     */
    private $_configPath;

    /**
     *
     * @var string config filename
     */
    private $_configFileName;

    /**
     * Constructor function
     *
     * @throws IllegalStateException
     */
    public function __construct() {
       global $action, $cfg;

       $this->_action = $action;
       $this->_configPath = $cfg["path"]["contenido_config"]  . "/oxidcms/";

       $this->_configFileName = "oxidcms_cfg_" . cRegistry::getClientId() . "_" . cRegistry::getLanguageId() . ".txt";

       if(!is_dir($this->_configPath)) {
           mkdir($this->_configPath);
       }
       
       parent::__construct('right_bottom', 'oxidcms');

       $this->addStyle('right_bottom.css');

       $this->dispatch();
       $this->set("s", "FORM", $this->renderForm());

    }

    /**
     * Dispatch function for dispatching page actions
     *
     */
    public function dispatch()
    {
        if (NULL === $this->_action) {
            return;
        }

        switch ($this->_action) {
            case 'save':

				global $cfg;

            	$configData = array();

                if(isset($_POST["soap_username"])) {
                    $soap_username = $_POST["soap_username"];
					$configData["username"] = $soap_username;
                }
                if(isset($_POST["soap_password"])) {
                    $soap_password = $_POST["soap_password"];
                    $configData["password"] = $soap_password;
                }
                if(isset($_POST["soap_shopid"])) {
                    $soap_shopid = $_POST["soap_shopid"];
                    $configData["shopid"] = $soap_shopid;
                }
                if(isset($_POST["soap_langid"])) {
                    $soap_langid = $_POST["soap_langid"];
                    $configData["langid"] = $soap_langid;
                }

                $ret = file_put_contents($this->_configPath.$this->_configFileName, serialize($configData));

                $tpl = cSmartyFrontend::getInstance();
                if($ret === false) {
					$tpl->assign("ERROR_MESSAGE", i18n("config is not writable check permissions", "oxidcms"));
                } else {
                	$tpl->assign("SUCCESS_MESSAGE", i18n("config successfully saved", "oxidcms"));
                }

                $fileContent = unserialize(file_get_contents($this->_configPath.$this->_configFileName));
                if(is_array($fileContent) && count($fileContent) > 0) {
                	foreach ($fileContent as $key => $content) {
                		$cfg['soap'][$key] = $content;
                	}
                }

        }
    }

    /**
     * Render page form and assign data
     *
     */
    public function renderForm() {
        $tpl = cSmartyFrontend::getInstance();

        global $cfg;

        $form_action = array(
            'area=oxidcms',
            'frame=4',
            'contenido=' . cRegistry::getBackendSessionId(),
            'action=save'
        );

        $tpl->assign("LABEL_CONFIGURATION", i18n("OXIDCMS Configuration", "oxidcms"));
        $tpl->assign("LABEL_SHOP_USERNAME", i18n("Shop username", "oxidcms"));
        $tpl->assign("LABEL_SHOP_PASSWORD", i18n("Shop password", "oxidcms"));
        $tpl->assign("LABEL_SHOP_ID", i18n("Shop ID", "oxidcms"));
        $tpl->assign("LABEL_LANGUAGE_ID", i18n("Language ID", "oxidcms"));

        $tpl->assign("add_spec_icon", $cfg['path']['images'] . 'submit.gif');
        $tpl->assign("add_to_form", $cfg['path']['images'] . 'but_ok.gif');
        $tpl->assign("submit_btn", $cfg['path']['images'] . 'but_ok.gif');
        $tpl->assign("form_action", 'main.php?' . implode('&', $form_action));

        $tpl->assign("oxidcms_uname", $cfg['soap']['username']);
        $tpl->assign("oxidcms_pw", $cfg['soap']['password']);
        $tpl->assign("oxidcms_shopid", $cfg['soap']['shopid']);
        $tpl->assign("oxidcms_langid", $cfg['soap']['langid']);

        echo $tpl->fetch($cfg['templates']['oxidcms_right_bottom']);

    }


}
?>
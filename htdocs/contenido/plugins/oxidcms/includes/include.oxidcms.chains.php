<?php

// assert CONTENIDO framework
defined('CON_FRAMEWORK') or die('Illegal call');

/**
 * Oxidcms chains class
 *
 */
class OxidcmsChains {

    /**
     * Adds Oxidcms specific chain functions to CEC registry.
     */
    public function __construct() {
        $cecRegistry = cRegistry::getCecRegistry();
        $cecRegistry->addChainFunction('Contenido.Frontend.HTMLCodeOutput', 'OxidcmsChains::replaceHTMLCodeOutput');
    }

    /**
     * Replace cached title tag before code output
     *
     * @param string $htmlCode
     * @return string $htmlCode
     */
    public static function replaceHTMLCodeOutput($htmlCode)
    {
        $tpl = cSmartyFrontend::getInstance();
        global $cfg;

        $pluginPath = cRegistry::getBackendUrl() . $cfg['path']['plugins'] . 'oxidcms/';
        $tpl->assign("pluginPath", $pluginPath);

        if (strpos($htmlCode, 'class="articleid"')) {

            // get image element
            $matches = array();
            $result = preg_match_all('/<img(.*?)\s*class="articleid"[^>]*>/', $htmlCode, $matches, PREG_OFFSET_CAPTURE);

            if (false !== $result) {
                foreach ($matches as $key => $match) {
                    foreach ($match as $ma) {
                        $img = $ma[0];
                        // get id as rel atribute
                        $matches_two = array();
                        if (false !== preg_match('/rel="([a-z0-9]{32})"/', $img, $matches_two)) {

                            $id = $matches_two[1];
                            $match_styles = array();
                            if (false !== preg_match('/title="(.*?)\s*"/', $img, $match_styles)) {
                                $styles = $match_styles[1];
                            } else {
                                $styles = "";
                            }


                            $artId = array();
                            $artId[0][0] = 'oxid';
                            $artId[0][1] = $id;

                            $aRet = Oxidcms_SoapClient::getInstance()->OXERPCallPlugin(array(
                                'sPluginName' => 'ffbgetproductbyartidplugin',
                                'aRequestData' => _soapEncodeERPType($artId)
                            ));
                            $data = array();

                            $data = unserialize($aRet->OXERPCallPluginResult->OXERPType->aResult->ArrayOfString->string[1]);

                            $tpl->assign("styles", $styles);
                            $tpl->assign("title", $data['title']);
                            $tpl->assign("price", $data['oxprice']);
                            $tpl->assign("thumb", $data["thumb"]);
                            $tpl->assign("currency", $data['currency']);
                            $tpl->assign("available", $data['available']);
                            $tpl->assign("stockstatus", $data['stockstatus']);

                            $shoplink = $data['tobasketlink'];
                            $shoplink = preg_replace('/force_sid=[0-9a-z]+&amp;?/', '', $shoplink);
                            $shoplink = preg_replace('/stoken=[0-9A-Z]+&amp;?/', '', $shoplink);
                            $shoplink = str_replace('cl=', 'cl=basket', $shoplink);
                            $shoplink .= '&amp;am=1';
                            $tpl->assign("tobasketlink", $shoplink);
                            $tpl->assign("link", $data['link']);
                            $tpl->assign("buyable", $data['buyable']);

                            $productOutput =  $tpl->fetch($cfg['templates']['oxidcms_product']);

                            $htmlCode = str_replace($img, $productOutput, $htmlCode);
                            //$htmlCode = print_r($data);

                        }
                    }
                }
            }
        }


        return $htmlCode;
    }
}

$chains = new OxidcmsChains();

?>
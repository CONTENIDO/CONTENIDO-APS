<?php
defined('CON_FRAMEWORK') or die('Illegal call');

?>
<!DOCTYPE html>

<!-- standard layout -->

<html lang="de">

    <head>

        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1" />

        <title><?php
$cCurrentModule = 10;
$cCurrentContainer = 10;
?><?php
 $breadcrumb = array(); $helper = cCategoryHelper::getInstance(); foreach ($helper->getCategoryPath(cRegistry::getCategoryId(), 1) as $categoryLang) { $breadcrumb[] = $categoryLang->get('name'); } $article = new cApiArticleLanguage(); $article->loadByArticleAndLanguageId(cRegistry::getArticleId(), cRegistry::getLanguageId()); $headline = strip_tags($article->getContent('CMS_HTMLHEAD', 1)); if ($headline != '') { $breadcrumb[] = $headline; } if ($headline === '') { $breadcrumb[] = conHtmlSpecialChars(mi18n("STARTPAGE")); } array_shift($breadcrumb); if (count($breadcrumb) > 0) { echo implode(' - ', $breadcrumb); } ?></title><link rel="stylesheet" type="text/css" href="//conclaus-git.local/cms/cache/standard_social_facebook.css" id="m8" />

        <link rel="stylesheet" type="text/css" href="css/reset.css" />
        <link rel="stylesheet" type="text/css" href="css/main.css" />
        <link rel="stylesheet" type="text/css" href="css/media.css" />
        <link rel="stylesheet" type="text/css" href="css/contenido_backend.css" />

        <!--[if IE 8]>
            <link type="text/css" rel="stylesheet" href="css/ie_8.css" media="all" />
        <![endif]-->
        <script type="text/javascript" charset="utf-8" src="js/jquery-1.8.2.min.js"></script>
    <meta name="generator" content="CMS CONTENIDO 4.9" />
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
<meta name="author" content="Systemadministrator" />
<meta name="description" content="Facebook" />
<meta name="keywords" content="contenido, facebook, einfach, embedded-content-url, angezeigt, einbetten, nutzerbeiträgen, facebook-content, contenido-seite, öffentlichkeit, modul, feature, öffentlichen, (like-button)" />
</head>

    <body>

        <div id="page">

            <div id="header">
                <?php
$cCurrentModule = 33;
$cCurrentContainer = 205;
?><?php
 $clientConfig = cRegistry::getClientConfig(cRegistry::getClientId()); $tpl = cSmartyFrontend::getInstance(); $tpl->assign('href', $clientConfig['path']['htmlpath']); $tpl->display('get.tpl'); ?>
                <ul id="navigation_header">
                    <li class="lang_changer">
                        <?php
$cCurrentModule = 0;
$cCurrentContainer = 211;
?>
                    </li>
                    <li>
                        <?php
$cCurrentModule = 26;
$cCurrentContainer = 212;
?><?php
 defined('CON_FRAMEWORK') || die('Illegal call: Missing framework initialization - request aborted.'); $rootIdcat = getEffectiveSetting('navigation_top', 'idcat', 1); $depth = getEffectiveSetting('navigation_top', 'depth', 3); $categoryHelper = cCategoryHelper::getInstance(); $categoryHelper->setAuth(cRegistry::getAuth()); $tree = $categoryHelper->getSubCategories($rootIdcat, $depth); if (!function_exists("navigation_top_filter")) { function navigation_top_filter(cApiCategoryLanguage $categoryLanguage) { return $categoryLanguage->get('idcat'); } } $path = array_map('navigation_top_filter', $categoryHelper->getCategoryPath(cRegistry::getCategoryId(), 1)); $tpl = cSmartyFrontend::getInstance(); $tpl->assign('tree', $tree); $tpl->assign('path', $path); $tpl->display('get.tpl'); ?>
                    </li>
                    <li>
                        <?php
$cCurrentModule = 25;
$cCurrentContainer = 213;
?><?php
 defined('CON_FRAMEWORK') || die('Illegal call: Missing framework initialization - request aborted.'); $searchResultIdart = getEffectiveSetting('navigation_searchform_top', 'search_result_idart'); $searchResultIdart = cSecurity::toInteger($searchResultIdart); $isModRewriteEnabled = class_exists('ModRewrite') && ModRewrite::isEnabled(); $action = $method = $label = $submit = ''; if (0 < $searchResultIdart) { if ($isModRewriteEnabled) { $action = cUri::getInstance()->build(array( 'idart' => $searchResultIdart, 'lang' => cRegistry::getLanguageId() )); } else { $action = 'front_content.php'; } $method = 'GET'; $label = mi18n("NAVIGATION_SEARCHFORM_TOP_LABEL"); if (false !== strpos($label, 'Module translation not found: ')) { $label = ''; } $submit = mi18n("NAVIGATION_SEARCHFORM_TOP_SUBMIT"); if (false !== strpos($submit, 'Module translation not found: ')) { $submit = ''; } } $tpl = cSmartyFrontend::getInstance(); $tpl->assign('action', $action); $tpl->assign('method', $method); $tpl->assign('label', $label); $tpl->assign('submit', $submit); if (!$isModRewriteEnabled) { $tpl->assign('idart', $searchResultIdart); $tpl->assign('idlang', cRegistry::getLanguageId()); } $tpl->display('get.tpl'); ?>
                    </li>
                </ul>
            </div>

            <div id="breadcrumb">
                <?php
$cCurrentModule = 14;
$cCurrentContainer = 90;
?><?php
 $categoryHelper = cCategoryHelper::getInstance(); $categoryHelper->setAuth(cRegistry::getAuth()); $categories = $categoryHelper->getCategoryPath(cRegistry::getCategoryId(), 1); $breadcrumb = array(); foreach ($categories as $categoryLang) { $breadcrumb[] = $categoryLang; } array_shift($breadcrumb); $headline = ''; $smarty = cSmartyFrontend::getInstance(); $smarty->assign('label_breadcrumb', mi18n("LABEL_BREADCRUMB")); $smarty->assign('breadcrumb', $breadcrumb); $smarty->assign('headline', $headline); $smarty->display('get.tpl'); ?>
            </div>

            <div id="menu">
                <?php
$cCurrentModule = 8;
$cCurrentContainer = 100;
?><?php
 defined('CON_FRAMEWORK') || die('Illegal call: Missing framework initialization - request aborted.'); $rootIdcat = getEffectiveSetting('navigation_main', 'idcat', 1); $depth = getEffectiveSetting('navigation_main', 'depth', 3); $categoryHelper = cCategoryHelper::getInstance(); $categoryHelper->setAuth(cRegistry::getAuth()); $tree = $categoryHelper->getSubCategories($rootIdcat, $depth); $filter = create_function('cApiCategoryLanguage $item', 'return $item->get(\'idcat\');'); $path = array_map($filter, $categoryHelper->getCategoryPath(cRegistry::getCategoryId(), 1)); $smarty = cSmartyFrontend::getInstance(); $smarty->assign('ulId', 'navigation'); $smarty->assign('tree', $tree); $smarty->assign('path', $path); $smarty->display('get.tpl'); ?>
            </div>

            <div id="content">
                <!--start:content-->
                <?php
$cCurrentModule = 1;
$cCurrentContainer = 110;
?><?php
 defined('CON_FRAMEWORK') || die('Illegal call: Missing framework initialization - request aborted.'); $header = "<p>Facebook</p>"; if (cRegistry::isBackendEditMode()) { $label = mi18n("LABEL_HEADER_FIRST"); } else { $label = NULL; $header = str_replace('&nbsp;', ' ', $header); $header = strip_tags($header); $header = trim($header); } $tpl = cSmartyFrontend::getInstance(); $tpl->assign('label', $label); $tpl->assign('header', $header); $tpl->display('get.tpl'); ?>
                <?php
$cCurrentModule = 2;
$cCurrentContainer = 120;
?><?php
 defined('CON_FRAMEWORK') || die('Illegal call: Missing framework initialization - request aborted.'); $header = ""; if (cRegistry::isBackendEditMode()) { $label = mi18n("LABEL_HEADER_SECOND"); } else { $label = NULL; $header = str_replace('&nbsp;', ' ', $header); $header = strip_tags($header); $header = trim($header); } $tpl = cSmartyFrontend::getInstance(); $tpl->assign('label', $label); $tpl->assign('header', $header); $tpl->display('get.tpl'); ?>
                <?php
$cCurrentModule = 4;
$cCurrentContainer = 130;
?><?php
 defined('CON_FRAMEWORK') || die('Illegal call: Missing framework initialization - request aborted.'); $text = "<p>CONTENIDOs Facebook Modul unterst&uuml;tzt den normalen \"Like\" Button und die gr&ouml;&szlig;eren Like Boxen.</p>
<p>Sie k&ouml;nnen einstellen, ob ein einfacher Z&auml;hler f&uuml;r die Likes angezeigt wird (Like-Button), oder, wie unten zu sehen, die Profile der Benutzer angezeigt werden sollen (Like-Box).</p>
<p>Der Like Button zeigt automatisch auf den aktuellen Artikel, um Ihren Besuchern eine einfach M&ouml;glichkeit zu bieten, Feedback &uuml;ber Ihren Content zu geben.</p>
<p>Auch das Einbetten von Facebook-Content in die eigene in CONTENIDO-Seite, ein neues Feature, das Facebook k&uuml;rzlich der &Ouml;ffentlichkeit vorstellte, kann nun einfach mit einem Modul realisert werden.</p>
<p>Das passende CONTENIDO Modul zum neuen Facebook Feature: F&uuml;r das Einbetten von &ouml;ffentlichen Postings und Nutzerbeitr&auml;gen, einfach die Embedded-Content-URL eintragen - fertig!</p>"; if (cRegistry::isBackendEditMode()) { $label = mi18n("LABEL_TEXT"); } else { $label = NULL; } $tpl = cSmartyFrontend::getInstance(); $tpl->assign('label', $label); $tpl->assign('text', $text); $tpl->display('get.tpl'); ?>
                <div class="teaser-text">
                    <?php
$cCurrentModule = 40;
$cCurrentContainer = 140;
?><?php
 $tpl = cSmartyFrontend::getInstance(); $urlLabel = mi18n("URL"); $pluginLabel = mi18n("PLUGIN"); $likeButtonLabel = mi18n("LIKE_BUTTON"); $likeBoxLabel = mi18n("LIKE_BOX"); $layoutLabel = mi18n("LAYOUT"); $standardLabel = mi18n("STANDARD"); $buttonCountLabel = mi18n("BUTTON_COUNT"); $boxCountLabel = mi18n("BOX_COUNT"); $showFacesLabel = mi18n("SHOW_FACES"); $widthLabel = mi18n("WIDTH"); $heightLabel = mi18n("HEIGHT"); $saveLabel = mi18n("SAVE"); $label_overview = mi18n("OVERVIEW_LABEL"); $automaticURLLabel = mi18n("AUTOMATIC_URL_LABEL"); $idartlang = cRegistry::getArticleLanguageId(); $idlang = cRegistry::getLanguageId(); $idclient = cRegistry::getClientId(); $art = new cApiArticleLanguage($idartlang); if (cRegistry::isBackendEditMode() && 'POST' === strtoupper($_SERVER['REQUEST_METHOD']) && $_POST['plugin_type'] == 'facebook') { conSaveContentEntry($idartlang, "CMS_HTML", 1000, $_POST['url']); conSaveContentEntry($idartlang, "CMS_HTML", 1001, $_POST['plugin']); conSaveContentEntry($idartlang, "CMS_HTML", 1002, $_POST['layout']); conSaveContentEntry($idartlang, "CMS_HTML", 1003, $_POST['faces']); conSaveContentEntry($idartlang, "CMS_HTML", 1004, $_POST['width']); conSaveContentEntry($idartlang, "CMS_HTML", 1005, $_POST['height']); conSaveContentEntry($idartlang, "CMS_HTML", 1006, $_POST['automaticURL']); } $url = $art->getContent("CMS_HTML", 1000); $pluginvalue = $art->getContent("CMS_HTML", 1001); $layoutvalue = $art->getContent("CMS_HTML", 1002); $facesvalue = $art->getContent("CMS_HTML", 1003); $width = $art->getContent("CMS_HTML", 1004); $height = $art->getContent("CMS_HTML", 1005); $useAutomaticURL = $art->getContent("CMS_HTML", 1006); if ($useAutomaticURL == "1") { $url = cRegistry::getFrontendUrl() . $art->getLink(); } if (cRegistry::isBackendEditMode()) { $tpl->assign('url', $url); $tpl->assign('pluginvalue', $pluginvalue); $tpl->assign('layoutvalue', $layoutvalue); $tpl->assign('facesvalue', $facesvalue); $tpl->assign('width', $width); $tpl->assign('height', $height); $tpl->assign('urlLabel', $urlLabel); $tpl->assign('pluginLabel', $pluginLabel); $tpl->assign('likeButtonLabel', $likeButtonLabel); $tpl->assign('likeBoxLabel', $likeBoxLabel); $tpl->assign('layoutLabel', $layoutLabel); $tpl->assign('standardLabel', $standardLabel); $tpl->assign('buttonCountLabel', $buttonCountLabel); $tpl->assign('boxCountLabel', $boxCountLabel); $tpl->assign('showFacesLabel', $showFacesLabel); $tpl->assign('widthLabel', $widthLabel); $tpl->assign('heightLabel', $heightLabel); $tpl->assign('save', $saveLabel); $tpl->assign('label_overview', $label_overview); $tpl->assign("automaticURLLabel", $automaticURLLabel); $tpl->assign("useAutomaticURL", $useAutomaticURL); $tpl->assign("autoUrlHelp", new cGuiBackendHelpbox(conHtmlSpecialChars(mi18n("AUTO_URL_HELP")))); $tpl->assign("likeButtonHelp", new cGuiBackendHelpbox(conHtmlSpecialChars(mi18n("LIKE_BUTTON_HELP")))); $tpl->assign("likeBoxHelp", new cGuiBackendHelpbox(conHtmlSpecialChars(mi18n("LIKE_BOX_HELP")))); $tpl->assign("standardHelp", new cGuiBackendHelpbox(conHtmlSpecialChars(mi18n("STANDARD_HELP")))); $tpl->assign("buttonCountHelp", new cGuiBackendHelpbox(conHtmlSpecialChars(mi18n("BUTTON_COUNT_HELP")))); $tpl->assign("boxCountHelp", new cGuiBackendHelpbox(conHtmlSpecialChars(mi18n("BOX_COUNT_HELP")))); $tpl->assign("showFacesHelp", new cGuiBackendHelpbox(conHtmlSpecialChars(mi18n("SHOW_FACES_HELP")))); $tpl->display('facebook_config_view.tpl'); } else { if ($url == '') { $url = 'http://facebook.com/cms.contenido'; } if ($pluginvalue == '') { $pluginvalue = 'like_box'; } cApiPropertyCollection::reset(); $propColl = new cApiPropertyCollection(); $propColl->changeClient($idclient); $language = $propColl->getValue('idlang', $idlang, 'language', 'code', ''); $country = $propColl->getValue('idlang', $idlang, 'country', 'code', ''); $locale = $language . '_' . strtoupper($country); if ($facesvalue != 'true') { $facesvalue = 'false'; } $tpl->assign('SHOW_FACES', $facesvalue); $tpl->assign('LOCALE', $locale); $tpl->assign('WIDTH', $width); $tpl->assign('HEIGHT', $height); $tpl->assign('LAYOUT', $layoutvalue); switch ($pluginvalue) { case 'like_button': $tpl->assign('URL', urlencode($url)); $tpl->display('facebook_like_button.tpl'); break; case 'like_box': $tpl->assign('URL', $url); $tpl->display('facebook_like_box.tpl'); break; default: $display = new cGuiNotification(); $display->displayMessageBox(cGuiNotification::LEVEL_ERROR, 'Please configure facebook plugin!'); } } ?>
                </div>
                <?php
$cCurrentModule = 45;
$cCurrentContainer = 150;
?><?php
 if (cRegistry::isBackendEditMode()) { $label = mi18n("LABEL_POST_URL"); $content = "<a id=\"m2\" class=\"link_list\" alt=\"\" title=\"\" target=\"\" href=\"https://www.facebook.com/cms.contenido/posts/567068046687531\">https://www.facebook.com/cms.contenido/posts/567068046687531</a>"; } else { $label = NULL; $url = "https://www.facebook.com/cms.contenido/posts/567068046687531"; if (in_array(getEffectiveSetting('fb-sdk', 'html5'), explode('|', '1|true|on'))) { $content = '<div class="fb-post" data-href="' . $url . '"></div>'; } else { $content = '<fb:post href="' . $url . '"></fb:post>'; } } $tpl = cSmartyFrontend::getInstance(); $tpl->assign('label', $label); $tpl->assign('content', $content); $tpl->display('get.tpl'); ?>
				<?php
$cCurrentModule = 6;
$cCurrentContainer = 160;
?><?php
 defined('CON_FRAMEWORK') || die('Illegal call: Missing framework initialization - request aborted.'); $date = ""; if (cRegistry::isBackendEditMode()) { $label = mi18n("LABEL_DATE"); } else { $label = NULL; } $tpl = cSmartyFrontend::getInstance(); $tpl->assign('label', $label); $tpl->assign('date', $date); $tpl->display('get.tpl'); ?>
                <?php
$cCurrentModule = 23;
$cCurrentContainer = 170;
?><?php
 defined('CON_FRAMEWORK') || die('Illegal call: Missing framework initialization - request aborted.'); $tpl = cSmartyFrontend::getInstance(); $tpl->assign('isBackendEditMode', cRegistry::isBackendEditMode()); $tpl->assign('label', mi18n("LABEL_TEASERIMAGE")); $tpl->assign('image', ""); $tpl->assign('editor', "<img id=\"m1\" src=\"\" alt=\"\" title=\"\" />"); $tpl->display('get.tpl'); ?>
                <?php
$cCurrentModule = 0;
$cCurrentContainer = 180;
?>
                <?php
$cCurrentModule = 0;
$cCurrentContainer = 190;
?>
                <?php
$cCurrentModule = 0;
$cCurrentContainer = 200;
?>
				<!--end:content-->
            </div>
            <div class="clear"></div>
            <div id="footer">
                <?php
$cCurrentModule = 7;
$cCurrentContainer = 210;
?><?php
 defined('CON_FRAMEWORK') || die('Illegal call: Missing framework initialization - request aborted.'); $collector = new cArticleCollector(array( 'idcat' => getEffectiveSetting('navigation_bottom', 'idcat', 1), 'start' => true, 'order' => 'sortsequence' )); $articles = array(); foreach ($collector as $article) { $articles[] = array( 'title' => $article->get('title'), 'url' => cUri::getInstance()->build(array( 'idart' => $article->get('idart'), 'lang' => cRegistry::getLanguageId() ), true) ); } $tpl = cSmartyFrontend::getInstance(); $tpl->assign('articles', $articles); $tpl->display('get.tpl'); ?>
                <?php
$cCurrentModule = 9;
$cCurrentContainer = 220;
?><?php
 defined('CON_FRAMEWORK') || die('Illegal call: Missing framework initialization - request aborted.'); $configIdart = getEffectiveSetting('footer_config', 'idart', 0); if (0 < $configIdart) { $article = new cApiArticleLanguage($configIdart, true); $url = array( 'rss' => $article->getContent('CMS_TEXT', 1), 'facebook' => $article->getContent('CMS_TEXT', 2), 'googleplus' => $article->getContent('CMS_TEXT', 3), 'twitter' => $article->getContent('CMS_TEXT', 4), 'xing' => $article->getContent('CMS_TEXT', 5) ); $tpl = cSmartyFrontend::getInstance(); $tpl->assign('url', $url); $tpl->display('get.tpl'); } ?>
            </div>

            <div id="copyright">
                <?php
$cCurrentModule = 17;
$cCurrentContainer = 230;
?><?php
 defined('CON_FRAMEWORK') || die('Illegal call: Missing framework initialization - request aborted.'); $configIdart = getEffectiveSetting('footer_config', 'idart', 0); if (0 < $configIdart) { $article = new cApiArticleLanguage($configIdart, true); $text = $article->getContent('CMS_HTML', 1); $text = str_replace('{year}', date('Y'), $text); $tpl = cSmartyFrontend::getInstance(); $tpl->assign('text', $text); $tpl->display('get.tpl'); } ?>
            </div>

        </div>

        <?php
$cCurrentModule = 46;
$cCurrentContainer = 300;
?><?php
 $settingType = 'fb-sdk'; $appId = getEffectiveSetting($settingType, 'app-id'); $idartChannel = getEffectiveSetting($settingType, 'idart-channel', 0); $idartChannel = cSecurity::toInteger($idartChannel); $channelUrl = ''; if (0 < $idartChannel) { $channelUrl = cUri::getInstance()->build(array( 'idart' => $idartChannel, 'lang' => cRegistry::getLanguageId() ), true); } $cookie = getEffectiveSetting($settingType, 'cookie'); $kidDirectedSite = getEffectiveSetting($settingType, 'kid-directed-site'); $locale = getEffectiveSetting($settingType, 'locale'); if (0 == strlen(trim($locale))) { cApiPropertyCollection::reset(); $propColl = new cApiPropertyCollection(); $propColl->changeClient(cRegistry::getClientId()); $languageCode = $propColl->getValue('idlang', cRegistry::getLanguageId(), 'language', 'code', ''); $countryCode = $propColl->getValue('idlang', cRegistry::getLanguageId(), 'country', 'code', ''); $locale = $languageCode . '_' . strtoupper($countryCode); } if (0 == strlen(trim($locale))) { $locale = 'en_US'; } $status = getEffectiveSetting($settingType, 'status'); $template = getEffectiveSetting($settingType, 'template', 'async'); $xfbml = getEffectiveSetting($settingType, 'xfbml'); $tpl = cSmartyFrontend::getInstance(); $tpl->assign('appId', $appId); $tpl->assign('channelUrl', $channelUrl); $tpl->assign('cookie', $cookie); $tpl->assign('kidDirectedSite', $kidDirectedSite); $tpl->assign('locale', $locale); $tpl->assign('status', $status); $tpl->assign('xfbml', $xfbml); $tpl->display($template . '.tpl'); ?>
        <?php
$cCurrentModule = 12;
$cCurrentContainer = 310;
?><?php
 $account = getEffectiveSetting('stats', 'ga_account', ''); if (0 < strlen(trim($account)) && cRegistry::isTrackingAllowed() && !cRegistry::isBackendEditMode()) { $tpl = cSmartyFrontend::getInstance(); $tpl->assign('account', $account); $tpl->display('get.tpl'); } ?>
        <?php
$cCurrentModule = 13;
$cCurrentContainer = 320;
?><?php
 $url = getEffectiveSetting('stats', 'piwik_url', ''); $site = getEffectiveSetting('stats', 'piwik_site', ''); if (0 < strlen(trim($url)) && 0 < strlen(trim($site)) && cRegistry::isTrackingAllowed() && !cRegistry::isBackendEditMode()) { $tpl = cSmartyFrontend::getInstance(); $tpl->assign('url', $url); $tpl->assign('site', $site); $tpl->display('get.tpl'); } ?>
        <?php
$cCurrentModule = 38;
$cCurrentContainer = 999;
?><?php
 if (!$contenido) { $session = cRegistry::getSession(); if (array_key_exists('acceptCookie', $_GET)) { $allowCookie = $_GET['acceptCookie'] === '1'? 1 : 0; setcookie('allowCookie', $allowCookie); $session->register('allowCookie'); } elseif (array_key_exists('allowCookie', $_COOKIE)) { $allowCookie = $_COOKIE['allowCookie'] === '1'? 1 : 0; $session->register('allowCookie'); } if (!isset($allowCookie)) { $tpl = cSmartyFrontend::getInstance(); $tpl->assign('trans', array( 'title' => mi18n("TITLE"), 'infoText' => mi18n("INFOTEXT"), 'userInput' => mi18n("USERINPUT"), 'accept' => mi18n("ACCEPT"), 'decline' => mi18n("DECLINE") )); function script_cookie_directive_add_get_params($uri) { foreach($_GET as $getKey => $getValue) { if (strpos($uri, '?' . $getKey . '=') !== false || strpos($uri, '&' . $getKey . '=') !== false || strpos($uri, '&amp;' . $getKey . '=') !== false) { continue; } if (strpos($uri, '?') === false) { $uri .= '?'; } else { $uri .= '&amp;'; } $uri .= htmlentities($getKey) . '=' . htmlentities($getValue); } return $uri; } $acceptUrl = script_cookie_directive_add_get_params(cUri::getInstance()->build(array( 'idart' => cRegistry::getArticleId(), 'lang' => cRegistry::getLanguageId(), 'acceptCookie' => 1 ), true)); $tpl->assign('pageUrlAccept', $acceptUrl); $denyUrl = script_cookie_directive_add_get_params(cUri::getInstance()->build(array( 'idart' => cRegistry::getArticleId(), 'lang' => cRegistry::getLanguageId(), 'acceptCookie' => 0 ), true)); $tpl->assign('pageUrlDeny', $denyUrl); $tpl->display('get.tpl'); } } ?>


        <script type="text/javascript" charset="utf-8" src="js/jquery-ui-1.9.1.custom.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="js/jquery.touchSwipe.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="js/main.js"></script>
        <script type="text/javascript" charset="utf-8" src="js/media.js"></script>
        <script type="text/javascript" charset="utf-8" src="js/jquery.validate.js"></script>

        <script type="text/javascript" charset="utf-8" src="js/velocity.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="js/velocity.ui.min.js"></script>

        <script type="text/javascript" charset="utf-8" src="js/respond.min.js"></script>
    <script src="//conclaus-git.local/cms/cache/standard_social_facebook.js" type="text/javascript"></script></body>

</html>
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
 $breadcrumb = array(); $helper = cCategoryHelper::getInstance(); foreach ($helper->getCategoryPath(cRegistry::getCategoryId(), 1) as $categoryLang) { $breadcrumb[] = $categoryLang->get('name'); } $article = new cApiArticleLanguage(); $article->loadByArticleAndLanguageId(cRegistry::getArticleId(), cRegistry::getLanguageId()); $headline = strip_tags($article->getContent('CMS_HTMLHEAD', 1)); if ($headline != '') { $breadcrumb[] = $headline; } if ($headline === '') { $breadcrumb[] = conHtmlSpecialChars(mi18n("STARTPAGE")); } array_shift($breadcrumb); if (count($breadcrumb) > 0) { echo implode(' - ', $breadcrumb); } ?></title><link rel="stylesheet" type="text/css" href="//conclaus-git.local/cms/cache/content_contact.css" id="m19" />

        <link rel="stylesheet" type="text/css" href="css/reset.css" />
        <link rel="stylesheet" type="text/css" href="css/main.css" />
        <link rel="stylesheet" type="text/css" href="css/media.css" />
        <link rel="stylesheet" type="text/css" href="css/contenido_backend.css" />

        <!--[if IE 8]>
            <link type="text/css" rel="stylesheet" href="css/ie_8.css" media="all" />
        <![endif]-->

    <meta name="generator" content="CMS CONTENIDO 4.9" />
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
<meta name="author" content="Systemadministrator" />
<meta name="description" content="Kontakt" />
<meta name="keywords" content="info@contenidoorginternet, http//www4fbdenordring, 801082-0e-mail, offenbach, business, telefon, 63067, four, (0), for, 82b" />
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
$cCurrentModule = 24;
$cCurrentContainer = 211;
?><?php
 $catCollection = new cApiCategoryLanguageCollection(); $artCollection = new cApiArticleLanguageCollection(); $catArtCollection = new cApiCategoryArticleCollection(); $languageCollectionInstance = new cApiLanguageCollection(); $clientsLangInstance = new cApiClientLanguageCollection(); $languageInstance = new cApiLanguage(); $tpl = new cTemplate(); $nextLang = false; $selectedLang = NULL; $checkedCatArt = false; $idcatAuto = cRegistry::getCategoryId(); $artRetItem = NULL; $urlSet = false; $currentLanguage = NULL; $clientId = cRegistry::getClientId(); $clientsLangInstance->select("idclient= " . $clientId); $resultClientLangs = $clientsLangInstance->fetchArray('idlang', 'idlang'); foreach ($resultClientLangs as $clientLang) { $languageInstance->loadByMany(array( 'active' => '1', 'idlang' => $clientLang )); if ($languageInstance->get('idlang')) { $allLanguages[] = $languageInstance->get('idlang'); } $languageInstance = new cApiLanguage(); } if (empty($allLanguages)) { } else if (count($allLanguages) != 1) { $currentLanguage = cRegistry::getLanguageId(); foreach ($allLanguages as $langs) { if ($langs > $currentLanguage) { $langName = conHtmlSpecialChars($languageCollectionInstance->getLanguageName((int) $langs)); $tpl->set('s', 'label', $langName); $tpl->set('s', 'title', $langName); $selectedLang = $langs; $nextLang = true; break; } } if ($nextLang === false) { $languageName = conHtmlSpecialChars($languageCollectionInstance->getLanguageName(reset($allLanguages))); $tpl->set('s', 'label', $languageName); $tpl->set('s', 'title', $languageName); $selectedLang = reset($allLanguages); } $catCheck = $catCollection->select("idcat = " . $idcatAuto . " AND " . " idlang = " . $selectedLang . " AND " . "startidartlang != 0", NULL, NULL, NULL); $catRetItem = new cApiCategoryLanguage(); $catRetItem->loadByCategoryIdAndLanguageId($idcatAuto, $selectedLang); if ($catCheck === true && $catRetItem) { $artRetItem = $artCollection->fetchById($catRetItem->get('startidartlang')); } if ($artRetItem) { if ($artRetItem->get('online') == 1 && $artRetItem->get('locked') == 0) { $checkedCatArt = true; } } if ($checkedCatArt === true) { $url = $catRetItem->getLink($selectedLang); } else { $config = cRegistry::getClientConfig(cRegistry::getClientId()); $url = cRegistry::getFrontendUrl() . 'front_content.php?idart='.$idart.'&changelang=' . $selectedLang; } $tpl->set('s', 'url', conHtmlSpecialChars($url)); $tpl->generate('get.html'); } ?>
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
 defined('CON_FRAMEWORK') || die('Illegal call: Missing framework initialization - request aborted.'); $header = "<p>Kontakt</p>"; if (cRegistry::isBackendEditMode()) { $label = mi18n("LABEL_HEADER_FIRST"); } else { $label = NULL; $header = str_replace('&nbsp;', ' ', $header); $header = strip_tags($header); $header = trim($header); } $tpl = cSmartyFrontend::getInstance(); $tpl->assign('label', $label); $tpl->assign('header', $header); $tpl->display('get.tpl'); ?>
                <?php
$cCurrentModule = 2;
$cCurrentContainer = 120;
?><?php
 defined('CON_FRAMEWORK') || die('Illegal call: Missing framework initialization - request aborted.'); $header = ""; if (cRegistry::isBackendEditMode()) { $label = mi18n("LABEL_HEADER_SECOND"); } else { $label = NULL; $header = str_replace('&nbsp;', ' ', $header); $header = strip_tags($header); $header = trim($header); } $tpl = cSmartyFrontend::getInstance(); $tpl->assign('label', $label); $tpl->assign('header', $header); $tpl->display('get.tpl'); ?>
                <?php
$cCurrentModule = 5;
$cCurrentContainer = 130;
?><?php
 defined('CON_FRAMEWORK') || die('Illegal call: Missing framework initialization - request aborted.'); $imageSource = ""; $imageDescription = ""; if (cRegistry::isBackendEditMode()) { $imageEditor = "<img id=\"m13\" src=\"\" alt=\"\" title=\"\" />"; } if (0 < strlen($imageSource)) { $clientConfig = cRegistry::getClientConfig(cRegistry::getClientId()); $filename = str_replace($clientConfig["upl"]["htmlpath"], $clientConfig["upl"]["path"], $imageSource); list($imageWidth, $imageHeight) = getimagesize($filename); $image = new stdClass(); $image->src = $imageSource; $image->alt = $imageDescription; $image->width = $imageWidth; $image->height = $imageHeight; } else { $image = NULL; } if (cRegistry::isBackendEditMode()) { $label = mi18n("LABEL_IMAGE"); } else { $label = NULL; } $tpl = cSmartyFrontend::getInstance(); $tpl->assign('label', $label); $tpl->assign('editor', $imageEditor); $tpl->assign('image', $image); $tpl->display('get.tpl'); ?>
                <div class="teaser-text">
                    <?php
$cCurrentModule = 4;
$cCurrentContainer = 140;
?><?php
 defined('CON_FRAMEWORK') || die('Illegal call: Missing framework initialization - request aborted.'); $text = ""; if (cRegistry::isBackendEditMode()) { $label = mi18n("LABEL_TEXT"); } else { $label = NULL; } $tpl = cSmartyFrontend::getInstance(); $tpl->assign('label', $label); $tpl->assign('text', $text); $tpl->display('get.tpl'); ?>
                </div>
                <?php
$cCurrentModule = 6;
$cCurrentContainer = 150;
?><?php
 defined('CON_FRAMEWORK') || die('Illegal call: Missing framework initialization - request aborted.'); $date = ""; if (cRegistry::isBackendEditMode()) { $label = mi18n("LABEL_DATE"); } else { $label = NULL; } $tpl = cSmartyFrontend::getInstance(); $tpl->assign('label', $label); $tpl->assign('date', $date); $tpl->display('get.tpl'); ?>
				<?php
$cCurrentModule = 27;
$cCurrentContainer = 160;
?><?php
 $tpl = cSmartyFrontend::getInstance(); $tpl->assign('isBackendEditMode', cRegistry::isBackendEditMode()); $tpl->assign('trans', array( 'header' => mi18n("HEADER"), 'address' => mi18n("ADDRESS"), 'latitude' => mi18n("LATITUDE"), 'longitude' => mi18n("LONGITUDE"), 'markerTitle' => mi18n("MARKER_TITLE"), 'wayDescription' => mi18n("WAY_DESCRIPTION") )); $tpl->assign('header', "<p>Der Weg zu four for business:</p>
<p></p>"); $tpl->assign('address', "<div>
<p><span style=\"font-size: xx-small;\"><strong>four for business AG</strong></span></p>
<p><span style=\"font-size: xx-small;\">Telefon:  49 (0) 69 801082-0<br />E-Mail: info@contenido.org<br />Internet: http://www.4fb.de<br />Nordring 82B 63067 Offenbach</span></p>
</div>"); $tpl->assign('lat', "50.1122129"); $tpl->assign('lng', "8.747967700000004"); $tpl->assign('markerTitle', "<div>
<p><strong>four for business AG</strong></p>
<p>Nordring 82B<br />63067 Offenbach</p>
<p>Telefon:  49 (0) 69 801082-0<br />E-Mail: info@contenido.org<br />Internet: http://www.4fb.de</p>
</div>"); $tpl->assign('way', "<div>
<h1><span style=\"color: #007abe;\">Wie Sie uns finden</span></h1>
<p><img src=\"images/spacer.gif\" border=\"0\" alt=\"\" width=\"1\" height=\"10\" /></p>
<h2>mit dem Auto oder der Bahn.</h2>
<p><img src=\"images/spacer.gif\" border=\"0\" alt=\"\" width=\"1\" height=\"10\" /></p>
<p>Ab dem 01. Juni 2008 erreichen Sie uns</p>
<div>&nbsp;</div>
<div>per Auto von Frankfurt:</div>
<div>&nbsp;</div>
<div>Von der Hanauer Landstrasse oder dem Riederwald auf die A661 fahren Richtung Offenbach. Ausfahrt Offenbach-Kaiserlei nehmen und im Kreisel die vierte Ausfahrt Richtung Hafen / Messe / Heyne Fabrik fahren.&nbsp;An der ersten Kreuzung nach links abbiegen und dem Strassenverlauf folgen. Auf dem Nordring an der Lilistrasse (rechte Seite vorbeifahren) und danach in das zweite Tor einbiegen. Im Hof der Heyne Fabrik finden Sie gleich links einen kleinen Platz, mit dem Eingang (Haus 4) zur 82 B.</div>
<div>&nbsp;</div>
<div>per Auto von K&ouml;ln / W&uuml;rzburg:</div>
<div>&nbsp;</div>
<div>Von der A3 auf die A661 Richtung Frankfurt/Offenbach.</div>
<div>Ausfahrt Offenbach-Kaiserlei, nach der Ausfahrt im Kreisel die zweite Strasse rechts ab und dann der Beschreibung 'Von Frankfurt' folgen.&nbsp;
<div>&nbsp;</div>
</div>
<div>&nbsp;</div>
<div>per Bahn von Frankfurt Hauptbahnhof:</div>
<div>&nbsp;</div>
<div>Ab Frankfurt Hauptbahnhof tief Gleis 102 mit der S-Bahn Linie S1 bis zur Haltestelle Offenbach Ledermuseum. Danach laufen Sie die Lilistra&szlig;e Richtung Main und biegen dann rechts ab auf den Nordring. Durch die zweite gro&szlig;e Toreinfahrt kommen sie zur Heyne Fabrik. Im Hof finden Sie gleich links einen kleinen Platz mit dem Eingang (Haus 4) zur 82 B.</div>
<div>&nbsp;</div>
<div>Wir w&uuml;nschen Ihnen eine gute Fahrt.</div>
</div>"); $tpl->display('get.tpl'); ?>
                <?php
$cCurrentModule = 37;
$cCurrentContainer = 170;
?><?php
 mi18n("REPLY_HEADLINE"); mi18n("REPLY_TEXT"); if (cRegistry::isBackendEditMode()) { echo '<label class="content_type_label">' . conHtmlSpecialChars(mi18n("LABEL_FORM_CONTACT")) . '</label>'; } echo "";?><?php $form = new cContentTypePifaForm('<?xml version="1.0" encoding="utf-8"?>
<pifaform><idform>1</idform><module>DefaultFormModule</module><processor>MailedFormProcessor</processor><template_get>cms_pifaform_default_get.tpl</template_get><template_post>cms_pifaform_default_post.tpl</template_post><mail_client_template>cms_pifaform_default_mail_client.tpl</mail_client_template><mail_client_from_email>info@contenido.org</mail_client_from_email><mail_client_from_name>CONTENIDO</mail_client_from_name><mail_client_subject>Kontakt Benutzermail</mail_client_subject><mail_system_template>cms_pifaform_default_mail_system.tpl</mail_system_template><mail_system_from_email>info@contenido.org</mail_system_from_email><mail_system_from_name>CONTENIDO</mail_system_from_name><mail_system_recipient_email>info@contenido.org</mail_system_recipient_email><mail_system_subject>Kontakt Systemmail</mail_system_subject></pifaform>
', 1, array()); echo $form->buildCode(); ?><?php echo ""; ?>
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

        <script type="text/javascript" charset="utf-8" src="js/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="js/jquery-ui-1.9.1.custom.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="js/jquery.touchSwipe.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="js/main.js"></script>
        <script type="text/javascript" charset="utf-8" src="js/media.js"></script>
        <script type="text/javascript" charset="utf-8" src="js/jquery.validate.js"></script>

        <script type="text/javascript" charset="utf-8" src="js/velocity.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="js/velocity.ui.min.js"></script>

        <script type="text/javascript" charset="utf-8" src="js/respond.min.js"></script>
    <script src="//conclaus-git.local/cms/cache/content_contact.js" type="text/javascript"></script></body>

</html>
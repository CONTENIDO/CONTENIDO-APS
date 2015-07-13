<?php
defined('CON_FRAMEWORK') or die('Illegal call');

?>
<!DOCTYPE html>

<!-- start page layout -->

<html lang="de">

    <head>

        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1" />

        <title><?php
$cCurrentModule = 10;
$cCurrentContainer = 10;
?><?php
 $breadcrumb = array(); $helper = cCategoryHelper::getInstance(); foreach ($helper->getCategoryPath(cRegistry::getCategoryId(), 1) as $categoryLang) { $breadcrumb[] = $categoryLang->get('name'); } $article = new cApiArticleLanguage(); $article->loadByArticleAndLanguageId(cRegistry::getArticleId(), cRegistry::getLanguageId()); $headline = strip_tags($article->getContent('CMS_HTMLHEAD', 1)); if ($headline != '') { $breadcrumb[] = $headline; } if ($headline === '') { $breadcrumb[] = conHtmlSpecialChars(mi18n("STARTPAGE")); } array_shift($breadcrumb); if (count($breadcrumb) > 0) { echo implode(' - ', $breadcrumb); } ?></title><link rel="stylesheet" type="text/css" href="//conclaus-git.local/cms/cache/start_page.css" id="m6" />

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
<meta name="description" content="" />
<meta name="keywords" content="" />
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

            <div id="menu" class="hide_desktop">
                <?php
$cCurrentModule = 8;
$cCurrentContainer = 900;
?><?php
 defined('CON_FRAMEWORK') || die('Illegal call: Missing framework initialization - request aborted.'); $rootIdcat = getEffectiveSetting('navigation_main', 'idcat', 1); $depth = getEffectiveSetting('navigation_main', 'depth', 3); $categoryHelper = cCategoryHelper::getInstance(); $categoryHelper->setAuth(cRegistry::getAuth()); $tree = $categoryHelper->getSubCategories($rootIdcat, $depth); $filter = create_function('cApiCategoryLanguage $item', 'return $item->get(\'idcat\');'); $path = array_map($filter, $categoryHelper->getCategoryPath(cRegistry::getCategoryId(), 1)); $smarty = cSmartyFrontend::getInstance(); $smarty->assign('ulId', 'navigation'); $smarty->assign('tree', $tree); $smarty->assign('path', $path); $smarty->display('get.tpl'); ?>
            </div>

            <div id="content">
                <?php
$cCurrentModule = 20;
$cCurrentContainer = 100;
?><?php
 echo "";?><?php
                    $teaser = new cContentTypeTeaser('<?xml version="1.0" encoding="utf-8"?>
<teaser><title>Startseite</title><category></category><count>4</count><style>cms_teaser_slider.html</style><manual>true</manual><start>false</start><source_head>CMS_HTMLHEAD</source_head><source_head_count>1</source_head_count><source_text>CMS_HTMLHEAD</source_text><source_text_count>2</source_text_count><source_image>CMS_IMG</source_image><source_image_count>100</source_image_count><filter></filter><sort>creationdate</sort><sort_order>asc</sort_order><character_limit>120</character_limit><image_width>920</image_width><image_height>280</image_height><manual_art><array_value>13</array_value><array_value>46</array_value><array_value>24</array_value><array_value>55</array_value></manual_art><image_crop>false</image_crop><source_date>CMS_DATE</source_date><source_date_count>1</source_date_count></teaser>
', 1, array());

                    echo $teaser->generateTeaserCode();
                 ?><?php echo ""; mi18n("MORE"); ?>
                <?php
$cCurrentModule = 21;
$cCurrentContainer = 110;
?><?php
 echo "";?><?php
                    $teaser = new cContentTypeTeaser('<?xml version="1.0" encoding="utf-8"?>
<teaser><title></title><category></category><count>4</count><style>cms_teaser_image.html</style><manual>true</manual><start>false</start><source_head>CMS_HTMLHEAD</source_head><source_head_count>1</source_head_count><source_text>CMS_HTMLHEAD</source_text><source_text_count>2</source_text_count><source_image>CMS_IMG</source_image><source_image_count>100</source_image_count><filter></filter><sort>creationdate</sort><sort_order>asc</sort_order><character_limit>120</character_limit><image_width>215</image_width><image_height>110</image_height><manual_art><array_value>66</array_value><array_value>67</array_value><array_value>68</array_value><array_value>65</array_value></manual_art><image_crop>true</image_crop><source_date>CMS_DATE</source_date><source_date_count>1</source_date_count></teaser>
', 2, array());

                    echo $teaser->generateTeaserCode();
                 ?><?php echo ""; mi18n("MORE"); ?>
                <?php
$cCurrentModule = 22;
$cCurrentContainer = 120;
?><?php
 echo "";?><?php
                    $teaser = new cContentTypeTeaser('<?xml version="1.0" encoding="utf-8"?>
<teaser><title></title><category></category><count>6</count><style>cms_teaser_text.html</style><manual>true</manual><start>false</start><source_head>CMS_HTMLHEAD</source_head><source_head_count>1</source_head_count><source_text>CMS_HTMLHEAD</source_text><source_text_count>2</source_text_count><source_image>CMS_IMG</source_image><source_image_count>100</source_image_count><filter></filter><sort>creationdate</sort><sort_order>asc</sort_order><character_limit>120</character_limit><image_width>100</image_width><image_height>75</image_height><manual_art><array_value>32</array_value><array_value>19</array_value><array_value>58</array_value><array_value>61</array_value></manual_art><image_crop>false</image_crop><source_date>CMS_DATE</source_date><source_date_count>1</source_date_count></teaser>
', 3, array());

                    echo $teaser->generateTeaserCode();
                 ?><?php echo ""; mi18n("MORE"); ?>
            </div>
            <div class="clear" ></div>
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

        <script type="text/javascript" charset="utf-8" src="js/respond.min.js"></script>
    <script src="//conclaus-git.local/cms/cache/start_page.js" type="text/javascript"></script></body>

</html>
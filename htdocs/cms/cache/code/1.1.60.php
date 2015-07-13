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
 $breadcrumb = array(); $helper = cCategoryHelper::getInstance(); foreach ($helper->getCategoryPath(cRegistry::getCategoryId(), 1) as $categoryLang) { $breadcrumb[] = $categoryLang->get('name'); } $article = new cApiArticleLanguage(); $article->loadByArticleAndLanguageId(cRegistry::getArticleId(), cRegistry::getLanguageId()); $headline = strip_tags($article->getContent('CMS_HTMLHEAD', 1)); if ($headline != '') { $breadcrumb[] = $headline; } if ($headline === '') { $breadcrumb[] = conHtmlSpecialChars(mi18n("STARTPAGE")); } array_shift($breadcrumb); if (count($breadcrumb) > 0) { echo implode(' - ', $breadcrumb); } ?></title><link rel="stylesheet" type="text/css" href="//conclaus-git.local/cms/cache/content_sitemap_html.css" id="m19" />

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
<meta name="description" content="Sitemap" />
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
 $catCollection = new cApiCategoryLanguageCollection(); $artCollection = new cApiArticleLanguageCollection(); $catArtCollection = new cApiCategoryArticleCollection(); $languageCollectionInstance = new cApiLanguageCollection(); $clientsLangInstance = new cApiClientLanguageCollection(); $languageInstance = new cApiLanguage(); $tpl = new cTemplate(); $nextLang = false; $selectedLang = NULL; $checkedCatArt = false; $idcatAuto = cRegistry::getCategoryId(); $artRetItem = NULL; $urlSet = false; $currentLanguage = NULL; $clientId = cRegistry::getClientId(); $clientsLangInstance->select("idclient= " . $clientId); $resultClientLangs = $clientsLangInstance->fetchArray('idlang', 'idlang'); foreach ($resultClientLangs as $clientLang) { $languageInstance->loadByMany(array( 'active' => '1', 'idlang' => $clientLang )); if ($languageInstance->get('idlang')) { $allLanguages[] = $languageInstance->get('idlang'); } $languageInstance = new cApiLanguage(); } if (empty($allLanguages)) { } else if (count($allLanguages) != 1) { $currentLanguage = cRegistry::getLanguageId(); foreach ($allLanguages as $langs) { if ($langs > $currentLanguage) { $langName = conHtmlSpecialChars($languageCollectionInstance->getLanguageName((int) $langs)); if ('' === trim($langName)) { $langName = mi18n("LANGUAGE_NAME_EMPTY"); } $tpl->set('s', 'label', $langName); $tpl->set('s', 'title', $langName); $selectedLang = $langs; $nextLang = true; break; } } if ($nextLang === false) { $languageName = conHtmlSpecialChars($languageCollectionInstance->getLanguageName(reset($allLanguages))); if ('' === trim($langName)) { $langName = mi18n("LANGUAGE_NAME_EMPTY"); } $tpl->set('s', 'label', $languageName); $tpl->set('s', 'title', $languageName); $selectedLang = reset($allLanguages); } $catCheck = $catCollection->select("idcat = " . $idcatAuto . " AND " . " idlang = " . $selectedLang . " AND " . "startidartlang != 0", NULL, NULL, NULL); $catRetItem = new cApiCategoryLanguage(); $catRetItem->loadByCategoryIdAndLanguageId($idcatAuto, $selectedLang); if ($catCheck === true && $catRetItem) { $artRetItem = $artCollection->fetchById($catRetItem->get('startidartlang')); } if ($artRetItem) { if ($artRetItem->get('online') == 1 && $artRetItem->get('locked') == 0) { $checkedCatArt = true; } } if ($checkedCatArt === true) { $url = $catRetItem->getLink($selectedLang); } else { $config = cRegistry::getClientConfig(cRegistry::getClientId()); $url = cRegistry::getFrontendUrl() . 'front_content.php?idart='.$idart.'&changelang=' . $selectedLang; } $tpl->set('s', 'url', conHtmlSpecialChars($url)); $tpl->generate('get.html'); } ?>
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
 defined('CON_FRAMEWORK') || die('Illegal call: Missing framework initialization - request aborted.'); $header = "<p>Sitemap</p>"; if (cRegistry::isBackendEditMode()) { $label = mi18n("LABEL_HEADER_FIRST"); } else { $label = NULL; $header = str_replace('&nbsp;', ' ', $header); $header = strip_tags($header); $header = trim($header); } $tpl = cSmartyFrontend::getInstance(); $tpl->assign('label', $label); $tpl->assign('header', $header); $tpl->display('get.tpl'); ?>
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
$cCurrentModule = 0;
$cCurrentContainer = 160;
?>
                <?php
$cCurrentModule = 28;
$cCurrentContainer = 170;
?><?php
 $client = cRegistry::getClientId(); $lang = cRegistry::getLanguageId(); $idart = cRegistry::getArticleId(); $art = new cApiArticleLanguage(); $art->loadByArticleAndLanguageId($idart, $lang); $content = $art->getContent('CMS_TEXT', 1); $level = $art->getContent('CMS_TEXT', 2); $article = $art->getContent('CMS_TEXT', 3); $tpl = cSmartyFrontend::getInstance(); $tpl->assign('isBackendEditMode', cRegistry::isBackendEditMode()); $tpl->assign('trans', array( 'headline' => mi18n("HEADLINE"), 'categoryLabel' => mi18n("CATEGORY_LABEL"), 'levelLabel' => mi18n("LEVEL_LABEL"), 'articleLabel' => mi18n("ARTICLE_LABEL"), 'articleHintLabel' => mi18n("ARTICLE_HINT_LABEL"), 'categoryHintLabel' => mi18n("GATEGORY_HINT_LABEL"), 'levelHintLabel' => mi18n("LEVEL_HINT_LABEL") )); $tpl->assign('category', "1"); $tpl->assign('level', "5"); $tpl->assign('article', "0"); $tpl->assign('first', false); if (false === is_numeric($content) || false === is_numeric($level)) { $tpl->assign('error', mi18n("NOT_NUMERIC_VALUE")); } else if ($article != 0 && $article != 1) { $tpl->assign('error', mi18n("NOT_ZERO_OR_ONE")); } else { $categoryHelper = cCategoryHelper::getInstance(); $categoryHelper->setAuth(cRegistry::getAuth()); $tree = $categoryHelper->getSubCategories($content, $level); if (1 == $article) { $tree = addArticlesToTree($tree); } $tpl->assign('tree', $tree); } $tpl->display('get.tpl'); function addArticlesToTree(array $tree) { $startidartlang = getStartIdArtLang(); foreach ($tree as $key => $wrapper) { $tree[$key]['articles'] = getArticlesFromCategory($wrapper['idcat'], $startidartlang); $tree[$key]['subcats'] = addArticlesToTree($tree[$key]['subcats']); } return $tree; } function getStartIdArtLang() { $cfg = cRegistry::getConfig(); $db = cRegistry::getDb(); $startidartlang = array(); $sql = 'SELECT startidartlang FROM  `' . $cfg['tab']['cat_lang'] . '` WHERE visible = 1 AND public = 1'; $ret = $db->query($sql); while ($db->next_record()) { $startidartlang[] = $db->f('startidartlang'); } return $startidartlang; } function getArticlesFromCategory($categoryId, $startidartlang) { $cfg = cRegistry::getConfig(); $db = cRegistry::getDb(); $sql = '-- getArticlesFromCategory()
        SELECT
            al.idartlang
            , UNIX_TIMESTAMP(al.lastmodified) AS lastmod
            , al.changefreq
            , al.sitemapprio
            , al.title
        FROM
            `' . $cfg['tab']['art_lang'] . '` AS al
            , `' . $cfg['tab']['cat_art'] . '` AS ca
        WHERE
            al.idart = ca.idart
            AND al.idlang = ' . cSecurity::toInteger(cRegistry::getLanguageId()) . '
            AND ca.idcat IN (' . $categoryId . ')
            AND al.online = 1
            AND al.searchable = 1
        ;'; $ret = $db->query($sql); $array = array(); if (false !== $ret) { while ($db->next_record()) { if (!in_array($db->f('idartlang'), $startidartlang)) { $article = new cApiArticleLanguage(); $article->loadByPrimaryKey($db->f('idartlang')); $array[] = $article; } } } return $array; } ?>
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
 if (!$contenido) { $session = cRegistry::getSession(); if (array_key_exists('acceptCookie', $_GET)) { $allowCookie = $_GET['acceptCookie'] === '1'? 1 : 0; setcookie('allowCookie', $allowCookie); $session->register('allowCookie'); } elseif (array_key_exists('allowCookie', $_COOKIE)) { $allowCookie = $_COOKIE['allowCookie'] === '1'? 1 : 0; $session->register('allowCookie'); } if (!isset($allowCookie)) { $tpl = cSmartyFrontend::getInstance(); $tpl->assign('trans', array( 'title' => mi18n("TITLE"), 'infoText' => mi18n("INFOTEXT"), 'userInput' => mi18n("USERINPUT"), 'accept' => mi18n("ACCEPT"), 'decline' => mi18n("DECLINE") )); function script_cookie_directive_add_get_params($uri) { foreach($_GET as $getKey => $getValue) { if (strpos($uri, '?' . $getKey . '=') !== false || strpos($uri, '&' . $getKey . '=') !== false) { continue; } if (strpos($uri, '?') === false) { $uri .= '?'; } else { $uri .= '&'; } $uri .= htmlentities($getKey) . '=' . htmlentities($getValue); } return $uri; } $acceptUrl = script_cookie_directive_add_get_params(cUri::getInstance()->build(array( 'idart' => cRegistry::getArticleId(), 'lang' => cRegistry::getLanguageId(), 'acceptCookie' => 1 ), true)); $tpl->assign('pageUrlAccept', $acceptUrl); $denyUrl = script_cookie_directive_add_get_params(cUri::getInstance()->build(array( 'idart' => cRegistry::getArticleId(), 'lang' => cRegistry::getLanguageId(), 'acceptCookie' => 0 ), true)); $tpl->assign('pageUrlDeny', $denyUrl); $tpl->display('get.tpl'); } } ?>

        <script type="text/javascript" charset="utf-8" src="js/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="js/jquery-ui-1.9.1.custom.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="js/jquery.touchSwipe.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="js/main.js"></script>
        <script type="text/javascript" charset="utf-8" src="js/media.js"></script>
        <script type="text/javascript" charset="utf-8" src="js/jquery.validate.js"></script>

        <script type="text/javascript" charset="utf-8" src="js/velocity.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="js/velocity.ui.min.js"></script>

        <script type="text/javascript" charset="utf-8" src="js/respond.min.js"></script>
    <script src="//conclaus-git.local/cms/cache/content_sitemap_html.js" type="text/javascript"></script></body>

</html>
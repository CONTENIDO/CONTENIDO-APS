<?php

/**
 * Gets oxidcms soap helper
 * 
 * @return ContenidoSoapHelper
 */
function ffb_oxidcms_getSoapHelper() {
    $clientId = cRegistry::getClientId();
    $langId = cRegistry::getLanguageId();
    $clientCfg = cRegistry::getClientConfig($clientId);
    $config = cRegistry::getConfig();

    return new ContenidoSoapHelper($clientId, $langId, $clientCfg, $config);
}

/**
 * Gets oxidcms link
 * 
 * @param unknown $link
 * @return NULL|Ambigous <multitype:, string>
 */
function ffb_oxidcms_getLink($link) {
    if ($link == '') {
        return NULL;
    }

    $linkEditor = new cContentTypeLinkeditor($link, 0, array());
    $linkData = $linkEditor->getConfiguredData();
    return $linkData['href'];
}

/**
 * Push blog entry
 * 
 * @param unknown $categoryId
 * @param cApiArticleLanguage $art
 * @param unknown $articles
 */
function ffb_oxidcms_pushBlogEntry($categoryId, cApiArticleLanguage $art, &$articles) {
    $timestamp = strtotime($art->get("published"));
    if ($timestamp == 0) {
        return;
    }

    if (isset($articles[$timestamp])) {
        $timestamp = $timestamp + rand(10, 100);
        if (isset($articles[$timestamp])) {
            $timestamp = $timestamp + rand(10, 100);
        }
    }

    $articles[$timestamp] = array(
        $categoryId,
        $art
    );
}

/**
 * Get comment count
 * 
 * @param unknown $idart
 * @param unknown $idcat
 * @return number
 */
function ffb_oxidcms_getCommentsCount($idart, $idcat) {
    global $cfg, $lang;
    $db = cRegistry::getDb();

    $query = "SELECT * FROM pi_user_comments WHERE (idart = $idart) AND (idcat = $idcat) AND (idlang = $lang) ORDER BY timestamp DESC";

    $db->query($query);

    return $db->num_rows();
}

/**
 *
 * @param unknown $idart
 * @param unknown $idcat
 * @return multitype:NULL
 */
function ffb_oxidcms_getComments($idart, $idcat) {
    global $cfg, $lang;
    $db = cRegistry::getDb();

    $query = "SELECT * FROM pi_user_comments WHERE (idart = $idart) AND (idcat = $idcat) AND (idlang = $lang) ORDER BY timestamp DESC";

    $ret = $db->query($query);

    $array = array();
    if (false !== $ret) {
        while ($db->next_record()) {
            $array[] = $db->copyResultToArray();
        }
    }
    return $array;
}

/**
 * Replace character encode issues
 * 
 * @param string $text
 * @return mixed
 */
function ffb_chars_encode($text) {
    $text = str_replace('�', 'Ae', $text);
    $text = str_replace('�', 'ae', $text);

    $text = str_replace('�', 'Oe', $text);
    $text = str_replace('�', 'oe', $text);

    $text = str_replace('�', 'Ue', $text);
    $text = str_replace('�', 'ue', $text);

    $text = str_replace('�', 'ss', $text);

    return $text;
}

/**
 * Generates contact box
 * 
 * @param unknown $idart
 */
function ffb_generateContactBox($idart) {
    global $client, $lang, $cfgClient, $cfg;

    $art = new cApiArticleLanguage();
    $art->loadByArticleAndLanguageId($idart, $idlang, true);

    $overline = $art->getContent("CMS_TEXT", 400);
    $headline = $art->getContent("CMS_TEXT", 401);
    $text = $art->getContent("CMS_HTML", 402);
    $image = $art->getContent("CMS_IMG", 403);
    $imageDesc = $art->getContent("CMS_IMGDESCR", 403);

    $tpl->set('s', 'overline', $overline);
    $tpl->set('s', 'headline', $headline);
    $tpl->set('s', 'text', $text);

    $template = 'contact_box_picless.html';
    if ((int) $image > 0) {
        $soapHelper = ffb_kundl_getSoapHelper();

        $template = 'contact_box.html';

        $tpl->set('s', 'image', $soapHelper->getImageUrl($image, 220, 110));
        $tpl->set('s', 'imageDesc', $imageDesc);
    }

    $tpl->generate('templates/' . $template);
}

/**
 * Gets deeper categories
 * 
 * @param unknown $subcat
 * @param unknown $categories
 */
function ffb_getDeeperCategoryIds($subcat, &$categories) {
    if (count($subcat->getSubcategories()) > 0) {
        foreach ($subcat->getSubcategories() as $subcategory) {
            ffb_kundl_getDeeperCategoryIds($subcategory, $categories);
            $categories[] = $subcategory->getCategoryLanguage()->getIdCat();
        }
    }
}

/**
 *
 * @param unknown $categoryId
 * @param cApiArticleLanguage $art
 * @param unknown $yearSelect
 * @param unknown $authorSelect
 * @param unknown $articles
 * @param unknown $taskData
 */
function ffb_pushBlogEntry($categoryId, cApiArticleLanguage $art, $yearSelect, $authorSelect, &$articles, &$taskData) {
    $o2c_author = $taskData['o2c_author'];
    $o2c_year = $taskData['o2c_year'];

    $timestamp = strtotime(strip_tags($art->getContent("DATE", 205)));
    if ($timestamp == 0) {
        return;
    }

    $year = date('Y', $timestamp);
    if (!in_array($year, $taskData['years'])) {
        $years = $taskData['yearCount'] = $taskData['yearCount'] + 1;

        if ($year == $o2c_year) {
            $active = true;
        } else {
            $active = false;
        }

        $option = new cHTMLOptionElement($year, $year, $active);
        $yearSelect->addOptionElement($years, $option);
        $taskData['years'][] = $year;
    }

    $author = $art->getContent("TEXT", 206);
    if (!in_array($author, $taskData['authors'])) {
        $authors = $taskData['authorCount'] = $taskData['authorCount'] + 1;

        if ($author === $o2c_author) {
            $active = true;
        } else {
            $active = false;
        }

        $option = new cHTMLOptionElement($author, urlencode($author), $active);
        $authorSelect->addOptionElement($authors, $option);
        $taskData['authors'][] = $author;
    }

    // filter criteria
    $addToList = false;
    if ($o2c_year == 0 && $o2c_author === 0) {
        $addToList = true;
    }

    if ($o2c_year == 0 && $o2c_author !== 0 && $author === $o2c_author) {
        $addToList = true;
    }

    if ($o2c_year != 0 && $o2c_author === 0 && $year == $o2c_year) {
        $addToList = true;
    }

    if ($o2c_year != 0 && $o2c_author !== 0 && $author === $o2c_author && $year == $o2c_year) {
        $addToList = true;
    }

    if ($addToList == true) {
        if (isset($articles[$timestamp])) {
            $timestamp = $timestamp + rand(10, 100);
            if (isset($articles[$timestamp])) {
                $timestamp = $timestamp + rand(10, 100);
            }
        }

        $articles[$timestamp] = array(
            $categoryId,
            $art
        );
    }
}

/**
 *
 * @param unknown $aDataContainer
 * @return StdClass
 */
function _soapEncodeERPType($aDataContainer) {
    if (!is_array(reset($aDataContainer))) {
        $aDataContainer = array(
            $aDataContainer
        );
    }
    $aNewContainer = array();

    foreach ($aDataContainer as $iIdx => &$aData) {
        $aNewData = array();

        foreach ($aData as $sKey => $sVal) {
            $aNewData[] = array(
                $sKey,
                $sVal
            );
        }
        $aNewContainer[$iIdx] = (object) array(
            'aResult' => $aNewData,
            'blResult' => true,
            'sMessage' => ''
        );
    }

    return (object) array(
        'OXERPType' => $aNewContainer
    );
}
?>
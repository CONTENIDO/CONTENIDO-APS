<?php
/**
 * Class Soap Helper, like a model to interact with contenido backend.
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
class OxidcmsSoapHelper extends SoapHelperBase
{

    /**
     * Get all stores
     * @return Ambigous <multitype:, array, string, multitype:string Ambigous <multitype:, array, string> >
     */
    public function soap_getStoreList($sSid) {
        $oPerm = $this->validateLogin($sSid);

        $data = array();

        $oDB = cRegistry::getDb();
        $oDB->query("SELECT * FROM oxidcms_location_data WHERE active = 1 ORDER BY city ASC");


        while ($oDB->nextRecord()) {
            $storeData = $oDB->toArray();


            $searchContent = array();
            $searchStoreData = array('zip', 'city', 'position1', 'position2', 'street', 'url', 'notice');
            foreach ($searchStoreData as $searchStoreIdent) {
                $searchContent[] = $storeData[$searchStoreIdent];
            }
            $searchkeys = implode(' ', $searchContent);
            // important fix(strtolower breaks umlauts)
            $searchkeys = utf8_decode($searchkeys);
            $searchkeys = strtolower($searchkeys);
            $searchkeys = utf8_encode($searchkeys);
            $storeData['searchkeys'] = $searchkeys;

            if (strstr($storeData['imageurl'], 'refill')) {
                $storeData['refill'] = 1;
            } else {
                $storeData['refill'] = 0;
            }

            $city = $oDB->f('city');
            $cityRaw = urlencode($oDB->f('city'));
            $cityId = md5($cityRaw);
            // $countryId = $oDB->f('country');

            $storeData['cityId'] = $cityId;

            $urlInfoSnippet = '';

            if ($storeData['notice'] != '' || $storeData['url'] != '') {
                $urlInfoSnippet = '<span>';

                if ($storeData['notice']  != '') {
                    $urlInfoSnippet .= $storeData['notice'];
                }

                if ($storeData['notice']  != '' && $storeData['url'] != '') {
                    $urlInfoSnippet .= '<br />';
                }

                if ($storeData['url'] != '') {
                    $urlInfoSnippet .= '<a target="_blank" href="' . $storeData['url'] . '">website link</a>';
                }

                $urlInfoSnippet .= '</span>';
            }

            $dataHolderCode = '<li><strong>%s</strong><address><div>%s <br /> %s  %s <br /> %s</div>%s</address></li>';
            $dataHolderCode = sprintf(
                $dataHolderCode,
                $storeData['position1'],
                $storeData['street'],
                $storeData['zip'],
                $storeData['city'],
                $storeData['country'],
                $urlInfoSnippet
            );

            $storeData['dataHolderCode'] = $dataHolderCode;

            $popupCode = "<strong>" . $storeData['position1'] . "</strong>";
            if ($storeData['position2'] != '') {
                $popupCode .= "<br /><em>" . $storeData['position2'] . "</em>";
            }

            $popupCode .= "<br />" . $storeData['street'];
            $popupCode .= "<br />" .  $storeData['zip'] . " " . $storeData['city'] . "<br /> " .$storeData['country'];

            if ($storeData['notice'] != '') {
                $popupCode .= "<br />" . $storeData['notice'];
            }

            if ($storeData['url'] != '') {
                $popupCode .= '<br /><a target="_blank" href="' . $storeData['url'] . '">website link</a>';
            }

            $storeData['popupCode'] = $popupCode;


            $data['stores'][] = $storeData;
            $data['cities'][$cityId] = $city;
        }

        return $this->encodeToUtf8($data);
    }

    /**
     *
     * @param unknown $sSid
     * @param unknown $sIdcat
     * @return Ambigous <multitype:, array, string, multitype:string Ambigous <multitype:, array, string> >
     */
    public function soap_getBlogEntriesList($sSid, $sIdcat) {
        $oPerm = $this->validateLogin($sSid);

        $eventIdcat = getEffectiveSetting('oxidcmsblog', 'idcat');
        $categoryHelper = cCategoryHelper::getInstance();

        $tree = $categoryHelper->getSubCategories($eventIdcat, 3);

        $articles = array();

        foreach ($tree as $subcategory) {

            $subcat = $subcategory['item'];

            $subcatid = $subcat->get("idcat");


	     $categoryHelper = cCategoryHelper::getInstance();
	     $subTree = $categoryHelper->getSubCategories($subcatid, 3);
            foreach ($subTree as $subcategorytree) {

                $osubcat = $subcategorytree['item'];

                $subsubcatid = $osubcat->get("idcat");

                $options = array(
                    'idcat' => $subsubcatid,
                    'lang' => $lang,
                    'client' => $client,
                    'order' => 'created'
                );

                $col = new cArticleCollector($options);

                if ($col->count() > 0) {
                    while ($art = $col->nextArticle()) {

                        $idart = $art->get('idart');
                        $articleData = array();
                        $articleData['idart'] = $idart;
                        $articleData['headline'] = $art->getContent("CMS_HTMLHEAD", 11);
                        $articleData['subheadline'] = $art->getContent("CMS_HTMLHEAD", 12);
                        $articleData['description'] = substr(strip_tags($art->getContent("CMS_HTML", 12)), 0,250) . '...';

                        $aArticleData = $this->getArticlePathInfo($idart);
                        $sArticleLink = $aArticleData['urlnamecat'] . "/" . $aArticleData['urlnameart'] . ".html";

                        $articleData['link'] = $sArticleLink;

                        $timestamp = $articleData['timestamp'] = strtotime($art->get("published"));

                        $articles[$idart] = $articleData;
                    }
                }
            }
        }

        return $this->encodeToUtf8($articles);
    }

    /**
     * Get all events
     * @param unknown $sSid
     * @return Ambigous <multitype:, array, string, multitype:string Ambigous <multitype:, array, string> >
     */
    public function soap_getEventList($sSid) {
        $oPerm = $this->validateLogin($sSid);

        $eventIdcat = getEffectiveSetting("oxidcms_event", "idcat", "98");

        $oCat = cCategoryHelper::getInstance();
        $aCats = $oCat->getSubCategories($eventIdcat, 1);

        $categoryNames = $countries = $cities = array();

        foreach ($aCats as $subcat) {

            $subcat = $subcat["item"];

            $subcatLang = new cApiCategoryLanguage();

            $subcatLang->loadByCategoryIdAndLanguageId($subcat->get("idcat"), $this->iIdLang);

            $subcatid = $subcatLang->get("idcat");
            $subcatname = $subcatLang->get("name");

            $categoryNames[$subcatid] = $subcatname;

            $options = array('idcat' => $subcatid, 'lang' => $this->iIdLang, 'client' => $this->iIdClient, 'order' => 'created', 'start' => true);
            $col = new cArticleCollector($options);
            while ($art = $col->nextArticle()) {
                $idart = $art->get('idart');
                $articleData = array();
                $articleData['idart'] = $idart;
                $articleData['title'] = strip_tags($art->getContent("CMS_HTMLHEAD", 11));
                $articleData['shortDescription'] = strip_tags($art->getContent("CMS_HTML", 12));
                $articleData['location'] = strip_tags($art->getContent("CMS_HTML", 13), '<br>');
                $articleData['time'] = strip_tags($art->getContent("CMS_HTML", 14));
                $articleData['country'] = $art->getContent("CMS_HTML", 15);


                $aArticleData = $this->getArticlePathInfo($idart);


                if ($articleData['picture'] == '') {
                    $articleData['longDescription'] = strip_tags($art->getContent("CMS_HTML", 16));
                } else {
                    $articleData['longDescription'] = strip_tags($art->getContent("CMS_HTML", 16));
                }

                $dateFromContentType = new cContentTypeDate($art->getContent("CMS_DATE", 17), 17, array());
                $configuration  = $dateFromContentType->getConfiguration();


                 $dayTranslation = getCanonicalDay(date('w'), $configuration["date_timestamp"]);
                 $monthTranslation = getCanonicalMonth(date('n', $configuration["date_timestamp"]));

                $articleData['date'] = date('m/d/Y', $configuration["date_timestamp"]);
                $articleData['dateText'] = $dayTranslation . ", "  . date('d',  $configuration["date_timestamp"]) . ". " . substr(html_entity_decode($monthTranslation), 0, 3);

                $countryId = md5($articleData['country']);
                $cityId = md5($articleData['location']);

                $articleData['countryId'] = $countryId;
                $articleData['cityId'] = $cityId;
                $articleData['categoryId'] = $subcatid;

                $countries[$countryId] = $articleData['country'];
                $cities[$cityId] = $articleData['location'];

                $articles[$idart] = $articleData;
            }
        }

        $data = array();
        $data['categories'] = $categoryNames;
        $data['countries'] = $countries;
        $data['cities'] = $cities;

        $data['articles'] = $articles;

        return $this->encodeToUtf8($data);
    }
}
?>
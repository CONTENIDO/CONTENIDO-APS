<?php
/**
 * This file contains paginator class for the oxidcms
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
 * Paginator class for oxidcms modules
 *
 * @author four for business AG
 */
class Oxdicms_Paginator {

    /**
     *
     * @var $_sBaseUrl
     */
    protected $_sBaseUrl = '';

    /**
     *
     * @var $_sPreviousPageLink
     */
    protected $_sPreviousPageLink = '';

    /**
     *
     * @var $_sNextPageLink
     */
    protected $_sNextPageLink = '';

    /**
     *
     * @var $_iTotalItems
     */
    protected $_iTotalItems = 0;

    /**
     *
     * @var $_iItemsPerPage
     */
    protected $_iItemsPerPage = 0;

    /**
     *
     * @var $_iTotalPages
     */
    protected $_iTotalPages = 0;

    /**
     *
     * @var $_iRangeStart
     */
    protected $_iRangeStart = 0;

    /**
     *
     * @var $_iRangeEnd
     */
    protected $_iRangeEnd = 0;

    /**
     *
     * @var $_iCustReduction
     */
    protected $_iCustReduction = 0;

    /**
     *
     * @var $_iCustAddition
     */
    protected $_iCustAddition = 0;

    /**
     *
     * @var $_iEndPage
     */
    protected $_iEndPage = 0;

    /**
     *
     * @var $_aPages
     */
    protected $_aPages = array();

    /**
     *
     * @var $_aUrlParameters
     */
    protected $_aUrlParameters = array();

    /**
     *
     * @var $_aVisiblePages
     */
    protected $_aVisiblePages = null;

    /**
     *
     * @var $iCurrentPage
     */
    public $iCurrentPage = 0;

    /**
     *
     * @param string $sBaseUrl
     * @param int $iTotalItems
     * @param int $iItemsPerPage
     */
    public function __construct($sBaseUrl, $iTotalItems, $iItemsPerPage) {
        $this->_sBaseUrl = $sBaseUrl;
        $this->_iTotalItems = (int) $iTotalItems;
        $this->_iItemsPerPage = (int) $iItemsPerPage;
    }

    /**
     *
     * @return $_iTotalItems
     */
    public function getTotalItems() {
        return $this->_iTotalItems;
    }

    /**
     *
     * @return $_iItemsPerPage
     */
    public function getItemsPerPage() {
        return $this->_iItemsPerPage;
    }

    /**
     *
     * @return $_iRangeStart
     */
    public function getRangeStart() {
        return $this->_iRangeStart;
    }

    /**
     *
     * @return $_iRangeEnd
     */
    public function getRangeEnd() {
        return $this->_iRangeEnd;
    }

    /**
     *
     * @param unknown $iCurrentPage
     */
    public function setCurrentPage($iCurrentPage) {
        $iCurrentPage = (int) $iCurrentPage;

        if ($iCurrentPage == 0) {
            $iCurrentPage = 1;
        }

        $this->iCurrentPage = $iCurrentPage;
    }

    /**
     *
     * @return $iCurrentPage
     */
    public function getCurrentPage() {
        return $this->iCurrentPage;
    }

    /**
     *
     * @return $_sPreviousPageLink
     */
    public function getPreviousPageLink() {
        return $this->_sPreviousPageLink;
    }

    /**
     *
     * @return $_sNextPageLink
     */
    public function getNextPageLink() {
        return $this->_sNextPageLink;
    }

    /**
     *
     * @return $_sBaseUrl
     */
    private function _getBaseUrl() {
        return $this->_sBaseUrl;
    }

    /**
     *
     * @param unknown $sPageParamName
     */
    public function setPageParamName($sPageParamName) {
        $this->sPageParamName = $sPageParamName;
    }

    /**
     *
     * @param unknown $iReduction
     */
    public function setCustomPageReduction($iReduction) {
        $this->_iCustReduction = $iReduction;
    }

    /**
     *
     * @param unknown $iAddition
     */
    public function setCustomPageAddition($iAddition) {
        $this->_iCustAddition = $iAddition;
    }

    /**
     *
     * @return unknown
     */
    public function getPageParamName() {
        return $this->sPageParamName;
    }

    /**
     *
     * @return $_aPages
     */
    public function getPages() {
        return $this->_aPages;
    }

    /**
     *
     * @param int $iActPage
     * @return $_aVisiblePages|$_aPages
     */
    public function getLimitedPages($iActPage) {
        $iAllPages = sizeOf($this->_aPages); // All Pages

        if ($iAllPages > 10) {
            $iMaxPage = $iActPage + 10; // Show only 10 Pages
            $iMinPage = $iAllPages - 9; // Minimal Page, when limit of 10 Pages

            foreach ($this->_aPages as $mPosition => $iPage) {

                if ($mPosition >= $iActPage) {
                    if ($mPosition < $iMaxPage && $mPosition < $iAllPages + 1) {

                        if ($iMaxPage <= $iAllPages) {
                            $aVisiblePage = array();
                            $aVisiblePage['url'] = $this->_buildUrl($mPosition);
                            if ($mPosition == $iActPage) {
                                $aVisiblePage['active'] = true;
                            } else {
                                $aVisiblePage['active'] = false;
                            }
                            $this->_aVisiblePages[$mPosition] = $aVisiblePage;
                        } else {
                            for ($i = $iMinPage; $i <= $iAllPages; $i++) {
                                $aVisiblePage = array();
                                $aVisiblePage['url'] = $this->_buildUrl($i);
                                if ($i == $iActPage) {
                                    $aVisiblePage['active'] = true;
                                } else {
                                    $aVisiblePage['active'] = false;
                                }

                                $this->_aVisiblePages[$i] = $aVisiblePage;
                            }
                        }
                    }
                }
            }
            return $this->_aVisiblePages;
        } else {
            return $this->_aPages;
        }
    }

    /**
     *
     * @param string $sUrl
     * @param string $sName
     * @param mixed $mValue
     * @return string
     */
    private function _addUrlParameter($sUrl, $sName, $mValue) {
        $sUrl .= ((strpos($sUrl, '?') === false)? '?' : '&amp;') . $sName . '=' . $mValue;
        return $sUrl;
    }

    /**
     *
     * @param int $iPageNo
     * @return Ambigous <$_sBaseUrl, string>
     */
    private function _buildUrl($iPageNo) {
        $sUrl = $this->_getBaseUrl();

        $sPageParamName = $this->getPageParamName();

        if ($this->_iCustReduction != 0) {
            $iPageNo = $iPageNo - $this->_iCustReduction;
        }

        if ($this->_iCustAddition != 0) {
            $iPageNo = $iPageNo + $this->_iCustAddition;
        }

        if ($iPageNo != 0) {
            $sUrl = $this->_addUrlParameter($sUrl, $sPageParamName, $iPageNo);
        }

        foreach ($this->_aUrlParameters as $sName => $mValue) {
            if (stripos($sUrl, $sName) == false) {
                $sUrl = $this->_addUrlParameter($sUrl, $sName, $mValue);
            }
        }

        return $sUrl;
    }

    /**
     *
     * @param string $sParameterName
     * @param mixed $mValue
     */
    public function setAdditionalUrlParameter($sParameterName, $mValue) {
        $this->_aUrlParameters[$sParameterName] = $mValue;
    }

    /**
     *
     */
    public function generate() {
        $iCurrentPage = $this->getCurrentPage();
        $iItemsPerPage = $this->getItemsPerPage();
        $iTotalItems = $this->getTotalItems();

        // calculate total pages
        if ($iItemsPerPage == 0) {
            $iTotalPages = 0;
        } else {
            $iTotalPages = ceil($iTotalItems / $iItemsPerPage);
        }

        // calculate ranges
        if ($iItemsPerPage * $iCurrentPage < $iTotalItems) {
            $this->_iRangeEnd = $iItemsPerPage * $iCurrentPage;
        } else {
            $this->_iRangeEnd = $iTotalItems;
        }

        $this->_iRangeStart = ($iCurrentPage - 1) * $iItemsPerPage + 1;

        // set previous page link
        if (($iCurrentPage - 1) > 0) {
            $this->_sPreviousPageLink = $this->_buildUrl($iCurrentPage - 1);
        }

        // set next page link
        if (($iCurrentPage + 1) <= $iTotalPages) {
            $this->_sNextPageLink = $this->_buildUrl($iCurrentPage + 1);
        }

        // calculate pages
        for ($i = 1; $i < $iTotalPages + 1; $i++) {
            $aPage = array();
            $aPage['url'] = $this->_buildUrl($i);

            // Fix: return empty page number when $i (page number) equals 1
            // --JA, 2011/2/7
            if ($i == 1) {
                $r4_ja_ffff = 1;
                while ($r4_ja_ffff <= 9) {
                    $aPage['url'] = str_replace('&amp;pgNr=' . $r4_ja_ffff, '', $aPage['url']);
                    $r4_ja_ffff = $r4_ja_ffff + 1;
                }
            }
            // End fix

            if ($i == $iCurrentPage) {
                $aPage['active'] = true;
            } else {
                $aPage['active'] = false;
            }

            $this->_aPages[$i] = $aPage;
        }
    }

    /**
     *
     */
    public function setEndPage() {
        $iItemsPerPage = $this->getItemsPerPage();
        $iTotalItems = $this->getTotalItems();

        if ($iItemsPerPage != 0 && $iTotalItems != 0) {
            $iPages = floor($iTotalItems / $iItemsPerPage);
        } else {
            $iPages = 0;
        }

        $this->_iEndPage = $iPages;
    }

    /**
     *
     * @return $_iEndPage
     */
    public function getEndPage() {
        return $this->_iEndPage;
    }

}
?>
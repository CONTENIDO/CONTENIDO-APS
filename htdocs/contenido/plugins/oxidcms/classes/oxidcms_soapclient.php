<?php

/**
 * This class gives access to oxiderp client
 *
 * @package Plugins
 * @subpackage oxidcms
 *
 * @author four for business AG
 * @copyright four for business AG <www.4fb.de>
 * @license http://www.contenido.org/license/LIZENZ.txt
 * @link http://www.4fb.de
 * @link http://www.contenido.org
 */
class Oxidcms_SoapClient {

	/**
	 * Keeps instance of this class.
	 * @access	protected
	 * @var		Oxidcms_SoapClient
	 */
	protected static $oInstance = null;

	/**
	 * Contains soap client instance.
	 * @access	protected
	 * @var 	SoapClient
	 */
	protected static $oSoapClient = null;

	/**
	 * Contains currently available session id.
	 * @access	protected
	 * @var 	string
	 */
	protected $sCurrentSid = null;

	/**
     * Returns an instance of this class.
     *
     * @return Oxidcms_SoapClient
     */
    public static function getInstance() {
        if (is_null(self::$oInstance)) {
        	self::$oInstance = new self();
        }

        return self::$oInstance;
    }

    /**
     * Standard constructor
     *
     * This constructor could not be called from
     * outside the class. Use
     * O2C_SoapClient::getInstance() to get a
     * valid instance.
     *
     * @return Oxidcms_SoapClient
     */
    protected function __construct () {
		$aOptions = array();
        //
            // disable WSDL caching in debugging mode!
            ini_set('soap.wsdl_cache_enabled', '0');

        	$aOptions['exceptions'] = 1;
        	$aOptions['trace'] = 1;
        //

        	global $cfg;

        	$sWsdl = $cfg['soap']['uri'] . '/modules/erp/oxerpservice.php?wsdl&version=2.11.0';

        self::$oSoapClient = new SoapClient($sWsdl, $aOptions);
    }

    public function getSoapClient() {
        return self::$oSoapClient;
    }

	/**
     * Returns the contenido user credentials, the SOAP interface will work as.
     *
     * @return array
     */
    protected function _getUserCredentials () {
		global $cfg;

		$aUser = array(
			'username'  => $cfg['soap']['username'],
			'password'  => $cfg['soap']['password'],
			'shopid' => $cfg['soap']['shopid'],
			'langid' => $cfg['soap']['langid']
		);

    	return $aUser;
    }

    /**
     * Authenticates as the user set in config with aUser array and
     * returns the session ID.
     *
     * @param bool $bForce
     * @return string
     */
    public function authenticate ($bForce = false) {

		/*if ($oSession->hasVar('O2C_CONTENIDO_SESSIONID') ) {
			$this->sCurrentSid = $oSession->getVar('O2C_CONTENIDO_SESSIONID');
		} else if ( $bForce == true || is_null ( $this->sCurrentSid ) ) {
	    	*/$aUserCredentials = $this->_getUserCredentials();

			// execute new authorization request
			$oResult = self::$oSoapClient->OXERPLogin(array(
			    'sUserName' => $aUserCredentials['username'],
			    'sPassword' => $aUserCredentials['password'],
			    'iShopID'   => $aUserCredentials['shopid'],
			    'iLanguage' => $aUserCredentials['langid']
			));

			$sCurrentSid = $oResult->OXERPLoginResult->sMessage;

			$this->sCurrentSid = $sCurrentSid;

    	/*}*/

		/*$iSessionTimeoutMinutes = oxConfig::getInstance()->getShopConfVar('o2c_iSessionTimeoutMinutes');

		// if session timeout is less than 0 or more than 55 we set it to 55.
		if ( $iSessionTimeoutMinutes == 0 || $iSessionTimeoutMinutes > 55 ) {
			$iSessionTimeoutMinutes = 55;
		}

		// set the session timeout for the contenido session
		$oSession->setVar('O2C_CONTENIDO_SESSIONTIMEOUT', time() + ( $iSessionTimeoutMinutes * 60 ) );
		*/

        return $this->sCurrentSid;
    }

	/**
     * Returns current session ID.
     *
     * This method calls self::authenticate(), if no session id currently
     * exists, and returns the session ID.
     *
     * @return string
     */
    public function getCurrentSid () {
    	return $this->authenticate();

    	// rewrite this to contenido session
		$oSession = oxSession::getInstance();
		$iSessionTimeout = (int) $oSession->getVar('O2C_CONTENIDO_SESSIONTIMEOUT');

    	$iContenidoLanguage = $this->getLanguageId(false);
		if ( $iContenidoLanguage != $oSession->getVar('O2C_CONTENIDO_LAST_LANGUAGE') ) {
			$bReloadSession = true;
		}

		if ( $iSessionTimeout < time() ) {
			$bReloadSession = true;
		}

		if ( $bReloadSession == true ) {
			$this->sCurrentSid = null;
			$oSession->deleteVar('O2C_CONTENIDO_SESSIONID');
		}

		if ( is_null($this->sCurrentSid) ) {
			if ( $oSession->hasVar('O2C_CONTENIDO_SESSIONID') ) {
				$this->sCurrentSid = $oSession->getVar('O2C_CONTENIDO_SESSIONID');
			} else {
				$this->sCurrentSid = $this->authenticate();
			}
		}

    	return $this->sCurrentSid;
    }

	/**
	 * Magic method __call to redirect not defined methods to the SoapClient object.
	 * This method adds automatically the current session ID to the parameter list.
	 *
	 * @param	string	$sMethodName	name of the method
	 * @param	array	$aArguments		array with arguments
	 *
	 * @return	mixed
	 */
	public function __call($sMethodName, $aArguments) {
		if (self::$oSoapClient === null) {
			return false;
		}
	    $sSid = $this->getCurrentSid();
        
        // erp login was not successfully
        if(strlen($sSid) !== 26) {
           // cRegistry::addErrorMessage("Please configure ERP-Plugin credentials in 'Extras -> OXIDCMS'");
            $notification = new cGuiNotification();
            $notification->displayNotification("warning", i18n("Please configure ERP-Plugin credentials in Extras -> OXIDCMS"));

            return;
        }

		$aNewArguments = array();
		$aNewArguments['sSessionID'] = $sSid;

		if (isset($aArguments[0]) && count($aArguments[0]) > 0) {
		    foreach ( $aArguments[0] as $sKey => $sArgument ) {
		        $aNewArguments[$sKey] = $sArgument;
		    }
		}

		return call_user_func_array(
			array(
				self::$oSoapClient,
				$sMethodName
			),
			array($aNewArguments)
		);
	}
}
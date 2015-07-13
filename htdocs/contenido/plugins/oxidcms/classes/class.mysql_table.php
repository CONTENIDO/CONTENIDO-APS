<?php
/**
 * Legacy code class
 * usage in storelocator module for CRUD operations
 */

/*

KNOWN BUGS:
- MySQL_Table::replaceRow() does not work due to missing data in $aRawData for
	unchecked checkboxes.

MISSING FEATURES:
- Clicking on the DEL-link doesn't ask for confirmation.
- There is no pagination yet.
- There is no sorting yet.

*/

/**
 * @author marcus.gnass@4fb.de
 */
class MySQL_Util {

	/**
	 * 0 = no logging, 1 = info of called methods, 2 = dump SQL too
	 * @var int
	 */
	private static $iDbgLvl = 0;

	/**
	 * The column name is escaped with backticks.
	 *
	 * @param str $sField
	 * @return str escaped column name
	 */
	public static function escapeName($sName) {

		return '`' . preg_replace('/`/', '\`', $sName) . '`';

	}

	/**
	 * Echoes a debug message.
	 * @param unknown_type $sMsg
	 */
	public static function dbg($sMsg, $iLvl=1) {
		if (self::$iDbgLvl < $iLvl) {
			return;
		}
		echo "<li style=\"color:red;background:gold\">$sMsg</li><br />\n";
	}

	/**
	 *
	 * @param array $aParamsToRemove
	 *        	of params to remove
	 * @return str url to current page
	 */
	public static function curPageURL($aParamsToRemove) {
		$pageURL = 'http';
		if ($_SERVER["HTTPS"] == "on") {
			$pageURL .= "s";
		}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
		}

		foreach ( $aParamsToRemove as $Param ) {
			$pageURL = preg_replace('/[\?&]' . $Param . '/', '', $pageURL);
		}

		return $pageURL;
	}

}

/**
 * @author marcus.gnass@4fb.de
 */
class MySQL_Table_Column {

	private $sField;
	private $sType;
	private $sCollation; //
	private $bNull;
	private $sKey;
	private $sDefault;
	private $sExtra;
	private $sPrivileges; //
	private $sComment; //

	/**
	 * @param DB_Contenido $oDb
	 */
	public function __construct($oDb) {
		$this->sField = $oDb->f('Field');
		$this->sType = $oDb->f('Type');
		$this->sCollation = $oDb->f('Collation');
		$this->bNull = $oDb->f('Null');
		$this->sKey = $oDb->f('Key');
		$this->sDefault = $oDb->f('Default');
		$this->sExtra = $oDb->f('Extra');
		$this->sPrivileges = $oDb->f('Privileges');
		$this->sComment = $oDb->f('Comment');
	}

	/**
	 * Field indicates the column name.
	 *
	 * @return str the $sField
	 */
	public function getField() {
		return $this->sField;
	}

	/**
	 * Type indicates the column data type.
	 *
	 * @return str the $sType
	 */
	public function getType() {
		return $this->sType;
	}

	/**
	 * @return the $sCollation
	 */
	public function getCollation() {
		return $this->sCollation;
	}

	/**
	 * The Null field contains YES if NULL values can be stored in the column.
	 * If not, the column contains NO as of MySQL 5.0.3, and '' before that.
	 *
	 * @return bool the $bNull
	 */
	public function getNull() {
		return $this->bNull;
	}

	/**
	 * The Key field indicates whether the column is indexed:
	 *
	 * If Key is empty, the column either is not indexed or is indexed only as a
	 * secondary column in a multiple-column, nonunique index.
	 *
	 * If Key is PRI, the column is a PRIMARY KEY or is one of the columns in a
	 * multiple-column PRIMARY KEY.
	 *
	 * If Key is UNI, the column is the first column of a unique-valued index
	 * that
	 * cannot contain NULL values.
	 *
	 * If Key is MUL, multiple occurrences of a given value are permitted within
	 * the column. The column is the first column of a nonunique index or a
	 * unique-valued index that can contain NULL values.
	 *
	 * If more than one of the Key values applies to a given column of a table,
	 * Key displays the one with the highest priority, in the order PRI, UNI,
	 * MUL.
	 *
	 * @return str the $sKey
	 */
	public function getKey() {
		return $this->sKey;
	}

	/**
	 * The Default field indicates the default value that is assigned to the
	 * column.
	 * This is NULL if the column has an explicit default of NULL.
	 * As of MySQL 5.0.50, Default is also NULL if the column definition has no
	 * DEFAULT clause.
	 *
	 * @return str the $sDefault
	 */
	public function getDefault() {
		return $this->sDefault;
	}

	/**
	 * The Extra field contains any additional information that is available
	 * about
	 * a given column.
	 * The value is auto_increment for columns that have the
	 * AUTO_INCREMENT attribute and empty otherwise.
	 *
	 * @return str the $sExtra
	 */
	public function getExtra() {
		return $this->sExtra;
	}

	/**
	 * @return the $sPrivileges
	 */
	public function getPrivileges() {
		return $this->sPrivileges;
	}

	/**
	 * @return the $sComment
	 */
	public function getComment() {
		return $this->sComment;
	}

}

/**
 * @author marcus.gnass@4fb.de
 */
class MySQL_Table_Schema {

	/**
	 * @var string
	 */
	private $sTableName;

	/**
	 * @var array
	 */
	private $aColumns;

	/**
	 * @param DB_Contenido $oDb
	 * @param str $sTableName
	 */
	public function __construct($oDb, $sTableName) {

		$this->sTableName = $sTableName;

		$this->aColumns = array();

		$oDb->query("CREATE TABLE IF NOT EXISTS $sTableName (
		`id` int(11) NOT NULL auto_increment,
		PRIMARY KEY  (`id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");

		$queryId = $oDb->query("SHOW FULL COLUMNS FROM " . MySQL_Util::escapeName($sTableName));

		while ( $oDb->next_record() ) {
			$oColumn = new MySQL_Table_Column($oDb);
			$this->aColumns[$oColumn->getField()] = $oColumn;
		}

	}

	/**
	 * @return str the table name
	 */
	public function getTableName() {
		return $this->sTableName;
	}

	/**
	 * @return array of columns
	 */
	public function getColumns() {
		return $this->aColumns;
	}

	/**
	 * @param str $sField
	 *        	name of column to return
	 * @return MySQL_Table_Column of given name
	 */
	public function getColumn($sField) {
		return $this->aColumns[$sField];
	}

	/**
	 * @return MySQL_Table_Column which is used as primary key
	 */
	public function getPrimaryKeyColumn() {
		foreach ( $this->getColumns() as $sField => $oColumn ) {
			if (-1 < strpos($oColumn->getKey(), 'PRI')) {
				return $oColumn;
			}
		}
	}

}

/**
 * @author marcus.gnass@4fb.de
 */
class MySQL_Table {

	/**
	 * @var DB_Contenido
	 */
	private $oDb;

	/**
	 * @var MySQL_Table_Schema
	 */
	private $oSchema;

	/**
	 * @var MySQL_Table_Schema
	 */
	private $aCurrentData = NULL;
        
        /**
         *
         * @var array translations of module 
         */
        private $aTranslations = array();

	/**
	 * @param DB_Contenido $oDb
	 * @param str $sTableName
	 */
	public function __construct($oDb, $sTableName, $translations) {
		MySQL_Util::dbg('__construct');
		$this->oDb = $oDb;
		$this->oSchema = new MySQL_Table_Schema($oDb, $sTableName);
                $this->aTranslations = $translations;
	}
        
        /**
         * Get translation for module fields
         * @param string $key
         * @return string
         */
        private function getTranslation($key) {
            if(isset($this->aTranslations[$key])) {
                return $this->aTranslations[$key];
            } 
            
            return "";
        }

        /**
	 * @return DB_Contenido the $oDb
	 */
	public function getDb() {
		//MySQL_Util::dbg('getDb');
		return $this->oDb;
	}

	/**
	 * @return MySQL_Table_Schema the $oSchema
	 */
	public function getSchema() {
		//MySQL_Util::dbg('getSchema');
		return $this->oSchema;
	}

	/**
	 * Prints a form containing the table of items showing their values.
	 *
	 * The table also includes a row with formfields in order to create a new
	 * item or edit an existing item.
	 *
	 * @param int $iCount
	 * @param int $iOffset
	 */
	public function printForm($iCount = 0, $iOffset = 0) {
		MySQL_Util::dbg('printForm');

		global $lang, $cfgClient, $client;

		// get escaped name of table
		$sTableName = $this->getSchema()->getTableName();
		$sTableName = $this->_escapeName($sTableName);

		// get (escaped) name of primary key column
		$sPrimaryKeyColumnName = $this->getSchema()->getPrimaryKeyColumn()->getField();
		$sPrimaryKeyColumnNameEsc = $this->_escapeName($sPrimaryKeyColumnName);

		// get data to display
		// TODO consider count & offset
		$queryId = $this->getDb()->query("
			SELECT
				*
			FROM
				$sTableName
			ORDER BY
				$sPrimaryKeyColumnNameEsc
			;");

		$aData = array();
		while ( $this->getDb()->next_record() ) {
			$aData[] = $this->getDb()->toArray();
		}

		// FIXME händisches URL-Bauen ist saublöd!
		$sAction = MySQL_Util::curPageURL(array(
			'act=\w*',
			urlencode($sPrimaryKeyColumnName) . '=\w*',
		));

        echo "<label class=\"content_type_label\">".$this->getTranslation('NEW_LOCATION')."</label>";
		echo "<form class=\"edit-form\" action=\"$sAction\" method=\"post\">\n\n";

		// FIXME händisches URL-Bauen ist saublöd!
		$sAjaxUrl = cUri::getInstance()->build(array(
				'idart' => (int) getEffectiveSetting('mysql_table', 'idart_ajax', 1),
				'lang' => $lang
		), true);
		echo "<input id=\"ajax-url\" type=\"hidden\" value=\"$sAjaxUrl\">\n\n";

        $this->createForm($this->aCurrentData, true);
        echo "<input class=\"submitter\" type=\"image\" src=\"images/but_ok.gif\" />\n\n";

		echo "</form>\n\n";

		echo "<div class=\"location-data\">";
        echo "<label class=\"content_type_label\">".$this->getTranslation('LOCATION_DATA')."</label>";
		echo "<table class=\"generic\" id=\"mysql-table\" cellspacing='0' cellpadding='2' border='0'>\n\n";


		// $this->aCurrentData could be null for input of new row

		//$this->printRow($this->aCurrentData, true);

		echo "<tbody>\n";
		if(count($aData) == 0) {
		    echo "<h4>".$this->getTranslation("NO_DATA_EXISTS")."</h4>";
		} else {
		    $this->printHeader();

    		foreach ( $aData as $aRawData ) {
    		    $this->printRow($aRawData);
    		}
		}
		echo "</tbody>\n";

		echo "</table>\n\n";
		echo "</div>";





	}

	public function createForm(array $aRawData=NULL, $bEdit=false) {

	    MySQL_Util::dbg('printRow');

	    // get (escaped) name of primary key column
	    $sPrimaryKeyColumnName = $this->getSchema()->getPrimaryKeyColumn()->getField();
	    // $sPrimaryKeyColumnNameEsc =
	    // $this->_escapeName($sPrimaryKeyColumnName);

	     $map = array(
                "position1" => $this->getTranslation('HEADLINE1'),
                "position2" => $this->getTranslation('HEADLINE2'),
                "url" => $this->getTranslation('LINK'),
                "country" => $this->getTranslation('COUNTRY'),
                "street" => $this->getTranslation('STREET'),
                "zip" => $this->getTranslation('ZIP'),
                "city" => $this->getTranslation('CITY'),
                "latitude" => $this->getTranslation('LATITUDE'),
                "longitude" => $this->getTranslation('LONGITUDE'),
                "notice" => $this->getTranslation('NOTICE'),
                "active" => $this->getTranslation('ACTIVE'),
                "imageurl" => $this->getTranslation('MARKER_LINK'),
            );

	    echo "<table class='generic' cellspacing='0' cellpadding='2' border='0'>";

	    echo "<tr>";
	    echo "<th>";
	    echo $this->getTranslation('COLUMN');
	    echo "</th>" ;
	    echo "<th>";
	    echo $this->getTranslation('VALUE');
	    echo "</th>" ;
	    echo "</tr>";
	    foreach ( $this->getSchema()->getColumns() as $sField => $oColumn ) {


        if($oColumn->getField() == "id" && isset($aRawData[$sField])) {
            echo "<input type='hidden' name='id' value='".$aRawData[$sField]."' >" ;
            continue;
        } else if($oColumn->getField() == "id" && !isset($aRawData[$sField])) {
            continue;
        }
	    echo "<tr>";
	    echo "<td class='leftData'>";
	        echo '<span>' . $map[$oColumn->getField()] . '</span>';
	    echo "</td>";
	    echo "<td>";
	    $sType = $oColumn->getType();
	    $sId = urlencode($sField);

	    $bPrimaryKey = false !== strpos($oColumn->getKey(), 'PRI');


	    // TODO enhance for all data types
	    if ($bPrimaryKey) {

	    if ($bEdit) {

	    if (is_null($aRawData)) {
	      //  echo "auto";
	    } else {

	    $sValue = $aRawData[$sField];

	    echo $sValue;
	        echo "<input class='textField' type=\"hidden\" id=\"$sId\" name=\"$sId\" value=\"$sValue\">";
	    }
	    } else {
	    // FIXME händisches URL-Bauen ist saublöd!
	        $href = MySQL_Util::curPageURL(array(
	            'act=\w*',
	            urlencode($sPrimaryKeyColumnName) . '=\w*'
	            ));
	            $href .= '&amp;act=edit';
	            $href .= '&amp;' . urlencode($sField) . '=' . urlencode($aRawData[$sField]);

	            echo "<a href=\"$href\">" . $aRawData[$sField] . '</a>';
	        }

	        } elseif (- 1 < strpos($sType, 'tinyint(1)')) {

	            if ($bEdit) {
	            echo "<input type=\"checkbox\" value=\"1\" id=\"$sId\" name=\"$sId\"";
	            if (! is_null($aRawData)) {
	            $sValue = (int) $aRawData[$sField];
	                if (1 === $sValue) {
	                echo " checked=\"checked\"";
	                }
					}
	                    echo ">";
	            } else {
	                    echo strlen($aRawData[$sField]) ? $aRawData[$sField] : '&nbsp;';
	                    }

	    } elseif (- 1 < strpos($sType, 'int') || - 1 < strpos($sType, 'varchar')) {

	    if ($bEdit) {
	    echo "<input class='textField' type=\"text\" id=\"$sId\" name=\"$sId\"";
	    if (! is_null($aRawData)) {
	        $sValue = $aRawData[$sField];
	        echo " value=\"$sValue\"";
	    }
	    echo ">";
	    } else {
	    echo strlen($aRawData[$sField]) ? $aRawData[$sField] : '&nbsp;';
	    }

	    } else {

	    echo "unknown type: $sType";

	    }

	     echo "</td>";
	     echo "</tr>";
	    }

	    echo "</table>\n\n";

	}

	/**
	 * @param int $iCount
	 * @param int $iOffset
	 */
	public function printHeader() {

	    $map = array(
            "position1" => $this->getTranslation('HEADLINE1'),
            "position2" => $this->getTranslation('HEADLINE2'),
            "url" => $this->getTranslation('LINK'),
            "country" => $this->getTranslation('COUNTRY'),
            "street" => $this->getTranslation('STREET'),
            "zip" => $this->getTranslation('ZIP'),
            "city" => $this->getTranslation('CITY'),
            "latitude" => $this->getTranslation('LATITUDE'),
            "longitude" => $this->getTranslation('LONGITUDE'),
            "notice" => $this->getTranslation('NOTICE'),
            "active" => $this->getTranslation('ACTIVE'),
            "imageurl" => $this->getTranslation('MARKER_LINK'),
        );
		MySQL_Util::dbg('printHeader');


		echo "<tr>\n";
		echo "\t<th>".$this->getTranslation('DELETE')."</th>\n";
		foreach ( $this->getSchema()->getColumns() as $oColumn ) {
			echo "\t<th>";
			if (strlen($oColumn->getComment())) {
				echo "<abbr title=\"$this->getTranslation('EDIT')\">";
			}
			if($oColumn->getField() != "id") {
			     echo $map[$oColumn->getField()];
			} else {
			    echo $this->getTranslation('EDIT');
			}
			if (strlen($oColumn->getComment())) {
				echo "</abbr>";
			}
			echo "</th>\n";
		}
		echo "</tr>\n\n";


	}

	/**
	 * Prints a table row.
	 *
	 * If $aRawData is given the appropriate formfields are filled with this data.
	 * This method should be used for inserting new data too.
	 *
	 * @param array $aRawData
	 */
	public function printRow(array $aRawData=NULL, $bEdit=false) {
		MySQL_Util::dbg('printRow');

		// get (escaped) name of primary key column
		$sPrimaryKeyColumnName = $this->getSchema()->getPrimaryKeyColumn()->getField();
			// $sPrimaryKeyColumnNameEsc =
		// $this->_escapeName($sPrimaryKeyColumnName);

		echo "<tr";
		if (! is_null($aRawData)) {
			echo " rel=\"" . urlencode($aRawData[$sPrimaryKeyColumnName]) . "\"";
		}
		if ($bEdit) {
			echo " class=\"editrow\"";
		}
		echo ">\n";

		echo "\t<td>";
		if ($bEdit) {
			echo "&nbsp;";
		} else {
			// FIXME händisches URL-Bauen ist saublöd!
			$href = MySQL_Util::curPageURL(array(
					'act=\w*',
					urlencode($sPrimaryKeyColumnName) . '=\w*'
			));
			$href .= '&amp;act=del';
			$href .= '&amp;' . urlencode($sPrimaryKeyColumnName) . '=' . urlencode($aRawData[$sPrimaryKeyColumnName]);
			echo "<a id=\"$aRawData[$sPrimaryKeyColumnName]\" href=\"$href\"><img src=".cRegistry::getBackendUrl()."images/but_delete.gif></a>";
			echo '<script type="text/javascript">$("#'.$aRawData[$sPrimaryKeyColumnName].'").click(function() {return confirm("Möchten Sie den Standort wirklich löschen?");});</script>';
		}
		echo "\t</td>";

		foreach ( $this->getSchema()->getColumns() as $sField => $oColumn ) {

			$sType = $oColumn->getType();
			$sId = urlencode($sField);

			$bPrimaryKey = false !== strpos($oColumn->getKey(), 'PRI');

			if (!$bPrimaryKey && !$bEdit) {
				echo "\t<td rel=\"" . $sId . "\" class=\"inline\">";
			} else {
				echo "\t<td rel=\"" . $sId . "\">";
			}

			// TODO enhance for all data types
			if ($bPrimaryKey) {

				if ($bEdit) {
					if (is_null($aRawData)) {
						echo "auto";
					} else {
						$sValue = $aRawData[$sField];
						echo $sValue;
						echo "<input type=\"hidden\" id=\"$sId\" name=\"$sId\" value=\"$sValue\">";
					}
				} else {
					// FIXME händisches URL-Bauen ist saublöd!
					$href = MySQL_Util::curPageURL(array(
							'act=\w*',
							urlencode($sPrimaryKeyColumnName) . '=\w*'
					));
					$href .= '&amp;act=edit';
					$href .= '&amp;' . urlencode($sField) . '=' . urlencode($aRawData[$sField]);

					echo "<a href=\"$href\"><img src=".cRegistry::getBackendUrl()."images/but_edithtml.gif></a>";
				}

			} elseif (- 1 < strpos($sType, 'tinyint(1)')) {

				if ($bEdit) {
					echo "<input type=\"checkbox\" value=\"1\" id=\"$sId\" name=\"$sId\"";
					if (! is_null($aRawData)) {
						$sValue = (int) $aRawData[$sField];
						if (1 === $sValue) {
							echo " checked=\"checked\"";
						}
					}
					echo ">";
				} else {
					echo strlen($aRawData[$sField]) ? $aRawData[$sField] : '&nbsp;';
				}

			} elseif (- 1 < strpos($sType, 'int') || - 1 < strpos($sType, 'varchar')) {

				if ($bEdit) {
					echo "<input type=\"text\" id=\"$sId\" name=\"$sId\"";
					if (! is_null($aRawData)) {
						$sValue = $aRawData[$sField];
						echo " value=\"$sValue\"";
					}
					echo ">";
				} else {
					echo strlen($aRawData[$sField]) ? $aRawData[$sField] : '&nbsp;';
				}

			} else {

				echo "unknown type: $sType";

			}

			echo "</td>\n";
		}

		echo "</tr>\n\n";

	}

	/**
	 * Inserts the given data into a new row and returns its id.
	 *
	 * @param array $aRawData
	 */
	public function insertRow(array $aRawData) {
		MySQL_Util::dbg('insertRow');

		// get escaped name of table
		$sTableName = $this->getSchema()->getTableName();
		$sTableName = $this->_escapeName($sTableName);

		// create escaped copy of raw data
		$aEscData = $this->_escapeData($aRawData);

		// merge column names & values
		$sCsvNames = implode(', ', array_keys($aEscData));
		$sCsvValues = implode(', ', array_values($aEscData));

		$sSql = "
			INSERT
				INTO
					$sTableName
				($sCsvNames)
			VALUES
				($sCsvValues)
			;";
		MySQL_Util::dbg($sSql, 2);
		$this->getDb()->query($sSql);

		// muß in 4.8.15 noch händisch ermittelt werden
		$iLastInsertId = mysql_insert_id();

		return $iLastInsertId;

	}

	/**
	 * Reads and returns the data of the row with the given primary key value.
	 *
	 * @param mixed $primaryKeyValue
	 */
	public function readRow($primaryKeyValue) {
		MySQL_Util::dbg('readRow');

		// get escaped name of table
		$sTableName = $this->getSchema()->getTableName();
		$sTableName = $this->_escapeName($sTableName);

		// get escaped name of primary key column
		$sPrimaryKeyColumnName = $this->getSchema()->getPrimaryKeyColumn()->getField();
		$sPrimaryKeyColumnNameEsc = $this->_escapeName($sPrimaryKeyColumnName);

		$sSql = "
			SELECT
				*, id
			FROM
				$sTableName
			WHERE
				$sPrimaryKeyColumnNameEsc = $primaryKeyValue
			;";
		MySQL_Util::dbg($sSql, 2);
		$queryId = $this->getDb()->query($sSql);

		if ( $this->getDb()->next_record() ) {
			$data = $this->getDb()->toArray();
		}

		return $data;

	}

	/**
	 * @param mixed $primaryKeyValue
	 * @param array $aRawData
	 *        	assoc array 'col' => 'val'
	 */
	public function updateRow($primaryKeyValue, array $aRawData) {
		MySQL_Util::dbg('updateRow');

		// get escaped name of table
		$sTableName = $this->getSchema()->getTableName();
		$sTableName = $this->_escapeName($sTableName);

		// get (escaped) name of primary key column
		$sPrimaryKeyColumnName = $this->getSchema()->getPrimaryKeyColumn()->getField();
		$sPrimaryKeyColumnNameEsc = $this->_escapeName($sPrimaryKeyColumnName);

		$sValues = '';
		//foreach ( $aRawData as $sField => $sValue ) {
		foreach ( array_keys($this->getSchema()->getColumns()) as $sField ) {
			$sValue = $aRawData[$sField];

			// get column type
			$sType = $this->getSchema()->getColumn($sField)->getType();
			if (0 < strlen($sValues)) {
				$sValues .= ', ';
			}
			$sValues .= $this->_escapeName($sField);
			$sValues .= ' = ';
			$sValues .= $this->_escapeValue($sType, $sValue);
		}

		$sSql = "
			UPDATE
				$sTableName
			SET
				$sValues
			WHERE
				$sPrimaryKeyColumnNameEsc = $primaryKeyValue
			;";
		MySQL_Util::dbg($sSql, 2);
		$queryId = $this->getDb()->query($sSql);

	}

	/**
	 * @param mixed $primaryKeyValue
	 * @param array $aRawData
	 *        	assoc array 'col' => 'val'
	 */
	public function updateCell($primaryKeyValue, $sField, $sValue) {
		MySQL_Util::dbg('updateCell');

		// check if table has given column
// 		if (! array_key_exists($sField, $this->getSchema()->getColumns())) {
// 			return;
// 		}

		// get escaped name of table
		$sTableName = $this->getSchema()->getTableName();
		$sTableName = $this->_escapeName($sTableName);

		// get (escaped) name of primary key column
		$sPrimaryKeyColumnName = $this->getSchema()->getPrimaryKeyColumn()->getField();
		$sPrimaryKeyColumnNameEsc = $this->_escapeName($sPrimaryKeyColumnName);

		// get column type
		$sType = $this->getSchema()->getColumn($sField)->getType();

		$sField = $this->_escapeName($sField);
		$sValue = $this->_escapeValue($sType, $sValue);

		$sSql = "
			UPDATE
				$sTableName
			SET
				$sField = $sValue
			WHERE
				$sPrimaryKeyColumnNameEsc = $primaryKeyValue
			;";
		MySQL_Util::dbg($sSql, 2);
		//fb($sSql);
		$queryId = $this->getDb()->query($sSql);

	}

	/**
	 * Replaces a data row. If there is no row with the given primary key value
	 * a new row is created.
	 *
	 * TODO Does not work due to missing data in $aRawData for unchecked checkboxes.
	 *
	 * @param array $aRawData
	 */
	public function replaceRow(array $aRawData) {
		MySQL_Util::dbg('replaceRow');

		// get escaped name of table
		$sTableName = $this->getSchema()->getTableName();
		$sTableName = $this->_escapeName($sTableName);

		// create escaped copy of raw data
		$aEscData = $this->_escapeData($aRawData);

		// merge column names & values
		$sCsvNames = implode(', ', array_keys($aEscData));
		$sCsvValues = implode(', ', array_values($aEscData));

		$sSql = "
			REPLACE
				INTO
					$sTableName
				($sCsvNames)
			VALUES
				($sCsvValues)
			;";
		MySQL_Util::dbg($sSql, 2);
		return $this->getDb()->query($sSql);

	}


	/**
	 * @param mixed $primaryKeyValue
	 */
	public function editRow($primaryKeyValue) {
		MySQL_Util::dbg('editRow');

		$this->aCurrentData = $this->readRow($primaryKeyValue);

	}

	/**
	 * Deletes the row with the given primary key value.
	 *
	 * @param mixed $primaryKeyValue
	 */
	public function deleteRow($primaryKeyValue) {

		// get escaped name of table
		$sTableName = $this->getSchema()->getTableName();
		$sTableName = $this->_escapeName($sTableName);

		// get escaped name of primary key column
		$sPrimaryKeyColumnName = $this->getSchema()->getPrimaryKeyColumn()->getField();
		$sPrimaryKeyColumnNameEsc = $this->_escapeName($sPrimaryKeyColumnName);

		$sSql = "
			DELETE
			FROM
				$sTableName
			WHERE
				$sPrimaryKeyColumnNameEsc = $primaryKeyValue
			;";
		MySQL_Util::dbg($sSql, 2);
		return $this->getDb()->query($sSql);

	}

	/**
	 */
	public function saveRow() {
		MySQL_Util::dbg('saveRow');

		// get (escaped) name of primary key column
		$sPrimaryKeyColumnName = $this->getSchema()->getPrimaryKeyColumn()->getField();
		//$sPrimaryKeyColumnNameEsc = $this->_escapeName($sPrimaryKeyColumnName);

		// read raw data from post
		$aRawData = array();
		foreach ( $this->getSchema()->getColumns() as $sField => $oColumn ) {
			if (! array_key_exists($sField, $_POST)) {
				continue;
			}
			$aRawData[$sField] = $_POST[$sField];
		}

		// insert || update row
		if (!array_key_exists($sPrimaryKeyColumnName, $_POST)) {
			$this->insertRow($aRawData);
		} else {
			$primaryKeyValue = $_POST[$sPrimaryKeyColumnName];
			$this->updateRow($primaryKeyValue, $aRawData);
		}

		//$this->replaceRow($aRawData);

	}

	/**
	 * Creates an escaped copy of the given array with raw data.
	 *
	 * The array keys are escaped with backticks. The array values are escaped
	 * according to the columns data type.
	 *
	 * Key/value tuples for keys which cant be found in the tables schema are
	 * ommitted.
	 *
	 * @param array $aRawData
	 * @return array with escaped keys & values
	 */
	private function _escapeData($aRawData) {
		MySQL_Util::dbg('_escapeData');

		$aEscData = array();
		foreach ( $aRawData as $sField => $value ) {

			// check if column for data exists
			if (! array_key_exists($sField, $this->getSchema()->getColumns())) {
				echo "$sField is no valid column";
				continue;
			}

			// get column type
			$sType = $this->getSchema()->getColumn($sField)->getType();

			// escape column name
			$sEscField = $this->_escapeName($sField);

			// escape column value
			$mEscValue = $this->_escapeValue($sType, $value);

			$aEscData[$sEscField] = $mEscValue;

		}

		return $aEscData;

	}

	/**
	 * The column name is escaped with backticks.
	 *
	 * @param str $sField
	 * @return str escaped column name
	 */
	private function _escapeName($sField) {
		MySQL_Util::dbg('_escapeName');
		return MySQL_Util::escapeName($sField);
	}

	/**
	 * The column name is escaped with backticks.
	 *
	 * @param str $sField
	 * @return str escaped column name
	 */
	private function _escapeValue($sType, $mValue) {
		MySQL_Util::dbg('_escapeValue');

		// TODO enhance for all data types
		if (- 1 !== strpos($sType, 'varchar')) {
			return "'" . $this->getDb()->escape((string) $mValue) . "'";
		} elseif (- 1 !== strpos($sType, 'int')) {
			return (int) $mValue;
		} else {
			return $mValue;
		}

	}

}

?>
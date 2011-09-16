<?php

/**
  * ACTIVE CMS CORE CLASS
  *
  * @package Active CMS
  * @author www.activedev.net
  * @copyright 2010
  * @version $ID : core.class.php v2.0.0
  */

class ActiveAppsCore {

	/**
	 * Singleton, holds instance of this object
	 * 
	 * @var Language
	 */
	private static $_instance;

	/**
	 * ActiveAppsCore::__construct()
	 * @access public
	 * @return ActiveAppsCore Constructor function
	 */	
	function __construct() {}

	/**
	 * Get an the current instance of this object
	 * 
	 * @access public
	 * @return ActiveAppsCore Class Instance
	 */
	public static function Instance() {

		if ( !self::$_instance ) {

			self::$_instance = new ActiveAppsCore();
		}
		return self::$_instance;
	}

	/**
	 * ActiveCore::getSettings()
	 * @access private
	 * @return ActiveAppsCore getSettings function
	 */
	private function GetSettings() {

	  global $database;

	  $getWebsiteSettings = 'SELECT * FROM '.TBL_SETTINGS.' 
							 WHERE setting_status = 1 
							 ORDER BY setting_order ASC';

	  $row = $database->TabResSQL( $getWebsiteSettings );

	  $this->site_name		= $row['site_name'];
	  $this->company		= $row['company'];
	  $this->site_url		= $row['site_url'];
	  $this->site_email		= $row['site_email'];
	  $this->theme			= $row['theme'];
	  $this->seo			= $row['seo'];
	  $this->backup			= $row['backup'];
	  $this->thumb_w		= $row['thumb_w'];
	  $this->thumb_h		= $row['thumb_h'];
	  $this->short_date		= $row['short_date'];
	  $this->long_date		= $row['long_date'];
	  $this->logo			= $row['logo'];
	  $this->offline		= $row['offline'];
	  $this->metakeys		= $row['metakeys'];
	  $this->metadesc		= $row['metadesc'];
	  $this->version		= $row['version'];

	}
	
	/**
	 * ActiveCore::GetResult()
	 * @access private
	 * @return ActiveAppsCore getSettings function
	 */
	public static function GetResult($message = null, $erreur = null, $page_info = null, $warning = null) {

		if ( isset($message) ) {

			echo '<div class="notification success">
					<span></span>
					<p><strong>Succèss !</strong>
					<br />'.$message.'</p>
				  </div>
				  <div class="clear"></div>';
			return $message;
		}
		elseif ( isset($erreur) ) {

			echo '<div class="notification error">
					<span></span>
					<p><strong>Erreur !</strong>
					<br />'.$erreur.'</p>
				  </div>
				  <div class="clear"></div>';
			return $erreur;
		}
		elseif ( !empty($page_info) ) {
			echo '<div class="notification info">
					<span></span>
					<p><strong>Info !</strong>
					<br />'. $page_info .'</p>
				  </div>
				  <div class="clear"></div>';
			return $page_info;
		}
		elseif ( !empty($warning) ) {
			echo '<div class="notification warning">
					<span></span>
					<p><strong>Avertissement !</strong>
					<br />'. $warning .'</p>
				  </div>
				  <div class="clear"></div>';
			return $warning;
		}
	}

}
	
?>
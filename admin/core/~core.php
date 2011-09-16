<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

// Path to the admin folder
define('ADMINPATH', str_replace('\\', '/', realpath('./')));

// Path to the application folder
define('ABSPATH', str_replace('\\', '/', realpath('../')));

// The name of THIS file
define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));

define('ADMIN_ROOT', realpath(dirname(__FILE__)) );

// The PHP file extension
define('EXT', '.php');

/**
 * WARNING 
 * WARNING
 * CONST TO DO 
 * DO NOT FORGET 
 */
define( 'ROOT_FOLDER', '/activecms' );

// The Directory separator
define('DS', '/' );
define('CSS', 'styles' );
define('JS', 'jscripts' );
define('LAYOUTS', 'design/default');
define('HELPERS', ADMINPATH . DS . 'core/helpers' . DS);
define('VIEWS', 'views');
define('INC', ADMINPATH . DS . 'views' . DS);
define('INI', ADMINPATH . DS . 'core/ini' . DS );
define('TPL', ADMINPATH . DS . 'design/default/_common' . DS );
define('CLASSES', ADMINPATH . DS . 'core/classes' . DS );
define('MODULES', ADMINPATH . DS . 'extension' );
define('THEME', ABSPATH . DS . 'themes' );
define('BASEURL', ROOT_FOLDER . '/admin/design/default/');
define('BASEADMINURL', ROOT_FOLDER . '/admin/');

define('BR', "\n");

$DatePublished  = time();

#print_r()parse_url($_SERVER[R])

//echo $_SERVER["SERVER_NAME"];

echo $_SERVER['PATH_INFO'];


session_start();

//echo substr(dirname(__FILE__), strlen($_SERVER['DOCUMENT_ROOT']));

// Get database file
include ADMINPATH . '/core/database.php';

// Check PHP version
if ( phpversion() < 5.2 ) {
    
    die( 'Active CMS nécessite PHP 5.2 ou supérieur pour fonctionner !' );
}

// Result message function
function get_result($message = null, $erreur = null, $page_info = null, $warning = null) {

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
// Time reloaded page function
function getmicrotime() {

    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
    
}
$starttime = getmicrotime();

$Language = Language::GetInstance();

if ( isset($_GET['ln']) ) {

    $_SESSION['language'] = $_GET['ln'];
    Language::Set($_SESSION['language']);
    Language::SetAuto(true);
}

// DEFINE BDD TABLES
define ('TBL_PAGES', DB_PREFIX.'pages');
define ('TBL_SETTINGS', DB_PREFIX.'settings');
define ('TBL_USERS', DB_PREFIX.'users');
define ('TBL_MAILING', DB_PREFIX.'mailing');

$ini 	= new FileINI(); // INI Class
$html	= new HTML(); // HTML Helper Class
$form	= new FORM(); // FORM Helper Class

/**
 * Autoload classes files
 * @param <type> $fileClassName
 * __autoload function
 */
function __autoload( $fileClassName ) {

    if ( file_exists( CLASSES . $fileClassName . '.class' . EXT ) ) {
        
		include CLASSES . $fileClassName . '.class' . EXT;
    }
    elseif ( file_exists( HELPERS . $fileClassName . '.helper' . EXT ) ) {
        
		include HELPERS . $fileClassName . '.helper' . EXT;
    }
    else {
        
		exit( 'Ligne :'. __LINE__ .'<br /> Impossible de charger la classe <strong>'. $fileClassName .'</strong>' );
    }
}

/**
 * Submit button
 * @param <type> $value
 * get_submit_button function
 */
function get_submit_button( $value ) {

    $html	= new HTML(); // HTML Helper Class
    $form	= new FORM(); // FORM Helper Class

    echo $form->form_submit( array( 'name'  => 'submit',
                                    'type'  => 'submit',
                                    'id'    => 'submit_new',
                                    'value' => __( $value ),
                                    'style' => 'float:left;')
							);
	
    echo $html->img( array( 'src'   => 'images/loading.gif',
                            'id'    => 'loading',
                            'style' => 'display:none;')
                    );
}
/**
 * Reset button
 * @param <type> $value
 * get_reset_button function
 */
function get_reset_button( $value ) {

    $form	= new FORM(); // FORM Helper Class

    echo $form->form_submit( array( 'name'  => 'submit',
                                    'type'  => 'submit',
                                    'id'    => 'submit_new',
                                    'value' => __( $value ),
                                    'style' => 'float:right;')
			);
}
/**
 * Cancel button
 * @param <type> $value
 * get_cancel_button function
 */
function get_cancel_button( $value ) {
	
    $form	= new FORM(); // FORM Helper Class

    echo $form->form_submit( array( 'name'  => 'submit',
                                    'type'  => 'submit',
                                    'id'    => 'submit_new',
                                    'value' => __( $value ),
                                    'style' => 'float:right;')
			);
}

/**
 * Cancel button
 * @param <type> $value
 * get_cancel_button function
 */
function get_current_page_title( $value, $icon, $head ) {
	
    $html		= new HTML(); // HTML Helper Class
	$img		= $html->img($icon);
	$tr_value	= __($value);
	
    echo $html->heading( $img . $tr_value, $head );
}

/*
function access_forbidden(){

	if (  )
}
*/

$ini_file				= INI . 'site.ini'; // FICHIER CONFIG INI
$ModeDeveloppement	    = $ini->setVariables($ini_file, 'DebugSettings', 'EnableOutputDebug'); // debug

$Mysql 	= new Mysql($Bdd = DB_NAME, $Serveur = DB_HOST , $Identifiant = DB_USER, $Mdp = DB_PASSWORD); // INSTANCIATION : CONNEXION BDD
$debug	= new debug(); // Output Debug Class

$user_registeration_section = 'UsersRegisterSettings'; // REGISTRATION SECTION []
$author_section             = 'AuthorSettings'; // AUTHOR SECTION []
$site_section               = 'SiteSettings'; // SITE SECTION []

$author                 = $ini->setVariables($ini_file, $author_section, 'Author');
$url_author             = $ini->setVariables($ini_file, $author_section, 'URLAuthor');
$version                = $ini->setVariables($ini_file, $author_section, 'AppVersion');
$app_years              = $ini->setVariables($ini_file, $author_section, 'AppYears');
$PublishedDateFormat    = $ini->setVariables($ini_file, $site_section, 'PublishedDateFormat'); // Date format
$WebSiteName            = $ini->setVariables($ini_file, $site_section, 'SiteName'); // Site Name
$UsernameMaxLength      = $ini->setVariables($ini_file, $user_registeration_section, 'UsernameMaxLength');
$UsernameMinLength      = $ini->setVariables($ini_file, $user_registeration_section, 'UsernameMinLength');
$PasswordMaxLength      = $ini->setVariables($ini_file, $user_registeration_section, 'PasswordMaxLength');
$PasswordMinLength      = $ini->setVariables($ini_file, $user_registeration_section, 'PasswordMinLength');
$UserDefaultStatus      = $ini->setVariables($ini_file, $user_registeration_section, 'UserDefaultStatus');
$UserDefaultLevel       = $ini->setVariables($ini_file, $user_registeration_section, 'UserDefaultLevel');

define( 'FRONT_END_URL', $ini->setVariables($ini_file, $site_section, 'FrontEndURL') ); // Site Path
define( 'BACK_END_URL', $ini->setVariables($ini_file, $site_section, 'BackEndURL') ); // Site Path
define( 'ADMIN_EMAIL', $ini->setVariables($ini_file, $author_section, 'EmailAuthor') ); // Admin Email
define( 'FRONT_LAYOUT', $ini->setVariables($ini_file, $site_section, 'FrontTemplate') ); // Admin Email

/*
// Loads the website template
if ( file_exists( THEME . DS . SITE_TEMPLATE . '/index.php' ) ) {
    
    include THEME . DS . SITE_TEMPLATE . '/index.php';
}
else {
	
    echo __('Le chemin du template est invalide ou introuvable !');
}
 * 
 */

/**
   * loadEditor()
   * 
   * @param mixed $field
   * @param mixed $value
   * @param mixed $width
   * @param mixed $height
   * @param mixed $toolbar
   * @return
   */
  function get_fck_editor($field, $value, $width, $height, $toolbar = 'Articles') {
	  
      $oFCKeditor = new FCKeditor($field);
      $oFCKeditor->Value = html_entity_decode($value, ENT_QUOTES, 'UTF-8');
      $oFCKeditor->Width = $width;
      $oFCKeditor->Height = $height;
      $oFCKeditor->BasePath = '../fck/';
      $oFCKeditor->ToolbarSet = $toolbar;
      $oFCKeditor->Create();
  }
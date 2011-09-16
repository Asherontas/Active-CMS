<?php

// ACTIVE CMS
// CORE FILE FOR APPLICATION

include_once 'admin/core/database.php';
include_once 'admin/classes/Mysql.class.php';

// DEFINE BDD TABLES
define('TBL_PAGES', DB_PREFIX.'pages');
define('TBL_SETTINGS', DB_PREFIX.'settings');
define('TBL_USERS', DB_PREFIX.'users');
define('TBL_MAILING', DB_PREFIX.'mailing');

define('THEME', 'templates/' );

	
if ( !file_exists('admin/core/database.php') OR !defined(DB_HOST) ) {
	echo 'd';
	#header('Location: install/');
}

$Mysql 	= new Mysql($Bdd = DB_NAME, $Serveur = DB_HOST , $Identifiant = DB_USER, $Mdp = DB_PASSWORD); // INSTANCIATION : CONNEXION BDD

// Get Config data
$SettingsQuery = $Mysql->TabResSQL('SELECT * FROM '.TBL_SETTINGS.'
									WHERE setting_status = "1"');

foreach ($SettingsQuery as $key => $Donnees) {

	$SettingsAttribute  = $Donnees['setting_name'];
	$SettingsValues     = $Donnees['setting_value'];

	switch ( $SettingsAttribute ) {
            
		case 'site_name':
			define( 'SITE_NAME', $SettingsValues );
		break;
		case 'site_solgan':
			define( 'SITE_SLOGAN', $SettingsValues );
		break;
		case 'site_keywords':
			define( 'SITE_KEYWORDS', $SettingsValues );
		break;
		case 'site_description':
			define( 'SITE_DESCRIPTION', $SettingsValues );
		break;
		case 'site_email':
			define( 'SITE_EMAIL', $SettingsValues );
		break;
		case 'site_seo':
			define( 'SITE_SEO', $SettingsValues );
		break;
		case 'site_template':
			define( 'SITE_TEMPLATE', $SettingsValues );
		break;
	}
}

// Loads the website template
if ( file_exists( THEME . SITE_TEMPLATE . '/index.php' ) ) {
    
    include THEME . SITE_TEMPLATE . '/index.php';
}
else {
	
    echo 'Le chemin du template est invalide ou introuvable !';
}
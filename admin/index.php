<?php

/*
  Active CMS "CMS PRO EVOLUTIF"
  copyright (c) 2010-2011 Active Developpement
  Application 	: Active-CMS Système de gestion de contenu
  Auteur		: Achour Omar
  Site web		: www.activedev.net
  E-mail		: contact@activedev.net

*/

#echo str_replace('=', '', base64_encode($data['ID']));

include dirname(__FILE__). '/init.php'; // FICHIER CONFIGURATION

if ( isset($_SESSION['username']) AND $_SESSION['username'] == true ) {

    $html_title = 'Active CMS | Administration';

    include TPL . '_head.php'; // HEAD LOGIN
    include TPL . 'header.php'; // HEADER
    include TPL . 'navigation.php'; // MENU NAVIGATION

    // PAGES CONTENT
    if ( !isset($_GET['action']) ) {

		$_GET['action'] = 'index';
    }
	if ( file_exists( 'extension/' . $_GET['action'] . EXT ) ) {
		
		$_GET['action'] =  'extension/'. $_GET['action'];
	}
    elseif ( !file_exists( INC . $_GET['action'] . EXT ) ) {
	
		$_GET['action'] =  'errors/404';
    }
	
    ob_start();
		
	include INC . $_GET['action'] . EXT;

	$get_content = ob_get_contents();

    ob_end_clean();

    echo $get_content;
	
    include TPL . 'footer.php'; // FOOTER
}
else {
    
    include TPL . '_login.php'; // LOGIN
}

/**
 *
 * Clear All
 * Defined variables
 * Defined functions
 * Defined constants
 * 
 */

/*

$vars	= get_defined_vars();
$func	= get_defined_functions();
$const	= get_defined_constants();

if ( !empty($const) OR !empty($func) OR !empty($vars)) {
    unset($vars, $func, $const);
}

 */
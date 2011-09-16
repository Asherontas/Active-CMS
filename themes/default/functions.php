<?php

define('TEMPLATE', THEME . DS . SITE_TEMPLATE);

define('INCLUDES', 'theme/');

$get = new SimpleSanitize('get', 'html', 0); // POST PARAMS

$PageID = $get->getInt('id');

// Get Links Query
$LinksQuery = $Mysql->TabResSQL('SELECT * FROM '.TBL_PAGES.' 
								 WHERE page_status = "1"');

// Get Pages Query
$PagesQuery = $Mysql->TabResSQL('SELECT page_content FROM '.TBL_PAGES.'
								 WHERE page_status = "1"
								 AND ID = "'.$PageID.'"');

// Get Pages Function
function get_content($PagesQuery, $PageID) {
	
    if ( $PageID != null ) {
       
        foreach ($PagesQuery as $Donnees) {
            echo html_entity_decode($Donnees['page_content']);
        }
    }
}

// Get Links Function
function get_links($LinksQuery) {
	
	foreach ($LinksQuery as $Donnees) {

        $PageID     = $Donnees['ID'];
        $PageLink   = $Donnees['page_link'];
        $PageTitle  = $Donnees['page_title'];
		
		$replace = array(
						'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
						'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
						'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
						'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
						'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
						'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
						'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f'
					);
		
		$PageTitleWash = strtr($PageTitle, $replace);
		
		if ( SITE_SEO == 0 ) {
           echo '<li><a href ="index.php?id='.$PageID.'">'.$PageLink.'</a></li>';
        }
        else {
           echo '<li><a href ="'.strtr($PageTitleWash, ' ', '-').'_'.$PageID.'.html">'.$PageLink.'</a></li>';
        }
    }
}

function get_page_title($LinksQuery) {
	
	foreach ($LinksQuery as $Donnees) {
		
        $PageTitle  = $Donnees['page_title'];
	}
	
	return $PageTitle;
}

?>
<?php 

/**
 * Page title 
 * @param Title, Icon, headers
 * Icon path images/title/<icon>
 */
get_current_page_title( 'Tous les Widgets', 'images/title/32/widgets.png', '1' );

$modules_section 	= 'ModuleSettings';

$IsEnabledModule	= $ini->setVariables($ini_file, $modules_section, 'EnableModules');
$ModuleName			= $ini->setVariables($ini_file, $modules_section, 'ModuleEnabled');

// DEFINIE LES MODULES
define( 'MODULE_NAME', $ModuleName );

$file = new Explorer();

$file->SetPath(INC . DS . '/widgets');
	
	$ModulesFolder = $file->Listing($exclude_extension = array('php', 'html'));

if ( $IsEnabledModule == 'true' ) {
	
    if ( empty($ModulesFolder) ) {

	    $page_info = __('Le dossier module est vide <br />
			    Aucun module à été ajouté, Merci de m\'envoyer un mail pour la création des modules !');
    }
    else {

	    $ShowModules 	= true;
	    $page_info 	= __('Voici la listes de tout les modules chargés <br />
				  Rendez vous dans le répertoire modules, et ajouter vos modules crées !');
    }
	
}
else {
	
	$erreur = __('Les modules sont désactivé ! <br />
		     LES MODULES SONT DESACTIVE, VEUILLER MODIFIER LE FICHIER <a href="?action=ini">INI</a>, PAR TRUE OU FALSE !');
}

get_result($message, $erreur, $page_info);

if ( $ShowModules == true ) {

?>
<table width="100%" border="0">
    <tr>
        <td>
            <?php foreach ( $ModulesFolder as $Module ) { ?>
            <div class="icon">
			<?php

			if ( file_exists(INC . $Module['dirname'] . DS . 'screenshot.png')) {

				$ModuleScreen = $html->img(INC . $Module['dirname'] . DS . 'screenshot.png');
			}
			else {

				$ModuleScreen = $html->img('images/module.png');
			}

			echo $html->url('modules/'.$Module['dirname'].'/module',
					$ModuleScreen.'<span class="module_name">'.$Module['dirname'].'</span>');

			?>
            </div>
          <?php } ?>
        </td>
    </tr>
</table>
<?php } ?>
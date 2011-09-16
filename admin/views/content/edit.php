<?php

echo $html->scripts('jscripts/tiny_mce/tiny_mce.js');
echo $html->scripts('jscripts/editeur.js');

$page_info =  __(' Voici la liste de tout les utilisateurs inscrits sur le site.<br />
				   Dans la colonne Actions, vous pouvez activer, editer et supprimer un utilisateur !');

$post   = new SimpleSanitize( 'get', 'mysql', 0 ); // INSTANCIATION : PROTECT POST FORM

$PageID = $post->getInt('id');

if ( isset( $_POST['submit'] ) ) {

    $post->setDataType('post');
	
    $page_title     = strip_tags($post->untouched('page_title'));
    $page_menu      = strip_tags($post->untouched('page_menu'));
    $page_content   = $post->untouched('page_content');

    $Mysql->ExecuteSQL('UPDATE '.TBL_PAGES.' SET page_title = "'.$page_title.'",
												 page_link = "'.$page_menu.'",
												 page_content = "'.$page_content.'",
												 page_modified = "'.$DatePublished.'"
                        WHERE ID = "'.$PageID.'"');

    if ( $Mysql ) {

		$message = __('Page à été mis a jours avec succes.');
	}
    else {

		$erreur  = __('Une erreur est survenu La page n\'a pas été mis a jour !');
	}	
}

if ( ! isset( $PageID ) ) {
	
	$erreur  = __('Acune page à éditer !');
}
else {

	$Resultat = $Mysql->TabResSQL('SELECT * FROM '. TBL_PAGES .' WHERE ID = '. $PageID);

	// Utilisation des résultats
	foreach ( $Resultat as $Donnees ) {

		$PageTitle		= $Donnees['page_title'];
		$DateModified 	= $Donnees['page_modified'];
		$PageLink		= $Donnees['page_link'];
		$PageContent	= $Donnees['page_content'];
	}
}

/**
 * Page title 
 * @param Title, Icon
 * Icon path images/title/<icon>
 */
get_current_page_title( 'Modification de la page "<strong>'. $PageTitle .'</strong>"<span> Dérnière modification le '. date($PublishedDateFormat, $DateModified) .'</span>', 
						'images/title/32/edit_page.png', '1' );

get_result( $message, $erreur, $page_info ); 

// Form Start
echo $form->form_open( 'edit&id='. $PageID );

?>
<table width="100%" border="0">
	<tr>
		<td width="20%"><?php echo __( 'Titre page' ); ?></td>
		<td width="80%">
	    <?php
			echo $form->form_input( array( 'name'	=> 'page_title',
										   'type'	=> 'text',
										   'value'	=> $PageTitle,
										   'size'	=> '50')
								);

			echo $html->clear_url( '', $html->img('images/help.png').'<span class="tooltip">'.__('Titre de la page').'</span>',
									array('class' => 'tooltips')
								);
		?>
		</td>
	</tr>
	<tr>
		<td><?php echo __('Titre men'); ?></td>
		<td>
		<?php
			echo $form->form_input( array( 'name'	=> 'page_menu',
										   'type'	=> 'text',
										   'value'	=> $PageLink,
										   'size'	=> '50')
								);

			echo $html->clear_url('', $html->img('images/help.png').'<span class="tooltip">'.__('Ceci et le titre qui sera affiché dans le menu navigation.').'</span>',
									array('class' => 'tooltips')
								);
		?>
		</td>
	</tr>
	<tr>
		<td valign="top"><?php echo __('Contenu'); ?></td>
		<td>
			<?php 
				require_once("fck/fckeditor.php");
				get_fck_editor('page_content', $PageContent, '100%', 350); 
			?>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><?php get_submit_button( 'Mettre à jour' ) ?></td>
	</tr>
</table>
<?php echo $form->form_close();
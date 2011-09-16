<?php

/**
 * Page title 
 * @param Title, Icon
 * Icon path images/title/<icon>
 */
get_current_page_title( 'Création d\'une nouvelle page', 'images/title/32/add_page.png', '1' );



$PagesTypes = array('view_full'		=> 'Toute la page',
					'view_line'		=> 'Portion de la page',
					'contact_form'	=> 'Formulaire de conntact',
					'gallery'		=> 'Gallerie images' );
					 
$getPagesParent = $Mysql->TabResSQL('SELECT ID, page_title FROM '.TBL_PAGES.' WHERE is_parent = 1');

$page_info = __('Voici la liste de tout les utilisateurs inscrits sur le site.<br />
		 Dans la colonne Actions, vous pouvez activer, editer et supprimer un utilisateur !');

$post = new SimpleSanitize( 'post', 'mysql', 0 ); // POST PARAMS

$PageTitle		= null;
$TitleMenu		= null;
$IsPublished 	= null;
$PageContent 	= null;

if ( isset($_POST) AND $_POST != null ) {

    $PageTitle      = strip_tags($post->get('page_title'));
    $TitleMenu      = strip_tags($post->get('page_menu'));
    $IsPublished    = $post->getInt('page_publish');
    $PageContent    = utf8_decode($post->get('page_content'));

    if ( empty($TitleMenu) OR empty($PageContent)) {
		
        $erreur = __('Veuillez repmplir tout les champs, et rédiger le contenu de la page !');
    }
	elseif ( empty( $PageTitle ) ) {
		
		$erreur = __('le titre de la page est requis !');
	}
    else {

         $Mysql->ExecuteSQL("INSERT INTO ".TBL_PAGES." (page_content,
														page_title,
														page_link,
														page_status,
														page_modified,
														page_published)
                             VALUES ('".$PageContent."',
                                     '".$PageTitle."',
                                     '".$TitleMenu."',
                                     '".$IsPublished."',
                                     '".$DatePublished."',
                                     '".$DatePublished."')
							");
        if ( $Mysql ) {

            $message = __('Page à été créer avec succès !!');
        }
        else {

            $erreur = __('Une erreur est survenu La page n\'a pas été créée !!');
        }
    }  
} // End if
	
get_result($message, $erreur, $page_info);

// Form Start
echo $form->form_open('add');

?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="120"><?php echo __('Titre de la page'); ?></td>
		<td width="600">
		<?php
			echo $form->form_input(array('name'	=> 'page_title',
										 'type'	=> 'text',
										 'value'=> $PageTitle,
										 'size'	=> '50'));
			
			echo $html->clear_url('', $html->img('images/help.png').'<span class="tooltip">'.__('Ceci et le titre de la page (Il sera affiché dans le navigateur').'</span>', array('class' => 'tooltips'));
		?>
		</td>
	</tr>
	<tr>
		<td><?php echo __('Titre du menu'); ?></td>
        <td>
		<?php
			echo $form->form_input(array('name'	=> 'page_menu',
										 'type'	=> 'text',
										 'value'=> $TitleMenu,
										 'size'	=> '50'));
			echo $html->clear_url('', $html->img('images/help.png').'<span class="tooltip">'.__('Saisir le lien qui sera affiché dans le menu navigation').'</span>', array('class' => 'tooltips'));
		?>
		</td>
	</tr>
	<tr>
		<td><?php echo __('Tyle de la page'); ?></td>
		<td>
        	<select name="page_parent" style="width:340px" tabindex="3">
				<option value=""></option>
				<?php foreach ( $PagesTypes as $key => $types ) { ?>
					<option value="<?php echo $key; ?>"><?php echo $types; ?></option>
				<?php } ?>
			</select>
			<a href="#" class="tooltips"><img src="images/help.png" alt="aide" /><span class="tooltip"><?php echo __('Saisir le lien qui sera affiché dans le menu navigation'); ?></span></a>
		</td>
	</tr>
	<tr>
		<td><?php echo __('Page parent'); ?></td>
		<td>
        	<select name="page_parent" style="width:340px" tabindex="4">
				<option value=""></option>
				<?php foreach ( $getPagesParent as $parent ) { ?>
					<option value="<?php echo $parent['ID']; ?>"><?php echo $parent['page_title']; ?></option>
				<?php } ?>
			</select>
			<a href="#" class="tooltips"><img src="images/help.png" alt="aide" /><span class="tooltip"><?php echo __('Saisir le lien qui sera affiché dans le menu navigation'); ?></span></a>
		</td>
	</tr>
	<tr>
		<td><?php echo __('Avoir des children'); ?></td>
		<td>
			<div class="demo-dark" id="demo1">
				<input type="radio" name="page_publish" value="1" id="radio4" class="radioSlider" style="" >
				<label for="radio4"><?php echo __('Oui'); ?></label>
				
				<input type="radio" name="page_publish" value="0" checked="checked" id="radio5" class="radioSlider" style="">
				<label for="radio5"><?php echo __('Non'); ?></label>
			</div>
		</td>
	</tr>
	<tr>
		<td><?php echo __('Publier la page'); ?></td>
		<td>
			<div class="demo-dark" id="demo2">
				<input type="radio" name="page_publish" value="1" id="radio4" class="radioSlider" style="" >
				<label for="radio4"><?php echo __('Oui'); ?></label>
				
				<input type="radio" name="page_publish" value="0" checked="checked" id="radio5" class="radioSlider" style="">
				<label for="radio5"><?php echo __('Non'); ?></label>
			</div>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td valign="top"><?php echo __('Contenu de la page'); ?></td>
		<td>
			<?php 
				require_once("fck/fckeditor.php");
				get_fck_editor('page_content', $PageContent, '100%', 350); 
			?>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><?php get_submit_button( 'Publier cette page' ); ?></td>
	</tr>
</table>
<?php echo $form->form_close();
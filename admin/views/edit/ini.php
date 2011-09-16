<?php

/**
 * Page title 
 * @param Title, Icon, headers
 * Icon path images/title/<icon>
 */
get_current_page_title( 'Configuration de fichier INI', 'images/title/32/ini.png', '1' );


$FileINI = new Explorer();

$SiteINIFile = INI . 'site.ini.config.php';

$FileINI->SetPath($SiteINIFile);

if ( isset($_POST['submit']) AND $_POST != null ) {

	$contentFileINI = $_POST['file_ini'];
	
	if ( is_writable($SiteINIFile) ) {
	
		$FileINI->Write($contentFileINI);
		$message = __('Le fichier a été mise a jour avec succèe !');
		
	}
	else {
	
		$erreur = __('Le fichier n\'est pas accessible en écriture !');
		
	}
}

$page_info = __('Ce fichier contient tout les paramètres qui définissant les paramètres de Active CMS <br />
    		 Ne touchez pas à ce fichier si vous ne savez pas exactement ce que vous faites !');


get_result($message, $erreur, $page_info);

// Form Start
echo $form->form_open('');

?>
<table width="100%" border="0">
    <tbody>
      <tr>
	<td width="100%">
	    <?php echo $form->form_textarea(array('cols' => '100', 'rows' => '30', 'name' => 'file_ini'), $FileINI->Read()); ?>
	</td>
      </tr>
      <tr>
	<td>
	<?php
	    echo $form->form_submit(array(  'name'  => 'submit',
					    'type'  => 'submit',
					    'id'    => 'submit_new',
					    'value' => __('Enregistrer les modifications'),
					    'style' => 'float:left;'
					)
				);

	    echo $html->img(array('src' => 'images/loading.gif', 'id' => 'loading', 'style' => 'display:none;'));
	?>
	</td>
      <td>&nbsp;</td>
      </tr>
    </tbody>
</table>
<?php echo $form->form_close();
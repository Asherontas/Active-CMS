<?php

/**
 * Page title 
 * @param Title, Icon, headers
 * Icon path images/title/<icon>
 */
get_current_page_title( 'Paramètres du site', 'images/title/32/settings.png', '1' );

$page_info = __('Ceci est la configuration globale du site<br />
				 This is a info notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit.');

$file = new Explorer();

$file->SetPath(THEME);
$TemplatesFolder = $file->Listing();

$post = new SimpleSanitize('post', 'mysql', 0); // POST PARAMS

if ( isset( $_POST['submit'] ) AND $_POST != null ) {
        
	$SiteName           = strip_tags($post->get('site_name'));
	$SiteSlogan         = strip_tags($post->get('site_slogan'));
	$SiteKeywords       = strip_tags($post->get('site_keywords'));
	$SiteDescription    = strip_tags($post->get('site_description'));
	$SiteEmail          = strip_tags($post->get('site_email'));
	$SiteURL	        = utf8_decode( strip_tags( $post->get( 'site_url' ) ) );
	$SiteStatus         = $post->getInt('site_status');
	$SiteSeo            = $post->getInt('site_seo');
	$SiteTheme			= strip_tags($post->get('site_template'));
	
	$SettingName		= array( 'site_name'		=> $SiteName,
								 'site_slogan'		=> $SiteSlogan,
								 'site_keywords'	=> $SiteKeywords,
								 'site_description' => $SiteDescription,
								 'site_email'		=> $SiteEmail,
								 'site_url'			=> $SiteURL,
								 'site_status'		=> $SiteStatus,
								 'site_seo'			=> $SiteSeo,
								 'site_template'	=> $SiteTheme );
	
	if ( !Validator::Email( $SiteEmail ) ) {

		$erreur = __( 'Adresse Email est invalide !' );
	}
	else {
		
		foreach ( $SettingName as $key => $Value ) {

			$UpdateSettingsQuery = $Mysql->ExecuteSQL( 'UPDATE '. TBL_SETTINGS .' SET setting_value = "'.$Value.'" WHERE setting_name = "'.$key.'"' );
		}

		if ( $UpdateSettingsQuery == 0 ) {

			$warning = __( 'Acune modification à était fait !' );
		}
		elseif ( $UpdateSettingsQuery == 1 ) {
			
			$message = __( 'Les données sont mis à jour avec succées !' );
		}
		else {

			$erreur = __( 'Une erreur est survenue, veuillez réessayer !' );
		}
	}
}

get_result($message, $erreur, $page_info, $warning);

echo $form->form_open('');

?>
<table width="100%" border="0">
	<?php
		
		/**
		 * getWebsiteSettings Query
		 * 
		 */
		$getWebsiteSettings = $Mysql->TabResSQL('SELECT * FROM '.TBL_SETTINGS.'
												 WHERE setting_status = 1
												 ORDER BY setting_order ASC');
		

		// Get result
		foreach ( $getWebsiteSettings as $Donnees ) {

			$SiteSettingsTitle 	= utf8_encode( $Donnees['setting_title'] );
			$SiteSettingsName 	= utf8_encode( $Donnees['setting_name'] );
			$SiteSettingsType 	= $Donnees['setting_type'];
			$SiteSettingsValue 	= utf8_encode( $Donnees['setting_value'] );
			$SiteSettingsInfo 	= utf8_encode( $Donnees['setting_info'] );
    
    ?>
    <tr>
		<td width="15%" valign="top"><?php echo __( $SiteSettingsTitle ); ?></td>
		<td width="85%">
			<?php

			switch ( $SiteSettingsType ) {
				
				case 'image':
				echo $form->form_upload( array( 'name' => $SiteSettingsName, 'type' => 'text', 'value'=> $SiteSettingsValue, 'size'	=> '50' ) );
				break;
			
				case 'url':
				echo $form->form_input( array( 'name' => $SiteSettingsName, 'type' => 'text', 'value'=> $SiteSettingsValue, 'size'	=> '50' ) );
				break;
			
				case 'mail':
				echo $form->form_input( array( 'name' => $SiteSettingsName, 'type' => 'text', 'value'=> $SiteSettingsValue, 'size'	=> '50' ) );
				break;
			
				case 'radio':
				if (  $SiteSettingsValue == 1 ) {
					echo '<div class="demo-light">';
					echo '<input type="radio" name="'. $SiteSettingsName .'" value="1" checked="checked" id="radio4" class="radioSlider" style="" >
							<label for="radio4">'. __('Oui') .'</label>
						  <input type="radio" name="'. $SiteSettingsName .'" value="0" id="radio5" class="radioSlider" style="">
							 <label for="radio5">'. __('Non') .'</label>';
					echo '</div>';
				}
				else {
					echo '<div class="demo-dark">';
					echo '<input type="radio" name="'. $SiteSettingsName .'" value="1" id="radio4" class="radioSlider" style="" >
							<label for="radio4">'. __('Oui') .'</label>
						 <input type="radio" name="'. $SiteSettingsName .'" value="0" checked="checked" id="radio5" class="radioSlider" style="">
							<label for="radio5">'. __('Non') .'</label>';
					echo '</div>';
				}
				break;
				
				case 'checkbox':
				echo $form->form_checkbox( $SiteSettingsName, $SiteSettingsValue, true );
				break;
			
				case 'template_path':
				echo '<select name="'. $SiteSettingsName .'" style="width:340px">';

				foreach ( $TemplatesFolder as $Templates ) {

					if ( $SiteSettingsValue == $Templates['dirname'] ) {

						echo '<option value="'. $SiteSettingsValue .'" selected="selected">'. $SiteSettingsValue .'</option>';
					}
					else {

						echo '<option value="'. $Templates['dirname'] .'">'. $Templates['dirname'] .'</option>';
					}
				}
				echo '</select>';
				break;
			
				case 'selection_multiple':
				echo $form->form_input(array('name' => $SiteSettingsName,'type' => 'text', 'value'=> $SiteSettingsValue, 'size'	=> '50'));
				break;
			
				case 'string':
				echo $form->form_input(array('name' => $SiteSettingsName,'type' => 'text', 'value'=> $SiteSettingsValue, 'size'	=> '50'));
				break;
			
				case 'text':
				echo $form->form_textarea(array('cols' => '47', 'rows' => '5', 'name' => $SiteSettingsName), $SiteSettingsValue);
				break;

			} // End Switch
			if ( !empty( $SiteSettingsInfo ) ) {

				echo $html->url('javas', $html->img( 'images/help.png' ).'<span class="tooltip">'.__($SiteSettingsInfo).'</span>',
					array('class' => 'tooltips'));
			}
			?>
		</td>
	</tr>
	<?php } ?>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
    <tr>
		<td>&nbsp;</td>
		<td>
			<?php get_submit_button( 'Enregistrer les modifications' ); ?>
			<input type="submit" style="float:right;" id="submit_new" value="Ajouter une options" name="submit">
		</td>
    </tr>
</table>
<?php echo $form->form_close(); ?>